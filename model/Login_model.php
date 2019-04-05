<?php 
	session_start();
	require_once('Conexion.php');

	class LoginModel extends Conexion
	{

		public function Restaurar_Password($usuario,$contrasena)
		{
			$dbconec = Conexion::Conectar();
			try 
			{
				$query = "CALL sp_reset_password_usuario(:usuario,:contrasena)";
				$stmt = $dbconec->prepare($query);
				$stmt->bindParam(":usuario",$usuario);
				$stmt->bindParam(":contrasena",$contrasena);

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

		
		public function Login_Usuario($usuario,$contrasena)
		{
			$dbconec = Conexion::Conectar();

			try 
			{

				$query = "CALL sp_login_usuario(:usuario,:contrasena)";
				$stmt = $dbconec->prepare($query);
				$stmt->bindParam(":usuario",$usuario);
				$stmt->bindParam(":contrasena",$contrasena);

				if($stmt->execute())
				{
					$row = $stmt->fetch(PDO::FETCH_ASSOC);

					if($row['contrasena'] == $contrasena){

						$_SESSION['user_id'] = $row['idusuario'];
						$_SESSION['user_name'] = $row['usuario'];
						$_SESSION['user_tipo'] = $row['tipo_usuario'];
						$_SESSION['user_empleado'] = $row['nombre_empleado'];

					   $data = "Validado";
					   echo json_encode($data);

					} else {

						$data = "Bad Pass";
						echo json_encode($data);
					}

				}

			}  catch (Exception $e) {
				$data = "Error";
				echo json_encode($data);
			
			}
						

		}


}

 ?>