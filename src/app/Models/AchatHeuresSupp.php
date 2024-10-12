<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AchatHeuresSupp extends Pivot
{
    use HasFactory;

    protected $table = "achat_heures_supps";

    protected $fillable = [
        'candidat_id',
        'type_permis_id',
        'date_achat',
        'quantite'
    ];
}
