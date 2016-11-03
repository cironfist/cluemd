<?php
try{

function doGetname($p)
{
	$q = "SELECT aname FROM user;";

	$db = new jkDB();
	$arr = $db->getQuery($q);
	if(!$arr)
		$p->setFailMsg('Get alias name fail.');
	else
	{
		$p->setSuccess();
		$p->setArrayMsg( $arr );
	}
}

function doAddname($p)
{
	$par = $p->getProtocol();
	$q = "INSERT INTO user (aname) VALUES ('".$par->aname."');";

	$db = new jkDB();
	if( $db->setQuery($q) == false )
		$p->setFailMsg('addname fail.');
	else
		$p->setSuccessMsg($par->aname.' is inserted.');
}

} catch( Exception $e ) {
	log1( $e->getMessage() );
}
?>
