<?php 

	require_once('Conexion.php');

	class EmpleadoModel extends Conexion
	{
		public function Listar_Empleados()
		{
			$dbconec = Conexion::Conectar();

			try 
			{
				$query = "CALL sp_view_empleado();";
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

		public function Insertar_Empleado($nombre_empleado, $apellido_empleado, $telefono_empleado, $email_empleado)
		{
			$dbconec = Conexion::Conectar();
			try 
			{
				$query = "CALL sp_insert_empleado(:nombre_empleado, :apellido_empleado, :telefono_empleado, :email_empleado)";
				$stmt = $dbconec->prepare($query);
				$stmt->bindParam(":nombre_empleado",$nombre_empleado);
				$stmt->bindParam(":apellido_empleado",$apellido_empleado);
				$stmt->bindParam(":telefono_empleado",$telefono_empleado);
				$stmt->bindParam(":email_empleado",$email_empleado);

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

		public function Editar_Empleado($idempleado, $nombre_empleado, $apellido_empleado, $telefono_empleado, $email_empleado, $estado)
		{
			$dbconec = Conexion::Conectar();
			try 
			{
				$query = "CALL sp_update_empleado(:idempleado, :nombre_empleado, :apellido_empleado, :telefono_empleado, :email_empleado, :estado);";
				$stmt = $dbconec->prepare($query);
				$stmt->bindParam(":idempleado",$idempleado);
				$stmt->bindParam(":nombre_empleado",$nombre_empleado);
				$stmt->bindParam(":apellido_empleado",$apellido_empleado);
				$stmt->bindParam(":telefono_empleado",$telefono_empleado);
				$stmt->bindParam(":email_empleado",$email_empleado);
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