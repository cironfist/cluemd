<?php
try{

	$query = 'ALTER TABLE test ADD COLUMN aname CHAR(32);';	

	$pdo = new PDO('sqlite:./test.db');
	$result = $pdo->query( $query );
	if( !$result )
	{
		echo "PDOstatement:errorInfo()\n";
		$arr = $pdo->errorInfo();
		print_r ( $arr );
	}
	else
		print $query."\nalter done.";

} catch( Exception $e ) {
	print $e->getMessage();
}

?>
