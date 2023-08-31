<?php
//espacio de nombre para la ruta del archivo
namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;

class ReporteModel extends Model
{
    public function reporServicioPorMes($fecha_inicio, $fecha_fin)
    {
        $sql = "SELECT tiposervicio.nombre, 
                SUM(detalleservicio.sub_monto) as monto, 
                tiposervicio.descripcion, 
                MONTH(notaservicio.fecha_ingreso) as mes
                FROM tiposervicio, servicio, detalleservicio, notaservicio
                WHERE servicio.id_tipoServicio = tiposervicio.id_tipoServicio 
                AND detalleservicio.id_notaServicio = notaservicio.id_notaServicio
                AND detalleservicio.id_servicio = servicio.id_servicio
                AND notaservicio.fecha_ingreso BETWEEN '$fecha_inicio' AND '$fecha_fin'
                GROUP BY MONTH(notaservicio.fecha_ingreso)
                ORDER BY MONTH(notaservicio.fecha_ingreso) ASC";

        $query = $this->db->query($sql);
        $datos = $query->getResultArray();
        return $datos;
    }

    public function reporServicioPorMesDetalle($fecha_inicio, $fecha_fin)
    {
        $sql = "SELECT tiposervicio.id_tipoServicio, 
                tiposervicio.nombre, 
                SUM(detalleservicio.sub_monto) as monto, 
                tiposervicio.descripcion, 
                MONTH(notaservicio.fecha_ingreso) as mes
                FROM tiposervicio, servicio, detalleservicio, notaservicio
                WHERE servicio.id_tipoServicio = tiposervicio.id_tipoServicio 
                AND detalleservicio.id_notaServicio = notaservicio.id_notaServicio
                AND detalleservicio.id_servicio = servicio.id_servicio
                AND notaservicio.fecha_ingreso BETWEEN '$fecha_inicio' AND '$fecha_fin'
                GROUP BY MONTH(notaservicio.fecha_ingreso), tiposervicio.nombre
                ORDER BY MONTH(notaservicio.fecha_ingreso) ASC";

        $query = $this->db->query($sql);
        $datos = $query->getResultArray();
        return $datos;
    }

    public function reporServicioDetallePorTipo($fecha_inicio, $fecha_fin, $id_tipoServicio, $mes)
    {
        $sql = "SELECT
                        servicio.nombre as nombre_servicio,
                        tiposervicio.nombre as nombre_tipoServicio, 
                        SUM(detalleservicio.sub_monto) as monto, 
                        tiposervicio.descripcion, 
                        MONTH(notaservicio.fecha_ingreso) as mes
                        FROM tiposervicio, servicio, detalleservicio, notaservicio
                        WHERE servicio.id_tipoServicio = tiposervicio.id_tipoServicio 
                        AND detalleservicio.id_notaServicio = notaservicio.id_notaServicio
                        AND detalleservicio.id_servicio = servicio.id_servicio
                        AND tiposervicio.id_tipoServicio = $id_tipoServicio
                        AND MONTH(notaservicio.fecha_ingreso) = $mes
                        GROUP BY MONTH(notaservicio.fecha_ingreso), servicio.nombre
                        ORDER BY MONTH(notaservicio.fecha_ingreso) ASC";

        $query = $this->db->query($sql);
        $datos = $query->getResultArray();
        return $datos;
    }

    public function reporteServicioTotal($fecha_inicio, $fecha_fin){
        $sql = "SELECT tiposervicio.nombre, 
                SUM(detalleservicio.sub_monto) as monto, 
                tiposervicio.descripcion
                FROM tiposervicio, servicio, detalleservicio, notaservicio
                WHERE servicio.id_tipoServicio = tiposervicio.id_tipoServicio 
                AND detalleservicio.id_notaServicio = notaservicio.id_notaServicio
                AND detalleservicio.id_servicio = servicio.id_servicio
                AND notaservicio.fecha_ingreso BETWEEN '$fecha_inicio' AND '$fecha_fin'
                GROUP BY tiposervicio.nombre";

        $query = $this->db->query($sql);
        $datos = $query->getResultArray();
        return $datos;
    }

    public function reporteHabitaciónCategoria($fecha_inicio, $fecha_fin)
    {
        $sql = "SELECT categoria.nombre, SUM(detallehospedaje.sub_monto) as monto, 
                MONTH(notahospedaje.fechaEntrada) as mes
                FROM categoria, habitacion, detallehospedaje, notahospedaje
                WHERE categoria.id = habitacion.id_categoria 
                AND habitacion.nro_habitacion = detallehospedaje.nro_habitacion
                AND notahospedaje.id_notaHospedaje = detallehospedaje.id_notaHospedaje
                AND categoria.estado = 1
                AND notahospedaje.fechaEntrada BETWEEN '$fecha_inicio' AND '$fecha_fin'
                GROUP BY categoria.nombre, MONTH(notahospedaje.fechaEntrada)
                ORDER BY MONTH(notahospedaje.fechaEntrada) ASC";
        $query = $this->db->query($sql);
        $datos = $query->getResultArray();
        return $datos;
    }

