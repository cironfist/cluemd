<?php
try{
include 'define.php';
include 'database.php';

function doGetname($recv)
{
	$q = "SELECT aname FROM test;";

	$db = new jkDB();
	$arr = $db->getQuery($q);

	$r = json_decode($arr);
	sendArr($r,$recv->cmd);
}

} catch( Exception $e ) {
	alog( $e->getMessage() );
}
?>
