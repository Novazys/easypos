<?php

	require_once('Conexion.php');

	class TallerModel extends Conexion
	{

		public function Ver_Max_Orden(){
			$dbconec = Conexion::Conectar();
			try {

				$query = "CALL sp_view_maxorden()";
				$stmt = $dbconec->prepare($query);
				$stmt->execute();
				$count = $stmt->rowCount();
				if($count > 0){

					$filas = $stmt->fetchAll();
					if (is_array($filas) || is_object($filas))
					{
						foreach ($filas as $row => $column)
						{
							$maximo = $column['max_orden'];
						}
						echo json_encode($maximo);
					}
				}



				//

			} catch (Exception $e) {

				echo "Error al cargar el listado";
			}
		}



		public function Ver_Moneda_Reporte(){

			$dbconec = Conexion::Conectar();

			try {
				$query = "CALL sp_view_money()";
				$stmt = $dbconec->prepare($query);
				$stmt->execute();
				$count = $stmt->rowCount();

				if($count > 0)
				{
					return $stmt->fetchAll();
				}


				$dbconec = null;

			} catch (Exception $e) {

				echo "Error al cargar el listado";
			}

		}

		public function Listar_Tecnicos()
		{
			$dbconec = Conexion::Conectar();

			try
			{
				$query = "CALL sp_view_tecnico_activo();";
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

    public function Listar_Ordenes($date,$date2)
    {
      $dbconec = Conexion::Conectar();

      try
      {
        $query = "CALL sp_view_ordentaller(:date,:date2);";
        $stmt = $dbconec->prepare($query);
        $stmt->bindParam(":date",$date);
        $stmt->bindParam(":date2",$date2);
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

		public function Reporte_Taller($id)
    {
      $dbconec = Conexion::Conectar();

      try
      {
        $query = "CALL sp_view_report_ordentaller(:id);";
        $stmt = $dbconec->prepare($query);
        $stmt->bindParam(":id",$id);
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


		public function Insertar_Orden($idcliente,$aparato,$modelo,$idmarca,$serie,$idtecnico,$averia,
		$observaciones,$deposito_revision,$deposito_reparacion,$parcial_pagar)
		{
			$dbconec = Conexion::Conectar();
			try
			{
				$query = "CALL sp_insert_ordentaller(:idcliente,:aparato,:modelo,:idmarca,:serie,:idtecnico,:averia,
				:observaciones,:deposito_revision,:deposito_reparacion,:parcial_pagar)";
				$stmt = $dbconec->prepare($query);
				$stmt->bindParam(":idcliente",$idcliente);
				$stmt->bindParam(":aparato",$aparato);
				$stmt->bindParam(":modelo",$modelo);
				$stmt->bindParam(":idmarca",$idmarca);
				$stmt->bindParam(":serie",$serie);
				$stmt->bindParam(":idtecnico",$idtecnico);
				$stmt->bindParam(":averia",$averia);
				$stmt->bindParam(":observaciones",$observaciones);
				$stmt->bindParam(":deposito_revision",$deposito_revision);
				$stmt->bindParam(":deposito_reparacion",$deposito_reparacion);
				$stmt->bindParam(":parcial_pagar",$parcial_pagar);

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

		public function Insertar_Diagnostico($idorden,$diagnostico,$estado_aparato,$repuestos,$mano_obra,$fecha_alta,$fecha_retiro,
		$ubicacion,$parcial_pagar)
		{
			$dbconec = Conexion::Conectar();
			try
			{
				$query = "CALL sp_insert_diagnostico(:idorden,:diagnostico,:estado_aparato,:repuestos,:mano_obra,:fecha_alta,:fecha_retiro,
				:ubicacion,:parcial_pagar)";
				$stmt = $dbconec->prepare($query);
				$stmt->bindParam(":idorden",$idorden);
				$stmt->bindParam(":diagnostico",$diagnostico);
				$stmt->bindParam(":estado_aparato",$estado_aparato);
				$stmt->bindParam(":repuestos",$repuestos);
				$stmt->bindParam(":mano_obra",$mano_obra);
				$stmt->bindParam(":fecha_alta",$fecha_alta);
				$stmt->bindParam(":fecha_retiro",$fecha_retiro);
				$stmt->bindParam(":ubicacion",$ubicacion);
				$stmt->bindParam(":parcial_pagar",$parcial_pagar);

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

		public function Editar_Orden($idorden,$numero_orden,$fecha_ingreso,$idcliente,$aparato,$modelo,$idmarca,$serie,$idtecnico,$averia,
		$observaciones,$deposito_revision,$deposito_reparacion)
		{
			$dbconec = Conexion::Conectar();
			try
			{
				$query = "CALL sp_update_ordentaller(:idorden,:numero_orden,:fecha_ingreso,:idcliente,:aparato,:modelo,:idmarca,:serie,:idtecnico,:averia,
				:observaciones,:deposito_revision,:deposito_reparacion)";
				$stmt = $dbconec->prepare($query);
				$stmt->bindParam(":idorden",$idorden);
				$stmt->bindParam(":numero_orden",$numero_orden);
				$stmt->bindParam(":fecha_ingreso",$fecha_ingreso);
				$stmt->bindParam(":idcliente",$idcliente);
				$stmt->bindParam(":aparato",$aparato);
				$stmt->bindParam(":modelo",$modelo);
				$stmt->bindParam(":idmarca",$idmarca);
				$stmt->bindParam(":serie",$serie);
				$stmt->bindParam(":idtecnico",$idtecnico);
				$stmt->bindParam(":averia",$averia);
				$stmt->bindParam(":observaciones",$observaciones);
				$stmt->bindParam(":deposito_revision",$deposito_revision);
				$stmt->bindParam(":deposito_reparacion",$deposito_reparacion);

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


		public function Borrar_Orden($idtaller)
		{
			$dbconec = Conexion::Conectar();
			$response = array();
			try
			{
				$query = "CALL sp_delete_ordentaller(:idtaller)";
				$stmt = $dbconec->prepare($query);
				$stmt->bindParam(":idtaller",$idtaller);

				if($stmt->execute())
				{
					$response['status']  = 'success';
					$response['message'] = 'Orden Eliminada Correctamente!';
				} else {

					$response['status']  = 'error';
					$response['message'] = 'No pudimos eliminar la Orden!';
				}
				echo json_encode($response);
				$dbconec = null;
			} catch (Exception $e) {
				$response['status']  = 'error';
				$response['message'] = 'Error de Ejecucion';
				echo json_encode($response);

			}

		}

		public function Count_Ordenes($date,$date2)
		{
			$dbconec = Conexion::Conectar();

			try
			{
				$query = "CALL sp_count_ordenes(:date,:date2);";
				$stmt = $dbconec->prepare($query);
				$stmt->bindParam(":date",$date);
				$stmt->bindParam(":date2",$date2);
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


	}


 ?>
