<?php 
    //espacio de nombre para la ruta del archivo
    namespace App\Models;
    use CodeIgniter\Model;

    class RolModel extends Model 
    {
        protected $table      = 'rol';
        protected $primaryKey = 'id_rol';

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

        public function mostrar() {
            return $this->where('estado', 1)->findAll();
        }

        public function crear($nombre, $descripcion, $estado = 1) {
            $resultado = $this->save([
                'nombre' => $nombre,
                'descripcion' => $descripcion,
                'estado' => $estado,
            ]);
            return $resultado;
        }

        public function editar($id_rol, $nombre, $descripcion) {
            $resultado = $this->update($id_rol, [
                'nombre' => $nombre,
                'descripcion' => $descripcion,
            ]);
            return $resultado;
        }

        public function mostrarId($id_rol, $id_modulo) {
            return $this->where('id_rol', $id_rol)->first();
        }

        public function mostrarDetalleRol($id_rol) {
            $this->select('rol.id_rol, 
                        permiso.id_permiso, 
                        permiso.nombre as nombre_permiso, 
                        tipopermiso.id_tipoPermiso, 
                        tipopermiso.nombre nombre_tipoPermiso, 
                        submodulo.id_submodulo, 
                        submodulo.nombre as nombre_submodulo, 
                        modulo.id_modulo,
                        modulo.nombre as nombre_modulo');
            $this->join('detallerolpermiso', 'detallerolpermiso.id_rol = rol.id_rol');
            $this->join('permiso', 'detallerolpermiso.id_permiso = permiso.id_permiso');
            $this->join('tipopermiso', 'permiso.id_tipoPermiso = tipopermiso.id_tipoPermiso');
            $this->join('submodulo', 'permiso.id_submodulo = submodulo.id_submodulo');
            $this->join('modulo', 'submodulo.id_submodulo = modulo.id_modulo');
            $resultado  = $this->where('rol.id_rol', $id_rol)->findAll();
            return $resultado;
        }

    }