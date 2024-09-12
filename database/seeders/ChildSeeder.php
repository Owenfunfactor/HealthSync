<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Child;
use Faker\Factory as Faker;

class ChildSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            Child::create([
                'nom' => $faker->name,
                'date_naissance' => $faker->date(),
                'departement' => $faker->state,
                'quartier' => $faker->streetName,
                'adresse' => $faker->address,
                'sexe' => $faker->randomElement(['masculin', 'féminin']),
                'profession' => $faker->jobTitle,
                'commune' => $faker->city,
                'phone' => $faker->numerify('##########'), // Générer un numéro de téléphone à 10 chiffres
                'nom_pere' => $faker->name('male'),
                'profession_pere' => $faker->jobTitle,
                'age_pere' => $faker->numberBetween(30, 60),
                'adresse_pere' => $faker->address,
                'tel_pere' => $faker->numerify('##########'), // Générer un numéro de téléphone à 10 chiffres
                'nom_mere' => $faker->name('female'),
                'profession_mere' => $faker->jobTitle,
                'age_mere' => $faker->numberBetween(30, 60),
                'adresse_mere' => $faker->address,
                'tel_mere' => $faker->numerify('##########'), // Générer un numéro de téléphone à 10 chiffres
            ]);
        }
    }
}
