<?php

namespace App\Http\Controllers;

use App\Models\Ordonnance;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class OrdonnanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $ordonnances = Ordonnance::with('patient')
                ->orderBy('created_at', 'desc')
                ->get();
            
            return response()->json([
                'success' => true,
                'data' => $ordonnances
            ]);
        } catch (\Exception $e) {
            Log::error('Error fetching ordonnances: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la récupération des ordonnances'
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'patient_id' => 'required|exists:patients,id',
            'date' => 'required|date',
            'prescriptions' => 'required|array|min:1',
            'prescriptions.*.nom' => 'required|string|max:255',
            'prescriptions.*.dosage' => 'required|string|max:255',
            'prescriptions.*.frequence' => 'nullable|string|max:255',
            'prescriptions.*.duree' => 'nullable|string|max:255',
            'notes' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $ordonnance = Ordonnance::create($request->all());
            
            $ordonnance->load('patient');
            
            Log::info('Ordonnance created successfully', ['id' => $ordonnance->id]);
            
            return response()->json([
                'success' => true,
                'message' => 'Ordonnance créée avec succès',
                'data' => $ordonnance
            ], 201);
        } catch (\Exception $e) {
            Log::error('Error creating ordonnance: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la création de l\'ordonnance'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $ordonnance = Ordonnance::with('patient')->find($id);
            
            if (!$ordonnance) {
                return response()->json([
                    'success' => false,
                    'message' => 'Ordonnance non trouvée'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => $ordonnance
            ]);
        } catch (\Exception $e) {
            Log::error('Error fetching ordonnance: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la récupération de l\'ordonnance'
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $ordonnance = Ordonnance::find($id);
        
        if (!$ordonnance) {
            return response()->json([
                'success' => false,
                'message' => 'Ordonnance non trouvée'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'patient_id' => 'sometimes|exists:patients,id',
            'date' => 'sometimes|date',
            'prescriptions' => 'sometimes|array|min:1',
            'prescriptions.*.nom' => 'required_with:prescriptions|string|max:255',
            'prescriptions.*.dosage' => 'required_with:prescriptions|string|max:255',
            'prescriptions.*.frequence' => 'nullable|string|max:255',
            'prescriptions.*.duree' => 'nullable|string|max:255',
            'notes' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $ordonnance->update($request->all());
            $ordonnance->load('patient');
            
            Log::info('Ordonnance updated successfully', ['id' => $ordonnance->id]);
            
            return response()->json([
                'success' => true,
                'message' => 'Ordonnance modifiée avec succès',
                'data' => $ordonnance
            ]);
        } catch (\Exception $e) {
            Log::error('Error updating ordonnance: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la modification de l\'ordonnance'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $ordonnance = Ordonnance::find($id);
        
        if (!$ordonnance) {
            return response()->json([
                'success' => false,
                'message' => 'Ordonnance non trouvée'
            ], 404);
        }

        try {
            $ordonnance->delete();
            
            Log::info('Ordonnance deleted successfully', ['id' => $id]);
            
            return response()->json([
                'success' => true,
                'message' => 'Ordonnance supprimée avec succès'
            ]);
        } catch (\Exception $e) {
            Log::error('Error deleting ordonnance: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la suppression de l\'ordonnance'
            ], 500);
        }
    }

    /**
     * Get ordonnances by patient.
     */
    public function getByPatient($patient_id)
    {
        try {
            $ordonnances = Ordonnance::where('patient_id', $patient_id)
                ->with('patient')
                ->orderBy('created_at', 'desc')
                ->get();

            return response()->json([
                'success' => true,
                'data' => $ordonnances
            ]);
        } catch (\Exception $e) {
            Log::error('Error fetching patient ordonnances: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la récupération des ordonnances du patient'
            ], 500);
        }
    }
}