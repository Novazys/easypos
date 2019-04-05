<?php
require __DIR__ . '/ticket/autoload.php';
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

function abre_cajon()
{
    /*Conectamos con la impresora*/
    $nombre_impresora = trim(file(__DIR__ . '/impresora.ini')[0]);
    $connector = new WindowsPrintConnector($nombre_impresora);
    $printer = new Printer($connector);
    /*No imprimimos nada, solamente abrimos cajón*/
    $printer->cut();
    $printer->pulse();
    $printer->close();
  
    /*Calculamos la hora para desearle buenos días, tardes o noches*/
    $hora = date("G");
    $str_deseo = "a";
    if ($hora >= 6 and $hora <= 12) {
        $str_deseo = "le deseamos un buen dia";
    }
    if ($hora >= 12 and $hora <= 19) {
        $str_deseo = "le deseamos una buena tarde";
    }
    if ($hora >= 19 and $hora <= 24) {
        $str_deseo = "le deseamos una buena noche";
    }
    if ($hora >= 0 and $hora <= 6) {
        $str_deseo = "le deseamos un buen dia";
    }
    /*Le deseamos al cliente buenas tardes, noches o días*/

    $printer->selectPrintMode(Printer::MODE_FONT_A);
    $printer->setJustification(Printer::JUSTIFY_CENTER);
    $printer->text(strtoupper($str_deseo));
    $printer->feed();

    /*Terminamos el trabajo de impresión y abrimos el cajón*/
    $printer->feed(2);
    $printer->cut();
    $printer->pulse();
    $printer->close();
}
