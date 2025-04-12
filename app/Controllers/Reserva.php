<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\NotaHospedajeModel;
use App\Models\ClienteModel;
use App\Models\TemporalReservaModel;
use App\Models\DetalleReservaModel;
use App\Models\ConfiguracionModel;
use App\Models\HabitacionModel;
use App\Models\ReservaModel;
use PDF;

class Reserva extends BaseController
{
    //tabla de la base de datos
    protected $notaReserva;
    protected $cliente;
    protected $temporal_reserva;
    protected $detallereserva;
    protected $reglas; //  TERMINAR VALIDACIONES
    protected $configuracion;
    protected $habitacion;
    protected $session;
    //protected $notaReserva;

    public function __construct()
    {
        $this->notaReserva = new ReservaModel();
        $this->cliente = new ClienteModel();
        $this->temporal_reserva = new TemporalReservaModel();
        $this->detallereserva = new DetalleReservaModel();
        $this->configuracion = new ConfiguracionModel();
        $this->habitacion = new HabitacionModel();
        $this->session = Session();
        helper(['form']);

        $this->reglas = [
            'id_cliente' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.'
                ]
            ]
        ];
    }

    //metodo principal, mostrar nota de habitaciones
    public function getIndex()
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        $notaReservaConsulta = $this->notaReserva->mostrarConCliente();
        $data = ['titulo' => 'Hospedajes', 'notaReservas' => $notaReservaConsulta];
        echo view('templates/header');
        echo view('gestionarNotaHospedaje/mostrarNotaHospedaje', $data);
        echo view('templates/footer');
    }

    public function getCrear()
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        $clientes = $this->cliente->mostrar();
        $habitaciones = $this->habitacion->mostrarHabitacionesDisponibles();
        //$reservas = $this->reserva->mostrar();
        $data = [
            'titulo' => 'Nueva Reserva',
            'clientes' => $clientes,
            'habitaciones' => $habitaciones,
            'validation' => $this->validator
        ];
        echo view('templates/header');
        echo view('gestionarReserva/crearReserva', $data);
        echo view('templates/footer');
    }

    public function postGuarda()
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        $id_notaReserva = $this->request->getPost('id_notaReserva'); //folio
        $fechaEntrada = $this->request->getPost('fechaEntrada');
        $fechaSalida = $this->request->getPost('fechaSalida');
        $cant_habitaciones = 0;
        $estadia = 0;
        $fecha_caducidad = '01/01/1990';
        $total = $this->request->getPost('total');
        $estado_reserva = 'En reserva';
        $estado = 1;
        $id_cliente = $this->request->getPost('id_cliente');
        //$id_reserva = $this->request->getPost('id_reserva');

        $session = session(); //para capturar el id_recepcionista

        //id de la nota hospedaje insertada recientemente, para insertar el detalle servicio
        $resultadoIdReserva = $this->notaReserva->insertarNotaReserva(
            $id_notaReserva,
            $estado_reserva,
            $fechaEntrada,
            $fechaSalida,
            $fecha_caducidad,
            $estadia,
            $cant_habitaciones,
            $total,
            $estado,
            $id_cliente,
            $session->id_recepcionista,
        );
        //insertar los datos en el detalle hospedaje
        if ($resultadoIdReserva) {
            //id_hospedaje temporal
            $resultadoIdReservaConsulta = $this->temporal_reserva->porIdNotaReserva($id_notaReserva);

            foreach ($resultadoIdReservaConsulta as $row) {
                $this->detallereserva->crear(
                    $resultadoIdReserva,
                    $row['nro_habitacion'],
                    $row['cantidad_dias'],
                    $row['subtotal'],
                    $id_cliente
                );

                //cambiar estado de las habitaciones del hospedaje a ocupada
                $this->habitacion->cambiarEstadoPorNroHabitacion2($row['nro_habitacion'], 'Reservada');
            }

            //eliminar el hospedaje temporal
            $this->temporal_reserva->eliminarReserva($id_notaReserva);
        }
        return redirect()->to(base_url().'habitacion');
    }

    //para mostrar la vista donde se genera el pdf
    public function getMuestraNotaHospedajePdf($id_notaReserva)
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        $data['id_notaReserva'] = $id_notaReserva;
        echo view('templates/header');
        echo view('gestionarReserva/verNotaHospedajePdf', $data);
        echo view('templates/footer');
    }

}
