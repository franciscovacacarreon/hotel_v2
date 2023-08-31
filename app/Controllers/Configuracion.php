<?php 
    //ubicacion donde se encuentra el archivo
    namespace App\Controllers;

    //plantilla predefina para aminorar el trabajo
    use App\Controllers\BaseController; 
    //indicar que vamos a utilizar el modelo UnidadesModel
    use App\Models\ConfiguracionModel;

    //el nombre de la clase debe llevar el mismo nombre del archivo
    class Configuracion extends BaseController 
    {
        protected $configuracion;
        protected $reglas;
        protected $session;

        //relación entre controlador y modelo
        public function __construct()
        {
            //validaciones, cpmpletar
            $this->configuracion = new ConfiguracionModel();
            $this->session = Session();
            helper(['form']);

            $this->reglas = [
                'hotel_nombre' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'El campo {field} es obligatorio.'
                    ]
                ],
                'hotel_rfc' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'El campo {field} es obligatorio.'
                    ]
                ]
            ]; 

        }
        
        public function getIndex($activo = 1) 
        {
            if (!isset($this->session->id_usuario)) {
                return redirect()->to(base_url());
            }
            $configuracion = $this->configuracion->mostrar();
            $data = ['titulo' => 'Configuracion', 
                    'id_configuracion' => $configuracion['id_configuracion'],
                    'nombre' => $configuracion['hotel_nombre'], 
                    'rfc' => $configuracion['hotel_rfc'], 
                    'telefono' => $configuracion['hotel_telefono'], 
                    'email' => $configuracion['hotel_email'], 
                    'direccion' => $configuracion['hotel_direccion'], 
                    'leyenda' => $configuracion['leyenda_nota']
                ];     
            echo view('templates/header');
            echo view('gestionarConfiguracion/mostrarConfiguracion', $data);
            echo view('templates/footer');
        }

        public function postActualizar() 
        {   
            if (!isset($this->session->id_usuario)) {
                return redirect()->to(base_url());
            }
            //guarda en la base de datos con el metodo save
            //request, getPost(recibe las etiquetas del html (input))
                                //update recibe el id para buscar el registro y actualizarlo
            
            if ($this->request->getMethod() == "post"  &&  $this->validate($this->reglas)) {
                $this->configuracion->actualizar(
                    $this->request->getPost('id_configuracion'),
                    $this->request->getPost('hotel_nombre'),
                    $this->request->getPost('hotel_rfc'),
                    $this->request->getPost('hotel_telefono'),
                    $this->request->getPost('hotel_email'),
                    $this->request->getPost('hotel_direccion'),
                    $this->request->getPost('leyenda_nota'),
                );

                return redirect()->to(base_url().'configuracion');
            } else {
                //return $this->getEditar($this->request->getPost('id'), $this->validator); 
            }
        }
    }
