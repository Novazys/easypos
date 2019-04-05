<?php 

	function __autoload($className){
		$model = "../../model/". $className ."_model.php";
		$controller = "../../controller/". $className ."_controller.php";
	
		require_once($model);
		require_once($controller);
	}

	$funcion = new Inventario();

	if(isset($_POST['proceso'])){
		
		try {

			$proceso = $_POST['proceso'];


			switch($proceso){

			case 'Validar':
				$funcion->Validar_Inventario();
			break;


			case 'Abrir':
				$funcion->Abrir_Inventario();
			break;

			case 'Cerrar':
				$funcion->Cerrar_Inventario();
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