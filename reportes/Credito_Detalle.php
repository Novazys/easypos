<?php
require('fpdf/fpdf.php');

class PDF extends FPDF
{
    // Page header
    function Header()
    {
        if ($this->page == 1)
        {
            // Logo
            //  $this->Image('logo.png',10,6,30);
            // Arial bold 15
            $this->SetFont('Arial','B',15);
            // Move to the right
            $this->Cell(105);
            $codigo =  base64_decode(isset($_GET['cod']) ? $_GET['cod'] : '');
            $arreglo = explode(",", $codigo);
            $longitud = count($arreglo);
            for($i=0; $i<$longitud; $i++){
                //saco el valor de cada elemento
                $codigo_credito = $arreglo[0];
             }
            // Title
            $this->Cell(105,10,'ESTADO DE CUENTA DE CREDITO '.$codigo_credito,0,0,'C');

            // Line break
            $this->Ln(20);
        }
    }

// Page footer
    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Page number
        $this->Cell(275,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'L');
        $this->Cell(43.2,10,date('d/m/Y H:i:s'),0,0,'C');
    }
}

    function __autoload($className){
            $model = "../model/". $className ."_model.php";
            $controller = "../controller/". $className ."_controller.php";

           require_once($model);
           require_once($controller);
    }

    $codigo =  base64_decode(isset($_GET['cod']) ? $_GET['cod'] : '');
    $arreglo = explode(",", $codigo);
    $longitud = count($arreglo);
    for($i=0; $i<$longitud; $i++){
        //saco el valor de cada elemento
        $idcredito = $arreglo[1];
     }

    $objCredito = New Credito();
    $datos = $objCredito->Listar_Creditos_Espc($idcredito);

    $list_abonos = $objCredito->Listar_Abonos_Credito($idcredito);

    if (is_array($datos) || is_object($datos))
    {
        foreach ($datos as $row => $column) {
          $codigo_credito = $column["codigo_credito"];
          $idventa = $column["idventa"];
          $numero_venta = $column["numero_venta"];
          $nombre_credito = $column["nombre_credito"];
          $fecha_credito = $column["fecha_credito"];
          $monto_credito = $column["monto_credito"];
          $monto_abonado = $column["monto_abonado"];
          $monto_restante = $column["monto_restante"];
          $estado_credito = $column["estado_credito"];
          $codigo_cliente = $column["codigo_cliente"];
          $cliente = $column["cliente"];
          $limite_credito = $column["limite_credito"];
        }

        if($estado_credito == 0):
          $estado_credito = 'CREDITO VIGENTE';
        else:
          $estado_credito = 'CREDITO FINALIZADO';
        endif;
    }


    $objVenta = new Venta();
    $listado = $objVenta->Listar_Detalle($idventa);

    $parametros = $objVenta->Ver_Moneda_Reporte();

    foreach ($parametros as $row => $column) {

        $moneda = $column['CurrencyName'];

    }


