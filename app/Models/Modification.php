<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Modification extends Model
{
    use SoftDeletes;

    use HasFactory;
    protected $fillable = [
        'motif',
        'consultation_pediatrie_id',
        'medecin_id',
        'infirmier_id',
        'suivie_id',
        'status'
    ];

    public function medecin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'medecin_id');
    }

    public function infirmier(): BelongsTo
    {
        return $this->belongsTo(User::class, 'infirmier_id');
    }

    public function consultation(): BelongsTo
    {
        return $this->belongsTo(Consultation_pediatrie::class);
    }
    public function suivie(): BelongsTo
    {
        return $this->belongsTo(Suivie::class);
    }

}
