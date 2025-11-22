<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PatientsTableSeeder extends Seeder
{
    public function run()
    {
        $patients = [
            [
                'nom' => 'Martin',
                'prenom' => 'Sophie',
                'date_naissance' => '1985-03-15',
                'telephone' => '0123456789',
                'email' => 'sophie.martin@email.com',
                'adresse' => '123 Avenue des Champs, Paris 75008',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nom' => 'Dubois',
                'prenom' => 'Pierre',
                'date_naissance' => '1978-11-22',
                'telephone' => '0234567891',
                'email' => 'pierre.dubois@email.com',
                'adresse' => '45 Rue de la République, Lyon 69001',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nom' => 'Moreau',
                'prenom' => 'Marie',
                'date_naissance' => '1990-07-08',
                'telephone' => '0345678912',
                'email' => 'marie.moreau@email.com',
                'adresse' => '78 Boulevard Saint-Germain, Marseille 13001',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nom' => 'Lefebvre',
                'prenom' => 'Jean',
                'date_naissance' => '1982-12-30',
                'telephone' => '0456789123',
                'email' => 'jean.lefebvre@email.com',
                'adresse' => '56 Rue du Faubourg, Toulouse 31000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nom' => 'Garcia',
                'prenom' => 'Isabelle',
                'date_naissance' => '1975-05-18',
                'telephone' => '0567891234',
                'email' => 'isabelle.garcia@email.com',
                'adresse' => '32 Avenue de la Liberté, Lille 59000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ];

        DB::table('patients')->insert($patients);
    }
}