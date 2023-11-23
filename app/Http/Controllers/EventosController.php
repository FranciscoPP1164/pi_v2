<?php

namespace App\Http\Controllers;

use App\Models\evento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EventosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("eventos.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $datosEvento = request()->except(['_token', '_method']);

        $validateDate = Validator::make($datosEvento, [
            'start' => 'after_or_equal:now',
        ]);

        if ($validateDate->fails()) {
            return 'is-menor';
        }

        // return $datosEvento['client'];

        // $client = Client::where('name', $datosEvento['client'])->first();
        // $nurse = Nurse::where('name', $datosEvento['nurse'])->first();
        // $patient = Patient::where('name', $datosEvento['patient'])->first();

        // if (!$client) {
        //     return 'nc';
        // }

        // $datosEvento['client_id'] = $client->id;

        // if (!$nurse) {
        //     return 'nn';
        // }

        // $datosEvento['nurse_id'] = $nurse->id;

        // if (!$patient) {
        //     return 'np';
        // }

        // $datosEvento['patient_id'] = $patient->id;

        // $eventThatMatchWithDate = evento::where('start', $request->start)->where('nurse_id', $nurse->id)->first();

        // if ($eventThatMatchWithDate) {
        //     return 'already-exists';
        // }

        // return $datosEvento['start'];
        evento::insert($datosEvento);
        print_r($datosEvento);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $data['eventos'] = evento::all();
        return response()->json($data['eventos']);

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
        $datosEventos = request()->except(['_token', '_method']);
        $respuesta = evento::where('id', '=', $id)->update($datosEventos);
        return response()->json($respuesta);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $eventos = evento::findOrFail($id);
        evento::destroy($id);
        return response()->json($id);
    }
}
