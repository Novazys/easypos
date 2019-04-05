<?php 

	class Perecedero {

		public function Listar_Perecederos($fecha1,$fecha2){

			$filas = PerecederoModel::Listar_Perecederos($fecha1,$fecha2);
			return $filas;
		
		}

		public function Listar_A_Vencer(){

			$filas = PerecederoModel::Listar_A_Vencer();
			return $filas;
		
		}

		public function Listar_Productos(){

			$filas = PerecederoModel::Listar_Productos();
			return $filas;
		
		}

		public function Listar_Stock($producto){

			$filas = PerecederoModel::Listar_Stock($producto);
			return $filas;
		
		}

		public function Insertar_Perecedero($fecha_vencimiento, $cantidad_perecedero, $idproducto){

			$cmd = PerecederoModel::Insertar_Perecedero($fecha_vencimiento, $cantidad_perecedero, $idproducto);
			
		}

		public function Editar_Perecedero($fecha_vencimiento, $cantidad_perecedero, $idproducto){

			$cmd = PerecederoModel::Editar_Perecedero($fecha_vencimiento, $cantidad_perecedero, $idproducto);
			
		}

		public function Borrar_Perecedero($fecha_vencimiento, $idproducto){

			$cmd = PerecederoModel::Borrar_Perecedero($fecha_vencimiento, $idproducto);
			
		}


	}


 ?>