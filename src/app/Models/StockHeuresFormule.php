<?php

namespace App\Models;

use App\Traits\HasCompositePrimaryKey;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StockHeuresFormule extends Pivot
{
    use HasFactory;
    use HasCompositePrimaryKey;

    protected $table = "stock_heures_formule";
    protected $primaryKey = ["candidat_id", "formule_conduite_id"];
    public $incrementing = false;


    protected $fillable = [
        'candidat_id',
        'formule_conduite_id',
        'quantite_conduite_restante',
        'quantite_pedagogique_restante'
    ];

    public function candidat()
    {
        return $this->belongsTo(Candidat::class);
    }

    public function formule() 
    {
        return $this->belongsTo(Formule::class, 'formule_conduite_id');
    }
}
