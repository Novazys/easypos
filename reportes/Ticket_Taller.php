<?php
	require('ClassTicket.php');
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
    $objCredito = new Credito();
    $parametros = $objCredito->Imprimir_Ticket_Abono('');
    $objVenta = new Venta();
    $parametros2 = $objVenta->Imprimir_Ticket_Venta('0');

    if($idorden == ""){
    	$datos = $objTaller->Reporte_Taller('0');
    } else {
    	$datos = $objTaller->Reporte_Taller($idorden);
    }

    foreach ($parametros as $key => $column) {
      $empresa = $column["p_empresa"];
      $propietario = $column["p_propietario"];
      $direccion = $column["p_direccion"];
      $nit = $column["p_numero_nit"];

      $fecha_resolucion = $column["p_fecha_resolucion"];
      $numero_resolucion = $column["p_numero_resolucion"];
      $numero_resolucion_fact = $column["p_numero_resolucion_fact"];
      $serie = $column["p_serie"];


    }

     foreach ($parametros2 as $key => $column) {
      $desde = $column["p_desde"];
	$hasta = $column["p_hasta"];


    }

    foreach ($datos as $row => $column) {

      $fecha_ingreso = $column["fecha_ingreso"];
      $numero_orden = $column["numero_orden"];
      $nombre_cliente = $column["nombre_cliente"];
      $aparato = $column["aparato"];
      $nombre_marca = $column["nombre_marca"];
      $modelo = $column["modelo"];
      $serie_aparato = $column["serie"];
      $averia = $column["averia"];
      $observaciones = $column["observaciones"];
      $diagnostico = $column["diagnostico"];
      $fecha_alta = $column["fecha_alta"];
      $fecha_retiro = $column["fecha_retiro"];
      $deposito_revision = $column["deposito_revision"];
      $deposito_reparacion = $column["deposito_reparacion"];
      $parcial_pagar = $column["parcial_pagar"];


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

	if($serie_aparato == ''){
		$serie_aparato = 'ND';
	}


	$total = $parcial_pagar + $deposito_reparacion + $deposito_revision;


	$pdf = new TICKET('P','mm',array(76,297));
	$pdf->AddPage();

		$pdf->SetFont('Arial', '', 12);
		$pdf->SetAutoPageBreak(true,1);

		include('../includes/ticketheader.inc.php');


		$pdf->SetFont('Arial', '', 8);
		$pdf->Text(5, $get_YH + 3, '---------------------------------------------------------------------');
		$pdf->SetY($get_YH + 4);
		$pdf->SetX(5);
		$pdf->MultiCell(65, 4.2, 'CLIENTE : '.$nombre_cliente, 0,'L',0 ,1);
		$get_YC = $pdf->GetY();
		$pdf->SetXY(5,$get_YC + 2);
		$pdf->MultiCell(60, 4.2, 'INGRESO : '.$fecha_ingreso, 0,'L',0 ,1);
		$pdf->Text(5, $get_YC  + 8, '---------------------------------------------------------------------');

		$pdf->SetFont('Arial', 'B', 9.2);
		$pdf->Text(13, $get_YC  + 12, 'INFORMACION DEL APARATO');
		$pdf->SetFont('Arial', '', 9.2);
		$pdf->Text(13, $get_YC  + 19, 'Aparato: '.$aparato);
		$pdf->Text(13, $get_YC  + 25, 'Marca: '.$nombre_marca);
		$pdf->Text(13, $get_YC  + 31, 'Modelo: '.$modelo);
		$pdf->Text(13, $get_YC  + 37, 'Serie: '.$serie_aparato);
		$pdf->SetFont('Arial', 'B', 9.2);
		$pdf->Text(10, $get_YC  + 46, 'AVERIA: ');

		$get_XA = $pdf->GetX();
		$get_YA = $pdf->GetY();
		$pdf->SetFont('Arial', '', 9.2);
		$pdf->setXY($get_XA - 2, $get_YA + 42);
		$pdf->MultiCell(80, 4.2, utf8_decode($averia), 0,'L',0 ,1);

		$get_XO = $pdf->GetX();
		$get_YO = $pdf->GetY();
		$pdf->SetFont('Arial', 'B', 9.2);
		$pdf->Text($get_XO - 1, $get_YO  + 5, 'OBSERVACIONES: ');
		$pdf->setXY($get_XO - 2, $get_YO + 8);
		$pdf->SetFont('Arial', '', 9.2);
		$pdf->MultiCell(60, 4.2, utf8_decode($observaciones), 0,'L',0 ,1);

		$get_XD = $pdf->GetX();
		$get_YD = $pdf->GetY();
		$pdf->SetFont('Arial', 'B', 9.2);
		$pdf->Text($get_XD - 1, $get_YD  + 5, 'DIAGNOSTICO: ');
		$pdf->setXY($get_XD - 2, $get_YD + 8);
		$pdf->SetFont('Arial', '', 9.2);
		$pdf->MultiCell(60, 4.2, utf8_decode($diagnostico), 0,'L',0 ,1);

		$get_XL = $pdf->GetX();
		$get_YL = $pdf->GetY();

		$pdf->SetFont('Arial', 'B', 9.2);
		$pdf->Text($get_XL - 1, $get_YL  + 5, 'Dado de Alta: ' . $fecha_alta);
		$pdf->Text($get_XL - 1, $get_YL  + 10, 'Fecha de Retiro: ' . $fecha_retiro);

		$pdf->Text($get_XL - 1, $get_YL  + 20, 'DEP REVISION : ' . number_format($deposito_revision, 2, '.', ','));
		$pdf->Text($get_XL - 1, $get_YL  + 25, 'DEP REPARACION : ' . number_format($deposito_reparacion, 2, '.', ','));
		$pdf->Text($get_XL - 1, $get_YL  + 30, 'PARCIAL : ' . number_format($parcial_pagar, 2, '.', ','));
		$pdf->Text($get_XL - 1, $get_YL  + 35, 'TOTAL : ' . number_format($total, 2, '.', ','));

		$pdf->SetFont('Arial', 'B', 14);
		$pdf->setXY($get_XL - 3, $get_YL + 42);
		$pdf->MultiCell(60, 4.2, utf8_decode($numero_orden), 0,'C',0 ,1);

		$pdf->SetFont('Arial', 'I', 9);
		$pdf->setXY($get_XL + 1, $get_YL + 49);
		$pdf->MultiCell(55, 4.2, utf8_decode('Despues de un mes no se aceptan reclamos por los articulos
		reparados que no se han retirado. Toda reparacion tiene un mes de garantia'), 0,'C',0 ,1);

	/*
			$pdf->IncludeJS("print('true');");
	*/




	$pdf->Output('','Ticket_'.$numero_orden.'.pdf',true);
	} catch (Exception $e) {

		$pdf->Text(22.8, 5, 'ERROR AL IMPRIMIR TICKET');
		$pdf->Output('I','Ticket_ERROR.pdf',true);

	}








 ?>
