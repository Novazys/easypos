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

         if (data=="No Existe"){

             swal({
                    title: "Debes Abrir Inventario!",
                    text: "El Inventario no se encuentra abierto",
                    confirmButtonColor: "#EF5350",
                    type: "warning"
             },
              function() {
                  setTimeout(function() {
                     window.location.href = "?View=Abrir-Inventario";
                  }, 1200);
              });


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




    jQuery.validator.addMethod("greaterThan",function (value, element, param) {
      var $min = $(param);
      if (this.settings.onfocusout) {
        $min.off(".validate-greaterThan").on("blur.validate-greaterThan", function () {
          $(element).valid();
        });
      }return parseInt(value) > parseInt($min.val());}, "Maximo debe ser mayor a minimo");

    jQuery.validator.addMethod("lettersonly", function(value, element) {
        return this.optional(element) || /^[a-z\s, . ()]+$/i.test(value);
    }, "No se permiten caracteres especiales");


     var validator = $("#frmModal").validate({

      ignore: '.select2-search__field', // ignore hidden fields
      errorClass: 'validation-error-label',
      successClass: 'validation-valid-label',

      highlight: function(element, errorClass) {
          $(element).removeClass(errorClass);
      },
      unhighlight: function(element, errorClass) {
          $(element).removeClass(errorClass);
      },
      // Different components require proper error label placement
      errorPlacement: function(error, element) {

        // Input with icons and Select2
         if (element.parents('div').hasClass('has-feedback') || element.hasClass('select2-hidden-accessible')) {
              error.appendTo( element.parent() );
          }

         // Input group, styled file input
          else if (element.parent().hasClass('uploader') || element.parents().hasClass('input-group')) {
              error.appendTo( element.parent().parent() );
          }

        else {
            error.insertAfter(element);
        }

      },

      rules: {
        txtFechaC:{
          required: true
        },
        txtNoCompro:{
          required:true
        },
        cbPago:{
          required:true
        },
        cbCompro:{
          required:true
        },
        cbProveedor:{
          required:true
        }
      },
        messages: {
            cbPago: {
                required: "Seleccione una opcion",
            },
            cbCompro: {
                required: "Seleccione una opcion",
            },
            txtNoCompro:{
               required: "Rellene el campo"
            },
            txtFechaC: {
              required : "Ingrese una fecha"
            }
        },
    validClass: "validation-valid-label",
     success: function(label) {
          label.addClass("validation-valid-label").text("Correcto.")
      },
       submitHandler: function (form) {
         enviar_data();
        }
     });


    var form = $('#frmModal');
   $('#cbPago', form).change(function () {
        form.validate().element($(this)); //revalidate the chosen dropdown value and show error or success message for the input
    });
   $('#cbProveedor', form).change(function () {
        form.validate().element($(this)); //revalidate the chosen dropdown value and show error or success message for the input
    });
   $('#cbCompro', form).change(function () {
        form.validate().element($(this)); //revalidate the chosen dropdown value and show error or success message for the input
    })


  $('#txtFechaC').datetimepicker({
        locale: 'es',
        format: 'DD/MM/YYYY',
        minDate: moment().startOf('month'),
 		    maxDate: moment().endOf('month')

  });

	  $('.select-size-xs').select2({
        containerCssClass: 'select-xs'
    });

    $("#txtFechaC").val("");
    $("#txtNoCompro").val("");
    $("#buscar_producto").val("");


    $.getJSON('web/ajax/ajxparametro.php?criterio=moneda',function(data){

      $.each(data,function(key,val){
        var moneda = val.CurrencyISO + ' ' + val.Symbol;
          $("#big_total").html(moneda + ' 0.00');
      });



    });



    $("#totales_foot").hide();
    $("#btnguardar").hide();
    $("#btncancelar").hide();

});


