<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoursCode extends Model
{
    use HasFactory;
    
    protected $table = "cours_code";

    protected $fillable = [
        'id',
        'dateCours',
        'heureDebut',
        'heureFin',
        'capacite'
    ];

}
