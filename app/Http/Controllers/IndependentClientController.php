<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveIndependentClientRequest;
use App\Models\Client;
use App\Models\Person;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
        $identityTypes = $this->getIdentityTypes();
        return view('clients.independents.create', compact('identityTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SaveIndependentClientRequest $request)
    {
        $validatedData = $request->validated();
        $params = ['type_user' => 2, 'prevUrl' => 'independent.client.create', 'laterUrl' => 'independent.client.index'];
        return $this->storeDataClients($validatedData, $params);
    }

    /**
     * Display the specified resource.
     */
    public function show($token)
    {
        try {
            $identityTypes = $this->getIdentityTypes();
            $client = Client::where('token', $token)->with(['person', 'person.identityType'])->first();
            return view('clients.independents.show', compact('identityTypes', 'client'));
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
