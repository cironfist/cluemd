<?php
	include 'define.php';	
	include 'database.php';
	include 'protocol.php';

	include 'cmd1.php';
	include 'cmd2.php';
	include 'cmd3.php';

	$p = new protocol();

	switch( $p->getCmd() )
	{
	case "doSQL":			doSQL($p);						break;
	case "getname": 		doGetname($p);					break;
	case "addname";			doAddname($p);					break;
	case "getSalary":		doSalary($p);					break;
	case "setWelfare":		doSetWelfare($p);				break;
	case "getWelfare":		doGetWelfare($p);				break;		
	case "setIncenInfo":	doSetIncenInfo($p);			break;
	case "getIncen":		doGetIncen($p);				break;
	case "getUserInfo":		doGetUserinfo($p);				break;
	case "setName":			doSetName($p);					break;				
	default:
		log1('----------------------------------------------'); 
		log1($p->getProtocol());						
		break;
	}

	$p->send();	
?>
