<?php
    namespace App\Controllers;
    use App\Controllers\BaseController;
    use App\Models\HabitacionModel;
    use App\Models\CategoriaModel;

    Class Habitacion extends BaseController {
        //tabla de la base de datos
        protected $habitacion;
        //usamos el modelo categoria para obtener las categorias
        protected $categoria; 
        //reglas para las validaciones
        protected $reglas;

        public function __construct(){
            $this->habitacion = new HabitacionModel();
            $this->categoria = new CategoriaModel();

            //validaciones
            $this->reglas = [
                'numero_camas' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'El campo {field} es obligatorio.'
                    ]
                ],
                'id_categoria' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'El campo {field} es obligatorio.'
                    ]
                ]
            ];

        }

        //metodo principal, mostrar habitacioness
        public function getIndex(){
        $habitacionConsulta = $this->habitacion->mostrar();
        $data = ['titulo' => 'Habitaciones' , 'habitaciones' => $habitacionConsulta];
            echo view('templates/header');
        echo view('gestionarHabitacion/mostrarHabitacion', $data);
            echo view('templates/footer');
        }


        //muestra la vista para insertar una habitacion 
        public function getCrear() {
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

        public function postInsertar() {
            //si se envia el método post y las valiciones son correctas
            if ($this->request->getMethod() == "post"  
                &&  $this->validate($this->reglas)) { 
                    $this->habitacion->crear(
                                            $this->request->getPost('numero_camas'), 
                                            $this->request->getPost('estado_habitacion'),
                                            $this->request->getPost('id_categoria')
                                        );
            //si las validaciones no son válidas
            return redirect()->to(base_url().'habitacion');
            } else {
                $this->getCrear();
            }
        }

        //consulta para obtener el registro a editar
        public function getEditar($nro_habitacion) {
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
        public function postActualizar() {
            
            //para la validación
            if ($this->request->getMethod() == "post"  
                &&  $this->validate($this->reglas)) { 
            
                    $resultado = $this->habitacion->editar(
                                    $this->request->getPost('nro_habitacion'), 
                                    $this->request->getPost('numero_camas'),
                                    $this->request->getPost('estado_habitacion'),
                                    $this->request->getPost('id_categoria')
                            );
                return redirect()->to(base_url().'habitacion');
            } else {

            }
        }

        //muestra las habitaciones inactivas
        public function getEliminados() {
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
        public function getEliminar($nro_habitacion) {
            $this->habitacion->eliminar($nro_habitacion);
            return redirect()->to(base_url().'habitacion');
        }

        //restaurar el registro (estado = 1)
        public function getRestaurar($nro_habitacion){
            $resultado = $this->habitacion->restaurar($nro_habitacion);
            if ($resultado) {
                return redirect()->to(base_url().'habitacion');
            } else {
                //mostrar mensaje de error
            }
        }

    }
