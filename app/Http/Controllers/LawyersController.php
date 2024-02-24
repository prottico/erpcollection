<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveLawyersRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LawyersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(User $users)
    {
        $data = User::where('type_user_id', 3)->whereHas('person')->with('person')->get();
        return view('lawyers.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('lawyers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SaveLawyersRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $validatedData['type_user_id'] = strval(3);

            if (User::where('email', $validatedData['email'])->exists()) {
                return redirect()->route('lawyers.create')
                    ->with('error', 'El correo electrónico ya está registrado. Por favor, utilice otro correo electrónico.');
            } else {

                $user = User::create($validatedData);
                $person = $user->person()->create($validatedData);
                $person->client()->create([
                    'person_id' => $person->id,
                    'client_type_id' => strval(2),
                    'user_type_id' => $validatedData['type_user_id'],
                ]);

                return redirect()->route('lawyers.index')->with('success', 'Registro creado correctamente');
            }
        } catch (\Throwable $th) {
            Log::error('Error creando registro de petición:', [
                'message' => $th->getMessage(),
                'data' => $validatedData,
            ]);

            return redirect()->route('lawyers.index')->with('error', 'Ocurrió un error al crear el registro. Por favor, inténtelo de nuevo.');
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
