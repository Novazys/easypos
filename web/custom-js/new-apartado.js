$(function() {

  $(".switch").bootstrapSwitch();
  //
  // Single select with icons
  //

  $('#txtFechaR').datetimepicker({
        locale: 'es',
        format: 'DD/MM/YYYY HH:mm:ss',
        minDate: moment()
  });

  // Format icon
  function iconFormat(icon) {
      var originalOption = icon.element;
      if (!icon.id) { return icon.text; }
      var $icon = "<i class='icon-" + $(icon.element).data('icon') + "'></i>" + icon.text;

      return $icon;
  }

  // Initialize with options
    $(".select-icons").select2({
        containerCssClass: 'bg-teal-400',
        templateResult: iconFormat,
        minimumResultsForSearch: Infinity,
        templateSelection: iconFormat,
        escapeMarkup: function(m) { return m; }
    });

    // Initialize with options
    $(".select-icons-search").select2({
        containerCssClass: 'bg-info-400',
        templateResult: iconFormat,
        minimumResultsForSearch: Infinity,
        templateSelection: iconFormat,
        escapeMarkup: function(m) { return m; }
    });

    $("#txtMonto").TouchSpin({
        min: 0.00,
        max: 100000000,
        step: 0.01,
        decimals: 2
    });

    $("#txtMontoTar").TouchSpin({
      min: 0.00,
      max: 100000000,
      step: 0.01,
      decimals: 2,
      prefix: '<i class="icon-credit-card2"></i>'
    });


    var urlprocess1 = 'web/ajax/ajxcaja.php';
    var urlprocess2 = 'web/ajax/ajxinventario.php';
    var proceso = 'Validar';
    var dataString='proceso='+proceso;


    $.ajax({
       type:'POST',
       url:urlprocess1,
       data: dataString,
       dataType: 'json',
       success: function(data){

         if (data=="Cerrada"){

             swal({
                      title: "Debes Abrir Caja!",
                      text: "No tienes registrado efectivo para movimientos",
                      confirmButtonColor: "#EF5350",
                      imageUrl: "web/assets/images/atm.png"
              },
              function() {
                  setTimeout(function() {
                     window.location.href = "?View=Caja";
                  }, 1200);
              });


          } else if (data == "Abierta"){

              $.ajax({
                 type:'POST',
                 url:urlprocess2,
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


    jQuery.validator.addMethod("greaterThan",function (value, element) {
      var $min = $("#txtDeuda");
      if (this.settings.onfocusout) {
        $min.off(".validate-greaterThan").on("blur.validate-greaterThan", function () {
          $(element).valid();
        });
      }return parseFloat(value) >= parseFloat($min.val());}, "Debe ser mayor a deuda");


     var validator = $("#frmPago").validate({

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

        txtMonto:{
         required: true
        },
        txtFechaR:{
          required: true
        },
        cbCliente:{
            required: true
        },
      },
      messages: {
          txtMonto: {
              required: "Ingrese cantidad",
          },
          txtFechaR: {
              required: "Ingrese fecha de retiro",
          }
      },

    validClass: "validation-valid-label",
     /*success: function(label) {
          label.addClass("validation-valid-label").text("Correcto.")
      },*/
       submitHandler: function (form) {
         enviar_data();

        }
     })

    var form = $('#frmPago');
     $('#cbCliente', form).change(function () {
          form.validate().element($(this)); //revalidate the chosen dropdown value and show error or success message for the input
      });

     $('#cbComprop', form).change(function () {
          form.validate().element($(this)); //revalidate the chosen dropdown value and show error or success message for the input
      });

      function limpiarform(){
        var form = $( "#frmPago" ).validate();
        form.resetForm();
      }



//**-------- Instanciando Select Cliente
    $('.select-size-xs').select2();
    $("#cbCliente").select2("val", "All");
    $('#cbCliente').change(function() {
      var cliente = $('#cbCliente').val();
      $.getJSON('web/ajax/ajxcliente.php?cliente='+cliente,function(data){
         $.each(data,function(key,val){
           var limite_credito = val.limite_credito;
           $("#txtLimitC").val(limite_credito);
             if($("#chkPagado").prop('checked') == false){
               Venta_Credito();
             }
         });
       });
    });

    $('#txtNoTarjeta').mask('0000-0000-0000-0000');
        $("#buscar_producto").val("");
        $.getJSON('web/ajax/ajxparametro.php?criterio=moneda',function(data){
          $.each(data,function(key,val){
            var moneda = val.CurrencyISO + ' ' + val.Symbol;
              $("#big_total").html(moneda + ' 0.00');
          });
        });
        $("#totales_foot").hide();
        $("#div-txtNoTarjeta").prop("disabled",true);
        $("#div-txtNoTarjeta").hide();
        $("#div-txtHabiente").prop("disabled",true);
        $("#div-txtHabiente").hide();
        $("#div-txtMontoTar").prop("disabled",true);
        $("#div-txtMontoTar").hide();

        $("#btnguardar").hide();
        $("#btncancelar").hide();



    $('#cbMPago').change(function() {

      if($("#chkPagado").prop('checked') == false){
        Venta_Credito();
      } else {
        Venta_Contado();
      }

      if (this.value == '1') {
        $("#txtMonto").val('');
        $("#txtMonto").prop("disabled",false);
        $("#div-txtNoTarjeta").prop("disabled",true);
        $("#div-txtNoTarjeta").hide();
        $("#div-txtHabiente").prop("disabled",true);
        $("#div-txtHabiente").hide();
        $("#div-txtMontoTar").prop("disabled",true);
        $("#div-txtMontoTar").hide();
        limpiarform();
        $("#btnRegistrar").prop("disabled",false);
        $("#txtMonto").change(function(){
            Cambio_Venta();
        });
    } else if (this.value == '2') {
        $("#txtMonto").val('');
        $("#txtMonto").prop("disabled",true);
        $("#txtCambio").val('');
        $("#txtCambio").prop("disabled",true);
        $("#div-txtNoTarjeta").prop("disabled",false);
        $("#div-txtNoTarjeta").show();
        $("#div-txtHabiente").prop("disabled",false);
        $("#div-txtHabiente").show();
        $("#txtMontoTar").prop("disabled",true);
        $("#div-txtMontoTar").show();
        $("#txtHabiente").val('');
        $("#txtNoTarjeta").val('');
        $("#txtMontoTar").val($("#txtDeuda").val());
        limpiarform();

      } else if (this.value == '3') {
          $("#txtMonto").change(function(){
              mitad_pago();
          });
          $("#txtMontoTar").change(function(){
              mitad_pago();
          });
          $("#txtMonto").val('');
          $("#txtMonto").prop("disabled",false);
          $("#txtCambio").val('0.00');
          $("#txtCambio").prop("disabled",true);
          $("#div-txtNoTarjeta").prop("disabled",false);
          $("#div-txtNoTarjeta").show();
          $("#div-txtHabiente").prop("disabled",false);
          $("#div-txtHabiente").show();
          $("#txtMontoTar").prop("disabled",false);
          $("#div-txtMontoTar").show();
          $("#txtHabiente").val('');
          $("#txtNoTarjeta").val('');
          $("#txtMontoTar").val('');
          limpiarform();
        }
    });

    buscar_por_codigo();

}); // end function ready

var mySwitch = new Switchery($('#chkBusqueda')[0], {
    size:"small",
    color: '#1fccef',
    secondaryColor: '#0095f2'
});

function limpiarform(){
  var form = $( "#frmPago" ).validate();
  form.resetForm();
}

function Cambio_Venta(){
    var deuda = 0;
    var pago = 0;
    var cambio = 0;
    deuda = $("#txtDeuda").val();
    pago = $("#txtMonto").val();
    cambio = parseFloat(pago - deuda);
    $("#txtCambio").val(cambio.toFixed(2));

  if($("#chkPagado").prop('checked') == false){
     $("#txtCambio").val('0.00');
  } else {
    if(parseFloat(pago) <  parseFloat(deuda)){
      $("#btnRegistrar").prop("disabled",false);
    } else {
      $("#btnRegistrar").prop("disabled",true);
    }
  }
}

$('#modal_iconified_cash').on('shown.bs.modal', function (e) {
  $("#txtMonto").change(function(){
      Cambio_Venta();
  });
});


$('#modal_iconified_cash').on('hidden.bs.modal', function () {
    $("#cbCliente").select2("val", "All");
    $("#txtLimitC").val("");
  //  $("#txtDeuda").val('');
    $("#txtMonto").val('');
    $("#txtCambio").val('');
    $("#txtNoTarjeta").val('');
    $("#txtHabiente").val('');
    $("#txtMontoTar").val('');
    limpiarform();
})

function mitad_pago(){
  var deuda =  $("#txtDeuda").val();
  var pago_efectivo = $("#txtMonto").val();
  var pago_tarjeta = $("#txtMontoTar").val();
  var sumatoria = 0;

  if(pago_tarjeta == ''){
    pago_tarjeta = 0.00
  }

  if(pago_efectivo == ''){
    pago_efectivo = 0.00
  }

  sumatoria = parseFloat(pago_efectivo) + parseFloat(pago_tarjeta);
  sumatoria = sumatoria.toFixed(2);

  if($("#chkPagado").prop('checked') == true){
      if(parseFloat(sumatoria)  >  parseFloat(deuda) || parseFloat(sumatoria)  <  parseFloat(deuda)){
        $("#btnRegistrar").prop("disabled",true);
        $("#txtCambio").val('0.00');
      } else if (parseFloat(sumatoria)  ==  parseFloat(deuda)) {
        $("#btnRegistrar").prop("disabled",false);
        $("#txtCambio").val('0.00');
      }
  }

}




//---- Controles que se Deshabilitan al venta al credito
function Venta_Credito(){

  var limite_credito = $("#txtLimitC").val();
  var monto_deudor = $("#txtDeuda").val()

  if(parseFloat(monto_deudor) > parseFloat(limite_credito) || parseFloat(limite_credito) == 0.00 || limite_credito == ''){
    $("#btnRegistrar").prop("disabled",true);
  } else {
    $("#btnRegistrar").prop("disabled",false);
  }

  $("#cbMPago").prop("disabled",true);
  $("#txtMonto").prop("disabled",true);
  $("#txtCambio").prop("disabled",true);
  $("#txtNoTarjeta").prop("disabled",true);
  $("#txtHabiente").prop("disabled",true);
  $("#txtMontoTar").prop("disabled",true);

  $("#txtMonto").val('');
  $("#txtCambio").val('');
  $("#txtNoTarjeta").val('');
  $("#txtHabiente").val('');
  $("#txtMontoTar").val('');
}

//---- Controles que se Deshabilitan al venta al CONTADO
function Venta_Contado(){
  $("#btnRegistrar").prop("disabled",false);
  $("#cbMPago").prop("disabled",false);
  $("#txtMonto").prop("disabled",false);
  $("#txtCambio").prop("disabled",false);
  $("#txtNoTarjeta").prop("disabled",false);
  $("#txtHabiente").prop("disabled",false);
  $("#txtMontoTar").prop("disabled",false);
  }


 // Evento Change de chkPagado
$("#chkPagado").change(function() {
   if(this.checked) {
      $("#chkPagado").val(true);
      document.getElementById("lblchk2").innerHTML = 'VENTA AL CONTADO';
      $("#txtMonto").val('');
      $("#txtCambio").val('');
      Venta_Contado();
   } else {
     $("#chkPagado").val(false);
     document.getElementById("lblchk2").innerHTML = 'VENTA AL CREDITO';
     $("#txtMonto").val('0.00');
     $("#txtCambio").val('0.00');
     Venta_Credito();
   }
})

 // Evento Change de chkBusqueda
$("#chkBusqueda").change(function() {
   if(this.checked) {
      $("#chkBusqueda").val(true);
      document.getElementById("lblchk3").innerHTML = ' PRODUCTO POR CODIGO';
      $("#buscar_producto").val('');
      buscar_por_codigo();
   } else {
     $("#chkBusqueda").val(false);
     document.getElementById("lblchk3").innerHTML = 'PRODUCTO POR DETALLE';
     $("#buscar_producto").val('');
     buscar_por_detalle();
   }
})


//---------************* Agrego al detalle
function agregar_detalle(idproducto,producto,especificacion,precio_venta,exento,stock,perecedero){
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

            case 6:
            break;

            case 7:
            break;

            } // end switch index 2

          }); // end each td

           filas=filas+1;

         } // if index > 0

      }); // end each tbldetalle tr


      if(perecedero == 0){

             tr_add += '<tr>';
             tr_add += '<td align="center">'+idproducto+'</td>';
             tr_add += '<td><h8 class="no-margin">'+producto+'</h8><br>'+
            '<span class="text-muted">'+especificacion+'</span></td>';
             tr_add += '<td width="5%"><input type="text" id="tblcant" name="tblcant" value="1.00" class="touchspin" style="width:70px;"></td>';
             tr_add += '<td align="center">'+precio_venta+'</td>';
             tr_add += '<td align="center">'+exento+'</td>';
             tr_add += '<td width="5%"><input type="text" id="tbldesc" name="tbldesc"  value="0.00" class="touchspin" style="width:70px;"></td>';
             tr_add += '<td align="center">'+precio_venta+'</td>';
             tr_add += '<td align="center">/</td>';
             tr_add += '<td align="center" class="Delete"><button type="button"class="btn btn-link btn-xs"><i class="icon-trash-alt"></i></button></td>';
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
               $("#buscar_producto").val('');
               // Prefix

               $('.select-size-xs').select2();

               $("input[name='tblcant']").TouchSpin({
                   verticalbuttons: true,
                   verticalupclass: 'icon-arrow-up22',
                   verticaldownclass: 'icon-arrow-down22',
                   min: 0.01,
                   max: stock,
                   step: 0.01,
                   decimals: 2,
               }).on('touchspin.on.startspin', function () {totales()});

               $("input[name='tbldesc']").TouchSpin({
                   prefix:'$',
                   verticalbuttons: true,
                   verticalupclass: 'icon-arrow-up22',
                   verticaldownclass: 'icon-arrow-down22',
                   min: 0.00,
                   
                   step: 0.01,
                   decimals: 2,
               }).on('touchspin.on.startspin', function () {totales()});;

                noty({
                       force: true,
                       text: 'Producto agregado!',
                       type: 'information',
                       layout: 'top',
                       timeout: 500,
                   });

               totales();

             } else if(existe==true) {

                posicion_fila=posicion_fila+1;
                setRowCant(posicion_fila);

                noty({
                       force: true,
                       text: 'Producto agregado!',
                       type: 'information',
                       layout: 'top',
                       timeout: 500,
                   });

             }



      } else if (perecedero == 1){



        select_fechas ="<select id='cbFecha' name='cbFecha' class='form-control'>";
      //  $('.select-size-xs').select2();
        $.getJSON('web/ajax/ajxventa.php?idproducto='+idproducto, function (datos){
            if(datos.length > 0){
              $.each(datos, function(i, obj){
                  select_fechas+='<option value="'+obj.fecha_vencimiento+'">'+obj.fecha_vencimiento+'</option>';
              })
            }
        select_fechas+="</select>";



        tr_add += '<tr>';
        tr_add += '<td align="center">'+idproducto+'</td>';
        tr_add += '<td><h8 class="no-margin">'+producto+'</h8><br>'+
       '<span class="text-muted">'+especificacion+'</span></td>';
        tr_add += '<td width="5%"><input type="text" id="tblcant" name="tblcant" value="1.00" class="touchspin" style="width:70px;"></td>';
        tr_add += '<td align="center">'+precio_venta+'</td>';
        tr_add += '<td align="center">'+exento+'</td>';
        tr_add += '<td width="5%"><input type="text" id="tbldesc" name="tbldesc"  value="0.00" class="touchspin" style="width:70px;"></td>';
        tr_add += '<td align="center">'+precio_venta+'</td>';
        tr_add += '<td align="center">'+select_fechas+'</td>';
        tr_add += '<td align="center" class="Delete"><button type="button"class="btn btn-link btn-xs"><i class="icon-trash-alt"></i></button></td>';
        tr_add += '</tr>';


          $("#tbldetalle").append(tr_add);
          $("#buscar_producto").val('');
          // Prefix


          $("input[name='tblcant']").TouchSpin({
              verticalbuttons: true,
              verticalupclass: 'icon-arrow-up22',
              verticaldownclass: 'icon-arrow-down22',
              min: 0.01,
              max: stock,
              step: 0.01,
              decimals: 2,
          }).on('touchspin.on.startspin', function () {totales()});

          $("input[name='tbldesc']").TouchSpin({
              prefix:'$',
              verticalbuttons: true,
              verticalupclass: 'icon-arrow-up22',
              verticaldownclass: 'icon-arrow-down22',
              min: 0.00,
              step: 0.01,
              
              decimals: 2,
          }).on('touchspin.on.startspin', function () {totales()});;

           noty({
                  force: true,
                  text: 'Producto agregado!',
                  type: 'information',
                  layout: 'top',
                  timeout: 500,
              });

          totales();

    }) // end getJSON


  } // else if perecedero

}
//-----------Agregar al Detalle


