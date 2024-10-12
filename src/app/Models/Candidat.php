<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Candidat extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'nom',
        'prenom',
        'adresse',
        'email',
        'telephone',
        'date_naissance'
    ];

    protected $casts = [
        'date_naissance' => 'date'
    ];

    public function getFullNameAttribute()
    {
        return $this->prenom . ' ' . $this->nom;
    }

    public function getFullNameAgeAttribute()
    {
        return $this->prenom . ' ' . $this->nom . ' (' . $this->age . ' ans)';
    }

    public function getAgeAttribute()
    {
        return Carbon::parse($this->date_naissance)->age;
    }

    public function achatHeuresSupplementaires()
    {
        return $this->hasMany(AchatHeuresSupp::class);
    }

    public function stockHeuresSupplementaires()
    {
        return $this->hasMany(StockHeuresSupp::class);
    }

    public function achatFormuleConduite()
    {
        return $this->hasMany(AchatFormuleConduite::class);
    }

    public function achatFormuleCode()
    {
        return $this->hasMany(AchatCode::class);
    }

    public function stockHeuresFormule()
    {
        return $this->hasMany(StockHeuresFormule::class);
    }

    public function codes()
    {
        return $this->belongsToMany(FormuleCode::class, 'achat_code', 'candidat_id', 'formule_code_id')->using(AchatCode::class);
    }
    public function conduites()
    {
        return $this->belongsToMany(FormuleConduite::class, 'achat_formule_conduite', 'candidat_id', 'formule_conduite_id');
    }

    public function lecons()
    {
        return $this->hasMany(Lecon::class);
    }
}
