<?php

	require_once('Conexion.php');

	class ApartadoModel extends Conexion
	{


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

		public function Listar_Apartados_Totales($criterio,$date,$date2,$estado)
		{
			$dbconec = Conexion::Conectar();

			try
			{
				$query = "CALL sp_consulta_apartados_totales(:criterio,:date,:date2,:estado);";
				$stmt = $dbconec->prepare($query);
				$stmt->bindParam(":criterio",$criterio);
				$stmt->bindParam(":date",$date);
				$stmt->bindParam(":date2",$date2);
				$stmt->bindParam(":estado",$estado);
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

		public function Listar_Apartados_Detalle($criterio,$date,$date2,$estado)
		{
			$dbconec = Conexion::Conectar();

			try
			{
				$query = "CALL sp_consulta_apartados_detalle(:criterio,:date,:date2,:estado);";
				$stmt = $dbconec->prepare($query);
				$stmt->bindParam(":criterio",$criterio);
				$stmt->bindParam(":date",$date);
				$stmt->bindParam(":date2",$date2);
				$stmt->bindParam(":estado",$estado);
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


		public function Listar_Apartados($criterio,$date,$date2,$estado)
		{
			$dbconec = Conexion::Conectar();

			try
			{
				$query = "CALL sp_consulta_apartados(:criterio,:date,:date2,:estado);";
				$stmt = $dbconec->prepare($query);
				$stmt->bindParam(":criterio",$criterio);
				$stmt->bindParam(":date",$date);
				$stmt->bindParam(":date2",$date2);
				$stmt->bindParam(":estado",$estado);
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


		public function Imprimir_Ticket_Apartado($idapartado)
		{
			$dbconec = Conexion::Conectar();

			try
			{
				$query = "CALL sp_imprimir_ticket_apartado(:idapartado);";
				$stmt = $dbconec->prepare($query);
				$stmt->bindParam(":idapartado",$idapartado);
				$stmt->execute();
				$count = $stmt->rowCount();

				if($count > 0)
				{
					return $stmt->fetchAll();
				}


				$dbconec = null;
			} catch (Exception $e) {
				 echo 'IMPRIMIR ERROR EN INFO';
				//echo '<span class="label label-danger label-block">ERROR AL CARGAR LOS DATOS, PRESIONE F5</span>';
			}
		}

		public function Imprimir_Ticket_DetalleApartado($idapartado)
		{
			$dbconec = Conexion::Conectar();

			try
			{
				$query = "CALL sp_detalle_imprimir_ticket_apartado(:idapartado);";
				$stmt = $dbconec->prepare($query);
				$stmt->bindParam(":idapartado",$idapartado);
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


		public function Listar_Detalle($idapartado)
		{
			$dbconec = Conexion::Conectar();

			try
			{
				$query = "CALL sp_view_detalleapartado(:idapartado);";
				$stmt = $dbconec->prepare($query);
				$stmt->bindParam(":idapartado",$idapartado);
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

		public function Listar_Info($idapartado)
		{
			$dbconec = Conexion::Conectar();

			try
			{
				$query = "CALL sp_view_apartado(:idapartado);";
				$stmt = $dbconec->prepare($query);
				$stmt->bindParam(":idapartado",$idapartado);
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

		public function Count_Apartados($criterio,$date,$date2)
		{
			$dbconec = Conexion::Conectar();

			try
			{
				$query = "CALL sp_count_apartados(:criterio,:date,:date2);";
				$stmt = $dbconec->prepare($query);
				$stmt->bindParam(":criterio",$criterio);
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

		 public function Autocomplete_Producto($search){

			try {

			$sugg_json = array();    // this is for displaying json data as a autosearch suggestion
			$json_row = array();     // this is for stroring mysql results in json string

			$keyword = preg_replace('/\s+/', ' ', $search); // it will replace multiple spaces from the input.

			$query = "CALL sp_search_producto_apartado(:search)";
			$stmt = Conexion::Conectar()->prepare($query);
			$stmt->bindParam(":search", $keyword);
			$stmt->execute();

			if ($stmt->rowCount() > 0){

			while($recResult = $stmt->fetch(PDO::FETCH_ASSOC)) {

				$json_row["value"] = $recResult['idproducto'];
				$json_row["label"] = $recResult['codigo_barra'].' - '.
				$recResult['nombre_producto'];
				$json_row["producto"] = $recResult['nombre_producto'];
				$json_row["precio_venta"] = $recResult['precio_venta'];
				$json_row["precio_venta_mayoreo"] = $recResult['precio_venta_mayoreo'];
				$json_row["stock"] = $recResult['stock'];
				$json_row["exento"] = $recResult['exento'];
				$json_row["perecedero"] = $recResult['perecedero'];
				$json_row["datos"] = $recResult['nombre_marca'].' - '.$recResult['siglas'];

				array_push($sugg_json, $json_row);
			}

			} else {

				$json_row["value"] = "";
				$json_row["label"] = "";
				$json_row["datos"] = "";
				array_push($sugg_json, $json_row);
			}


			 $jsonOutput = json_encode($sugg_json, JSON_UNESCAPED_SLASHES);
 			 print $jsonOutput;


			} catch (Exception $e) {

				echo "Error al cargar el listado";
			}

		  }


		public function Listar_Clientes()
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


		public function Insertar_Apartado($fecha_limite_retiro,
		$sumas, $iva, $exento, $retenido, $descuento, $total, $abonado_apartado, $restante_pagar, $sonletras, $idcliente, $idusuario)
		{
			$dbconec = Conexion::Conectar();
			try
			{
				$query = "CALL sp_insert_apartado(:fecha_limite_retiro,
    		:sumas, :iva, :exento, :retenido, :descuento, :total, :abonado_apartado, :restante_pagar, :sonletras, :idcliente, :idusuario)";

				$stmt = $dbconec->prepare($query);
				$stmt->bindParam(":fecha_limite_retiro",$fecha_limite_retiro);
				$stmt->bindParam(":sumas",$sumas);
				$stmt->bindParam(":iva",$iva);
				$stmt->bindParam(":exento",$exento);
				$stmt->bindParam(":retenido",$retenido);
				$stmt->bindParam(":descuento",$descuento);
				$stmt->bindParam(":total",$total);
        $stmt->bindParam(":abonado_apartado",$abonado_apartado);
        $stmt->bindParam(":restante_pagar",$restante_pagar);
				$stmt->bindParam(":sonletras",$sonletras);
				$stmt->bindParam(":idcliente",$idcliente);
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
				//$data = "Error";
				//echo json_encode($data);
				echo $e;

			}

		}


		public function Anular_Apartado($idapartado)
		{
			$dbconec = Conexion::Conectar();
			$response = array();
			try
			{
				$query = "CALL sp_anular_apartado(:idapartado)";
				$stmt = $dbconec->prepare($query);
				$stmt->bindParam(":idapartado",$idapartado);

				if($stmt->execute())
				{
					$response['status']  = 'success';
					$response['message'] = 'Apartado Anulado Correctamente!';
				} else {

					$response['status']  = 'error';
					$response['message'] = 'No pudimos anular la Venta!';
				}
				echo json_encode($response);
				$dbconec = null;
			} catch (Exception $e) {
				$response['status']  = 'error';
				$response['message'] = 'Error de Ejecucion';
				echo json_encode($response);

			}

		}

		public function Insertar_DetalleApartado($idproducto, $cantidad, $precio_unitario, $exento, $descuento, $fecha_vence, $importe){

			try {

				$query = "CALL sp_insert_detalleapartado(:idproducto, :cantidad, :precio_unitario, :exento, :descuento, :fecha_vence, :importe)";

				$stmt = Conexion::Conectar()->prepare($query);
		   		$stmt->bindParam(":idproducto",$idproducto);
		   		$stmt->bindParam(":cantidad",$cantidad);
		   		$stmt->bindParam(":precio_unitario",$precio_unitario);
		   		$stmt->bindParam(":exento",$exento);
		   		$stmt->bindParam(":descuento",$descuento);
		   		$stmt->bindParam(":fecha_vence",$fecha_vence);
		   		$stmt->bindParam(":importe",$importe);

				$stmt->execute();

				$dbconec = null;

			} catch (Exception $e) {

				//$data = "Error";
 	   		//echo json_encode($data);
				echo $e;
			}

		}

		public function Insertar_Venta($idapartado, $tipo_pago, $tipo_comprobante, $pago_efectivo, $pago_tarjeta, 
		$numero_tarjeta, $tarjeta_habiente, $cambio, $idcliente, $idusuario)
		{
			$dbconec = Conexion::Conectar();
			try
			{
				$query = "CALL sp_insert_venta_apartado(:idapartado, :tipo_pago, :tipo_comprobante,
				:pago_efectivo, :pago_tarjeta, :numero_tarjeta, :tarjeta_habiente, :cambio, :idcliente, :idusuario)";

				$stmt = $dbconec->prepare($query);
				$stmt->bindParam(":idapartado",$idapartado);
				$stmt->bindParam(":tipo_pago",$tipo_pago);
				$stmt->bindParam(":tipo_comprobante",$tipo_comprobante);
				$stmt->bindParam(":pago_efectivo",$pago_efectivo);
				$stmt->bindParam(":pago_tarjeta",$pago_tarjeta);
				$stmt->bindParam(":numero_tarjeta",$numero_tarjeta);
				$stmt->bindParam(":tarjeta_habiente",$tarjeta_habiente);
				$stmt->bindParam(":cambio",$cambio);
				$stmt->bindParam(":idcliente",$idcliente);
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
				//$data = "Error";
				//echo json_encode($data);
				echo $e;

			}

		}



	}


 ?>
