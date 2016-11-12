<?php

function doAddNote($p)
{
    if( !isset($p->title,$p->value) )
        return ;
        
    $sql = "INSERT INTO note (title,value) VALUES('".$p->title."','".$p->value."');";

    $db = new jkDB('memo');
    if( !$db->setQuery($sql) )
        $p->setFailMsg($db->getFailMsg());
    else
        $p->setSuccessMsg('add note success');
}

function doDeleteNote($p)
{
    if( !isset($p->idx) )
        return ;

    $sql = "DELETE FROM note WHERE idx='$p->idx';";
    $db = new jkDB('memo');
    if( !$db->setQuery($sql) )
        $p->setFailMsg($db->getFailMsg());
    else
        $p->setSuccessMsg('delete note success');
}

function doSearchNote($p)
{
    if( !isset($p->value) )
        return ;

    $sql = "SELECT * FROM note WHERE title LIKE '%$p->value%' OR value LIKE '%$p->value%';";

    $db = new jkDB('memo');
    $ar = $db->getQuery( $sql );
    if(!$ar)
        $p->setFailMsg($db->getFailMsg());
    else
    {
        $p->setSuccess();
        $p->setArrayMsg($ar);        
    }
}

function doAppendNote($p)
{
    if( !isset($p->pidx,$p->title,$p->value) )
        return ;

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
        return ;

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
        return ;

    $sql="UPDATE note SET title='$p->title',value='$p->value',pidx='$p->pidx' WHERE idx='$p->idx';";

    $db = new jkDB('memo');
    if($db->setQuery($sql))
        $p->setSuccessMsg('note Modified.');
    else 
        $p->setFailMsg('note modify fail.');   
}


?>