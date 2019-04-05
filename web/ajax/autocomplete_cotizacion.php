<?php

function __autoload($className){
  $model = "../../model/". $className ."_model.php";
  $controller = "../../controller/". $className ."_controller.php";

  require_once($model);
  require_once($controller);
}

 $funcion = new Cotizacion();

 $keyword = trim($_REQUEST['term']);


 $funcion->Autocomplete_Producto($keyword);


?>
