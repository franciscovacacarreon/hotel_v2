<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\NotaServicioModel;
use App\Models\ClienteModel;
use App\Models\TemporalServicioModel;
use App\Models\DetalleServicioModel;
use App\Models\ConfiguracionModel;
use App\Models\ServicioModel;
use App\Models\NotaHospedajeModel;
use App\Models\DetalleRolPermisoModel;
use PDF;

class NotaServicio extends BaseController
{
    //tabla de la base de datos
    protected $notaservicio;
    protected $cliente;
    protected $temporal_servicio;
    protected $detalleservicio;
    protected $reglas; //  TERMINAR VALIDACIONES
    protected $configuracion;
    protected $servicio;
    protected $notahospedaje;
    protected $session;
    protected $detalleRol;

    public function __construct()
    {
        $this->notaservicio = new NotaServicioModel();
        $this->cliente = new ClienteModel();
        $this->temporal_servicio = new TemporalServicioModel();
        $this->detalleservicio = new DetalleServicioModel();
        $this->configuracion = new ConfiguracionModel();
        $this->servicio = new ServicioModel();
        $this->notahospedaje = new NotaHospedajeModel();
        $this->detalleRol = new DetalleRolPermisoModel();
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


    //validar permisos
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

    //metodo principal, mostrar nota de servicios
    public function getIndex()
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        if (!$this->verficarPermiso('Notas de servicio', 3)) {
            $this->getSinPermiso();
        } else {
            $NotaServicioConsulta = $this->notaservicio->mostrar();
            $data = ['titulo' => 'Nota de servicios', 'notaServicios' => $NotaServicioConsulta];
            echo view('templates/header');
            echo view('gestionarNotaServicio/mostrarNotaServicio', $data);
            echo view('templates/footer');
        }
    }


