<?php
    $pdf->setXY(2,1.5);
    $pdf->MultiCell(73, 4.2, $empresa, 0,'C',0 ,1);

    $pdf->setXY(2,6);
    $pdf->SetFont('Arial', '', 8);
    $pdf->MultiCell(73, 4.2, $propietario, 0,'C',0 ,1);

    $pdf->setXY(2,10);
    $pdf->SetFont('Arial', '', 6.9);
    $pdf->MultiCell(73, 4.2, $direccion, 0,'C',0 ,1);

    $get_YD = $pdf->GetY();

    $pdf->setXY(2,$get_YD);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(73, 4.2, 'NIT : '.$nit, 0,'C',0 ,1);

    $pdf->setXY(2,$get_YD + 4);
    $pdf->SetFont('Arial', '', 7);
    $pdf->MultiCell(73, 4.2, 'Resolucion '.$numero_resolucion_fact.' del '.$fecha_resolucion, 0,'C',0 ,1);

    $pdf->setXY(2,$get_YD + 8);
    $pdf->SetFont('Arial', 'B', 7);
    $pdf->MultiCell(73, 4.2, 'Serie : '.$serie.' de '.$desde.' a '.$hasta, 0,'C',0 ,1);

    $pdf->setXY(2,$get_YD + 12);
    $pdf->SetFont('Arial', 'B', 7);
    $pdf->MultiCell(73, 4.2, 'Resolucion del Sistema', 0,'C',0 ,1);

    $pdf->setXY(2,$get_YD + 16);
    $pdf->SetFont('Arial', '', 7);
    $pdf->MultiCell(73, 4.2, $numero_resolucion.' de '.$fecha_resolucion, 0,'C',0 ,1);

    $get_YH = $pdf->GetY();
   /*  $pdf->SetFont('Arial', '', 8);
    $pdf->SetY(7);
    $pdf->MultiCell(55, 4.2, $direccion, 0,'C',0 ,1);
    $get_YH = $pdf->GetY();

    $pdf->Text(8, $get_YH + 3, 'NIT : '.$nit);
    $pdf->Text(10, $get_YH + 7, $propietario);
    $pdf->Text(8, $get_YH + 11.2, 'FECHA RESOLUCION : '.$fecha_resolucion);
    $pdf->Text(8, $get_YH + 16, 'NO. RESOLUCION : '.$numero_resolucion);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Text(8.5, $get_YH + 20, ''.$serie);*/

 ?>
