<?php

    //app.conf.php es el archivo que maneja toda la aplicacion.
    define("DEFAULT_VIEW","Login");  // layout vista si no ha iniciado sesion
    define("DEFAULT_LAYOUT","general.lyt.php");// default para el resto del contenido
    define("PATH_VIEW",realpath("./view/"));// carpeta de vista
    define("PATH_LAYOUT",realpath("./layout"));// carpeta de layout


    //esto lo necesito en el index

    $conf["Login"] = array(
        "file" => "login.vw.php",
        "layout" => "login.lyt.php"
    );

    $conf["error_404"] = array(

        "file" => "404.vw.php",
        "layout" => "error.lyt.php"
    );

    $conf["Inicio"] = array(
        "file" => "home.vw.php",
        "layout" => "home.lyt.php"
    );

    $conf["Acerca-de"] = array(
        "file" => "info.vw.php",
        "layout" => "home.lyt.php"
    );

    // Almacen

    $conf["Categoria"] = array(
        "file" => "categoria.vw.php"
    );

    $conf["Presentacion"] = array(
        "file" => "presentacion.vw.php"
    );

    $conf["Marca"] = array(
        "file" => "marca.vw.php"
    );

    $conf["Producto"] = array(
        "file" => "producto.vw.php"
    );

    $conf["Perecederos"] = array(
        "file" => "perecedero.vw.php"
    );
    // Almacen

    // Cotizaciones

    $conf["Cotizacion"] = array(
        "file" => "cotizacion.vw.php",
        "layout" => "pos.lyt.php"
    );

    $conf["Cotizaciones"] = array(
        "file" => "cotizaciones.vw.php"
    );

    // Cotizaciones


    // Compras

    $conf["Proveedor"] = array(
        "file" => "proveedor.vw.php"
    );

    $conf["Compras"] = array(
        "file" => "compra.vw.php",
        "layout" => "pos.lyt.php"
    );

    $conf["Compras-Fecha"] = array(
        "file" => "comprasfecha.vw.php"
    );

    $conf["Compras-Mes"] = array(
        "file" => "comprasmes.vw.php"
    );

    $conf["Historico-Precios"] = array(
        "file" => "historico.vw.php"
    );

    // Compras

    // Caja

    $conf["Caja"] = array(
        "file" => "caja.vw.php"
    );

    $conf["Historico-Caja"] = array(
        "file" => "historicocaja.vw.php"
    );

    // Caja

    // Ventas

    $conf["Clientes"] = array(
        "file" => "cliente.vw.php"
    );


    $conf["POS"] = array(
        "file" => "pos.vw.php",
        "layout" => "pos.lyt.php"
    );

    $conf["Venta-Diaria"] = array(
        "file" => "ventadiaria.vw.php"
    );

    $conf["Ventas-Fecha"] = array(
        "file" => "ventasfecha.vw.php"
    );

    $conf["Ventas-Mes"] = array(
        "file" => "ventasmes.vw.php"
    );

    // Ventas

    // Inventario

    $conf["Abrir-Inventario"] = array(
        "file" => "abririnventario.vw.php"
    );

    $conf["Kardex"] = array(
        "file" => "kardex.vw.php"
    );
    // Inventario

    // Documentos

    $conf["Tipo-Comprobante"] = array(
        "file" => "tipocomprobante.vw.php"
    );

    $conf["Tirajes"] = array(
        "file" => "tirajes.vw.php"
    );
    // Documentos


    // Usuarios

    $conf["Empleados"] = array(
        "file" => "empleados.vw.php"
    );

    $conf["Usuario"] = array(
        "file" => "usuario.vw.php"
    );

    // Usuarios

    // Ajustes

    $conf["Parametros"] = array(
        "file" => "parametros.vw.php"
    );
    
    $conf["Monedas"] = array(
        "file" => "monedas.vw.php"
    );

    $conf["Backup"] = array(
        "file" => "respaldos.vw.php"
    );

    $conf["Do-Backup"] = array(
        "file" => "makebu.vw.php"
    );

    // Ajustes

    // Creditos

    $conf["Creditos"] = array(
        "file" => "credito.vw.php"
    );
    // Creditos

    // Taller

    $conf["Taller"] = array(
        "file" => "taller.vw.php"
    );

    $conf["Tecnicos"] = array(
        "file" => "tecnicos.vw.php"
    );

    // Taller

    // Apartados

    $conf["POS-A"] = array(
        "file" => "pos-a.vw.php",
        "layout" => "pos.lyt.php"
    );

    $conf["Apartados-Diarios"] = array(
        "file" => "apartadodiario.vw.php"
    );

    $conf["Apartados-Fecha"] = array(
        "file" => "apartadosfecha.vw.php"
    );

    $conf["Apartados-Mes"] = array(
        "file" => "apartadosmes.vw.php"
    );

    // Apartados

 ?>
