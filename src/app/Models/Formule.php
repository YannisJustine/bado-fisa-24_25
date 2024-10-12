<?php

namespace App\Models;

use App\Enums\FormuleEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Formule extends Model
{
    use HasFactory;

    protected $fillable = [
        "libelle",
        "prix"
    ];

    public function formuleConduite()
    {
        return $this->hasOne(FormuleConduite::class);
    }

    public function formuleCode()
    {
        return $this->hasOne(FormuleCode::class);
    }

    public function isFormuleConduite() {
        return $this->formuleConduite instanceof FormuleConduite;
    }

    public function isFormuleCode() {
        return $this->formuleCode instanceof FormuleCode;
    }

    public function getType()
    {
        switch ($this->libelle) {
            case FormuleEnum::CODE->value:
            case FormuleEnum::CODE_ILLIMITE->value:
                return 'Code';
            case FormuleEnum::POIDS_LOURD->value:
            case FormuleEnum::CONDUITE_ACCOMPAGNEE_B->value:
            case FormuleEnum::CONDUITE_NORMALE_B->value:
            case FormuleEnum::MOTO->value:
                return 'Conduite';
            default:
                # Unreachable
                return 'Erreur';
        }
    }
}
