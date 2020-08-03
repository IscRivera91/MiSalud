<?php 

namespace Controlador;

use Ayuda\Html;
use Clase\Controlador;
use Interfas\Database;
use Error\Base AS ErrorBase;
use Modelo\Metodos AS ModeloMetodos;
use Modelo\Menus AS ModeloMenus;

class metodos extends Controlador
{
    private array $menuRegistros;

    public function __construct(Database $coneccion)
    {
        $modelo = new ModeloMetodos($coneccion);
        $modeloMenus = new ModeloMenus($coneccion);

        try {
            $columas = ['menus_id','menus_nombre'];
            $this->menuRegistros = $modeloMenus->buscarTodo($columas,[],'',true)['registros'];
        } catch (ErrorBase $e) {
            $error = new ErrorBase('Error al obtner los menus');
            $error->muestraError();
        }

        $nombreMenu = 'metodos';
        $this->breadcrumb = false;

        $camposLista = [
            'Id' => 'metodos_id',
            'Menu' => 'menus_nombre',
            'Metodo' => 'metodos_nombre',
            'Etiqueta' => 'metodos_etiqueta',
            'Icono' => 'metodos_icono',
            'Activo' => 'metodos_activo',
            'Activo Accion' => 'metodos_activo_accion',
            'Activo Menu' => 'metodos_activo_menu'
        ];

        $camposFiltrosLista = [
            'Menu' => 'menus.nombre',
            'Metodo' => 'metodos.nombre'
        ];

        parent::__construct($modelo, $nombreMenu, $camposLista, $camposFiltrosLista);
    }

    public function registrar()
    {
        $this->breadcrumb = true;
        
        $this->htmlInputFormulario[] = Html::input('Metodo','nombre',4);
        $this->htmlInputFormulario[] = Html::input('Etiqueta','etiqueta',4,'','','text','');
        $this->htmlInputFormulario[] = Html::input('Icon','icono',4,'','','text','');
        $this->htmlInputFormulario[] = Html::selectConBuscador('menus','Menu', 'menu_id', 3,$this->menuRegistros,'menus_nombre','-1',1);
        $this->htmlInputFormulario[] = Html::selectActivo('Activo','activo',3,'-1',2);
        $this->htmlInputFormulario[] = Html::selectActivo('Activo Accion','activo_accion',3,'-1',3);
        $this->htmlInputFormulario[] = Html::selectActivo('Activo Menu','activo_menu',3,'-1',4);

        $this->htmlInputFormulario[] = Html::submit('Registrar',$this->llaveFormulario,4);
    }

    public function modificar()
    {
        parent::modificar();
        $this->breadcrumb = true;

        $nombreMenu = $this->nombreMenu;
        $registro = $this->registro;

        $this->htmlInputFormulario[] = Html::input('Metodo','nombre',4,$registro["{$nombreMenu}_nombre"]);
        $this->htmlInputFormulario[] = Html::input('Etiqueta','etiqueta',4,$registro["{$nombreMenu}_etiqueta"],'','text','');
        $this->htmlInputFormulario[] = Html::input('Icon','icono',4,$registro["{$nombreMenu}_icono"],'','text','');
        $this->htmlInputFormulario[] = Html::selectConBuscador(
            'menus',
            'Menu', 
            'menu_id', 
            3,
            $this->menuRegistros,
            'menus_nombre',
            $registro["{$nombreMenu}_menu_id"],
            1
        );
        $this->htmlInputFormulario[] = Html::selectActivo('Activo','activo',3,$registro["{$nombreMenu}_activo"],2);
        $this->htmlInputFormulario[] = Html::selectActivo('Activo Accion','activo_accion',3,$registro["{$nombreMenu}_activo_accion"],3);
        $this->htmlInputFormulario[] = Html::selectActivo('Activo Menu','activo_menu',3,$registro["{$nombreMenu}_activo_menu"],4);

        $this->htmlInputFormulario[] = Html::submit('Modificar',$this->llaveFormulario,4);
    }

}