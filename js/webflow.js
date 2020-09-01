/*!
 * ----------------------------------------------------------------------
 * Webflow: Front-end site library
 * @license MIT
 * Other scripts may access this api using an async handler:
 *   var Webflow = Webflow || [];
 *   Webflow.push(readyFunction);
 * ----------------------------------------------------------------------
 */
var Webflow = { w: Webflow };
Webflow.init = function () {
  'use strict';

  var $ = window.$;
  var api = {};
  var modules = {};
  var primary = [];
  var secondary = this.w || [];
  var $win = $(window);
  var $doc = $(document);
  var _ = api._ = underscore();
  var domready = false;
  var tram = window.tram;
  var Modernizr = window.Modernizr;
  var noop = function () { };
  tram.config.hideBackface = false;
  tram.config.keepInherited = true;

  /**
   * Webflow.define() - Define a webflow.js module
   * @param  {string} name
   * @param  {function} factory
   */
  api.define = function (name, factory) {
    var module = modules[name] = factory($, _);
    if (!module) return;
    // If running in Webflow app, subscribe to design/preview events
    if (api.env()) {
      $.isFunction(module.design) && window.addEventListener('__wf_design', module.design);
      $.isFunction(module.preview) && window.addEventListener('__wf_preview', module.preview);
    }
    // Subscribe to module front-end events
    $.isFunction(module.destroy) && $win.on('__wf_destroy', module.destroy);
    // Look for a ready method on module
    if (module.ready && $.isFunction(module.ready)) {
      // If domready has already happened, call ready method
      if (domready) module.ready();
      // Otherwise push ready method into primary queue
      else primary.push(module.ready);
    }
  };

  /**
   * Webflow.require() - Load a Webflow.js module
   * @param  {string} name
   * @return {object}
   */
  api.require = function (name) {
    return modules[name];
  };

  /**
   * Webflow.push() - Add a ready handler into secondary queue
   * @param {function} ready  Callback to invoke on domready
   */
  api.push = function (ready) {
    // If domready has already happened, invoke handler
    if (domready) {
      $.isFunction(ready) && ready();
      return;
    }
    // Otherwise push into secondary queue
    secondary.push(ready);
  };

  /**
   * Webflow.env() - Get the state of the Webflow app
   * @param {string} mode [optional]
   * @return {boolean}
   */
  api.env = function (mode) {
    var designFlag = window.__wf_design;
    var inApp = typeof designFlag != 'undefined';
    if (!mode) return inApp;
    if (mode == 'design') return inApp && designFlag;
    if (mode == 'preview') return inApp && !designFlag;
    if (mode == 'slug') return inApp && window.__wf_slug;
    if (mode == 'editor') return window.WebflowEditor;
  };

  // Feature detects + browser sniffs  à² _à² 
  var userAgent = navigator.userAgent.toLowerCase();
  var appVersion = navigator.appVersion.toLowerCase();
  var touch = api.env.touch = ('ontouchstart' in window) || window.DocumentTouch && document instanceof window.DocumentTouch;
  var chrome = api.env.chrome = /chrome/.test(userAgent) && /Google/.test(navigator.vendor) && parseInt(appVersion.match(/chrome\/(\d+)\./)[1], 10);
  var ios = api.env.ios = Modernizr && Modernizr.ios;
  api.env.safari = /safari/.test(userAgent) && !chrome && !ios;

  // Maintain current touch target to prevent late clicks on touch devices
  var touchTarget;
  // Listen for both events to support touch/mouse hybrid devices
  touch && $doc.on('touchstart mousedown', function (evt) {
    touchTarget = evt.target;
  });

  /**
   * Webflow.validClick() - validate click target against current touch target
   * @param  {HTMLElement} clickTarget  Element being clicked
   * @return {Boolean}  True if click target is valid (always true on non-touch)
   */
  api.validClick = touch ? function (clickTarget) {
    return clickTarget === touchTarget || $.contains(clickTarget, touchTarget);
  } : function () { return true; };

  /**
   * Webflow.resize, Webflow.scroll - throttled event proxies
   */
  var resizeEvents = 'resize.webflow orientationchange.webflow load.webflow';
  var scrollEvents = 'scroll.webflow ' + resizeEvents;
  api.resize = eventProxy($win, resizeEvents);
  api.scroll = eventProxy($win, scrollEvents);
  api.redraw = eventProxy();

  // Create a proxy instance for throttled events
  function eventProxy(target, types) {

    // Set up throttled method (using custom frame-based _.throttle)
    var handlers = [];
    var proxy = {};
    proxy.up = _.throttle(function (evt) {
      _.each(handlers, function (h) { h(evt); });
    });

    // Bind events to target
    if (target && types) target.on(types, proxy.up);

    /**
     * Add an event handler
     * @param  {function} handler
     */
    proxy.on = function (handler) {
      if (typeof handler != 'function') return;
      if (_.contains(handlers, handler)) return;
      handlers.push(handler);
    };

    /**
     * Remove an event handler
     * @param  {function} handler
     */
    proxy.off = function (handler) {
      handlers = _.filter(handlers, function (h) {
        return h !== handler;
      });
    };
    return proxy;
  }

  // Provide optional IX events to components
  api.ixEvents = function () {
    var ix = api.require('ix');
    return (ix && ix.events) || {
      reset: noop,
      intro: noop,
      outro: noop
    };
  };

  // Webflow.location() - Wrap window.location in api
  api.location = function (url) {
    window.location = url;
  };

  // Webflow.app - Designer-specific methods
  api.app = api.env() ? {} : null;
  if (api.app) {

    // Trigger redraw for specific elements
    var Event = window.Event;
    var redraw = new Event('__wf_redraw');
    api.app.redrawElement = function (i, el) { el.dispatchEvent(redraw); };

    // Webflow.location - Re-route location change to trigger an event
    api.location = function (url) {
      window.dispatchEvent(new CustomEvent('__wf_location', { detail: url }));
    };
  }

  // Webflow.ready() - Call primary and secondary handlers
  api.ready = function () {
    domready = true;
    $.each(primary.concat(secondary), function (index, value) {
      $.isFunction(value) && value();
    });
    // Trigger resize
    api.resize.up();
  };

  /**
   * Webflow.load() - Add a window load handler that will run even if load event has already happened
   * @param  {function} handler
   */
  var deferLoad;
  api.load = function (handler) {
    deferLoad.then(handler);
  };

  function bindLoad() {
    // Reject any previous deferred (to support destroy)
    if (deferLoad) {
      deferLoad.reject();
      $win.off('load', deferLoad.resolve);
    }
    // Create deferred and bind window load event
    deferLoad = new $.Deferred();
    $win.on('load', deferLoad.resolve);
  }

  // Webflow.destroy() - Trigger a cleanup event for all modules
  api.destroy = function () {
    $win.triggerHandler('__wf_destroy');
    // If load event has not yet fired, replace the deferred
    if (deferLoad.state() == 'pending') bindLoad();
  };

  // Listen for domready
  $(api.ready);

  // Listen for window.onload and resolve deferred
  bindLoad();

  /*!
   * Webflow._ (aka) Underscore.js 1.6.0 (custom build)
   * _.each
   * _.map
   * _.find
   * _.filter
   * _.any
   * _.contains
   * _.delay
   * _.defer
   * _.throttle (webflow)
   * _.debounce
   * _.keys
   * _.has
   * _.now
   *
   * http://underscorejs.org
   * (c) 2009-2013 Jeremy Ashkenas, DocumentCloud and Investigative Reporters & Editors
   * Underscore may be freely distributed under the MIT license.
   */
  function underscore() {
    var _ = {};

    // Current version.
    _.VERSION = '1.6.0-Webflow';

    // Establish the object that gets returned to break out of a loop iteration.
    var breaker = {};

    // Save bytes in the minified (but not gzipped) version:
    var ArrayProto = Array.prototype, ObjProto = Object.prototype, FuncProto = Function.prototype;

    // Create quick reference variables for speed access to core prototypes.
    var
      push = ArrayProto.push,
      slice = ArrayProto.slice,
      concat = ArrayProto.concat,
      toString = ObjProto.toString,
      hasOwnProperty = ObjProto.hasOwnProperty;

    // All **ECMAScript 5** native function implementations that we hope to use
    // are declared here.
    var
      nativeForEach = ArrayProto.forEach,
      nativeMap = ArrayProto.map,
      nativeReduce = ArrayProto.reduce,
      nativeReduceRight = ArrayProto.reduceRight,
      nativeFilter = ArrayProto.filter,
      nativeEvery = ArrayProto.every,
      nativeSome = ArrayProto.some,
      nativeIndexOf = ArrayProto.indexOf,
      nativeLastIndexOf = ArrayProto.lastIndexOf,
      nativeIsArray = Array.isArray,
      nativeKeys = Object.keys,
      nativeBind = FuncProto.bind;

    // Collection Functions
    // --------------------

    // The cornerstone, an `each` implementation, aka `forEach`.
    // Handles objects with the built-in `forEach`, arrays, and raw objects.
    // Delegates to **ECMAScript 5**'s native `forEach` if available.
    var each = _.each = _.forEach = function (obj, iterator, context) {
      /* jshint shadow:true */
      if (obj == null) return obj;
      if (nativeForEach && obj.forEach === nativeForEach) {
        obj.forEach(iterator, context);
      } else if (obj.length === +obj.length) {
        for (var i = 0, length = obj.length; i < length; i++) {
          if (iterator.call(context, obj[i], i, obj) === breaker) return;
        }
      } else {
        var keys = _.keys(obj);
        for (var i = 0, length = keys.length; i < length; i++) {
          if (iterator.call(context, obj[keys[i]], keys[i], obj) === breaker) return;
        }
      }
      return obj;
    };

    // Return the results of applying the iterator to each element.
    // Delegates to **ECMAScript 5**'s native `map` if available.
    _.map = _.collect = function (obj, iterator, context) {
      var results = [];
      if (obj == null) return results;
      if (nativeMap && obj.map === nativeMap) return obj.map(iterator, context);
      each(obj, function (value, index, list) {
        results.push(iterator.call(context, value, index, list));
      });
      return results;
    };

    // Return the first value which passes a truth test. Aliased as `detect`.
    _.find = _.detect = function (obj, predicate, context) {
      var result;
      any(obj, function (value, index, list) {
        if (predicate.call(context, value, index, list)) {
          result = value;
          return true;
        }
      });
      return result;
    };

    // Return all the elements that pass a truth test.
    // Delegates to **ECMAScript 5**'s native `filter` if available.
    // Aliased as `select`.
    _.filter = _.select = function (obj, predicate, context) {
      var results = [];
      if (obj == null) return results;
      if (nativeFilter && obj.filter === nativeFilter) return obj.filter(predicate, context);
      each(obj, function (value, index, list) {
        if (predicate.call(context, value, index, list)) results.push(value);
      });
      return results;
    };

    // Determine if at least one element in the object matches a truth test.
    // Delegates to **ECMAScript 5**'s native `some` if available.
    // Aliased as `any`.
    var any = _.some = _.any = function (obj, predicate, context) {
      predicate || (predicate = _.identity);
      var result = false;
      if (obj == null) return result;
      if (nativeSome && obj.some === nativeSome) return obj.some(predicate, context);
      each(obj, function (value, index, list) {
        if (result || (result = predicate.call(context, value, index, list))) return breaker;
      });
      return !!result;
    };

    // Determine if the array or object contains a given value (using `===`).
    // Aliased as `include`.
    _.contains = _.include = function (obj, target) {
      if (obj == null) return false;
      if (nativeIndexOf && obj.indexOf === nativeIndexOf) return obj.indexOf(target) != -1;
      return any(obj, function (value) {
        return value === target;
      });
    };

    // Function (ahem) Functions
    // --------------------

    // Delays a function for the given number of milliseconds, and then calls
    // it with the arguments supplied.
    _.delay = function (func, wait) {
      var args = slice.call(arguments, 2);
      return setTimeout(function () { return func.apply(null, args); }, wait);
    };

    // Defers a function, scheduling it to run after the current call stack has
    // cleared.
    _.defer = function (func) {
      return _.delay.apply(_, [func, 1].concat(slice.call(arguments, 1)));
    };

    // Returns a function, that, when invoked, will only be triggered once every
    // browser animation frame - using tram's requestAnimationFrame polyfill.
    _.throttle = function (func) {
      var wait, args, context;
      return function () {
        if (wait) return;
        wait = true;
        args = arguments;
        context = this;
        tram.frame(function () {
          wait = false;
          func.apply(context, args);
        });
      };
    };

    // Returns a function, that, as long as it continues to be invoked, will not
    // be triggered. The function will be called after it stops being called for
    // N milliseconds. If `immediate` is passed, trigger the function on the
    // leading edge, instead of the trailing.
    _.debounce = function (func, wait, immediate) {
      var timeout, args, context, timestamp, result;

      var later = function () {
        var last = _.now() - timestamp;
        if (last < wait) {
          timeout = setTimeout(later, wait - last);
        } else {
          timeout = null;
          if (!immediate) {
            result = func.apply(context, args);
            context = args = null;
          }
        }
      };

      return function () {
        context = this;
        args = arguments;
        timestamp = _.now();
        var callNow = immediate && !timeout;
        if (!timeout) {
          timeout = setTimeout(later, wait);
        }
        if (callNow) {
          result = func.apply(context, args);
          context = args = null;
        }

        return result;
      };
    };

    // Object Functions
    // ----------------

    // Retrieve the names of an object's properties.
    // Delegates to **ECMAScript 5**'s native `Object.keys`
    _.keys = function (obj) {
      if (!_.isObject(obj)) return [];
      if (nativeKeys) return nativeKeys(obj);
      var keys = [];
      for (var key in obj) if (_.has(obj, key)) keys.push(key);
      return keys;
    };

    // Shortcut function for checking if an object has a given property directly
    // on itself (in other words, not on a prototype).
    _.has = function (obj, key) {
      return hasOwnProperty.call(obj, key);
    };

    // Is a given variable an object?
    _.isObject = function (obj) {
      return obj === Object(obj);
    };

    // Utility Functions
    // -----------------

    // A (possibly faster) way to get the current timestamp as an integer.
    _.now = Date.now || function () { return new Date().getTime(); };

    // Export underscore
    return _;
  }

  // Export api
  Webflow = api;
};
/*!
 * ----------------------------------------------------------------------
 * Webflow: 3rd party plugins
 */
