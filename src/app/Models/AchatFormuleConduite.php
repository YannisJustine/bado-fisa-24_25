<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class AchatFormuleConduite extends Pivot
{
    use HasFactory;

    protected $table = "achat_formule_conduite";

    protected $fillable = [
        'candidat_id',
        'formule_conduite_id',
        'date_achat'
    ];
}
