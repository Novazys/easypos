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
            $this->Cell(100);
            // Title
            $this->Cell(105,10,'RESUMEN DE SALDOS Y MOVIMIENTOS DE PRODUCTOS DEL MES DE '.strtoupper($meses[date($mes)-1].' del '.$ano),0,0,'C');

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

    $objInventario =  new Inventario();

    $mes = isset($_GET['mes']) ? $_GET['mes'] : '';
    $mes = DateTime::createFromFormat('m/Y', $mes)->format('Y-m');

    $listado = $objInventario->Listar_Kardex($mes);

    $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto",
    "Septiembre","Octubre","Noviembre","Diciembre");

    $mes_actual = strtoupper($meses[date(substr($mes, 5,6))-1]);
    $ano = substr($mes, 0,4);

try {
    // Instanciation of inherited class
    $pdf = new PDF('L','mm',array(216,330));
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',11);
    $pdf->SetFillColor(255,255,255);
    $pdf->Cell(14,14,' NO.',1,0,'L',1);
    $pdf->Cell(130,14,' PRODUCTOS',1,0,'L',1);
    $pdf->Cell(41,14,'MARCA',1,0,'C',1);
    $pdf->setXY(195,36);
    $pdf->Cell(31,8,'SALDO INICIAL',1,0,'C',1);
    $pdf->Cell(31,8,'ENTRADAS',1,0,'C',1);
    $pdf->Cell(31,8,'SALIDAS',1,0,'C',1);
    $pdf->Cell(31,8,'SALDO',1,0,'C',1);
    $pdf->setXY(195,30);
    $pdf->Cell(124,6,'MOVIMIENTOS',1,0,'C',1);
    $pdf->Ln(14);
    $pdf->SetFont('Arial','',10);
    $total_inicial = 0;
    $total_entrada = 0;
    $total_salidas = 0;
    $total_final = 0;
    if (is_array($listado) || is_object($listado))
    {
        foreach ($listado as $row => $column) {

            $pdf->setX(10);
            $pdf->Cell(14,9,$column["idproducto"],1,0,'L',1);
            $pdf->Cell(130,9,$column["producto"],1,0,'L',1);
            $pdf->Cell(41,9,$column["nombre_marca"],1,0,'C',1);
            $pdf->Cell(31,9,$column["saldo_inicial"],1,0,'C',1);
            $pdf->Cell(31,9,$column["entradas"],1,0,'C',1);
            $pdf->Cell(31,9,$column["salidas"],1,0,'C',1);
            $pdf->Cell(31,9,$column["saldo_final"],1,0,'C',1);

            $total_inicial = $total_inicial + $column["saldo_inicial"];
            $total_entrada = $total_entrada + $column["entradas"];
            $total_salidas = $total_salidas + $column["salidas"];
            $total_final = $total_final + $column["saldo_final"];

            $pdf->Ln(8);
            $get_Y = $pdf->GetY();

        }

        $pdf->setXY(10,$get_Y+1);
        $pdf->SetFont('Arial','B',11);
        $pdf->Cell(185,9,'TOTALES',1,0,'C',1);
        $pdf->Cell(31,9,number_format($total_inicial, 2, '.', ','),1,0,'C',1);
        $pdf->Cell(31,9,number_format($total_entrada, 2, '.', ','),1,0,'C',1);
        $pdf->Cell(31,9,number_format($total_salidas, 2, '.', ','),1,0,'C',1);
        $pdf->Cell(31,9,number_format($total_final, 2, '.', ','),1,0,'C',1);

    }


    $pdf->Output('I','Res_Saldos_'.$mes_actual.'_del_'.$ano);



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