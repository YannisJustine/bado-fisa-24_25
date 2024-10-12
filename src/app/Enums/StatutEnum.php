<?php
namespace App\Enums;


enum StatutEnum: int
{
    case ATTENTE = 0;
    case IMPOSSIBLE = 1;
    case REFUSE = 2;
    case PLANIFIE = 3;

    public function getLibelle(): string
    {
        switch ($this) {
            case self::ATTENTE:
                return 'En attente';
            case self::IMPOSSIBLE:
                return 'Impossible';
            case self::REFUSE:
                return 'Refusé';
            case self::PLANIFIE:
                return 'Planifié';
            default:
                return 'Inconnu';
        }
    }

    public function getColor(): string
    {
        switch ($this) {
            case self::ATTENTE:
                return 'text-yellow-300';
            case self::IMPOSSIBLE:
                return 'text-red-700';
            case self::REFUSE:
                return 'text-red-500';
            case self::PLANIFIE:
                return 'text-green-500';
            default:
                return 'text-gray-500';
        }
    }
}