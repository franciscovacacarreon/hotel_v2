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

//el nombre de la clase debe llevar el mismo nombre del archivo
class Usuario extends BaseController
{
    protected $usuario;
    protected $recepcionista;
    protected $roles;
    protected $reglas;
    protected $reglasLogin;
    protected $reglasCambia;

    public function __construct()
    {
        $this->usuario = new UsuarioModel();
        $this->recepcionista = new RecepcionistaModel();
        $this->roles = new RolModel();

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

                    //estableciendo una sesión
                    $session = session();
                    //le pasamos los datos de la sesión
                    $session->set($datosSesion);
                    //redirecionar a la vista principal
                    return redirect()->to(base_url() . 'habitacion');
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


    public function getLogout()
    {
        $session = session();
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

    public function postActualizarPassword()
    {

        if ($this->request->getMethod() == "post"  &&  $this->validate($this->reglasCambia)) {

            $session = session();
            $idUsuario = $session->id_usuario;
            $pass = (string)$this->request->getPost('password');
            $hash = password_hash($pass, PASSWORD_DEFAULT);

            $this->usuario->update($idUsuario, ['password' => $hash]);
            //redirecionamiento
            $usuario = $this->usuario->motrarId($session->id_usuario);

            $data = ['titulo' => 'Cambiar Contraseña', 'usuario' => $usuario, 'mensaje' => 'Contraseña Actualizada'];
            echo view('templates/header');
            echo view('usuarios/cambiaPassword', $data);
            echo view('templates/footer');
        } else {
            $session = session();
            $usuario = $this->usuario->motrarId($session->id_usuario);
            $data = ['titulo' => 'Cambiar Contraseña', 'usuario' => $usuario, 'validation' => $this->validator];
            echo view('templates/header');
            echo view('templates/usuarios/cambiaPassword', $data);
            echo view('templates/footer');
        }
    }
}
