<?php
//espacio de nombre para la ruta del archivo
namespace App\Models;

use CodeIgniter\Model;

class DetalleHospedajeModel extends Model
{

    protected $table      = 'detallehospedaje';
    //protected $primaryKey = 'id';

    //id autoIncrement
    //protected $useAutoIncrement = true;

    //como vamos a regresar las consultas, en este caso en un arreglo
    protected $returnType     = 'array';
    //utilizar eliminaciones de filas
    protected $useSoftDeletes = false;

    //ingresar el nombre de las columnas que estamos agregando, en este caso "unidades"
    protected $allowedFields = ['id_notaHospedaje', 
                                'nro_habitacion', 
                                'cantidad_dias', 
                                'sub_monto',
                                'id_cliente',
                            ];

    // Dates
    //tipo de tiempo que utilizamos
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    //si hay filas para crear, modificar, eliminar (guarda automaticamente la fecha al crear, eliminar o modificar, se necesita crear los campo fecha_alta, etc en la base de datos)
    protected $createdField  = 'fecha_ingreso';
    protected $updatedField  = '';
    //protected $deletedField  = 'deleted_at'; (no se ocupará en este caso)

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;

    //métodos 
    public function crear (
        $id_notaHospedaje, 
        $nro_habitacion, 
        $cantidad_dias, 
        $sub_monto,
        $id_cliente
        ) {
        $this->save([
            'id_notaHospedaje' => $id_notaHospedaje,
            'nro_habitacion' => $nro_habitacion,
            'cantidad_dias' => $cantidad_dias,
            'sub_monto' => $sub_monto,
            'id_cliente' => $id_cliente,
        ]);
    }

    //mostrar detalle segun id_notaHospedaje
    public function mostrarDetalleHospedaje($id_notaHospedaje){
        return $this->where('id_notaHospedaje', $id_notaHospedaje)->findAll();
    }
}
