<?php
namespace App\Enums;


enum FormuleEnum: string
{
    case CODE = 'Code';
    case CODE_ILLIMITE = 'Code Illimité';
    case CONDUITE_ACCOMPAGNEE_B = 'Conduite accompagnée B';
    case CONDUITE_NORMALE_B = 'Conduite normale B';
    case MOTO = 'Moto';
    case POIDS_LOURD = 'Poids-Lourd';

}