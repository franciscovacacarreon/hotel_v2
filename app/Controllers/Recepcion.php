<?php

namespace App\Controllers;

use App\Controllers\BaseController;


use App\Models\HabitacionModel;
use App\Models\DetalleRolPermisoModel;
use App\Models\SubmoduloModel;


class Recepcion extends BaseController
{

    //tabla de la base de datos
    protected $habitacion;
    protected $detalleRol;
    protected $submodulo;
    protected $id_modulo;
    //reglas para las validaciones
    protected $reglas;
    protected $session;

    public function __construct()
    {
        $this->habitacion = new HabitacionModel();
        $this->detalleRol = new DetalleRolPermisoModel();
        $this->submodulo = new SubmoduloModel();
        $this->session = Session();

        //validaciones
        $this->reglas = [
            'precio' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.'
                ]
            ],
            'nombre' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.'
                ]
            ],
            'descripcion' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.'
                ]
            ]
        ];
    }

    public function getSinPermiso()
    {
        echo view('templates/header');
        echo view('gestionarRol/sinpermiso');
        echo view('templates/footer');
    }

    public function verficarPermiso($permiso, $id_submodulo)
    {
        $permiso  = $this->detalleRol->verificarPermiso($this->session->id_rol, $permiso, $id_submodulo);
        return $permiso;
    }

    //metodo principal, mostrar categorias
    public function getIndex()
    {
        //verificar si la sesion sigue activa
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        if (!$this->verficarPermiso('Recepción', 1)) {
            $this->getSinPermiso();
        } else {
            $botonFinalizar = $this->verficarPermiso('Recepción Finalizar', 1) == false ? 'visually-hidden-focusable' : '';
            $consulta = $this->habitacion->habitacionHospedajeOcupada();
            $data = ['titulo' => 'Categoria', 'datos' => $consulta, 'botonFinalizar' => $botonFinalizar];
            echo view('templates/header');
            echo view('gestionarRecepcion/mostrarRecepcion', $data);
            echo view('templates/footer');
        }
    }
}
