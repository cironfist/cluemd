<?php

define ("CLUEMD_VERSION",		1);
define ("JK_SUCCESS", 			100);
define ("JK_DEBUG", 			101);
define ("JK_FAIL",				999);

function sendArr( $arr, $cmd )
{
	$arr['rcode']		= JK_SUCCESS;
	$arr['cmd']			= $cmd;
	echo json_encode($arr);
}
function sendMsg( $msg, $cmd ) 
{ 
	$return['rcode'] 		= JK_SUCCESS; 
	$return['msg'] 			= $msg;
	$return['cmd']			= $cmd;
	echo json_encode($return); 
}
function sendMsg2( $msg, $code ) 
{ 
	$return['rcode'] 		= $code; 
	$return['msg'] 			= $msg;
	echo json_encode($return); 
}
function sendDMsg( $msg ) 
{ 
	$return['rcode'] 		= JK_DEBUG; 
	$return['msg'] 			= $msg;
	echo json_encode($return); 
}
function alog( $m ) { clog($m); sendDMsg($m); }
function blog( $s, $c ) { clog($s); sendDMsg($c); }
function rlog( $r ) { print_r($r); }
function clog( $m ) 
{ 
	$t = new DateTime();
	$m = $t->format("Y-m-d h:i:s").":".$m."\n";
	return error_log($m,3,'/var/tmp/cluemd.log'); 
}
?>
