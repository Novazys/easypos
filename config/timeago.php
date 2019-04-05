<?php
	date_default_timezone_set("America/El_Salvador"); 
	
	  function Daysdiference($date){

	  	$hoy = date('Y-m-d');

	  	$date_dia = substr($date, 8, 8);
        $date_mes = substr($date, 5, 2);
        $date_ano = substr($date, 0, 4);

	  	$now_dia = substr($hoy, 8, 8);
        $now_mes = substr($hoy, 5, 2);
        $now_ano = substr($hoy, 0, 4);


		//calculo timestam de las dos fechas 
		$timestamp1 = mktime(0,0,0,$date_mes,$date_dia,$date_ano); 
		$timestamp2 = mktime(4,12,0,$now_mes,$now_dia,$now_ano); 

		//resto a una fecha la otra 
		$segundos_diferencia = $timestamp1 - $timestamp2; 
		//echo $segundos_diferencia; 

		//convierto segundos en días 
		$dias_diferencia = $segundos_diferencia / (60 * 60 * 24); 

		//obtengo el valor absoulto de los días (quito el posible signo negativo) 
		$dias_diferencia = abs($dias_diferencia); 

		//quito los decimales a los días de diferencia 
		$dias_diferencia = floor($dias_diferencia); 

		return $dias_diferencia;

	  }

	  function Monthsdiference($date)
	  {
	  	$now = date('Y-m-d');
	  	$fechainicial = new DateTime($date);
		$fechafinal = new DateTime($now);

		if($fechafinal > $fechainicial){

			return 0;

		} else {

			$diferencia = $fechainicial->diff($fechafinal);
			$meses = ( $diferencia->y * 12 ) + $diferencia->m;
			return $meses;
		}


	  }

	  function timeAgo($time_ago){
		$cur_time 	= time();
		$time_elapsed 	= $cur_time - $time_ago;
		$seconds 	= $time_elapsed ;
		$minutes 	= round($time_elapsed / 60 );
		$hours 		= round($time_elapsed / 3600);
		$days 		= round($time_elapsed / 86400 );
		$weeks 		= round($time_elapsed / 604800);
		$months 	= round($time_elapsed / 2600640 );
		$years 		= round($time_elapsed / 31207680 );
		// Seconds
		if($seconds <= 60){
			echo "hace $seconds segundos";
		}
		//Minutes
		else if($minutes <=60){
			if($minutes==1){
				echo "hace un minuto";
			}
			else{
				echo "$minutes minutes ago";
			}
		}
		//Hours
		else if($hours <=24){
			if($hours==1){
				echo "hace una hora";
			}else{
				echo "hace $hours horas";
			}
		}
		//Days
		else if($days <= 7){
			if($days==1){
				echo "ayer";
			}else{
				echo "hace $days dias";
			}
		}
		//Weeks
		else if($weeks <= 4.3){
			if($weeks==1){
				echo "hace una semana";
			}else{
				echo "hace $weeks semanas";
			}
		}
		//Months
		else if($months <=12){
			if($months==1){
				echo "hace un mes";
			}else{
				echo "hace $months meses";
			}
		}
		//Years
		else{
			if($years==1){
				echo "hace un año";
			}else{
				echo "hace $years años";
			}
		  }
	}

?>