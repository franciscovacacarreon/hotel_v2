<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TemporalServicioModel;
use App\Models\ServicioModel;

class TemporalServicio extends BaseController
{
    //tabla de la base de datos
    protected $temporal_servicio;
    protected $servicio;
    protected $session;

    public function __construct()
    {
        $this->temporal_servicio = new TemporalServicioModel();
        $this->servicio = new ServicioModel();
        $this->session = Session();
    }

    //insertar datos en la tabla temporal
    public function getInsertar($id_servicio, $cantidad, $id_notaServicio, $id_cliente, $id_notaHospedaje)
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        $error = '';
        $servicio = $this->servicio->mostrarId($id_servicio);

        if ($servicio) {
            $datosExiste = $this->temporal_servicio->porIdServicio_NotaServicio($id_servicio, $id_notaServicio);

            //si existe el servicio temporal
            if ($datosExiste) {
                //si existe se le suma la cantidad y recalcula el subtotal
                $cantidad = $datosExiste->cantidad + $cantidad;
                $subtotal = $cantidad * $datosExiste->precio;

                $this->temporal_servicio->actualizarServicio_NotaServicio($id_servicio, $id_notaServicio, $cantidad, $subtotal);
            } else { //si no existe, cargamos un servicio temporal
                $subtotal = $cantidad * $servicio['precio'];

                $this->temporal_servicio->crear(
                    $id_notaServicio,
                    $id_servicio,
                    $id_servicio,
                    $servicio['nombre'],
                    $servicio['precio'],
                    $cantidad,
                    $subtotal,
                    $id_cliente,
                    $id_notaHospedaje
                );
            }
        } else {
            $error = 'No existe el servicio';
        }

        $res['datos'] = $this->cargarServicio($id_notaServicio);
        $res['total'] = $this->totalServicio($id_notaServicio);
        $res['error'] = $error;
        echo json_encode($res);
    }

    //Carga los servicios y retorna los datos en un string
    public function cargarServicio($id_notaServicio) 
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        //obtener los datos de la compra temporal segun el id_notaServicio
        $resultado = $this->temporal_servicio->porIdNotaServicio($id_notaServicio);
        $fila = '';
        $numFila = 0;
        foreach ($resultado as $row) {
            $numFila++;
            $fila .= "<tr id='fila".$numFila."'>";
            $fila .= "<td>".$numFila."</td>";
            $fila .= "<td>".$row['nombre']."</td>";
            $fila .= "<td>".$row['cantidad']."</td>";
            $fila .= "<td>".$row['precio']."</td>";
            $fila .= "<td>".$row['subtotal']."</td>";
            $fila .= "<td>".$row['id_cliente']."</td>";
            $fila .= "<td>".$row['id_notaHospedaje']."</td>";
            $fila .= "<td> 
                            <a onclick=\"eliminarServicio(".$row['id_servicio'].", '".$id_notaServicio."')\" class='borrar'>
                                <span class='fas fa-fw fa-trash' > </span>
                            </a> 
                         </td>";

            $fila .= "</tr>";   
        }
        return $fila;
    }

    //Calcular el total
    public function totalServicio($id_notaServicio) 
    {   
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        $resultado = $this->temporal_servicio->porIdNotaServicio($id_notaServicio);
        $total = 0;
        foreach ($resultado as $row) {
            $total += $row['subtotal'];
        }
        return $total;
    }

    //aliminar la tabla temporal
    public function getEliminar($id_servicio, $id_notaServicio) 
    {   
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        $datosExiste = $this->temporal_servicio->porIdServicio_NotaServicio($id_servicio, $id_notaServicio);

        if ($datosExiste){
            if ($datosExiste->cantidad > 1) {
                $cantidad = $datosExiste->cantidad - 1;
                $subtotal = $cantidad * $datosExiste->precio;
                $this->temporal_servicio->actualizarServicio_NotaServicio($id_servicio, $id_notaServicio, $cantidad, $subtotal);
            } else {
                $this->temporal_servicio->eliminarServicio_NotaServicio($id_servicio, $id_notaServicio);
            }
        }

        $res['datos'] = $this->cargarServicio($id_notaServicio);
        $res['total'] = $this->totalServicio($id_notaServicio); //modificado
        $res['error'] = '';
        echo json_encode($res);
    } 
}
