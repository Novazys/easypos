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

	$total = $deposito_reparacion + $deposito_revision;

$numero_telefono = substr($numero_telefono, 0, 4).'-'.substr($numero_telefono, 4, 4);

	$pdf = new TICKET('P','mm',array(76,80));
	$pdf->AddPage();


		$pdf->SetAutoPageBreak(true,1);

    $pdf->SetFont('Arial', '', 10);
    $pdf->Text(5, 10, '----------------------------------------------------------');
    $pdf->setXY(4,12);
		$pdf->MultiCell(66, 4.2, $nombre_cliente, 0,'L',0 ,1);
    $get_YC = $pdf->GetY();
    $pdf->Text(5, $get_YC + 5, 'INGRESO : '.$fecha_ingreso);
    $pdf->Text(5, $get_YC + 11, 'TELEFONO : '.$numero_telefono);
    $pdf->Text(5, $get_YC + 16, '----------------------------------------------------------');
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Text(26, $get_YC + 25, $numero_orden);


	/*
			$pdf->IncludeJS("print('true');");
	*/




	$pdf->Output('','Ticket_'.$numero_orden.'.pdf',true);
	} catch (Exception $e) {

		$pdf->Text(22.8, 5, 'ERROR AL IMPRIMIR TICKET');
		$pdf->Output('I','Ticket_ERROR.pdf',true);

	}








 ?>
