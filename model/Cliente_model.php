<?php

	require_once('Conexion.php');

	class ClienteModel extends Conexion
	{
		public function Listar_Clientes()
		{
			$dbconec = Conexion::Conectar();

			try
			{
				$query = "CALL sp_view_Cliente();";
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

		public function Listar_Clientes_Activos()
		{
			$dbconec = Conexion::Conectar();

			try
			{
				$query = "CALL sp_view_cliente_activo();";
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

		public function Listar_Clientes_Inactivos()
		{
			$dbconec = Conexion::Conectar();

			try
			{
				$query = "CALL sp_view_cliente_inactivo();";
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

		public function Ver_Limite_Credito($idcliente){

			$dbconec = Conexion::Conectar();
			try {

				$query = "CALL sp_view_limite_credito(:idcliente)";
				$stmt = $dbconec->prepare($query);
				$stmt->bindParam(":idcliente",$idcliente);
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


		public function Insertar_Cliente($nombre_cliente, $numero_nit, $direccion,
		$numero_telefono, $email, $giro, $limite_credito)
		{
			$dbconec = Conexion::Conectar();
			try
			{
				$query = "CALL sp_insert_cliente(:nombre_cliente, :numero_nit,
				:direccion, :numero_telefono, :email, :giro, :limite_credito)";
				$stmt = $dbconec->prepare($query);
				$stmt->bindParam(":nombre_cliente",$nombre_cliente);
				$stmt->bindParam(":numero_nit",$numero_nit);
				
				$stmt->bindParam(":direccion",$direccion);
				$stmt->bindParam(":numero_telefono",$numero_telefono);
				$stmt->bindParam(":email",$email);
				$stmt->bindParam(":giro",$giro);
				$stmt->bindParam(":limite_credito",$limite_credito);

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

		public function Editar_Cliente($idcliente, $nombre_cliente, $numero_nit, $direccion,
		$numero_telefono, $email, $giro, $limite_credito, $estado)
		{
			$dbconec = Conexion::Conectar();
			try
			{
				$query = "CALL sp_update_cliente(:idcliente, :nombre_cliente, :numero_nit,
				:direccion, :numero_telefono, :email, :giro, :limite_credito, :estado);";
				$stmt = $dbconec->prepare($query);
				$stmt->bindParam(":idcliente",$idcliente);
				$stmt->bindParam(":nombre_cliente",$nombre_cliente);
				$stmt->bindParam(":numero_nit",$numero_nit);

				$stmt->bindParam(":direccion",$direccion);
				$stmt->bindParam(":numero_telefono",$numero_telefono);
				$stmt->bindParam(":email",$email);
				$stmt->bindParam(":giro",$giro);
				$stmt->bindParam(":limite_credito",$limite_credito);
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