// reemplazar valores de celda cantidades
function setRowCant(rowId){
    var cantidad_anterior=$('#tbldetalle tr:nth-child('+rowId+')').find('td:eq(2)').find("#tblcant").val();
    var cantidad_nueva= parseFloat(cantidad_anterior)+1;
    $('#tbldetalle tr:nth-child('+rowId+')').find('td:eq(2)').find("#tblcant").val(cantidad_nueva.toFixed(2));
    totales();
};


function buscar_por_codigo()
{
  $("#buscar_producto").autocomplete({
    minLength: 1,
    source: "web/ajax/autocomplete_venta.php",
    autoFocus: true,
    focus: function( event, ui ) {
       var tipo_precio = $('#chkPrecio').is(':checked') ? 1 : 0;
        var idproducto = ui.item.value;
        var producto = ui.item.producto;
        var precio_venta = ui.item.precio_venta;
        var precio_venta_mayoreo = ui.item.precio_venta_mayoreo;
        var datos = ui.item.datos;
        var exento = ui.item.exento;
        var stock = ui.item.stock;
        var perecedero = ui.item.perecedero;
        var inventariable = ui.item.inventariable;


        if(inventariable == 0){

          agregar_detalle(idproducto,producto,datos,precio_venta,0.00,stock,perecedero,inventariable);
          $('#buscar_producto').autocomplete('close');

        } else if (inventariable == 1){

            if(exento == 0)
            {
              if(tipo_precio == 1)
              {
                agregar_detalle(idproducto,producto,datos,precio_venta,0.00,stock,perecedero,inventariable);
                $('#buscar_producto').autocomplete('close');
              } else if (tipo_precio == 0){

                agregar_detalle(idproducto,producto,datos,precio_venta_mayoreo,0.00,stock,perecedero,inventariable);
                $('#buscar_producto').autocomplete('close');
              }

            } else if (exento == 1){

              if(tipo_precio == 1)
              {
                agregar_detalle(idproducto,producto,datos,precio_venta,precio_venta,stock,perecedero,inventariable);
                $('#buscar_producto').autocomplete('close');
              } else if (tipo_precio == 0){
                agregar_detalle(idproducto,producto,datos,precio_venta_mayoreo,precio_venta_mayoreo,stock,perecedero,inventariable);
                $('#buscar_producto').autocomplete('close');
              }

            }
          
          }

        $(this).val("");
        return false;

       /* $("#buscar_producto").val(ui.item.label);
        return false;*/
      }
  });

}


