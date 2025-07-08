<?php

namespace App\Http\Controllers;

use App\Models\Rendezvous;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class RendezvousController extends Controller
{
    // Récupérer tous les rendez-vous
    public function index()
    {
        try {
            $rendezvous = Rendezvous::with('patient')->get();
            return response()->json($rendezvous);
        } catch (\Exception $e) {
            Log::error('Erreur lors de la récupération des rendez-vous: ' . $e->getMessage());
            return response()->json(['message' => 'Erreur lors de la récupération des rendez-vous', 'error' => $e->getMessage()], 500);
        }
    }

    // Récupérer un rendez-vous spécifique
    public function show($id)
    {
        try {
            $rendezvous = Rendezvous::with('patient')->findOrFail($id);
            return response()->json($rendezvous);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Rendez-vous non trouvé'], 404);
        } catch (\Exception $e) {
            Log::error('Erreur lors de la récupération du rendez-vous: ' . $e->getMessage());
            return response()->json(['message' => 'Erreur lors de la récupération du rendez-vous', 'error' => $e->getMessage()], 500);
        }
    }

    // Créer un nouveau rendez-vous
    public function store(Request $request)
    {
        Log::info('Tentative de création de rendez-vous avec les données: ', $request->all());
        
        try {
            $validated = $request->validate([
                'patient_id' => 'required|exists:patients,id',
                'date_heure' => 'required|date',
                'motif' => 'nullable|string',
            ]);
            
            // Vérifier si le patient existe
            $patient = Patient::find($request->patient_id);
            if (!$patient) {
                return response()->json(['message' => 'Le patient spécifié n\'existe pas'], 422);
            }
            
            $rendezvous = Rendezvous::create($validated);
            
            Log::info('Rendez-vous créé avec succès. ID: ' . $rendezvous->id);
            
            // Récupérer le rendez-vous avec les relations pour le retourner
            $rendezvous = Rendezvous::with('patient')->find($rendezvous->id);
            
            return response()->json($rendezvous, 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::warning('Validation échouée lors de la création du rendez-vous: ' . json_encode($e->errors()));
            return response()->json(['message' => 'Données invalides', 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            Log::error('Erreur lors de la création du rendez-vous: ' . $e->getMessage());
            return response()->json(['message' => 'Erreur lors de la création du rendez-vous', 'error' => $e->getMessage()], 500);
        }
    }

    // Mettre à jour un rendez-vous
    public function update(Request $request, $id)
    {
        Log::info('Tentative de mise à jour du rendez-vous ID: ' . $id . ' avec les données: ', $request->all());
    
        try {
            // Validate the request data
            $validated = $request->validate([
                'patient_id' => 'sometimes|required|exists:patients,id',
                'date_heure' => 'sometimes|required|date',
                'motif' => 'nullable|string',
            ]);
    
            // Find the rendez-vous
            $rendezvous = Rendezvous::findOrFail($id);
    
            // Update the rendez-vous
            $rendezvous->update($validated);
    
            Log::info('Rendez-vous mis à jour avec succès. ID: ' . $rendezvous->id);
    
            // Return the updated rendez-vous with patient data
            $rendezvous = Rendezvous::with('patient')->find($id);
    
            return response()->json($rendezvous);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Rendez-vous non trouvé'], 404);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::warning('Validation échouée lors de la mise à jour du rendez-vous: ' . json_encode($e->errors()));
            return response()->json(['message' => 'Données invalides', 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            Log::error('Erreur lors de la mise à jour du rendez-vous: ' . $e->getMessage());
            return response()->json(['message' => 'Erreur lors de la mise à jour du rendez-vous', 'error' => $e->getMessage()], 500);
        }
    }
    // Supprimer un rendez-vous
    public function destroy($id)
    {
        Log::info('Tentative de suppression du rendez-vous ID: ' . $id);
        
        try {
            $rendezvous = Rendezvous::findOrFail($id);
            $rendezvous->delete();
            
            Log::info('Rendez-vous supprimé avec succès. ID: ' . $id);
            
            return response()->json(null, 204);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Rendez-vous non trouvé'], 404);
        } catch (\Exception $e) {
            Log::error('Erreur lors de la suppression du rendez-vous: ' . $e->getMessage());
            return response()->json(['message' => 'Erreur lors de la suppression du rendez-vous', 'error' => $e->getMessage()], 500);
        }
    }
    
    // Récupérer les rendez-vous d'un patient spécifique
    public function getByPatient($patient_id)
    {
        try {
            // Vérifier si le patient existe
            if (!Patient::find($patient_id)) {
                return response()->json(['message' => 'Patient non trouvé'], 404);
            }
            
            $rendezvous = Rendezvous::where('patient_id', $patient_id)
                                   ->with('patient')
                                   ->get();
                                   
            return response()->json($rendezvous);
        } catch (\Exception $e) {
            Log::error('Erreur lors de la récupération des rendez-vous du patient: ' . $e->getMessage());
            return response()->json(['message' => 'Erreur lors de la récupération des rendez-vous', 'error' => $e->getMessage()], 500);
        }
    }
}