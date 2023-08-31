<?php 
    //espacio de nombre para la ruta del archivo
    namespace App\Models;
    use CodeIgniter\Model;

    class DetalleRolPermisoModel extends Model 
    {
        protected $table = 'detallerolpermiso';


        protected $returnType     = 'array';
        protected $useSoftDeletes = false;

        protected $allowedFields = ['id_rol', 'id_permiso'];

        protected $useTimestamps = true;
        protected $dateFormat    = 'datetime';
        protected $createdField  = '';
        protected $updatedField  = '';
        //protected $deletedField  = 'deleted_at'; (no se ocupará en este caso)

        // Validation
        protected $validationRules      = [];
        protected $validationMessages   = [];
        protected $skipValidation       = false;

        public function crear($id_rol, $id_permiso) {
            $resultado = false;
            $datosExiste = $this->existe($id_rol, $id_permiso);
            if (count($datosExiste) == 0) {
                $resultado = $this->save([
                    'id_rol' => $id_rol,
                    'id_permiso' => $id_permiso,
                ]);
            } 
            return $resultado;
        }

        //Función sin utilizar
        public function existe($id_rol, $id_permiso) {
            $this->where('id_rol', $id_rol);
            $this->where('id_permiso', $id_permiso);
            return $this->findAll();
        }

        public function eliminar($id_rol) {
            $this->where('id_rol', $id_rol);
            return $this->delete();
        }

        //retorna los detalles de los permisos de un rol
        public function permisosAsignados($id_rol) {
            return $this->where('id_rol', $id_rol)->findAll();
        }

        //Función que verifica si el rol tiene un permiso específico
        public function verificarPermiso($id_rol, $permiso, $id_submodulo) {
            $tieneAccesso = false;
            $this->select('*');
            $this->join('permiso', 'detallerolpermiso.id_permiso = permiso.id_permiso');
            $existe = $this->where(['id_rol' => $id_rol, 
                                    'permiso.nombre' => $permiso, 
                                    'permiso.id_submodulo' => $id_submodulo
                                    ])->first();

            if ($existe != null) {
                $tieneAccesso = true;
            }
            return $tieneAccesso;
        }

    }