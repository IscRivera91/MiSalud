<?php 

namespace Ayuda;

use Interfas\Database;
use Interfas\GeneraConsultas;
use Modelo\MetodosGrupos;

class Acciones
{
    public static function crear(
        Database $coneccion, 
        int $grupoId,
        string $controladorActual
    ): array {

        if (isset($_SESSION[SESSION_ID]["{$controladorActual}Acciones"])) {
            return $_SESSION[SESSION_ID]["{$controladorActual}Acciones"];
        }

        $modeloMetodosGrupos = new MetodosGrupos($coneccion);
        
        $filtros = [
            ['campo' => "{$modeloMetodosGrupos->obtenerTabla()}.grupo_id", 'valor'=>$grupoId, 'signoComparacion'=>'=', 'conectivaLogica'=>''],
            ['campo' => "metodos.activo_accion", 'valor'=>1, 'signoComparacion'=>'=', 'conectivaLogica'=>'AND'],
            ['campo' => "menus.nombre", 'valor'=>$controladorActual, 'signoComparacion'=>'=', 'conectivaLogica'=>'AND']
        ];
        
        $columnas = [
            'metodos_nombre',
            'metodos_accion',
            'metodos_icono',
            'menus_nombre'
        ];

        $orderBy = [
            'metodos.nombre' => 'ASC'
        ];

        $resultado = $modeloMetodosGrupos->buscarConFiltros($filtros, $columnas, $orderBy);

        if ($resultado['numeroRegistros'] === 0){
            return [];
        }

        $acciones = [];

        foreach ($resultado['registros'] as $accion){
            $acciones[$accion['metodos_nombre']] = $accion;
        }
        $_SESSION[SESSION_ID]["{$controladorActual}Acciones"] = $acciones; 
        return $acciones;
    }
}