function _fclose_cal() {
    $d('calendar').removeAll();
}

function _fdayclick_cal(e) {
    $d('calday').attr('name', e.attr('name'));
}

function _fprev_cal() {
    var year = $d('calyear').attr('name');
    var month = $d('calmonth').attr('name');
    var date = $d('calday').attr('name');

    var type = $d('caltype').attr('name');
    if (type == 'month') {
        year--;
        _f_makemonth_cal(year, month);
    } else {
        if (month == 0) {
            month = 11;
            year--;
        } else
            month--;
        _f_makeday_cal(year, month, date);
    }
}

function _fnext_cal() {
    var year = $d('calyear').attr('name');
    var month = $d('calmonth').attr('name');
    var date = $d('calday').attr('name');

    var type = $d('caltype').attr('name');
    if (type == 'month') {
        year--;
        _f_makemonth_cal(year, month);
    } else {
        if (month == 11) {
            month = 0;
            year++;
        } else {
            month++;
        }
        _f_makeday_cal(year, month, date);
    }
}

Element.prototype.calendar = function(type) {
    /*if ($d('calendar'))
        return;*/

    var t = this.add('table', null, 'id', 'calendar');
    var thead = t.add('thead', null, 'id', 'caltype').attr('name', type);
    var tbody = t.add('tbody').attr('id', 'calday');

    thead.add('input', null, 'type', 'button').attr('value', 'prev').attr('onclick', '_fprev_cal()');
    thead.add('input', null, 'type', 'button').attr('value', 'month').attr('onclick', 'fmonth')
        .attr('id', 'calmonth');
    thead.add('input', null, 'type', 'button').attr('value', 'year').attr('onclick', 'fyear')
        .attr('id', 'calyear');
    thead.add('input', null, 'type', 'button').attr('value', 'next').attr('onclick', '_fnext_cal()');
    thead.add('input', null, 'type', 'button').attr('value', 'close').attr('onclick', '_fclose_cal()');

    var now = new Date();
    var year = now.getFullYear();
    var month = now.getMonth(); // 0-11
    var date = now.getDate(); // 날짜 1-31    

    if (type == 'month')
        _f_makemonth_cal(year, month);
    else
        _f_makeday_cal(year, month, date);
}

function _f_makemonth_cal(year, month) {
    var tbody = $d('calday');
    tbody.removeAll();

    $d('calyear').attr('name', year);
    $d('calmonth').attr('name', month);

    var cur = 1;
    for (var i = 0; i < 4; i++) {
        var row = tbody.add('tr');
        for (var ii = 0; ii < 3; ii++) {
            row.add('td', cur, 'onclick', '_fdayclick_cal(this)').attr('name', cur)
                .attr('class', 'a');
            cur++;
        }
    }
}

function _f_makeday_cal(year, month, date) {
    var ardays = new Array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
    if ((year % 4 == 0 && year % 100 !== 0) || year % 400 == 0)
        ardays[1] = 29;

    var days = ardays[month];

    var first = new Date(year, month, 1);
    var last = new Date(year, month, ardays[month]);
    first = first.getDay();
    last = last.getDay();
    var lastmonthdays = (month == 0) ? ardays[11] : ardays[month - 1];

    var numrow = ((first + days) / 7) + 1;
    var cur = 1;

    $d('calyear').attr('name', year);
    $d('calmonth').attr('name', month);

    var tbody = $d('calday');
    tbody.removeAll();

    var week = tbody.add('tr');
    week.add('th', '일');
    week.add('th', '월');
    week.add('th', '화');
    week.add('th', '수');
    week.add('th', '목');
    week.add('th', '금');
    week.add('th', '토');

    this._addday = function(cur, row) {
        row.add('td', cur, 'onclick', '_fdayclick_cal(this)').attr('name', cur).attr('class', 'a');
        return cur + 1;
    }

    for (var i = 0; i < numrow; i++) {
        var row = tbody.add('tr');
        for (var ii = 0; ii < 7; ii++) {
            if (i == 0) // 첫번째 줄
            {
                if (ii < first) // 이번달 아님
                    row.add('td', lastmonthdays - (first - ii) + 1).attr('class', 'b');
                else
                    cur = this._addday(cur, row);
            } else if (i == numrow - 1) { // 마지막줄
                if (ii > last) // 이번달 아님
                    row.add('td', ii - last + 1).attr('class', 'b');
                else
                    cur = this._addday(cur, row);
            } else
                cur = this._addday(cur, row);
        }
    }
}