/* jshint ignore:start */
/*!
 * tram.js v0.8.1-global
 * Cross-browser CSS3 transitions in JavaScript
 * https://github.com/bkwld/tram
 * MIT License
 */
window.tram = function (a) { function b(a, b) { var c = new L.Bare; return c.init(a, b) } function c(a) { return a.replace(/[A-Z]/g, function (a) { return "-" + a.toLowerCase() }) } function d(a) { var b = parseInt(a.slice(1), 16), c = b >> 16 & 255, d = b >> 8 & 255, e = 255 & b; return [c, d, e] } function e(a, b, c) { return "#" + (1 << 24 | a << 16 | b << 8 | c).toString(16).slice(1) } function f() { } function g(a, b) { _("Type warning: Expected: [" + a + "] Got: [" + typeof b + "] " + b) } function h(a, b, c) { _("Units do not match [" + a + "]: " + b + ", " + c) } function i(a, b, c) { if (void 0 !== b && (c = b), void 0 === a) return c; var d = c; return Z.test(a) || !$.test(a) ? d = parseInt(a, 10) : $.test(a) && (d = 1e3 * parseFloat(a)), 0 > d && (d = 0), d === d ? d : c } function j(a) { for (var b = -1, c = a ? a.length : 0, d = []; ++b < c;) { var e = a[b]; e && d.push(e) } return d } var k = function (a, b, c) { function d(a) { return "object" == typeof a } function e(a) { return "function" == typeof a } function f() { } function g(h, i) { function j() { var a = new k; return e(a.init) && a.init.apply(a, arguments), a } function k() { } i === c && (i = h, h = Object), j.Bare = k; var l, m = f[a] = h[a], n = k[a] = j[a] = new f; return n.constructor = j, j.mixin = function (b) { return k[a] = j[a] = g(j, b)[a], j }, j.open = function (a) { if (l = {}, e(a) ? l = a.call(j, n, m, j, h) : d(a) && (l = a), d(l)) for (var c in l) b.call(l, c) && (n[c] = l[c]); return e(n.init) || (n.init = h), j }, j.open(i) } return g }("prototype", {}.hasOwnProperty), l = { ease: ["ease", function (a, b, c, d) { var e = (a /= d) * a, f = e * a; return b + c * (-2.75 * f * e + 11 * e * e + -15.5 * f + 8 * e + .25 * a) }], "ease-in": ["ease-in", function (a, b, c, d) { var e = (a /= d) * a, f = e * a; return b + c * (-1 * f * e + 3 * e * e + -3 * f + 2 * e) }], "ease-out": ["ease-out", function (a, b, c, d) { var e = (a /= d) * a, f = e * a; return b + c * (.3 * f * e + -1.6 * e * e + 2.2 * f + -1.8 * e + 1.9 * a) }], "ease-in-out": ["ease-in-out", function (a, b, c, d) { var e = (a /= d) * a, f = e * a; return b + c * (2 * f * e + -5 * e * e + 2 * f + 2 * e) }], linear: ["linear", function (a, b, c, d) { return c * a / d + b }], "ease-in-quad": ["cubic-bezier(0.550, 0.085, 0.680, 0.530)", function (a, b, c, d) { return c * (a /= d) * a + b }], "ease-out-quad": ["cubic-bezier(0.250, 0.460, 0.450, 0.940)", function (a, b, c, d) { return -c * (a /= d) * (a - 2) + b }], "ease-in-out-quad": ["cubic-bezier(0.455, 0.030, 0.515, 0.955)", function (a, b, c, d) { return (a /= d / 2) < 1 ? c / 2 * a * a + b : -c / 2 * (--a * (a - 2) - 1) + b }], "ease-in-cubic": ["cubic-bezier(0.550, 0.055, 0.675, 0.190)", function (a, b, c, d) { return c * (a /= d) * a * a + b }], "ease-out-cubic": ["cubic-bezier(0.215, 0.610, 0.355, 1)", function (a, b, c, d) { return c * ((a = a / d - 1) * a * a + 1) + b }], "ease-in-out-cubic": ["cubic-bezier(0.645, 0.045, 0.355, 1)", function (a, b, c, d) { return (a /= d / 2) < 1 ? c / 2 * a * a * a + b : c / 2 * ((a -= 2) * a * a + 2) + b }], "ease-in-quart": ["cubic-bezier(0.895, 0.030, 0.685, 0.220)", function (a, b, c, d) { return c * (a /= d) * a * a * a + b }], "ease-out-quart": ["cubic-bezier(0.165, 0.840, 0.440, 1)", function (a, b, c, d) { return -c * ((a = a / d - 1) * a * a * a - 1) + b }], "ease-in-out-quart": ["cubic-bezier(0.770, 0, 0.175, 1)", function (a, b, c, d) { return (a /= d / 2) < 1 ? c / 2 * a * a * a * a + b : -c / 2 * ((a -= 2) * a * a * a - 2) + b }], "ease-in-quint": ["cubic-bezier(0.755, 0.050, 0.855, 0.060)", function (a, b, c, d) { return c * (a /= d) * a * a * a * a + b }], "ease-out-quint": ["cubic-bezier(0.230, 1, 0.320, 1)", function (a, b, c, d) { return c * ((a = a / d - 1) * a * a * a * a + 1) + b }], "ease-in-out-quint": ["cubic-bezier(0.860, 0, 0.070, 1)", function (a, b, c, d) { return (a /= d / 2) < 1 ? c / 2 * a * a * a * a * a + b : c / 2 * ((a -= 2) * a * a * a * a + 2) + b }], "ease-in-sine": ["cubic-bezier(0.470, 0, 0.745, 0.715)", function (a, b, c, d) { return -c * Math.cos(a / d * (Math.PI / 2)) + c + b }], "ease-out-sine": ["cubic-bezier(0.390, 0.575, 0.565, 1)", function (a, b, c, d) { return c * Math.sin(a / d * (Math.PI / 2)) + b }], "ease-in-out-sine": ["cubic-bezier(0.445, 0.050, 0.550, 0.950)", function (a, b, c, d) { return -c / 2 * (Math.cos(Math.PI * a / d) - 1) + b }], "ease-in-expo": ["cubic-bezier(0.950, 0.050, 0.795, 0.035)", function (a, b, c, d) { return 0 === a ? b : c * Math.pow(2, 10 * (a / d - 1)) + b }], "ease-out-expo": ["cubic-bezier(0.190, 1, 0.220, 1)", function (a, b, c, d) { return a === d ? b + c : c * (-Math.pow(2, -10 * a / d) + 1) + b }], "ease-in-out-expo": ["cubic-bezier(1, 0, 0, 1)", function (a, b, c, d) { return 0 === a ? b : a === d ? b + c : (a /= d / 2) < 1 ? c / 2 * Math.pow(2, 10 * (a - 1)) + b : c / 2 * (-Math.pow(2, -10 * --a) + 2) + b }], "ease-in-circ": ["cubic-bezier(0.600, 0.040, 0.980, 0.335)", function (a, b, c, d) { return -c * (Math.sqrt(1 - (a /= d) * a) - 1) + b }], "ease-out-circ": ["cubic-bezier(0.075, 0.820, 0.165, 1)", function (a, b, c, d) { return c * Math.sqrt(1 - (a = a / d - 1) * a) + b }], "ease-in-out-circ": ["cubic-bezier(0.785, 0.135, 0.150, 0.860)", function (a, b, c, d) { return (a /= d / 2) < 1 ? -c / 2 * (Math.sqrt(1 - a * a) - 1) + b : c / 2 * (Math.sqrt(1 - (a -= 2) * a) + 1) + b }], "ease-in-back": ["cubic-bezier(0.600, -0.280, 0.735, 0.045)", function (a, b, c, d, e) { return void 0 === e && (e = 1.70158), c * (a /= d) * a * ((e + 1) * a - e) + b }], "ease-out-back": ["cubic-bezier(0.175, 0.885, 0.320, 1.275)", function (a, b, c, d, e) { return void 0 === e && (e = 1.70158), c * ((a = a / d - 1) * a * ((e + 1) * a + e) + 1) + b }], "ease-in-out-back": ["cubic-bezier(0.680, -0.550, 0.265, 1.550)", function (a, b, c, d, e) { return void 0 === e && (e = 1.70158), (a /= d / 2) < 1 ? c / 2 * a * a * (((e *= 1.525) + 1) * a - e) + b : c / 2 * ((a -= 2) * a * (((e *= 1.525) + 1) * a + e) + 2) + b }] }, m = { "ease-in-back": "cubic-bezier(0.600, 0, 0.735, 0.045)", "ease-out-back": "cubic-bezier(0.175, 0.885, 0.320, 1)", "ease-in-out-back": "cubic-bezier(0.680, 0, 0.265, 1)" }, n = document, o = window, p = "bkwld-tram", q = /[\-\.0-9]/g, r = /[A-Z]/, s = "number", t = /^(rgb|#)/, u = /(em|cm|mm|in|pt|pc|px)$/, v = /(em|cm|mm|in|pt|pc|px|%)$/, w = /(deg|rad|turn)$/, x = "unitless", y = /(all|none) 0s ease 0s/, z = /^(width|height)$/, A = " ", B = n.createElement("a"), C = ["Webkit", "Moz", "O", "ms"], D = ["-webkit-", "-moz-", "-o-", "-ms-"], E = function (a) { if (a in B.style) return { dom: a, css: a }; var b, c, d = "", e = a.split("-"); for (b = 0; b < e.length; b++)d += e[b].charAt(0).toUpperCase() + e[b].slice(1); for (b = 0; b < C.length; b++)if (c = C[b] + d, c in B.style) return { dom: c, css: D[b] + a } }, F = b.support = { bind: Function.prototype.bind, transform: E("transform"), transition: E("transition"), backface: E("backface-visibility"), timing: E("transition-timing-function") }; if (F.transition) { var G = F.timing.dom; if (B.style[G] = l["ease-in-back"][0], !B.style[G]) for (var H in m) l[H][0] = m[H] } var I = b.frame = function () { var a = o.requestAnimationFrame || o.webkitRequestAnimationFrame || o.mozRequestAnimationFrame || o.oRequestAnimationFrame || o.msRequestAnimationFrame; return a && F.bind ? a.bind(o) : function (a) { o.setTimeout(a, 16) } }(), J = b.now = function () { var a = o.performance, b = a && (a.now || a.webkitNow || a.msNow || a.mozNow); return b && F.bind ? b.bind(a) : Date.now || function () { return +new Date } }(), K = k(function (b) { function d(a, b) { var c = j(("" + a).split(A)), d = c[0]; b = b || {}; var e = X[d]; if (!e) return _("Unsupported property: " + d); if (!b.weak || !this.props[d]) { var f = e[0], g = this.props[d]; return g || (g = this.props[d] = new f.Bare), g.init(this.$el, c, e, b), g } } function e(a, b, c) { if (a) { var e = typeof a; if (b || (this.timer && this.timer.destroy(), this.queue = [], this.active = !1), "number" == e && b) return this.timer = new R({ duration: a, context: this, complete: h }), void (this.active = !0); if ("string" == e && b) { switch (a) { case "hide": n.call(this); break; case "stop": k.call(this); break; case "redraw": o.call(this); break; default: d.call(this, a, c && c[1]) }return h.call(this) } if ("function" == e) return void a.call(this, this); if ("object" == e) { var f = 0; t.call(this, a, function (a, b) { a.span > f && (f = a.span), a.stop(), a.animate(b) }, function (a) { "wait" in a && (f = i(a.wait, 0)) }), s.call(this), f > 0 && (this.timer = new R({ duration: f, context: this }), this.active = !0, b && (this.timer.complete = h)); var g = this, j = !1, l = {}; I(function () { t.call(g, a, function (a) { a.active && (j = !0, l[a.name] = a.nextStyle) }), j && g.$el.css(l) }) } } } function f(a) { a = i(a, 0), this.active ? this.queue.push({ options: a }) : (this.timer = new R({ duration: a, context: this, complete: h }), this.active = !0) } function g(a) { return this.active ? (this.queue.push({ options: a, args: arguments }), void (this.timer.complete = h)) : _("No active transition timer. Use start() or wait() before then().") } function h() { if (this.timer && this.timer.destroy(), this.active = !1, this.queue.length) { var a = this.queue.shift(); e.call(this, a.options, !0, a.args) } } function k(a) { this.timer && this.timer.destroy(), this.queue = [], this.active = !1; var b; "string" == typeof a ? (b = {}, b[a] = 1) : b = "object" == typeof a && null != a ? a : this.props, t.call(this, b, u), s.call(this) } function l(a) { k.call(this, a), t.call(this, a, v, w) } function m(a) { "string" != typeof a && (a = "block"), this.el.style.display = a } function n() { k.call(this), this.el.style.display = "none" } function o() { this.el.offsetHeight } function q() { k.call(this), a.removeData(this.el, p), this.$el = this.el = null } function s() { var a, b, c = []; this.upstream && c.push(this.upstream); for (a in this.props) b = this.props[a], b.active && c.push(b.string); c = c.join(","), this.style !== c && (this.style = c, this.el.style[F.transition.dom] = c) } function t(a, b, e) { var f, g, h, i, j = b !== u, k = {}; for (f in a) h = a[f], f in Y ? (k.transform || (k.transform = {}), k.transform[f] = h) : (r.test(f) && (f = c(f)), f in X ? k[f] = h : (i || (i = {}), i[f] = h)); for (f in k) { if (h = k[f], g = this.props[f], !g) { if (!j) continue; g = d.call(this, f) } b.call(this, g, h) } e && i && e.call(this, i) } function u(a) { a.stop() } function v(a, b) { a.set(b) } function w(a) { this.$el.css(a) } function x(a, c) { b[a] = function () { return this.children ? z.call(this, c, arguments) : (this.el && c.apply(this, arguments), this) } } function z(a, b) { var c, d = this.children.length; for (c = 0; d > c; c++)a.apply(this.children[c], b); return this } b.init = function (b) { if (this.$el = a(b), this.el = this.$el[0], this.props = {}, this.queue = [], this.style = "", this.active = !1, T.keepInherited && !T.fallback) { var c = V(this.el, "transition"); c && !y.test(c) && (this.upstream = c) } F.backface && T.hideBackface && U(this.el, F.backface.css, "hidden") }, x("add", d), x("start", e), x("wait", f), x("then", g), x("next", h), x("stop", k), x("set", l), x("show", m), x("hide", n), x("redraw", o), x("destroy", q) }), L = k(K, function (b) { function c(b, c) { var d = a.data(b, p) || a.data(b, p, new K.Bare); return d.el || d.init(b), c ? d.start(c) : d } b.init = function (b, d) { var e = a(b); if (!e.length) return this; if (1 === e.length) return c(e[0], d); var f = []; return e.each(function (a, b) { f.push(c(b, d)) }), this.children = f, this } }), M = k(function (a) { function b() { var a = this.get(); this.update("auto"); var b = this.get(); return this.update(a), b } function c(a, b, c) { return void 0 !== b && (c = b), a in l ? a : c } function d(a) { var b = /rgba?\((\d+),\s*(\d+),\s*(\d+)/.exec(a); return (b ? e(b[1], b[2], b[3]) : a).replace(/#(\w)(\w)(\w)$/, "#$1$1$2$2$3$3") } var f = { duration: 500, ease: "ease", delay: 0 }; a.init = function (a, b, d, e) { this.$el = a, this.el = a[0]; var g = b[0]; d[2] && (g = d[2]), W[g] && (g = W[g]), this.name = g, this.type = d[1], this.duration = i(b[1], this.duration, f.duration), this.ease = c(b[2], this.ease, f.ease), this.delay = i(b[3], this.delay, f.delay), this.span = this.duration + this.delay, this.active = !1, this.nextStyle = null, this.auto = z.test(this.name), this.unit = e.unit || this.unit || T.defaultUnit, this.angle = e.angle || this.angle || T.defaultAngle, T.fallback || e.fallback ? this.animate = this.fallback : (this.animate = this.transition, this.string = this.name + A + this.duration + "ms" + ("ease" != this.ease ? A + l[this.ease][0] : "") + (this.delay ? A + this.delay + "ms" : "")) }, a.set = function (a) { a = this.convert(a, this.type), this.update(a), this.redraw() }, a.transition = function (a) { this.active = !0, a = this.convert(a, this.type), this.auto && ("auto" == this.el.style[this.name] && (this.update(this.get()), this.redraw()), "auto" == a && (a = b.call(this))), this.nextStyle = a }, a.fallback = function (a) { var c = this.el.style[this.name] || this.convert(this.get(), this.type); a = this.convert(a, this.type), this.auto && ("auto" == c && (c = this.convert(this.get(), this.type)), "auto" == a && (a = b.call(this))), this.tween = new Q({ from: c, to: a, duration: this.duration, delay: this.delay, ease: this.ease, update: this.update, context: this }) }, a.get = function () { return V(this.el, this.name) }, a.update = function (a) { U(this.el, this.name, a) }, a.stop = function () { (this.active || this.nextStyle) && (this.active = !1, this.nextStyle = null, U(this.el, this.name, this.get())); var a = this.tween; a && a.context && a.destroy() }, a.convert = function (a, b) { if ("auto" == a && this.auto) return a; var c, e = "number" == typeof a, f = "string" == typeof a; switch (b) { case s: if (e) return a; if (f && "" === a.replace(q, "")) return +a; c = "number(unitless)"; break; case t: if (f) { if ("" === a && this.original) return this.original; if (b.test(a)) return "#" == a.charAt(0) && 7 == a.length ? a : d(a) } c = "hex or rgb string"; break; case u: if (e) return a + this.unit; if (f && b.test(a)) return a; c = "number(px) or string(unit)"; break; case v: if (e) return a + this.unit; if (f && b.test(a)) return a; c = "number(px) or string(unit or %)"; break; case w: if (e) return a + this.angle; if (f && b.test(a)) return a; c = "number(deg) or string(angle)"; break; case x: if (e) return a; if (f && v.test(a)) return a; c = "number(unitless) or string(unit or %)" }return g(c, a), a }, a.redraw = function () { this.el.offsetHeight } }), N = k(M, function (a, b) { a.init = function () { b.init.apply(this, arguments), this.original || (this.original = this.convert(this.get(), t)) } }), O = k(M, function (a, b) { a.init = function () { b.init.apply(this, arguments), this.animate = this.fallback }, a.get = function () { return this.$el[this.name]() }, a.update = function (a) { this.$el[this.name](a) } }), P = k(M, function (a, b) { function c(a, b) { var c, d, e, f, g; for (c in a) f = Y[c], e = f[0], d = f[1] || c, g = this.convert(a[c], e), b.call(this, d, g, e) } a.init = function () { b.init.apply(this, arguments), this.current || (this.current = {}, Y.perspective && T.perspective && (this.current.perspective = T.perspective, U(this.el, this.name, this.style(this.current)), this.redraw())) }, a.set = function (a) { c.call(this, a, function (a, b) { this.current[a] = b }), U(this.el, this.name, this.style(this.current)), this.redraw() }, a.transition = function (a) { var b = this.values(a); this.tween = new S({ current: this.current, values: b, duration: this.duration, delay: this.delay, ease: this.ease }); var c, d = {}; for (c in this.current) d[c] = c in b ? b[c] : this.current[c]; this.active = !0, this.nextStyle = this.style(d) }, a.fallback = function (a) { var b = this.values(a); this.tween = new S({ current: this.current, values: b, duration: this.duration, delay: this.delay, ease: this.ease, update: this.update, context: this }) }, a.update = function () { U(this.el, this.name, this.style(this.current)) }, a.style = function (a) { var b, c = ""; for (b in a) c += b + "(" + a[b] + ") "; return c }, a.values = function (a) { var b, d = {}; return c.call(this, a, function (a, c, e) { d[a] = c, void 0 === this.current[a] && (b = 0, ~a.indexOf("scale") && (b = 1), this.current[a] = this.convert(b, e)) }), d } }), Q = k(function (b) { function c(a) { 1 === n.push(a) && I(g) } function g() { var a, b, c, d = n.length; if (d) for (I(g), b = J(), a = d; a--;)c = n[a], c && c.render(b) } function i(b) { var c, d = a.inArray(b, n); d >= 0 && (c = n.slice(d + 1), n.length = d, c.length && (n = n.concat(c))) } function j(a) { return Math.round(a * o) / o } function k(a, b, c) { return e(a[0] + c * (b[0] - a[0]), a[1] + c * (b[1] - a[1]), a[2] + c * (b[2] - a[2])) } var m = { ease: l.ease[1], from: 0, to: 1 }; b.init = function (a) { this.duration = a.duration || 0, this.delay = a.delay || 0; var b = a.ease || m.ease; l[b] && (b = l[b][1]), "function" != typeof b && (b = m.ease), this.ease = b, this.update = a.update || f, this.complete = a.complete || f, this.context = a.context || this, this.name = a.name; var c = a.from, d = a.to; void 0 === c && (c = m.from), void 0 === d && (d = m.to), this.unit = a.unit || "", "number" == typeof c && "number" == typeof d ? (this.begin = c, this.change = d - c) : this.format(d, c), this.value = this.begin + this.unit, this.start = J(), a.autoplay !== !1 && this.play() }, b.play = function () { this.active || (this.start || (this.start = J()), this.active = !0, c(this)) }, b.stop = function () { this.active && (this.active = !1, i(this)) }, b.render = function (a) { var b, c = a - this.start; if (this.delay) { if (c <= this.delay) return; c -= this.delay } if (c < this.duration) { var d = this.ease(c, 0, 1, this.duration); return b = this.startRGB ? k(this.startRGB, this.endRGB, d) : j(this.begin + d * this.change), this.value = b + this.unit, void this.update.call(this.context, this.value) } b = this.endHex || this.begin + this.change, this.value = b + this.unit, this.update.call(this.context, this.value), this.complete.call(this.context), this.destroy() }, b.format = function (a, b) { if (b += "", a += "", "#" == a.charAt(0)) return this.startRGB = d(b), this.endRGB = d(a), this.endHex = a, this.begin = 0, void (this.change = 1); if (!this.unit) { var c = b.replace(q, ""), e = a.replace(q, ""); c !== e && h("tween", b, a), this.unit = c } b = parseFloat(b), a = parseFloat(a), this.begin = this.value = b, this.change = a - b }, b.destroy = function () { this.stop(), this.context = null, this.ease = this.update = this.complete = f }; var n = [], o = 1e3 }), R = k(Q, function (a) { a.init = function (a) { this.duration = a.duration || 0, this.complete = a.complete || f, this.context = a.context, this.play() }, a.render = function (a) { var b = a - this.start; b < this.duration || (this.complete.call(this.context), this.destroy()) } }), S = k(Q, function (a, b) { a.init = function (a) { this.context = a.context, this.update = a.update, this.tweens = [], this.current = a.current; var b, c; for (b in a.values) c = a.values[b], this.current[b] !== c && this.tweens.push(new Q({ name: b, from: this.current[b], to: c, duration: a.duration, delay: a.delay, ease: a.ease, autoplay: !1 })); this.play() }, a.render = function (a) { var b, c, d = this.tweens.length, e = !1; for (b = d; b--;)c = this.tweens[b], c.context && (c.render(a), this.current[c.name] = c.value, e = !0); return e ? void (this.update && this.update.call(this.context)) : this.destroy() }, a.destroy = function () { if (b.destroy.call(this), this.tweens) { var a, c = this.tweens.length; for (a = c; a--;)this.tweens[a].destroy(); this.tweens = null, this.current = null } } }), T = b.config = { defaultUnit: "px", defaultAngle: "deg", keepInherited: !1, hideBackface: !1, perspective: "", fallback: !F.transition, agentTests: [] }; b.fallback = function (a) { if (!F.transition) return T.fallback = !0; T.agentTests.push("(" + a + ")"); var b = new RegExp(T.agentTests.join("|"), "i"); T.fallback = b.test(navigator.userAgent) }, b.fallback("6.0.[2-5] Safari"), b.tween = function (a) { return new Q(a) }, b.delay = function (a, b, c) { return new R({ complete: b, duration: a, context: c }) }, a.fn.tram = function (a) { return b.call(null, this, a) }; var U = a.style, V = a.css, W = { transform: F.transform && F.transform.css }, X = { color: [N, t], background: [N, t, "background-color"], "outline-color": [N, t], "border-color": [N, t], "border-top-color": [N, t], "border-right-color": [N, t], "border-bottom-color": [N, t], "border-left-color": [N, t], "border-width": [M, u], "border-top-width": [M, u], "border-right-width": [M, u], "border-bottom-width": [M, u], "border-left-width": [M, u], "border-spacing": [M, u], "letter-spacing": [M, u], margin: [M, u], "margin-top": [M, u], "margin-right": [M, u], "margin-bottom": [M, u], "margin-left": [M, u], padding: [M, u], "padding-top": [M, u], "padding-right": [M, u], "padding-bottom": [M, u], "padding-left": [M, u], "outline-width": [M, u], opacity: [M, s], top: [M, v], right: [M, v], bottom: [M, v], left: [M, v], "font-size": [M, v], "text-indent": [M, v], "word-spacing": [M, v], width: [M, v], "min-width": [M, v], "max-width": [M, v], height: [M, v], "min-height": [M, v], "max-height": [M, v], "line-height": [M, x], "scroll-top": [O, s, "scrollTop"], "scroll-left": [O, s, "scrollLeft"] }, Y = {}; F.transform && (X.transform = [P], Y = { x: [v, "translateX"], y: [v, "translateY"], rotate: [w], rotateX: [w], rotateY: [w], scale: [s], scaleX: [s], scaleY: [s], skew: [w], skewX: [w], skewY: [w] }), F.transform && F.backface && (Y.z = [v, "translateZ"], Y.rotateZ = [w], Y.scaleZ = [s], Y.perspective = [u]); var Z = /ms/, $ = /s|\./, _ = function () { var a = "warn", b = window.console; return b && b[a] ? function (c) { b[a](c) } : f }(); return a.tram = b }(window.jQuery);
/*!
 * jQuery-ajaxTransport-XDomainRequest - v1.0.3 - 2014-06-06
 * https://github.com/MoonScript/jQuery-ajaxTransport-XDomainRequest
 * Copyright (c) 2014 Jason Moon (@JSONMOON)
 * Licensed MIT (/blob/master/LICENSE.txt)
 */
(function (a) { if (typeof define === 'function' && define.amd) { define(['jquery'], a) } else if (typeof exports === 'object') { module.exports = a(require('jquery')) } else { a(jQuery) } }(function ($) { if ($.support.cors || !$.ajaxTransport || !window.XDomainRequest) { return } var n = /^https?:\/\//i; var o = /^get|post$/i; var p = new RegExp('^' + location.protocol, 'i'); $.ajaxTransport('* text html xml json', function (j, k, l) { if (!j.crossDomain || !j.async || !o.test(j.type) || !n.test(j.url) || !p.test(j.url)) { return } var m = null; return { send: function (f, g) { var h = ''; var i = (k.dataType || '').toLowerCase(); m = new XDomainRequest(); if (/^\d+$/.test(k.timeout)) { m.timeout = k.timeout } m.ontimeout = function () { g(500, 'timeout') }; m.onload = function () { var a = 'Content-Length: ' + m.responseText.length + '\r\nContent-Type: ' + m.contentType; var b = { code: 200, message: 'success' }; var c = { text: m.responseText }; try { if (i === 'html' || /text\/html/i.test(m.contentType)) { c.html = m.responseText } else if (i === 'json' || (i !== 'text' && /\/json/i.test(m.contentType))) { try { c.json = $.parseJSON(m.responseText) } catch (e) { b.code = 500; b.message = 'parseerror' } } else if (i === 'xml' || (i !== 'text' && /\/xml/i.test(m.contentType))) { var d = new ActiveXObject('Microsoft.XMLDOM'); d.async = false; try { d.loadXML(m.responseText) } catch (e) { d = undefined } if (!d || !d.documentElement || d.getElementsByTagName('parsererror').length) { b.code = 500; b.message = 'parseerror'; throw 'Invalid XML: ' + m.responseText; } c.xml = d } } catch (parseMessage) { throw parseMessage; } finally { g(b.code, b.message, c, a) } }; m.onprogress = function () { }; m.onerror = function () { g(500, 'error', { text: m.responseText }) }; if (k.data) { h = ($.type(k.data) === 'string') ? k.data : $.param(k.data) } m.open(j.type, j.url); m.send(h) }, abort: function () { if (m) { m.abort() } } } }) }));
/* jshint ignore:end */
/**
 * ----------------------------------------------------------------------
 * Init lib after plugins
 */
Webflow.init();
/**
 * ----------------------------------------------------------------------
 * Webflow: Interactions
 */
Webflow.define('ix', function ($, _) {
  'use strict';

  var api = {};
  var designer;
  var $win = $(window);
  var namespace = '.w-ix';
  var tram = window.tram;
  var env = Webflow.env;
  var ios = env.ios;
  var inApp = env();
  var emptyFix = env.chrome && env.chrome < 35;
  var transNone = 'none 0s ease 0s';
  var introEvent = 'w-ix-intro' + namespace;
  var outroEvent = 'w-ix-outro' + namespace;
  var fallbackProps = /width|height/;
  var eventQueue = [];
  var $subs = $();
  var config = {};
  var anchors = [];
  var loads = [];
  var readys = [];
  var destroyed;

  // Component types and proxy selectors
  var components = {
    tabs: '.w-tab-link, .w-tab-pane',
    dropdown: '.w-dropdown',
    slider: '.w-slide',
    navbar: '.w-nav'
  };

  // -----------------------------------
  // Module methods

  api.init = function (list) {
    setTimeout(function () { configure(list); }, 1);
  };

  api.preview = function () {
    designer = false;
    setTimeout(function () { configure(window.__wf_ix); }, 1);
  };

  api.design = function () {
    designer = true;
    api.destroy();
  };

  api.destroy = function () {
    destroyed = true;
    $subs.each(teardown);
    Webflow.scroll.off(scroll);
    asyncEvents();
    anchors = [];
    loads = [];
    readys = [];
  };

  api.ready = function () {
    // Ready should only be used after destroy, as a way to re-init
    if (config && destroyed) {
      destroyed = false;
      init();
    }
  };

  api.run = run;
  api.events = {};
  api.style = inApp ? styleApp : stylePub;

  // -----------------------------------
  // Private methods

  function configure(list) {
    if (!list) return;

    // Map all interactions to a hash using slug as key.
    config = {};
    _.each(list, function (item) {
      config[item.slug] = item.value;
    });

    // Init ix after config
    init();
  }

  function init() {
    // Build each element's interaction keying from data attribute
    var els = $('[data-ix]');
    if (!els.length) return;
    els.each(teardown);
    els.each(build);

    // Listen for scroll events if any anchors exist
    if (anchors.length) {
      Webflow.scroll.on(scroll);
      setTimeout(scroll, 1);
    }

    // Handle loads or readys if they exist
    if (loads.length) Webflow.load(runLoads);
    if (readys.length) setTimeout(runReadys, 1);

    // Trigger queued events, must happen after init
    initEvents();
  }

  function build(i, el) {
    var $el = $(el);
    var id = $el.attr('data-ix');
    var ix = config[id];
    if (!ix) return;
    var triggers = ix.triggers;
    if (!triggers) return;

    // Set initial styles, unless we detect an iOS device + any non-iOS triggers
    var setStyles = !(ios && _.any(triggers, isNonIOS));
    if (setStyles) api.style($el, ix.style);

    _.each(triggers, function (trigger) {
      var state = {};
      var type = trigger.type;
      var stepsB = trigger.stepsB && trigger.stepsB.length;

      function runA() { run(trigger, $el, { group: 'A' }); }
      function runB() { run(trigger, $el, { group: 'B' }); }

      if (type == 'load') {
        (trigger.preload && !inApp) ? loads.push(runA) : readys.push(runA);
        return;
      }

      if (type == 'click') {
        $el.on('click' + namespace, function (evt) {
          // Avoid late clicks on touch devices
          if (!Webflow.validClick(evt.currentTarget)) return;

          // Prevent default on empty hash urls
          if ($el.attr('href') === '#') evt.preventDefault();

          run(trigger, $el, { group: state.clicked ? 'B' : 'A' });
          if (stepsB) state.clicked = !state.clicked;
        });
        $subs = $subs.add($el);
        return;
      }

      if (type == 'hover') {
        $el.on('mouseenter' + namespace, runA);
        $el.on('mouseleave' + namespace, runB);
        $subs = $subs.add($el);
        return;
      }

      // Check for a component proxy selector
      var proxy = components[type];
      if (proxy) {
        var $proxy = $el.closest(proxy);
        $proxy.on(introEvent, runA).on(outroEvent, runB);
        $subs = $subs.add($proxy);
        return;
      }

      // Ignore the following triggers on iOS devices
      if (ios) return;

      if (type == 'scroll') {
        anchors.push({
          el: $el, trigger: trigger, state: { active: false },
          offsetTop: convert(trigger.offsetTop),
          offsetBot: convert(trigger.offsetBot)
        });
        return;
      }
    });
  }

  function isNonIOS(trigger) {
    return trigger.type == 'scroll';
  }

  function convert(offset) {
    if (!offset) return 0;
    offset = offset + '';
    var result = parseInt(offset, 10);
    if (result !== result) return 0;
    if (offset.indexOf('%') > 0) {
      result = result / 100;
      if (result >= 1) result = 0.999;
    }
    return result;
  }

  function teardown(i, el) {
    $(el).off(namespace);
  }

  function scroll() {
    var viewTop = $win.scrollTop();
    var viewHeight = $win.height();

    // Check each anchor for a valid scroll trigger
    var count = anchors.length;
    for (var i = 0; i < count; i++) {
      var anchor = anchors[i];
      var $el = anchor.el;
      var trigger = anchor.trigger;
      var stepsB = trigger.stepsB && trigger.stepsB.length;
      var state = anchor.state;
      var top = $el.offset().top;
      var height = $el.outerHeight();
      var offsetTop = anchor.offsetTop;
      var offsetBot = anchor.offsetBot;
      if (offsetTop < 1 && offsetTop > 0) offsetTop *= viewHeight;
      if (offsetBot < 1 && offsetBot > 0) offsetBot *= viewHeight;
      var active = (top + height - offsetTop >= viewTop && top + offsetBot <= viewTop + viewHeight);
      if (active === state.active) continue;
      if (active === false && !stepsB) continue;
      state.active = active;
      run(trigger, $el, { group: active ? 'A' : 'B' });
    }
  }

  function runLoads() {
    var count = loads.length;
    for (var i = 0; i < count; i++) {
      loads[i]();
    }
  }

  function runReadys() {
    var count = readys.length;
    for (var i = 0; i < count; i++) {
      readys[i]();
    }
  }

  function run(trigger, $el, opts, replay) {
    opts = opts || {};
    var done = opts.done;

    // Do not run in designer unless forced
    if (designer && !opts.force) return;

    // Operate on a set of grouped steps
    var group = opts.group || 'A';
    var loop = trigger['loop' + group];
    var steps = trigger['steps' + group];
    if (!steps || !steps.length) return;
    if (steps.length < 2) loop = false;

    // One-time init before any loops
    if (!replay) {

      // Find selector within element descendants, siblings, or query whole document
      var selector = trigger.selector;
      if (selector) {
        $el = (
          trigger.descend ? $el.find(selector) :
            trigger.siblings ? $el.siblings(selector) :
              $(selector)
        );
        if (inApp) $el.attr('data-ix-affect', 1);
      }

      // Apply empty fix for certain Chrome versions
      if (emptyFix) $el.addClass('w-ix-emptyfix');
    }

    var _tram = tram($el);

    // Add steps
    var meta = {};
    for (var i = 0; i < steps.length; i++) {
      addStep(_tram, steps[i], meta);
    }

    function fin() {
      // Run trigger again if looped
      if (loop) return run(trigger, $el, opts, true);

      // Reset any 'auto' values
      if (meta.width == 'auto') _tram.set({ width: 'auto' });
      if (meta.height == 'auto') _tram.set({ height: 'auto' });

      // Run callback
      done && done();
    }

    // Add final step to queue if tram has started
    meta.start ? _tram.then(fin) : fin();
  }

  function addStep(_tram, step, meta) {
    var addMethod = 'add';
    var startMethod = 'start';

    // Once the transition has started, we will always use then() to add to the queue.
    if (meta.start) addMethod = startMethod = 'then';

    // Parse transitions string on the current step
    var transitions = step.transition;
    if (transitions) {
      transitions = transitions.split(',');
      for (var i = 0; i < transitions.length; i++) {
        var transition = transitions[i];
        var options = fallbackProps.test(transition) ? { fallback: true } : null;
        _tram[addMethod](transition, options);
      }
    }

    // Build a clean object to pass to the tram method
    var clean = tramify(step) || {};

    // Store last width and height values
    if (clean.width != null) meta.width = clean.width;
    if (clean.height != null) meta.height = clean.height;

    // When transitions are not present, set values immediately and continue queue.
    if (transitions == null) {

      // If we have started, wrap set() in then() and reset queue
      if (meta.start) {
        _tram.then(function () {
          var queue = this.queue;
          this.set(clean);
          if (clean.display) {
            _tram.redraw();
            Webflow.redraw.up();
          }
          this.queue = queue;
          this.next();
        });
      } else {
        _tram.set(clean);

        // Always redraw after setting display
        if (clean.display) {
          _tram.redraw();
          Webflow.redraw.up();
        }
      }

      // Use the wait() method to kick off queue in absence of transitions.
      var wait = clean.wait;
      if (wait != null) {
        _tram.wait(wait);
        meta.start = true;
      }

      // Otherwise, when transitions are present
    } else {

      // If display is present, handle it separately
      if (clean.display) {
        var display = clean.display;
        delete clean.display;

        // If we've already started, we need to wrap it in a then()
        if (meta.start) {
          _tram.then(function () {
            var queue = this.queue;
            this.set({ display: display }).redraw();
            Webflow.redraw.up();
            this.queue = queue;
            this.next();
          });
        } else {
          _tram.set({ display: display }).redraw();
          Webflow.redraw.up();
        }
      }

      // Otherwise, start a transition using the current start method.
      _tram[startMethod](clean);
      meta.start = true;
    }
  }

  // (In app) Set styles immediately and manage upstream transition
  function styleApp(el, data) {
    var _tram = tram(el);

    // Get computed transition value
    el.css('transition', '');
    var computed = el.css('transition');

    // If computed is disabled, clear upstream
    if (computed === transNone) computed = _tram.upstream = null;

    // Disable upstream temporarily
    _tram.upstream = transNone;

    // Set values immediately
    _tram.set(tramify(data));

    // Only restore upstream in preview mode
    _tram.upstream = computed;
  }

  // (Published) Set styles immediately on specified jquery element
  function stylePub(el, data) {
    tram(el).set(tramify(data));
  }

  // Build a clean object for tram
  function tramify(obj) {
    var result = {};
    var found = false;
    for (var x in obj) {
      if (x === 'transition') continue;
      result[x] = obj[x];
      found = true;
    }
    // If empty, return null for tram.set/stop compliance
    return found ? result : null;
  }

  // Events used by other webflow modules
  var events = {
    reset: function (i, el) {
      el.__wf_intro = null;
    },
    intro: function (i, el) {
      if (el.__wf_intro) return;
      el.__wf_intro = true;
      $(el).triggerHandler(introEvent);
    },
    outro: function (i, el) {
      if (!el.__wf_intro) return;
      el.__wf_intro = null;
      $(el).triggerHandler(outroEvent);
    }
  };

  // Trigger events in queue + point to sync methods
  function initEvents() {
    var count = eventQueue.length;
    for (var i = 0; i < count; i++) {
      var memo = eventQueue[i];
      memo[0](0, memo[1]);
    }
    eventQueue = [];
    $.extend(api.events, events);
  }

  // Replace events with async methods prior to init
  function asyncEvents() {
    _.each(events, function (func, name) {
      api.events[name] = function (i, el) {
        eventQueue.push([func, el]);
      };
    });
  }

  asyncEvents();

  // Export module
  return api;
});


/**
 * ----------------------------------------------------------------------
 * Webflow: Interactions: Init
 */
Webflow.require('ix').init([
  { "slug": "fade-in-heading", "name": "Fade in heading", "value": { "style": { "opacity": 0, "x": "0px", "y": "-30px" }, "triggers": [{ "type": "load", "stepsA": [{ "wait": 300 }, { "opacity": 1, "transition": "transform 1200ms ease-out-cubic 0ms, opacity 1200ms ease 0ms", "x": "0px", "y": "0px" }], "stepsB": [] }] } },
  { "slug": "fade-in-heading-2", "name": "Fade in heading 2", "value": { "style": { "opacity": 0, "x": "0px", "y": "-30px" }, "triggers": [{ "type": "load", "stepsA": [{ "wait": 600 }, { "opacity": 1, "transition": "transform 1200ms ease-out-cubic 0ms, opacity 1200ms ease 0ms", "x": "0px", "y": "0px" }], "stepsB": [] }] } },
  { "slug": "fade-in-heading-3", "name": "Fade in heading 3", "value": { "style": { "opacity": 0, "x": "0px", "y": "-30px" }, "triggers": [{ "type": "load", "stepsA": [{ "wait": 900 }, { "opacity": 1, "transition": "transform 1200ms ease-out-cubic 0ms, opacity 1200ms ease 0ms", "x": "0px", "y": "0px" }], "stepsB": [] }] } },
  { "slug": "fade-in-heading-4", "name": "Fade in heading 4", "value": { "style": { "opacity": 0, "x": "0px", "y": "-30px" }, "triggers": [{ "type": "load", "stepsA": [{ "wait": 1200 }, { "opacity": 1, "transition": "transform 1200ms ease-out-cubic 0ms, opacity 1200ms ease 0ms", "x": "0px", "y": "0px" }], "stepsB": [] }] } },
  { "slug": "nav-bar-load", "name": "Nav Bar Load", "value": { "style": { "opacity": 0, "x": "0px", "y": "-80px" }, "triggers": [{ "type": "load", "stepsA": [{ "wait": 1500 }, { "opacity": 1, "transition": "transform 1200ms ease-out-quart 0ms, opacity 1200ms ease 0ms", "x": "0px", "y": "0px" }], "stepsB": [] }] } },
  { "slug": "subtitle-load", "name": "Subtitle Load", "value": { "style": { "opacity": 0, "x": "0px", "y": "41px" }, "triggers": [{ "type": "load", "stepsA": [{ "wait": 1500 }, { "opacity": 1, "transition": "transform 1200ms ease-out-quart 0ms, opacity 1200ms ease 0ms", "x": "0px", "y": "0px" }], "stepsB": [] }] } },
  { "slug": "subtitle-load-2", "name": "Subtitle Load 2", "value": { "style": { "opacity": 0, "x": "0px", "y": "41px" }, "triggers": [{ "type": "load", "stepsA": [{ "wait": 1800 }, { "opacity": 1, "transition": "transform 1200ms ease-out-quart 0ms, opacity 1200ms ease 0ms", "x": "0px", "y": "0px" }], "stepsB": [] }] } },
  { "slug": "down-arrow", "name": "Down Arrow", "value": { "style": {}, "triggers": [{ "type": "load", "selector": ".down-inner", "descend": true, "stepsA": [{ "wait": 1500 }, { "opacity": 1, "transition": "transform 1200ms ease-out-quart 0ms, opacity 600ms ease-in-out-cubic 0ms", "x": "0px", "y": "0px" }], "stepsB": [] }, { "type": "hover", "selector": ".down-inner", "descend": true, "loopA": true, "stepsA": [{ "opacity": 1, "wait": 400, "transition": "transform 600ms ease-in-out-cubic 0ms", "x": "0px", "y": "50px" }, { "x": "0px", "y": "-50px" }, { "transition": "transform 600ms ease-out-cubic 0ms", "x": "0px", "y": "0px" }], "stepsB": [{ "wait": 400, "transition": "transform 600ms ease-in-out-cubic 0ms", "x": "0px", "y": "50px" }, { "x": "0px", "y": "-50px" }, { "transition": "transform 500ms ease 0ms", "x": "0px", "y": "0px" }] }] } },
  { "slug": "scale-on-scroll", "name": "Scale on Scroll", "value": { "style": { "opacity": 0, "scale": 0.79 }, "triggers": [{ "type": "scroll", "offsetBot": "17%", "stepsA": [{ "opacity": 1, "transition": "transform 500ms ease 0ms, opacity 500ms ease 0ms", "scale": 1.02 }, { "transition": "transform 500ms ease 0ms", "scale": 1 }], "stepsB": [] }] } },
  { "slug": "scale-on-scroll-delay-100", "name": "Scale on Scroll delay 100", "value": { "style": { "opacity": 0, "scale": 0.79 }, "triggers": [{ "type": "scroll", "offsetBot": "17%", "stepsA": [{ "wait": 100 }, { "opacity": 1, "transition": "transform 500ms ease 0ms, opacity 500ms ease 0ms", "scale": 1.02 }, { "transition": "transform 500ms ease 0ms", "scale": 1 }], "stepsB": [] }] } },
  { "slug": "scale-on-scroll-delay-200", "name": "Scale on Scroll delay 200", "value": { "style": { "opacity": 0, "scale": 0.79 }, "triggers": [{ "type": "scroll", "offsetBot": "17%", "stepsA": [{ "wait": 200 }, { "opacity": 1, "transition": "transform 500ms ease 0ms, opacity 500ms ease 0ms", "scale": 1.02 }, { "transition": "transform 500ms ease 0ms", "scale": 1 }], "stepsB": [] }] } },
  { "slug": "scale-on-scroll-delay-300", "name": "Scale on Scroll delay 300", "value": { "style": { "opacity": 0, "scale": 0.79 }, "triggers": [{ "type": "scroll", "offsetBot": "17%", "stepsA": [{ "wait": 300 }, { "opacity": 1, "transition": "transform 500ms ease 0ms, opacity 500ms ease 0ms", "scale": 1.02 }, { "transition": "transform 500ms ease 0ms", "scale": 1 }], "stepsB": [] }] } },
  { "slug": "scale-on-scroll-delay-4000", "name": "Scale on Scroll delay 4000", "value": { "style": { "opacity": 0, "scale": 0.79 }, "triggers": [{ "type": "scroll", "offsetBot": "17%", "stepsA": [{ "wait": 4000 }, { "opacity": 1, "transition": "transform 500ms ease 0ms, opacity 500ms ease 0ms", "scale": 1.02 }, { "transition": "transform 500ms ease 0ms", "scale": 1 }], "stepsB": [] }] } },
  { "slug": "hide-on-load", "name": "Hide on Load", "value": { "style": { "x": "0px", "y": "-59px" }, "triggers": [] } },
  { "slug": "show-scroll-nav-after-this", "name": "Show Scroll Nav after this", "value": { "style": {}, "triggers": [{ "type": "scroll", "selector": ".nav.scroll", "stepsA": [], "stepsB": [] }] } },
  { "slug": "new-interaction", "name": "New Interaction", "value": { "style": { "opacity": 0, "x": "-434px", "y": "0px", "rotate": "180deg" }, "triggers": [{ "type": "load", "stepsA": [{ "wait": 1500 }, { "opacity": 1, "transition": "transform 1000ms ease 0ms, opacity 1000ms ease 0ms", "x": "0px", "y": "0px" }], "stepsB": [] }] } },
  { "slug": "show-nav", "name": "Show nav", "value": { "style": {}, "triggers": [{ "type": "scroll", "selector": ".nav-scroll", "offsetTop": "52px", "offsetBot": "50%", "stepsA": [{ "opacity": 0, "transition": "transform 500ms ease 0ms, opacity 500ms ease 0ms", "x": "0px", "y": "-64px" }, { "display": "none" }], "stepsB": [{ "display": "block" }, { "opacity": 1, "transition": "transform 500ms ease 0ms, opacity 500ms ease 0ms", "x": "0px", "y": "0px" }] }] } },
  { "slug": "new-interaction-2", "name": "New Interaction 2", "value": { "style": {}, "triggers": [{ "type": "hover", "selector": ".feature-icon", "descend": true, "stepsA": [{ "opacity": 0, "scale": 0.5 }, { "opacity": 1, "transition": "transform 500ms ease 0ms, opacity 500ms ease 0ms", "scale": 1.49 }, { "transition": "transform 500ms ease 0ms", "scale": 1 }], "stepsB": [{ "opacity": 0, "transition": "opacity 500ms ease 0ms", "scale": 0.56 }] }] } },
  { "slug": "0-opacity-on-load", "name": "0 opacity on load", "value": { "style": { "opacity": 0 }, "triggers": [] } },
  { "slug": "display-none-on-load", "name": "Display none on load", "value": { "style": { "display": "none" }, "triggers": [] } },
  { "slug": "fade-from-top", "name": "Fade from top", "value": { "style": { "opacity": 0 }, "triggers": [{ "type": "scroll", "offsetTop": "5%", "offsetBot": "5%", "stepsA": [{ "x": "0", "y": "-50px" }, { "opacity": 1, "transition": "transform 750ms ease 0ms, opacity 750ms ease 0ms", "x": "0px", "y": "0px" }], "stepsB": [{ "opacity": 0, "transition": "transform 750ms ease 0ms, opacity 750ms ease 0ms", "x": "0px", "y": "0px" }, { "transition": "transform 750ms ease 0ms", "x": "0px", "y": "0px" }] }] } },
  { "slug": "fade-from-left", "name": "Fade from left", "value": { "style": { "opacity": 0 }, "triggers": [{ "type": "scroll", "offsetTop": "5%", "offsetBot": "5%", "stepsA": [{ "x": "-10px", "y": "0px" }, { "opacity": 1, "transition": "transform 750ms ease 0ms, opacity 750ms ease 0ms", "x": "0px", "y": "0px" }], "stepsB": [{ "opacity": 0, "transition": "transform 750ms ease 0ms, opacity 750ms ease 0ms", "x": "-10px", "y": "0px" }, { "transition": "transform 750ms ease 0ms", "x": "0px", "y": "0px" }] }] } },
  { "slug": "fade-from-right", "name": "Fade from right", "value": { "style": { "opacity": 0 }, "triggers": [{ "type": "scroll", "offsetTop": "5%", "offsetBot": "5%", "stepsA": [{ "x": "50px", "y": "0px" }, { "opacity": 1, "transition": "transform 750ms ease 0ms, opacity 750ms ease 0ms", "x": "0px", "y": "0px" }], "stepsB": [{ "opacity": 0, "transition": "transform 750ms ease 0ms, opacity 750ms ease 0ms", "x": "50px", "y": "0px" }, { "transition": "transform 750ms ease 0ms", "x": "0px", "y": "0px" }] }] } },
  { "slug": "example-1", "name": "Example 1", "value": { "style": { "opacity": 0 }, "triggers": [{ "type": "scroll", "offsetTop": "30%", "offsetBot": "30%", "stepsA": [{ "x": "0px", "y": "-70px" }, { "opacity": 1, "transition": "transform 500ms ease-in-quad 0ms, opacity 500ms ease 0ms", "x": "0px", "y": "0px" }, { "transition": "transform 350ms ease-out-quad 0ms", "x": "0px", "y": "-30px" }, { "transition": "transform 300ms ease-in-quad 0ms", "x": "0px", "y": "0px" }, { "transition": "transform 200ms ease-out-quad 0ms", "x": "0px", "y": "-14px" }, { "transition": "transform 175ms ease-in-quad 0ms", "x": "0px", "y": "0px" }, { "transition": "transform 135ms ease-in-quad 0ms", "x": "0px", "y": "-3px" }, { "transition": "transform 100ms ease-out-quad 0ms", "x": "0px", "y": "0px" }], "stepsB": [{ "opacity": 0, "transition": "opacity 200ms ease 0ms" }] }] } },
  { "slug": "example-1a", "name": "Example 1a", "value": { "style": { "opacity": 0 }, "triggers": [{ "type": "scroll", "offsetTop": "20%", "offsetBot": "20%", "stepsA": [{ "scale": 1.5 }, { "opacity": 1, "transition": "transform 500ms ease 0ms, opacity 500ms ease 0ms", "scale": 0.94 }, { "transition": "transform 500ms ease 0ms", "scale": 1.05 }, { "transition": "transform 500ms ease 0ms", "scale": 0.98 }, { "transition": "transform 500ms ease 0ms", "scale": 1 }], "stepsB": [{ "opacity": 0, "transition": "opacity 200ms ease 0ms" }] }] } },
  { "slug": "example-1b", "name": "Example 1b", "value": { "style": { "opacity": 0 }, "triggers": [{ "type": "scroll", "offsetTop": "30%", "offsetBot": "30%", "stepsA": [{ "x": "-80px", "y": "0px" }, { "title": "Move to Origin, Opacity 100%", "opacity": 1, "transition": "transform 750ms ease-out-cubic 0ms, opacity 750ms ease 0ms", "x": "0px", "y": "0px" }], "stepsB": [{ "title": "Move Right 80px, Opacity 0%", "opacity": 0, "transition": "transform 750ms ease-in-cubic 0ms, opacity 750ms ease 0ms", "x": "80px", "y": "0px" }] }] } },
  { "slug": "example-2-footer-flyout", "name": "Example 2 - footer flyout", "value": { "style": {}, "triggers": [{ "type": "scroll", "selector": ".footer-flyout", "offsetTop": "60%", "offsetBot": "60%", "stepsA": [{ "display": "block" }, { "transition": "transform 700ms ease-out-cubic 0ms", "x": "0px", "y": "0px" }], "stepsB": [{ "transition": "transform 300ms ease-in-cubic 0ms", "x": "0px", "y": "120px" }, { "display": "none" }] }] } },
  { "slug": "example-2-initial-appearance", "name": "Example 2 - initial appearance", "value": { "style": { "display": "none", "x": "0px", "y": "120px" }, "triggers": [] } },
  { "slug": "example-click-to-show", "name": "Example - Click to Show", "value": { "style": {}, "triggers": [{ "type": "click", "selector": ".hidden-text", "stepsA": [{ "title": "Height 0px, Display Block", "display": "block", "height": "0px" }, { "title": "Height Auto for 500ms", "height": "auto", "transition": "height 500ms ease 0ms" }], "stepsB": [{ "height": "1px", "transition": "height 500ms ease 0ms" }, { "display": "none" }] }] } },
  { "slug": "example-show-sidebar", "name": "Example - Show Sidebar", "value": { "style": {}, "triggers": [{ "type": "click", "selector": ".sidebar", "stepsA": [{ "display": "block" }, { "transition": "transform 500ms ease-out-cubic 0ms", "x": "0px", "y": "0px" }], "stepsB": [] }] } },
  { "slug": "sidebar-initial-appearance", "name": "Sidebar initial appearance", "value": { "style": { "display": "none", "x": "305px", "y": "0px" }, "triggers": [] } },
  { "slug": "hide-sidebar", "name": "Hide Sidebar", "value": { "style": {}, "triggers": [{ "type": "click", "selector": ".sidebar", "stepsA": [{ "transition": "transform 500ms ease-in-cubic 0ms", "x": "305px", "y": "0px" }, { "display": "none" }], "stepsB": [] }] } },
  { "slug": "made-in-webflow", "name": "Made in Webflow", "value": { "style": { "opacity": 0, "scale": 1.19, "rotate": "-15deg" }, "triggers": [{ "type": "load", "stepsA": [{ "wait": 1800 }, { "opacity": 1, "transition": "transform 1200ms ease-out-cubic 0ms, opacity 1200ms ease 0ms", "scale": 1, "rotate": "-12deg" }], "stepsB": [] }] } },
  { "slug": "example-hover-album", "name": "Example - hover album", "value": { "style": {}, "triggers": [{ "type": "hover", "selector": ".album-info", "stepsA": [{ "title": "Move Down 105px Instantly", "x": "0px", "y": "105px" }, { "title": "Move to Origin, Opacity 100%", "opacity": 1, "transition": "transform 700ms ease-out-cubic 0ms, opacity 700ms ease 0ms", "x": "0px", "y": "0px" }], "stepsB": [{ "title": "Move Down 105px, Opacity 0%", "opacity": 0, "transition": "transform 300ms ease-in-cubic 0ms, opacity 300ms ease-in-cubic 0ms", "x": "0px", "y": "105px" }, { "title": "Move to Origin Instantly", "x": "0px", "y": "0px" }] }, { "type": "hover", "selector": ".album-gradient", "stepsA": [{ "title": "Opacity 100% for 700ms", "opacity": 1, "transition": "opacity 700ms ease 0ms" }], "stepsB": [{ "title": "Opacity 0% for 300ms", "opacity": 0, "transition": "opacity 300ms ease-in-cubic 0ms" }] }, { "type": "hover", "selector": ".social-btn", "stepsA": [{ "scale": 0.5 }, { "rotate": "15deg" }, { "opacity": 1, "transition": "transform 700ms ease-out-cubic 0ms, opacity 700ms ease-out-cubic 0ms", "scale": 1, "rotate": "0deg" }], "stepsB": [{ "opacity": 0, "transition": "transform 300ms ease-in-cubic 0ms, opacity 300ms ease-in-cubic 0ms", "scale": 0.5, "rotate": "-15deg" }, { "scale": 1, "rotate": "0deg" }] }] } },
  { "slug": "album-icons", "name": "album icons", "value": { "style": { "opacity": 0 }, "triggers": [{ "type": "hover", "stepsA": [{ "transition": "transform 200ms ease-out-cubic 0ms, opacity 300ms ease-out-cubic 0ms", "scale": 0.75 }], "stepsB": [{ "transition": "transform 200ms ease-in-cubic 0ms", "scale": 1 }] }] } },
  { "slug": "test-selector-rename", "name": "test selector rename", "value": { "style": {}, "triggers": [{ "type": "scroll", "offsetBot": "20%", "stepsA": [{ "display": "block", "opacity": 0.29, "transition": "transform 700ms ease 0ms, opacity 700ms ease 0ms", "scale": 1.29, "rotate": "90deg" }], "stepsB": [{ "display": "inline", "opacity": 1, "transition": "transform 700ms ease 0ms, opacity 700ms ease 0ms", "scale": 1, "rotate": "0deg", "x": "0px", "y": "0px" }] }] } },
  { "slug": "circle-play-animation", "name": "Circle Play Animation", "value": { "style": {}, "triggers": [] } },
  { "slug": "album-info-initial-appearance", "name": "Album Info Initial Appearance", "value": { "style": { "opacity": 0, "x": "0px", "y": "105px" }, "triggers": [] } },
  { "slug": "fake", "name": "fake", "value": { "style": {}, "triggers": [{ "type": "hover", "stepsA": [{ "transition": "transform 500ms ease-in-cubic 0ms", "x": "0px", "y": "0px" }, { "transition": "transform 500ms ease-in-cubic 0ms", "scale": 1.12 }, { "width": "33px", "transition": "width 500ms ease-in-cubic 0ms" }, { "opacity": 0.39, "transition": "opacity 500ms ease-in-cubic 0ms" }, { "display": "block" }, { "display": "none" }, { "wait": 300 }, { "display": "inline-block" }, { "height": "17px", "transition": "height 500ms ease 0ms" }, { "transition": "transform 500ms ease 0ms", "scale": 1 }, { "transition": "transform 500ms ease 0ms", "rotate": "0deg" }], "stepsB": [] }] } },
  { "slug": "scroll-text-fade-away", "name": "Scroll Text Fade Away", "value": { "style": {}, "triggers": [{ "type": "scroll", "selector": ".scroll-1", "offsetTop": "70%", "stepsA": [], "stepsB": [{ "opacity": 0, "transition": "opacity 500ms ease 0ms" }] }] } },
  { "slug": "heading-text-load", "name": "Heading Text Load", "value": { "style": { "opacity": 0, "x": "0px", "y": "41px" }, "triggers": [{ "type": "load", "stepsA": [{ "wait": 1500 }, { "opacity": 0.75, "transition": "transform 1200ms ease-out-quart 0ms, opacity 500ms ease 0ms", "x": "0px", "y": "0px" }], "stepsB": [] }] } },
  { "slug": "play-buttons", "name": "Play Buttons", "value": { "style": { "width": "55px" }, "triggers": [] } },
  { "slug": "down-arrow-on-load", "name": "Down arrow on load", "value": { "style": { "opacity": 0, "x": "0px", "y": "30px" }, "triggers": [] } },
  { "slug": "awwwwwards", "name": "awwwwwards", "value": { "style": { "opacity": 0.39, "x": "73px", "y": "0px" }, "triggers": [{ "type": "load", "stepsA": [{ "wait": 1500 }, { "opacity": 1, "transition": "transform 1200ms ease-out-quart 0ms, opacity 1200ms ease 0ms", "x": "0px", "y": "0px" }], "stepsB": [] }] } }
]);
// ---
// generated by coffee-script 1.9.2