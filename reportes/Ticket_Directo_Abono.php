<?php
session_start();
$usuario = $_SESSION['user_name'];
require('../model/Credito_model.php');
require('../controller/Credito_controller.php');
require __DIR__ . '/ticket/autoload.php';
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

$idabono =  base64_decode(isset($_GET['abono']) ? $_GET['abono'] : '');


$objCredito = new Credito();
$datos = $objCredito->Imprimir_Ticket_Abono($idabono);

foreach ($datos as $row => $column) {

  $empresa = $column["p_empresa"];
  $propietario = $column["p_propietario"];
  $direccion = $column["p_direccion"];
  $nit = $column["p_numero_nit"];

  $fecha_resolucion = $column["p_fecha_resolucion"];
  $numero_resolucion = $column["p_numero_resolucion"];
  $numero_resolucion_fact = $column["p_numero_resolucion_fact"];
  $serie = $column["p_serie"];

  $p_fecha_abono = $column["p_fecha_abono"];
  $p_monto_abono = $column["p_monto_abono"];
  $p_codigo_credito = $column["p_codigo_credito"];
  $p_monto_credito = $column["p_monto_credito"];
  $p_monto_abonado = $column["p_monto_abonado"];
  $p_monto_restante = $column["p_monto_restante"];
  $p_total_abonado = $column["p_total_abonado"];
  $p_restante_credito = $column["p_restante_credito"];
  $moneda = $column["p_moneda"];
  $simbolo = $column["p_simbolo"];
  $cliente = $column["p_cliente"];
  $usuario = $column["p_usuario"];
  $desde = $column["p_desde"];
  $hasta = $column["p_hasta"];
}

$p_fecha_abono = DateTime::createFromFormat('Y-m-d H:i:s', $p_fecha_abono)->format('d/m/Y H:i:s');


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
$printer -> text("TICKET DE ABONO A CREDITO \n");
$printer -> selectPrintMode();
$printer -> text( $p_codigo_credito."\n");
$printer -> selectPrintMode();
$printer -> text("CAJA #1 \n");
$printer -> selectPrintMode();
$printer -> text("FECHA Y HORA \n");
$printer -> selectPrintMode();
$printer -> text($p_fecha_abono."\n");
$printer -> selectPrintMode();
$printer -> text("ABONO POR \n");
$printer -> selectPrintMode();
$printer -> text($simbolo.' '.$p_monto_abono."\n");
$printer -> feed(3);
$printer -> selectPrintMode();
$printer -> text("Total Credito :                 ".$simbolo.' '.$p_monto_credito."\n");
$printer -> selectPrintMode();
$printer -> text("Total Abonado :                 ".$simbolo.' '.$p_total_abonado."\n");
$printer -> selectPrintMode();
$printer -> text("Total Pendiente :               ".$simbolo.' '.$p_restante_credito."\n");
$printer -> feed(3);
$printer -> selectPrintMode();
$printer -> text("------------------------------------------------ \n");
$printer -> selectPrintMode();
$printer -> text($cliente."\n");
$printer -> selectPrintMode();
$printer -> text("******************** ORIGINAL ****************** \n");
$printer -> selectPrintMode();
$printer -> text("Abonado por : ".$usuario." \n");
/* Cut the receipt and open the cash drawer */
$printer -> cut();
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
$printer -> setJustification(Printer::JUSTIFY_CENTER);
$printer -> selectPrintMode();
$printer -> text("TICKET DE ABONO A CREDITO \n");
$printer -> selectPrintMode();
$printer -> text( $p_codigo_credito."\n");
$printer -> selectPrintMode();
$printer -> text("CAJA #1 \n");
$printer -> selectPrintMode();
$printer -> text("FECHA Y HORA \n");
$printer -> selectPrintMode();
$printer -> text($p_fecha_abono."\n");
$printer -> selectPrintMode();
$printer -> text("ABONO POR \n");
$printer -> selectPrintMode();
$printer -> text($simbolo.' '.$p_monto_abono."\n");
$printer -> feed(3);
$printer -> selectPrintMode();
$printer -> text("Total Credito :                 ".$simbolo.' '.$p_monto_credito."\n");
$printer -> selectPrintMode();
$printer -> text("Total Abonado :                 ".$simbolo.' '.$p_total_abonado."\n");
$printer -> selectPrintMode();
$printer -> text("Total Pendiente :               ".$simbolo.' '.$p_restante_credito."\n");
$printer -> feed(3);
$printer -> selectPrintMode();
$printer -> text("------------------------------------------------ \n");
$printer -> selectPrintMode();
$printer -> text($cliente."\n");
$printer -> selectPrintMode();
$printer -> text("***************** COPIA CLIENTE **************** \n");
$printer -> selectPrintMode();
$printer -> text("Abonado por : ".$usuario." \n");
$printer -> cut();
$printer -> pulse();
$printer -> close();

	echo "<script>window.location.href = '../?View=Creditos'</script>";
