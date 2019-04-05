<?php 

	require_once('Conexion.php');

	class MarcaModel extends Conexion
	{
		public function Listar_Marcas()
		{
			$dbconec = Conexion::Conectar();

			try 
			{
				$query = "CALL sp_view_marca();";
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

		public function Insertar_Marca($marca)
		{
			$dbconec = Conexion::Conectar();
			try 
			{
				$query = "CALL sp_insert_marca(:marca)";
				$stmt = $dbconec->prepare($query);
				$stmt->bindParam(":marca",$marca);

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

		public function Editar_Marca($idmarca,$marca,$estado)
		{
			$dbconec = Conexion::Conectar();
			try 
			{
				$query = "CALL sp_update_marca(:idmarca,:marca,:estado);";
				$stmt = $dbconec->prepare($query);
				$stmt->bindParam(":idmarca",$idmarca);
				$stmt->bindParam(":marca",$marca);
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