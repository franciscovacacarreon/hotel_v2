<?php
    namespace App\Controllers;
    use App\Controllers\BaseController;
    use App\Models\RecepcionistaModel;

    Class Recepcionista extends BaseController {
        //tabla de la base de datos
        protected $recepcionista;
        //reglas para las validaciones
        protected $reglas;

        public function __construct(){
            $this->recepcionista = new RecepcionistaModel();

            helper(['form']); // para poder usar la función set_value en la vista

            //validaciones
            $this->reglas = [
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
                'telefono' => [
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
                ],
                'sueldo' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'El campo {field} es obligatorio.'
                    ]
                ]
            ];

        }

        //metodo principal, mostrar recepcionistas
        public function getIndex(){
            $recepcionistaConsulta = $this->recepcionista->mostrar();
            $data = ['titulo' => 'Recepcionistas', 'recepcionistas' => $recepcionistaConsulta];
            echo view('templates/header');
            echo view('gestionarRecepcionista/mostrarRecepcionista', $data);
            echo view('templates/footer');
        }


        //muestra la vista para crear una recepcionista 
        public function getCrear() {
            $data = ['titulo' => 'Crear Recepcionista', 'validation' => $this->validator];
            echo view('templates/header');
            echo view('gestionarRecepcionista/crearRecepcionista', $data);
            echo view('templates/footer');

        }

        public function postInsertar() {
            //si se envia el método post y las valiciones son correctas
            if ($this->request->getMethod() == "post"  
                &&  $this->validate($this->reglas)) { 
                    $this->recepcionista->crear(
                                            $this->request->getPost('nombre'), 
                                            $this->request->getPost('paterno'),
                                            $this->request->getPost('materno'),  
                                            $this->request->getPost('telefono'),
                                            $this->request->getPost('fecha_nacimiento'),
                                            $this->request->getPost('sexo'),
                                            $this->request->getPost('sueldo'),                  
                                        );
            //si las validaciones no son válidas
            return redirect()->to(base_url().'recepcionista');
            } else {
                $this->getCrear();
            }
        }

        //consulta para obtener el registro a editar
        public function getEditar($id_recepcionista) {
            $recepcionistas = $this->recepcionista->mostrarId($id_recepcionista);
            $data = [
                        'titulo' => 'Editar recepcionista', 
                        'recepcionista' => $recepcionistas, 
                        'validation' => $this->validator
                    ];
            echo view('templates/header');
            echo view('gestionarRecepcionista/editarRecepcionista', $data);
            echo view('templates/footer');

        }

        //actualizar el registro 
        public function postActualizar() {
            
            //para la validación
            if ($this->request->getMethod() == "post"  
                &&  $this->validate($this->reglas)) { 
            
                    $resultado = $this->recepcionista->editar(
                                        $this->request->getPost('id_recepcionista'), 
                                        $this->request->getPost('nombre'), 
                                        $this->request->getPost('paterno'),
                                        $this->request->getPost('materno'),  
                                        $this->request->getPost('telefono'),
                                        $this->request->getPost('fecha_nacimiento'),
                                        $this->request->getPost('sexo'),
                                        $this->request->getPost('sueldo'), 
                            );
                        
                return redirect()->to(base_url().'recepcionista');
            } else {
                $this->getEditar($this->request->getPost('id_recepcionista'));
            }
        }

        //muestra las recepcionistas inactivas
        public function getEliminados() {
            $recepcionistas = $this->recepcionista->mostrarEliminados();
            $data = [
                        'titulo' => 'Recepcionistas eliminados', 
                        'recepcionistas' => $recepcionistas
                    ];
            echo view('templates/header');
            echo view('gestionarRecepcionista/eliminarRecepcionista', $data);
            echo view('templates/footer');
        }

        //dar de baja al registro (cambiar estado a inactivo)
        public function getEliminar($id_recepcionista) {
            //mejorar con un if
            $this->recepcionista->eliminar($id_recepcionista);
            return redirect()->to(base_url().'recepcionista');
        }

        public function getRestaurar($id_recepcionista){
            $resultado = $this->recepcionista->restaurar($id_recepcionista);
            if ($resultado) {
                return redirect()->to(base_url().'recepcionista');
            } else {
                //mostrar mensaje de error
            }
        }

    }
