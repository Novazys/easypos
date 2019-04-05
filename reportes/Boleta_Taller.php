<?php
  require('ClassMultiCell.php');
  $idorden =  base64_decode(isset($_GET['orden']) ? $_GET['orden'] : '');

  try
  {
  function __autoload($className){
            $model = "../model/". $className ."_model.php";
            $controller = "../controller/". $className ."_controller.php";

           require_once($model);
           require_once($controller);
    }

      $objTaller = new Taller();


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

      $param_moneda = $objTaller->Ver_Moneda_Reporte();
      foreach ($param_moneda as $row => $column) {
          $moneda = $column['CurrencyName'];
      }


      if($idorden == ""){
      	$datos = $objTaller->Reporte_Taller('0');
      } else {
      	$datos = $objTaller->Reporte_Taller($idorden);
      }

      foreach ($datos as $row => $column) {

      	$fecha_ingreso = $column["fecha_ingreso"];
        $numero_orden = $column["numero_orden"];
        $nombre_cliente = $column["nombre_cliente"];
        $aparato = $column["aparato"];
        $nombre_marca = $column["nombre_marca"];
        $modelo = $column["modelo"];
        $serie = $column["serie"];
        $averia = $column["averia"];
        $observaciones = $column["observaciones"];
        $diagnostico = $column["diagnostico"];
        $fecha_alta = $column["fecha_alta"];
        $fecha_retiro = $column["fecha_retiro"];
        $deposito_revision = $column["deposito_revision"];
        $deposito_reparacion = $column["deposito_reparacion"];
        $parcial_pagar = $column["parcial_pagar"];
        $numero_telefono = $column["numero_telefono"];
        $numero_telefono = substr($numero_telefono, 0, 4).'-'.substr($numero_telefono, 4, 4);
      }

      $fecha_ingreso = DateTime::createFromFormat('Y-m-d H:i:s', $fecha_ingreso)->format('d/m/Y H:i:s');

      if($fecha_alta !=''){
          $fecha_alta = DateTime::createFromFormat('Y-m-d H:i:s', $fecha_alta)->format('d/m/Y H:i:s');
      } else {
        $fecha_alta = '';
      }
      if($fecha_retiro  !=''){
            $fecha_retiro  = DateTime::createFromFormat('Y-m-d H:i:s',   $fecha_retiro )->format('d/m/Y H:i:s');
      } else {
          $fecha_retiro  = '';
      }

  	if($nombre_marca == ''){
  		$nombre_marca = 'ND';
  	}

  	if($modelo == ''){
  		$modelo = 'ND';
  	}

  	if($serie == ''){
  		$serie = 'ND';
  	}

  	$total = $parcial_pagar + $deposito_reparacion + $deposito_revision;



    $pdf = new PDF('P','mm','Letter');
    $pdf->AddPage();
    $pdf->AliasNbPages();
    $pdf->SetFont('Arial','B',16);
    $pdf->setXY(10,6);
    $pdf->Cell(40,10,$empresa);


    $pdf->setXY(129,36);
    $pdf->SetFont('Arial','',14);
    $pdf->Cell(46,8,'NO. ORDEN : ');
    $pdf->SetFont('Arial','B',14);
    $pdf->setXY(161,36.3);
    $pdf->Cell(37,8,$numero_orden);
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
    $pdf->setX(71);

    $pdf->SetFont('Arial','',14);


    $pdf->SetFont('Arial','',11);
    $pdf->setXY(10,32);
    $pdf->Cell(44,7,'EMITIDA EL DIA ');
    $pdf->SetFont('Arial','B',11);
    $pdf->setXY(40,32);
    $pdf->Cell(38,7, date('d/m/Y').' A LAS '.date('H:i:s'));


    $pdf->SetFont('Arial','',13);
    $pdf->setXY(10,43);
    $pdf->Cell(25,10,'CLIENTE : ');
    $pdf->SetFont('Arial','B',13);
    $pdf->Cell(20,10,$nombre_cliente);
    $pdf->SetFont('Arial','',13);
    $pdf->setXY(10,50);
    $pdf->Cell(2,10,'Telefono : ');
    $pdf->SetFont('Arial','B',13);
    $pdf->setXY(35,50);
    $pdf->Cell(2,10,$numero_telefono);

    $pdf->Line(210,60,10,60);
    $pdf->Ln(10);
    $pdf->SetFont('Arial','',8);
    $pdf->SetFillColor(172,172,172);
    $pdf->Cell(50,5,'Aparato',1,0,'L',1);
    $pdf->Cell(25,5,'Modelo',1,0,'C',1);
    $pdf->Cell(25,5,'Serie',1,0,'C',1);
    $pdf->Cell(70,5,'Averia',1,0,'C',1);
    $pdf->Cell(30,5,'Fecha Ingreso',1,0,'C',1);
    $pdf->SetFillColor(255,255,255);
    $pdf->Ln(5);


    $pdf->setX(10);
    $pdf->SetWidths(array(50,25,25,70,30));
    $pdf->Row(array($aparato,$modelo,$serie,$averia,$fecha_ingreso));
    $get_Y = $pdf->GetY();
    $pdf->setXY(10,$get_Y + 10);
    $pdf->SetFillColor(172,172,172);
    $pdf->Cell(95,5,'OBSERVACIONES',1,0,'C',1);
    $pdf->setXY(115,$get_Y + 10);
    $pdf->Cell(95,5,'DIAGNOSTICO',1,0,'C',1);
    $pdf->SetFillColor(255,255,255);
    $pdf->setXY(10,$get_Y + 15);
    $pdf->MultiCell(95, 4.2, utf8_decode($observaciones), 1,'C',0 ,1);
    $pdf->setXY(115,$get_Y + 15);
    $pdf->MultiCell(95, 4.2, utf8_decode($diagnostico), 1,'C',0 ,1);
    $get_Y2 = $pdf->GetY();
    $pdf->Ln(15);

      $pdf->SetFont('Arial','B',8.5);
      $pdf->Cell(144,20,'',1,0,'C',1);
      $pdf->Text(60,$get_Y2 + 19,'NOTAS IMPORTANTES');
      $pdf->SetFont('Arial','',8.5);
      $pdf->Text(15,$get_Y2 + 24,'1 - PRECIOS SUJETOS EN '.strtoupper($moneda));
      $pdf->Text(15,$get_Y2 + 28,utf8_decode('2 - Despues de dos meses no se aceptan reclamos por los articulos reparados'));
      $pdf->Text(15,$get_Y2 + 32,utf8_decode('que no se han retirado. Toda reparacion tiene un mes de garantia'));
      $pdf->setX(154);
      $pdf->SetFillColor(172,172,172);
      $pdf->SetFont('Arial','B',8.5);
      $pdf->Cell(33,5,'DEP. REVISION',1,0,'R',1);
      $pdf->SetFont('Arial','',8.5);
      $pdf->SetFillColor(255,255,255);
      $pdf->Cell(23,5,$deposito_revision,1,0,'C',1);
      $pdf->Ln(5);
      $pdf->setX(154);
      $pdf->SetFillColor(172,172,172);
      $pdf->SetFont('Arial','B',8.5);
      $pdf->Cell(33,5,'DEP. REPARACION',1,0,'R',1);
      $pdf->SetFillColor(255,255,255);
      $pdf->SetFont('Arial','',8.5);
      $pdf->Cell(23,5,$deposito_reparacion,1,0,'C',1);
      $pdf->Ln(5);
      $pdf->setX(154);
      $pdf->SetFillColor(172,172,172);
      $pdf->SetFont('Arial','B',8.5);
      $pdf->Cell(33,5,'PARCIAL',1,0,'R',1);
      $pdf->SetFillColor(255,255,255);
      $pdf->SetFont('Arial','',8.5);
      $pdf->Cell(23,5,$parcial_pagar,1,0,'C',1);
      $pdf->Ln(5);
      $pdf->setX(154);
      $pdf->SetFillColor(172,172,172);
      $pdf->SetFont('Arial','B',8.5);
      $pdf->Cell(33,5,'TOTAL',1,0,'R',1);
      $pdf->SetFillColor(255,255,255);
      $pdf->SetFont('Arial','',8.5);
      $pdf->Cell(23,5,$total,1,0,'C',1);





      $pdf->Output('I','Boleta_'.$numero_orden.'.pdf');

  } catch (Exception $e) {

    $pdf->Text(22.8, 5, 'ERROR AL IMPRIMIR COTIZACION');
    $pdf->Output('I','COTIZACION_ERROR.pdf',true);

  }

 ?>
