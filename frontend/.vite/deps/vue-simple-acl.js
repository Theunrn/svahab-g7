import "./chunk-CEQRFMJQ.js";

// node_modules/vue-simple-acl/dist/vue-simple-acl.esm-browser.js
function e(e2, t) {
  const n = /* @__PURE__ */ Object.create(null), o = e2.split(",");
  for (let e3 = 0; e3 < o.length; e3++)
    n[o[e3]] = true;
  return t ? (e3) => !!n[e3.toLowerCase()] : (e3) => !!n[e3];
}
var i = true ? Object.freeze({}) : {};
Object.freeze([]);
var c = () => {
};
var u = Object.assign;
var p = Object.prototype.hasOwnProperty;
var f = (e2, t) => p.call(e2, t);
var d = Array.isArray;
var h = (e2) => "[object Map]" === b(e2);
var g = (e2) => "function" == typeof e2;
var y = (e2) => "string" == typeof e2;
var v = (e2) => "symbol" == typeof e2;
var m = (e2) => null !== e2 && "object" == typeof e2;
var _ = Object.prototype.toString;
var b = (e2) => _.call(e2);
var N = (e2) => b(e2).slice(8, -1);
var E = (e2) => y(e2) && "NaN" !== e2 && "-" !== e2[0] && "" + parseInt(e2, 10) === e2;
var w = /* @__PURE__ */ ((e2) => {
  const t = /* @__PURE__ */ Object.create(null);
  return (n) => t[n] || (t[n] = e2(n));
})((e2) => e2.charAt(0).toUpperCase() + e2.slice(1));
var O = (e2, t) => !Object.is(e2, t);
var $;
function V(e2, ...t) {
  console.warn(`[Vue warn] ${e2}`, ...t);
}
var R = (e2) => {
  const t = new Set(e2);
  return t.w = 0, t.n = 0, t;
};
var P = (e2) => (e2.w & C) > 0;
var k = (e2) => (e2.n & C) > 0;
var D = /* @__PURE__ */ new WeakMap();
var S = 0;
var C = 1;
var x;
var A = Symbol(true ? "iterate" : "");
var j = Symbol(true ? "Map key iterate" : "");
var U = class {
  constructor(e2, t = null, n) {
    this.fn = e2, this.scheduler = t, this.active = true, this.deps = [], this.parent = void 0, function(e3, t2) {
      t2 && t2.active && t2.effects.push(e3);
    }(this, n);
  }
  run() {
    if (!this.active)
      return this.fn();
    let e2 = x, t = M;
    for (; e2; ) {
      if (e2 === this)
        return;
      e2 = e2.parent;
    }
    try {
      return this.parent = x, x = this, M = true, C = 1 << ++S, S <= 30 ? (({ deps: e3 }) => {
        if (e3.length)
          for (let t2 = 0; t2 < e3.length; t2++)
            e3[t2].w |= C;
      })(this) : T(this), this.fn();
    } finally {
      S <= 30 && ((e3) => {
        const { deps: t2 } = e3;
        if (t2.length) {
          let n = 0;
          for (let o = 0; o < t2.length; o++) {
            const r = t2[o];
            P(r) && !k(r) ? r.delete(e3) : t2[n++] = r, r.w &= ~C, r.n &= ~C;
          }
          t2.length = n;
        }
      })(this), C = 1 << --S, x = this.parent, M = t, this.parent = void 0, this.deferStop && this.stop();
    }
  }
  stop() {
    x === this ? this.deferStop = true : this.active && (T(this), this.onStop && this.onStop(), this.active = false);
  }
};
function T(e2) {
  const { deps: t } = e2;
  if (t.length) {
    for (let n = 0; n < t.length; n++)
      t[n].delete(e2);
    t.length = 0;
  }
}
var M = true;
var I = [];
function F() {
  I.push(M), M = false;
}
function z() {
  const e2 = I.pop();
  M = void 0 === e2 || e2;
}
function L(e2, t, n) {
  if (M && x) {
    let o = D.get(e2);
    o || D.set(e2, o = /* @__PURE__ */ new Map());
    let r = o.get(n);
    r || o.set(n, r = R());
    W(r, true ? { effect: x, target: e2, type: t, key: n } : void 0);
  }
}
function W(e2, t) {
  let n = false;
  S <= 30 ? k(e2) || (e2.n |= C, n = !P(e2)) : n = !e2.has(x), n && (e2.add(x), x.deps.push(e2), x.onTrack && x.onTrack(Object.assign({ effect: x }, t)));
}
function H(e2, t, n, o, r, s) {
  const i2 = D.get(e2);
  if (!i2)
    return;
  let c2 = [];
  if ("clear" === t)
    c2 = [...i2.values()];
  else if ("length" === n && d(e2))
    i2.forEach((e3, t2) => {
      ("length" === t2 || t2 >= o) && c2.push(e3);
    });
  else
    switch (void 0 !== n && c2.push(i2.get(n)), t) {
      case "add":
        d(e2) ? E(n) && c2.push(i2.get("length")) : (c2.push(i2.get(A)), h(e2) && c2.push(i2.get(j)));
        break;
      case "delete":
        d(e2) || (c2.push(i2.get(A)), h(e2) && c2.push(i2.get(j)));
        break;
      case "set":
        h(e2) && c2.push(i2.get(A));
    }
  const a = true ? { target: e2, type: t, key: n, newValue: o, oldValue: r, oldTarget: s } : void 0;
  if (1 === c2.length)
    c2[0] && (true ? q(c2[0], a) : q(c2[0]));
  else {
    const e3 = [];
    for (const t2 of c2)
      t2 && e3.push(...t2);
    true ? q(R(e3), a) : q(R(e3));
  }
}
function q(e2, t) {
  const n = d(e2) ? e2 : [...e2];
  for (const e3 of n)
    e3.computed && K(e3, t);
  for (const e3 of n)
    e3.computed || K(e3, t);
}
function K(e2, t) {
  (e2 !== x || e2.allowRecurse) && (e2.onTrigger && e2.onTrigger(u({ effect: e2 }, t)), e2.scheduler ? e2.scheduler() : e2.run());
}
var B = e("__proto__,__v_isRef,__isVue");
var J = new Set(Object.getOwnPropertyNames(Symbol).filter((e2) => "arguments" !== e2 && "caller" !== e2).map((e2) => Symbol[e2]).filter(v));
var G = ee();
var Q = ee(true);
var X = ee(true, true);
var Y = Z();
function Z() {
  const e2 = {};
  return ["includes", "indexOf", "lastIndexOf"].forEach((t) => {
    e2[t] = function(...e3) {
      const n = Ie(this);
      for (let e4 = 0, t2 = this.length; e4 < t2; e4++)
        L(n, "get", e4 + "");
      const o = n[t](...e3);
      return -1 === o || false === o ? n[t](...e3.map(Ie)) : o;
    };
  }), ["push", "pop", "shift", "unshift", "splice"].forEach((t) => {
    e2[t] = function(...e3) {
      F();
      const n = Ie(this)[t].apply(this, e3);
      return z(), n;
    };
  }), e2;
}
function ee(e2 = false, t = false) {
  return function(n, o, r) {
    if ("__v_isReactive" === o)
      return !e2;
    if ("__v_isReadonly" === o)
      return e2;
    if ("__v_isShallow" === o)
      return t;
    if ("__v_raw" === o && r === (e2 ? t ? De : ke : t ? Pe : Re).get(n))
      return n;
    const s = d(n);
    if (!e2 && s && f(Y, o))
      return Reflect.get(Y, o, r);
    const i2 = Reflect.get(n, o, r);
    return (v(o) ? J.has(o) : B(o)) ? i2 : (e2 || L(n, "get", o), t ? i2 : We(i2) ? s && E(o) ? i2 : i2.value : m(i2) ? e2 ? Ce(i2) : Se(i2) : i2);
  };
}
function te(e2 = false) {
  return function(t, n, o, r) {
    let s = t[n];
    if (Ue(s) && We(s) && !We(o))
      return false;
    if (!e2 && !Ue(o) && (Te(o) || (o = Ie(o), s = Ie(s)), !d(t) && We(s) && !We(o)))
      return s.value = o, true;
    const i2 = d(t) && E(n) ? Number(n) < t.length : f(t, n), c2 = Reflect.set(t, n, o, r);
    return t === Ie(r) && (i2 ? O(o, s) && H(t, "set", n, o, s) : H(t, "add", n, o)), c2;
  };
}
var ne = { get: G, set: te(), deleteProperty: function(e2, t) {
  const n = f(e2, t), o = e2[t], r = Reflect.deleteProperty(e2, t);
  return r && n && H(e2, "delete", t, void 0, o), r;
}, has: function(e2, t) {
  const n = Reflect.has(e2, t);
  return v(t) && J.has(t) || L(e2, "has", t), n;
}, ownKeys: function(e2) {
  return L(e2, "iterate", d(e2) ? "length" : A), Reflect.ownKeys(e2);
} };
var oe = { get: Q, set: (e2, t) => (V(`Set operation on key "${String(t)}" failed: target is readonly.`, e2), true), deleteProperty: (e2, t) => (V(`Delete operation on key "${String(t)}" failed: target is readonly.`, e2), true) };
var re = u({}, oe, { get: X });
var se = (e2) => e2;
var ie = (e2) => Reflect.getPrototypeOf(e2);
function ce(e2, t, n = false, o = false) {
  const r = Ie(e2 = e2.__v_raw), s = Ie(t);
  n || (t !== s && L(r, "get", t), L(r, "get", s));
  const { has: i2 } = ie(r), c2 = o ? se : n ? Le : ze;
  return i2.call(r, t) ? c2(e2.get(t)) : i2.call(r, s) ? c2(e2.get(s)) : void (e2 !== r && e2.get(t));
}
function ae(e2, t = false) {
  const n = this.__v_raw, o = Ie(n), r = Ie(e2);
  return t || (e2 !== r && L(o, "has", e2), L(o, "has", r)), e2 === r ? n.has(e2) : n.has(e2) || n.has(r);
}
function le(e2, t = false) {
  return e2 = e2.__v_raw, !t && L(Ie(e2), "iterate", A), Reflect.get(e2, "size", e2);
}
function ue(e2) {
  e2 = Ie(e2);
  const t = Ie(this);
  return ie(t).has.call(t, e2) || (t.add(e2), H(t, "add", e2, e2)), this;
}
function pe(e2, t) {
  t = Ie(t);
  const n = Ie(this), { has: o, get: r } = ie(n);
  let s = o.call(n, e2);
  s ? Ve(n, o, e2) : (e2 = Ie(e2), s = o.call(n, e2));
  const i2 = r.call(n, e2);
  return n.set(e2, t), s ? O(t, i2) && H(n, "set", e2, t, i2) : H(n, "add", e2, t), this;
}
function fe(e2) {
  const t = Ie(this), { has: n, get: o } = ie(t);
  let r = n.call(t, e2);
  r ? Ve(t, n, e2) : (e2 = Ie(e2), r = n.call(t, e2));
  const s = o ? o.call(t, e2) : void 0, i2 = t.delete(e2);
  return r && H(t, "delete", e2, void 0, s), i2;
}
function de() {
  const e2 = Ie(this), t = 0 !== e2.size, n = true ? h(e2) ? new Map(e2) : new Set(e2) : void 0, o = e2.clear();
  return t && H(e2, "clear", void 0, void 0, n), o;
}
function he(e2, t) {
  return function(n, o) {
    const r = this, s = r.__v_raw, i2 = Ie(s), c2 = t ? se : e2 ? Le : ze;
    return !e2 && L(i2, "iterate", A), s.forEach((e3, t2) => n.call(o, c2(e3), c2(t2), r));
  };
}
function ge(e2, t, n) {
  return function(...o) {
    const r = this.__v_raw, s = Ie(r), i2 = h(s), c2 = "entries" === e2 || e2 === Symbol.iterator && i2, a = "keys" === e2 && i2, l = r[e2](...o), u2 = n ? se : t ? Le : ze;
    return !t && L(s, "iterate", a ? j : A), { next() {
      const { value: e3, done: t2 } = l.next();
      return t2 ? { value: e3, done: t2 } : { value: c2 ? [u2(e3[0]), u2(e3[1])] : u2(e3), done: t2 };
    }, [Symbol.iterator]() {
      return this;
    } };
  };
}
function ye(e2) {
  return function(...t) {
    if (true) {
      const n = t[0] ? `on key "${t[0]}" ` : "";
      console.warn(`${w(e2)} operation ${n}failed: target is readonly.`, Ie(this));
    }
    return "delete" !== e2 && this;
  };
}
function ve() {
  const e2 = { get(e3) {
    return ce(this, e3);
  }, get size() {
    return le(this);
  }, has: ae, add: ue, set: pe, delete: fe, clear: de, forEach: he(false, false) }, t = { get(e3) {
    return ce(this, e3, false, true);
  }, get size() {
    return le(this);
  }, has: ae, add: ue, set: pe, delete: fe, clear: de, forEach: he(false, true) }, n = { get(e3) {
    return ce(this, e3, true);
  }, get size() {
    return le(this, true);
  }, has(e3) {
    return ae.call(this, e3, true);
  }, add: ye("add"), set: ye("set"), delete: ye("delete"), clear: ye("clear"), forEach: he(true, false) }, o = { get(e3) {
    return ce(this, e3, true, true);
  }, get size() {
    return le(this, true);
  }, has(e3) {
    return ae.call(this, e3, true);
  }, add: ye("add"), set: ye("set"), delete: ye("delete"), clear: ye("clear"), forEach: he(true, true) };
  return ["keys", "values", "entries", Symbol.iterator].forEach((r) => {
    e2[r] = ge(r, false, false), n[r] = ge(r, true, false), t[r] = ge(r, false, true), o[r] = ge(r, true, true);
  }), [e2, n, t, o];
}
var [me, _e, be, Ne] = ve();
function Ee(e2, t) {
  const n = t ? e2 ? Ne : be : e2 ? _e : me;
  return (t2, o, r) => "__v_isReactive" === o ? !e2 : "__v_isReadonly" === o ? e2 : "__v_raw" === o ? t2 : Reflect.get(f(n, o) && o in t2 ? n : t2, o, r);
}
var we = { get: Ee(false, false) };
var Oe = { get: Ee(true, false) };
var $e = { get: Ee(true, true) };
function Ve(e2, t, n) {
  const o = Ie(n);
  if (o !== n && t.call(e2, o)) {
    const t2 = N(e2);
    console.warn(`Reactive ${t2} contains both the raw and reactive versions of the same object${"Map" === t2 ? " as keys" : ""}, which can lead to inconsistencies. Avoid differentiating between the raw and reactive versions of an object and only use the reactive version if possible.`);
  }
}
var Re = /* @__PURE__ */ new WeakMap();
var Pe = /* @__PURE__ */ new WeakMap();
var ke = /* @__PURE__ */ new WeakMap();
var De = /* @__PURE__ */ new WeakMap();
function Se(e2) {
  return Ue(e2) ? e2 : Ae(e2, false, ne, we, Re);
}
function Ce(e2) {
  return Ae(e2, true, oe, Oe, ke);
}
function xe(e2) {
  return Ae(e2, true, re, $e, De);
}
function Ae(e2, t, n, o, r) {
  if (!m(e2))
    return console.warn(`value cannot be made reactive: ${String(e2)}`), e2;
  if (e2.__v_raw && (!t || !e2.__v_isReactive))
    return e2;
  const s = r.get(e2);
  if (s)
    return s;
  const i2 = (c2 = e2).__v_skip || !Object.isExtensible(c2) ? 0 : function(e3) {
    switch (e3) {
      case "Object":
      case "Array":
        return 1;
      case "Map":
      case "Set":
      case "WeakMap":
      case "WeakSet":
        return 2;
      default:
        return 0;
    }
  }(N(c2));
  var c2;
  if (0 === i2)
    return e2;
  const a = new Proxy(e2, 2 === i2 ? o : n);
  return r.set(e2, a), a;
}
function je(e2) {
  return Ue(e2) ? je(e2.__v_raw) : !(!e2 || !e2.__v_isReactive);
}
function Ue(e2) {
  return !(!e2 || !e2.__v_isReadonly);
}
function Te(e2) {
  return !(!e2 || !e2.__v_isShallow);
}
function Ie(e2) {
  const t = e2 && e2.__v_raw;
  return t ? Ie(t) : e2;
}
function Fe(e2) {
  return ((e3, t, n) => {
    Object.defineProperty(e3, t, { configurable: true, enumerable: false, value: n });
  })(e2, "__v_skip", true), e2;
}
var ze = (e2) => m(e2) ? Se(e2) : e2;
var Le = (e2) => m(e2) ? Ce(e2) : e2;
function We(e2) {
  return !(!e2 || true !== e2.__v_isRef);
}
var He = { get: (e2, t, n) => {
  return We(o = Reflect.get(e2, t, n)) ? o.value : o;
  var o;
}, set: (e2, t, n, o) => {
  const r = e2[t];
  return We(r) && !We(n) ? (r.value = n, true) : Reflect.set(e2, t, n, o);
} };
var qe = class {
  constructor(e2, t, n, o) {
    this._setter = t, this.dep = void 0, this.__v_isRef = true, this._dirty = true, this.effect = new U(e2, () => {
      var e3, t2;
      this._dirty || (this._dirty = true, (e3 = Ie(e3 = this)).dep && (true ? q(e3.dep, { target: e3, type: "set", key: "value", newValue: t2 }) : q(e3.dep)));
    }), this.effect.computed = this, this.effect.active = this._cacheable = !o, this.__v_isReadonly = n;
  }
  get value() {
    const e2 = Ie(this);
    var t;
    return t = e2, M && x && (t = Ie(t), true ? W(t.dep || (t.dep = R()), { target: t, type: "get", key: "value" }) : W(t.dep || (t.dep = R()))), !e2._dirty && e2._cacheable || (e2._dirty = false, e2._value = e2.effect.run()), e2._value;
  }
  set value(e2) {
    this._setter(e2);
  }
};
var Ke = [];
function Be(e2, ...t) {
  F();
  const n = Ke.length ? Ke[Ke.length - 1].component : null, o = n && n.appContext.config.warnHandler, r = function() {
    let e3 = Ke[Ke.length - 1];
    if (!e3)
      return [];
    const t2 = [];
    for (; e3; ) {
      const n2 = t2[0];
      n2 && n2.vnode === e3 ? n2.recurseCount++ : t2.push({ vnode: e3, recurseCount: 0 });
      const o2 = e3.component && e3.component.parent;
      e3 = o2 && o2.vnode;
    }
    return t2;
  }();
  if (o)
    Xe(o, n, 11, [e2 + t.join(""), n && n.proxy, r.map(({ vnode: e3 }) => `at <${sn(n, e3.type)}>`).join("\n"), r]);
  else {
    const n2 = [`[Vue warn]: ${e2}`, ...t];
    r.length && n2.push("\n", ...function(e3) {
      const t2 = [];
      return e3.forEach((e4, n3) => {
        t2.push(...0 === n3 ? [] : ["\n"], ...function({ vnode: e5, recurseCount: t3 }) {
          const n4 = t3 > 0 ? `... (${t3} recursive calls)` : "", o2 = !!e5.component && null == e5.component.parent, r2 = ` at <${sn(e5.component, e5.type, o2)}`, s = ">" + n4;
          return e5.props ? [r2, ...Je(e5.props), s] : [r2 + s];
        }(e4));
      }), t2;
    }(r)), console.warn(...n2);
  }
  z();
}
function Je(e2) {
  const t = [], n = Object.keys(e2);
  return n.slice(0, 3).forEach((n2) => {
    t.push(...Ge(n2, e2[n2]));
  }), n.length > 3 && t.push(" ..."), t;
}
function Ge(e2, t, n) {
  return y(t) ? (t = JSON.stringify(t), n ? t : [`${e2}=${t}`]) : "number" == typeof t || "boolean" == typeof t || null == t ? n ? t : [`${e2}=${t}`] : We(t) ? (t = Ge(e2, Ie(t.value), true), n ? t : [`${e2}=Ref<`, t, ">"]) : g(t) ? [`${e2}=fn${t.name ? `<${t.name}>` : ""}`] : (t = Ie(t), n ? t : [`${e2}=`, t]);
}
var Qe = { sp: "serverPrefetch hook", bc: "beforeCreate hook", c: "created hook", bm: "beforeMount hook", m: "mounted hook", bu: "beforeUpdate hook", u: "updated", bum: "beforeUnmount hook", um: "unmounted hook", a: "activated hook", da: "deactivated hook", ec: "errorCaptured hook", rtc: "renderTracked hook", rtg: "renderTriggered hook", 0: "setup function", 1: "render function", 2: "watcher getter", 3: "watcher callback", 4: "watcher cleanup function", 5: "native event handler", 6: "component event handler", 7: "vnode hook", 8: "directive hook", 9: "transition hook", 10: "app errorHandler", 11: "app warnHandler", 12: "ref function", 13: "async component loader", 14: "scheduler flush. This is likely a Vue internals bug. Please open an issue at https://new-issue.vuejs.org/?repo=vuejs/core" };
function Xe(e2, t, n, o) {
  let r;
  try {
    r = o ? e2(...o) : e2();
  } catch (e3) {
    Ze(e3, t, n);
  }
  return r;
}
function Ye(e2, t, n, o) {
  if (g(e2)) {
    const s2 = Xe(e2, t, n, o);
    return s2 && (m(r = s2) && g(r.then) && g(r.catch)) && s2.catch((e3) => {
      Ze(e3, t, n);
    }), s2;
  }
  var r;
  const s = [];
  for (let r2 = 0; r2 < e2.length; r2++)
    s.push(Ye(e2[r2], t, n, o));
  return s;
}
function Ze(e2, t, n, o = true) {
  const r = t ? t.vnode : null;
  if (t) {
    let o2 = t.parent;
    const r2 = t.proxy, s = true ? Qe[n] : n;
    for (; o2; ) {
      const t2 = o2.ec;
      if (t2) {
        for (let n2 = 0; n2 < t2.length; n2++)
          if (false === t2[n2](e2, r2, s))
            return;
      }
      o2 = o2.parent;
    }
    const i2 = t.appContext.config.errorHandler;
    if (i2)
      return void Xe(i2, null, 10, [e2, r2, s]);
  }
  !function(e3, t2, n2, o2 = true) {
    if (true) {
      const s = Qe[t2];
      if (n2 && (r2 = n2, Ke.push(r2)), Be("Unhandled error" + (s ? ` during execution of ${s}` : "")), n2 && Ke.pop(), o2)
        throw e3;
      console.error(e3);
    } else
      console.error(e3);
    var r2;
  }(e2, n, r, o);
}
var et = false;
var tt = false;
var nt = [];
var ot = 0;
var rt = [];
var st = null;
var it = 0;
var ct = [];
var at = null;
var lt = 0;
var ut = Promise.resolve();
var pt = null;
var ft = null;
function dt(e2) {
  const t = pt || ut;
  return e2 ? t.then(this ? e2.bind(this) : e2) : t;
}
function ht(e2) {
  nt.length && nt.includes(e2, et && e2.allowRecurse ? ot + 1 : ot) || e2 === ft || (null == e2.id ? nt.push(e2) : nt.splice(function(e3) {
    let t = ot + 1, n = nt.length;
    for (; t < n; ) {
      const o = t + n >>> 1;
      _t(nt[o]) < e3 ? t = o + 1 : n = o;
    }
    return t;
  }(e2.id), 0, e2), gt());
}
function gt() {
  et || tt || (tt = true, pt = ut.then(bt));
}
function yt(e2, t, n, o) {
  d(e2) ? n.push(...e2) : t && t.includes(e2, e2.allowRecurse ? o + 1 : o) || n.push(e2), gt();
}
function vt(e2) {
  yt(e2, at, ct, lt);
}
function mt(e2, t = null) {
  if (rt.length) {
    for (ft = t, st = [...new Set(rt)], rt.length = 0, e2 = e2 || /* @__PURE__ */ new Map(), it = 0; it < st.length; it++)
      Nt(e2, st[it]) || st[it]();
    st = null, it = 0, ft = null, mt(e2, t);
  }
}
var _t = (e2) => null == e2.id ? 1 / 0 : e2.id;
function bt(e2) {
  tt = false, et = true, e2 = e2 || /* @__PURE__ */ new Map(), mt(e2), nt.sort((e3, t2) => _t(e3) - _t(t2));
  const t = true ? (t2) => Nt(e2, t2) : c;
  try {
    for (ot = 0; ot < nt.length; ot++) {
      const e3 = nt[ot];
      if (e3 && false !== e3.active) {
        if (t(e3))
          continue;
        Xe(e3, null, 14);
      }
    }
  } finally {
    ot = 0, nt.length = 0, function(e3) {
      if (mt(), ct.length) {
        const t2 = [...new Set(ct)];
        if (ct.length = 0, at)
          return void at.push(...t2);
        for (at = t2, e3 = e3 || /* @__PURE__ */ new Map(), at.sort((e4, t3) => _t(e4) - _t(t3)), lt = 0; lt < at.length; lt++)
          Nt(e3, at[lt]) || at[lt]();
        at = null, lt = 0;
      }
    }(e2), et = false, pt = null, (nt.length || rt.length || ct.length) && bt(e2);
  }
}
function Nt(e2, t) {
  if (e2.has(t)) {
    const n = e2.get(t);
    if (n > 100) {
      const e3 = t.ownerInstance, n2 = e3 && rn(e3.type);
      return Be(`Maximum recursive updates exceeded${n2 ? ` in component <${n2}>` : ""}. This means you have a reactive effect that is mutating its own dependencies and thus recursively triggering itself. Possible sources include component template, render function, updated hook or watcher source function.`), true;
    }
    e2.set(t, n + 1);
  } else
    e2.set(t, 1);
}
var Et = /* @__PURE__ */ new Set();
($ || ($ = "undefined" != typeof globalThis ? globalThis : "undefined" != typeof self ? self : "undefined" != typeof window ? window : "undefined" != typeof global ? global : {})).__VUE_HMR_RUNTIME__ = { createRecord: Vt(function(e2, t) {
  if (wt.has(e2))
    return false;
  return wt.set(e2, { initialDef: Ot(t), instances: /* @__PURE__ */ new Set() }), true;
}), rerender: Vt(function(e2, t) {
  const n = wt.get(e2);
  if (!n)
    return;
  n.initialDef.render = t, [...n.instances].forEach((e3) => {
    t && (e3.render = t, Ot(e3.type).render = t), e3.renderCache = [], e3.update();
  });
}), reload: Vt(function(e2, t) {
  const n = wt.get(e2);
  if (!n)
    return;
  t = Ot(t), $t(n.initialDef, t);
  const o = [...n.instances];
  for (const e3 of o) {
    const o2 = Ot(e3.type);
    Et.has(o2) || (o2 !== n.initialDef && $t(o2, t), Et.add(o2)), e3.appContext.optionsCache.delete(e3.type), e3.ceReload ? (Et.add(o2), e3.ceReload(t.styles), Et.delete(o2)) : e3.parent ? (ht(e3.parent.update), e3.parent.type.__asyncLoader && e3.parent.ceReload && e3.parent.ceReload(t.styles)) : e3.appContext.reload ? e3.appContext.reload() : "undefined" != typeof window ? window.location.reload() : console.warn("[HMR] Root or manually mounted instance modified. Full reload required.");
  }
  vt(() => {
    for (const e3 of o)
      Et.delete(Ot(e3.type));
  });
}) };
var wt = /* @__PURE__ */ new Map();
function Ot(e2) {
  return cn(e2) ? e2.__vccOpts : e2;
}
function $t(e2, t) {
  u(e2, t);
  for (const n in e2)
    "__file" === n || n in t || delete e2[n];
}
function Vt(e2) {
  return (t, n) => {
    try {
      return e2(t, n);
    } catch (e3) {
      console.error(e3), console.warn("[HMR] Something went wrong during Vue component hot-reload. Full reload required.");
    }
  };
}
var Rt = {};
function Pt(e2, t, { immediate: n, deep: o, flush: r, onTrack: s, onTrigger: a } = i) {
  t || (void 0 !== n && Be('watch() "immediate" option is only respected when using the watch(source, callback, options?) signature.'), void 0 !== o && Be('watch() "deep" option is only respected when using the watch(source, callback, options?) signature.'));
  const l = (e3) => {
    Be("Invalid watch source: ", e3, "A watch source can only be a getter/effect function, a ref, a reactive object, or an array of these types.");
  }, u2 = en;
  let p2, f2, h2 = false, y2 = false;
  if (We(e2) ? (p2 = () => e2.value, h2 = Te(e2)) : je(e2) ? (p2 = () => e2, o = true) : d(e2) ? (y2 = true, h2 = e2.some((e3) => je(e3) || Te(e3)), p2 = () => e2.map((e3) => We(e3) ? e3.value : je(e3) ? Dt(e3) : g(e3) ? Xe(e3, u2, 2) : void l(e3))) : g(e2) ? p2 = t ? () => Xe(e2, u2, 2) : () => {
    if (!u2 || !u2.isUnmounted)
      return f2 && f2(), Ye(e2, u2, 3, [v2]);
  } : (p2 = c, l(e2)), t && o) {
    const e3 = p2;
    p2 = () => Dt(e3());
  }
  let v2 = (e3) => {
    f2 = N2.onStop = () => {
      Xe(e3, u2, 4);
    };
  }, m2 = y2 ? [] : Rt;
  const _2 = () => {
    if (N2.active)
      if (t) {
        const e3 = N2.run();
        (o || h2 || (y2 ? e3.some((e4, t2) => O(e4, m2[t2])) : O(e3, m2))) && (f2 && f2(), Ye(t, u2, 3, [e3, m2 === Rt ? void 0 : m2, v2]), m2 = e3);
      } else
        N2.run();
  };
  let b2;
  _2.allowRecurse = !!t, b2 = "sync" === r ? _2 : "post" === r ? () => Lt(_2, u2 && u2.suspense) : () => function(e3) {
    yt(e3, st, rt, it);
  }(_2);
  const N2 = new U(p2, b2);
  return N2.onTrack = s, N2.onTrigger = a, t ? n ? _2() : m2 = N2.run() : "post" === r ? Lt(N2.run.bind(N2), u2 && u2.suspense) : N2.run(), () => {
    N2.stop(), u2 && u2.scope && ((e3, t2) => {
      const n2 = e3.indexOf(t2);
      n2 > -1 && e3.splice(n2, 1);
    })(u2.scope.effects, N2);
  };
}
function kt(e2, t, n) {
  const o = this.proxy, r = y(e2) ? e2.includes(".") ? function(e3, t2) {
    const n2 = t2.split(".");
    return () => {
      let t3 = e3;
      for (let e4 = 0; e4 < n2.length && t3; e4++)
        t3 = t3[n2[e4]];
      return t3;
    };
  }(o, e2) : () => o[e2] : e2.bind(o, o);
  let s;
  g(t) ? s = t : (s = t.handler, n = t);
  const i2 = en;
  tn(this);
  const c2 = Pt(r, s.bind(o), n);
  return i2 ? tn(i2) : nn(), c2;
}
function Dt(e2, t) {
  if (!m(e2) || e2.__v_skip)
    return e2;
  if ((t = t || /* @__PURE__ */ new Set()).has(e2))
    return e2;
  if (t.add(e2), We(e2))
    Dt(e2.value, t);
  else if (d(e2))
    for (let n = 0; n < e2.length; n++)
      Dt(e2[n], t);
  else if ("[object Set]" === b(e2) || h(e2))
    e2.forEach((e3) => {
      Dt(e3, t);
    });
  else if (((e3) => "[object Object]" === b(e3))(e2))
    for (const n in e2)
      Dt(e2[n], t);
  return e2;
}
var St = Symbol();
var Ct = (e2) => e2 ? 4 & e2.vnode.shapeFlag ? function(e3) {
  if (e3.exposed)
    return e3.exposeProxy || (e3.exposeProxy = new Proxy(je(t = Fe(e3.exposed)) ? t : new Proxy(t, He), { get: (t2, n) => n in t2 ? t2[n] : n in xt ? xt[n](e3) : void 0 }));
  var t;
}(e2) || e2.proxy : Ct(e2.parent) : null;
var xt = u(/* @__PURE__ */ Object.create(null), { $: (e2) => e2, $el: (e2) => e2.vnode.el, $data: (e2) => e2.data, $props: (e2) => true ? xe(e2.props) : e2.props, $attrs: (e2) => true ? xe(e2.attrs) : e2.attrs, $slots: (e2) => true ? xe(e2.slots) : e2.slots, $refs: (e2) => true ? xe(e2.refs) : e2.refs, $parent: (e2) => Ct(e2.parent), $root: (e2) => Ct(e2.root), $emit: (e2) => e2.emit, $options: (e2) => __VUE_OPTIONS_API__ ? function(e3) {
  const t = e3.type, { mixins: n, extends: o } = t, { mixins: r, optionsCache: s, config: { optionMergeStrategies: i2 } } = e3.appContext, c2 = s.get(t);
  let a;
  c2 ? a = c2 : r.length || n || o ? (a = {}, r.length && r.forEach((e4) => Ut(a, e4, i2, true)), Ut(a, t, i2)) : a = t;
  return s.set(t, a), a;
}(e2) : e2.type, $forceUpdate: (e2) => e2.f || (e2.f = () => ht(e2.update)), $nextTick: (e2) => e2.n || (e2.n = dt.bind(e2.proxy)), $watch: (e2) => __VUE_OPTIONS_API__ ? kt.bind(e2) : c });
var At = { get({ _: e2 }, t) {
  const { ctx: n, setupState: o, data: r, props: s, accessCache: c2, type: a, appContext: l } = e2;
  if ("__isVue" === t)
    return true;
  if (o !== i && o.__isScriptSetup && f(o, t))
    return o[t];
  let u2;
  if ("$" !== t[0]) {
    const a2 = c2[t];
    if (void 0 !== a2)
      switch (a2) {
        case 1:
          return o[t];
        case 2:
          return r[t];
        case 4:
          return n[t];
        case 3:
          return s[t];
      }
    else {
      if (o !== i && f(o, t))
        return c2[t] = 1, o[t];
      if (r !== i && f(r, t))
        return c2[t] = 2, r[t];
      if ((u2 = e2.propsOptions[0]) && f(u2, t))
        return c2[t] = 3, s[t];
      if (n !== i && f(n, t))
        return c2[t] = 4, n[t];
      __VUE_OPTIONS_API__ && !jt || (c2[t] = 0);
    }
  }
  const p2 = xt[t];
  let d2, h2;
  return p2 ? ("$attrs" === t && (L(e2, "get", t), "development"), p2(e2)) : (d2 = a.__cssModules) && (d2 = d2[t]) ? d2 : n !== i && f(n, t) ? (c2[t] = 4, n[t]) : (h2 = l.config.globalProperties, f(h2, t) ? h2[t] : void 0);
}, set({ _: e2 }, t, n) {
  const { data: o, setupState: r, ctx: s } = e2;
  return r !== i && f(r, t) ? (r[t] = n, true) : o !== i && f(o, t) ? (o[t] = n, true) : f(e2.props, t) ? (Be(`Attempting to mutate prop "${t}". Props are readonly.`, e2), false) : "$" === t[0] && t.slice(1) in e2 ? (Be(`Attempting to mutate public property "${t}". Properties starting with $ are reserved and readonly.`, e2), false) : (t in e2.appContext.config.globalProperties ? Object.defineProperty(s, t, { enumerable: true, configurable: true, value: n }) : s[t] = n, true);
}, has({ _: { data: e2, setupState: t, accessCache: n, ctx: o, appContext: r, propsOptions: s } }, c2) {
  let a;
  return !!n[c2] || e2 !== i && f(e2, c2) || t !== i && f(t, c2) || (a = s[0]) && f(a, c2) || f(o, c2) || f(xt, c2) || f(r.config.globalProperties, c2);
}, defineProperty(e2, t, n) {
  return null != n.get ? e2._.accessCache[t] = 0 : f(n, "value") && this.set(e2, t, n.value, null), Reflect.defineProperty(e2, t, n);
} };
At.ownKeys = (e2) => (Be("Avoid app logic that relies on enumerating keys on a component instance. The keys will be empty in production mode to avoid performance overhead."), Reflect.ownKeys(e2));
var jt = true;
function Ut(e2, t, n, o = false) {
  const { mixins: r, extends: s } = t;
  s && Ut(e2, s, n, true), r && r.forEach((t2) => Ut(e2, t2, n, true));
  for (const r2 in t)
    if (o && "expose" === r2)
      Be('"expose" option is ignored when declared in mixins or extends. It should only be declared in the base component itself.');
    else {
      const o2 = Tt[r2] || n && n[r2];
      e2[r2] = o2 ? o2(e2[r2], t[r2]) : t[r2];
    }
  return e2;
}
var Tt = { data: Mt, props: zt, emits: zt, methods: zt, computed: zt, beforeCreate: Ft, created: Ft, beforeMount: Ft, mounted: Ft, beforeUpdate: Ft, updated: Ft, beforeDestroy: Ft, beforeUnmount: Ft, destroyed: Ft, unmounted: Ft, activated: Ft, deactivated: Ft, errorCaptured: Ft, serverPrefetch: Ft, components: zt, directives: zt, watch: function(e2, t) {
  if (!e2)
    return t;
  if (!t)
    return e2;
  const n = u(/* @__PURE__ */ Object.create(null), e2);
  for (const o in t)
    n[o] = Ft(e2[o], t[o]);
  return n;
}, provide: Mt, inject: function(e2, t) {
  return zt(It(e2), It(t));
} };
function Mt(e2, t) {
  return t ? e2 ? function() {
    return u(g(e2) ? e2.call(this, this) : e2, g(t) ? t.call(this, this) : t);
  } : t : e2;
}
function It(e2) {
  if (d(e2)) {
    const t = {};
    for (let n = 0; n < e2.length; n++)
      t[e2[n]] = e2[n];
    return t;
  }
  return e2;
}
function Ft(e2, t) {
  return e2 ? [...new Set([].concat(e2, t))] : t;
}
function zt(e2, t) {
  return e2 ? u(u(/* @__PURE__ */ Object.create(null), e2), t) : t;
}
var Lt = function(e2, t) {
  t && t.pendingBranch ? d(e2) ? t.effects.push(...e2) : t.effects.push(e2) : vt(e2);
};
var Wt = Symbol(true ? "Fragment" : void 0);
var Ht = Symbol(true ? "Text" : void 0);
var qt = Symbol(true ? "Comment" : void 0);
Symbol(true ? "Static" : void 0);
var en = null;
var tn = (e2) => {
  en = e2, e2.scope.on();
};
var nn = () => {
  en && en.scope.off(), en = null;
};
var on = /(?:^|[-_])(\w)/g;
function rn(e2, t = true) {
  return g(e2) ? e2.displayName || e2.name : e2.name || t && e2.__name;
}
function sn(e2, t, n = false) {
  let o = rn(t);
  if (!o && t.__file) {
    const e3 = t.__file.match(/([^/\\]+)\.\w+$/);
    e3 && (o = e3[1]);
  }
  if (!o && e2 && e2.parent) {
    const n2 = (e3) => {
      for (const n3 in e3)
        if (e3[n3] === t)
          return n3;
    };
    o = n2(e2.components || e2.parent.type.components) || n2(e2.appContext.components);
  }
  return o ? o.replace(on, (e3) => e3.toUpperCase()).replace(/[-_]/g, "") : n ? "App" : "Anonymous";
}
function cn(e2) {
  return g(e2) && "__vccOpts" in e2;
}
var an = (e2, t) => function(e3, t2, n = false) {
  let o, r;
  const s = g(e3);
  s ? (o = e3, r = true ? () => {
    console.warn("Write operation failed: computed value is readonly");
  } : c) : (o = e3.get, r = e3.set);
  const i2 = new qe(o, r, s || !r, n);
  return t2 && !n && (i2.effect.onTrack = t2.onTrack, i2.effect.onTrigger = t2.onTrigger), i2;
}(e2, t, false);
function ln(e2) {
  return !(!e2 || !e2.__v_isShallow);
}
Symbol(true ? "ssrContext" : ""), function() {
  if ("undefined" == typeof window)
    return;
  const e2 = { style: "color:#3ba776" }, t = { style: "color:#0b1bc9" }, n = { style: "color:#b62e24" }, o = { style: "color:#9d288c" }, r = { header: (t2) => m(t2) ? t2.__isVue ? ["div", e2, "VueInstance"] : We(t2) ? ["div", {}, ["span", e2, f2(t2)], "<", a(t2.value), ">"] : je(t2) ? ["div", {}, ["span", e2, ln(t2) ? "ShallowReactive" : "Reactive"], "<", a(t2), ">" + (Ue(t2) ? " (readonly)" : "")] : Ue(t2) ? ["div", {}, ["span", e2, ln(t2) ? "ShallowReadonly" : "Readonly"], "<", a(t2), ">"] : null : null, hasBody: (e3) => e3 && e3.__isVue, body(e3) {
    if (e3 && e3.__isVue)
      return ["div", {}, ...s(e3.$)];
  } };
  function s(e3) {
    const t2 = [];
    e3.type.props && e3.props && t2.push(c2("props", Ie(e3.props))), e3.setupState !== i && t2.push(c2("setup", e3.setupState)), e3.data !== i && t2.push(c2("data", Ie(e3.data)));
    const n2 = l(e3, "computed");
    n2 && t2.push(c2("computed", n2));
    const r2 = l(e3, "inject");
    return r2 && t2.push(c2("injected", r2)), t2.push(["div", {}, ["span", { style: o.style + ";opacity:0.66" }, "$ (internal): "], ["object", { object: e3 }]]), t2;
  }
  function c2(e3, t2) {
    return t2 = u({}, t2), Object.keys(t2).length ? ["div", { style: "line-height:1.25em;margin-bottom:0.6em" }, ["div", { style: "color:#476582" }, e3], ["div", { style: "padding-left:1.25em" }, ...Object.keys(t2).map((e4) => ["div", {}, ["span", o, e4 + ": "], a(t2[e4], false)])]] : ["span", {}];
  }
  function a(e3, r2 = true) {
    return "number" == typeof e3 ? ["span", t, e3] : "string" == typeof e3 ? ["span", n, JSON.stringify(e3)] : "boolean" == typeof e3 ? ["span", o, e3] : m(e3) ? ["object", { object: r2 ? Ie(e3) : e3 }] : ["span", n, String(e3)];
  }
  function l(e3, t2) {
    const n2 = e3.type;
    if (g(n2))
      return;
    const o2 = {};
    for (const r2 in e3.ctx)
      p2(n2, r2, t2) && (o2[r2] = e3.ctx[r2]);
    return o2;
  }
  function p2(e3, t2, n2) {
    const o2 = e3[n2];
    return !!(d(o2) && o2.includes(t2) || m(o2) && t2 in o2) || !(!e3.extends || !p2(e3.extends, t2, n2)) || !(!e3.mixins || !e3.mixins.some((e4) => p2(e4, t2, n2))) || void 0;
  }
  function f2(e3) {
    return ln(e3) ? "ShallowRef" : e3.effect ? "ComputedRef" : "Ref";
  }
  window.devtoolsFormatters ? window.devtoolsFormatters.push(r) : window.devtoolsFormatters = [r];
}();
var un = (e2) => {
  let t = null;
  const n = e2.toString().match(/\(([a-z0-9 ,$_+*\-/]+)\)/im);
  if (n && Array.isArray(n) && n[0]) {
    let e3 = n[0];
    e3 = e3.replace(/\(|\)|[ ]/g, "");
    const o = e3.split(",");
    o.length > 0 && (t = o);
  }
  return t;
};
var pn = (e2) => "string" != typeof e2 ? "" : e2.charAt(0).toUpperCase() + e2.slice(1);
var fn = Se({ registeredUser: {}, registeredRules: {}, options: {} });
var dn = (e2) => {
  if (wn(e2.user))
    fn.registeredUser = e2.user();
  else {
    const t = e2.user;
    fn.registeredUser = t;
  }
  e2.rules && "function" == typeof e2.rules && e2.rules(), fn.options = e2;
};
var hn = (e2, t) => {
  Object.prototype.hasOwnProperty.call(fn.registeredRules, e2) ? console.warn(`:::VueSimpleACL::: Duplicate ACL Rule '${e2}' defined. Only the first defined rule will be evaluated.`) : fn.registeredRules[e2] = t;
};
var gn = (e2, t) => {
  "string" == typeof e2 ? hn(e2, t) : "object" == typeof e2 && Array.isArray(e2) && Object.values(e2).forEach((e3) => {
    hn(e3, t);
  });
};
var yn = (e2, t, n) => {
  try {
    return "function" == typeof e2 && ("object" != typeof n || Array.isArray(n) ? "object" == typeof n && Array.isArray(n) ? e2(fn.registeredUser, ...n) : e2(fn.registeredUser) : e2(fn.registeredUser, n));
  } catch (n2) {
    const o = un(e2);
    let r = null;
    o && Array.isArray(o) && (o.shift(), r = o.join(", "));
    let s = ':::VueSimpleACL::: The defined ACL Rule for "' + t + '" require some argument(s) or data object to be specified for matching.';
    return s += "\n\nCheck the file containing your defineAclRules((setRule) => {...}); declarations", s += "\n\nExamples:", o && o.length <= 0 ? (s += `
v-can:${t}`, s += `
v-can="'${t}'"`, s += `
$can('${t}')`) : o && 1 === o.length ? (s += `
v-can:${t}="${r}"`, s += `
v-can="'${t}', ${r}"`, s += `
$can('${t}', ${r})`) : (s += `
v-can:${t}="[${r}]"`, s += `
v-can="'${t}', [${r}]"`, s += `
$can('${t}', [${r}])`), console.error(s), console.error(n2), false;
  }
};
var vn = ({ abilities: e2, args: t, any: n = false }) => {
  if (e2 && "string" == typeof e2) {
    if (Object.prototype.hasOwnProperty.call(fn.registeredRules, e2)) {
      const n2 = fn.registeredRules[e2];
      return yn(n2, e2, t);
    }
  } else if ("object" == typeof e2 && Array.isArray(e2)) {
    let t2 = false, o = false, r = 0, s = 0;
    return e2.forEach((e3) => {
      if (Object.prototype.hasOwnProperty.call(fn.registeredRules, e3.abilities)) {
        const i2 = fn.registeredRules[e3.abilities];
        o = yn(i2, e3.abilities, e3.args), o && s++, true === n && o && (t2 = true), r++;
      }
    }), r > 0 && r === s && (t2 = true), t2;
  }
  return false;
};
var mn = ({ abilities: e2, args: t, any: n = false }) => {
  const o = t, r = n;
  let s = false;
  if (e2)
    s = vn(o ? { abilities: e2, args: o } : { abilities: e2 });
  else if (o && "string" == typeof o)
    s = vn({ abilities: o });
  else if (o && null !== o && "object" == typeof o) {
    if (2 !== (Array.isArray(o) ? o.length : Object.keys(o).length) || "string" != typeof o[0] || "object" != typeof o[1] || Array.isArray(o[1])) {
      const e3 = [], t2 = [];
      o.forEach((t3) => {
        if (t3 && "string" == typeof t3)
          e3.push({ abilities: t3 });
        else if (t3 && "object" == typeof t3) {
          let n2 = null;
          const o2 = [];
          t3.forEach((e4) => {
            e4 && !n2 && "string" == typeof e4 ? n2 = e4 : o2.push(e4);
          }), n2 && e3.push({ abilities: n2, args: o2 });
        }
      }), s = vn({ abilities: e3, args: t2, any: r });
    } else
      s = vn({ abilities: o[0], args: o[1] });
  }
  return s;
};
var _n = ({ abilities: e2, args: t, any: n = false }) => e2 && "string" == typeof e2 ? mn({ abilities: e2, args: t, any: n }) : "object" == typeof e2 ? mn({ abilities: null, args: e2, any: n }) : (console.warn(":::VueSimpleACL::: Invalid ACL arguments specified."), false);
var bn = (e2, t) => _n({ abilities: e2, args: t, any: false });
var Nn = (e2, t) => !_n({ abilities: e2, args: t, any: false });
var En = (e2, t) => _n({ abilities: e2, args: t, any: true });
var wn = (e2) => "function" == typeof e2 && e2() instanceof Promise;
var On = (e2, t) => {
  const n = !!e2.config.globalProperties, o = { ...{ user: /* @__PURE__ */ Object.create(null), rules: null, router: null, onDeniedRoute: "/", directiveName: "can", helperName: "$can", enableSematicAlias: true }, ...t };
  o.directiveName && "string" == typeof o.directiveName && o.directiveName.startsWith("v-") && (o.directiveName = o.directiveName.substring(2, o.directiveName.length)), o.helperName && "string" == typeof o.helperName && "$" !== o.helperName.charAt(0) && (o.helperName = "$" + o.helperName), wn(o.user) || dn(o);
  const r = (e3, t2) => {
    const n2 = t2.arg, o2 = t2.value, r2 = t2.modifiers, s2 = !!r2.any, i3 = !!r2.not, c2 = !!r2.readonly, a = !(!r2.disable && !r2.disabled);
    !r2.hide && r2.hidden;
    mn({ abilities: n2, args: o2, any: s2 }) ? i3 && (e3.style.display = "none") : i3 || (a ? e3.disabled = true : c2 ? e3.readOnly = true : e3.style.display = "none");
  }, s = (e3, t2, n2) => {
    e3.directive(`${t2}`, { mounted(e4, t3) {
      r(e4, t3);
    }, updated(e4, t3) {
      r(e4, t3);
    } });
  }, i2 = (e3, t2, n2, o2) => {
    n2 ? o2 ? (e3.config.globalProperties.$acl || (e3.config.globalProperties.$acl = {}), e3.config.globalProperties.$acl[t2] = (e4, t3) => bn(e4, t3), e3.config.globalProperties.$acl[`all${pn(t2)}`] = (e4, t3) => bn(e4, t3), e3.config.globalProperties.$acl[`not${pn(t2)}`] = (e4, t3) => Nn(e4, t3), e3.config.globalProperties.$acl[`any${pn(t2)}`] = (e4, t3) => En(e4, t3)) : (e3.config.globalProperties[t2] = (e4, t3) => bn(e4, t3), e3.config.globalProperties[t2].all = (e4, t3) => bn(e4, t3), e3.config.globalProperties[t2].not = (e4, t3) => Nn(e4, t3), e3.config.globalProperties[t2].any = (e4, t3) => En(e4, t3)) : o2 ? (e3.prototype.$acl || (e3.prototype.$acl = {}), e3.prototype.$acl[t2] = (e4, t3) => bn(e4, t3), e3.prototype.$acl[`all${pn(t2)}`] = (e4, t3) => bn(e4, t3), e3.prototype.$acl[`not${pn(t2)}`] = (e4, t3) => Nn(e4, t3), e3.prototype.$acl[`any${pn(t2)}`] = (e4, t3) => En(e4, t3)) : (e3.prototype[t2] = (e4, t3) => bn(e4, t3), e3.prototype[t2].all = (e4, t3) => bn(e4, t3), e3.prototype[t2].not = (e4, t3) => Nn(e4, t3), e3.prototype[t2].any = (e4, t3) => En(e4, t3));
  };
  if (s(e2, `${o.directiveName}`), o.enableSematicAlias && (s(e2, "permission"), s(e2, "permissions"), s(e2, "role"), s(e2, "roles"), s(e2, "role-or-permission"), s(e2, "role-or-permissions")), i2(e2, `${o.helperName}`, n, false), o.enableSematicAlias && (i2(e2, "can", n, true), i2(e2, "permission", n, true), i2(e2, "permissions", n, true), i2(e2, "role", n, true), i2(e2, "roles", n, true), i2(e2, "roleOrPermission", n, true), i2(e2, "roleOrPermissions", n, true), n ? (e2.config.globalProperties.$acl || (e2.config.globalProperties.$acl = {}), e2.config.globalProperties.$acl.user = an(() => fn.registeredUser).value, e2.config.globalProperties.$acl.getUser = () => fn.registeredUser) : (e2.prototype.$acl || (e2.prototype.$acl = {}), e2.prototype.$acl.user = an(() => fn.registeredUser).value, e2.prototype.$acl.getUser = () => fn.registeredUser)), o.router) {
    const e3 = (e4, t3, n2, r2) => {
      if (r2)
        n2();
      else {
        let r3 = o.onDeniedRoute;
        e4.meta && e4.meta.onDeniedRoute && (r3 = e4.meta.onDeniedRoute), n2("object" == typeof r3 ? r3 : "$from" === r3 ? t3 : { path: `${r3}`, replace: true });
      }
    }, t2 = (t3, n2, o2) => {
      if (t3.meta && (t3.meta.can || t3.meta.permission || t3.meta.role || t3.meta.roleOrPermission)) {
        const r2 = t3.meta.can || t3.meta.permission || t3.meta.role || t3.meta.roleOrPermission;
        let s2 = false;
        if ("function" == typeof r2) {
          const e4 = un(r2);
          s2 = Array.isArray(e4) && 4 === e4.length ? r2(t3, n2, bn, fn.registeredUser) : r2(t3, n2, bn);
        } else
          s2 = bn(r2);
        e3(t3, n2, o2, s2);
      } else if (t3.meta && (t3.meta.canAll || t3.meta.allCan || t3.meta.allPermission || t3.meta.allRole || t3.meta.allRoleOrPermission)) {
        const r2 = t3.meta.canAll || t3.meta.allCan || t3.meta.allPermission || t3.meta.allRole || t3.meta.allRoleOrPermission;
        let s2 = false;
        if ("function" == typeof r2) {
          const e4 = un(r2);
          s2 = Array.isArray(e4) && 4 === e4.length ? r2(t3, n2, bn, fn.registeredUser) : r2(t3, n2, bn);
        } else
          s2 = bn(r2);
        e3(t3, n2, o2, s2);
      } else if (t3.meta && (t3.meta.cannot || t3.meta.canNot || t3.meta.notCan || t3.meta.notPermission || t3.meta.notRole || t3.meta.notRoleOrPermission)) {
        const r2 = t3.meta.cannot || t3.meta.canNot || t3.meta.notCan || t3.meta.notPermission || t3.meta.notRole || t3.meta.notRoleOrPermission;
        let s2 = false;
        if ("function" == typeof r2) {
          const e4 = un(r2);
          s2 = Array.isArray(e4) && 4 === e4.length ? r2(t3, n2, Nn, fn.registeredUser) : r2(t3, n2, Nn);
        } else
          s2 = Nn(r2);
        e3(t3, n2, o2, s2);
      } else if (t3.meta && (t3.meta.canAny || t3.meta.anyCan || t3.meta.anyPermission || t3.meta.anyRole || t3.meta.anyRoleOrPermission)) {
        const r2 = t3.meta.canAny || t3.meta.anyCan || t3.meta.anyPermission || t3.meta.anyRole || t3.meta.anyRoleOrPermission;
        let s2 = false;
        if ("function" == typeof r2) {
          const e4 = un(r2);
          s2 = Array.isArray(e4) && 4 === e4.length ? r2(t3, n2, En, fn.registeredUser) : r2(t3, n2, En);
        } else
          s2 = En(r2);
        e3(t3, n2, o2, s2);
      } else
        o2();
    };
    o.router.beforeEach((e4, n2, r2) => {
      wn(o.user) ? o.user().then((s2) => {
        o.user = s2, dn(o), t2(e4, n2, r2);
      }).catch(() => {
        console.warn(":::VueSimpleACL::: Error while processing/retrieving 'user' data with the Asynchronous function.");
      }) : t2(e4, n2, r2);
    });
  } else
    wn(o.user) && console.error(":::VueSimpleACL::: Instance of vue-router is required to define 'user' retrieved from a promise or Asynchronous function.");
};
var $n = (e2) => ({ install: (t, n = {}) => {
  On(t, { ...n, ...e2 });
} });
var Vn = (e2) => {
  "function" == typeof e2 && e2(gn);
};
var Rn = () => {
  const e2 = {};
  return e2.user = an(() => fn.registeredUser).value, e2.getUser = () => fn.registeredUser, e2.can = bn, e2.can.not = Nn, e2.can.any = En, e2.notCan = Nn, e2.canNot = Nn, e2.cannot = Nn, e2.anyCan = En, e2.permission = bn, e2.allPermission = bn, e2.notPermission = Nn, e2.anyPermission = En, e2.permission.not = Nn, e2.permission.any = En, e2.role = bn, e2.allRole = bn, e2.notRole = Nn, e2.anyRole = En, e2.role.not = Nn, e2.role.any = En, e2.roleOrPermission = bn, e2.allRoleOrPermission = bn, e2.notRoleOrPermission = Nn, e2.anyRoleOrPermission = En, e2.roleOrPermission.not = Nn, e2.roleOrPermission.any = En, Se(e2);
};
var Pn = { install: (e2, t) => On(e2, t) };
export {
  $n as createAcl,
  Pn as default,
  Vn as defineAclRules,
  Rn as useAcl
};
//# sourceMappingURL=vue-simple-acl.js.map
