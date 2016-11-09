<?php
function doLogin($p)
{
	if(!isset($p->email,$p->pw))
		return;

	$sql="SELECT idx FROM user WHERE email='$p->email' AND pw='$p->pw';";

	$db = new jkDB('cluemd');
	$r = $db->getQuery($sql);
	if(!$r)
		$p->setFailMsg('fail to get user info.');
	else
	{
		$p->setSuccess();
		$p->setArrayMsg($r);
	}
}

function doAddUser($p)
{
	if(!isset($p->aname,$p->email,$p->pw))
		return ;

	$sql="INSERT INTO user(email,pw,aname) VALUES ('$p->email','$p->pw','$p->aname');";

	$db = new jkDB('cluemd');
	if( $db->setQuery($sql) )
	{
		doLogin($p);		
	}
	else
		$p->setFailMsg('Fail to add user.');
}
?>
