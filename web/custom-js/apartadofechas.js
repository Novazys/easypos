
$(function () {

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
        required: function() {
                 return $("#cbMPago").val() == 1 || $("#cbMPago").val() == 3;
          }
      },
      cbCompro:{
        required: true
      },
      cbCliente:{
        required: true
      },
      txtNoTarjeta:{
        required: function() {
                 return $("#cbMPago").val() == 2 || $("#cbMPago").val() == 3;
          }
      },
      txtHabiente:{
        required: function() {
                 return $("#cbMPago").val() == 2 || $("#cbMPago").val() == 3;
          }
      },
      txtMontoTar:{
        required: function() {
                 return $("#cbMPago").val() == 2 || $("#cbMPago").val() == 3;
          }
      }
    },
    messages: {
        txtMonto: {
            required: "Ingrese cantidad",
        },
        cbCompro: {
            required: "Seleccione una opcion",
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


  /*Evento change de ChkEstado en el cual al chequear o deschequear cambia el label*/
$("#chkEstado").change(function() {
if(this.checked) {
 $("#chkEstado").val(true);
 document.getElementById("lblchk").innerHTML = 'REPORTES DETALLADOS';
} else {
$("#chkEstado").val(false);
document.getElementById("lblchk").innerHTML = 'REPORTES TOTALIZADOS';
}
});


$(document).on('click', '#print_vigentes', function(e){

       Print_Report('Vigentes');
       e.preventDefault();
  });

  $(document).on('click', '#print_anuladas', function(e){

       Print_Report('Anuladas');
       e.preventDefault();
 });

$(document).on('click', '#print_contado', function(e){

       Print_Report('Finalizados');
       e.preventDefault();
 });


 var mySwitch = new Switchery($('.switchery')[0], {
          size:"small",
          color: '#0D74E9',
          secondaryColor :'#26A69A'
      });



// Setting datatable defaults
$.extend( $.fn.dataTable.defaults, {
    autoWidth: false,
    columnDefs: [{
        orderable: false,
        width: '100px'
    }],
    dom: '<"datatable-header"fpl><"datatable-scroll"t><"datatable-footer"ip>',
    language: {
        search: '<span>Buscar:</span> _INPUT_',
        lengthMenu: '<span>Ver:</span> _MENU_',
        emptyTable: "No existen registros",
        sZeroRecords:    "No se encontraron resultados",
        sInfoEmpty:      "No existen registros que contabilizar",
        sInfoFiltered:   "(filtrado de un total de _MAX_ registros)",
        sInfo:           "Mostrando del registro _START_ al _END_ de un total de _TOTAL_ datos",
        paginate: { 'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;' }

    },
    drawCallback: function () {
        $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').addClass('dropup');
    },
    preDrawCallback: function() {
        $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').removeClass('dropup');
    }
});


// Basic datatable
$('.datatable-basic').DataTable();

// Add placeholder to the datatable filter option
$('.dataTables_filter input[type=search]').attr('placeholder','Escriba para filtrar...');


// Enable Select2 select for the length option
$('.dataTables_length select').select2({
    minimumResultsForSearch: Infinity,
    width: 'auto'
});


  $('#txtF1').datetimepicker({
        locale: 'es',
        format: 'DD/MM/YYYY',
        useCurrent:true,
        viewDate: moment()

  });

  $('#txtF2').datetimepicker({
        locale: 'es',
        format: 'DD/MM/YYYY',
        useCurrent: false
  });

$("#txtF1").on("dp.change", function (e) {
            $('#txtF2').data("DateTimePicker").minDate(e.date);
        });
$("#txtF2").on("dp.change", function (e) {
    $('#txtF1').data("DateTimePicker").maxDate(e.date);
});


     var validator = $("#frmSearch").validate({

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
        txtF1:{
          required: true
        },
        txtF2:{
          required:true
        }
      },
    validClass: "validation-valid-label",
     success: function(label) {
          label.addClass("validation-valid-label").text("Correcto.")
      },

       submitHandler: function (form) {
           buscar_datos();
        }
     });

  $(document).on('click', '#delete_product', function(e){

       var productId = $(this).data('id');
       SwalDelete(productId);
       e.preventDefault();
  });

  $(document).on('click', '#pay_money', function(e){

       var productId = $(this).data('id');
       Finalizar(productId);
       e.preventDefault();
  });

  $(document).on('click', '#detail_pay', function(e){

       var productId = $(this).data('id');
       detalle_venta(productId);
       e.preventDefault();
  });

  $(document).on('click', '#print_receip', function(e){

       var productId = $(this).data('id');
       Imprimir_Ticket(productId);
       e.preventDefault();
  });

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

    if(parseFloat(pago) >=  parseFloat(deuda)){
      $("#btnRegistrar").prop("disabled",false);
    } else {
      $("#btnRegistrar").prop("disabled",true);
    }

}


