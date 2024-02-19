<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveIndependentClientRequest;
use App\Models\Client;
use App\Models\Person;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class IndependentClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Client $clients)
    {
        $data = $this->getClientsByType(2);
        return view('clients.independents.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('clients.independents.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SaveIndependentClientRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $validatedData['type_user_id'] = strval(2);

            if (User::where('email', $validatedData['email'])->exists()) {
                return redirect()->route('independent.client.create')
                    ->with('error', 'El correo electrónico ya está registrado. Por favor, utilice otro correo electrónico.');
                return;
            } else {
                $user = User::create($validatedData);
                $person = $user->person()->create($validatedData);
                $person->client()->create([
                    'person_id' => $person->id,
                    'client_type_id' => strval(2),
                    'user_type_id' => $validatedData['type_user_id'],
                ]);
                
                return redirect()->route('independent.client.index')->with('success', 'Registro creado correctamente');
            }
        } catch (\Throwable $th) {
            Log::error('Error creando registro de petición:', [
                'message' => $th->getMessage(),
                'data' => $validatedData,
            ]);

            return redirect()->route('independent.client.index')->with('error', 'Ocurrió un error al crear el registro. Por favor, inténtelo de nuevo.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
