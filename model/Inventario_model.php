<?php

	require_once('Conexion.php');

	class InventarioModel extends Conexion
	{
		public function Listar_Kardex($mes)
		{
			$dbconec = Conexion::Conectar();

			try
			{
				$query = "CALL sp_kardex_inventario(:mes);";
				$stmt = $dbconec->prepare($query);
				$stmt->bindParam(":mes",$mes);
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

		public function Listar_Entradas($mes)
		{
			$dbconec = Conexion::Conectar();

			try
			{
				$query = "CALL sp_view_entradas(:mes);";
				$stmt = $dbconec->prepare($query);
				$stmt->bindParam(":mes",$mes);
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

		public function Listar_Salidas($mes)
		{
			$dbconec = Conexion::Conectar();

			try
			{
				$query = "CALL sp_view_salidas(:mes);";
				$stmt = $dbconec->prepare($query);
				$stmt->bindParam(":mes",$mes);
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



		public function Validar_Inventario()
		{
			$dbconec = Conexion::Conectar();
			try
			{
				$query = "CALL sp_validar_inventario()";
				$stmt = $dbconec->prepare($query);

				if($stmt->execute())
				{
					$row = $stmt->fetch(PDO::FETCH_ASSOC);

					if($row['respuesta'] == 'VALIDADO'){

								$data = "Validado";
		 	   				echo json_encode($data);

					} else if ($row['respuesta'] == 'NO EXISTE'){

								$data = "No Existe";
								echo json_encode($data);

					} else if ($row['respuesta'] == 'SIN PRODUCTOS'){

							$data = "0";
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


		public function Abrir_Inventario()
		{
			$dbconec = Conexion::Conectar();
			try
			{
				$query = "CALL sp_abrir_inventario()";
				$stmt = $dbconec->prepare($query);

				if($stmt->execute())
				{

					$row = $stmt->fetch(PDO::FETCH_ASSOC);

					if($row['respuesta'] == 'ABIERTO'){

						$data = "Validado";
 	   					echo json_encode($data);

					} else {

						$data = "Vigente";
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

		public function Cerrar_Inventario()
		{
			$dbconec = Conexion::Conectar();
			try
			{
				$query = "CALL sp_cerrar_inventario_manual()";
				$stmt = $dbconec->prepare($query);

				if($stmt->execute())
				{

					$row = $stmt->fetch(PDO::FETCH_ASSOC);

					if($row['respuesta'] == 'CERRADO'){

						$data = $row['respuesta'];
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

		public function Insertar_Entrada($descripcion,$cantidad,$producto)
		{
			$dbconec = Conexion::Conectar();
			try
			{
				$query = "CALL sp_insert_entrada(:descripcion,:cantidad,:producto)";
				$stmt = $dbconec->prepare($query);
				$stmt->bindParam(":descripcion",$descripcion);
				$stmt->bindParam(":cantidad",$cantidad);
				$stmt->bindParam(":producto",$producto);

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


		public function Insertar_Salida($descripcion,$cantidad,$producto)
		{
			$dbconec = Conexion::Conectar();
			try
			{
				$query = "CALL sp_insert_salida(:descripcion,:cantidad,:producto)";
				$stmt = $dbconec->prepare($query);
				$stmt->bindParam(":descripcion",$descripcion);
				$stmt->bindParam(":cantidad",$cantidad);
				$stmt->bindParam(":producto",$producto);

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

	}


 ?>
