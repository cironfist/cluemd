<?php
try{

function doGetname($recv)
{
	$q = "SELECT aname FROM user;";

	$db = new jkDB();
	$arr = $db->getQuery($q);

	$r = json_encode($arr);
	sendMsg($r,$recv->cmd);
}

function doAddname($ar)
{
	$q = "INSERT INTO user (aname) VALUES ('".$ar->aname."');";

	$db = new jkDB();
	if( $db->setQuery($q) == false )
		sendDMsg('addname fail.');
	else
	{
		sendMsg($ar->aname.' is inserted.',$ar->cmd);
	}
}

} catch( Exception $e ) {
	alog( $e->getMessage() );
}
?>