$('#modal_iconified_cash').on('shown.bs.modal', function (e) {
  $("#txtMonto").change(function(){
      Cambio_Venta();
  });
});


function openPago(total,idcliente,idapartado)
{

    $('#txtID').val(idapartado);
    $('#txtDeuda').val(Math.abs(total)); // Math.abs convierte un numero sea este positivo o negativo
    $("#cbCliente").val(idcliente).trigger("change");

}



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


  if(parseFloat(sumatoria)  >  parseFloat(deuda) || parseFloat(sumatoria)  <  parseFloat(deuda)){
    $("#btnRegistrar").prop("disabled",true);
    $("#txtCambio").val('0.00');
  } else if (parseFloat(sumatoria)  ==  parseFloat(deuda)) {
    $("#btnRegistrar").prop("disabled",false);
    $("#txtCambio").val('0.00');
  }


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



function buscar_datos()
{
  var fecha1 = $("#txtF1").val();
  var fecha2 = $("#txtF2").val();

    if(fecha1!="" && fecha2!="")
    {
        $.ajax({

           type:"GET",
           url:"web/ajax/reload-apartados_fecha.php?fecha1="+fecha1+"&fecha2="+fecha2,
           success: function(data){
              $('#reload-div').html(data);
           }

       });
    } else {

      $.ajax({

           type:"GET",
           url:"web/ajax/reload-apartados_fecha.php?fecha1=empty&fecha2=empty",
           success: function(data){
              $('#reload-div').html(data);
           }

       });

    }

}

function detalle_venta(VentaNo)
{
    $.ajax({

       type:"GET",
       url:"web/ajax/reload-detalle-apartado.php?numero_transaccion="+VentaNo,
       success: function(data){
          $('#reload-detalle').html(data);
       }

   });

}

