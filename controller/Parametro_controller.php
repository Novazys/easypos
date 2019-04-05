<?php

	class Parametro {

		public function Listar_Parametros(){

			$filas = ParametroModel::Listar_Parametros();
			return $filas;

		}

		public function Listar_Monedas(){

			$filas = ParametroModel::Listar_Monedas();
			return $filas;

		}

		public function Ver_Impuesto(){

			$filas = ParametroModel::Ver_Impuesto();
			return $filas;

		}

		public function Ver_Moneda(){

			$filas = ParametroModel::Ver_Moneda();
			return $filas;

		}

		public function Ver_Moneda_Simbolo(){

			$filas = ParametroModel::Ver_Moneda_Simbolo();
			return $filas;

		}


		public function Insertar_Parametro($nombre_empresa, $propietario, $numero_nit,
		 $porcentaje_iva,$porcentaje_retencion,$monto_retencion,$direccion,$idcurrency){

		$cmd = ParametroModel::Insertar_Parametro($nombre_empresa, $propietario, $numero_nit,
		 $porcentaje_iva,$porcentaje_retencion,$monto_retencion,$direccion,$idcurrency);

		}

		public function Editar_Parametro($idparametro, $nombre_empresa, $propietario, $numero_nit,
		 $porcentaje_iva,$porcentaje_retencion,$monto_retencion,$direccion,$idcurrency){

		$cmd = ParametroModel::Editar_Parametro($idparametro, $nombre_empresa, $propietario, $numero_nit,
		 $porcentaje_iva,$porcentaje_retencion,$monto_retencion,$direccion,$idcurrency);

		}

	}


 ?>
