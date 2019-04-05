<?php 

	function __autoload($className){
		$model = "../../model/". $className ."_model.php";
		$controller = "../../controller/". $className ."_controller.php";
	
		require_once($model);
		require_once($controller);
	}

	$funcion = new Presentacion();

	if(isset($_POST['presentacion'])){
		
		try {

			$proceso = $_POST['proceso'];
			$id = $_POST['id'];
			$presentacion = trim($_POST['presentacion']);
			$siglas = trim($_POST['sigla']);
			$estado = trim($_POST['estado']);

			switch($proceso){

			case 'Registro':
				$funcion->Insertar_Presentacion($presentacion,$siglas);
			break;

			case 'Edicion':
				$funcion->Editar_Presentacion($id,$presentacion,$siglas,$estado);
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
