<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * Fetch all patients.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Fetch all patients from the database
        $patients = Patient::all();
        return response()->json($patients);
    }

    /**
     * Fetch a single patient by ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Find the patient by ID or return a 404 error if not found
        $patient = Patient::findOrFail($id);
        return response()->json($patient);
    }

    /**
     * Create a new patient.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'date_naissance' => 'nullable|date',
            'telephone' => 'nullable|string',
            'email' => 'nullable|email',
            'adresse' => 'nullable|string',
            'antecedents_medicaux' => 'nullable|string',
            'hospitalise' => 'nullable|boolean',
        ]);

        // Create a new patient
        $patient = Patient::create($request->all());
        return response()->json($patient, 201); // 201: Resource created
    }

    /**
     * Update an existing patient.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'nom' => 'sometimes|string',
            'prenom' => 'sometimes|string',
            'date_naissance' => 'nullable|date',
            'telephone' => 'nullable|string',
            'email' => 'nullable|email',
            'adresse' => 'nullable|string',
            'antecedents_medicaux' => 'nullable|string',
            'hospitalise' => 'nullable|boolean',
        ]);

        // Find the patient by ID or return a 404 error if not found
        $patient = Patient::findOrFail($id);

        // Update the patient with the request data
        $patient->update($request->all());
        return response()->json($patient);
    }

    /**
     * Delete a patient.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Find the patient by ID or return a 404 error if not found
        $patient = Patient::findOrFail($id);

        // Delete the patient
        $patient->delete();
        return response()->json(null, 204); // 204: No content
    }
}