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
            // Title
            $this->Cell(105,10,'REPORTE DE CLIENTES ACTIVOS',0,0,'C');

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

    $objCliente = new Cliente();
    $listado = $objCliente->Listar_Clientes_Activos();

try {
    // Instanciation of inherited class
    $pdf = new PDF('L','mm',array(216,330));
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Arial','',11);
    $pdf->SetFillColor(255,255,255);
    $pdf->Cell(30,5,'Cod. Interno',0,0,'L',1);
    $pdf->Cell(110,5,'Cliente',0,0,'L',1);
    $pdf->Cell(40,5,'NIT',0,0,'L',1);
    $pdf->Cell(30,5,'Telefono',0,0,'L',1);
    $pdf->Cell(60,5,'Email',0,0,'C',1);
    $pdf->Cell(42,5,'Limite Credito $',0,0,'C',1);
  /*  $pdf->Cell(22,5,'Stock',0,0,'C',1);*/
    $pdf->Line(322,28,10,28);
    $pdf->Line(322,37,10,37);
    $pdf->Ln(9);
    $total = 0;

    if (is_array($listado) || is_object($listado))
    {
        foreach ($listado as $row => $column) {

            $nit = $column['numero_nit'];
            $telefono = $column['numero_telefono'];


            $telefono = substr($telefono, 0, 4).'-'.substr($telefono, 4, 4);
            $nit =  substr($nit, 0, 7).'-'.substr($nit, 7,9);

            $pdf->setX(9);
            $pdf->Cell(30,5,$column["codigo_cliente"],0,0,'L',1);
            $pdf->Cell(110,5,$column["nombre_cliente"],0,0,'L',1);
            $pdf->Cell(40,5,$nit,0,0,'L',1);
            $pdf->Cell(30,5,$telefono,0,0,'L',1);
            $pdf->Cell(60,5,$column["email"],0,0,'C',1);
            $pdf->Cell(42,5,$column["limite_credito"],0,0,'C',1);
            /*$pdf->Cell(22,5,$column["stock"],0,0,'C',1);*/
            $pdf->Ln(6);
            $get_Y = $pdf->GetY();
            $total = $total + 1;
        }

        $pdf->Line(322,$get_Y+1,10,$get_Y+1);
        $pdf->SetFont('Arial','B',11);
        $pdf->Text(10,$get_Y + 10,'TOTAL DE CLIENTES ACTIVOS : '.number_format($total, 2, '.', ','));
    }


    $pdf->Output('I','Clientes_Activos.pdf');



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
