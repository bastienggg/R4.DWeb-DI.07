<?php

// Là ou la classe est déclarée (où son fichier se trouve)
namespace App\Service;

use App\Entity\Lego;

class LegoService
{
    public function getLego(): Lego
    {
    $lego = new Lego(1, 'Volkswagen Beetle', 'Creator Expert');
    return $lego;
    }
}

