/*! formstone v0.8.24 [core.js] 2015-10-21 | MIT License | formstone.it */
//Prerequisite for number.js
var Formstone = window.Formstone = function (a, b, c) {
    "use strict";
    function d(a) {
        m.Plugins[a].initialized || (m.Plugins[a].methods._setup.call(c), m.Plugins[a].initialized = !0);
    }
    function e(a, b, c, d) {
        var e, f = {raw: {}};
        d = d || {};
        for (e in d)
            d.hasOwnProperty(e) && ("classes" === a ? (f.raw[d[e]] = b + "-" + d[e], f[d[e]] = "." + b + "-" + d[e]) : (f.raw[e] = d[e], f[e] = d[e] + "." + b));
        for (e in c)
            c.hasOwnProperty(e) && ("classes" === a ? (f.raw[e] = c[e].replace(/{ns}/g, b), f[e] = c[e].replace(/{ns}/g, "." + b)) : (f.raw[e] = c[e].replace(/.{ns}/g, ""), f[e] = c[e].replace(/{ns}/g, b)));
        return f;
    }
    function f() {
        var a, b = {
            transition: "transitionend", MozTransition: "transitionend", OTransition: "otransitionend", WebkitTransition: "webkitTransitionEnd"}, d = ["transition", "-webkit-transition"], e = {transform: "transform", MozTransform: "-moz-transform", OTransform: "-o-transform", msTransform: "-ms-transform", webkitTransform: "-webkit-transform"}, f = "transitionend", g = "", h = "", i = c.createElement("div");
        for (a in b)
            if (b.hasOwnProperty(a) && a in i.style) {
                f = b[a], m.support.transition = !0;
                break
            }
        p.transitionEnd = f + ".{ns}";
        for (a in d)
            if (d.hasOwnProperty(a) && d[a]in i.style) {
                g = d[a];
                break
            }
        m.transition = g;
        for (a in e)
            if (e.hasOwnProperty(a) && e[a]in i.style) {
                m.support.transform = !0, h = e[a];
                break
            }
        m.transform = h;
    }
    function g() {
        m.windowWidth = m.$window.width(), m.windowHeight = m.$window.height(), q = l.startTimer(q, r, h);
    }
    function h() {
        for (var a in m.ResizeHandlers)
            m.ResizeHandlers.hasOwnProperty(a) && m.ResizeHandlers[a].callback.call(b, m.windowWidth, m.windowHeight);
    }
    function i() {
        if (m.support.raf) {
            m.window.requestAnimationFrame(i);
            for (var a in m.RAFHandlers)
                m.RAFHandlers.hasOwnProperty(a) && m.RAFHandlers[a].callback.call(b);
        }
    }
    function j(a, b) {
        return parseInt(a.priority) - parseInt(b.priority);
    }
    var k = function () {
        this.Version = "0.8.24", this.Plugins = {}, this.DontConflict = !1, this.Conflicts = {
            fn: {
            }
        }, this.ResizeHandlers = [], this.RAFHandlers = [], this.window = b, this.$window = a(b), this.document = c, this.$document = a(c), this.$body = null, this.windowWidth = 0, this.windowHeight = 0, this.fallbackWidth = 1024, this.userAgent = b.navigator.userAgent || b.navigator.vendor || b.opera, this.isFirefox = /Firefox/i.test(this.userAgent), this.isChrome = /Chrome/i.test(this.userAgent), this.isSafari = /Safari/i.test(this.userAgent) && !this.isChrome, this.isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(this.userAgent), this.isFirefoxMobile = this.isFirefox && this.isMobile, this.transform = null, this.transition = null, this.support = {
            file: !!(b.File && b.FileList && b.FileReader), history: !!(b.history && b.history.pushState && b.history.replaceState), matchMedia: !(!b.matchMedia && !b.msMatchMedia), pointer: !!b.PointerEvent, raf: !(!b.requestAnimationFrame || !b.cancelAnimationFrame), touch: !!("ontouchstart"in b || b.DocumentTouch && c instanceof b.DocumentTouch), transition: !1, transform: !1
        };
    }, l = {
        killEvent: function (a, b) {
            try {
                a.preventDefault(), a.stopPropagation(), b && a.stopImmediatePropagation();
            }
            catch (c) {
            }
        }, startTimer: function (a, b, c, d) {
            return l.clearTimer(a), d ? setInterval(c, b) : setTimeout(c, b);
        }, clearTimer: function (a, b) {
            a && (b ? clearInterval(a) : clearTimeout(a), a = null);
        }, sortAsc: function (a, b) {
            return parseInt(a, 10) - parseInt(b, 10);
        }, sortDesc: function (a, b) {
            return parseInt(b, 10) - parseInt(a, 10);
        }, decodeEntities: function (a) {
            var b = m.document.createElement("textarea");
            return b.innerHTML = a, b.value;
        }, parseQueryString: function (a) {
            for (var b = {}, c = a.slice(a.indexOf("?") + 1).split("&"), d = 0; d < c.length; d++) {
                var e = c[d].split("=");
                b[e[0]] = e[1];
            }
            return b;
        }
    }, m = new k, n = a.Deferred(), o = {base: "{ns}", element: "{ns}-element"
    }, p = {namespace: ".{ns}", beforeUnload: "beforeunload.{ns}", blur: "blur.{ns}", change: "change.{ns}", click: "click.{ns}", dblClick: "dblclick.{ns}", drag: "drag.{ns}", dragEnd: "dragend.{ns}", dragEnter: "dragenter.{ns}", dragLeave: "dragleave.{ns}", dragOver: "dragover.{ns}", dragStart: "dragstart.{ns}", drop: "drop.{ns}", error: "error.{ns}", focus: "focus.{ns}", focusIn: "focusin.{ns}", focusOut: "focusout.{ns}", input: "input.{ns}", keyDown: "keydown.{ns}", keyPress: "keypress.{ns}", keyUp: "keyup.{ns}", load: "load.{ns}", mouseDown: "mousedown.{ns}", mouseEnter: "mouseenter.{ns}", mouseLeave: "mouseleave.{ns}", mouseMove: "mousemove.{ns}", mouseOut: "mouseout.{ns}", mouseOver: "mouseover.{ns}", mouseUp: "mouseup.{ns}", panStart: "panstart.{ns}", pan: "pan.{ns}", panEnd: "panend.{ns}", resize: "resize.{ns}", scaleStart: "scalestart.{ns}", scaleEnd: "scaleend.{ns}", scale: "scale.{ns}", scroll: "scroll.{ns}", select: "select.{ns}", swipe: "swipe.{ns}", touchCancel: "touchcancel.{ns}", touchEnd: "touchend.{ns}", touchLeave: "touchleave.{ns}", touchMove: "touchmove.{ns}", touchStart: "touchstart.{ns}"};
    k.prototype.NoConflict = function () {
        m.DontConflict = !0;
        for (var b in m.Plugins)
            m.Plugins.hasOwnProperty(b) && (a[b] = m.Conflicts[b], a.fn[b] = m.Conflicts.fn[b]);
    }, k.prototype.Plugin = function (c, f) {
        return m.Plugins[c] = function (c, d) {
            function f(b) {
                var e, f, g, i = "object" === a.type(b), j = this, k = a();
                for (b = a.extend(!0, {}, d.defaults || {}, i?b:{}), f = 0, g = j.length; g > f; f++)
                    if (e = j.eq(f), !h(e)) {
                        var l = "__" + d.guid++, m = d.classes.raw.base + l, n = e.data(c + "-options"), o = a.extend(!0, {$el: e, guid: l, rawGuid: m, dotGuid: "." + m}, b, "object" === a.type(n) ? n : {});
                        e.addClass(d.classes.raw.element).data(s, o), d.methods._construct.apply(e, [o].concat(Array.prototype.slice.call(arguments, i ? 1 : 0))), k = k.add(e);
                    }
                for (f = 0, g = k.length; g > f; f++)
                    e = k.eq(f), d.methods._postConstruct.apply(e, [h(e)]);
                return j;
            }
            function g() {
                d.functions.iterate.apply(this, [d.methods._destruct].concat(Array.prototype.slice.call(arguments, 1))), this.removeClass(d.classes.raw.element).removeData(s);
            }
            function h(a) {
                return a.data(s);
            }
            function i(b) {
                if (this instanceof a) {
                    var c = d.methods[b];
                    return"object" !== a.type(b) && b ? c && 0 !== b.indexOf("_") ? d.functions.iterate.apply(this, [c].concat(Array.prototype.slice.call(arguments, 1))) : this : f.apply(this, arguments);
                }
            }
            function k(c) {
                var e = d.utilities[c] || d.utilities._initialize || !1;
                return e ? e.apply(b, Array.prototype.slice.call(arguments, "object" === a.type(c) ? 0 : 1)) : void 0;
            }
            function n(b) {
                d.defaults = a.extend(!0, d.defaults, b || {});
            }
            function q(b) {
                for (var c = this, d = 0, e = c.length; e > d; d++) {
                    var f = c.eq(d), g = h(f) || {};
                    "undefined" !== a.type(g.$el) && b.apply(f, [g].concat(Array.prototype.slice.call(arguments, 1)));
                }
                return c;
            }
            var r = "fs-" + c, s = "fs" + c.replace(/(^|\s)([a-z])/g, function (a, b, c) {
                return b + c.toUpperCase();
            });
            return d.initialized = !1, d.priority = d.priority || 10, d.classes = e("classes", r, o, d.classes), d.events = e("events", c, p, d.events), d.functions = a.extend({getData: h, iterate: q}, l, d.functions), d.methods = a.extend(!0, {_setup: a.noop, _construct: a.noop, _postConstruct: a.noop, _destruct: a.noop, _resize: !1, destroy: g}, d.methods), d.utilities = a.extend(!0, {_initialize: !1, _delegate: !1, defaults: n}, d.utilities), d.widget && (m.Conflicts.fn[c] = a.fn[c], a.fn[s] = i, m.DontConflict || (a.fn[c] = a.fn[s])), m.Conflicts[c] = a[c], a[s] = d.utilities._delegate || k, m.DontConflict || (a[c] = a[s]), d.namespace = c, d.namespaceClean = s, d.guid = 0, d.methods._resize && (m.ResizeHandlers.push({namespace: c, priority: d.priority, callback: d.methods._resize}), m.ResizeHandlers.sort(j)), d.methods._raf && (m.RAFHandlers.push({namespace: c, priority: d.priority, callback: d.methods._raf}), m.RAFHandlers.sort(j)), d;
        }(c, f), n.then(function () {
            d(c);
        }), m.Plugins[c];
    };
    var q = null, r = 20;
    return m.$window.on("resize.fs", g), g(), i(), a(function () {
        m.$body = a("body"), n.resolve(), m.support.nativeMatchMedia = m.support.matchMedia && !a("html").hasClass("no-matchmedia");
    }), p.clickTouchStart = p.click + " " + p.touchStart, f(), m;
}(jQuery, window, document);