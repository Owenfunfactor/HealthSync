<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('children', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->date('date_naissance');
            $table->string('departement');
            $table->string('quartier');
            $table->string('adresse');
            $table->string('sexe');
            $table->string('profession');
            $table->string('commune');
            $table->string('phone', 20); // Changer en string
            $table->string('nom_pere');
            $table->string('profession_pere');
            $table->integer('age_pere');
            $table->string('adresse_pere');
            $table->string('tel_pere', 20); // Changer en string
            $table->string('nom_mere');
            $table->string('profession_mere');
            $table->integer('age_mere');
            $table->string('adresse_mere');
            $table->string('tel_mere', 20); // Changer en string
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('children');
    }
};
