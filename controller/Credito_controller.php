<?php

	class Credito {

		public function Imprimir_Ticket_Abono($idabono){

			$filas = CreditoModel::Imprimir_Ticket_Abono($idabono);
			return $filas;

		}

		public function Reporte_Abonos($fecha,$fecha2){

			$filas = CreditoModel::Reporte_Abonos($fecha,$fecha2);
			return $filas;

		}


		public function Listar_Creditos($idcredito){

			$filas = CreditoModel::Listar_Creditos($idcredito);
			return $filas;

		}

		public function Listar_Creditos_Espc($idcredito){

			$filas = CreditoModel::Listar_Creditos_Espc($idcredito);
			return $filas;

		}

		public function Listar_Abonos_Credito($idcredito){

			$filas = CreditoModel::Listar_Abonos_Credito($idcredito);
			return $filas;

		}

		public function Listar_Abonos_All(){

			$filas = CreditoModel::Listar_Abonos_All();
			return $filas;

		}

		public function Count_Creditos(){

			$filas = CreditoModel::Count_Creditos();
			return $filas;

		}

		public function Listar_Detalle($idVenta){

			$filas = CreditoModel::Listar_Detalle($idVenta);
			return $filas;

		}

		public function Listar_Info($idVenta){

			$filas = CreditoModel::Listar_Info($idVenta);
			return $filas;

		}

		public function Ver_Restante($idcredito){

			$filas = CreditoModel::Ver_Restante($idcredito);
			return $filas;

		}


		public function Borrar_Abono($idabono){

			$cmd = CreditoModel::Borrar_Abono($idabono);

		}


		public function Editar_Credito($id,$nombre,$fecha,$monto,$abonado,$restante,$estado){

			$cmd = CreditoModel::Editar_Credito($id,$nombre,$fecha,$monto,$abonado,$restante,$estado);

		}

		public function Insertar_Abono($idcredito, $monto, $idusuario){

			$cmd = CreditoModel::Insertar_Abono($idcredito, $monto, $idusuario);

		}

		public function Editar_Abono($idabono,$fecha_abono,$monto_abono){

			$cmd = CreditoModel::Editar_Abono($idabono,$fecha_abono,$monto_abono);

		}

		public function Monto_Maximo($idcredito){

			$filas = CreditoModel::Monto_Maximo($idcredito);
			return $filas;

		}


	}


 ?>
