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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
    public function store(SaveQuotationRequest $request)
    {
        try {
            $validateData = $request->validated();
            $path = '';
            $count = Quotation::count() + 1;

            if ($request->hasFile('base_execution_document')) {
                $path = $request->file('base_execution_document')->store('base_execution_documents', 'public');
                // foreach ($request->file('base_execution_document') as $file) {
                //     $file->store('public');
                // }
            }

            $validateData['base_execution_document'] = $request->file('base_execution_document')->getClientOriginalName();
            $validateData['path_base_execution_document'] = $path;
            $validateData['client_id'] = strval($request->user()->person->client->id);
            $validateData['credit_start_date'] = Carbon::parse($request->input('credit_start_date'));
            $validateData['last_payment_day'] = Carbon::parse($request->input('last_payment_day'));
            $validateData['token'] = $this->getFakerToken();
            $validateData['code'] = 'C-' . str_pad($count, 9, '0', STR_PAD_LEFT);
            Quotation::create($validateData);

            if (Auth::check()) {
                /** @var \App\Models\User $user */
                $user = Auth::user();
                if ($user->hasRole('independent-client')) {
                    return redirect()->route('clients.quotations.index')->with('success', 'Cotización registrada correctamente!');
                } else {
                    return redirect()->route('quotations.index')->with('success', 'Cotización registrada correctamente!');
                }
            }
        } catch (\Throwable $th) {
            Log::error(['Message' => $th->getMessage()]);
            return redirect()->route('quotations.index')->with('error', '¡Ha ocurrido un error inesperado!');
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $token)
    {
        try {
            $view = '';
            $quotation = Quotation::where('token', $token)->with(['client', 'client.person', 'documents', 'typeCase'])->first();
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
            $quotation = Quotation::where('token', $token)->first();
            $quotation->update($request->validated());
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
