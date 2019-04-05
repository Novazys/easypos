<?php 

	function __autoload($className){
		$model = "../../model/". $className ."_model.php";
		$controller = "../../controller/". $className ."_controller.php";
	
		require_once($model);
		require_once($controller);
	}

	$funcion = new Perecedero();

	$producto = isset($_GET['producto']) ? $_GET['producto'] : '';
	if(!$producto==""){
		$funcion->Listar_Stock($producto);
	}

	if(isset($_POST['fecha_vencimiento']) && isset($_POST['cantidad_perecedero']) && isset($_POST['idproducto'])){
		
		try {

			$proceso = $_POST['proceso'];
			$fecha_vencimiento = trim($_POST['fecha_vencimiento']);
			$cantidad_perecedero = trim($_POST['cantidad_perecedero']);
			$idproducto = trim($_POST['idproducto']);

			if($fecha_vencimiento!='empty')
			{
				$fecha_vencimiento = DateTime::createFromFormat('d/m/Y', $fecha_vencimiento)->format('Y-m-d');
			}

			

			switch($proceso){

			case 'Registro':
				$funcion->Insertar_Perecedero($fecha_vencimiento,$cantidad_perecedero,$idproducto);
			break;

			case 'Edicion':
				$funcion->Editar_Perecedero($fecha_vencimiento,$cantidad_perecedero,$idproducto);
			break;

			case 'Eliminar':

				$idproducto_final = "";
				$fecha_vencimiento_final = "";

				$arreglo = explode(",", $idproducto);
				//saco el numero de elementos
				$longitud = count($arreglo);

				for($i=0; $i<$longitud; $i++){
			      //saco el valor de cada elemento
				    $idproducto_final = $arreglo[0];
				    $fecha_vencimiento_final = $arreglo[1];
				 }

				$funcion->Borrar_Perecedero($fecha_vencimiento_final,$idproducto_final);

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
