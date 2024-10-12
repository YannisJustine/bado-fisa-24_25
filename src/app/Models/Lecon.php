<?php

namespace App\Models;

use App\Enums\TypeLeconEnum;
use App\Models\LeconConduite;
use App\Models\LeconAccompagnement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lecon extends Model
{
    use HasFactory;

    protected $with = ['leconConduite', 'leconAccompagnement'];

    protected $fillable = [
        'id',
        'date_reservation',
        'heure_debut',
        'heure_fin',
        'user_id',
        'candidat_id',
        'statut_id',
    ];

    protected $casts = [
        'date_reservation' => 'date',
   
    ];

    public function leconConduite() {
        return $this->hasOne(LeconConduite::class);
    }

    public function leconAccompagnement() {
        return $this->hasOne(LeconAccompagnement::class);
    }

    public function candidat() {
        return $this->belongsTo(Candidat::class);
    }

    public function formateur() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getLecon() {
        return $this->leconConduite ?? $this->leconAccompagnement;
    }

    public function statut() {
        return $this->belongsTo(Statut::class);
    }

    public function getType()
    {
        if($this->leconConduite)
        {
            if($this->leconConduite->formule_conduite_id)
                return TypeLeconEnum::CONDUITE_FORMULE;
            return TypeLeconEnum::CONDUITE_SUPPLEMENTAIRE;
        } else if ($this->leconAccompagnement)
            return TypeLeconEnum::ACCOMPAGNEMENT;
        return TypeLeconEnum::UNKNOWN;
    }

    public function deepReplicate()
    {
        if($this->leconConduite)
        {
            $lecon = $this->replicate();
            $lecon->push();
            $leconConduite = $this->leconConduite->replicate();
            $leconConduite->lecon_id = $lecon->id;
            $leconConduite->push();
        } else if ($this->leconAccompagnement)
        {
            $lecon = $this->replicate();
            $lecon->push();
            $leconAccompagnement = $this->leconAccompagnement->replicate();
            $leconAccompagnement->lecon_id = $lecon->id;
            $leconAccompagnement->push();
        }
        return $lecon;
    }

}
