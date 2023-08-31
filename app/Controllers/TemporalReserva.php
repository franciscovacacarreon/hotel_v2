<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TemporalReservaModel;
use App\Models\HabitacionModel;
use DateTime;

class TemporalReserva extends BaseController
{
    //tabla de la base de datos
    protected $temporal_reserva;
    protected $habitacion;
    protected $session;

    public function __construct()
    {
        $this->temporal_reserva = new TemporalReservaModel();
        $this->habitacion = new HabitacionModel();
        $this->session = Session();
    }

    //insertar datos en la tabla temporal
    //insertar datos en la tabla temporal
    public function getInsertar($nro_habitacion, $cantidad, $id_notaReserva, $id_cliente, $id_reserva)
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        $error = '';
        $habitacion = $this->habitacion->buscarPorId($nro_habitacion);

        if ($habitacion) {
            $datosExiste = $this->temporal_reserva->porIdHabitacion_notaReserva($nro_habitacion, $id_notaReserva);

            //si existe el servicio temporal
            if ($datosExiste) {
                //si existe la habitacion, mandamos un mensaje
                $error = 'La habitación ya fue agregada';


                /*$subtotal = $cantidad * $datosExiste->precio;
                $this->temporal_reserva->actualizarHabitacion_notaHospedaje($nro_habitacion, $id_notaReserva, $cantidad, $subtotal);*/
            } else {
                $subtotal = $cantidad * $habitacion['precio'];
                $this->temporal_reserva->crear(
                    $id_notaReserva,
                    $nro_habitacion,
                    $habitacion['nombre_categoria'],
                    '',
                    $habitacion['precio'],
                    $subtotal,
                    '',
                    $cantidad,
                    $id_cliente,
                    //$id_reserva
                );
            }
        } else {
            $error = 'No existe la habitacion';
        }

        $res['datos'] = $this->cargarReserva($id_notaReserva);
        $res['total'] = $this->totalReserva($id_notaReserva);
        $res['error'] = $error;
        echo json_encode($res);
    }


    //Carga los servicios y retorna los datos en un string
    public function cargarReserva($id_notaReserva)
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        //obtener los datos de la compra temporal segun el id_notaReserva
        $resultado = $this->temporal_reserva->porIdNotaReserva($id_notaReserva);
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
            //$fila .= "<td>" . $row['id_reserva'] . "</td>";
            $fila .= "<td class='text-center'>" . $row['cantidad_dias'] . "</td>";
            $fila .= "<td> 
                            <a onclick=\"eliminarHabitacion(" . $row['nro_habitacion'] . ", '" . $id_notaReserva . "')\" class='borrar'>
                                <span class='fas fa-fw fa-trash' > </span>
                            </a> 
                         </td>";
            $fila .= "</tr>";
        }
        return $fila;
    }

    //Calcular el total
    public function totalReserva($id_notaReserva)
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        $resultado = $this->temporal_reserva->porIdNotaReserva($id_notaReserva);
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

    public function getEliminar($nro_habitacion, $id_notaReserva)
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        $datosExiste = $this->temporal_reserva->porIdHabitacion_notaReserva($nro_habitacion, $id_notaReserva);

        if ($datosExiste) {
            $this->temporal_reserva->eliminarHabitacion_notaReserva($nro_habitacion, $id_notaReserva);
        }

        $res['datos'] = $this->cargarReserva($id_notaReserva);
        $res['total'] = $this->totalReserva($id_notaReserva);
        $res['error'] = '';
        echo json_encode($res);
    }
}
