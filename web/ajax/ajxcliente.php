<?php

	function __autoload($className){
		$model = "../../model/". $className ."_model.php";
		$controller = "../../controller/". $className ."_controller.php";

		require_once($model);
		require_once($controller);
	}

	$funcion = new Cliente();

	if(!empty($_GET)){
			$idcliente = isset($_GET['cliente']) ? $_GET['cliente'] : '';
			$funcion->Ver_Limite_Credito($idcliente);
	}

	if (!empty($_POST))
	{

	if(isset($_POST['nombre_cliente'])){

		try {

			$proceso = $_POST['proceso'];
			$id = $_POST['id'];
			$nombre_cliente = trim($_POST['nombre_cliente']);

			$numero_telefono = trim($_POST['numero_telefono']);
			$numero_nit = trim($_POST['numero_nit']);
			$email = trim($_POST['email']);
			$giro = trim($_POST['giro']);
			$estado = trim($_POST['estado']);
			$direccion = trim($_POST['direccion']);
			$limite_credito = trim($_POST['limite_credito']);
			$numero_telefono =  str_replace ( "-", "", $numero_telefono);
			$numero_nit = str_replace ( "-", "", $numero_nit);

			switch($proceso){

			case 'Registro':
				$funcion->Insertar_Cliente($nombre_cliente,$numero_nit,$direccion,
				$numero_telefono,$email,$giro,$limite_credito);
			break;

			case 'Edicion':
				$funcion->Editar_Cliente($id,$nombre_cliente,$numero_nit,$direccion,
				$numero_telefono,$email,$giro,$limite_credito,$estado);
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
