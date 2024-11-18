<?php

namespace App\Models;

use App\Models\StockHeuresFormule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FormuleConduite extends Model
{
    use HasFactory;
    protected $table = 'formules_conduite';

    protected $primaryKey = 'formule_id';
    protected $fillable = [
        "age_minimum",
        "age_maximum",
        "nb_heures_conduite",
        "nb_heures_pedagogique",
        "type_permis_id"
    ];

    public function formule()
    {
        return $this->belongsTo(Formule::class);
    }

    public function typePermis()
    {
        return $this->belongsTo(TypePermis::class);
    }

    public function leconsConduite()
    {
        return $this->hasMany(LeconConduite::class, 'formule_conduite_id');
    }

    public function stockHeuresFormule()
    {
        return $this->hasMany(StockHeuresFormule::class, 'formule_conduite_id');
    }
}
