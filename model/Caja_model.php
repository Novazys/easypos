<?php 

	require_once('Conexion.php');

	class CajaModel extends Conexion
	{

		public function Validar_Caja()
		{
			$dbconec = Conexion::Conectar();
			try 
			{
				$query = "CALL sp_validar_caja()";
				$stmt = $dbconec->prepare($query);

				if($stmt->execute())
				{
					$count = $stmt->rowCount();
					if($count == 0){
						$data = "Cerrada";
 	   					echo json_encode($data);
					} else {
						$data = "Abierta";
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

		public function Listar_Datos()
		{
			$dbconec = Conexion::Conectar();

			try 
			{
				$query = "CALL sp_view_datos_caja();";
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

		public function Listar_Historico($date,$date2)
		{
			$dbconec = Conexion::Conectar();

			try 
			{
				$query = "CALL sp_historico_caja(:date,:date2);";
				$stmt = $dbconec->prepare($query);
				$stmt->bindParam(":date",$date);
				$stmt->bindParam(":date2",$date2);
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


		public function Listar_Movimientos()
		{
			$dbconec = Conexion::Conectar();

			try 
			{
				$query = "CALL sp_view_movimientos_caja();";
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

		public function Get_Movimientos()
		{
			$dbconec = Conexion::Conectar();

			try 
			{
				$query = "CALL sp_view_movimientos_caja();";
				$stmt = $dbconec->prepare($query);
				$stmt->execute();
				$count = $stmt->rowCount();
				$Data = array();
				if($count > 0)
				{
					while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
		  				$Data[] = $row;
					}
					echo json_encode($Data);
				}

				
				$dbconec = null;
			} catch (Exception $e) {
				//echo $e;
				echo '<span class="label label-danger label-block">ERROR AL CARGAR LOS DATOS, PRESIONE F5</span>';
			}
		}

		public function Listar_Ingresos()
		{
			$dbconec = Conexion::Conectar();

			try 
			{
				$query = "CALL sp_view_ingresos_caja();";
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

		public function Listar_Devoluciones()
		{
			$dbconec = Conexion::Conectar();

			try 
			{
				$query = "CALL sp_view_devoluciones_caja();";
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


		public function Listar_Prestamos()
		{
			$dbconec = Conexion::Conectar();

			try 
			{
				$query = "CALL sp_view_prestamos_caja();";
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

		public function Listar_Gastos()
		{
			$dbconec = Conexion::Conectar();

			try 
			{
				$query = "CALL sp_view_gastos_caja();";
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


		public function Abrir_Caja($monto)
		{
			$dbconec = Conexion::Conectar();
			try 
			{
				$query = "CALL sp_abrir_caja(:monto)";
				$stmt = $dbconec->prepare($query);
				$stmt->bindParam(":monto",$monto);

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

		public function Update_Caja($monto)
		{
			$dbconec = Conexion::Conectar();
			try 
			{
				$query = "CALL sp_update_monto_inicial(:monto)";
				$stmt = $dbconec->prepare($query);
				$stmt->bindParam(":monto",$monto);

				if($stmt->execute()){

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

		public function Cerrar_Caja($monto)
		{
			$dbconec = Conexion::Conectar();
			try 
			{
				$query = "CALL sp_cerrar_caja(:monto)";
				$stmt = $dbconec->prepare($query);
				$stmt->bindParam(":monto",$monto);

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

		public function Cerrar_Caja_Manual($id)
		{
			$dbconec = Conexion::Conectar();
			try 
			{
				$query = "CALL sp_cerrar_caja_manual(:id)";
				$stmt = $dbconec->prepare($query);
				$stmt->bindParam(":id",$id);

				if($stmt->execute())
				{
					$response['status']  = 'success';
					$response['message'] = 'Caja cerrada Correctamente!';
				} else {

					$response['status']  = 'error';
					$response['message'] = 'No pudimos cerrar la caja!';
				}
				echo json_encode($response);
				$dbconec = null;
			} catch (Exception $e) {
				$data = "Error";
				echo json_encode($data);
				
			}
		}

			public function Insertar_Movimiento($tipo_movimiento,$monto,$descripcion)
			{
				$dbconec = Conexion::Conectar();
				try 
				{
					$query = "CALL sp_insert_caja_movimiento(:tipo_movimiento,:monto,:descripcion)";
					$stmt = $dbconec->prepare($query);
					$stmt->bindParam(":tipo_movimiento",$tipo_movimiento);
					$stmt->bindParam(":monto",$monto);
					$stmt->bindParam(":descripcion",$descripcion);

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

			public function Insertar_Caja_Venta($monto)
			{
				$dbconec = Conexion::Conectar();
				try 
				{
					$query = "CALL sp_insert_caja_venta(:monto)";
					$stmt = $dbconec->prepare($query);
					$stmt->bindParam(":monto",$monto);

					$stmt->execute();
					
					$dbconec = null;

				} catch (Exception $e) {
					//$data = "Error";
					//echo json_encode($data);
					echo $e;
				}

			}


	}


 ?>