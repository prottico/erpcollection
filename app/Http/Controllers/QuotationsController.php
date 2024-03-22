<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use RuntimeException;
use App\Models\Budget;
use App\Models\Product;
use App\Models\Currency;
use App\Models\TypeCase;
use App\Models\Quotation;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use function Laravel\Prompts\error;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

use App\Http\Requests\SaveLawyersRequest;
use App\Http\Requests\SaveQuotationRequest;
use App\Http\Requests\SaveLawyerQuotationRequest;

class QuotationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Quotation::with('client')->get();
        return view('quotations.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $currencies = Currency::all();
        return view('quotations.create', compact('currencies'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(SaveQuotationRequest $request): RedirectResponse
    {
        // dd($request->all());
        try {
            $validatedData = $request->validated();
            $this->saveBaseExecutionDocumentIfExists($request);
            if (!$request->hasFile('base_execution_document')) {
                return null;
            }

            $path = $request->file('base_execution_document')->store('base_execution_documents', 'public');
            $validatedData['base_execution_document'] = $request->file('base_execution_document')->getClientOriginalName();
            $validatedData['path_base_execution_document'] = $path;

            $validatedData = $this->setAdditionalProperties($validatedData, $request);

            Quotation::create($validatedData);

            return $this->redirectBasedOnUserRole($request);
        } catch (\Throwable $exception) {
            Log::error(['Message' => $exception->getMessage(), 'data' => $validatedData]);
            return back()->with('error', '¡Ha ocurrido un error inesperado!');
        }
    }

    private function saveBaseExecutionDocumentIfExists($request)
    {

        //         if ($request->hasFile('base_execution_document')) {
        //             $path = $request->file('base_execution_document')->store('base_execution_documents', 'public');
        //             // foreach ($request->file('base_execution_document') as $file) {
        //             //     $file->store('public');
        //             // }
        //         }

        if (!$request->hasFile('base_execution_document')) {
            return null;
        }

        $path = $request->file('base_execution_document')->store('base_execution_documents', 'public');
        $validatedData['base_execution_document'] = $request->file('base_execution_document')->getClientOriginalName();
        $validatedData['path_base_execution_document'] = $path;

        // return $path;
    }

    private function setAdditionalProperties(&$validatedData, SaveQuotationRequest $request): array
    {
        $validatedData['client_id'] = Str::of($request->user()->person->client->id)->toString();
        $validatedData['credit_start_date'] = Carbon::parse($request->input('credit_start_date'));
        $validatedData['last_payment_day'] = $request->input('no_apply_last_payment_day') ? null : Carbon::parse($request->input('last_payment_day'));
        $validatedData['token'] = $this->getFakerToken();
        $validatedData['code'] = $this->generateCodeBasedOnTypePaymentId($validatedData['type_payment_id']);

        return $validatedData;
    }

    private function generateCodeBasedOnTypePaymentId(int $typePaymentId): string
    {
        switch ($typePaymentId) {
            case 1:
                return 'CJ-' . str_pad(Quotation::count() + 1, 9, '0', STR_PAD_LEFT);
            case 2:
                return 'CEJ-' . str_pad(Quotation::count() + 1, 9, '0', STR_PAD_LEFT);
            default:
                return 'EF-' . str_pad(Quotation::count() + 1, 9, '0', STR_PAD_LEFT);
        }
    }

    private function redirectBasedOnUserRole(SaveQuotationRequest $request): RedirectResponse
    {
        if (auth()->check()) {
            /** @var \App\Models\User $user */
            $user = auth()->user();
            return $user->hasRole('independent-client|company-client|employee')
                ? redirect()->route('clients.quotations.index')->with('success', 'Cotización registrada correctamente!')
                : redirect()->route('quotations.index')->with('success', 'Cotización registrada correctamente!');
        }
        throw new RuntimeException('Usuario autenticado no encontrado.');
    }

    /**
     * Display the specified resource.
     */
    public function edit(string $token)
    {
        try {
            $view = '';
            $quotation = Quotation::where('token', $token)->with(['client', 'client.person', 'documents', 'typeCase', 'budget', 'budget.product'])->first();
            $lawyers = User::where('type_user_id', 3)->whereHas('person')->with(['person'])->get();
            $typeCases = TypeCase::all();
            $currencies = $this->getCurrencies();

            if (Auth::check()) {
                /** @var \App\Models\User $user */
                $user = Auth::user();
                if ($user->hasRole('lawyer')) {
                    $view = 'quotations.lawyers.edit';
                } else {
                    $view = 'quotations.edit';
                }
            };
            return view($view, compact('quotation', 'lawyers', 'typeCases', 'currencies'));
        } catch (\Throwable $th) {
            Log::error(['Message' => $th->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function show(string $token)
    {
        $quotation = Quotation::where('token', $token)->with(['client', 'client.person', 'documents', 'typeCase', 'budget', 'budget.product'])->first();
        $currencies = $this->getCurrencies();
        return view('quotations.show', compact('quotation', 'currencies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SaveLawyerQuotationRequest $request, string $token)
    {
        try {
            $validatedData = $request->validated();
            dd($validatedData);
            $quotation = Quotation::where('token', $token)->with(['budget', 'budget.products', 'typeCase'])->first();

            $budgetData =  array_merge(array_diff_key($validatedData, ['type_case_id' => null, 'honorary1' => null, 'description_honorary_1' => null, 'price_honorary_1' => null]));
            // dd($budgetData);
            $budgetData['quotation_id'] = $quotation->id;

            if (!$quotation->budget) {
                $budget = new Budget;
                $budget->quotation_id = $quotation->id; // Agregar esta línea para asignar explícitamente el valor
                $budget  = $quotation->budget()->save($budget);
                $quotation->budget()->update($budgetData);

                $product = new Product;
                $product->budget_id = $budget->id;
                $product->name = $validatedData['honorary1'];
                $product->description = $validatedData['description_honorary_1'];
                $product->price = $validatedData['price_honorary_1'];
                $product->save();
            }
            // else {
            //     dd($budgetData);
            //     $budget = $quotation->budget->update($budgetData);
            //     $budget->product->update([
            //         'budget_id' => $budget->id,
            //         'name' => $validatedData['honorary1'],
            //         'description' => $validatedData['description_honorary_1'],
            //         'price' => $validatedData['price_honorary_1'],
            //     ]);

            // }
            $quotation->update($validatedData);

            return redirect()->route('lawyers.quotations.index')->with('success', 'Registro actualizado correctamente');
        } catch (\Throwable $th) {
            Log::error([
                'Message' => $th->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $lawyer = Quotation::where('id', $id)->first();
            $lawyer->delete();
            return redirect()->route('quotations.index')->with('success', 'Registro eliminado correctamente!');
        } catch (\Throwable $th) {
            Log::error('Error:', [
                'message' => $th->getMessage()
            ]);
        }
    }

    public function assignLawyer(Request $request)
    {
        try {
            $quotation = Quotation::find($request->input('quotationId'));

            if (!$request->input('lawyerId')) {
                return redirect()->back()->with('error', 'Obligatoriamente debes seleecionar un abogado!');
            }

            $lawyer = User::where('id', $request->input('lawyerId'))->with('person')->first();
            $quotation->lawyer_id = $lawyer->person->id;
            $quotation->save();
            return redirect()->route('quotations.show', $quotation->token)->with('success', 'Abogado asignado correctamente');
        } catch (\Throwable $th) {
            Log::error([
                'Message' => $th->getMessage()
            ]);
        }
    }

    public function updateQuotationByAdmin(SaveQuotationRequest $request, string $token)
    {
        try {
            $validatedData = $request->validated();
            // dd($validatedData);
            $validatedData['token'] = $this->getFakerToken();
            $quotation = Quotation::where('token', $token)->first();
            $quotation->update($validatedData);
            return redirect()->route('quotations.edit', $quotation->token)->with('success', 'Registro actualizado correctamente!');
        } catch (\Throwable $th) {
            Log::error([
                'Message' => $th->getMessage(),
                'data' => $validatedData,
            ]);
        }
    }
}
