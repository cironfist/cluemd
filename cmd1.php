<?php
try{
include 'define.php';
include 'database.php';

function doGetname($cmd)
{
	$q = "SELECT aname FROM test;";

	$db = new jkDB();
	$arr = $db->getQuery($q);

	$r = json_decode($arr);
	sendArr($r,$cmd);
}

} catch( Exception $e ) {
	alog( $e->getMessage() );
}
?>
