<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $patients = Patient::all();
        return view('patients.index', ['patients' => $patients]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('patients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $newPatient = $request->validate([
            'name' => 'required|string|bail',
            'age' => 'required|integer|bail',
            'identity_document' => 'required|numeric|bail',
            'direction' => 'required|string|bail',
        ]);

        Patient::create($newPatient);

        return redirect()->route('patients.index')->with('success');
    }

    /**
     * Display the specified resource.
     */
    public function show(Patient $patient)
    {
        return view('patients.show', ['patient' => $patient]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Patient $patient)
    {
        return view('patients.edit', ['patient' => $patient]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Patient $patient)
    {
        $patientDataToUpdate = $request->validate([
            'name' => 'required|string|bail',
            'age' => 'required|integer|bail',
            'identity_document' => 'required|numeric|bail',
            'direction' => 'required|string|bail',
        ]);

        $isPatientUpdated = $patient->update($patientDataToUpdate);

        if ($isPatientUpdated) {
            return redirect()->route('patients.index')->with('failed');
        }

        return redirect()->route('patients.index')->with('success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Patient $patient)
    {
        $patient->update(['status' => 'inactive']);

        return redirect()->route('patients.index')->with('success');
    }
}
