<?php 
    //espacio de nombre para la ruta del archivo
    namespace App\Models;
    use CodeIgniter\Model;

    class ConfiguracionModel extends Model 
    {
        protected $table      = 'configuracion';
        protected $primaryKey = 'id_configuracion';

        //id autoIncrement
        protected $useAutoIncrement = true;

        //como vamos a regresar las consultas, en este caso en un arreglo
        protected $returnType     = 'array';
        //utilizar eliminaciones de filas
        protected $useSoftDeletes = false;
        protected $useSoftUpdates = false;
        protected $useSoftCreates = false;

        //ingresar el nombre de las columnas que estamos agregando, en este caso "unidades"
        protected $allowedFields = ['hotel_nombre', 
                                    'hotel_rfc',
                                    'hotel_telefono',
                                    'hotel_direccion',
                                    'hotel_email',
                                    'hotel_direccion',
                                    'leyenda_nota',
                                ];

        // Dates
        //tipo de tiempo que utilizamos
        protected $useTimestamps = true;
        protected $dateFormat    = 'datetime';
        //si hay filas para crear, modificar, eliminar (guarda automaticamente la fecha al crear, eliminar o modificar, se necesita crear los campo fecha_alta, etc en la base de datos)
        protected $createdField  = null;
        protected $updatedField  = null;
        //protected $deletedField  = 'deleted_at'; (no se ocupará en este caso)

        // Validation
        protected $validationRules      = [];
        protected $validationMessages   = [];
        protected $skipValidation       = false;


        //metodos

        public function mostrar() {
            return $this->select('*')->first();
        }

        public function actualizar (
            $id_configuracion, 
            $hotel_nombre, 
            $hotel_rfc, 
            $hotel_telefono, 
            $hotel_email, 
            $hotel_direccion, 
            $leyenda_nota
            ) {

                $this->update($id_configuracion, 
                [
                    'hotel_nombre' => $hotel_nombre,
                    'hotel_rfc' => $hotel_rfc,
                    'hotel_telefono' => $hotel_telefono,
                    'hotel_email' => $hotel_email,
                    'hotel_direccion' => $hotel_direccion,
                    'leyenda_nota' => $leyenda_nota,
                ]);

        }
    }
