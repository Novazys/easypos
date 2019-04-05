<?php

	require_once('Conexion.php');

	class CreditoModel extends Conexion
	{

		public function Imprimir_Ticket_Abono($idabono)
		{
			$dbconec = Conexion::Conectar();

			try
			{
				$query = "CALL sp_imprimir_ticket_abono(:idabono);";
				$stmt = $dbconec->prepare($query);
				$stmt->bindParam(":idabono",$idabono);
				$stmt->execute();
				$count = $stmt->rowCount();

				if($count > 0)
				{
					return $stmt;
				}


				$dbconec = null;
			} catch (Exception $e) {

				echo '<span class="label label-danger label-block">ERROR AL CARGAR LOS DATOS, PRESIONE F5</span>';
			}
		}


		public function Listar_Creditos($criterio)
		{
			$dbconec = Conexion::Conectar();

			try
			{
				$query = "CALL sp_view_creditos(:criterio);";
				$stmt = $dbconec->prepare($query);
				$stmt->bindParam(":criterio",$criterio);
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

		public function Listar_Creditos_Espc($criterio)
		{
			$dbconec = Conexion::Conectar();

			try
			{
				$query = "CALL sp_view_creditos_espc(:criterio);";
				$stmt = $dbconec->prepare($query);
				$stmt->bindParam(":criterio",$criterio);
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


    public function Listar_Abonos_Credito($criterio)
    {
      $dbconec = Conexion::Conectar();

      try
      {
        $query = "CALL sp_view_abonos(:criterio);";
        $stmt = $dbconec->prepare($query);
        $stmt->bindParam(":criterio",$criterio);
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

		public function Reporte_Abonos($fecha,$fecha2)
		{
			$dbconec = Conexion::Conectar();

			try
			{
				$query = "CALL sp_view_total_abonos_fechas(:fecha,:fecha2);";
				$stmt = $dbconec->prepare($query);
				$stmt->bindParam(":fecha",$fecha);
				$stmt->bindParam(":fecha2",$fecha2);
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

    public function Listar_Abonos_All()
    {
      $dbconec = Conexion::Conectar();

      try
      {
        $query = "CALL sp_view_all_abonos();";
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

		public function Listar_Detalle($idventa)
		{
			$dbconec = Conexion::Conectar();

			try
			{
				$query = "CALL sp_view_detalleventa(:idventa);";
				$stmt = $dbconec->prepare($query);
				$stmt->bindParam(":idventa",$idventa);
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

		public function Listar_Info($idventa)
		{
			$dbconec = Conexion::Conectar();

			try
			{
				$query = "CALL sp_view_venta(:idventa);";
				$stmt = $dbconec->prepare($query);
				$stmt->bindParam(":idventa",$idventa);
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

    public function Ver_Restante($idcredito){

      $dbconec = Conexion::Conectar();
      try {

        $query = "CALL sp_view_monto_credito(:idcredito)";
        $stmt->bindParam(":idcredito",$idcredito);
        $stmt = $dbconec->prepare($query);
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


    		public function Count_Creditos()
    		{
    			$dbconec = Conexion::Conectar();

    			try
    			{
    				$query = "CALL sp_count_creditos();";
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




    public function Editar_Credito($id,$nombre,$fecha,$monto,$abonado,$restante,$estado)
    {
      $dbconec = Conexion::Conectar();
      try
      {
        $query = "CALL sp_update_credito(:id,:nombre,:fecha,:monto,:abonado,:restante,:estado);";
        $stmt = $dbconec->prepare($query);
				$stmt->bindParam(":id",$id);
        $stmt->bindParam(":nombre",$nombre);
        $stmt->bindParam(":fecha",$fecha);
        $stmt->bindParam(":monto",$monto);
        $stmt->bindParam(":abonado",$abonado);
        $stmt->bindParam(":restante",$restante);
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

    public function Insertar_Abono($idcredito, $monto, $idusuario)
    {
      $dbconec = Conexion::Conectar();
      try
      {
        $query = "CALL sp_insert_abono(:idcredito, :monto, :idusuario)";
        $stmt = $dbconec->prepare($query);
        $stmt->bindParam(":idcredito",$idcredito);
        $stmt->bindParam(":monto",$monto);
				$stmt->bindParam(":idusuario",$idusuario);

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

    public function Editar_Abono($idabono,$fecha_abono,$monto_abono)
    {
      $dbconec = Conexion::Conectar();
      try
      {
        $query = "CALL sp_update_abono(:idabono,:fecha_abono,:monto_abono);";
        $stmt = $dbconec->prepare($query);
        $stmt->bindParam(":idabono",$idabono);
        $stmt->bindParam(":fecha_abono",$fecha_abono);
        $stmt->bindParam(":monto_abono",$monto_abono);

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


		public function Borrar_Abono($idabono)
		{
			$dbconec = Conexion::Conectar();
			$response = array();
			try
			{
				$query = "CALL sp_delete_abono(:idabono);";
				$stmt = $dbconec->prepare($query);
				$stmt->bindParam(":idabono",$idabono);

				if($stmt->execute())
				{
					$response['status']  = 'success';
					$response['message'] = 'Abono eliminado del listado Correctamente!';
				} else {

					$response['status']  = 'error';
					$response['message'] = 'No pudimos borrar el Abono!';
				}
				echo json_encode($response);
				$dbconec = null;
			} catch (Exception $e) {
				$response['status']  = 'error';
				$response['message'] = 'Error de Ejecucion';
				echo json_encode($response);

			}

		}


				public function Monto_Maximo($idcredito)
				{
					$dbconec = Conexion::Conectar();

					try
					{
						$query = "CALL sp_view_monto_credito(:idcredito);";
						$stmt = $dbconec->prepare($query);
						$stmt->bindParam(":idcredito",$idcredito);
						$stmt->execute();
						$count = $stmt->rowCount();
						$Data = array();
						if($count > 0)
						{
							while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
				  				$Data[] = $row;
							}
							echo json_encode($Data);
						}


						$dbconec = null;
					} catch (Exception $e) {
						//echo $e;
						echo '<span class="label label-danger label-block">ERROR AL CARGAR LOS DATOS, PRESIONE F5</span>';
					}
				}

	}


 ?>
