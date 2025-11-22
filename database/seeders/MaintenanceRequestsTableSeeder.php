<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MaintenanceRequestsTableSeeder extends Seeder
{
    public function run()
    {
        $equipments = DB::table('equipments')->take(3)->get();
        $users = DB::table('users')->take(2)->get();

        if ($equipments->count() === 0) {
            $this->command->info('Aucun équipement trouvé. Veuillez d\'abord exécuter le EquipmentsTableSeeder.');
            return;
        }

        $maintenanceRequests = [
            [
                'equipment_id' => $equipments[0]->id,
                'user_id' => $users[0]->id ?? null,
                'description' => 'Bruit anormal lors du fonctionnement',
                'status' => 'pending',
                'request_date' => Carbon::now()->subDays(2),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'equipment_id' => $equipments[1]->id,
                'user_id' => $users[1]->id ?? null,
                'description' => 'Calibration nécessaire',
                'status' => 'completed',
                'request_date' => Carbon::now()->subDays(5),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'equipment_id' => $equipments[2]->id,
                'user_id' => $users[0]->id ?? null,
                'description' => 'Problème de chauffage de la plateforme',
                'status' => 'pending',
                'request_date' => Carbon::now()->subDay(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ];

        DB::table('maintenance_requests')->insert($maintenanceRequests);
    }
}