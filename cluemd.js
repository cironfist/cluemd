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
			fRecv(r);
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
	var h, url, snd;

	arr.cluemd = '0.1';
	
	snd = "jk="+JSON.stringify(arr);

	h = new XMLHttpRequest();
	h.onreadystatechange = fResponse;
	h.open("POST", "cluemd.php", true);
	h.setRequestHeader('Content-Type','application/x-www-form-urlencoded;charset=UTF-8');
	h.send(snd);
}

