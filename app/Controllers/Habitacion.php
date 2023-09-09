<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\HabitacionModel;
use App\Models\CategoriaModel;
use App\Models\DetalleRolPermisoModel;

class Habitacion extends BaseController
{
    //tabla de la base de datos
    protected $habitacion;
    //usamos el modelo categoria para obtener las categorias
    protected $categoria;
    protected $detalleRol;
    //reglas para las validaciones
    protected $reglas;
    protected $session;

    public function __construct()
    {
        $this->habitacion = new HabitacionModel();
        $this->categoria = new CategoriaModel();
        $this->detalleRol = new DetalleRolPermisoModel();
        $this->session = Session();

        //validaciones
        $this->reglas = [
            // 'numero_camas' => [
            //     'rules' => 'required',
            //     'errors' => [
            //         'required' => 'El campo {field} es obligatorio.'
            //     ]
            // ],
            'id_categoria' => [
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

    //metodo principal, mostrar habitacioness
    public function getIndex()
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        if (!$this->verficarPermiso('Habitaciones', 5)) {
            return $this->getSinPermiso();
        }

        $botonesClass = [
            'botonAgregar' => $this->verficarPermiso('Agregar', 5) == false ? 'visually-hidden-focusable' : '',
            'botonEliminados' => $this->verficarPermiso('Eliminados', 5) == false ? 'visually-hidden-focusable' : '',
            'botonEditar' => $this->verficarPermiso('Editar', 5) == false ? 'disabled-link' : 'btn btn-warning btn-sm',
            'botonEliminar' => $this->verficarPermiso('Eliminar', 5) == false ? 'disabled-link' : 'btn btn-danger btn-sm',
        ];
        $habitacionConsulta = $this->habitacion->mostrar();
        $data = ['titulo' => 'Habitaciones', 'habitaciones' => $habitacionConsulta];
        echo view('templates/header');
        echo view('gestionarHabitacion/mostrarHabitacion', $data);
        echo view('templates/footer');
    }

    //muestra la vista para insertar una habitacion 
    public function getCrear()
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        if (!$this->verficarPermiso('Agregar', 5)  ||  !$this->verficarPermiso('Habitaciones', 5)) {
            return $this->getSinPermiso();
        }
        //consulta para traer las categorias disponibles
        $categorias = $this->categoria->mostrar();
        $data = [
            'titulo' => 'Crear Habitacion',
            'validation' => $this->validator,
            'categorias' => $categorias
        ];
        echo view('templates/header');
        echo view('gestionarHabitacion/crearHabitacion', $data);
        echo view('templates/footer');
    }

    public function postInsertar()
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        if (!$this->verficarPermiso('Agregar', 5)  ||  !$this->verficarPermiso('Habitaciones', 5)) {
            return $this->getSinPermiso();
        }
        //si se envia el método post y las valiciones son correctas
        if (
            $this->request->getMethod() == "post"
            &&  $this->validate($this->reglas)
        ) {
            $this->habitacion->crear(
                // $this->request->getPost('numero_camas'),
                $this->request->getPost('estado_habitacion'),
                $this->request->getPost('id_categoria')
            );
            //si las validaciones no son válidas
            return redirect()->to(base_url() . 'habitacion');
        } else {
            $this->getCrear();
        }
    }

    //consulta para obtener el registro a editar
    public function getEditar($nro_habitacion)
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        if (!$this->verficarPermiso('Editar', 5)  ||  !$this->verficarPermiso('Habitaciones', 5)) {
            return $this->getSinPermiso();
        }
        $habitacion = $this->habitacion->mostrarId($nro_habitacion);
        $categorias = $this->categoria->mostrar();
        $data = [
            'titulo' => 'Editar Habitación',
            'habitacion' => $habitacion,
            'categorias' => $categorias,
            'validation' => $this->validator
        ];
        echo view('templates/header');
        echo view('gestionarHabitacion/editarHabitacion', $data);
        echo view('templates/footer');
    }

    //actualizar el registro 
    public function postActualizar()
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        if (!$this->verficarPermiso('Editar', 5)  ||  !$this->verficarPermiso('Habitaciones', 5)) {
            return $this->getSinPermiso();
        }
        //para la validación
        if (
            $this->request->getMethod() == "post"
            &&  $this->validate($this->reglas)
        ) {

            $resultado = $this->habitacion->editar(
                $this->request->getPost('nro_habitacion'),
                $this->request->getPost('numero_camas'),
                $this->request->getPost('estado_habitacion'),
                $this->request->getPost('id_categoria')
            );
            return redirect()->to(base_url() . 'habitacion');
        } else {
        }
    }

    //muestra las habitaciones inactivas
    public function getEliminados()
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        if (!$this->verficarPermiso('Eliminados', 5)  ||  !$this->verficarPermiso('Habitaciones', 5)) {
            return $this->getSinPermiso();
        }
        $habitaciones = $this->habitacion->mostrarEliminados();
        $data = [
            'titulo' => 'Habitaciones eliminadas',
            'habitaciones' => $habitaciones
        ];
        echo view('templates/header');
        echo view('gestionarHabitacion/eliminarHabitacion', $data);
        echo view('templates/footer');
    }

    //dar de baja al registro (cambiar estado a inactivo)
    public function getEliminar($nro_habitacion)
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        if (!$this->verficarPermiso('Eliminar', 5)  ||  !$this->verficarPermiso('Habitaciones', 5)) {
            return $this->getSinPermiso();
        }
        $resultado = $this->habitacion->eliminar($nro_habitacion);
        if ($resultado) {
            $habitacionConsulta = $this->habitacion->mostrar();
            $data = ['titulo' => 'Habitaciones', 'habitaciones' => $habitacionConsulta];
            echo view('templates/header');
            echo view('gestionarHabitacion/mostrarHabitacion', $data);
            echo view('templates/footer');
        } else {
            $error = 'La habitación tiene registros asociados';
            $habitacionConsulta = $this->habitacion->mostrar();
            $data = ['titulo' => 'Habitaciones', 'error' => $error, 'habitaciones' => $habitacionConsulta];
            echo view('templates/header');
            echo view('gestionarHabitacion/mostrarHabitacion', $data);
            echo view('templates/footer');
        }
    }

    //restaurar el registro (estado = 1)
    public function getRestaurar($nro_habitacion)
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        if (!$this->verficarPermiso('Eliminados', 5)  ||  !$this->verficarPermiso('Habitaciones', 5)) {
            return $this->getSinPermiso();
        }
        $resultado = $this->habitacion->restaurar($nro_habitacion);
        if ($resultado) {
            return redirect()->to(base_url() . 'habitacion');
        } else {
            //mostrar mensaje de error
        }
    }

    public function getBuscarPorId($nro_habitacion)
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        $datos = $this->habitacion->buscarPorId($nro_habitacion);
        $resultado['existe'] = false;
        $resultado['data'] = '';
        $resultado['error'] = '';

        //verificar disponibilidad de habitacion
        if ($datos) {
            if ($datos['estado_habitacion'] == 'Disponible') {
                $resultado['data'] = $datos;
                $resultado['existe'] = true;
            } else {
                $resultado['error'] = 'Habitación no disponible';
            }
        } else {
            $resultado['error'] = 'Habitación no existe';
            //$resultado['existe'] = false;
        }

        //para que trabaje el ajax correctamente, se convierte a json
        echo json_encode($resultado);
    }
}
