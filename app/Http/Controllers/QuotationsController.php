<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveLawyerQuotationRequest;
use App\Http\Requests\SaveLawyersRequest;
use App\Http\Requests\SaveQuotationRequest;
use App\Models\Currency;
use App\Models\Quotation;
use App\Models\TypeCase;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use RuntimeException;

use function Laravel\Prompts\error;

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
        try {
            $validatedData = $request->validated();
            // $this->saveBaseExecutionDocumentIfExists($request);
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

    // private function saveBaseExecutionDocumentIfExists(SaveQuotationRequest $request): string|null
    // {

    //     //         if ($request->hasFile('base_execution_document')) {
    //     //             $path = $request->file('base_execution_document')->store('base_execution_documents', 'public');
    //     //             // foreach ($request->file('base_execution_document') as $file) {
    //     //             //     $file->store('public');
    //     //             // }
    //     //         }

    //     if (!$request->hasFile('base_execution_document')) {
    //         return null;
    //     }

    //     $path = $request->file('base_execution_document')->store('base_execution_documents', 'public');
    //     $validatedData['base_execution_document'] = $request->file('base_execution_document')->getClientOriginalName();
    //     $validatedData['path_base_execution_document'] = $path;

    //     // return $path;
    // }

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
    public function show(string $token)
    {
        try {
            $view = '';
            $quotation = Quotation::where('token', $token)->with(['client', 'client.person', 'documents', 'typeCase', 'budget'])->first();
            $lawyers = User::where('type_user_id', 3)->whereHas('person')->with(['person'])->get();
            $typeCases = TypeCase::all();
            $currency = Currency::find($quotation->currency_id);

            if (Auth::check()) {
                /** @var \App\Models\User $user */
                $user = Auth::user();
                if ($user->hasRole('lawyer')) {
                    $view = 'quotations.lawyers.show';
                } else {
                    $view = 'quotations.show';
                }
            };
            return view($view, compact('quotation', 'lawyers', 'typeCases', 'currency'));
        } catch (\Throwable $th) {
            Log::error(['Message' => $th->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SaveLawyerQuotationRequest $request, string $token)
    {
        try {
            $validatedData = $request->validated();
            $quotation = Quotation::where('token', $token)->with(['budget', 'budget.products'])->first();

            $budgetData =  array_merge(array_diff_key($validatedData, ['type_case_id' => null]));
            $budgetData['quotation_id'] = $quotation->id;

            if (!$quotation->budget) {
                $budget = $quotation->budget->create($budgetData);
                $budget->products->create([
                    'budget_id' => $quotation->budget->id,
                    'name' => $validatedData['honorary1'],
                    'description' => $validatedData['description_honorary_1'],
                    'price' => $validatedData['price_honorary_1'],
                ]);
            } else {
                $quotation->budget->fill($budgetData);
                $quotation->budget->save();
                $quotation->budget->products->update([
                    'budget_id' => $quotation->budget->id,
                    'name' => $validatedData['honorary1'],
                    'description' => $validatedData['description_honorary_1'],
                    'price' => $validatedData['price_honorary_1'],
                ]);
            }
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
        //
    }

    public function assignLawyer(Request $request)
    {
        try {
            $lawyer = User::where('id', $request->input('lawyerId'))->with('person')->first();
            $quotation = Quotation::find($request->input('quotationId'));
            $quotation->lawyer_id = $lawyer->person->id;
            $quotation->save();
            return redirect()->route('quotations.show', $quotation->token)->with('success', 'Abogado asignado correctamente');
        } catch (\Throwable $th) {
            Log::error([
                'Message' => $th->getMessage()
            ]);
        }
    }
}
