<?php
//espacio de nombre para la ruta del archivo
namespace App\Models;

use CodeIgniter\Model;

class ReservaModel extends Model
{

    protected $table      = 'reserva';
    protected $primaryKey = 'id_notaReserva';

    //id autoIncrement
    protected $useAutoIncrement = true;

    //como vamos a regresar las consultas, en este caso en un arreglo
    protected $returnType     = 'array';
    //utilizar eliminaciones de filas
    protected $useSoftDeletes = false;

    //ingresar el nombre de las columnas que estamos agregando, en este caso "unidades"
    protected $allowedFields = ['estado_reserva', 
                                'fechaEntrada', 
                                'fechaSalida', 
                                'fecha_caducidad', 
                                'estadia',
                                'cant_habitaciones', 
                                'monto_total', 
                                'estado', 
                                'id_cliente',
                                'id_recepcionista',
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


    //métodos 
    //mostrar notaservicio
    public function mostrar()
    {
        return $this->where('estado', 1)->findAll();
    }

    public function mostrarConCliente(){
        $sql = "SELECT reserva.*, 
                CONCAT(cliente.nombre, ' ', cliente.paterno) as nombre_cliente
                FROM reserva, cliente
                WHERE reserva.id_cliente = cliente.id_cliente";

        $query = $this->db->query($sql);
        $datosHabitacionCategoria = $query->getResultArray(); //devolver el una fila
        return $datosHabitacionCategoria;
    }

    //si uso, borrar metodo
    public function mostrarNotaReserva($id_notaReserva){

        $this->select('reserva.*', 'CONCAT(cliente.nombre, " ", cliente.paterno) as nombre_cliente');
        $this->join('cliente', 'cliente.id_cliente', '=', 'reserva.id_cliente');
        $datos = $this->where('id_notaReserva', $id_notaReserva)->first();
        return $datos;
    }

    //mostrar por id
    public function mostrarNotaReservaId($id_notaReserva){
        $sql = "SELECT reserva.*, 
                CONCAT(cliente.nombre, ' ', cliente.paterno) as nombre_cliente
                FROM reserva, cliente
                WHERE reserva.id_cliente = cliente.id_cliente
                AND reserva.id_notaReserva = $id_notaReserva";

        $query = $this->db->query($sql);
        $datos = $query->getRowArray(); //devolver el una fila
        return $datos;
    }

    //insertar datos en la nota reserva y obtener el id insertado
    public function insertarNotaReserva(
        $id_notaReserva, //folio
        $estado_reserva,
        $fechaEntrada, 
        $fechaSalida, 
        $fecha_caducidad, 
        $estadia, 
        $cant_habitaciones,
        $monto_total,
        $estado,
        $id_cliente,
        $id_recepcionista
        ) {
            
            $data = [
                //'folio' => $id_notaReserva,
                'estado_reserva' => $estado_reserva,
                'fechaEntrada' => $fechaEntrada,
                'fechaSalida' => $fechaSalida,
                'fecha_caducidad' => $fecha_caducidad,
                'estadia' => $estadia,
                'cant_habitaciones' => $cant_habitaciones,
                'monto_total' => $monto_total,
                'estado' => $estado,
                'id_cliente' => $id_cliente,
                'id_recepcionista' => $id_recepcionista,
            ];


            $this->insert($data); //para obtener el id insertado recientemente
            $id_insertado = $this->getInsertID();
            return $id_insertado;
    }

    public function cantidadHabitaciones($id_notaReserva){
        $sql = "SELECT COUNT(reserva.id_notaReserva) as cantidad_habitaciones
                FROM reserva, DetalleReserva
                WHERE DetalleReserva.id_notaReserva = reserva.id_notaReserva
                AND reserva.id_notaReserva = $id_notaReserva";
        $query = $this->db->query($sql);
        $resultado = $query->getRowArray();
        $cantidad = $resultado['cant_habitaciones'];
        return $cantidad;
    }

    //consulta para los reportes
    public function reporteReservaFecha($fecha_inicio, $fecha_fin){
        $sql = "SELECT reserva.*, 
                CONCAT(cliente.nombre, ' ', cliente.paterno) as nombre_cliente, 
                habitacion.nro_habitacion,
                categoria.nombre as nombre_categoria, 
                categoria.descripcion, 
                categoria.precio
                FROM reserva, detallereserva, cliente, habitacion, categoria, recepcionista
                WHERE reserva.id_cliente = cliente.id_cliente
                AND reserva.id_recepcionista = recepcionista.id_recepcionista
                AND habitacion.id_categoria = categoria.id
                AND detallereserva.id_notaReserva = reserva.id_notaReserva
                AND detallereserva.nro_habitacion = habitacion.nro_habitacion
                AND reserva.fechaEntrada BETWEEN '$fecha_inicio' AND '$fecha_fin'";

        $query = $this->db->query($sql);
        $datos = $query->getResultArray();
        return $datos;
    }

    //consulta para los reportes
    public function reporteMontoHospedaje($fecha_inicio, $fecha_fin){
        $sql = "SELECT SUM(reserva.monto_total) as monto_reserva,
                COUNT(reserva.id_notaReserva) as cantidad_reserva
                FROM reserva, detallereserva, cliente, habitacion, categoria, recepcionista
                WHERE reserva.id_cliente = cliente.id_cliente
                AND reserva.id_recepcionista = recepcionista.id_recepcionista
                AND habitacion.id_categoria = categoria.id
                AND detallereserva.id_notaReserva = reserva.id_notaReserva
                AND detallereserva.nro_habitacion = habitacion.nro_habitacion
                AND reserva.fechaEntrada BETWEEN '$fecha_inicio' AND '$fecha_fin'";

        $query = $this->db->query($sql);
        $datos = $query->getRowArray();
        return $datos;
    }

}
