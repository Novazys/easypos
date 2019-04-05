function cargarDiv(div,url)
{
      $(div).load(url);
}

$(function() {

    var urlprocess = 'web/ajax/ajxinventario.php';
    var proceso = 'Validar';
    var dataString='proceso='+proceso;

    $.ajax({
       type:'POST',
       url:urlprocess,
       data: dataString,
       dataType: 'json',
       success: function(data){

       	 if(data=="Validado"){

       	 	cargarDiv("#reload-div","web/ajax/reload-closeinventario.php");

        } else if (data=="0") {

          cargarDiv("#reload-div","web/ajax/reload-0productos.php");

        } else if (data=="No Existe"){

            /* swal({
                    title: "Debes Abrir Inventario!",
                    text: "El Inventario no se encuentra vigente",
                    confirmButtonColor: "#EF5350",
                    imageUrl: "web/assets/images/cube.png"
             });*/


             cargarDiv("#reload-div","web/ajax/reload-openinventario.php");

          } else if(data =="Error"){

                 swal({
                  title: "Lo sentimos...",
                  text: "No procesamos bien tus datos!",
                  confirmButtonColor: "#EF5350",
                  type: "error"
              });
          }

       },error: function() {

           swal({
              title: "Lo sentimos...",
              text: "Algo sucedio mal!",
              confirmButtonColor: "#EF5350",
              type: "error"
          });


       }

    });


});


function AbrirInventario(){

	 var urlprocess = 'web/ajax/ajxinventario.php';
	  var proceso = 'Abrir';
	  var dataString='proceso='+proceso;

	  $.ajax({
	     type:'POST',
	     url:urlprocess,
	     data: dataString,
	     dataType: 'json',
	     success: function(data){

	        if(data=="Validado"){

             swal({
                  title: "Exito!",
                  text: "Inventario abierto",
                  confirmButtonColor: "#66BB6A",
                  imageUrl: "web/assets/images/unlock.png"
              });

			  cargarDiv("#reload-div","web/ajax/reload-closeinventario.php");

	        } else if (data=="Vigente"){




 				cargarDiv("#reload-div","web/ajax/reload-closeinventario.php");

	        } else if(data =="Error"){

	               swal({
	                title: "Lo sentimos...",
	                text: "No procesamos bien tus datos!",
	                confirmButtonColor: "#EF5350",
	                type: "error"
	            });
	        }

	     },error: function() {

	         swal({
	            title: "Lo sentimos...",
	            text: "Algo sucedio mal!",
	            confirmButtonColor: "#EF5350",
	            type: "error"
	        });


	     }

	  });

}


function CerrarInventario(){

	 var urlprocess = 'web/ajax/ajxinventario.php';
	  var proceso = 'Cerrar';
	  var dataString='proceso='+proceso;

	  $.ajax({
	     type:'POST',
	     url:urlprocess,
	     data: dataString,
	     dataType: 'json',
	     success: function(data){

	        if(data=="CERRADO"){

			swal({
                  title: "Exito!",
                  text: "Inventario CERRADO",
                  confirmButtonColor: "#66BB6A",
                  imageUrl: "web/assets/images/cube.png"
              });

			  cargarDiv("#reload-div","web/ajax/reload-openinventario.php");

	        } else if (data=="Vigente"){

 				cargarDiv("#reload-div","web/ajax/reload-openinventario.php");

	        } else if(data =="Error"){

	               swal({
	                title: "Lo sentimos...",
	                text: "No procesamos bien tus datos!",
	                confirmButtonColor: "#EF5350",
	                type: "error"
	            });
	        }

	     },error: function() {

	         swal({
	            title: "Lo sentimos...",
	            text: "Algo sucedio mal!",
	            confirmButtonColor: "#EF5350",
	            type: "error"
	        });


	     }

	  });

}
