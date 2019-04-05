<?php 

	require_once('Conexion.php');

	class PerecederoModel extends Conexion
	{
		public function Listar_Perecederos($fecha1,$fecha2)
		{
			$dbconec = Conexion::Conectar();

			try 
			{
				$query = "CALL sp_view_perecedero(:fecha1,:fecha2);";
				$stmt = $dbconec->prepare($query);
				$stmt->bindParam(":fecha1",$fecha1);
				$stmt->bindParam(":fecha2",$fecha2);
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

		public function Listar_A_Vencer()
		{
			$dbconec = Conexion::Conectar();

			try 
			{
				$query = "CALL sp_view_a_vencer_meses();";
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

		public function Listar_Productos()
		{
			$dbconec = Conexion::Conectar();

			try 
			{
				$query = "CALL sp_view_producto_perecedero();";
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

		public function Listar_Stock($producto)
		{
			$dbconec = Conexion::Conectar();

			try 
			{
				$query = "CALL sp_view_stock_producto_perecedero(:producto);";
				$stmt = $dbconec->prepare($query);
				$stmt->bindParam(":producto",$producto);
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


		public function Insertar_Perecedero($fecha_vencimiento, $cantidad_perecedero, $idproducto)
		{
			$dbconec = Conexion::Conectar();
			try 
			{
				$query = "CALL sp_insert_perecedero(:fecha_vencimiento, :cantidad_perecedero, :idproducto)";
				$stmt = $dbconec->prepare($query);
				$stmt->bindParam(":fecha_vencimiento",$fecha_vencimiento);
				$stmt->bindParam(":cantidad_perecedero",$cantidad_perecedero);
				$stmt->bindParam(":idproducto",$idproducto);

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

		public function Editar_Perecedero($fecha_vencimiento, $cantidad_perecedero, $idproducto)
		{
			$dbconec = Conexion::Conectar();
			try 
			{
				$query = "CALL sp_update_perecedero(:fecha_vencimiento, :cantidad_perecedero, :idproducto);";
				$stmt = $dbconec->prepare($query);
				$stmt->bindParam(":fecha_vencimiento",$fecha_vencimiento);
				$stmt->bindParam(":cantidad_perecedero",$cantidad_perecedero);
				$stmt->bindParam(":idproducto",$idproducto);


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


		public function Borrar_Perecedero($fecha_vencimiento, $idproducto)
		{
			$dbconec = Conexion::Conectar();
			$response = array();
			try 
			{
				$query = "CALL sp_delete_perecedero(:fecha_vencimiento, :idproducto);";
				$stmt = $dbconec->prepare($query);
				$stmt->bindParam(":fecha_vencimiento",$fecha_vencimiento);
				$stmt->bindParam(":idproducto",$idproducto);

				if($stmt->execute())
				{
					$response['status']  = 'success';
					$response['message'] = 'Producto eliminado del listado Correctamente!';
				} else {

					$response['status']  = 'error';
					$response['message'] = 'No pudimos borrar el producto!';
				}
				echo json_encode($response);
				$dbconec = null;
			} catch (Exception $e) {
				$response['status']  = 'error';
				$response['message'] = 'Error de Ejecucion';
				echo json_encode($response);
				
			}

		}

	}


 ?>