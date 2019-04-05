<?php 

	class Usuario {

		public function Listar_Usuarios(){

			$filas = UsuarioModel::Listar_Usuarios();
			return $filas;
		
		}

		public function Listar_Empleados(){

			$filas = UsuarioModel::Listar_Empleados();
			return $filas;
		
		}

		public function Insertar_Usuario($usuario, $contrasena, $tipo_usuario, $idempleado){

			$cmd = UsuarioModel::Insertar_Usuario($usuario, $contrasena, $tipo_usuario, $idempleado);
			
		}

		public function Editar_Usuario($idusuario, $usuario, $contrasena, $tipo_usuario, $estado, $idempleado){

			$cmd = UsuarioModel::Editar_Usuario($idusuario, $usuario, $contrasena, $tipo_usuario, $estado, $idempleado);
			
		}

	}


 ?>