<?php
// app/Http/Controllers/MaintenanceRequestController.php
namespace App\Http\Controllers;

use App\Models\MaintenanceRequest;
use App\Models\Equipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MaintenanceRequestController extends Controller {
    // Récupérer toutes les demandes de maintenance
    public function index()
    {
        try {
            $requests = MaintenanceRequest::with('equipment')->get();
            return response()->json($requests);
        } catch (\Exception $e) {
            Log::error('Erreur lors de la récupération des demandes de maintenance: ' . $e->getMessage());
            return response()->json(['error' => 'Erreur lors de la récupération des demandes de maintenance'], 500);
        }
    }
    
    // Créer une nouvelle demande de maintenance
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'equipment_id' => 'required|exists:equipments,id',
                'description' => 'required|string',
                'status' => 'required|string|in:pending,completed',
            ]);
            
            $validated['request_date'] = now(); // Date actuelle
            $maintenanceRequest = MaintenanceRequest::create($validated);
            
            // Mettre à jour la date de dernière maintenance de l'équipement
            if ($validated['status'] === 'completed') {
                $equipment = Equipment::findOrFail($validated['equipment_id']);
                $equipment->update(['last_maintenance' => now()]);
            }
            
            return response()->json($maintenanceRequest, 201);
        } catch (\Exception $e) {
            Log::error('Erreur lors de la création d\'une demande de maintenance: ' . $e->getMessage());
            return response()->json(['error' => 'Erreur lors de la création d\'une demande de maintenance', 'details' => $e->getMessage()], 500);
        }
    }
    
    // Récupérer une demande de maintenance spécifique
    public function show($id)
    {
        try {
            $maintenanceRequest = MaintenanceRequest::with('equipment')->findOrFail($id);
            return response()->json($maintenanceRequest);
        } catch (\Exception $e) {
            Log::error('Demande de maintenance non trouvée: ' . $e->getMessage());
            return response()->json(['error' => 'Demande de maintenance non trouvée'], 404);
        }
    }
    
    // Mettre à jour une demande de maintenance
    public function update(Request $request, $id)
    {
        try {
            $maintenanceRequest = MaintenanceRequest::findOrFail($id);
            
            $validated = $request->validate([
               'equipment_id' => 'sometimes|exists:equipments,id', // Correction ici
            'description' => 'sometimes|string',
            'status' => 'sometimes|string|in:pending,completed',
            ]);
            
            $maintenanceRequest->update($validated);
            
            // Mettre à jour la date de dernière maintenance de l'équipement si le statut passe à completed
            if (isset($validated['status']) && $validated['status'] === 'completed') {
                $equipment = Equipment::findOrFail($maintenanceRequest->equipment_id);
                $equipment->update(['last_maintenance' => now()]);
            }
            
            return response()->json($maintenanceRequest);
        } catch (\Exception $e) {
            Log::error('Erreur lors de la mise à jour d\'une demande de maintenance: ' . $e->getMessage());
            return response()->json(['error' => 'Erreur lors de la mise à jour d\'une demande de maintenance'], 500);
        }
    }
    
    // Supprimer une demande de maintenance
    public function destroy($id)
    {
        try {
            $maintenanceRequest = MaintenanceRequest::findOrFail($id);
            $maintenanceRequest->delete();
            return response()->json(null, 204);
        } catch (\Exception $e) {
            Log::error('Erreur lors de la suppression d\'une demande de maintenance: ' . $e->getMessage());
            return response()->json(['error' => 'Erreur lors de la suppression d\'une demande de maintenance'], 500);
        }
    }
    
    // Marquer une demande de maintenance comme terminée
    public function complete($id)
    {
        try {
            $maintenanceRequest = MaintenanceRequest::findOrFail($id);
            $maintenanceRequest->update(['status' => 'completed']);
            
            // Mettre à jour la date de dernière maintenance de l'équipement
            $equipment = Equipment::findOrFail($maintenanceRequest->equipment_id);
            $equipment->update(['last_maintenance' => now()]);
            
            return response()->json($maintenanceRequest);
        } catch (\Exception $e) {
            Log::error('Erreur lors de la mise à jour du statut de la demande de maintenance: ' . $e->getMessage());
            return response()->json(['error' => 'Erreur lors de la mise à jour du statut de la demande de maintenance'], 500);
        }
    }
}