function buscar_por_detalle()
{
  $("#buscar_producto").autocomplete({
    minLength: 3,
    source: "web/ajax/autocomplete_venta.php",

    focus: function( event, ui ) {
     // $("#buscar_producto").val(ui.item.label);
      return false;
    },

       select: function( event, ui ) {
        var tipo_precio = $('#chkPrecio').is(':checked') ? 1 : 0;
        var idproducto = ui.item.value;
        var producto = ui.item.producto;
        var precio_venta = ui.item.precio_venta;
        var precio_venta_mayoreo = ui.item.precio_venta_mayoreo;
        var datos = ui.item.datos;
        var exento = ui.item.exento;
        var stock = ui.item.stock;
        var perecedero = ui.item.perecedero;
        var inventariable = ui.item.inventariable;

        if(inventariable == 0){

          agregar_detalle(idproducto,producto,datos,precio_venta,0.00,stock,perecedero,inventariable);
        
        } else if (inventariable == 1){


            if(exento == 0)
            {
              if(tipo_precio == 1)
              {
                agregar_detalle(idproducto,producto,datos,precio_venta,0.00,stock,perecedero,inventariable);

              } else if (tipo_precio == 0){

                agregar_detalle(idproducto,producto,datos,precio_venta_mayoreo,0.00,stock,perecedero,inventariable);

              }

            } else if (exento == 1){

              if(tipo_precio == 1)
              {
                agregar_detalle(idproducto,producto,datos,precio_venta,precio_venta,stock,perecedero,inventariable);

              } else if (tipo_precio == 0){
                agregar_detalle(idproducto,producto,datos,precio_venta_mayoreo,precio_venta_mayoreo,stock,perecedero,inventariable);

              }

            }

        }

        $(this).val("");
        return false;
    },
    open: function(event, ui) {
             $(".ui-autocomplete").css("z-index", 1000);
    },

    _renderItem: function( ul, item ) {

    var re = new RegExp( "(" + this.term + ")", "gi" ),
        cls = this.options.highlightClass,
        template = "<span class='" + cls + "'>$1</span>",
        label = item.label.replace( re, template ),
        $li = $( "<li/>" ).appendTo( ul );
           
    $( "<a/>" ).attr( "href", "#" )
               .html( label )
               .appendTo( $li );
            
    return $li;
            
}

})

/*.autocomplete("instance")._renderItem = function(ul, item) {

    return $("<li>").append("<span class='text-semibold'>" + item.label + '</span>' + "<br>" + '<span class="text-muted text-size-small">' + item.datos + '</span>').appendTo(ul);
}*/

}

