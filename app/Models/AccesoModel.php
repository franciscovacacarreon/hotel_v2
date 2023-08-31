<?php 
    //espacio de nombre para la ruta del archivo
    namespace App\Models;
    use CodeIgniter\Model;

    class AccesoModel extends Model 
    {
        protected $table      = 'acceso';
        protected $primaryKey = 'id_acceso';

        //id autoIncrement
        protected $useAutoIncrement = true;

        //como vamos a regresar las consultas, en este caso en un arreglo
        protected $returnType     = 'array';
        //utilizar eliminaciones de filas
        protected $useSoftDeletes = false;

        //ingresar el nombre de las columnas que estamos agregando, en este caso "unidades"
        protected $allowedFields = ['id_usuario', 'evento', 'ip', 'detalle'];

        // Dates
        //tipo de tiempo que utilizamos
        protected $useTimestamps = true;
        protected $dateFormat    = 'datetime';
        //si hay filas para crear, modificar, eliminar (guarda automaticamente la fecha al crear, eliminar o modificar, se necesita crear los campo fecha_alta, etc en la base de datos)
        protected $createdField  = 'fecha';
        protected $updatedField  = '';
        //protected $deletedField  = 'deleted_at'; (no se ocupará en este caso)

        // Validation
        protected $validationRules      = [];
        protected $validationMessages   = [];
        protected $skipValidation       = false;

        public function crear ($id_usuario, $evento, $ip, $detalle) {
            $resultado = $this->save([
                'id_usuario' => $id_usuario,
                'evento' => $evento,
                'ip' => $ip,
                'detalle' => $detalle,
            ]);
            return $resultado;
        }
    }