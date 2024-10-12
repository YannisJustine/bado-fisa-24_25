<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class HoraireFormateur extends Pivot
{
    use HasFactory;

    protected $table = "horaires_formateur";
    
    protected $fillable = [
        "user_id",
        "creneau_id"
    ];

    public function creneaux()
    {
        return $this->belongsTo(Creneau::class);
    }
}
