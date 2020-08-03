<?php 

namespace Controlador;

use Ayuda\Html;
use Clase\Modelo;
use Modelo\Metodos;
use Clase\Controlador;
use Interfas\Database;
use Modelo\MetodosGrupos;
use Error\Base AS ErrorBase;
use Modelo\Grupos AS ModeloGrupos;

class grupos extends Controlador
{
    public array $metodosAgrupadosPorMenu;
    public string $nombreGrupo;
    public int $grupoId;
    public Modelo $Metodos;
    public Modelo $MetodosGrupos;

    public function __construct(Database $coneccion)
    {
        $modelo = new ModeloGrupos($coneccion);
        $this->Metodos = new Metodos($coneccion);
        $this->MetodosGrupos = new MetodosGrupos($coneccion);
        $nombreMenu = 'grupos';
        $this->breadcrumb = false;

        $camposLista = [
            'Id' => 'grupos_id',
            'Grupo' => 'grupos_nombre',
            'Activo' => 'grupos_activo'
        ];

        $camposFiltrosLista = [
            'Grupo' => 'grupos.nombre'
        ];

        parent::__construct($modelo, $nombreMenu, $camposLista, $camposFiltrosLista);
    }

    public function registrar()
    {
        $this->breadcrumb = true;
        
        $this->htmlInputFormulario[] = Html::input('Grupo','nombre',4);

        $this->htmlInputFormulario[] = Html::submit('Registrar',$this->llaveFormulario,4);
    }

    public function modificar()
    {
        parent::modificar();
        $this->breadcrumb = true;

        $nombreMenu = $this->nombreMenu;
        $registro = $this->registro;

        $this->htmlInputFormulario[] = Html::input('Grupo','nombre',4,$registro["{$nombreMenu}_nombre"]);

        $this->htmlInputFormulario[] = Html::submit('Modificar',$this->llaveFormulario,4);
    }

    public function permisos()
    {
        $grupoId = $this->validaRegistoId();
        $this->grupoId = $grupoId;
        $this->metodosAgrupadosPorMenu = $this->modelo->obtenerMetodosAgrupadosPorMenu($grupoId);
        $this->nombreGrupo = $this->modelo->obtenerNombreGrupo($grupoId);
        
    }

    public function altaPermiso()
    {
        try {
            
            $metodoId = $this->validaMedotoId();
            $grupoId = $this->validaGrupoId();

            $datos = ['grupo_id' => $grupoId, 'metodo_id' => $metodoId, 'activo' => 1];
            $this->MetodosGrupos->registrar($datos);

        } catch (ErrorBase $e) {
            header('Content-Type: application/json');
            $json = json_encode(['respuesta' => false,'error' => $e->getMessage()]);
            echo $json;
            exit;
        }

        header('Content-Type: application/json');
        $json = json_encode(['respuesta' => true,'error' => '']);
        echo $json;
        exit;

    }

    public function bajaPermiso()
    {
        try {
            
            $metodoId = $this->validaMedotoId();
            $grupoId = $this->validaGrupoId();

            $filtros = [
                ['campo'=>"{$this->MetodosGrupos->obtenerTabla()}.grupo_id", 'valor'=>$grupoId, 'signoComparacion'=>'=', 'conectivaLogica' => ''],
                ['campo'=>"{$this->MetodosGrupos->obtenerTabla()}.metodo_id", 'valor'=>$metodoId, 'signoComparacion'=>'=', 'conectivaLogica' => 'AND']
            ];
            $this->MetodosGrupos->eliminarConFiltros($filtros);

        } catch (ErrorBase $e) {
            header('Content-Type: application/json');
            $json = json_encode(['respuesta' => false,'error' => $e->getMessage()]);
            echo $json;
            exit;
        }

        header('Content-Type: application/json');
        $json = json_encode(['respuesta' => true,'error' => '']);
        echo $json;
        exit;

    }

    public function validaMedotoId()
    {
        if (!isset($_GET['metodoId'])) {
            throw new ErrorBase('se esperaba el parametro GET metodoId');  
        }

        $metodoId = (int) $_GET['metodoId'];

        if (!$this->Metodos->existeRegistroId($metodoId)) {
            throw new ErrorBase('el metodoId no existe'); 
        }
        
        return $metodoId;

    }

    public function validaGrupoId()
    {
        if (!isset($_GET['grupoId'])) {
            throw new ErrorBase('se esperaba el parametro GET grupoId');  
        }

        $grupoId = (int) $_GET['grupoId'];

        if (!$this->modelo->existeRegistroId($grupoId)) {
            throw new ErrorBase('el grupoId no existe');  
        }
        
        return $grupoId;
    }

}