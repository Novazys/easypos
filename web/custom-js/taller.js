$(function() {

    $(document).on('click', '#print_ticket', function(e){
         var productId = $(this).data('id');
         Print_Report('Ticket',productId);
         e.preventDefault();
    });

    $(document).on('click', '#print_invoice', function(e){
         var productId = $(this).data('id');
         Print_Report('Orden',productId);
         e.preventDefault();
    });

    $(document).on('click', '#delete_product', function(e){

         var productId = $(this).data('id');
         SwalDelete(productId);
         e.preventDefault();
    });

  $('#btnEditar').hide();

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

    $('#txtFechaI').datetimepicker({
      locale: 'es',
      format: 'DD/MM/YYYY HH:mm:ss'

    });

    $('#txtFechaR').datetimepicker({
      locale: 'es',
      format: 'DD/MM/YYYY HH:mm:ss'

    });

    $('#txtFechaA').datetimepicker({
      locale: 'es',
      format: 'DD/MM/YYYY HH:mm:ss'

    });

    // Table setup
    // ------------------------------

    // Setting datatable defaults
    $.extend( $.fn.dataTable.defaults, {
        autoWidth: false,
        pageLength: 50,
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

    // Prefix
    $("#txtDRevi").TouchSpin({
        min: 0.00,
        max: 100000000,
        step: 0.01,
        decimals: 2,
        prefix: '$'
    });

    // Prefix
    $("#txtDRepa").TouchSpin({
        min: 0.00,
        max: 100000000,
        step: 0.01,
        decimals: 2,
        prefix: '$'
    });

    // Prefix
    $("#txtDRevi-D").TouchSpin({
        min: 0.00,
        max: 100000000,
        step: 0.01,
        decimals: 2,
        prefix: '$'
    });

    // Prefix
    $("#txtDRepa-D").TouchSpin({
        min: 0.00,
        max: 100000000,
        step: 0.01,
        decimals: 2,
        prefix: '$'
    });


    // Prefix
    $("#txtRepues").TouchSpin({
        min: 0.00,
        max: 100000000,
        step: 0.01,
        decimals: 2,
        prefix: '$'
    });

    // Prefix
    $("#txtManoObra").TouchSpin({
        min: 0.00,
        max: 100000000,
        step: 0.01,
        decimals: 2,
        prefix: '$'
    });

    // Prefix
    $("#txtRepues-I").TouchSpin({
        min: 0.00,
        max: 100000000,
        step: 0.01,
        decimals: 2,
        prefix: '$'
    });

    // Prefix
    $("#txtManoObra-I").TouchSpin({
        min: 0.00,
        max: 100000000,
        step: 0.01,
        decimals: 2,
        prefix: '$'
    });

    var validator = $("#frmInformacion").validate({

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
       txtNoOrden:{
         maxlength:175,
         required: true
       },
       txtFechaI:{
         required: true
       },
       cbCliente:{
         required: true
       },
       txtAparato:{
          maxlength:125,
         required: true
       },
       txtModelo:{
        maxlength:125,
        required:true
       },
       cbMarca:{
         required: true
       },
       txtSerie:{
         maxlength:125
       },
       cbTecnico:{
         required: true
       },
       txtAveria:{
         maxlength:200,
         required: true
       },
       txtObservaciones:{
         maxlength:200,
         required: true
       },
       txtDRevi:{
         required: true
       },
       txtDRepa:{
         required: true
       },
       txtParcial:{
         required:true
       }
     },
   validClass: "validation-valid-label",
    success: function(label) {
         label.addClass("validation-valid-label").text("Correcto.")
     },

      submitHandler: function (form) {
          enviar_informacion();
       }
    });

    var validator = $("#frmDiagnostico").validate({

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
       txtDiagnostico:{
         maxlength:200,
         required: true
       },
       txtEstado:{
         maxlength:200,
         required:true
       },
       txtRepues:{
         required:true
       },
       txtManoObra:{
         required:true
       },
       txtFechaA:{
         required:true
       },
       txtUbicacion:{
         required:true
       },
       txtParcial:{
         required:true
       }
     },
   validClass: "validation-valid-label",
    success: function(label) {
         label.addClass("validation-valid-label").text("Correcto.")
     },

      submitHandler: function (form) {
          enviar_diagnostico();
       }
    });

      var form = $('#frmInformacion');

      $('#cbCliente', form).change(function () {
           form.validate().element($(this)); //revalidate the chosen dropdown value and show error or success message for the input
       });

      $('#cbMarca', form).change(function () {
           form.validate().element($(this)); //revalidate the chosen dropdown value and show error or success message for the input
       });

       $('#cbTecnico', form).change(function () {
            form.validate().element($(this)); //revalidate the chosen dropdown value and show error or success message for the input
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

});


function limpiarform1(){

  var form = $( "#frmInformacion" ).validate();
  form.resetForm();

}

function limpiarform2(){

  var form = $( "#frmDiagnostico" ).validate();
  form.resetForm();

}

function Costo_Reparacion(){

var parametro = $("#txtProceso_I").val();

 if(parametro == 'Informacion'){

   var repuestos = $("#txtRepues").val();
   var mano_obra = $("#txtManoObra").val();

   var costo_reparacion = 0;
   if(repuestos =='' && mano_obra==''){
     repuestos = 0.00;
     mano_obra - 0.00;
     costo_reparacion = 0.00;
   } else if (repuestos !='' && mano_obra ==''){
     costo_reparacion = parseFloat(repuestos);
   } else if (repuestos == '' && mano_obra !=''){
     costo_reparacion = parseFloat(mano_obra);
   } else if (repuestos != '' && mano_obra!=''){
     costo_reparacion = parseFloat(repuestos) + parseFloat(mano_obra);
   }

   var deposito_revision = $("#txtDRevi").val();
   var deposito_reparacion = $("#txtDRepa").val();
   var parcial = 0;

   if(deposito_revision == ''){deposito_revision = 0.00};
   if(deposito_reparacion == ''){deposito_reparacion = 0.00};

   $("#txtCosto").val(costo_reparacion.toFixed(2));
   parcial =  costo_reparacion - (parseFloat(deposito_revision) + parseFloat(deposito_reparacion));

   $("#txtParcial").val(parcial.toFixed(2));

 } else if (parametro == 'Editar-Informacion'){

   var repuestos = $("#txtRepues-I").val();
   var mano_obra = $("#txtManoObra-I").val();

   var costo_reparacion = 0;
   if(repuestos =='' && mano_obra==''){
     repuestos = 0.00;
     mano_obra - 0.00;
     costo_reparacion = 0.00;
   } else if (repuestos !='' && mano_obra ==''){
     costo_reparacion = parseFloat(repuestos);
   } else if (repuestos == '' && mano_obra !=''){
     costo_reparacion = parseFloat(mano_obra);
   } else if (repuestos != '' && mano_obra!=''){
     costo_reparacion = parseFloat(repuestos) + parseFloat(mano_obra);
   }

   var deposito_revision = $("#txtDRevi").val();
   var deposito_reparacion = $("#txtDRepa").val();
   var parcial = 0;

   if(deposito_revision == ''){deposito_revision = 0.00};
   if(deposito_reparacion == ''){deposito_reparacion = 0.00};

   $("#txtCosto").val(costo_reparacion.toFixed(2));
   parcial =  costo_reparacion - (parseFloat(deposito_revision) + parseFloat(deposito_reparacion));

   $("#txtParcial").val(parcial.toFixed(2));


 } else if(parametro == ''){

   var repuestos = $("#txtRepues").val();
   var mano_obra = $("#txtManoObra").val();

   var costo_reparacion = 0;
   if(repuestos =='' && mano_obra==''){
     repuestos = 0.00;
     mano_obra - 0.00;
     costo_reparacion = 0.00;
   } else if (repuestos !='' && mano_obra ==''){
     costo_reparacion = parseFloat(repuestos);
   } else if (repuestos == '' && mano_obra !=''){
     costo_reparacion = parseFloat(mano_obra);
   } else if (repuestos != '' && mano_obra!=''){
     costo_reparacion = parseFloat(repuestos) + parseFloat(mano_obra);
   }

   var deposito_revision = $("#txtDRevi-D").val();
   var deposito_reparacion = $("#txtDRepa-D").val();
   var parcial = 0;

   if(deposito_revision == ''){deposito_revision = 0.00};
   if(deposito_reparacion == ''){deposito_reparacion = 0.00};

   $("#txtCosto").val(costo_reparacion.toFixed(2));
   parcial =  costo_reparacion - (parseFloat(deposito_revision) + parseFloat(deposito_reparacion));

   $("#txtParcial-D").val(parcial.toFixed(2));

 }



}

/*function Ver_Max(){
  $.ajax({
        type:'GET',
        url: 'web/ajax/ajxtaller.php?criterio=max',
        success: function (data){
          var valor = $.parseJSON(data)
          $("#txtNoOrden").val(valor);
          //console.log(data);
        }
    });
}*/

function newOrden()
 {
    //Ver_Max();
    openOrden('nuevo',null,null,null,null,null,null,null,null,null);
    $('#modal_iconified').modal('show');
 }
function openOrden(action, idorden, numero_orden, fecha_ingreso, idcliente, aparato, modelo, idmarca, serie, idtecnico, averia, observaciones, deposito_revision, deposito_reparacion, diagnostico, estado_aparato,
repuestos, mano_obra, fecha_alta, fecha_retiro, ubicacion, parcial_pagar)
{

  $("#txtRepues").change(function(){
      Costo_Reparacion();
  });

  $("#txtManoObra").change(function(){
      Costo_Reparacion();
  });

  $("#txtDRepa").change(function(){
    Costo_Reparacion();
  });

  $("#txtDRevi").change(function(){
    Costo_Reparacion();
  });

   if (action == 'diagnostico' || action == 'diagnostico-editar'){
       $('#modal_iconified2').on('shown.bs.modal', function () {

        var modal = $(this);
        if (action == 'diagnostico'){
           $('#txtProceso_I').val('');

           $('#txtID_I').val('');
           $('#txtProceso_I').val('');
           $('#txtID_Di').val(idorden);
           $('#txtDiagnostico').val('');
           $('#txtEstado').val('');
           $('#txtRepues').val('');
           $('#txtFechaA').val('');
           $('#txtFechaR').val('');
           $('#txtManoObra').val('');
           $('#txtCosto').val('');
           $('#txtParcial-D').val('');
           $('#txtUbicacion').val('');

           $('#txtDRevi-D').val(deposito_revision);
           $('#txtDRepa-D').val(deposito_reparacion);
           $('#txtParcial-D').val(parcial_pagar);

           $('#txtDiagnostico').prop( "disabled" , false);
           $('#txtEstado').prop( "disabled" , false);
           $('#txtFechaR').prop( "disabled" , false);
           $('#txtFechaA').prop( "disabled" , false);
           $('#txtRepues').prop( "disabled" , false);
           $('#txtManoObra').prop( "disabled" , false);
           $('#txtCosto').prop( "disabled" , true);
           $('#txtUbicacion').prop( "disabled" , false);
           modal.find('.title-form').text('Ingresar Diagnostico de Aparato');
           limpiarform2();



         } else if (action == 'diagnostico-editar'){

           //  $('#modal_iconified').modal('show');
             $('#txtID_Di').val(idorden);
             $('#txtID_I').val('');
             $('#txtProceso_I').val('');

             $('#txtFechaA').val(fecha_alta);
             $('#txtFechaR').val(fecha_retiro);
             $('#txtDiagnostico').val(diagnostico);
             $('#txtEstado').val(estado_aparato);
             $('#txtRepues').val(repuestos);
             $('#txtManoObra').val(mano_obra);
             var costo_reparacion = parseFloat(repuestos) + parseFloat(mano_obra);
             $('#txtCosto').val(costo_reparacion.toFixed(2));
             $('#txtUbicacion').val(ubicacion);
             $('#txtDRevi-D').val(deposito_revision);
             $('#txtDRepa-D').val(deposito_reparacion);
             $('#txtParcial-D').val(parcial_pagar);

             modal.find('.title-form').text('Editar Diagnostico de Aparato');
         }

   });
}

    $('#modal_iconified').on('shown.bs.modal', function () {
     var modal = $(this);
     if (action == 'nuevo'){

       $('#txtID_Di').val('');
       $('#txtID_I').val('');

       $('#txtProceso_I').val('Informacion');

       $('#txtNoOrden').val('');
       $('#txtFechaI').val('');
       $('#txtFechaA').val('');
       $('#txtFechaR').val('');
       $('#txtAparato').val('');
       $('#txtModelo').val('');
       $('#txtSerie').val('');
       $('#txtAveria').val('');
       $('#txtObservaciones').val('');
       $('#txtDiagnostico').val('');
       $('#txtEstado').val('');
       $('#txtDRevi').val('');
       $('#txtDRepa').val('');
       $('#txtRepues').val('');
       $('#txtManoObra').val('');
       $('#txtCosto').val('');

       $('#txtRepues-I').val('');
       $('#txtManoObra-I').val('');
       $('#txtCosto-I').val('');

       $('#txtParcial').val('');
       $('#txtUbicacion').val('');
       $("#cbCliente").select2("val", "All");
       $("#cbMarca").select2("val", "All");
       $("#cbTecnico").select2("val", "All");

       $('#txtNoOrden').prop( "disabled" , true);
       $('#txtFechaI').prop( "disabled" , true);
       $('#txtFechaA').prop( "disabled" , true);
       $('#txtFechaR').prop( "disabled" , true);
       $('#txtAparato').prop( "disabled" , false);
       $('#txtModelo').prop( "disabled" , false);
       $('#txtSerie').prop( "disabled" , false);
       $('#txtAveria').prop( "disabled" , false);
       $('#txtObservaciones').prop( "disabled" , false);
       $('#txtDiagnostico').prop( "disabled" , true);
       $('#txtEstado').prop( "disabled" , true);
       $('#txtDRevi').prop( "disabled" , false);
       $('#txtDRepa').prop( "disabled" , false);
       $('#txtRepues').prop( "disabled" , true);
       $('#txtManoObra').prop( "disabled" , true);
       $('#txtCosto').prop( "disabled" , true);
       $('#txtParcial').prop( "disabled" , true);
       $('#txtUbicacion').prop( "disabled" , true);
       $('#cbCliente').prop( "disabled" , false);
       $('#cbMarca').prop( "disabled" , false);
       $('#cbTecnico').prop( "disabled" , false);
       $("#div-txtRepues-I").hide();
       $("#div-txtCosto-I").hide();
       $("#div-txtManoObra-I").hide();

      limpiarform1();


      modal.find('.title-form').text('Ingresar Orden de Taller');

     } else if(action=='informacion-editar') {

    //  $('#modal_iconified').modal('show');
      $('#txtID_Di').val('');
      $('#txtID_I').val(idorden);

      $('#txtProceso_Di').val('');
      $('#txtProceso_I').val('Editar-Informacion');

      $('#txtNoOrden').val(numero_orden);
      $('#txtFechaI').val(fecha_ingreso);
      $('#txtAparato').val(aparato);
      $('#txtModelo').val(modelo);
      $('#txtSerie').val(serie);
      $('#txtAveria').val(averia);
      $('#txtObservaciones').val(observaciones);
      $('#txtDRevi').val(deposito_revision);
      $('#txtDRepa').val(deposito_reparacion);
      $('#txtParcial').val(parcial_pagar);

      $('#txtRepues-I').val(repuestos);
      $('#txtManoObra-I').val(mano_obra);

      var costo_reparacion = parseFloat(repuestos) + parseFloat(mano_obra);
      $('#txtCosto-I').val(costo_reparacion.toFixed(2));


      $("#cbCliente").val(idcliente).trigger("change");
      $("#cbMarca").val(idmarca).trigger("change");
      $("#cbTecnico").val(idtecnico).trigger("change");


      $('#txtNoOrden').prop( "disabled" , false);
      $('#txtFechaI').prop( "disabled" , false);
      $('#txtAparato').prop( "disabled" , false);
      $('#txtModelo').prop( "disabled" , false);
      $('#txtSerie').prop( "disabled" , false);
      $('#txtAveria').prop( "disabled" , false);
      $('#txtObservaciones').prop( "disabled" , false);
      $('#txtDRevi').prop( "disabled" , false);
      $('#txtDRepa').prop( "disabled" , false);
      $('#txtParcial').prop( "disabled" , true);
      $('#cbCliente').prop( "disabled" , false);
      $('#cbMarca').prop( "disabled" , false);
      $('#cbTecnico').prop( "disabled" , false);
      $("#div-txtRepues-I").show();
      $("#div-txtCosto-I").show();
      $("#div-txtManoObra-I").show();

      modal.find('.title-form').text('Editar Orden de Taller');
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
           url:"web/ajax/reload-taller.php?fecha1="+fecha1+"&fecha2="+fecha2,
           success: function(data){
              $('#reload-div').html(data);
           }

       });
    } else {

      $.ajax({

           type:"GET",
           url:"web/ajax/reload-taller.php?fecha1=empty&fecha2=empty",
           success: function(data){
              $('#reload-div').html(data);
           }

       });

    }

}

function enviar_informacion(){
  var urlprocess = 'web/ajax/ajxtaller.php';
  var id =  $("#txtID_I").val();
  var proceso = $('#txtProceso_I').val();
  var numero_orden  =$("#txtNoOrden").val();
  var fecha_ingreso = $("#txtFechaI").val();
  var cliente  =$("#cbCliente").val();
  var tecnico = $("#cbTecnico").val();
  var aparato =$("#txtAparato").val();
  var marca  =$("#cbMarca").val();
  var modelo  =$("#txtModelo").val();
  var serie  =$("#txtSerie").val();
  var averia  =$("#txtAveria").val();
  var observaciones  =$("#txtObservaciones").val();
  var deposito_revision  =$("#txtDRevi").val();
  var deposito_reparacion  =$("#txtDRepa").val();
  var parcial  =$("#txtParcial").val();

  var dataString='proceso='+proceso+'&id='+id+'&cliente='+cliente+'&tecnico='+tecnico+'&aparato='+aparato+'&marca='+marca;
  dataString+='&modelo='+modelo+'&serie='+serie+'&averia='+averia+'&observaciones='+observaciones+'&numero_orden='+numero_orden;
  dataString+='&deposito_revision='+deposito_revision+'&deposito_reparacion='+deposito_reparacion+'&parcial='+parcial+'&fecha_ingreso='+fecha_ingreso;

  $.ajax({
     type:'POST',
     url:urlprocess,
     data: dataString,
     dataType: 'json',
     success: function(data){

       if(proceso == 'Informacion'){

         if(data=="Validado"){

           swal({
               title: "Exito!",
               text: "Orden Registrada Exitosamente!",
               confirmButtonColor: "#66BB6A",
               type: "success"
           });



           $('#modal_iconified').modal('toggle');


           cargarDiv("#reload-div","web/ajax/reload-taller.php?fecha1=empty&fecha2=empty");
           limpiarform1();



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


       } else  if(proceso == 'Editar-Informacion'){

         if(data=="Validado"){

           swal({
               title: "Exito!",
               text: "Orden Editada Exitosamente!",
               confirmButtonColor: "#2196F3",
              type: "info"
           });

          Print_Ticket_Edit(id);


           $('#modal_iconified').modal('toggle');

           cargarDiv("#reload-div","web/ajax/reload-taller.php?fecha1=empty&fecha2=empty");
           limpiarform();



         }  else if(data =="Error"){

                swal({
                 title: "Lo sentimos...",
                 text: "No procesamos bien tus datos!",
                 confirmButtonColor: "#EF5350",
                 type: "error"
             });
         }


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

function enviar_diagnostico(){
  var urlprocess = 'web/ajax/ajxtaller.php';
  var proceso = 'Diagnostico';
  var id =  $("#txtID_Di").val();
  var fecha_alta  =$("#txtFechaA").val();
  var fecha_retiro =$("#txtFechaR").val();
  var diagnostico  = $("#txtDiagnostico").val();
  var estado  =$("#txtEstado").val();
  var repuestos  =$("#txtRepues").val();
  var mano_obra  =$("#txtManoObra").val();
  var parcial  =$("#txtParcial-D").val();
  var ubicacion  =$("#txtUbicacion").val();

  var dataString='proceso='+proceso+'&id='+id+'&diagnostico='+diagnostico+'&estado='+estado+'&repuestos='+repuestos;
  dataString+='&mano_obra='+mano_obra+'&parcial='+parcial+'&ubicacion='+ubicacion+'&fecha_alta='+fecha_alta+'&fecha_retiro='+fecha_retiro;

  $.ajax({
     type:'POST',
     url:urlprocess,
     data: dataString,
     dataType: 'json',
     success: function(data){

        if(data=="Validado"){

          swal({
              title: "Exito!",
              text: "Diagnostico Registrado Exitosamente!",
              confirmButtonColor: "#66BB6A",
              type: "success"
          });




          $('#modal_iconified2').modal('toggle');

          cargarDiv("#reload-div","web/ajax/reload-taller.php?fecha1=empty&fecha2=empty");
          limpiarform2();



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



function Print_Report(Criterio,Orden)
{

    if (Criterio == 'Orden') {

        window.open("reportes/Boleta_Taller.php?orden="+btoa(Orden),
       'win2',
       'status=yes,toolbar=yes,scrollbars=yes,titlebar=yes,menubar=yes,'+
       'resizable=yes,width=800,height=800,directories=no,location=no'+
       'fullscreen=yes');
    }



}

function SwalDelete(productId){
              swal({
                title: "¿Está seguro que desea borrar la orden?",
                text: "Este proceso es irreversible!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#EF5350",
                confirmButtonText: "Si, Borrar",
                cancelButtonText: "No, volver atras",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm){
                if (isConfirm) {
                     return new Promise(function(resolve) {
                        $.ajax({
                        url: 'web/ajax/ajxtaller.php',
                        type: 'POST',
                        data: 'proceso=Borrar&numero_transaccion='+productId+'&numero_orden=null',
                        dataType: 'json'
                        })
                        .done(function(response){
                         swal('Eliminada!', response.message, response.status);
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

function Print_Ticket_Regis(){
  var url = "reportes/Ticket_Taller.php?orden=''";
  var url2 = "reportes/Ticket_Taller_Aparato.php?orden=''";
  $('#ticket_frame').attr('src', url)
  $('#ticket2_frame').attr('src', url2)
  $('#modal_ticket').modal('show');

}

function Print_Ticket_Edit(orden){
    var url = "reportes/Ticket_Taller.php?orden="+btoa(orden);
    var url2 = "reportes/Ticket_Taller_Aparato.php?orden="+btoa(orden);
    $('#ticket_frame').attr('src', url)
    $('#ticket2_frame').attr('src', url2)
    $('#modal_ticket').modal('show');
}

function Print_Ticket(orden){
    var url = "reportes/Ticket_Taller.php?orden="+btoa(orden);
    var url2 = "reportes/Ticket_Taller_Aparato.php?orden="+btoa(orden);
    $('#ticket_frame').attr('src', url)
    $('#ticket2_frame').attr('src', url2)
}