    public function reporteHabitaciónCategoriaTotal($fecha_inicio, $fecha_fin)
    {
        $sql = "SELECT SUM(detallehospedaje.sub_monto) as monto, MONTH(notahospedaje.fechaEntrada) as mes
                FROM categoria, habitacion, detallehospedaje, notahospedaje
                WHERE categoria.id = habitacion.id_categoria 
                AND habitacion.nro_habitacion = detallehospedaje.nro_habitacion
                AND notahospedaje.id_notaHospedaje = detallehospedaje.id_notaHospedaje
                AND categoria.estado = 1
                AND notahospedaje.fechaEntrada BETWEEN '$fecha_inicio' AND '$fecha_fin'
                GROUP BY MONTH(notahospedaje.fechaEntrada)";
        $query = $this->db->query($sql);
        $datos = $query->getResultArray();
        return $datos;
    }

    public function reporteHabitaciónCategoriaMes($fecha_inicio, $fecha_fin, $mes)
    {
        $sql = "SELECT categoria.nombre, SUM(detallehospedaje.sub_monto) as monto, 
                MONTH(notahospedaje.fechaEntrada) as mes
                FROM categoria, habitacion, detallehospedaje, notahospedaje
                WHERE categoria.id = habitacion.id_categoria 
                AND habitacion.nro_habitacion = detallehospedaje.nro_habitacion
                AND notahospedaje.id_notaHospedaje = detallehospedaje.id_notaHospedaje
                AND categoria.estado = 1
                AND notahospedaje.fechaEntrada BETWEEN '$fecha_inicio' AND '$fecha_fin'
                AND MONTH(notahospedaje.fechaEntrada) = $mes
                GROUP BY categoria.nombre, MONTH(notahospedaje.fechaEntrada)
                ORDER BY SUM(detallehospedaje.sub_monto) DESC
                LIMIT 1";
        $query = $this->db->query($sql);
        $datos = $query->getRowArray();
        return $datos;
    }

    public function reportePorCategoria($fecha_inicio, $fecha_fin)
    {
        $sql = "SELECT categoria.nombre, SUM(detallehospedaje.sub_monto) as monto
                FROM categoria, habitacion, detallehospedaje, notahospedaje
                WHERE categoria.id = habitacion.id_categoria 
                AND habitacion.nro_habitacion = detallehospedaje.nro_habitacion
                AND notahospedaje.id_notaHospedaje = detallehospedaje.id_notaHospedaje
                AND categoria.estado = 1
                AND notahospedaje.fechaEntrada BETWEEN '$fecha_inicio' AND '$fecha_fin'
                GROUP BY categoria.nombre";
        $query = $this->db->query($sql);
        $datos = $query->getResultArray();
        return $datos;
    }

    public function reporteHospedajePorMes($fecha_inicio, $fecha_fin){
        $sql = "SELECT SUM(notahospedaje.monto_total) as monto, 
                       COUNT(notahospedaje.id_notaHospedaje) as cantidad,
                       MONTH(notahospedaje.fechaEntrada) as mes
                FROM notahospedaje
                WHERE notahospedaje.fechaEntrada BETWEEN '$fecha_inicio' AND '$fecha_fin'
                GROUP BY MONTH(notahospedaje.fechaEntrada)
                ORDER BY MONTH(notahospedaje.fechaEntrada)";
        $query = $this->db->query($sql);
        $datos = $query->getResultArray();
        return $datos;
    }

    public function reporteHospedajePorSemana($fecha_inicio, $fecha_fin){
        $sql = "SELECT 
                    YEARWEEK(notahospedaje.fechaEntrada) AS semana,
                    COUNT(notahospedaje.id_notaHospedaje) as cantidad,
                    SUM(notahospedaje.monto_total) as monto, 
                    MONTH(notahospedaje.fechaEntrada) as mes
                FROM notahospedaje
                WHERE notahospedaje.fechaEntrada BETWEEN '$fecha_inicio' AND '$fecha_fin'
                GROUP BY semana, mes
                ORDER BY semana";
        $query = $this->db->query($sql);
        $datos = $query->getResultArray();
        return $datos;
    }

    public function reporteHospedajeTotal($fecha_inicio, $fecha_fin){
        $sql = "SELECT SUM(notahospedaje.monto_total) as monto_total,
                       COUNT(notahospedaje.id_notaHospedaje) as cantidad_nota
                FROM notahospedaje
                WHERE notahospedaje.fechaEntrada BETWEEN '$fecha_inicio' AND '$fecha_fin'";
        $query = $this->db->query($sql);
        $datos = $query->getRowArray();
        return $datos;
    }
}
