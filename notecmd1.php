<?php

function addnote($p)
{
    if( !isset($p->title,$p->value) )
        return $p->setFailMsg('not set argument.');
        
    $sql = "INSERT INTO note (title,value) VALUES('".$p->title."','".$p->value."');";

    $db = new jkDB('memo');
    if( !$db->setQuery($sql) )
        $p->setFailMsg('add note Fail');
    else
        $p->setSuccessMsg('add note success');
}

function deletenote($p)
{
    if( !isset($p->idx) )
        return $p->setFailMsg("index not set.");

    $sql = "DELETE FROM note WHERE idx='$p->idx';";
    $db = new jkDB('memo');
    if( !$db->setQuery($sql) )
        $p->setFailMsg('delete note Fail');
    else
        $p->setSuccessMsg('delete note success');
}

function doSearchNote($p)
{
    if( !isset($p->value) )
        return $p->setFailMsg('keyword not set.');

    $sql = "SELECT * FROM note WHERE title LIKE '%$p->value%' OR value LIKE '%$p->value%';";

    $db = new jkDB('memo');
    $ar = $db->getQuery( $sql );
    if(!$ar)
        $p->setFailMsg('no search result found.');
    else
    {
        $p->setSuccess();
        $p->setArrayMsg($ar);
    }
}

function doAppendNote($p)
{
    if( !isset($p->pidx,$p->title,$p->value) )
        return $p->setFailMsg('not set parent.');

    $sql="INSERT INTO note (title,value,pidx) VALUES ('$p->title','$p->value','$p->pidx');";

    $db = new jkDB('memo');
    if( !$db->setQuery($sql) )
        $p->setFailMsg('append note fail.');
    else
        $p->setSuccessMsg('append note success.');
}

function doGetNote($p)
{
    if( !isset($p->idx) )
        return $p->setFailMsg('not set index.');

    $sql="SELECT * FROM note WHERE idx='$p->idx' OR pidx='$p->idx';";

    $db = new jkDB('memo');
    $ar = $db->getQuery($sql);
    if(!$ar)
        $p->setFailMsg('get note info fail.');
    else
    {
        $p->setSuccess();
        $p->setArrayMsg($ar);
    }
}

function doModifyNote($p)
{
    if( !isset($p->idx,$p->title,$p->value,$p->pidx) )
        return $p->setFailMsg('not set modify argument.');

    $sql="UPDATE note SET title='$p->title',value='$p->value',pidx='$p->pidx' WHERE idx='$p->idx';";

    $db = new jkDB('memo');
    if($db->setQuery($sql))
        $p->setSuccessMsg('note Modified.');
    else 
        $p->setFailMsg('note modify fail.');   
}


?>