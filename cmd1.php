<?php

function doSQL($p)
{
	if( isset($p->sql,$p->aname) == false )
		return;

	$db = new jkDB('cluemd');
	$r = $db->setQuery( $p->sql );
	if( $r == false )
		$p->setFailMsg($p->sql.':Fail');
	else
		$p->setSuccessMsg($p->sql.':success');
}

function doGetname($p)
{
	$q = "SELECT aname FROM user;";

	$db = new jkDB('cluemd');
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
		return $p->setFailMsg('real name not set.');

	$q = "INSERT INTO user (aname) VALUES ('".$p->aname."');";

	$db = new jkDB('cluemd');
	if( $db->setQuery($q) == false )
		$p->setFailMsg('addname fail.');
	else
		$p->setSuccessMsg($p->aname.' is inserted.');
}

function doGetSalary($p)
{
	if( !isset($p->idx) )
		return $p->setFailMsg('not employee');

	$sql="SELECT date,tbonus,sbonus,obonus,salary,rate,hour,tsalary FROM bonus WHERE idx='$p->idx' ORDER BY date DESC;";
	/*if( isset($p->date) ) 
		$sql += "WHERE B.date='$p->date' ";
	
	$sql += "INNER JOIN user AS U ON B.idx = u.idx;";*/
	$db = new jkDB('cluemd');
	$ar = $db->getQuery();
	if(!$ar)
		$p->setFailMsg('no data founud.');
	else
	{
		$p->setSuccessMsg();
		$p->setArrayMsg($ar);
	}
	
}

?>
