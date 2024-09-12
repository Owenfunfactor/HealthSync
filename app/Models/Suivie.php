<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Suivie extends Model
{
    use HasFactory;

    public $fillable = [
        'nom',
        'observation',
        'follow_up'
    ];


    public function consultation_pediatrie(): BelongsTo
    {
        return $this->belongsTo(Consultation_pediatrie::class);
    }

    public function demandeModif(): HasOne 
    {
        return $this->hasOne(Modification::class);
    }
}




