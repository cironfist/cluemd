<?php
	include 'define.php';	
	include 'database.php';

	$recv = $_POST['jk'];
	if( $recv == null )
	{
		blog( 'no data found.','no service.');
		return;
	}
	else
		clog( "data:".$recv );

	/*if( !isset( $_POST['clueddmd'] ) )
	{
		sendMsg "no cluemd found.";
		return clog("no service.");
	}*/

	//syslog(LOG_NOTICE,'ssss');
	//echo $_POST['cluemd'];
	
	$ar = json_decode( $recv );
	if( $ar == NULL )
		alog("parsing error");

	$query= ""; 
	switch( $ar->cmd )
	{
	case "select":
		$query = "SELECT * FROM test WHERE ".$ar->column."=".$ar->data.";";
		break;
	case "getname":
		$query = "SELECT aname FROM test;";
		break;
	default:	
	}

	clog($query);

	$db = new jkDB();
	$db->query( $query );

	/*print 'do query : '.$query;

	$pdo = new PDO('mysql:host=localhost;dbname=test','root','opfdcrr');
	$result = $pdo->query( $query );
	if( !$result )
	{
		blog( print_r($pdo->errorInfo(), 'query error') ); 
	}
	else
	{
		print $query."<br/>\nselect done.";
	}*/
?>
