<?php

namespace App\Http\Controllers;

use App\Models\Conge;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CongeController extends Controller
{
    // Récupérer tous les congés avec les utilisateurs
    public function index()
    {
        $conges = Conge::with('user')->get();
        return response()->json($conges);
    }

    // Créer un nouveau congé
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'type' => ['required', Rule::in(['annuel', 'maladie', 'maternité', 'exceptionnel'])],
            'motif' => 'nullable|string',
            'statut' => ['sometimes', Rule::in(['en attente', 'accepté', 'refusé'])]
            ] );

        $conge = Conge::create([
            'user_id' => $request->user_id,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
            'type' => $request->type,
            'motif' => $request->motif,
            'statut' => $request->statut ?? 'en attente',
        ]);

        return response()->json($conge, 201);
    }

    // Mettre à jour un congé
    public function update(Request $request, Conge $conge)
    {
        $request->validate([
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'type' => ['required', Rule::in(['annuel', 'maladie', 'maternité', 'exceptionnel'])],
            'motif' => 'nullable|string',
            'statut' => ['required', Rule::in(['en attente', 'accepté', 'refusé'])]
        ]);

        $conge->update($request->all());
        return response()->json($conge);
    }

    // Supprimer un congé
    public function destroy(Conge $conge)
    {
        $conge->delete();
        return response()->json(null, 204);
    }

    // Approuver un congé
    public function approve(Conge $conge)
    {
        $conge->update(['statut' => 'accepté']);
        return response()->json($conge->fresh()->load('user'));
    }
    
    // Rejeter un congé
    public function reject(Conge $conge)
    {
        $conge->update(['statut' => 'refusé']);
        return response()->json($conge->fresh()->load('user'));
    }
}