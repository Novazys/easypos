<?php

	require_once('Conexion.php');

	class CompraModel extends Conexion
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

		public function Listar_Compras($criterio,$date,$date2,$estado,$pago)
		{
			$dbconec = Conexion::Conectar();

			try
			{
				$query = "CALL sp_consulta_compras(:criterio,:date,:date2,:estado,:pago);";
				$stmt = $dbconec->prepare($query);
				$stmt->bindParam(":criterio",$criterio);
				$stmt->bindParam(":date",$date);
				$stmt->bindParam(":date2",$date2);
				$stmt->bindParam(":estado",$estado);
				$stmt->bindParam(":pago",$pago);
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

		public function Listar_Compras_Detalle($criterio,$date,$date2,$estado,$pago)
		{
			$dbconec = Conexion::Conectar();

			try
			{
				$query = "CALL sp_consulta_compras_detalle(:criterio,:date,:date2,:estado,:pago);";
				$stmt = $dbconec->prepare($query);
				$stmt->bindParam(":criterio",$criterio);
				$stmt->bindParam(":date",$date);
				$stmt->bindParam(":date2",$date2);
				$stmt->bindParam(":estado",$estado);
				$stmt->bindParam(":pago",$pago);
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

		public function Listar_Compras_Totales($criterio,$date,$date2,$estado,$pago)
		{
			$dbconec = Conexion::Conectar();

			try
			{
				$query = "CALL sp_consulta_compras_totales(:criterio,:date,:date2,:estado,:pago);";
				$stmt = $dbconec->prepare($query);
				$stmt->bindParam(":criterio",$criterio);
				$stmt->bindParam(":date",$date);
				$stmt->bindParam(":date2",$date2);
				$stmt->bindParam(":estado",$estado);
				$stmt->bindParam(":pago",$pago);
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

		public function Listar_Detalle($idcompra)
		{
			$dbconec = Conexion::Conectar();

			try
			{
				$query = "CALL sp_view_detallecompra(:idcompra);";
				$stmt = $dbconec->prepare($query);
				$stmt->bindParam(":idcompra",$idcompra);
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

		public function Listar_Info($idcompra)
		{
			$dbconec = Conexion::Conectar();

			try
			{
				$query = "CALL sp_view_compra(:idcompra);";
				$stmt = $dbconec->prepare($query);
				$stmt->bindParam(":idcompra",$idcompra);
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

		public function Listar_Historico($idproducto)
		{
			$dbconec = Conexion::Conectar();

			try
			{
				$query = "CALL sp_consulta_historico_precios(:idproducto);";
				$stmt = $dbconec->prepare($query);
				$stmt->bindParam(":idproducto",$idproducto);
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

		public function Reporte_Historico($idproducto)
		{
			$dbconec = Conexion::Conectar();

			try
			{
				$query = "CALL sp_consulta_historico_precios(:idproducto);";
				$stmt = $dbconec->prepare($query);
				$stmt->bindParam(":idproducto",$idproducto);
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

		public function Reporte_Historico_Mas_Bajo($idproducto)
		{
			$dbconec = Conexion::Conectar();

			try
			{
				$query = "CALL sp_consulta_precio_mas_bajo(:idproducto);";
				$stmt = $dbconec->prepare($query);
				$stmt->bindParam(":idproducto",$idproducto);
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

		public function Count_Compras($criterio,$date,$date2)
		{
			$dbconec = Conexion::Conectar();

			try
			{
				$query = "CALL sp_count_compras(:criterio,:date,:date2);";
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


		public function Insertar_Compra($fecha_compra, $idproveedor, $tipo_pago, $numero_comprobante, $tipo_comprobante, $fecha_comprobante,
		$sumas, $iva, $exento, $retenido, $total, $sonletras)
		{
			$dbconec = Conexion::Conectar();
			try
			{
				$query = "CALL sp_insert_compra(:fecha_compra, :idproveedor, :tipo_pago, :numero_comprobante, :tipo_comprobante,
				:fecha_comprobante, :sumas, :iva, :exento, :retenido, :total, :sonletras)";
				$stmt = $dbconec->prepare($query);
				$stmt->bindParam(":fecha_compra",$fecha_compra);
				$stmt->bindParam(":idproveedor",$idproveedor);
				$stmt->bindParam(":tipo_pago",$tipo_pago);
				$stmt->bindParam(":numero_comprobante",$numero_comprobante);
				$stmt->bindParam(":tipo_comprobante",$tipo_comprobante);
				$stmt->bindParam(":fecha_comprobante",$fecha_comprobante);
				$stmt->bindParam(":sumas",$sumas);
				$stmt->bindParam(":iva",$iva);
				$stmt->bindParam(":exento",$exento);
				$stmt->bindParam(":retenido",$retenido);
				$stmt->bindParam(":total",$total);
				$stmt->bindParam(":sonletras",$sonletras);

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

		public function Anular_Compra($idcompra)
		{
			$dbconec = Conexion::Conectar();
			$response = array();
			try
			{
				$query = "CALL sp_anular_compra(:idcompra)";
				$stmt = $dbconec->prepare($query);
				$stmt->bindParam(":idcompra",$idcompra);

				if($stmt->execute())
				{
					$response['status']  = 'success';
					$response['message'] = 'Compra Anulada Correctamente!';
				} else {

					$response['status']  = 'error';
					$response['message'] = 'No pudimos anular la Compra!';
				}
				echo json_encode($response);
				$dbconec = null;
			} catch (Exception $e) {
				$response['status']  = 'error';
				$response['message'] = 'Error de Ejecucion';
				echo json_encode($response);

			}

		}

		public function Insertar_DetalleCompra($idproducto, $cantidad, $precio_unitario, $exento, $fecha_vence, $importe){

			try {

				$query = "CALL sp_insert_detallecompra(:idproducto, :cantidad, :precio_unitario, :exento, :fecha_vence, :importe)";

				$stmt = Conexion::Conectar()->prepare($query);
		   		$stmt->bindParam(":idproducto",$idproducto);
		   		$stmt->bindParam(":cantidad",$cantidad);
		   		$stmt->bindParam(":precio_unitario",$precio_unitario);
		   		$stmt->bindParam(":exento",$exento);
		   		$stmt->bindParam(":fecha_vence",$fecha_vence);
		   		$stmt->bindParam(":importe",$importe);

				$stmt->execute();

				$dbconec = null;

			} catch (Exception $e) {
					echo $e;
				 //$data = "Error";
 	   		 //echo json_encode($data);
			}

		}



	}


 ?>
