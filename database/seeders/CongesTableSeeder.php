<?php



namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CongesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('conges')->insert([
            'user_id' => 1, // Remplacez par l'ID d'un utilisateur existant
            'date_debut' => '2023-10-01',
            'date_fin' => '2023-10-05',
            'type' => 'annuel',
            'statut' => 'accepté',
            'motif' => 'Vacances annuelles',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('conges')->insert([
            'user_id' => 2, // Remplacez par l'ID d'un autre utilisateur existant
            'date_debut' => '2023-11-15',
            'date_fin' => '2023-11-20',
            'type' => 'maladie',
            'statut' => 'en attente',
            'motif' => 'Grippe',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Ajoutez autant d'enregistrements que nécessaire
    }
}