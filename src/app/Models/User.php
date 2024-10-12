<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Log;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nom',
        'prenom',
        'num_securite_sociale',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Username
     * @return string
     */
    public function getFullNameAttribute() {
        return $this->prenom.' '.strtoupper($this->nom);
    }

    /**
     * Initials
     * @return string
     */
    public function getInitialsAttribute() {
        return mb_strtoupper(mb_substr($this->prenom, 0, 1, "UTF-8"), 'UTF-8').mb_strtoupper(mb_substr($this->nom, 0, 1, "UTF-8"), 'UTF-8');
    }

    public function creneaux()
    {
        return $this->belongsToMany(Creneau::class, 'horaires_formateur', 'user_id', 'creneau_id')->withTimestamps();
    }

    public function typePermis()
    {
        return $this->belongsToMany(TypePermis::class, 'habilite', 'user_id', 'type_permis_id');
    }

    public function lecons()
    {
        return $this->hasMany(Lecon::class);
    }
}
