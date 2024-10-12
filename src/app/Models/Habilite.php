<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Habilite extends Pivot
{
    protected $table = 'habilite';

    protected $fillable = [
        'user_id',
        'type_permis_id'
    ];
}
