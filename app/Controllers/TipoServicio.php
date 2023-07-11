<?php 
    namespace App\Controllers;
    use App\Controllers\BaseController;
    use App\Models\TipoServicioModel;

    Class TipoServicio extends BaseController {
        //tabla de la base de datos
        protected $tipoServicio;
        protected $reglas;

        public function __construct(){
            $this->tipoServicio = new TipoServicioModel();

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

        }

        //metodo para mostrar todos los TipoServicio
        public function getIndex(){
            $tipoServicio = $this->tipoServicio->mostrar();
            $data = ['titulo' => 'Tipo Servicio', 'datos' => $tipoServicio];
            echo view('templates/header');
            echo view('gestionarTipoServicio/mostrarTipoServicio', $data);
            echo view('templates/footer');
        }

        //metodo para redirigirnos a la vista para crear un tipoServicio
        public function getCrear(){
            $data = ['titulo' => 'Crear Tipo Servcio', 'validation' => $this->validator];
            echo view('templates/header');
            echo view('gestionarTipoServicio/crearTipoServicio', $data);
            echo view('templates/footer');
        }

        //metodo para guardar un nuevo regristro en la BD
        public function postInsertar(){
            //si se envia el metodo post y la validaciones son correctas
            if($this->request->getMethod()=="post" && $this->validate($this->reglas)){
                $this->tipoServicio->crear(
                                            $this->request->getPost('nombre'),
                                            $this->request->getPost('descripcion')
                );
                return redirect()->to(base_url().'tipoServicio');
            }else{
                $this->getCrear();
            }
        }

        //metodo para obtener el id del registro a editar y mandarnos a la vista para editar
        public function getEditar($id){
            $tipoServicio = $this->tipoServicio->mostrarId($id);
            $data = [
                'titulo' => 'Editar Tipo Servicio',
                'datos' => $tipoServicio,
                'validation' => $this->validator
            ];
            echo view('templates/header');
            echo view('gestionarTipoServicio/editarTipoServicio', $data);
            echo view('templates/footer');
        }

        //actualizar el registro 
        public function postActualizar() {
            
            //para la validación
            if ($this->request->getMethod() == "post"  &&  $this->validate($this->reglas)) { 
                    $consulta = $this->tipoServicio->editar(
                                                            $this->request->getPost('id'), 
                                                            $this->request->getPost('nombre'),
                                                            $this->request->getPost('descripcion'),
                    );
                        
                return redirect()->to(base_url().'tipoServicio');
            } else {

            }
        }

        //metodo para redirigirnos a la vista de las categorias dados de baja
        public function getEliminados(){
            $tipoServicio = $this->tipoServicio->mostrarEliminados();
            $data = [
                'titulo' => 'Tipo Servicio Eliminadas',
                'datos' => $tipoServicio,
            ];
            echo view('templates/header');
            echo view('gestionarTipoServicio/eliminarTipoServicio', $data);
            echo view('templates/footer');
        }

        //metodo para dar de baja a un registro
        public function getEliminar($id){
            $this->tipoServicio->eliminar($id);
            return redirect()->to(base_url().'tipoServicio');
        }

        public function getRestaurar($id){
            $this->tipoServicio->restaurar($id);
            return redirect()->to(base_url().'tipoServicio');
        }

    }