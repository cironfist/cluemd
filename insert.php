<?php
try{

	$query =	'INSERT INTO test ('
				.$_POST['column']
				.') VALUES (\''
				.$_POST['data']
				.'\');';	

	print 'do query : '.$query."<br/>";

	$pdo = new PDO('mysql:host=localhost;dbname=test','root','opfdcrr');
	$result = $pdo->query( $query );
	if( !$result )
	{
		echo "PDOstatement:errorInfo()\n";
		$arr = $pdo->errorInfo();
		print_r ( $arr );
	}
	else
		print $query."<br/>\nalter done.";

} catch( Exception $e ) {
	print $e->getMessage();
}

?>
