<?php
//espacio de nombre para la ruta del archivo
namespace App\Models;

use CodeIgniter\Model;

class ServicioModel extends Model
{

    protected $table      = 'servicio';
    protected $primaryKey = 'id_servicio';

    //id autoIncrement
    protected $useAutoIncrement = true;

    //como vamos a regresar las consultas, en este caso en un arreglo
    protected $returnType     = 'array';
    //utilizar eliminaciones de filas
    protected $useSoftDeletes = false;

    //ingresar el nombre de las columnas que estamos agregando, en este caso "unidades"
    protected $allowedFields = ['nombre', 'precio', 'descripcion', 'estado', 'id_tipoServicio'];

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


    //métodos 
    //mostrar servicio
    public function mostrar()
    {
        $sql = "SELECT servicio.*, tipoServicio.nombre as nombre_tipoServicio
                FROM servicio, tipoServicio
                WHERE servicio.id_tipoServicio = tipoServicio.id_tipoServicio
                AND servicio.estado = 1";

        $query = $this->db->query($sql);
        $datosHabitacionCategoria = $query->getResultArray();
        return $datosHabitacionCategoria;
    }

    //mostrar servicio por id
    public function mostrarId($id_servicio)
    {
        //Corregir, mostrar solo los servicios activos
        return $this->where('id_servicio ', $id_servicio)->first();
    }

    public function buscarPorId($id_servicio)
    {
        $resultado = $this->select('*')
            ->where('id_servicio', $id_servicio)
            ->where('estado', 1)
            ->get()->getRow();

        return $resultado;
    }

    //crear servicio
    public function crear($nombre, $precio, $descripcion, $id_tipoServicio)
    {

        //validaciones del lado de backend (debatir)
        $resultado = $this->save(
            [
                'nombre' => $nombre,
                'precio' => $precio,
                'descripcion' => $descripcion,
                'id_tipoServicio' => $id_tipoServicio,
                'estado' => 1
            ]
        );
        return $resultado;
    }

    //editar servicio
    public function editar($id_servicio, $nombre, $precio, $descripcion, $id_tipoServicio)
    {
        $resultado = $this->update(
            $id_servicio,
            [
                'nombre' => $nombre,
                'precio' => $precio,
                'descripcion' => $descripcion,
                'id_tipoServicio' => $id_tipoServicio
            ]
        );
        return $resultado;
    }



    //mostrar las habitaciones inactivas
    public function mostrarEliminados()
    {
        $sql = "SELECT servicio.*, tipoServicio.nombre as nombre_tipoServicio
                FROM servicio, tipoServicio
                WHERE servicio.id_tipoServicio = tipoServicio.id_tipoServicio
                AND servicio.estado = 0";

        $query = $this->db->query($sql);
        $datosHabitacionCategoria = $query->getResultArray();
        return $datosHabitacionCategoria;
    }


    //cambiar estado a inactivo
    public function eliminar($id_servicio)
    {
        $resultado = false;

        $sql = "SELECT servicio.*
                FROM notaservicio, servicio, detalleservicio
                WHERE detalleservicio.id_notaServicio = notaservicio.id_notaServicio
                AND detalleservicio.id_servicio = servicio.id_servicio
                AND DATE(notaservicio.fecha_ingreso) = DATE(NOW())
                AND servicio.id_servicio = $id_servicio;";

        $query = $this->db->query($sql);
        $datos = $query->getResultArray();
        if (count($datos) == 0) {
            $resultado = $this->update($id_servicio, ['estado' => '0']);
        }
        return $resultado;
    }

    //cambiar estado a activo
    public function restaurar($id_servicio)
    {
        $resultado = $this->update($id_servicio, ['estado' => '1']);
        return $resultado;
    }
}
