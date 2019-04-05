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

function buscar_datos()
{
    $.ajax({

       type:"GET",
       url:"web/ajax/reload-ventas_dia.php",
       success: function(data){
          $('#reload-div').html(data);
       }

   });

}

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

function Imprimir_Ticket(VentaNo)
{
   window.open('reportes/TicketV.php?venta='+btoa(VentaNo),
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
                        data: 'proceso=Anular_Venta&numero_transaccion='+productId,
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
                         swal('Finalizada!', response.Diasage, response.status);
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

  var estado = $('#chkEstado').is(':checked') ? 1 : 0;

  if(estado == 0){

    if(Criterio == 'Vigentes')
    {
         window.open('reportes/Ventas_Vigentes_Dia.php',
        'win2',
        'status=yes,toolbar=yes,scrollbars=yes,titlebar=yes,menubar=yes,'+
        'resizable=yes,width=800,height=800,directories=no,location=no'+
        'fullscreen=yes');

    } else if (Criterio == 'Anuladas') {

         window.open('reportes/Ventas_Anuladas_Dia.php',
        'win2',
        'status=yes,toolbar=yes,scrollbars=yes,titlebar=yes,menubar=yes,'+
        'resizable=yes,width=600,height=600,directories=no,location=no'+
        'fullscreen=yes');

    } else if (Criterio == 'Contado') {

         window.open('reportes/Ventas_Contado_Dia.php',
        'win2',
        'status=yes,toolbar=yes,scrollbars=yes,titlebar=yes,menubar=yes,'+
        'resizable=yes,width=600,height=600,directories=no,location=no'+
        'fullscreen=yes');

    } else if (Criterio == 'Credito'){

         window.open('reportes/Ventas_Credito_Dia.php',
        'win2',
        'status=yes,toolbar=yes,scrollbars=yes,titlebar=yes,menubar=yes,'+
        'resizable=yes,width=600,height=600,directories=no,location=no'+
        'fullscreen=yes');
    }

  } else {

    if(Criterio == 'Vigentes')
    {
         window.open('reportes/VentasD_Vigentes_Dia.php',
        'win2',
        'status=yes,toolbar=yes,scrollbars=yes,titlebar=yes,menubar=yes,'+
        'resizable=yes,width=800,height=800,directories=no,location=no'+
        'fullscreen=yes');

    } else if (Criterio == 'Anuladas') {

         window.open('reportes/VentasD_Anuladas_Dia.php',
        'win2',
        'status=yes,toolbar=yes,scrollbars=yes,titlebar=yes,menubar=yes,'+
        'resizable=yes,width=600,height=600,directories=no,location=no'+
        'fullscreen=yes');

    } else if (Criterio == 'Contado') {

         window.open('reportes/VentasD_Contado_Dia.php',
        'win2',
        'status=yes,toolbar=yes,scrollbars=yes,titlebar=yes,menubar=yes,'+
        'resizable=yes,width=600,height=600,directories=no,location=no'+
        'fullscreen=yes');

    } else if (Criterio == 'Credito'){

         window.open('reportes/VentasD_Credito_Dia.php',
        'win2',
        'status=yes,toolbar=yes,scrollbars=yes,titlebar=yes,menubar=yes,'+
        'resizable=yes,width=600,height=600,directories=no,location=no'+
        'fullscreen=yes');
    }


  }

}
