<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::all();
        return view('clients.index', ['clients' => $clients]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $newClient = $request->validate([
            'name' => 'required|string|bail',
            'phone' => 'required|numeric|bail',
            'identity_document' => 'required|numeric|bail',
        ]);

        Client::create($newClient);

        return redirect()->route('clients.index')->with('success');
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        return view('clients.show', ['client' => $client]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        return view('clients.edit', ['client' => $client]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        $clientDataToUpdate = $request->validate([
            'name' => 'required|string|bail',
            'phone' => 'required|numeric|bail',
            'identity_document' => 'required|numeric|bail',
        ]);

        $isClientUpdated = $client->update($clientDataToUpdate);

        if ($isClientUpdated) {
            return redirect()->route('clients.index')->with('failed');
        }

        return redirect()->route('clients.index')->with('success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        // $client->update(['status' => 'inactive']);

        $client->delete();

        return redirect()->route('clients.index')->with('success');
    }
}
