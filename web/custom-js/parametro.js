$(function() {

    // Table setup
    // ------------------------------

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

      $('.select-search').select2();


    jQuery.validator.addMethod("greaterThan",function (value, element, param) {
      var $min = $(param);
      if (this.settings.onfocusout) {
        $min.off(".validate-greaterThan").on("blur.validate-greaterThan", function () {
          $(element).valid();
        });
      }return parseInt(value) > parseInt($min.val());}, "Maximo debe ser mayor a minimo");

    jQuery.validator.addMethod("lettersonly", function(value, element) {
        return this.optional(element) || /^[a-z\s 0-9, / # . ()]+$/i.test(value);
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
        cbMoneda:{
          required:true
        },
        txtEmpresa:{
          maxlength:150,
          minlength: 4,
          required: true,
          lettersonly:true
        },
        txtNIT:{
          maxlength:9,
          minlength: 9,
          required: true
        },
        txtPropietario:{
          maxlength:150,
          minlength: 1,
          required: true
        },
        txtPIVA:{
          required: true
        },
        txtPRET:{
          required: true
        },
        txtMontoR:{
          required: true
        },
        txtDireccion:{
          required:true,
          minlength:4,
          maxlength:200
        }
      },
    validClass: "validation-valid-label",
     success: function(label) {
          label.addClass("validation-valid-label").text("Correcto.")
      },

       submitHandler: function (form) {
           enviar_frm();
        }
     });

     var form = $('#frmModal');

      $('#cbMoneda', form).change(function () {
           form.validate().element($(this)); //revalidate the chosen dropdown value and show error or success message for the input
       });

    $('#btnEditar').hide();

    $("#txtPIVA").TouchSpin({
        min: 1,
        max: 100,
        step: 1,
        decimals: 2,
        prefix: '%'
    });


    $("#txtPRET").TouchSpin({
        min: 0,
        max: 100,
        step: 1,
        decimals: 2,
        prefix: '%'
    });

    $("#txtMontoR").TouchSpin({
        min: 0.00,
        max: 100000000,
        step: 0.01,
        decimals: 2,
        prefix: '<i class="icon-cash3"></i>'
    });

    $('#txtNIT').mask('0000000-0');

  $.fn.modal.Constructor.prototype.enforceFocus = function() {};


});

  function limpiarform(){

    var form = $( "#frmModal" ).validate();
    form.resetForm();

  }


function newParametro()
 {
    openParametro('nuevo',null,null,null,null,null,null,null,null,null);
    $('#modal_iconified').modal('show');
 }
