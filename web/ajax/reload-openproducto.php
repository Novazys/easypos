<?php
session_start();
$tipo_usuario = $_SESSION['user_tipo'];

function __autoload($className) {
    $model = "../../model/" . $className . "_model.php";
    $controller = "../../controller/" . $className . "_controller.php";

    require_once($model);
    require_once($controller);
}

$objProducto = new Producto();
?>


<!-- Basic initialization -->
<div class="panel panel-flat">
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="?View=Inicio"><i class="icon-home2 position-left"></i> Inicio</a></li>
            <li><a href="javascript:;">Almacen</a></li>
            <li class="active">Productos</li>
        </ul>
    </div>
    <div class="panel-heading">
        <h5 class="panel-title">Productos</h5>

        <div class="heading-elements">
            <?php if ($tipo_usuario == '1') { ?>
                <button type="button" class="btn btn-primary heading-btn"
                        onclick="newProducto()">
                    <i class="icon-database-add"></i> Agregar Nuevo/a</button>

                <div class="btn-group">
                    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-printer2 position-left"></i> Imprimir Reporte
                        <span class="caret"></span></button>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li><a id="print_activos" href="javascript:void(0)"
                               ><i class="icon-file-pdf"></i> Productos Activos</a></li>
                        <li class="divider"></li>
                        <li><a id="print_inactivos" href="javascript:void(0)">
                                <i class="icon-file-pdf"></i> Productos Inactivos</a></li>
                        <li class="divider"></li>
                        <li><a id="print_agotados" href="javascript:void(0)">
                                <i class="icon-file-pdf"></i> Productos Agotados</a></li>
                        <li class="divider"></li>
                        <li><a id="print_vigentes" href="javascript:void(0)">
                                <i class="icon-file-pdf"></i> Productos Vigentes</a></li>
                    </ul>
                </div>
            <?php } ?>

        </div>
    </div>
    <div class="panel-body">
    </div>
    <div id="reload-div">
        <table class="table datatable-basic table-borderless table-hover table-xxs">
            <?php if ($tipo_usuario == '1') { ?>
                <thead>
                    <tr>
                        <th>Barra/Interno</th>
                        <th>Producto</th>
                        <th>Marca</th>
                        <th>Presentacion</th>
                        <th>S.Min.</th>
                        <th>Stock</th>
                        <th>P.Compra</th>
                        <th>Precio</th>
                        <th class="text-center">Opciones</th>
                    </tr>
                </thead>



                <tbody>

                    <?php
                    $filas = $objProducto->Listar_Productos();
                    if (is_array($filas) || is_object($filas)) {
                        foreach ($filas as $row => $column) {
                            $stock_print = "";
                            $codigo_print = "";
                            $codigo_barra = $column['codigo_barra'];
                            $inventariable = $column['inventariable'];
                            $stock = $column['stock'];
                            $stock_min = $column['stock_min'];

                            if ($codigo_barra == '') {
                                $codigo_print = $column['codigo_interno'];
                            } else {

                                $codigo_print = $codigo_barra;
                            }

                            if ($inventariable == 1) {

                                if ($stock >= 1 && $stock < $stock_min) {
                                    $stock_print = '<span class="label label-warning label-rounded"><span
					                	class="text-bold">POR AGOTARSE</span></span>';
                                } else if ($stock == $stock_min) {

                                    $stock_print = '<span class="label label-info label-rounded"><span
					                	class="text-bold">EN MINIMO</span></span>';
                                } else if ($stock > $stock_min) {

                                    $stock_print = '<span
					                	class="">' . $stock . '</span>';
                                } else if ($stock == 0) {

                                    $stock_print = '<span class="label label-danger label-rounded">
					                	<span class="text-bold">AGOTADO</span></span>';
                                }
                            } else {

                                $stock_print = '<span class="label label-primary label-rounded"><span
					                	class="text-bold">SERVICIO</span></span>';
                            }
                            ?>
                            <tr>
                                <td><?php print($codigo_print); ?></td>
                                <td><?php print($column['nombre_producto']); ?></td>
                                <td><?php print($column['nombre_marca']); ?></td>
                                <td><?php print($column['nombre_presentacion']); ?></td>
                                <td><?php print($column['stock_min']); ?></td>
                                <td><?php print($stock_print); ?></td>
                                <td><?php print($column['precio_compra']); ?></td>
                                <td><?php print($column['precio_venta']); ?></td>
                                <td class="text-center">
                                    <ul class="icons-list">
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                <i class="icon-menu9"></i>
                                            </a>

                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li><a
                                                        href="javascript:;" data-toggle="modal" data-target="#modal_iconified"
                                                        onclick="openProducto('editar',
                                                                                                                            '<?php print($column["idproducto"]); ?>',
                                                                                                                            '<?php print($column["codigo_interno"]); ?>',
                                                                                                                            '<?php print($column["codigo_barra"]); ?>',
                                                                                                                            '<?php print($column["nombre_producto"]); ?>',
                                                                                                                            '<?php print($column["precio_compra"]); ?>',
                                                                                                                            '<?php print($column["precio_venta"]); ?>',
                                                                                                                            '<?php print($column["precio_venta_mayoreo"]); ?>',
                                                                                                                            '<?php print($column["stock"]); ?>',
                                                                                                                            '<?php print($column["stock_min"]); ?>',
                                                                                                                            '<?php print($column["idcategoria"]); ?>',
                                                                                                                            '<?php print($column["idmarca"]); ?>',
                                                                                                                            '<?php print($column["idpresentacion"]); ?>',
                                                                                                                            '<?php print($column["estado"]); ?>',
                                                                                                                            '<?php print($column["exento"]); ?>',
                                                                                                                            '<?php print($column["inventariable"]); ?>',
                                                                                                                            '<?php print($column["perecedero"]); ?>')">
                                                        <i class="icon-pencil6">
                                                        </i> Editar</a></li>
                                                <li><a
                                                        href="javascript:;" data-toggle="modal" 
                                                        data-target="#modal_iconified_barcode"
                                                        onclick="openBarcode(
                                                                                                                            '<?php print($column["codigo_barra"]); ?>',
                                                                                                                            '<?php print($column["codigo_interno"]); ?>',
                                                                                                                            '<?php print($column["nombre_producto"]); ?>',
                                                                                                                            '<?php print($column["idproducto"]); ?>')">
                                                        <i class="icon-barcode2">
                                                        </i>Codigo de Barra</a></li>
                                                <li><a
                                                        href="javascript:;" data-toggle="modal" data-target="#modal_iconified"
                                                        onclick="openProducto('ver',
                                                                                                                            '<?php print($column["idproducto"]); ?>',
                                                                                                                            '<?php print($column["codigo_interno"]); ?>',
                                                                                                                            '<?php print($column["codigo_barra"]); ?>',
                                                                                                                            '<?php print($column["nombre_producto"]); ?>',
                                                                                                                            '<?php print($column["precio_compra"]); ?>',
                                                                                                                            '<?php print($column["precio_venta"]); ?>',
                                                                                                                            '<?php print($column["precio_venta_mayoreo"]); ?>',
                                                                                                                            '<?php print($column["stock"]); ?>',
                                                                                                                            '<?php print($column["stock_min"]); ?>',
                                                                                                                            '<?php print($column["idcategoria"]); ?>',
                                                                                                                            '<?php print($column["idmarca"]); ?>',
                                                                                                                            '<?php print($column["idpresentacion"]); ?>',
                                                                                                                            '<?php print($column["estado"]); ?>',
                                                                                                                            '<?php print($column["exento"]); ?>',
                                                                                                                            '<?php print($column["inventariable"]); ?>',
                                                                                                                            '<?php print($column["perecedero"]); ?>')">
                                                        <i class=" icon-eye8">
                                                        </i> Ver</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                                                        <?php
                                                    }
                                                }
                                                ?>

                </tbody>

