<?php

	class Producto {

		
		public function Print_Barcode($idproducto){

			$filas = ProductoModel::Print_Barcode($idproducto);
			return $filas;

		}


		public function Listar_Productos(){

			$filas = ProductoModel::Listar_Productos();
			return $filas;

		}


		public function Autocomplete_Producto($search){

			$filas = ProductoModel::Autocomplete_Producto($search);
			return $filas;

		}

		public function Listar_Productos_Activos(){

			$filas = ProductoModel::Listar_Productos_Activos();
			return $filas;

		}

		public function Listar_Productos_Inactivos(){

			$filas = ProductoModel::Listar_Productos_Inactivos();
			return $filas;

		}

		public function Listar_Productos_Agotados(){

			$filas = ProductoModel::Listar_Productos_Agotados();
			return $filas;

		}

		public function Listar_Productos_Vigentes(){

			$filas = ProductoModel::Listar_Productos_Vigentes();
			return $filas;

		}


		public function Listar_Perecederos(){

			$filas = ProductoModel::Listar_Perecederos();
			return $filas;

		}

		public function Listar_No_Perecederos(){

			$filas = ProductoModel::Listar_No_Perecederos();
			return $filas;

		}


		public function Listar_Categorias(){

			$filas = ProductoModel::Listar_Categorias();
			return $filas;

		}

		public function Listar_Marcas(){

			$filas = ProductoModel::Listar_Marcas();
			return $filas;

		}

		public function Listar_Presentaciones(){

			$filas = ProductoModel::Listar_Presentaciones();
			return $filas;

		}

		public function Listar_Proveedores(){

			$filas = ProductoModel::Listar_Proveedores();
			return $filas;

		}

		public function Insertar_Producto($codigo_barra, $nombre_producto, $precio_compra, $precio_venta, $precio_venta_mayoreo,
		$stock,$stock_min, $idcategoria, $idmarca, $idpresentacion, $exento, $inventariable, $perecedero){

			$cmd = ProductoModel::Insertar_Producto($codigo_barra, $nombre_producto, $precio_compra, $precio_venta, $precio_venta_mayoreo,
			$stock,$stock_min, $idcategoria, $idmarca, $idpresentacion, $exento, $inventariable, $perecedero);

		}

		public function Editar_Producto($idproducto, $codigo_barra, $nombre_producto, $precio_compra, $precio_venta, $precio_venta_mayoreo,
		$stock_min, $idcategoria, $idmarca, $idpresentacion, $estado, $exento, $inventariable, $perecedero){

			$cmd = ProductoModel::Editar_Producto($idproducto, $codigo_barra, $nombre_producto, $precio_compra, $precio_venta, $precio_venta_mayoreo,
			$stock_min, $idcategoria,$idmarca, $idpresentacion, $estado, $exento, $inventariable, $perecedero);

		}

	}


 ?>
