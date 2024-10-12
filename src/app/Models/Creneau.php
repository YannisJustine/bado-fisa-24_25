<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Creneau extends Model
{
    use HasFactory;

    protected $table = 'creneaux';
    protected $fillable = [
        'jour_semaine',
        'heure_debut',
        'heure_fin',
    ];

    public function formateurs()
    {
        return $this->belongsToMany(User::class, 'horaires_formateur', 'creneau_id', 'user_id');
    }
}
