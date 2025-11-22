<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RendezVousTableSeeder extends Seeder
{
    public function run()
    {
        $patients = DB::table('patients')->take(5)->get();

        if ($patients->count() === 0) {
            $this->command->info('Aucun patient trouvé. Veuillez d\'abord exécuter le PatientsTableSeeder.');
            return;
        }

        $rendezvous = [
            [
                'patient_id' => $patients[0]->id,
                'date_heure' => '2024-06-15 09:00:00',
                'motif' => 'Consultation générale',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'patient_id' => $patients[1]->id,
                'date_heure' => '2024-06-15 10:30:00',
                'motif' => 'Suivi traitement',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'patient_id' => $patients[2]->id,
                'date_heure' => '2024-06-16 14:00:00',
                'motif' => 'Examen annuel',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'patient_id' => $patients[3]->id,
                'date_heure' => '2024-06-17 11:00:00',
                'motif' => 'Douleurs articulaires',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'patient_id' => $patients[4]->id,
                'date_heure' => '2024-06-18 16:30:00',
                'motif' => 'Consultation urgente',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ];

        DB::table('rendezvous')->insert($rendezvous);
    }
}