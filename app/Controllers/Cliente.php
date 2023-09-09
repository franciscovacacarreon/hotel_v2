<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ClienteModel;
use App\Models\DetalleRolPermisoModel;

class Cliente extends BaseController
{
    //tabla de la base de datos
    protected $cliente;
    protected $detalleRol;
    //reglas para las validaciones
    protected $reglas;
    protected $session;

    public function __construct()
    {
        $this->cliente = new ClienteModel();
        $this->detalleRol = new DetalleRolPermisoModel();
        $this->session = Session();

        helper(['form']); // para poder usar la función set_value en la vista

        //validaciones
        $this->reglas = [
            'ci' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.'
                ]
            ],
            'telefono' => [
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
            'paterno' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.'
                ]
            ],
            'materno' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.'
                ]
            ],
            'fecha_nacimiento' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.'
                ]
            ],
            'sexo' => [
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

    //metodo principal, mostrar clientes
    public function getIndex()
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        if (!$this->verficarPermiso('Clientes', 7)) {
            return $this->getSinPermiso();
        }

        $botonesClass = [
            'botonAgregar' => $this->verficarPermiso('Agregar', 7) == false ? 'visually-hidden-focusable' : '',
            'botonEliminados' => $this->verficarPermiso('Eliminados', 7) == false ? 'visually-hidden-focusable' : '',
            'botonEditar' => $this->verficarPermiso('Editar', 7) == false ? 'disabled-link' : 'btn btn-warning btn-sm',
            'botonEliminar' => $this->verficarPermiso('Eliminar', 7) == false ? 'disabled-link' : 'btn btn-danger btn-sm',
        ];
        $clienteConsulta = $this->cliente->mostrar();
        $data = ['titulo' => 'Clientes', 'clientes' => $clienteConsulta, 'botonesClass' => $botonesClass];
        echo view('templates/header');
        echo view('gestionarCliente/mostrarCliente', $data);
        echo view('templates/footer');
    }


    //muestra la vista para crear una cliente 
    public function getCrear()
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        if (!$this->verficarPermiso('Agregar', 7)  ||  !$this->verficarPermiso('Clientes', 7)) {
            return $this->getSinPermiso();
        }
        $data = ['titulo' => 'Crear Cliente', 'validation' => $this->validator];
        echo view('templates/header');
        echo view('gestionarCliente/crearCliente', $data);
        echo view('templates/footer');
    }

    public function postInsertar()
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        if (!$this->verficarPermiso('Agregar', 7)  ||  !$this->verficarPermiso('Clientes', 7)) {
            return $this->getSinPermiso();
        }
        //si se envia el método post y las valiciones son correctas
        if (
            $this->request->getMethod() == "post"
            &&  $this->validate($this->reglas)
        ) {
            $this->cliente->crear(
                $this->request->getPost('ci'),
                $this->request->getPost('telefono'),
                $this->request->getPost('nombre'),
                $this->request->getPost('paterno'),
                $this->request->getPost('materno'),
                $this->request->getPost('fecha_nacimiento'),
                $this->request->getPost('sexo'),
            );
            //si las validaciones no son válidas
            return redirect()->to(base_url() . 'cliente');
        } else {
            $this->getCrear();
        }
    }

    //consulta para obtener el registro a editar
    public function getEditar($id_cliente)
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        if (!$this->verficarPermiso('Editar', 7)  ||  !$this->verficarPermiso('Clientes', 7)) {
            return $this->getSinPermiso();
        }
        $clientes = $this->cliente->mostrarId($id_cliente);
        $data = [
            'titulo' => 'Editar Cliente',
            'cliente' => $clientes,
            'validation' => $this->validator
        ];
        echo view('templates/header');
        echo view('gestionarCliente/editarCliente', $data);
        echo view('templates/footer');
    }

    //actualizar el registro 
    public function postActualizar()
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        if (!$this->verficarPermiso('Editar', 7)  ||  !$this->verficarPermiso('Clientes', 7)) {
            return $this->getSinPermiso();
        }
        //para la validación
        if (
            $this->request->getMethod() == "post"
            &&  $this->validate($this->reglas)
        ) {

            $resultado = $this->cliente->editar(
                $this->request->getPost('id_cliente'),
                $this->request->getPost('ci'),
                $this->request->getPost('telefono'),
                $this->request->getPost('nombre'),
                $this->request->getPost('paterno'),
                $this->request->getPost('materno'),
                $this->request->getPost('fecha_nacimiento'),
                $this->request->getPost('sexo'),
            );

            return redirect()->to(base_url() . 'cliente');
        } else {
            $this->getEditar($this->request->getPost('id_cliente'));
        }
    }

    //muestra las clientes inactivos
    public function getEliminados()
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        if (!$this->verficarPermiso('Eliminados', 7)  ||  !$this->verficarPermiso('Clientes', 7)) {
            return $this->getSinPermiso();
        }
        $clientes = $this->cliente->mostrarEliminados();
        $data = [
            'titulo' => 'Clientes eliminados',
            'clientes' => $clientes
        ];
        echo view('templates/header');
        echo view('gestionarCliente/eliminarCliente', $data);
        echo view('templates/footer');
    }

    //dar de baja al registro (cambiar estado a inactivo)
    public function getEliminar($id_cliente)
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        if (!$this->verficarPermiso('Eliminar', 7)  ||  !$this->verficarPermiso('Clientes', 7)) {
            return $this->getSinPermiso();
        }
        $resultado = $this->cliente->eliminar($id_cliente);

        if (!$resultado) {
            $error = 'El cliente tiene registros asociados';
            $clienteConsulta = $this->cliente->mostrar();
            $data = ['titulo' => 'Clientes', 'error' => $error, 'clientes' => $clienteConsulta];
            echo view('templates/header');
            echo view('gestionarCliente/mostrarCliente', $data);
            echo view('templates/footer');
        } else {
            return redirect()->to(base_url() . 'cliente');
        }
    }

    public function getRestaurar($id_cliente)
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        if (!$this->verficarPermiso('Eliminados', 7)  ||  !$this->verficarPermiso('Clientes', 7)) {
            return $this->getSinPermiso();
        }
        $resultado = $this->cliente->restaurar($id_cliente);
        if ($resultado) {
            return redirect()->to(base_url() . 'cliente');
        } else {
            //mostrar mensaje de error
        }
    }

    //buscar por id
    public function getBuscarPorId($id_cliente)
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        $datos = $this->cliente->mostrarId($id_cliente);
        $resultado['existe'] = false;
        $resultado['data'] = '';
        $resultado['error'] = '';

        //verificar disponibilidad de habitacion
        if ($datos) {
            $resultado['data'] = $datos;
            $resultado['existe'] = true;
        } else {
            $resultado['error'] = 'Habitación no existe';
            //$resultado['existe'] = false;
        }

        //para que trabaje el ajax correctamente, se convierte a json
        echo json_encode($resultado);
    }
}