// Evento que selecciona la fila y la elimina de la tabla
$(document).on("click",".Delete",function(){
  var parent = $(this).parents().get(0);
  $(parent).remove();
  totales();

});


$(document).on("focusout","#tblcant, #tbldesc",function(){
    totales();
})


$("#btncancelar").click(function(){

        swal({
            title: "¿Está seguro que desea cancelar la Venta?",
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


//---------************* Totales

function totales(){


var total_sumas=0; total_exentos=0; total_iva = 0; subtotal=0; sumas = 0; iva = 0; subtotal = 0;exentos = 0; total=0;descuentos = 0;
var iva_retenido = 0; iva_exento = 0; total_iva_exento = 0; total_descuentos=0; porc_rete=0; iva_entero = 0; iva_div = 0;

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
           iva_div = iva + 1;

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


                            case 5:  campo5 = $(this).find("#tbldesc").val();
                                     descuentos = parseFloat(campo5);
                                     var calculo_precio = campo2 * campo3;
                                      if(descuentos > calculo_precio)
                                     {
                                      descuentos = 0.00;
                                      $(this).find("#tbldesc").val(descuentos);
                                      $("#tbldesc").trigger("touchspin.updatesettings", {max: calculo_precio});
                                     } else {
                                      descuentos = parseFloat(campo5);
                                      $("#tbldesc").trigger("touchspin.updatesettings", {max: calculo_precio});
                                     }
                                     break;

                            case 6: campo6 = campo2 * campo3;
                                    sumas = parseFloat(campo6);
                                    if(isNaN(sumas)){sumas = 0.00;}
                                    $(this).text(sumas.toFixed(2));
                                    break;

                            case 7:  campo7 = $(this).text();
                                     break;



                        }
                      //  $(this).css("background-color", "#ECF8E0");
                    })

                      if(isNaN(sumas)){sumas = 0.00;}
                      if(isNaN(exentos)){exentos = 0.00;}
                      if(isNaN(descuentos)){descuentos = 0.00;}

                      if(sumas==''){sumas = 0.00;}
                      if(exentos==''){exentos = 0.00;}
                      if(descuentos==''){descuentos = 0.00;}


                      subtotal = (subtotal + sumas)-exentos;
                      total_sumas = subtotal / iva_div;
                      total_iva = subtotal - total_sumas;
                      total_exentos = total_exentos + exentos;
                      total_descuentos = total_descuentos + descuentos;

                      if(total_sumas >= monto_retencion){
                         iva_retenido = total_sumas * porc_rete;
                         total = ((subtotal + total_exentos) - iva_retenido) - total_descuentos;

                      } else {

                         total = (subtotal + total_exentos) - total_descuentos;
                      }
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
                $("#descuentos").html(total_descuentos.toFixed(2));
                $("#total").html(total.toFixed(2));
                $("#txtDeuda").val(total.toFixed(2));



                $("#big_total").html(moneda+' '+ $.number(total, 2 ));



                if ($('#tbldetalle > tbody >tr').length > 0){
                      $("#btncancelar").show();
                      $("#btnguardar").show();
                      $("#totales_foot").show();
                      $('#txtMonto').prop( "disabled" , false);
                 } else if($('#tbldetalle > tbody >tr').length ===0){
                      $("#btncancelar").hide();
                      $("#totales_foot").hide();
                      $("#btnguardar").hide();
                      $('#txtMonto').prop( "disabled" , true);
                 }

              });


            });

        });

    });
}

