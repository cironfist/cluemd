function fRecv(r) {}
function fError(r) {}

function fResponse()
{
	var recv;
	
	if( this.status != 200 )
	{
		fError('status:'+this.status);
		return;
	}

	switch(this.readyState)
	{
	case 0: break;	// uninitialiazed
	case 1:	break;	// loading
	case 2: break;	// loaded
	case 3: break;	// interative
	case 4:			// complete
		var r = JSON.parse( this.responseText );
		if( r.rcode == 100 )
			fRecv(r.msg);
		else
			fError('receive error.');	
		break;
	default: 
		fError('unknown error.');
		break;
	}
}

function doQuery(arr)
{
	var h, url, s;

	arr.cluemd = '0.1';
	
	switch(arr.cmd)
	{
	case "select"	: url="select.php"; 		break;
	case "login"	: url="login.php";			break;
	}

	s = "jk="+JSON.stringify(arr);

	h = new XMLHttpRequest();
	h.onreadystatechange = fResponse;
	h.open("POST", url, true);
	h.setRequestHeader('Content-Type','application/x-www-form-urlencoded;charset=UTF-8');
	h.send(s);
}

