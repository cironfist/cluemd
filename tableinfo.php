<?php
try{
	
	$pdo = new PDO('sqlite:./test.db');
	$result = $pdo->query('DESCRIBE test;');
	if( !$result )
	{
		echo "PDOstatement:errorInfo()\n";
		$arr = $pdo->errorInfo();
		print_r ( $arr );
	}
	else
		print $result;

} catch( Exception $e ) {
	print $e->getMessage();
}

?>
