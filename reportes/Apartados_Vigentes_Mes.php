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
            $this->Cell(98);
            // Title
              $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto",
            "Septiembre","Octubre","Noviembre","Diciembre");

             $mes = isset($_GET['mes']) ? $_GET['mes'] : '';
             $ano = substr($mes,3,4);

            $this->Cell(105,10,'APARTADOS VIGENTES DEL MES '.strtoupper($meses[date($mes)-1].' del '.$ano),0,0,'C');

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


    $objVenta =  new Venta();
    $objApartado =  new Apartado();
    $listado = $objApartado ->Listar_Apartados('MES',$mes,'',1);
    $parametros = $objVenta->Ver_Moneda_Reporte();

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
    $pdf->Cell(35,5,'No. Apartado',0,0,'L',1);
    $pdf->Cell(45,5,'Fecha Apartado',0,0,'L',1);
    $pdf->Cell(45,5,'Fecha Limite',0,0,'L',1);
    $pdf->Cell(110,5,'Cliente',0,0,'L',1);
    $pdf->Cell(30,5,'Abonado',0,0,'L',1);
    $pdf->Cell(30,5,'Restante',0,0,'L',1);
    $pdf->Cell(22,5,'Total',0,0,'L',1);
    $pdf->Line(322,28,10,28);
    $pdf->Line(322,37,10,37);
    $pdf->Ln(9);
    $total = 0;
    $total_abonado = 0;
    if (is_array($listado) || is_object($listado))
    {
        foreach ($listado as $row => $column) {

        $fecha_apartado = $column["fecha_apartado"];
        if(is_null($fecha_apartado))
        {
            $c_fecha_apartado = '';

        } else {

            $c_fecha_apartado = DateTime::createFromFormat('Y-m-d H:i:s',$fecha_apartado)->format('d/m/Y H:i:s');
        }

        $fecha_limite_retiro = $column["fecha_limite_retiro"];
        if(is_null($fecha_limite_retiro))
        {
            $c_fecha_limite_retiro = '';

        } else {

            $c_fecha_limite_retiro = 
            DateTime::createFromFormat('Y-m-d H:i:s',$fecha_limite_retiro)->format('d/m/Y H:i:s');
        }



            $pdf->setX(9);
            $pdf->Cell(35,5,$column["numero_apartado"],0,0,'L',1);
            $pdf->Cell(45,5,$c_fecha_apartado,0,0,'L',1);
            $pdf->Cell(45,5,$c_fecha_limite_retiro,0,0,'L',1);
            $pdf->Cell(110,5,$column["cliente"],0,0,'L',1);
            $pdf->Cell(30,5,$column["abonado_apartado"],0,0,'L',1);
            $pdf->Cell(30,5,$column["restante_pagar"],0,0,'L',1);
            $pdf->Cell(22,5,$column["total"],0,0,'L',1);
            //$total = $total + $column["total"];
            $total_abonado = $total_abonado + $column["abonado_apartado"];
            $pdf->Ln(6);
            $get_Y = $pdf->GetY();
        }

        $pdf->Line(322,$get_Y+1,10,$get_Y+1);
        $pdf->SetFont('Arial','B',11);
        $pdf->Text(10,$get_Y + 10,'MONTO TOTAL INGRESADO POR ABONOS DE APARTADO ESTE MES'.number_format($total_abonado, 2, '.', ','));
        $pdf->Text(10,$get_Y + 15,'PRECIOS EN : '.$moneda);
    }

    $pdf->Output('I','Apartados_Vigentes_'.$mes_actual.'_del_'.$ano.'.pdf');



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
