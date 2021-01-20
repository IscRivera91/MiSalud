<?php 

namespace App\modelos;

use App\clases\Modelo;
use App\interfaces\Database;

class Presiones extends Modelo
{
    public function __construct(Database $coneccion)
    {
        $tabla = 'presiones';
        $relaciones = [
            'usuarios' => "{$tabla}.usuario_id"

        ]; 
        $columnas = [
            'unicas' => [],
            'obligatorias' => ['sistolica','diastolica','bpm','fecha','hora'],
            'protegidas' => []
        ];
        parent::__construct($coneccion, $tabla, $relaciones, $columnas);
    }
}