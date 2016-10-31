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
	$r['rcode'] 		= JK_SUCCESS; 
	$r['msg'] 			= $msg;
	$r['cmd']			= $cmd;
	echo json_encode($r); 
}
function sendMsg2( $msg, $code ) 
{ 
	$r['rcode'] 		= $code; 
	$r['msg'] 			= $msg;
	echo json_encode($r); 
}
function sendDMsg( $msg ) 
{ 
	$r['rcode'] 		= JK_DEBUG; 
	$r['msg'] 			= $msg;
	echo json_encode($r); 
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
