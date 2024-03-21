<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Person;
use Illuminate\Http\Request;
use App\Http\Requests\UpdatePeopleRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::with('person')->get();
        return view('users.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = 'Jeloueee';
        return view('users.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UpdatePeopleRequest $request)
    {
        try {
            $validateData =  $request->validated();
            $validateData['token'] = $this->getFakerToken();

            $user = User::create($validateData);
            $validateData['token'] = $this->getFakerToken();
            $validateData['user_id'] = $user->id;
            $person = Person::create($validateData);
            $user->person()->save($person);

            return redirect()->route('admin.users.index')->with('success', 'Registro creado correctamente');
        } catch (\Throwable $th) {
            \Illuminate\Support\Facades\Log::error([
                'Message' => $th->getMessage(),
                'Data' => $validateData
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $token)
    {
        $person = Person::where('token', $token)->with('user')->first();
        return view('users.show', compact('person'));
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
            $validateData =  $request->validated();
            $validateData['token'] = $this->getFakerToken();
            $person = Person::where('token', $token)->with('user')->first();
            $person->user->update($validateData);
            $person->update($validateData);
            return redirect()->route('admin.users.index')->with('success', 'Registro actualizado correctamente');
        } catch (\Throwable $th) {
            \Illuminate\Support\Facades\Log::error([
                'Message' => $th->getMessage(),
                'Data' => $validateData
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $person = Person::find($id);
            $person->user()->delete();
            $person->delete();
            return redirect()->route('admin.users.index')->with('success', 'Registro eliminado correctamente');
        } catch (\Throwable $th) {
            \Illuminate\Support\Facades\Log::error([
                'Message' => $th->getMessage()
            ]);
        }
    }
}
