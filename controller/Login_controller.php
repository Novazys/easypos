<?php 
	
	class Login
	
	{

		public function Restaurar_Password($usuario,$contrasena){

			$cmd = LoginModel::Restaurar_Password($usuario,$contrasena);
			
		}

		public function Login_Usuario($usuario,$contrasena){

			$cmd = LoginModel::Login_Usuario($usuario,$contrasena);
			
		}

		
	}
		
 ?>