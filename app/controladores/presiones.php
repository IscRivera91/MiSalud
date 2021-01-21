<?php 

namespace App\controladores;

use App\ayudas\Html;
use App\ayudas\Redireccion;
use App\clases\Controlador;
use App\interfaces\Database;
use App\modelos\Presiones AS ModeloPresiones;

class presiones extends Controlador
{
    private $Presiones;

    public function __construct(Database $coneccion)
    {
        $this->Presiones = new ModeloPresiones($coneccion);
        $this->modelo = $this->Presiones;
        $this->nombreMenu = 'presiones';
        $this->breadcrumb = false;

        $this->camposLista = [
            'Id' => 'presiones_id',
            'Usuario' => 'usuarios_nombre_completo',
            'Bpm' => 'presiones_bpm',
            'Activo' => 'presiones_activo'
        ];
        
        parent::__construct();
    }
    
    public function generaInputFiltros (array $datosFiltros): void 
    {
        $col = 3;
        $this->sizeColumnasInputsFiltros = $col;
        
        //values de todos los inputs vacios
        $datos['usuarios+nombre_completo'] = '';

        foreach ($datosFiltros as $key => $filtro) {
            $datos[$key] = $filtro;
        }

        $tablaCampo = 'usuarios+nombre_completo';
        $placeholder = '';

        $this->htmlInputFiltros[$tablaCampo] = Html::inputText($col,'Usuario',1,$tablaCampo,$placeholder,$datos[$tablaCampo]);
    }

    public function nuevoRegistro(): void
    {
        
    }

    public function registrarBd()
    {
        $_POST['usuario_id'] = USUARIO_ID;
        $this->redireccionar = false;
        $resultado = parent::registrarBd();
        
        Redireccion::enviar($this->nombreMenu,'registros',SESSION_ID,$resultado);
    }

    public function registros()
    {

    }

}