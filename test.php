<?php
	$con = mysql_connect('160.153.47.1', 'sisterhoodmakati', 'Makati2014');
	
	if(! $con) {
		echo 'Error: '.mysql_error();
	} else {
		echo 'Connected!';
	}
?>