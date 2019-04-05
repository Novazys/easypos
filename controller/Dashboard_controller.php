<?php

	class Dashboard {

		public function Ver_Moneda_Reporte(){

			$filas = DashboardModel::Ver_Moneda_Reporte();
			return $filas;

		}


		public function Datos_Paneles(){

			$filas = DashboardModel::Datos_Paneles();
			return $filas;

		}

		public function Compras_Anuales(){

			$filas = DashboardModel::Compras_Anuales();
			return $filas;

		}

		public function Ventas_Anuales(){

			$filas = DashboardModel::Ventas_Anuales();
			return $filas;

		}

	}


?>
