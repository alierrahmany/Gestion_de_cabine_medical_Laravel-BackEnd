<?php

namespace Database\Seeders;

use App\Models\Patient;
use Illuminate\Database\Seeder;

class PatientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Patient::create([
            'nom' => 'Doe',
            'prenom' => 'John',
            'date_naissance' => '1990-01-01',
            'telephone' => '123456789',
            'email' => 'john.doe@example.com',
            'adresse' => '123 Main St',
            'antecedents_medicaux' => 'None',
            'hospitalise' => false,
        ]);

        // Add more patients as needed
    }
}