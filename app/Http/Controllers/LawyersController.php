<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
    public function store(Request $request)
    {
        //
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
