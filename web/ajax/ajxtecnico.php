<?php

	function __autoload($className){
		$model = "../../model/". $className ."_model.php";
		$controller = "../../controller/". $className ."_controller.php";

		require_once($model);
		require_once($controller);
	}

	$funcion = new Tecnico();

	if(isset($_POST['tecnico'])){

		try {

			$proceso = $_POST['proceso'];
			$id = $_POST['id'];
			$tecnico = trim($_POST['tecnico']);
			$telefono = trim($_POST['telefono']);
			$estado = trim($_POST['estado']);

      $telefono =  str_replace ( "-", "", $telefono);

			switch($proceso){

			case 'Registro':
				$funcion->Insertar_Tecnico($tecnico,$telefono);
			break;

			case 'Edicion':
				$funcion->Editar_Tecnico($id,$tecnico,$telefono,$estado);
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





?>
