<?php
//espacio de nombre para la ruta del archivo
namespace App\Models;

use CodeIgniter\Model;

class TemporalHospedajeModel extends Model
{

    protected $table      = 'temporalHospedaje';
    protected $primaryKey = 'id_temporalHospedaje';

    //id autoIncrement
    protected $useAutoIncrement = true;

    //como vamos a regresar las consultas, en este caso en un arreglo
    protected $returnType     = 'array';
    //utilizar eliminaciones de filas
    protected $useSoftDeletes = false;

    //ingresar el nombre de las columnas que estamos agregando, en este caso "unidades"
    protected $allowedFields = ['id_notaHospedaje', 
                                'nro_habitacion', 
                                'nombre_categoria', 
                                'fechaEntrada',
                                'fechaSalida', 
                                'precio',
                                'subtotal',
                                'cantidad_dias',
                                'id_cliente',
                                'id_reserva',
                            ];

    // Dates
    //tipo de tiempo que utilizamos
    protected $useTimestamps = false;

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;


    //métodos 

    //consulta para mostrar si ya existe un hospedaje temporal 
    public function porIdHabitacion_notaHospedaje($nro_habitacion, $id_notaHospedaje) {
        $this->select('*');
        $this->where('id_notaHospedaje', $id_notaHospedaje);
        $this->where('nro_habitacion', $nro_habitacion);
        $datos = $this->get()->getRow(); //resultado de consulta como objeto
        return $datos;
    }

    //actualizar datos de la tabla temporal
    public function actualizarHabitacion_notaHospedaje(
        $nro_habitacion, $id_notaHospedaje, $cantidad, $subtotal) {

            $this->set('cantidad', $cantidad);
            $this->set('subtotal', $subtotal);
            $this->where('nro_habitacion', $nro_habitacion);
            $this->where('id_notaHospedaje', $id_notaHospedaje);
            $this->update();
    }

    public function crear(
        $id_notaHospedaje,
        $nro_habitacion,
        $nombre_categoria, 
        $fechaEntrada,
        $precio,
        $subtotal,
        $fechaSalida,
        $cantidad_dias,
        $id_cliente,
        $id_reserva
    ) {
        $this->save([
            'id_notaHospedaje' => $id_notaHospedaje,
            'nro_habitacion' => $nro_habitacion,
            'nombre_categoria' => $nombre_categoria,
            'fechaEntrada' => $fechaEntrada,
            'precio' => $precio,
            'subtotal' => $subtotal,
            'fechaSalida' => $fechaSalida,
            'cantidad_dias' => $cantidad_dias,
            'id_cliente' => $id_cliente,
            'id_reserva' => $id_reserva,
        ]);
    }

    //retornar el registro segun el id_notaHospedaje
    public function porIdNotaHospedaje($id_notaHospedaje){
        $this->select('*');
        $this->where('id_notaHospedaje', $id_notaHospedaje);
        $datos = $this->findAll();
        return $datos;
    }

    //eliminar el registro segun el nro_habitacion y id_notaHospedaje
    public function eliminarHabitacion_notaHospedaje($nro_habitacion, $id_notaHospedaje){
        $this->where('nro_habitacion', $nro_habitacion);
        $this->where('id_notaHospedaje', $id_notaHospedaje);
        $this->delete(); //delete porque solo es una tabla temporal
    }

    //elimina el registro según la nota servicio
    public function eliminarNotaHospedaje($id_notaHospedaje){
        $this->where('id_notaHospedaje', $id_notaHospedaje);
        $this->delete(); //porque es una tabla temporal
    }

}
