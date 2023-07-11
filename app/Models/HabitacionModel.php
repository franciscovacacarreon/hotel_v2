<?php
//espacio de nombre para la ruta del archivo
namespace App\Models;

use CodeIgniter\Model;

class HabitacionModel extends Model
{

    protected $table      = 'habitacion';
    protected $primaryKey = 'nro_habitacion';

    //id autoIncrement
    protected $useAutoIncrement = true;

    //como vamos a regresar las consultas, en este caso en un arreglo
    protected $returnType     = 'array';
    //utilizar eliminaciones de filas
    protected $useSoftDeletes = false;

    //ingresar el nombre de las columnas que estamos agregando, en este caso "unidades"
    protected $allowedFields = [
        'estado_habitacion',
        'numero_camas',
        'id_categoria',
        'estado'
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

    //mostrar habitación, con el nombre de la categoria
    public function mostrar()
    {
        $sql = "SELECT habitacion.*, categoria.nombre as nombre_categoria
                FROM habitacion, categoria
                WHERE habitacion.id_categoria = categoria.id
                AND habitacion.estado = 1";

        $query = $this->db->query($sql);
        $datosHabitacionCategoria = $query->getResultArray();
        return $datosHabitacionCategoria;
    }

    //mostrar habitación por id
    public function mostrarId($nro_habitacion)
    {
        return $this->where('nro_habitacion ', $nro_habitacion)->first();
    }

    //crear habitación
    public function crear($numero_camas, $estado_habitacion, $id_categoria)
    {

        //validaciones del lado de backend (debatir)
        $resultado = $this->save(
            [
                'numero_camas' => $numero_camas,
                'estado_habitacion' => $estado_habitacion,
                'id_categoria' => $id_categoria,
                'estado' => 1
            ]
        );
        return $resultado;
    }

    //editar habitación
    public function editar($nro_habitacion, $numero_camas, $estado_habitacion, $id_categoria)
    {
        $resultado = $this->update(
            $nro_habitacion,
            [
                'numero_camas' => $numero_camas,
                'estado_habitacion' => $estado_habitacion,
                'id_categoria' => $id_categoria
            ]
        );
        return $resultado;
    }



    //mostrar las habitaciones inactivas
    public function mostrarEliminados()
    {
        $sql = "SELECT habitacion.*, categoria.nombre as nombre_categoria
                FROM habitacion, categoria
                WHERE habitacion.id_categoria = categoria.id
                AND habitacion.estado = 0";

        $query = $this->db->query($sql);
        $datosHabitacionCategoria = $query->getResultArray();
        return $datosHabitacionCategoria;
    }


    //cambiar estado a inactivo
    public function eliminar($nro_habitacion)
    {
        $resultado = $this->update($nro_habitacion, ['estado' => '0']);
        return $resultado;
    }

    //cambiar estado a activo
    public function restaurar($nro_habitacion)
    {
        $resultado = $this->update($nro_habitacion, ['estado' => '1']);
        return $resultado;
    }
}
