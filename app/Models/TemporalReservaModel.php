<?php
//espacio de nombre para la ruta del archivo
namespace App\Models;

use CodeIgniter\Model;

class TemporalReservaModel extends Model
{

    protected $table      = 'temporalReserva';
    protected $primaryKey = 'id_temporalReserva';

    //id autoIncrement
    protected $useAutoIncrement = true;

    //como vamos a regresar las consultas, en este caso en un arreglo
    protected $returnType     = 'array';
    //utilizar eliminaciones de filas
    protected $useSoftDeletes = false;

    //ingresar el nombre de las columnas que estamos agregando, en este caso "unidades"
    protected $allowedFields = ['id_notaReserva', 
                                'nro_habitacion', 
                                'nombre_categoria', 
                                'fechaEntrada',
                                'fechaSalida', 
                                'precio',
                                'subtotal',
                                'cantidad_dias',
                                'id_cliente',
                                //'id_reserva',
                                'nombre',
                                'email',
                                'nroAdultos',
                                'nroNiños',
                                'nroAdultos',
                                'comentario',      
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
    public function porIdHabitacion_notaReserva($nro_habitacion, $id_notaReserva) {
        $this->select('*');
        $this->where('id_notaReserva', $id_notaReserva);
        $this->where('nro_habitacion', $nro_habitacion);
        $datos = $this->get()->getRow(); //resultado de consulta como objeto
        return $datos;
    }

    //actualizar datos de la tabla temporal
    public function actualizarHabitacion_notaReserva(
        $nro_habitacion, $id_notaReserva, $cantidad, $subtotal) {

            $this->set('cantidad', $cantidad);
            $this->set('subtotal', $subtotal);
            $this->where('nro_habitacion', $nro_habitacion);
            $this->where('id_notaReserva', $id_notaReserva);
            $this->update();
    }

    public function crear(
        $id_notaReserva,
        $nro_habitacion,
        $nombre_categoria, 
        $fechaEntrada,
        $precio,
        $subtotal,
        $fechaSalida,
        $cantidad_dias,
        $id_cliente,
        //$id_reserva
        // $nombre,
        // $email,
        // $nroAdultos,
        // $nroNiños,
        // $nroCuartos,
        // $comentario,
    ) {
        $this->save([
            'id_notaReserva' => $id_notaReserva,
            'nro_habitacion' => $nro_habitacion,
            'nombre_categoria' => $nombre_categoria,
            'fechaEntrada' => $fechaEntrada,
            'precio' => $precio,
            'subtotal' => $subtotal,
            'fechaSalida' => $fechaSalida,
            'cantidad_dias' => $cantidad_dias,
            'id_cliente' => $id_cliente,
            //'id_reserva' => $id_reserva,
            // 'nombre' => $nombre,
            // 'email' => $email,
            // 'nroAdultos' => $nroAdultos,
            // 'nroNiños' => $nroNiños,
            // 'nroCuartos' => $nroCuartos,
            // 'comentario' => $comentario,
        ]);
    }

    //retornar el registro segun el id_notaReserva
    public function porIdNotaReserva($id_notaReserva){
        $this->select('*');
        $this->where('id_notaReserva', $id_notaReserva);
        $datos = $this->findAll();
        return $datos;
    }

    //eliminar el registro segun el nro_habitacion y id_notaReserva
    public function eliminarHabitacion_notaReserva($nro_habitacion, $id_notaReserva){
        $this->where('nro_habitacion', $nro_habitacion);
        $this->where('id_notaReserva', $id_notaReserva);
        $this->delete(); //delete porque solo es una tabla temporal
    }

    //elimina el registro según la nota servicio
    public function eliminarReserva($id_notaReserva){
        $this->where('id_notaReserva', $id_notaReserva);
        $this->delete(); //porque es una tabla temporal
    }

}
