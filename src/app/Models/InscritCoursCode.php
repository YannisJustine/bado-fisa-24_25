<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class InscritCoursCode extends Pivot
{
    use HasFactory;

    protected $table = "inscrit_cours_code";
}
