<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveLawyersRequest;
use App\Models\Client;
use App\Models\Person;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LawyersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(User $users)
    {
        $data = User::where('type_user_id', 3)->with(['person'])->get();
        // dd($data);
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
                $user->assignRole('lawyer');
                $validatedData['token'] = $this->getFakerToken();
                $person = $user->person()->create($validatedData);
                $person->client()->create([
                    'person_id' => $person->id,
                    'user_type_id' => $validatedData['type_user_id'],
                    'token' => $this->getFakerToken()
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
    public function show(string $token)
    {
        try {
            $lawyer = Person::where('token', $token)->with(['user'])->first();
            return view('lawyers.show', compact('lawyer'));
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
    public function update(SaveLawyersRequest $request, Person $lawyer)
    {
        try {

            $faker = Faker::create();
            $validatedData = $request->validated();
            $validatedData['token'] = strval($faker->unique()->sha256());
            $lawyer->update($validatedData);
            $validatedData['token'] = strval($faker->unique()->sha256());

            if ($validatedData['password'] == null) {
                $validatedData['password'] = $lawyer->user->password;
            }

            $lawyer->user->update($validatedData);
            return redirect()->route('lawyers.index')->with('success', 'Registro actualizado correctamente!');
        } catch (\Throwable $th) {
            Log::error('Error:', ['message' => $th->getMessage()]);
            return redirect()->back()->with('error', 'Ocurrió un error al actualizar el registro.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $lawyer = User::where('id', $id)->with('person')->first();
            $lawyer->person()->delete();
            $lawyer->delete();
            return redirect()->route('lawyers.index')->with('success', 'Registro eliminado correctamente!');
        } catch (\Throwable $th) {
            Log::error('Error:', [
                'message' => $th->getMessage()
            ]);
        }
    }
}
