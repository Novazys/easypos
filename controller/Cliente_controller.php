<?php

	class Cliente {

		public function Listar_Clientes(){

			$filas = ClienteModel::Listar_Clientes();
			return $filas;

		}

		public function Ver_Limite_Credito($idcliente){

			$filas = ClienteModel::Ver_Limite_Credito($idcliente);
			return $filas;

		}

		public function Listar_Clientes_Activos(){

			$filas = ClienteModel::Listar_Clientes_Activos();
			return $filas;

		}

		public function Listar_Clientes_Inactivos(){

			$filas = ClienteModel::Listar_Clientes_Inactivos();
			return $filas;

		}

		public function Insertar_Cliente($nombre_cliente, $numero_nit,  $direccion,
		$numero_telefono, $email, $giro, $limite_credito){

			$cmd = ClienteModel::Insertar_Cliente($nombre_cliente, $numero_nit,  $direccion,
			$numero_telefono, $email, $giro, $limite_credito);

		}

		public function Editar_Cliente($idcliente, $nombre_cliente, $numero_nit,  $direccion,
		$numero_telefono, $email, $giro, $limite_credito, $estado){

			$cmd = ClienteModel::Editar_Cliente($idcliente, $nombre_cliente, $numero_nit,  $direccion,
			$numero_telefono, $email, $giro, $limite_credito, $estado);

		}

	}


 ?>
