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
        cbCompro:{
          required: true
        },
        txtFechaT:{
          required: true
        },
        txtNoResolucion:{
          required: true
        },
        txtNoResolucionF:{
          required: true
        },
        txtNoSerie:{
          required:true
        },
        txtDel:{
          required:true
        },
        txtAl:{
          required:true
        },
        txtDel:{
          required:true
        },
        txtDispo:{
          required:true
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

  $('#txtFechaT').datetimepicker({
        locale: 'es',
        format: 'DD/MM/YYYY'

  });

    $('#btnEditar').hide();


 $('.select-search').select2();

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

      $("#cbCompro").select2("val", "All");

    $("#txtDel").TouchSpin({
        min: 1,
        max: 100000000,
        step: 1
    });

    $("#txtUsados").TouchSpin({
        min: 0,
        max: 100000000,
        step: 1
    });

    $("#txtDispo").TouchSpin({
        min: 1,
        max: 100000000,
        step: 1
    });

    $("#txtAl").TouchSpin({
        min: 1,
        max: 100000000,
        step: 1
    });

});

  function limpiarform(){

    var form = $( "#frmModal" ).validate();
    form.resetForm();

  }


function newTiraje()
 {
    openTiraje('nuevo',null,null,null,null,null,null,null,null,null);
    $('#modal_iconified').modal('show');
 }
function openTiraje(action, idtiraje, fecha_resolucion, numero_resolucion,  numero_resolucion_fact, serie, desde, hasta, disponibles, usados, idcomprobante)
 {

    $('#modal_iconified').on('shown.bs.modal', function () {
     var modal = $(this);
     if (action == 'nuevo'){

      $('#txtProceso').val('Registro');
      $('#txtID').val('');
      $('#txtFechaT').val('');
      $('#txtNoResolucion').val('');
      $('#txtNoResolucionF').val('');
      $('#txtNoSerie').val('');
      $('#txtDel').val('');
      $('#txtAl').val('');
      $('#txtDispo').val('');
      $('#txtUsados').val('');
      $("#cbCompro").select2("val", "All");

      $("#txtAl").change(function() {
        var disponibles = $("#txtAl").val();
         $("#txtDispo").val(disponibles);
      });

      $('#txtFechaT').prop( "disabled" , false);
      $('#txtNoResolucion').prop( "disabled" , false);
      $('#txtNoResolucionF').prop( "disabled" , false);
      $('#txtNoSerie').prop( "disabled" , false);
      $('#txtDel').prop( "disabled" , false);
      $('#txtAl').prop( "disabled" , false);
      $('#txtDispo').prop( "disabled" , true);
      $('#txtUsados').prop( "disabled" , true);
      $('#cbCompro').prop( "disabled" , false);

      $('#btnEditar').hide();
      $('#btnGuardar').show();
      limpiarform();

      modal.find('.title-form').text('Ingresar Tiraje');
     }else if(action=='editar') {

      $('#modal_iconified').modal('show');

      $('#txtProceso').val('Edicion');
      $('#txtID').val(idtiraje);
      $('#txtFechaT').val(fecha_resolucion);
      $('#txtNoResolucion').val(numero_resolucion);
      $('#txtNoResolucionF').val(numero_resolucion_fact);
      $('#txtNoSerie').val(serie);
      $('#txtDel').val(desde);
      $('#txtAl').val(hasta);
      $('#txtDispo').val(disponibles);
      $('#txtUsados').val(usados);
      $("#cbCompro").val(idcomprobante).trigger("change");


      $('#txtFechaT').prop( "disabled" , false);
      $('#txtNoResolucion').prop( "disabled" , false);
      $('#txtNoResolucionF').prop( "disabled" , false);
      $('#txtNoSerie').prop( "disabled" , false);
      $('#txtDel').prop( "disabled" , false);
      $('#txtAl').prop( "disabled" , false);
      $('#txtDispo').prop( "disabled" , false);
      $('#txtUsados').prop( "disabled" , false);
      $('#cbCompro').prop( "disabled" , false);

      $('#btnEditar').show();
      $('#btnGuardar').hide();

      modal.find('.title-form').text('Actualizar Tiraje');
     } else if(action=='ver'){
      $('#txtProceso').val('');
      $('#txtID').val(idtiraje);
      $('#txtFechaT').val(fecha_resolucion);
      $('#txtNoResolucion').val(numero_resolucion);
       $('#txtNoResolucionF').val(numero_resolucion_fact);
      $('#txtNoSerie').val(serie);
      $('#txtDel').val(desde);
      $('#txtAl').val(hasta);
      $('#txtDispo').val(disponibles);
      $('#txtUsados').val(usados);
      $("#cbCompro").val(idcomprobante).trigger("change");


      $('#txtFechaT').prop( "disabled" , true);
      $('#txtNoResolucion').prop( "disabled" , true);
      $('#txtNoResolucionF').prop( "disabled" , true);
      $('#txtNoSerie').prop( "disabled" , true);
      $('#txtDel').prop( "disabled" , true);
      $('#txtAl').prop( "disabled" , true);
      $('#txtDispo').prop( "disabled" , true);
      $('#txtUsados').prop( "disabled" , true);
      $('#cbCompro').prop( "disabled" , true);


      $('#btnEditar').hide();
      $('#btnGuardar').hide();

      modal.find('.title-form').text('Ver Tiraje');
     }

  });

}

function enviar_frm()
{
  var urlprocess = 'web/ajax/ajxtiraje.php';
  var proceso = $("#txtProceso").val();
  var id = $("#txtID").val();
  var fecha_resolucion =$("#txtFechaT").val();
  var numero_resolucion =$("#txtNoResolucion").val();
  var numero_resolucion_fact =$("#txtNoResolucionF").val();
  var serie =$("#txtNoSerie").val();
  var desde =$("#txtDel").val();
  var hasta =$("#txtAl").val();
  var disponibles =$("#txtDispo").val();
  var idcomprobante =$("#cbCompro").val();

  var dataString='proceso='+proceso+'&id='+id+'&fecha_resolucion='+fecha_resolucion+'&numero_resolucion='+numero_resolucion+'&serie='+serie;
  dataString+='&desde='+desde+'&hasta='+hasta+'&disponibles='+disponibles+'&idcomprobante='+idcomprobante+'&numero_resolucion_fact='+numero_resolucion_fact;

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
                  text: "Tiraje registrado",
                  confirmButtonColor: "#66BB6A",
                  type: "success"
              });

              $('#modal_iconified').modal('toggle');

              cargarDiv("#reload-div","web/ajax/reload-tiraje.php");
              limpiarform();

              } else if(proceso == "Edicion") {


                  swal({
                      title: "Exito!",
                      text: "Tiraje modificado",
                      confirmButtonColor: "#2196F3",
                      type: "info"
                  });
                   $('#modal_iconified').modal('toggle');
                  cargarDiv("#reload-div","web/ajax/reload-tiraje.php");

              }

        } else if (data=="Duplicado"){

           swal({
                  title: "Ops!",
                  text: "No permitimos 2 usuarios a un empleado",
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
