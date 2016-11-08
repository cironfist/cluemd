<?php
include 'define.php';
include 'protocol.php';

include 'notecmd1.php';

$p = new protocol();

switch( $p->getCmd() )
{
case "addnote":         doAddNote($p);      break;
case "appendnote":      doAppendNote($p);   break;
case "deletenote":      doDeleteNote($p);   break;
case "modifynote":      doModifyNote($p);   break;
case "getnote":         doGetNote($p);      break;
case "searchnote":      doSearchNote($p);   break;
default:
    log1('===================================');
    log1($p->getProtocol());
    break;
}

$p->send();

?>