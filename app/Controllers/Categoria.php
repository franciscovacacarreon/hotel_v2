<?php
    namespace App\Controllers;
    use App\Controllers\BaseController;
    use App\Models\CategoriaModel;

    Class Categoria extends BaseController {
        //tabla de la base de datos
        protected $categoria;
        //reglas para las validaciones
        protected $reglas;

        public function __construct(){
            $this->categoria = new CategoriaModel();

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
                ]
                ,
                'descripcion' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'El campo {field} es obligatorio.'
                    ]
                ]
            ];

        }

        //metodo principal, mostrar categorias
        public function getIndex(){
            $categoriaConsulta = $this->categoria->mostrar();
            $data = ['titulo' => 'Categoria', 'datos' => $categoriaConsulta];
            echo view('templates/header');
            echo view('gestionarCategoria/mostrarCategoria', $data);
            echo view('templates/footer');
        }


        //muestra la vista para crear una categoria 
        public function getCrear() {
            $data = ['titulo' => 'Crear Categoria', 'validation' => $this->validator];
            echo view('templates/header');
            echo view('gestionarCategoria/crearCategoria', $data);
            echo view('templates/footer');

        }

        public function postInsertar() {
            //si se envia el método post y las valiciones son correctas
            if ($this->request->getMethod() == "post"  
                &&  $this->validate($this->reglas)) { 
                    $this->categoria->crear(
                                            $this->request->getPost('precio'), 
                                            $this->request->getPost('nombre'),
                                            $this->request->getPost('descripcion'),     
                                                        
                                        );
            //si las validaciones no son válidas
            return redirect()->to(base_url().'categoria');
            } else {
                $this->getCrear();
            }
        }

        //consulta para obtener el registro a editar
        public function getEditar($id) {
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
        public function postActualizar() {
            
            //para la validación
            if ($this->request->getMethod() == "post"  
                &&  $this->validate($this->reglas)) { 
            
                    $resultado = $this->categoria->editar(
                                    $this->request->getPost('id'), 
                                    $this->request->getPost('precio'),
                                    $this->request->getPost('nombre'),
                                    $this->request->getPost('descripcion'),
                            );
                        
                return redirect()->to(base_url().'categoria');
            } else {

            }
        }

        //muestra las categorias inactivas
        public function getEliminados() {
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
        public function getEliminar($id) {
            //mejorar con un if
            $this->categoria->eliminar($id);
            return redirect()->to(base_url().'categoria');
        }

        public function getRestaurar($id){
            $resultado = $this->categoria->restaurar($id);
            if ($resultado) {
                return redirect()->to(base_url().'categoria');
            } else {
                //mostrar mensaje de error
            }
        }

    }
