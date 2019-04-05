<?php
require('fpdf/fpdf.php');

class PDF extends FPDF
{
    // Page header
    function Header()
    {
        if ($this->page == 1)
        {

            $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto",
            "Septiembre","Octubre","Noviembre","Diciembre");

             $mes = isset($_GET['mes']) ? $_GET['mes'] : '';
             $ano = substr($mes,3,4);
            // Logo
            //  $this->Image('logo.png',10,6,30);
            // Arial bold 15
            $this->SetFont('Arial','B',15);
            // Move to the right
            $this->Cell(98);
            // Title
            $this->Cell(105,10,'COMPRAS AL CONTADO MES '.strtoupper($meses[date($mes)-1].' del '.$ano),0,0,'C');

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

    $mes = isset($_GET['mes']) ? $_GET['mes'] : '';
    $mes = DateTime::createFromFormat('m/Y', $mes)->format('m-Y');


    $objCompra =  new Compra();
    $listado = $objCompra->Listar_Compras('MES',$mes,'','',1);
    $parametros = $objCompra->Ver_Moneda_Reporte();

foreach ($parametros as $row => $column) {

    $moneda = $column['CurrencyName'];

}

    $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto",
    "Septiembre","Octubre","Noviembre","Diciembre");

    $mes_actual = strtoupper($meses[date(substr($mes, 0,2))-1]);
    $ano = substr($mes, 3,4);

try {
    // Instanciation of inherited class
    $pdf = new PDF('L','mm',array(216,330));
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Arial','',11);
    $pdf->SetFillColor(255,255,255);
    $pdf->Cell(35,5,'Comprobante',0,0,'L',1);
    $pdf->Cell(35,5,'No. Comprobante',0,0,'L',1);
    $pdf->Cell(35,5,'F. Comprobante',0,0,'L',1);
    $pdf->Cell(120,5,'Proveedor',0,0,'L',1);
    $pdf->Cell(30,5,'Tipo Pago',0,0,'L',1);
    $pdf->Cell(22,5,'Total',0,0,'C',1);
    $pdf->Line(322,28,10,28);
    $pdf->Line(322,37,10,37);
    $pdf->Ln(9);
    $total = 0;
    if (is_array($listado) || is_object($listado))
    {
        foreach ($listado as $row => $column) {

        $fecha_comprobante = $column["fecha_comprobante"];
        if(is_null($fecha_comprobante))
        {
            $c_fecha_comprobante = '';

        } else {

            $c_fecha_comprobante = DateTime::createFromFormat('Y-m-d',$fecha_comprobante)->format('d/m/Y');
        }

        $tipo_comprobante = $column["tipo_comprobante"];
        if($tipo_comprobante == '1')
        {
            $tipo_comprobante = 'TICKET';

        } else if ($tipo_comprobante == '2'){

            $tipo_comprobante = 'FACTURA';

        } else if ($tipo_comprobante == '3'){

            $tipo_comprobante = 'CREDITO FISCAL';
        }


        $tipo_pago = $column["tipo_pago"];
        if($tipo_pago == '1')
        {
            $tipo_pago = 'CONTADO';

        } else if ($tipo_pago == '2'){

            $tipo_pago = 'CREDITO';
        }

            $pdf->setX(9);
            $pdf->Cell(35,5,$tipo_comprobante,0,0,'L',1);
            $pdf->Cell(35,5,$column["numero_comprobante"],0,0,'L',1);
            $pdf->Cell(35,5,$c_fecha_comprobante,0,0,'L',1);
            $pdf->Cell(120,5,$column["nombre_proveedor"],0,0,'L',1);
            $pdf->Cell(30,5,$tipo_pago,0,0,'L',1);
            $pdf->Cell(22,5,$column["total"],0,0,'C',1);
            $total = $total + $column["total"];
            $pdf->Ln(6);
            $get_Y = $pdf->GetY();
        }

        $pdf->Line(322,$get_Y+1,10,$get_Y+1);
        $pdf->SetFont('Arial','B',11);
        $pdf->Text(10,$get_Y + 10,'GASTO EN COMPRAS ENTRE DICHAS FECHAS : '.number_format($total, 2, '.', ','));
          $pdf->Text(10,$get_Y + 15,'PRECIOS EN : '.$moneda);
    }


    $pdf->Output('I','Compras_Contado_'.$mes_actual.'_del_'.$ano.'.pdf');



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
