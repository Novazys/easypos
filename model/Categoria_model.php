<?php 

	require_once('Conexion.php');

	class CategoriaModel extends Conexion
	{
		public function Listar_Categorias()
		{
			$dbconec = Conexion::Conectar();

			try 
			{
				$query = "CALL sp_view_categoria();";
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

		public function Insertar_Categoria($categoria)
		{
			$dbconec = Conexion::Conectar();
			try 
			{
				$query = "CALL sp_insert_categoria(:categoria)";
				$stmt = $dbconec->prepare($query);
				$stmt->bindParam(":categoria",$categoria);

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

		public function Editar_Categoria($idcategoria,$categoria,$estado)
		{
			$dbconec = Conexion::Conectar();
			try 
			{
				$query = "CALL sp_update_categoria(:idcategoria,:categoria,:estado);";
				$stmt = $dbconec->prepare($query);
				$stmt->bindParam(":idcategoria",$idcategoria);
				$stmt->bindParam(":categoria",$categoria);
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