//---------************* Agrego al detalle
function agergar_detalle(idproducto,producto,datos,precio_compra,cantidad,exento,perecedero){

    var tr_add="";
    var id_previo = new Array();
    var filas=0;

      $("#tbldetalle tr").each(function (index){

         if (index>0){

         var campo0, campo1;
          $(this).children("td").each(function (index2){

            switch(index2){

            case 0:
            campo0 = $(this).text();
            if(campo0!=undefined || campo0!=''){
                id_previo.push(campo0);
            }
            break;

            case 1:
            break;

            case 2:
            break;

            case 3:
            break;

            case 4:
            break;

            case 5:
            break;

            } // end switch index 2

          }); // end each td

           filas=filas+1;

         } // if index > 0

      }); // end each tbldetalle tr

      if(perecedero == 1)
      {
         tr_add += '<tr>';
         tr_add += '<td align="center">'+idproducto+'</td>';
         tr_add += '<td><h8 class="no-margin">'+producto+'</h8><br>'+
        '<span class="text-muted">'+datos+'</span></td>';
         tr_add += '<td width="5%"><input type="text" id="tblcant" name="tblcant" value="1.00" class="touchspin" style="width:70px;"></td>';
         tr_add += '<td align="center">'+precio_compra+'</td>';
         tr_add += '<td align="center">'+exento+'</td>';
         tr_add += '<td align="center">'+precio_compra+'</td>';
         tr_add += '<td align="center" class="Delete"><button type="button"class="btn btn-danger btn-xs"><i class="icon-trash-alt"></i></button></td>';
         tr_add += '<td align="center"><input type="text" class="form-control input-xs input-date" id="tblvence"'+
        'name="tblvence" style="width:90px;"></td>';
         tr_add += '</tr>';

        var existe = false;
        var posicion_fila = 0;

        $.each(id_previo, function(i,id_prod_ant){
            if(idproducto==id_prod_ant){
              existe = true;
              posicion_fila=i;
          }
        });

          $("#tbldetalle").append(tr_add);
          $("input[name='tblcant']").TouchSpin({
              verticalbuttons: true,
              verticalupclass: 'icon-arrow-up22',
              verticaldownclass: 'icon-arrow-down22',
              min: 0.01,
              max: 100000000,
              step: 0.01,
              decimals: 2,
          }).on('touchspin.on.startspin', function () {totales()});
          new PNotify({
              text: 'Producto agregado al detalle.',
              addclass: "stack-bottom-right bg-primary",
          });


          $('.input-date').datetimepicker({
                  locale: 'es',
                  format: 'DD/MM/YYYY',
                  minDate: moment().add(10,"days")

            });

          totales();

      } else {

         tr_add += '<tr>';
         tr_add += '<td align="center">'+idproducto+'</td>';
         tr_add += '<td><h8 class="no-margin">'+producto+'</h8><br>'+
        '<span class="text-muted">'+datos+'</span></td>';
         tr_add += '<td width="5%"><input type="text" id="tblcant" name="tblcant" value="1.00" class="touchspin" style="width:70px;"></td>';
         tr_add += '<td align="center">'+precio_compra+'</td>';
         tr_add += '<td align="center">'+exento+'</td>';
         tr_add += '<td align="center">'+precio_compra+'</td>';
         tr_add += '<td align="center" class="Delete"><button type="button"class="btn btn-danger btn-xs"><i class="icon-trash-alt"></i></button></td>';
         tr_add += '<td align="center">/</td>';
         tr_add += '</tr>';

        var existe = false;
        var posicion_fila = 0;

        $.each(id_previo, function(i,id_prod_ant){
            if(idproducto==id_prod_ant){
              existe = true;
              posicion_fila=i;
          }
        });

        if(existe==false){
          $("#tbldetalle").append(tr_add);
          $("input[name='tblcant']").TouchSpin({
              verticalbuttons: true,
              verticalupclass: 'icon-arrow-up22',
              verticaldownclass: 'icon-arrow-down22',
              min: 0.01,
              max: 100000000,
              step: 0.01,
              decimals: 2,
          }).on('touchspin.on.startspin', function () {totales()});
          new PNotify({
              text: 'Producto agregado al detalle.',
              addclass: "stack-bottom-right bg-primary",
          });


          $('.input-date').datetimepicker({
                  locale: 'es',
                  format: 'DD/MM/YYYY',
                  minDate: moment().add(10,"days")

            });

          totales();
          //limpiar_producto();
        } else if(existe==true) {
           posicion_fila=posicion_fila+1;
           new PNotify({
              text: 'Este producto ya existe en el detalle.',
              addclass: "stack-bottom-right bg-warning",
              type: 'error'
          });
          //limpiar_producto();
        }

      }






}

    //Autocomplete
   $("#buscar_producto").autocomplete({
        minLength: 1,
        source: "web/ajax/autocomplete_producto.php",
        focus: function( event, ui ) {
            $("#buscar_producto").val(ui.item.label);
            return false;
        },
        select: function( event, ui ) {
            var idproducto = ui.item.value;
            var producto = ui.item.producto;
            var precio_compra = ui.item.precio_compra;
            var datos = ui.item.datos;
            var exento = ui.item.exento;
            var perecedero = ui.item.perecedero;

            if(exento == 0)
            {
              agergar_detalle(idproducto,producto,datos,precio_compra,1,0.00,perecedero);
              validar_siexistefilas();
            } else if (exento == 1){
              agergar_detalle(idproducto,producto,datos,precio_compra,1,precio_compra,perecedero);
              validar_siexistefilas();
            }

            $(this).val("");
            return false;
        },
        open: function(event, ui) {
                 $(".ui-autocomplete").css("z-index", 1000)
        },
    })
    .autocomplete("instance")._renderItem = function(ul, item) {
        return $("<li>").append("<span class='text-semibold'>" + item.label + '</span>' + "<br>" + '<span class="text-muted text-size-small">' + item.datos + '</span>').appendTo(ul);
    };

