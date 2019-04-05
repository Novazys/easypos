<?php 

	require_once('Conexion.php');

	class UsuarioModel extends Conexion
	{
		public function Listar_Usuarios()
		{
			$dbconec = Conexion::Conectar();

			try 
			{
				$query = "CALL sp_view_usuario();";
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

		public function Listar_Empleados()
		{
			$dbconec = Conexion::Conectar();

			try 
			{
				$query = "CALL sp_view_empleado_activo();";
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


		public function Insertar_Usuario($usuario, $contrasena, $tipo_usuario, $idempleado)
		{
			$dbconec = Conexion::Conectar();
			try 
			{
				$query = "CALL sp_insert_usuario(:usuario, :contrasena, :tipo_usuario, :idempleado)";
				$stmt = $dbconec->prepare($query);
				$stmt->bindParam(":usuario",$usuario);
				$stmt->bindParam(":contrasena",$contrasena);
				$stmt->bindParam(":tipo_usuario",$tipo_usuario);
				$stmt->bindParam(":idempleado",$idempleado);

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

		public function Editar_Usuario($idusuario, $usuario, $contrasena, $tipo_usuario, $estado, $idempleado)
		{
			$dbconec = Conexion::Conectar();
			try 
			{
				$query = "CALL sp_update_usuario(:idusuario, :usuario, :contrasena, :tipo_usuario, :estado, :idempleado);";
				$stmt = $dbconec->prepare($query);
				$stmt->bindParam(":idusuario",$idusuario);
				$stmt->bindParam(":usuario",$usuario);
				$stmt->bindParam(":contrasena",$contrasena);
				$stmt->bindParam(":tipo_usuario",$tipo_usuario);
				$stmt->bindParam(":estado",$estado);
				$stmt->bindParam(":idempleado",$idempleado);


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