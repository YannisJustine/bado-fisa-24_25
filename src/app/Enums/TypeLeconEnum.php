<?php
namespace App\Enums;

enum TypeLeconEnum
{
    case CONDUITE_FORMULE;
    case CONDUITE_SUPPLEMENTAIRE;

    case ACCOMPAGNEMENT;
    case UNKNOWN;

    public function toString() : string
    {
        switch ($this) {
            case self::ACCOMPAGNEMENT:
                return "Accompagnement";
            case self::CONDUITE_SUPPLEMENTAIRE:
            case self::CONDUITE_FORMULE:
                return "Conduite";
            default:
                return "Erreur";
        }
    }
}