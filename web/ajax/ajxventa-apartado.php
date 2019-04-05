<?php
	session_start();
	require_once("../../config/money_string.php");

	function __autoload($className){
		$model = "../../model/". $className ."_model.php";
		$controller = "../../controller/". $className ."_controller.php";

		require_once($model);
		require_once($controller);
	}


		$funcion = new Apartado();

		$caja_funcion = new Caja();

		date_default_timezone_set("America/El_Salvador");


	if (!empty($_POST))
	{
		try {

		  $idapartado = trim($_POST['id']);
		  $comprobante = trim($_POST['comprobante']);
		  $tipo_pago = trim($_POST['tipo_pago']);
		  $idcliente = trim($_POST['idcliente']);
		  $cambio = trim($_POST['cambio']);
		  $efectivo = trim($_POST['efectivo']);
		  $pago_tarjeta = trim($_POST['pago_tarjeta']);
		  $numero_tarjeta = trim($_POST['numero_tarjeta']);
		  $tarjeta_habiente = trim($_POST['tarjeta_habiente']);
		  $numero_tarjeta =  str_replace ( "-", "", $numero_tarjeta);

			if($tipo_pago == '1'){
				$tipo_pago = 'EFECTIVO';
			} else if ($tipo_pago =='2'){
				$tipo_pago = 'TARJETA';
			} else if ($tipo_pago =='3'){
				$tipo_pago = 'EFECTIVO Y TARJETA';
			}

			$funcion->Insertar_Venta($idapartado,$tipo_pago,$comprobante,$efectivo,$pago_tarjeta,$numero_tarjeta,
			$tarjeta_habiente,$cambio,$idcliente,$_SESSION['user_id']);

		} catch (Exception $e) {
			 $data = "Error";
 	   	 echo json_encode($data);
		}

}



?>
