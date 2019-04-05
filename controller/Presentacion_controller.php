<?php 

	class Presentacion {

		public function Listar_Presentaciones(){

			$filas = PresentacionModel::Listar_Presentaciones();
			return $filas;
		
		}

		public function Insertar_Presentacion($presentacion,$siglas){

			$cmd = PresentacionModel::Insertar_Presentacion($presentacion,$siglas);
			
		}

		public function Editar_Presentacion($idpresentacion,$presentacion,$siglas,$estado){

			$cmd = PresentacionModel::Editar_Presentacion($idpresentacion,$presentacion,$siglas,$estado);
			
		}

	}


 ?>