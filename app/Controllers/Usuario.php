<?php
//ubicacion donde se encuentra el archivo
namespace App\Controllers;

//plantilla predefina para aminorar el trabajo
use App\Controllers\BaseController;
//indicar que vamos a utilizar el modelo UnidadesModel
use App\Models\UsuarioModel;
use App\Models\RecepcionistaModel;
//use App\Models\ClienteModel;
use App\Models\RolModel;

//para la vista administrador
use App\Models\HabitacionModel;
use App\Models\ServicioModel;
use App\Models\TipoServicioModel;
use App\Models\AccesoModel;

//el nombre de la clase debe llevar el mismo nombre del archivo
class Usuario extends BaseController
{
    protected $usuario;
    protected $recepcionista;
    protected $roles;
    protected $reglas;
    protected $reglasLogin;
    protected $reglasCambia;
    protected $acceso;
    protected $session;

    //para la vista administrador
    protected $habitacion;
    protected $servicio;
    protected $tiposervicio;

    public function __construct()
    {
        $this->usuario = new UsuarioModel();
        $this->recepcionista = new RecepcionistaModel();
        $this->roles = new RolModel();
        $this->session = Session();
        //para la vista administrador
        $this->habitacion = new HabitacionModel();
        $this->servicio = new ServicioModel();
        $this->tiposervicio = new TipoServicioModel();
        $this->acceso = new AccesoModel();

        helper(['form']); //para que no se pierdan los datos escritos en la vista

        //validaciones para insertar un registro de login(usuario)
        $this->reglas = [
            'usuario' => [
                'rules' => 'required|is_unique[usuario.usuario]',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.',
                    'is_unique' => 'El campo {field} debe ser unico.',
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.'
                ]
            ], // re_password = confirmar contraseña
            're_password' => [       /*se indica que debe ser igual al campos password */
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.',
                    'matches' => 'Las contraseñas no coinciden.'
                ]
            ],
            'id_recepcionista' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.'
                ]
            ],
            'id_rol' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.'
                ]
            ]
        ];

        //reglas para iniciar sesión
        $this->reglasLogin = [
            'usuario' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.'
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.'
                ]
            ]
        ];

        //reglas para cambiar contraseña
        $this->reglasCambia = [
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.'
                ]
            ],
            're_password' => [       /*se indica que debe ser igual al campos password */
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.',
                    'matches' => 'Las contraseñas no coinciden.'
                ]
            ]
        ];
    }

    public function getIndex()
    {
        $usuarios = $this->usuario->mostrar();
        $data = ['titulo' => 'Usuarios', 'usuarios' => $usuarios];
        echo view('templates/header');
        echo view('gestionarUsuario/mostrarUsuario', $data);
        echo view('templates/footer');
    }

    public function getCrear()
    {
        $recepcionistas = $this->recepcionista->mostrar();
        $roles = $this->roles->mostrar();
        $data = [
            'titulo' => 'Agregar Usuario',
            'recepcionistas' => $recepcionistas,
            'roles' => $roles,
            'validation' => $this->validator
        ];
        echo view('templates/header');
        echo view('gestionarUsuario/crearUsuario', $data);
        echo view('templates/footer');
    }

    public function postInsertar()
    {
        if ($this->request->getMethod() == "post"  &&  $this->validate($this->reglas)) {
            $pass = (string)$this->request->getPost('password');
            $hash = password_hash($pass, PASSWORD_DEFAULT);

            $this->usuario->crear(
                $this->request->getPost('usuario'),
                $this->request->getPost('password'),
                $this->request->getPost('id_recepcionista'),
                $this->request->getPost('id_cliente'),
                $this->request->getPost('id_rol'),
            );
            return redirect()->to(base_url() . 'usuario');
        } else {
            $this->getCrear();
        }
    }

    //corregir error cuando, se actualiza todo hasta el usuario
    public function getEditar($id_usuario)
    {
        $usuario = $this->usuario->mostrarId($id_usuario);
        $recepcionistas = $this->recepcionista->mostrar();
        $roles = $this->roles->mostrar();
        $data = [
            'titulo' => 'Editar Usuario',
            'usuario' => $usuario,
            'recepcionistas' => $recepcionistas,
            'roles' => $roles,
            'validation' => $this->validator
        ];
        echo view('templates/header');
        echo view('gestionarUsuario/editarUsuario', $data);
        echo view('templates/footer');
    }

    //actualizar el registro 
    public function postActualizar()
    {
        //para la validación
        if (
            $this->request->getMethod() == "post"
            &&  $this->validate($this->reglas)
        ) {

            $resultado = $this->usuario->editar(
                $this->request->getPost('id_usuario'),
                $this->request->getPost('usuario'),
                $this->request->getPost('password'),
                $this->request->getPost('id_recepcionista'),
                $this->request->getPost('id_cliente'),
                $this->request->getPost('id_rol')
            );
            return redirect()->to(base_url() . 'usuario');
        } else {
            $this->getEditar($this->request->getPost('id_usuario'));
        }
    }

    //mostrar eliminados
    public function getEliminados()
    {
        $usuarios = $this->usuario->mostrarEliminados();
        $data = [
            'titulo' => 'Usuarios eliminados',
            'usuarios' => $usuarios
        ];
        echo view('templates/header');
        echo view('gestionarUsuario/eliminarUsuario', $data);
        echo view('templates/footer');
    }

    //dar de baja al registro (cambiar estado a inactivo)
    public function getEliminar($id_usuario)
    {
        $this->usuario->eliminar($id_usuario);
        return redirect()->to(base_url() . 'usuario');
    }

    //restaurar el registro (estado = 1)
    public function getRestaurar($id_usuario)
    {
        $resultado = $this->usuario->restaurar($id_usuario);
        if ($resultado) {
            return redirect()->to(base_url() . 'usuario');
        } else {
            //mostrar mensaje de error
        }
    }

    //validar el inicio de sesión
    public function postValida()
    {
        if ($this->request->getMethod() == "post"  &&  $this->validate($this->reglasLogin)) {

            $usuario = $this->request->getPost('usuario');
            $password = (string)$this->request->getPost('password');
            $datosUsuario = $this->usuario->where('usuario', $usuario)->first();

            if ($datosUsuario != null) {
                //funcion que nos ayuda a hacer el cifrado
                //texto plano, texto cifrado (base de datos)
                if (password_verify($password, $datosUsuario['password'])) {
                    $datosSesion = [
                        'usuario' => $datosUsuario['usuario'],
                        //'rol' => $datosUsuario['usuario'],
                        'id_usuario' => $datosUsuario['id_usuario'],
                        'id_recepcionista' => $datosUsuario['id_recepcionista'],
                        'id_rol' => $datosUsuario['id_rol'],
                        'id_cliente' => $datosUsuario['id_cliente']
                    ];


                    $ip = $_SERVER['REMOTE_ADDR']; //ip
                    $detalles = $_SERVER['HTTP_USER_AGENT']; //detalles del navegador  

                    $evento = 'Inicio de sesión';
                    $this->acceso->crear(
                            $datosUsuario['id_usuario'], 
                            $evento, 
                            $ip, 
                            $detalles, 
                        );

                    //estableciendo una sesión
                    $session = session();
                    //le pasamos los datos de la sesión
                    $session->set($datosSesion);
                    //redirecionar a la vista principal
                    return redirect()->to(base_url() . 'administrador');
                } else {
                    $data['error'] = "Las contraseñas no coinciden.";
                    //$this->getLogin();
                    echo view('login', $data);
                }
            } else {
                $data['error'] = "El usuario no existe.";
                //$this->getLogin();
                echo view('login', $data);
            }
        } else {
            $data = ['validation' => $this->validator];
            echo view('login', $data);
        }
    }


    //cerrar sesión
    public function getLogout()
    {
        $session = session();

        $ip = $_SERVER['REMOTE_ADDR']; 
        $detalles = $_SERVER['HTTP_USER_AGENT']; 

        $evento = 'Cierre de sesión';
        $this->acceso->crear(
                $session->id_usuario, 
                $evento, 
                $ip, 
                $detalles, 
            );

        $session->destroy(); //Cerrar sesion;
        return redirect()->to(base_url());
    }

    public function getCambiaPassword()
    {
        $session = session();
        $usuario = $this->usuario->mostrarId($session->id_usuario);
        $data = ['titulo' => 'Cambiar Contraseña', 'usuario' => $usuario];
        echo view('templates/header');
        echo view('gestionarUsuario/cambiaPassword', $data);
        echo view('templates/footer');
    }

    //actualizar contraseña
    public function postActualizarPassword()
    {
        if ($this->request->getMethod() == "post"  &&  $this->validate($this->reglasCambia)) {

            $session = session();
            $idUsuario = $session->id_usuario;
            $pass = (string)$this->request->getPost('password');
            $hash = password_hash($pass, PASSWORD_DEFAULT);

            $this->usuario->update($idUsuario, ['password' => $hash]);
            //redirecionamiento
            $usuario = $this->usuario->mostrarId($session->id_usuario);

            $data = ['titulo' => 'Cambiar Contraseña', 'usuario' => $usuario, 'mensaje' => 'Contraseña Actualizada'];
            echo view('templates/header');
            echo view('gestionarUsuario/cambiaPassword', $data);
            echo view('templates/footer');
        } else {
            $session = session();
            $usuario = $this->usuario->mostrarId($session->id_usuario);
            $data = ['titulo' => 'Cambiar Contraseña', 'usuario' => $usuario, 'validation' => $this->validator];
            echo view('templates/header');
            echo view('gestionarUsuario/cambiaPassword', $data);
            echo view('templates/footer');
        }
    }

    public function getAdministrador()
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }

        $servicios = $this->servicio->mostrar();
        $datos = [
            'habitacion' => $this->habitacion->cantidadHabitaciones(),
            'habitacionDisponible' => $this->habitacion->cantidadHabitacionesDisponible(),
            'habitacionOcupada' => $this->habitacion->cantidadHabitacionesOcupada(),
            'habitacionMantenimiento' => $this->habitacion->cantidadHabitacionesMantenimiento(),
            'cantidadHospedaje' => $this->habitacion->cantidadHospedajeDia(),
            'cantidadServicio' => $this->habitacion->cantidadServicioDia()['cantidad_servicio'],
            'cantidadCliente' => $this->habitacion->cantidadClienteDia()['cantidad_cliente'],
            'servicios' => $servicios,
            'tipoServicios' => $this->tiposervicio->mostrar()
            
        ];

        echo view('templates/header');
        echo view('gestionarAdministrador/administrador', $datos);
        echo view('templates/footer');
    }
}


//10703 lineas de codigos hasta la fecha 12/08/2023
