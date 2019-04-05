<?php 

	class Moneda {

		public function Listar_Monedas(){

			$filas = MonedaModel::Listar_Monedas();
			return $filas;
		
		}


		public function Insertar_Moneda($CurrencyISO, $Language, $CurrencyName, $Money, $Symbol){

			$cmd = MonedaModel::Insertar_Moneda($CurrencyISO, $Language, $CurrencyName, $Money, $Symbol);
			
		}

		public function Editar_Moneda($idcurrency, $CurrencyISO, $Language, $CurrencyName, $Money, $Symbol){

			$cmd = MonedaModel::Editar_Moneda($idcurrency, $CurrencyISO, $Language, $CurrencyName, $Money, $Symbol);
			
		}

	}


 ?>