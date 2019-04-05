<?php 

	require_once('Conexion.php');

	class MonedaModel extends Conexion
	{
		public function Listar_Monedas()
		{
			$dbconec = Conexion::Conectar();

			try 
			{
				$query = "CALL sp_view_currency();";
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

		public function Insertar_Moneda($CurrencyISO, $Language, $CurrencyName, $Money, $Symbol)
		{
			$dbconec = Conexion::Conectar();
			try 
			{
				$query = "CALL sp_insert_currency(:CurrencyISO, :Language, :CurrencyName, :Money, :Symbol)";
				$stmt = $dbconec->prepare($query);
				$stmt->bindParam(":CurrencyISO",$CurrencyISO);
				$stmt->bindParam(":Language",$Language);
				$stmt->bindParam(":CurrencyName",$CurrencyName);
				$stmt->bindParam(":Money",$Money);
				$stmt->bindParam(":Symbol",$Symbol);


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

		public function Editar_Moneda($idcurrency, $CurrencyISO, $Language, $CurrencyName, $Money, $Symbol)
		{
			$dbconec = Conexion::Conectar();
			try 
			{
				$query = "CALL sp_update_currency(:idcurrency, :CurrencyISO, :Language, :CurrencyName, :Money, :Symbol);";
				$stmt = $dbconec->prepare($query);
				$stmt->bindParam(":idcurrency",$idcurrency);
				$stmt->bindParam(":CurrencyISO",$CurrencyISO);
				$stmt->bindParam(":Language",$Language);
				$stmt->bindParam(":CurrencyName",$CurrencyName);
				$stmt->bindParam(":Money",$Money);
				$stmt->bindParam(":Symbol",$Symbol);


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