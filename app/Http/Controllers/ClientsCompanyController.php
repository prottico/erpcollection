<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveUsersForCompanyRequest;
use App\Http\Requests\UpdatePeopleRequest;
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
        return view('company.people.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('company.people.create');
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
            $person = $user->person()->create($validatedData);
            $person->client()->create($validatedData);

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
        try {
            $person = Person::where('token', $token)->first();
            return view('company.people.show', compact('person'));
        } catch (\Throwable $th) {
            Log::error([
                'Message' => $th->getMessage()
            ]);
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
    public function update(UpdatePeopleRequest $request, string $token)
    {
        try {
            $validatedData = $request->validated();
            $person = Person::where('token', $token)->first();

            if ($validatedData['password'] == null) {
                $validatedData['password'] = $person->user->password;
            }
            $person->user->update($validatedData);
            $person->update($validatedData);

            return redirect()->route('clients.company.users.index')->with('success', 'Registro actualizado correctamente');
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
}
