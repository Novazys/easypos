<?php
	require('ClassTicket.php');
	$idapartado =  base64_decode(isset($_GET['num']) ? $_GET['num'] : '');
	try
	{

	function __autoload($className){
            $model = "../model/". $className ."_model.php";
            $controller = "../controller/". $className ."_controller.php";

           require_once($model);
           require_once($controller);
    }


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


	$pdf = new TICKET('P','mm',array(76,297));
	$pdf->AddPage();


		$pdf->SetFont('Arial', '', 12);
		$pdf->SetAutoPageBreak(true,1);

		include('../includes/ticketheader.inc.php');

		$pdf->SetFont('Arial', '', 9.2);
		$pdf->Text(2, $get_YH + 4, '------------------------------------------------------------------');
		$pdf->SetFont('Arial', 'B', 8.5);
		$pdf->Text(4, $get_YH  + 8, 'No. Apartado: '.$numero_apartado);
		$pdf->Text(55, $get_YH + 8, 'Caja No.: 1');
		$pdf->Text(4, $get_YH + 13, 'Fecha Apartado: '.$fecha_apartado);
		$pdf->Text(4, $get_YH  + 18, 'Cajero : '.substr($empleado, 0,5));
		$pdf->SetFont('Arial', '', 9.2);
		$pdf->Text(2, $get_YH + 22, '------------------------------------------------------------------');

		$pdf->SetXY(2,$get_YH + 26);
		$pdf->SetFillColor(255,255,255);
		$pdf->SetFont('Arial','B',8.5);
		$pdf->Cell(13,4,'Cantid',0,0,'L',1);
		$pdf->Cell(28,4,'Descripcion',0,0,'L',1);
		$pdf->Cell(16,4,'Precio',0,0,'L',1);
		$pdf->Cell(12,4,'Total',0,0,'L',1);
		$pdf->SetFont('Arial','',8.5);
		$pdf->Text(2, $get_YH + 32, '-----------------------------------------------------------------------');
		$pdf->Ln(6);
		$item = 0;
		while($row = $detalle->fetch(PDO::FETCH_ASSOC)) {
		 $item = $item + 1;
			$pdf->setX(1.1);
			$pdf->Cell(13,4,$row['cantidad'],0,0,'L');
			$pdf->Cell(28,4,$row['descripcion'],0,0,'L',1);
			$pdf->Cell(16,4,$row['precio_unitario'],0,0,'L',1);
			$pdf->Cell(8,4,$row['importe'],0,0,'L',1);
			$pdf->Ln(4.5);
			$get_Y = $pdf->GetY();
		}
		$pdf->Text(2, $get_Y+1, '-----------------------------------------------------------------------');
		$pdf->SetFont('Arial','B',8.5);
		$pdf->Text(4,$get_Y + 5,'G = GRAVADO');
		$pdf->Text(30,$get_Y + 5,'E = EXENTO');

		$pdf->Text(4,$get_Y + 10,'SUBTOTAL :');
		$pdf->Text(57,$get_Y + 10,$subtotal);
		$pdf->Text(4,$get_Y + 15,'EXENTO :');
		$pdf->Text(57,$get_Y + 15,$exento);
		$pdf->Text(4,$get_Y + 20,'GRAVADO :');
		$pdf->Text(57,$get_Y + 20,$subtotal);
		$pdf->Text(4,$get_Y + 25,'DESCUENTO :');
		$pdf->Text(56,$get_Y + 25,'-'.$descuento);
		$pdf->Text(4,$get_Y + 30,'TOTAL A PAGAR :');
		$pdf->SetFont('Arial','B',8.5);
		$pdf->Text(57,$get_Y + 30,$total);

		$pdf->Text(2, $get_Y+33, '-----------------------------------------------------------------------');
		$pdf->Text(4,$get_Y + 36,'Numero de Productos :');
		$pdf->Text(57,$get_Y + 36,$numero_productos);


		$pdf->Text(24,$get_Y + 40,'Abonado :');
		$pdf->Text(57,$get_Y + 40,$abonado_apartado);
		$pdf->Text(24,$get_Y + 44,'Restante :');
		$pdf->Text(57,$get_Y + 44,$restante_pagar);


		$pdf->Text(2, $get_Y+47, '-----------------------------------------------------------------------');
		$pdf->SetFont('Arial','BI',8.5);
		$pdf->Text(3, $get_Y+52, 'Precios en : '.$moneda);

		$pdf->SetFont('Arial','B',8.5);
		$pdf->Text(19, $get_Y+62, 'GRACIAS POR SU COMPRA');
		$pdf->SetFont('Arial','BI',8.5);
		$pdf->setXY(6,$get_Y + 65);
    $pdf->MultiCell(65, 4.2, utf8_decode('* Recuerde que tiene un total de: '.$diferencia.' dias (hasta el '.$fecha_limite_retiro.'),
		para poder saldar su apartado. De caso contrario este quedara anulado y el producto puede agotarse en existencias *'), 0,'C',0 ,1);
		$pdf->SetFillColor(0,0,0);
		$pdf->SetFont('Arial','B',8.5);
		$pdf->setX(11);
		$pdf->Code39(4,$get_Y+89,$numero_apartado,1,5);
		$pdf->SetFont('Arial','',8.5);
		$pdf->Text(28, $get_Y+99, '*'.$numero_apartado.'*');


		//$pdf->IncludeJS("print('true');");





	$pdf->Output('','TicketApartado_'.$numero_apartado.'.pdf',true);
	} catch (Exception $e) {

		$pdf->Text(22.8, 5, 'ERROR AL IMPRIMIR TICKET');
		$pdf->Output('I','Ticket_ERROR.pdf',true);

	}








 ?>
