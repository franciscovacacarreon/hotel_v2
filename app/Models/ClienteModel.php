<?php
//espacio de nombre para la ruta del archivo
namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;

class ClienteModel extends Model
{

    protected $table      = 'cliente';
    protected $primaryKey = 'id_cliente';

    //id autoIncrement
    protected $useAutoIncrement = true;

    //como vamos a regresar las consultas, en este caso en un arreglo
    protected $returnType     = 'array';
    //utilizar eliminaciones de filas
    protected $useSoftDeletes = false;

    //ingresar el nombre de las columnas que estamos agregando, en este caso "unidades"
    protected $allowedFields = [
        'ci',
        'telefono',
        'nombre',
        'paterno',
        'materno',
        'fecha_nacimiento',
        'sexo',
        'id_responsable',
        'estado',
    ];

    // Dates
    //tipo de tiempo que utilizamos
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    //si hay filas para crear, modificar, eliminar (guarda automaticamente la fecha al crear, eliminar o modificar, se necesita crear los campo fecha_alta, etc en la base de datos)
    protected $createdField  = 'fecha_ingreso';
    protected $updatedField  = 'fecha_edit';
    //protected $deletedField  = 'deleted_at'; (no se ocupará en este caso)

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;


    //Métodos

    //mostrar cliente
    public function mostrar()
    {
        return $this->where('estado', 1)->findAll();
    }

    //mostrar cliente por id
    public function mostrarId($id_cliente)
    {
        return $this->where('id_cliente', $id_cliente)->first();
    }

    //Crear un cliente
    public function crear(
        $ci,
        $telefono,
        $nombre,
        $paterno,
        $materno,
        $fecha_nacimiento,
        $sexo
    ) {
        $resultado = $this->save(
            [
                'ci' => $ci,
                'telefono' => $telefono,
                'nombre' => $nombre,
                'paterno' => $paterno,
                'materno' => $materno,
                'fecha_nacimiento' => $fecha_nacimiento,
                'sexo' => $sexo,
                'estado' => 1
            ]
        );
        return $resultado;
    }

    //editar un cliente
    public function editar(
        $id_cliente,
        $ci,
        $telefono,
        $nombre,
        $paterno,
        $materno,
        $fecha_nacimiento,
        $sexo
    ) {
        $resultado = $this->update(
            $id_cliente,
            [
                'ci' => $ci,
                'telefono' => $telefono,
                'nombre' => $nombre,
                'paterno' => $paterno,
                'materno' => $materno,
                'fecha_nacimiento' => $fecha_nacimiento,
                'sexo' => $sexo
            ]
        );
        return $resultado;
    }


    //mostrar los inactivos
    public function mostrarEliminados()
    {
        $resultado = $this->where('estado', '0')->findAll();;
        return $resultado;
    }

    //cambiar estado a inactivo
    public function eliminar($id_cliente)
    {
        $resultado = false;

        //hospedaje
        $sql = "SELECT cliente.*
                FROM cliente, notahospedaje
                WHERE notahospedaje.id_cliente = cliente.id_cliente
                AND notahospedaje.estado_hospedaje = 'En estadía'
                AND cliente.id_cliente = $id_cliente";

            $query = $this->db->query($sql);
            $datosCliente = $query->getResultArray();

        if (count($datosCliente) == 0) {
            //reserva
            $sql2 = "SELECT cliente.*
                    FROM cliente, reserva
                    WHERE reserva.id_cliente = cliente.id_cliente
                    AND reserva.estado_reserva = 'En reserva'
                    AND cliente.id_cliente = $id_cliente";

            $query2 = $this->db->query($sql2);
            $datosClienteReserva = $query2->getResultArray();
            if (count($datosClienteReserva) == 0) {
                $resultado = $this->update($id_cliente, ['estado' => '0']);
            }   
        }
        return $resultado;
    }

    //cambiar estado a activo
    public function restaurar($id_cliente)
    {
        $resultado = $this->update($id_cliente, ['estado' => '1']);
        return $resultado;
    }
}
