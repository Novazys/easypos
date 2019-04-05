<?php 

	function __autoload($className){
		$model = "../../model/". $className ."_model.php";
		$controller = "../../controller/". $className ."_controller.php";
	
		require_once($model);
		require_once($controller);
	}

	$funcion = new Tiraje();

	if(isset($_POST['fecha_resolucion']) && isset($_POST['numero_resolucion']) && isset($_POST['serie'])){
		
		try {


			$proceso = $_POST['proceso'];
			$id = $_POST['id'];
			$fecha_resolucion = trim($_POST['fecha_resolucion']);
			$numero_resolucion = trim($_POST['numero_resolucion']);
			$numero_resolucion_fact = trim($_POST['numero_resolucion_fact']);
			$serie = trim($_POST['serie']);
			$desde = trim($_POST['desde']);
			$hasta = trim($_POST['hasta']);
			$disponibles = trim($_POST['disponibles']);
			$idcomprobante = trim($_POST['idcomprobante']);

			$fecha_resolucion = DateTime::createFromFormat('d/m/Y', $fecha_resolucion)->format('Y-m-d');

			switch($proceso){

			case 'Registro':
				$funcion->Insertar_Tiraje($fecha_resolucion,$numero_resolucion, $numero_resolucion_fact,$serie,$desde,$hasta,$disponibles,$idcomprobante);
			break;

			case 'Edicion':
				$funcion->Editar_Tiraje($id,$fecha_resolucion,$numero_resolucion, $numero_resolucion_fact,$serie,$desde,$hasta,$disponibles,$idcomprobante);
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
