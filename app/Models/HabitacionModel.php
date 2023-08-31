<?php
//espacio de nombre para la ruta del archivo
namespace App\Models;

use App\Controllers\Categoria;
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
        $sql = "SELECT habitacion.*, 
                categoria.nombre as nombre_categoria, 
                categoria.precio
                FROM habitacion, categoria
                WHERE habitacion.id_categoria = categoria.id
                AND habitacion.estado = 1
                ORDER BY habitacion.nro_habitacion ASC";

        $query = $this->db->query($sql);
        $datosHabitacionCategoria = $query->getResultArray();
        return $datosHabitacionCategoria;
    }

    public function mostrarHabitacionesDisponibles()
    {
        $sql = "SELECT habitacion.*, 
                categoria.nombre as nombre_categoria,
                categoria.precio
                FROM habitacion, categoria
                WHERE habitacion.id_categoria = categoria.id
                AND habitacion.estado_habitacion = 'Disponible'
                AND habitacion.estado = 1";

        $query = $this->db->query($sql);
        $datosHabitacionCategoria = $query->getResultArray();
        return $datosHabitacionCategoria;
    }

    //mostrar habitación por id
    public function mostrarId($nro_habitacion)
    {

        $sql = "SELECT habitacion.*, 
                categoria.nombre as nombre_categoria, 
                categoria.precio
                FROM habitacion, categoria
                WHERE habitacion.id_categoria = categoria.id
                AND habitacion.nro_habitacion = $nro_habitacion
                AND habitacion.estado = 1";

        $query = $this->db->query($sql);
        $datosHabitacionCategoria = $query->getRowArray();
        return $datosHabitacionCategoria;

        // $this->select('habitacion.*', 'categoria.*');
        // $this->join('categoria', 'habitacion.id_categoria = categoria.id');
        // $where = "habitacion.nro_habitacion = $nro_habitacion
        //           AND  habitacion.estado = 1";
        // $this->where($where);
        // $habitaciones = $this->get()->getRow();
        // return $habitaciones;
    }

    //crear habitación
    public function crear(/*$numero_camas,*/$estado_habitacion, $id_categoria)
    {

        $resultado = $this->save(
            [
                // 'numero_camas' => $numero_camas,
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
        $resultado = false;
        //si no tiene hospedajes
        $sql = "SELECT habitacion.*
                FROM habitacion, detallehospedaje, notahospedaje
                WHERE detallehospedaje.id_notaHospedaje = notahospedaje.id_notaHospedaje
                AND detallehospedaje.nro_habitacion = habitacion.nro_habitacion
                AND notahospedaje.estado_hospedaje = 'En estadía'
                AND (habitacion.estado_habitacion = 'Ocupada' 
                or habitacion.estado_habitacion = 'Reservada')
                AND habitacion.nro_habitacion = $nro_habitacion";

        $query = $this->db->query($sql);
        $datosHabitacion = $query->getResultArray();

        if (count($datosHabitacion) == 0) {
           $sql2 = "SELECT *
                    FROM habitacion
                    WHERE estado_habitacion = 'Reservada'
                    AND nro_habitacion = $nro_habitacion";

            $query2 = $this->db->query($sql2);
            $datosHabitacionReserva = $query2->getResultArray();

            if (count($datosHabitacionReserva) == 0) {
                $resultado = $this->update($nro_habitacion, ['estado' => '0']);
            }
        }
        return $resultado;
    }

    //cambiar estado a activo
    public function restaurar($nro_habitacion)
    {
        $resultado = $this->update($nro_habitacion, ['estado' => '1']);
        return $resultado;
    }


    public function buscarPorId($nro_habitacion)
    {
        $sql = "SELECT habitacion.*, 
                categoria.nombre as nombre_categoria, 
                categoria.precio as precio,
                categoria.descripcion
                FROM habitacion, categoria
                WHERE habitacion.id_categoria = categoria.id
                AND habitacion.nro_habitacion = $nro_habitacion
                AND habitacion.estado = 1";

        $query = $this->db->query($sql);
        $datosHabitacionCategoria = $query->getRowArray(); //devolver el una fila
        return $datosHabitacionCategoria;
    }

    public function cambiarEstadoPorNroHabitacion($nro_habitacion){
        $this->update($nro_habitacion, ['estado_habitacion' => 'Ocupada']);
    }

    public function cambiarEstadoPorNroHabitacion2($nro_habitacion, $estado){
        $this->update($nro_habitacion, ['estado_habitacion' => $estado]);
    }

    //sin usar
    public function cambiarEstadoHabitacionPorHospedaje($id_notaHospedaje){  
        $this->join('detalleHospedaje', 'detalleHospedaje.nro_habitacion = habitacion.nro_habitacion');
        $this->join('notaHospedaje', 'detalleHospedaje.id_notaHospedaje = notaHospedaje.id_notaHospedaje');
        $this->set('habitacion.estado_habitacion', 'Ocupada');
        $this->where('notaHospedaje.id_notaHospedaje', $id_notaHospedaje);
        $this->update();
    }

    //consultas para la vista de administrador
    public function cantidadHabitaciones(){
        $sql = "SELECT COUNT(nro_habitacion) as cantidad_habitaciones
                FROM habitacion";

        $query = $this->db->query($sql);
        $datos = $query->getRowArray(); //devolver el una fila
        return $datos;
    }

    public function cantidadHabitacionesDisponible(){
        $sql = "SELECT COUNT(nro_habitacion) as cantidad_disponible
                FROM habitacion
                WHERE habitacion.estado_habitacion = 'Disponible'";

        $query = $this->db->query($sql);
        $datos = $query->getRowArray(); //devolver el una fila
        return $datos;
    }

    public function cantidadHabitacionesOcupada(){
        $sql = "SELECT COUNT(nro_habitacion) as cantidad_ocupada
                FROM habitacion
                WHERE habitacion.estado_habitacion = 'Ocupada'";

        $query = $this->db->query($sql);
        $datos = $query->getRowArray(); //devolver el una fila
        return $datos;
    }

    public function cantidadHabitacionesMantenimiento(){
        $sql = "SELECT COUNT(nro_habitacion) as cantidad_mantenimiento
                FROM habitacion
                WHERE habitacion.estado_habitacion = 'En mantenimiento'";

        $query = $this->db->query($sql);
        $datos = $query->getRowArray(); //devolver el una fila
        return $datos;
    }

    public function cantidadHospedajeDia(){
        $sql = "SELECT COUNT(id_notaHospedaje) as cantidad_hospedaje
                FROM notaHospedaje
                WHERE notaHospedaje.id_notaHospedaje = '" . date("Y-m-d") . "'";

        $query = $this->db->query($sql);
        $datos = $query->getRowArray(); //devolver el una fila
        return $datos;
    }

    public function cantidadServicioDia(){
        $sql = "SELECT COUNT(servicio.id_servicio) as cantidad_servicio
                FROM notaServicio, servicio, detalleServicio
                WHERE detalleServicio.id_notaServicio = notaServicio.id_notaServicio
                AND detalleServicio.id_servicio = servicio.id_servicio
                AND notaServicio.id_notaServicio = '" . date("Y-m-d") . "'";

        $query = $this->db->query($sql);
        $datos = $query->getRowArray(); //devolver el una fila
        return $datos;
    }

    public function cantidadClienteDia(){
        $fecha_actual = date("Y-m-d");
        $sql = "SELECT COUNT(id_cliente) as cantidad_cliente
                FROM cliente
                WHERE DATE_FORMAT(fecha_ingreso, '%Y-%m-%d') = '$fecha_actual'";

        $query = $this->db->query($sql);
        $datos = $query->getRowArray(); //devolver el una fila
        return $datos;
    }
    //fin consulta para vista administrador

    public function habitacionHospedajeOcupada(){
        $sql = "SELECT habitacion.*, 
                notahospedaje.fechaEntrada, 
                notahospedaje.fechaSalida, 
                notahospedaje.id_notaHospedaje,
                CONCAT(cliente.nombre, ' ', cliente.paterno) as nombre_cliente
                FROM habitacion, detallehospedaje, notahospedaje, cliente
                WHERE detallehospedaje.id_notaHospedaje = notahospedaje.id_notaHospedaje
                AND detallehospedaje.nro_habitacion = habitacion.nro_habitacion
                AND notahospedaje.id_cliente = cliente.id_cliente
                AND notahospedaje.estado_hospedaje = 'En Estadía'";

        $query = $this->db->query($sql);
        $datos = $query->getResultArray(); 
        return $datos;
    }

}
