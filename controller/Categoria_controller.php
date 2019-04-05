<?php 

	class Categoria {

		public function Listar_Categorias(){

			$filas = CategoriaModel::Listar_Categorias();
			return $filas;
		
		}

		public function Insertar_Categoria($categoria){

			$cmd = CategoriaModel::Insertar_Categoria($categoria);
			
		}

		public function Editar_Categoria($idcategoria,$categoria,$estado){

			$cmd = CategoriaModel::Editar_Categoria($idcategoria,$categoria,$estado);
			
		}

	}


 ?>