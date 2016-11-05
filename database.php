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
			$this->pdo = null;
			log1( $e->getMessage() );
		}
	}

	function getQuery( $msg )
	{
		if(!$this->pdo)
			return false;

		$st = $this->query( $msg );
		if( !$st ) 
			return false;
			
		$r = array();
		foreach( $st->fetchAll(PDO::FETCH_ASSOC) as $row )
		{
			$r[] = $row;			
		}
		return $r;
	}

	protected function query( $msg )
	{
		log1("query:".$msg);

		$r = $this->pdo->query($msg);
		if( !$r )
		{
			log1( print_r($this->pdo->errorInfo(),true) );
			return false;
		}
		return $r;
	}

	function setQuery( $msg ) 
	{ 
		if(!$this->pdo)
			return false;
		else
			return $this->query( $msg ); 
	}
	
}
	
?>
