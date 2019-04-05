<?php

	function __autoload($className){
		$model = "../../model/". $className ."_model.php";
		$controller = "../../controller/". $className ."_controller.php";

		require_once($model);
		require_once($controller);
	}

	$funcion = new Parametro();

	if (!empty($_GET)){
		$criterio = isset($_GET['criterio']) ? $_GET['criterio'] : '';

		if($criterio == "moneda"){
			$funcion->Ver_Moneda();

		} else if ($criterio =="iva"){
			$funcion->Ver_Impuesto();
		}

	}


	if (!empty($_POST))
	{
	if(isset($_POST['nombre_empresa'])){

		try {

			$proceso = $_POST['proceso'];
			$id = $_POST['id'];
			$nombre_empresa = trim($_POST['nombre_empresa']);
			$propietario = trim($_POST['propietario']);
			$numero_nit = trim($_POST['numero_nit']);

			$porcentaje_iva = trim($_POST['porcentaje_iva']);
			$porcentaje_retencion = trim($_POST['porcentaje_retencion']);
			$monto_retencion = trim($_POST['monto_retencion']);
			$direccion_empresa = trim($_POST['direccion_empresa']);
			$idcurrency = trim($_POST['idcurrency']);

			$numero_nit = str_replace ( "-", "", $numero_nit);

			switch($proceso){

			case 'Registro':
				$funcion->Insertar_Parametro($nombre_empresa,$propietario,$numero_nit,$porcentaje_iva,
				$porcentaje_retencion,$monto_retencion,$direccion_empresa,$idcurrency);
			break;

			case 'Edicion':
				$funcion->Editar_Parametro($id,$nombre_empresa,$propietario,$numero_nit,$porcentaje_iva,
				$porcentaje_retencion,$monto_retencion,$direccion_empresa,$idcurrency);
			break;

			default:
				$data = "Error";
 	   		 	echo json_encode($data);
			break;
		}

		} catch (Exception $e) {

			$data = "Error";
 	   		echo json_encode($data);
		}

	}

}



?>
