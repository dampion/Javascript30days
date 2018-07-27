String.prototype.format = function () {
    var args = arguments;
    return this.replace(/\{(\d+)\}/g, function (m, i) {
        return args[i];
    });
};
var EasyMask = {
    callback: null,
    size: function () {
        var a = document.documentElement;
        var b = document.body;
        var c = Math.max;
        var d = window.innerWidth || c(b.clientWidth, a.clientWidth, b.offsetWidth, a.offsetWidth);
         d=Math.max(d,1000);  /*容器的最小宽度1000px*/
         var e = window.innerHeight || c(b.clientHeight, a.clientHeight, b.offsetHeight, a.offsetHeight);
        var f = c(b.scrollWidth, a.scrollWidth);
        var g = c(b.scrollHeight, a.scrollHeight);
        return [c(e, g), Math.min(d, f)]
    },
    addEvent: function (a, b, c) {
        a.attachEvent ? a.attachEvent('on' + b, function () { c.call(a) }) : a.addEventListener(b, c, false);
    },
    removeEvent: function (o, a, b) {
        o.detachEvent ? o.detachEvent('on' + a, b) : o.removeEventListener(a, b, false);
    },
    init: function () {
        this.ie6 = window.navigator.userAgent.indexOf('MSIE 6.0') != -1;
        var $ = function (v) { return document.getElementById(v); };
        var k = function (i, v) { return $(i) ? $(i) : v ? document.createElement("div") : document.createElement("iframe"); };
        var a = arguments.length ? arguments[0] : new Object;
        this.callback = a.callback;
        var size = this.size();
        var h = size[0];
        var w = size[1];
        var o = a.opacity ? a.opacity : 5;
        var m = a.molor ? a.molor : 'black';
        var width = a.width ? a.width < 300 ? 300 : a.width : 300;
        var height = a.height ? a.height < 100 ? 100 : a.height : 100;
        var b = a.bgcolor ? a.bgcolor : "#7D0000";
        var z = k("resourceContents", true);
        z.id = "resourceContents";
        z.style.cssText = 'position:fixed;_position:absolute;z-index:999999;width:{1}px;top:50%;left:50%;height:{2}px'.format(b, width, height);
        z.innerHTML = (a.html || "");
        var c = k("resourceMasks", true);
        c.id = "resourceMasks";
        if (a.fclose) c.onclick = this.close;
        c.style.cssText = "position:absolute;left:0;top:0;width:{0}px;height:{1}px;background:{2};z-index:999998;filter:alpha(opacity={3}0);opacity:0.{3};".format(w, h, m, o);
        this.app(z)(c);
        if (this.ie6) {
            this.resize();
            var s = k("resourceHideSelect", false);
            s.id = "resourceHideSelect";
            s.style.cssText = "height:{0}px;width:{1}px;z-index:999997;position:absolute;top:0;left:0;background:#fff;border:0;filter:alpha(opacity=0);opacity:0;".format(h, w);
            this.app(s);
        }
        else {
            z.style.marginLeft = '-{0}px'.format(Math.floor(width / 2));
            z.style.marginTop = '-{0}px'.format(Math.floor(height / 2));
        }
        EasyMask.addEvent(window, 'resize', EasyMask.resize);
        EasyMask.addEvent(window, 'scroll', EasyMask.resize);
    },
    close: function () {
        EasyMask.del('resourceMasks', 'resourceContents');
        this.ie6 = window.navigator.userAgent.indexOf('MSIE 6.0') != -1;
        if (this.ie6) {EasyMask.del('resourceHideSelect');}
        EasyMask.removeEvent(window, 'resize', EasyMask.resize);
        EasyMask.removeEvent(window, 'scroll', EasyMask.resize);
        if (typeof (EasyMask.callback) == 'function') {
            this.callback.call(this);
        }
         $(".layerBox").hide();
   },
    app: function (v) {
        document.body.appendChild(v);
        return EasyMask.app;
    },
    del: function () {
        for (var i = 0; i < arguments.length; i++) {
            var id = document.getElementById(arguments[i]);
            id && id.parentNode.removeChild(id);
        }
    },
    resize: function () {
        var s = EasyMask.size();
        var o = document.getElementById('resourceMasks');
        if (o) {
            o.style.height = s[0] + 'px';
            o.style.width = s[1] + 'px';
        }
        if (EasyMask.ie6) {
            var t = document.documentElement.scrollTop;
            var h = window.innerHeight || self.innerHeight || (document.documentElement && document.documentElement.clientHeight && document.documentElement.offsetHeight) || document.body.clientHeight;
            var b = document.getElementById('resourceContents');
            var he = b.offsetHeight;
            var wi = b.offsetWidth;
            var height = t + (h - he) / 2;
            b.style.top = height + "px";
            b.style.marginLeft = '-{0}px'.format(Math.floor(wi / 2));
        }
    }
}