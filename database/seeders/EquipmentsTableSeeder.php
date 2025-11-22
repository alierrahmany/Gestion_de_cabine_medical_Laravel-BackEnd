<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EquipmentsTableSeeder extends Seeder
{
    public function run()
    {
        $equipments = [
            [
                'name' => 'Scanner IRM 3T',
                'type' => 'Scanner',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Échographe Doppler',
                'type' => 'Échographe',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Imprimante 3D Dentaire',
                'type' => 'Imprimante 3D',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Salle de Radiologie Numérique',
                'type' => 'Radiologie',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Analyseur Biochimique',
                'type' => 'Analyseur',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ];

        DB::table('equipments')->insert($equipments);
    }
}