//---------************* Totales

//---------************* Enviar datos y guardar compra


function enviar_data(){

  var i=0;
  var StringDatos="";
  var idcliente = $("#cbCliente").val();
  var fecha_retiro = $('#txtFechaR').val();
  var sumas = $("#sumas").text();
  var iva = $("#iva").text();
  var exento = $("#exentas").text();
  var retenido = $("#ivaretenido").text();
  var descuentos = $("#descuentos").text();
  var restante = $("#txtCambio").val();
  var total = $("#total").text();
  var abonado = $("#txtMonto").val();



  var cantidad = 0;
  var precio_unitario = 0;
  var ventas_nosujetas = 0;
  var exentos = 0;
  var importe = 0;
  var descuento = 0;
  var fecha_vence = "";

    $("#tbldetalle tbody tr").each(function (index)
        {
            var campo1, campo2, campo3, campo4, campo5, campo6, campo7;
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

                    case 5:  campo5 = $(this).find("#tbldesc").val();
                             descuento = parseFloat(campo5);
                             break;

                    case 6:  campo6 = campo2 * campo3;
                             importe = parseFloat(campo6);
                             $(this).text(campo6.toFixed(2));
                             break;

                    case 7: campo7 = $(this).find("#cbFecha option:selected").text();
                            fecha_vence = campo7;
                            break;


                }
              //  $(this).css("background-color", "#ECF8E0");
            })

        if(campo0!=""|| campo0==undefined || isNaN(campo0)==false && cantidad > 0){
        StringDatos+=campo0+"|"+cantidad+"|"+precio_unitario+"|"+exentos+"|"+descuento+"|"+fecha_vence+"|"+importe+"#";
        i=i+1;
        }

     })



        var dataString='&stringdatos='+StringDatos+'&cuantos='+i;
        dataString+='&idcliente='+idcliente+'&sumas='+sumas+'&iva='+iva;
        dataString+='&retenido='+retenido+'&exento='+exento+'&descuento='+descuentos+'&total='+total;
        dataString+='&abonado='+abonado+'&restante='+restante+'&fecha_retiro='+fecha_retiro;

        if(total > 0.00){

            $.ajax({

            type:'POST',
            url:'web/ajax/ajxapartado.php',
            data: dataString,
            cache: false,
            dataType: 'json',
            success: function(data){

              if(data=="Validado"){

                $("#btnguardar").hide();
                $("#btncancelar").hide();
                $('#modal_iconified_cash').modal('toggle');


                  swal({
                      title: "¿Desea Imprimir el Comprobante?",
                      text: "Su cliente lo puede solicitar",
                      imageUrl: "web/assets/images/receipt.png",
                      showCancelButton: true,
                      cancelButtonColor: "#EF5350",
                      confirmButtonColor: "#43ABDB",
                      confirmButtonText: "Si, Imprimir",
                      cancelButtonText: "No",
                      closeOnConfirm: false,
                      closeOnCancel: false,
                    },
                    function(isConfirm){
                      if (isConfirm) {
                         /* window.open('reportes/Ticket_Apartado.php?num=""',
                          'win2',
                          'status=yes,toolbar=yes,scrollbars=yes,titlebar=yes,menubar=yes,'+
                          'resizable=yes,width=600,height=600,directories=no,location=no'+
                          'fullscreen=yes');
                          location.reload();*/
                          window.location.href = 'http://localhost/easyposgt/reportes/Ticket_Directo_Apartado.php?num='
                      } else {
                         setTimeout(function(){
                            swal("Espere un momento..");
                            location.reload();
                          }, 2000);
                      }
                    });


              } else {

                swal('Lo sentimos, no pudimos registrar tu informacion!', "Intentalo nuevamente", "error");
              }
            },error: function() {

               swal("Ups! Ocurrio un error","Algo salio mal al procesar tu peticion","error");
          }


        });


        } else {

           swal("Imposible","No se puede registrar una compra con valor 0.00","warning");

        }
}
