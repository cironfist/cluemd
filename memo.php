<?php
include 'define.php';
include 'protocol.php';

include 'memocmd1.php';

$p = new protocol();

switch( $p->getCmd() )
{
case "addnote":         doAddMemo($p);      break;
case "deletenote":      doDeleteMemo($p);   break;
case "modifynote":      doModifymemo($p);   break;
case "getnote":         doGetMemo($p);      break;
case "searchnote":      doSearchMemo($p);   break;
default:
    log1('===================================');
    log1($p->getProtocol());
    break;
}

$p->send();

?>