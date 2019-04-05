<?php 

	class Proveedor {

		public function Listar_Proveedores(){

			$filas = ProveedorModel::Listar_Proveedores();
			return $filas;
		
		}

		public function Insertar_Proveedor($nombre_proveedor, $numero_telefono, $numero_nit,  
		$nombre_contacto, $telefono_contacto){

			$cmd = ProveedorModel::Insertar_Proveedor($nombre_proveedor, $numero_telefono, $numero_nit,  
			$nombre_contacto, $telefono_contacto);
			
		}

		public function Editar_Proveedor($idproveedor,$nombre_proveedor, $numero_telefono, $numero_nit,  
		$nombre_contacto, $telefono_contacto,$estado){

			$cmd = ProveedorModel::Editar_Proveedor($idproveedor,$nombre_proveedor, $numero_telefono, $numero_nit,  
			$nombre_contacto, $telefono_contacto,$estado);
			
		}

	}


 ?>