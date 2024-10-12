<?php 

namespace App\Models;

use App\Enums\StatutEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Statut extends Model
{
    use HasFactory;

    protected $casts = [
        'id' => StatutEnum::class
    ];

    protected $fillable = [
        'id',
        'statut'
    ];
}
