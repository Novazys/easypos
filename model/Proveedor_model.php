<?php

	require_once('Conexion.php');

	class ProveedorModel extends Conexion
	{
		public function Listar_Proveedores()
		{
			$dbconec = Conexion::Conectar();

			try
			{
				$query = "CALL sp_view_proveedor();";
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

		public function Insertar_Proveedor($nombre_proveedor, $numero_telefono, $numero_nit, 
		$nombre_contacto, $telefono_contacto)
		{
			$dbconec = Conexion::Conectar();
			try
			{
				$query = "CALL sp_insert_proveedor(:nombre_proveedor, :numero_telefono, :numero_nit,
				:nombre_contacto, :telefono_contacto)";
				$stmt = $dbconec->prepare($query);
				$stmt->bindParam(":nombre_proveedor",$nombre_proveedor);
				$stmt->bindParam(":numero_telefono",$numero_telefono);
				$stmt->bindParam(":numero_nit",$numero_nit);

				$stmt->bindParam(":nombre_contacto",$nombre_contacto);
				$stmt->bindParam(":telefono_contacto",$telefono_contacto);

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

		public function Editar_Proveedor($idproveedor ,$nombre_proveedor, $numero_telefono, $numero_nit,
		$nombre_contacto, $telefono_contacto,$estado)
		{
			$dbconec = Conexion::Conectar();
			try
			{
				$query = "CALL sp_update_proveedor(:idproveedor, :nombre_proveedor, :numero_telefono, :numero_nit,
				:nombre_contacto, :telefono_contacto, :estado);";
				$stmt = $dbconec->prepare($query);
				$stmt->bindParam(":idproveedor",$idproveedor);
				$stmt->bindParam(":nombre_proveedor",$nombre_proveedor);
				$stmt->bindParam(":numero_telefono",$numero_telefono);
				$stmt->bindParam(":numero_nit",$numero_nit);

				$stmt->bindParam(":nombre_contacto",$nombre_contacto);
				$stmt->bindParam(":telefono_contacto",$telefono_contacto);
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
