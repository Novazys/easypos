<?php

	function __autoload($className){
		$model = "../../model/". $className ."_model.php";
		$controller = "../../controller/". $className ."_controller.php";

		require_once($model);
		require_once($controller);
	}

	$objTecnico =  new Tecnico();

 ?>
 <table class="table datatable-basic table-xxs table-hover">
   <thead>
     <tr>
       <th>No</th>
       <th>Tecnico</th>
       <th>Telefono</th>
       <th>Estado</th>
       <th class="text-center">Opciones</th>
     </tr>
   </thead>

   <tbody>

     <?php
       $filas = $objTecnico->Listar_Tecnicos();
       if (is_array($filas) || is_object($filas))
       {
       foreach ($filas as $row => $column)
       {
         $telefono = $column['telefono'];
         $telefono = substr($telefono, 0, 4).'-'.substr($telefono, 4, 4);
       ?>
         <tr>
                   <td><?php print($column['idtecnico']); ?></td>
                   <td><?php print($column['tecnico']); ?></td>
                   <td><?php print($telefono); ?></td>
                   <td><?php if($column['estado'] == '1')
                     echo '<span class="label label-success label-rounded"><span
                     class="text-bold">VIGENTE</span></span>';
                     else
                     echo '<span class="label label-default label-rounded">
                   <span
                       class="text-bold">DESCONTINUADO</span></span>'
                   ?></td>
                   <td class="text-center">
           <ul class="icons-list">
             <li class="dropdown">
               <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                 <i class="icon-menu9"></i>
               </a>

               <ul class="dropdown-menu dropdown-menu-right">
                 <li><a
                 href="javascript:;" data-toggle="modal" data-target="#modal_iconified"
                 onclick="openPresentacion('editar',
                            '<?php print($column["idtecnico"]); ?>',
                            '<?php print($column["tecnico"]); ?>',
                            '<?php print($telefono); ?>',
                            '<?php print($column["estado"]); ?>')">
                  <i class="icon-pencil6">
                    </i> Editar</a></li>
                 <li><a
                 href="javascript:;" data-toggle="modal" data-target="#modal_iconified"
                 onclick="openPresentacion('ver',
                            '<?php print($column["idtecnico"]); ?>',
                            '<?php print($column["tecnico"]); ?>',
                            '<?php print($telefono); ?>',
                            '<?php print($column["estado"]); ?>')">
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
 </table>

<script type="text/javascript" src="web/custom-js/tecnico.js"></script>
