<?php 

namespace Modelo;

use Clase\Modelo;
use Interfas\Database;
use Error\Base AS ErrorBase;
use Error\Autentificacion AS ErrorAutentificacion;

class Usuarios extends Modelo
{
    public function __construct(Database $coneccion)
    {
        $tabla = 'usuarios';
        $relaciones = [
            'grupos' => "{$tabla}.grupo_id"
        ]; 
        $columnas = [
            'unicas' => ['usuario' => 'usuario','correo' => 'correo_electronico'],
            'obligatorias' => ['usuario','password','correo_electronico','grupo_id'],
            'protegidas' => ['password']
        ];
        parent::__construct($coneccion, $tabla, $relaciones, $columnas);
    }

    public function registrar($datos):array
    {
        if (!isset($datos['password'])) {
            throw new ErrorBase('El campo password debe existir en el array de datos');
        }

        $datos['password'] = md5($datos['password']);
        $resultado = parent::registrar($datos);
        return $resultado;
    }

    public function login(array $datosPost):array
    {
        $filtros = [
            ['campo' => "usuarios.usuario" , 'valor' =>  $datosPost['usuario'] , 'signoComparacion' => '=' , 'conectivaLogica' => '' ],
            ['campo' => "usuarios.password", 'valor' =>  md5($datosPost['password']) , 'signoComparacion' => '=' , 'conectivaLogica' => 'AND']
        ];

        $resultado = parent::buscarConFiltros($filtros); 

        if ( $resultado['numeroRegistros'] !== 1){
            throw new ErrorAutentificacion('usuario o contraseña incorrecto');
        }
        
        return $resultado['registros'][0];
    }
}