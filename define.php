<?php

function log1( $m ) 
{ 
	date_default_timezone_set('Asia/Seoul');
	$t = new DateTime();
	$tf = $t->format("Y-m-d h:i:s");

	if( is_array($m) )
		$m = $tf.":".print_r($m,true)."\n";
	else
		$m = $tf.":".$m."\n";
	return error_log($m); 
}
?>
