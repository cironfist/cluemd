<?php
class jkDB {
	protected $pdo;

	function __construct() { $this->open(); }
	function __destruct() {}

	protected function open()
	{
		try{
			$this->pdo = 
				new PDO('mysql:host=localhost;dbname=cluemd','root','opfdcrr');
		} catch( PDOException $e ) {
			alog( $e->getMessage() );
			return false;
		}
		return true;
	}

	function getQuery( $msg )
	{
		$st = $this->query( $msg );
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

		$r = $this->pdo->query($msg);
		if( !$r )
		{
			blog( print_r($this->pdo->errorInfo()), 'query error' );
			return false;
		}
		return $r;
	}

	function setQuery( $msg ) { return $this->query( $msg ); }
	
}
	
?>
