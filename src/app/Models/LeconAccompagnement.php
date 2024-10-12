<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeconAccompagnement extends Model
{
    use HasFactory;
    protected $table = 'lecons_accompagnement';
    protected $primaryKey = 'lecon_id';

    protected $fillable = [
        'formule_conduite_id',
        'lecon_id'
    ];

    public function lecon()
    {
        return $this->belongsTo(Lecon::class);
    }

    public function formuleConduite()
    {
        return $this->belongsTo(FormuleConduite::class, 'formule_conduite_id', 'formule_id');
    }
}
