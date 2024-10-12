<?php

namespace App\Models;

use App\Enums\TypePermisEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TypePermis extends Model
{
    use HasFactory;

    protected $fillable = [
        "libelle",
        "prix_unitaire"
    ];
}
