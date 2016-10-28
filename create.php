<?php
try{

	$pdo = new PDO('sqlite:./test.db');
	$result = $pdo->query(
			'CREATE TABLE test (
			id 		INT UNSIGNED NOT NULL,
			email 		CHAR(32),
			name 		CHAR(32),
			PRIMARY KEY(id) );'	
			);
	if( !$result )
	{
		echo "PDOstatement:errorInfo()\n";
		$arr = $pdo->errorInfo();
		print_r ( $arr );
	}

} catch( Exception $e ) {
	print $e->getMessage();
}

?>
