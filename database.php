<?php
include 'define.php';
class jkDB {
	protected $pdo;

	function __construct() { $pdo = NULL; }
	function __destruct() {}

	protected function open()
	{
		try{
			$pdo = new PDO('mysql:host=localhost;dbname=test','root','opfdcrr');
		} catch( PDOException $e ) {
			alog( $e->getMessage() );
			return false;
		}
		return true;
	}

	function getQuery( $msg )
	{
		$st = query( $msg );
		if( !$st ) return false;
			
		$r = array();
		foreach( $st->fetchAll() as $row )
		{
			$r[] = $row;			
		}
		return $r;
	}

	protected function query( $msg )
	{
		clog("query:".$msg);

		if($pdo == NULL) 
			if( !open() ) 
				return false;
		
		$r = $pdo->query($msg);
		if( !$r )
		{
			blog( print_r($pdo->errorInfo(), 'query error') );
			return false;
		}
		return $r;
	}
	
}
	
?>
