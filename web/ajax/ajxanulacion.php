<?php 

	function __autoload($className){
		$model = "../../model/". $className ."_model.php";
		$controller = "../../controller/". $className ."_controller.php";
	
		require_once($model);
		require_once($controller);
	}

	$venta = new Venta();
	$compra = new Compra();
	$apartado = new Apartado();


	if(isset($_POST['proceso'])){
		
		try {

			$proceso = $_POST['proceso'];


			$numero_transaccion = trim($_POST['numero_transaccion']);
			


			switch($proceso){

			case 'Anular_Venta':
				$venta->Anular_Venta($numero_transaccion);
			break;

			case 'Finalizar_Venta':
				$venta->Finalizar_Venta($numero_transaccion);
			break;

			case 'Anular_Compra':
				$compra->Anular_Compra($numero_transaccion);
			break;


			case 'Anular_Apartado':
				$apartado->Anular_Apartado($numero_transaccion);
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
