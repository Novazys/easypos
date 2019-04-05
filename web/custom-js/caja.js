/* ------------------------------------------------------------------------------
 *
 *  # C3.js - bars and pies
 *
 *  Demo setup of bars, pies and chart combinations
 *
 *  Version: 1.0
 *  Latest update: August 1, 2015
 *
 * ---------------------------------------------------------------------------- */

$(function () {


  $(document).on('click', '#print_diario', function(e){

        bootbox.dialog({
                title: "Imprimir Corte Z - Diario",
                size: "small",
                message: '<div class="row">  ' +
                    '<div class="col-md-12">' +
                        '<form class="form-validate-jquery">' +
                            '<div class="form-group">' +
                                '<div class="col-md-6">' +
                                  '<div class="input-group">'+
                                    '<span class="input-group-addon"><i class="icon-calendar3"></i></span>'+
                                    '<input id="txtDia" name="txtDia" type="text" placeholder="Ingrese el dia" class="form-control">' +
                                    '</div>'+
                                '</div>' +
                            '</div>' +
                        '</form>' +
                    '</div>' +
                    '</div>',
                buttons: {
                    success: {
                        label: "<i class='icon-printer2 position-left'></i> Imprimir Corte",
                        className: "btn-info",
                        callback: function () {

                           var dia = $('#txtDia').val();
                           if(dia!=""){
                            Print_Report('Z-Diario',dia);
                           } else {

                               swal({
                                      title: "Ops!",
                                      text: "Debes seleccionar un dia",
                                      confirmButtonColor: "#EF5350",
                                      type: "warning"
                                });
                           }

                        }
                    }
                }
            }
        );

    $('#txtDia').datetimepicker({
          locale: 'es',
          format: 'DD/MM/YYYY',
          useCurrent:true,
          viewDate: moment()

    });

    e.preventDefault();

  });

  $(document).on('click', '#print_mes', function(e){

      bootbox.dialog({
                title: "Imprimir Corte Z - Mensual",
                size: "small",
                message: '<div class="row">  ' +
                    '<div class="col-md-12">' +
                        '<form class="form-validate-jquery">' +
                            '<div class="form-group">' +
                                '<div class="col-md-6">' +
                                  '<div class="input-group">'+
                                    '<span class="input-group-addon"><i class="icon-calendar3"></i></span>'+
                                    '<input id="txtMes" name="txtMes" type="text" placeholder="Ingrese el Mes" class="form-control">' +
                                    '</div>'+
                                '</div>' +
                            '</div>' +
                        '</form>' +
                    '</div>' +
                    '</div>',
                buttons: {
                    success: {
                        label: "<i class='icon-printer2 position-left'></i> Imprimir Corte",
                        className: "btn-info",
                        callback: function () {

                          var mes = $("#txtMes").val();

                            if(mes!="")
                            {
                              Print_Report('Z-Mensual',mes);

                            } else {

                               swal({
                                      title: "Ops!",
                                      text: "Debes seleccionar un mes",
                                      confirmButtonColor: "#EF5350",
                                      type: "warning"
                                });

                            }


                        }
                    }
                }
            }
        );

    $('#txtMes').datetimepicker({
          locale: 'es',
          format: 'MM/YYYY',
          useCurrent:true,
          viewDate: moment()

    });

       e.preventDefault();
  });


    $("#txtMonto").TouchSpin({
        min: 0.01,
        max: 100000000,
        step: 0.01,
        decimals: 2,
        prefix: '$'
    });

    $("#txtCantidad").TouchSpin({
        min: 0.01,
        max: 100000000,
        step: 0.01,
        decimals: 2,
        prefix: '$'
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


    jQuery.validator.addMethod("lettersonly", function(value, element) {
        return this.optional(element) || /^[a-z\s, . ()]+$/i.test(value);
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
        txtMonto:{
          min:0.01,
          required: true
        },
        txtDescripcion:{
          maxlength:80,
          minlength: 4,
          required: true,
          lettersonly:true
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



  var validator = $("#frmMonto").validate({

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
        txtCantidad:{
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


 $.getJSON('web/ajax/ajxcaja.php?movimientos=view',function(data){

 	$.each(data,function(key,val){

      var monto_inicial = val.p_monto_inicial;
	    var ingresos = val.p_ingresos;
	    var devoluciones = val.p_devoluciones;
	    var prestamos = val.p_prestamos;
	    var gastos =val.p_gastos;
	   	var c_ingresos = val.c_ingresos;
	    var c_devoluciones = val.c_devoluciones;
	    var c_prestamos = val.c_prestamos;
	    var c_gastos =val.c_gastos;

	    $("#span-ing").text(c_ingresos);
	    $("#span-dev").text(c_devoluciones);
	    $("#span-pre").text(c_prestamos);
	    $("#span-gas").text(c_gastos);

		    // Generate chart
		    var pie_chart = c3.generate({
		        bindto: '#c3-pie-chart',
		        size: { width: 500 },
		        color: {
		            pattern: ['#37474f','#5CB85C', '#E9573F', '#F6BB42', '#63D3E9']
		        },
		        data: {
		            columns: [
                    ['MONTO INICIAL', parseFloat(monto_inicial)],
		                ['INGRESOS', parseFloat(ingresos)],
		                ['DEVOLUCIONES', parseFloat(devoluciones)],
		                ['PRESTAMOS', parseFloat(prestamos)],
		                ['GASTOS', parseFloat(gastos)],
		            ],
		            type : 'pie'
		        }
		    });


	 	}); // end each


	 }); // getjson


});

function newMovimiento()
{
    openMovimiento('nuevo',null);
    $('#modal_iconified_movimiento').modal('show');
}

function openMovimiento(action,id)
 {
    $('#modal_iconified_movimiento').on('shown.bs.modal', function () {
     var modal = $(this);
     if (action == 'devolucion'){

      $('#txtProceso').val('Devolucion');
      $('#txtMonto').val('');
      $('#txtDescripcion').val('');

      $('#btnGuardar').show();


      modal.find('.title-form').text('Devolucion de Efectivo de Caja');
     }else if(action=='prestamo') {

      $('#modal_iconified_movimiento').modal('show');

      $('#txtProceso').val('Prestamo');
      $('#txtMonto').val('');
      $('#txtDescripcion').val('');

      $('#btnGuardar').show();

      modal.find('.title-form').text('Prestamo de Efectivo de Caja');
     } else if(action=='gasto'){

     $('#modal_iconified_movimiento').modal('show');

      $('#txtProceso').val('Gasto');
      $('#txtMonto').val('');
      $('#txtDescripcion').val('');

      $('#btnGuardar').show();


      modal.find('.title-form').text('Gasto de Efectivo de Caja');
     }

  });

    $('#modal_iconified').on('shown.bs.modal', function () {
     var modal = $(this);
     if (action == 'abrir'){

      $('#txtProceso').val('Abrir');
      $('#txtCantidad').val('');

      $('#btnGuardar').show();

      modal.find('.title-form').text('Abrir Caja');
     }else if(action=='cerrar') {

      $('#modal_iconified').modal('show');

       var saldo = $("#Diferencia").text();
       saldo = parseFloat(saldo.substr(2,7));

      $('#txtProceso').val('Cerrar');
      $('#txtCantidad').val(saldo.toFixed(2));

      $('#btnGuardar').show();

      modal.find('.title-form').text('Cerrar Caja');
     } else if (action == 'update'){

      var saldo = $("#inicial").text();
      saldo = parseFloat(saldo.substr(2,7));

       $('#txtProceso').val('Update');
       $('#txtCantidad').val(saldo.toFixed(2));

       $('#btnGuardar').show();

        modal.find('.title-form').text('Editar Monto Inicial de Caja');
     }

  });


}

function cargarDiv(div,url)
{
      $(div).load(url);
}

function enviar_frm()
{
  var urlprocess = 'web/ajax/ajxcaja.php';
  var proceso = $("#txtProceso").val();
  var monto = $("#txtMonto").val();
  var cantidad = $("#txtCantidad").val();
  var descripcion = $("#txtDescripcion").val();

  var dataString='proceso='+proceso+'&monto='+monto+'&cantidad='+cantidad+'&descripcion='+descripcion;


  $.ajax({
     type:'POST',
     url:urlprocess,
     data: dataString,
     dataType: 'json',
     success: function(data){

        if(data=="Validado"){

             if(proceso=="Devolucion"){

              swal({
                  title: "Exito!",
                  text: "Devolucion registrada",
                  confirmButtonColor: "#66BB6A",
                  type: "success"
              });

              $('#modal_iconified_movimiento').modal('toggle');

              cargarDiv("#reload-div","web/ajax/reload-caja.php");


              } else if(proceso == "Prestamo") {

	              swal({
	                  title: "Exito!",
	                  text: "Prestamo registrado",
	                  confirmButtonColor: "#66BB6A",
	                  type: "success"
	              });

                $('#modal_iconified_movimiento').modal('toggle');
                cargarDiv("#reload-div","web/ajax/reload-caja.php");

              }

              else if(proceso == "Gasto") {

	              swal({
	                  title: "Exito!",
	                  text: "Gasto registrado",
	                  confirmButtonColor: "#66BB6A",
	                  type: "success"
	              });

                  $('#modal_iconified_movimiento').modal('toggle');
                  cargarDiv("#reload-div","web/ajax/reload-caja.php");

              }  else if(proceso == "Abrir") {

                swal({
                    title: "Exito!",
                    text: "Caja Abierta con Exito!",
                    confirmButtonColor: "#66BB6A",
                    type: "success"
                });

                  $('#modal_iconified').modal('toggle');
                  cargarDiv("#reload-div","web/ajax/reload-caja.php");

              }  else if(proceso == "Cerrar") {

                swal({
                    title: "Exito!",
                    text: "Caja Cerrada con Exito",
                    confirmButtonColor: "#66BB6A",
                    type: "success"
                });

                  $('#modal_iconified').modal('toggle');
                  cargarDiv("#reload-div","web/ajax/reload-caja.php");

              }  else if(proceso == "Update") {

                swal({
                    title: "Exito!",
                    text: "Monto Inicial Editado con Exito",
                    confirmButtonColor: "#66BB6A",
                    type: "success"
                });

                  $('#modal_iconified').modal('toggle');
                  cargarDiv("#reload-div","web/ajax/reload-caja.php");

              }

        } else if (data=="Duplicado"){

           swal({
                  title: "Ops!",
                  text: "NO se puede abrir otra caja con la fecha de hoy",
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


function Print_Report(Criterio,parameter)
{

      if(Criterio == "Z-Diario") {


      /* window.open('reportes/Corte_Z_Dia.php?day='+parameter,
      'win2','status=yes,toolbar=yes,scrollbars=yes,titlebar=yes,menubar=yes,'+
      'resizable=yes,width=800,height=800,directories=no,location=no'+
      'fullscreen=yes');*/

      window.location.href = 'http://localhost/easyposgt/reportes/Corte_Z_Dia_D.php?day='+parameter;

      } else if (Criterio == "Z-Mensual") {

      /* window.open('reportes/Corte_Z_Mes.php?mes='+parameter,
      'win2','status=yes,toolbar=yes,scrollbars=yes,titlebar=yes,menubar=yes,'+
      'resizable=yes,width=800,height=800,directories=no,location=no'+
      'fullscreen=yes');*/

      window.location.href = 'http://localhost/easyposgt/reportes/Corte_Z_Mes_D.php?mes='+parameter;

      } else if (Criterio == "Caja") {

       window.open('reportes/Salidas_Inventario.php?mes='+mes,
      'win2','status=yes,toolbar=yes,scrollbars=yes,titlebar=yes,menubar=yes,'+
      'resizable=yes,width=800,height=800,directories=no,location=no'+
      'fullscreen=yes');

      }

     /* } else {


          swal({
                  title: "Ops!",
                  text: "Debes seleccionar el Mes",
                  confirmButtonColor: "#EF5350",
                  type: "warning"
           });

      }*/

}
