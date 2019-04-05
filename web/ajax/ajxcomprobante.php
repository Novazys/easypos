<?php 

	function __autoload($className){
		$model = "../../model/". $className ."_model.php";
		$controller = "../../controller/". $className ."_controller.php";
	
		require_once($model);
		require_once($controller);
	}

	$funcion = new Comprobante();

	if(isset($_POST['comprobante'])){
		
		try {

			$proceso = $_POST['proceso'];
			$id = $_POST['id'];
			$comprobante = trim($_POST['comprobante']);
			$estado = trim($_POST['estado']);

			switch($proceso){

			case 'Registro':
				$funcion->Insertar_Comprobante($comprobante);
			break;

			case 'Edicion':
				$funcion->Editar_Comprobante($id,$comprobante,$estado);
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
