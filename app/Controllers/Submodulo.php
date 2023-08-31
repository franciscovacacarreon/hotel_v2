<?php

namespace App\Controllers;

use App\Controllers\BaseController;


use App\Models\PermisoModel;
use App\Models\SubmoduloModel;
use App\Models\ModuloModel;


class Submodulo extends BaseController
{

    //tabla de la base de datos
    protected $submodulo;
    protected $modulo;
    //reglas para las validaciones
    protected $reglas;
    protected $session;

    public function __construct()
    {
        $this->submodulo = new SubmoduloModel();
        $this->modulo = new ModuloModel();
        $this->session = Session();

        //validaciones
        $this->reglas = [
            'nombre' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.'
                ]
            ],
            'id_modulo' => [
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
        $submodulos = $this->submodulo->mostrar();
        $modulos = $this->modulo->mostrar();
        $data = [
            'titulo' => 'Submodulos',
            'submodulos' => $submodulos,
            'modulos' => $modulos,
            'validation' => $this->validator
        ];
        echo view('templates/header');
        echo view('gestionarSubmodulo/mostrarSubmodulo', $data);
        echo view('templates/footer');
    }

    public function getIndexJSON()
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        // $submodulos = $this->submodulo->mostrar();
        $submodulos = $this->addAccionEditDelete($this->submodulo->mostrar());
        $modulos = $this->modulo->mostrar();
        $data = [
            'titulo' => 'Submodulos',
            'submodulos' => $submodulos,
            'modulos' => $modulos,
        ];
        echo json_encode($data);
    }


    public function postInsertar()
    {
        $resultado = false;
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        if (
            $this->request->getMethod() == "post"
            &&  $this->validate($this->reglas)
        ) {
            $resultado = $this->submodulo->crear(
                $this->request->getPost('nombre'),
                $this->request->getPost('id_modulo')
            );
        } 
        return json_encode($resultado);
    }

    public function addAccionEditDelete($datos)
    {
        $newData = [];
        foreach ($datos as $dato) {
            $dato['accion'] = '
            <a href="' . base_url() . 'submodulo/editar/' . $dato['id_submodulo'] . '" class="btn btn-warning btn-sm" title="Editar Registro">
                <i class="fa fa-pencil"></i>
            </a>
            
            <a href="#" data-href="' . base_url() . 'submodulo/eliminar/' . $dato['id_submodulo'] . '" data-bs-toggle="modal" data-bs-target="#modal-confirma" data-placement="top" title="Eliminar Registro" class="btn btn-danger btn-sm">
                <i class="fa fa-trash"></i>
            </a>
            ';

            array_push($newData, $dato);
        }
        return $newData;
    }
}
