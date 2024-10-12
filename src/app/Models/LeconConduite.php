<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeconConduite extends Model
{
    use HasFactory;

    protected $table = 'lecons_conduite';
    protected $primaryKey = 'lecon_id';
    protected $fillable = [
        'lecon_id',
        'user_id',
        'plaque_imm',
        'candidat_id',
        'formule_conduite_id'
    ];
    
    public function lecon()
    {
        return $this->belongsTo(Lecon::class);
    }

    public function vehicule()
    {
        return $this->belongsTo(Vehicule::class, 'plaque_imm', 'plaque_imm');
    }

    public function formuleConduite()
    {
        return $this->belongsTo(FormuleConduite::class, 'formule_conduite_id', 'formule_id');
    }
}
