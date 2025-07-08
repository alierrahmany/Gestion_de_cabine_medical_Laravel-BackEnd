<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Rendezvous;
use App\Models\Conge;
use App\Models\Equipment;
use App\Models\User;

class StatistiqueController extends Controller
{
    public function getDashboardStats()
    {
        try {
            // Counts existants
            $totalPatients = Patient::count();
            $totalRendezvous = Rendezvous::count();
            $totalConges = Conge::count();
            $totalEquipments = Equipment::count();

            // Nouveaux counts des rôles
            $totalMedecins = User::where('role', 'medcin')->count();
            $totalInfirmiers = User::where('role', 'infirmier')->count();
            $totalTechniciens = User::where('role', 'technicien')->count();
            $totalSecretaires = User::where('role', 'secretaire')->count();

            return response()->json([
                'totalPatients' => $totalPatients,
                'totalRendezvous' => $totalRendezvous,
                'totalConges' => $totalConges,
                'totalEquipments' => $totalEquipments,
                'totalMedecins' => $totalMedecins,
                'totalInfirmiers' => $totalInfirmiers,
                'totalTechniciens' => $totalTechniciens,
                'totalSecretaires' => $totalSecretaires,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while fetching statistics.'], 500);
        }
    }
}