<?php 

	function __autoload($className){
		$model = "../../model/". $className ."_model.php";
		$controller = "../../controller/". $className ."_controller.php";
	
		require_once($model);
		require_once($controller);
	}

	$funcion = new Moneda();

	if(isset($_POST['CurrencyISO']) && isset($_POST['CurrencyName']) && isset($_POST['Symbol'])){
		
		try {


			$proceso = $_POST['proceso'];
			$id = $_POST['id'];

			$CurrencyISO = trim($_POST['CurrencyISO']);
			$Language = trim($_POST['Language']);
			$CurrencyName = trim($_POST['CurrencyName']);
			$Money = trim($_POST['Money']);
			$Symbol = trim($_POST['Symbol']);


			switch($proceso){

			case 'Registro':
				$funcion->Insertar_Moneda($CurrencyISO, $Language, $CurrencyName, $Money, $Symbol);
			break;

			case 'Edicion':
				$funcion->Editar_Moneda($id,$CurrencyISO, $Language, $CurrencyName, $Money, $Symbol);
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
