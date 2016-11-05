<?php

function doSQL($p)
{
	if( isset($p->sql,$p->aname) == false )
		return;

	$db = new jkDB();
	$r = $db->setQuery( $p->sql );
	if( $r == false )
		$p->setFailMsg($p->sql.':Fail');
	else
		$p->setSuccessMsg($p->sql.':success');
}

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
	if( isset($p->aname) == false )
		return;

	$q = "INSERT INTO user (aname) VALUES ('".$p->aname."');";

	$db = new jkDB();
	if( $db->setQuery($q) == false )
		$p->setFailMsg('addname fail.');
	else
		$p->setSuccessMsg($p->aname.' is inserted.');
}

?>
