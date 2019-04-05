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
            $this->Cell(95);
            // Title
            $this->Cell(105,10,'REPORTE DE MARCAS DE PRODUCTOS',0,0,'C');

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
        $this->Cell(235,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'L');
        $this->Cell(43.2,10,date('d/m/Y H:i:s'),0,0,'C');
    }
}

    function __autoload($className){
            $model = "../model/". $className ."_model.php";
            $controller = "../controller/". $className ."_controller.php";
        
           require_once($model);
           require_once($controller);
    }

    $objMarca =  new Marca();
    $listado = $objMarca->Listar_Marcas(); 

try {
    // Instanciation of inherited class
    $pdf = new PDF('L');
    $pdf->AliasNbPages();
    $pdf->AddPage('Letter');
    $pdf->SetFont('Arial','',11);
    $pdf->SetFillColor(255,255,255);
    $pdf->SetX(20);
    $pdf->Cell(30,5,'No',0,0,'L',1);
    $pdf->Cell(200,5,'Marca',0,0,'L',1);
    $pdf->Cell(30,5,'Estado',0,0,'L',1);
    $pdf->Line(285,28,10,28);
    $pdf->Line(285,37,10,37);
    $pdf->Ln(9);

    if (is_array($listado) || is_object($listado))
    {
        foreach ($listado as $row => $column) {

            $estado = $column['estado'];
            if($estado == '1')
            {
                $estado = 'ACTIVO';

            } else {

                $estado = 'INACTIVO';
            }


            $pdf->setX(20);
            $pdf->Cell(30,5,$column["idmarca"],0,0,'L',1);
            $pdf->Cell(200,5,$column["nombre_marca"],0,0,'L',1);
            $pdf->Cell(120,5,$estado,0,0,'L',1);
            $pdf->Ln(6);
            $get_Y = $pdf->GetY();
        }
    }
    

    $pdf->Output('I','Reporte_Marcas.pdf');



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