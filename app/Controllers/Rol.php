<?php

namespace App\Controllers;

use App\Controllers\BaseController;


use App\Models\RolModel;
use App\Models\PermisoModel;
use App\Models\DetalleRolPermisoModel;
use App\Models\SubmoduloModel;
use App\Models\ModuloModel;

class Rol extends BaseController
{

    //tabla de la base de datos
    protected $rol;
    protected $permiso;
    protected $detalleRol;
    protected $submodulo;
    protected $modulo;
    //reglas para las validaciones
    protected $reglas;
    protected $reglasEdit;
    protected $session;

    public function __construct()
    {
        $this->rol = new RolModel();
        $this->permiso = new PermisoModel();
        $this->detalleRol = new DetalleRolPermisoModel();
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
            'descripcion' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.'
                ]
            ]
        ];

        $this->reglasEdit = [
            'nombre-edit' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.'
                ]
            ],
            'descripcion-edit' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.'
                ]
            ]
        ];
    }

    //metodo principal, mostrar Roles
    public function getIndex()
    {
        //verificar si la sesion sigue activa
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        $rolConsulta = $this->rol->mostrar();
        $data = ['titulo' => 'Roles', 'datos' => $rolConsulta];
        echo view('templates/header');
        echo view('gestionarRol/mostrarRol', $data);
        echo view('templates/footer');
    }

    //muestra la vista para crear una rol 
    public function getCrear()
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        $data = ['titulo' => 'Crear Rol', 'validation' => $this->validator];
        echo view('templates/header');
        echo view('gestionarRol/crearRol', $data);
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
            $this->rol->crear(
                $this->request->getPost('nombre'),
                $this->request->getPost('descripcion'),
            );
            //si las validaciones no son válidas
            return redirect()->to(base_url() . 'rol');
        } else {
            $this->getCrear();
        }
    }

    //consulta para obtener el registro a editar
    public function getEditar($id)
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        $Roles = $this->rol->mostrarId($id);
        $data = [
            'titulo' => 'Editar Rol',
            'datos' => $Roles,
            'validation' => $this->validator
        ];
        echo json_encode($data); //para trabajar con ajax
    }

    //actualizar el registro 
    public function postActualizar()
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        //para la validación
        if (
            $this->request->getMethod() == "post"
            &&  $this->validate($this->reglasEdit)
        ) {

            $resultado = $this->rol->editar(
                $this->request->getPost('id_rol'),
                $this->request->getPost('nombre-edit'),
                $this->request->getPost('descripcion-edit'),
            );

            return redirect()->to(base_url() . 'rol');
        } else {
            printf("Error");
        }
    }

    //muestra las Roles inactivas
    public function getEliminados()
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        $Roles = $this->rol->mostrarEliminados();
        $data = [
            'titulo' => 'Roles eliminadas',
            'datos' => $Roles
        ];
        echo view('templates/header');
        echo view('gestionarRol/eliminarRol', $data);
        echo view('templates/footer');
    }

    //dar de baja al registro (cambiar estado a inactivo)
    public function getEliminar($id)
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        $resultado = $this->rol->eliminar($id);
        if ($resultado) {
            $rolConsulta = $this->rol->mostrar();
            $data = ['titulo' => 'Rol', 'datos' => $rolConsulta];
            echo view('templates/header');
            echo view('gestionarRol/mostrarRol', $data);
            echo view('templates/footer');
        } else {
            $error = 'El rol tiene registros asociados';
            $rolConsulta = $this->rol->mostrar();
            $data = ['titulo' => 'Rol', 'error' => $error, 'datos' => $rolConsulta];
            echo view('templates/header');
            echo view('gestionarRol/mostrarCategoria', $data);
            echo view('templates/footer');
        }
    }

    public function getRestaurar($id)
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        $resultado = $this->rol->restaurar($id);
        if ($resultado) {
            return redirect()->to(base_url() . 'rol');
        } else {
            //mostrar mensaje de error
        }
    }

    //envía los datos de los permisos que tiene un rol a la vista detalles
    public function getDetalle($id_rol)
    {
        $permisos = $this->permiso->mostrar();
        $submodulos = $this->submodulo->mostrar();
        $modulos = $this->modulo->mostrar();
        $datosDetalleRol =  $this->rol->mostrarDetalleRol($id_rol);
        $datos = array();
        //$this->detalleRol->verificarPermiso($id_rol, 'MenuHospedaje');

        $permisosAsignados = $this->detalleRol->permisosAsignados($id_rol);
        foreach ($permisosAsignados as $permisoAsignado) {
            $datos[$permisoAsignado['id_permiso']] = true;
        }

        $data = [
            'titulo' => 'Asignar permisos',
            'permisos' => $permisos,
            'id_rol' => $id_rol,
            'asignado' => $datos,
            'submodulos' => $submodulos,
            'modulos' => $modulos,
            'datosDetalleRol' => $datosDetalleRol,
        ];
        echo view('templates/header');
        echo view('gestionarRol/detalle', $data);
        echo view('templates/footer');
    }

    public function postGuardaPermiso()
    {
        if ($this->request->getMethod() == "post") {
            $id_rol = $this->request->getPost('id_rol');
            $permisos = $this->request->getPost('permisos');

            $this->detalleRol->eliminar($id_rol);
            foreach ($permisos as $permiso) {
                $resultado = $this->detalleRol->crear($id_rol, $permiso);
            }
            $this->getIndex();
        }
    }
}
