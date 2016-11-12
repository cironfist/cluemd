<?php
function doLogin($p)
{
	if(!isset($p->email,$p->pw))
		return;

	$sql="SELECT idx,email,aname,current FROM user WHERE email='$p->email' AND pw='$p->pw';";

	$db = new jkDB('cluemd');
	$r = $db->getQuery($sql);
	if(!$r)
		$p->setFailMsg('fail to Login.');
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

	$sql="UPDATE user SET email='$p->email' pw='$p->pw' WHERE aname='$p->aname';";

	$db = new jkDB('cluemd');
	if( $db->setQuery($sql) )
	{
		doLogin($p);		
	}
	else
		$p->setFailMsg($db->getFailMsg());
}
?>