// Evento que selecciona la fila y la elimina de la tabla
$(document).on("click",".Delete",function(){
  var parent = $(this).parents().get(0);
  $(parent).remove();
  totales();
  validar_siexistefilas();
});



  $(document).on("focusout","#tblcant",function(){
        totales();

  })

  //---------************* Totales

function totales(){


  var total_sumas=0; total_exentos=0; total_iva = 0; subtotal=0; sumas = 0; iva = 0; subtotal = 0;exentos = 0; total=0;
  var iva_retenido = 0; iva_exento = 0; total_iva_exento = 0; porc_rete=0;

 $.getJSON('web/ajax/ajxparametro.php?criterio=moneda',function(data){

   $.each(data,function(key,val){

     var moneda = val.CurrencyISO + ' ' + val.Symbol;

       $.getJSON('web/ajax/ajxparametro.php?criterio=iva',function(data){

          $.each(data,function(key,val){

              var valor_iva = val.porcentaje_iva;
              var monto_retencion = val.monto_retencion;
              var porcentaje_retencion = val.porcentaje_retencion;

              iva = valor_iva / 100;
              porc_rete = porcentaje_retencion / 100;

          $("#tbldetalle tbody tr").each(function (index)
              {
                  var campo1, campo2, campo3, campo4, campo5, campo6, campo7, campo8, campo9, campo10, campo11;
                  $(this).children("td").each(function (index2)
                  {
                      switch (index2)
                      {
                          case 0:  campo0 = $(this).text();
                                   break;
                          case 1:  campo1 = $(this).text();
                                   break;
                          case 2:  campo2 = $(this).find("#tblcant").val();
                                   campo2 = parseFloat(campo2);
                                   break;

                          case 3:  campo3 = $(this).text();
                                   campo3 = parseFloat(campo3);
                                   break;

                          case 4:  campo4 = $(this).text();
                                   campo4 = parseFloat(campo4);
                                   if(campo4!=0.00)
                                   {
                                   campo4 = campo2 * campo3;
                                   exentos = parseFloat(campo4);
                                   if(isNaN(exentos)){exentos = 0.00;}
                                   $(this).text(exentos.toFixed(2));
                                   } else {
                                     exentos = parseFloat(campo4);
                                     if(isNaN(exentos)){exentos = 0.00;}
                                     $(this).text(exentos.toFixed(2));
                                   }
                                   break;


                          case 5:  campo5 = campo2 * campo3;
                                  sumas = parseFloat(campo5);
                                  if(isNaN(sumas)){sumas = 0.00;}
                                  $(this).text(sumas.toFixed(2));
                                   break;
                          case 6:  campo6 = $(this).text();
                                   break;



                      }
                    //  $(this).css("background-color", "#ECF8E0");
                  })

                    if(isNaN(sumas)){sumas = 0.00;}
                    if(isNaN(exentos)){exentos = 0.00;}

                    if(sumas==''){sumas = 0.00;}
                    if(exentos==''){exentos = 0.00;}


                    total_exentos = total_exentos + exentos;
                    total_sumas = (total_sumas + sumas - exentos);

                   if(total_sumas >= monto_retencion){

                    total_iva = total_sumas * iva;
                    subtotal = total_sumas + total_iva;
                    iva_retenido = total_sumas * porc_rete;
                    total = subtotal - iva_retenido + total_exentos;

                  } else {

                    total_iva = total_sumas * iva;
                    subtotal = total_sumas + total_iva;
                    total = subtotal + total_exentos;
                  }



                //  alert(campo1 + ' - ' + campo2 + ' - ' + campo3 + ' - ' + campo4);
              })

              if(isNaN(total_sumas)){total_sumas = 0.00;}
              if(isNaN(total_iva)){total_iva = 0.00;}
              if(isNaN(subtotal)){subtotal = 0.00;}
              if(isNaN(iva_retenido)){iva_retenido = 0.00;}
              if(isNaN(total)){total = 0.00;}


              $("#sumas").html(total_sumas.toFixed(2));
              $("#iva").html(total_iva.toFixed(2));
              $("#subtotal").html(subtotal.toFixed(2));
              $("#ivaretenido").html(iva_retenido.toFixed(2));
              $("#exentas").html(total_exentos.toFixed(2));
              $("#total").html(total.toFixed(2));
              $("#big_total").html(moneda+' '+ $.number(total, 2 ));

            });

          });

      });

  });


}

