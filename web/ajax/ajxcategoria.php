<?php 

	function __autoload($className){
		$model = "../../model/". $className ."_model.php";
		$controller = "../../controller/". $className ."_controller.php";
	
		require_once($model);
		require_once($controller);
	}

	$funcion = new Categoria();

	if(isset($_POST['categoria'])){
		
		try {

			$proceso = $_POST['proceso'];
			$id = $_POST['id'];
			$categoria = trim($_POST['categoria']);
			$estado = trim($_POST['estado']);

			switch($proceso){

			case 'Registro':
				$funcion->Insertar_Categoria($categoria);
			break;

			case 'Edicion':
				$funcion->Editar_Categoria($id,$categoria,$estado);
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
