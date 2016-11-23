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
	$q = "SELECT aname,idx FROM user;";

	$db = new jkDB('cluemd');
	$arr = $db->getQuery($q);
	if(!$arr)
		$p->setFailMsg($db->getFailMsg());
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

	$q = "INSERT INTO user (aname) VALUES ('$p->aname');";

	$db = new jkDB('cluemd');
	if( $db->setQuery($q) == false )
		$p->setFailMsg($db->getFailMsg());
	else
		$p->setSuccessMsg($p->aname.' is inserted.');
}

function doGetSalary($p)
{
	if( !isset($p->idx) )
		return ;

	$sql="SELECT date,tbonus,sbonus,obonus,salary,rate,hour,tsalary 
	FROM bonus WHERE idx='$p->idx' ORDER BY date DESC;";
	/*if( isset($p->date) ) 
		$sql .= "WHERE B.date='$p->date' ";
	
	$sql .= "INNER JOIN user AS U ON B.idx = u.idx;";*/
	$db = new jkDB('cluemd');
	$ar = $db->getQuery($sql);
	if(!$ar)
		$p->setFailMsg($db->getFailMsg());
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
		$p->setFailMsg($db->getFailMsg());
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
	if(isArg('aname')) {$sql.="aname='$p->aname'";}
	if(isArg('email')) {$sql.="email='$p->email'";}
	if(isArg('salary')) {$sql.="salary='$p->salary'";}
	if(isArg('hour')) {$sql.="hour='$p->hour'";}
	if(isArg('rate')) {$sql.="rate='$p->rate'";}
	if(isArg('current')) {$sql.="current='$p->current'";}
	if(isArg('status')) {$sql.="status='$p->status'";}
	
	$sql.=" WHERE idx='$p->idx';";

	$db = new jkDB('cluemd');
	if( $db->setQuery($sql) )
		$p->setSuccessMsg('success set user information.');
	else
		$p->setFailMsg($db->getFailMsg());
}

?>
