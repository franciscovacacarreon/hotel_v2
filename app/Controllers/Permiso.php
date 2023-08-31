<?php

namespace App\Controllers;

use App\Controllers\BaseController;


use App\Models\PermisoModel;
use App\Models\SubmoduloModel;
use App\Models\TipoPermisoModel;


class Permiso extends BaseController
{

    //tabla de la base de datos
    protected $permiso;
    protected $submodulo;
    protected $tipoPermiso;
    //reglas para las validaciones
    protected $reglas;
    protected $session;

    public function __construct()
    {
        $this->permiso = new PermisoModel();
        $this->submodulo = new SubmoduloModel();
        $this->tipoPermiso = new TipoPermisoModel();
        $this->session = Session();

        //validaciones
        $this->reglas = [
            'nombre' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.'
                ]
            ],
            'id_tipoPermiso' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.'
                ]
            ],
            'id_submodulo' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.'
                ]
            ]
        ];
    }

    //metodo principal, mostrar permisos
    public function getIndex()
    {
        //verificar si la sesion sigue activa
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        $permisoConsulta = $this->permiso->mostrar();
        $submodulos = $this->submodulo->mostrar();
        $tipoPermisos = $this->tipoPermiso->mostrar();
        $data = ['titulo' => 
                 'Permisos', 
                 'permisos' => $permisoConsulta, 
                 'submodulos' => $submodulos,
                 'tipoPermisos' => $tipoPermisos,
                ];
        echo view('templates/header');
        echo view('gestionarPermiso/mostrarPermiso', $data);
        echo view('templates/footer');
    }

    public function postInsertar()
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        //si se envia el método post y las valiciones son correctas
        if (
            $this->request->getMethod() == "post"
            &&  $this->validate($this->reglas)
        ) {
            $this->permiso->crear(
                $this->request->getPost('nombre'),
                $this->request->getPost('id_tipoPermiso'),
                $this->request->getPost('id_submodulo'),
            );
            //si las validaciones no son válidas
            return redirect()->to(base_url() . 'permiso');
        } else {
            echo 'error';
        }
    }

    public function getActualizar($id_permiso, $nombre, $id_tipoPermiso, $id_submodulo) {   
        $resultado = false;
        if (isset($id_permiso) && isset($nombre) && isset($id_tipoPermiso) && isset($id_submodulo)) {
            $resultado = $this->permiso->editar($id_permiso, $nombre, $id_tipoPermiso, $id_submodulo);
        }
        return $resultado;
    }

    public function getActualizarNombre($id_permiso, $nombre) {
        $resultado = false;
        if ($id_permiso != ''  &&  $nombre != '') {
            $resultado = $this->permiso->editarNombre($id_permiso, $nombre);
        }
        return json_encode($resultado);
    }

    public function getActualizarIDTipoPermiso($id_permiso, $id_tipoPermiso) {
        $resultado = false;
        if ($id_permiso != ''  &&  $id_tipoPermiso != '') {
            $resultado = $this->permiso->editarIDTipoPermiso($id_permiso, $id_tipoPermiso);
        }
        return $resultado;
    }

    public function getActualizarIDSubmodulo($id_permiso, $id_submodulo) {
        $resultado = false;
        if ($id_permiso != ''  &&  $id_submodulo != '') {
            $resultado = $this->permiso->editarIDSubmodulo($id_permiso, $id_submodulo);
        }
        return $resultado;
    }

    /*public function getTipoPermisoJSON () {
        $tipoPermisos = $this->tipoPermiso->mostrar();
        $tipoPermisosJSON = json_encode($tipoPermisos);
        return $tipoPermisosJSON;
    }

    public function getModuloJSON() {
        $submodulos = $this->submodulo->mostrar();
        $modulosJSON = json_encode($submodulos);
        return $modulosJSON;
    }*/

}
