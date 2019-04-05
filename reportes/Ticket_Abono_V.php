<?php
	$idabono =  base64_decode(isset($_GET['abono']) ? $_GET['abono'] : '');
	require('ClassTicket.php');

	try
	{

	function __autoload($className){
            $model = "../model/". $className ."_model.php";
            $controller = "../controller/". $className ."_controller.php";

           require_once($model);
           require_once($controller);
    }

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

		$pdf = new TICKET('P','mm',array(76,297));
		$pdf->AddPage();


			$pdf->SetFont('Arial', '', 10);
			$pdf->SetAutoPageBreak(true,10);

			include('../includes/ticketheader.inc.php');

			$pdf->SetFont('Arial', '', 9.2);
	    $pdf->Text(2, $get_YH + 23, '-------------------------------------------------------------------');
	    $pdf->SetXY(2,40);
	    $pdf->SetFillColor(255,255,255);
	    $get_Y = $pdf->GetY();
	    $pdf->SetFont('Arial','B',12);
	    $pdf->Text(7,$get_YH + 27,'TICKET DE ABONO A CREDITO ');
	    $pdf->Text(23,$get_YH + 32,$p_codigo_credito);
			$pdf->Text(30,$get_YH + 38,'CAJA #1');

	    $pdf->SetFont('Arial','B',10);
	    $pdf->Text(24,$get_YH + 44,'FECHA Y HORA');
	    $pdf->SetFont('Arial','',10);
	    $pdf->Text(22,$get_YH + 50, $p_fecha_abono);

	    $pdf->SetFont('Arial','B',12);
	    $pdf->Text(26,$get_YH + 60,'ABONO POR ');
	    $pdf->Text(29,$get_YH + 67, $simbolo.' '.$p_monto_abono);

	    $pdf->SetFont('Arial','B',11);
	    $pdf->Text(11.5,$get_Y + 55,'Total Credito :');
	    $pdf->Text(48,$get_Y + 55, $simbolo.' '.$p_monto_credito);

	    $pdf->Text(8,$get_Y + 60,'Total Abonado :');
	    $pdf->Text(48,$get_Y + 60, $simbolo.' '.$p_total_abonado);

	    $pdf->Text(6,$get_Y + 65,'Total Pendiente :');
	    $pdf->Text(48,$get_Y + 65, $simbolo.' '.$p_restante_credito);


	    $pdf->Line(73,125,5,125);
	    $pdf->SetFont('Arial','BI',8.5);
	    $pdf->Text(11,$get_Y + 89,$cliente);
	    $pdf->SetFont('Arial','I',8.5);
	    $pdf->Text(4.5,$get_Y + 100,'**********************ORIGINAL**********************');
			$pdf->Text(23,$get_Y + 105,'Abonado por : ');
			$pdf->SetFont('Arial','BI',8.5);
			$pdf->Text(43,$get_Y + 105, $usuario);



	    $pdf->AddPage();

	    $pdf->SetFont('Arial', '', 10);
	    $pdf->SetAutoPageBreak(true,1);

			include('../includes/ticketheader.inc.php');

			$pdf->SetFont('Arial', '', 9.2);
	    $pdf->Text(2, $get_YH + 23, '-------------------------------------------------------------------');
	    $pdf->SetXY(2,40);
	    $pdf->SetFillColor(255,255,255);
	    $get_Y = $pdf->GetY();
	    $pdf->SetFont('Arial','B',12);
	    $pdf->Text(7,$get_YH + 27,'TICKET DE ABONO A CREDITO ');
	    $pdf->Text(23,$get_YH + 32,$p_codigo_credito);
			$pdf->Text(30,$get_YH + 38,'CAJA #1');

	    $pdf->SetFont('Arial','B',10);
	    $pdf->Text(24,$get_YH + 44,'FECHA Y HORA');
	    $pdf->SetFont('Arial','',10);
	    $pdf->Text(22,$get_YH + 50, $p_fecha_abono);

	    $pdf->SetFont('Arial','B',12);
	    $pdf->Text(26,$get_YH + 60,'ABONO POR ');
	    $pdf->Text(29,$get_YH + 67, $simbolo.' '.$p_monto_abono);

	    $pdf->SetFont('Arial','B',11);
	    $pdf->Text(11.5,$get_Y + 55,'Total Credito :');
	    $pdf->Text(48,$get_Y + 55, $simbolo.' '.$p_monto_credito);

	    $pdf->Text(8,$get_Y + 60,'Total Abonado :');
	    $pdf->Text(48,$get_Y + 60, $simbolo.' '.$p_total_abonado);

	    $pdf->Text(6,$get_Y + 65,'Total Pendiente :');
	    $pdf->Text(48,$get_Y + 65, $simbolo.' '.$p_restante_credito);


	    $pdf->Line(73,125,5,125);
	    $pdf->SetFont('Arial','BI',8.5);
	    $pdf->Text(11,$get_Y + 89,$cliente);
	    $pdf->SetFont('Arial','I',8.5);
	    $pdf->Text(4.5,$get_Y + 100,'*******************COPIA CLIENTE*******************');
			$pdf->Text(23,$get_Y + 105,'Abonado por : ');
			$pdf->SetFont('Arial','BI',8.5);
			$pdf->Text(43,$get_Y + 105, $usuario);


			$pdf->IncludeJS("print('true');");

	$pdf->Output('I','ABONO_CREDITO'.$p_codigo_credito.'.pdf',true);
	} catch (Exception $e) {

		$pdf->Text(22.8, 5, 'ERROR AL IMPRIMIR TICKET');
		$pdf->Output('I','Ticket_ERROR.pdf',true);

	}








 ?>