<?php } else { ?>
                <thead>
                    <tr>
                        <th>Barra/Interno</th>
                        <th>Producto</th>
                        <th>Marca</th>
                        <th>Presentacion</th>
                        <th>S.Min.</th>
                        <th>Stock</th>
                        <th>Precio</th>
                        <th class="text-center">Opciones</th>
                    </tr>
                </thead>


                <tbody>

    <?php
    $filas = $objProducto->Listar_Productos();
    if (is_array($filas) || is_object($filas)) {
        foreach ($filas as $row => $column) {
            $stock_print = "";
            $codigo_print = "";
            $codigo_barra = $column['codigo_barra'];
            $inventariable = $column['inventariable'];
            $stock = $column['stock'];
            $stock_min = $column['stock_min'];

            if ($codigo_barra == '') {
                $codigo_print = $column['codigo_interno'];
            } else {

                $codigo_print = $codigo_barra;
            }

            if ($inventariable == 1) {

                if ($stock >= 1 && $stock < $stock_min) {
                    $stock_print = '<span class="label label-warning label-rounded"><span
					                	class="text-bold">POR AGOTARSE</span></span>';
                } else if ($stock == $stock_min) {

                    $stock_print = '<span class="label label-info label-rounded"><span
					                	class="text-bold">EN MINIMO</span></span>';
                } else if ($stock > $stock_min) {

                    $stock_print = '<span
					                	class="">' . $stock . '</span>';
                } else if ($stock == 0) {

                    $stock_print = '<span class="label label-danger label-rounded">
					                	<span class="text-bold">AGOTADO</span></span>';
                }
            } else {

                $stock_print = '<span class="label label-primary label-rounded"><span
					                	class="text-bold">SERVICIO</span></span>';
            }
            ?>
                            <tr>
                                <td><?php print($codigo_print); ?></td>
                                <td><?php print($column['nombre_producto']); ?></td>
                                <td><?php print($column['nombre_marca']); ?></td>
                                <td><?php print($column['nombre_presentacion']); ?></td>
                                <td><?php print($column['stock_min']); ?></td>
                                <td class="success"><?php print($stock_print); ?></td>
                                <td><?php print($column['precio_venta']); ?></td>
                                <td class="text-center">
                                    <ul class="icons-list">
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                <i class="icon-menu9"></i>
                                            </a>

                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li><a
                                                        href="javascript:;" data-toggle="modal" 
                                                        data-target="#modal_iconified_barcode"
                                                        onclick="openBarcode(
                                                                                                                            '<?php print($column["codigo_barra"]); ?>',
                                                                                                                            '<?php print($column["codigo_interno"]); ?>',
                                                                                                                            '<?php print($column["nombre_producto"]); ?>',
                                                                                                                            '<?php print($column["idproducto"]); ?>')">
                                                        <i class="icon-barcode2">
                                                        </i>Codigo de Barra</a></li>
                                                <li><a
                                                        href="javascript:;" data-toggle="modal" data-target="#modal_iconified"
                                                        onclick="openProducto('ver',
                                                                                                                            '<?php print($column["idproducto"]); ?>',
                                                                                                                            '<?php print($column["codigo_interno"]); ?>',
                                                                                                                            '<?php print($column["codigo_barra"]); ?>',
                                                                                                                            '<?php print($column["nombre_producto"]); ?>',
                                                                                                                            '<?php print($column["precio_compra"]); ?>',
                                                                                                                            '<?php print($column["precio_venta"]); ?>',
                                                                                                                            '<?php print($column["precio_venta_mayoreo"]); ?>',
                                                                                                                            '<?php print($column["stock"]); ?>',
                                                                                                                            '<?php print($column["stock_min"]); ?>',
                                                                                                                            '<?php print($column["idcategoria"]); ?>',
                                                                                                                            '<?php print($column["idmarca"]); ?>',
                                                                                                                            '<?php print($column["idpresentacion"]); ?>',
                                                                                                                            '<?php print($column["estado"]); ?>',
                                                                                                                            '<?php print($column["exento"]); ?>',
                                                                                                                            '<?php print($column["inventariable"]); ?>',
                                                                                                                            '<?php print($column["perecedero"]); ?>')">
                                                        <i class=" icon-eye8">
                                                        </i> Ver</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                                                        <?php
                                                    }
                                                }
                                                ?>

                </tbody>


                                            <?php } ?>
        </table>
    </div>
