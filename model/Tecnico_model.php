<?php

	require_once('Conexion.php');

	class TecnicoModel extends Conexion
	{
		public function Listar_Tecnicos()
		{
			$dbconec = Conexion::Conectar();

			try
			{
				$query = "CALL sp_view_tecnico();";
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

		public function Insertar_Tecnico($Tecnico,$telefono)
		{
			$dbconec = Conexion::Conectar();
			try
			{
				$query = "CALL sp_insert_Tecnico(:Tecnico,:telefono)";
				$stmt = $dbconec->prepare($query);
				$stmt->bindParam(":Tecnico",$Tecnico);
				$stmt->bindParam(":telefono",$telefono);

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

		public function Editar_Tecnico($idTecnico,$Tecnico,$telefono,$estado)
		{
			$dbconec = Conexion::Conectar();
			try
			{
				$query = "CALL sp_update_Tecnico(:idTecnico,:Tecnico,:telefono,:estado);";
				$stmt = $dbconec->prepare($query);
				$stmt->bindParam(":idTecnico",$idTecnico);
				$stmt->bindParam(":Tecnico",$Tecnico);
				$stmt->bindParam(":telefono",$telefono);
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
