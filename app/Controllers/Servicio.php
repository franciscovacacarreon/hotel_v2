<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ServicioModel;
use App\Models\TipoServicioModel;
use App\Models\DetalleRolPermisoModel;

class Servicio extends BaseController
{
    //tabla de la base de datos
    protected $servicio;
    //usamos el modelo tipoServicio para obtener las tipoServicios
    protected $tipoServicio;
    protected $detalleRol;
    //reglas para las validaciones
    protected $reglas;
    protected $session;

    public function __construct()
    {
        $this->servicio = new ServicioModel();
        $this->tipoServicio = new TipoServicioModel();
        $this->detalleRol = new DetalleRolPermisoModel();
        $this->session = Session();

        //validaciones
        $this->reglas = [
            'nombre' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.'
                ]
            ],
            'precio' => [
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
            ],
            'id_tipoServicio' => [
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

    //metodo principal, mostrar servicio
    public function getIndex()
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        if (!$this->verficarPermiso('Servicios', 3)) {
            $this->getSinPermiso();
        } else {

            $botonesClass = [
                'botonAgregar' => $this->verficarPermiso('Agregar', 3) == false ? 'visually-hidden-focusable' : '',
                'botonEliminados' => $this->verficarPermiso('Eliminados', 3) == false ? 'visually-hidden-focusable' : '',
                'botonEditar' => $this->verficarPermiso('Editar', 3) == false ? 'disabled-link' : 'btn btn-warning btn-sm',
                'botonEliminar' => $this->verficarPermiso('Eliminar', 3) == false ? 'disabled-link' : 'btn btn-danger btn-sm',
            ];

            $servicioConsulta = $this->servicio->mostrar();
            $data = [
                'titulo' => 'Servicios',
                'servicios' => $servicioConsulta,
                'botonesClass' => $botonesClass,
            ];
            echo view('templates/header');
            echo view('gestionarServicio/mostrarServicio', $data);
            echo view('templates/footer');
        }
    }


    //muestra la vista para insertar un servicio 
    public function getCrear()
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        if (!$this->verficarPermiso('Agregar', 3)  ||  !$this->verficarPermiso('servicios', 3)) {
            return $this->getSinPermiso();
        }
        //consulta para traer los tipoServicios disponibles
        $tipoServicios = $this->tipoServicio->mostrar();
        $data = [
            'titulo' => 'Crear Servicio',
            'validation' => $this->validator,
            'tipoServicios' => $tipoServicios
        ];
        echo view('templates/header');
        echo view('gestionarServicio/crearServicio', $data);
        echo view('templates/footer');
    }

    public function postInsertar()
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        if (!$this->verficarPermiso('Agregar', 3)  ||  !$this->verficarPermiso('servicios', 3)) {
            return $this->getSinPermiso();
        }
        //si se envia el método post y las valiciones son correctas
        if (
            $this->request->getMethod() == "post"
            &&  $this->validate($this->reglas)
        ) {
            $this->servicio->crear(
                $this->request->getPost('nombre'),
                $this->request->getPost('precio'),
                $this->request->getPost('descripcion'),
                $this->request->getPost('id_tipoServicio')
            );
            //si las validaciones no son válidas
            return redirect()->to(base_url() . 'servicio');
        } else {
            $this->getCrear();
        }
    }

    //consulta para obtener el registro a editar
    public function getEditar($id_servicio)
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        if (!$this->verficarPermiso('Editar', 3)  ||  !$this->verficarPermiso('servicios', 3)) {
            return $this->getSinPermiso();
        }
        $servicio = $this->servicio->mostrarId($id_servicio);
        $tipoServicios = $this->tipoServicio->mostrar();
        $data = [
            'titulo' => 'Editar Servicio',
            'servicio' => $servicio,
            'tipoServicios' => $tipoServicios,
            'validation' => $this->validator
        ];
        echo view('templates/header');
        echo view('gestionarServicio/editarServicio', $data);
        echo view('templates/footer');
    }

    //actualizar el registro 
    public function postActualizar()
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        if (!$this->verficarPermiso('Editar', 3)  ||  !$this->verficarPermiso('servicios', 3)) {
            return $this->getSinPermiso();
        }
        //para la validación
        if (
            $this->request->getMethod() == "post"
            &&  $this->validate($this->reglas)
        ) {

            $resultado = $this->servicio->editar(
                $this->request->getPost('id_servicio'),
                $this->request->getPost('nombre'),
                $this->request->getPost('precio'),
                $this->request->getPost('descripcion'),
                $this->request->getPost('id_tipoServicio')
            );
            return redirect()->to(base_url() . 'servicio');
        } else {
        }
    }

    public function getEliminados()
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        if (!$this->verficarPermiso('Eliminados', 3)  ||  !$this->verficarPermiso('servicios', 3)) {
            return $this->getSinPermiso();
        }
        $servicios = $this->servicio->mostrarEliminados();
        $data = [
            'titulo' => 'Habitaciones eliminadas',
            'servicios' => $servicios
        ];
        echo view('templates/header');
        echo view('gestionarServicio/eliminarServicio', $data);
        echo view('templates/footer');
    }

    //dar de baja al registro (cambiar estado a inactivo)
    public function getEliminar($id_servicio)
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        if (!$this->verficarPermiso('Eliminar', 3)  ||  !$this->verficarPermiso('servicios', 3)) {
            return $this->getSinPermiso();
        }
        $resultado = $this->servicio->eliminar($id_servicio);
        if (!$resultado) {
            $servicioConsulta = $this->servicio->mostrar();
            $error = 'El servicio tiene registros asociados';
            $data = ['titulo' => 'Servicios', 'error' => $error, 'servicios' => $servicioConsulta];
            echo view('templates/header');
            echo view('gestionarServicio/mostrarServicio', $data);
            echo view('templates/footer');
        } else {
            return redirect()->to(base_url() . 'servicio');
        }
    }

    //restaurar el registro (estado = 1)
    public function getRestaurar($id_servicio)
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        if (!$this->verficarPermiso('Eliminados', 3)  ||  !$this->verficarPermiso('servicios', 3)) {
            return $this->getSinPermiso();
        }
        $resultado = $this->servicio->restaurar($id_servicio);
        if ($resultado) {
            return redirect()->to(base_url() . 'servicio');
        } else {
            //mostrar mensaje de error
        }
    }

    //métodos para ajax
    public function getBuscarPorId($id_servicio)
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        $datos = $this->servicio->buscarPorId($id_servicio);
        
        $resultado['existe'] = false;
        $resultado['datos'] = '';
        $resultado['error'] = '';

        if ($datos) {
            $resultado['datos'] = $datos;
            $resultado['existe'] = true;
        } else {
            $resultado['error'] = 'No existe el servicio.';
            //$resultado['existe'] = false;
        }

        //para que trabaje el ajax correctamente, se convierte a json
        echo json_encode($resultado);
    }
}
