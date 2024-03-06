<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveUsersForCompanyRequest;
use App\Models\Person;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ClientsCompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $companyId = $request->user()->person->id;
        $data = Person::where('company_id', $companyId)->whereNotIn('id', [$companyId])->get();
        return view('company.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('company.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SaveUsersForCompanyRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $user = User::create($validatedData);
            $user->assignRole('employee');

            $validatedData['token'] = $this->getFakerToken();
            $validatedData['company_id'] = $request->user()->person->id;
            $user->person()->create($validatedData);
            return redirect()->route('clients.company.users.index')->with('success', 'Registro creado correctamente');

        } catch (\Throwable $th) {
            Log::error([
                'Message' => $th->getMessage(),
                'data' => $validatedData
            ]);
            return redirect()->route('clients.company.users.index')->with('error', 'Algo malo ha ocurrido, intentalo nuevamente!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $token)
    {

        return $token;
        // return Person::where('token', $token)->first();
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
