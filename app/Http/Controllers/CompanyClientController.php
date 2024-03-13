<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Client;
use App\Models\Person;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\SaveCompanyClientRequest;
use App\Http\Requests\UpdateCompanyRequest;

class CompanyClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Client $clients)
    {
        // $data = $this->getClientsByType(1);
        $data = Company::all();
        // dd($data);
        return view('clients.company.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $identityTypes = $this->getIdentityTypes();
        return view('clients.company.create', compact('identityTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SaveCompanyClientRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $validatedData['token'] = $this->getFakerToken();
            $company = Company::create($validatedData);

            $user = User::create([
                'name' => $validatedData['responsible_name'],
                'email' => $validatedData['responsible_email'],
                'password' => $validatedData['responsible_password'],
                'type_user_id' => 1
            ]);

            $user->assignRole('company-client');

            $person = $user->person()->create([
                'name' => $validatedData['responsible_name'],
                'lastname' => $validatedData['responsible_lastname'],
                'email' => $validatedData['responsible_email'],
                'responsible' => true,
                'company_id' => $company->id
            ]);

            $person->client()->create([
                'person_id' => $person->id,
                'client_type_id' => 1,
                'user_type_id' =>  1,
                'token' => $this->getFakerToken()
            ]);

            return redirect()->route('company.client.index')->with('success', 'Registro creado correctamente');
        } catch (\Throwable $th) {
            Log::error([
                'Message' => $th->getMessage(),
                'data' => $validatedData
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $token)
    {
        try {
            $identityTypes = $this->getIdentityTypes();
            $client = Company::where('token', $token)->with(['person'])->first();
            $responsible = Person::where('company_id', $client->id)->first();
            return view('clients.company.show', compact('identityTypes', 'client', 'responsible'));
        } catch (\Throwable $th) {
            Log::error('Error:', [
                'message' => $th->getMessage()
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
    public function update(UpdateCompanyRequest $request, Company $client)
    {
        try {
            $validatedData = $request->validated();
            $personId = $client->person->first();        //
            $person = Person::find($personId->id);
            $client->update($validatedData);

            if ($validatedData['responsible_password'] == null) {
                $person->user->update([
                    'name' => $validatedData['responsible_name'],
                    'email' => $validatedData['responsible_email'],
                    'password' => $person->user->password
                ]);
            } else {
                $person->user->update([
                    'name' => $validatedData['responsible_name'],
                    'email' => $validatedData['responsible_email'],
                    'password' => $validatedData['responsible_password']
                ]);
            }

            $person->update([
                'name' => $validatedData['responsible_name'],
                'lastaname' => $validatedData['responsible_lastname'],
                'email' => $validatedData['responsible_email'],
                'token' => $this->getFakerToken(),
                'responsible' => true,
            ]);

            return redirect()->route('company.client.index')->with('success', 'Registro actualizado correctamente');
            // toastr()->success('Data has been saved successfully!', 'Congrats', ['timeOut' => 5000]);

        } catch (\Throwable $th) {
            Log::error([
                'Message' => $th->getMessage(),
                'Data' => $validatedData
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // Obtenemos el cliente
            $client = Company::findOrFail($id);

            // Iteramos sobre la lista de personas asociadas al cliente
            foreach ($client->person as $person) {
                // Borramos el recurso asociado a la persona
                $person->user->first()->delete();
                $person->delete();
            }

            // Finalmente borramos el recurso Company
            $client->delete();

            return redirect()->route('company.client.index')->with('success', 'Registro eliminado correctamente!');
        } catch (\Exception $exception) {
            Log::error('Error:', [
                'message' => $exception->getMessage()
            ]);

            return back()->withErrors(['message' => __('messages.internal_server_error')])->withInput();
        }
    }
}
