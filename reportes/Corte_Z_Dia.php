<?php
	require('ClassTicket.php');

	try
	{

	function __autoload($className){
            $model = "../model/". $className ."_model.php";
            $controller = "../controller/". $className ."_controller.php";

           require_once($model);
           require_once($controller);
    }

	  $fecha =  isset($_GET['day']) ? $_GET['day'] : '';
    $objVenta = new Venta();
    $fecha = DateTime::createFromFormat('d/m/Y', $fecha)->format('Y-m-d');
    $datos = $objVenta->Imprimir_Ticket_Venta('0');

    //$fecha = DateTime::createFromFormat('Y-m-d', $fecha)->format('d/m/Y');

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

	$pdf = new TICKET('P','mm',array(76,297));
	$pdf->AddPage();
	if($tipo_comprobante == '1')
	{
		$pdf->SetFont('Arial', '', 10);
		$pdf->SetAutoPageBreak(true,1);

		include('../includes/ticketheader.inc.php');

		$pdf->SetFont('Arial', '', 9.2);
		$pdf->Text(2, $get_YH + 1, '------------------------------------------------------------------');

		$get_Y = $pdf->GetY();
		$pdf->SetFont('Arial','B',14);
		$pdf->Text(16,$get_Y + 8,'CORTE Z - DIARIO');

		$pdf->SetFont('Arial','B',9.5);
		$pdf->Text(20, $get_Y + 14,'CAJA #1 | TICKET # '.$p_hasta_impreso);

		$pdf->SetFont('Arial','B',10);
		$pdf->Text(25,$get_Y + 20,'FECHA Y HORA');

		$pdf->setXY(4,$get_Y + 22);
	    $pdf->SetFont('Arial', '', 8.5);
	    $pdf->MultiCell(70, 4.2,
	    DateTime::createFromFormat('Y-m-d', $fecha)->format('d/m/Y').' - '.date('H:i:s'), 0,'C',0 ,1);

	    $pdf->SetFont('Arial','B',10);
	    $pdf->Text(21,$get_Y + 31,'TICKETS IMPRESOS');
		$pdf->SetFont('Arial','B',10);

		$pdf->Text(26,$get_Y + 36,'DESDE : ');
		$pdf->Text(40,$get_Y + 36,' '.$p_desde_impreso);

		$pdf->Text(26,$get_Y + 41,'HASTA : ');
		$pdf->Text(40,$get_Y + 41,' '.$p_hasta_impreso);

		$pdf->Text(18,$get_Y + 48,'DEVOLUCIONES : 0.00');

		$pdf->SetFont('Arial','B',12);
		$pdf->Text(18,$get_Y + 57,'DESGLOCE VENTA');

		$pdf->SetFont('Arial','',10);
		$pdf->Text(13,$get_Y + 66,'VENTA GRAVADA :');
		$pdf->SetFont('Arial','B',10);
		$pdf->Text(50,$get_Y + 66,$p_venta_gravada);
		$pdf->SetFont('Arial','',10);
		$pdf->Text(25,$get_Y + 71.5,'VENTA IVA :');
		$pdf->SetFont('Arial','B',10);
		$pdf->Text(50,$get_Y + 71.5,$p_venta_iva);
		$pdf->SetFont('Arial','',10);
		$pdf->Text(13,$get_Y + 77,'TOTAL GRAVADO :');
		$pdf->SetFont('Arial','B',10);
		$pdf->Text(50,$get_Y + 77,$p_total_gravado);
		$pdf->SetFont('Arial','',10);
		$pdf->Text(18,$get_Y + 84,'TOTAL EXENTO :');
		$pdf->SetFont('Arial','B',10);
		$pdf->Text(50,$get_Y + 84,$p_total_exento);
		$pdf->SetFont('Arial','',10);
                $pdf->Text(10,$get_Y + 90,'TOTAL DESCUENTO :');
                $pdf->SetFont('Arial','B',10);
                $pdf->Text(50,$get_Y + 90,$p_total_descuento);
		$pdf->SetFont('Arial','',10);
		$pdf->Text(2, $get_Y + 95, '-------------------------------------------------------------');
		$pdf->Text(20,$get_Y + 100,'TOTAL VENTA :');
		$pdf->SetFont('Arial','B',10);
		$pdf->Text(50,$get_Y + 100,$p_total_venta);

		$pdf->IncludeJS("print('true');");



	} else {

		$pdf->SetFont('Arial', '', 10);
		$pdf->Text(7, 58, '* EL COMPROBANTE DE VENTA*');
		$pdf->Text(20, 65, '* NO ES TICKET*');
	}



	$pdf->Output('I','Corte_Z_'.DateTime::createFromFormat('Y-m-d', $fecha)->format('d/m/Y').'.pdf',true);
	} catch (Exception $e) {

		$pdf->Text(22.8, 5, 'ERROR AL IMPRIMIR TICKET');
		$pdf->Output('I','Ticket_ERROR.pdf',true);

	}








 ?>
