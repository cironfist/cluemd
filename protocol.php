<?php

define ("CLUEMD_VERSION",		1);
define ("JK_SUCCESS", 			100);
define ("JK_DEBUG", 			101);
define ("JK_FAIL",				999);
define ("JK_PARSING_FAIL",		900);
define ("JK_ERROR",				901);

/*	'cmd' protocol define
	addname : 'aname'=> insert alias name
	getname :
	
*/

class protocol {
	public $p = array();
	/*
		p['cmd'] 		: command instruction
		p['msg']		: return message or result or error explain msg
		p['cluemd']		: ex) 0.1 command version
		p['code']		: return code. ex) fail.success.error.
	*/
	public function	__construct()
	{
		if( isset($_POST['jk']) )
		{
			$this->p = json_decode($_POST['jk'],true);
			if( !$this->getCmd() )
			{
				$this->setCmd('notdefine Command');
				$this->setFailMsg('Command not set.');
			}
		}
		else
		{
			$this->setCmd('notdefine JK');
			$this->setFailMsg('JK not defined');
		}

	}

	function __get($name)				{ return $this->p[$name]; }
	function __set($name,$value)		{ return $this->p[$name] = $value; }
	function __isset($name)				
	{ 
		$r = isset($this->p[$name]); 
		if( !$r )
			$this->setFailMsg($name.':argument not set.');
		return $r;
	}

	function isArg($name)  				{return isset($this->p[$name]); }

	function getProtocol()				{ return $this->p; }
	function getCmd()					{ return $this->p['cmd']; }

	function setMsg($m)					{ $this->p['msg'] = $m; }
	function setCmd($cmd)				{ $this->p['cmd'] = $cmd; }
	function setSuccess() 				{ $this->p['code'] = JK_SUCCESS; }
	function setParsingFail()			{ $this->p['code'] = JK_PARSING_FAIL; }
	function setFail()					{ $this->p['code'] = JK_FAIL; }
	function setResult($r) 				{ $this->p['result'] = $r;}
	function setFailMsg($msg)			{ $this->setFail();$this->setResult($msg); }
	function setSuccessMsg($msg)		{ $this->setSuccess();$this->setResult($msg); }
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
}	// class protocol
	
?>
