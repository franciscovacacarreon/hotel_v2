<?php 
    namespace App\Models;
    use CodeIgniter\Model;

    class ModuloModel extends Model 
    {
        protected $table      = 'modulo';
        protected $primaryKey = 'id_modulo';

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
            $this->select('modulo.*, modulo.id_modulo as id');
            return $this->findAll();
        }

        //retornar modulo por nombre
        public function mostrarPorID($id_modulo) {
            $this->where('id_modulo', $id_modulo);
            return $this->first();
        }

    }