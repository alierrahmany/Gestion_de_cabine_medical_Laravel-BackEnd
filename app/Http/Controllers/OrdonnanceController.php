<?php


namespace App\Http\Controllers;

use App\Models\Ordonnance;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrdonnanceController extends Controller
{
    // Récupérer toutes les ordonnances
    public function index()
    {
        $ordonnances = Ordonnance::with('patient')->get();
        return response()->json($ordonnances);
    }

    // Créer une nouvelle ordonnance
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'date' => 'required|date',
            'prescriptions' => 'required|array',
            'notes' => 'nullable|string',
        ]);

        $ordonnance = Ordonnance::create($validatedData);
        return response()->json($ordonnance, 201);
    }

    // Récupérer une ordonnance spécifique
    public function show($id)
    {
        $ordonnance = Ordonnance::with('patient')->find($id);
        if (!$ordonnance) {
            return response()->json(['message' => 'Ordonnance not found'], 404);
        }
        return response()->json($ordonnance);
    }

    // Mettre à jour une ordonnance
    public function update(Request $request, $id)
    {
        $ordonnance = Ordonnance::find($id);
        if (!$ordonnance) {
            return response()->json(['message' => 'Ordonnance not found'], 404);
        }

        $validatedData = $request->validate([
            'patient_id' => 'sometimes|exists:patients,id',
            'date' => 'sometimes|date',
            'prescriptions' => 'sometimes|array',
            'notes' => 'nullable|string',
        ]);

        $ordonnance->update($validatedData);
        return response()->json($ordonnance);
    }

    // Supprimer une ordonnance
    public function destroy($id)
    {
        $ordonnance = Ordonnance::find($id);
        if (!$ordonnance) {
            return response()->json(['message' => 'Ordonnance not found'], 404);
        }

        $ordonnance->delete();
        return response()->json(['message' => 'Ordonnance deleted successfully']);
    }

    // Récupérer les ordonnances d'un patient spécifique
    public function getByPatient($patient_id)
    {
        $ordonnances = Ordonnance::where('patient_id', $patient_id)->with('patient')->get();
        return response()->json($ordonnances);
    }
}
