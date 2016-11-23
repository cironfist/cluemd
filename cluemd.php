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
	case "getSalary":		doGetSalary($p);				break;
	case "addwelfare":		doAddWelfare($p);				break;
	case "getWelfare":		doGetWelfare($p);				break;		
	case "setUserInfo":		setUserInfo($p);				break;
	case "getUserInfo":		getUserInfo($p);				break;
	case "setName":			doSetName($p);					break;	
	case "makeBonusTable":  doMakeBonusTable($p);			break;
	case "setSalesInfo": 	doSetSalesInfo($p);				break;	
	case "adduser": 		doAddUser($p);					break;
	case "login": 			doLogin($p);					break;
			
	default:
		log1('----------------------------------------------'); 
		log1($p->getProtocol());						
		break;
	}

	$p->send();	
?>
