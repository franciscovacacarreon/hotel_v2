<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TemporalHospedajeModel;
use App\Models\HabitacionModel;
use DateTime;

class TemporalHospedaje extends BaseController
{
    //tabla de la base de datos
    protected $temporal_hospedaje;
    protected $habitacion;
    protected $session;

    public function __construct()
    {
        $this->temporal_hospedaje = new TemporalHospedajeModel();
        $this->habitacion = new HabitacionModel();
        $this->session = Session();
    }

    //insertar datos en la tabla temporal
    //insertar datos en la tabla temporal
    public function getInsertar($nro_habitacion, $cantidad, $id_notaHospedaje, $id_cliente, $id_reserva)
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        $error = '';
        $habitacion = $this->habitacion->buscarPorId($nro_habitacion);

        if ($habitacion) {
            $datosExiste = $this->temporal_hospedaje->porIdHabitacion_notaHospedaje($nro_habitacion, $id_notaHospedaje);

            //si existe el servicio temporal
            if ($datosExiste) {
                //si existe la habitacion, mandamos un mensaje
                $error = 'La habitación ya fue agregada';


                /*$subtotal = $cantidad * $datosExiste->precio;
                $this->temporal_hospedaje->actualizarHabitacion_notaHospedaje($nro_habitacion, $id_notaHospedaje, $cantidad, $subtotal);*/
            } else {
                $subtotal = $cantidad * $habitacion['precio'];
                $this->temporal_hospedaje->crear(
                    $id_notaHospedaje,
                    $nro_habitacion,
                    $habitacion['nombre_categoria'],
                    '',
                    $habitacion['precio'],
                    $subtotal,
                    '',
                    $cantidad,
                    $id_cliente,
                    $id_reserva
                );
            }
        } else {
            $error = 'No existe la habitacion';
        }

        $res['datos'] = $this->cargarHospedaje($id_notaHospedaje);
        $res['total'] = $this->totalHospedaje($id_notaHospedaje);
        $res['error'] = $error;
        echo json_encode($res);
    }


    //Carga los servicios y retorna los datos en un string
    public function cargarHospedaje($id_notaHospedaje)
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        //obtener los datos de la compra temporal segun el id_notaHospedaje
        $resultado = $this->temporal_hospedaje->porIdNotaHospedaje($id_notaHospedaje);
        $fila = '';
        $numFila = 0;
        foreach ($resultado as $row) {
            $numFila++;
            $fila .= "<tr class='text-center' id='fila" . $numFila . "'>";
            $fila .= "<td>" . $numFila . "</td>";
            $fila .= "<td>" . $row['nro_habitacion'] . "</td>";
            $fila .= "<td>" . $row['nombre_categoria'] . "</td>";
            $fila .= "<td>" . $row['precio'] . "</td>";
            $fila .= "<td>" . $row['subtotal'] . "</td>";
            $fila .= "<td>" . $row['id_cliente'] . "</td>";
            $fila .= "<td>" . $row['id_reserva'] . "</td>";
            $fila .= "<td class='text-center'>" . $row['cantidad_dias'] . "</td>";
            $fila .= "<td> 
                            <a onclick=\"eliminarHabitacion(" . $row['nro_habitacion'] . ", '" . $id_notaHospedaje . "')\" class='borrar'>
                                <span class='fas fa-fw fa-trash' > </span>
                            </a> 
                         </td>";
            $fila .= "</tr>";
        }
        return $fila;
    }

    //Calcular el total
    public function totalHospedaje($id_notaHospedaje)
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        $resultado = $this->temporal_hospedaje->porIdNotaHospedaje($id_notaHospedaje);
        $total = 0;
        foreach ($resultado as $row) {
            $total += $row['subtotal'];
        }
        return $total;
    }

    public function rangoFechas($fecha1, $fecha2)
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        $datetime1 = new DateTime($fecha1);
        $datetime2 = new DateTime($fecha2);

        //diferencia entre las dos fechas
        $interval = $datetime1->diff($datetime2);
        //diferencia en dias
        $diferenciaEnDias = $interval->days;
        //cantidad de dias
        return $diferenciaEnDias;
    }

    public function getEliminar($nro_habitacion, $id_notaHospedaje)
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        $datosExiste = $this->temporal_hospedaje->porIdHabitacion_notaHospedaje($nro_habitacion, $id_notaHospedaje);

        if ($datosExiste) {
            $this->temporal_hospedaje->eliminarHabitacion_notaHospedaje($nro_habitacion, $id_notaHospedaje);
        }

        $res['datos'] = $this->cargarHospedaje($id_notaHospedaje);
        $res['total'] = $this->totalHospedaje($id_notaHospedaje);
        $res['error'] = '';
        echo json_encode($res);
    }
}
