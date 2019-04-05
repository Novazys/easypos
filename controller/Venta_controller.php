<?php

	class Venta {

		public function Ver_Moneda_Reporte(){

			$filas = VentaModel::Ver_Moneda_Reporte();
			return $filas;

		}

		public function Listar_Ventas($criterio,$date,$date2,$estado){

			$filas = VentaModel::Listar_Ventas($criterio,$date,$date2,$estado);
			return $filas;

		}

		public function Listar_Ventas_Totales($criterio,$date,$date2,$estado){

			$filas = VentaModel::Listar_Ventas_Totales($criterio,$date,$date2,$estado);
			return $filas;

		}

		public function Listar_Ventas_Detalle($criterio,$date,$date2,$estado){

			$filas = VentaModel::Listar_Ventas_Detalle($criterio,$date,$date2,$estado);
			return $filas;

		}

		public function Imprimir_Ticket_DetalleVenta($idVenta){

			$filas = VentaModel::Imprimir_Ticket_DetalleVenta($idVenta);
			return $filas;

		}

		public function Imprimir_Ticket_Venta($idVenta){

			$filas = VentaModel::Imprimir_Ticket_Venta($idVenta);
			return $filas;

		}

		public function Imprimir_Corte_Z_Dia($date){

			$filas = VentaModel::Imprimir_Corte_Z_Dia($date);
			return $filas;

		}


		public function Imprimir_Corte_Z_Mes($date){

			$filas = VentaModel::Imprimir_Corte_Z_Mes($date);
			return $filas;

		}


		public function Listar_Detalle($idVenta){

			$filas = VentaModel::Listar_Detalle($idVenta);
			return $filas;

		}

		public function Listar_Info($idVenta){

			$filas = VentaModel::Listar_Info($idVenta);
			return $filas;

		}

		public function Count_Ventas($criterio,$date,$date2){

			$filas = VentaModel::Count_Ventas($criterio,$date,$date2);
			return $filas;

		}


		public function Listar_Clientes(){

			$filas = VentaModel::Listar_Clientes();
			return $filas;

		}

		public function Listar_Comprobantes(){

			$filas = VentaModel::Listar_Comprobantes();
			return $filas;

		}


		public function Listar_Empresas(){

			$filas = VentaModel::Listar_Empresas();
			return $filas;

		}

		public function Autocomplete_Producto($search){

			$filas = VentaModel::Autocomplete_Producto($search);
			return $filas;

		}

		public function Insertar_Venta($tipo_pago, $tipo_comprobante,
		$sumas, $iva, $exento, $retenido, $descuento, $total, $sonletras, $pago_efectivo, $pago_tarjeta, $numero_tarjeta, $tarjeta_habiente,
		$cambio, $estado, $idcliente, $idusuario){

		$cmd = VentaModel::Insertar_Venta($tipo_pago, $tipo_comprobante,
		$sumas, $iva, $exento, $retenido, $descuento, $total, $sonletras, $pago_efectivo, $pago_tarjeta, $numero_tarjeta, $tarjeta_habiente,
		$cambio, $estado, $idcliente, $idusuario);

		}

		public function Insertar_DetalleVenta($idproducto, $cantidad, $precio_unitario, $exento, $descuento, $fecha_vence, $importe){

		$cmd = VentaModel::Insertar_DetalleVenta($idproducto, $cantidad, $precio_unitario, $exento, $descuento, $fecha_vence, $importe);

		}

		public function Anular_Venta($idventa){

		$cmd = VentaModel::Anular_Venta($idventa);

		}


		public function Fechas_Vencimiento($idproducto){

			$filas = VentaModel::Fechas_Vencimiento($idproducto);
			return $filas;

		}

		public function Finalizar_Venta($idventa){

		$cmd = VentaModel::Finalizar_Venta($idventa);

		}

	}


 ?>
