<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Child extends Model
{
    use HasFactory;

    protected $fillable = [
        'num_dossier',
        'date_consultation',
        'nom_medecin',
        'nom',
        'age',
        'departement',
        'quartier',
        'adresse',
        'sexe',
        'profession',
        'commune',
        'phone',
        'nom_pere',
        'profession_pere',
        'age_pere',
        'adresse_pere',
        'tel_pere',
        'nom_mere',
        'profession_mere',
        'age_mere',
        'adresse_mere',
        'tel_mere'
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function consultation_pediatries(): HasMany
    {
        return $this->hasMany(Consultation_pediatrie::class);
    }

}
