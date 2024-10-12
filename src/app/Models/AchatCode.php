<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AchatCode extends Pivot
{
    use HasFactory;

    protected $table = "achat_code";
    protected $fillable = [
        "candidat_id",
        "formule_code_id",
        "date_achat",
        'date_debut',
        'date_fin'
    ];

    protected $casts = [
        'date_achat' => 'datetime',
        'date_debut' => 'datetime',
        'date_fin' => 'datetime',
    ];

}
