/* jakweb Style */
$(document).ready(function () {

  $.slidebars({
    siteClose: true, // true or false
    disableOver: 992, // integer or false
    hideControlClasses: true, // true or false
    scrollLock: true // true or false
  });

  $(window).scroll(function () {
    if ($(this).scrollTop() > 100) {
      $('#toTop').fadeIn();
    } else {
      $('#toTop').fadeOut();
    }
  });
  $('#toTop').click(function () {
    $("html, body").animate({scrollTop: 0}, 400);
    return false;
  });

});

// Slidebars 0.10.3 (http://plugins.adchsm.me/slidebars/) written by Adam Smith (http://www.adchsm.com/) released under MIT License (http://plugins.adchsm.me/slidebars/license.txt)
!function (t) {
  t.slidebars = function (s) {
    function e() {
      !c.disableOver || "number" == typeof c.disableOver && c.disableOver >= k ? (w = !0, t("html").addClass("sb-init"), c.hideControlClasses && T.removeClass("sb-hide"), i()) : "number" == typeof c.disableOver && c.disableOver < k && (w = !1, t("html").removeClass("sb-init"), c.hideControlClasses && T.addClass("sb-hide"), g.css("minHeight", ""), (p || y) && o())
    }

    function i() {
      g.css("minHeight", "");
      var s = parseInt(g.css("height"), 10), e = parseInt(t("html").css("height"), 10);
      e > s && g.css("minHeight", t("html").css("height")), m && m.hasClass("sb-width-custom") && m.css("width", m.attr("data-sb-width")), C && C.hasClass("sb-width-custom") && C.css("width", C.attr("data-sb-width")), m && (m.hasClass("sb-style-push") || m.hasClass("sb-style-overlay")) && m.css("marginLeft", "-" + m.css("width")), C && (C.hasClass("sb-style-push") || C.hasClass("sb-style-overlay")) && C.css("marginRight", "-" + C.css("width")), c.scrollLock && t("html").addClass("sb-scroll-lock")
    }

    function n(t, s, e) {
      function n() {
        a.removeAttr("style"), i()
      }

      var a;
      if (a = t.hasClass("sb-style-push") ? g.add(t).add(O) : t.hasClass("sb-style-overlay") ? t : g.add(O), "translate" === x)"0px" === s ? n() : a.css("transform", "translate( " + s + " )"); else if ("side" === x)"0px" === s ? n() : ("-" === s[0] && (s = s.substr(1)), a.css(e, "0px"), setTimeout(function () {
        a.css(e, s)
      }, 1)); else if ("jQuery" === x) {
        "-" === s[0] && (s = s.substr(1));
        var o = {};
        o[e] = s, a.stop().animate(o, 400)
      }
    }

    function a(s) {
      function e() {
        w && "left" === s && m ? (t("html").addClass("sb-active sb-active-left"), m.addClass("sb-active"), n(m, m.css("width"), "left"), setTimeout(function () {
          p = !0
        }, 400)) : w && "right" === s && C && (t("html").addClass("sb-active sb-active-right"), C.addClass("sb-active"), n(C, "-" + C.css("width"), "right"), setTimeout(function () {
          y = !0
        }, 400))
      }

      "left" === s && m && y || "right" === s && C && p ? (o(), setTimeout(e, 400)) : e()
    }

    function o(s, e) {
      (p || y) && (p && (n(m, "0px", "left"), p = !1), y && (n(C, "0px", "right"), y = !1), setTimeout(function () {
        t("html").removeClass("sb-active sb-active-left sb-active-right"), m && m.removeClass("sb-active"), C && C.removeClass("sb-active"), "undefined" != typeof s && (void 0 === typeof e && (e = "_self"), window.open(s, e))
      }, 400))
    }

    function l(t) {
      "left" === t && m && (p ? o() : a("left")), "right" === t && C && (y ? o() : a("right"))
    }

    function r(t, s) {
      t.stopPropagation(), t.preventDefault(), "touchend" === t.type && s.off("click")
    }

    var c = t.extend({
      siteClose: !0,
      scrollLock: !1,
      disableOver: !1,
      hideControlClasses: !1
    }, s), h = document.createElement("div").style, d = !1, f = !1;
    ("" === h.MozTransition || "" === h.WebkitTransition || "" === h.OTransition || "" === h.transition) && (d = !0), ("" === h.MozTransform || "" === h.WebkitTransform || "" === h.OTransform || "" === h.transform) && (f = !0);
    var u = navigator.userAgent, b = !1, v = !1;
    /Android/.test(u) ? b = u.substr(u.indexOf("Android") + 8, 3) : /(iPhone|iPod|iPad)/.test(u) && (v = u.substr(u.indexOf("OS ") + 3, 3).replace("_", ".")), (b && 3 > b || v && 5 > v) && t("html").addClass("sb-static");
    var g = t("#sb-site, .sb-site-container");
    if (t(".sb-left").length)var m = t(".sb-left"), p = !1;
    if (t(".sb-right").length)var C = t(".sb-right"), y = !1;
    var w = !1, k = t(window).width(), T = t(".sb-toggle-left, .sb-toggle-right, .sb-open-left, .sb-open-right, .sb-close"), O = t(".sb-slide");
    e(), t(window).resize(function () {
      var s = t(window).width();
      k !== s && (k = s, e(), p && a("left"), y && a("right"))
    });
    var x;
    d && f ? (x = "translate", b && 4.4 > b && (x = "side")) : x = "jQuery", this.slidebars = {
      open: a,
      close: o,
      toggle: l,
      init: function () {
        return w
      },
      active: function (t) {
        return "left" === t && m ? p : "right" === t && C ? y : void 0
      },
      destroy: function (t) {
        "left" === t && m && (p && o(), setTimeout(function () {
          m.remove(), m = !1
        }, 400)), "right" === t && C && (y && o(), setTimeout(function () {
          C.remove(), C = !1
        }, 400))
      }
    }, t(".sb-toggle-left").on("touchend click", function (s) {
      r(s, t(this)), l("left")
    }), t(".sb-toggle-right").on("touchend click", function (s) {
      r(s, t(this)), l("right")
    }), t(".sb-open-left").on("touchend click", function (s) {
      r(s, t(this)), a("left")
    }), t(".sb-open-right").on("touchend click", function (s) {
      r(s, t(this)), a("right")
    }), t(".sb-close").on("touchend click", function (s) {
      if (t(this).is("a") || t(this).children().is("a")) {
        if ("click" === s.type) {
          s.stopPropagation(), s.preventDefault();
          var e = t(this).is("a") ? t(this) : t(this).find("a"), i = e.attr("href"), n = e.attr("target") ? e.attr("target") : "_self";
          o(i, n)
        }
      } else r(s, t(this)), o()
    }), g.on("touchend click", function (s) {
      c.siteClose && (p || y) && (r(s, t(this)), o())
    })
  }
}(jQuery);