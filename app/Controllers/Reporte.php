<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\NotaHospedajeModel;
use App\Models\ClienteModel;
use App\Models\TemporalHospedajeModel;
use App\Models\DetalleHospedajeModel;
use App\Models\ConfiguracionModel;
use App\Models\HabitacionModel;
use App\Models\ReporteModel;
use App\Models\CategoriaModel;
use PDF;

class Reporte extends BaseController
{
    //tabla de la base de datos
    protected $notaHospedaje;
    protected $cliente;
    protected $temporal_hospedaje;
    protected $detalleHospedaje;
    protected $reglas; //  TERMINAR VALIDACIONES
    protected $configuracion;
    protected $habitacion;
    protected $reporte;
    protected $categoria;
    // protected $sw;
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
        $this->reporte = new ReporteModel();
        $this->categoria = new CategoriaModel();
        $this->session = Session();
        helper(['form']);

        $this->reglas = [
            'fecha_inicio' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.'
                ]
            ],
            'fecha_fin' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.'
                ]
            ]
        ];
    }

    public function getIndex()
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        $data = ['titulo' => 'Reporte de hospedaje', 'validation' => $this->validator];
        echo view('templates/header');
        echo view('gestionarReporte/reporteHospedajeRango', $data);
        echo view('templates/footer');
    }

    //para mostrar la vista donde se genera el pdf
    public function postMuestraReporteHospedajePdf()
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        if ($this->request->getMethod() == "post" && $this->validate($this->reglas)) {
            $fechaini = $this->request->getPost('fecha_inicio');
            $fechafin = $this->request->getPost('fecha_fin');
            $data = ['fecha_inicio' => $fechaini, 'fecha_fin' => $fechafin];
            echo view('templates/header');
            echo view('gestionarReporte/verReporteHospedajePdf', $data);
            echo view('templates/footer');
        } else {
            $this->getIndex();
        }
    }

    public function getGeneraReporteHospedajePdf($fecha_inicio, $fecha_fin)
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        $datosHospedajeMes = $this->reporte->reporteHospedajePorMes($fecha_inicio, $fecha_fin);
        $datosHospedajeSemana = $this->reporte->reporteHospedajePorSemana($fecha_inicio, $fecha_fin);
        $datoTotalHospedaje = $this->reporte->reporteHospedajeTotal($fecha_inicio, $fecha_fin);

        $datosHotel = $this->configuracion->mostrar();

        $fechaActual = date('Y-m-d');
        $horaActual = date('H:i:s');

        //creando el pdf
        //orientacion, medida (ml), tamaño = letter = carta
        $pdf = new \FPDF('P', 'mm', 'letter');
        $pdf->AddPage();
        $pdf->SetMargins(10, 10, 10);
        $pdf->SetTitle("Hospedaje");
        $pdf->SetFont('Arial', 'B', 12);

        //Agregado una tabla
        //ancho, alto, titulo, bordes, salto de línea, posicion
        $pdf->Cell(195, 5, "Reporte de Hospedajes", 0, 1, 'C');

        //indicar que estamos trabajando con pdf
        $this->response->setHeader('Content-Type', 'application/pdf');

        //DATOS DEL HOTEL
        $pdf->SetFont('Arial', 'B', 9); //reducir el tamaño de letra para el contenido
        $pdf->Cell(50, 5, utf8_decode($datosHotel['hotel_nombre']), 0, 1, 'L'); //L = left
        $pdf->Cell(20, 5, utf8_decode('Dirección: '), 0, 0, 'L'); //utf8_decode para acentos
        $pdf->SetFont('Arial', '', 9); //quitamos la negrita
        $pdf->Cell(50, 5,  utf8_decode($datosHotel['hotel_direccion']), 0, 1, 'L');

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(25, 5, utf8_decode('Fecha: y hora: '), 0, 0, 'L');
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(50, 5, $fechaActual . ' ' . $horaActual, 0, 1, 'L');
        $pdf->Ln();

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(25, 5, utf8_decode('Rago de fechas del reporte:'), 0, 1, 'L');
        $pdf->Cell(25, 5, utf8_decode('Fecha de inicio: '), 0, 0, 'L');
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(25, 5, $fecha_inicio, 0, 0, 'L');
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(25, 5, utf8_decode('Fecha de fin: '), 0, 0, 'L');
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(50, 5, $fecha_fin, 0, 1, 'L');
        //moneda
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(25, 5, utf8_decode('Moneda: '), 0, 0, 'L');
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(25, 5, 'Bolivianos', 0, 1, 'L');
        //porcentaje
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(25, 5, utf8_decode('%: '), 0, 0, 'L');
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(25, 5, 'Porcentaje', 0, 1, 'L');
        $pdf->Ln();

        //Título
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(196, 7, utf8_decode('Ingresos por hospedajes'), 0, 1, 'C');

        //ITTULO DE LA TABLA
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetFillColor(12, 95, 151); //color fondo de la celda
        $pdf->SetTextColor(255, 255, 255); //color del texto
        $pdf->Cell(196, 7, 'Hospedajes', 1, 1, 'C', 1);
        $pdf->Cell(65, 5, utf8_decode('Cantidad de hospedajes'), 1, 0, 'C', 1);
        $pdf->Cell(66, 5, utf8_decode('Monto'), 1, 0, 'C', 1);
        $pdf->Cell(65, 5, utf8_decode('%'), 1, 1, 'C', 1);
        //contenido
        $pdf->SetFillColor(245, 242, 242);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Cell(65, 5, $datoTotalHospedaje['cantidad_nota'], 1, 0, 'C', 1);
        $pdf->Cell(66, 5, sprintf("%.2f", (float)($datoTotalHospedaje['monto_total'])), 1, 0, 'C', 1);
        $pdf->Cell(65, 5, 100, 1, 1, 'C', 1);
        $pdf->Ln();
        //subtitulo
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(196, 7, 'Detalle de ingresos de hospedajes por mes', 0, 1, 'C');

        //recorrer los hospedajes por mes
        foreach ($datosHospedajeMes as $hospedajeMes) {
            //titulo encabezado
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->SetFillColor(12, 95, 151); //color fondo de la celda
            $pdf->SetTextColor(255, 255, 255); //color del texto
            $pdf->Cell(196, 7, 'Ingresos de ' . $this->getNombreMes($hospedajeMes['mes']), 1, 1, 'C', 1);
            $pdf->Cell(50, 5, 'Mes', 1, 0, 'C', 1);
            $pdf->Cell(50, 5, 'Cantidad de Hospedajes', 1, 0, 'C', 1);
            $pdf->Cell(50, 5, utf8_decode('Monto'), 1, 0, 'C', 1);
            $pdf->Cell(46, 5, utf8_decode('%'), 1, 1, 'C', 1);
            $pdf->SetFillColor(245, 242, 242);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(50, 5, $this->getNombreMes($hospedajeMes['mes']), 1, 0, 'C', 1);
            $pdf->Cell(50, 5, $hospedajeMes['cantidad'], 1, 0, 'C', 1);
            $pdf->Cell(50, 5, sprintf("%.2f", (float)($hospedajeMes['monto'])), 1, 0, 'C', 1);
            $pdf->Cell(46, 5, utf8_decode('100'), 1, 1, 'C', 1);

            $pdf->SetFillColor(27, 152, 238); //color fondo de la celda
            $pdf->SetTextColor(255, 255, 255); //color del texto
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(196, 7, 'Detalle de los ingresos de ' . $this->getNombreMes($hospedajeMes['mes']), 1, 1, 'C', 1);
            $pdf->Cell(50, 5, 'Nro. Semana', 1, 0, 'C', 1);
            $pdf->Cell(50, 5, 'Cantidad de Hospedajes', 1, 0, 'C', 1);
            $pdf->Cell(50, 5, utf8_decode('Monto'), 1, 0, 'C', 1);
            $pdf->Cell(46, 5, utf8_decode('%'), 1, 1, 'C', 1);
            $pdf->SetFillColor(245, 242, 242);
            $pdf->SetTextColor(0, 0, 0);
            $contador = 1;
            foreach ($datosHospedajeSemana as $hospedajeSemana) {
                if ($hospedajeSemana['mes'] == $hospedajeMes['mes']) {

                    $pdf->Cell(50, 5, $contador, 1, 0, 'C', 1);
                    $pdf->Cell(50, 5, $hospedajeSemana['cantidad'], 1, 0, 'C', 1);
                    $pdf->Cell(50, 5, sprintf("%.2f", (float)$hospedajeSemana['monto']), 1, 0, 'C', 1);
                    $pdf->Cell(46, 5, sprintf("%.2f", (float)(($hospedajeSemana['monto'] / $hospedajeMes['monto'])) * 100), 1, 1, 'C', 1);
                    $contador++;
                }
            }
            $pdf->Ln();
        }

        //imgen
        $pdf->image(base_url() . 'assets/img/iconoHotel.png', 185, 10, 20, 20, 'PNG');

        $pdf->Output("ingresos_hospedajes.pdf", "I");
    }


    ///// SERVICIOS, para mostrar la vista donde se genera el pdf

    public function getIndexServicio()
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        $data = ['titulo' => 'Reporte de servicios', 'validation' => $this->validator];
        echo view('templates/header');
        echo view('gestionarReporte/reporteServicioRango', $data);
        echo view('templates/footer');
    }

    public function getGraficaServicio()
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        $data = ['titulo' => 'Reporte de hospedaje', 'validation' => $this->validator];
        echo view('templates/header');
        echo view('gestionarReporte/reporteServicioGrafica', $data);
        echo view('templates/footer');
    }

    public function postMuestraReporteServicioPdf()
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        if ($this->request->getMethod() == "post" && $this->validate($this->reglas)) {
            $fechaini = $this->request->getPost('fecha_inicio');
            $fechafin = $this->request->getPost('fecha_fin');
            $data = ['fecha_inicio' => $fechaini, 'fecha_fin' => $fechafin];
            echo view('templates/header');
            echo view('gestionarReporte/verReporteServicioPdf', $data);
            echo view('templates/footer');
        } else {
            $this->getIndex();
        }
    }


    public function getGeneraReporteServicioPdf($fecha_inicio, $fecha_fin)
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        $datosServiciosMes = $this->reporte->reporServicioPorMes($fecha_inicio, $fecha_fin);
        $datosServiciosDetalleMes = $this->reporte->reporServicioPorMesDetalle($fecha_inicio, $fecha_fin);
        $datosServiciosTotal = $this->reporte->reporteServicioTotal($fecha_inicio, $fecha_fin);
        $datosHotel = $this->configuracion->mostrar();

        $fechaActual = date('Y-m-d');
        $horaActual = date('H:i:s');

        //creando el pdf
        //orientacion, medida (ml), tamaño = letter = carta
        $pdf = new \FPDF('P', 'mm', 'letter');
        $pdf->AddPage();
        $pdf->SetMargins(10, 10, 10);
        $pdf->SetTitle("Hospedaje");
        $pdf->SetFont('Arial', 'B', 12);

        //Agregado una tabla
        //ancho, alto, titulo, bordes, salto de línea, posicion
        $pdf->Cell(195, 5, "Reporte de Servicios", 0, 1, 'C');

        //indicar que estamos trabajando con pdf
        $this->response->setHeader('Content-Type', 'application/pdf');

        //DATOS DEL HOTEL
        $pdf->SetFont('Arial', 'B', 9); //reducir el tamaño de letra para el contenido
        $pdf->Cell(50, 5, utf8_decode($datosHotel['hotel_nombre']), 0, 1, 'L'); //L = left
        $pdf->Cell(20, 5, utf8_decode('Dirección: '), 0, 0, 'L'); //utf8_decode para acentos
        $pdf->SetFont('Arial', '', 9); //quitamos la negrita
        $pdf->Cell(50, 5,  utf8_decode($datosHotel['hotel_direccion']), 0, 1, 'L');

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(25, 5, utf8_decode('Fecha: y hora: '), 0, 0, 'L');
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(50, 5, $fechaActual . ' ' . $horaActual, 0, 1, 'L');
        $pdf->Ln();

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(25, 5, utf8_decode('Rago de Fechas del reporte:'), 0, 1, 'L');
        $pdf->Cell(25, 5, utf8_decode('Fecha de inicio: '), 0, 0, 'L');
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(25, 5, $fecha_inicio, 0, 0, 'L');
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(25, 5, utf8_decode('Fecha de fin: '), 0, 0, 'L');
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(50, 5, $fecha_fin, 0, 1, 'L');
        //moneda
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(25, 5, utf8_decode('Moneda: '), 0, 0, 'L');
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(25, 5, 'Bolivianos', 0, 1, 'L');
        //porcentaje
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(25, 5, utf8_decode('%: '), 0, 0, 'L');
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(25, 5, 'Porcentaje', 0, 1, 'L');
        $pdf->Ln();
        //imgen
        $pdf->image(base_url() . 'assets/img/iconoHotel.png', 185, 10, 20, 20, 'PNG');

        //ITTULO 
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(196, 7, utf8_decode('Ingresos por los tipos de servicios'), 0, 1, 'C');
        //ITTULO DE LA TABLA
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetFillColor(12, 95, 151);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(196, 7, 'Tipos de Servicios', 1, 1, 'C', 1);

        //ENCABEZADO DE LA TABLA
        //ITTULO DE LA TABLA, por categoria
        $pdf->Cell(65, 5, utf8_decode('Nombre'), 1, 0, 'C', 1);
        $pdf->Cell(66, 5, utf8_decode('Ingreso total (BS)'), 1, 0, 'C', 1);
        $pdf->Cell(65, 5, utf8_decode('%'), 1, 1, 'C', 1);

        //contenido
        $pdf->SetFillColor(245, 242, 242);
        $pdf->SetTextColor(0, 0, 0);

        //total
        $total = $this->calculaTotal($datosServiciosMes);
        $total = $total == 0 ? $total = 1 : $total; //division por cero

        //rellenar contenido
        foreach ($datosServiciosTotal as $dato) {
            $pdf->Cell(65, 5, $dato['nombre'], 1, 0, 'C', 1);
            $pdf->Cell(66, 5,  sprintf("%.2f", $dato['monto']), 1, 0, 'C', 1);
            $pdf->Cell(65, 5, sprintf("%.2f", (float)(($dato['monto'] / $total) * 100)), 1, 1, 'C', 1);
        }
        //para el total
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetFillColor(12, 95, 151); //color fondo de la celda
        $pdf->SetTextColor(255, 255, 255);

        $pdf->Cell(65, 5, 'Total', 0, 0, 'C', 1);
        $pdf->Cell(66, 5, number_format($total, 2), 0, 0, 'C', 1);
        $pdf->Cell(65, 5, 100, 0, 1, 'C', 1);
        $pdf->Ln();
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Cell(196, 7, utf8_decode('Detalles de los ingresos por mes'), 0, 1, 'C');

        //detalle del mes 
        foreach ($datosServiciosMes as $datoMes) {
            //ITTULO DE LA TABLA
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->SetFillColor(12, 95, 151); //color fondo de la celda
            $pdf->SetTextColor(255, 255, 255); //color del texto
            $pdf->Cell(196, 7, utf8_decode('Ingresos de ' . $this->getNombreMes($datoMes['mes'])), 1, 1, 'C', 1); //ultimo uno, 
            $pdf->SetFont('Arial', 'B', 9);
            $pdf->SetTextColor(0, 0, 0); //reestablacer el color del texto
            //encabezado
            $pdf->SetFillColor(12, 95, 151); //color fondo de la celda
            $pdf->SetTextColor(255, 255, 255); //color del texto
            $pdf->Cell(65, 5, utf8_decode('Mes'), 1, 0, 'C', 1);
            $pdf->Cell(66, 5, utf8_decode('Ingreso total'), 1, 0, 'C', 1);
            $pdf->Cell(65, 5, utf8_decode('% - P/Total'), 1, 1, 'C', 1);
            //contenido
            $pdf->SetFillColor(245, 242, 242);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(65, 5, utf8_decode($this->getNombreMes($datoMes['mes'])), 1, 0, 'C', 1);
            $pdf->Cell(66, 5, number_format($datoMes['monto'], 2), 1, 0, 'C', 1);
            $pdf->Cell(65, 5, utf8_decode('100 - ') . number_format(($datoMes['monto'] / $total) * 100, 2), 1, 1, 'C', 1);
            //$pdf->Ln(); 
            //detalle de la ingreso
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->SetFillColor(27, 152, 238); //color fondo de la celda
            $pdf->SetTextColor(255, 255, 255); //color del texto
            $pdf->Cell(196, 7, utf8_decode('Detalle de los ingresos de ' . $this->getNombreMes($datoMes['mes'])), 1, 1, 'C', 1); //ultimo uno, 
            //rellenar el detalle del mes
            foreach ($datosServiciosDetalleMes as $datos) {
                if ($datos['mes'] == $datoMes['mes']) {


                    //encabezado
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->SetFillColor(27, 152, 238); //color fondo de la celda
                    $pdf->SetTextColor(255, 255, 255); //color del texto
                    $pdf->Cell(65, 5, utf8_decode('Nombre tipo de servicio'), 1, 0, 'C', 1);
                    $pdf->Cell(66, 5, utf8_decode('Monto'), 1, 0, 'C', 1);
                    $pdf->Cell(65, 5, utf8_decode('% (P/Total Mes)'), 1, 1, 'C', 1);
                    $pdf->SetFont('Arial', '', 9, 1);
                    $pdf->SetTextColor(0, 0, 0);


                    $pdf->SetFont('Arial', 'B', 9, 1);
                    $pdf->SetFillColor(245, 242, 242);
                    $pdf->Cell(65, 5, utf8_decode($datos['nombre']), 1, 0, 'C', 1);
                    $pdf->Cell(66, 5, number_format($datos['monto'], 2), 1, 0, 'C', 1);
                    $pdf->Cell(65, 5, sprintf("%.2f", (float)(($datos['monto'] / $datoMes['monto'])) * 100), 1, 1, 'C', 1);

                    //detalle de cada tipo de servicio
                    $detalleTipoServicio = $this->reporte->reporServicioDetallePorTipo($fecha_inicio, $fecha_fin, $datos['id_tipoServicio'], $datos['mes']); //consulta
                    //titulo de la tabla detalle tipo servicio
                    $pdf->SetFillColor(236, 249, 246);
                    $pdf->SetFont('Arial', 'B', 9, 1);
                    $pdf->Cell(196, 7, utf8_decode('Detalle de ingresos por el tipo de servicio ' . $datos['nombre']), 1, 1, 'C', 1);
                    //cabecera
                    $pdf->Cell(65, 5, utf8_decode('Nombre del servicio'), 1, 0, 'C', 1);
                    $pdf->Cell(66, 5, utf8_decode('Monto'), 1, 0, 'C', 1);
                    $pdf->Cell(65, 5, utf8_decode('% (P/Monto Tipo Servicio)'), 1, 1, 'C', 1);
                    $pdf->SetFont('Arial', '', 9, 1);

                    //contenido 
                    foreach ($detalleTipoServicio as $data) {
                        $pdf->Cell(65, 5, $data['nombre_servicio'], 1, 0, 'C', 1);
                        $pdf->Cell(66, 5, number_format($data['monto'], 2), 1, 0, 'C', 1);
                        $pdf->Cell(65, 5, sprintf("%.2f", (float)(($data['monto'] / $datoMes['monto'])) * 100), 1, 1, 'C', 1);
                    }
                }
            }
            $pdf->Ln();
        }

        $pdf->Output("ingresos_servicios.pdf", "I");
    }


    //REPORTE HABITACION

    public function postMuestraReporteHabitacionPdf()
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        if ($this->request->getMethod() == "post" && $this->validate($this->reglas)) {
            $fechaini = $this->request->getPost('fecha_inicio');
            $fechafin = $this->request->getPost('fecha_fin');
            $data = ['fecha_inicio' => $fechaini, 'fecha_fin' => $fechafin];
            echo view('templates/header');
            echo view('gestionarReporte/verReporteHabitacionPdf', $data);
            echo view('templates/footer');
        } else {
            $this->getIndex();
        }
    }


    public function getGeneraReporteHabitacionPdf($fecha_inicio, $fecha_fin)
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        $datosHabitacion = $this->reporte->reporteHabitaciónCategoria($fecha_inicio, $fecha_fin);
        $datosHabitacionTotal = $this->reporte->reporteHabitaciónCategoriaTotal($fecha_inicio, $fecha_fin);
        $datosPorcategoria = $this->reporte->reportePorCategoria($fecha_inicio, $fecha_fin);
        $categorias = $this->categoria->mostrar();
        $datosHotel = $this->configuracion->mostrar();

        $fechaActual = date('Y-m-d');
        $horaActual = date('H:i:s');

        //creando el pdf
        //orientacion, medida (ml), tamaño = letter = carta
        $pdf = new \FPDF('P', 'mm', 'letter');
        $pdf->AddPage();
        $pdf->SetMargins(10, 10, 10);
        $pdf->SetTitle("Hospedaje");
        $pdf->SetFont('Arial', 'B', 12);

        //Agregado una tabla
        //ancho, alto, titulo, bordes, salto de línea, posicion
        $pdf->Cell(195, 5, "Reporte de Habitaciones", 0, 1, 'C');

        //indicar que estamos trabajando con pdf
        $this->response->setHeader('Content-Type', 'application/pdf');

        //DATOS DEL HOTEL
        $pdf->SetFont('Arial', 'B', 9); //reducir el tamaño de letra para el contenido
        $pdf->Cell(50, 5, utf8_decode($datosHotel['hotel_nombre']), 0, 1, 'L'); //L = left
        $pdf->Cell(20, 5, utf8_decode('Dirección: '), 0, 0, 'L'); //utf8_decode para acentos
        $pdf->SetFont('Arial', '', 9); //quitamos la negrita
        $pdf->Cell(50, 5,  utf8_decode($datosHotel['hotel_direccion']), 0, 1, 'L');

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(25, 5, utf8_decode('Fecha: y hora: '), 0, 0, 'L');
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(50, 5, $fechaActual . ' ' . $horaActual, 0, 1, 'L');
        $pdf->Ln();

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(25, 5, utf8_decode('Rago de Fechas del reporte:'), 0, 1, 'L');
        $pdf->Cell(25, 5, utf8_decode('Fecha de inicio: '), 0, 0, 'L');
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(25, 5, $fecha_inicio, 0, 0, 'L');
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(25, 5, utf8_decode('Fecha de fin: '), 0, 0, 'L');
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(50, 5, $fecha_fin, 0, 1, 'L');
        //moneda
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(25, 5, utf8_decode('Moneda: '), 0, 0, 'L');
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(25, 5, 'Bolivianos', 0, 1, 'L');
        //porcentaje
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(25, 5, utf8_decode('%: '), 0, 0, 'L');
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(25, 5, 'Porcentaje', 0, 1, 'L');

        $pdf->Ln();

        //imgen
        $pdf->image(base_url() . 'assets/img/iconoHotel.png', 185, 10, 20, 20, 'PNG');

        //ITTULO DE LA TABLA
        $pdf->SetFont('Arial', 'B', 10);
        // $pdf->SetFillColor(27, 152, 238); //color fondo de la celda
        // $pdf->SetTextColor(255, 255, 255); //color del texto
        $pdf->Cell(196, 7, utf8_decode('Ingresos por categoría de habitación'), 0, 1, 'C'); //ultimo uno, para indicar que tiene fondo

        //ITTULO DE LA TABLA, por categoria
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetFillColor(12, 95, 151); //color fondo de la celda
        $pdf->SetTextColor(255, 255, 255); //color del texto
        $pdf->Cell(196, 7, 'Categorias', 1, 1, 'C', 1); //ultimo uno, 
        $pdf->SetFont('Arial', 'B', 9);
        //encabezado
        $pdf->SetFillColor(12, 95, 151); //       (linea demas)
        $pdf->SetTextColor(255, 255, 255); //     (línea demás)
        $pdf->Cell(65, 5, utf8_decode('Nombre'), 1, 0, 'C', 1);
        $pdf->Cell(66, 5, utf8_decode('Ingreso total'), 1, 0, 'C', 1);
        $pdf->Cell(65, 5, utf8_decode('%'), 1, 1, 'C', 1);
        //contenido
        $pdf->SetFillColor(245, 242, 242);
        $pdf->SetTextColor(0, 0, 0);

        $total = 0; //para sacar el total
        foreach ($datosPorcategoria as $datos) {
            $total += $datos['monto'];
        }

        //para controlar la division por cero
        $total = $total == 0 ? $total = 1 : $total;

        //rellenar el contenido
        foreach ($datosPorcategoria as $datos) {
            $pdf->Cell(65, 5, $datos['nombre'], 1, 0, 'C', 1);
            $pdf->Cell(66, 5, $datos['monto'], 1, 0, 'C', 1);
            $pdf->Cell(65, 5, sprintf("%.2f", (float)(($datos['monto'] / $total) * 100)), 1, 1, 'C', 1);
        }
        //para el total
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetFillColor(12, 95, 151); //color fondo de la celda
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(65, 5, 'Total', 0, 0, 'C', 1);

        $pdf->Cell(66, 5, $total, 0, 0, 'C', 1);
        $pdf->Cell(65, 5, 100, 0, 1, 'C', 1);
        $pdf->Ln();
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Cell(196, 7, utf8_decode('Detalles de los ingresos por mes'), 0, 1, 'C');

        //detalle del mes
        foreach ($datosHabitacionTotal as $habitacionTotal) {
            //ITTULO DE LA TABLA
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->SetFillColor(12, 95, 151); //color fondo de la celda
            $pdf->SetTextColor(255, 255, 255); //color del texto
            $pdf->Cell(196, 7, utf8_decode('Ingresos de ' . $this->getNombreMes($habitacionTotal['mes'])), 1, 1, 'C', 1); //ultimo uno, 
            $pdf->SetFont('Arial', 'B', 9);
            $pdf->SetTextColor(0, 0, 0); //reestablacer el color del texto
            //encabezado
            $pdf->SetFillColor(12, 95, 151); //color fondo de la celda
            $pdf->SetTextColor(255, 255, 255); //color del texto
            $pdf->Cell(65, 5, utf8_decode('Mes'), 1, 0, 'C', 1);
            $pdf->Cell(66, 5, utf8_decode('Ingreso total'), 1, 0, 'C', 1);
            $pdf->Cell(65, 5, utf8_decode('%'), 1, 1, 'C', 1);
            //contenido
            $pdf->SetFillColor(245, 242, 242);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(65, 5, utf8_decode($this->getNombreMes($habitacionTotal['mes'])), 1, 0, 'C', 1);
            $pdf->Cell(66, 5, utf8_decode($habitacionTotal['monto']), 1, 0, 'C', 1);
            $pdf->Cell(65, 5, utf8_decode('100'), 1, 1, 'C', 1);
            // $pdf->Ln(); 
            //ITTULO DE LA TABLA
            $pdf->Ln();
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->SetFillColor(27, 152, 238); //color fondo de la celda
            $pdf->SetTextColor(255, 255, 255); //color del texto
            $pdf->Cell(196, 7, utf8_decode('Detalle de los ingresos de ' . $this->getNombreMes($habitacionTotal['mes'])), 1, 1, 'C', 1); //ultimo uno, 
            //encabezado
            $pdf->SetFont('Arial', 'B', 9);
            $pdf->Cell(65, 5, utf8_decode('Nombre categoria'), 1, 0, 'C', 1);
            $pdf->Cell(66, 5, utf8_decode('Monto'), 1, 0, 'C', 1);
            $pdf->Cell(65, 5, utf8_decode('%'), 1, 1, 'C', 1);
            $pdf->SetFont('Arial', '', 9, 1);
            $pdf->SetTextColor(0, 0, 0);

            //consulta para ganancia mayor por mes
            $datosAux = $this->reporte->reporteHabitaciónCategoriaMes($fecha_inicio, $fecha_fin, $habitacionTotal['mes']);

            //rellenar el detalle del mes
            foreach ($datosHabitacion as $datos) {
                if ($datos['mes'] == $habitacionTotal['mes']) {
                    if ($datosAux['monto'] == $datos['monto']) {
                        $pdf->SetFillColor(184, 254, 136);
                        $pdf->Cell(65, 5, utf8_decode($datos['nombre']), 1, 0, 'C', 1);
                        $pdf->Cell(66, 5, utf8_decode($datos['monto']), 1, 0, 'C', 1);
                        $pdf->Cell(65, 5, sprintf("%.2f", (float)(($datos['monto'] / $habitacionTotal['monto'])) * 100), 1, 1, 'C', 1);
                    } else {
                        $pdf->SetFillColor(245, 242, 242);
                        $pdf->Cell(65, 5, utf8_decode($datos['nombre']), 1, 0, 'C', 1);
                        $pdf->Cell(66, 5, utf8_decode($datos['monto']), 1, 0, 'C', 1);
                        $pdf->Cell(65, 5, sprintf("%.2f", (float)(($datos['monto'] / $habitacionTotal['monto'])) * 100), 1, 1, 'C', 1);
                    }
                }
            }

            //agregar las categiras con ganancias cero
            $sw = false;
            foreach ($categorias as $categoria) {
                $sw = false;
                foreach ($datosHabitacion as $data) {
                    if ($categoria['nombre'] == $data['nombre']  && $habitacionTotal['mes'] == $data['mes']) {
                        $sw = true;
                        break;
                    }
                }
                if ($sw == false) {
                    $pdf->SetFillColor(243, 114, 114);
                    $pdf->Cell(65, 5, utf8_decode($categoria['nombre']), 1, 0, 'C', 1);
                    $pdf->Cell(66, 5, 0, 1, 0, 'C', 1);
                    $pdf->Cell(65, 5, 0, 1, 1, 'C', 1);
                }
            }
            $pdf->Ln();
        }
        $pdf->SetFillColor(184, 254, 136);
        $pdf->Cell(20, 5, '', 1, 0, 'C', 1);
        $pdf->Cell(70, 5, 'Categorias con mas ingresos por mes', 0, 1, 'C');
        $pdf->SetFillColor(243, 114, 114);
        $pdf->Cell(20, 5, '', 1, 0, 'C', 1);
        $pdf->Cell(70, 5, 'Categorias con cero ingresos por mes', 0, 1, 'C');


        $pdf->Output("ingresos_habitacion_categoria.pdf", "I");
    }


    public function getNombreMes($mes)
    {
        $meses = ["", "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
        return $meses[$mes];
    }


    //datos de ganancias por mes
    public function getDatosReporteHabitacionTotalMes($fecha_inicio, $fecha_fin)
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        $datosHabitacionTotal = $this->reporte->reporteHabitaciónCategoriaTotal($fecha_inicio, $fecha_fin);

        //para que trabaje el ajax correctamente, se convierte a json
        echo json_encode($datosHabitacionTotal);
    }

    public function getReportePorCategoria($fecha_inicio, $fecha_fin)
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        $datos = $this->reporte->reportePorCategoria($fecha_inicio, $fecha_fin);

        //para que trabaje el ajax correctamente, se convierte a json
        echo json_encode($datos);
    }

    public function getReportePorHospedajeMes($fecha_inicio, $fecha_fin)
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        $datos = $this->reporte->reporteHospedajePorMes($fecha_inicio, $fecha_fin);

        //para que trabaje el ajax correctamente, se convierte a json
        echo json_encode($datos);
    }

    public function getReportePorHospedajeSemana($fecha_inicio, $fecha_fin)
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        $datos = $this->reporte->reporteHospedajePorSemana($fecha_inicio, $fecha_fin);

        //para que trabaje el ajax correctamente, se convierte a json
        echo json_encode($datos);
    }


    public function calculaTotal($datos)
    {
        $total = 0; //para sacar el total
        foreach ($datos as $dato) {
            $total += $dato['monto'];
        }
        return $total;
    }
}
