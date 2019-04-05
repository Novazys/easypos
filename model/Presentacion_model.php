<?php 

	require_once('Conexion.php');

	class PresentacionModel extends Conexion
	{
		public function Listar_Presentaciones()
		{
			$dbconec = Conexion::Conectar();

			try 
			{
				$query = "CALL sp_view_presentacion();";
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

		public function Insertar_Presentacion($presentacion,$siglas)
		{
			$dbconec = Conexion::Conectar();
			try 
			{
				$query = "CALL sp_insert_presentacion(:presentacion,:siglas)";
				$stmt = $dbconec->prepare($query);
				$stmt->bindParam(":presentacion",$presentacion);
				$stmt->bindParam(":siglas",$siglas);

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

		public function Editar_Presentacion($idpresentacion,$presentacion,$siglas,$estado)
		{
			$dbconec = Conexion::Conectar();
			try 
			{
				$query = "CALL sp_update_presentacion(:idpresentacion,:presentacion,:siglas,:estado);";
				$stmt = $dbconec->prepare($query);
				$stmt->bindParam(":idpresentacion",$idpresentacion);
				$stmt->bindParam(":presentacion",$presentacion);
				$stmt->bindParam(":siglas",$siglas);
				$stmt->bindParam(":estado",$estado);


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