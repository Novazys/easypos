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
            $this->Cell(103);
            // Title
            $this->Cell(105,10,'ENTRADAS DE PRODUCTOS DEL MES DE '.strtoupper($meses[date($mes)-1].' del '.$ano),0,0,'C');

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

    $listado = $objInventario->Listar_Entradas($mes);

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
    $pdf->Cell(14,10,' NO.',1,0,'L',1);
    $pdf->Cell(103,10,' PRODUCTOS',1,0,'L',1);
    $pdf->Cell(35,10,'MARCA',1,0,'C',1);
    $pdf->Cell(28,10,'FECHA',1,0,'C',1);
    $pdf->Cell(80,10,'MOTIVO',1,0,'C',1);
    $pdf->Cell(25,10,'CANTIDAD',1,0,'C',1);
    $pdf->Cell(25,10,'VALOR',1,0,'C',1);
    $pdf->Ln(10);
    $pdf->SetFont('Arial','',10);
    $total_entrada = 0;
    $total_final = 0;
    if (is_array($listado) || is_object($listado))
    {
        foreach ($listado as $row => $column) {


            $fecha_movimiento = $column["fecha_entrada"];
            if(is_null($fecha_movimiento))
            {
                $envio_date = '';

            } else {

                $envio_date = DateTime::createFromFormat('Y-m-d',$fecha_movimiento)->format('d/m/Y');
            }


            $pdf->setX(10);
            $pdf->Cell(14,9,$column["idproducto"],1,0,'L',1);
            $pdf->Cell(103,9,$column["nombre_producto"].' '.$column["siglas"],1,0,'L',1);
            $pdf->Cell(35,9,$column["nombre_marca"],1,0,'C',1);
            $pdf->Cell(28,9,$envio_date,1,0,'C',1);
            $pdf->Cell(80,9,$column["descripcion_entrada"],1,0,'L',1);
            $pdf->Cell(25,9,$column["cantidad_entrada"],1,0,'C',1);
            $pdf->Cell(25,9,$column["costo_total_entrada"],1,0,'C',1);

            $total_entrada = $total_entrada + $column["cantidad_entrada"];
            $total_final = $total_final + $column["costo_total_entrada"];

            $pdf->Ln(8);
            $get_Y = $pdf->GetY();

        }

      $pdf->setXY(10,$get_Y+1);
        $pdf->SetFont('Arial','B',11);
        $pdf->Cell(260,9,'TOTALES',1,0,'C',1);
        $pdf->Cell(25,9,number_format($total_entrada, 2, '.', ','),1,0,'C',1);
        $pdf->Cell(25,9,number_format($total_final, 2, '.', ','),1,0,'C',1);

    }


    $pdf->Output('I','Entradas_'.$mes_actual.'_del_'.$ano);



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