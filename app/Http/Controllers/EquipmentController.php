<?php
// app/Http/Controllers/EquipmentController.php
namespace App\Http\Controllers;

use App\Models\Equipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EquipmentController extends Controller {
    // Récupérer tous les équipements
    public function index()
    {
        try {
            $equipments = Equipment::all();
            return response()->json($equipments);
        } catch (\Exception $e) {
            Log::error('Erreur lors de la récupération des équipements: ' . $e->getMessage());
            return response()->json(['error' => 'Erreur lors de la récupération des équipements'], 500);
        }
    }
    // Créer un nouvel équipement
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'type' => 'required|string|max:255',
                'status' => 'required|string|in:actif,inactif,en maintenance',
                'last_maintenance' => 'required|date',
            ]);
            
            $equipment = Equipment::create($validated);
            return response()->json($equipment, 201);
        } catch (\Exception $e) {
            Log::error('Erreur lors de la création d\'un équipement: ' . $e->getMessage());
            return response()->json(['error' => 'Erreur lors de la création d\'un équipement'], 500);
        }
    }
    
    // Récupérer un équipement spécifique
    public function show($id)
    {
        try {
            $equipment = Equipment::findOrFail($id);
            return response()->json($equipment);
        } catch (\Exception $e) {
            Log::error('Équipement non trouvé: ' . $e->getMessage());
            return response()->json(['error' => 'Équipement non trouvé'], 404);
        }
    }
    
    // Mettre à jour un équipement
    public function update(Request $request, $id)
    {
        try {
            $equipment = Equipment::findOrFail($id);
            
            $validated = $request->validate([
                'name' => 'sometimes|string|max:255',
                'type' => 'sometimes|string|max:255',
                'status' => 'sometimes|string|in:actif,inactif,en maintenance',
                'last_maintenance' => 'sometimes|date',
            ]);
            
            $equipment->update($validated);
            return response()->json($equipment);
        } catch (\Exception $e) {
            Log::error('Erreur lors de la mise à jour d\'un équipement: ' . $e->getMessage());
            return response()->json(['error' => 'Erreur lors de la mise à jour d\'un équipement'], 500);
        }
    }
    
    // Supprimer un équipement
    public function destroy($id)
    {
        try {
            $equipment = Equipment::findOrFail($id);
            $equipment->delete();
            return response()->json(null, 204);
        } catch (\Exception $e) {
            Log::error('Erreur lors de la suppression d\'un équipement: ' . $e->getMessage());
            return response()->json(['error' => 'Erreur lors de la suppression d\'un équipement'], 500);
        }
    }
}