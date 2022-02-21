<?php

namespace App\Controllers;

use App\Class\BaseController;
use App\Class\Redireccion;
use App\Models\Presion;


class PresionController extends BaseController
{

    public function __construct()
    {
        $this->model = Presion::class;
        $this->nameController = 'Presion';
        $this->nameModel = 'Presion';
        parent::__construct();
    }

    public function  nuevoRegistro()
    {
        $this->breadcrumb = false;
    }

    public function  registrarBd()
    {
        $datos = $this->validaDatosFormulario();

        $datos['user_id'] = USUARIO_ID;
        $datos['created_user_id'] = USUARIO_ID;
        $datos['updated_user_id'] = USUARIO_ID;

        $Presion = Presion::query()->create($datos);
        $Presion->save();

        $mensaje = 'datos registrados';

        Redireccion::enviar($this->nameController,'registros',SESSION_ID,$mensaje);
        exit;

    }

    public function registros()
    {
        $this->breadcrumb = false;
        $registros = Presion::query()->where('user_id',USUARIO_ID)->get()->toArray();
        $this->registros = $registros;
    }

}