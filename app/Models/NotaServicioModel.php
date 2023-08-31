<?php
//espacio de nombre para la ruta del archivo
namespace App\Models;

use CodeIgniter\Model;

class NotaServicioModel extends Model
{

    protected $table      = 'notaServicio';
    protected $primaryKey = 'id_notaServicio';

    //id autoIncrement
    protected $useAutoIncrement = true;

    //como vamos a regresar las consultas, en este caso en un arreglo
    protected $returnType     = 'array';
    //utilizar eliminaciones de filas
    protected $useSoftDeletes = false;

    //ingresar el nombre de las columnas que estamos agregando, en este caso "unidades"
    protected $allowedFields = ['monto_total', 
                                'estado', 
                                'id_notaHospedaje', 
                                'id_cliente', 
                                'id_recepcionista'];

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

    //insertar datos en la nota servicio
    public function insertaNotaServicio(
        $id_notaServicio, 
        $total, 
        $id_recepcionista, 
        $id_cliente, 
        $id_notaHospedaje) {
            
            $data = [
                'folio' => $id_notaServicio,
                'monto_total' => $total,
                'id_recepcionista' => $id_recepcionista,
                'id_cliente' => $id_cliente,
                'id_notaHospedaje' => $id_notaHospedaje,
            ];

            $this->insert($data); //para obtener el id insertado recientemente
            $id_insertado = $this->getInsertID();
            return $id_insertado;
    }

    public function mostrarNotaServicioId($id_notaServicio){
        return $this->where('id_notaServicio', $id_notaServicio)->first();
    }

    //cosulta para el pdf
    public function mostrarDetalleNotaServicio($id_notaServicio) {
        $sql = "SELECT notaservicio.id_notaServicio, 
        notaservicio.monto_total, 
        notaservicio.fecha_ingreso as fecha_ingreso_notaServicio, 
        notaservicio.estado as estado_notaServicio, 
        notaservicio.id_recepcionista,
        notaservicio.id_notaHospedaje,
        CONCAT(recepcionista.nombre, ' ', recepcionista.paterno) as nombre_recepcionista,
        detalleservicio.id_notaServicio as id_notaServicio_detalleServicio, 
        detalleservicio.id_servicio as id_servicio_detalleServicio,
        detalleservicio.cantidad_servicio, 
        detalleservicio.sub_monto, 
        servicio.id_servicio, 
        servicio.nombre as nombre_servicio,
        servicio.precio as precio_servicio,
        servicio.descripcion as descripcion_servicio,
        cliente.id_cliente,
        CONCAT(cliente.nombre, ' ', cliente.paterno) as nombre_cliente
        FROM cliente, notaservicio, servicio, detalleservicio, recepcionista
        WHERE detalleservicio.id_notaServicio = notaservicio.id_notaServicio
        AND detalleservicio.id_servicio = servicio.id_servicio
        AND notaservicio.id_recepcionista = recepcionista.id_recepcionista
        AND notaservicio.id_cliente = cliente.id_cliente 
        AND notaservicio.id_notaservicio = $id_notaServicio";
        $query = $this->db->query($sql);
        $datosDetalleNotaServicio = $query->getResultArray();
        return $datosDetalleNotaServicio;
    }
}
