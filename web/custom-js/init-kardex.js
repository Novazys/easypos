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

           cargarDiv("#reload-full-div","web/ajax/reload-openkardex.php");

         } else if (data=="No Existe" || data =="0"){

             swal({
                    title: "Debes Abrir Inventario!",
                    text: "El Inventario no se encuentra vigente",
                    confirmButtonColor: "#EF5350",
                    imageUrl: "web/assets/images/cube.png"
             });


             cargarDiv("#reload-full-div","web/ajax/reload-closekardex.php");

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
