<?php 

	class Inventario {

		public function Listar_Kardex($mes){

			$filas = InventarioModel::Listar_Kardex($mes);
			return $filas;
		
		}

		public function Listar_Entradas($mes){

			$filas = InventarioModel::Listar_Entradas($mes);
			return $filas;
		
		}

		public function Listar_Salidas($mes){

			$filas = InventarioModel::Listar_Salidas($mes);
			return $filas;
		
		}


		public function Insertar_Entrada($descripcion,$cantidad,$producto){

			$cmd = InventarioModel::Insertar_Entrada($descripcion,$cantidad,$producto);
			
		}

		public function Insertar_Salida($descripcion,$cantidad,$producto){

			$cmd = InventarioModel::Insertar_Salida($descripcion,$cantidad,$producto);
			
		}


		public function Abrir_Inventario(){

			$cmd = InventarioModel::Abrir_Inventario();
			
		}

		public function Cerrar_Inventario(){

			$cmd = InventarioModel::Cerrar_Inventario();
			
		}

		public function Validar_Inventario(){

			$cmd = InventarioModel::Validar_Inventario();
			
		}
	}


 ?>