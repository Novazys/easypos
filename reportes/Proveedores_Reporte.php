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
            $this->Cell(105,10,'REPORTE DE PROVEEDORES DE ALMACEN',0,0,'C');

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

    $objProveedor = new Proveedor();
    $listado = $objProveedor->Listar_Proveedores();

try {
    // Instanciation of inherited class
    $pdf = new PDF('L','mm',array(216,330));
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Arial','',11);
    $pdf->SetFillColor(255,255,255);
    $pdf->Cell(30,5,'Cod. Interno',0,0,'L',1);
    $pdf->Cell(105,5,'Proveedor',0,0,'L',1);
    $pdf->Cell(21,5,'Telefono',0,0,'L',1);
    $pdf->Cell(35,5,'NIT',0,0,'L',1);
    $pdf->Cell(80,5,'Contacto',0,0,'L',1);
    $pdf->Cell(20,5,'Estado',0,0,'C',1);
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
            $estado = $column['estado'];
            if($estado == '1')
            {
                $estado = 'ACTIVO';

            } else {

                $estado = 'INACTIVO';
            }

            $pdf->setX(9);
            $pdf->Cell(30,5,$column["codigo_proveedor"],0,0,'L',1);
            $pdf->Cell(105,5,$column["nombre_proveedor"],0,0,'L',1);
            $pdf->Cell(21,5,$telefono,0,0,'L',1);
            $pdf->Cell(35,5,$nit,0,0,'L',1);
            $pdf->Cell(80,5,$column["nombre_contacto"],0,0,'L',1);
            $pdf->Cell(20,5,$estado,0,0,'C',1);
            $pdf->Ln(6);
            $get_Y = $pdf->GetY();
            $total = $total + 1 ;
        }

        $pdf->Line(322,$get_Y+1,10,$get_Y+1);
        $pdf->SetFont('Arial','B',11);
        $pdf->Text(10,$get_Y + 10,'TOTAL DE PROVEEDORES REGISTRADOS : '.number_format($total, 2, '.', ','));
    }
    

    $pdf->Output('I','Reporte_de_Proveedores.pdf');



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