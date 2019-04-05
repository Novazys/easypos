<?php 

	class Marca {

		public function Listar_Marcas(){

			$filas = MarcaModel::Listar_Marcas();
			return $filas;
		
		}

		public function Insertar_Marca($marca){

			$cmd = MarcaModel::Insertar_Marca($marca);
			
		}

		public function Editar_Marca($idmarca,$marca,$estado){

			$cmd = MarcaModel::Editar_Marca($idmarca,$marca,$estado);
			
		}

	}


 ?>