<?php
try{
	$pdo = new PDO('mysql:host=localhost','root','opfdcrr');
	print "mysql open.<br/>";
} catch( Exception $e ) {
	print $e->getMessage();
}

?>
