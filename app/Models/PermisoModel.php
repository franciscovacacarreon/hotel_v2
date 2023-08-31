<?php 

    namespace App\Models;
    use CodeIgniter\Model;

    class PermisoModel extends Model 
    {
        protected $table      = 'permiso';
        protected $primaryKey = 'id_permiso';

        protected $useAutoIncrement = true;

        protected $returnType     = 'array';
        protected $useSoftDeletes = false;

        protected $allowedFields = ['nombre', 'id_tipoPermiso', 'id_submodulo'];

        protected $useTimestamps = true;
        protected $dateFormat    = 'datetime';
        protected $createdField  = '';
        protected $updatedField  = '';

        // Validation
        protected $validationRules      = [];
        protected $validationMessages   = [];
        protected $skipValidation       = false;

         //Métodos

        public function mostrar() {
            $this->select('permiso.*, submodulo.nombre as nombre_submodulo, tipoPermiso.nombre as nombre_tipoPermiso');
            $this->join('tipoPermiso', 'tipoPermiso.id_tipoPermiso = permiso.id_tipoPermiso');
            $this->join('submodulo', 'submodulo.id_submodulo = permiso.id_submodulo');
            return $this->findAll();
        }

        public function crear($nombre, $id_tipoPermiso, $id_submodulo) {
            $resultado = $this->save([
                'nombre' => $nombre,
                'id_tipoPermiso' => $id_tipoPermiso,
                'id_submodulo' => $id_submodulo,
            ]);
        }

        public function buscarPorTipo($tipo) {
            return $this->where('tipo', $tipo)->findAll();
        }

        public function mostrarId($id_permiso) {
            $this->select('permiso.*, submodulo.nombre as nombre_submodulo');
            $this->join('submodulo', 'submodulo.id_submodulo = permiso.id_submodulo');
            $this->where('id_permiso', $id_permiso);
            return $this->first();
        }

        public function editar($id_permiso, $nombre, $id_tipoPermiso, $id_submodulo) {
            $resultado = $this->update($id_permiso, [
                'nombre' => $nombre,
                'id_tipoPermiso' => $id_tipoPermiso,
                'id_submodulo' => $id_submodulo,
            ]);
            return $resultado;
        }

        public function editarNombre($id_permiso, $nombre) {
            $resultado = $this->update($id_permiso, [
                'nombre' => $nombre
            ]);
            return $resultado;
        }

        public function editarIDTipoPermiso($id_permiso, $id_tipoPermiso) {
            $resultado = $this->update($id_permiso, [
                'id_tipoPermiso' => $id_tipoPermiso
            ]);
            return $resultado;
        }

        public function editarIDSubmodulo($id_permiso, $id_submodulo) {
            $resultado = $this->update($id_permiso, [
                'id_submodulo' => $id_submodulo
            ]);
            return $resultado;
        }

    }