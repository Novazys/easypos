<?php 

	require_once('Conexion.php');

	class TirajeModel extends Conexion
	{
		public function Listar_Tirajes()
		{
			$dbconec = Conexion::Conectar();

			try 
			{
				$query = "CALL sp_view_tiraje();";
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

		public function Listar_Comprobantes()
		{
			$dbconec = Conexion::Conectar();

			try 
			{
				$query = "CALL sp_view_comprobante_activo();";
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


		public function Insertar_Tiraje($fecha_resolucion, $numero_resolucion, $numero_resolucion_fact, $serie, $desde, $hasta, $disponibles, $idcomprobante)
		{
			$dbconec = Conexion::Conectar();
			try 
			{
				$query = "CALL sp_insert_tiraje_comprobante(:fecha_resolucion, :numero_resolucion, :numero_resolucion_fact, :serie, :desde, :hasta, :disponibles, :idcomprobante)";
				$stmt = $dbconec->prepare($query);
				$stmt->bindParam(":fecha_resolucion",$fecha_resolucion);
				$stmt->bindParam(":numero_resolucion",$numero_resolucion);
				$stmt->bindParam(":numero_resolucion_fact",$numero_resolucion_fact);
				$stmt->bindParam(":serie",$serie);
				$stmt->bindParam(":desde",$desde);
				$stmt->bindParam(":hasta",$hasta);
				$stmt->bindParam(":disponibles",$disponibles);
				$stmt->bindParam(":idcomprobante",$idcomprobante);

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
				//$data = "Error";
				//echo json_encode($data);
				echo $e;
				
			}

		}

		public function Editar_Tiraje($idtiraje, $fecha_resolucion, $numero_resolucion, $numero_resolucion_fact, $serie, $desde, $hasta, $disponibles, $idcomprobante)
		{
			$dbconec = Conexion::Conectar();
			try 
			{
				$query = "CALL sp_update_tiraje_comprobante(:idtiraje, :fecha_resolucion, 
				:numero_resolucion, :numero_resolucion_fact, :serie, :desde, :hasta,  :disponibles, :idcomprobante);";
				$stmt = $dbconec->prepare($query);
				$stmt->bindParam(":idtiraje",$idtiraje);
				$stmt->bindParam(":fecha_resolucion",$fecha_resolucion);
				$stmt->bindParam(":numero_resolucion",$numero_resolucion);
				$stmt->bindParam(":numero_resolucion_fact",$numero_resolucion_fact);
				$stmt->bindParam(":serie",$serie);
				$stmt->bindParam(":desde",$desde);
				$stmt->bindParam(":hasta",$hasta);
				$stmt->bindParam(":disponibles",$disponibles);
				$stmt->bindParam(":idcomprobante",$idcomprobante);


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
				//$data = "Error";
				//echo json_encode($data);
				echo $e;
			
			}

		}

	}


 ?>