</div>

<!-- Iconified modal -->
<div id="modal_iconified" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title"><i class="icon-pencil7"></i> &nbsp; <span class="title-form"></span></h5>
            </div>

            <form role="form" autocomplete="off" class="form-validate-jquery" id="frmModal">
                <div class="modal-body" id="modal-container">

                    <div class="alert alert-info alert-styled-left text-blue-800 content-group">
                        <span class="text-semibold">Estimado usuario</span>
                        Los campos remarcados con <span class="text-danger"> * </span> son necesarios.
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <input type="hidden" id="txtID" name="txtID" class="form-control" value="">
                        <input type="hidden" id="txtProceso" name="txtProceso" class="form-control" value="">
                    </div>


                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <label>Codigo</label>
                                <input type="text" id="txtCodigo" name="txtCodigo" placeholder="AUTOGENERADO"
                                       class="form-control" style="text-transform:uppercase;"
                                       onkeyup="javascript:this.value = this.value.toUpperCase();" readonly="" disabled="disabled">
                            </div>

                            <div class="col-sm-6">
                                <label>Codigo Interno o Barra</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="icon-barcode2"></i></span>
                                    <input type="text" id="txtCodigoBarra" name="txtCodigoBarra" placeholder="0108580848408"
                                           class="form-control" style="text-transform:uppercase;"
                                           onkeyup="javascript:this.value = this.value.toUpperCase();">
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <label>Producto <span class="text-danger">*</span></label>
                                <input type="text" id="txtProducto" name="txtProducto" placeholder="EJ. BOTE DE MAYONESA HELLMANS"
                                       class="form-control" style="text-transform:uppercase;"
                                       onkeyup="javascript:this.value = this.value.toUpperCase();">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-5">
                                <label>Stock<span class="text-danger">*</span></label>
                                <input type="text" id="txtStock" name="txtStock" placeholder="0.00"
                                       class="touchspin-prefix" value="0" style="text-transform:uppercase;"
                                       onkeyup="javascript:this.value = this.value.toUpperCase();">
                            </div>

