<?php
//espacio de nombre para la ruta del archivo
namespace App\Models;

use CodeIgniter\Model;

class NotaHospedajeModel extends Model
{

    protected $table      = 'notaHospedaje';
    protected $primaryKey = 'id_notaHospedaje';

    //id autoIncrement
    protected $useAutoIncrement = true;

    //como vamos a regresar las consultas, en este caso en un arreglo
    protected $returnType     = 'array';
    //utilizar eliminaciones de filas
    protected $useSoftDeletes = false;

    //ingresar el nombre de las columnas que estamos agregando, en este caso "unidades"
    protected $allowedFields = [
        'fechaEntrada',
        'fechaSalida',
        'fechaRealiSalida',
        'cant_habitaciones',
        'monto_total',
        'estado_hospedaje',
        'estado',
        'id_reserva',
        'id_recepcionista',
        'id_cliente',
        'tipoPago'
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
    //mostrar notaServicio
    public function mostrar()
    {
        return $this->where('estado', 1)->findAll();
    }

    public function mostrarConCliente()
    {
        $sql = "SELECT notaHospedaje.*, 
                CONCAT(cliente.nombre, ' ', cliente.paterno) as nombre_cliente
                FROM notaHospedaje, cliente
                WHERE notaHospedaje.id_cliente = cliente.id_cliente
                ORDER BY notaHospedaje.id_notaHospedaje";

        $query = $this->db->query($sql);
        $datosHabitacionCategoria = $query->getResultArray(); //devolver el una fila
        return $datosHabitacionCategoria;
    }

    //si uso, borrar metodo
    public function mostrarNotaHospedaje($id_notaHospedaje)
    {

        $this->select('notaHospedaje.*', 'CONCAT(cliente.nombre, " ", cliente.paterno) as nombre_cliente');
        $this->join('cliente', 'cliente.id_cliente', '=', 'notaHospedaje.id_cliente');
        $datos = $this->where('id_notaHospedaje', $id_notaHospedaje)->first();
        return $datos;
    }

    //mostrar por id
    public function mostrarNotaHospedajeId($id_notaHospedaje)
    {
        $sql = "SELECT notaHospedaje.*, 
                CONCAT(cliente.nombre, ' ', cliente.paterno) as nombre_cliente
                FROM notaHospedaje, cliente
                WHERE notaHospedaje.id_cliente = cliente.id_cliente
                AND notaHospedaje.id_notaHospedaje = $id_notaHospedaje";

        $query = $this->db->query($sql);
        $datosHabitacionCategoria = $query->getRowArray(); //devolver el una fila
        return $datosHabitacionCategoria;
    }

    //insertar datos en la nota hospedaje y obtener el id insertado
    public function insertarNotaHospedaje(
        $id_notaHospedaje, //folio
        $fechaEntrada,
        $fechaSalida,
        $cant_habitaciones,
        $total,
        $estado_hospedaje,
        $id_cliente,
        $id_recepcionista,
        $id_reserva,
        $tipoPago
    ) {

        $data = [
            //'folio' => $id_notaHospedaje,
            'fechaEntrada' => $fechaEntrada,
            'fechaSalida' => $fechaSalida,
            'cant_habitaciones' => $cant_habitaciones,
            'monto_total' => $total,
            'estado_hospedaje' => $estado_hospedaje,
            'id_cliente' => $id_cliente,
            'id_recepcionista' => $id_recepcionista,
            'id_reserva' => $id_reserva,
            'tipoPago' => $tipoPago,
            'estado' => 1, //agregado
        ];


        $this->insert($data); //para obtener el id insertado recientemente
        $id_insertado = $this->getInsertID();
        return $id_insertado;
    }

    public function cantidadHabitaciones($id_notaHospedaje)
    {
        $sql = "SELECT COUNT(NotaHospedaje.id_nota) as cantidad_habitaciones
                FROM NotaHospedaje, DetalleHospedaje
                WHERE DetalleHospedaje.id_nota = NotaHospedaje.id_nota
                AND NotaHospedaje.id_nota = $id_notaHospedaje";
        $query = $this->db->query($sql);
        $resultado = $query->getRowArray();
        $cantidad = $resultado['cantidad_habitaciones'];
        return $cantidad;
    }

    //consulta para los reportes
    public function reporteHospedajeFecha($fecha_inicio, $fecha_fin)
    {
        $sql = "SELECT notahospedaje.*, 
                CONCAT(cliente.nombre, ' ', cliente.paterno) as nombre_cliente, 
                habitacion.nro_habitacion,
                categoria.nombre as nombre_categoria, 
                categoria.descripcion, 
                categoria.precio
                FROM notahospedaje, detallehospedaje, cliente, habitacion, categoria, recepcionista
                WHERE notahospedaje.id_cliente = cliente.id_cliente
                AND notahospedaje.id_recepcionista = recepcionista.id_recepcionista
                AND habitacion.id_categoria = categoria.id
                AND detallehospedaje.id_notaHospedaje = notahospedaje.id_notaHospedaje
                AND detallehospedaje.nro_habitacion = habitacion.nro_habitacion
                AND notahospedaje.fechaEntrada BETWEEN '$fecha_inicio' AND '$fecha_fin'";

        $query = $this->db->query($sql);
        $datos = $query->getResultArray();
        return $datos;
    }

    //consulta para los reportes
    public function reporteMontoHospedaje($fecha_inicio, $fecha_fin)
    {
        $sql = "SELECT SUM(notahospedaje.monto_total) as monto_hospedaje,
                COUNT(notahospedaje.id_notaHospedaje) as cantidad_hospedaje
                FROM notahospedaje, detallehospedaje, cliente, habitacion, categoria, recepcionista
                WHERE notahospedaje.id_cliente = cliente.id_cliente
                AND notahospedaje.id_recepcionista = recepcionista.id_recepcionista
                AND habitacion.id_categoria = categoria.id
                AND detallehospedaje.id_notaHospedaje = notahospedaje.id_notaHospedaje
                AND detallehospedaje.nro_habitacion = habitacion.nro_habitacion
                AND notahospedaje.fechaEntrada BETWEEN '$fecha_inicio' AND '$fecha_fin'";

        $query = $this->db->query($sql);
        $datos = $query->getRowArray();
        return $datos;
    }

    //finalizar hospedaje
    public function finalizarHospedaje($id_notaHospedaje, $estado_habitacion)
    {
        $fechaActual = date('Y-m-d');
        $sql = "UPDATE habitacion
                JOIN detallehospedaje ON detallehospedaje.nro_habitacion = habitacion.nro_habitacion
                JOIN notahospedaje ON detallehospedaje.id_notaHospedaje = notahospedaje.id_notaHospedaje
                SET habitacion.estado_habitacion = '$estado_habitacion',
                estado_hospedaje = 'Finalizado', notaHospedaje.fechaRealSalida = '$fechaActual'
                WHERE notahospedaje.id_notaHospedaje = $id_notaHospedaje;";

        $query = $this->db->query($sql);
        // $datos = $query->getRowArray();
        // return $datos;
    }
}
