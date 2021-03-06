var letters = ["", " ", ",", ".", "'", "-", "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "u", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z", "æ", "ø", "å"];
var inputs = [];
var editing = window.location.search;
var hours = parseInt(document.getElementById("hour").value);
var minuts = parseInt(document.getElementById("min").value);
if (editing === "?edit") {
    hours = parseInt(document.getElementById("hhour").value);
    minuts = parseInt(document.getElementById("hmin").value);
}
function add(input, field) {
    inputs = [];
    var number = "";
    if (input === "") {
        input = 0;
    }
    var i;
    for (i = 0; i < input.length; i++) {
        inputs.push(input.substr(i, i + 1));
    }
    var potential;
    for (potential in inputs) {
        var isthere = false;
        var letter;
        for (letter in letters) {
            if (inputs[potential] === letters[letter]) {
                isthere = true;
            }
        }
        if (!isthere) {
            potential = inputs[potential];
            number = number + potential;
        }
    }
    if (number !== "") {
        if (field === "hour") {
            addManyHours(number);
        } else {
            addManyMinuts(number);
        }
    }
}
function addManyHours(hour) {
    hours = parseInt(hour);
    document.getElementById("hour").value = "";
    document.getElementById("hour").value = hours;
}
function addManyMinuts(minut) {
    minuts = parseInt(minut);
    while (minuts >= 60) {
        minuts = minuts - 60;
        addHours();
    }
    document.getElementById("min").value = "";
    document.getElementById("min").value = minuts;
}
function addHours() {
    hours = hours + 1;
    document.getElementById("hour").value = "";
    document.getElementById("hour").value = hours;
}
function addMinuts() {
    minuts = minuts + 15;
    if (minuts >= 60) {
        addHours();
        minuts = 0;
    }
    document.getElementById("min").value = "";
    document.getElementById("min").value = minuts;
}
function subtractHours() {
    if (hours > 0) {
        hours = hours - 1;
    }
    document.getElementById("hour").value = "";
    document.getElementById("hour").value = hours;
}
function subtractMinuts() {
    minuts = minuts - 15;
    if (minuts < 0) {
        minuts = 45;
        subtractHours();
    }
    document.getElementById("min").value = "";
    document.getElementById("min").value = minuts;
}
/////*! formstone v0.8.24 [number.js] 2015-10-21 | MIT License | formstone.it */
////Functions for transforming number input
//!function (a, b) {
//    "use strict";
//    function c() {
//        s = b.$body;
//    }
//    function d(a) {
//        var b = parseFloat(this.attr("min")), c = parseFloat(this.attr("max"));
//        a.min = b || 0 === b ? b : !1, a.max = c || 0 === c ? c : !1, a.step = parseFloat(this.attr("step")) || 1, a.timer = null, a.digits = l(a.step), a.disabled = this.prop("disabled");
//        var d = "";
//        d += '<button type="button" id="up" class="' + [p.arrow, p.up].join(" ") + '">' + a.labels.up + "</button>", d += '<button type="button" id"down" class="' + [p.arrow, p.down].join(" ") + '">' + a.labels.down + "</button>", this.wrap('<div class="' + [p.base, a.customClass, a.disabled ? p.disabled : ""].join(" ") + '"></div>').after(d), a.$container = this.parent(o.base), a.$arrows = a.$container.find(o.arrow), this.on(q.keyPress, o.element, a, h), a.$container.on([q.touchStart, q.mouseDown].join(" "), o.arrow, a, i);
//    }
//    function e(a) {
//        a.$arrows.remove(), this.unwrap().off(q.namespace);
//    }
//    function f(a) {
//        a.disabled && (this.prop("disabled", !1), a.$container.removeClass(p.disabled), a.disabled = !1);
//    }
//    function g(a) {
//        a.disabled || (this.prop("disabled", !0), a.$container.addClass(p.disabled), a.disabled = !0);
//    }
//    function h(a) {
//        var b = a.data;
//        (38 === a.keyCode || 40 === a.keyCode) && (a.preventDefault(), k(b, 38 === a.keyCode ? b.step : -b.step));
//    }
//    function i(b) {
//        r.killEvent(b), j(b);
//        var c = b.data;
//        if (!c.disabled) {
//            var d = a(b.target).hasClass(p.up) ? c.step : -c.step;
//            c.timer = r.startTimer(c.timer, 110, function () {
//                k(c, d, !1);
//            }, !0), k(c, d), s.on([q.touchEnd, q.mouseUp].join(" "), c, j);
//        }
//    }
//    function j(a) {
//        r.killEvent(a);
//        var b = a.data;
//        r.clearTimer(b.timer, !0), s.off(q.namespace);
//    }
//    function k(b, c) {
//        var d = parseFloat(b.$el.val()), e = c;
//        "undefined" === a.type(d) || isNaN(d) ? e = b.min !== !1 ? b.min : 0 : b.min !== !1 && d < b.min ? e = b.min : e += d;
//        var f = (e - b.min) % b.step;
//        0 !== f && (e -= f), b.min !== !1 && e < b.min && (e = b.min), b.max !== !1 && e > b.max && (e -= b.step), e !== d && (e = m(e, b.digits), b.$el.val(e).trigger(q.raw.change));
//    }
//    function l(a) {
//        var b = String(a);
//        return b.indexOf(".") > -1 ? b.length - b.indexOf(".") - 1 : 0;
//    }
//    function m(a, b) {
//        var c = Math.pow(10, b);
//        return Math.round(a * c) / c;
//    }
//    var n = b.Plugin("number", {
//        widget: !0, defaults: {
//            customClass: "", labels: {
//                up: "Up", down: "Down"
//            }
//        }, classes: ["arrow", "up", "down", "disabled"], methods: {
//            _setup: c, _construct: d, _destruct: e, enable: f, disable: g
//        }, events: {
//        }
//    }), o = n.classes, p = o.raw, q = n.events, r = n.functions, s = null;
//}(jQuery, Formstone);
