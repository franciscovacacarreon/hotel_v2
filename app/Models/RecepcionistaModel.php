<?php
//espacio de nombre para la ruta del archivo
namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;

class RecepcionistaModel extends Model
{

    protected $table      = 'recepcionista';
    protected $primaryKey = 'id_recepcionista';

    //id autoIncrement
    protected $useAutoIncrement = true;

    //como vamos a regresar las consultas, en este caso en un arreglo
    protected $returnType     = 'array';
    //utilizar eliminaciones de filas
    protected $useSoftDeletes = false;

    //ingresar el nombre de las columnas que estamos agregando, en este caso "unidades"
    protected $allowedFields = [
        'nombre',
        'paterno',
        'materno',
        'telefono',
        'fecha_nacimiento',
        'sexo',
        'sueldo',
        'estado',
    ];

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


    //Métodos

    //mostrar recepcionista
    public function mostrar()
    {
        $recepcionistaConsulta = $this->where('estado', 1)->findAll();
        return $recepcionistaConsulta;
    }

    //mostrar recepcionista por id
    public function mostrarId($id_recepcionista)
    {
        return $this->where('id_recepcionista', $id_recepcionista)->first();
    }

    //Crear un recepcionista
    public function crear(
        $nombre,
        $paterno,
        $materno,
        $telefono,
        $fecha_nacimiento,
        $sexo,
        $sueldo
    ) {
        $resultado = $this->save(
            [
                'nombre' => $nombre,
                'paterno' => $paterno,
                'materno' => $materno,
                'telefono' => $telefono,
                'fecha_nacimiento' => $fecha_nacimiento,
                'sexo' => $sexo,
                'sueldo' => $sueldo,
                'estado' => 1
            ]
        );
        return $resultado;
    }

    //editar un recepcionista
    public function editar(
        $id_recepcionista, 
        $nombre, $paterno, 
        $materno, $telefono, 
        $fecha_nacimiento, 
        $sexo, 
        $sueldo)
    {
        $resultado = $this->update(
            $id_recepcionista,
            [
                'nombre' => $nombre,
                'paterno' => $paterno,
                'materno' => $materno,
                'telefono' => $telefono,
                'fecha_nacimiento' => $fecha_nacimiento,
                'sexo' => $sexo,
                'sueldo' => $sueldo
            ]
        );
        return $resultado;
    }


    //mostrar los inactivos
    public function mostrarEliminados()
    {
        $resultado = $this->where('estado', '0')->findAll();;
        return $resultado;
    }

    //cambiar estado a inactivo
    public function eliminar($id_recepcionista)
    {
        $resultado = $this->update($id_recepcionista, ['estado' => '0']);
        return $resultado;
    }

    //cambiar estado a activo
    public function restaurar($id_recepcionista)
    {
        $resultado = $this->update($id_recepcionista, ['estado' => '1']);
        return $resultado;
    }
}
