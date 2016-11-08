<?php
function doAddMemo($p)
{
    $sql = 'INSERT INTO note (';
    $sql2 = ") VALUES ('";
    if( isset($p->title) )  {$sql+='title,'; $sql2+="$p->title','"; }
    if( isset($p->pw) )     {$sql+='pw,'; $sql2+="$p->pw','"; }
    if( isset($p->id) )     {$sql+='id,'; $sql2+="$p->id','"; }
    if( isset($p->desc1) )  {$sql+='desc1,'; $sql2+="$p->desc1','"; }
    if( isset($p->desc2) )  {$sql+='desc2,'; $sql2+="$p->desc2','"; }
    if( isset($p->desc3) )  {$sql+='desc3,'; $sql2+="$p->desc3'"; }

    $sql = $sql.$sql2.");";

    $db = new jkDB('memo');   
    $r = $db->setQuery( $sql );
	if( $r == false )
		$p->setFailMsg('Memo add fail.');
	else
		$p->setSuccessMsg('Memo add success.');
}


?>