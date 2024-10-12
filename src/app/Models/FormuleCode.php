<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormuleCode extends Model
{
    use HasFactory;
    protected $table = 'formules_code';
    protected $primaryKey = 'formule_id';

    protected $fillable = [
        "duree_validite"
    ];

    public function formule()
    {
        return $this->belongsTo(Formule::class);
    }

    public function isIllimite() {
        return $this->duree_validite == null;
    }
}
