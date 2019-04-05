<?php
  require('fpdf/fpdf.php');
  $idcotizacion =  base64_decode(isset($_GET['cotizacion']) ? $_GET['cotizacion'] : '');

  try
  {
  function __autoload($className){
            $model = "../model/". $className ."_model.php";
            $controller = "../controller/". $className ."_controller.php";

           require_once($model);
           require_once($controller);
    }

    $objCotizacion =  new Cotizacion();
    $listado = $objCotizacion->Listar_Detalle($idcotizacion);

    $param_moneda = $objCotizacion->Ver_Moneda_Reporte();
    foreach ($param_moneda as $row => $column) {
        $moneda = $column['CurrencyName'];
    }

    $info = $objCotizacion->Listar_Info($idcotizacion);

    if (is_array($info) || is_object($info)){
    	foreach ($info as $row => $column) {
    		$numero_cotizacion = $column["numero_cotizacion"];
    		$fecha_cotizacion = $column["fecha_cotizacion"];
        $fecha_cotizacion = DateTime::createFromFormat('Y-m-d H:i:s', $fecha_cotizacion)->format('d/m/Y H:i:s');
    		$tipo_pago = $column["tipo_pago"];
    		$a_nombre = $column["a_nombre"];
    		$entrega = $column["entrega"];
    		$sumas = $column["sumas"];
    		$iva = $column["iva"];
    		$subtotal = $column["subtotal"];
    		$total_exento = $column["total_exento"];
    		$retenido = $column["retenido"];
    		$total_descuento = $column["total_descuento"];
    		$total = $column["total"];
        $empleado = $column["empleado"];
        $direccion_cliente = $column["direccion_cliente"];
        $nit = $column['numero_nit'];
        $nit_cliente =  substr($nit, 0, 4).'-'.substr($nit, 4, 6).'-'.substr($nit, 10, 3).'-'.substr($nit, 13);
        $telefono = $column['numero_telefono'];
        $telefono =  substr($telefono, 0, 4).'-'.substr($telefono, 4);
        $email = $column['email'];

    	}
    }


    $objParametro =  new Parametro();
    $filas = $objParametro->Listar_Parametros();

    if (is_array($filas) || is_object($filas))
    {
        foreach ($filas as $row => $column)
        {
          $empresa = $column['nombre_empresa'];
          $propietario = $column['propietario'];
          $direccion_empresa = $column['direccion_empresa'];
          $nit = $column['numero_nit'];
          $nit =  substr($nit, 0, 7).'-'.substr($nit, 7,9);

        }
    }



    $pdf = new FPDF('P','mm','Letter');
    $pdf->AddPage();
    $pdf->AliasNbPages();
    $pdf->SetFont('Arial','B',16);
    $pdf->setXY(10,6);
    $pdf->Cell(40,10,$empresa);


    $pdf->setXY(129,36);
    $pdf->SetFont('Arial','',14);
    $pdf->Cell(46,8,'NO. COTIZACION : ');
    $pdf->SetFont('Arial','B',14);
    $pdf->Cell(37,8,$numero_cotizacion);
    $pdf->SetFont('Arial','',10);

    $pdf->setXY(10,6);
    $pdf->Cell(50,20,$propietario);
    $pdf->setX(10);
    $pdf->Cell(2,30,$direccion_empresa);
    $pdf->setX(10);
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(2,40,'NIT : ');
    $pdf->setX(60);

    $pdf->SetFont('Arial','',10);
    $pdf->setX(19);
    $pdf->Cell(2,40,$nit);


    $pdf->SetFont('Arial','',14);


    $pdf->SetFont('Arial','',11);
    $pdf->setXY(10,32);
    $pdf->Cell(44,7,'FECHA DE CREACION : ');
    $pdf->SetFont('Arial','B',11);
    $pdf->Cell(38,7,$fecha_cotizacion);

    $pdf->SetFont('Arial','',11);
    $pdf->setXY(10,38);
    $pdf->Cell(34,6,'COTIZADO POR : ');
    $pdf->SetFont('Arial','B',11);
    $pdf->Cell(82,6,$empleado);
    $pdf->Line(210,44,10,44);


    $pdf->SetFont('Arial','',13);
    $pdf->setXY(10,43);
    $pdf->Cell(25,10,'CLIENTE : ');
    $pdf->SetFont('Arial','B',13);
    $pdf->Cell(20,10,$a_nombre);
    $pdf->setXY(10,50);
    $pdf->SetFont('Arial','',8.5);
    $pdf->Cell(150,5,$direccion_cliente);
    $pdf->setXY(10,52);
    $pdf->SetFont('Arial','B',8.5);
    $pdf->Cell(2,10,'NIT : ');
    $pdf->setXY(18,52);
    $pdf->SetFont('Arial','',8.5);
    $pdf->Cell(2,10,$nit_cliente);
    $pdf->setXY(47,52);
    $pdf->SetFont('Arial','B',8.5);
    $pdf->Cell(2,10,'Telefono : ');
    $pdf->SetFont('Arial','',8.5);
    $pdf->setXY(63,52);
    $pdf->Cell(2,10,$telefono);
    $pdf->SetFont('Arial','B',8.5);
    $pdf->setXY(80,52);
    $pdf->Cell(2,10,'Email : ');
    $pdf->SetFont('Arial','',8.5);
    $pdf->setXY(91,52);
    $pdf->Cell(2,10,$email);

    $pdf->Line(210,60,10,60);
    $pdf->Ln(10);

    $pdf->SetFillColor(172,172,172);
    $pdf->Cell(23,5,'Cant.',1,0,'L',1);
    $pdf->Cell(85,5,'Producto',1,0,'L',1);
    $pdf->Cell(23,5,'Precio',1,0,'C',1);
    $pdf->Cell(23,5,'Exento',1,0,'C',1);
    $pdf->Cell(23,5,'Descuento',1,0,'C',1);
    $pdf->Cell(23,5,'Total',1,0,'C',1);
    $pdf->SetFillColor(255,255,255);
    $pdf->Ln(5);

    if (is_array($listado) || is_object($listado))
    {
        foreach ($listado as $row => $column) {

        $pdf->setX(10);
        $pdf->Cell(23,5,$column["cantidad"],1,0,'L',1);
        $pdf->Cell(85,5,$column["nombre_producto"],1,0,'L',1);
        $pdf->Cell(23,5,$column["precio_unitario"],1,0,'C',1);
        $pdf->Cell(23,5,$column["exento"],1,0,'C',1);
        $pdf->Cell(23,5,$column["descuento"],1,0,'C',1);
        $pdf->Cell(23,5,$column["importe"],1,0,'C',1);
        $pdf->Ln(5);
        $get_Y = $pdf->GetY();
      }

      $pdf->SetFont('Arial','B',8.5);
      $pdf->Cell(144,35,'',1,0,'C',1);
      $pdf->Text(60,$get_Y + 5,'NOTAS IMPORTANTES');
      $pdf->SetFont('Arial','',8.5);
      $pdf->Text(15,$get_Y + 12,'1 - PRECIOS SUJETOS EN '.strtoupper($moneda).', SUJETOS A CAMBIO');
      $pdf->Text(19.5,$get_Y + 16,'SIN PREVIO AVISO Y POR TIPO DE CAMBIO.');
      $pdf->Text(15,$get_Y + 23,'2 - TIEMPO DE ENTREGA : '.$entrega.'.');
      $pdf->Text(15,$get_Y + 30,'3 - FORMA DE PAGO: '.$tipo_pago.'.');
      $pdf->setX(154);
      $pdf->SetFillColor(172,172,172);
      $pdf->SetFont('Arial','B',8.5);
      $pdf->Cell(33,5,'SUMAS',1,0,'R',1);
      $pdf->SetFont('Arial','',8.5);
      $pdf->SetFillColor(255,255,255);
      $pdf->Cell(23,5,$sumas,1,0,'C',1);
      $pdf->Ln(5);
      $pdf->setX(154);
      $pdf->SetFillColor(172,172,172);
      $pdf->SetFont('Arial','B',8.5);
      $pdf->Cell(33,5,'IVA',1,0,'R',1);
      $pdf->SetFillColor(255,255,255);
      $pdf->SetFont('Arial','',8.5);
      $pdf->Cell(23,5,$iva,1,0,'C',1);
      $pdf->Ln(5);
      $pdf->setX(154);
      $pdf->SetFillColor(172,172,172);
      $pdf->SetFont('Arial','B',8.5);
      $pdf->Cell(33,5,'SUBTOTAL',1,0,'R',1);
      $pdf->SetFillColor(255,255,255);
      $pdf->SetFont('Arial','',8.5);
      $pdf->Cell(23,5,$subtotal,1,0,'C',1);
      $pdf->Ln(5);
      $pdf->setX(154);
      $pdf->SetFillColor(172,172,172);
      $pdf->SetFont('Arial','B',8.5);
      $pdf->Cell(33,5,'RETENCION',1,0,'R',1);
      $pdf->SetFillColor(255,255,255);
      $pdf->SetFont('Arial','',8.5);
      $pdf->Cell(23,5,$retenido,1,0,'C',1);
      $pdf->Ln(5);
      $pdf->setX(154);
      $pdf->SetFillColor(172,172,172);
      $pdf->SetFont('Arial','B',8.5);
      $pdf->Cell(33,5,'TOTAL EXENTO',1,0,'R',1);
      $pdf->SetFont('Arial','',8.5);
      $pdf->SetFillColor(255,255,255);
      $pdf->Cell(23,5,$total_exento,1,0,'C',1);
      $pdf->Ln(5);
      $pdf->setX(154);
      $pdf->SetFillColor(172,172,172);
      $pdf->SetFont('Arial','B',8.5);
      $pdf->Cell(33,5,'TOTAL DESCUENTO',1,0,'R',1);
      $pdf->SetFillColor(255,255,255);
      $pdf->SetFont('Arial','',8.5);
      $pdf->Cell(23,5,$total_descuento,1,0,'C',1);
      $pdf->Ln(5);
      $pdf->setX(154);
      $pdf->SetFillColor(172,172,172);
      $pdf->SetFont('Arial','B',8.5);
      $pdf->Cell(33,5,'TOTAL PAGAR',1,0,'R',1);
      $pdf->SetFillColor(255,255,255);
      $pdf->SetFont('Arial','',8.5);
      $pdf->Cell(23,5,$total,1,0,'C',1);

    }


      $pdf->Output('I','Cotizacion_'.$numero_cotizacion.'.pdf');

  } catch (Exception $e) {

    $pdf->Text(22.8, 5, 'ERROR AL IMPRIMIR COTIZACION');
    $pdf->Output('I','COTIZACION_ERROR.pdf',true);

  }

 ?>
