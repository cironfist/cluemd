<?php
class jkDB {
	protected $pdo;
	protected $failmsg;

	function __construct($dbname) { $this->open($dbname); }
	function __destruct() {}

	function getFailMsg() 	{ return $this->failmsg; }
	protected function open($dbname)
	{
		$failmsg='init msg';
		try{
			$openstr =
			'mysql:host=localhost;dbname='.$dbname;
			$this->pdo = 
				new PDO($openstr,'root','opfdcrr');
		} catch( PDOException $e ) {
			$this->pdo = null;
			log1( $e->getMessage() );
			$this->failmsg='data init fail.';
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
		log1("query->".$msg);

		$r = $this->pdo->query($msg);
		if( !$r )
		{
			$a = $this->pdo->errorInfo();
			log1( print_r($a,true) );
			$this->failmsg=$a[2];
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
