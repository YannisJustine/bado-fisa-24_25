<?php

namespace App\Models;

use App\Traits\HasCompositePrimaryKey;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StockHeuresSupp extends Pivot
{
    use HasFactory;
    use HasCompositePrimaryKey;

    protected $table = "stock_heures_supps";
    protected $primaryKey = ["candidat_id", "type_permis_id"];
    public $incrementing = false;

    protected $fillable = [
        'candidat_id',
        'type_permis_id',
        'quantite_restante'
    ];

    public function candidat()
    {
        return $this->belongsTo(Candidat::class);
    }

    public function typePermis()
    {
        return $this->belongsTo(TypePermis::class);
    }

}
