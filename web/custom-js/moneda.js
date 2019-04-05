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
        txtISO:{
          required: true,
          maxlength:3
        },
        txtLenguaje:{
          required: true,
          maxlength:3
        },
        txtNombre:{
          required: true,
          maxlength:35
        },
        txtMoneda:{
          required:true,
          maxlength:30
        },
        txtSimbolo:{
          required:true,
          maxlength:3
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

       $('#cbCompro', form).change(function () {
            form.validate().element($(this)); //revalidate the chosen dropdown value and show error or success message for the input
        });


    $('#btnEditar').hide();


        /*Evento change de ChkEstado en el cual al chequear o deschequear cambia el label*/
    $("#chkEstado").change(function() {
        if(this.checked) {
           $("#chkEstado").val(true);
           document.getElementById("lblchk").innerHTML = 'ACTIVO';
        } else {
          $("#chkEstado").val(false);
          document.getElementById("lblchk").innerHTML = 'INACTIVO';
        }
    });



  $.fn.modal.Constructor.prototype.enforceFocus = function() {};

});

  function limpiarform(){

    var form = $( "#frmModal" ).validate();
    form.resetForm();

  }


function newMoneda()
 {
    openMoneda('nuevo',null,null,null,null,null,null,null,null,null);
    $('#modal_iconified').modal('show');
 }
function openMoneda(action, idcurrency, CurrencyISO, Language, CurrencyName, Money, Symbol)
 {

    $('#modal_iconified').on('shown.bs.modal', function () {
     var modal = $(this);
     if (action == 'nuevo'){

      $('#txtProceso').val('Registro');
      $('#txtID').val('');
      $('#txtISO').val('');
      $('#txtLenguaje').val('');
      $('#txtNombre').val('');
      $('#txtMoneda').val('');
      $('#txtSimbolo').val('');


      $('#txtISO').prop( "disabled" , false);
      $('#txtLenguaje').prop( "disabled" , false);
      $('#txtNombre').prop( "disabled" , false);
      $('#txtMoneda').prop( "disabled" , false);
      $('#txtSimbolo').prop( "disabled" , false);


      $('#btnEditar').hide();
      $('#btnGuardar').show();
      limpiarform();

      modal.find('.title-form').text('Ingresar Moneda');
     }else if(action=='editar') {

      $('#modal_iconified').modal('show');

      $('#txtProceso').val('Edicion');
      $('#txtID').val(idcurrency);
      $('#txtISO').val(CurrencyISO);
      $('#txtLenguaje').val(Language);
      $('#txtNombre').val(CurrencyName);
      $('#txtMoneda').val(Money);
      $('#txtSimbolo').val(Symbol);


      $('#txtISO').prop( "disabled" , false);
      $('#txtLenguaje').prop( "disabled" , false);
      $('#txtNombre').prop( "disabled" , false);
      $('#txtMoneda').prop( "disabled" , false);
      $('#txtSimbolo').prop( "disabled" , false);


      $('#btnEditar').show();
      $('#btnGuardar').hide();

      modal.find('.title-form').text('Actualizar Moneda');
     } else if(action=='ver'){
      $('#txtProceso').val('');
      $('#txtID').val(idcurrency);
      $('#txtISO').val(CurrencyISO);
      $('#txtLenguaje').val(Language);
      $('#txtNombre').val(CurrencyName);
      $('#txtMoneda').val(Money);
      $('#txtSimbolo').val(Symbol);


      $('#txtISO').prop( "disabled" , true);
      $('#txtLenguaje').prop( "disabled" , true);
      $('#txtNombre').prop( "disabled" , true);
      $('#txtMoneda').prop( "disabled" , true);
      $('#txtSimbolo').prop( "disabled" , true);



      $('#btnEditar').hide();
      $('#btnGuardar').hide();

      modal.find('.title-form').text('Ver Moneda');
     }

  });

}

function enviar_frm()
{
  var urlprocess = 'web/ajax/ajxmoneda.php';
  var proceso = $("#txtProceso").val();
  var id = $("#txtID").val();
  var CurrencyISO =$("#txtISO").val();
  var Language =$("#txtLenguaje").val();
  var CurrencyName =$("#txtNombre").val();
  var Money =$("#txtMoneda").val();
  var Symbol =$("#txtSimbolo").val();


  var dataString='proceso='+proceso+'&id='+id+'&CurrencyISO='+CurrencyISO+'&Language='+Language+'&CurrencyName='+CurrencyName;
  dataString+='&Money='+Money+'&Symbol='+Symbol;

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
                  text: "Moneda registrada",
                  confirmButtonColor: "#66BB6A",
                  type: "success"
              });

              $('#modal_iconified').modal('toggle');

              cargarDiv("#reload-div","web/ajax/reload-moneda.php");
              limpiarform();

              } else if(proceso == "Edicion") {


                  swal({
                      title: "Exito!",
                      text: "Moneda Modificada",
                      confirmButtonColor: "#2196F3",
                      type: "info"
                  });
                   $('#modal_iconified').modal('toggle');
                  cargarDiv("#reload-div","web/ajax/reload-moneda.php");

              }

        } else if (data=="Duplicado"){

           swal({
                  title: "Ops!",
                  text: "Esta moneda ya esiste",
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
