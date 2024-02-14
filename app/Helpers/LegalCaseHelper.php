<?php

use App\Models\LegalCase;

function generateCorelativeCode()
{
    $prefix = 'C-'; // Prefijo para el código del caso
    $correlative = LegalCase::count() + 1; // Obtener el siguiente correlativo
    return $prefix . str_pad($correlative, 9, '0', STR_PAD_LEFT); // Formato del código
}
