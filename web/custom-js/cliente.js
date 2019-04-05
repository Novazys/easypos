
$(function() {

  $(document).on('click', '#print_activos', function(e){

       Print_Report('Activos');
       e.preventDefault();
  });

  $(document).on('click', '#print_inactivos', function(e){

       Print_Report('Inactivos');
       e.preventDefault();
 });


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

// Styled checkboxes, radios, bootstrap switch
            if (element.parents('div').hasClass("checker") || element.parents('div').hasClass("choice") || element.parent().hasClass('bootstrap-switch-container') ) {
                if(element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                    error.appendTo( element.parent().parent().parent().parent() );
                }
                 else {
                    error.appendTo( element.parent().parent().parent().parent().parent() );
                }
            }

            // Unstyled checkboxes, radios
            else if (element.parents('div').hasClass('checkbox') || element.parents('div').hasClass('radio')) {
                error.appendTo( element.parent().parent().parent() );
            }

            // Input with icons and Select2
            else if (element.parents('div').hasClass('has-feedback') || element.hasClass('select2-hidden-accessible')) {
                error.appendTo( element.parent() );
            }

            // Inline checkboxes, radios
            else if (element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                error.appendTo( element.parent().parent() );
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
          maxlength:90,
          minlength: 4,
          required: true,
          lettersonly:true
        },
        txtNIT:{
          maxlength:9,
          minlength: 9
        },
        txtEmail:{
          email:true
        },
        txtTelefono:{
          maxlength:9,
          minlength: 1
        },
        txtGiro:{
          maxlength:80
        },
        txtDireccion:{
          maxlength:100,
          minlength: 4
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

     $("#txtLimitC").TouchSpin({
         min: 0.00,
         max: 100000,
         step: 0.01,
         decimals: 2,
         prefix: '$'
     });

    $('#btnEditar').hide();

    $('#txtTelefono').mask('0000-0000');

    $('#txtNIT').mask('0000000-0');



        /*Evento change de ChkEstado en el cual al chequear o deschequear cambia el label*/
    $("#chkEstado").change(function() {
        if(this.checked) {
           $("#chkEstado").val(true);
           document.getElementById("lblchk").innerHTML = 'VIGENTE';
        } else {
          $("#chkEstado").val(false);
          document.getElementById("lblchk").innerHTML = 'DESCONTINUADO';
        }
    });

  $.fn.modal.Constructor.prototype.enforceFocus = function() {};


});

  function limpiarform(){

    var form = $( "#frmModal" ).validate();
    form.resetForm();

  }

  function setSwitchery(switchElement, checkedBool) {
    if((checkedBool && !switchElement.isChecked()) || (!checkedBool && switchElement.isChecked())) {
        switchElement.setPosition(true);
        switchElement.handleOnchange(true);
    }
}

    // Styled checkboxes, radios
    $(".styled, .multiselect-container input").uniform({ radioClass: 'choice' });

function newCliente()
 {
    openCliente('nuevo',null,null,null,null,null,null,null,null,null);
    $('#modal_iconified').modal('show');
 }
function openCliente(action, idcliente, codigo_cliente, nombre_cliente, numero_nit, direccion, numero_telefono, email, giro ,limite_credito ,estado)
 {
      var mySwitch = new Switchery($('#chkEstado')[0], {
          size:"small",
          color: '#0D74E9'
      });

    $('#modal_iconified').on('shown.bs.modal', function () {
     var modal = $(this);
     if (action == 'nuevo'){

      $('#txtProceso').val('Registro');
      $('#txtID').val('');
      $('#txtCodigo').val('');
      $('#txtNombre').val('');
      $('#txtNIT').val('');
      $('#txtDireccion').val('');
      $('#txtTelefono').val('');
      $('#txtEmail').val('');
      $('#txtGiro').val('');
      $('#txtLimitC').val('');

      setSwitchery(mySwitch, true);

      $('#txtNombre').prop( "disabled" , false);
      $('#txtNIT').prop( "disabled" , false);
      $('#txtTelefono').prop( "disabled" , false);
      $('#txtEmail').prop( "disabled" , false);
      $('#txtGiro').prop( "disabled" , false);
      $('#txtDireccion').prop( "disabled" , false);
      $('#txtLimitC').prop("disabled",false);
      $('#chkEstado').prop( "disabled" , true);


      $('#btnEditar').hide();
      $('#btnGuardar').show();
      limpiarform();

      modal.find('.title-form').text('Ingresar Cliente');
     }else if(action=='editar') {

      $('#modal_iconified').modal('show');

      $('#txtProceso').val('Edicion');
      $('#txtID').val(idcliente);
      $('#txtCodigo').val(codigo_cliente);
      $('#txtNombre').val(nombre_cliente);
      $('#txtNIT').val(numero_nit);
      $('#txtDireccion').val(direccion);
      $('#txtTelefono').val(numero_telefono);
      $('#txtEmail').val(email);
      $('#txtGiro').val(giro);
      $('#txtLimitC').val(limite_credito);


      if (estado == '1')
        {
          $("#chkEstado").val(true);
          setSwitchery(mySwitch, true);
          document.getElementById("chkEstado").checked = true;
          document.getElementById("lblchk").innerHTML = 'VIGENTE';
        }else {
          $("#chkEstado").val(false);
          setSwitchery(mySwitch, false);
          document.getElementById("chkEstado").checked = false;
          document.getElementById("lblchk").innerHTML = 'DESCONTINUADO';
        }


      $('#txtNombre').prop( "disabled" , false);
      $('#txtNIT').prop( "disabled" , false);
      $('#txtTelefono').prop( "disabled" , false);
      $('#txtEmail').prop( "disabled" , false);
      $('#txtDireccion').prop( "disabled" , false);
      $('#txtGiro').prop( "disabled" , false);
      $('#txtLimitC').prop("disabled",false);
      $('#chkEstado').prop( "disabled" , false);


      $('#btnEditar').show();
      $('#btnGuardar').hide();

      modal.find('.title-form').text('Actualizar Cliente');
     } else if(action=='ver'){
      $('#txtProceso').val('');
      $('#txtID').val(idcliente);
      $('#txtCodigo').val(codigo_cliente);
      $('#txtNombre').val(nombre_cliente);
      $('#txtDireccion').val(direccion);
      $('#txtNIT').val(numero_nit);
      $('#txtTelefono').val(numero_telefono);
      $('#txtEmail').val(email);
      $('#txtGiro').val(giro);
      $('#txtLimitC').val(limite_credito);

      if (estado == '1')
        {
          $("#chkEstado").val(true);
          setSwitchery(mySwitch, true);
          document.getElementById("chkEstado").checked = true;
          document.getElementById("lblchk").innerHTML = 'VIGENTE';
        }else {
          $("#chkEstado").val(false);
          setSwitchery(mySwitch, false);
          document.getElementById("chkEstado").checked = false;
          document.getElementById("lblchk").innerHTML = 'DESCONTINUADO';
        }



      $('#txtNombre').prop( "disabled" , true);
      $('#txtNIT').prop( "disabled" , true);
      $('#txtTelefono').prop( "disabled" , true);
      $('#txtEmail').prop( "disabled" , true);
      $('#txtLimitC').prop( "disabled" , true);
      $('#txtDireccion').prop( "disabled" , true);
      $('#txtGiro').prop( "disabled" , true);
      $('#txtLimitC').prop("disabled",true);
      $('#chkEstado').prop( "disabled" , true);



      $('#btnEditar').hide();
      $('#btnGuardar').hide();

      modal.find('.title-form').text('Ver Cliente');
     }

  });

}

function enviar_frm()
{
  var urlprocess = 'web/ajax/ajxcliente.php';
  var proceso = $("#txtProceso").val();
  var id = $("#txtID").val();
  var nombre_cliente =$("#txtNombre").val();
  var numero_telefono =$("#txtTelefono").val();
  var numero_nit =$("#txtNIT").val();
  var direccion =$("#txtDireccion").val();
  var email =$("#txtEmail").val();
  var giro =$("#txtGiro").val();
  var estado = $('#chkEstado').is(':checked') ? 1 : 0;
  var limite_credito = $('#txtLimitC').val();

  var dataString='proceso='+proceso+'&id='+id+'&nombre_cliente='+nombre_cliente+'&numero_telefono='+numero_telefono+'&estado='+estado;
  dataString+='&numero_nit='+numero_nit+'&email='+email+'&direccion='+direccion+'&limite_credito='+limite_credito+'&giro='+giro;

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
                  text: "Cliente registrado",
                  confirmButtonColor: "#66BB6A",
                  type: "success"
              });

              $('#modal_iconified').modal('toggle');

              cargarDiv("#reload-div","web/ajax/reload-cliente.php");
              limpiarform();

              } else if(proceso == "Edicion") {


                  swal({
                      title: "Exito!",
                      text: "Cliente modificado",
                      confirmButtonColor: "#2196F3",
                      type: "info"
                  });
                   $('#modal_iconified').modal('toggle');
                  cargarDiv("#reload-div","web/ajax/reload-cliente.php");

              }

        } else if (data=="Duplicado"){

           swal({
                  title: "Ops!",
                  text: "El dato que ingresaste ya existe",
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

function Print_Report(Criterio)
{

  if(Criterio == 'Activos')
  {
       window.open('reportes/Clientes_Activos.php',
      'win2',
      'status=yes,toolbar=yes,scrollbars=yes,titlebar=yes,menubar=yes,'+
      'resizable=yes,width=800,height=800,directories=no,location=no'+
      'fullscreen=yes');

  } else if (Criterio == 'Inactivos') {

       window.open('reportes/Clientes_Inactivos.php',
      'win2',
      'status=yes,toolbar=yes,scrollbars=yes,titlebar=yes,menubar=yes,'+
      'resizable=yes,width=600,height=600,directories=no,location=no'+
      'fullscreen=yes');
  }

}
