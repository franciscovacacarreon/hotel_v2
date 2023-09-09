<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\NotaHospedajeModel;
use App\Models\ClienteModel;
use App\Models\TemporalHospedajeModel;
use App\Models\DetalleHospedajeModel;
use App\Models\ConfiguracionModel;
use App\Models\HabitacionModel;
use App\Models\DetalleRolPermisoModel;
use PDF;

class NotaHospedaje extends BaseController
{
    //tabla de la base de datos
    protected $notaHospedaje;
    protected $cliente;
    protected $temporal_hospedaje;
    protected $detalleHospedaje;
    protected $reglas; //  TERMINAR VALIDACIONES
    protected $configuracion;
    protected $habitacion;
    protected $detalleRol;
    protected $session;
    //protected $notaHospedaje;

    public function __construct()
    {
        $this->notaHospedaje = new NotaHospedajeModel();
        $this->cliente = new ClienteModel();
        $this->temporal_hospedaje = new TemporalHospedajeModel();
        $this->detalleHospedaje = new DetalleHospedajeModel();
        $this->configuracion = new ConfiguracionModel();
        $this->habitacion = new HabitacionModel();
        $this->detalleRol = new DetalleRolPermisoModel();
        $this->session = Session();
        helper(['form']);

        $this->reglas = [
            'id_cliente' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.'
                ]
            ],
            'id_pago' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.'
                ]
            ]
        ];
    }

    public function getSinPermiso()
    {
        echo view('templates/header');
        echo view('gestionarRol/sinpermiso');
        echo view('templates/footer');
    }

    public function verficarPermiso($permiso, $id_submodulo)
    {
        $permiso  = $this->detalleRol->verificarPermiso($this->session->id_rol, $permiso, $id_submodulo);
        return $permiso;
    }

    //metodo principal, mostrar nota de habitaciones
    public function getIndex()
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        if (!$this->verficarPermiso('Hospedaje', 2)) {
            $this->getSinPermiso();
        } else {
            $botonDetalle = $this->verficarPermiso('Hospedaje Detalle', 2);
            $botonFinalizar = $this->verficarPermiso('Hospedaje Finalizar', 2) == false ? 'disabled-link' : '';
            $notaHospedajeConsulta = $this->notaHospedaje->mostrarConCliente();
            $data = ['titulo' => 'Hospedajes', 'validation' => $this->validator, 'notaHospedajes' => $notaHospedajeConsulta, 'botonDetalle' => $botonDetalle, 'botonFinalizar' => $botonFinalizar];
            echo view('templates/header');
            echo view('gestionarNotaHospedaje/mostrarNotaHospedaje', $data);
            echo view('templates/footer');
        }
    }

    //FALTAN LAS RESERVAS
    public function getCrear()
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        if (!$this->verficarPermiso('Nuevo Hospedaje', 2)) {
            return $this->getSinPermiso();
        }
        $clientes = $this->cliente->mostrar();
        $habitaciones = $this->habitacion->mostrarHabitacionesDisponibles();
        //$reservas = $this->reserva->mostrar();
        $data = [
            'titulo' => 'Nueva nota de hospedaje',
            'clientes' => $clientes,
            'habitaciones' => $habitaciones,
            'validation' => $this->validator
        ];
        echo view('templates/header');
        echo view('gestionarNotaHospedaje/crearNotaHospedaje', $data);
        echo view('templates/footer');
    }

    //guardar el hospedaje en la nota hospedaje 
    public function postGuarda()
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        if (!$this->verficarPermiso('Nuevo Hospedaje', 2)) {
            return $this->getSinPermiso();
        }
        if (
            $this->request->getMethod() == "post"
            &&  $this->validate($this->reglas)
        ) {

            $id_notaHospedaje = $this->request->getPost('id_notaHospedaje'); //folio
            $fechaEntrada = $this->request->getPost('fechaEntrada');
            $fechaSalida = $this->request->getPost('fechaSalida');
            $cant_habitaciones = 0;
            $total = $this->request->getPost('total');
            $estado_hospedaje = 'En estadía';
            $id_cliente = $this->request->getPost('id_cliente');
            $id_reserva = $this->request->getPost('id_reserva');
            $tipoPago = $this->request->getPost('id_pago');

            $session = session(); //para capturar el id_recepcionista

            //id de la nota hospedaje insertada recientemente, para insertar el detalle servicio
            $resultdadoIdHospedaje = $this->notaHospedaje->insertarNotaHospedaje(
                $id_notaHospedaje,
                $fechaEntrada,
                $fechaSalida,
                $cant_habitaciones,
                $total,
                $estado_hospedaje,
                $id_cliente,
                $session->id_recepcionista,
                $id_reserva,
                $tipoPago
            );
            //insertar los datos en el detalle hospedaje
            if ($resultdadoIdHospedaje) {
                //id_hospedaje temporal
                $resultNotaHospedaje = $this->temporal_hospedaje->porIdNotaHospedaje($id_notaHospedaje);

                foreach ($resultNotaHospedaje as $row) {
                    $this->detalleHospedaje->crear(
                        $resultdadoIdHospedaje,
                        $row['nro_habitacion'],
                        $row['cantidad_dias'],
                        $row['subtotal'],
                        $id_cliente
                    );

                    //cambiar estado de las habitaciones del hospedaje a ocupada
                    $this->habitacion->cambiarEstadoPorNroHabitacion($row['nro_habitacion']);
                }

                //eliminar el hospedaje temporal
                $this->temporal_hospedaje->eliminarNotaHospedaje($id_notaHospedaje);
            }
            return redirect()->to(base_url() . "notaHospedaje/muestraNotaHospedajePdf/" . $resultdadoIdHospedaje);
        } else {
            return redirect()->to(base_url() . "notaHospedaje/crear");
        }
    }


    //para mostrar la vista donde se genera el pdf
    public function getMuestraNotaHospedajePdf($id_notaHospedaje)
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        $data['id_notaHospedaje'] = $id_notaHospedaje;
        echo view('templates/header');
        echo view('gestionarNotaHospedaje/verNotaHospedajePdf', $data);
        echo view('templates/footer');
    }

    //generar el pdf
    public function getGeneraNotaHospedajePdf($id_notaHospedaje)
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        $datosNotaHospedaje = $this->notaHospedaje->mostrarNotaHospedajeId($id_notaHospedaje);
        $datosDetalleNotaHospedaje = $this->detalleHospedaje->mostrarDetalleHospedaje($id_notaHospedaje);
        $datosHotel = $this->configuracion->mostrar();

        //creando el pdf
        //orientacion, medida (ml), tamaño = letter = carta
        $pdf = new \FPDF('P', 'mm', 'letter');
        $pdf->AddPage();
        $pdf->SetMargins(10, 10, 10);
        $pdf->SetTitle("Hospedaje");
        $pdf->SetFont('Arial', 'B', 12);

        //Agregado una tabla
        //ancho, alto, titulo, bordes, salto de línea, posicion
        $pdf->Cell(195, 5, "Hospedaje realizado", 0, 1, 'C');

        //indicar que estamos trabajando con pdf
        $this->response->setHeader('Content-Type', 'application/pdf');

        //DATOS DEL HOTEL
        $pdf->SetFont('Arial', 'B', 9); //reducir el tamaño de letra para el contenido
        $pdf->Cell(50, 5, utf8_decode($datosHotel['hotel_nombre']), 0, 1, 'L'); //L = left
        $pdf->Cell(20, 5, utf8_decode('Dirección: '), 0, 0, 'L'); //utf8_decode para acentos
        $pdf->SetFont('Arial', '', 9); //quitamos la negrita
        $pdf->Cell(50, 5,  utf8_decode($datosHotel['hotel_direccion']), 0, 1, 'L');

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(25, 5, utf8_decode('Fecha y hora: '), 0, 0, 'L');
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(50, 5, $datosNotaHospedaje['fecha_ingreso'], 0, 1, 'L');

        //fecha entrada del hospedaje
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(50, 5, utf8_decode('Fecha de entrada del hospedaje: '), 0, 0, 'L');
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(50, 5, $datosNotaHospedaje['fechaEntrada'], 0, 1, 'L');
        //fecha salida del hospedaje
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(50, 5, utf8_decode('Fecha de salida del hospedaje: '), 0, 0, 'L');
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(50, 5, $datosNotaHospedaje['fechaSalida'], 0, 1, 'L');
        $pdf->Ln();

        //ITTULO DE LA TABLA
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetFillColor(27, 152, 238); //color fondo de la celda
        $pdf->SetTextColor(255, 255, 255); //color del texto
        $pdf->Cell(196, 5, 'DETALLE DEL HOSPEDAJE', 1, 1, 'C', 1); //ultimo uno, para indicar que tiene fondo

        //ENCABEZADO DE LA TABLA
        $pdf->SetTextColor(0, 0, 0); //reestablacer el color del texto
        $pdf->Cell(14, 5, 'Nro.', 1, 0, 'L');
        $pdf->Cell(25, 5, utf8_decode('Nro. Habitación'), 1, 0, 'L');
        $pdf->Cell(40, 5, utf8_decode('Tipo de habitación'), 1, 0, 'L');
        $pdf->Cell(45, 5, utf8_decode('Detalle de la habitación'), 1, 0, 'L');
        $pdf->Cell(20, 5, 'Precio', 1, 0, 'L');
        $pdf->Cell(20, 5, 'Importe', 1, 0, 'L'); //es el subtotal
        $pdf->Cell(32, 5, 'Cliente', 1, 1, 'L');

        //contenido de la tabla
        $pdf->SetFont('Arial', '', 8);
        $contador = 1;
        foreach ($datosDetalleNotaHospedaje as $row) {
            $id_habitacion = (int)$row['nro_habitacion'];
            $catHabitacion = $this->habitacion->buscarPorId($id_habitacion);

            $pdf->Cell(14, 5, $contador, 1, 0, 'L');
            $pdf->Cell(25, 5, $row['nro_habitacion'], 1, 0, 'L');
            $pdf->Cell(40, 5, $catHabitacion['nombre_categoria'], 1, 0, 'L');
            $pdf->Cell(45, 5, $catHabitacion['descripcion'], 1, 0, 'L');
            $pdf->Cell(20, 5, $catHabitacion['precio'], 1, 0, 'L'); //es el subtotal
            $pdf->Cell(20, 5, $row['sub_monto'], 1, 0, 'L');
            $pdf->Cell(32, 5, $datosNotaHospedaje['nombre_cliente'], 1, 1, 'L');

            $contador++;
        }

        $pdf->Ln();
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(195, 5, 'Total Bs. ' . $datosNotaHospedaje['monto_total'], 0, 1, 'R');
        //imgen
        $pdf->image(base_url() . 'assets/img/iconoHotel.png', 185, 10, 20, 20, 'PNG');

        $pdf->Output("nota_servicio.pdf", "I");
    }

    public function getFinalizarHospedaje($id_notaHospedaje)
    {
        if (!$this->verficarPermiso('Hospedaje Finalizar', 2)  ||  !$this->verficarPermiso('Hospedaje', 2)) {
            return $this->getSinPermiso();
        }
        $this->notaHospedaje->finalizarHospedaje($id_notaHospedaje, 'Disponible');
        return redirect()->to(base_url() . 'habitacion');
    }
}
