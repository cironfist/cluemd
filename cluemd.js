function fRecv(r) {}

function fError(r) {}

function setCookie($key, $value, $exp = 30) {
    var d = new Date();
    var ar = new Object();
    if (document.cookie)
        ar = JSON.parse(document.cookie);
    ar['domain'] = 'cluemd';
    ar[$key] = $value;
    ar['expday'] = d.getDate() + $exp;
    document.cookie = JSON.stringify(ar);
}

function getCookie($key) {
    var $c = document.cookie;
    if (!$c)
        return false;
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

function fmoney(str) {
    if (str.length < 4)
        return str;

    var pattern = /(\d+)(\d{3})/;
    if (pattern.test(str)) {
        var $1 = RegExp.$1;
        var $2 = RegExp.$2;
        return fmoney($1) + "," + $2;
    }
    return str;
}

Element.prototype.attrfind = function(name, value) {

    for (var i = 0; i < this.children.length; i++) {
        if (this.children[i].hasAttribute(name)) {
            if (this.children[i].attr(name) == value)
                return this.children[i];
        }
    }
    return false;
}

Element.prototype.attr = function(name, value = null) {
    if (!value)
        return this.getAttribute(name);

    this.setAttribute(name, value);

    return this;
}

Element.prototype.add = function(tag, text = null, attr = null, value = null) {
    var e = document.createElement(tag);

    if (text) {
        var tnode = document.createTextNode(text);
        e.appendChild(tnode);
    }
    if (attr && value) { e.setAttribute(attr, value); }

    this.appendChild(e);

    return e;
}

Element.prototype.removeAll = function() {
    var ch = this.children;
    var l = ch.length;
    for (var i = 0; i < l; i++) {
        this.firstElementChild.removeAll();
        this.removeChild(this.firstElementChild);
    }
}


function fHeaderBT() {
    var d = $d('headerBT').value;
    if (d == '사용자등록')
        $.location.href = "adduser.html";
    else if (d == '로그아웃') {
        document.cookie = '';
        $.location.href = "login.html";
    }
}

function fHeaderLoad() {
    var id = getCookie('id');
    var idx = getCookie('idx');
    var aname = getCookie('aname');

    if (!id || !idx) { // 로그인 안된상태
        $d('headerBT').value = "사용자등록";
        $d('userinfo').value = '';
    } else // 로그인 된상태
    {
        $d('headerBT').value = "로그아웃";
        $d('userinfo').value = aname;
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
            else if (r.code >= 900)
                fError(r);
            break;
        default:
            break;
    }
}

function fSetList(options, value) {
    for (var i = 0; i < options.length; i++) {
        if (options[i].text == value) {
            options.selectedIndex = i;
            return;
        }
    }
}

function fGetMsg(msg) {
    var a = Array();
    a = JSON.parse(msg);
    return a;
}

function doQuery(arr, target = "cluemd.php") {
    var h, url, snd;

    arr.cluemd = '0.1';

    snd = "jk=" + JSON.stringify(arr);

    h = new XMLHttpRequest();
    h.onreadystatechange = fResponse;
    h.open("POST", target, true);
    h.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded;charset=UTF-8');
    h.send(snd);
}

$ = window;

function $d(name) {
    if (name.charAt(0) == '#')
        return document.getElementsByTagName(name.substr(1, name.length - 1));
    else if (name.charAt(0) == '!')
        return document.getElementById(name.substr(1, name.length - 1)).style;
    else
        return document.getElementById(name);
}