<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    
    public function run(): void
    {
        DB::table('users')->delete();
       DB::table('users')->insert([
            [
                'name' => 'Medcin',
                'email' => 'medcin@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'medcin',
                'image' => 'no_image.jpg',
                'status' => 1,
                'heure_debut' => '08:00:00',
                'heure_fin' => '17:00:00',
                'last_login' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Infirmier',
                'email' => 'infirmier@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'infirmier',
                'image' => 'no_image.jpg',
                'status' => 1,
                'heure_debut' => '07:00:00',
                'heure_fin' => '15:00:00',
                'last_login' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Secretaire',
                'email' => 'secretaire@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'secretaire',
                'image' => 'no_image.jpg',
                'status' => 1,
                'heure_debut' => '09:00:00',
                'heure_fin' => '18:00:00',
                'last_login' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Administratif',
                'email' => 'administratif@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'administratif',
                'image' => 'no_image.jpg',
                'status' => 1,
                'heure_debut' => '08:30:00',
                'heure_fin' => '17:30:00',
                'last_login' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Technicien',
                'email' => 'technicien@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'technicien',
                'image' => 'no_image.jpg',
                'status' => 1,
                'heure_debut' => '06:00:00',
                'heure_fin' => '14:00:00',
                'last_login' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'salma',
                'email' => 'salmamaadour3@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'technicien',
                'image' => 'no_image.jpg',
                'status' => 1,
                'heure_debut' => '06:00:00',
                'heure_fin' => '14:00:00',
                'last_login' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}

