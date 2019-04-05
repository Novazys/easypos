<?php 

	function __autoload($className){
		$model = "../../model/". $className ."_model.php";
		$controller = "../../controller/". $className ."_controller.php";
	
		require_once($model);
		require_once($controller);
	}

	$funcion = new Inventario();

	if(isset($_POST['proceso']) && isset($_POST['producto']) && isset($_POST['motivo']) && isset($_POST['cantidad'])){
		
		try {

			$proceso = $_POST['proceso'];
			$producto = trim($_POST['producto']);
			$motivo = trim($_POST['motivo']);
			$cantidad = trim($_POST['cantidad']);

			switch($proceso){

			case 'Entrada':
				$funcion->Insertar_Entrada($motivo,$cantidad,$producto);
			break;

			case 'Salida':
				$funcion->Insertar_Salida($motivo,$cantidad,$producto);
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
