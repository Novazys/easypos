<?php
session_start();
$usuario = $_SESSION['user_name'];
require('../model/Venta_model.php');
require('../controller/Venta_controller.php');
require __DIR__ . '/ticket/autoload.php';
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

$objVenta = new Venta();
$fecha =  isset($_GET['day']) ? $_GET['day'] : '';
$fecha = DateTime::createFromFormat('d/m/Y', $fecha)->format('Y-m-d');
$datos = $objVenta->Imprimir_Ticket_Venta('0');
if($fecha == ""){

  $detalle = $objVenta->Imprimir_Corte_Z_Dia(date('Y-m-d'));

} else {

  $detalle = $objVenta->Imprimir_Corte_Z_Dia($fecha);

}
foreach ($datos as $row => $column) {

  $tipo_comprobante = $column["p_tipo_comprobante"];
  $empresa = $column["p_empresa"];
  $propietario = $column["p_propietario"];
  $direccion = $column["p_direccion"];
  $nit = $column["p_numero_nit"];
  $numero_resolucion_fact = $column["p_numero_resolucion_fact"];
  $fecha_resolucion = $column["p_fecha_resolucion"];
  $numero_resolucion = $column["p_numero_resolucion"];
  $serie = $column["p_serie"];
  $numero_comprobante = $column["p_numero_comprobante"];
  $empleado = $column["p_empleado"];
  $numero_venta = $column["p_numero_venta"];
  $fecha_venta = $column["p_fecha_venta"];
  $subtotal = $column["p_subtotal"];
  $exento = $column["p_exento"];
  $descuento = $column["p_descuento"];
  $total = $column["p_total"];
  $numero_productos = $column["p_numero_productos"];
  $desde = $column["p_desde"];
$hasta = $column["p_hasta"];
}

foreach ($detalle as $row => $column) {

  $p_desde_impreso = $column["p_desde_impreso"];
  $p_hasta_impreso = $column["p_hasta_impreso"];
  $p_venta_gravada = $column["p_venta_gravada"];
  $p_venta_iva = $column["p_venta_iva"];
  $p_total_exento = $column["p_total_exento"];
  $p_total_gravado = $column["p_total_gravado"];
  $p_total_descuento = $column["p_total_descuento"];
  $p_total_venta = $column["p_total_venta"];
}

$nit =  substr($nit, 0, 7).'-'.substr($nit, 7,9);


$nombre_impresora = trim(file(__DIR__ . '/impresora.ini')[0]);
/* Fill in your own connector here */
$connector = new WindowsPrintConnector($nombre_impresora);
$printer = new Printer($connector);
/* Name of shop */
$printer -> setJustification(Printer::JUSTIFY_CENTER);
$printer -> text($empresa."\n");
$printer -> selectPrintMode();
$printer -> text($direccion."\n");
$printer -> selectPrintMode();
$printer -> text('NIT : '.$nit."\n");
$printer -> selectPrintMode();
$printer -> text('Resolucion '.$numero_resolucion_fact.' del '.$fecha_resolucion."\n");
$printer -> selectPrintMode();
$printer -> text('Serie : '.$serie.' de '.$desde.' a '.$hasta."\n");
$printer -> selectPrintMode();
$printer -> text("Resolucion del Sistema \n");
$printer -> selectPrintMode();
$printer -> text($numero_resolucion.' de'.$fecha_resolucion."\n");
$printer -> selectPrintMode();
$printer -> text("------------------------------------------------");
$printer -> feed();
/* Title of receipt */
$printer -> setJustification(Printer::JUSTIFY_CENTER);
$printer -> selectPrintMode();
$printer -> text("CORTE Z - DIARIO \n \n");
$printer -> selectPrintMode();
$printer -> text("CAJA #1 | TICKET # ".$p_hasta_impreso." \n");
$printer -> selectPrintMode();
$printer -> text("FECHA Y HORA \n");
$printer -> selectPrintMode();
$printer -> text(DateTime::createFromFormat('Y-m-d', $fecha)->format('d/m/Y').' - '.date('H:i:s')."\n \n");
$printer -> selectPrintMode();
$printer -> text("TICKETS IMPRESOS \n");
$printer -> selectPrintMode();
$printer -> text('DESDE : '.$p_desde_impreso."\n");
$printer -> selectPrintMode();
$printer -> text('HASTA : '.$p_hasta_impreso."\n \n");
$printer -> selectPrintMode();
$printer -> text("DEVOLUCIONES : 0.00 \n \n");
$printer -> selectPrintMode();
$printer -> text("DESGLOCE VENTA \n \n");
$printer -> selectPrintMode();
$printer -> text("VENTA GRAVADA :              ".$p_venta_gravada."\n");
$printer -> selectPrintMode();
$printer -> text("VENTA IVA :                  ".$p_venta_iva."\n");
$printer -> selectPrintMode();
$printer -> text("TOTAL GRAVADO :              ".$p_total_gravado."\n");
$printer -> selectPrintMode();
$printer -> text("TOTAL EXENTO :               ".$p_total_exento."\n");
$printer -> selectPrintMode();
$printer -> text("TOTAL DESCUENTO :            ".$p_total_descuento."\n");
$printer -> selectPrintMode();
$printer -> text("------------------------------------------------");
$printer -> selectPrintMode();
$printer -> text("TOTAL VENTA :                ".$p_total_venta."\n");

$printer -> cut();
$printer -> pulse();
$printer -> close();

echo "<script>window.location.href = '../?View=Caja'</script>";