//---------************* Totales

function validar_siexistefilas(){

  if ($('#tbldetalle >tbody >tr').length > 0){
       $("#btncancelar").show();
       $("#btnguardar").show();
       $("#totales_foot").show();
  } else if($('#tbldetalle >tbody >tr').length ==0){
       $("#btncancelar").hide();
       $("#totales_foot").hide();
       $("#btnguardar").hide();
  }

}

$("#btncancelar").click(function(){

        swal({
            title: "¿Está seguro que desea cancelar la Compra?",
            text: "Se eliminaran todos los datos que ya ingreso!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#EF5350",
            confirmButtonText: "Si, cancelar",
            cancelButtonText: "No, deseo continuar",
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function(isConfirm){
            if (isConfirm) {
                swal({
                    title: "Cancelado!",
                    text: "Su proceso fue cancelado con exito.",
                    confirmButtonColor: "#66BB6A",
                    type: "success"
                },
                function() {
                    setTimeout(function() {
                        location.reload();
                    }, 1200);
                });
            }
            else {
                swal({
                    title: "Esta bien",
                    text: "Puedes seguir donde te quedaste",
                    confirmButtonColor: "#2196F3",
                    type: "info"
                });
            }
        });
});

//---------************* Enviar datos y guardar compra

// Dark
$('#btnguardar').on('click', function() {

});



function enviar_data(){

   var dark1 = $("#panel-cobro");
    $(dark1).block({
        message: '<i class="icon-spinner spinner"></i>',
        overlayCSS: {
            backgroundColor: '#fff',
            opacity: 0.8,
            cursor: 'wait'
        },
        css: {
            border: 0,
            padding: 0,
            backgroundColor: 'none'
        }
    });

   var dark2 = $("#panel-detalle");
    $(dark2).block({
        message: '<i class="icon-spinner spinner"></i>',
        overlayCSS: {
            backgroundColor: '#fff',
            opacity: 0.8,
            cursor: 'wait'
        },
        css: {
            border: 0,
            padding: 0,
            backgroundColor: 'none'
        }
    });

  var i=0;
  var StringDatos="";
  var idproveedor = $("#cbProveedor").val();
  var comprobante = $("#cbCompro").val();
  var numero_comprobante = $("#txtNoCompro").val();
  var fecha_comprobante = $("#txtFechaC").val();
  var tipo_pago = $("#cbPago").val();
  var sumas = $("#sumas").text();
  var iva = $("#iva").text();
  var exento = $("#exentas").text();
  var retenido = $("#ivaretenido").text();
  var total = $("#total").text();

  var cantidad = 0;
  var precio_unitario = 0;
  var ventas_nosujetas = 0;
  var exentos = 0;
  var importe = 0;
  var fecha_vence = "";

    $("#tbldetalle tbody tr").each(function (index)
        {
            var campo1, campo2, campo3, campo4, campo5, campo6;
            $(this).children("td").each(function (index2)
            {
                switch (index2)
                {

                    case 0:  campo0 = $(this).text();
                             break;
                    case 1:  campo1 = $(this).text();
                             break;
                    case 2:  campo2 = $(this).find("#tblcant").val();
                             cantidad = parseFloat(campo2);
                             break;

                    case 3:  campo3 = $(this).text();
                             precio_unitario = parseFloat(campo3);
                             break;

                    case 4:  campo4 = $(this).text();
                             exentos = parseFloat(campo4);
                             break;

                    case 5:  campo5 = campo2 * campo3;
                             importe = parseFloat(campo5);
                             $(this).text(campo5.toFixed(2));
                             break;
                    case 6:  campo6 = $(this).text();
                             break;

                    case 7: campo7 = $(this).find("#tblvence").val();
                            if (undefined === campo7){
                              fecha_vence = "/";
                             } else {
                              fecha_vence = campo7;
                             }
                            break;


                }
              //  $(this).css("background-color", "#ECF8E0");
            })

        if(campo0!=""|| campo0==undefined || isNaN(campo0)==false && cantidad > 0){
        StringDatos+=campo0+"|"+cantidad+"|"+precio_unitario+"|"+exentos+"|"+fecha_vence+"|"+importe+"#";
        i=i+1;
        }

     })

        var dataString='comprobante='+comprobante+'&numero_comprobante='+numero_comprobante+'&fecha_comprobante='+fecha_comprobante;
        dataString+='&tipo_pago='+tipo_pago+'&idproveedor='+idproveedor+'&sumas='+sumas+'&iva='+iva;
        dataString+='&retenido='+retenido+'&exento='+exento+'&total='+total+'&accion=Cabeza';

        var list = 'stringdatos='+StringDatos+'&cuantos='+i+'&accion=Detalle';

        if(total > 0){


            $.ajax({

            type:'POST',
            url:'web/ajax/ajxcompra.php',
            data: dataString,
            cache: false,
            dataType: 'json',
            success: function(data){

              if(data=="Validado"){

                $.ajax({

                type:'POST',
                url:'web/ajax/ajxcompra.php',
                data: list,
                cache: false,
                success: function(){

                      swal({
                        title: "Exito!",
                        text: "Compra registrada!",
                        confirmButtonColor: "#4CAF50",
                        imageUrl: "web/assets/images/trolley.png"
                      });

                      setTimeout(function() {
                          location.reload();
                           $(dark1).unblock();
                           $(dark2).unblock();
                      }, 800);

                },error: function() {

                  swal("Ups! Ocurrio un error","Algo salio mal al procesar tu peticion","error");
                        $(dark1).unblock();
                        $(dark2).unblock();
                  }


                }); // Detalle Ajax

              } else if (data == "Duplicado"){

                swal('Lo sentimos, ya existe una compra con este comprobante y fecha!', "Intentalo nuevamente", "warning");

                $(dark1).unblock();
                $(dark2).unblock();

              } else {

                swal('Lo sentimos, no pudimos registrar tu informacion!', "Intentalo nuevamente", "error");
                $(dark1).unblock();
                $(dark2).unblock();
              }
            },error: function() {

               swal("Ups! Ocurrio un error","Algo salio mal al procesar tu peticion","error");
                $(dark1).unblock();
                $(dark2).unblock();
          }


        });


        } else {

           swal("Imposible","No se puede registrar una compra con valor 0.00","warning");
           $(dark1).unblock();
           $(dark2).unblock();
        }

}
