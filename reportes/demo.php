<?php
/**
 * This is a demo script for the functions of the PHP ESC/POS print driver,
 * Escpos.php.
 *
 * Most printers implement only a subset of the functionality of the driver, so
 * will not render this output correctly in all cases.
 *
 * @author Michael Billington <michael.billington@gmail.com>
 */
 session_start();
 $usuario = $_SESSION['user_name'];
 require('../model/Venta_model.php');
 require('../controller/Venta_controller.php');
 require __DIR__ . '/ticket/autoload.php';
 use Mike42\Escpos\Printer;
 use Mike42\Escpos\EscposImage;
 use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

 class Producto{

 	public function __construct($nombre, $precio, $cantidad){
 		$this->nombre = $nombre;
 		$this->precio = $precio;
 		$this->cantidad = $cantidad;
 	}
 }

 /*
 	Vamos a simular algunos productos. Estos
 	podemos recuperarlos desde $_POST o desde
 	cualquier entrada de datos. Yo los declararé
 	aquí mismo
 */

 $productos = array(
 		new Producto("Papas fritas", 10, 1),
 		new Producto("Pringles", 22, 2),
 		/*
 			El nombre del siguiente producto es largo
 			para comprobar que la librería
 			bajará el texto por nosotros en caso de
 			que sea muy largo
 		*/
 		new Producto("Galletas saladas con un sabor muy salado y un precio excelente", 10, 1.5),
 	);

 /*
 	Aquí, en lugar de "POS-58" (que es el nombre de mi impresora)
 	escribe el nombre de la tuya. Recuerda que debes compartirla
 	desde el panel de control
 */

 $nombre_impresora = "EPSON TM-T20II Receipt";


 $connector = new WindowsPrintConnector($nombre_impresora);
 $printer = new Printer($connector);


 /*
 	Vamos a imprimir un logotipo
 	opcional. Recuerda que esto
 	no funcionará en todas las
 	impresoras

 	Pequeña nota: Es recomendable que la imagen no sea
 	transparente (aunque sea png hay que quitar el canal alfa)
 	y que tenga una resolución baja. En mi caso
 	la imagen que uso es de 250 x 250
 */

 # Vamos a alinear al centro lo próximo que imprimamos
 $printer->setJustification(Printer::JUSTIFY_CENTER);

 /*
 	Intentaremos cargar e imprimir
 	el logo
 */
 try{
 	$logo = EscposImage::load("logo.png", false);
     $printer->bitImage($logo);
 }catch(Exception $e){/*No hacemos nada si hay error*/}

 /*
 	Ahora vamos a imprimir un encabezado
 */

 $printer->text("Yo voy en el encabezado" . "\n");
 $printer->text("Otra linea" . "\n");
 #La fecha también
 $printer->text(date("Y-m-d H:i:s") . "\n");


 /*
 	Ahora vamos a imprimir los
 	productos
 */

 # Para mostrar el total
// $printer = new Escpos();
 /* Print top logo */
 //$printer->setJustification(Escpos::JUSTIFY_CENTER);
 /* Line spacing */
 /*
 $printer -> setEmphasis(true);
 $printer -> text("Line spacing\n");
 $printer -> setEmphasis(false);
 foreach(array(16, 32, 64, 128, 255) as $spacing) {
     $printer -> setLineSpacing($spacing);
     $printer -> text("Spacing $spacing: The quick brown fox jumps over the lazy dog. The quick brown fox jumps over the lazy dog.\n");
 }
 $printer -> setLineSpacing(); // Back to default
 */
 /* Stuff around with left margin */
 // Most simple example

// Most simple example
$printer->text("FACTURA \n");
$printer->text("Computel Peru S.A.C. \n");
$printer->text("Csan Jose N° 1122 Chiclayo-Lambayeque \n");
$printer->text("ruc: \n");
$printer->text("TICKET \n");
$printer->text("001-000040\n");
$printer->setEmphasis(false);
$printer->feed();
$printer->setJustification();
$printer->setFont(Printer::FONT_C);
$printer->feed();
$printer->text("#CAJA:16       20-02-2016 11:12:01\n");
$printer->text("Ticket                  <original>\n");
$printer->text("-------------------------------------\n");
$printer->text("TIPO:Efec. DNI N°:\n");
$printer->text("Cliente: BARTOLOME CURO\n");
$printer->feed();
$printer->text("Direccion: \n");
$printer->feed();
$printer->text("Cajero: admin\n");
$printer->text("Vendedor: .....\n");
$printer->text("-------------------------------------\n");
$printer->text("Descripcion \n");
$printer->text("Precio      cant           Total \n");
$printer->text("-------------------------------------\n");
$printer->text("Mantenimiento general\n");
$printer->text("60.00       1.00          60.00\n");
$printer->text("-------------------------------------\n");
$printer->text("IGV(18%)               S/.9.15\n");
$printer->text("Subtotal               S/.50.85\n");
$printer->text("Pago adelantado(anticipo)    0.00\n");
$printer->text("Vale de Consumo              0.00\n");

 /*Alimentamos el papel 3 veces*/
 $printer->feed(3);

 /*
 	Cortamos el papel. Si nuestra impresora
 	no tiene soporte para ello, no generará
 	ningún error
 */
 $printer->cut();

 /*
 	Por medio de la impresora mandamos un pulso.
 	Esto es útil cuando la tenemos conectada
 	por ejemplo a un cajón
 */
 $printer->pulse();

 /*
 	Para imprimir realmente, tenemos que "cerrar"
 	la conexión con la impresora. Recuerda incluir esto al final de todos los archivos
 */
 $printer->close();
 ?>
