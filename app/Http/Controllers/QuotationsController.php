<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveQuotationRequest;
use App\Models\Quotation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
        return view('quotations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SaveQuotationRequest $request)
    {
        try {
            $validateData = $request->validated();
            $path = '';

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
            $quotation = Quotation::where('token', $token)->get();
            // dd($quotation);
            return view('quotations.show');
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
