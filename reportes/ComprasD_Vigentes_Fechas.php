<?php
require('fpdf/fpdf.php');

class PDF extends FPDF
{
    // Page header
    function Header()
    {
        if ($this->page == 1)
        {
             $fecha1 = isset($_GET['fecha1']) ? $_GET['fecha1'] : '';
             $fecha2 = isset($_GET['fecha2']) ? $_GET['fecha2'] : '';

            // Logo
            //  $this->Image('logo.png',10,6,30);
            // Arial bold 15
            $this->SetFont('Arial','B',15);
            // Move to the right
            $this->Cell(98);
            // Title
            $this->Cell(115,10,'COMPRAS (DETALLADAS) VIGENTES ENTRE EL '.$fecha1.' Y '.$fecha2,0,0,'C');

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

    $fecha1 = isset($_GET['fecha1']) ? $_GET['fecha1'] : '';
    $fecha2 = isset($_GET['fecha2']) ? $_GET['fecha2'] : '';


    $fecha1 = DateTime::createFromFormat('d/m/Y', $fecha1)->format('Y-m-d');
    $fecha2 = DateTime::createFromFormat('d/m/Y', $fecha2)->format('Y-m-d');

    $objCompra =  new Compra();
    $listado = $objCompra->Listar_Compras_Detalle('FECHAS',$fecha1,$fecha2,1,'');
    $totales = $objCompra->Listar_Compras_Totales('FECHAS',$fecha1,$fecha2,1,'');
    $parametros = $objCompra->Ver_Moneda_Reporte();

    foreach ($parametros as $row => $column) {

        $moneda = $column['CurrencyName'];

    }

    foreach ($totales as $row => $column) {
      $total_iva = $column['total_iva'];
      $total_exento = $column['total_exento'];
      $total_retenido = $column['total_retenido'];
      $total_comprado = $column['total_comprado'];
    }


    $fecha1 = DateTime::createFromFormat('Y-m-d', $fecha1)->format('d/m/Y');
    $fecha2 = DateTime::createFromFormat('Y-m-d', $fecha2)->format('d/m/Y');

try {
    // Instanciation of inherited class
    $pdf = new PDF('L','mm',array(216,330));
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Arial','',11);
    $pdf->SetFillColor(255,255,255);
    $pdf->Cell(30,5,'Cantidad',0,0,'L',1);
    $pdf->Cell(31,5,'Cod. Barra',0,0,'L',1);
    $pdf->Cell(120,5,'Producto',0,0,'L',1);
    $pdf->Cell(40,5,'Marca',0,0,'L',1);
    $pdf->Cell(22,5,'Vence',0,0,'L',1);
    $pdf->Cell(22,5,'Costo',0,0,'C',1);
    $pdf->Cell(22,5,'Exento',0,0,'C',1);
    $pdf->Cell(22,5,'Total',0,0,'C',1);
    $pdf->Line(322,28,10,28);
    $pdf->Line(322,37,10,37);
    $pdf->Ln(9);
    $total = 0;
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

          $pdf->setX(9);
          $pdf->Cell(30,5,$column["cantidad"],0,0,'L',1);
          $pdf->Cell(31,5,$column["codigo_barra"],0,0,'L',1);
          $pdf->Cell(120,5,$column["nombre_producto"].' '.$column["siglas"],0,0,'L',1);
          $pdf->Cell(40,5,$column["nombre_marca"],0,0,'L',1);
          $pdf->Cell(22,5,$c_fecha_vence,0,0,'L',1);
          $pdf->Cell(22,5,$column["precio_unitario"],0,0,'C',1);
          $pdf->Cell(22,5,$column["exento"],0,0,'C',1);
          $pdf->Cell(22,5,$column["importe"],0,0,'C',1);
          $pdf->Ln(6);
          $get_Y = $pdf->GetY();
          $total = $total + $column["cantidad"];
        }

        $pdf->Line(322,$get_Y+1,10,$get_Y+1);
        $pdf->SetFont('Arial','B',11);
        $pdf->Text(10,$get_Y + 10,'TOTAL DE PRODUCTOS COMPRADOS : '.number_format($total, 2, '.', ','));
        $pdf->Text(10,$get_Y + 15,'TOTAL GASTADO POR COMPRAS : '.number_format($total_comprado, 2, '.', ','));
        $pdf->Text(10,$get_Y + 20,'TOTAL DE IVA EN COMPRAS : '.number_format($total_iva, 2, '.', ','));
        $pdf->Text(10,$get_Y + 25,'TOTAL RETENIDO : '.number_format($total_retenido, 2, '.', ','));
        $pdf->Text(10,$get_Y + 30,'TOTAL EXENTO : '.number_format($total_exento, 2, '.', ','));
        $pdf->Text(250,$get_Y + 45,'PRECIOS EN : '.$moneda);
    }


    $pdf->Output('I','Compras_Vigentes_del_'.$fecha1.'_al_'.$fecha2.'.pdf');



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