function Imprimir_Ticket(VentaNo)
{
   window.open('reportes/Ticket_Apartado.php?num='+btoa(VentaNo),
  'win2','status=yes,toolbar=yes,scrollbars=yes,titlebar=yes,menubar=yes,'+
  'resizable=yes,width=600,height=600,directories=no,location=no'+
  'fullscreen=yes');

}


    function SwalDelete(productId){
              swal({
                title: "¿Está seguro que desea anular la transacción?",
                text: "Este proceso es irreversible!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#EF5350",
                confirmButtonText: "Si, Anular",
                cancelButtonText: "No, volver atras",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm){
                if (isConfirm) {
                     return new Promise(function(resolve) {
                        $.ajax({
                        url: 'web/ajax/ajxanulacion.php',
                        type: 'POST',
                        data: 'proceso=Anular_Apartado&numero_transaccion='+productId,
                        dataType: 'json'
                        })
                        .done(function(response){
                         swal('Anulada!', response.Diasage, response.status);
                         buscar_datos();
                        })
                        .fail(function(){
                         swal('Oops...', 'Algo salio mal al procesar tu peticion!', 'error');
                        });
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

 }

   function Finalizar(productId){
              swal({
                title: "¿Está seguro que desea finalizar la venta?",
                text: "Este proceso es irreversible!",
                showCancelButton: true,
                confirmButtonColor: "#4caf50",
                confirmButtonText: "Si, Finalizar",
                cancelButtonText: "No, volver atras",
                closeOnConfirm: false,
                closeOnCancel: false,
                imageUrl: "web/assets/images/change.png",
                allowOutsideClick: false
            },
            function(isConfirm){
                if (isConfirm) {
                     return new Promise(function(resolve) {
                        $.ajax({
                        url: 'web/ajax/ajxanulacion.php',
                        type: 'POST',
                        data: 'proceso=Finalizar_Venta&numero_transaccion='+productId,
                        dataType: 'json'
                        })
                        .done(function(response){
                         swal('Finalizada!', response.message, response.status);
                         buscar_datos();
                        })
                        .fail(function(){
                         swal('Oops...', 'Algo salio mal al procesar tu peticion!', 'error');
                        });
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

 }

  function Print_Report(Criterio)
{


  var fecha1 = $("#txtF1").val();
  var fecha2 = $("#txtF2").val();

  var estado = $('#chkEstado').is(':checked') ? 1 : 0;

  if(estado == 0){

    if(fecha1!="" && fecha2!="")
    {

        if(Criterio == 'Vigentes')
        {
             window.open('reportes/Apartados_Vigentes_Fechas.php?fecha1='+fecha1+'&fecha2='+fecha2,
            'win2',
            'status=yes,toolbar=yes,scrollbars=yes,titlebar=yes,menubar=yes,'+
            'resizable=yes,width=800,height=800,directories=no,location=no'+
            'fullscreen=yes');

        } else if (Criterio == 'Anuladas') {

             window.open('reportes/Apartados_Anulados_Fechas.php?fecha1='+fecha1+'&fecha2='+fecha2,
            'win2',
            'status=yes,toolbar=yes,scrollbars=yes,titlebar=yes,menubar=yes,'+
            'resizable=yes,width=600,height=600,directories=no,location=no'+
            'fullscreen=yes');

        } else if (Criterio == 'Finalizados') {

             window.open('reportes/Apartados_Finalizados_Fechas.php?fecha1='+fecha1+'&fecha2='+fecha2,
            'win2',
            'status=yes,toolbar=yes,scrollbars=yes,titlebar=yes,menubar=yes,'+
            'resizable=yes,width=600,height=600,directories=no,location=no'+
            'fullscreen=yes');

        } 


    } else {


        swal({
                title: "Ops!",
                imageUrl: "web/assets/images/calendar.png",
                text: "Debes seleccionar 2 fechas",
                confirmButtonColor: "#EF5350"
         });



    }

 } else {


   if(fecha1!="" && fecha2!="")
   {
        if(Criterio == 'Vigentes')
        {
             window.open('reportes/ApartadosD_Vigentes_Fechas.php?fecha1='+fecha1+'&fecha2='+fecha2,
            'win2',
            'status=yes,toolbar=yes,scrollbars=yes,titlebar=yes,menubar=yes,'+
            'resizable=yes,width=800,height=800,directories=no,location=no'+
            'fullscreen=yes');

        } else if (Criterio == 'Anuladas') {

             window.open('reportes/ApartadosD_Anulados_Fechas.php?fecha1='+fecha1+'&fecha2='+fecha2,
            'win2',
            'status=yes,toolbar=yes,scrollbars=yes,titlebar=yes,menubar=yes,'+
            'resizable=yes,width=600,height=600,directories=no,location=no'+
            'fullscreen=yes');

        } else if (Criterio == 'Finalizados') {

             window.open('reportes/ApartadosD_Finalizados_Fechas.php?fecha1='+fecha1+'&fecha2='+fecha2,
            'win2',
            'status=yes,toolbar=yes,scrollbars=yes,titlebar=yes,menubar=yes,'+
            'resizable=yes,width=600,height=600,directories=no,location=no'+
            'fullscreen=yes');

        } 

   } else {


       swal({
               title: "Ops!",
               imageUrl: "web/assets/images/calendar.png",
               text: "Debes seleccionar 2 fechas",
               confirmButtonColor: "#EF5350"
        });

   }



 }


}


function enviar_data(){

  var i=0;
  var id = $("#txtID").val();
  var comprobante = $("#cbCompro").val();
  var idcliente = $("#cbCliente").val();
  var tipo_pago = $('#cbMPago').val();
  var cambio = $("#txtCambio").val();

  var efectivo = $("#txtMonto").val();
  var pago_tarjeta = $("#txtMontoTar").val();
  var numero_tarjeta = $("#txtNoTarjeta").val();
  var tarjeta_habiente = $("#txtHabiente").val();







        var dataString='comprobante='+comprobante;
        dataString+='&tipo_pago='+tipo_pago+'&idcliente='+idcliente+'&id='+id;
        dataString+='&efectivo='+efectivo+'&pago_tarjeta='+pago_tarjeta+'&numero_tarjeta='+numero_tarjeta+'&tarjeta_habiente='+tarjeta_habiente+'&cambio='+cambio;

  
            $.ajax({

            type:'POST',
            url:'web/ajax/ajxventa-apartado.php',
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
                          window.open('reportes/Ticket.php?venta=""',
                          'win2',
                          'status=yes,toolbar=yes,scrollbars=yes,titlebar=yes,menubar=yes,'+
                          'resizable=yes,width=600,height=600,directories=no,location=no'+
                          'fullscreen=yes');
                          location.reload();
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


        
}
