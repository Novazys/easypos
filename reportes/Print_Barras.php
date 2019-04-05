<?php
  $id =  base64_decode(isset($_GET['ref']) ? $_GET['ref'] : '');
  $cant = isset($_GET['cant']) ? $_GET['cant'] : '';
  $ancho = isset($_GET['ancho']) ? $_GET['ancho'] : '';
  $alto = isset($_GET['alto']) ? $_GET['alto'] : '';

  require_once('tcpdf/tcpdf.php');

  function __autoload($className){
            $model = "../model/". $className ."_model.php";
            $controller = "../controller/". $className ."_controller.php";

           require_once($model);
           require_once($controller);
    }

  $objProducto = new Producto();
  $listado = $objProducto->Print_Barcode($id);

  foreach ($listado as $row => $column) {
    $codigo = $column["codigo_barra"];
    $interno = $column["codigo_interno"];
    $producto = $column["nombre_producto"];
  }

  class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        // Logo
        $image_file = K_PATH_IMAGES.'logo_example.jpg';
        $this->Image($image_file, 10, 10, 15, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
        $this->SetFont('helvetica', 'B', 20);
        // Title
        $this->Cell(0, 15, '<< TCPDF Example 003 >>', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Pagina '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

  $pdf = new MYPDF('P','mm','Letter',true,'UTF-8',false);
  $pdf->setPrintHeader(false);

  $pdf->addPage();
  $pdf->SetFont('helvetica', '', 8);


  // define barcode style
  $style = array(
      'position' => '',
      'align' => 'C',
      'stretch' => false,
      'fitwidth' => true,
      'cellfitalign' => '',
      'border' => false,
      'hpadding' => 'auto',
      'vpadding' => 'auto',
      'fgcolor' => array(0,0,0),
      'bgcolor' => false, //array(255,255,255),
      'text' => true,
      'font' => 'helvetica',
      'fontsize' => 8,
      'stretchtext' => 4
  );


    $x = $pdf->getX();
    $y = $pdf->getY();


 /*<td>'.$td.'</td>
          <td>'.$td.'</td>
          <td>'.$td.'</td>
          <td>'.$td.'</td>
          <td>'.$td.'</td>'
          ;*/

    if($codigo == ''){
         $params = $pdf->serializeTCPDFtagParameters(array($interno, 'C128', '', '', $ancho, $alto, 0.4, $style, 'N'));
    } else {
         $params = $pdf->serializeTCPDFtagParameters(array($codigo, 'C128', '', '', $ancho, $alto, 0.4, $style, 'N'));
    }
    $td= '<tcpdf method="write1DBarcode" params="'.$params.'" />';

    $filas = $cant / 5;

       $html = '<table>';
        for ($j=0; $j < $filas; $j++) { 
          $html.='<tr>';
            for ($i=0; $i < 5; $i++) { 
              $html.='<td>'.$td.'</td>';
              
            }
          $html.='</tr>';
        }
      $html.= '</table>';

    


    $pdf->writeHTML($html, true, false, true, false, '');


    $pdf->output('Codigo_Barra '.$producto.'.pdf','I');
 ?>
