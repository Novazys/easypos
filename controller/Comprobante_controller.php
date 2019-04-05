<?php 

	class Comprobante {

		public function Listar_Comprobantes(){

			$filas = ComprobanteModel::Listar_Comprobantes();
			return $filas;
		
		}

		public function Insertar_Comprobante($comprobante){

			$cmd = ComprobanteModel::Insertar_Comprobante($comprobante);
			
		}

		public function Editar_Comprobante($idcomprobante,$comprobante,$estado){

			$cmd = ComprobanteModel::Editar_Comprobante($idcomprobante,$comprobante,$estado);
			
		}

	}


 ?>