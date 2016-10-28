<?php
try{
include 'define.php';

function doGetname()
{
	$q = "SELECT aname FROM test;";
}

} catch( Exception $e ) {
	alog( $e->getMessage() );
}
?>