function openParametro(action, idparametro, nombre_empresa, propietario, numero_nit, porcentaje_iva, porcentaje_retencion, monto_retencion, idcurrency ,direccion_empresa)
 {

    $('#modal_iconified').on('shown.bs.modal', function () {
     var modal = $(this);
     if (action == 'nuevo'){

      $('#txtProceso').val('Registro');
      $('#txtID').val('');
      $('#txtEmpresa').val('');
      $('#txtPropietario').val('');
      $('#txtNIT').val('');
      $('#txtPIVA').val('');
      $('#txtPRET').val('');
      $('#txtMontoR').val('');
      $("#txtDireccion").val('');
      $("#cbMoneda").select2("val", "All");


      $('#txtEmpresa').prop( "disabled" , false);
      $('#txtNIT').prop( "disabled" , false);
      $('#txtPropietario').prop( "disabled" , false);
      $('#txtPIVA').prop( "disabled" , false);
      $('#txtPRET').prop( "disabled" , false);
      $('#txtMontoR').prop( "disabled" , false);
      $('#txtDireccion').prop( "disabled" , false);
      $('#cbMoneda').prop( "disabled" , false);


      $('#btnEditar').hide();
      $('#btnGuardar').show();
      limpiarform();

      modal.find('.title-form').text('Ingresar Parametro');
     }else if(action=='editar') {

      $('#modal_iconified').modal('show');

      $('#txtProceso').val('Edicion');
      $('#txtID').val(idparametro);
      $('#txtEmpresa').val(nombre_empresa);
      $('#txtPropietario').val(propietario);
      $('#txtNIT').val(numero_nit);
      $('#txtPIVA').val(porcentaje_iva);
      $('#txtPRET').val(porcentaje_retencion);
      $('#txtMontoR').val(monto_retencion);
      $("#txtDireccion").val(direccion_empresa);
      $("#cbMoneda").val(idcurrency).trigger("change");


      $('#txtEmpresa').prop( "disabled" , false);
      $('#txtNIT').prop( "disabled" , false);
      $('#txtPropietario').prop( "disabled" , false);
      $('#txtPIVA').prop( "disabled" , false);
      $('#txtPRET').prop( "disabled" , false);
      $('#txtMontoR').prop( "disabled" , false);
      $('#txtDireccion').prop( "disabled" , false);
      $('#cbMoneda').prop( "disabled" , false);


      $('#btnEditar').show();
      $('#btnGuardar').hide();

      modal.find('.title-form').text('Actualizar Parametro');
     } else if(action=='ver'){
      $('#txtProceso').val('');
      $('#txtID').val(idparametro);
      $('#txtEmpresa').val(nombre_empresa);
      $('#txtPropietario').val(propietario);
      $('#txtNIT').val(numero_nit);
      $('#txtPIVA').val(porcentaje_iva);
      $('#txtPRET').val(porcentaje_retencion);
      $('#txtMontoR').val(monto_retencion);
      $("#txtDireccion").val(direccion_empresa);
      $("#cbMoneda").val(idcurrency).trigger("change");


      $('#txtEmpresa').prop( "disabled" , true);
      $('#txtNIT').prop( "disabled" , true);
      $('#txtPropietario').prop( "disabled" , true);
      $('#txtPIVA').prop( "disabled" , true);
      $('#txtPRET').prop( "disabled" , true);
      $('#txtMontoR').prop( "disabled" , true);
      $('#txtDireccion').prop( "disabled" , true);
      $('#cbMoneda').prop( "disabled" , true);

      $('#btnEditar').hide();
      $('#btnGuardar').hide();

      modal.find('.title-form').text('Ver Parametro');
     }

  });

}

function enviar_frm()
{
  var urlprocess = 'web/ajax/ajxparametro.php';
  var proceso = $("#txtProceso").val();
  var id = $("#txtID").val();
  var nombre_empresa =$("#txtEmpresa").val();
  var propietario =$("#txtPropietario").val();
  var numero_nit =$("#txtNIT").val();
  var porcentaje_iva = $("#txtPIVA").val();
  var porcentaje_retencion = $('#txtPRET').val();
  var monto_retencion = $('#txtMontoR').val();
  var direccion_empresa = $("#txtDireccion").val();
  var idcurrency = $("#cbMoneda").val();

  var dataString='proceso='+proceso+'&id='+id+'&nombre_empresa='+nombre_empresa+'&propietario='+propietario;
  dataString+='&numero_nit='+numero_nit+'&porcentaje_iva='+porcentaje_iva+'&direccion_empresa='+direccion_empresa+'&idcurrency='+idcurrency;
  dataString+='&porcentaje_retencion='+porcentaje_retencion+'&monto_retencion='+monto_retencion;


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
                  text: "Parametro registrado",
                  confirmButtonColor: "#66BB6A",
                  type: "success"
              });

              $('#modal_iconified').modal('toggle');

              cargarDiv("#reload-div","web/ajax/reload-parametro.php");
              limpiarform();

              } else if(proceso == "Edicion") {


                  swal({
                      title: "Exito!",
                      text: "Parametro modificado",
                      confirmButtonColor: "#2196F3",
                      type: "info"
                  });
                   $('#modal_iconified').modal('toggle');
                  cargarDiv("#reload-div","web/ajax/reload-parametro.php");

              }

        } else if (data=="Duplicado"){

           swal({
                  title: "Lo sentimos!",
                  text: "Solo permitimos un parametro en el sistema",
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

function cargarDiv(div,url)
{
      $(div).load(url);
}