<?php if ($tipo_usuario == '1'): ?>
                                <div class="col-sm-6">
                                    <label>Precio Compra <span class="text-danger">*</span></label>
                                    <input type="text" id="txtPCompra" name="txtPCompra" placeholder="EJ. 1.6081"
                                           class="touchspin-prefix" value="0" style="text-transform:uppercase;"
                                           onkeyup="javascript:this.value = this.value.toUpperCase();">
                                </div>
<?php endif; ?>


                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <label>Precio Venta <span class="text-danger">*</span></label>
                                <input type="text" id="txtPVenta" name="txtPVenta" placeholder="EJ. 1.50"
                                       class="touchspin-prefix" value="0" style="text-transform:uppercase;"
                                       onkeyup="javascript:this.value = this.value.toUpperCase();">
                            </div>

                            <div class="col-sm-6">
                                <label>Precio Venta Mayoreo <span class="text-danger">*</span></label>
                                <input type="text" id="txtPVentaM" name="txtPVentaM" placeholder="EJ. 1.25"
                                       class="touchspin-prefix" value="0" style="text-transform:uppercase;"
                                       onkeyup="javascript:this.value = this.value.toUpperCase();">
                            </div>

                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-5">
                                <label>Stock Min <span class="text-danger">*</span></label>
                                <input type="text" id="txtSMin" name="txtSMin" placeholder="EJ. 5"
                                       class="touchspin-prefix" value="0" style="text-transform:uppercase;"
                                       onkeyup="javascript:this.value = this.value.toUpperCase();">
                            </div>

                            <div class="col-sm-7">
                                <label>Categoria <span class="text-danger">*</span></label>
                                <select  data-placeholder="Seleccione una categoria..." id="cbCategoria" name="cbCategoria"
                                         class="select-search" style="text-transform:uppercase;"
                                         onkeyup="javascript:this.value = this.value.toUpperCase();">
