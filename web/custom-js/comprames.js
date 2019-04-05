$(function () {

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

       Print_Report('Contado');
       e.preventDefault();
 });

$(document).on('click', '#print_credito', function(e){

       Print_Report('Credito');
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


  $('#txtMes').datetimepicker({
        locale: 'es',
        format: 'MM/YYYY',
        useCurrent:true,
        viewDate: moment()

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
        txtMes:{
          required: true
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

  $(document).on('click', '#detail_pay', function(e){

       var productId = $(this).data('id');
       detalle_compra(productId);
       e.preventDefault();
  });


});

function detalle_compra(VentaNo)
{
    $.ajax({

       type:"GET",
       url:"web/ajax/reload-detalle-compra.php?numero_transaccion="+VentaNo,
       success: function(data){
          $('#reload-detalle').html(data);
       }

   });

}

function buscar_datos()
{
 var mes = $("#txtMes").val();

    if(mes!="")
    {
        $.ajax({

           type:"GET",
           url:"web/ajax/reload-compras_mes.php?mes="+mes,
           success: function(data){
              $('#reload-div').html(data);
           }

       });

    } else {
            $.ajax({

           type:"GET",
           url:"web/ajax/reload-compras_mes.php?mes=empty",
           success: function(data){
              $('#reload-div').html(data);
           }

       });
    }

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
                        data: 'proceso=Anular_Compra&numero_transaccion='+productId,
                        dataType: 'json'
                        })
                        .done(function(response){
                         swal('Anulada!', response.message, response.status);
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


  var mes = $("#txtMes").val();
  var estado = $('#chkEstado').is(':checked') ? 1 : 0;

  if(estado == 0){

    if(mes!="")
    {
        if(Criterio == 'Vigentes')
        {
             window.open('reportes/Compras_Vigentes_Mes.php?mes='+mes,
            'win2',
            'status=yes,toolbar=yes,scrollbars=yes,titlebar=yes,menubar=yes,'+
            'resizable=yes,width=800,height=800,directories=no,location=no'+
            'fullscreen=yes');

        } else if (Criterio == 'Anuladas') {

             window.open('reportes/Compras_Anuladas_Mes.php?mes='+mes,
            'win2',
            'status=yes,toolbar=yes,scrollbars=yes,titlebar=yes,menubar=yes,'+
            'resizable=yes,width=600,height=600,directories=no,location=no'+
            'fullscreen=yes');

        } else if (Criterio == 'Contado') {

             window.open('reportes/Compras_Contado_Mes.php?mes='+mes,
            'win2',
            'status=yes,toolbar=yes,scrollbars=yes,titlebar=yes,menubar=yes,'+
            'resizable=yes,width=600,height=600,directories=no,location=no'+
            'fullscreen=yes');

        } else if (Criterio == 'Credito'){

             window.open('reportes/Compras_Credito_Mes.php?mes='+mes,
            'win2',
            'status=yes,toolbar=yes,scrollbars=yes,titlebar=yes,menubar=yes,'+
            'resizable=yes,width=600,height=600,directories=no,location=no'+
            'fullscreen=yes');
        }

    } else {


        swal({
                title: "Ops!",
                imageUrl: "web/assets/images/calendar.png",
                text: "Debes seleccionar el Mes",
                confirmButtonColor: "#EF5350"
         });



    }


  } else {
    if(mes!="")
    {
        if(Criterio == 'Vigentes')
        {
             window.open('reportes/ComprasD_Vigentes_Mes.php?mes='+mes,
            'win2',
            'status=yes,toolbar=yes,scrollbars=yes,titlebar=yes,menubar=yes,'+
            'resizable=yes,width=800,height=800,directories=no,location=no'+
            'fullscreen=yes');

        } else if (Criterio == 'Anuladas') {

             window.open('reportes/ComprasD_Anuladas_Mes.php?mes='+mes,
            'win2',
            'status=yes,toolbar=yes,scrollbars=yes,titlebar=yes,menubar=yes,'+
            'resizable=yes,width=600,height=600,directories=no,location=no'+
            'fullscreen=yes');

        } else if (Criterio == 'Contado') {

             window.open('reportes/ComprasD_Contado_Mes.php?mes='+mes,
            'win2',
            'status=yes,toolbar=yes,scrollbars=yes,titlebar=yes,menubar=yes,'+
            'resizable=yes,width=600,height=600,directories=no,location=no'+
            'fullscreen=yes');

        } else if (Criterio == 'Credito'){

             window.open('reportes/ComprasD_Credito_Mes.php?mes='+mes,
            'win2',
            'status=yes,toolbar=yes,scrollbars=yes,titlebar=yes,menubar=yes,'+
            'resizable=yes,width=600,height=600,directories=no,location=no'+
            'fullscreen=yes');
        }

    } else {


        swal({
                title: "Ops!",
                imageUrl: "web/assets/images/calendar.png",
                text: "Debes seleccionar el Mes",
                confirmButtonColor: "#EF5350"
         });



    }

  }



}
