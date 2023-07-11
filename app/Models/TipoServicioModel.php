<?php

    namespace App\Models;

    use CodeIgniter\Model;

    class TipoServicioModel extends Model
    {

        protected $table      = 'TipoServicio';
        protected $primaryKey = 'id_tipoServicio';

        //id autoIncrement
        protected $useAutoIncrement = true;

        //como vamos a regresar las consultas, en este caso en un arreglo
        protected $returnType     = 'array';
        //utilizar eliminaciones de filas
        protected $useSoftDeletes = false;

        //ingresar el nombre de las columnas que estamos agregando, en este caso "unidades"
        protected $allowedFields = ['nombre', 'descripcion', 'estado'];

        // Dates
        //tipo de tiempo que utilizamos
        protected $useTimestamps = true;
        protected $dateFormat    = 'datetime';
        //si hay filas para crear, modificar, eliminar (guarda automaticamente la fecha al crear, eliminar o modificar, se necesita crear los campo fecha_alta, etc en la base de datos)
        protected $createdField  = 'fecha_ingreso';
        protected $updatedField  = 'fecha_edit';
        //protected $deletedField  = 'deleted_at'; (no se ocupará en este caso)

        // Validation
        protected $validationRules      = [];
        protected $validationMessages   = [];
        protected $skipValidation       = false;

        //metodos para obetener todos los registro de tipo servicio que esten activos
        public function mostrar(){
            $consulta = $this->where('estado', 1)->findAll();
            return $consulta;
        }

        public function mostrarId($id){
            return $this->where('id_tipoServicio', $id)->first();
        }

        //metodo para crear un nuevo registro en la BD
        public function crear($nombre, $descripcion){
            $consulta = $this->save(
                [
                    'nombre' => $nombre,
                    'descripcion' => $descripcion,
                    'estado' => 1
                ]
            );
            return $consulta;         
        }

        //metodo para editar un registro
        public function editar($id, $nombre, $descripcion){
            $resultado = $this->update($id, [
                                                'nombre' => $nombre,
                                                'descripcion' => $descripcion,
                                            ]
                                        );
            return $resultado;
        }

         //para redirigir a la vista de los inactivos
         public function mostrarEliminados(){
            $consulta =$this->where('estado', 0)->findAll();
            return $consulta;
        }

        //cambiar estado a activo
        public function restaurar($id){
            $consulta = $this->update($id, ['estado' => 1]);
            return $consulta;
        }

        //cambiar estado a inactivo
        public function eliminar($id){
            $consulta = $this->update($id, ['estado' => 0]);
            return $consulta;
        }
    }
