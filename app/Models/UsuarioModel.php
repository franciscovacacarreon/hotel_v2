<?php
//espacio de nombre para la ruta del archivo
namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{

    protected $table      = 'usuario';
    protected $primaryKey = 'id_usuario';

    //id autoIncrement
    protected $useAutoIncrement = true;

    //como vamos a regresar las consultas, en este caso en un arreglo
    protected $returnType     = 'array';
    //utilizar eliminaciones de filas
    protected $useSoftDeletes = false;

    //ingresar el nombre de las columnas que estamos agregando, en este caso "unidades"
    protected $allowedFields = [
        'usuario',
        'password',
        'estado',
        'id_recepcionista',
        'id_cliente',
        'id_rol',
        'estado'
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


    //métodos 
    //mostrar usuarios
    public function mostrar()
    {
        $sql = "SELECT usuario.*, rol.nombre as rol, 
                CONCAT(recepcionista.nombre, ' ', recepcionista.paterno) as nombre_recepcionista
                FROM usuario, rol, recepcionista
                WHERE usuario.id_rol = rol.id_rol
                AND usuario.id_recepcionista = recepcionista.id_recepcionista
                AND usuario.estado = 1";

        $query = $this->db->query($sql);
        $datosHabitacionCategoria = $query->getResultArray();
        return $datosHabitacionCategoria;
    }

    //mostrar usuario según su id
    public function mostrarId($id_usuario)
    {
        return $this->where('id_usuario', $id_usuario)->first();
    }

    //mostrar el usuario segun su nombre de usuario
    public function mostrarPorUsuario($usuario)
    {
        $sql = "SELECT usuario.*, rol.nombre as rol
                FROM usuario, rol
                WHERE usuario.id_rol = rol.id_rol 
                AND usuario.estado = 1
                AND usuario.usuario = $usuario";

        $query = $this->db->query($sql);
        $datosHabitacionCategoria = $query->getResultArray();
        return $datosHabitacionCategoria;
    }

    //Crear usuario
    public function crear(
        $usuario,
        $password,
        $id_recepcionista,
        $id_cliente,
        $id_rol
    ) {
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $resultado = $this->save(
            [
                'usuario' => $usuario,
                'password' => $hash,
                'id_recepcionista' => $id_recepcionista,
                'id_cliente' => $id_cliente,
                'id_rol' => $id_rol,
                'estado' => 1,
            ]
        );
        //save retorna un booleano
        return $resultado;
    }

    //editar usuario
    public function editar(
        $id_usuario,
        $usuario,
        $password,
        $id_recepcionista,
        $id_cliente,
        $id_rol
    ) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $resultado = $this->update(
            $id_usuario,
            [
                'usuario' => $usuario,
                'password' => $hash,
                'id_recepcionista' => $id_recepcionista,
                'id_cliente' => $id_cliente,
                'id_rol' => $id_rol,
            ]
        );
        return $resultado;
    }

    //mostrar los inactivos
    public function mostrarEliminados()
    {
        $sql = "SELECT usuario.*, rol.nombre as rol, 
                CONCAT(recepcionista.nombre, ' ', recepcionista.paterno) as nombre_recepcionista
                FROM usuario, rol, recepcionista
                WHERE usuario.id_rol = rol.id_rol
                AND usuario.id_recepcionista = recepcionista.id_recepcionista
                AND usuario.estado = 0";

        $query = $this->db->query($sql);
        $datosHabitacionCategoria = $query->getResultArray();
        return $datosHabitacionCategoria;
    }


    //cambiar estado a inactivo
    public function eliminar($id_usuario)
    {
        return $this->update($id_usuario, ['estado' => '0']);
    }

    //cambiar estado a activo
    public function restaurar($id_usuario)
    {
        return $this->update($id_usuario, ['estado' => '1']);
    }
}
