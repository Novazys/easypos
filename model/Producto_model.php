<?php

	require_once('Conexion.php');

	class ProductoModel extends Conexion
	{
		public function Print_Barcode($idproducto)
		{
			$dbconec = Conexion::Conectar();

			try
			{
				$query = "CALL sp_print_barcode_producto(:idproducto);";
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

		public function Listar_Productos()
		{
			$dbconec = Conexion::Conectar();

			try
			{
				$query = "CALL sp_view_producto();";
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

		public function Listar_Productos_Activos()
		{
			$dbconec = Conexion::Conectar();

			try
			{
				$query = "CALL sp_view_producto_activo();";
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

		public function Listar_Productos_Inactivos()
		{
			$dbconec = Conexion::Conectar();

			try
			{
				$query = "CALL sp_view_producto_inactivo();";
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

		public function Listar_Productos_Agotados()
		{
			$dbconec = Conexion::Conectar();

			try
			{
				$query = "CALL sp_view_producto_agotado();";
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


		public function Listar_Productos_Vigentes()
		{
			$dbconec = Conexion::Conectar();

			try
			{
				$query = "CALL sp_view_producto_vigente();";
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

		public function Listar_Perecederos()
		{
			$dbconec = Conexion::Conectar();

			try
			{
				$query = "CALL sp_view_producto_perecedero();";
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


		public function Listar_No_Perecederos()
		{
			$dbconec = Conexion::Conectar();

			try
			{
				$query = "CALL sp_view_producto_no_perecedero();";
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

		public function Listar_Proveedores()
		{
			$dbconec = Conexion::Conectar();

			try
			{
				$query = "CALL sp_view_proveedor_activo();";
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

		public function Listar_Categorias()
		{
			$dbconec = Conexion::Conectar();

			try
			{
				$query = "CALL sp_view_categoria_activa();";
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

		public function Listar_Marcas()
		{
			$dbconec = Conexion::Conectar();

			try
			{
				$query = "CALL sp_view_marca_activa();";
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

		public function Listar_Presentaciones()
		{
			$dbconec = Conexion::Conectar();

			try
			{
				$query = "CALL sp_view_presentacion_activa();";
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

		 public function Autocomplete_Producto($search){

			try {

			$sugg_json = array();    // this is for displaying json data as a autosearch suggestion
			$json_row = array();     // this is for stroring mysql results in json string

			$keyword = preg_replace('/\s+/', ' ', $search); // it will replace multiple spaces from the input.

			$query = "CALL sp_search_producto(:search)";
			$stmt = Conexion::Conectar()->prepare($query);
			$stmt->bindParam(":search", $keyword);
			$stmt->execute();

			if ($stmt->rowCount() > 0){

			while($recResult = $stmt->fetch(PDO::FETCH_ASSOC)) {

				$json_row["value"] = $recResult['idproducto'];
				$json_row["label"] = $recResult['codigo_barra'].' - '.$recResult['nombre_producto'];
				$json_row["producto"] = $recResult['nombre_producto'];
				$json_row["precio_compra"] = $recResult['precio_compra'];
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

		public function Insertar_Producto($codigo_barra,$nombre_producto,$precio_compra,$precio_venta,
		$precio_venta_mayoreo,$stock,$stock_min,$idcategoria,$idmarca,$idpresentacion,$exento,$inventariable,$perecedero)
		{
			$dbconec = Conexion::Conectar();
			try
			{
				$query = "CALL sp_insert_producto(:codigo_barra,:nombre_producto,:precio_compra,:precio_venta,
				:precio_venta_mayoreo,:stock,:stock_min,:idcategoria,:idmarca,:idpresentacion,:exento,:inventariable,:perecedero)";
				$stmt = $dbconec->prepare($query);
				$stmt->bindParam(":codigo_barra",$codigo_barra);
				$stmt->bindParam(":nombre_producto",$nombre_producto);
				$stmt->bindParam(":precio_compra",$precio_compra);
				$stmt->bindParam(":precio_venta",$precio_venta);
				$stmt->bindParam(":precio_venta_mayoreo",$precio_venta_mayoreo);
				$stmt->bindParam(":stock",$stock);
				$stmt->bindParam(":stock_min",$stock_min);
				$stmt->bindParam(":idcategoria",$idcategoria);
				$stmt->bindParam(":idmarca",$idmarca);
				$stmt->bindParam(":idpresentacion",$idpresentacion);
				$stmt->bindParam(":exento",$exento);
				$stmt->bindParam(":inventariable",$inventariable);
				$stmt->bindParam(":perecedero",$perecedero);

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
				//echo $e;
				$data = "Error";
				echo json_encode($data);

			}

		}

		public function Editar_Producto($idproducto, $codigo_barra,$nombre_producto,$precio_compra,$precio_venta,$precio_venta_mayoreo,$stock_min,
		$idcategoria,$idmarca,$idpresentacion,$estado,$exento,$inventariable,$perecedero)
		{
			$dbconec = Conexion::Conectar();
			try
			{
				$query = "CALL sp_update_producto(:idproducto,:codigo_barra,:nombre_producto,:precio_compra,:precio_venta,:precio_venta_mayoreo,:stock_min,
				:idcategoria,:idmarca,:idpresentacion,:estado,:exento,:inventariable,:perecedero);";
				$stmt = $dbconec->prepare($query);
				$stmt->bindParam(":idproducto",$idproducto);
				$stmt->bindParam(":codigo_barra",$codigo_barra);
				$stmt->bindParam(":nombre_producto",$nombre_producto);
				$stmt->bindParam(":precio_compra",$precio_compra);
				$stmt->bindParam(":precio_venta",$precio_venta);
				$stmt->bindParam(":precio_venta_mayoreo",$precio_venta_mayoreo);
				$stmt->bindParam(":stock_min",$stock_min);
				$stmt->bindParam(":idcategoria",$idcategoria);
				$stmt->bindParam(":idmarca",$idmarca);
				$stmt->bindParam(":idpresentacion",$idpresentacion);
				$stmt->bindParam(":estado",$estado);
				$stmt->bindParam(":exento",$exento);
				$stmt->bindParam(":inventariable",$inventariable);
				$stmt->bindParam(":perecedero",$perecedero);


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
				//echo $e;
				$data = "Error";
				echo json_encode($data);

			}

		}

	}


 ?>
