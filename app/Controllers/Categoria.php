<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CategoriaModel;
use App\Models\DetalleRolPermisoModel;


class Categoria extends BaseController
{

    //tabla de la base de datos
    protected $categoria;
    protected $detalleRol;
    //reglas para las validaciones
    protected $reglas;
    protected $session;

    public function __construct()
    {
        $this->categoria = new CategoriaModel();
        $this->detalleRol = new DetalleRolPermisoModel();
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

    //validar permisos
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
        if (!$this->verficarPermiso('Categorias', 6)) {
            return $this->getSinPermiso();
        }

        $botonesClass = [
            'botonAgregar' => $this->verficarPermiso('Agregar', 6) == false ? 'visually-hidden-focusable' : '',
            'botonEliminados' => $this->verficarPermiso('Eliminados', 6) == false ? 'visually-hidden-focusable' : '',
            'botonEditar' => $this->verficarPermiso('Editar', 6) == false ? 'disabled-link' : 'btn btn-warning btn-sm',
            'botonEliminar' => $this->verficarPermiso('Eliminar', 6) == false ? 'disabled-link' : 'btn btn-danger btn-sm',
        ];
        $categoriaConsulta = $this->categoria->mostrar();
        $data = ['titulo' => 'Categoria', 'datos' => $categoriaConsulta, 'botonesClass' => $botonesClass];
        echo view('templates/header');
        echo view('gestionarCategoria/mostrarCategoria', $data);
        echo view('templates/footer');
    }

    //muestra la vista para crear una categoria 
    public function getCrear()
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        if (!$this->verficarPermiso('Agregar', 6)  ||  !$this->verficarPermiso('Categorias', 6)) {
            return $this->getSinPermiso();
        }
        $data = ['titulo' => 'Crear Categoria', 'validation' => $this->validator];
        echo view('templates/header');
        echo view('gestionarCategoria/crearCategoria', $data);
        echo view('templates/footer');
    }

    public function postInsertar()
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        if (!$this->verficarPermiso('Agregar', 6)  ||  !$this->verficarPermiso('Categorias', 6)) {
            return $this->getSinPermiso();
        }
        //si se envia el método post y las valiciones son correctas
        if (
            $this->request->getMethod() == "post"
            &&  $this->validate($this->reglas)
        ) {
            $this->categoria->crear(
                $this->request->getPost('precio'),
                $this->request->getPost('nombre'),
                $this->request->getPost('descripcion'),

            );
            //si las validaciones no son válidas
            return redirect()->to(base_url() . 'categoria');
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
        if (!$this->verficarPermiso('Editar', 6)  ||  !$this->verficarPermiso('Categorias', 6)) {
            return $this->getSinPermiso();
        }
        $categorias = $this->categoria->mostrarId($id);
        $data = [
            'titulo' => 'Editar Categoria',
            'datos' => $categorias,
            'validation' => $this->validator
        ];
        echo view('templates/header');
        echo view('gestionarCategoria/editarCategoria', $data);
        echo view('templates/footer');
    }

    //actualizar el registro 
    public function postActualizar()
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        if (!$this->verficarPermiso('Editar', 6)  ||  !$this->verficarPermiso('Categorias', 6)) {
            return $this->getSinPermiso();
        }
        //para la validación
        if (
            $this->request->getMethod() == "post"
            &&  $this->validate($this->reglas)
        ) {

            $resultado = $this->categoria->editar(
                $this->request->getPost('id'),
                $this->request->getPost('precio'),
                $this->request->getPost('nombre'),
                $this->request->getPost('descripcion'),
            );

            return redirect()->to(base_url() . 'categoria');
        } else {
        }
    }

    //muestra las categorias inactivas
    public function getEliminados()
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        if (!$this->verficarPermiso('Eliminados', 6)  ||  !$this->verficarPermiso('Categorias', 6)) {
            return $this->getSinPermiso();
        }
        $categorias = $this->categoria->mostrarEliminados();
        $data = [
            'titulo' => 'Categorias eliminadas',
            'datos' => $categorias
        ];
        echo view('templates/header');
        echo view('gestionarCategoria/eliminarCategoria', $data);
        echo view('templates/footer');
    }

    //dar de baja al registro (cambiar estado a inactivo)
    public function getEliminar($id)
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        if (!$this->verficarPermiso('Eliminar', 6)  ||  !$this->verficarPermiso('Categorias', 6)) {
            return $this->getSinPermiso();
        }
        //mejorar con un if
        $resultado = $this->categoria->eliminar($id);
        if ($resultado) {
            $categoriaConsulta = $this->categoria->mostrar();
            $data = ['titulo' => 'Categoria', 'datos' => $categoriaConsulta];
            echo view('templates/header');
            echo view('gestionarCategoria/mostrarCategoria', $data);
            echo view('templates/footer');
        } else {
            $error = 'La categoría tiene registros asociados';
            $categoriaConsulta = $this->categoria->mostrar();
            $data = ['titulo' => 'Categoria', 'error' => $error,'datos' => $categoriaConsulta];
            echo view('templates/header');
            echo view('gestionarCategoria/mostrarCategoria', $data);
            echo view('templates/footer');
        }
    }

    public function getRestaurar($id)
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        if (!$this->verficarPermiso('Eliminados', 6)  ||  !$this->verficarPermiso('Categorias', 6)) {
            return $this->getSinPermiso();
        }
        $resultado = $this->categoria->restaurar($id);
        if ($resultado) {
            return redirect()->to(base_url() . 'categoria');
        } else {
            //mostrar mensaje de error
        }
    }
}
