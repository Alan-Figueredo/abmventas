<?php
    header('Content-type: text/csv; charset-utf-8');
    header('Content-Disposition: attachment; filename=reporte.csv');
    include_once "config.php";
    include_once "entidades/venta.php";
    $venta = new Venta();


$aVentas = $venta->obtenerTodos();
$fp = fopen('reporte.csv', 'w');
$titulo = array("Fecha","Cliente", "Producto", "Cantidad", "Total");
fputcsv($fp, $titulo, ";");
foreach ($aVentas as $item) {
    fputcsv($fp, array($item->fecha,
                       $item->nombre_cliente,
                       $item->nombre_producto,
                       $item->cantidad,
                       $item->total) , ";");
}
fclose($fp);
?>