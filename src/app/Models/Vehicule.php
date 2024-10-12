<?php

namespace App\Models;

use App\Http\Helper;
use App\Enums\StatutEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vehicule extends Model
{
    use HasFactory;

    protected $primaryKey = "plaque_imm";

    protected $keyType = 'string';

    protected $fillable = [
        "plaque_imm",
        "marque",
        "date_achat",
        "puissance",
        "type_permis_id"
    ];

    public function typePermis()
    {
        return $this->belongsTo(TypePermis::class);
    }

    public function lecons()
    {
        return $this->hasMany(LeconConduite::class, "plaque_imm", "plaque_imm");
    }

    public function intersect($date, $heure_debut, $heure_fin)
    {
        $lecons = $this->lecons()->with("lecon")->whereHas("lecon", function ($query) use ($date) {
            return $query->where([
                ['date_reservation', $date],
                ['statut_id', StatutEnum::PLANIFIE->value]
            ]);
        })->get();

        foreach ($lecons as $leconConduite) {
            if(Helper::intervalIntersect($leconConduite->lecon->heure_debut, $leconConduite->lecon->heure_fin, $heure_debut, $heure_fin))
                return true;
        }

        return false;
    }
}
