<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;


class Consultation_pediatrie extends Model
{
    use HasFactory;

    protected $fillable = [
        'motif',
        'suivie_grossesse',
        'motif_non_suivie_grossesse',
        'type_accouchement',
        'dure_naissance',
        'reanimation_neonatale',
        'infection_neonatal',
        'traitement_medical_infection',
        'ictere_neonatal',
        'transfusion',
        'nb_transfusion',
        'autre_info',
        'vaccination_ajour',
        'autre_antecedant',
        'antecedant_chirurgicaux',
        'temperature',
        'poids',
        'taille',
        'frequence_cardiaque',
        'pouls',
        'frequence_respiratoire',
        'etat_general',
        'autre_etat',
        'mucqueuse',
        'aute_info',
        'signe_physique',
        'bilan_biologique',
        'bilan_radiologique',
        'suspission_diagnostic',
        'resultat_biologie',
        'resultat_img_radiologie',
        'diagnostic',
        'traitement',
        'evolution',
        'pronostic',
        'diagnostic_sortie',
        'type_sortie',
        'date_sortie',
        'child_id',
        'user_id'
    ];

    public function child(): BelongsTo
    {
        return $this->belongsTo(Child::class);
    }
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function suivie(): HasOne
    {
        return $this->hasOne(Suivie::class);
    }

}
