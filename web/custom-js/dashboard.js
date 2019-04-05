
$(function() {

 /*$.getJSON('web/ajax/ajxcaja.php?movimientos=view',function(data){

 	$.each(data,function(key,val){

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
		        bindto: '#chart-ventas',
		        size: { width: 460 },
		        data: {
			        x: 'x',
			        columns: [
			            ['x', '01', '02', '03', '04', '05', '06','07','08','09','10','11','12'],
			            ['MONTO', 30, 200, 100, 400, 150, 250,360,50,66,90,150,99]
			        ],
			        type : 'bar',
			        colors: {
		           		MONTO: '#66BB6A'
		        	},
			    },
			    axis : {
			    	x:{
			    		type: 'category',
			    	},
			         y : {
			            tick: {
			                format: d3.format("$,")
			//                format: function (d) { return "$" + d; }
			            }
			        }
			    }
		    });


	 	}); // end each


	 }); // getjson*/

});

