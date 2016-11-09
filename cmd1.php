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
		return ;

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
		return ;

	$sql="SELECT date,tbonus,sbonus,obonus,salary,rate,hour,tsalary FROM bonus WHERE idx='$p->idx' ORDER BY date DESC;";
	/*if( isset($p->date) ) 
		$sql .= "WHERE B.date='$p->date' ";
	
	$sql .= "INNER JOIN user AS U ON B.idx = u.idx;";*/
	$db = new jkDB('cluemd');
	$ar = $db->getQuery($sql);
	if(!$ar)
		$p->setFailMsg('no data founud.');
	else
	{
		$p->setSuccess();
		$p->setArrayMsg($ar);
	}
	
}

function getUserInfo($p)
{
	if(!isset($p->idx))
		return ;

	$sql="SELECT * FROM user WHERE idx='$p->idx';";

	$db= new jkDB('cluemd');
	$ar=$db->getQuery($sql);
	if(!$ar)
		$p->setFailMsg('not find user info.');
	else
	{
		$p->setSuccess();
		$p->setArrayMsg($ar);
	}
}

function setUserInfo($p)
{
	if(!isset($p->idx))
		return;

//	UPDATE user set WHERE
	$sql="UPDATE user SET ";
	if(isSetAr('aname')) {$sql.="aname='$p->aname'";}
	if(isSetAr('email')) {$sql.="email='$p->email'";}
	if(isSetAr('salary')) {$sql.="salary='$p->salary'";}
	if(isSetAr('hour')) {$sql.="hour='$p->hour'";}
	if(isSetAr('rate')) {$sql.="rate='$p->rate'";}
	if(isSetAr('current')) {$sql.="current='$p->current'";}
	if(isSetAr('status')) {$sql.="status='$p->status'";}
	
	$sql.=" WHERE idx='$p->idx';";

	$db = new jkDB('cluemd');
	if( $db->setQuery($sql) )
		$p->setSuccessMsg('success set user information.');
	else
		$p->setFailMsg('Fail user info.');
}

?>
