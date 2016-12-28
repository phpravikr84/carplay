<?php

	// Loader - class and connection
	include('loader.php');
	 
	
	$begin = new DateTime( '2016-09-22' );
	$end = new DateTime( '2016-10-30' );
	
	$interval = DateInterval::createFromDateString('1 day');
	$period = new DatePeriod($begin, $interval, $end);
	
	foreach ( $period as $dt ){
		$range=range(strtotime("08:00"),strtotime("23:00"),30*60);
		foreach($range as $time){
			$end_time= date("H:i",strtotime('+30 minutes',$time));
			echo $calendar->addEvent('Discount', 'Discount', $dt->format( "Y-m-d" ), date("H:i",$time), $dt->format( "Y-m-d" ), $end_time, '', 'No', '?page=', '', 40, 10);
			//echo $calendar->addEvent($title, $description, $start_date, $start_time, $end_date, $end_time, $color, $allDay, $url, $extra,$discount,$seats);
			echo $dt->format( "Y-m-d" ).' '.date("H:i",$time)."\n".'</br>';
		}
	
	}

?>