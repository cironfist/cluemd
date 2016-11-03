<?php

define ("CLUEMD_VERSION",		1);
define ("JK_SUCCESS", 			100);
define ("JK_DEBUG", 			101);
define ("JK_FAIL",				999);
define ("JK_PARSING_FAIL",		900);

/*	'cmd' protocol define
	addname : 'aname'=> insert alias name
	getname :
	
*/

class protocol {
	protected $p;
	/*
		p['cmd'] 		: command instruction
		p['msg']		: return message or result or error explain msg
		p['cluemd']		: ex) 0.1 command version
		p['code']		: return code. ex) fail.success.error.
	*/
	__construct()
	{
		if( isset($_POST['jk']) )
			$this->p = json_decode($_POST['jk']);
		else
		{
			$this->p = array();
			$this->p->setCmd('notdefine');
			$this->p->setFailMsg('command not defined');
		}
	}

	function getProtocol()				{ return $this->p; }
	function getCmd()					{ return $this->p['cmd']; }

	function setMsg($m)					{ $this->p['msg'] = $m; }
	function setCmd($cmd)				{ $this->p['cmd'] = $cmd; }
	function setSuccess() 				{ $this->p['code'] = JK_SUCCESS; }
	function setParsingFail()			{ $this->p['code'] = JK_PARSING_FAIL; }
	function setFail()					{ $this->p['code'] = JK_FAIL; }
	function setFailMsg($msg)			{ $this->setFail();$this->setMsg($msg); }
	function setSuccessMsg($msg)		{ $this->setSuccess();$this->setMsg($msg); }
	function setArrayMsg($ar)			
	{ 
		$r = json_encode($ar);
		$this->p['msg']	= $r;
	}

	function send()
	{
		$r = json_encode($this->p);
		echo $r;
	}
	
?>
