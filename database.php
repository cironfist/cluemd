<?php
class jkDB {
	protected $pdo;

	function __construct($dbname) { $this->open($dbname); }
	function __destruct() {}

	protected function open($dbname)
	{
		try{
			$openstr =
			'mysql:host=localhost;dbname='.$dbname;
			$this->pdo = 
				new PDO($openstr,'root','opfdcrr');
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
