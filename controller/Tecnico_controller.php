<?php

	class Tecnico {

		public function Listar_Tecnicos(){

			$filas = TecnicoModel::Listar_Tecnicos();
			return $filas;

		}

		public function Insertar_Tecnico($Tecnico,$telefono){

			$cmd = TecnicoModel::Insertar_Tecnico($Tecnico,$telefono);

		}

		public function Editar_Tecnico($idTecnico,$Tecnico,$telefono,$estado){

			$cmd = TecnicoModel::Editar_Tecnico($idTecnico,$Tecnico,$telefono,$estado);

		}

	}


 ?>
