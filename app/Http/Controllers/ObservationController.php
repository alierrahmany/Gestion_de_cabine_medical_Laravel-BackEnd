<?php

namespace App\Http\Controllers;

use App\Models\Observation;
use Illuminate\Http\Request;

class ObservationController extends Controller
{
    public function index()
    {
        $observations = Observation::all();
        return response()->json($observations);
    }

    public function store(Request $request)
    {
        $request->validate([
            'text' => 'required|string',
            'patient_id' => 'required|exists:patients,id',
        ]);

        $observation = Observation::create($request->all());
        return response()->json($observation, 201);
    }

    public function show($id)
    {
        $observation = Observation::findOrFail($id);
        return response()->json($observation);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'text' => 'sometimes|string',
        ]);

        $observation = Observation::findOrFail($id);
        $observation->update($request->all());
        return response()->json($observation);
    }

    public function destroy($id)
    {
        $observation = Observation::findOrFail($id);
        $observation->delete();
        return response()->json(null, 204);
    }

    public function getByPatient($patient_id)
    {
        $observations = Observation::where('patient_id', $patient_id)->get();
        return response()->json($observations);
    }
}
