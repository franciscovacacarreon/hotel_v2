<?php
//espacio de nombre para la ruta del archivo
namespace App\Models;

use CodeIgniter\Model;

class TemporalServicioModel extends Model
{

    protected $table      = 'temporalServicio';
    protected $primaryKey = 'id_temporalServicio';

    //id autoIncrement
    protected $useAutoIncrement = true;

    //como vamos a regresar las consultas, en este caso en un arreglo
    protected $returnType     = 'array';
    //utilizar eliminaciones de filas
    protected $useSoftDeletes = false;

    //ingresar el nombre de las columnas que estamos agregando, en este caso "unidades"
    protected $allowedFields = ['id_notaServicio', 
                                'id_servicio', 
                                'nro_servicio', 
                                'nombre',
                                'cantidad', 
                                'precio',
                                'subtotal',
                                'id_cliente',
                                'id_notaHospedaje',
                            ];

    // Dates
    //tipo de tiempo que utilizamos
    protected $useTimestamps = false;

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;


    //métodos 

    //consulta para mostrar si ya existe una compra temporal 
    public function porIdServicio_NotaServicio($id_servicio, $id_notaServicio) {
        $this->select('*');
        $this->where('id_notaServicio', $id_notaServicio);
        $this->where('id_servicio', $id_servicio);
        $datos = $this->get()->getRow(); //resultado de consulta como objeto
        return $datos;
    }

    //actualizar datos de la tabla temporal
    public function actualizarServicio_NotaServicio(
        $id_servicio, $id_notaServicio, $cantidad, $subtotal) {

            $this->set('cantidad', $cantidad);
            $this->set('subtotal', $subtotal);
            $this->where('id_servicio', $id_servicio);
            $this->where('id_notaServicio', $id_notaServicio);
            $this->update();
    }

    //insertar datos en la tabla temporal
    public function crear(
        $id_notaServicio,
        $id_servicio,
        $nro_servicio, //redundancia
        $nombre,
        $precio,
        $cantidad,
        $subtotal,
        $id_cliente,
        $id_notaHospedaje
    ) {
        $this->save([
            'id_notaServicio' => $id_notaServicio,
            'id_servicio' => $id_servicio,
            'nro_servicio' => $nro_servicio,
            'nombre' => $nombre,
            'precio' => $precio,
            'cantidad' => $cantidad,
            'subtotal' => $subtotal,
            'id_cliente' => $id_cliente,
            'id_notaHospedaje' => $id_notaHospedaje,
        ]);
    }

    //retornar el registro segun el id_notaServicio
    public function porIdNotaServicio($id_notaServicio){
        $this->select('*');
        $this->where('id_notaServicio', $id_notaServicio);
        $datos = $this->findAll();
        return $datos;
    }

    //eliminar el registro segun el id_servicio y id_notaServicio
    public function eliminarServicio_NotaServicio($id_servicio, $id_notaServicio){
        $this->where('id_servicio', $id_servicio);
        $this->where('id_notaServicio', $id_notaServicio);
        $this->delete(); //delete porque solo es una tabla temporal
    }

    //elimina el registro según la nota servicio
    public function eliminarNotaServicio($id_notaServicio){
        $this->where('id_notaServicio', $id_notaServicio);
        $this->delete(); //porque es una tabla temporal
    }
}