try {
    // Instanciation of inherited class
    $pdf = new PDF('L','mm',array(216,330));
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Arial','I',12);
    $pdf->Text(10, 30, 'DESCRIPCION DE CREDITO : ');
    $pdf->Text(10, 37, 'CLIENTE : ');

    $pdf->Text(150, 30, 'FECHA DE CREDITO : ');
    $pdf->Text(150, 37, 'MONTO DE CREDITO : ');

    $pdf->Text(270, 30, 'ESTADO DE CREDITO : ');


    $pdf->SetFont('Arial','BI',12);
    $pdf->Text(70, 30, $nombre_credito);
    $pdf->Text(32, 37, $codigo_cliente.' - '.$cliente);

    $pdf->Text(197, 30, DateTime::createFromFormat('Y-m-d H:i:s',$fecha_credito)->format('d/m/Y H:i:s'));
    $pdf->Text(197, 37, $monto_credito);

    $pdf->SetFont('Arial','BI',14);
    $pdf->Text(270, 38, $estado_credito);

    $pdf->setY(45);
    $pdf->SetFont('Arial','',11);
    $pdf->SetFillColor(255,255,255);
    $pdf->Cell(30,5,'Cantidad',1,0,'L',1);
    $pdf->Cell(118,5,'Producto',1,0,'L',1);
    $pdf->Cell(32,5,'Presentacion',1,0,'C',1);
    $pdf->Cell(32,5,'Precio Venta',1,0,'C',1);
    $pdf->Cell(25,5,'Vence',1,0,'C',1);
    $pdf->Cell(25,5,'Exento',1,0,'C',1);
    $pdf->Cell(25,5,'Descuento',1,0,'C',1);
    $pdf->Cell(25,5,'Total',1,0,'C',1);
    $pdf->Ln(5);
    $total = 0;
    $importe = 0;
    $utilidad = 0;
    if (is_array($listado) || is_object($listado))
    {
        foreach ($listado as $row => $column) {

          $fecha_vence = $column["fecha_vence"];
          if(is_null($fecha_vence))
          {
              $c_fecha_vence = '';

          } else {

              $c_fecha_vence = DateTime::createFromFormat('Y-m-d',$fecha_vence)->format('d/m/Y');
          }

        $pdf->setX(10);
        $pdf->Cell(30,7,$column["cantidad"],1,0,'L',1);
        $pdf->Cell(118,7,$column["nombre_producto"].' - '.$column["nombre_marca"],1,0,'L',1);
        $pdf->Cell(32,7,$column["siglas"],1,0,'C',1);
        $pdf->Cell(32,7,$column["precio_unitario"],1,0,'C',1);
        $pdf->Cell(25,7,$c_fecha_vence,1,0,'C',1);
        $pdf->Cell(25,7,$column["exento"],1,0,'C',1);
        $pdf->Cell(25,7,$column["descuento"],1,0,'C',1);
        $pdf->Cell(25,7,$column["importe"],1,0,'C',1);
        $pdf->Ln(6);
        $get_Y = $pdf->GetY();
        $total = $total + $column["cantidad"];
      }

      $pdf->SetFont('Arial','B',13);
      $pdf->Cell(312,10,'ABONOS REALIZADOS',1,0,'C',1);

      $pdf->Ln(10);
      $pdf->setX(10);
      $pdf->SetFont('Arial','',12);
      $pdf->Cell(76,12,'Fecha Abono',1,0,'C',1);
      $pdf->Cell(40,12,'Monto Abonado',1,0,'C',1);
      $pdf->Cell(40,12,'Abonado por',1,0,'C',1);
      $pdf->Cell(78,12,'Restante hasta dicha Fecha',1,0,'C',1);
      $pdf->Cell(78,12,'Abonado hasta dicha Fecha',1,0,'C',1);
      //$pdf->Line(322,67,10,67);
      $pdf->Ln(11);

     if (is_array($list_abonos) || is_object($list_abonos))
      {
          foreach ($list_abonos as $row => $column) {

          $fecha_abono = $column["fecha_abono"];
          if(is_null($fecha_abono))
          {
              $c_fecha_abono = '';

          } else {

              $c_fecha_abono = DateTime::createFromFormat('Y-m-d H:i:s',$fecha_abono)->format('d/m/Y H:i:s');
          }


          $pdf->Cell(76,6,$c_fecha_abono,1,0,'C',1);
          $pdf->Cell(40,6,$column["monto_abono"],1,0,'C',1);
          $pdf->Cell(40,6,$column["usuario"],1,0,'C',1);
          $pdf->Cell(78,6,$column["restante_credito"],1,0,'C',1);
          $pdf->Cell(78,6,$column["total_abonado"],1,0,'C',1);
          $pdf->Ln(6);
          $get_Y = $pdf->GetY();
        }

        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(76,6,'TOTAL ABONADO / QUEDAN : ',1,0,'C',1);
        $pdf->Cell(80,6,$monto_abonado,1,0,'C',1);
        $pdf->Cell(78,6,$monto_restante,1,0,'C',1);
        $pdf->Cell(78,6,'',1,0,'C',1);


      }
      $get_Y = $pdf->GetY();
      $pdf->Text(10,$get_Y + 15,'PRECIOS EN : '.$moneda);

    }




    $pdf->Output('I','Estado_Cuenta_'.$codigo_credito.'.pdf');



} catch (Exception $e) {

    // Instanciation of inherited class
    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage('L','Letter');
    $pdf->Text(50,50,'ERROR AL IMPRIMIR');
    $pdf->SetFont('Times','',12);
    $pdf->Output();

}

?>
