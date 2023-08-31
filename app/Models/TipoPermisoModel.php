<?php 

    namespace App\Models;
    use CodeIgniter\Model;

    class TipoPermisoModel extends Model 
    {
        protected $table      = 'tipoPermiso';
        protected $primaryKey = 'id_tipoPermiso';

        protected $useAutoIncrement = true;

        protected $returnType     = 'array';
        protected $useSoftDeletes = false;

        protected $allowedFields = ['nombre'];

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
            $this->select('tipoPermiso.*, tipoPermiso.id_tipoPermiso as id');
            return $this->findAll();
        }
    }