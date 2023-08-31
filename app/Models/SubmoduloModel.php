<?php

namespace App\Models;

use CodeIgniter\Model;

class SubmoduloModel extends Model
{
    protected $table      = 'submodulo';
    protected $primaryKey = 'id_submodulo';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['nombre', 'id_modulo'];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = '';
    protected $updatedField  = '';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;

    //Métodos
    public function mostrar()
    {
        $this->select('submodulo.*, submodulo.id_submodulo as id');
        return $this->findAll();
    }

    //retornar submodulo por nombre
    public function mostrarPorID($id_submodulo)
    {
        $this->where('id_submodulo', $id_submodulo);
        return $this->first();
    }

    public function crear($nombre, $id_modulo)
    {
        $resultado = $this->save(
            [
                'nombre' => $nombre,
                'id_modulo' => $id_modulo,
                'estado' => 1
            ]
        );
        return $resultado;
    }

    public function editar($id_submodulo, $nombre, $id_modulo)
    {
        $resultado = $this->update($id_submodulo, [
            'nombre' => $nombre,
            'id_modulo' => $id_modulo,
        ]);
        return $resultado;
    }

    public function mostrarEliminados()
    {
        $resultado = $this->where('estado', '0')->findAll();;
        return $resultado;
    }
}
