<?php
require('fpdf/fpdf.php');

$idproducto = isset($_GET['idproducto']) ? $_GET['idproducto'] : '';

class PDF extends FPDF
{
    
    // Page header
    function Header()
    {
        if ($this->page == 1)
        {
             $producto = isset($_GET['producto']) ? $_GET['producto'] : '';
            // Logo
            //  $this->Image('logo.png',10,6,30);
            // Arial bold 15
            $this->SetFont('Arial','B',15);
            // Move to the right
            $this->Cell(105);
            // Title
            $this->Cell(105,10,'HISTORICO DE PRECIOS DE : '.$producto,0,0,'C');

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

    $objCompra = new Compra();
    $listado = $objCompra->Reporte_Historico($idproducto);
    $mas_bajo = $objCompra->Reporte_Historico_Mas_Bajo($idproducto);
    $producto = isset($_GET['producto']) ? $_GET['producto'] : '';
    $menor = 0.00;
    $precio_mas_bajo = 0.00;
    $proveedor_ganador = "";
    $fecha_baja="";

    foreach ($mas_bajo as $row => $column) {
        $proveedor_ganador = $column["nombre_proveedor"];
        $menor = $column["precio_comprado"];
        $fecha_baja = $column["fecha_precio"];
    }

try {
    // Instanciation of inherited class
    $pdf = new PDF('L','mm',array(216,330));
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Arial','',11);
    $pdf->SetFillColor(255,255,255);
    $pdf->Cell(100,5,'Producto',0,0,'L',1);
    $pdf->Cell(35,5,'Marca',0,0,'L',1);
    $pdf->Cell(25,5,'Presentacion',0,0,'L',1);
    $pdf->Cell(105,5,'Proveedor',0,0,'L',1);
    $pdf->Cell(22,5,'Fecha',0,0,'L',1);
    $pdf->Cell(22,5,'Precio',0,0,'C',1);
    $pdf->Line(322,28,10,28);
    $pdf->Line(322,37,10,37);
    $pdf->Ln(9);



    if (is_array($listado) || is_object($listado))
    {
        foreach ($listado as $row => $column) {

            $precio_mas_bajo = $column["precio_comprado"];
            $fecha_precio = $column["fecha_precio"];
            

            if(is_null($fecha_precio))
            {
                $envio_date = '';

            } else {

                $envio_date = DateTime::createFromFormat('Y-m-d',$fecha_precio)->format('d/m/Y');
            }

            

            $pdf->setX(9);
            $pdf->Cell(100,5,$column["nombre_producto"],0,0,'L',1);
            $pdf->Cell(35,5,$column["nombre_marca"],0,0,'L',1);
            $pdf->Cell(25,5,$column["siglas"],0,0,'L',1);
            $pdf->Cell(105,5,$column["nombre_proveedor"],0,0,'L',1);
            $pdf->Cell(22,5,$envio_date,0,0,'L',1);
            $pdf->Cell(22,5,$column["precio_comprado"],0,0,'C',1);
            $pdf->Ln(6);
            $get_Y = $pdf->GetY();
        }

        $pdf->Line(322,$get_Y+1,10,$get_Y+1);
        $pdf->SetFont('Arial','B',11);
        $pdf->Text(10,$get_Y + 10,'EL PRECIO MAS BAJO AL QUE SE HA COMPRADO ES : '.number_format($menor, 4, '.', ','));
        $pdf->Text(10,$get_Y + 16,'COMPRADO A  : '.$proveedor_ganador.' LA FECHA DE : '.DateTime::createFromFormat('Y-m-d',$fecha_baja)->format('d/m/Y'));
    }
    

    $pdf->Output('I','Historico_Precios_'.$producto.'.pdf');



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