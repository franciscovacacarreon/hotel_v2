<?php
//espacio de nombre para la ruta del archivo
namespace App\Models;

use CodeIgniter\Model;

class CategoriaModel extends Model
{

    protected $table      = 'categoria';
    protected $primaryKey = 'id';

    //id autoIncrement
    protected $useAutoIncrement = true;

    //como vamos a regresar las consultas, en este caso en un arreglo
    protected $returnType     = 'array';
    //utilizar eliminaciones de filas
    protected $useSoftDeletes = false;

    //ingresar el nombre de las columnas que estamos agregando, en este caso "unidades"
    protected $allowedFields = ['precio', 'nombre', 'descripcion', 'estado'];

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
    
    //mostrar Categorias
    public function mostrar()
    {
        $categoriaConsulta = $this->where('estado', 1)->findAll();
        return $categoriaConsulta;
    }

    //mostrar categoria según su id
    public function mostrarId($id)
    {
        return $this->where('id', $id)->first();
    }

    //Crear categoria
    public function crear($precio, $nombre, $descripcion)
    {

        //validaciones del lado de backend (debatir)
        $resultado = $this->save(
            [
                'precio' => $precio,
                'nombre' => $nombre,
                'descripcion' => $descripcion,
                'estado' => 1
            ]
        );
        //save retorna un booleano
        return $resultado;
    }

    //editar categoria
    public function editar($id, $precio, $nombre, $descripcion)
    {
        $resultado = $this->update($id, [
            'precio' => $precio,
            'nombre' => $nombre,
            'descripcion' => $descripcion,
        ]);
        return $resultado;
    }

    //mostrar los inactivos
    public function mostrarEliminados()
    {
        $resultado = $this->where('estado', '0')->findAll();;
        return $resultado;
    }


    //cambiar estado a inactivo
    public function eliminar($id)
    {
        $resultado = false;
        //para no eliminar las categorias que tienen una habitacion
        $sql = "SELECT *FROM categoria, habitacion
                WHERE habitacion.id_categoria = categoria.id
                AND categoria.id = $id";
        $query = $this->db->query($sql);
        $datos = $query->getResultArray();
        if (count($datos) == 0) {
            $resultado = $this->update($id, ['estado' => '0']);
        } 
        return $resultado;
    }

    //cambiar estado a activo
    public function restaurar($id)
    {
        //true o false, (update, save) //pensar validaciones
        $resultado = $this->update($id, ['estado' => '1']);
        return $resultado;
    }
}
