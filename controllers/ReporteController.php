<?php
namespace Controllers;

use Mpdf\Mpdf;
use MVC\Router;
use Model\Venta;
use Exception;

class ReporteController {
    public static function pdf(Router $router){
        $primera_fecha = $_GET['primera_fecha'];
        $segunda_fecha = $_GET['segunda_fecha'];
        $ventas = VentaController::buscarAPI($primera_fecha, $segunda_fecha);

        $mpdf = new Mpdf([
            "orientation" => "P",
            "default_font_size" => 12,
            "default_font" => "arial",
            "format" => "Letter",
            "mode" => 'utf-8'
        ]);
        $mpdf->SetMargins(30, 35, 25);

        $html = self::loadReportHTML($router, $ventas);
        self::configurePDFHeaderFooter($mpdf, $router);

        $mpdf->WriteHTML($html);

        $mpdf->Output();
    }

    public static function generarPDF(Router $router) {
        $datos = json_decode(file_get_contents('php://input'));

        // Cargar una vista HTML con los datos
        $html = self::loadReportHTML($router, $datos);

        // Crear un objeto mPDF
        $mpdf = new Mpdf();

        // Configurar encabezado y pie de página si es necesario
        self::configurePDFHeaderFooter($mpdf, $router);

        // Agregar el contenido HTML al PDF
        $mpdf->WriteHTML($html);

        // Generar el PDF y mostrarlo o descargarlo
        $mpdf->Output();
    }

    private static function loadReportHTML(Router $router, $data) {
        return $router->load('reporte/pdf', [
            'ventas' => $data
        ]);
    }

    private static function configurePDFHeaderFooter(Mpdf $mpdf, Router $router) {
        $htmlHeader = $router->load('reporte/header');
        $htmlFooter = $router->load('reporte/footer');
        $mpdf->SetHTMLHeader($htmlHeader);
        $mpdf->SetHTMLFooter($htmlFooter);
    }
}
