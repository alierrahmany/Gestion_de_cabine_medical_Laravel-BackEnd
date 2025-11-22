<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        
        // Puis les autres seeders dans l'ordre logique
        $this->call(PatientsTableSeeder::class);
        $this->call(EquipmentsTableSeeder::class);
        $this->call(RendezVousTableSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(MaintenanceRequestsTableSeeder::class);
    }
}