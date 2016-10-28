<?php
	include 'define.php';	

	include 'cmd1.php';
	include 'cmd2.php';
	include 'cmd3.php';

	$recv = $_POST['jk'];
	if( $recv == null )
	{
		blog( 'no data found.','no service.');
		return;
	}
	else
		clog( "data:".$recv );

	$ar = json_decode( $recv );
	if( $ar == NULL )
		alog("parsing error");

	switch( $ar->cmd )
	{
	case "test1":			doTest1($ar);					break;
	case "getname": 		doGetname($ar);					break;
	case "getSalary":		doSalary($ar);					break;
	case "setWelfare":		doSetWelfare($ar);				break;
	case "getWelfare":		doGetWelfare($ar);				break;		
	case "setIncenInfo":	doSetIncenInfo($ar);			break;
	case "getIncen":		doGetIncen($ar);				break;
	case "getUserInfo":		doGetUserinfo($ar);				break;
	case "setName":			doSetName($ar);					break;				
	default:	
	}
?>
