<?php

namespace App\Http\Controllers;

use App\Models\Nurse;
use Illuminate\Http\Request;

class NursesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $nurses = Nurse::all();
        return view("nurses.index", ['nurses' => $nurses]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("nurses.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $newNurse = $request->validate([
            'name' => 'required|string|bail',
            'gender' => 'required|in:male,female|bail',
        ]);

        Nurse::create($newNurse);

        return redirect()->route('nurses.index')->with('success');
    }

    /**
     * Display the specified resource.
     */
    public function show(Nurse $nurse)
    {
        return view('nurses.show', ['nurse' => $nurse]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Nurse $nurse)
    {
        return view('nurses.edit', ['nurse' => $nurse]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Nurse $nurse)
    {
        $nurseDataToUpdate = $request->validate([
            'name' => 'required|string|bail',
            'gender' => 'required|string|bail',
        ]);

        $isNurseUpdated = $nurse->update($nurseDataToUpdate);

        if ($isNurseUpdated) {
            return redirect()->route('nurses.index')->with('failed');
        }

        return redirect()->route('nurses.index')->with('success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Nurse $nurse)
    {
        $nurse->delete();

        return redirect()->route('nurses.index')->with('success');
    }
}
