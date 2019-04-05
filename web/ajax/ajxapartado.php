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

		  $cuantos = $_POST['cuantos'];
		  $stringdatos = $_POST['stringdatos'];
		  $listadatos=explode('#',$stringdatos);
			$fecha_retiro = trim($_POST['fecha_retiro']);
		  $idcliente = trim($_POST['idcliente']);
		  $sumas = trim($_POST['sumas']);
		  $iva = trim($_POST['iva']);
		  $exento = trim($_POST['exento']);
		  $retenido = trim($_POST['retenido']);
		  $descuento = trim($_POST['descuento']);
		  $total = trim($_POST['total']);
			$abonado = trim($_POST['abonado']);
			$restante = trim($_POST['restante']);
		  $son_letras = num2letras($total);

      $fecha_retiro = DateTime::createFromFormat('d/m/Y H:i:s', $fecha_retiro)->format('Y-m-d H:i:s');

			$funcion->Insertar_Apartado($fecha_retiro,$sumas,$iva,$exento,$retenido,$descuento,$total,$abonado,$restante,$son_letras,
      $idcliente,$_SESSION['user_id']);


			for ($i=0;$i<$cuantos ;$i++){

		  	 list($idproducto,$cantidad,$precio_unitario,$exentos,$descuento,$fecha_vence,$importe)=explode('|',$listadatos[$i]);


		  	if($fecha_vence=='')
				{
					$fecha_vence = '2000-01-01';

				} else {

					$fecha_vence = DateTime::createFromFormat('d/m/Y', $fecha_vence)->format('Y-m-d');
				}

		  	 	$funcion->Insertar_DetalleApartado($idproducto,$cantidad,$precio_unitario,$exentos,$descuento,$fecha_vence,$importe);

		  }

		} catch (Exception $e) {
			 $data = "Error";
 	   	 echo json_encode($data);
		}

}



?>
