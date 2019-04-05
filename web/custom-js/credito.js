$(function () {

  $('#txtDesde').datetimepicker({
        locale: 'es',
        format: 'DD/MM/YYYY'

  });

  $('#txtHasta').datetimepicker({
        locale: 'es',
        format: 'DD/MM/YYYY'

  });

  $("#txtDesde").on("dp.change", function (e) {
              $('#txtHasta').data("DateTimePicker").minDate(e.date);
          });
  $("#txtHasta").on("dp.change", function (e) {
      $('#txtDesde').data("DateTimePicker").maxDate(e.date);
  });

  $(document).on('click', '#print_vigentes', function(e){

       Print_Report('Vigentes');
       e.preventDefault();
  });

  $(document).on('click', '#print_finalizados', function(e){

       Print_Report('Finalizados');
       e.preventDefault();
 });

  $(document).on('click', '#print_estado', function(e){

      var productId = $(this).data('id');
      Imprimir_Estado(productId);
      e.preventDefault();
 });

 $(document).on('click', '#delete_abono', function(e){

     var productId = $(this).data('id');
     SwalDelete(productId);
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


  $("#txtMonto").TouchSpin({
    min: 0.01,
    max: 100000000,
    step: 0.01,
    decimals: 2,
    prefix: '<i class="icon-cash"></i>'
  });

  $("#txtMontoA").TouchSpin({
    min: 0.01,
    max: 100000000,
    step: 0.01,
    decimals: 2,
    prefix: '<i class="icon-cash"></i>'
  });


    $("#txtMontoR").TouchSpin({
      min: 0.01,
      max: 100000000,
      step: 0.01,
      decimals: 2,
      prefix: '<i class="icon-cash"></i>'
    });

    $("#txtMontoAbono").TouchSpin({
      min: 0.01,
      max: 100000000,
      step: 0.01,
      decimals: 2,
      prefix: '<i class="icon-cash3"></i>'
    });


  // Setting datatable defaults
$.extend( $.fn.dataTable.defaults, {
    autoWidth: false,
    pageLength: 100,
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


  $('#txtFechaC').datetimepicker({
        locale: 'es',
        format: 'DD/MM/YYYY HH:mm:ss'

  });

  $('#txtFechaA').datetimepicker({
        locale: 'es',
        format: 'DD/MM/YYYY HH:mm:ss'

  });

  $('.select-search').select2();

    /*Evento change de ChkEstado en el cual al chequear o deschequear cambia el label*/
  $("#chkEstado").change(function() {
  if(this.checked) {
     $("#chkEstado").val(true);
     document.getElementById("lblchk").innerHTML = 'VIGENTE';
  } else {
    $("#chkEstado").val(false);
    document.getElementById("lblchk").innerHTML = 'FINALIZADO';
  }
  });

  $.fn.modal.Constructor.prototype.enforceFocus = function() {};

      var validator = $("#frmAbono").validate({

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
       cbCredito:{
         required: true
       },
       txtMontoAbono:{
        required: true
       },
       txtFechaA:{
        required: true
       }
     },
    validClass: "validation-valid-label",
    success: function(label) {
         label.addClass("validation-valid-label").text("Correcto.")
     },

      submitHandler: function (form) {
          enviar_abono();
       }
    });


    var validator_report = $("#frmReport").validate({

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
         txtDesde:{
           required: true
         },
         txtHasta:{
          required: true
         }
       },
      validClass: "validation-valid-label",
      success: function(label) {
           label.addClass("validation-valid-label").text("Correcto.")
       },

        submitHandler: function (form) {
           imprimir_abono_reporte();
         }
      });

    var form = $('#frmAbono');
    $('#cbCredito', form).change(function () {
         form.validate().element($(this)); //revalidate the chosen dropdown value and show error or success message for the input
     });

     var validator2 = $("#frmCredito").validate({

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
      txtNombre:{
        required: true
      },
      txtFechaC:{
       required: true
      },
      txtMonto:{
       required: true
     },
      txtMontoA:{
       required: true
      },
      txtMontoR:{
       required: true
      },
    },
   validClass: "validation-valid-label",
   success: function(label) {
        label.addClass("validation-valid-label").text("Correcto.")
    },

     submitHandler: function (form) {
         enviar_credito();
      }
   });

});

function detalle_venta(VentaNo)
{
    $.ajax({

       type:"GET",
       url:"web/ajax/reload-detalle-venta.php?numero_transaccion="+VentaNo,
       success: function(data){
          $('#reload-detalle').html(data);
       }

   });

}

function SwalDelete(productId){
          swal({
            title: "¿Está seguro que desea borrar el abono?",
            text: "Este proceso es irreversible!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#EF5350",
            confirmButtonText: "Si, Eliminar",
            cancelButtonText: "No, volver atras",
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function(isConfirm){
            if (isConfirm) {
                 return new Promise(function(resolve) {
                    $.ajax({
                    url: 'web/ajax/ajxcredito.php',
                    type: 'POST',
                    data: 'proceso=Eliminar&opcion=ABONO&id='+productId,
                    dataType: 'json'
                    })
                    .done(function(response){
                     swal('Eliminado!', response.message, response.status);
                     cargarDiv("#reload-div","web/ajax/reload-credito.php");
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

    if(Criterio == 'Vigentes')
    {
         window.open('reportes/Creditos_Vigentes.php?',
        'win2',
        'status=yes,toolbar=yes,scrollbars=yes,titlebar=yes,menubar=yes,'+
        'resizable=yes,width=800,height=800,directories=no,location=no'+
        'fullscreen=yes');

    } else if (Criterio == 'Finalizados') {

         window.open('reportes/Ventas_Anuladas_Dia.php?',
        'win2',
        'status=yes,toolbar=yes,scrollbars=yes,titlebar=yes,menubar=yes,'+
        'resizable=yes,width=600,height=600,directories=no,location=no'+
        'fullscreen=yes');

    } else if (Criterio == 'Contado') {

         window.open('reportes/Ventas_Contado_Dia.php?',
        'win2',
        'status=yes,toolbar=yes,scrollbars=yes,titlebar=yes,menubar=yes,'+
        'resizable=yes,width=600,height=600,directories=no,location=no'+
        'fullscreen=yes');

    } else if (Criterio == 'Credito'){

         window.open('reportes/Ventas_Credito_Dia.php?',
        'win2',
        'status=yes,toolbar=yes,scrollbars=yes,titlebar=yes,menubar=yes,'+
        'resizable=yes,width=600,height=600,directories=no,location=no'+
        'fullscreen=yes');
    }

}

function limpiarform_C(){

  var form = $( "#frmCredito" ).validate();
  form.resetForm();

}

function limpiarform_A(){

  var form = $( "#frmAbono" ).validate();
  form.resetForm();

}

function Limite_Abono()
{
    var monto_restante = "";
    var credito = $("#cbCredito").val();

    if(credito!=null){

      $.getJSON('web/ajax/ajxcredito.php?credito='+credito,function(data){
            $.each(data,function(key,val){
              monto_restante = val.monto_restante;
            });
          $("#txtMontoAbono").val(monto_restante);
          $("#txtMontoAbono").trigger("touchspin.updatesettings", {max: monto_restante});
      });

    }
}



function newAbono()
{
  openAbono('nuevo',null,null,null,null);
  $('#Modal_Abono').modal('show');
}
function openAbono(action,idabono,codigo,fecha,monto,idcredito)
 {
    $('#Modal_Abono').on('shown.bs.modal', function () {
     var modal = $(this);
     if (action == 'nuevo'){


       $("#cbCredito").change(function() {
          Limite_Abono();
       });

      $('#txtProceso').val('Registro');
      $('#txtID').val('');
      $('#txtFechaA').val('');
      $('#txtMontoAbono').val('');
      $("#cbCredito").select2("val", "All");

      $('#txtMontoAbono').prop( "disabled" , false);
      $('#txtFechaA').prop( "disabled" , true);
      $('#cbCredito').prop( "disabled" , false);

      $('#btnEditar_A').hide();
      $('#btnGuardar').show();
      limpiarform_A();

      modal.find('.title-form').text('Abonar Credito');
     }else if(action=='editar') {

      $('#Modal_Abono').modal('show');

      $('#txtProceso').val('Edicion');
      $('#txtID').val(idabono);
      $('#txtFechaA').val(fecha);
      $('#txtMontoAbono').val(monto);
      $("#cbCredito").val(idcredito).trigger("change");

      $('#txtMontoAbono').prop( "disabled" , false);
      $('#txtFechaA').prop( "disabled" , false);
      $('#cbCredito').prop( "disabled" , true);

      $('#btnEditar_A').show();
      $('#btnGuardar').hide();

      modal.find('.title-form').text('Editar Abono de Credito : ' + codigo);
     } else if(action=='ver'){
      $('#txtProceso').val('');
      $('#txtID').val(idabono);
      $('#txtFechaA').val(fecha);
      $('#txtMontoAbono').val(monto);
      $("#cbCredito").val(idcredito).trigger("change");

      $('#txtMontoAbono').prop( "disabled" , true);
      $('#txtFechaA').prop( "disabled" , true);
      $('#cbCredito').prop( "disabled" , true);

      $('#btnEditar_A').hide();
      $('#btnGuardar').hide();

      modal.find('.title-form').text('Ver Abono');
     }

  });

}

function setSwitchery(switchElement, checkedBool) {
  if((checkedBool && !switchElement.isChecked()) || (!checkedBool && switchElement.isChecked())) {
      switchElement.setPosition(true);
      switchElement.handleOnchange(true);
  }
}


function newCredito()
{
  openCredito('nuevo',null,null,null,null,null,null,null);
  $('#Modal_Credito').modal('show');
}
function openCredito(action,idcredito,codigo_credito,nombre_credito,fecha_credito,monto_credito,abonado,restante,estado)
 {
    $('#Modal_Credito').on('shown.bs.modal', function () {
     var modal = $(this);

    if(action=='editar') {

      $('#Modal_Credito').modal('show');

      var mySwitch = new Switchery($('#chkEstado')[0], {
        size:"small",
        color: '#0D74E9'
    });

      $('#txtProceso_C').val('Edicion');
      $('#txtID_C').val(idcredito);
      $('#txtCodigo').val(codigo_credito);
      $('#txtNombre').val(nombre_credito);
      $('#txtFechaC').val(fecha_credito);
      $('#txtMonto').val(monto_credito);
      $('#txtMontoA').val(abonado);
      $('#txtMontoR').val(restante);

      if (estado == '0')
      {
        $("#chkEstado").val(true);
        setSwitchery(mySwitch, true);
        document.getElementById("chkEstado").checked = true;
        document.getElementById("lblchk").innerHTML = 'VIGENTE';
      }else {
        $("#chkEstado").val(false);
        setSwitchery(mySwitch, false);
        document.getElementById("chkEstado").checked = false;
        document.getElementById("lblchk").innerHTML = 'FINALIZADO';
      }

      $('#txtNombre').prop( "disabled" , false);
      $('#txtFechaC').prop( "disabled" , false);
      $('#txtMonto').prop( "disabled" , false);
      $('#txtMontoA').prop( "disabled" , false);
      $('#txtMontoR').prop( "disabled" , false);

      $('#btnEditar_C').show();

      modal.find('.title-form').text('Editar Credito : ' + codigo_credito);
     } else if(action=='ver'){
      $('#txtProceso_C').val('');
      $('#txtID_C').val(idcredito);
      $('#txtCodigo').val(codigo_credito);
      $('#txtNombre').val(nombre_credito);
      $('#txtFechaC').val(fecha_credito);
      $('#txtMonto').val(monto_credito);
      $('#txtMontoA').val(abonado);
      $('#txtMontoR').val(restante);

      $('#txtNombre').prop( "disabled" , true);
      $('#txtFechaC').prop( "disabled" , true);
      $('#txtMonto').prop( "disabled" , true);
      $('#txtMontoA').prop( "disabled" , true);
      $('#txtMontoR').prop( "disabled" , true);

      $('#btnEditar_C').hide();


      modal.find('.title-form').text('Ver Credito : ' + codigo_credito);
     }

  });

}



function cargarDiv(div,url)
{
      $(div).load(url);
}

function Imprimir_Ticket(Abono)
{
  /* window.open('reportes/Ticket_Abono_V.php?abono='+btoa(Abono),
  'win2','status=yes,toolbar=yes,scrollbars=yes,titlebar=yes,menubar=yes,'+
  'resizable=yes,width=600,height=600,directories=no,location=no'+
  'fullscreen=yes');*/

window.location.href ='http://localhost/easyposgt/reportes/Ticket_Directo_Abono.php?abono='+btoa(Abono);

}

function Imprimir_Estado(Cod)
{
   window.open('reportes/Credito_Detalle.php?cod='+btoa(Cod),
  'win2','status=yes,toolbar=yes,scrollbars=yes,titlebar=yes,menubar=yes,'+
  'resizable=yes,width=600,height=600,directories=no,location=no'+
  'fullscreen=yes');

}

function enviar_abono()
{
  var urlprocess = 'web/ajax/ajxcredito.php';
  var opcion = 'ABONO';
  var id = $("#txtID").val();
  var proceso = $("#txtProceso").val();
  var fecha_abono = $("#txtFechaA").val();
  var monto_abono = $("#txtMontoAbono").val();
  var idcredito = $("#cbCredito").val();

  var dataString='proceso='+proceso+'&fecha_abono='+fecha_abono+'&monto_abono='+monto_abono+'&idcredito='+idcredito+'&opcion='+opcion+'&id='+id;


  $.ajax({
     type:'POST',
     url:urlprocess,
     data: dataString,
     dataType: 'json',
     success: function(data){

        if(data=="Validado"){

             if(proceso=="Registro"){

              swal({
                  title: "Exito!",
                  text: "Abono registrado",
                  confirmButtonColor: "#66BB6A",
                  type: "success"
              });

              $("#cbCredito").select2("val", "All");


              $('#Modal_Abono').modal('toggle');
              cargarDiv("#reload-div","web/ajax/reload-credito.php");
              limpiarform_A();

              } else if(proceso == "Edicion") {


                  swal({
                      title: "Exito!",
                      text: "Abono modificado",
                      confirmButtonColor: "#2196F3",
                      type: "info"
                  });
                   $('#modal_iconified').modal('toggle');
                   cargarDiv("#reload-div","web/ajax/reload-credito.php");

              }

        } else if(data =="Duplicado"){

               swal({
                title: "Ups!...",
                text: "Este credito ya no admite mas abonos!",
                confirmButtonColor: "#EF5350",
                type: "warning"
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

}

function enviar_credito()
{
  var urlprocess = 'web/ajax/ajxcredito.php';
  var opcion = 'CREDITO';
  var id = $("#txtID_C").val();
  var nombre_credito = $("#txtNombre").val();
  var fecha_credito= $("#txtFechaC").val();
  var monto_credito= $("#txtMonto").val();
  var monto_abonado= $("#txtMontoA").val();
  var monto_restante= $("#txtMontoR").val();
  var estado = $('#chkEstado').is(':checked') ? 0 : 1;

  var dataString = 'opcion='+opcion+'&id='+id+'&nombre_credito='+nombre_credito+'&fecha_credito='+fecha_credito+'&monto_credito='+monto_credito;
  dataString+='&monto_abonado='+monto_abonado+'&monto_restante='+monto_restante+'&estado='+estado;

  $.ajax({
     type:'POST',
     url:urlprocess,
     data: dataString,
     dataType: 'json',
     success: function(data){

        if(data=="Validado"){

          swal({
              title: "Exito!",
              text: "Credito modificado",
              confirmButtonColor: "#2196F3",
              type: "info"
          });

           $('#Modal_Credito').modal('toggle');
           cargarDiv("#reload-div","web/ajax/reload-credito.php");
           limpiarform_C();


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

function imprimir_abono_reporte(){

  var fecha1 = $("#txtDesde").val();
  var fecha2 = $("#txtHasta").val();

    if(fecha1!="" && fecha2!="")
    {
        window.open('reportes/Total_Abonos.php?fecha1='+fecha1+'&fecha2='+fecha2,
       'win2',
       'status=yes,toolbar=yes,scrollbars=yes,titlebar=yes,menubar=yes,'+
       'resizable=yes,width=800,height=800,directories=no,location=no'+
       'fullscreen=yes');
    }


}

function Print_Ticket(Abono){
  /*  var url = 'reportes/Ticket_Abono_O.php?abono='+btoa(Abono);
    var url2 = 'reportes/Ticket_Abono_C.php?abono='+btoa(Abono);
    $('#ticket_frame').attr('src', url)
    $('#ticket2_frame').attr('src', url2)*/
    window.location.href ='http://localhost/easyposgt/reportes/Ticket_Directo_Abono.php?abono='+btoa(Abono);
}
