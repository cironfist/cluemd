function calendar(parent, type) {

    var c = function(parent, type) {
        c.table = parent.add('table');
        var thead = c.table.add('thead');
        c.tbody = c.table.add('tbody');

        thead.add2('input', 'prev', 'type', 'button').attr('onclick', '_cal.prev()');
        c.btMonth = thead.add2('input', 'month', 'type', 'button').attr('onclick', '_cal.month()');
        c.btYear = thead.add2('input', 'year', 'type', 'button').attr('onclick', '_cal.year()');
        thead.add2('input', 'next', 'type', 'button').attr('onclick', '_cal.next()');
        thead.add2('input', 'close', 'type', 'button').attr('onclick', '_cal.close()');

        var now = new Date();
        c.year = now.getFullYear();
        c.month = now.getMonth(); // 0-11
        c.date = now.getDate(); // 날짜 1-31
        c.method = type; // month,day 

        if (type == 'month')
            c.makemonth(c.year, c.month);
        else
            c.makeday(c.year, c.month, c.date);

        $._cal = c;
    }

    /*c.prototype = {
        table: null,
        //prev: null,
        // thead: null,
        tbody: null,
        btMonth: null,
        btYear: null,
        year: 0,
        month: 0,
        date: 0,
        method: "not defined",
    };*/

    c.makemonth = function(year, month) {
        c.tbody.removeAll();

        c.btYear.attr('value', year);
        c.btMonth.attr('value', month + 1);

        var cur = 1;
        for (var i = 0; i < 4; i++) {
            var row = c.tbody.add('tr');
            for (var ii = 0; ii < 3; ii++) {
                row.add('td', cur, 'onclick', '_cal.dayclick(this)').attr('class', 'a');
                cur++;
            }
        }

    }
    c.addday = function(cur, row) {
        row.add('td', cur, 'onclick', '_cal.dayclick(this)').attr('name', cur).attr('class', 'a');
        return cur + 1;
    }
    c.makeday = function(year, month, date) {
        var ardays = new Array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
        if ((year % 4 == 0 && year % 100 !== 0) || year % 400 == 0)
            ardays[1] = 29;

        var days = ardays[month];

        var first = new Date(year, month, 1);
        var last = new Date(year, month, ardays[month]);
        first = first.getDay();
        last = last.getDay();
        var lastmonthdays = (month == 0) ? ardays[11] : ardays[month - 1];

        var tnum = (first + days) % 7;
        var numrow = Math.floor((first + days) / 7);
        if (tnum > 0)
            numrow++;
        var cur = 1;

        c.btYear.attr('value', year);
        c.btMonth.attr('value', month + 1);

        c.tbody.removeAll();

        var week = c.tbody.add('tr');
        week.add('th', '일');
        week.add('th', '월');
        week.add('th', '화');
        week.add('th', '수');
        week.add('th', '목');
        week.add('th', '금');
        week.add('th', '토');

        for (var i = 0; i < numrow; i++) {
            var row = c.tbody.add('tr');
            for (var ii = 0; ii < 7; ii++) {
                if (i == 0) // 첫번째 줄
                {
                    if (ii < first) // 이번달 아님
                        row.add('td', lastmonthdays - (first - ii) + 1).attr('class', 'b');
                    else
                        cur = c.addday(cur, row);
                } else if (i == numrow - 1) { // 마지막줄
                    if (ii > last) // 이번달 아님
                        row.add('td', ii - last).attr('class', 'b');
                    else
                        cur = c.addday(cur, row);
                } else
                    cur = c.addday(cur, row);
            }
        }

    }

    c.close = function() {
        c.table.removeAll();
    }

    c.dayclick = function(e) {
        c.date = e.innerText;
    }

    c.prev = function() {

        if (c.method == 'month') {
            c.year--;
            c.makemonth(c.year, c.month);
        } else {
            if (c.month == 0) {
                c.month = 11;
                c.year--;
            } else
                c.month--;
            c.makeday(c.year, c.month, c.date);
        }

    }

    c.next = function() {
        if (c.method == 'month') {
            c.year--;
            c.makemonth(c.year, c.month);
        } else {
            if (c.month == 11) {
                c.month = 0;
                c.year++;
            } else {
                c.month++;
            }
            c.makeday(c.year, c.month, c.date);
        }

    }

    return c(parent, type);

} // module.exports calendar

//window.c = calendar.c;