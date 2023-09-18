<?php

namespace Controllers;

use Mpdf\Mpdf;
use MVC\Router;
use Model\Venta;
use Exception;

class VentaController
{
    public static function index(Router $router)
    {
        $router->render('ventas/index', []);
    }

    public static function buscarAPI()
    {
        $primera_fecha = $_GET['primera_fecha'];
        $segunda_fecha = $_GET['segunda_fecha'];
        
        // Formatear las fechas en el formato YYYY-MM-DD HH:MM
        $fechaInicioFormateada = date('Y-m-d H:i', strtotime($primera_fecha));
        $fechaFinFormateada = date('Y-m-d H:i', strtotime($segunda_fecha));

        // Construir la consulta SQL utilizando las fechas formateadas
        $sql = "
            SELECT
                v.venta_fecha AS fecha,
                dv.detalle_cantidad AS cantidad,
                p.producto_nombre AS producto,
                c.cliente_nombre AS cliente
            FROM
                ventas v
                INNER JOIN detalle_ventas dv ON v.venta_id = dv.detalle_venta
                INNER JOIN productos p ON dv.detalle_producto = p.producto_id
                INNER JOIN clientes c ON v.venta_cliente = c.cliente_id
            WHERE
                v.venta_fecha BETWEEN '{$fechaInicioFormateada}' AND '{$fechaFinFormateada}'";

        try {
            // Ejecutar la consulta SQL para obtener datos de ventas en el rango de fechas.
            $ventas = Venta::fetchArray($sql);
            echo json_encode($ventas);
        } catch (Exception $e) {
            echo json_encode([
                'error' => true,
                'message' => 'Ocurrió un error al buscar las ventas',
                'details' => $e->getMessage()
            ]);
        }
    }
}
