function fRecv(r) {}

function fError(r) {}

function setCookie($key, $value, $exp) {
    var d = new Date();
    var ar = new Object();
    ar['domain'] = 'cluemd';
    ar[$key] = $value;
    ar['expday'] = d.getDate() + $exp;
    document.cookie = JSON.stringify(ar);
}

function getCookie($key) {
    var $c = document.cookie;
    if (!$c)
        return "cookie(" + $key + ")->not set";
    var r = JSON.parse(document.cookie);
    if (!r[$key])
        return false;
    else {
        if (r['expday']) {
            var d = new Date();
            if (r['expday'] < d.getDate())
                return false;
        }
        return r[$key];
    }
}

function fResponse() {
    switch (this.readyState) {
        case 0:
            break; // uninitialiazed
        case 1:
            break; // loading
        case 2:
            break; // loaded
        case 3:
            break; // interative
        case 4: // complete
            var r = JSON.parse(this.responseText);
            if (r.code == 100)
                fRecv(r);
            else
                fError(r);
            break;
        default:
            break;
    }
}

function doQuery(arr) {
    var h, url, snd;

    arr.cluemd = '0.1';

    snd = "jk=" + JSON.stringify(arr);

    h = new XMLHttpRequest();
    h.onreadystatechange = fResponse;
    h.open("POST", "cluemd.php", true);
    h.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded;charset=UTF-8');
    h.send(snd);
}

$ = window;

function $d(name) {
    if (name.charAt(0) == '#')
        return document.getElementsByTagName(name.substr(1, name.length));
    else
        return document.getElementById(name);
}