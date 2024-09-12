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
        Schema::create('consultation_pediatries', function (Blueprint $table) {
            $table->id();
            $table->longText('motif');
            $table->string('antecedant_medicaux');
            $table->string('suivie_grossesse');
            $table->string('motif_non_suivie_grossesse')->nullable();
            $table->integer('dure_naissance');
            $table->string('type_accouchement');
            $table->string('reanimation_neonatale');
            $table->string('infection_neonatal');
            $table->string('traitement_medical_infection')->nullable();
            $table->string('ictere_neonatal');
            $table->string('transfusion');
            $table->string('nb_transfusion')->nullable();
            $table->string('autre_info')->nullable();
            $table->string('vaccination_ajour');
            $table->string('autre_antecedant')->nullable();
            $table->string('antecedant_chirurgicaux');
            $table->double('temperature');
            $table->double('poids');
            $table->integer('taille');
            $table->integer('frequence_cardiaque');
            $table->integer('pouls');
            $table->integer('frequence_respiratoire');
            $table->string('etat_general');
            $table->string('autre_etat')->nullable();
            $table->string('mucqueuse');
            $table->string('aute_info')->nullable();
            $table->string('signe_physique');
            $table->string('bilan_biologique');
            $table->string('bilan_radiologique');
            $table->string('suspission_diagnostic');
            $table->string('resultat_biologie');
            $table->string('resultat_img_radiologie');
            $table->string('diagnostic');
            $table->longText('traitement');
            $table->longText('prescription');
            $table->string('evolution');
            $table->string('pronostic');
            $table->string('diagnostic_sortie');
            $table->string('type_sortie');
            $table->date('date_sortie');
            $table->foreignId('child_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultation_pediatries');
    }
};