<?php
$filas = $objProducto->Listar_Categorias();
if (is_array($filas) || is_object($filas)) {
    foreach ($filas as $row => $column) {
        ?>
                                            <option value="<?php print ($column["idcategoria"]) ?>">
        <?php print ($column["nombre_categoria"]) ?></option>
        <?php
    }
}
?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <label>Marca</label>
                                <select  data-placeholder="Seleccione una categoria..." id="cbMarca" name="cbMarca"
                                         class="select-search" style="text-transform:uppercase;"
                                         onkeyup="javascript:this.value = this.value.toUpperCase();">
                                             <?php
                                             $filas = $objProducto->Listar_Marcas();
                                             if (is_array($filas) || is_object($filas)) {
                                                 foreach ($filas as $row => $column) {
                                                     ?>
                                            <option value="<?php print ($column["idmarca"]) ?>">
                                                     <?php print ($column["nombre_marca"]) ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                </select>
                            </div>

                            <div class="col-sm-6">
                                <label>Presentacion <span class="text-danger">*</span></label>
                                <select  data-placeholder="Seleccione una presentacion..." id="cbPresentacion" name="cbPresentacion"
                                         class="select-search" style="text-transform:uppercase;"
                                         onkeyup="javascript:this.value = this.value.toUpperCase();">
<?php
$filas = $objProducto->Listar_Presentaciones();
if (is_array($filas) || is_object($filas)) {
    foreach ($filas as $row => $column) {
        ?>
                                            <option value="<?php print ($column["idpresentacion"]) ?>">
                                                     <?php print ($column["siglas"]) ?></option>
                                                     <?php
                                                 }
                                             }
                                             ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="checkbox checkbox-switchery switchery-sm">
                                    <label>
                                        <input type="checkbox" id="chkPerece" name="chkPerece"
                                               class="switchery">
                                        <span id="lblchk-p">NO PERECEDERO</span>
                                    </label>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="checkbox checkbox-switchery switchery-sm">
                                    <label>
                                        <input type="checkbox" id="chkExento" name="chkExento"
                                               class="switchery">
                                        <span id="lblchk-e">NO EXENTO</span>
                                    </label>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="checkbox checkbox-switchery switchery-sm">
                                    <label>
                                        <input type="checkbox" id="chkInven" name="chkInven"
                                               class="switchery" checked="checked" >
                                        <span id="lblchk-i">INVENTARIABLE</span>
                                    </label>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="checkbox checkbox-switchery switchery-sm">
                                    <label>
                                        <input type="checkbox" id="chkEstado" name="chkEstado"
                                               class="switchery" checked="checked" >
                                        <span id="lblchk">VIGENTE</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>

                <div class="modal-footer">
                    <button id="btnGuardar" type="submit" class="btn btn-primary">Guardar</button>
                    <button id="btnEditar" type="submit" class="btn btn-warning">Editar</button>
                    <button  type="reset" class="btn btn-default" id="reset"
                             class="btn btn-link" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Iconified modal -->
<div id="modal_iconified_barcode" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title"><i class="icon-printer"></i> &nbsp; <span class="title-form"></span></h5>
            </div>

            <form role="form" autocomplete="off" class="form-validate-jquery" id="frmPrint">
                <div class="modal-body" id="modal-container">

                    <div class="alert alert-info alert-styled-left text-blue-800 content-group">
                        <span class="text-semibold">Estimado usuario</span>
                        Los campos remarcados con <span class="text-danger"> * </span> son necesarios.
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <input type="hidden" id="txtIDP" name="txtIDP" class="form-control" value="">
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <label>Barra</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="icon-barcode2"></i></span>
                                    <input type="text" id="txtCodigoBarraP" name="txtCodigoBarraP"
                                           placeholder="0108580848408"
                                           class="form-control" style="text-transform:uppercase;"
                                           onkeyup="javascript:this.value = this.value.toUpperCase();">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <label>Producto <span class="text-danger">*</span></label>
                                <input type="text" id="txtProductoP" name="txtProductoP" placeholder="EJ. BOTE DE MAYONESA HELLMANS"
                                       class="form-control" style="text-transform:uppercase;"
                                       onkeyup="javascript:this.value = this.value.toUpperCase();">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <label>Cantidad de etiquetas<span class="text-danger">*</span></label>
                                <input type="text" id="txtCant" name="txtCant" placeholder="0.00"
                                       class="touchspin-prefix" style="text-transform:uppercase;"
                                       onkeyup="javascript:this.value = this.value.toUpperCase();">
                            </div>

                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">

                            <div class="col-sm-6">
                                <label>Ancho de etiqueta (mm)<span class="text-danger">*</span></label>
                                <input type="text" id="txtAncho" name="txtAncho"
                                       placeholder="EJ. 14.00"
                                       class="touchspin-prefix" style="text-transform:uppercase;"
                                       onkeyup="javascript:this.value = this.value.toUpperCase();">
                            </div>

                            <div class="col-sm-6">
                                <label>Alto de etiqueta (mm)<span class="text-danger">*</span></label>
                                <input type="text" id="txtAlto" name="txtAlto"
                                       placeholder="EJ. 1.00"
                                       class="touchspin-prefix" style="text-transform:uppercase;"
                                       onkeyup="javascript:this.value = this.value.toUpperCase();">
                            </div>

                        </div>
                    </div>


                </div>

                <div class="modal-footer">
                    <button id="btnPrint" type="submit" class="btn btn-info">Imprimir</button>
                    <button  type="reset" class="btn btn-default" id="reset"
                             class="btn btn-link" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript" src="web/custom-js/producto.js"></script>
