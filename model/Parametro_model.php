<?php

	require_once('Conexion.php');

	class ParametroModel extends Conexion
	{
		public function Listar_Parametros()
		{
			$dbconec = Conexion::Conectar();

			try
			{
				$query = "CALL sp_view_parametro();";
				$stmt = $dbconec->prepare($query);
				$stmt->execute();
				$count = $stmt->rowCount();

				if($count > 0)
				{
					return $stmt->fetchAll();
				}


				$dbconec = null;
			} catch (Exception $e) {

				echo '<span class="label label-danger label-block">ERROR AL CARGAR LOS DATOS, PRESIONE F5</span>';
			}
		}

		public function Listar_Monedas()
		{
			$dbconec = Conexion::Conectar();

			try
			{
				$query = "CALL sp_view_currency();";
				$stmt = $dbconec->prepare($query);
				$stmt->execute();
				$count = $stmt->rowCount();

				if($count > 0)
				{
					return $stmt->fetchAll();
				}


				$dbconec = null;
			} catch (Exception $e) {

				echo '<span class="label label-danger label-block">ERROR AL CARGAR LOS DATOS, PRESIONE F5</span>';
			}
		}

		public function Ver_Impuesto(){

			$dbconec = Conexion::Conectar();
			try {

				$query = "CALL sp_view_impuesto()";
				$stmt = $dbconec->prepare($query);
				$stmt->execute();
				$Data = array();

				while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
		  			$Data[] = $row;
				}

				// header('Content-type: application/json');
				 echo json_encode($Data);

			} catch (Exception $e) {

				echo "Error al cargar el listado";
			}

		}

		public function Ver_Moneda(){

			$dbconec = Conexion::Conectar();

			try {
				$query = "CALL sp_view_money()";
				$stmt = $dbconec->prepare($query);
				$stmt->execute();
				$Data = array();

				while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
		  			$Data[] = $row;
				}

				// header('Content-type: application/json');
				 echo json_encode($Data);

			} catch (Exception $e) {

				echo "Error al cargar el listado";
			}

		}

		public function Ver_Moneda_Simbolo(){

			$dbconec = Conexion::Conectar();

			try {
				$query = "CALL sp_view_money()";
				$stmt = $dbconec->prepare($query);
				$stmt->execute();
				$count = $stmt->rowCount();

				if($count > 0)
				{
					return $stmt->fetchAll();
				}


				$dbconec = null;

			} catch (Exception $e) {

				echo "Error al cargar el listado";
			}

		}


		public function Insertar_Parametro($nombre_empresa, $propietario, $numero_nit,
		$porcentaje_iva, $porcentaje_retencion , $monto_retencion, $direccion, $idcurrency)
		{
			$dbconec = Conexion::Conectar();
			try
			{
				$query = "CALL sp_insert_parametro(:nombre_empresa, :propietario, :numero_nit,
				:porcentaje_iva, :porcentaje_retencion, :monto_retencion, :direccion, :idcurrency)";
				$stmt = $dbconec->prepare($query);
				$stmt->bindParam(":nombre_empresa",$nombre_empresa);
				$stmt->bindParam(":propietario",$propietario);
				$stmt->bindParam(":numero_nit",$numero_nit);

				$stmt->bindParam(":porcentaje_iva",$porcentaje_iva);
				$stmt->bindParam(":porcentaje_retencion",$porcentaje_retencion);
				$stmt->bindParam(":monto_retencion",$monto_retencion);
				$stmt->bindParam(":direccion",$direccion);
				$stmt->bindParam(":idcurrency",$idcurrency);

				if($stmt->execute())
				{
					$count = $stmt->rowCount();
					if($count == 0){
						$data = "Duplicado";
 	   					echo json_encode($data);
					} else {
						$data = "Validado";
 	   					echo json_encode($data);
					}
				} else {

					$data = "Error";
 	   		 	echo json_encode($data);
				}
				$dbconec = null;
			} catch (Exception $e) {
				$data = "Error";
				echo json_encode($data);

			}

		}

		public function Editar_Parametro($idparametro, $nombre_empresa, $propietario, $numero_nit,
		$porcentaje_iva, $porcentaje_retencion, $monto_retencion, $direccion,$idcurrency)
		{
			$dbconec = Conexion::Conectar();
			try
			{
				$query = "CALL sp_update_parametro(:idparametro,:nombre_empresa, :propietario, :numero_nit,
				:porcentaje_iva, :porcentaje_retencion, :monto_retencion, :direccion,:idcurrency);";
				$stmt = $dbconec->prepare($query);
				$stmt->bindParam(":idparametro",$idparametro);
				$stmt->bindParam(":nombre_empresa",$nombre_empresa);
				$stmt->bindParam(":propietario",$propietario);
				$stmt->bindParam(":numero_nit",$numero_nit);
				
				$stmt->bindParam(":porcentaje_iva",$porcentaje_iva);
				$stmt->bindParam(":porcentaje_retencion",$porcentaje_retencion);
				$stmt->bindParam(":monto_retencion",$monto_retencion);
				$stmt->bindParam(":direccion",$direccion);
				$stmt->bindParam(":idcurrency",$idcurrency);

				if($stmt->execute())
				{

				  $data = "Validado";
   				  echo json_encode($data);

				} else {

					$data = "Error";
 	   		 	 	echo json_encode($data);
				}
				$dbconec = null;
			} catch (Exception $e) {
				$data = "Error";
				echo json_encode($data);

			}

		}

	}


 ?>
