<?php 

	function __autoload($className){
		$model = "../../model/". $className ."_model.php";
		$controller = "../../controller/". $className ."_controller.php";
	
		require_once($model);
		require_once($controller);
	}

	$funcion = new Usuario();

	if(isset($_POST['usuario']) && isset($_POST['contrasena'])){
		
		try {


			$proceso = $_POST['proceso'];
			$id = $_POST['id'];
			$usuario = trim($_POST['usuario']);
			$contrasena = trim($_POST['contrasena']);
			$tipo_usuario = trim($_POST['tipo_usuario']);
			$idempleado = trim($_POST['idempleado']);
			$estado = trim($_POST['estado']);


			switch($proceso){

			case 'Registro':
				$funcion->Insertar_Usuario($usuario,$contrasena,$tipo_usuario,$idempleado);
			break;

			case 'Edicion':
				$funcion->Editar_Usuario($id,$usuario,$contrasena,$tipo_usuario,$estado,$idempleado);
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
