<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveCompanyClientRequest;
use App\Models\Client;
use Illuminate\Http\Request;

class CompanyClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Client $clients)
    {
        $data = $this->getClientsByType(1);
        return view('clients.company.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $physicalClient = $this->physicalClient;
        return view('clients.company.create', compact('physicalClient'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SaveCompanyClientRequest $request)
    {
        $validatedData = $request->validated();
        $params = ['type_user' => 1, 'prevUrl' => 'company.client.create', 'laterUrl' => 'company.client.index'];
        return $this->storeDataClients($validatedData, $params);
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
