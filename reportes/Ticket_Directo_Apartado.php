<?php
session_start();
$usuario = $_SESSION['user_name'];
require('../model/Apartado_model.php');
require('../controller/Apartado_controller.php');
require __DIR__ . '/ticket/autoload.php';
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

	$idapartado =  base64_decode(isset($_GET['num']) ? $_GET['num'] : '');


$objApartado = new Apartado();

if($idapartado == ""){
  $detalle = $objApartado->Imprimir_Ticket_DetalleApartado('0');
  $datos = $objApartado->Imprimir_Ticket_Apartado('0');
} else {
  $detalle = $objApartado->Imprimir_Ticket_DetalleApartado($idapartado);
  $datos = $objApartado->Imprimir_Ticket_Apartado($idapartado);
}

foreach ($datos as $row => $column) {


  $empresa = $column["p_empresa"];
  $propietario = $column["p_propietario"];
  $direccion = $column["p_direccion"];
  $nit = $column["p_numero_nit"];

  $fecha_resolucion = $column["p_fecha_resolucion"];
  $numero_resolucion = $column["p_numero_resolucion"];
  $numero_resolucion_fact = $column["p_numero_resolucion_fact"];
  $serie = $column["p_serie"];
  $empleado = $column["p_empleado"];
  $numero_apartado = $column["p_numero_apartado"];
  $fecha_apartado = $column["p_fecha_apartado"];
  $subtotal = $column["p_subtotal"];
  $exento = $column["p_exento"];
  $descuento = $column["p_descuento"];
  $total = $column["p_total"];
  $numero_productos = $column["p_numero_productos"];
  $restante_pagar = $column["p_restante_pagar"];
  $abonado_apartado = $column["p_abonado_apartado"];
  $fecha_limite_retiro = $column["p_fecha_limite_retiro"];
  $moneda = $column["p_moneda"];
  $estado = $column["p_estado"];
  $diferencia = $column["p_diferencia_fechas"];
      $desde = $column["p_desde"];
$hasta = $column["p_hasta"];
}

$nit =  substr($nit, 0, 7).'-'.substr($nit, 7,9);


$fecha_limite_retiro = DateTime::createFromFormat('Y-m-d H:i:s', $fecha_limite_retiro)->format('d/m/Y H:i:s');


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
$printer -> setJustification(Printer::JUSTIFY_LEFT);
$printer -> selectPrintMode();
$printer -> text("NO. APARTADO : ".$numero_apartado."          CAJA NO. 1 \n");
$printer -> selectPrintMode();
$printer -> text('FECHA DE APARTADO : '.$fecha_apartado."\n");
$printer -> selectPrintMode();
$printer -> text("CAJERO : ".$usuario."\n");
$printer -> selectPrintMode();
$printer -> text("------------------------------------------------");
$printer -> selectPrintMode();
$printer -> text("CANTID      DESCRIPCION      PRECIO       TOTAL \n");
$printer -> selectPrintMode();
$printer -> text("------------------------------------------------");
$printer -> selectPrintMode();
while($row = $detalle->fetch(PDO::FETCH_ASSOC)) {
  $printer -> text($row['cantidad']."      ".$row['descripcion']."      ".$row['precio_unitario']."     ".$row['importe']);
  $printer -> text("\n");
}
$printer -> selectPrintMode();
$printer -> text("------------------------------------------------ \n");

$printer -> selectPrintMode();
$printer -> text("G = GRAVADO      E = EXENTO \n \n");
$printer -> selectPrintMode();
$printer -> text("SUBTOTAL :                              ".$subtotal."\n");
$printer -> selectPrintMode();
$printer -> text("EXENTO :                                ".$exento."\n");
$printer -> selectPrintMode();
$printer -> text("GRAVADO :                               ".$subtotal."\n");
$printer -> selectPrintMode();
$printer -> text("DESCUENTO :                            - ".$descuento."\n");
$printer -> selectPrintMode();
$printer -> text("TOTAL A PAGAR:                          ".$total."\n");

$printer -> selectPrintMode();
$printer -> text("------------------------------------------------ \n");
$printer -> selectPrintMode();
$printer -> text("Numero de Productos:    ".$numero_productos."\n");
$printer -> selectPrintMode();
$printer -> text("Abonado:                ".$abonado_apartado."\n");
$printer -> selectPrintMode();
$printer -> text("Restante:              ".$restante_pagar."\n");

$printer -> selectPrintMode();
$printer -> text("------------------------------------------------ \n");
$printer -> selectPrintMode();
$printer -> text("PRECIOS EN :        ".$moneda."\n");

/* Footer */
$printer -> feed(2);
$printer -> setJustification(Printer::JUSTIFY_CENTER);
$printer -> selectPrintMode();
$printer -> text("GRACIAS POR SU COMPRA\n");
$printer -> selectPrintMode();
$printer -> text("* Recuerde que tiene un total de :".$diferencia." dias \n");
$printer -> selectPrintMode();
$printer -> text("(hasta el ".$fecha_limite_retiro."), \n");
$printer -> selectPrintMode();
$printer -> text("para poder saldar su apartado. De caso \n");
$printer -> selectPrintMode();
$printer -> text("contrario este quedara anulado y el \n");
$printer -> selectPrintMode();
$printer -> text("producto puede agotarse en existencia \n");
$printer->barcode($numero_apartado, Printer::BARCODE_CODE39);
$printer -> feed();
$printer -> text($numero_apartado."\n");
$printer -> feed(2);
//$printer -> text($date . "\n");
/* Cut the receipt and open the cash drawer */
$printer -> cut();
$printer -> pulse();
$printer -> close();

	echo "<script>window.location.href = '../?View=POS-A'</script>";
