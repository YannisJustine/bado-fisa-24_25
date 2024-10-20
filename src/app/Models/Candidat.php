<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Candidat extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'nom',
        'prenom',
        'adresse',
        'email',
        'telephone',
        'date_naissance',
        'password',
    ];
    protected $guard = 'candidat';
    
    protected $casts = [
        'date_naissance' => 'date'
    ];


    /**
     * Initials
     * @return string
     */
    public function getInitialsAttribute() {
        return mb_strtoupper(mb_substr($this->prenom, 0, 1, "UTF-8"), 'UTF-8').mb_strtoupper(mb_substr($this->nom, 0, 1, "UTF-8"), 'UTF-8');
    }

    public function getFullNameAttribute()
    {
        return ucfirst($this->prenom) . ' ' . ucfirst($this->nom);
    }

    public function nom() : Attribute
    {
        return Attribute::make(
            get: fn(string $value) => ucfirst($value)
        );
    }

    public function prenom() : Attribute
    {
        return Attribute::make(
            get: fn(string $value) => ucfirst($value)
        );
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
