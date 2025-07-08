<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Equipment;
use Illuminate\Support\Facades\DB;

class EquipmentSeeder extends Seeder
{
    /**
     * Exécute le seeder.
     */
    public function run()
    {
        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
    
        // Truncate the table
        DB::table('equipments')->truncate();
    
        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    
        // Insert new data
        Equipment::insert([
            [
                'name' => 'Scanner IRM',
                'type' => 'Scanner Médical',
                'status' => 'actif',
                'last_maintenance' => '2024-02-10',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Imprimante 3D',
                'type' => 'Impression Médicale',
                'status' => 'en maintenance',
                'last_maintenance' => '2024-03-05',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Défibrillateur',
                'type' => 'Équipement d\'urgence',
                'status' => 'actif',
                'last_maintenance' => '2024-01-20',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}