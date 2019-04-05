$(function() {

  $(document).on('click', '#print_reporte', function(e){

       Print_Report();
       e.preventDefault();
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



     var validator2 = $("#frmSearch").validate({

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
        cbProducto:{
          required: true
        },
        txtCantidad:{
         required: true
        },
        txtFechaV:{
         required: true
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


    $('#btnEditar').hide();

        // Default initialization
    $(".styled, .multiselect-container input").uniform({
        radioClass: 'choice'
    });

        /*Evento change de ChkEstado en el cual al chequear o deschequear cambia el label*/
    $("#chkEstado").change(function() {
        if(this.checked) {
           $("#chkEstado").val(true);
           document.getElementById("lblchk").innerHTML = 'VIGENTE';
        } else {
          $("#chkEstado").val(false);
          document.getElementById("lblchk").innerHTML = 'VENCIDO';
        }
    });

  $.fn.modal.Constructor.prototype.enforceFocus = function() {};

  $('#txtFechaV').datetimepicker({
        locale: 'es',
        format: 'DD/MM/YYYY',
        minDate: moment().add(10,"days")

  });

  $("#txtCantidad").TouchSpin({
        min: 1,
        max: 100000000,
        step: 0.01,
        decimals: 2,
        prefix: '<i class="icon-box-add"></i>'
    });

    $('.select-search').select2();

   var form = $('#frmModal');
   $('#cbProducto', form).change(function () {
        form.validate().element($(this)); //revalidate the chosen dropdown value and show error or success message for the input
    });

 $(document).on('click', '#delete_product', function(e){

       var productId = $(this).data('id');
       SwalDelete(productId);
       e.preventDefault();
  });


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

function Max_Stock()
{
    var stock = "";
    var producto = $("#cbProducto").val();

    if(producto!=null){

      $.getJSON('web/ajax/ajxperecedero.php?producto='+producto,function(data){
            $.each(data,function(key,val){
              stock = val.stock;
            });

          $("#txtCantidad").trigger("touchspin.updatesettings", {max: stock});
      });

    }
}

  $("#cbProducto").change(function() {
     Max_Stock();
  });



function newPerecedero()
 {
    openPerecedero('nuevo',null,null,null,null);
    $('#modal_iconified').modal('show');
 }

function openPerecedero(action,fecha_vencimiento,cantidad_perecedero,estado_producto,idproducto)
{
      var mySwitch = new Switchery($('#chkEstado')[0], {
          size:"small",
          color: '#0D74E9'
      });

    $('#modal_iconified').on('shown.bs.modal', function () {
     var modal = $(this);

     if (action == 'nuevo'){

      $('#txtProceso').val('Registro');
      $('#txtCantidad').val('');
      $('#txtFechaV').val('');
      $("#cbProducto").select2("val", "All");
      setSwitchery(mySwitch, true);

      $('#txtCantidad').prop( "disabled" , false);
      $('#txtFechaV').prop( "disabled" , false);
      $('#cbProducto').prop( "disabled" , false);
      $('#chkEstado').prop( "disabled" , true);



      $('#btnEditar').hide();
      $('#btnGuardar').show();
      limpiarform();




      modal.find('.title-form').text('Ingresar Producto Perecedero');

     } else if(action=='editar') {

      $('#modal_iconified').modal('show');

      $('#txtProceso').val('Edicion');
      $('#txtCantidad').val(cantidad_perecedero);
      $('#txtFechaV').val(fecha_vencimiento);
      $("#cbProducto").val(idproducto).trigger("change");

      if (estado_producto == 'VIGENTE')
        {
          $("#chkEstado").val(true);
          setSwitchery(mySwitch, true);
          document.getElementById("chkEstado").checked = true;
          document.getElementById("lblchk").innerHTML = 'VIGENTE';
        }else {
          $("#chkEstado").val(false);
          setSwitchery(mySwitch, false);
          document.getElementById("chkEstado").checked = false;
          document.getElementById("lblchk").innerHTML = 'VENCIDO';
        }


      $('#txtCantidad').prop( "disabled" , false);
      $('#txtFechaV').prop( "disabled" , true);
      $('#cbProducto').prop( "disabled" , true);
      $('#chkEstado').prop( "disabled" , true);


      $('#btnEditar').show();
      $('#btnGuardar').hide();

      modal.find('.title-form').text('Actualizar Cantidad de Producto');

     } else if(action=='ver'){

      $('#txtProceso').val('');
      $('#txtCantidad').val(cantidad_perecedero);
      $('#txtFechaV').val(fecha_vencimiento);
      $("#cbProducto").val(idproducto).trigger("change");

      if (estado_producto == 'VIGENTE')
        {
          $("#chkEstado").val(true);
          setSwitchery(mySwitch, true);
          document.getElementById("chkEstado").checked = true;
          document.getElementById("lblchk").innerHTML = 'VIGENTE';
        }else {
          $("#chkEstado").val(false);
          setSwitchery(mySwitch, false);
          document.getElementById("chkEstado").checked = false;
          document.getElementById("lblchk").innerHTML = 'VENCIDO';
        }

      $('#txtCantidad').prop( "disabled" , true);
      $('#txtFechaV').prop( "disabled" , true);
      $('#cbProducto').prop( "disabled" , true);
      $('#chkEstado').prop( "disabled" , true);


      $('#btnEditar').hide();
      $('#btnGuardar').hide();


      modal.find('.title-form').text('Ver Producto Perecedero');

     }

  });

}

function buscar_datos()
{
  var fecha1 = $("#txtF1").val();
  var fecha2 = $("#txtF2").val();

    if(fecha1!="" && fecha2!="")
    {
        $.ajax({

           type:"GET",
           url:"web/ajax/reload-perecedero.php?fecha1="+fecha1+"&fecha2="+fecha2,
           success: function(data){
              $('#reload-div').html(data);
           }

       });
    } else {

      $.ajax({

           type:"GET",
           url:"web/ajax/reload-perecedero.php?fecha1=empty&fecha2=empty",
           success: function(data){
              $('#reload-div').html(data);
           }

       });

    }

}

function enviar_frm()
{
  var urlprocess = 'web/ajax/ajxperecedero.php';
  var proceso = $("#txtProceso").val();
  var fecha_vencimiento = $("#txtFechaV").val();
  var cantidad_perecedero = $("#txtCantidad").val();
  var idproducto = $("#cbProducto").val();

  var dataString='proceso='+proceso+'&fecha_vencimiento='+fecha_vencimiento+'&cantidad_perecedero='+cantidad_perecedero+'&idproducto='+idproducto;


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
                  text: "Producto registrado",
                  confirmButtonColor: "#66BB6A",
                  type: "success"
              });

              $('#modal_iconified').modal('toggle');

              cargarDiv("#reload-div","web/ajax/reload-perecedero.php?fecha1=empty&fecha2=empty");
              limpiarform();

              } else if(proceso == "Edicion") {


                  swal({
                      title: "Exito!",
                      text: "Cantidad modificada",
                      confirmButtonColor: "#2196F3",
                      type: "info"
                  });
                   $('#modal_iconified').modal('toggle');
                  cargarDiv("#reload-div","web/ajax/reload-perecedero.php?fecha1=empty&fecha2=empty");

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

    function SwalDelete(productId){
              swal({
                title: "¿Está seguro que desea borrar el producto?",
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
                        url: 'web/ajax/ajxperecedero.php',
                        type: 'POST',
                        data: 'proceso=Eliminar&idproducto='+productId+'&fecha_vencimiento=empty&cantidad_perecedero=caempty',
                        dataType: 'json'
                        })
                        .done(function(response){
                         swal('Eliminado!', response.message, response.status);
                         cargarDiv("#reload-div","web/ajax/reload-perecedero.php?fecha1=empty&fecha2=empty");
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

 function Print_Report() {

  var fecha1 = $("#txtF1").val();
  var fecha2 = $("#txtF2").val();

    if(fecha1!="" && fecha2!="")
    {
       window.open('reportes/Productos_Perecederos_Fechas.php?fecha1='+fecha1+'&fecha2='+fecha2,
      'win2',
      'status=yes,toolbar=yes,scrollbars=yes,titlebar=yes,menubar=yes,'+
      'resizable=yes,width=800,height=800,directories=no,location=no'+
      'fullscreen=yes');

    } else {

         window.open('reportes/Productos_Perecederos.php',
        'win2',
        'status=yes,toolbar=yes,scrollbars=yes,titlebar=yes,menubar=yes,'+
        'resizable=yes,width=800,height=800,directories=no,location=no'+
        'fullscreen=yes');

    }


}