    //muestra la vista para crear una notaservicio 
    //(FALTA AÑADIR EL HOSPEDAJE)
    public function getCrear()
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        if (!$this->verficarPermiso('Nueva nota servicio', 3)) {
            $this->getSinPermiso();
        } else {
            $clientes = $this->cliente->mostrar();
            $servicios = $this->servicio->mostrar();
            $hospedajes = $this->notahospedaje->mostrar();
            $data = [
                'titulo' => 'Nueva nota de servicio',
                'clientes' => $clientes,
                'servicios' => $servicios,
                'notaHospedajes' => $hospedajes,
                'validation' => $this->validator
            ];
            echo view('templates/header');
            echo view('gestionarNotaServicio/crearNotaServicio', $data);
            echo view('templates/footer');
        }
    }

    //guardar el servicio en la nota de servicio
    public function postGuarda()
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        if (!$this->verficarPermiso('Nueva nota servicio', 3)) {
            return $this->getSinPermiso();
        }
        if ($this->validate($this->reglas)) {

            $id_notaServicio = $this->request->getPost('id_notaServicio'); //folio
            $id_cliente = $this->request->getPost('id_cliente');
            $id_notaHospedaje = $this->request->getPost('id_notaHospedaje');
            $total = $this->request->getPost('total');

            $session = session(); //para capturar el id_recepcionista

            //id de la nota servicio insertada recientemente, para insertar el detalle servicio
            $resultadoId = $this->notaservicio->insertaNotaServicio($id_notaServicio, $total, $session->id_recepcionista, $id_cliente, $id_notaHospedaje);

            //insertar los datos en el detalle servicio
            if ($resultadoId) {
                $resultadoNotaServicio = $this->temporal_servicio->porIdNotaServicio($id_notaServicio);

                foreach ($resultadoNotaServicio as $row) {
                    $this->detalleservicio->crear(
                        $resultadoId,
                        $row['id_servicio'],
                        $row['cantidad'],
                        $row['subtotal']
                    );
                }

                //eliminar el servicio temporal
                $this->temporal_servicio->eliminarNotaServicio($id_notaServicio);
            }
        }
        //redireccionar a la vista del pdf
        return redirect()->to(base_url() . "notaservicio/muestraNotaServicioPdf/" . $resultadoId);
    }

    //para mostrar la vista donde se genera el pdf
    public function getMuestraNotaServicioPdf($id_notaServicio)
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        $data['id_notaServicio'] = $id_notaServicio;
        echo view('templates/header');
        echo view('gestionarNotaServicio/verNotaServicioPdf', $data);
        echo view('templates/footer');
    }

    /*En config/Autoload.php, agregar la librería
    * Descargar la libreria fpdf y copiar dentro de la carpeta /app/ThirdParty
    * Agregar las librerias externas que se utilizará, para el pdf
    public $classmap = [
        'FPDF' => APPPATH . 'ThirdParty/fpdf/fpdf.php',
    ];*/

    //generar el pdf
    public function getGeneraNotaServicioPdf($id_notaServicio)
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        $datosNotaServicio = $this->notaservicio->mostrarNotaServicioId($id_notaServicio);
        $datosDetalleNotaServicio = $this->notaservicio->mostrarDetalleNotaServicio($id_notaServicio);
        $datosHotel = $this->configuracion->mostrar();

        //creando el pdf
        //orientacion, medida (ml), tamaño = letter = carta
        $pdf = new \FPDF('P', 'mm', 'letter');
        $pdf->AddPage();
        $pdf->SetMargins(10, 10, 10);
        $pdf->SetTitle("Servicios");
        $pdf->SetFont('Arial', 'B', 12);

        //Agregado una tabla
        //ancho, alto, titulo, bordes, salto de líne, posicion
        $pdf->Cell(195, 5, "Servicios realizados", 0, 1, 'C');

        //indicar que estamos trabajando con pdf
        $this->response->setHeader('Content-Type', 'application/pdf');

        $pdf->SetFont('Arial', 'B', 9); //reducir el tamaño de letra para el contenido
        $pdf->Cell(50, 5, utf8_decode($datosHotel['hotel_nombre']), 0, 1, 'L'); //L = left
        $pdf->Cell(20, 5, utf8_decode('Dirección: '), 0, 0, 'L'); //utf8_decode para acentos
        $pdf->SetFont('Arial', '', 9); //quitamos la negrita
        $pdf->Cell(50, 5,  utf8_decode($datosHotel['hotel_direccion']), 0, 1, 'L');

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(25, 5, utf8_decode('Fecha y hora: '), 0, 0, 'L');
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(50, 5, $datosNotaServicio['fecha_ingreso'], 0, 1, 'L');
        $pdf->Ln(); //salto de línea

        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetFillColor(27, 152, 238); //color fondo de la celda
        $pdf->SetTextColor(255, 255, 255); //color del texto
        $pdf->Cell(196, 5, 'Detalle de los servicios', 1, 1, 'C', 1); //ultimo uno, para indicar que tiene fondo
        $pdf->SetTextColor(0, 0, 0); //reestablacer el color del texto
        $pdf->Cell(14, 5, 'Nro', 1, 0, 'L');
        $pdf->Cell(40, 5, 'Nombre del servicio', 1, 0, 'L');
        $pdf->Cell(20, 5, 'Cantidad', 1, 0, 'L');
        $pdf->Cell(20, 5, 'Precio', 1, 0, 'L');
        $pdf->Cell(20, 5, 'Importe', 1, 0, 'L'); //es el subtotal
        $pdf->Cell(31, 5, 'Cliente', 1, 0, 'L');
        $pdf->Cell(20, 5, 'Hospedaje', 1, 0, 'L');
        $pdf->Cell(31, 5, 'Recepcionista', 1, 1, 'L');


        $pdf->SetFont('Arial', '', 8);
        $contador = 1;
        foreach ($datosDetalleNotaServicio as $row) {
            $pdf->Cell(14, 5, $contador, 1, 0, 'L');
            $pdf->Cell(40, 5, $row['nombre_servicio'], 1, 0, 'L');
            $pdf->Cell(20, 5, $row['cantidad_servicio'], 1, 0, 'L');
            $pdf->Cell(20, 5, $row['precio_servicio'], 1, 0, 'L');
            $pdf->Cell(20, 5, $row['sub_monto'], 1, 0, 'L'); //es el subtotal
            $pdf->Cell(31, 5, $row['nombre_cliente'], 1, 0, 'L');
            $pdf->Cell(20, 5, $row['id_notaHospedaje'], 1, 0, 'L');
            $pdf->Cell(31, 5, $row['nombre_recepcionista'], 1, 1, 'L');

            $contador++;
        }

        $pdf->Ln();
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(195, 5, 'Total Bs. ' . $datosNotaServicio['monto_total'], 0, 1, 'R');

        $pdf->image(base_url() . 'assets/img/iconoHotel.png', 185, 10, 20, 20, 'PNG');

        $pdf->Output("nota_servicio.pdf", "I");
    }
}
