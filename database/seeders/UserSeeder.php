<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'type_compte' => 'admin',
            'departement' => 'Pédiatrie',
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
            'type_compte' => 'Traitant',
            'departement' => 'Pédiatrie',
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);
        User::create([
            'name' => 'Khamala HARIS',
            'email' => 'danyannick@gmail.com',
            'type_compte' => 'infirmier',
            'departement' => null,
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);

        // Ajoutez d'autres utilisateurs si nécessaire
    }
}
