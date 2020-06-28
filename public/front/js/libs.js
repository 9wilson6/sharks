var _gsScope = "undefined" != typeof module && module.exports && "undefined" != typeof global ? global : this || window;
(_gsScope._gsQueue || (_gsScope._gsQueue = [])).push(function () {
        "use strict";
        _gsScope._gsDefine("TweenMax", ["core.Animation", "core.SimpleTimeline", "TweenLite"], function (e, t, i) {
                var r = function (e) {
                        var t, i = [],
                            r = e.length;
                        for (t = 0; t !== r; i.push(e[t++]));
                        return i
                    },
                    a = function (e, t, r) {
                        i.call(this, e, t, r), this._cycle = 0, this._yoyo = !0 === this.vars.yoyo, this._repeat = this.vars.repeat || 0, this._repeatDelay = this.vars.repeatDelay || 0, this._dirty = !0, this.render = a.prototype.render
                    },
                    s = 1e-10,
                    n = i._internals,
                    o = n.isSelector,
                    l = n.isArray,
                    d = a.prototype = i.to({}, .1, {}),
                    h = [];
                a.version = "1.15.1", d.constructor = a, d.kill()._gc = !1, a.killTweensOf = a.killDelayedCallsTo = i.killTweensOf, a.getTweensOf = i.getTweensOf, a.lagSmoothing = i.lagSmoothing, a.ticker = i.ticker, a.render = i.render, d.invalidate = function () {
                    return this._yoyo = !0 === this.vars.yoyo, this._repeat = this.vars.repeat || 0, this._repeatDelay = this.vars.repeatDelay || 0, this._uncache(!0), i.prototype.invalidate.call(this)
                }, d.updateTo = function (e, t) {
                    var r, a = this.ratio,
                        s = this.vars.immediateRender || e.immediateRender;
                    t && this._startTime < this._timeline._time && (this._startTime = this._timeline._time, this._uncache(!1), this._gc ? this._enabled(!0, !1) : this._timeline.insert(this, this._startTime - this._delay));
                    for (r in e) this.vars[r] = e[r];
                    if (this._initted || s)
                        if (t) this._initted = !1, s && this.render(0, !0, !0);
                        else if (this._gc && this._enabled(!0, !1), this._notifyPluginsOfEnabled && this._firstPT && i._onPluginEvent("_onDisable", this), this._time / this._duration > .998) {
                        var n = this._time;
                        this.render(0, !0, !1), this._initted = !1, this.render(n, !0, !1)
                    } else if (this._time > 0 || s) {
                        this._initted = !1, this._init();
                        for (var o, l = 1 / (1 - a), d = this._firstPT; d;) o = d.s + d.c, d.c *= l, d.s = o - d.c, d = d._next
                    }
                    return this
                }, d.render = function (e, t, i) {
                    this._initted || 0 === this._duration && this.vars.repeat && this.invalidate();
                    var r, a, o, l, d, c, u, p, f = this._dirty ? this.totalDuration() : this._totalDuration,
                        m = this._time,
                        v = this._totalTime,
                        g = this._cycle,
                        _ = this._duration,
                        y = this._rawPrevTime;
                    if (e >= f ? (this._totalTime = f, this._cycle = this._repeat, this._yoyo && 0 != (1 & this._cycle) ? (this._time = 0, this.ratio = this._ease._calcEnd ? this._ease.getRatio(0) : 0) : (this._time = _, this.ratio = this._ease._calcEnd ? this._ease.getRatio(1) : 1), this._reversed || (r = !0, a = "onComplete"), 0 === _ && (this._initted || !this.vars.lazy || i) && (this._startTime === this._timeline._duration && (e = 0), (0 === e || 0 > y || y === s) && y !== e && (i = !0, y > s && (a = "onReverseComplete")), this._rawPrevTime = p = !t || e || y === e ? e : s)) : 1e-7 > e ? (this._totalTime = this._time = this._cycle = 0, this.ratio = this._ease._calcEnd ? this._ease.getRatio(0) : 0, (0 !== v || 0 === _ && y > 0 && y !== s) && (a = "onReverseComplete", r = this._reversed), 0 > e && (this._active = !1, 0 === _ && (this._initted || !this.vars.lazy || i) && (y >= 0 && (i = !0), this._rawPrevTime = p = !t || e || y === e ? e : s)), this._initted || (i = !0)) : (this._totalTime = this._time = e, 0 !== this._repeat && (l = _ + this._repeatDelay, this._cycle = this._totalTime / l >> 0, 0 !== this._cycle && this._cycle === this._totalTime / l && this._cycle--, this._time = this._totalTime - this._cycle * l, this._yoyo && 0 != (1 & this._cycle) && (this._time = _ - this._time), this._time > _ ? this._time = _ : 0 > this._time && (this._time = 0)), this._easeType ? (d = this._time / _, c = this._easeType, u = this._easePower, (1 === c || 3 === c && d >= .5) && (d = 1 - d), 3 === c && (d *= 2), 1 === u ? d *= d : 2 === u ? d *= d * d : 3 === u ? d *= d * d * d : 4 === u && (d *= d * d * d * d), this.ratio = 1 === c ? 1 - d : 2 === c ? d : .5 > this._time / _ ? d / 2 : 1 - d / 2) : this.ratio = this._ease.getRatio(this._time / _)), m !== this._time || i || g !== this._cycle) {
                        if (!this._initted) {
                            if (this._init(), !this._initted || this._gc) return;
                            if (!i && this._firstPT && (!1 !== this.vars.lazy && this._duration || this.vars.lazy && !this._duration)) return this._time = m, this._totalTime = v, this._rawPrevTime = y, this._cycle = g, n.lazyTweens.push(this), void(this._lazy = [e, t]);
                            this._time && !r ? this.ratio = this._ease.getRatio(this._time / _) : r && this._ease._calcEnd && (this.ratio = this._ease.getRatio(0 === this._time ? 0 : 1))
                        }
                        for (!1 !== this._lazy && (this._lazy = !1), this._active || !this._paused && this._time !== m && e >= 0 && (this._active = !0), 0 === v && (2 === this._initted && e > 0 && this._init(), this._startAt && (e >= 0 ? this._startAt.render(e, t, i) : a || (a = "_dummyGS")), this.vars.onStart && (0 !== this._totalTime || 0 === _) && (t || this.vars.onStart.apply(this.vars.onStartScope || this, this.vars.onStartParams || h))), o = this._firstPT; o;) o.f ? o.t[o.p](o.c * this.ratio + o.s) : o.t[o.p] = o.c * this.ratio + o.s, o = o._next;
                        this._onUpdate && (0 > e && this._startAt && this._startTime && this._startAt.render(e, t, i), t || (this._totalTime !== v || r) && this._onUpdate.apply(this.vars.onUpdateScope || this, this.vars.onUpdateParams || h)), this._cycle !== g && (t || this._gc || this.vars.onRepeat && this.vars.onRepeat.apply(this.vars.onRepeatScope || this, this.vars.onRepeatParams || h)), a && (!this._gc || i) && (0 > e && this._startAt && !this._onUpdate && this._startTime && this._startAt.render(e, t, i), r && (this._timeline.autoRemoveChildren && this._enabled(!1, !1), this._active = !1), !t && this.vars[a] && this.vars[a].apply(this.vars[a + "Scope"] || this, this.vars[a + "Params"] || h), 0 === _ && this._rawPrevTime === s && p !== s && (this._rawPrevTime = 0))
                    } else v !== this._totalTime && this._onUpdate && (t || this._onUpdate.apply(this.vars.onUpdateScope || this, this.vars.onUpdateParams || h))
                }, a.to = function (e, t, i) {
                    return new a(e, t, i)
                }, a.from = function (e, t, i) {
                    return i.runBackwards = !0, i.immediateRender = 0 != i.immediateRender, new a(e, t, i)
                }, a.fromTo = function (e, t, i, r) {
                    return r.startAt = i, r.immediateRender = 0 != r.immediateRender && 0 != i.immediateRender, new a(e, t, r)
                }, a.staggerTo = a.allTo = function (e, t, s, n, d, c, u) {
                    n = n || 0;
                    var p, f, m, v, g = s.delay || 0,
                        _ = [];
                    for (l(e) || ("string" == typeof e && (e = i.selector(e) || e), o(e) && (e = r(e))), e = e || [], 0 > n && ((e = r(e)).reverse(), n *= -1), p = e.length - 1, m = 0; p >= m; m++) {
                        f = {};
                        for (v in s) f[v] = s[v];
                        f.delay = g, m === p && d && (f.onComplete = function () {
                            s.onComplete && s.onComplete.apply(s.onCompleteScope || this, arguments), d.apply(u || this, c || h)
                        }), _[m] = new a(e[m], t, f), g += n
                    }
                    return _
                }, a.staggerFrom = a.allFrom = function (e, t, i, r, s, n, o) {
                    return i.runBackwards = !0, i.immediateRender = 0 != i.immediateRender, a.staggerTo(e, t, i, r, s, n, o)
                }, a.staggerFromTo = a.allFromTo = function (e, t, i, r, s, n, o, l) {
                    return r.startAt = i, r.immediateRender = 0 != r.immediateRender && 0 != i.immediateRender, a.staggerTo(e, t, r, s, n, o, l)
                }, a.delayedCall = function (e, t, i, r, s) {
                    return new a(t, 0, {
                        delay: e,
                        onComplete: t,
                        onCompleteParams: i,
                        onCompleteScope: r,
                        onReverseComplete: t,
                        onReverseCompleteParams: i,
                        onReverseCompleteScope: r,
                        immediateRender: !1,
                        useFrames: s,
                        overwrite: 0
                    })
                }, a.set = function (e, t) {
                    return new a(e, 0, t)
                }, a.isTweening = function (e) {
                    return i.getTweensOf(e, !0).length > 0
                };
                var c = function (e, t) {
                        for (var r = [], a = 0, s = e._first; s;) s instanceof i ? r[a++] = s : (t && (r[a++] = s), r = r.concat(c(s, t)), a = r.length), s = s._next;
                        return r
                    },
                    u = a.getAllTweens = function (t) {
                        return c(e._rootTimeline, t).concat(c(e._rootFramesTimeline, t))
                    };
                a.killAll = function (e, i, r, a) {
                    null == i && (i = !0), null == r && (r = !0);
                    var s, n, o, l = u(0 != a),
                        d = l.length,
                        h = i && r && a;
                    for (o = 0; d > o; o++) n = l[o], (h || n instanceof t || (s = n.target === n.vars.onComplete) && r || i && !s) && (e ? n.totalTime(n._reversed ? 0 : n.totalDuration()) : n._enabled(!1, !1))
                }, a.killChildTweensOf = function (e, t) {
                    if (null != e) {
                        var s, d, h, c, u, p = n.tweenLookup;
                        if ("string" == typeof e && (e = i.selector(e) || e), o(e) && (e = r(e)), l(e))
                            for (c = e.length; --c > -1;) a.killChildTweensOf(e[c], t);
                        else {
                            s = [];
                            for (h in p)
                                for (d = p[h].target.parentNode; d;) d === e && (s = s.concat(p[h].tweens)), d = d.parentNode;
                            for (u = s.length, c = 0; u > c; c++) t && s[c].totalTime(s[c].totalDuration()), s[c]._enabled(!1, !1)
                        }
                    }
                };
                var p = function (e, i, r, a) {
                    i = !1 !== i, r = !1 !== r;
                    for (var s, n, o = u(a = !1 !== a), l = i && r && a, d = o.length; --d > -1;) n = o[d], (l || n instanceof t || (s = n.target === n.vars.onComplete) && r || i && !s) && n.paused(e)
                };
                return a.pauseAll = function (e, t, i) {
                    p(!0, e, t, i)
                }, a.resumeAll = function (e, t, i) {
                    p(!1, e, t, i)
                }, a.globalTimeScale = function (t) {
                    var r = e._rootTimeline,
                        a = i.ticker.time;
                    return arguments.length ? (t = t || s, r._startTime = a - (a - r._startTime) * r._timeScale / t, r = e._rootFramesTimeline, a = i.ticker.frame, r._startTime = a - (a - r._startTime) * r._timeScale / t, r._timeScale = e._rootTimeline._timeScale = t, t) : r._timeScale
                }, d.progress = function (e) {
                    return arguments.length ? this.totalTime(this.duration() * (this._yoyo && 0 != (1 & this._cycle) ? 1 - e : e) + this._cycle * (this._duration + this._repeatDelay), !1) : this._time / this.duration()
                }, d.totalProgress = function (e) {
                    return arguments.length ? this.totalTime(this.totalDuration() * e, !1) : this._totalTime / this.totalDuration()
                }, d.time = function (e, t) {
                    return arguments.length ? (this._dirty && this.totalDuration(), e > this._duration && (e = this._duration), this._yoyo && 0 != (1 & this._cycle) ? e = this._duration - e + this._cycle * (this._duration + this._repeatDelay) : 0 !== this._repeat && (e += this._cycle * (this._duration + this._repeatDelay)), this.totalTime(e, t)) : this._time
                }, d.duration = function (t) {
                    return arguments.length ? e.prototype.duration.call(this, t) : this._duration
                }, d.totalDuration = function (e) {
                    return arguments.length ? -1 === this._repeat ? this : this.duration((e - this._repeat * this._repeatDelay) / (this._repeat + 1)) : (this._dirty && (this._totalDuration = -1 === this._repeat ? 999999999999 : this._duration * (this._repeat + 1) + this._repeatDelay * this._repeat, this._dirty = !1), this._totalDuration)
                }, d.repeat = function (e) {
                    return arguments.length ? (this._repeat = e, this._uncache(!0)) : this._repeat
                }, d.repeatDelay = function (e) {
                    return arguments.length ? (this._repeatDelay = e, this._uncache(!0)) : this._repeatDelay
                }, d.yoyo = function (e) {
                    return arguments.length ? (this._yoyo = e, this) : this._yoyo
                }, a
            }, !0), _gsScope._gsDefine("TimelineLite", ["core.Animation", "core.SimpleTimeline", "TweenLite"], function (e, t, i) {
                var r = function (e) {
                        t.call(this, e), this._labels = {}, this.autoRemoveChildren = !0 === this.vars.autoRemoveChildren, this.smoothChildTiming = !0 === this.vars.smoothChildTiming, this._sortChildren = !0, this._onUpdate = this.vars.onUpdate;
                        var i, r, a = this.vars;
                        for (r in a) i = a[r], l(i) && -1 !== i.join("").indexOf("{self}") && (a[r] = this._swapSelfInParams(i));
                        l(a.tweens) && this.add(a.tweens, 0, a.align, a.stagger)
                    },
                    a = 1e-10,
                    s = i._internals,
                    n = r._internals = {},
                    o = s.isSelector,
                    l = s.isArray,
                    d = s.lazyTweens,
                    h = s.lazyRender,
                    c = [],
                    u = _gsScope._gsDefine.globals,
                    p = function (e) {
                        var t, i = {};
                        for (t in e) i[t] = e[t];
                        return i
                    },
                    f = n.pauseCallback = function (e, t, i, r) {
                        var a = e._timeline,
                            s = a._totalTime;
                        !t && this._forcingPlayhead || a._rawPrevTime === e._startTime || (a.pause(e._startTime), t && t.apply(r || a, i || c), this._forcingPlayhead && a.seek(s))
                    },
                    m = function (e) {
                        var t, i = [],
                            r = e.length;
                        for (t = 0; t !== r; i.push(e[t++]));
                        return i
                    },
                    v = r.prototype = new t;
                return r.version = "1.15.1", v.constructor = r, v.kill()._gc = v._forcingPlayhead = !1, v.to = function (e, t, r, a) {
                    var s = r.repeat && u.TweenMax || i;
                    return t ? this.add(new s(e, t, r), a) : this.set(e, r, a)
                }, v.from = function (e, t, r, a) {
                    return this.add((r.repeat && u.TweenMax || i).from(e, t, r), a)
                }, v.fromTo = function (e, t, r, a, s) {
                    var n = a.repeat && u.TweenMax || i;
                    return t ? this.add(n.fromTo(e, t, r, a), s) : this.set(e, a, s)
                }, v.staggerTo = function (e, t, a, s, n, l, d, h) {
                    var c, u = new r({
                        onComplete: l,
                        onCompleteParams: d,
                        onCompleteScope: h,
                        smoothChildTiming: this.smoothChildTiming
                    });
                    for ("string" == typeof e && (e = i.selector(e) || e), o(e = e || []) && (e = m(e)), 0 > (s = s || 0) && ((e = m(e)).reverse(), s *= -1), c = 0; e.length > c; c++) a.startAt && (a.startAt = p(a.startAt)), u.to(e[c], t, p(a), c * s);
                    return this.add(u, n)
                }, v.staggerFrom = function (e, t, i, r, a, s, n, o) {
                    return i.immediateRender = 0 != i.immediateRender, i.runBackwards = !0, this.staggerTo(e, t, i, r, a, s, n, o)
                }, v.staggerFromTo = function (e, t, i, r, a, s, n, o, l) {
                    return r.startAt = i, r.immediateRender = 0 != r.immediateRender && 0 != i.immediateRender, this.staggerTo(e, t, r, a, s, n, o, l)
                }, v.call = function (e, t, r, a) {
                    return this.add(i.delayedCall(0, e, t, r), a)
                }, v.set = function (e, t, r) {
                    return r = this._parseTimeOrLabel(r, 0, !0), null == t.immediateRender && (t.immediateRender = r === this._time && !this._paused), this.add(new i(e, 0, t), r)
                }, r.exportRoot = function (e, t) {
                    null == (e = e || {}).smoothChildTiming && (e.smoothChildTiming = !0);
                    var a, s, n = new r(e),
                        o = n._timeline;
                    for (null == t && (t = !0), o._remove(n, !0), n._startTime = 0, n._rawPrevTime = n._time = n._totalTime = o._time, a = o._first; a;) s = a._next, t && a instanceof i && a.target === a.vars.onComplete || n.add(a, a._startTime - a._delay), a = s;
                    return o.add(n, 0), n
                }, v.add = function (a, s, n, o) {
                    var d, h, c, u, p, f;
                    if ("number" != typeof s && (s = this._parseTimeOrLabel(s, 0, !0, a)), !(a instanceof e)) {
                        if (a instanceof Array || a && a.push && l(a)) {
                            for (n = n || "normal", o = o || 0, d = s, h = a.length, c = 0; h > c; c++) l(u = a[c]) && (u = new r({
                                tweens: u
                            })), this.add(u, d), "string" != typeof u && "function" != typeof u && ("sequence" === n ? d = u._startTime + u.totalDuration() / u._timeScale : "start" === n && (u._startTime -= u.delay())), d += o;
                            return this._uncache(!0)
                        }
                        if ("string" == typeof a) return this.addLabel(a, s);
                        if ("function" != typeof a) throw "Cannot add " + a + " into the timeline; it is not a tween, timeline, function, or string.";
                        a = i.delayedCall(0, a)
                    }
                    if (t.prototype.add.call(this, a, s), (this._gc || this._time === this._duration) && !this._paused && this._duration < this.duration())
                        for (p = this, f = p.rawTime() > a._startTime; p._timeline;) f && p._timeline.smoothChildTiming ? p.totalTime(p._totalTime, !0) : p._gc && p._enabled(!0, !1), p = p._timeline;
                    return this
                }, v.remove = function (t) {
                    if (t instanceof e) return this._remove(t, !1);
                    if (t instanceof Array || t && t.push && l(t)) {
                        for (var i = t.length; --i > -1;) this.remove(t[i]);
                        return this
                    }
                    return "string" == typeof t ? this.removeLabel(t) : this.kill(null, t)
                }, v._remove = function (e, i) {
                    t.prototype._remove.call(this, e, i);
                    var r = this._last;
                    return r ? this._time > r._startTime + r._totalDuration / r._timeScale && (this._time = this.duration(), this._totalTime = this._totalDuration) : this._time = this._totalTime = this._duration = this._totalDuration = 0, this
                }, v.append = function (e, t) {
                    return this.add(e, this._parseTimeOrLabel(null, t, !0, e))
                }, v.insert = v.insertMultiple = function (e, t, i, r) {
                    return this.add(e, t || 0, i, r)
                }, v.appendMultiple = function (e, t, i, r) {
                    return this.add(e, this._parseTimeOrLabel(null, t, !0, e), i, r)
                }, v.addLabel = function (e, t) {
                    return this._labels[e] = this._parseTimeOrLabel(t), this
                }, v.addPause = function (e, t, r, a) {
                    var s = i.delayedCall(0, f, ["{self}", t, r, a], this);
                    return s.data = "isPause", this.add(s, e)
                }, v.removeLabel = function (e) {
                    return delete this._labels[e], this
                }, v.getLabelTime = function (e) {
                    return null != this._labels[e] ? this._labels[e] : -1
                }, v._parseTimeOrLabel = function (t, i, r, a) {
                    var s;
                    if (a instanceof e && a.timeline === this) this.remove(a);
                    else if (a && (a instanceof Array || a.push && l(a)))
                        for (s = a.length; --s > -1;) a[s] instanceof e && a[s].timeline === this && this.remove(a[s]);
                    if ("string" == typeof i) return this._parseTimeOrLabel(i, r && "number" == typeof t && null == this._labels[i] ? t - this.duration() : 0, r);
                    if (i = i || 0, "string" != typeof t || !isNaN(t) && null == this._labels[t]) null == t && (t = this.duration());
                    else {
                        if (-1 === (s = t.indexOf("="))) return null == this._labels[t] ? r ? this._labels[t] = this.duration() + i : i : this._labels[t] + i;
                        i = parseInt(t.charAt(s - 1) + "1", 10) * Number(t.substr(s + 1)), t = s > 1 ? this._parseTimeOrLabel(t.substr(0, s - 1), 0, r) : this.duration()
                    }
                    return Number(t) + i
                }, v.seek = function (e, t) {
                    return this.totalTime("number" == typeof e ? e : this._parseTimeOrLabel(e), !1 !== t)
                }, v.stop = function () {
                    return this.paused(!0)
                }, v.gotoAndPlay = function (e, t) {
                    return this.play(e, t)
                }, v.gotoAndStop = function (e, t) {
                    return this.pause(e, t)
                }, v.render = function (e, t, i) {
                    this._gc && this._enabled(!0, !1);
                    var r, s, n, o, l, u = this._dirty ? this.totalDuration() : this._totalDuration,
                        p = this._time,
                        f = this._startTime,
                        m = this._timeScale,
                        v = this._paused;
                    if (e >= u ? (this._totalTime = this._time = u, this._reversed || this._hasPausedChild() || (s = !0, o = "onComplete", 0 === this._duration && (0 === e || 0 > this._rawPrevTime || this._rawPrevTime === a) && this._rawPrevTime !== e && this._first && (l = !0, this._rawPrevTime > a && (o = "onReverseComplete"))), this._rawPrevTime = this._duration || !t || e || this._rawPrevTime === e ? e : a, e = u + 1e-4) : 1e-7 > e ? (this._totalTime = this._time = 0, (0 !== p || 0 === this._duration && this._rawPrevTime !== a && (this._rawPrevTime > 0 || 0 > e && this._rawPrevTime >= 0)) && (o = "onReverseComplete", s = this._reversed), 0 > e ? (this._active = !1, this._rawPrevTime >= 0 && this._first && (l = !0), this._rawPrevTime = e) : (this._rawPrevTime = this._duration || !t || e || this._rawPrevTime === e ? e : a, e = 0, this._initted || (l = !0))) : this._totalTime = this._time = this._rawPrevTime = e, this._time !== p && this._first || i || l) {
                        if (this._initted || (this._initted = !0), this._active || !this._paused && this._time !== p && e > 0 && (this._active = !0), 0 === p && this.vars.onStart && 0 !== this._time && (t || this.vars.onStart.apply(this.vars.onStartScope || this, this.vars.onStartParams || c)), this._time >= p)
                            for (r = this._first; r && (n = r._next, !this._paused || v);)(r._active || r._startTime <= this._time && !r._paused && !r._gc) && (r._reversed ? r.render((r._dirty ? r.totalDuration() : r._totalDuration) - (e - r._startTime) * r._timeScale, t, i) : r.render((e - r._startTime) * r._timeScale, t, i)), r = n;
                        else
                            for (r = this._last; r && (n = r._prev, !this._paused || v);)(r._active || p >= r._startTime && !r._paused && !r._gc) && (r._reversed ? r.render((r._dirty ? r.totalDuration() : r._totalDuration) - (e - r._startTime) * r._timeScale, t, i) : r.render((e - r._startTime) * r._timeScale, t, i)), r = n;
                        this._onUpdate && (t || (d.length && h(), this._onUpdate.apply(this.vars.onUpdateScope || this, this.vars.onUpdateParams || c))), o && (this._gc || (f === this._startTime || m !== this._timeScale) && (0 === this._time || u >= this.totalDuration()) && (s && (d.length && h(), this._timeline.autoRemoveChildren && this._enabled(!1, !1), this._active = !1), !t && this.vars[o] && this.vars[o].apply(this.vars[o + "Scope"] || this, this.vars[o + "Params"] || c)))
                    }
                }, v._hasPausedChild = function () {
                    for (var e = this._first; e;) {
                        if (e._paused || e instanceof r && e._hasPausedChild()) return !0;
                        e = e._next
                    }
                    return !1
                }, v.getChildren = function (e, t, r, a) {
                    a = a || -9999999999;
                    for (var s = [], n = this._first, o = 0; n;) a > n._startTime || (n instanceof i ? !1 !== t && (s[o++] = n) : (!1 !== r && (s[o++] = n), !1 !== e && (s = s.concat(n.getChildren(!0, t, r)), o = s.length))), n = n._next;
                    return s
                }, v.getTweensOf = function (e, t) {
                    var r, a, s = this._gc,
                        n = [],
                        o = 0;
                    for (s && this._enabled(!0, !0), a = (r = i.getTweensOf(e)).length; --a > -1;)(r[a].timeline === this || t && this._contains(r[a])) && (n[o++] = r[a]);
                    return s && this._enabled(!1, !0), n
                }, v.recent = function () {
                    return this._recent
                }, v._contains = function (e) {
                    for (var t = e.timeline; t;) {
                        if (t === this) return !0;
                        t = t.timeline
                    }
                    return !1
                }, v.shiftChildren = function (e, t, i) {
                    i = i || 0;
                    for (var r, a = this._first, s = this._labels; a;) a._startTime >= i && (a._startTime += e), a = a._next;
                    if (t)
                        for (r in s) s[r] >= i && (s[r] += e);
                    return this._uncache(!0)
                }, v._kill = function (e, t) {
                    if (!e && !t) return this._enabled(!1, !1);
                    for (var i = t ? this.getTweensOf(t) : this.getChildren(!0, !0, !1), r = i.length, a = !1; --r > -1;) i[r]._kill(e, t) && (a = !0);
                    return a
                }, v.clear = function (e) {
                    var t = this.getChildren(!1, !0, !0),
                        i = t.length;
                    for (this._time = this._totalTime = 0; --i > -1;) t[i]._enabled(!1, !1);
                    return !1 !== e && (this._labels = {}), this._uncache(!0)
                }, v.invalidate = function () {
                    for (var t = this._first; t;) t.invalidate(), t = t._next;
                    return e.prototype.invalidate.call(this)
                }, v._enabled = function (e, i) {
                    if (e === this._gc)
                        for (var r = this._first; r;) r._enabled(e, !0), r = r._next;
                    return t.prototype._enabled.call(this, e, i)
                }, v.totalTime = function () {
                    this._forcingPlayhead = !0;
                    var t = e.prototype.totalTime.apply(this, arguments);
                    return this._forcingPlayhead = !1, t
                }, v.duration = function (e) {
                    return arguments.length ? (0 !== this.duration() && 0 !== e && this.timeScale(this._duration / e), this) : (this._dirty && this.totalDuration(), this._duration)
                }, v.totalDuration = function (e) {
                    if (!arguments.length) {
                        if (this._dirty) {
                            for (var t, i, r = 0, a = this._last, s = 999999999999; a;) t = a._prev, a._dirty && a.totalDuration(), a._startTime > s && this._sortChildren && !a._paused ? this.add(a, a._startTime - a._delay) : s = a._startTime, 0 > a._startTime && !a._paused && (r -= a._startTime, this._timeline.smoothChildTiming && (this._startTime += a._startTime / this._timeScale), this.shiftChildren(-a._startTime, !1, -9999999999), s = 0), (i = a._startTime + a._totalDuration / a._timeScale) > r && (r = i), a = t;
                            this._duration = this._totalDuration = r, this._dirty = !1
                        }
                        return this._totalDuration
                    }
                    return 0 !== this.totalDuration() && 0 !== e && this.timeScale(this._totalDuration / e), this
                }, v.usesFrames = function () {
                    for (var t = this._timeline; t._timeline;) t = t._timeline;
                    return t === e._rootFramesTimeline
                }, v.rawTime = function () {
                    return this._paused ? this._totalTime : (this._timeline.rawTime() - this._startTime) * this._timeScale
                }, r
            }, !0), _gsScope._gsDefine("TimelineMax", ["TimelineLite", "TweenLite", "easing.Ease"], function (e, t, i) {
                var r = function (t) {
                        e.call(this, t), this._repeat = this.vars.repeat || 0, this._repeatDelay = this.vars.repeatDelay || 0, this._cycle = 0, this._yoyo = !0 === this.vars.yoyo, this._dirty = !0
                    },
                    a = 1e-10,
                    s = [],
                    n = t._internals,
                    o = n.lazyTweens,
                    l = n.lazyRender,
                    d = new i(null, null, 1, 0),
                    h = r.prototype = new e;
                return h.constructor = r, h.kill()._gc = !1, r.version = "1.15.1", h.invalidate = function () {
                    return this._yoyo = !0 === this.vars.yoyo, this._repeat = this.vars.repeat || 0, this._repeatDelay = this.vars.repeatDelay || 0, this._uncache(!0), e.prototype.invalidate.call(this)
                }, h.addCallback = function (e, i, r, a) {
                    return this.add(t.delayedCall(0, e, r, a), i)
                }, h.removeCallback = function (e, t) {
                    if (e)
                        if (null == t) this._kill(null, e);
                        else
                            for (var i = this.getTweensOf(e, !1), r = i.length, a = this._parseTimeOrLabel(t); --r > -1;) i[r]._startTime === a && i[r]._enabled(!1, !1);
                    return this
                }, h.removePause = function (t) {
                    return this.removeCallback(e._internals.pauseCallback, t)
                }, h.tweenTo = function (e, i) {
                    i = i || {};
                    var r, a, n, o = {
                        ease: d,
                        useFrames: this.usesFrames(),
                        immediateRender: !1
                    };
                    for (a in i) o[a] = i[a];
                    return o.time = this._parseTimeOrLabel(e), r = Math.abs(Number(o.time) - this._time) / this._timeScale || .001, n = new t(this, r, o), o.onStart = function () {
                        n.target.paused(!0), n.vars.time !== n.target.time() && r === n.duration() && n.duration(Math.abs(n.vars.time - n.target.time()) / n.target._timeScale), i.onStart && i.onStart.apply(i.onStartScope || n, i.onStartParams || s)
                    }, n
                }, h.tweenFromTo = function (e, t, i) {
                    i = i || {}, e = this._parseTimeOrLabel(e), i.startAt = {
                        onComplete: this.seek,
                        onCompleteParams: [e],
                        onCompleteScope: this
                    }, i.immediateRender = !1 !== i.immediateRender;
                    var r = this.tweenTo(t, i);
                    return r.duration(Math.abs(r.vars.time - e) / this._timeScale || .001)
                }, h.render = function (e, t, i) {
                    this._gc && this._enabled(!0, !1);
                    var r, n, d, h, c, u, p = this._dirty ? this.totalDuration() : this._totalDuration,
                        f = this._duration,
                        m = this._time,
                        v = this._totalTime,
                        g = this._startTime,
                        _ = this._timeScale,
                        y = this._rawPrevTime,
                        w = this._paused,
                        b = this._cycle;
                    if (e >= p ? (this._locked || (this._totalTime = p, this._cycle = this._repeat), this._reversed || this._hasPausedChild() || (n = !0, h = "onComplete", 0 === this._duration && (0 === e || 0 > y || y === a) && y !== e && this._first && (c = !0, y > a && (h = "onReverseComplete"))), this._rawPrevTime = this._duration || !t || e || this._rawPrevTime === e ? e : a, this._yoyo && 0 != (1 & this._cycle) ? this._time = e = 0 : (this._time = f, e = f + 1e-4)) : 1e-7 > e ? (this._locked || (this._totalTime = this._cycle = 0), this._time = 0, (0 !== m || 0 === f && y !== a && (y > 0 || 0 > e && y >= 0) && !this._locked) && (h = "onReverseComplete", n = this._reversed), 0 > e ? (this._active = !1, y >= 0 && this._first && (c = !0), this._rawPrevTime = e) : (this._rawPrevTime = f || !t || e || this._rawPrevTime === e ? e : a, e = 0, this._initted || (c = !0))) : (0 === f && 0 > y && (c = !0), this._time = this._rawPrevTime = e, this._locked || (this._totalTime = e, 0 !== this._repeat && (u = f + this._repeatDelay, this._cycle = this._totalTime / u >> 0, 0 !== this._cycle && this._cycle === this._totalTime / u && this._cycle--, this._time = this._totalTime - this._cycle * u, this._yoyo && 0 != (1 & this._cycle) && (this._time = f - this._time), this._time > f ? (this._time = f, e = f + 1e-4) : 0 > this._time ? this._time = e = 0 : e = this._time))), this._cycle !== b && !this._locked) {
                        var x = this._yoyo && 0 != (1 & b),
                            T = x === (this._yoyo && 0 != (1 & this._cycle)),
                            S = this._totalTime,
                            E = this._cycle,
                            C = this._rawPrevTime,
                            P = this._time;
                        if (this._totalTime = b * f, b > this._cycle ? x = !x : this._totalTime += f, this._time = m, this._rawPrevTime = 0 === f ? y - 1e-4 : y, this._cycle = b, this._locked = !0, m = x ? 0 : f, this.render(m, t, 0 === f), t || this._gc || this.vars.onRepeat && this.vars.onRepeat.apply(this.vars.onRepeatScope || this, this.vars.onRepeatParams || s), T && (m = x ? f + 1e-4 : -1e-4, this.render(m, !0, !1)), this._locked = !1, this._paused && !w) return;
                        this._time = P, this._totalTime = S, this._cycle = E, this._rawPrevTime = C
                    }
                    if (this._time !== m && this._first || i || c) {
                        if (this._initted || (this._initted = !0), this._active || !this._paused && this._totalTime !== v && e > 0 && (this._active = !0), 0 === v && this.vars.onStart && 0 !== this._totalTime && (t || this.vars.onStart.apply(this.vars.onStartScope || this, this.vars.onStartParams || s)), this._time >= m)
                            for (r = this._first; r && (d = r._next, !this._paused || w);)(r._active || r._startTime <= this._time && !r._paused && !r._gc) && (r._reversed ? r.render((r._dirty ? r.totalDuration() : r._totalDuration) - (e - r._startTime) * r._timeScale, t, i) : r.render((e - r._startTime) * r._timeScale, t, i)), r = d;
                        else
                            for (r = this._last; r && (d = r._prev, !this._paused || w);)(r._active || m >= r._startTime && !r._paused && !r._gc) && (r._reversed ? r.render((r._dirty ? r.totalDuration() : r._totalDuration) - (e - r._startTime) * r._timeScale, t, i) : r.render((e - r._startTime) * r._timeScale, t, i)), r = d;
                        this._onUpdate && (t || (o.length && l(), this._onUpdate.apply(this.vars.onUpdateScope || this, this.vars.onUpdateParams || s))), h && (this._locked || this._gc || (g === this._startTime || _ !== this._timeScale) && (0 === this._time || p >= this.totalDuration()) && (n && (o.length && l(), this._timeline.autoRemoveChildren && this._enabled(!1, !1), this._active = !1), !t && this.vars[h] && this.vars[h].apply(this.vars[h + "Scope"] || this, this.vars[h + "Params"] || s)))
                    } else v !== this._totalTime && this._onUpdate && (t || this._onUpdate.apply(this.vars.onUpdateScope || this, this.vars.onUpdateParams || s))
                }, h.getActive = function (e, t, i) {
                    null == e && (e = !0), null == t && (t = !0), null == i && (i = !1);
                    var r, a, s = [],
                        n = this.getChildren(e, t, i),
                        o = 0,
                        l = n.length;
                    for (r = 0; l > r; r++)(a = n[r]).isActive() && (s[o++] = a);
                    return s
                }, h.getLabelAfter = function (e) {
                    e || 0 !== e && (e = this._time);
                    var t, i = this.getLabelsArray(),
                        r = i.length;
                    for (t = 0; r > t; t++)
                        if (i[t].time > e) return i[t].name;
                    return null
                }, h.getLabelBefore = function (e) {
                    null == e && (e = this._time);
                    for (var t = this.getLabelsArray(), i = t.length; --i > -1;)
                        if (e > t[i].time) return t[i].name;
                    return null
                }, h.getLabelsArray = function () {
                    var e, t = [],
                        i = 0;
                    for (e in this._labels) t[i++] = {
                        time: this._labels[e],
                        name: e
                    };
                    return t.sort(function (e, t) {
                        return e.time - t.time
                    }), t
                }, h.progress = function (e, t) {
                    return arguments.length ? this.totalTime(this.duration() * (this._yoyo && 0 != (1 & this._cycle) ? 1 - e : e) + this._cycle * (this._duration + this._repeatDelay), t) : this._time / this.duration()
                }, h.totalProgress = function (e, t) {
                    return arguments.length ? this.totalTime(this.totalDuration() * e, t) : this._totalTime / this.totalDuration()
                }, h.totalDuration = function (t) {
                    return arguments.length ? -1 === this._repeat ? this : this.duration((t - this._repeat * this._repeatDelay) / (this._repeat + 1)) : (this._dirty && (e.prototype.totalDuration.call(this), this._totalDuration = -1 === this._repeat ? 999999999999 : this._duration * (this._repeat + 1) + this._repeatDelay * this._repeat), this._totalDuration)
                }, h.time = function (e, t) {
                    return arguments.length ? (this._dirty && this.totalDuration(), e > this._duration && (e = this._duration), this._yoyo && 0 != (1 & this._cycle) ? e = this._duration - e + this._cycle * (this._duration + this._repeatDelay) : 0 !== this._repeat && (e += this._cycle * (this._duration + this._repeatDelay)), this.totalTime(e, t)) : this._time
                }, h.repeat = function (e) {
                    return arguments.length ? (this._repeat = e, this._uncache(!0)) : this._repeat
                }, h.repeatDelay = function (e) {
                    return arguments.length ? (this._repeatDelay = e, this._uncache(!0)) : this._repeatDelay
                }, h.yoyo = function (e) {
                    return arguments.length ? (this._yoyo = e, this) : this._yoyo
                }, h.currentLabel = function (e) {
                    return arguments.length ? this.seek(e, !0) : this.getLabelBefore(this._time + 1e-8)
                }, r
            }, !0),
            function () {
                var e = 180 / Math.PI,
                    t = [],
                    i = [],
                    r = [],
                    a = {},
                    s = _gsScope._gsDefine.globals,
                    n = function (e, t, i, r) {
                        this.a = e, this.b = t, this.c = i, this.d = r, this.da = r - e, this.ca = i - e, this.ba = t - e
                    },
                    o = function (e, t, i, r) {
                        var a = {
                                a: e
                            },
                            s = {},
                            n = {},
                            o = {
                                c: r
                            },
                            l = (e + t) / 2,
                            d = (t + i) / 2,
                            h = (i + r) / 2,
                            c = (l + d) / 2,
                            u = (d + h) / 2,
                            p = (u - c) / 8;
                        return a.b = l + (e - l) / 4, s.b = c + p, a.c = s.a = (a.b + s.b) / 2, s.c = n.a = (c + u) / 2, n.b = u - p, o.b = h + (r - h) / 4, n.c = o.a = (n.b + o.b) / 2, [a, s, n, o]
                    },
                    l = function (e, a, s, n, l) {
                        var d, h, c, u, p, f, m, v, g, _, y, w, b, x = e.length - 1,
                            T = 0,
                            S = e[0].a;
                        for (d = 0; x > d; d++) p = e[T], h = p.a, c = p.d, u = e[T + 1].d, l ? (y = t[d], w = i[d], b = .25 * (w + y) * a / (n ? .5 : r[d] || .5), f = c - (c - h) * (n ? .5 * a : 0 !== y ? b / y : 0), m = c + (u - c) * (n ? .5 * a : 0 !== w ? b / w : 0), v = c - (f + ((m - f) * (3 * y / (y + w) + .5) / 4 || 0))) : (f = c - .5 * (c - h) * a, m = c + .5 * (u - c) * a, v = c - (f + m) / 2), f += v, m += v, p.c = g = f, p.b = 0 !== d ? S : S = p.a + .6 * (p.c - p.a), p.da = c - h, p.ca = g - h, p.ba = S - h, s ? (_ = o(h, S, g, c), e.splice(T, 1, _[0], _[1], _[2], _[3]), T += 4) : T++, S = m;
                        (p = e[T]).b = S, p.c = S + .4 * (p.d - S), p.da = p.d - p.a, p.ca = p.c - p.a, p.ba = S - p.a, s && (_ = o(p.a, S, p.c, p.d), e.splice(T, 1, _[0], _[1], _[2], _[3]))
                    },
                    d = function (e, r, a, s) {
                        var o, l, d, h, c, u, p = [];
                        if (s)
                            for (e = [s].concat(e), l = e.length; --l > -1;) "string" == typeof (u = e[l][r]) && "=" === u.charAt(1) && (e[l][r] = s[r] + Number(u.charAt(0) + u.substr(2)));
                        if (0 > (o = e.length - 2)) return p[0] = new n(e[0][r], 0, 0, e[-1 > o ? 0 : 1][r]), p;
                        for (l = 0; o > l; l++) d = e[l][r], h = e[l + 1][r], p[l] = new n(d, 0, 0, h), a && (c = e[l + 2][r], t[l] = (t[l] || 0) + (h - d) * (h - d), i[l] = (i[l] || 0) + (c - h) * (c - h));
                        return p[l] = new n(e[l][r], 0, 0, e[l + 1][r]), p
                    },
                    h = function (e, s, n, o, h, c) {
                        var u, p, f, m, v, g, _, y, w = {},
                            b = [],
                            x = c || e[0];
                        h = "string" == typeof h ? "," + h + "," : ",x,y,z,left,top,right,bottom,marginTop,marginLeft,marginRight,marginBottom,paddingLeft,paddingTop,paddingRight,paddingBottom,backgroundPosition,backgroundPosition_y,", null == s && (s = 1);
                        for (p in e[0]) b.push(p);
                        if (e.length > 1) {
                            for (y = e[e.length - 1], _ = !0, u = b.length; --u > -1;)
                                if (p = b[u], Math.abs(x[p] - y[p]) > .05) {
                                    _ = !1;
                                    break
                                } _ && (e = e.concat(), c && e.unshift(c), e.push(e[1]), c = e[e.length - 3])
                        }
                        for (t.length = i.length = r.length = 0, u = b.length; --u > -1;) p = b[u], a[p] = -1 !== h.indexOf("," + p + ","), w[p] = d(e, p, a[p], c);
                        for (u = t.length; --u > -1;) t[u] = Math.sqrt(t[u]), i[u] = Math.sqrt(i[u]);
                        if (!o) {
                            for (u = b.length; --u > -1;)
                                if (a[p])
                                    for (f = w[b[u]], g = f.length - 1, m = 0; g > m; m++) v = f[m + 1].da / i[m] + f[m].da / t[m], r[m] = (r[m] || 0) + v * v;
                            for (u = r.length; --u > -1;) r[u] = Math.sqrt(r[u])
                        }
                        for (u = b.length, m = n ? 4 : 1; --u > -1;) p = b[u], f = w[p], l(f, s, n, o, a[p]), _ && (f.splice(0, m), f.splice(f.length - m, m));
                        return w
                    },
                    c = function (e, t, i) {
                        var r, a, s, o, l, d, h, c, u, p, f, m = {},
                            v = "cubic" === (t = t || "soft") ? 3 : 2,
                            g = "soft" === t,
                            _ = [];
                        if (g && i && (e = [i].concat(e)), null == e || v + 1 > e.length) throw "invalid Bezier data";
                        for (u in e[0]) _.push(u);
                        for (d = _.length; --d > -1;) {
                            for (m[u = _[d]] = l = [], p = 0, c = e.length, h = 0; c > h; h++) r = null == i ? e[h][u] : "string" == typeof (f = e[h][u]) && "=" === f.charAt(1) ? i[u] + Number(f.charAt(0) + f.substr(2)) : Number(f), g && h > 1 && c - 1 > h && (l[p++] = (r + l[p - 2]) / 2), l[p++] = r;
                            for (c = p - v + 1, p = 0, h = 0; c > h; h += v) r = l[h], a = l[h + 1], s = l[h + 2], o = 2 === v ? 0 : l[h + 3], l[p++] = f = 3 === v ? new n(r, a, s, o) : new n(r, (2 * a + r) / 3, (2 * a + s) / 3, s);
                            l.length = p
                        }
                        return m
                    },
                    u = function (e, t, i) {
                        for (var r, a, s, n, o, l, d, h, c, u, p, f = 1 / i, m = e.length; --m > -1;)
                            for (u = e[m], s = u.a, n = u.d - s, o = u.c - s, l = u.b - s, r = a = 0, h = 1; i >= h; h++) d = f * h, c = 1 - d, r = a - (a = (d * d * n + 3 * c * (d * o + c * l)) * d), p = m * i + h - 1, t[p] = (t[p] || 0) + r * r
                    },
                    p = function (e, t) {
                        var i, r, a, s, n = [],
                            o = [],
                            l = 0,
                            d = 0,
                            h = (t = t >> 0 || 6) - 1,
                            c = [],
                            p = [];
                        for (i in e) u(e[i], n, t);
                        for (a = n.length, r = 0; a > r; r++) l += Math.sqrt(n[r]), s = r % t, p[s] = l, s === h && (d += l, s = r / t >> 0, c[s] = p, o[s] = d, l = 0, p = []);
                        return {
                            length: d,
                            lengths: o,
                            segments: c
                        }
                    },
                    f = _gsScope._gsDefine.plugin({
                        propName: "bezier",
                        priority: -1,
                        version: "1.3.4",
                        API: 2,
                        global: !0,
                        init: function (e, t, i) {
                            this._target = e, t instanceof Array && (t = {
                                values: t
                            }), this._func = {}, this._round = {}, this._props = [], this._timeRes = null == t.timeResolution ? 6 : parseInt(t.timeResolution, 10);
                            var r, a, s, n, o, l = t.values || [],
                                d = {},
                                u = l[0],
                                f = t.autoRotate || i.vars.orientToBezier;
                            this._autoRotate = f ? f instanceof Array ? f : [
                                ["x", "y", "rotation", !0 === f ? 0 : Number(f) || 0]
                            ] : null;
                            for (r in u) this._props.push(r);
                            for (s = this._props.length; --s > -1;) r = this._props[s], this._overwriteProps.push(r), a = this._func[r] = "function" == typeof e[r], d[r] = a ? e[r.indexOf("set") || "function" != typeof e["get" + r.substr(3)] ? r : "get" + r.substr(3)]() : parseFloat(e[r]), o || d[r] !== l[0][r] && (o = d);
                            if (this._beziers = "cubic" !== t.type && "quadratic" !== t.type && "soft" !== t.type ? h(l, isNaN(t.curviness) ? 1 : t.curviness, !1, "thruBasic" === t.type, t.correlate, o) : c(l, t.type, d), this._segCount = this._beziers[r].length, this._timeRes) {
                                var m = p(this._beziers, this._timeRes);
                                this._length = m.length, this._lengths = m.lengths, this._segments = m.segments, this._l1 = this._li = this._s1 = this._si = 0, this._l2 = this._lengths[0], this._curSeg = this._segments[0], this._s2 = this._curSeg[0], this._prec = 1 / this._curSeg.length
                            }
                            if (f = this._autoRotate)
                                for (this._initialRotations = [], f[0] instanceof Array || (this._autoRotate = f = [f]), s = f.length; --s > -1;) {
                                    for (n = 0; 3 > n; n++) r = f[s][n], this._func[r] = "function" == typeof e[r] && e[r.indexOf("set") || "function" != typeof e["get" + r.substr(3)] ? r : "get" + r.substr(3)];
                                    r = f[s][2], this._initialRotations[s] = this._func[r] ? this._func[r].call(this._target) : this._target[r]
                                }
                            return this._startRatio = i.vars.runBackwards ? 1 : 0, !0
                        },
                        set: function (t) {
                            var i, r, a, s, n, o, l, d, h, c, u = this._segCount,
                                p = this._func,
                                f = this._target,
                                m = t !== this._startRatio;
                            if (this._timeRes) {
                                if (h = this._lengths, c = this._curSeg, t *= this._length, a = this._li, t > this._l2 && u - 1 > a) {
                                    for (d = u - 1; d > a && t >= (this._l2 = h[++a]););
                                    this._l1 = h[a - 1], this._li = a, this._curSeg = c = this._segments[a], this._s2 = c[this._s1 = this._si = 0]
                                } else if (this._l1 > t && a > 0) {
                                    for (; a > 0 && (this._l1 = h[--a]) >= t;);
                                    0 === a && this._l1 > t ? this._l1 = 0 : a++, this._l2 = h[a], this._li = a, this._curSeg = c = this._segments[a], this._s1 = c[(this._si = c.length - 1) - 1] || 0, this._s2 = c[this._si]
                                }
                                if (i = a, t -= this._l1, a = this._si, t > this._s2 && c.length - 1 > a) {
                                    for (d = c.length - 1; d > a && t >= (this._s2 = c[++a]););
                                    this._s1 = c[a - 1], this._si = a
                                } else if (this._s1 > t && a > 0) {
                                    for (; a > 0 && (this._s1 = c[--a]) >= t;);
                                    0 === a && this._s1 > t ? this._s1 = 0 : a++, this._s2 = c[a], this._si = a
                                }
                                o = (a + (t - this._s1) / (this._s2 - this._s1)) * this._prec
                            } else i = 0 > t ? 0 : t >= 1 ? u - 1 : u * t >> 0, o = (t - i * (1 / u)) * u;
                            for (r = 1 - o, a = this._props.length; --a > -1;) s = this._props[a], n = this._beziers[s][i], l = (o * o * n.da + 3 * r * (o * n.ca + r * n.ba)) * o + n.a, this._round[s] && (l = Math.round(l)), p[s] ? f[s](l) : f[s] = l;
                            if (this._autoRotate) {
                                var v, g, _, y, w, b, x, T = this._autoRotate;
                                for (a = T.length; --a > -1;) s = T[a][2], b = T[a][3] || 0, x = !0 === T[a][4] ? 1 : e, n = this._beziers[T[a][0]], v = this._beziers[T[a][1]], n && v && (n = n[i], v = v[i], g = n.a + (n.b - n.a) * o, y = n.b + (n.c - n.b) * o, g += (y - g) * o, y += (n.c + (n.d - n.c) * o - y) * o, _ = v.a + (v.b - v.a) * o, w = v.b + (v.c - v.b) * o, _ += (w - _) * o, w += (v.c + (v.d - v.c) * o - w) * o, l = m ? Math.atan2(w - _, y - g) * x + b : this._initialRotations[a], p[s] ? f[s](l) : f[s] = l)
                            }
                        }
                    }),
                    m = f.prototype;
                f.bezierThrough = h, f.cubicToQuadratic = o, f._autoCSS = !0, f.quadraticToCubic = function (e, t, i) {
                    return new n(e, (2 * t + e) / 3, (2 * t + i) / 3, i)
                }, f._cssRegister = function () {
                    var e = s.CSSPlugin;
                    if (e) {
                        var t = e._internals,
                            i = t._parseToProxy,
                            r = t._setPluginRatio,
                            a = t.CSSPropTween;
                        t._registerComplexSpecialProp("bezier", {
                            parser: function (e, t, s, n, o, l) {
                                t instanceof Array && (t = {
                                    values: t
                                }), l = new f;
                                var d, h, c, u = t.values,
                                    p = u.length - 1,
                                    m = [],
                                    v = {};
                                if (0 > p) return o;
                                for (d = 0; p >= d; d++) c = i(e, u[d], n, o, l, p !== d), m[d] = c.end;
                                for (h in t) v[h] = t[h];
                                return v.values = m, o = new a(e, "bezier", 0, 0, c.pt, 2), o.data = c, o.plugin = l, o.setRatio = r, 0 === v.autoRotate && (v.autoRotate = !0), !v.autoRotate || v.autoRotate instanceof Array || (d = !0 === v.autoRotate ? 0 : Number(v.autoRotate), v.autoRotate = null != c.end.left ? [
                                    ["left", "top", "rotation", d, !1]
                                ] : null != c.end.x && [
                                    ["x", "y", "rotation", d, !1]
                                ]), v.autoRotate && (n._transform || n._enableTransforms(!1), c.autoRotate = n._target._gsTransform), l._onInitTween(c.proxy, v, n._tween), o
                            }
                        })
                    }
                }, m._roundProps = function (e, t) {
                    for (var i = this._overwriteProps, r = i.length; --r > -1;)(e[i[r]] || e.bezier || e.bezierThrough) && (this._round[i[r]] = t)
                }, m._kill = function (e) {
                    var t, i, r = this._props;
                    for (t in this._beziers)
                        if (t in e)
                            for (delete this._beziers[t], delete this._func[t], i = r.length; --i > -1;) r[i] === t && r.splice(i, 1);
                    return this._super._kill.call(this, e)
                }
            }(), _gsScope._gsDefine("plugins.CSSPlugin", ["plugins.TweenPlugin", "TweenLite"], function (e, t) {
                var i, r, a, s, n = function () {
                        e.call(this, "css"), this._overwriteProps.length = 0, this.setRatio = n.prototype.setRatio
                    },
                    o = _gsScope._gsDefine.globals,
                    l = {},
                    d = n.prototype = new e("css");
                d.constructor = n, n.version = "1.15.1", n.API = 2, n.defaultTransformPerspective = 0, n.defaultSkewType = "compensated", d = "px", n.suffixMap = {
                    top: d,
                    right: d,
                    bottom: d,
                    left: d,
                    width: d,
                    height: d,
                    fontSize: d,
                    padding: d,
                    margin: d,
                    perspective: d,
                    lineHeight: ""
                };
                var h, c, u, p, f, m, v = /(?:\d|\-\d|\.\d|\-\.\d)+/g,
                    g = /(?:\d|\-\d|\.\d|\-\.\d|\+=\d|\-=\d|\+=.\d|\-=\.\d)+/g,
                    _ = /(?:\+=|\-=|\-|\b)[\d\-\.]+[a-zA-Z0-9]*(?:%|\b)/gi,
                    y = /(?![+-]?\d*\.?\d+|[+-]|e[+-]\d+)[^0-9]/g,
                    w = /(?:\d|\-|\+|=|#|\.)*/g,
                    b = /opacity *= *([^)]*)/i,
                    x = /opacity:([^;]*)/i,
                    T = /alpha\(opacity *=.+?\)/i,
                    S = /^(rgb|hsl)/,
                    E = /([A-Z])/g,
                    C = /-([a-z])/gi,
                    P = /(^(?:url\(\"|url\())|(?:(\"\))$|\)$)/gi,
                    M = function (e, t) {
                        return t.toUpperCase()
                    },
                    k = /(?:Left|Right|Width)/i,
                    z = /(M11|M12|M21|M22)=[\d\-\.e]+/gi,
                    R = /progid\:DXImageTransform\.Microsoft\.Matrix\(.+?\)/i,
                    O = /,(?=[^\)]*(?:\(|$))/gi,
                    A = Math.PI / 180,
                    D = 180 / Math.PI,
                    I = {},
                    L = document,
                    N = function (e) {
                        return L.createElementNS ? L.createElementNS("http://www.w3.org/1999/xhtml", e) : L.createElement(e)
                    },
                    $ = N("div"),
                    F = N("img"),
                    X = n._internals = {
                        _specialProps: l
                    },
                    Y = navigator.userAgent,
                    B = function () {
                        var e = Y.indexOf("Android"),
                            t = N("a");
                        return u = -1 !== Y.indexOf("Safari") && -1 === Y.indexOf("Chrome") && (-1 === e || Number(Y.substr(e + 8, 1)) > 3), f = u && 6 > Number(Y.substr(Y.indexOf("Version/") + 8, 1)), p = -1 !== Y.indexOf("Firefox"), (/MSIE ([0-9]{1,}[\.0-9]{0,})/.exec(Y) || /Trident\/.*rv:([0-9]{1,}[\.0-9]{0,})/.exec(Y)) && (m = parseFloat(RegExp.$1)), !!t && (t.style.cssText = "top:1px;opacity:.55;", /^0.55/.test(t.style.opacity))
                    }(),
                    G = function (e) {
                        return b.test("string" == typeof e ? e : (e.currentStyle ? e.currentStyle.filter : e.style.filter) || "") ? parseFloat(RegExp.$1) / 100 : 1
                    },
                    H = function (e) {
                        window.console && console.log(e)
                    },
                    V = "",
                    j = "",
                    W = function (e, t) {
                        var i, r, a = (t = t || $).style;
                        if (void 0 !== a[e]) return e;
                        for (e = e.charAt(0).toUpperCase() + e.substr(1), i = ["O", "Moz", "ms", "Ms", "Webkit"], r = 5; --r > -1 && void 0 === a[i[r] + e];);
                        return r >= 0 ? (j = 3 === r ? "ms" : i[r], V = "-" + j.toLowerCase() + "-", j + e) : null
                    },
                    U = L.defaultView ? L.defaultView.getComputedStyle : function () {},
                    q = n.getStyle = function (e, t, i, r, a) {
                        var s;
                        return B || "opacity" !== t ? (!r && e.style[t] ? s = e.style[t] : (i = i || U(e)) ? s = i[t] || i.getPropertyValue(t) || i.getPropertyValue(t.replace(E, "-$1").toLowerCase()) : e.currentStyle && (s = e.currentStyle[t]), null == a || s && "none" !== s && "auto" !== s && "auto auto" !== s ? s : a) : G(e)
                    },
                    Z = X.convertToPixels = function (e, i, r, a, s) {
                        if ("px" === a || !a) return r;
                        if ("auto" === a || !r) return 0;
                        var o, l, d, h = k.test(i),
                            c = e,
                            u = $.style,
                            p = 0 > r;
                        if (p && (r = -r), "%" === a && -1 !== i.indexOf("border")) o = r / 100 * (h ? e.clientWidth : e.clientHeight);
                        else {
                            if (u.cssText = "border:0 solid red;position:" + q(e, "position") + ";line-height:0;", "%" !== a && c.appendChild) u[h ? "borderLeftWidth" : "borderTopWidth"] = r + a;
                            else {
                                if (c = e.parentNode || L.body, l = c._gsCache, d = t.ticker.frame, l && h && l.time === d) return l.width * r / 100;
                                u[h ? "width" : "height"] = r + a
                            }
                            c.appendChild($), o = parseFloat($[h ? "offsetWidth" : "offsetHeight"]), c.removeChild($), h && "%" === a && !1 !== n.cacheWidths && (l = c._gsCache = c._gsCache || {}, l.time = d, l.width = o / r * 100), 0 !== o || s || (o = Z(e, i, r, a, !0))
                        }
                        return p ? -o : o
                    },
                    K = X.calculateOffset = function (e, t, i) {
                        if ("absolute" !== q(e, "position", i)) return 0;
                        var r = "left" === t ? "Left" : "Top",
                            a = q(e, "margin" + r, i);
                        return e["offset" + r] - (Z(e, t, parseFloat(a), a.replace(w, "")) || 0)
                    },
                    Q = function (e, t) {
                        var i, r, a = {};
                        if (t = t || U(e, null))
                            for (i in t)(-1 === i.indexOf("Transform") || be === i) && (a[i] = t[i]);
                        else if (t = e.currentStyle || e.style)
                            for (i in t) "string" == typeof i && void 0 === a[i] && (a[i.replace(C, M)] = t[i]);
                        return B || (a.opacity = G(e)), r = Re(e, t, !1), a.rotation = r.rotation, a.skewX = r.skewX, a.scaleX = r.scaleX, a.scaleY = r.scaleY, a.x = r.x, a.y = r.y, Se && (a.z = r.z, a.rotationX = r.rotationX, a.rotationY = r.rotationY, a.scaleZ = r.scaleZ), a.filters && delete a.filters, a
                    },
                    J = function (e, t, i, r, a) {
                        var s, n, o, l = {},
                            d = e.style;
                        for (n in i) "cssText" !== n && "length" !== n && isNaN(n) && (t[n] !== (s = i[n]) || a && a[n]) && -1 === n.indexOf("Origin") && ("number" == typeof s || "string" == typeof s) && (l[n] = "auto" !== s || "left" !== n && "top" !== n ? "" !== s && "auto" !== s && "none" !== s || "string" != typeof t[n] || "" === t[n].replace(y, "") ? s : 0 : K(e, n), void 0 !== d[n] && (o = new pe(d, n, d[n], o)));
                        if (r)
                            for (n in r) "className" !== n && (l[n] = r[n]);
                        return {
                            difs: l,
                            firstMPT: o
                        }
                    },
                    ee = {
                        width: ["Left", "Right"],
                        height: ["Top", "Bottom"]
                    },
                    te = ["marginLeft", "marginRight", "marginTop", "marginBottom"],
                    ie = function (e, t, i) {
                        var r = parseFloat("width" === t ? e.offsetWidth : e.offsetHeight),
                            a = ee[t],
                            s = a.length;
                        for (i = i || U(e, null); --s > -1;) r -= parseFloat(q(e, "padding" + a[s], i, !0)) || 0, r -= parseFloat(q(e, "border" + a[s] + "Width", i, !0)) || 0;
                        return r
                    },
                    re = function (e, t) {
                        (null == e || "" === e || "auto" === e || "auto auto" === e) && (e = "0 0");
                        var i = e.split(" "),
                            r = -1 !== e.indexOf("left") ? "0%" : -1 !== e.indexOf("right") ? "100%" : i[0],
                            a = -1 !== e.indexOf("top") ? "0%" : -1 !== e.indexOf("bottom") ? "100%" : i[1];
                        return null == a ? a = "center" === r ? "50%" : "0" : "center" === a && (a = "50%"), ("center" === r || isNaN(parseFloat(r)) && -1 === (r + "").indexOf("=")) && (r = "50%"), t && (t.oxp = -1 !== r.indexOf("%"), t.oyp = -1 !== a.indexOf("%"), t.oxr = "=" === r.charAt(1), t.oyr = "=" === a.charAt(1), t.ox = parseFloat(r.replace(y, "")), t.oy = parseFloat(a.replace(y, ""))), r + " " + a + (i.length > 2 ? " " + i[2] : "")
                    },
                    ae = function (e, t) {
                        return "string" == typeof e && "=" === e.charAt(1) ? parseInt(e.charAt(0) + "1", 10) * parseFloat(e.substr(2)) : parseFloat(e) - parseFloat(t)
                    },
                    se = function (e, t) {
                        return null == e ? t : "string" == typeof e && "=" === e.charAt(1) ? parseInt(e.charAt(0) + "1", 10) * parseFloat(e.substr(2)) + t : parseFloat(e)
                    },
                    ne = function (e, t, i, r) {
                        var a, s, n, o, l;
                        return null == e ? o = t : "number" == typeof e ? o = e : (a = 360, s = e.split("_"), l = "=" === e.charAt(1), n = (l ? parseInt(e.charAt(0) + "1", 10) * parseFloat(s[0].substr(2)) : parseFloat(s[0])) * (-1 === e.indexOf("rad") ? 1 : D) - (l ? 0 : t), s.length && (r && (r[i] = t + n), -1 !== e.indexOf("short") && (n %= a) != n % (a / 2) && (n = 0 > n ? n + a : n - a), -1 !== e.indexOf("_cw") && 0 > n ? n = (n + 9999999999 * a) % a - (0 | n / a) * a : -1 !== e.indexOf("ccw") && n > 0 && (n = (n - 9999999999 * a) % a - (0 | n / a) * a)), o = t + n), 1e-6 > o && o > -1e-6 && (o = 0), o
                    },
                    oe = {
                        aqua: [0, 255, 255],
                        lime: [0, 255, 0],
                        silver: [192, 192, 192],
                        black: [0, 0, 0],
                        maroon: [128, 0, 0],
                        teal: [0, 128, 128],
                        blue: [0, 0, 255],
                        navy: [0, 0, 128],
                        white: [255, 255, 255],
                        fuchsia: [255, 0, 255],
                        olive: [128, 128, 0],
                        yellow: [255, 255, 0],
                        orange: [255, 165, 0],
                        gray: [128, 128, 128],
                        purple: [128, 0, 128],
                        green: [0, 128, 0],
                        red: [255, 0, 0],
                        pink: [255, 192, 203],
                        cyan: [0, 255, 255],
                        transparent: [255, 255, 255, 0]
                    },
                    le = function (e, t, i) {
                        return e = 0 > e ? e + 1 : e > 1 ? e - 1 : e, 0 | 255 * (1 > 6 * e ? t + 6 * (i - t) * e : .5 > e ? i : 2 > 3 * e ? t + 6 * (i - t) * (2 / 3 - e) : t) + .5
                    },
                    de = n.parseColor = function (e) {
                        var t, i, r, a, s, n;
                        return e && "" !== e ? "number" == typeof e ? [e >> 16, 255 & e >> 8, 255 & e] : ("," === e.charAt(e.length - 1) && (e = e.substr(0, e.length - 1)), oe[e] ? oe[e] : "#" === e.charAt(0) ? (4 === e.length && (t = e.charAt(1), i = e.charAt(2), r = e.charAt(3), e = "#" + t + t + i + i + r + r), e = parseInt(e.substr(1), 16), [e >> 16, 255 & e >> 8, 255 & e]) : "hsl" === e.substr(0, 3) ? (e = e.match(v), a = Number(e[0]) % 360 / 360, s = Number(e[1]) / 100, n = Number(e[2]) / 100, i = .5 >= n ? n * (s + 1) : n + s - n * s, t = 2 * n - i, e.length > 3 && (e[3] = Number(e[3])), e[0] = le(a + 1 / 3, t, i), e[1] = le(a, t, i), e[2] = le(a - 1 / 3, t, i), e) : (e = e.match(v) || oe.transparent, e[0] = Number(e[0]), e[1] = Number(e[1]), e[2] = Number(e[2]), e.length > 3 && (e[3] = Number(e[3])), e)) : oe.black
                    },
                    he = "(?:\\b(?:(?:rgb|rgba|hsl|hsla)\\(.+?\\))|\\B#.+?\\b";
                for (d in oe) he += "|" + d + "\\b";
                he = RegExp(he + ")", "gi");
                var ce = function (e, t, i, r) {
                        if (null == e) return function (e) {
                            return e
                        };
                        var a, s = t ? (e.match(he) || [""])[0] : "",
                            n = e.split(s).join("").match(_) || [],
                            o = e.substr(0, e.indexOf(n[0])),
                            l = ")" === e.charAt(e.length - 1) ? ")" : "",
                            d = -1 !== e.indexOf(" ") ? " " : ",",
                            h = n.length,
                            c = h > 0 ? n[0].replace(v, "") : "";
                        return h ? a = t ? function (e) {
                            var t, u, p, f;
                            if ("number" == typeof e) e += c;
                            else if (r && O.test(e)) {
                                for (f = e.replace(O, "|").split("|"), p = 0; f.length > p; p++) f[p] = a(f[p]);
                                return f.join(",")
                            }
                            if (t = (e.match(he) || [s])[0], u = e.split(t).join("").match(_) || [], p = u.length, h > p--)
                                for (; h > ++p;) u[p] = i ? u[0 | (p - 1) / 2] : n[p];
                            return o + u.join(d) + d + t + l + (-1 !== e.indexOf("inset") ? " inset" : "")
                        } : function (e) {
                            var t, s, u;
                            if ("number" == typeof e) e += c;
                            else if (r && O.test(e)) {
                                for (s = e.replace(O, "|").split("|"), u = 0; s.length > u; u++) s[u] = a(s[u]);
                                return s.join(",")
                            }
                            if (t = e.match(_) || [], u = t.length, h > u--)
                                for (; h > ++u;) t[u] = i ? t[0 | (u - 1) / 2] : n[u];
                            return o + t.join(d) + l
                        } : function (e) {
                            return e
                        }
                    },
                    ue = function (e) {
                        return e = e.split(","),
                            function (t, i, r, a, s, n, o) {
                                var l, d = (i + "").split(" ");
                                for (o = {}, l = 0; 4 > l; l++) o[e[l]] = d[l] = d[l] || d[(l - 1) / 2 >> 0];
                                return a.parse(t, o, s, n)
                            }
                    },
                    pe = (X._setPluginRatio = function (e) {
                        this.plugin.setRatio(e);
                        for (var t, i, r, a, s = this.data, n = s.proxy, o = s.firstMPT; o;) t = n[o.v], o.r ? t = Math.round(t) : 1e-6 > t && t > -1e-6 && (t = 0), o.t[o.p] = t, o = o._next;
                        if (s.autoRotate && (s.autoRotate.rotation = n.rotation), 1 === e)
                            for (o = s.firstMPT; o;) {
                                if ((i = o.t).type) {
                                    if (1 === i.type) {
                                        for (a = i.xs0 + i.s + i.xs1, r = 1; i.l > r; r++) a += i["xn" + r] + i["xs" + (r + 1)];
                                        i.e = a
                                    }
                                } else i.e = i.s + i.xs0;
                                o = o._next
                            }
                    }, function (e, t, i, r, a) {
                        this.t = e, this.p = t, this.v = i, this.r = a, r && (r._prev = this, this._next = r)
                    }),
                    fe = (X._parseToProxy = function (e, t, i, r, a, s) {
                        var n, o, l, d, h, c = r,
                            u = {},
                            p = {},
                            f = i._transform,
                            m = I;
                        for (i._transform = null, I = t, r = h = i.parse(e, t, r, a), I = m, s && (i._transform = f, c && (c._prev = null, c._prev && (c._prev._next = null))); r && r !== c;) {
                            if (1 >= r.type && (o = r.p, p[o] = r.s + r.c, u[o] = r.s, s || (d = new pe(r, "s", o, d, r.r), r.c = 0), 1 === r.type))
                                for (n = r.l; --n > 0;) l = "xn" + n, o = r.p + "_" + l, p[o] = r.data[l], u[o] = r[l], s || (d = new pe(r, l, o, d, r.rxp[l]));
                            r = r._next
                        }
                        return {
                            proxy: u,
                            end: p,
                            firstMPT: d,
                            pt: h
                        }
                    }, X.CSSPropTween = function (e, t, r, a, n, o, l, d, h, c, u) {
                        this.t = e, this.p = t, this.s = r, this.c = a, this.n = l || t, e instanceof fe || s.push(this.n), this.r = d, this.type = o || 0, h && (this.pr = h, i = !0), this.b = void 0 === c ? r : c, this.e = void 0 === u ? r + a : u, n && (this._next = n, n._prev = this)
                    }),
                    me = n.parseComplex = function (e, t, i, r, a, s, n, o, l, d) {
                        i = i || s || "", n = new fe(e, t, 0, 0, n, d ? 2 : 1, null, !1, o, i, r), r += "";
                        var c, u, p, f, m, _, y, w, b, x, T, E, C = i.split(", ").join(",").split(" "),
                            P = r.split(", ").join(",").split(" "),
                            M = C.length,
                            k = !1 !== h;
                        for ((-1 !== r.indexOf(",") || -1 !== i.indexOf(",")) && (C = C.join(" ").replace(O, ", ").split(" "), P = P.join(" ").replace(O, ", ").split(" "), M = C.length), M !== P.length && (C = (s || "").split(" "), M = C.length), n.plugin = l, n.setRatio = d, c = 0; M > c; c++)
                            if (f = C[c], m = P[c], (w = parseFloat(f)) || 0 === w) n.appendXtra("", w, ae(m, w), m.replace(g, ""), k && -1 !== m.indexOf("px"), !0);
                            else if (a && ("#" === f.charAt(0) || oe[f] || S.test(f))) E = "," === m.charAt(m.length - 1) ? ")," : ")", f = de(f), m = de(m), b = f.length + m.length > 6, b && !B && 0 === m[3] ? (n["xs" + n.l] += n.l ? " transparent" : "transparent", n.e = n.e.split(P[c]).join("transparent")) : (B || (b = !1), n.appendXtra(b ? "rgba(" : "rgb(", f[0], m[0] - f[0], ",", !0, !0).appendXtra("", f[1], m[1] - f[1], ",", !0).appendXtra("", f[2], m[2] - f[2], b ? "," : E, !0), b && (f = 4 > f.length ? 1 : f[3], n.appendXtra("", f, (4 > m.length ? 1 : m[3]) - f, E, !1)));
                        else if (_ = f.match(v)) {
                            if (!(y = m.match(g)) || y.length !== _.length) return n;
                            for (p = 0, u = 0; _.length > u; u++) T = _[u], x = f.indexOf(T, p), n.appendXtra(f.substr(p, x - p), Number(T), ae(y[u], T), "", k && "px" === f.substr(x + T.length, 2), 0 === u), p = x + T.length;
                            n["xs" + n.l] += f.substr(p)
                        } else n["xs" + n.l] += n.l ? " " + f : f;
                        if (-1 !== r.indexOf("=") && n.data) {
                            for (E = n.xs0 + n.data.s, c = 1; n.l > c; c++) E += n["xs" + c] + n.data["xn" + c];
                            n.e = E + n["xs" + c]
                        }
                        return n.l || (n.type = -1, n.xs0 = n.e), n.xfirst || n
                    },
                    ve = 9;
                for ((d = fe.prototype).l = d.pr = 0; --ve > 0;) d["xn" + ve] = 0, d["xs" + ve] = "";
                d.xs0 = "", d._next = d._prev = d.xfirst = d.data = d.plugin = d.setRatio = d.rxp = null, d.appendXtra = function (e, t, i, r, a, s) {
                    var n = this,
                        o = n.l;
                    return n["xs" + o] += s && o ? " " + e : e || "", i || 0 === o || n.plugin ? (n.l++, n.type = n.setRatio ? 2 : 1, n["xs" + n.l] = r || "", o > 0 ? (n.data["xn" + o] = t + i, n.rxp["xn" + o] = a, n["xn" + o] = t, n.plugin || (n.xfirst = new fe(n, "xn" + o, t, i, n.xfirst || n, 0, n.n, a, n.pr), n.xfirst.xs0 = 0), n) : (n.data = {
                        s: t + i
                    }, n.rxp = {}, n.s = t, n.c = i, n.r = a, n)) : (n["xs" + o] += t + (r || ""), n)
                };
                var ge = function (e, t) {
                        t = t || {}, this.p = t.prefix ? W(e) || e : e, l[e] = l[this.p] = this, this.format = t.formatter || ce(t.defaultValue, t.color, t.collapsible, t.multi), t.parser && (this.parse = t.parser), this.clrs = t.color, this.multi = t.multi, this.keyword = t.keyword, this.dflt = t.defaultValue, this.pr = t.priority || 0
                    },
                    _e = X._registerComplexSpecialProp = function (e, t, i) {
                        "object" != typeof t && (t = {
                            parser: i
                        });
                        var r, a = e.split(","),
                            s = t.defaultValue;
                        for (i = i || [s], r = 0; a.length > r; r++) t.prefix = 0 === r && t.prefix, t.defaultValue = i[r] || s, new ge(a[r], t)
                    };
                (d = ge.prototype).parseComplex = function (e, t, i, r, a, s) {
                    var n, o, l, d, h, c, u = this.keyword;
                    if (this.multi && (O.test(i) || O.test(t) ? (o = t.replace(O, "|").split("|"), l = i.replace(O, "|").split("|")) : u && (o = [t], l = [i])), l) {
                        for (d = l.length > o.length ? l.length : o.length, n = 0; d > n; n++) t = o[n] = o[n] || this.dflt, i = l[n] = l[n] || this.dflt, u && (h = t.indexOf(u), c = i.indexOf(u), h !== c && (i = -1 === c ? l : o, i[n] += " " + u));
                        t = o.join(", "), i = l.join(", ")
                    }
                    return me(e, this.p, t, i, this.clrs, this.dflt, r, this.pr, a, s)
                }, d.parse = function (e, t, i, r, s, n) {
                    return this.parseComplex(e.style, this.format(q(e, this.p, a, !1, this.dflt)), this.format(t), s, n)
                }, n.registerSpecialProp = function (e, t, i) {
                    _e(e, {
                        parser: function (e, r, a, s, n, o) {
                            var l = new fe(e, a, 0, 0, n, 2, a, !1, i);
                            return l.plugin = o, l.setRatio = t(e, r, s._tween, a), l
                        },
                        priority: i
                    })
                };
                var ye, we = "scaleX,scaleY,scaleZ,x,y,z,skewX,skewY,rotation,rotationX,rotationY,perspective,xPercent,yPercent".split(","),
                    be = W("transform"),
                    xe = V + "transform",
                    Te = W("transformOrigin"),
                    Se = null !== W("perspective"),
                    Ee = X.Transform = function () {
                        this.perspective = parseFloat(n.defaultTransformPerspective) || 0, this.force3D = !(!1 === n.defaultForce3D || !Se) && (n.defaultForce3D || "auto")
                    },
                    Ce = window.SVGElement,
                    Pe = function (e, t, i) {
                        var r, a = L.createElementNS("http://www.w3.org/2000/svg", e),
                            s = /([a-z])([A-Z])/g;
                        for (r in i) a.setAttributeNS(null, r.replace(s, "$1-$2").toLowerCase(), i[r]);
                        return t.appendChild(a), a
                    },
                    Me = document.documentElement,
                    ke = function () {
                        var e, t, i, r = m || /Android/i.test(Y) && !window.chrome;
                        return L.createElementNS && !r && (e = Pe("svg", Me), t = Pe("rect", e, {
                            width: 100,
                            height: 50,
                            x: 100
                        }), i = t.getBoundingClientRect().width, t.style[Te] = "50% 50%", t.style[be] = "scaleX(0.5)", r = i === t.getBoundingClientRect().width && !(p && Se), Me.removeChild(e)), r
                    }(),
                    ze = function (e, t, i) {
                        var r = e.getBBox();
                        t = re(t).split(" "), i.xOrigin = (-1 !== t[0].indexOf("%") ? parseFloat(t[0]) / 100 * r.width : parseFloat(t[0])) + r.x, i.yOrigin = (-1 !== t[1].indexOf("%") ? parseFloat(t[1]) / 100 * r.height : parseFloat(t[1])) + r.y
                    },
                    Re = X.getTransform = function (e, t, i, r) {
                        if (e._gsTransform && i && !r) return e._gsTransform;
                        var s, o, l, d, h, c, u, p, f, m, v = i ? e._gsTransform || new Ee : new Ee,
                            g = 0 > v.scaleX,
                            _ = 1e5,
                            y = Se ? parseFloat(q(e, Te, t, !1, "0 0 0").split(" ")[2]) || v.zOrigin || 0 : 0,
                            w = parseFloat(n.defaultTransformPerspective) || 0;
                        if (be ? o = q(e, xe, t, !0) : e.currentStyle && (o = e.currentStyle.filter.match(z), o = o && 4 === o.length ? [o[0].substr(4), Number(o[2].substr(4)), Number(o[1].substr(4)), o[3].substr(4), v.x || 0, v.y || 0].join(",") : ""), s = !o || "none" === o || "matrix(1, 0, 0, 1, 0, 0)" === o, v.svg = !!(Ce && "function" == typeof e.getBBox && e.getCTM && (!e.parentNode || e.parentNode.getBBox && e.parentNode.getCTM)), v.svg && (ze(e, q(e, Te, a, !1, "50% 50%") + "", v), ye = n.useSVGTransformAttr || ke, l = e.getAttribute("transform"), s && l && -1 !== l.indexOf("matrix") && (o = l, s = 0)), !s) {
                            for (d = (l = (o || "").match(/(?:\-|\b)[\d\-\.e]+\b/gi) || []).length; --d > -1;) h = Number(l[d]), l[d] = (c = h - (h |= 0)) ? (0 | c * _ + (0 > c ? -.5 : .5)) / _ + h : h;
                            if (16 === l.length) {
                                var b, x, T, S, E, C = l[0],
                                    P = l[1],
                                    M = l[2],
                                    k = l[3],
                                    R = l[4],
                                    O = l[5],
                                    A = l[6],
                                    I = l[7],
                                    L = l[8],
                                    N = l[9],
                                    $ = l[10],
                                    F = l[12],
                                    X = l[13],
                                    Y = l[14],
                                    B = l[11],
                                    G = Math.atan2(A, $);
                                v.zOrigin && (Y = -v.zOrigin, F = L * Y - l[12], X = N * Y - l[13], Y = $ * Y + v.zOrigin - l[14]), v.rotationX = G * D, G && (S = Math.cos(-G), E = Math.sin(-G), b = R * S + L * E, x = O * S + N * E, T = A * S + $ * E, L = R * -E + L * S, N = O * -E + N * S, $ = A * -E + $ * S, B = I * -E + B * S, R = b, O = x, A = T), G = Math.atan2(L, $), v.rotationY = G * D, G && (S = Math.cos(-G), E = Math.sin(-G), b = C * S - L * E, x = P * S - N * E, T = M * S - $ * E, N = P * E + N * S, $ = M * E + $ * S, B = k * E + B * S, C = b, P = x, M = T), G = Math.atan2(P, C), v.rotation = G * D, G && (S = Math.cos(-G), E = Math.sin(-G), C = C * S + R * E, x = P * S + O * E, O = P * -E + O * S, A = M * -E + A * S, P = x), v.rotationX && Math.abs(v.rotationX) + Math.abs(v.rotation) > 359.9 && (v.rotationX = v.rotation = 0, v.rotationY += 180), v.scaleX = (0 | Math.sqrt(C * C + P * P) * _ + .5) / _, v.scaleY = (0 | Math.sqrt(O * O + N * N) * _ + .5) / _, v.scaleZ = (0 | Math.sqrt(A * A + $ * $) * _ + .5) / _, v.skewX = 0, v.perspective = B ? 1 / (0 > B ? -B : B) : 0, v.x = F, v.y = X, v.z = Y
                            } else if (!(Se && !r && l.length && v.x === l[4] && v.y === l[5] && (v.rotationX || v.rotationY) || void 0 !== v.x && "none" === q(e, "display", t))) {
                                var H = l.length >= 6,
                                    V = H ? l[0] : 1,
                                    j = l[1] || 0,
                                    W = l[2] || 0,
                                    U = H ? l[3] : 1;
                                v.x = l[4] || 0, v.y = l[5] || 0, u = Math.sqrt(V * V + j * j), p = Math.sqrt(U * U + W * W), f = V || j ? Math.atan2(j, V) * D : v.rotation || 0, m = W || U ? Math.atan2(W, U) * D + f : v.skewX || 0, Math.abs(m) > 90 && 270 > Math.abs(m) && (g ? (u *= -1, m += 0 >= f ? 180 : -180, f += 0 >= f ? 180 : -180) : (p *= -1, m += 0 >= m ? 180 : -180)), v.scaleX = u, v.scaleY = p, v.rotation = f, v.skewX = m, Se && (v.rotationX = v.rotationY = v.z = 0, v.perspective = w, v.scaleZ = 1)
                            }
                            v.zOrigin = y;
                            for (d in v) 2e-5 > v[d] && v[d] > -2e-5 && (v[d] = 0)
                        }
                        return i && (e._gsTransform = v), v
                    },
                    Oe = function (e) {
                        var t, i, r = this.data,
                            a = -r.rotation * A,
                            s = a + r.skewX * A,
                            n = 1e5,
                            o = (0 | Math.cos(a) * r.scaleX * n) / n,
                            l = (0 | Math.sin(a) * r.scaleX * n) / n,
                            d = (0 | Math.sin(s) * -r.scaleY * n) / n,
                            h = (0 | Math.cos(s) * r.scaleY * n) / n,
                            c = this.t.style,
                            u = this.t.currentStyle;
                        if (u) {
                            i = l, l = -d, d = -i, t = u.filter, c.filter = "";
                            var p, f, v = this.t.offsetWidth,
                                g = this.t.offsetHeight,
                                _ = "absolute" !== u.position,
                                y = "progid:DXImageTransform.Microsoft.Matrix(M11=" + o + ", M12=" + l + ", M21=" + d + ", M22=" + h,
                                x = r.x + v * r.xPercent / 100,
                                T = r.y + g * r.yPercent / 100;
                            if (null != r.ox && (p = (r.oxp ? .01 * v * r.ox : r.ox) - v / 2, f = (r.oyp ? .01 * g * r.oy : r.oy) - g / 2, x += p - (p * o + f * l), T += f - (p * d + f * h)), _ ? (p = v / 2, f = g / 2, y += ", Dx=" + (p - (p * o + f * l) + x) + ", Dy=" + (f - (p * d + f * h) + T) + ")") : y += ", sizingMethod='auto expand')", c.filter = -1 !== t.indexOf("DXImageTransform.Microsoft.Matrix(") ? t.replace(R, y) : y + " " + t, (0 === e || 1 === e) && 1 === o && 0 === l && 0 === d && 1 === h && (_ && -1 === y.indexOf("Dx=0, Dy=0") || b.test(t) && 100 !== parseFloat(RegExp.$1) || -1 === t.indexOf(t.indexOf("Alpha")) && c.removeAttribute("filter")), !_) {
                                var S, E, C, P = 8 > m ? 1 : -1;
                                for (p = r.ieOffsetX || 0, f = r.ieOffsetY || 0, r.ieOffsetX = Math.round((v - ((0 > o ? -o : o) * v + (0 > l ? -l : l) * g)) / 2 + x), r.ieOffsetY = Math.round((g - ((0 > h ? -h : h) * g + (0 > d ? -d : d) * v)) / 2 + T), ve = 0; 4 > ve; ve++) E = te[ve], S = u[E], i = -1 !== S.indexOf("px") ? parseFloat(S) : Z(this.t, E, parseFloat(S), S.replace(w, "")) || 0, C = i !== r[E] ? 2 > ve ? -r.ieOffsetX : -r.ieOffsetY : 2 > ve ? p - r.ieOffsetX : f - r.ieOffsetY, c[E] = (r[E] = Math.round(i - C * (0 === ve || 2 === ve ? 1 : P))) + "px"
                            }
                        }
                    },
                    Ae = X.set3DTransformRatio = function (e) {
                        var t, i, r, a, s, n, o, l, d, h, c, u, f, m, v, g, _, y, w, b, x, T = this.data,
                            S = this.t.style,
                            E = T.rotation * A,
                            C = T.scaleX,
                            P = T.scaleY,
                            M = T.scaleZ,
                            k = T.x,
                            z = T.y,
                            R = T.z,
                            O = T.perspective;
                        if (1 !== e && 0 !== e && T.force3D || !0 === T.force3D || T.rotationY || T.rotationX || 1 !== M || O || R) {
                            if (p && ((m = 1e-4) > C && C > -m && (C = M = 2e-5), m > P && P > -m && (P = M = 2e-5), !O || T.z || T.rotationX || T.rotationY || (O = 0)), E || T.skewX) v = t = Math.cos(E), g = a = Math.sin(E), T.skewX && (E -= T.skewX * A, v = Math.cos(E), g = Math.sin(E), "simple" === T.skewType && (_ = Math.tan(T.skewX * A), _ = Math.sqrt(1 + _ * _), v *= _, g *= _)), i = -g, s = v;
                            else {
                                if (!(T.rotationY || T.rotationX || 1 !== M || O || T.svg)) return void(S[be] = (T.xPercent || T.yPercent ? "translate(" + T.xPercent + "%," + T.yPercent + "%) translate3d(" : "translate3d(") + k + "px," + z + "px," + R + "px)" + (1 !== C || 1 !== P ? " scale(" + C + "," + P + ")" : ""));
                                t = s = 1, i = a = 0
                            }
                            d = 1, r = n = o = l = h = c = 0, u = O ? -1 / O : 0, f = T.zOrigin, m = 1e-6, b = ",", x = "0", (E = T.rotationY * A) && (v = Math.cos(E), g = Math.sin(E), o = -g, h = u * -g, r = t * g, n = a * g, d = v, u *= v, t *= v, a *= v), (E = T.rotationX * A) && (v = Math.cos(E), g = Math.sin(E), _ = i * v + r * g, y = s * v + n * g, l = d * g, c = u * g, r = i * -g + r * v, n = s * -g + n * v, d *= v, u *= v, i = _, s = y), 1 !== M && (r *= M, n *= M, d *= M, u *= M), 1 !== P && (i *= P, s *= P, l *= P, c *= P), 1 !== C && (t *= C, a *= C, o *= C, h *= C), (f || T.svg) && (f && (k += r * -f, z += n * -f, R += d * -f + f), T.svg && (k += T.xOrigin - (T.xOrigin * t + T.yOrigin * i), z += T.yOrigin - (T.xOrigin * a + T.yOrigin * s)), m > k && k > -m && (k = x), m > z && z > -m && (z = x), m > R && R > -m && (R = 0)), w = T.xPercent || T.yPercent ? "translate(" + T.xPercent + "%," + T.yPercent + "%) matrix3d(" : "matrix3d(", w += (m > t && t > -m ? x : t) + b + (m > a && a > -m ? x : a) + b + (m > o && o > -m ? x : o), w += b + (m > h && h > -m ? x : h) + b + (m > i && i > -m ? x : i) + b + (m > s && s > -m ? x : s), T.rotationX || T.rotationY ? (w += b + (m > l && l > -m ? x : l) + b + (m > c && c > -m ? x : c) + b + (m > r && r > -m ? x : r), w += b + (m > n && n > -m ? x : n) + b + (m > d && d > -m ? x : d) + b + (m > u && u > -m ? x : u) + b) : w += ",0,0,0,0,1,0,", w += k + b + z + b + R + b + (O ? 1 + -R / O : 1) + ")", S[be] = w
                        } else De.call(this, e)
                    },
                    De = X.set2DTransformRatio = function (e) {
                        var t, i, r, a, s, n, o, l, d, h, c, u = this.data,
                            p = this.t,
                            f = p.style,
                            m = u.x,
                            v = u.y;
                        return !(u.rotationX || u.rotationY || u.z || !0 === u.force3D || "auto" === u.force3D && 1 !== e && 0 !== e) || u.svg && ye || !Se ? (a = u.scaleX, s = u.scaleY, void(u.rotation || u.skewX || u.svg ? (t = u.rotation * A, i = t - u.skewX * A, r = 1e5, n = Math.cos(t) * a, o = Math.sin(t) * a, l = Math.sin(i) * -s, d = Math.cos(i) * s, u.svg && (m += u.xOrigin - (u.xOrigin * n + u.yOrigin * l), v += u.yOrigin - (u.xOrigin * o + u.yOrigin * d), (c = 1e-6) > m && m > -c && (m = 0), c > v && v > -c && (v = 0)), h = (0 | n * r) / r + "," + (0 | o * r) / r + "," + (0 | l * r) / r + "," + (0 | d * r) / r + "," + m + "," + v + ")", u.svg && ye ? p.setAttribute("transform", "matrix(" + h) : f[be] = (u.xPercent || u.yPercent ? "translate(" + u.xPercent + "%," + u.yPercent + "%) matrix(" : "matrix(") + h) : f[be] = (u.xPercent || u.yPercent ? "translate(" + u.xPercent + "%," + u.yPercent + "%) matrix(" : "matrix(") + a + ",0,0," + s + "," + m + "," + v + ")")) : (this.setRatio = Ae, void Ae.call(this, e))
                    };
                (d = Ee.prototype).x = d.y = d.z = d.skewX = d.skewY = d.rotation = d.rotationX = d.rotationY = d.zOrigin = d.xPercent = d.yPercent = 0, d.scaleX = d.scaleY = d.scaleZ = 1, _e("transform,scale,scaleX,scaleY,scaleZ,x,y,z,rotation,rotationX,rotationY,rotationZ,skewX,skewY,shortRotation,shortRotationX,shortRotationY,shortRotationZ,transformOrigin,transformPerspective,directionalRotation,parseTransform,force3D,skewType,xPercent,yPercent", {
                    parser: function (e, t, i, r, s, o, l) {
                        if (r._lastParsedTransform === l) return s;
                        r._lastParsedTransform = l;
                        var d, h, c, u, p, f, m, v = r._transform = Re(e, a, !0, l.parseTransform),
                            g = e.style,
                            _ = we.length,
                            y = l,
                            w = {};
                        if ("string" == typeof y.transform && be) c = $.style, c[be] = y.transform, c.display = "block", c.position = "absolute", L.body.appendChild($), d = Re($, null, !1), L.body.removeChild($);
                        else if ("object" == typeof y) {
                            if (d = {
                                    scaleX: se(null != y.scaleX ? y.scaleX : y.scale, v.scaleX),
                                    scaleY: se(null != y.scaleY ? y.scaleY : y.scale, v.scaleY),
                                    scaleZ: se(y.scaleZ, v.scaleZ),
                                    x: se(y.x, v.x),
                                    y: se(y.y, v.y),
                                    z: se(y.z, v.z),
                                    xPercent: se(y.xPercent, v.xPercent),
                                    yPercent: se(y.yPercent, v.yPercent),
                                    perspective: se(y.transformPerspective, v.perspective)
                                }, null != (m = y.directionalRotation))
                                if ("object" == typeof m)
                                    for (c in m) y[c] = m[c];
                                else y.rotation = m;
                            "string" == typeof y.x && -1 !== y.x.indexOf("%") && (d.x = 0, d.xPercent = se(y.x, v.xPercent)), "string" == typeof y.y && -1 !== y.y.indexOf("%") && (d.y = 0, d.yPercent = se(y.y, v.yPercent)), d.rotation = ne("rotation" in y ? y.rotation : "shortRotation" in y ? y.shortRotation + "_short" : "rotationZ" in y ? y.rotationZ : v.rotation, v.rotation, "rotation", w), Se && (d.rotationX = ne("rotationX" in y ? y.rotationX : "shortRotationX" in y ? y.shortRotationX + "_short" : v.rotationX || 0, v.rotationX, "rotationX", w), d.rotationY = ne("rotationY" in y ? y.rotationY : "shortRotationY" in y ? y.shortRotationY + "_short" : v.rotationY || 0, v.rotationY, "rotationY", w)), d.skewX = null == y.skewX ? v.skewX : ne(y.skewX, v.skewX), d.skewY = null == y.skewY ? v.skewY : ne(y.skewY, v.skewY), (h = d.skewY - v.skewY) && (d.skewX += h, d.rotation += h)
                        }
                        for (Se && null != y.force3D && (v.force3D = y.force3D, f = !0), v.skewType = y.skewType || v.skewType || n.defaultSkewType, (p = v.force3D || v.z || v.rotationX || v.rotationY || d.z || d.rotationX || d.rotationY || d.perspective) || null == y.scale || (d.scaleZ = 1); --_ > -1;) i = we[_], ((u = d[i] - v[i]) > 1e-6 || -1e-6 > u || null != y[i] || null != I[i]) && (f = !0, s = new fe(v, i, v[i], u, s), i in w && (s.e = w[i]), s.xs0 = 0, s.plugin = o, r._overwriteProps.push(s.n));
                        return (u = y.transformOrigin) && v.svg && (ze(e, re(u), d), s = new fe(v, "xOrigin", v.xOrigin, d.xOrigin - v.xOrigin, s, -1, "transformOrigin"), s.b = v.xOrigin, s.e = s.xs0 = d.xOrigin, s = new fe(v, "yOrigin", v.yOrigin, d.yOrigin - v.yOrigin, s, -1, "transformOrigin"), s.b = v.yOrigin, s.e = s.xs0 = d.yOrigin, u = "0px 0px"), (u || Se && p && v.zOrigin) && (be ? (f = !0, i = Te, u = (u || q(e, i, a, !1, "50% 50%")) + "", s = new fe(g, i, 0, 0, s, -1, "transformOrigin"), s.b = g[i], s.plugin = o, Se ? (c = v.zOrigin, u = u.split(" "), v.zOrigin = (u.length > 2 && (0 === c || "0px" !== u[2]) ? parseFloat(u[2]) : c) || 0, s.xs0 = s.e = u[0] + " " + (u[1] || "50%") + " 0px", s = new fe(v, "zOrigin", 0, 0, s, -1, s.n), s.b = c, s.xs0 = s.e = v.zOrigin) : s.xs0 = s.e = u) : re(u + "", v)), f && (r._transformType = v.svg && ye || !p && 3 !== this._transformType ? 2 : 3), s
                    },
                    prefix: !0
                }), _e("boxShadow", {
                    defaultValue: "0px 0px 0px 0px #999",
                    prefix: !0,
                    color: !0,
                    multi: !0,
                    keyword: "inset"
                }), _e("borderRadius", {
                    defaultValue: "0px",
                    parser: function (e, t, i, s, n) {
                        t = this.format(t);
                        var o, l, d, h, c, u, p, f, m, v, g, _, y, w, b, x, T = ["borderTopLeftRadius", "borderTopRightRadius", "borderBottomRightRadius", "borderBottomLeftRadius"],
                            S = e.style;
                        for (m = parseFloat(e.offsetWidth), v = parseFloat(e.offsetHeight), o = t.split(" "), l = 0; T.length > l; l++) this.p.indexOf("border") && (T[l] = W(T[l])), -1 !== (c = h = q(e, T[l], a, !1, "0px")).indexOf(" ") && (h = c.split(" "), c = h[0], h = h[1]), u = d = o[l], p = parseFloat(c), _ = c.substr((p + "").length), y = "=" === u.charAt(1), y ? (f = parseInt(u.charAt(0) + "1", 10), u = u.substr(2), f *= parseFloat(u), g = u.substr((f + "").length - (0 > f ? 1 : 0)) || "") : (f = parseFloat(u), g = u.substr((f + "").length)), "" === g && (g = r[i] || _), g !== _ && (w = Z(e, "borderLeft", p, _), b = Z(e, "borderTop", p, _), "%" === g ? (c = w / m * 100 + "%", h = b / v * 100 + "%") : "em" === g ? (x = Z(e, "borderLeft", 1, "em"), c = w / x + "em", h = b / x + "em") : (c = w + "px", h = b + "px"), y && (u = parseFloat(c) + f + g, d = parseFloat(h) + f + g)), n = me(S, T[l], c + " " + h, u + " " + d, !1, "0px", n);
                        return n
                    },
                    prefix: !0,
                    formatter: ce("0px 0px 0px 0px", !1, !0)
                }), _e("backgroundPosition", {
                    defaultValue: "0 0",
                    parser: function (e, t, i, r, s, n) {
                        var o, l, d, h, c, u, p = "background-position",
                            f = a || U(e, null),
                            v = this.format((f ? m ? f.getPropertyValue(p + "-x") + " " + f.getPropertyValue(p + "-y") : f.getPropertyValue(p) : e.currentStyle.backgroundPositionX + " " + e.currentStyle.backgroundPositionY) || "0 0"),
                            g = this.format(t);
                        if (-1 !== v.indexOf("%") != (-1 !== g.indexOf("%")) && (u = q(e, "backgroundImage").replace(P, "")) && "none" !== u) {
                            for (o = v.split(" "), l = g.split(" "), F.setAttribute("src", u), d = 2; --d > -1;) v = o[d], (h = -1 !== v.indexOf("%")) !== (-1 !== l[d].indexOf("%")) && (c = 0 === d ? e.offsetWidth - F.width : e.offsetHeight - F.height, o[d] = h ? parseFloat(v) / 100 * c + "px" : parseFloat(v) / c * 100 + "%");
                            v = o.join(" ")
                        }
                        return this.parseComplex(e.style, v, g, s, n)
                    },
                    formatter: re
                }), _e("backgroundSize", {
                    defaultValue: "0 0",
                    formatter: re
                }), _e("perspective", {
                    defaultValue: "0px",
                    prefix: !0
                }), _e("perspectiveOrigin", {
                    defaultValue: "50% 50%",
                    prefix: !0
                }), _e("transformStyle", {
                    prefix: !0
                }), _e("backfaceVisibility", {
                    prefix: !0
                }), _e("userSelect", {
                    prefix: !0
                }), _e("margin", {
                    parser: ue("marginTop,marginRight,marginBottom,marginLeft")
                }), _e("padding", {
                    parser: ue("paddingTop,paddingRight,paddingBottom,paddingLeft")
                }), _e("clip", {
                    defaultValue: "rect(0px,0px,0px,0px)",
                    parser: function (e, t, i, r, s, n) {
                        var o, l, d;
                        return 9 > m ? (l = e.currentStyle, d = 8 > m ? " " : ",", o = "rect(" + l.clipTop + d + l.clipRight + d + l.clipBottom + d + l.clipLeft + ")", t = this.format(t).split(",").join(d)) : (o = this.format(q(e, this.p, a, !1, this.dflt)), t = this.format(t)), this.parseComplex(e.style, o, t, s, n)
                    }
                }), _e("textShadow", {
                    defaultValue: "0px 0px 0px #999",
                    color: !0,
                    multi: !0
                }), _e("autoRound,strictUnits", {
                    parser: function (e, t, i, r, a) {
                        return a
                    }
                }), _e("border", {
                    defaultValue: "0px solid #000",
                    parser: function (e, t, i, r, s, n) {
                        return this.parseComplex(e.style, this.format(q(e, "borderTopWidth", a, !1, "0px") + " " + q(e, "borderTopStyle", a, !1, "solid") + " " + q(e, "borderTopColor", a, !1, "#000")), this.format(t), s, n)
                    },
                    color: !0,
                    formatter: function (e) {
                        var t = e.split(" ");
                        return t[0] + " " + (t[1] || "solid") + " " + (e.match(he) || ["#000"])[0]
                    }
                }), _e("borderWidth", {
                    parser: ue("borderTopWidth,borderRightWidth,borderBottomWidth,borderLeftWidth")
                }), _e("float,cssFloat,styleFloat", {
                    parser: function (e, t, i, r, a) {
                        var s = e.style,
                            n = "cssFloat" in s ? "cssFloat" : "styleFloat";
                        return new fe(s, n, 0, 0, a, -1, i, !1, 0, s[n], t)
                    }
                });
                var Ie = function (e) {
                    var t, i = this.t,
                        r = i.filter || q(this.data, "filter") || "",
                        a = 0 | this.s + this.c * e;
                    100 === a && (-1 === r.indexOf("atrix(") && -1 === r.indexOf("radient(") && -1 === r.indexOf("oader(") ? (i.removeAttribute("filter"), t = !q(this.data, "filter")) : (i.filter = r.replace(T, ""), t = !0)), t || (this.xn1 && (i.filter = r = r || "alpha(opacity=" + a + ")"), -1 === r.indexOf("pacity") ? 0 === a && this.xn1 || (i.filter = r + " alpha(opacity=" + a + ")") : i.filter = r.replace(b, "opacity=" + a))
                };
                _e("opacity,alpha,autoAlpha", {
                    defaultValue: "1",
                    parser: function (e, t, i, r, s, n) {
                        var o = parseFloat(q(e, "opacity", a, !1, "1")),
                            l = e.style,
                            d = "autoAlpha" === i;
                        return "string" == typeof t && "=" === t.charAt(1) && (t = ("-" === t.charAt(0) ? -1 : 1) * parseFloat(t.substr(2)) + o), d && 1 === o && "hidden" === q(e, "visibility", a) && 0 !== t && (o = 0), B ? s = new fe(l, "opacity", o, t - o, s) : (s = new fe(l, "opacity", 100 * o, 100 * (t - o), s), s.xn1 = d ? 1 : 0, l.zoom = 1, s.type = 2, s.b = "alpha(opacity=" + s.s + ")", s.e = "alpha(opacity=" + (s.s + s.c) + ")", s.data = e, s.plugin = n, s.setRatio = Ie), d && (s = new fe(l, "visibility", 0, 0, s, -1, null, !1, 0, 0 !== o ? "inherit" : "hidden", 0 === t ? "hidden" : "inherit"), s.xs0 = "inherit", r._overwriteProps.push(s.n), r._overwriteProps.push(i)), s
                    }
                });
                var Le = function (e, t) {
                        t && (e.removeProperty ? ("ms" === t.substr(0, 2) && (t = "M" + t.substr(1)), e.removeProperty(t.replace(E, "-$1").toLowerCase())) : e.removeAttribute(t))
                    },
                    Ne = function (e) {
                        if (this.t._gsClassPT = this, 1 === e || 0 === e) {
                            this.t.setAttribute("class", 0 === e ? this.b : this.e);
                            for (var t = this.data, i = this.t.style; t;) t.v ? i[t.p] = t.v : Le(i, t.p), t = t._next;
                            1 === e && this.t._gsClassPT === this && (this.t._gsClassPT = null)
                        } else this.t.getAttribute("class") !== this.e && this.t.setAttribute("class", this.e)
                    };
                _e("className", {
                    parser: function (e, t, r, s, n, o, l) {
                        var d, h, c, u, p, f = e.getAttribute("class") || "",
                            m = e.style.cssText;
                        if (n = s._classNamePT = new fe(e, r, 0, 0, n, 2), n.setRatio = Ne, n.pr = -11, i = !0, n.b = f, h = Q(e, a), c = e._gsClassPT) {
                            for (u = {}, p = c.data; p;) u[p.p] = 1, p = p._next;
                            c.setRatio(1)
                        }
                        return e._gsClassPT = n, n.e = "=" !== t.charAt(1) ? t : f.replace(RegExp("\\s*\\b" + t.substr(2) + "\\b"), "") + ("+" === t.charAt(0) ? " " + t.substr(2) : ""), s._tween._duration && (e.setAttribute("class", n.e), d = J(e, h, Q(e), l, u), e.setAttribute("class", f), n.data = d.firstMPT, e.style.cssText = m, n = n.xfirst = s.parse(e, d.difs, n, o)), n
                    }
                });
                var $e = function (e) {
                    if ((1 === e || 0 === e) && this.data._totalTime === this.data._totalDuration && "isFromStart" !== this.data.data) {
                        var t, i, r, a, s = this.t.style,
                            n = l.transform.parse;
                        if ("all" === this.e) s.cssText = "", a = !0;
                        else
                            for (t = this.e.split(" ").join("").split(","), r = t.length; --r > -1;) i = t[r], l[i] && (l[i].parse === n ? a = !0 : i = "transformOrigin" === i ? Te : l[i].p), Le(s, i);
                        a && (Le(s, be), this.t._gsTransform && delete this.t._gsTransform)
                    }
                };
                for (_e("clearProps", {
                        parser: function (e, t, r, a, s) {
                            return s = new fe(e, r, 0, 0, s, 2), s.setRatio = $e, s.e = t, s.pr = -10, s.data = a._tween, i = !0, s
                        }
                    }), d = "bezier,throwProps,physicsProps,physics2D".split(","), ve = d.length; ve--;) ! function (e) {
                    if (!l[e]) {
                        var t = e.charAt(0).toUpperCase() + e.substr(1) + "Plugin";
                        _e(e, {
                            parser: function (e, i, r, a, s, n, d) {
                                var h = o.com.greensock.plugins[t];
                                return h ? (h._cssRegister(), l[r].parse(e, i, r, a, s, n, d)) : (H("Error: " + t + " js file not loaded."), s)
                            }
                        })
                    }
                }(d[ve]);
                (d = n.prototype)._firstPT = d._lastParsedTransform = d._transform = null, d._onInitTween = function (e, t, o) {
                    if (!e.nodeType) return !1;
                    this._target = e, this._tween = o, this._vars = t, h = t.autoRound, i = !1, r = t.suffixMap || n.suffixMap, a = U(e, ""), s = this._overwriteProps;
                    var l, d, p, m, v, g, _, y, w, b = e.style;
                    if (c && "" === b.zIndex && ("auto" === (l = q(e, "zIndex", a)) || "" === l) && this._addLazySet(b, "zIndex", 0), "string" == typeof t && (m = b.cssText, l = Q(e, a), b.cssText = m + ";" + t, l = J(e, l, Q(e)).difs, !B && x.test(t) && (l.opacity = parseFloat(RegExp.$1)), t = l, b.cssText = m), this._firstPT = d = this.parse(e, t, null), this._transformType) {
                        for (w = 3 === this._transformType, be ? u && (c = !0, "" === b.zIndex && ("auto" === (_ = q(e, "zIndex", a)) || "" === _) && this._addLazySet(b, "zIndex", 0), f && this._addLazySet(b, "WebkitBackfaceVisibility", this._vars.WebkitBackfaceVisibility || (w ? "visible" : "hidden"))) : b.zoom = 1, p = d; p && p._next;) p = p._next;
                        y = new fe(e, "transform", 0, 0, null, 2), this._linkCSSP(y, null, p), y.setRatio = w && Se ? Ae : be ? De : Oe, y.data = this._transform || Re(e, a, !0), s.pop()
                    }
                    if (i) {
                        for (; d;) {
                            for (g = d._next, p = m; p && p.pr > d.pr;) p = p._next;
                            (d._prev = p ? p._prev : v) ? d._prev._next = d: m = d, (d._next = p) ? p._prev = d : v = d, d = g
                        }
                        this._firstPT = m
                    }
                    return !0
                }, d.parse = function (e, t, i, s) {
                    var n, o, d, c, u, p, f, m, v, g, _ = e.style;
                    for (n in t) p = t[n], o = l[n], o ? i = o.parse(e, p, n, this, i, s, t) : (u = q(e, n, a) + "", v = "string" == typeof p, "color" === n || "fill" === n || "stroke" === n || -1 !== n.indexOf("Color") || v && S.test(p) ? (v || (p = de(p), p = (p.length > 3 ? "rgba(" : "rgb(") + p.join(",") + ")"), i = me(_, n, u, p, !0, "transparent", i, 0, s)) : !v || -1 === p.indexOf(" ") && -1 === p.indexOf(",") ? (d = parseFloat(u), f = d || 0 === d ? u.substr((d + "").length) : "", ("" === u || "auto" === u) && ("width" === n || "height" === n ? (d = ie(e, n, a), f = "px") : "left" === n || "top" === n ? (d = K(e, n, a), f = "px") : (d = "opacity" !== n ? 0 : 1, f = "")), g = v && "=" === p.charAt(1), g ? (c = parseInt(p.charAt(0) + "1", 10), p = p.substr(2), c *= parseFloat(p), m = p.replace(w, "")) : (c = parseFloat(p), m = v ? p.replace(w, "") : ""), "" === m && (m = n in r ? r[n] : f), p = c || 0 === c ? (g ? c + d : c) + m : t[n], f !== m && "" !== m && (c || 0 === c) && d && (d = Z(e, n, d, f), "%" === m ? (d /= Z(e, n, 100, "%") / 100, !0 !== t.strictUnits && (u = d + "%")) : "em" === m ? d /= Z(e, n, 1, "em") : "px" !== m && (c = Z(e, n, c, m), m = "px"), g && (c || 0 === c) && (p = c + d + m)), g && (c += d), !d && 0 !== d || !c && 0 !== c ? void 0 !== _[n] && (p || "NaN" != p + "" && null != p) ? (i = new fe(_, n, c || d || 0, 0, i, -1, n, !1, 0, u, p), i.xs0 = "none" !== p || "display" !== n && -1 === n.indexOf("Style") ? p : u) : H("invalid " + n + " tween value: " + t[n]) : (i = new fe(_, n, d, c - d, i, 0, n, !1 !== h && ("px" === m || "zIndex" === n), 0, u, p), i.xs0 = m)) : i = me(_, n, u, p, !0, null, i, 0, s)), s && i && !i.plugin && (i.plugin = s);
                    return i
                }, d.setRatio = function (e) {
                    var t, i, r, a = this._firstPT;
                    if (1 !== e || this._tween._time !== this._tween._duration && 0 !== this._tween._time)
                        if (e || this._tween._time !== this._tween._duration && 0 !== this._tween._time || -1e-6 === this._tween._rawPrevTime)
                            for (; a;) {
                                if (t = a.c * e + a.s, a.r ? t = Math.round(t) : 1e-6 > t && t > -1e-6 && (t = 0), a.type)
                                    if (1 === a.type)
                                        if (2 === (r = a.l)) a.t[a.p] = a.xs0 + t + a.xs1 + a.xn1 + a.xs2;
                                        else if (3 === r) a.t[a.p] = a.xs0 + t + a.xs1 + a.xn1 + a.xs2 + a.xn2 + a.xs3;
                                else if (4 === r) a.t[a.p] = a.xs0 + t + a.xs1 + a.xn1 + a.xs2 + a.xn2 + a.xs3 + a.xn3 + a.xs4;
                                else if (5 === r) a.t[a.p] = a.xs0 + t + a.xs1 + a.xn1 + a.xs2 + a.xn2 + a.xs3 + a.xn3 + a.xs4 + a.xn4 + a.xs5;
                                else {
                                    for (i = a.xs0 + t + a.xs1, r = 1; a.l > r; r++) i += a["xn" + r] + a["xs" + (r + 1)];
                                    a.t[a.p] = i
                                } else -1 === a.type ? a.t[a.p] = a.xs0 : a.setRatio && a.setRatio(e);
                                else a.t[a.p] = t + a.xs0;
                                a = a._next
                            } else
                                for (; a;) 2 !== a.type ? a.t[a.p] = a.b : a.setRatio(e), a = a._next;
                        else
                            for (; a;) 2 !== a.type ? a.t[a.p] = a.e : a.setRatio(e), a = a._next
                }, d._enableTransforms = function (e) {
                    this._transform = this._transform || Re(this._target, a, !0), this._transformType = this._transform.svg && ye || !e && 3 !== this._transformType ? 2 : 3
                };
                var Fe = function () {
                    this.t[this.p] = this.e, this.data._linkCSSP(this, this._next, null, !0)
                };
                d._addLazySet = function (e, t, i) {
                    var r = this._firstPT = new fe(e, t, 0, 0, this._firstPT, 2);
                    r.e = i, r.setRatio = Fe, r.data = this
                }, d._linkCSSP = function (e, t, i, r) {
                    return e && (t && (t._prev = e), e._next && (e._next._prev = e._prev), e._prev ? e._prev._next = e._next : this._firstPT === e && (this._firstPT = e._next, r = !0), i ? i._next = e : r || null !== this._firstPT || (this._firstPT = e), e._next = t, e._prev = i), e
                }, d._kill = function (t) {
                    var i, r, a, s = t;
                    if (t.autoAlpha || t.alpha) {
                        s = {};
                        for (r in t) s[r] = t[r];
                        s.opacity = 1, s.autoAlpha && (s.visibility = 1)
                    }
                    return t.className && (i = this._classNamePT) && (a = i.xfirst, a && a._prev ? this._linkCSSP(a._prev, i._next, a._prev._prev) : a === this._firstPT && (this._firstPT = i._next), i._next && this._linkCSSP(i._next, i._next._next, a._prev), this._classNamePT = null), e.prototype._kill.call(this, s)
                };
                var Xe = function (e, t, i) {
                    var r, a, s, n;
                    if (e.slice)
                        for (a = e.length; --a > -1;) Xe(e[a], t, i);
                    else
                        for (r = e.childNodes, a = r.length; --a > -1;) s = r[a], n = s.type, s.style && (t.push(Q(s)), i && i.push(s)), 1 !== n && 9 !== n && 11 !== n || !s.childNodes.length || Xe(s, t, i)
                };
                return n.cascadeTo = function (e, i, r) {
                    var a, s, n, o = t.to(e, i, r),
                        l = [o],
                        d = [],
                        h = [],
                        c = [],
                        u = t._internals.reservedProps;
                    for (e = o._targets || o.target, Xe(e, d, c), o.render(i, !0), Xe(e, h), o.render(0, !0), o._enabled(!0), a = c.length; --a > -1;)
                        if ((s = J(c[a], d[a], h[a])).firstMPT) {
                            s = s.difs;
                            for (n in r) u[n] && (s[n] = r[n]);
                            l.push(t.to(c[a], i, s))
                        } return l
                }, e.activate([n]), n
            }, !0),
            function () {
                var e = _gsScope._gsDefine.plugin({
                    propName: "roundProps",
                    priority: -1,
                    API: 2,
                    init: function (e, t, i) {
                        return this._tween = i, !0
                    }
                }).prototype;
                e._onInitAllProps = function () {
                    for (var e, t, i, r = this._tween, a = r.vars.roundProps instanceof Array ? r.vars.roundProps : r.vars.roundProps.split(","), s = a.length, n = {}, o = r._propLookup.roundProps; --s > -1;) n[a[s]] = 1;
                    for (s = a.length; --s > -1;)
                        for (e = a[s], t = r._firstPT; t;) i = t._next, t.pg ? t.t._roundProps(n, !0) : t.n === e && (this._add(t.t, e, t.s, t.c), i && (i._prev = t._prev), t._prev ? t._prev._next = i : r._firstPT === t && (r._firstPT = i), t._next = t._prev = null, r._propLookup[e] = o), t = i;
                    return !1
                }, e._add = function (e, t, i, r) {
                    this._addTween(e, t, i, i + r, t, !0), this._overwriteProps.push(t)
                }
            }(), _gsScope._gsDefine.plugin({
                propName: "attr",
                API: 2,
                version: "0.3.3",
                init: function (e, t) {
                    var i, r, a;
                    if ("function" != typeof e.setAttribute) return !1;
                    this._target = e, this._proxy = {}, this._start = {}, this._end = {};
                    for (i in t) this._start[i] = this._proxy[i] = r = e.getAttribute(i), a = this._addTween(this._proxy, i, parseFloat(r), t[i], i), this._end[i] = a ? a.s + a.c : t[i], this._overwriteProps.push(i);
                    return !0
                },
                set: function (e) {
                    this._super.setRatio.call(this, e);
                    for (var t, i = this._overwriteProps, r = i.length, a = 1 === e ? this._end : e ? this._proxy : this._start; --r > -1;) t = i[r], this._target.setAttribute(t, a[t] + "")
                }
            }), _gsScope._gsDefine.plugin({
                propName: "directionalRotation",
                version: "0.2.1",
                API: 2,
                init: function (e, t) {
                    "object" != typeof t && (t = {
                        rotation: t
                    }), this.finals = {};
                    var i, r, a, s, n, o, l = !0 === t.useRadians ? 2 * Math.PI : 360;
                    for (i in t) "useRadians" !== i && (o = (t[i] + "").split("_"), r = o[0], a = parseFloat("function" != typeof e[i] ? e[i] : e[i.indexOf("set") || "function" != typeof e["get" + i.substr(3)] ? i : "get" + i.substr(3)]()), s = this.finals[i] = "string" == typeof r && "=" === r.charAt(1) ? a + parseInt(r.charAt(0) + "1", 10) * Number(r.substr(2)) : Number(r) || 0, n = s - a, o.length && (-1 !== (r = o.join("_")).indexOf("short") && (n %= l) != n % (l / 2) && (n = 0 > n ? n + l : n - l), -1 !== r.indexOf("_cw") && 0 > n ? n = (n + 9999999999 * l) % l - (0 | n / l) * l : -1 !== r.indexOf("ccw") && n > 0 && (n = (n - 9999999999 * l) % l - (0 | n / l) * l)), (n > 1e-6 || -1e-6 > n) && (this._addTween(e, i, a, a + n, i), this._overwriteProps.push(i)));
                    return !0
                },
                set: function (e) {
                    var t;
                    if (1 !== e) this._super.setRatio.call(this, e);
                    else
                        for (t = this._firstPT; t;) t.f ? t.t[t.p](this.finals[t.p]) : t.t[t.p] = this.finals[t.p], t = t._next
                }
            })._autoCSS = !0, _gsScope._gsDefine("easing.Back", ["easing.Ease"], function (e) {
                var t, i, r, a = _gsScope.GreenSockGlobals || _gsScope,
                    s = a.com.greensock,
                    n = 2 * Math.PI,
                    o = Math.PI / 2,
                    l = s._class,
                    d = function (t, i) {
                        var r = l("easing." + t, function () {}, !0),
                            a = r.prototype = new e;
                        return a.constructor = r, a.getRatio = i, r
                    },
                    h = e.register || function () {},
                    c = function (e, t, i, r) {
                        var a = l("easing." + e, {
                            easeOut: new t,
                            easeIn: new i,
                            easeInOut: new r
                        }, !0);
                        return h(a, e), a
                    },
                    u = function (e, t, i) {
                        this.t = e, this.v = t, i && (this.next = i, i.prev = this, this.c = i.v - t, this.gap = i.t - e)
                    },
                    p = function (t, i) {
                        var r = l("easing." + t, function (e) {
                                this._p1 = e || 0 === e ? e : 1.70158, this._p2 = 1.525 * this._p1
                            }, !0),
                            a = r.prototype = new e;
                        return a.constructor = r, a.getRatio = i, a.config = function (e) {
                            return new r(e)
                        }, r
                    },
                    f = c("Back", p("BackOut", function (e) {
                        return (e -= 1) * e * ((this._p1 + 1) * e + this._p1) + 1
                    }), p("BackIn", function (e) {
                        return e * e * ((this._p1 + 1) * e - this._p1)
                    }), p("BackInOut", function (e) {
                        return 1 > (e *= 2) ? .5 * e * e * ((this._p2 + 1) * e - this._p2) : .5 * ((e -= 2) * e * ((this._p2 + 1) * e + this._p2) + 2)
                    })),
                    m = l("easing.SlowMo", function (e, t, i) {
                        t = t || 0 === t ? t : .7, null == e ? e = .7 : e > 1 && (e = 1), this._p = 1 !== e ? t : 0, this._p1 = (1 - e) / 2, this._p2 = e, this._p3 = this._p1 + this._p2, this._calcEnd = !0 === i
                    }, !0),
                    v = m.prototype = new e;
                return v.constructor = m, v.getRatio = function (e) {
                    var t = e + (.5 - e) * this._p;
                    return this._p1 > e ? this._calcEnd ? 1 - (e = 1 - e / this._p1) * e : t - (e = 1 - e / this._p1) * e * e * e * t : e > this._p3 ? this._calcEnd ? 1 - (e = (e - this._p3) / this._p1) * e : t + (e - t) * (e = (e - this._p3) / this._p1) * e * e * e : this._calcEnd ? 1 : t
                }, m.ease = new m(.7, .7), v.config = m.config = function (e, t, i) {
                    return new m(e, t, i)
                }, t = l("easing.SteppedEase", function (e) {
                    e = e || 1, this._p1 = 1 / e, this._p2 = e + 1
                }, !0), v = t.prototype = new e, v.constructor = t, v.getRatio = function (e) {
                    return 0 > e ? e = 0 : e >= 1 && (e = .999999999), (this._p2 * e >> 0) * this._p1
                }, v.config = t.config = function (e) {
                    return new t(e)
                }, i = l("easing.RoughEase", function (t) {
                    for (var i, r, a, s, n, o, l = (t = t || {}).taper || "none", d = [], h = 0, c = 0 | (t.points || 20), p = c, f = !1 !== t.randomize, m = !0 === t.clamp, v = t.template instanceof e ? t.template : null, g = "number" == typeof t.strength ? .4 * t.strength : .4; --p > -1;) i = f ? Math.random() : 1 / c * p, r = v ? v.getRatio(i) : i, "none" === l ? a = g : "out" === l ? (s = 1 - i, a = s * s * g) : "in" === l ? a = i * i * g : .5 > i ? (s = 2 * i, a = .5 * s * s * g) : (s = 2 * (1 - i), a = .5 * s * s * g), f ? r += Math.random() * a - .5 * a : p % 2 ? r += .5 * a : r -= .5 * a, m && (r > 1 ? r = 1 : 0 > r && (r = 0)), d[h++] = {
                        x: i,
                        y: r
                    };
                    for (d.sort(function (e, t) {
                            return e.x - t.x
                        }), o = new u(1, 1, null), p = c; --p > -1;) n = d[p], o = new u(n.x, n.y, o);
                    this._prev = new u(0, 0, 0 !== o.t ? o : o.next)
                }, !0), v = i.prototype = new e, v.constructor = i, v.getRatio = function (e) {
                    var t = this._prev;
                    if (e > t.t) {
                        for (; t.next && e >= t.t;) t = t.next;
                        t = t.prev
                    } else
                        for (; t.prev && t.t >= e;) t = t.prev;
                    return this._prev = t, t.v + (e - t.t) / t.gap * t.c
                }, v.config = function (e) {
                    return new i(e)
                }, i.ease = new i, c("Bounce", d("BounceOut", function (e) {
                    return 1 / 2.75 > e ? 7.5625 * e * e : 2 / 2.75 > e ? 7.5625 * (e -= 1.5 / 2.75) * e + .75 : 2.5 / 2.75 > e ? 7.5625 * (e -= 2.25 / 2.75) * e + .9375 : 7.5625 * (e -= 2.625 / 2.75) * e + .984375
                }), d("BounceIn", function (e) {
                    return 1 / 2.75 > (e = 1 - e) ? 1 - 7.5625 * e * e : 2 / 2.75 > e ? 1 - (7.5625 * (e -= 1.5 / 2.75) * e + .75) : 2.5 / 2.75 > e ? 1 - (7.5625 * (e -= 2.25 / 2.75) * e + .9375) : 1 - (7.5625 * (e -= 2.625 / 2.75) * e + .984375)
                }), d("BounceInOut", function (e) {
                    var t = .5 > e;
                    return e = t ? 1 - 2 * e : 2 * e - 1, e = 1 / 2.75 > e ? 7.5625 * e * e : 2 / 2.75 > e ? 7.5625 * (e -= 1.5 / 2.75) * e + .75 : 2.5 / 2.75 > e ? 7.5625 * (e -= 2.25 / 2.75) * e + .9375 : 7.5625 * (e -= 2.625 / 2.75) * e + .984375, t ? .5 * (1 - e) : .5 * e + .5
                })), c("Circ", d("CircOut", function (e) {
                    return Math.sqrt(1 - (e -= 1) * e)
                }), d("CircIn", function (e) {
                    return -(Math.sqrt(1 - e * e) - 1)
                }), d("CircInOut", function (e) {
                    return 1 > (e *= 2) ? -.5 * (Math.sqrt(1 - e * e) - 1) : .5 * (Math.sqrt(1 - (e -= 2) * e) + 1)
                })), r = function (t, i, r) {
                    var a = l("easing." + t, function (e, t) {
                            this._p1 = e || 1, this._p2 = t || r, this._p3 = this._p2 / n * (Math.asin(1 / this._p1) || 0)
                        }, !0),
                        s = a.prototype = new e;
                    return s.constructor = a, s.getRatio = i, s.config = function (e, t) {
                        return new a(e, t)
                    }, a
                }, c("Elastic", r("ElasticOut", function (e) {
                    return this._p1 * Math.pow(2, -10 * e) * Math.sin((e - this._p3) * n / this._p2) + 1
                }, .3), r("ElasticIn", function (e) {
                    return -this._p1 * Math.pow(2, 10 * (e -= 1)) * Math.sin((e - this._p3) * n / this._p2)
                }, .3), r("ElasticInOut", function (e) {
                    return 1 > (e *= 2) ? -.5 * this._p1 * Math.pow(2, 10 * (e -= 1)) * Math.sin((e - this._p3) * n / this._p2) : .5 * this._p1 * Math.pow(2, -10 * (e -= 1)) * Math.sin((e - this._p3) * n / this._p2) + 1
                }, .45)), c("Expo", d("ExpoOut", function (e) {
                    return 1 - Math.pow(2, -10 * e)
                }), d("ExpoIn", function (e) {
                    return Math.pow(2, 10 * (e - 1)) - .001
                }), d("ExpoInOut", function (e) {
                    return 1 > (e *= 2) ? .5 * Math.pow(2, 10 * (e - 1)) : .5 * (2 - Math.pow(2, -10 * (e - 1)))
                })), c("Sine", d("SineOut", function (e) {
                    return Math.sin(e * o)
                }), d("SineIn", function (e) {
                    return 1 - Math.cos(e * o)
                }), d("SineInOut", function (e) {
                    return -.5 * (Math.cos(Math.PI * e) - 1)
                })), l("easing.EaseLookup", {
                    find: function (t) {
                        return e.map[t]
                    }
                }, !0), h(a.SlowMo, "SlowMo", "ease,"), h(i, "RoughEase", "ease,"), h(t, "SteppedEase", "ease,"), f
            }, !0)
    }), _gsScope._gsDefine && _gsScope._gsQueue.pop()(),
    function (e, t) {
        "use strict";
        var i = e.GreenSockGlobals = e.GreenSockGlobals || e;
        if (!i.TweenLite) {
            var r, a, s, n, o, l = function (e) {
                    var t, r = e.split("."),
                        a = i;
                    for (t = 0; r.length > t; t++) a[r[t]] = a = a[r[t]] || {};
                    return a
                },
                d = l("com.greensock"),
                h = 1e-10,
                c = function (e) {
                    var t, i = [],
                        r = e.length;
                    for (t = 0; t !== r; i.push(e[t++]));
                    return i
                },
                u = function () {},
                p = function () {
                    var e = Object.prototype.toString,
                        t = e.call([]);
                    return function (i) {
                        return null != i && (i instanceof Array || "object" == typeof i && !!i.push && e.call(i) === t)
                    }
                }(),
                f = {},
                m = function (t, r, a, s) {
                    this.sc = f[t] ? f[t].sc : [], f[t] = this, this.gsClass = null, this.func = a;
                    var n = [];
                    this.check = function (o) {
                        for (var d, h, c, u, p = r.length, v = p; --p > -1;)(d = f[r[p]] || new m(r[p], [])).gsClass ? (n[p] = d.gsClass, v--) : o && d.sc.push(this);
                        if (0 === v && a)
                            for (h = ("com.greensock." + t).split("."), c = h.pop(), u = l(h.join("."))[c] = this.gsClass = a.apply(a, n), s && (i[c] = u, "function" == typeof define && define.amd ? define((e.GreenSockAMDPath ? e.GreenSockAMDPath + "/" : "") + t.split(".").pop(), [], function () {
                                    return u
                                }) : "TweenMax" === t && "undefined" != typeof module && module.exports && (module.exports = u)), p = 0; this.sc.length > p; p++) this.sc[p].check()
                    }, this.check(!0)
                },
                v = e._gsDefine = function (e, t, i, r) {
                    return new m(e, t, i, r)
                },
                g = d._class = function (e, t, i) {
                    return t = t || function () {}, v(e, [], function () {
                        return t
                    }, i), t
                };
            v.globals = i;
            var _ = [0, 0, 1, 1],
                y = [],
                w = g("easing.Ease", function (e, t, i, r) {
                    this._func = e, this._type = i || 0, this._power = r || 0, this._params = t ? _.concat(t) : _
                }, !0),
                b = w.map = {},
                x = w.register = function (e, t, i, r) {
                    for (var a, s, n, o, l = t.split(","), h = l.length, c = (i || "easeIn,easeOut,easeInOut").split(","); --h > -1;)
                        for (s = l[h], a = r ? g("easing." + s, null, !0) : d.easing[s] || {}, n = c.length; --n > -1;) o = c[n], b[s + "." + o] = b[o + s] = a[o] = e.getRatio ? e : e[o] || new e
                };
            for ((s = w.prototype)._calcEnd = !1, s.getRatio = function (e) {
                    if (this._func) return this._params[0] = e, this._func.apply(null, this._params);
                    var t = this._type,
                        i = this._power,
                        r = 1 === t ? 1 - e : 2 === t ? e : .5 > e ? 2 * e : 2 * (1 - e);
                    return 1 === i ? r *= r : 2 === i ? r *= r * r : 3 === i ? r *= r * r * r : 4 === i && (r *= r * r * r * r), 1 === t ? 1 - r : 2 === t ? r : .5 > e ? r / 2 : 1 - r / 2
                }, a = (r = ["Linear", "Quad", "Cubic", "Quart", "Quint,Strong"]).length; --a > -1;) s = r[a] + ",Power" + a, x(new w(null, null, 1, a), s, "easeOut", !0), x(new w(null, null, 2, a), s, "easeIn" + (0 === a ? ",easeNone" : "")), x(new w(null, null, 3, a), s, "easeInOut");
            b.linear = d.easing.Linear.easeIn, b.swing = d.easing.Quad.easeInOut;
            var T = g("events.EventDispatcher", function (e) {
                this._listeners = {}, this._eventTarget = e || this
            });
            (s = T.prototype).addEventListener = function (e, t, i, r, a) {
                a = a || 0;
                var s, l, d = this._listeners[e],
                    h = 0;
                for (null == d && (this._listeners[e] = d = []), l = d.length; --l > -1;) s = d[l], s.c === t && s.s === i ? d.splice(l, 1) : 0 === h && a > s.pr && (h = l + 1);
                d.splice(h, 0, {
                    c: t,
                    s: i,
                    up: r,
                    pr: a
                }), this !== n || o || n.wake()
            }, s.removeEventListener = function (e, t) {
                var i, r = this._listeners[e];
                if (r)
                    for (i = r.length; --i > -1;)
                        if (r[i].c === t) return void r.splice(i, 1)
            }, s.dispatchEvent = function (e) {
                var t, i, r, a = this._listeners[e];
                if (a)
                    for (t = a.length, i = this._eventTarget; --t > -1;)(r = a[t]) && (r.up ? r.c.call(r.s || i, {
                        type: e,
                        target: i
                    }) : r.c.call(r.s || i))
            };
            var S = e.requestAnimationFrame,
                E = e.cancelAnimationFrame,
                C = Date.now || function () {
                    return (new Date).getTime()
                },
                P = C();
            for (a = (r = ["ms", "moz", "webkit", "o"]).length; --a > -1 && !S;) S = e[r[a] + "RequestAnimationFrame"], E = e[r[a] + "CancelAnimationFrame"] || e[r[a] + "CancelRequestAnimationFrame"];
            g("Ticker", function (e, t) {
                var i, r, a, s, l, d = this,
                    c = C(),
                    p = !1 !== t && S,
                    f = 500,
                    m = 33,
                    v = function (e) {
                        var t, n, o = C() - P;
                        o > f && (c += o - m), P += o, d.time = (P - c) / 1e3, t = d.time - l, (!i || t > 0 || !0 === e) && (d.frame++, l += t + (t >= s ? .004 : s - t), n = !0), !0 !== e && (a = r(v)), n && d.dispatchEvent("tick")
                    };
                T.call(d), d.time = d.frame = 0, d.tick = function () {
                    v(!0)
                }, d.lagSmoothing = function (e, t) {
                    f = e || 1 / h, m = Math.min(t, f, 0)
                }, d.sleep = function () {
                    null != a && (p && E ? E(a) : clearTimeout(a), r = u, a = null, d === n && (o = !1))
                }, d.wake = function () {
                    null !== a ? d.sleep() : d.frame > 10 && (P = C() - f + 5), r = 0 === i ? u : p && S ? S : function (e) {
                        return setTimeout(e, 0 | 1e3 * (l - d.time) + 1)
                    }, d === n && (o = !0), v(2)
                }, d.fps = function (e) {
                    return arguments.length ? (i = e, s = 1 / (i || 60), l = this.time + s, void d.wake()) : i
                }, d.useRAF = function (e) {
                    return arguments.length ? (d.sleep(), p = e, void d.fps(i)) : p
                }, d.fps(e), setTimeout(function () {
                    p && (!a || 5 > d.frame) && d.useRAF(!1)
                }, 1500)
            }), (s = d.Ticker.prototype = new d.events.EventDispatcher).constructor = d.Ticker;
            var M = g("core.Animation", function (e, t) {
                if (this.vars = t = t || {}, this._duration = this._totalDuration = e || 0, this._delay = Number(t.delay) || 0, this._timeScale = 1, this._active = !0 === t.immediateRender, this.data = t.data, this._reversed = !0 === t.reversed, G) {
                    o || n.wake();
                    var i = this.vars.useFrames ? B : G;
                    i.add(this, i._time), this.vars.paused && this.paused(!0)
                }
            });
            n = M.ticker = new d.Ticker, (s = M.prototype)._dirty = s._gc = s._initted = s._paused = !1, s._totalTime = s._time = 0, s._rawPrevTime = -1, s._next = s._last = s._onUpdate = s._timeline = s.timeline = null, s._paused = !1;
            var k = function () {
                o && C() - P > 2e3 && n.wake(), setTimeout(k, 2e3)
            };
            k(), s.play = function (e, t) {
                return null != e && this.seek(e, t), this.reversed(!1).paused(!1)
            }, s.pause = function (e, t) {
                return null != e && this.seek(e, t), this.paused(!0)
            }, s.resume = function (e, t) {
                return null != e && this.seek(e, t), this.paused(!1)
            }, s.seek = function (e, t) {
                return this.totalTime(Number(e), !1 !== t)
            }, s.restart = function (e, t) {
                return this.reversed(!1).paused(!1).totalTime(e ? -this._delay : 0, !1 !== t, !0)
            }, s.reverse = function (e, t) {
                return null != e && this.seek(e || this.totalDuration(), t), this.reversed(!0).paused(!1)
            }, s.render = function () {}, s.invalidate = function () {
                return this._time = this._totalTime = 0, this._initted = this._gc = !1, this._rawPrevTime = -1, (this._gc || !this.timeline) && this._enabled(!0), this
            }, s.isActive = function () {
                var e, t = this._timeline,
                    i = this._startTime;
                return !t || !this._gc && !this._paused && t.isActive() && (e = t.rawTime()) >= i && i + this.totalDuration() / this._timeScale > e
            }, s._enabled = function (e, t) {
                return o || n.wake(), this._gc = !e, this._active = this.isActive(), !0 !== t && (e && !this.timeline ? this._timeline.add(this, this._startTime - this._delay) : !e && this.timeline && this._timeline._remove(this, !0)), !1
            }, s._kill = function () {
                return this._enabled(!1, !1)
            }, s.kill = function (e, t) {
                return this._kill(e, t), this
            }, s._uncache = function (e) {
                for (var t = e ? this : this.timeline; t;) t._dirty = !0, t = t.timeline;
                return this
            }, s._swapSelfInParams = function (e) {
                for (var t = e.length, i = e.concat(); --t > -1;) "{self}" === e[t] && (i[t] = this);
                return i
            }, s.eventCallback = function (e, t, i, r) {
                if ("on" === (e || "").substr(0, 2)) {
                    var a = this.vars;
                    if (1 === arguments.length) return a[e];
                    null == t ? delete a[e] : (a[e] = t, a[e + "Params"] = p(i) && -1 !== i.join("").indexOf("{self}") ? this._swapSelfInParams(i) : i, a[e + "Scope"] = r), "onUpdate" === e && (this._onUpdate = t)
                }
                return this
            }, s.delay = function (e) {
                return arguments.length ? (this._timeline.smoothChildTiming && this.startTime(this._startTime + e - this._delay), this._delay = e, this) : this._delay
            }, s.duration = function (e) {
                return arguments.length ? (this._duration = this._totalDuration = e, this._uncache(!0), this._timeline.smoothChildTiming && this._time > 0 && this._time < this._duration && 0 !== e && this.totalTime(this._totalTime * (e / this._duration), !0), this) : (this._dirty = !1, this._duration)
            }, s.totalDuration = function (e) {
                return this._dirty = !1, arguments.length ? this.duration(e) : this._totalDuration
            }, s.time = function (e, t) {
                return arguments.length ? (this._dirty && this.totalDuration(), this.totalTime(e > this._duration ? this._duration : e, t)) : this._time
            }, s.totalTime = function (e, t, i) {
                if (o || n.wake(), !arguments.length) return this._totalTime;
                if (this._timeline) {
                    if (0 > e && !i && (e += this.totalDuration()), this._timeline.smoothChildTiming) {
                        this._dirty && this.totalDuration();
                        var r = this._totalDuration,
                            a = this._timeline;
                        if (e > r && !i && (e = r), this._startTime = (this._paused ? this._pauseTime : a._time) - (this._reversed ? r - e : e) / this._timeScale, a._dirty || this._uncache(!1), a._timeline)
                            for (; a._timeline;) a._timeline._time !== (a._startTime + a._totalTime) / a._timeScale && a.totalTime(a._totalTime, !0), a = a._timeline
                    }
                    this._gc && this._enabled(!0, !1), (this._totalTime !== e || 0 === this._duration) && (this.render(e, t, !1), D.length && H())
                }
                return this
            }, s.progress = s.totalProgress = function (e, t) {
                return arguments.length ? this.totalTime(this.duration() * e, t) : this._time / this.duration()
            }, s.startTime = function (e) {
                return arguments.length ? (e !== this._startTime && (this._startTime = e, this.timeline && this.timeline._sortChildren && this.timeline.add(this, e - this._delay)), this) : this._startTime
            }, s.endTime = function (e) {
                return this._startTime + (0 != e ? this.totalDuration() : this.duration()) / this._timeScale
            }, s.timeScale = function (e) {
                if (!arguments.length) return this._timeScale;
                if (e = e || h, this._timeline && this._timeline.smoothChildTiming) {
                    var t = this._pauseTime,
                        i = t || 0 === t ? t : this._timeline.totalTime();
                    this._startTime = i - (i - this._startTime) * this._timeScale / e
                }
                return this._timeScale = e, this._uncache(!1)
            }, s.reversed = function (e) {
                return arguments.length ? (e != this._reversed && (this._reversed = e, this.totalTime(this._timeline && !this._timeline.smoothChildTiming ? this.totalDuration() - this._totalTime : this._totalTime, !0)), this) : this._reversed
            }, s.paused = function (e) {
                if (!arguments.length) return this._paused;
                if (e != this._paused && this._timeline) {
                    o || e || n.wake();
                    var t = this._timeline,
                        i = t.rawTime(),
                        r = i - this._pauseTime;
                    !e && t.smoothChildTiming && (this._startTime += r, this._uncache(!1)), this._pauseTime = e ? i : null, this._paused = e, this._active = this.isActive(), !e && 0 !== r && this._initted && this.duration() && this.render(t.smoothChildTiming ? this._totalTime : (i - this._startTime) / this._timeScale, !0, !0)
                }
                return this._gc && !e && this._enabled(!0, !1), this
            };
            var z = g("core.SimpleTimeline", function (e) {
                M.call(this, 0, e), this.autoRemoveChildren = this.smoothChildTiming = !0
            });
            (s = z.prototype = new M).constructor = z, s.kill()._gc = !1, s._first = s._last = s._recent = null, s._sortChildren = !1, s.add = s.insert = function (e, t) {
                var i, r;
                if (e._startTime = Number(t || 0) + e._delay, e._paused && this !== e._timeline && (e._pauseTime = e._startTime + (this.rawTime() - e._startTime) / e._timeScale), e.timeline && e.timeline._remove(e, !0), e.timeline = e._timeline = this, e._gc && e._enabled(!0, !0), i = this._last, this._sortChildren)
                    for (r = e._startTime; i && i._startTime > r;) i = i._prev;
                return i ? (e._next = i._next, i._next = e) : (e._next = this._first, this._first = e), e._next ? e._next._prev = e : this._last = e, e._prev = i, this._recent = e, this._timeline && this._uncache(!0), this
            }, s._remove = function (e, t) {
                return e.timeline === this && (t || e._enabled(!1, !0), e._prev ? e._prev._next = e._next : this._first === e && (this._first = e._next), e._next ? e._next._prev = e._prev : this._last === e && (this._last = e._prev), e._next = e._prev = e.timeline = null, e === this._recent && (this._recent = this._last), this._timeline && this._uncache(!0)), this
            }, s.render = function (e, t, i) {
                var r, a = this._first;
                for (this._totalTime = this._time = this._rawPrevTime = e; a;) r = a._next, (a._active || e >= a._startTime && !a._paused) && (a._reversed ? a.render((a._dirty ? a.totalDuration() : a._totalDuration) - (e - a._startTime) * a._timeScale, t, i) : a.render((e - a._startTime) * a._timeScale, t, i)), a = r
            }, s.rawTime = function () {
                return o || n.wake(), this._totalTime
            };
            var R = g("TweenLite", function (t, i, r) {
                    if (M.call(this, i, r), this.render = R.prototype.render, null == t) throw "Cannot tween a null target.";
                    this.target = t = "string" != typeof t ? t : R.selector(t) || t;
                    var a, s, n, o = t.jquery || t.length && t !== e && t[0] && (t[0] === e || t[0].nodeType && t[0].style && !t.nodeType),
                        l = this.vars.overwrite;
                    if (this._overwrite = l = null == l ? Y[R.defaultOverwrite] : "number" == typeof l ? l >> 0 : Y[l], (o || t instanceof Array || t.push && p(t)) && "number" != typeof t[0])
                        for (this._targets = n = c(t), this._propLookup = [], this._siblings = [], a = 0; n.length > a; a++) s = n[a], s ? "string" != typeof s ? s.length && s !== e && s[0] && (s[0] === e || s[0].nodeType && s[0].style && !s.nodeType) ? (n.splice(a--, 1), this._targets = n = n.concat(c(s))) : (this._siblings[a] = V(s, this, !1), 1 === l && this._siblings[a].length > 1 && W(s, this, null, 1, this._siblings[a])) : "string" == typeof (s = n[a--] = R.selector(s)) && n.splice(a + 1, 1) : n.splice(a--, 1);
                    else this._propLookup = {}, this._siblings = V(t, this, !1), 1 === l && this._siblings.length > 1 && W(t, this, null, 1, this._siblings);
                    (this.vars.immediateRender || 0 === i && 0 === this._delay && !1 !== this.vars.immediateRender) && (this._time = -h, this.render(-this._delay))
                }, !0),
                O = function (t) {
                    return t && t.length && t !== e && t[0] && (t[0] === e || t[0].nodeType && t[0].style && !t.nodeType)
                },
                A = function (e, t) {
                    var i, r = {};
                    for (i in e) X[i] || i in t && "transform" !== i && "x" !== i && "y" !== i && "width" !== i && "height" !== i && "className" !== i && "border" !== i || !(!N[i] || N[i] && N[i]._autoCSS) || (r[i] = e[i], delete e[i]);
                    e.css = r
                };
            (s = R.prototype = new M).constructor = R, s.kill()._gc = !1, s.ratio = 0, s._firstPT = s._targets = s._overwrittenProps = s._startAt = null, s._notifyPluginsOfEnabled = s._lazy = !1, R.version = "1.15.1", R.defaultEase = s._ease = new w(null, null, 1, 1), R.defaultOverwrite = "auto", R.ticker = n, R.autoSleep = !0, R.lagSmoothing = function (e, t) {
                n.lagSmoothing(e, t)
            }, R.selector = e.$ || e.jQuery || function (t) {
                var i = e.$ || e.jQuery;
                return i ? (R.selector = i, i(t)) : "undefined" == typeof document ? t : document.querySelectorAll ? document.querySelectorAll(t) : document.getElementById("#" === t.charAt(0) ? t.substr(1) : t)
            };
            var D = [],
                I = {},
                L = R._internals = {
                    isArray: p,
                    isSelector: O,
                    lazyTweens: D
                },
                N = R._plugins = {},
                $ = L.tweenLookup = {},
                F = 0,
                X = L.reservedProps = {
                    ease: 1,
                    delay: 1,
                    overwrite: 1,
                    onComplete: 1,
                    onCompleteParams: 1,
                    onCompleteScope: 1,
                    useFrames: 1,
                    runBackwards: 1,
                    startAt: 1,
                    onUpdate: 1,
                    onUpdateParams: 1,
                    onUpdateScope: 1,
                    onStart: 1,
                    onStartParams: 1,
                    onStartScope: 1,
                    onReverseComplete: 1,
                    onReverseCompleteParams: 1,
                    onReverseCompleteScope: 1,
                    onRepeat: 1,
                    onRepeatParams: 1,
                    onRepeatScope: 1,
                    easeParams: 1,
                    yoyo: 1,
                    immediateRender: 1,
                    repeat: 1,
                    repeatDelay: 1,
                    data: 1,
                    paused: 1,
                    reversed: 1,
                    autoCSS: 1,
                    lazy: 1,
                    onOverwrite: 1
                },
                Y = {
                    none: 0,
                    all: 1,
                    auto: 2,
                    concurrent: 3,
                    allOnStart: 4,
                    preexisting: 5,
                    true: 1,
                    false: 0
                },
                B = M._rootFramesTimeline = new z,
                G = M._rootTimeline = new z,
                H = L.lazyRender = function () {
                    var e, t = D.length;
                    for (I = {}; --t > -1;)(e = D[t]) && !1 !== e._lazy && (e.render(e._lazy[0], e._lazy[1], !0), e._lazy = !1);
                    D.length = 0
                };
            G._startTime = n.time, B._startTime = n.frame, G._active = B._active = !0, setTimeout(H, 1), M._updateRoot = R.render = function () {
                var e, t, i;
                if (D.length && H(), G.render((n.time - G._startTime) * G._timeScale, !1, !1), B.render((n.frame - B._startTime) * B._timeScale, !1, !1), D.length && H(), !(n.frame % 120)) {
                    for (i in $) {
                        for (e = (t = $[i].tweens).length; --e > -1;) t[e]._gc && t.splice(e, 1);
                        0 === t.length && delete $[i]
                    }
                    if ((!(i = G._first) || i._paused) && R.autoSleep && !B._first && 1 === n._listeners.tick.length) {
                        for (; i && i._paused;) i = i._next;
                        i || n.sleep()
                    }
                }
            }, n.addEventListener("tick", M._updateRoot);
            var V = function (e, t, i) {
                    var r, a, s = e._gsTweenID;
                    if ($[s || (e._gsTweenID = s = "t" + F++)] || ($[s] = {
                            target: e,
                            tweens: []
                        }), t && (r = $[s].tweens, r[a = r.length] = t, i))
                        for (; --a > -1;) r[a] === t && r.splice(a, 1);
                    return $[s].tweens
                },
                j = function (e, t, i, r) {
                    var a, s, n = e.vars.onOverwrite;
                    return n && (a = n(e, t, i, r)), (n = R.onOverwrite) && (s = n(e, t, i, r)), !1 !== a && !1 !== s
                },
                W = function (e, t, i, r, a) {
                    var s, n, o, l;
                    if (1 === r || r >= 4) {
                        for (l = a.length, s = 0; l > s; s++)
                            if ((o = a[s]) !== t) o._gc || j(o, t) && o._enabled(!1, !1) && (n = !0);
                            else if (5 === r) break;
                        return n
                    }
                    var d, c = t._startTime + h,
                        u = [],
                        p = 0,
                        f = 0 === t._duration;
                    for (s = a.length; --s > -1;)(o = a[s]) === t || o._gc || o._paused || (o._timeline !== t._timeline ? (d = d || U(t, 0, f), 0 === U(o, d, f) && (u[p++] = o)) : c >= o._startTime && o._startTime + o.totalDuration() / o._timeScale > c && ((f || !o._initted) && 2e-10 >= c - o._startTime || (u[p++] = o)));
                    for (s = p; --s > -1;)
                        if (o = u[s], 2 === r && o._kill(i, e, t) && (n = !0), 2 !== r || !o._firstPT && o._initted) {
                            if (2 !== r && !j(o, t)) continue;
                            o._enabled(!1, !1) && (n = !0)
                        } return n
                },
                U = function (e, t, i) {
                    for (var r = e._timeline, a = r._timeScale, s = e._startTime; r._timeline;) {
                        if (s += r._startTime, a *= r._timeScale, r._paused) return -100;
                        r = r._timeline
                    }
                    return s /= a, s > t ? s - t : i && s === t || !e._initted && 2 * h > s - t ? h : (s += e.totalDuration() / e._timeScale / a) > t + h ? 0 : s - t - h
                };
            s._init = function () {
                var e, t, i, r, a, s = this.vars,
                    n = this._overwrittenProps,
                    o = this._duration,
                    l = !!s.immediateRender,
                    d = s.ease;
                if (s.startAt) {
                    this._startAt && (this._startAt.render(-1, !0), this._startAt.kill()), a = {};
                    for (r in s.startAt) a[r] = s.startAt[r];
                    if (a.overwrite = !1, a.immediateRender = !0, a.lazy = l && !1 !== s.lazy, a.startAt = a.delay = null, this._startAt = R.to(this.target, 0, a), l)
                        if (this._time > 0) this._startAt = null;
                        else if (0 !== o) return
                } else if (s.runBackwards && 0 !== o)
                    if (this._startAt) this._startAt.render(-1, !0), this._startAt.kill(), this._startAt = null;
                    else {
                        0 !== this._time && (l = !1), i = {};
                        for (r in s) X[r] && "autoCSS" !== r || (i[r] = s[r]);
                        if (i.overwrite = 0, i.data = "isFromStart", i.lazy = l && !1 !== s.lazy, i.immediateRender = l, this._startAt = R.to(this.target, 0, i), l) {
                            if (0 === this._time) return
                        } else this._startAt._init(), this._startAt._enabled(!1), this.vars.immediateRender && (this._startAt = null)
                    } if (this._ease = d = d ? d instanceof w ? d : "function" == typeof d ? new w(d, s.easeParams) : b[d] || R.defaultEase : R.defaultEase, s.easeParams instanceof Array && d.config && (this._ease = d.config.apply(d, s.easeParams)), this._easeType = this._ease._type, this._easePower = this._ease._power, this._firstPT = null, this._targets)
                    for (e = this._targets.length; --e > -1;) this._initProps(this._targets[e], this._propLookup[e] = {}, this._siblings[e], n ? n[e] : null) && (t = !0);
                else t = this._initProps(this.target, this._propLookup, this._siblings, n);
                if (t && R._onPluginEvent("_onInitAllProps", this), n && (this._firstPT || "function" != typeof this.target && this._enabled(!1, !1)), s.runBackwards)
                    for (i = this._firstPT; i;) i.s += i.c, i.c = -i.c, i = i._next;
                this._onUpdate = s.onUpdate, this._initted = !0
            }, s._initProps = function (t, i, r, a) {
                var s, n, o, l, d, h;
                if (null == t) return !1;
                I[t._gsTweenID] && H(), this.vars.css || t.style && t !== e && t.nodeType && N.css && !1 !== this.vars.autoCSS && A(this.vars, t);
                for (s in this.vars) {
                    if (h = this.vars[s], X[s]) h && (h instanceof Array || h.push && p(h)) && -1 !== h.join("").indexOf("{self}") && (this.vars[s] = h = this._swapSelfInParams(h, this));
                    else if (N[s] && (l = new N[s])._onInitTween(t, this.vars[s], this)) {
                        for (this._firstPT = d = {
                                _next: this._firstPT,
                                t: l,
                                p: "setRatio",
                                s: 0,
                                c: 1,
                                f: !0,
                                n: s,
                                pg: !0,
                                pr: l._priority
                            }, n = l._overwriteProps.length; --n > -1;) i[l._overwriteProps[n]] = this._firstPT;
                        (l._priority || l._onInitAllProps) && (o = !0), (l._onDisable || l._onEnable) && (this._notifyPluginsOfEnabled = !0)
                    } else this._firstPT = i[s] = d = {
                        _next: this._firstPT,
                        t: t,
                        p: s,
                        f: "function" == typeof t[s],
                        n: s,
                        pg: !1,
                        pr: 0
                    }, d.s = d.f ? t[s.indexOf("set") || "function" != typeof t["get" + s.substr(3)] ? s : "get" + s.substr(3)]() : parseFloat(t[s]), d.c = "string" == typeof h && "=" === h.charAt(1) ? parseInt(h.charAt(0) + "1", 10) * Number(h.substr(2)) : Number(h) - d.s || 0;
                    d && d._next && (d._next._prev = d)
                }
                return a && this._kill(a, t) ? this._initProps(t, i, r, a) : this._overwrite > 1 && this._firstPT && r.length > 1 && W(t, this, i, this._overwrite, r) ? (this._kill(i, t), this._initProps(t, i, r, a)) : (this._firstPT && (!1 !== this.vars.lazy && this._duration || this.vars.lazy && !this._duration) && (I[t._gsTweenID] = !0), o)
            }, s.render = function (e, t, i) {
                var r, a, s, n, o = this._time,
                    l = this._duration,
                    d = this._rawPrevTime;
                if (e >= l) this._totalTime = this._time = l, this.ratio = this._ease._calcEnd ? this._ease.getRatio(1) : 1, this._reversed || (r = !0, a = "onComplete"), 0 === l && (this._initted || !this.vars.lazy || i) && (this._startTime === this._timeline._duration && (e = 0), (0 === e || 0 > d || d === h && "isPause" !== this.data) && d !== e && (i = !0, d > h && (a = "onReverseComplete")), this._rawPrevTime = n = !t || e || d === e ? e : h);
                else if (1e-7 > e) this._totalTime = this._time = 0, this.ratio = this._ease._calcEnd ? this._ease.getRatio(0) : 0, (0 !== o || 0 === l && d > 0 && d !== h) && (a = "onReverseComplete", r = this._reversed), 0 > e && (this._active = !1, 0 === l && (this._initted || !this.vars.lazy || i) && (d >= 0 && (d !== h || "isPause" !== this.data) && (i = !0), this._rawPrevTime = n = !t || e || d === e ? e : h)), this._initted || (i = !0);
                else if (this._totalTime = this._time = e, this._easeType) {
                    var c = e / l,
                        u = this._easeType,
                        p = this._easePower;
                    (1 === u || 3 === u && c >= .5) && (c = 1 - c), 3 === u && (c *= 2), 1 === p ? c *= c : 2 === p ? c *= c * c : 3 === p ? c *= c * c * c : 4 === p && (c *= c * c * c * c), this.ratio = 1 === u ? 1 - c : 2 === u ? c : .5 > e / l ? c / 2 : 1 - c / 2
                } else this.ratio = this._ease.getRatio(e / l);
                if (this._time !== o || i) {
                    if (!this._initted) {
                        if (this._init(), !this._initted || this._gc) return;
                        if (!i && this._firstPT && (!1 !== this.vars.lazy && this._duration || this.vars.lazy && !this._duration)) return this._time = this._totalTime = o, this._rawPrevTime = d, D.push(this), void(this._lazy = [e, t]);
                        this._time && !r ? this.ratio = this._ease.getRatio(this._time / l) : r && this._ease._calcEnd && (this.ratio = this._ease.getRatio(0 === this._time ? 0 : 1))
                    }
                    for (!1 !== this._lazy && (this._lazy = !1), this._active || !this._paused && this._time !== o && e >= 0 && (this._active = !0), 0 === o && (this._startAt && (e >= 0 ? this._startAt.render(e, t, i) : a || (a = "_dummyGS")), this.vars.onStart && (0 !== this._time || 0 === l) && (t || this.vars.onStart.apply(this.vars.onStartScope || this, this.vars.onStartParams || y))), s = this._firstPT; s;) s.f ? s.t[s.p](s.c * this.ratio + s.s) : s.t[s.p] = s.c * this.ratio + s.s, s = s._next;
                    this._onUpdate && (0 > e && this._startAt && -1e-4 !== e && this._startAt.render(e, t, i), t || (this._time !== o || r) && this._onUpdate.apply(this.vars.onUpdateScope || this, this.vars.onUpdateParams || y)), a && (!this._gc || i) && (0 > e && this._startAt && !this._onUpdate && -1e-4 !== e && this._startAt.render(e, t, i), r && (this._timeline.autoRemoveChildren && this._enabled(!1, !1), this._active = !1), !t && this.vars[a] && this.vars[a].apply(this.vars[a + "Scope"] || this, this.vars[a + "Params"] || y), 0 === l && this._rawPrevTime === h && n !== h && (this._rawPrevTime = 0))
                }
            }, s._kill = function (e, t, i) {
                if ("all" === e && (e = null), null == e && (null == t || t === this.target)) return this._lazy = !1, this._enabled(!1, !1);
                t = "string" != typeof t ? t || this._targets || this.target : R.selector(t) || t;
                var r, a, s, n, o, l, d, h, c;
                if ((p(t) || O(t)) && "number" != typeof t[0])
                    for (r = t.length; --r > -1;) this._kill(e, t[r]) && (l = !0);
                else {
                    if (this._targets) {
                        for (r = this._targets.length; --r > -1;)
                            if (t === this._targets[r]) {
                                o = this._propLookup[r] || {}, this._overwrittenProps = this._overwrittenProps || [], a = this._overwrittenProps[r] = e ? this._overwrittenProps[r] || {} : "all";
                                break
                            }
                    } else {
                        if (t !== this.target) return !1;
                        o = this._propLookup, a = this._overwrittenProps = e ? this._overwrittenProps || {} : "all"
                    }
                    if (o) {
                        if (d = e || o, h = e !== a && "all" !== a && e !== o && ("object" != typeof e || !e._tempKill), i && (R.onOverwrite || this.vars.onOverwrite)) {
                            for (s in d) o[s] && (c || (c = []), c.push(s));
                            if (!j(this, i, t, c)) return !1
                        }
                        for (s in d)(n = o[s]) && (n.pg && n.t._kill(d) && (l = !0), n.pg && 0 !== n.t._overwriteProps.length || (n._prev ? n._prev._next = n._next : n === this._firstPT && (this._firstPT = n._next), n._next && (n._next._prev = n._prev), n._next = n._prev = null), delete o[s]), h && (a[s] = 1);
                        !this._firstPT && this._initted && this._enabled(!1, !1)
                    }
                }
                return l
            }, s.invalidate = function () {
                return this._notifyPluginsOfEnabled && R._onPluginEvent("_onDisable", this), this._firstPT = this._overwrittenProps = this._startAt = this._onUpdate = null, this._notifyPluginsOfEnabled = this._active = this._lazy = !1, this._propLookup = this._targets ? {} : [], M.prototype.invalidate.call(this), this.vars.immediateRender && (this._time = -h, this.render(-this._delay)), this
            }, s._enabled = function (e, t) {
                if (o || n.wake(), e && this._gc) {
                    var i, r = this._targets;
                    if (r)
                        for (i = r.length; --i > -1;) this._siblings[i] = V(r[i], this, !0);
                    else this._siblings = V(this.target, this, !0)
                }
                return M.prototype._enabled.call(this, e, t), !(!this._notifyPluginsOfEnabled || !this._firstPT) && R._onPluginEvent(e ? "_onEnable" : "_onDisable", this)
            }, R.to = function (e, t, i) {
                return new R(e, t, i)
            }, R.from = function (e, t, i) {
                return i.runBackwards = !0, i.immediateRender = 0 != i.immediateRender, new R(e, t, i)
            }, R.fromTo = function (e, t, i, r) {
                return r.startAt = i, r.immediateRender = 0 != r.immediateRender && 0 != i.immediateRender, new R(e, t, r)
            }, R.delayedCall = function (e, t, i, r, a) {
                return new R(t, 0, {
                    delay: e,
                    onComplete: t,
                    onCompleteParams: i,
                    onCompleteScope: r,
                    onReverseComplete: t,
                    onReverseCompleteParams: i,
                    onReverseCompleteScope: r,
                    immediateRender: !1,
                    lazy: !1,
                    useFrames: a,
                    overwrite: 0
                })
            }, R.set = function (e, t) {
                return new R(e, 0, t)
            }, R.getTweensOf = function (e, t) {
                if (null == e) return [];
                e = "string" != typeof e ? e : R.selector(e) || e;
                var i, r, a, s;
                if ((p(e) || O(e)) && "number" != typeof e[0]) {
                    for (i = e.length, r = []; --i > -1;) r = r.concat(R.getTweensOf(e[i], t));
                    for (i = r.length; --i > -1;)
                        for (s = r[i], a = i; --a > -1;) s === r[a] && r.splice(i, 1)
                } else
                    for (r = V(e).concat(), i = r.length; --i > -1;)(r[i]._gc || t && !r[i].isActive()) && r.splice(i, 1);
                return r
            }, R.killTweensOf = R.killDelayedCallsTo = function (e, t, i) {
                "object" == typeof t && (i = t, t = !1);
                for (var r = R.getTweensOf(e, t), a = r.length; --a > -1;) r[a]._kill(i, e)
            };
            var q = g("plugins.TweenPlugin", function (e, t) {
                this._overwriteProps = (e || "").split(","), this._propName = this._overwriteProps[0], this._priority = t || 0, this._super = q.prototype
            }, !0);
            if (s = q.prototype, q.version = "1.10.1", q.API = 2, s._firstPT = null, s._addTween = function (e, t, i, r, a, s) {
                    var n, o;
                    return null != r && (n = "number" == typeof r || "=" !== r.charAt(1) ? Number(r) - i : parseInt(r.charAt(0) + "1", 10) * Number(r.substr(2))) ? (this._firstPT = o = {
                        _next: this._firstPT,
                        t: e,
                        p: t,
                        s: i,
                        c: n,
                        f: "function" == typeof e[t],
                        n: a || t,
                        r: s
                    }, o._next && (o._next._prev = o), o) : void 0
                }, s.setRatio = function (e) {
                    for (var t, i = this._firstPT; i;) t = i.c * e + i.s, i.r ? t = Math.round(t) : 1e-6 > t && t > -1e-6 && (t = 0), i.f ? i.t[i.p](t) : i.t[i.p] = t, i = i._next
                }, s._kill = function (e) {
                    var t, i = this._overwriteProps,
                        r = this._firstPT;
                    if (null != e[this._propName]) this._overwriteProps = [];
                    else
                        for (t = i.length; --t > -1;) null != e[i[t]] && i.splice(t, 1);
                    for (; r;) null != e[r.n] && (r._next && (r._next._prev = r._prev), r._prev ? (r._prev._next = r._next, r._prev = null) : this._firstPT === r && (this._firstPT = r._next)), r = r._next;
                    return !1
                }, s._roundProps = function (e, t) {
                    for (var i = this._firstPT; i;)(e[this._propName] || null != i.n && e[i.n.split(this._propName + "_").join("")]) && (i.r = t), i = i._next
                }, R._onPluginEvent = function (e, t) {
                    var i, r, a, s, n, o = t._firstPT;
                    if ("_onInitAllProps" === e) {
                        for (; o;) {
                            for (n = o._next, r = a; r && r.pr > o.pr;) r = r._next;
                            (o._prev = r ? r._prev : s) ? o._prev._next = o: a = o, (o._next = r) ? r._prev = o : s = o, o = n
                        }
                        o = t._firstPT = a
                    }
                    for (; o;) o.pg && "function" == typeof o.t[e] && o.t[e]() && (i = !0), o = o._next;
                    return i
                }, q.activate = function (e) {
                    for (var t = e.length; --t > -1;) e[t].API === q.API && (N[(new e[t])._propName] = e[t]);
                    return !0
                }, v.plugin = function (e) {
                    if (!(e && e.propName && e.init && e.API)) throw "illegal plugin definition.";
                    var t, i = e.propName,
                        r = e.priority || 0,
                        a = e.overwriteProps,
                        s = {
                            init: "_onInitTween",
                            set: "setRatio",
                            kill: "_kill",
                            round: "_roundProps",
                            initAll: "_onInitAllProps"
                        },
                        n = g("plugins." + i.charAt(0).toUpperCase() + i.substr(1) + "Plugin", function () {
                            q.call(this, i, r), this._overwriteProps = a || []
                        }, !0 === e.global),
                        o = n.prototype = new q(i);
                    o.constructor = n, n.API = e.API;
                    for (t in s) "function" == typeof e[t] && (o[s[t]] = e[t]);
                    return n.version = e.version, q.activate([n]), n
                }, r = e._gsQueue) {
                for (a = 0; r.length > a; a++) r[a]();
                for (s in f) f[s].func || e.console.log("GSAP encountered missing dependency: com.greensock." + s)
            }
            o = !1
        }
    }("undefined" != typeof module && module.exports && "undefined" != typeof global ? global : this || window),
    function (e, t) {
        "function" == typeof define && define.amd ? define(t) : "object" == typeof exports ? module.exports = t() : e.ScrollMagic = t()
    }(this, function () {
        "use strict";
        var e = function () {
            r.log(2, "(COMPATIBILITY NOTICE) -> As of ScrollMagic 2.0.0 you need to use 'new ScrollMagic.Controller()' to create a new controller instance. Use 'new ScrollMagic.Scene()' to instance a scene.")
        };
        e.version = "2.0.5", window.addEventListener("mousewheel", function () {});
        e.Controller = function (i) {
            var a, s, n = "ScrollMagic.Controller",
                o = t.defaults,
                l = this,
                d = r.extend({}, o, i),
                h = [],
                c = !1,
                u = 0,
                p = "PAUSED",
                f = !0,
                m = 0,
                v = !0,
                g = function () {
                    d.refreshInterval > 0 && (s = window.setTimeout(S, d.refreshInterval))
                },
                _ = function () {
                    return d.vertical ? r.get.scrollTop(d.container) : r.get.scrollLeft(d.container)
                },
                y = function () {
                    return d.vertical ? r.get.height(d.container) : r.get.width(d.container)
                },
                w = this._setScrollPos = function (e) {
                    d.vertical ? f ? window.scrollTo(r.get.scrollLeft(), e) : d.container.scrollTop = e : f ? window.scrollTo(e, r.get.scrollTop()) : d.container.scrollLeft = e
                },
                b = function () {
                    if (v && c) {
                        var e = r.type.Array(c) ? c : h.slice(0);
                        c = !1;
                        var t = u,
                            i = (u = l.scrollPos()) - t;
                        0 !== i && (p = i > 0 ? "FORWARD" : "REVERSE"), "REVERSE" === p && e.reverse(), e.forEach(function (t, i) {
                            E(3, "updating Scene " + (i + 1) + "/" + e.length + " (" + h.length + " total)"), t.update(!0)
                        }), 0 === e.length && d.loglevel >= 3 && E(3, "updating 0 Scenes (nothing added to controller)")
                    }
                },
                x = function () {
                    a = r.rAF(b)
                },
                T = function (e) {
                    E(3, "event fired causing an update:", e.type), "resize" == e.type && (m = y(), p = "PAUSED"), !0 !== c && (c = !0, x())
                },
                S = function () {
                    if (!f && m != y()) {
                        var e;
                        try {
                            e = new Event("resize", {
                                bubbles: !1,
                                cancelable: !1
                            })
                        } catch (t) {
                            (e = document.createEvent("Event")).initEvent("resize", !1, !1)
                        }
                        d.container.dispatchEvent(e)
                    }
                    h.forEach(function (e, t) {
                        e.refresh()
                    }), g()
                },
                E = this._log = function (e, t) {
                    d.loglevel >= e && (Array.prototype.splice.call(arguments, 1, 0, "(" + n + ") ->"), r.log.apply(window, arguments))
                };
            this._options = d;
            var C = function (e) {
                if (e.length <= 1) return e;
                var t = e.slice(0);
                return t.sort(function (e, t) {
                    return e.scrollOffset() > t.scrollOffset() ? 1 : -1
                }), t
            };
            return this.addScene = function (t) {
                    if (r.type.Array(t)) t.forEach(function (e, t) {
                        l.addScene(e)
                    });
                    else if (t instanceof e.Scene) {
                        if (t.controller() !== l) t.addTo(l);
                        else if (h.indexOf(t) < 0) {
                            h.push(t), h = C(h), t.on("shift.controller_sort", function () {
                                h = C(h)
                            });
                            for (var i in d.globalSceneOptions) t[i] && t[i].call(t, d.globalSceneOptions[i]);
                            E(3, "adding Scene (now " + h.length + " total)")
                        }
                    } else E(1, "ERROR: invalid argument supplied for '.addScene()'");
                    return l
                }, this.removeScene = function (e) {
                    if (r.type.Array(e)) e.forEach(function (e, t) {
                        l.removeScene(e)
                    });
                    else {
                        var t = h.indexOf(e);
                        t > -1 && (e.off("shift.controller_sort"), h.splice(t, 1), E(3, "removing Scene (now " + h.length + " left)"), e.remove())
                    }
                    return l
                }, this.updateScene = function (t, i) {
                    return r.type.Array(t) ? t.forEach(function (e, t) {
                        l.updateScene(e, i)
                    }) : i ? t.update(!0) : !0 !== c && t instanceof e.Scene && (-1 == (c = c || []).indexOf(t) && c.push(t), c = C(c), x()), l
                }, this.update = function (e) {
                    return T({
                        type: "resize"
                    }), e && b(), l
                }, this.scrollTo = function (t, i) {
                    if (r.type.Number(t)) w.call(d.container, t, i);
                    else if (t instanceof e.Scene) t.controller() === l ? l.scrollTo(t.scrollOffset(), i) : E(2, "scrollTo(): The supplied scene does not belong to this controller. Scroll cancelled.", t);
                    else if (r.type.Function(t)) w = t;
                    else {
                        var a = r.get.elements(t)[0];
                        if (a) {
                            for (; a.parentNode.hasAttribute("data-scrollmagic-pin-spacer");) a = a.parentNode;
                            var s = d.vertical ? "top" : "left",
                                n = r.get.offset(d.container),
                                o = r.get.offset(a);
                            f || (n[s] -= l.scrollPos()), l.scrollTo(o[s] - n[s], i)
                        } else E(2, "scrollTo(): The supplied argument is invalid. Scroll cancelled.", t)
                    }
                    return l
                }, this.scrollPos = function (e) {
                    return arguments.length ? (r.type.Function(e) ? _ = e : E(2, "Provided value for method 'scrollPos' is not a function. To change the current scroll position use 'scrollTo()'."), l) : _.call(l)
                }, this.info = function (e) {
                    var t = {
                        size: m,
                        vertical: d.vertical,
                        scrollPos: u,
                        scrollDirection: p,
                        container: d.container,
                        isDocument: f
                    };
                    return arguments.length ? void 0 !== t[e] ? t[e] : void E(1, 'ERROR: option "' + e + '" is not available') : t
                }, this.loglevel = function (e) {
                    return arguments.length ? (d.loglevel != e && (d.loglevel = e), l) : d.loglevel
                }, this.enabled = function (e) {
                    return arguments.length ? (v != e && (v = !!e, l.updateScene(h, !0)), l) : v
                }, this.destroy = function (e) {
                    window.clearTimeout(s);
                    for (var t = h.length; t--;) h[t].destroy(e);
                    return d.container.removeEventListener("resize", T), d.container.removeEventListener("scroll", T), r.cAF(a), E(3, "destroyed " + n + " (reset: " + (e ? "true" : "false") + ")"), null
                },
                function () {
                    for (var t in d) o.hasOwnProperty(t) || (E(2, 'WARNING: Unknown option "' + t + '"'), delete d[t]);
                    if (d.container = r.get.elements(d.container)[0], !d.container) throw E(1, "ERROR creating object " + n + ": No valid scroll container supplied"), n + " init failed.";
                    (f = d.container === window || d.container === document.body || !document.body.contains(d.container)) && (d.container = window), m = y(), d.container.addEventListener("resize", T), d.container.addEventListener("scroll", T), d.refreshInterval = parseInt(d.refreshInterval) || o.refreshInterval, g(), E(3, "added new " + n + " controller (v" + e.version + ")")
                }(), l
        };
        var t = {
            defaults: {
                container: window,
                vertical: !0,
                globalSceneOptions: {},
                loglevel: 2,
                refreshInterval: 100
            }
        };
        e.Controller.addOption = function (e, i) {
            t.defaults[e] = i
        }, e.Controller.extend = function (t) {
            var i = this;
            e.Controller = function () {
                return i.apply(this, arguments), this.$super = r.extend({}, this), t.apply(this, arguments) || this
            }, r.extend(e.Controller, i), e.Controller.prototype = i.prototype, e.Controller.prototype.constructor = e.Controller
        }, e.Scene = function (t) {
            var a, s, n = "ScrollMagic.Scene",
                o = i.defaults,
                l = this,
                d = r.extend({}, o, t),
                h = "BEFORE",
                c = 0,
                u = {
                    start: 0,
                    end: 0
                },
                p = 0,
                f = !0,
                m = {};
            this.on = function (e, t) {
                return r.type.Function(t) ? (e = e.trim().split(" ")).forEach(function (e) {
                    var i = e.split("."),
                        r = i[0],
                        a = i[1];
                    "*" != r && (m[r] || (m[r] = []), m[r].push({
                        namespace: a || "",
                        callback: t
                    }))
                }) : v(1, "ERROR when calling '.on()': Supplied callback for '" + e + "' is not a valid function!"), l
            }, this.off = function (e, t) {
                return e ? ((e = e.trim().split(" ")).forEach(function (e, i) {
                    var r = e.split("."),
                        a = r[0],
                        s = r[1] || "";
                    ("*" === a ? Object.keys(m) : [a]).forEach(function (e) {
                        for (var i = m[e] || [], r = i.length; r--;) {
                            var a = i[r];
                            !a || s !== a.namespace && "*" !== s || t && t != a.callback || i.splice(r, 1)
                        }
                        i.length || delete m[e]
                    })
                }), l) : (v(1, "ERROR: Invalid event name supplied."), l)
            }, this.trigger = function (t, i) {
                if (t) {
                    var r = t.trim().split("."),
                        a = r[0],
                        s = r[1],
                        n = m[a];
                    v(3, "event fired:", a, i ? "->" : "", i || ""), n && n.forEach(function (t, r) {
                        s && s !== t.namespace || t.callback.call(l, new e.Event(a, t.namespace, l, i))
                    })
                } else v(1, "ERROR: Invalid event name supplied.");
                return l
            }, l.on("change.internal", function (e) {
                "loglevel" !== e.what && "tweenChanges" !== e.what && ("triggerElement" === e.what ? y() : "reverse" === e.what && l.update())
            }).on("shift.internal", function (e) {
                g(), l.update()
            });
            var v = this._log = function (e, t) {
                d.loglevel >= e && (Array.prototype.splice.call(arguments, 1, 0, "(" + n + ") ->"), r.log.apply(window, arguments))
            };
            this.addTo = function (t) {
                return t instanceof e.Controller ? s != t && (s && s.removeScene(l), s = t, x(), _(!0), y(!0), g(), s.info("container").addEventListener("resize", w), t.addScene(l), l.trigger("add", {
                    controller: s
                }), v(3, "added " + n + " to controller"), l.update()) : v(1, "ERROR: supplied argument of 'addTo()' is not a valid ScrollMagic Controller"), l
            }, this.enabled = function (e) {
                return arguments.length ? (f != e && (f = !!e, l.update(!0)), l) : f
            }, this.remove = function () {
                if (s) {
                    s.info("container").removeEventListener("resize", w);
                    var e = s;
                    s = void 0, e.removeScene(l), l.trigger("remove"), v(3, "removed " + n + " from controller")
                }
                return l
            }, this.destroy = function (e) {
                return l.trigger("destroy", {
                    reset: e
                }), l.remove(), l.off("*.*"), v(3, "destroyed " + n + " (reset: " + (e ? "true" : "false") + ")"), null
            }, this.update = function (e) {
                if (s)
                    if (e)
                        if (s.enabled() && f) {
                            var t, i = s.info("scrollPos");
                            t = d.duration > 0 ? (i - u.start) / (u.end - u.start) : i >= u.start ? 1 : 0, l.trigger("update", {
                                startPos: u.start,
                                endPos: u.end,
                                scrollPos: i
                            }), l.progress(t)
                        } else E && "DURING" === h && P(!0);
                else s.updateScene(l, !1);
                return l
            }, this.refresh = function () {
                return _(), y(), l
            }, this.progress = function (e) {
                if (arguments.length) {
                    var t = !1,
                        i = h,
                        r = s ? s.info("scrollDirection") : "PAUSED",
                        a = d.reverse || e >= c;
                    if (0 === d.duration ? (t = c != e, h = 0 === (c = e < 1 && a ? 0 : 1) ? "BEFORE" : "DURING") : e < 0 && "BEFORE" !== h && a ? (c = 0, h = "BEFORE", t = !0) : e >= 0 && e < 1 && a ? (c = e, h = "DURING", t = !0) : e >= 1 && "AFTER" !== h ? (c = 1, h = "AFTER", t = !0) : "DURING" !== h || a || P(), t) {
                        var n = {
                                progress: c,
                                state: h,
                                scrollDirection: r
                            },
                            o = h != i,
                            u = function (e) {
                                l.trigger(e, n)
                            };
                        o && "DURING" !== i && (u("enter"), u("BEFORE" === i ? "start" : "end")), u("progress"), o && "DURING" !== h && (u("BEFORE" === h ? "start" : "end"), u("leave"))
                    }
                    return l
                }
                return c
            };
            var g = function () {
                    u = {
                        start: p + d.offset
                    }, s && d.triggerElement && (u.start -= s.info("size") * d.triggerHook), u.end = u.start + d.duration
                },
                _ = function (e) {
                    if (a) {
                        T("duration", a.call(l)) && !e && (l.trigger("change", {
                            what: "duration",
                            newval: d.duration
                        }), l.trigger("shift", {
                            reason: "duration"
                        }))
                    }
                },
                y = function (e) {
                    var t = 0,
                        i = d.triggerElement;
                    if (s && i) {
                        for (var a = s.info(), n = r.get.offset(a.container), o = a.vertical ? "top" : "left"; i.parentNode.hasAttribute("data-scrollmagic-pin-spacer");) i = i.parentNode;
                        var h = r.get.offset(i);
                        a.isDocument || (n[o] -= s.scrollPos()), t = h[o] - n[o]
                    }
                    var c = t != p;
                    p = t, c && !e && l.trigger("shift", {
                        reason: "triggerElementPosition"
                    })
                },
                w = function (e) {
                    d.triggerHook > 0 && l.trigger("shift", {
                        reason: "containerResize"
                    })
                },
                b = r.extend(i.validate, {
                    duration: function (e) {
                        if (r.type.String(e) && e.match(/^(\.|\d)*\d+%$/)) {
                            var t = parseFloat(e) / 100;
                            e = function () {
                                return s ? s.info("size") * t : 0
                            }
                        }
                        if (r.type.Function(e)) {
                            a = e;
                            try {
                                e = parseFloat(a())
                            } catch (t) {
                                e = -1
                            }
                        }
                        if (e = parseFloat(e), !r.type.Number(e) || e < 0) throw a ? (a = void 0, ['Invalid return value of supplied function for option "duration":', e]) : ['Invalid value for option "duration":', e];
                        return e
                    }
                }),
                x = function (e) {
                    (e = arguments.length ? [e] : Object.keys(b)).forEach(function (e, t) {
                        var i;
                        if (b[e]) try {
                            i = b[e](d[e])
                        } catch (t) {
                            i = o[e];
                            var a = r.type.String(t) ? [t] : t;
                            r.type.Array(a) ? (a[0] = "ERROR: " + a[0], a.unshift(1), v.apply(this, a)) : v(1, "ERROR: Problem executing validation callback for option '" + e + "':", t.message)
                        } finally {
                            d[e] = i
                        }
                    })
                },
                T = function (e, t) {
                    var i = !1,
                        r = d[e];
                    return d[e] != t && (d[e] = t, x(e), i = r != d[e]), i
                },
                S = function (e) {
                    l[e] || (l[e] = function (t) {
                        return arguments.length ? ("duration" === e && (a = void 0), T(e, t) && (l.trigger("change", {
                            what: e,
                            newval: d[e]
                        }), i.shifts.indexOf(e) > -1 && l.trigger("shift", {
                            reason: e
                        })), l) : d[e]
                    })
                };
            this.controller = function () {
                return s
            }, this.state = function () {
                return h
            }, this.scrollOffset = function () {
                return u.start
            }, this.triggerPosition = function () {
                var e = d.offset;
                return s && (d.triggerElement ? e += p : e += s.info("size") * l.triggerHook()), e
            };
            var E, C;
            l.on("shift.internal", function (e) {
                var t = "duration" === e.reason;
                ("AFTER" === h && t || "DURING" === h && 0 === d.duration) && P(), t && M()
            }).on("progress.internal", function (e) {
                P()
            }).on("add.internal", function (e) {
                M()
            }).on("destroy.internal", function (e) {
                l.removePin(e.reset)
            });
            var P = function (e) {
                    if (E && s) {
                        var t = s.info(),
                            i = C.spacer.firstChild;
                        if (e || "DURING" !== h) {
                            var a = {
                                    position: C.inFlow ? "relative" : "absolute",
                                    top: 0,
                                    left: 0
                                },
                                n = r.css(i, "position") != a.position;
                            C.pushFollowers ? d.duration > 0 && ("AFTER" === h && 0 === parseFloat(r.css(C.spacer, "padding-top")) ? n = !0 : "BEFORE" === h && 0 === parseFloat(r.css(C.spacer, "padding-bottom")) && (n = !0)) : a[t.vertical ? "top" : "left"] = d.duration * c, r.css(i, a), n && M()
                        } else {
                            "fixed" != r.css(i, "position") && (r.css(i, {
                                position: "fixed"
                            }), M());
                            var o = r.get.offset(C.spacer, !0),
                                l = d.reverse || 0 === d.duration ? t.scrollPos - u.start : Math.round(c * d.duration * 10) / 10;
                            o[t.vertical ? "top" : "left"] += l, r.css(C.spacer.firstChild, {
                                top: o.top,
                                left: o.left
                            })
                        }
                    }
                },
                M = function () {
                    if (E && s && C.inFlow) {
                        var e = "DURING" === h,
                            t = s.info("vertical"),
                            i = C.spacer.firstChild,
                            a = r.isMarginCollapseType(r.css(C.spacer, "display")),
                            n = {};
                        C.relSize.width || C.relSize.autoFullWidth ? e ? r.css(E, {
                            width: r.get.width(C.spacer)
                        }) : r.css(E, {
                            width: "100%"
                        }) : (n["min-width"] = r.get.width(t ? E : i, !0, !0), n.width = e ? n["min-width"] : "auto"), C.relSize.height ? e ? r.css(E, {
                            height: r.get.height(C.spacer) - (C.pushFollowers ? d.duration : 0)
                        }) : r.css(E, {
                            height: "100%"
                        }) : (n["min-height"] = r.get.height(t ? i : E, !0, !a), n.height = e ? n["min-height"] : "auto"), C.pushFollowers && (n["padding" + (t ? "Top" : "Left")] = d.duration * c, n["padding" + (t ? "Bottom" : "Right")] = d.duration * (1 - c)), r.css(C.spacer, n)
                    }
                },
                k = function () {
                    s && E && "DURING" === h && !s.info("isDocument") && P()
                },
                z = function () {
                    s && E && "DURING" === h && ((C.relSize.width || C.relSize.autoFullWidth) && r.get.width(window) != r.get.width(C.spacer.parentNode) || C.relSize.height && r.get.height(window) != r.get.height(C.spacer.parentNode)) && M()
                },
                R = function (e) {
                    s && E && "DURING" === h && !s.info("isDocument") && (e.preventDefault(), s._setScrollPos(s.info("scrollPos") - ((e.wheelDelta || e[s.info("vertical") ? "wheelDeltaY" : "wheelDeltaX"]) / 3 || 30 * -e.detail)))
                };
            this.setPin = function (e, t) {
                var i = {
                    pushFollowers: !0,
                    spacerClass: "scrollmagic-pin-spacer"
                };
                if (t = r.extend({}, i, t), !(e = r.get.elements(e)[0])) return v(1, "ERROR calling method 'setPin()': Invalid pin element supplied."), l;
                if ("fixed" === r.css(e, "position")) return v(1, "ERROR calling method 'setPin()': Pin does not work with elements that are positioned 'fixed'."), l;
                if (E) {
                    if (E === e) return l;
                    l.removePin()
                }
                var a = (E = e).parentNode.style.display,
                    s = ["top", "left", "bottom", "right", "margin", "marginLeft", "marginRight", "marginTop", "marginBottom"];
                E.parentNode.style.display = "none";
                var n = "absolute" != r.css(E, "position"),
                    o = r.css(E, s.concat(["display"])),
                    h = r.css(E, ["width", "height"]);
                E.parentNode.style.display = a, !n && t.pushFollowers && (v(2, "WARNING: If the pinned element is positioned absolutely pushFollowers will be disabled."), t.pushFollowers = !1), window.setTimeout(function () {
                    E && 0 === d.duration && t.pushFollowers && v(2, "WARNING: pushFollowers =", !0, "has no effect, when scene duration is 0.")
                }, 0);
                var c = E.parentNode.insertBefore(document.createElement("div"), E),
                    u = r.extend(o, {
                        position: n ? "relative" : "absolute",
                        boxSizing: "content-box",
                        mozBoxSizing: "content-box",
                        webkitBoxSizing: "content-box"
                    });
                if (n || r.extend(u, r.css(E, ["width", "height"])), r.css(c, u), c.setAttribute("data-scrollmagic-pin-spacer", ""), r.addClass(c, t.spacerClass), C = {
                        spacer: c,
                        relSize: {
                            width: "%" === h.width.slice(-1),
                            height: "%" === h.height.slice(-1),
                            autoFullWidth: "auto" === h.width && n && r.isMarginCollapseType(o.display)
                        },
                        pushFollowers: t.pushFollowers,
                        inFlow: n
                    }, !E.___origStyle) {
                    E.___origStyle = {};
                    var p = E.style;
                    s.concat(["width", "height", "position", "boxSizing", "mozBoxSizing", "webkitBoxSizing"]).forEach(function (e) {
                        E.___origStyle[e] = p[e] || ""
                    })
                }
                return C.relSize.width && r.css(c, {
                    width: h.width
                }), C.relSize.height && r.css(c, {
                    height: h.height
                }), c.appendChild(E), r.css(E, {
                    position: n ? "relative" : "absolute",
                    margin: "auto",
                    top: "auto",
                    left: "auto",
                    bottom: "auto",
                    right: "auto"
                }), (C.relSize.width || C.relSize.autoFullWidth) && r.css(E, {
                    boxSizing: "border-box",
                    mozBoxSizing: "border-box",
                    webkitBoxSizing: "border-box"
                }), window.addEventListener("scroll", k), window.addEventListener("resize", k), window.addEventListener("resize", z), E.addEventListener("mousewheel", R), E.addEventListener("DOMMouseScroll", R), v(3, "added pin"), P(), l
            }, this.removePin = function (e) {
                if (E) {
                    if ("DURING" === h && P(!0), e || !s) {
                        var t = C.spacer.firstChild;
                        if (t.hasAttribute("data-scrollmagic-pin-spacer")) {
                            var i = C.spacer.style,
                                a = ["margin", "marginLeft", "marginRight", "marginTop", "marginBottom"];
                            margins = {}, a.forEach(function (e) {
                                margins[e] = i[e] || ""
                            }), r.css(t, margins)
                        }
                        C.spacer.parentNode.insertBefore(t, C.spacer), C.spacer.parentNode.removeChild(C.spacer), E.parentNode.hasAttribute("data-scrollmagic-pin-spacer") || (r.css(E, E.___origStyle), delete E.___origStyle)
                    }
                    window.removeEventListener("scroll", k), window.removeEventListener("resize", k), window.removeEventListener("resize", z), E.removeEventListener("mousewheel", R), E.removeEventListener("DOMMouseScroll", R), E = void 0, v(3, "removed pin (reset: " + (e ? "true" : "false") + ")")
                }
                return l
            };
            var O, A = [];
            return l.on("destroy.internal", function (e) {
                    l.removeClassToggle(e.reset)
                }), this.setClassToggle = function (e, t) {
                    var i = r.get.elements(e);
                    return 0 !== i.length && r.type.String(t) ? (A.length > 0 && l.removeClassToggle(), O = t, A = i, l.on("enter.internal_class leave.internal_class", function (e) {
                        var t = "enter" === e.type ? r.addClass : r.removeClass;
                        A.forEach(function (e, i) {
                            t(e, O)
                        })
                    }), l) : (v(1, "ERROR calling method 'setClassToggle()': Invalid " + (0 === i.length ? "element" : "classes") + " supplied."), l)
                }, this.removeClassToggle = function (e) {
                    return e && A.forEach(function (e, t) {
                        r.removeClass(e, O)
                    }), l.off("start.internal_class end.internal_class"), O = void 0, A = [], l
                },
                function () {
                    for (var e in d) o.hasOwnProperty(e) || (v(2, 'WARNING: Unknown option "' + e + '"'), delete d[e]);
                    for (var t in o) S(t);
                    x()
                }(), l
        };
        var i = {
            defaults: {
                duration: 0,
                offset: 0,
                triggerElement: void 0,
                triggerHook: .5,
                reverse: !0,
                loglevel: 2
            },
            validate: {
                offset: function (e) {
                    if (e = parseFloat(e), !r.type.Number(e)) throw ['Invalid value for option "offset":', e];
                    return e
                },
                triggerElement: function (e) {
                    if (e = e || void 0) {
                        var t = r.get.elements(e)[0];
                        if (!t) throw ['Element defined in option "triggerElement" was not found:', e];
                        e = t
                    }
                    return e
                },
                triggerHook: function (e) {
                    var t = {
                        onCenter: .5,
                        onEnter: 1,
                        onLeave: 0
                    };
                    if (r.type.Number(e)) e = Math.max(0, Math.min(parseFloat(e), 1));
                    else {
                        if (!(e in t)) throw ['Invalid value for option "triggerHook": ', e];
                        e = t[e]
                    }
                    return e
                },
                reverse: function (e) {
                    return !!e
                },
                loglevel: function (e) {
                    if (e = parseInt(e), !r.type.Number(e) || e < 0 || e > 3) throw ['Invalid value for option "loglevel":', e];
                    return e
                }
            },
            shifts: ["duration", "offset", "triggerHook"]
        };
        e.Scene.addOption = function (t, r, a, s) {
            t in i.defaults ? e._util.log(1, "[static] ScrollMagic.Scene -> Cannot add Scene option '" + t + "', because it already exists.") : (i.defaults[t] = r, i.validate[t] = a, s && i.shifts.push(t))
        }, e.Scene.extend = function (t) {
            var i = this;
            e.Scene = function () {
                return i.apply(this, arguments), this.$super = r.extend({}, this), t.apply(this, arguments) || this
            }, r.extend(e.Scene, i), e.Scene.prototype = i.prototype, e.Scene.prototype.constructor = e.Scene
        }, e.Event = function (e, t, i, r) {
            r = r || {};
            for (var a in r) this[a] = r[a];
            return this.type = e, this.target = this.currentTarget = i, this.namespace = t || "", this.timeStamp = this.timestamp = Date.now(), this
        };
        var r = e._util = function (e) {
            var t, i = {},
                r = function (e) {
                    return parseFloat(e) || 0
                },
                a = function (t) {
                    return t.currentStyle ? t.currentStyle : e.getComputedStyle(t)
                },
                s = function (t, i, s, n) {
                    if ((i = i === document ? e : i) === e) n = !1;
                    else if (!f.DomElement(i)) return 0;
                    t = t.charAt(0).toUpperCase() + t.substr(1).toLowerCase();
                    var o = (s ? i["offset" + t] || i["outer" + t] : i["client" + t] || i["inner" + t]) || 0;
                    if (s && n) {
                        var l = a(i);
                        o += "Height" === t ? r(l.marginTop) + r(l.marginBottom) : r(l.marginLeft) + r(l.marginRight)
                    }
                    return o
                },
                n = function (e) {
                    return e.replace(/^[^a-z]+([a-z])/g, "$1").replace(/-([a-z])/g, function (e) {
                        return e[1].toUpperCase()
                    })
                };
            i.extend = function (e) {
                for (e = e || {}, t = 1; t < arguments.length; t++)
                    if (arguments[t])
                        for (var i in arguments[t]) arguments[t].hasOwnProperty(i) && (e[i] = arguments[t][i]);
                return e
            }, i.isMarginCollapseType = function (e) {
                return ["block", "flex", "list-item", "table", "-webkit-box"].indexOf(e) > -1
            };
            var o = 0,
                l = ["ms", "moz", "webkit", "o"],
                d = e.requestAnimationFrame,
                h = e.cancelAnimationFrame;
            for (t = 0; !d && t < l.length; ++t) d = e[l[t] + "RequestAnimationFrame"], h = e[l[t] + "CancelAnimationFrame"] || e[l[t] + "CancelRequestAnimationFrame"];
            d || (d = function (t) {
                var i = (new Date).getTime(),
                    r = Math.max(0, 16 - (i - o)),
                    a = e.setTimeout(function () {
                        t(i + r)
                    }, r);
                return o = i + r, a
            }), h || (h = function (t) {
                e.clearTimeout(t)
            }), i.rAF = d.bind(e), i.cAF = h.bind(e);
            var c = ["error", "warn", "log"],
                u = e.console || {};
            for (u.log = u.log || function () {}, t = 0; t < c.length; t++) {
                var p = c[t];
                u[p] || (u[p] = u.log)
            }
            i.log = function (e) {
                (e > c.length || e <= 0) && (e = c.length);
                var t = new Date,
                    i = ("0" + t.getHours()).slice(-2) + ":" + ("0" + t.getMinutes()).slice(-2) + ":" + ("0" + t.getSeconds()).slice(-2) + ":" + ("00" + t.getMilliseconds()).slice(-3),
                    r = c[e - 1],
                    a = Array.prototype.splice.call(arguments, 1);
                Function.prototype.bind.call(u[r], u);
                a.unshift(i)
            };
            var f = i.type = function (e) {
                return Object.prototype.toString.call(e).replace(/^\[object (.+)\]$/, "$1").toLowerCase()
            };
            f.String = function (e) {
                return "string" === f(e)
            }, f.Function = function (e) {
                return "function" === f(e)
            }, f.Array = function (e) {
                return Array.isArray(e)
            }, f.Number = function (e) {
                return !f.Array(e) && e - parseFloat(e) + 1 >= 0
            }, f.DomElement = function (e) {
                return "object" == typeof HTMLElement ? e instanceof HTMLElement : e && "object" == typeof e && null !== e && 1 === e.nodeType && "string" == typeof e.nodeName
            };
            var m = i.get = {};
            return m.elements = function (t) {
                var i = [];
                if (f.String(t)) try {
                    t = document.querySelectorAll(t)
                } catch (e) {
                    return i
                }
                if ("nodelist" === f(t) || f.Array(t))
                    for (var r = 0, a = i.length = t.length; r < a; r++) {
                        var s = t[r];
                        i[r] = f.DomElement(s) ? s : m.elements(s)
                    } else(f.DomElement(t) || t === document || t === e) && (i = [t]);
                return i
            }, m.scrollTop = function (t) {
                return t && "number" == typeof t.scrollTop ? t.scrollTop : e.pageYOffset || 0
            }, m.scrollLeft = function (t) {
                return t && "number" == typeof t.scrollLeft ? t.scrollLeft : e.pageXOffset || 0
            }, m.width = function (e, t, i) {
                return s("width", e, t, i)
            }, m.height = function (e, t, i) {
                return s("height", e, t, i)
            }, m.offset = function (e, t) {
                var i = {
                    top: 0,
                    left: 0
                };
                if (e && e.getBoundingClientRect) {
                    var r = e.getBoundingClientRect();
                    i.top = r.top, i.left = r.left, t || (i.top += m.scrollTop(), i.left += m.scrollLeft())
                }
                return i
            }, i.addClass = function (e, t) {
                t && (e.classList ? e.classList.add(t) : e.className += " " + t)
            }, i.removeClass = function (e, t) {
                t && (e.classList ? e.classList.remove(t) : e.className = e.className.replace(new RegExp("(^|\\b)" + t.split(" ").join("|") + "(\\b|$)", "gi"), " "))
            }, i.css = function (e, t) {
                if (f.String(t)) return a(e)[n(t)];
                if (f.Array(t)) {
                    var i = {},
                        r = a(e);
                    return t.forEach(function (e, t) {
                        i[e] = r[n(e)]
                    }), i
                }
                for (var s in t) {
                    var o = t[s];
                    o == parseFloat(o) && (o += "px"), e.style[n(s)] = o
                }
            }, i
        }(window || {});
        return e.Scene.prototype.addIndicators = function () {
            return e._util.log(1, "(ScrollMagic.Scene) -> ERROR calling addIndicators() due to missing Plugin 'debug.addIndicators'. Please make sure to include plugins/debug.addIndicators.js"), this
        }, e.Scene.prototype.removeIndicators = function () {
            return e._util.log(1, "(ScrollMagic.Scene) -> ERROR calling removeIndicators() due to missing Plugin 'debug.addIndicators'. Please make sure to include plugins/debug.addIndicators.js"), this
        }, e.Scene.prototype.setTween = function () {
            return e._util.log(1, "(ScrollMagic.Scene) -> ERROR calling setTween() due to missing Plugin 'animation.gsap'. Please make sure to include plugins/animation.gsap.js"), this
        }, e.Scene.prototype.removeTween = function () {
            return e._util.log(1, "(ScrollMagic.Scene) -> ERROR calling removeTween() due to missing Plugin 'animation.gsap'. Please make sure to include plugins/animation.gsap.js"), this
        }, e.Scene.prototype.setVelocity = function () {
            return e._util.log(1, "(ScrollMagic.Scene) -> ERROR calling setVelocity() due to missing Plugin 'animation.velocity'. Please make sure to include plugins/animation.velocity.js"), this
        }, e.Scene.prototype.removeVelocity = function () {
            return e._util.log(1, "(ScrollMagic.Scene) -> ERROR calling removeVelocity() due to missing Plugin 'animation.velocity'. Please make sure to include plugins/animation.velocity.js"), this
        }, e
    }),
    function (e, t) {
        "function" == typeof define && define.amd ? define(["ScrollMagic", "TweenMax", "TimelineMax"], t) : "object" == typeof exports ? (require("gsap"), t(require("scrollmagic"), TweenMax, TimelineMax)) : t(e.ScrollMagic || e.jQuery && e.jQuery.ScrollMagic, e.TweenMax || e.TweenLite, e.TimelineMax || e.TimelineLite)
    }(this, function (e, t, i) {
        "use strict";
        var r = window.console || {},
            a = Function.prototype.bind.call(r.error || r.log || function () {}, r);
        e || a("(animation.gsap) -> ERROR: The ScrollMagic main module could not be found. Please make sure it's loaded before this plugin or use an asynchronous loader like requirejs."), t || a("(animation.gsap) -> ERROR: TweenLite or TweenMax could not be found. Please make sure GSAP is loaded before ScrollMagic or use an asynchronous loader like requirejs."), e.Scene.addOption("tweenChanges", !1, function (e) {
            return !!e
        }), e.Scene.extend(function () {
            var e, r = this,
                a = function () {
                    r._log && (Array.prototype.splice.call(arguments, 1, 0, "(animation.gsap)", "->"), r._log.apply(this, arguments))
                };
            r.on("progress.plugin_gsap", function () {
                s()
            }), r.on("destroy.plugin_gsap", function (e) {
                r.removeTween(e.reset)
            });
            var s = function () {
                if (e) {
                    var t = r.progress(),
                        i = r.state();
                    e.repeat && -1 === e.repeat() ? "DURING" === i && e.paused() ? e.play() : "DURING" === i || e.paused() || e.pause() : t != e.progress() && (0 === r.duration() ? t > 0 ? e.play() : e.reverse() : r.tweenChanges() && e.tweenTo ? e.tweenTo(t * e.duration()) : e.progress(t).pause())
                }
            };
            r.setTween = function (n, o, l) {
                var d;
                arguments.length > 1 && (arguments.length < 3 && (l = o, o = 1), n = t.to(n, o, l));
                try {
                    (d = i ? new i({
                        smoothChildTiming: !0
                    }).add(n) : n).pause()
                } catch (e) {
                    return a(1, "ERROR calling method 'setTween()': Supplied argument is not a valid TweenObject"), r
                }
                if (e && r.removeTween(), e = d, n.repeat && -1 === n.repeat() && (e.repeat(-1), e.yoyo(n.yoyo())), r.tweenChanges() && !e.tweenTo && a(2, "WARNING: tweenChanges will only work if the TimelineMax object is available for ScrollMagic."), e && r.controller() && r.triggerElement() && r.loglevel() >= 2) {
                    var h = t.getTweensOf(r.triggerElement()),
                        c = r.controller().info("vertical");
                    h.forEach(function (e, t) {
                        var i = e.vars.css || e.vars;
                        if (c ? void 0 !== i.top || void 0 !== i.bottom : void 0 !== i.left || void 0 !== i.right) return a(2, "WARNING: Tweening the position of the trigger element affects the scene timing and should be avoided!"), !1
                    })
                }
                if (parseFloat(TweenLite.version) >= 1.14)
                    for (var u, p, f = e.getChildren ? e.getChildren(!0, !0, !1) : [e], m = function () {
                            a(2, "WARNING: tween was overwritten by another. To learn how to avoid this issue see here: https://github.com/janpaepke/ScrollMagic/wiki/WARNING:-tween-was-overwritten-by-another")
                        }, v = 0; v < f.length; v++) u = f[v], p !== m && (p = u.vars.onOverwrite, u.vars.onOverwrite = function () {
                        p && p.apply(this, arguments), m.apply(this, arguments)
                    });
                return a(3, "added tween"), s(), r
            }, r.removeTween = function (t) {
                return e && (t && e.progress(0).pause(), e.kill(), e = void 0, a(3, "removed tween (reset: " + (t ? "true" : "false") + ")")), r
            }
        })
    }),
    function (e, t) {
        "object" == typeof exports && "undefined" != typeof module ? module.exports = t() : "function" == typeof define && define.amd ? define(t) : e.Swiper = t()
    }(this, function () {
        "use strict";

        function e(e, t) {
            var i = [],
                r = 0;
            if (e && !t && e instanceof a) return e;
            if (e)
                if ("string" == typeof e) {
                    var s, n, o = e.trim();
                    if (o.indexOf("<") >= 0 && o.indexOf(">") >= 0) {
                        var l = "div";
                        for (0 === o.indexOf("<li") && (l = "ul"), 0 === o.indexOf("<tr") && (l = "tbody"), 0 !== o.indexOf("<td") && 0 !== o.indexOf("<th") || (l = "tr"), 0 === o.indexOf("<tbody") && (l = "table"), 0 === o.indexOf("<option") && (l = "select"), (n = document.createElement(l)).innerHTML = o, r = 0; r < n.childNodes.length; r += 1) i.push(n.childNodes[r])
                    } else
                        for (s = t || "#" !== e[0] || e.match(/[ .<>:~]/) ? (t || document).querySelectorAll(e.trim()) : [document.getElementById(e.trim().split("#")[1])], r = 0; r < s.length; r += 1) s[r] && i.push(s[r])
                } else if (e.nodeType || e === window || e === document) i.push(e);
            else if (e.length > 0 && e[0].nodeType)
                for (r = 0; r < e.length; r += 1) i.push(e[r]);
            return new a(i)
        }

        function t(e) {
            for (var t = [], i = 0; i < e.length; i += 1) - 1 === t.indexOf(e[i]) && t.push(e[i]);
            return t
        }
        var i, r = i = "undefined" == typeof window ? {
                navigator: {
                    userAgent: ""
                },
                location: {},
                history: {},
                addEventListener: function () {},
                removeEventListener: function () {},
                getComputedStyle: function () {
                    return {}
                },
                Image: function () {},
                Date: function () {},
                screen: {}
            } : window,
            a = function (e) {
                for (var t = this, i = 0; i < e.length; i += 1) t[i] = e[i];
                return t.length = e.length, this
            };
        e.fn = a.prototype, e.Class = a, e.Dom7 = a, "resize scroll".split(" ");
        var s = {
            addClass: function (e) {
                var t = this;
                if (void 0 === e) return this;
                for (var i = e.split(" "), r = 0; r < i.length; r += 1)
                    for (var a = 0; a < this.length; a += 1) void 0 !== t[a].classList && t[a].classList.add(i[r]);
                return this
            },
            removeClass: function (e) {
                for (var t = this, i = e.split(" "), r = 0; r < i.length; r += 1)
                    for (var a = 0; a < this.length; a += 1) void 0 !== t[a].classList && t[a].classList.remove(i[r]);
                return this
            },
            hasClass: function (e) {
                return !!this[0] && this[0].classList.contains(e)
            },
            toggleClass: function (e) {
                for (var t = this, i = e.split(" "), r = 0; r < i.length; r += 1)
                    for (var a = 0; a < this.length; a += 1) void 0 !== t[a].classList && t[a].classList.toggle(i[r]);
                return this
            },
            attr: function (e, t) {
                var i = arguments,
                    r = this;
                if (1 !== arguments.length || "string" != typeof e) {
                    for (var a = 0; a < this.length; a += 1)
                        if (2 === i.length) r[a].setAttribute(e, t);
                        else
                            for (var s in e) r[a][s] = e[s], r[a].setAttribute(s, e[s]);
                    return this
                }
                if (this[0]) return this[0].getAttribute(e)
            },
            removeAttr: function (e) {
                for (var t = this, i = 0; i < this.length; i += 1) t[i].removeAttribute(e);
                return this
            },
            data: function (e, t) {
                var i, r = this;
                if (void 0 !== t) {
                    for (var a = 0; a < this.length; a += 1)(i = r[a]).dom7ElementDataStorage || (i.dom7ElementDataStorage = {}), i.dom7ElementDataStorage[e] = t;
                    return this
                }
                if (i = this[0]) {
                    if (i.dom7ElementDataStorage && e in i.dom7ElementDataStorage) return i.dom7ElementDataStorage[e];
                    var s = i.getAttribute("data-" + e);
                    if (s) return s
                }
            },
            transform: function (e) {
                for (var t = this, i = 0; i < this.length; i += 1) {
                    var r = t[i].style;
                    r.webkitTransform = e, r.transform = e
                }
                return this
            },
            transition: function (e) {
                var t = this;
                "string" != typeof e && (e += "ms");
                for (var i = 0; i < this.length; i += 1) {
                    var r = t[i].style;
                    r.webkitTransitionDuration = e, r.transitionDuration = e
                }
                return this
            },
            on: function () {
                function t(t) {
                    var i = t.target;
                    if (i) {
                        var r = t.target.dom7EventData || [];
                        if (r.unshift(t), e(i).is(o)) l.apply(i, r);
                        else
                            for (var a = e(i).parents(), s = 0; s < a.length; s += 1) e(a[s]).is(o) && l.apply(a[s], r)
                    }
                }

                function i(e) {
                    var t = e && e.target ? e.target.dom7EventData || [] : [];
                    t.unshift(e), l.apply(this, t)
                }
                for (var r = this, a = [], s = arguments.length; s--;) a[s] = arguments[s];
                var n = a[0],
                    o = a[1],
                    l = a[2],
                    d = a[3];
                if ("function" == typeof a[1]) {
                    var h;
                    n = (h = a)[0], l = h[1], d = h[2], o = void 0
                }
                d || (d = !1);
                for (var c, u = n.split(" "), p = 0; p < this.length; p += 1) {
                    var f = r[p];
                    if (o)
                        for (c = 0; c < u.length; c += 1) f.dom7LiveListeners || (f.dom7LiveListeners = []), f.dom7LiveListeners.push({
                            type: n,
                            listener: l,
                            proxyListener: t
                        }), f.addEventListener(u[c], t, d);
                    else
                        for (c = 0; c < u.length; c += 1) f.dom7Listeners || (f.dom7Listeners = []), f.dom7Listeners.push({
                            type: n,
                            listener: l,
                            proxyListener: i
                        }), f.addEventListener(u[c], i, d)
                }
                return this
            },
            off: function () {
                for (var e = this, t = [], i = arguments.length; i--;) t[i] = arguments[i];
                var r = t[0],
                    a = t[1],
                    s = t[2],
                    n = t[3];
                if ("function" == typeof t[1]) {
                    var o;
                    r = (o = t)[0], s = o[1], n = o[2], a = void 0
                }
                n || (n = !1);
                for (var l = r.split(" "), d = 0; d < l.length; d += 1)
                    for (var h = 0; h < this.length; h += 1) {
                        var c = e[h];
                        if (a) {
                            if (c.dom7LiveListeners)
                                for (var u = 0; u < c.dom7LiveListeners.length; u += 1) s ? c.dom7LiveListeners[u].listener === s && c.removeEventListener(l[d], c.dom7LiveListeners[u].proxyListener, n) : c.dom7LiveListeners[u].type === l[d] && c.removeEventListener(l[d], c.dom7LiveListeners[u].proxyListener, n)
                        } else if (c.dom7Listeners)
                            for (var p = 0; p < c.dom7Listeners.length; p += 1) s ? c.dom7Listeners[p].listener === s && c.removeEventListener(l[d], c.dom7Listeners[p].proxyListener, n) : c.dom7Listeners[p].type === l[d] && c.removeEventListener(l[d], c.dom7Listeners[p].proxyListener, n)
                    }
                return this
            },
            trigger: function () {
                for (var e = this, t = [], i = arguments.length; i--;) t[i] = arguments[i];
                for (var r = t[0].split(" "), a = t[1], s = 0; s < r.length; s += 1)
                    for (var n = 0; n < this.length; n += 1) {
                        var o = void 0;
                        try {
                            o = new window.CustomEvent(r[s], {
                                detail: a,
                                bubbles: !0,
                                cancelable: !0
                            })
                        } catch (e) {
                            (o = document.createEvent("Event")).initEvent(r[s], !0, !0), o.detail = a
                        }
                        e[n].dom7EventData = t.filter(function (e, t) {
                            return t > 0
                        }), e[n].dispatchEvent(o), e[n].dom7EventData = [], delete e[n].dom7EventData
                    }
                return this
            },
            transitionEnd: function (e) {
                function t(s) {
                    if (s.target === this)
                        for (e.call(this, s), i = 0; i < r.length; i += 1) a.off(r[i], t)
                }
                var i, r = ["webkitTransitionEnd", "transitionend"],
                    a = this;
                if (e)
                    for (i = 0; i < r.length; i += 1) a.on(r[i], t);
                return this
            },
            outerWidth: function (e) {
                if (this.length > 0) {
                    if (e) {
                        var t = this.styles();
                        return this[0].offsetWidth + parseFloat(t.getPropertyValue("margin-right")) + parseFloat(t.getPropertyValue("margin-left"))
                    }
                    return this[0].offsetWidth
                }
                return null
            },
            outerHeight: function (e) {
                if (this.length > 0) {
                    if (e) {
                        var t = this.styles();
                        return this[0].offsetHeight + parseFloat(t.getPropertyValue("margin-top")) + parseFloat(t.getPropertyValue("margin-bottom"))
                    }
                    return this[0].offsetHeight
                }
                return null
            },
            offset: function () {
                if (this.length > 0) {
                    var e = this[0],
                        t = e.getBoundingClientRect(),
                        i = document.body,
                        r = e.clientTop || i.clientTop || 0,
                        a = e.clientLeft || i.clientLeft || 0,
                        s = e === window ? window.scrollY : e.scrollTop,
                        n = e === window ? window.scrollX : e.scrollLeft;
                    return {
                        top: t.top + s - r,
                        left: t.left + n - a
                    }
                }
                return null
            },
            css: function (e, t) {
                var i, r = this;
                if (1 === arguments.length) {
                    if ("string" != typeof e) {
                        for (i = 0; i < this.length; i += 1)
                            for (var a in e) r[i].style[a] = e[a];
                        return this
                    }
                    if (this[0]) return window.getComputedStyle(this[0], null).getPropertyValue(e)
                }
                if (2 === arguments.length && "string" == typeof e) {
                    for (i = 0; i < this.length; i += 1) r[i].style[e] = t;
                    return this
                }
                return this
            },
            each: function (e) {
                var t = this;
                if (!e) return this;
                for (var i = 0; i < this.length; i += 1)
                    if (!1 === e.call(t[i], i, t[i])) return t;
                return this
            },
            html: function (e) {
                var t = this;
                if (void 0 === e) return this[0] ? this[0].innerHTML : void 0;
                for (var i = 0; i < this.length; i += 1) t[i].innerHTML = e;
                return this
            },
            text: function (e) {
                var t = this;
                if (void 0 === e) return this[0] ? this[0].textContent.trim() : null;
                for (var i = 0; i < this.length; i += 1) t[i].textContent = e;
                return this
            },
            is: function (t) {
                var i, r, s = this[0];
                if (!s || void 0 === t) return !1;
                if ("string" == typeof t) {
                    if (s.matches) return s.matches(t);
                    if (s.webkitMatchesSelector) return s.webkitMatchesSelector(t);
                    if (s.msMatchesSelector) return s.msMatchesSelector(t);
                    for (i = e(t), r = 0; r < i.length; r += 1)
                        if (i[r] === s) return !0;
                    return !1
                }
                if (t === document) return s === document;
                if (t === window) return s === window;
                if (t.nodeType || t instanceof a) {
                    for (i = t.nodeType ? [t] : t, r = 0; r < i.length; r += 1)
                        if (i[r] === s) return !0;
                    return !1
                }
                return !1
            },
            index: function () {
                var e, t = this[0];
                if (t) {
                    for (e = 0; null !== (t = t.previousSibling);) 1 === t.nodeType && (e += 1);
                    return e
                }
            },
            eq: function (e) {
                if (void 0 === e) return this;
                var t, i = this.length;
                return e > i - 1 ? new a([]) : e < 0 ? (t = i + e, new a(t < 0 ? [] : [this[t]])) : new a([this[e]])
            },
            append: function () {
                for (var e = this, t = [], i = arguments.length; i--;) t[i] = arguments[i];
                for (var r, s = 0; s < t.length; s += 1) {
                    r = t[s];
                    for (var n = 0; n < this.length; n += 1)
                        if ("string" == typeof r) {
                            var o = document.createElement("div");
                            for (o.innerHTML = r; o.firstChild;) e[n].appendChild(o.firstChild)
                        } else if (r instanceof a)
                        for (var l = 0; l < r.length; l += 1) e[n].appendChild(r[l]);
                    else e[n].appendChild(r)
                }
                return this
            },
            prepend: function (e) {
                var t, i, r = this;
                for (t = 0; t < this.length; t += 1)
                    if ("string" == typeof e) {
                        var s = document.createElement("div");
                        for (s.innerHTML = e, i = s.childNodes.length - 1; i >= 0; i -= 1) r[t].insertBefore(s.childNodes[i], r[t].childNodes[0])
                    } else if (e instanceof a)
                    for (i = 0; i < e.length; i += 1) r[t].insertBefore(e[i], r[t].childNodes[0]);
                else r[t].insertBefore(e, r[t].childNodes[0]);
                return this
            },
            next: function (t) {
                return new a(this.length > 0 ? t ? this[0].nextElementSibling && e(this[0].nextElementSibling).is(t) ? [this[0].nextElementSibling] : [] : this[0].nextElementSibling ? [this[0].nextElementSibling] : [] : [])
            },
            nextAll: function (t) {
                var i = [],
                    r = this[0];
                if (!r) return new a([]);
                for (; r.nextElementSibling;) {
                    var s = r.nextElementSibling;
                    t ? e(s).is(t) && i.push(s) : i.push(s), r = s
                }
                return new a(i)
            },
            prev: function (t) {
                if (this.length > 0) {
                    var i = this[0];
                    return new a(t ? i.previousElementSibling && e(i.previousElementSibling).is(t) ? [i.previousElementSibling] : [] : i.previousElementSibling ? [i.previousElementSibling] : [])
                }
                return new a([])
            },
            prevAll: function (t) {
                var i = [],
                    r = this[0];
                if (!r) return new a([]);
                for (; r.previousElementSibling;) {
                    var s = r.previousElementSibling;
                    t ? e(s).is(t) && i.push(s) : i.push(s), r = s
                }
                return new a(i)
            },
            parent: function (i) {
                for (var r = this, a = [], s = 0; s < this.length; s += 1) null !== r[s].parentNode && (i ? e(r[s].parentNode).is(i) && a.push(r[s].parentNode) : a.push(r[s].parentNode));
                return e(t(a))
            },
            parents: function (i) {
                for (var r = this, a = [], s = 0; s < this.length; s += 1)
                    for (var n = r[s].parentNode; n;) i ? e(n).is(i) && a.push(n) : a.push(n), n = n.parentNode;
                return e(t(a))
            },
            closest: function (e) {
                var t = this;
                return void 0 === e ? new a([]) : (t.is(e) || (t = t.parents(e).eq(0)), t)
            },
            find: function (e) {
                for (var t = this, i = [], r = 0; r < this.length; r += 1)
                    for (var s = t[r].querySelectorAll(e), n = 0; n < s.length; n += 1) i.push(s[n]);
                return new a(i)
            },
            children: function (i) {
                for (var r = this, s = [], n = 0; n < this.length; n += 1)
                    for (var o = r[n].childNodes, l = 0; l < o.length; l += 1) i ? 1 === o[l].nodeType && e(o[l]).is(i) && s.push(o[l]) : 1 === o[l].nodeType && s.push(o[l]);
                return new a(t(s))
            },
            remove: function () {
                for (var e = this, t = 0; t < this.length; t += 1) e[t].parentNode && e[t].parentNode.removeChild(e[t]);
                return this
            },
            add: function () {
                for (var t = [], i = arguments.length; i--;) t[i] = arguments[i];
                var r, a, s = this;
                for (r = 0; r < t.length; r += 1) {
                    var n = e(t[r]);
                    for (a = 0; a < n.length; a += 1) s[s.length] = n[a], s.length += 1
                }
                return s
            },
            styles: function () {
                return this[0] ? window.getComputedStyle(this[0], null) : {}
            }
        };
        Object.keys(s).forEach(function (t) {
            e.fn[t] = s[t]
        });
        var n, o = {
                deleteProps: function (e) {
                    var t = e;
                    Object.keys(t).forEach(function (e) {
                        try {
                            t[e] = null
                        } catch (e) {}
                        try {
                            delete t[e]
                        } catch (e) {}
                    })
                },
                nextTick: function (e, t) {
                    return void 0 === t && (t = 0), setTimeout(e, t)
                },
                now: function () {
                    return Date.now()
                },
                getTranslate: function (e, t) {
                    void 0 === t && (t = "x");
                    var i, a, s, n = r.getComputedStyle(e, null);
                    return r.WebKitCSSMatrix ? ((a = n.transform || n.webkitTransform).split(",").length > 6 && (a = a.split(", ").map(function (e) {
                        return e.replace(",", ".")
                    }).join(", ")), s = new r.WebKitCSSMatrix("none" === a ? "" : a)) : i = (s = n.MozTransform || n.OTransform || n.MsTransform || n.msTransform || n.transform || n.getPropertyValue("transform").replace("translate(", "matrix(1, 0, 0, 1,")).toString().split(","), "x" === t && (a = r.WebKitCSSMatrix ? s.m41 : 16 === i.length ? parseFloat(i[12]) : parseFloat(i[4])), "y" === t && (a = r.WebKitCSSMatrix ? s.m42 : 16 === i.length ? parseFloat(i[13]) : parseFloat(i[5])), a || 0
                },
                parseUrlQuery: function (e) {
                    var t, i, a, s, n = {},
                        o = e || r.location.href;
                    if ("string" == typeof o && o.length)
                        for (s = (i = (o = o.indexOf("?") > -1 ? o.replace(/\S*\?/, "") : "").split("&").filter(function (e) {
                                return "" !== e
                            })).length, t = 0; t < s; t += 1) a = i[t].replace(/#\S+/g, "").split("="), n[decodeURIComponent(a[0])] = void 0 === a[1] ? void 0 : decodeURIComponent(a[1]) || "";
                    return n
                },
                isObject: function (e) {
                    return "object" == typeof e && null !== e && e.constructor && e.constructor === Object
                },
                extend: function () {
                    for (var e = [], t = arguments.length; t--;) e[t] = arguments[t];
                    for (var i = Object(e[0]), r = 1; r < e.length; r += 1) {
                        var a = e[r];
                        if (void 0 !== a && null !== a)
                            for (var s = Object.keys(Object(a)), n = 0, l = s.length; n < l; n += 1) {
                                var d = s[n],
                                    h = Object.getOwnPropertyDescriptor(a, d);
                                void 0 !== h && h.enumerable && (o.isObject(i[d]) && o.isObject(a[d]) ? o.extend(i[d], a[d]) : !o.isObject(i[d]) && o.isObject(a[d]) ? (i[d] = {}, o.extend(i[d], a[d])) : i[d] = a[d])
                            }
                    }
                    return i
                }
            },
            l = n = "undefined" == typeof document ? {
                addEventListener: function () {},
                removeEventListener: function () {},
                activeElement: {
                    blur: function () {},
                    nodeName: ""
                },
                querySelector: function () {
                    return {}
                },
                querySelectorAll: function () {
                    return []
                },
                createElement: function () {
                    return {
                        style: {},
                        setAttribute: function () {},
                        getElementsByTagName: function () {
                            return []
                        }
                    }
                },
                location: {
                    hash: ""
                }
            } : document,
            d = {
                touch: r.Modernizr && !0 === r.Modernizr.touch || !!("ontouchstart" in r || r.DocumentTouch && l instanceof r.DocumentTouch),
                transforms3d: r.Modernizr && !0 === r.Modernizr.csstransforms3d || function () {
                    var e = l.createElement("div").style;
                    return "webkitPerspective" in e || "MozPerspective" in e || "OPerspective" in e || "MsPerspective" in e || "perspective" in e
                }(),
                flexbox: function () {
                    for (var e = l.createElement("div").style, t = "alignItems webkitAlignItems webkitBoxAlign msFlexAlign mozBoxAlign webkitFlexDirection msFlexDirection mozBoxDirection mozBoxOrient webkitBoxDirection webkitBoxOrient".split(" "), i = 0; i < t.length; i += 1)
                        if (t[i] in e) return !0;
                    return !1
                }(),
                observer: "MutationObserver" in r || "WebkitMutationObserver" in r,
                passiveListener: function () {
                    var e = !1;
                    try {
                        var t = Object.defineProperty({}, "passive", {
                            get: function () {
                                e = !0
                            }
                        });
                        r.addEventListener("testPassiveListener", null, t)
                    } catch (e) {}
                    return e
                }(),
                gestures: "ongesturestart" in r
            },
            h = function (e) {
                void 0 === e && (e = {});
                var t = this;
                t.params = e, t.eventsListeners = {}, t.params && t.params.on && Object.keys(t.params.on).forEach(function (e) {
                    t.on(e, t.params.on[e])
                })
            },
            c = {
                components: {}
            };
        h.prototype.on = function (e, t) {
            var i = this;
            return "function" != typeof t ? i : (e.split(" ").forEach(function (e) {
                i.eventsListeners[e] || (i.eventsListeners[e] = []), i.eventsListeners[e].push(t)
            }), i)
        }, h.prototype.once = function (e, t) {
            function i() {
                for (var a = [], s = arguments.length; s--;) a[s] = arguments[s];
                t.apply(r, a), r.off(e, i)
            }
            var r = this;
            return "function" != typeof t ? r : r.on(e, i)
        }, h.prototype.off = function (e, t) {
            var i = this;
            return e.split(" ").forEach(function (e) {
                void 0 === t ? i.eventsListeners[e] = [] : i.eventsListeners[e].forEach(function (r, a) {
                    r === t && i.eventsListeners[e].splice(a, 1)
                })
            }), i
        }, h.prototype.emit = function () {
            for (var e = [], t = arguments.length; t--;) e[t] = arguments[t];
            var i = this;
            if (!i.eventsListeners) return i;
            var r, a, s;
            return "string" == typeof e[0] || Array.isArray(e[0]) ? (r = e[0], a = e.slice(1, e.length), s = i) : (r = e[0].events, a = e[0].data, s = e[0].context || i), (Array.isArray(r) ? r : r.split(" ")).forEach(function (e) {
                if (i.eventsListeners[e]) {
                    var t = [];
                    i.eventsListeners[e].forEach(function (e) {
                        t.push(e)
                    }), t.forEach(function (e) {
                        e.apply(s, a)
                    })
                }
            }), i
        }, h.prototype.useModulesParams = function (e) {
            var t = this;
            t.modules && Object.keys(t.modules).forEach(function (i) {
                var r = t.modules[i];
                r.params && o.extend(e, r.params)
            })
        }, h.prototype.useModules = function (e) {
            void 0 === e && (e = {});
            var t = this;
            t.modules && Object.keys(t.modules).forEach(function (i) {
                var r = t.modules[i],
                    a = e[i] || {};
                r.instance && Object.keys(r.instance).forEach(function (e) {
                    var i = r.instance[e];
                    t[e] = "function" == typeof i ? i.bind(t) : i
                }), r.on && t.on && Object.keys(r.on).forEach(function (e) {
                    t.on(e, r.on[e])
                }), r.create && r.create.bind(t)(a)
            })
        }, c.components.set = function (e) {
            var t = this;
            t.use && t.use(e)
        }, h.installModule = function (e) {
            for (var t = [], i = arguments.length - 1; i-- > 0;) t[i] = arguments[i + 1];
            var r = this;
            r.prototype.modules || (r.prototype.modules = {});
            var a = e.name || Object.keys(r.prototype.modules).length + "_" + o.now();
            return r.prototype.modules[a] = e, e.proto && Object.keys(e.proto).forEach(function (t) {
                r.prototype[t] = e.proto[t]
            }), e.static && Object.keys(e.static).forEach(function (t) {
                r[t] = e.static[t]
            }), e.install && e.install.apply(r, t), r
        }, h.use = function (e) {
            for (var t = [], i = arguments.length - 1; i-- > 0;) t[i] = arguments[i + 1];
            var r = this;
            return Array.isArray(e) ? (e.forEach(function (e) {
                return r.installModule(e)
            }), r) : r.installModule.apply(r, [e].concat(t))
        }, Object.defineProperties(h, c);
        var u = {
                updateSize: function () {
                    var e, t, i = this,
                        r = i.$el;
                    e = void 0 !== i.params.width ? i.params.width : r[0].clientWidth, t = void 0 !== i.params.height ? i.params.height : r[0].clientHeight, 0 === e && i.isHorizontal() || 0 === t && i.isVertical() || (e = e - parseInt(r.css("padding-left"), 10) - parseInt(r.css("padding-right"), 10), t = t - parseInt(r.css("padding-top"), 10) - parseInt(r.css("padding-bottom"), 10), o.extend(i, {
                        width: e,
                        height: t,
                        size: i.isHorizontal() ? e : t
                    }))
                },
                updateSlides: function () {
                    var e = this,
                        t = e.params,
                        i = e.$wrapperEl,
                        r = e.size,
                        a = e.rtl,
                        s = e.wrongRTL,
                        n = i.children("." + e.params.slideClass),
                        l = e.virtual && t.virtual.enabled ? e.virtual.slides.length : n.length,
                        h = [],
                        c = [],
                        u = [],
                        p = t.slidesOffsetBefore;
                    "function" == typeof p && (p = t.slidesOffsetBefore.call(e));
                    var f = t.slidesOffsetAfter;
                    "function" == typeof f && (f = t.slidesOffsetAfter.call(e));
                    var m = l,
                        v = e.snapGrid.length,
                        g = e.snapGrid.length,
                        _ = t.spaceBetween,
                        y = -p,
                        w = 0,
                        b = 0;
                    if (void 0 !== r) {
                        "string" == typeof _ && _.indexOf("%") >= 0 && (_ = parseFloat(_.replace("%", "")) / 100 * r), e.virtualSize = -_, a ? n.css({
                            marginLeft: "",
                            marginTop: ""
                        }) : n.css({
                            marginRight: "",
                            marginBottom: ""
                        });
                        var x;
                        t.slidesPerColumn > 1 && (x = Math.floor(l / t.slidesPerColumn) === l / e.params.slidesPerColumn ? l : Math.ceil(l / t.slidesPerColumn) * t.slidesPerColumn, "auto" !== t.slidesPerView && "row" === t.slidesPerColumnFill && (x = Math.max(x, t.slidesPerView * t.slidesPerColumn)));
                        for (var T, S = t.slidesPerColumn, E = x / S, C = E - (t.slidesPerColumn * E - l), P = 0; P < l; P += 1) {
                            T = 0;
                            var M = n.eq(P);
                            if (t.slidesPerColumn > 1) {
                                var k = void 0,
                                    z = void 0,
                                    R = void 0;
                                "column" === t.slidesPerColumnFill ? (R = P - (z = Math.floor(P / S)) * S, (z > C || z === C && R === S - 1) && (R += 1) >= S && (R = 0, z += 1), k = z + R * x / S, M.css({
                                    "-webkit-box-ordinal-group": k,
                                    "-moz-box-ordinal-group": k,
                                    "-ms-flex-order": k,
                                    "-webkit-order": k,
                                    order: k
                                })) : z = P - (R = Math.floor(P / E)) * E, M.css("margin-" + (e.isHorizontal() ? "top" : "left"), 0 !== R && t.spaceBetween && t.spaceBetween + "px").attr("data-swiper-column", z).attr("data-swiper-row", R)
                            }
                            "none" !== M.css("display") && ("auto" === t.slidesPerView ? (T = e.isHorizontal() ? M.outerWidth(!0) : M.outerHeight(!0), t.roundLengths && (T = Math.floor(T))) : (T = (r - (t.slidesPerView - 1) * _) / t.slidesPerView, t.roundLengths && (T = Math.floor(T)), n[P] && (e.isHorizontal() ? n[P].style.width = T + "px" : n[P].style.height = T + "px")), n[P] && (n[P].swiperSlideSize = T), u.push(T), t.centeredSlides ? (y = y + T / 2 + w / 2 + _, 0 === w && 0 !== P && (y = y - r / 2 - _), 0 === P && (y = y - r / 2 - _), Math.abs(y) < .001 && (y = 0), b % t.slidesPerGroup == 0 && h.push(y), c.push(y)) : (b % t.slidesPerGroup == 0 && h.push(y), c.push(y), y = y + T + _), e.virtualSize += T + _, w = T, b += 1)
                        }
                        e.virtualSize = Math.max(e.virtualSize, r) + f;
                        var O;
                        if (a && s && ("slide" === t.effect || "coverflow" === t.effect) && i.css({
                                width: e.virtualSize + t.spaceBetween + "px"
                            }), d.flexbox && !t.setWrapperSize || (e.isHorizontal() ? i.css({
                                width: e.virtualSize + t.spaceBetween + "px"
                            }) : i.css({
                                height: e.virtualSize + t.spaceBetween + "px"
                            })), t.slidesPerColumn > 1 && (e.virtualSize = (T + t.spaceBetween) * x, e.virtualSize = Math.ceil(e.virtualSize / t.slidesPerColumn) - t.spaceBetween, e.isHorizontal() ? i.css({
                                width: e.virtualSize + t.spaceBetween + "px"
                            }) : i.css({
                                height: e.virtualSize + t.spaceBetween + "px"
                            }), t.centeredSlides)) {
                            O = [];
                            for (var A = 0; A < h.length; A += 1) h[A] < e.virtualSize + h[0] && O.push(h[A]);
                            h = O
                        }
                        if (!t.centeredSlides) {
                            O = [];
                            for (var D = 0; D < h.length; D += 1) h[D] <= e.virtualSize - r && O.push(h[D]);
                            h = O, Math.floor(e.virtualSize - r) - Math.floor(h[h.length - 1]) > 1 && h.push(e.virtualSize - r)
                        }
                        0 === h.length && (h = [0]), 0 !== t.spaceBetween && (e.isHorizontal() ? a ? n.css({
                            marginLeft: _ + "px"
                        }) : n.css({
                            marginRight: _ + "px"
                        }) : n.css({
                            marginBottom: _ + "px"
                        })), o.extend(e, {
                            slides: n,
                            snapGrid: h,
                            slidesGrid: c,
                            slidesSizesGrid: u
                        }), l !== m && e.emit("slidesLengthChange"), h.length !== v && e.emit("snapGridLengthChange"), c.length !== g && e.emit("slidesGridLengthChange"), (t.watchSlidesProgress || t.watchSlidesVisibility) && e.updateSlidesOffset()
                    }
                },
                updateAutoHeight: function () {
                    var e, t = this,
                        i = [],
                        r = 0;
                    if ("auto" !== t.params.slidesPerView && t.params.slidesPerView > 1)
                        for (e = 0; e < Math.ceil(t.params.slidesPerView); e += 1) {
                            var a = t.activeIndex + e;
                            if (a > t.slides.length) break;
                            i.push(t.slides.eq(a)[0])
                        } else i.push(t.slides.eq(t.activeIndex)[0]);
                    for (e = 0; e < i.length; e += 1)
                        if (void 0 !== i[e]) {
                            var s = i[e].offsetHeight;
                            r = s > r ? s : r
                        } r && t.$wrapperEl.css("height", r + "px")
                },
                updateSlidesOffset: function () {
                    for (var e = this, t = e.slides, i = 0; i < t.length; i += 1) t[i].swiperSlideOffset = e.isHorizontal() ? t[i].offsetLeft : t[i].offsetTop
                },
                updateSlidesProgress: function (e) {
                    void 0 === e && (e = this.translate || 0);
                    var t = this,
                        i = t.params,
                        r = t.slides,
                        a = t.rtl;
                    if (0 !== r.length) {
                        void 0 === r[0].swiperSlideOffset && t.updateSlidesOffset();
                        var s = -e;
                        a && (s = e), r.removeClass(i.slideVisibleClass);
                        for (var n = 0; n < r.length; n += 1) {
                            var o = r[n],
                                l = (s + (i.centeredSlides ? t.minTranslate() : 0) - o.swiperSlideOffset) / (o.swiperSlideSize + i.spaceBetween);
                            if (i.watchSlidesVisibility) {
                                var d = -(s - o.swiperSlideOffset),
                                    h = d + t.slidesSizesGrid[n];
                                (d >= 0 && d < t.size || h > 0 && h <= t.size || d <= 0 && h >= t.size) && r.eq(n).addClass(i.slideVisibleClass)
                            }
                            o.progress = a ? -l : l
                        }
                    }
                },
                updateProgress: function (e) {
                    void 0 === e && (e = this.translate || 0);
                    var t = this,
                        i = t.params,
                        r = t.maxTranslate() - t.minTranslate(),
                        a = t.progress,
                        s = t.isBeginning,
                        n = t.isEnd,
                        l = s,
                        d = n;
                    0 === r ? (a = 0, s = !0, n = !0) : (s = (a = (e - t.minTranslate()) / r) <= 0, n = a >= 1), o.extend(t, {
                        progress: a,
                        isBeginning: s,
                        isEnd: n
                    }), (i.watchSlidesProgress || i.watchSlidesVisibility) && t.updateSlidesProgress(e), s && !l && t.emit("reachBeginning toEdge"), n && !d && t.emit("reachEnd toEdge"), (l && !s || d && !n) && t.emit("fromEdge"), t.emit("progress", a)
                },
                updateSlidesClasses: function () {
                    var e = this,
                        t = e.slides,
                        i = e.params,
                        r = e.$wrapperEl,
                        a = e.activeIndex,
                        s = e.realIndex,
                        n = e.virtual && i.virtual.enabled;
                    t.removeClass(i.slideActiveClass + " " + i.slideNextClass + " " + i.slidePrevClass + " " + i.slideDuplicateActiveClass + " " + i.slideDuplicateNextClass + " " + i.slideDuplicatePrevClass);
                    var o;
                    (o = n ? e.$wrapperEl.find("." + i.slideClass + '[data-swiper-slide-index="' + a + '"]') : t.eq(a)).addClass(i.slideActiveClass), i.loop && (o.hasClass(i.slideDuplicateClass) ? r.children("." + i.slideClass + ":not(." + i.slideDuplicateClass + ')[data-swiper-slide-index="' + s + '"]').addClass(i.slideDuplicateActiveClass) : r.children("." + i.slideClass + "." + i.slideDuplicateClass + '[data-swiper-slide-index="' + s + '"]').addClass(i.slideDuplicateActiveClass));
                    var l = o.nextAll("." + i.slideClass).eq(0).addClass(i.slideNextClass);
                    i.loop && 0 === l.length && (l = t.eq(0)).addClass(i.slideNextClass);
                    var d = o.prevAll("." + i.slideClass).eq(0).addClass(i.slidePrevClass);
                    i.loop && 0 === d.length && (d = t.eq(-1)).addClass(i.slidePrevClass), i.loop && (l.hasClass(i.slideDuplicateClass) ? r.children("." + i.slideClass + ":not(." + i.slideDuplicateClass + ')[data-swiper-slide-index="' + l.attr("data-swiper-slide-index") + '"]').addClass(i.slideDuplicateNextClass) : r.children("." + i.slideClass + "." + i.slideDuplicateClass + '[data-swiper-slide-index="' + l.attr("data-swiper-slide-index") + '"]').addClass(i.slideDuplicateNextClass), d.hasClass(i.slideDuplicateClass) ? r.children("." + i.slideClass + ":not(." + i.slideDuplicateClass + ')[data-swiper-slide-index="' + d.attr("data-swiper-slide-index") + '"]').addClass(i.slideDuplicatePrevClass) : r.children("." + i.slideClass + "." + i.slideDuplicateClass + '[data-swiper-slide-index="' + d.attr("data-swiper-slide-index") + '"]').addClass(i.slideDuplicatePrevClass))
                },
                updateActiveIndex: function (e) {
                    var t, i = this,
                        r = i.rtl ? i.translate : -i.translate,
                        a = i.slidesGrid,
                        s = i.snapGrid,
                        n = i.params,
                        l = i.activeIndex,
                        d = i.realIndex,
                        h = i.snapIndex,
                        c = e;
                    if (void 0 === c) {
                        for (var u = 0; u < a.length; u += 1) void 0 !== a[u + 1] ? r >= a[u] && r < a[u + 1] - (a[u + 1] - a[u]) / 2 ? c = u : r >= a[u] && r < a[u + 1] && (c = u + 1) : r >= a[u] && (c = u);
                        n.normalizeSlideIndex && (c < 0 || void 0 === c) && (c = 0)
                    }
                    if ((t = s.indexOf(r) >= 0 ? s.indexOf(r) : Math.floor(c / n.slidesPerGroup)) >= s.length && (t = s.length - 1), c !== l) {
                        var p = parseInt(i.slides.eq(c).attr("data-swiper-slide-index") || c, 10);
                        o.extend(i, {
                            snapIndex: t,
                            realIndex: p,
                            previousIndex: l,
                            activeIndex: c
                        }), i.emit("activeIndexChange"), i.emit("snapIndexChange"), d !== p && i.emit("realIndexChange"), i.emit("slideChange")
                    } else t !== h && (i.snapIndex = t, i.emit("snapIndexChange"))
                },
                updateClickedSlide: function (t) {
                    var i = this,
                        r = i.params,
                        a = e(t.target).closest("." + r.slideClass)[0],
                        s = !1;
                    if (a)
                        for (var n = 0; n < i.slides.length; n += 1) i.slides[n] === a && (s = !0);
                    if (!a || !s) return i.clickedSlide = void 0, void(i.clickedIndex = void 0);
                    i.clickedSlide = a, i.virtual && i.params.virtual.enabled ? i.clickedIndex = parseInt(e(a).attr("data-swiper-slide-index"), 10) : i.clickedIndex = e(a).index(), r.slideToClickedSlide && void 0 !== i.clickedIndex && i.clickedIndex !== i.activeIndex && i.slideToClickedSlide()
                }
            },
            p = {
                getTranslate: function (e) {
                    void 0 === e && (e = this.isHorizontal() ? "x" : "y");
                    var t = this,
                        i = t.params,
                        r = t.rtl,
                        a = t.translate,
                        s = t.$wrapperEl;
                    if (i.virtualTranslate) return r ? -a : a;
                    var n = o.getTranslate(s[0], e);
                    return r && (n = -n), n || 0
                },
                setTranslate: function (e, t) {
                    var i = this,
                        r = i.rtl,
                        a = i.params,
                        s = i.$wrapperEl,
                        n = i.progress,
                        o = 0,
                        l = 0;
                    i.isHorizontal() ? o = r ? -e : e : l = e, a.roundLengths && (o = Math.floor(o), l = Math.floor(l)), a.virtualTranslate || (d.transforms3d ? s.transform("translate3d(" + o + "px, " + l + "px, 0px)") : s.transform("translate(" + o + "px, " + l + "px)")), i.translate = i.isHorizontal() ? o : l;
                    var h = i.maxTranslate() - i.minTranslate();
                    (0 === h ? 0 : (e - i.minTranslate()) / h) !== n && i.updateProgress(e), i.emit("setTranslate", i.translate, t)
                },
                minTranslate: function () {
                    return -this.snapGrid[0]
                },
                maxTranslate: function () {
                    return -this.snapGrid[this.snapGrid.length - 1]
                }
            },
            f = {
                setTransition: function (e, t) {
                    var i = this;
                    i.$wrapperEl.transition(e), i.emit("setTransition", e, t)
                },
                transitionStart: function (e) {
                    void 0 === e && (e = !0);
                    var t = this,
                        i = t.activeIndex,
                        r = t.params,
                        a = t.previousIndex;
                    r.autoHeight && t.updateAutoHeight(), t.emit("transitionStart"), e && i !== a && (t.emit("slideChangeTransitionStart"), i > a ? t.emit("slideNextTransitionStart") : t.emit("slidePrevTransitionStart"))
                },
                transitionEnd: function (e) {
                    void 0 === e && (e = !0);
                    var t = this,
                        i = t.activeIndex,
                        r = t.previousIndex;
                    t.animating = !1, t.setTransition(0), t.emit("transitionEnd"), e && i !== r && (t.emit("slideChangeTransitionEnd"), i > r ? t.emit("slideNextTransitionEnd") : t.emit("slidePrevTransitionEnd"))
                }
            },
            m = {
                isSafari: function () {
                    var e = r.navigator.userAgent.toLowerCase();
                    return e.indexOf("safari") >= 0 && e.indexOf("chrome") < 0 && e.indexOf("android") < 0
                }(),
                isUiWebView: /(iPhone|iPod|iPad).*AppleWebKit(?!.*Safari)/i.test(r.navigator.userAgent),
                ie: r.navigator.pointerEnabled || r.navigator.msPointerEnabled,
                ieTouch: r.navigator.msPointerEnabled && r.navigator.msMaxTouchPoints > 1 || r.navigator.pointerEnabled && r.navigator.maxTouchPoints > 1,
                lteIE9: function () {
                    var e = l.createElement("div");
                    return e.innerHTML = "\x3c!--[if lte IE 9]><i></i><![endif]--\x3e", 1 === e.getElementsByTagName("i").length
                }()
            },
            v = {
                slideTo: function (e, t, i, r) {
                    void 0 === e && (e = 0), void 0 === t && (t = this.params.speed), void 0 === i && (i = !0);
                    var a = this,
                        s = e;
                    s < 0 && (s = 0);
                    var n = a.params,
                        o = a.snapGrid,
                        l = a.slidesGrid,
                        d = a.previousIndex,
                        h = a.activeIndex,
                        c = a.rtl,
                        u = a.$wrapperEl,
                        p = Math.floor(s / n.slidesPerGroup);
                    p >= o.length && (p = o.length - 1), (h || n.initialSlide || 0) === (d || 0) && i && a.emit("beforeSlideChangeStart");
                    var f = -o[p];
                    if (a.updateProgress(f), n.normalizeSlideIndex)
                        for (var v = 0; v < l.length; v += 1) - Math.floor(100 * f) >= Math.floor(100 * l[v]) && (s = v);
                    return !(!a.allowSlideNext && f < a.translate && f < a.minTranslate() || !a.allowSlidePrev && f > a.translate && f > a.maxTranslate() && (h || 0) !== s || (c && -f === a.translate || !c && f === a.translate ? (a.updateActiveIndex(s), n.autoHeight && a.updateAutoHeight(), a.updateSlidesClasses(), "slide" !== n.effect && a.setTranslate(f), 1) : (0 === t || m.lteIE9 ? (a.setTransition(0), a.setTranslate(f), a.updateActiveIndex(s), a.updateSlidesClasses(), a.emit("beforeTransitionStart", t, r), a.transitionStart(i), a.transitionEnd(i)) : (a.setTransition(t), a.setTranslate(f), a.updateActiveIndex(s), a.updateSlidesClasses(), a.emit("beforeTransitionStart", t, r), a.transitionStart(i), a.animating || (a.animating = !0, u.transitionEnd(function () {
                        a && !a.destroyed && a.transitionEnd(i)
                    }))), 0)))
                },
                slideNext: function (e, t, i) {
                    void 0 === e && (e = this.params.speed), void 0 === t && (t = !0);
                    var r = this,
                        a = r.params,
                        s = r.animating;
                    return a.loop ? !s && (r.loopFix(), r._clientLeft = r.$wrapperEl[0].clientLeft, r.slideTo(r.activeIndex + a.slidesPerGroup, e, t, i)) : r.slideTo(r.activeIndex + a.slidesPerGroup, e, t, i)
                },
                slidePrev: function (e, t, i) {
                    void 0 === e && (e = this.params.speed), void 0 === t && (t = !0);
                    var r = this,
                        a = r.params,
                        s = r.animating;
                    return a.loop ? !s && (r.loopFix(), r._clientLeft = r.$wrapperEl[0].clientLeft, r.slideTo(r.activeIndex - 1, e, t, i)) : r.slideTo(r.activeIndex - 1, e, t, i)
                },
                slideReset: function (e, t, i) {
                    void 0 === e && (e = this.params.speed), void 0 === t && (t = !0);
                    var r = this;
                    return r.slideTo(r.activeIndex, e, t, i)
                },
                slideToClickedSlide: function () {
                    var t, i = this,
                        r = i.params,
                        a = i.$wrapperEl,
                        s = "auto" === r.slidesPerView ? i.slidesPerViewDynamic() : r.slidesPerView,
                        n = i.clickedIndex;
                    if (r.loop) {
                        if (i.animating) return;
                        t = parseInt(e(i.clickedSlide).attr("data-swiper-slide-index"), 10), r.centeredSlides ? n < i.loopedSlides - s / 2 || n > i.slides.length - i.loopedSlides + s / 2 ? (i.loopFix(), n = a.children("." + r.slideClass + '[data-swiper-slide-index="' + t + '"]:not(.' + r.slideDuplicateClass + ")").eq(0).index(), o.nextTick(function () {
                            i.slideTo(n)
                        })) : i.slideTo(n) : n > i.slides.length - s ? (i.loopFix(), n = a.children("." + r.slideClass + '[data-swiper-slide-index="' + t + '"]:not(.' + r.slideDuplicateClass + ")").eq(0).index(), o.nextTick(function () {
                            i.slideTo(n)
                        })) : i.slideTo(n)
                    } else i.slideTo(n)
                }
            },
            g = {
                loopCreate: function () {
                    var t = this,
                        i = t.params,
                        r = t.$wrapperEl;
                    r.children("." + i.slideClass + "." + i.slideDuplicateClass).remove();
                    var a = r.children("." + i.slideClass);
                    if (i.loopFillGroupWithBlank) {
                        var s = i.slidesPerGroup - a.length % i.slidesPerGroup;
                        if (s !== i.slidesPerGroup) {
                            for (var n = 0; n < s; n += 1) {
                                var o = e(l.createElement("div")).addClass(i.slideClass + " " + i.slideBlankClass);
                                r.append(o)
                            }
                            a = r.children("." + i.slideClass)
                        }
                    }
                    "auto" !== i.slidesPerView || i.loopedSlides || (i.loopedSlides = a.length), t.loopedSlides = parseInt(i.loopedSlides || i.slidesPerView, 10), t.loopedSlides += i.loopAdditionalSlides, t.loopedSlides > a.length && (t.loopedSlides = a.length);
                    var d = [],
                        h = [];
                    a.each(function (i, r) {
                        var s = e(r);
                        i < t.loopedSlides && h.push(r), i < a.length && i >= a.length - t.loopedSlides && d.push(r), s.attr("data-swiper-slide-index", i)
                    });
                    for (var c = 0; c < h.length; c += 1) r.append(e(h[c].cloneNode(!0)).addClass(i.slideDuplicateClass));
                    for (var u = d.length - 1; u >= 0; u -= 1) r.prepend(e(d[u].cloneNode(!0)).addClass(i.slideDuplicateClass))
                },
                loopFix: function () {
                    var e, t = this,
                        i = t.params,
                        r = t.activeIndex,
                        a = t.slides,
                        s = t.loopedSlides,
                        n = t.allowSlidePrev,
                        o = t.allowSlideNext;
                    t.allowSlidePrev = !0, t.allowSlideNext = !0, r < s ? (e = a.length - 3 * s + r, e += s, t.slideTo(e, 0, !1, !0)) : ("auto" === i.slidesPerView && r >= 2 * s || r > a.length - 2 * i.slidesPerView) && (e = -a.length + r + s, e += s, t.slideTo(e, 0, !1, !0)), t.allowSlidePrev = n, t.allowSlideNext = o
                },
                loopDestroy: function () {
                    var e = this,
                        t = e.$wrapperEl,
                        i = e.params,
                        r = e.slides;
                    t.children("." + i.slideClass + "." + i.slideDuplicateClass).remove(), r.removeAttr("data-swiper-slide-index")
                }
            },
            _ = {
                setGrabCursor: function (e) {
                    var t = this;
                    if (!d.touch && t.params.simulateTouch) {
                        var i = t.el;
                        i.style.cursor = "move", i.style.cursor = e ? "-webkit-grabbing" : "-webkit-grab", i.style.cursor = e ? "-moz-grabbin" : "-moz-grab", i.style.cursor = e ? "grabbing" : "grab"
                    }
                },
                unsetGrabCursor: function () {
                    var e = this;
                    d.touch || (e.el.style.cursor = "")
                }
            },
            y = {
                appendSlide: function (e) {
                    var t = this,
                        i = t.$wrapperEl,
                        r = t.params;
                    if (r.loop && t.loopDestroy(), "object" == typeof e && "length" in e)
                        for (var a = 0; a < e.length; a += 1) e[a] && i.append(e[a]);
                    else i.append(e);
                    r.loop && t.loopCreate(), r.observer && d.observer || t.update()
                },
                prependSlide: function (e) {
                    var t = this,
                        i = t.params,
                        r = t.$wrapperEl,
                        a = t.activeIndex;
                    i.loop && t.loopDestroy();
                    var s = a + 1;
                    if ("object" == typeof e && "length" in e) {
                        for (var n = 0; n < e.length; n += 1) e[n] && r.prepend(e[n]);
                        s = a + e.length
                    } else r.prepend(e);
                    i.loop && t.loopCreate(), i.observer && d.observer || t.update(), t.slideTo(s, 0, !1)
                },
                removeSlide: function (e) {
                    var t = this,
                        i = t.params,
                        r = t.$wrapperEl,
                        a = t.activeIndex;
                    i.loop && (t.loopDestroy(), t.slides = r.children("." + i.slideClass));
                    var s, n = a;
                    if ("object" == typeof e && "length" in e) {
                        for (var o = 0; o < e.length; o += 1) s = e[o], t.slides[s] && t.slides.eq(s).remove(), s < n && (n -= 1);
                        n = Math.max(n, 0)
                    } else s = e, t.slides[s] && t.slides.eq(s).remove(), s < n && (n -= 1), n = Math.max(n, 0);
                    i.loop && t.loopCreate(), i.observer && d.observer || t.update(), i.loop ? t.slideTo(n + t.loopedSlides, 0, !1) : t.slideTo(n, 0, !1)
                },
                removeAllSlides: function () {
                    for (var e = this, t = [], i = 0; i < e.slides.length; i += 1) t.push(i);
                    e.removeSlide(t)
                }
            },
            w = function () {
                var e = r.navigator.userAgent,
                    t = {
                        ios: !1,
                        android: !1,
                        androidChrome: !1,
                        desktop: !1,
                        windows: !1,
                        iphone: !1,
                        ipod: !1,
                        ipad: !1,
                        cordova: r.cordova || r.phonegap,
                        phonegap: r.cordova || r.phonegap
                    },
                    i = e.match(/(Windows Phone);?[\s\/]+([\d.]+)?/),
                    a = e.match(/(Android);?[\s\/]+([\d.]+)?/),
                    s = e.match(/(iPad).*OS\s([\d_]+)/),
                    n = e.match(/(iPod)(.*OS\s([\d_]+))?/),
                    o = !s && e.match(/(iPhone\sOS|iOS)\s([\d_]+)/);
                if (i && (t.os = "windows", t.osVersion = i[2], t.windows = !0), a && !i && (t.os = "android", t.osVersion = a[2], t.android = !0, t.androidChrome = e.toLowerCase().indexOf("chrome") >= 0), (s || o || n) && (t.os = "ios", t.ios = !0), o && !n && (t.osVersion = o[2].replace(/_/g, "."), t.iphone = !0), s && (t.osVersion = s[2].replace(/_/g, "."), t.ipad = !0), n && (t.osVersion = n[3] ? n[3].replace(/_/g, ".") : null, t.iphone = !0), t.ios && t.osVersion && e.indexOf("Version/") >= 0 && "10" === t.osVersion.split(".")[0] && (t.osVersion = e.toLowerCase().split("version/")[1].split(" ")[0]), t.desktop = !(t.os || t.android || t.webView), t.webView = (o || s || n) && e.match(/.*AppleWebKit(?!.*Safari)/i), t.os && "ios" === t.os) {
                    var d = t.osVersion.split("."),
                        h = l.querySelector('meta[name="viewport"]');
                    t.minimalUi = !t.webView && (n || o) && (1 * d[0] == 7 ? 1 * d[1] >= 1 : 1 * d[0] > 7) && h && h.getAttribute("content").indexOf("minimal-ui") >= 0
                }
                return t.pixelRatio = r.devicePixelRatio || 1, t
            }(),
            b = function (t) {
                var i = this,
                    r = i.touchEventsData,
                    a = i.params,
                    s = i.touches,
                    n = t;
                if (n.originalEvent && (n = n.originalEvent), r.isTouchEvent = "touchstart" === n.type, (r.isTouchEvent || !("which" in n) || 3 !== n.which) && (!r.isTouched || !r.isMoved))
                    if (a.noSwiping && e(n.target).closest("." + a.noSwipingClass)[0]) i.allowClick = !0;
                    else if (!a.swipeHandler || e(n).closest(a.swipeHandler)[0]) {
                    s.currentX = "touchstart" === n.type ? n.targetTouches[0].pageX : n.pageX, s.currentY = "touchstart" === n.type ? n.targetTouches[0].pageY : n.pageY;
                    var d = s.currentX,
                        h = s.currentY;
                    if (!(w.ios && !w.cordova && a.iOSEdgeSwipeDetection && d <= a.iOSEdgeSwipeThreshold && d >= window.screen.width - a.iOSEdgeSwipeThreshold)) {
                        if (o.extend(r, {
                                isTouched: !0,
                                isMoved: !1,
                                allowTouchCallbacks: !0,
                                isScrolling: void 0,
                                startMoving: void 0
                            }), s.startX = d, s.startY = h, r.touchStartTime = o.now(), i.allowClick = !0, i.updateSize(), i.swipeDirection = void 0, a.threshold > 0 && (r.allowThresholdMove = !1), "touchstart" !== n.type) {
                            var c = !0;
                            e(n.target).is(r.formElements) && (c = !1), l.activeElement && e(l.activeElement).is(r.formElements) && l.activeElement.blur(), c && i.allowTouchMove && n.preventDefault()
                        }
                        i.emit("touchStart", n)
                    }
                }
            },
            x = function (t) {
                var i = this,
                    r = i.touchEventsData,
                    a = i.params,
                    s = i.touches,
                    n = i.rtl,
                    d = t;
                if (d.originalEvent && (d = d.originalEvent), !r.isTouchEvent || "mousemove" !== d.type) {
                    var h = "touchmove" === d.type ? d.targetTouches[0].pageX : d.pageX,
                        c = "touchmove" === d.type ? d.targetTouches[0].pageY : d.pageY;
                    if (d.preventedByNestedSwiper) return s.startX = h, void(s.startY = c);
                    if (!i.allowTouchMove) return i.allowClick = !1, void(r.isTouched && (o.extend(s, {
                        startX: h,
                        startY: c,
                        currentX: h,
                        currentY: c
                    }), r.touchStartTime = o.now()));
                    if (r.isTouchEvent && a.touchReleaseOnEdges && !a.loop)
                        if (i.isVertical()) {
                            if (c < s.startY && i.translate <= i.maxTranslate() || c > s.startY && i.translate >= i.minTranslate()) return r.isTouched = !1, void(r.isMoved = !1)
                        } else if (h < s.startX && i.translate <= i.maxTranslate() || h > s.startX && i.translate >= i.minTranslate()) return;
                    if (r.isTouchEvent && l.activeElement && d.target === l.activeElement && e(d.target).is(r.formElements)) return r.isMoved = !0, void(i.allowClick = !1);
                    if (r.allowTouchCallbacks && i.emit("touchMove", d), !(d.targetTouches && d.targetTouches.length > 1)) {
                        s.currentX = h, s.currentY = c;
                        var u = s.currentX - s.startX,
                            p = s.currentY - s.startY;
                        if (void 0 === r.isScrolling) {
                            var f;
                            i.isHorizontal() && s.currentY === s.startY || i.isVertical() && s.currentX === s.startX ? r.isScrolling = !1 : u * u + p * p >= 25 && (f = 180 * Math.atan2(Math.abs(p), Math.abs(u)) / Math.PI, r.isScrolling = i.isHorizontal() ? f > a.touchAngle : 90 - f > a.touchAngle)
                        }
                        if (r.isScrolling && i.emit("touchMoveOpposite", d), "undefined" == typeof startMoving && (s.currentX === s.startX && s.currentY === s.startY || (r.startMoving = !0)), r.isTouched)
                            if (r.isScrolling) r.isTouched = !1;
                            else if (r.startMoving) {
                            i.allowClick = !1, d.preventDefault(), a.touchMoveStopPropagation && !a.nested && d.stopPropagation(), r.isMoved || (a.loop && i.loopFix(), r.startTranslate = i.getTranslate(), i.setTransition(0), i.animating && i.$wrapperEl.trigger("webkitTransitionEnd transitionend"), r.allowMomentumBounce = !1, !a.grabCursor || !0 !== i.allowSlideNext && !0 !== i.allowSlidePrev || i.setGrabCursor(!0), i.emit("sliderFirstMove", d)), i.emit("sliderMove", d), r.isMoved = !0;
                            var m = i.isHorizontal() ? u : p;
                            s.diff = m, m *= a.touchRatio, n && (m = -m), i.swipeDirection = m > 0 ? "prev" : "next", r.currentTranslate = m + r.startTranslate;
                            var v = !0,
                                g = a.resistanceRatio;
                            if (a.touchReleaseOnEdges && (g = 0), m > 0 && r.currentTranslate > i.minTranslate() ? (v = !1, a.resistance && (r.currentTranslate = i.minTranslate() - 1 + Math.pow(-i.minTranslate() + r.startTranslate + m, g))) : m < 0 && r.currentTranslate < i.maxTranslate() && (v = !1, a.resistance && (r.currentTranslate = i.maxTranslate() + 1 - Math.pow(i.maxTranslate() - r.startTranslate - m, g))), v && (d.preventedByNestedSwiper = !0), !i.allowSlideNext && "next" === i.swipeDirection && r.currentTranslate < r.startTranslate && (r.currentTranslate = r.startTranslate), !i.allowSlidePrev && "prev" === i.swipeDirection && r.currentTranslate > r.startTranslate && (r.currentTranslate = r.startTranslate), a.threshold > 0) {
                                if (!(Math.abs(m) > a.threshold || r.allowThresholdMove)) return void(r.currentTranslate = r.startTranslate);
                                if (!r.allowThresholdMove) return r.allowThresholdMove = !0, s.startX = s.currentX, s.startY = s.currentY, r.currentTranslate = r.startTranslate, void(s.diff = i.isHorizontal() ? s.currentX - s.startX : s.currentY - s.startY)
                            }
                            a.followFinger && ((a.freeMode || a.watchSlidesProgress || a.watchSlidesVisibility) && (i.updateActiveIndex(), i.updateSlidesClasses()), a.freeMode && (0 === r.velocities.length && r.velocities.push({
                                position: s[i.isHorizontal() ? "startX" : "startY"],
                                time: r.touchStartTime
                            }), r.velocities.push({
                                position: s[i.isHorizontal() ? "currentX" : "currentY"],
                                time: o.now()
                            })), i.updateProgress(r.currentTranslate), i.setTranslate(r.currentTranslate))
                        }
                    }
                }
            },
            T = function (e) {
                var t = this,
                    i = t.touchEventsData,
                    r = t.params,
                    a = t.touches,
                    s = t.rtl,
                    n = t.$wrapperEl,
                    l = t.slidesGrid,
                    d = t.snapGrid,
                    h = e;
                if (h.originalEvent && (h = h.originalEvent), i.allowTouchCallbacks && t.emit("touchEnd", h), i.allowTouchCallbacks = !1, i.isTouched) {
                    r.grabCursor && i.isMoved && i.isTouched && (!0 === t.allowSlideNext || !0 === t.allowSlidePrev) && t.setGrabCursor(!1);
                    var c = o.now(),
                        u = c - i.touchStartTime;
                    if (t.allowClick && (t.updateClickedSlide(h), t.emit("tap", h), u < 300 && c - i.lastClickTime > 300 && (i.clickTimeout && clearTimeout(i.clickTimeout), i.clickTimeout = o.nextTick(function () {
                            t && !t.destroyed && t.emit("click", h)
                        }, 300)), u < 300 && c - i.lastClickTime < 300 && (i.clickTimeout && clearTimeout(i.clickTimeout), t.emit("doubleTap", h))), i.lastClickTime = o.now(), o.nextTick(function () {
                            t.destroyed || (t.allowClick = !0)
                        }), !i.isTouched || !i.isMoved || !t.swipeDirection || 0 === a.diff || i.currentTranslate === i.startTranslate) return i.isTouched = !1, void(i.isMoved = !1);
                    i.isTouched = !1, i.isMoved = !1;
                    var p;
                    if (p = r.followFinger ? s ? t.translate : -t.translate : -i.currentTranslate, r.freeMode) {
                        if (p < -t.minTranslate()) return void t.slideTo(t.activeIndex);
                        if (p > -t.maxTranslate()) return void(t.slides.length < d.length ? t.slideTo(d.length - 1) : t.slideTo(t.slides.length - 1));
                        if (r.freeModeMomentum) {
                            if (i.velocities.length > 1) {
                                var f = i.velocities.pop(),
                                    m = i.velocities.pop(),
                                    v = f.position - m.position,
                                    g = f.time - m.time;
                                t.velocity = v / g, t.velocity /= 2, Math.abs(t.velocity) < r.freeModeMinimumVelocity && (t.velocity = 0), (g > 150 || o.now() - f.time > 300) && (t.velocity = 0)
                            } else t.velocity = 0;
                            t.velocity *= r.freeModeMomentumVelocityRatio, i.velocities.length = 0;
                            var _ = 1e3 * r.freeModeMomentumRatio,
                                y = t.velocity * _,
                                w = t.translate + y;
                            s && (w = -w);
                            var b, x = !1,
                                T = 20 * Math.abs(t.velocity) * r.freeModeMomentumBounceRatio;
                            if (w < t.maxTranslate()) r.freeModeMomentumBounce ? (w + t.maxTranslate() < -T && (w = t.maxTranslate() - T), b = t.maxTranslate(), x = !0, i.allowMomentumBounce = !0) : w = t.maxTranslate();
                            else if (w > t.minTranslate()) r.freeModeMomentumBounce ? (w - t.minTranslate() > T && (w = t.minTranslate() + T), b = t.minTranslate(), x = !0, i.allowMomentumBounce = !0) : w = t.minTranslate();
                            else if (r.freeModeSticky) {
                                for (var S, E = 0; E < d.length; E += 1)
                                    if (d[E] > -w) {
                                        S = E;
                                        break
                                    } w = -(w = Math.abs(d[S] - w) < Math.abs(d[S - 1] - w) || "next" === t.swipeDirection ? d[S] : d[S - 1])
                            }
                            if (0 !== t.velocity) _ = s ? Math.abs((-w - t.translate) / t.velocity) : Math.abs((w - t.translate) / t.velocity);
                            else if (r.freeModeSticky) return void t.slideReset();
                            r.freeModeMomentumBounce && x ? (t.updateProgress(b), t.setTransition(_), t.setTranslate(w), t.transitionStart(), t.animating = !0, n.transitionEnd(function () {
                                t && !t.destroyed && i.allowMomentumBounce && (t.emit("momentumBounce"), t.setTransition(r.speed), t.setTranslate(b), n.transitionEnd(function () {
                                    t && !t.destroyed && t.transitionEnd()
                                }))
                            })) : t.velocity ? (t.updateProgress(w), t.setTransition(_), t.setTranslate(w), t.transitionStart(), t.animating || (t.animating = !0, n.transitionEnd(function () {
                                t && !t.destroyed && t.transitionEnd()
                            }))) : t.updateProgress(w), t.updateActiveIndex(), t.updateSlidesClasses()
                        }(!r.freeModeMomentum || u >= r.longSwipesMs) && (t.updateProgress(), t.updateActiveIndex(), t.updateSlidesClasses())
                    } else {
                        for (var C = 0, P = t.slidesSizesGrid[0], M = 0; M < l.length; M += r.slidesPerGroup) void 0 !== l[M + r.slidesPerGroup] ? p >= l[M] && p < l[M + r.slidesPerGroup] && (C = M, P = l[M + r.slidesPerGroup] - l[M]) : p >= l[M] && (C = M, P = l[l.length - 1] - l[l.length - 2]);
                        var k = (p - l[C]) / P;
                        if (u > r.longSwipesMs) {
                            if (!r.longSwipes) return void t.slideTo(t.activeIndex);
                            "next" === t.swipeDirection && (k >= r.longSwipesRatio ? t.slideTo(C + r.slidesPerGroup) : t.slideTo(C)), "prev" === t.swipeDirection && (k > 1 - r.longSwipesRatio ? t.slideTo(C + r.slidesPerGroup) : t.slideTo(C))
                        } else {
                            if (!r.shortSwipes) return void t.slideTo(t.activeIndex);
                            "next" === t.swipeDirection && t.slideTo(C + r.slidesPerGroup), "prev" === t.swipeDirection && t.slideTo(C)
                        }
                    }
                }
            },
            S = function () {
                var e = this,
                    t = e.params,
                    i = e.el;
                if (!i || 0 !== i.offsetWidth) {
                    t.breakpoints && e.setBreakpoint();
                    var r = e.allowSlideNext,
                        a = e.allowSlidePrev;
                    if (e.allowSlideNext = !0, e.allowSlidePrev = !0, e.updateSize(), e.updateSlides(), t.freeMode) {
                        var s = Math.min(Math.max(e.translate, e.maxTranslate()), e.minTranslate());
                        e.setTranslate(s), e.updateActiveIndex(), e.updateSlidesClasses(), t.autoHeight && e.updateAutoHeight()
                    } else e.updateSlidesClasses(), ("auto" === t.slidesPerView || t.slidesPerView > 1) && e.isEnd && !e.params.centeredSlides ? e.slideTo(e.slides.length - 1, 0, !1, !0) : e.slideTo(e.activeIndex, 0, !1, !0);
                    e.allowSlidePrev = a, e.allowSlideNext = r
                }
            },
            E = function (e) {
                var t = this;
                t.allowClick || (t.params.preventClicks && e.preventDefault(), t.params.preventClicksPropagation && t.animating && (e.stopPropagation(), e.stopImmediatePropagation()))
            },
            C = {
                init: !0,
                direction: "horizontal",
                touchEventsTarget: "container",
                initialSlide: 0,
                speed: 300,
                iOSEdgeSwipeDetection: !1,
                iOSEdgeSwipeThreshold: 20,
                freeMode: !1,
                freeModeMomentum: !0,
                freeModeMomentumRatio: 1,
                freeModeMomentumBounce: !0,
                freeModeMomentumBounceRatio: 1,
                freeModeMomentumVelocityRatio: 1,
                freeModeSticky: !1,
                freeModeMinimumVelocity: .02,
                autoHeight: !1,
                setWrapperSize: !1,
                virtualTranslate: !1,
                effect: "slide",
                breakpoints: void 0,
                spaceBetween: 0,
                slidesPerView: 1,
                slidesPerColumn: 1,
                slidesPerColumnFill: "column",
                slidesPerGroup: 1,
                centeredSlides: !1,
                slidesOffsetBefore: 0,
                slidesOffsetAfter: 0,
                normalizeSlideIndex: !0,
                roundLengths: !1,
                touchRatio: 1,
                touchAngle: 45,
                simulateTouch: !0,
                shortSwipes: !0,
                longSwipes: !0,
                longSwipesRatio: .5,
                longSwipesMs: 300,
                followFinger: !0,
                allowTouchMove: !0,
                threshold: 0,
                touchMoveStopPropagation: !0,
                touchReleaseOnEdges: !1,
                uniqueNavElements: !0,
                resistance: !0,
                resistanceRatio: .85,
                watchSlidesProgress: !1,
                watchSlidesVisibility: !1,
                grabCursor: !1,
                preventClicks: !0,
                preventClicksPropagation: !0,
                slideToClickedSlide: !1,
                preloadImages: !0,
                updateOnImagesReady: !0,
                loop: !1,
                loopAdditionalSlides: 0,
                loopedSlides: null,
                loopFillGroupWithBlank: !1,
                allowSlidePrev: !0,
                allowSlideNext: !0,
                swipeHandler: null,
                noSwiping: !0,
                noSwipingClass: "swiper-no-swiping",
                passiveListeners: !0,
                containerModifierClass: "swiper-container-",
                slideClass: "swiper-slide",
                slideBlankClass: "swiper-slide-invisible-blank",
                slideActiveClass: "swiper-slide-active",
                slideDuplicateActiveClass: "swiper-slide-duplicate-active",
                slideVisibleClass: "swiper-slide-visible",
                slideDuplicateClass: "swiper-slide-duplicate",
                slideNextClass: "swiper-slide-next",
                slideDuplicateNextClass: "swiper-slide-duplicate-next",
                slidePrevClass: "swiper-slide-prev",
                slideDuplicatePrevClass: "swiper-slide-duplicate-prev",
                wrapperClass: "swiper-wrapper",
                runCallbacksOnInit: !0
            },
            P = {
                update: u,
                translate: p,
                transition: f,
                slide: v,
                loop: g,
                grabCursor: _,
                manipulation: y,
                events: {
                    attachEvents: function () {
                        var e = this,
                            t = e.params,
                            i = e.touchEvents,
                            r = e.el,
                            a = e.wrapperEl;
                        e.onTouchStart = b.bind(e), e.onTouchMove = x.bind(e), e.onTouchEnd = T.bind(e), e.onClick = E.bind(e);
                        var s = "container" === t.touchEventsTarget ? r : a,
                            n = !!t.nested;
                        if (m.ie) s.addEventListener(i.start, e.onTouchStart, !1), (d.touch ? s : l).addEventListener(i.move, e.onTouchMove, n), (d.touch ? s : l).addEventListener(i.end, e.onTouchEnd, !1);
                        else {
                            if (d.touch) {
                                var o = !("touchstart" !== i.start || !d.passiveListener || !t.passiveListeners) && {
                                    passive: !0,
                                    capture: !1
                                };
                                s.addEventListener(i.start, e.onTouchStart, o), s.addEventListener(i.move, e.onTouchMove, d.passiveListener ? {
                                    passive: !1,
                                    capture: n
                                } : n), s.addEventListener(i.end, e.onTouchEnd, o)
                            }(t.simulateTouch && !w.ios && !w.android || t.simulateTouch && !d.touch && w.ios) && (s.addEventListener("mousedown", e.onTouchStart, !1), l.addEventListener("mousemove", e.onTouchMove, n), l.addEventListener("mouseup", e.onTouchEnd, !1))
                        }(t.preventClicks || t.preventClicksPropagation) && s.addEventListener("click", e.onClick, !0), e.on("resize observerUpdate", S)
                    },
                    detachEvents: function () {
                        var e = this,
                            t = e.params,
                            i = e.touchEvents,
                            r = e.el,
                            a = e.wrapperEl,
                            s = "container" === t.touchEventsTarget ? r : a,
                            n = !!t.nested;
                        if (m.ie) s.removeEventListener(i.start, e.onTouchStart, !1), (d.touch ? s : l).removeEventListener(i.move, e.onTouchMove, n), (d.touch ? s : l).removeEventListener(i.end, e.onTouchEnd, !1);
                        else {
                            if (d.touch) {
                                var o = !("onTouchStart" !== i.start || !d.passiveListener || !t.passiveListeners) && {
                                    passive: !0,
                                    capture: !1
                                };
                                s.removeEventListener(i.start, e.onTouchStart, o), s.removeEventListener(i.move, e.onTouchMove, n), s.removeEventListener(i.end, e.onTouchEnd, o)
                            }(t.simulateTouch && !w.ios && !w.android || t.simulateTouch && !d.touch && w.ios) && (s.removeEventListener("mousedown", e.onTouchStart, !1), l.removeEventListener("mousemove", e.onTouchMove, n), l.removeEventListener("mouseup", e.onTouchEnd, !1))
                        }(t.preventClicks || t.preventClicksPropagation) && s.removeEventListener("click", e.onClick, !0), e.off("resize observerUpdate", S)
                    }
                },
                breakpoints: {
                    setBreakpoint: function () {
                        var e = this,
                            t = e.activeIndex,
                            i = e.loopedSlides;
                        void 0 === i && (i = 0);
                        var r = e.params,
                            a = r.breakpoints;
                        if (a && (!a || 0 !== Object.keys(a).length)) {
                            var s = e.getBreakpoint(a);
                            if (s && e.currentBreakpoint !== s) {
                                var n = s in a ? a[s] : e.originalParams,
                                    l = r.loop && n.slidesPerView !== r.slidesPerView;
                                o.extend(e.params, n), o.extend(e, {
                                    allowTouchMove: e.params.allowTouchMove,
                                    allowSlideNext: e.params.allowSlideNext,
                                    allowSlidePrev: e.params.allowSlidePrev
                                }), e.currentBreakpoint = s, l && (e.loopDestroy(), e.loopCreate(), e.updateSlides(), e.slideTo(t - i + e.loopedSlides, 0, !1)), e.emit("breakpoint", n)
                            }
                        }
                    },
                    getBreakpoint: function (e) {
                        if (e) {
                            var t = !1,
                                i = [];
                            Object.keys(e).forEach(function (e) {
                                i.push(e)
                            }), i.sort(function (e, t) {
                                return parseInt(e, 10) - parseInt(t, 10)
                            });
                            for (var a = 0; a < i.length; a += 1) {
                                var s = i[a];
                                s >= r.innerWidth && !t && (t = s)
                            }
                            return t || "max"
                        }
                    }
                },
                classes: {
                    addClasses: function () {
                        var e = this,
                            t = e.classNames,
                            i = e.params,
                            a = e.rtl,
                            s = e.$el,
                            n = [];
                        n.push(i.direction), i.freeMode && n.push("free-mode"), d.flexbox || n.push("no-flexbox"), i.autoHeight && n.push("autoheight"), a && n.push("rtl"), i.slidesPerColumn > 1 && n.push("multirow"), w.android && n.push("android"), w.ios && n.push("ios"), (r.navigator.pointerEnabled || r.navigator.msPointerEnabled) && n.push("wp8-" + i.direction), n.forEach(function (e) {
                            t.push(i.containerModifierClass + e)
                        }), s.addClass(t.join(" "))
                    },
                    removeClasses: function () {
                        var e = this,
                            t = e.$el,
                            i = e.classNames;
                        t.removeClass(i.join(" "))
                    }
                },
                images: {
                    loadImage: function (e, t, i, a, s, n) {
                        function o() {
                            n && n()
                        }
                        var l;
                        e.complete && s ? o() : t ? ((l = new r.Image).onload = o, l.onerror = o, a && (l.sizes = a), i && (l.srcset = i), t && (l.src = t)) : o()
                    },
                    preloadImages: function () {
                        var e = this;
                        e.imagesToLoad = e.$el.find("img");
                        for (var t = 0; t < e.imagesToLoad.length; t += 1) {
                            var i = e.imagesToLoad[t];
                            e.loadImage(i, i.currentSrc || i.getAttribute("src"), i.srcset || i.getAttribute("srcset"), i.sizes || i.getAttribute("sizes"), !0, function () {
                                void 0 !== e && null !== e && e && !e.destroyed && (void 0 !== e.imagesLoaded && (e.imagesLoaded += 1), e.imagesLoaded === e.imagesToLoad.length && (e.params.updateOnImagesReady && e.update(), e.emit("imagesReady")))
                            })
                        }
                    }
                }
            },
            M = {},
            k = function (t) {
                function i() {
                    for (var a = [], s = arguments.length; s--;) a[s] = arguments[s];
                    var n, l;
                    if (1 === a.length && a[0].constructor && a[0].constructor === Object) l = a[0];
                    else {
                        var h;
                        n = (h = a)[0], l = h[1]
                    }
                    l || (l = {}), l = o.extend({}, l), n && !l.el && (l.el = n), t.call(this, l), Object.keys(P).forEach(function (e) {
                        Object.keys(P[e]).forEach(function (t) {
                            i.prototype[t] || (i.prototype[t] = P[e][t])
                        })
                    });
                    var c = this;
                    void 0 === c.modules && (c.modules = {}), Object.keys(c.modules).forEach(function (e) {
                        var t = c.modules[e];
                        if (t.params) {
                            var i = Object.keys(t.params)[0],
                                r = t.params[i];
                            if ("object" != typeof r) return;
                            if (!(i in l && "enabled" in r)) return;
                            !0 === l[i] && (l[i] = {
                                enabled: !0
                            }), "object" != typeof l[i] || "enabled" in l[i] || (l[i].enabled = !0), l[i] || (l[i] = {
                                enabled: !1
                            })
                        }
                    });
                    var u = o.extend({}, C);
                    c.useModulesParams(u), c.params = o.extend({}, u, M, l), c.originalParams = o.extend({}, c.params), c.passedParams = o.extend({}, l);
                    var p = e(c.params.el);
                    if (n = p[0]) {
                        if (p.length > 1) {
                            var f = [];
                            return p.each(function (e, t) {
                                var r = o.extend({}, l, {
                                    el: t
                                });
                                f.push(new i(r))
                            }), f
                        }
                        n.swiper = c, p.data("swiper", c);
                        var m = p.children("." + c.params.wrapperClass);
                        return o.extend(c, {
                            $el: p,
                            el: n,
                            $wrapperEl: m,
                            wrapperEl: m[0],
                            classNames: [],
                            slides: e(),
                            slidesGrid: [],
                            snapGrid: [],
                            slidesSizesGrid: [],
                            isHorizontal: function () {
                                return "horizontal" === c.params.direction
                            },
                            isVertical: function () {
                                return "vertical" === c.params.direction
                            },
                            rtl: "horizontal" === c.params.direction && ("rtl" === n.dir.toLowerCase() || "rtl" === p.css("direction")),
                            wrongRTL: "-webkit-box" === m.css("display"),
                            activeIndex: 0,
                            realIndex: 0,
                            isBeginning: !0,
                            isEnd: !1,
                            translate: 0,
                            progress: 0,
                            velocity: 0,
                            animating: !1,
                            allowSlideNext: c.params.allowSlideNext,
                            allowSlidePrev: c.params.allowSlidePrev,
                            touchEvents: function () {
                                var e = ["touchstart", "touchmove", "touchend"],
                                    t = ["mousedown", "mousemove", "mouseup"];
                                return r.navigator.pointerEnabled ? t = ["pointerdown", "pointermove", "pointerup"] : r.navigator.msPointerEnabled && (t = ["MSPointerDown", "MsPointerMove", "MsPointerUp"]), {
                                    start: d.touch || !c.params.simulateTouch ? e[0] : t[0],
                                    move: d.touch || !c.params.simulateTouch ? e[1] : t[1],
                                    end: d.touch || !c.params.simulateTouch ? e[2] : t[2]
                                }
                            }(),
                            touchEventsData: {
                                isTouched: void 0,
                                isMoved: void 0,
                                allowTouchCallbacks: void 0,
                                touchStartTime: void 0,
                                isScrolling: void 0,
                                currentTranslate: void 0,
                                startTranslate: void 0,
                                allowThresholdMove: void 0,
                                formElements: "input, select, option, textarea, button, video",
                                lastClickTime: o.now(),
                                clickTimeout: void 0,
                                velocities: [],
                                allowMomentumBounce: void 0,
                                isTouchEvent: void 0,
                                startMoving: void 0
                            },
                            allowClick: !0,
                            allowTouchMove: c.params.allowTouchMove,
                            touches: {
                                startX: 0,
                                startY: 0,
                                currentX: 0,
                                currentY: 0,
                                diff: 0
                            },
                            imagesToLoad: [],
                            imagesLoaded: 0
                        }), c.useModules(), c.params.init && c.init(), c
                    }
                }
                t && (i.__proto__ = t), i.prototype = Object.create(t && t.prototype), i.prototype.constructor = i;
                var a = {
                    extendedDefaults: {},
                    defaults: {},
                    Class: {},
                    $: {}
                };
                return i.prototype.slidesPerViewDynamic = function () {
                    var e = this,
                        t = e.params,
                        i = e.slides,
                        r = e.slidesGrid,
                        a = e.size,
                        s = e.activeIndex,
                        n = 1;
                    if (t.centeredSlides) {
                        for (var o, l = i[s].swiperSlideSize, d = s + 1; d < i.length; d += 1) i[d] && !o && (n += 1, (l += i[d].swiperSlideSize) > a && (o = !0));
                        for (var h = s - 1; h >= 0; h -= 1) i[h] && !o && (n += 1, (l += i[h].swiperSlideSize) > a && (o = !0))
                    } else
                        for (var c = s + 1; c < i.length; c += 1) r[c] - r[s] < a && (n += 1);
                    return n
                }, i.prototype.update = function () {
                    function e() {
                        i = Math.min(Math.max(t.translate, t.maxTranslate()), t.minTranslate()), t.setTranslate(i), t.updateActiveIndex(), t.updateSlidesClasses()
                    }
                    var t = this;
                    if (t && !t.destroyed) {
                        t.updateSize(), t.updateSlides(), t.updateProgress(), t.updateSlidesClasses();
                        var i;
                        t.params.freeMode ? (e(), t.params.autoHeight && t.updateAutoHeight()) : (("auto" === t.params.slidesPerView || t.params.slidesPerView > 1) && t.isEnd && !t.params.centeredSlides ? t.slideTo(t.slides.length - 1, 0, !1, !0) : t.slideTo(t.activeIndex, 0, !1, !0)) || e(), t.emit("update")
                    }
                }, i.prototype.init = function () {
                    var e = this;
                    e.initialized || (e.emit("beforeInit"), e.params.breakpoints && e.setBreakpoint(), e.addClasses(), e.params.loop && e.loopCreate(), e.updateSize(), e.updateSlides(), e.params.grabCursor && e.setGrabCursor(), e.params.preloadImages && e.preloadImages(), e.params.loop ? e.slideTo(e.params.initialSlide + e.loopedSlides, 0, e.params.runCallbacksOnInit) : e.slideTo(e.params.initialSlide, 0, e.params.runCallbacksOnInit), e.attachEvents(), e.initialized = !0, e.emit("init"))
                }, i.prototype.destroy = function (e, t) {
                    void 0 === e && (e = !0), void 0 === t && (t = !0);
                    var i = this,
                        r = i.params,
                        a = i.$el,
                        s = i.$wrapperEl,
                        n = i.slides;
                    i.emit("beforeDestroy"), i.initialized = !1, i.detachEvents(), r.loop && i.loopDestroy(), t && (i.removeClasses(), a.removeAttr("style"), s.removeAttr("style"), n && n.length && n.removeClass([r.slideVisibleClass, r.slideActiveClass, r.slideNextClass, r.slidePrevClass].join(" ")).removeAttr("style").removeAttr("data-swiper-slide-index").removeAttr("data-swiper-column").removeAttr("data-swiper-row")), i.emit("destroy"), Object.keys(i.eventsListeners).forEach(function (e) {
                        i.off(e)
                    }), !1 !== e && (i.$el[0].swiper = null, i.$el.data("swiper", null), o.deleteProps(i)), i.destroyed = !0
                }, i.extendDefaults = function (e) {
                    o.extend(M, e)
                }, a.extendedDefaults.get = function () {
                    return M
                }, a.defaults.get = function () {
                    return C
                }, a.Class.get = function () {
                    return t
                }, a.$.get = function () {
                    return e
                }, Object.defineProperties(i, a), i
            }(h),
            z = {
                name: "device",
                proto: {
                    device: w
                },
                static: {
                    device: w
                }
            },
            R = {
                name: "support",
                proto: {
                    support: d
                },
                static: {
                    support: d
                }
            },
            O = {
                name: "browser",
                proto: {
                    browser: m
                },
                static: {
                    browser: m
                }
            },
            A = {
                name: "resize",
                create: function () {
                    var e = this;
                    o.extend(e, {
                        resize: {
                            resizeHandler: function () {
                                e && !e.destroyed && e.initialized && (e.emit("beforeResize"), e.emit("resize"))
                            },
                            orientationChangeHandler: function () {
                                e && !e.destroyed && e.initialized && e.emit("orientationchange")
                            }
                        }
                    })
                },
                on: {
                    init: function () {
                        var e = this;
                        r.addEventListener("resize", e.resize.resizeHandler), r.addEventListener("orientationchange", e.resize.orientationChangeHandler)
                    },
                    destroy: function () {
                        var e = this;
                        r.removeEventListener("resize", e.resize.resizeHandler), r.removeEventListener("orientationchange", e.resize.orientationChangeHandler)
                    }
                }
            },
            D = {
                func: r.MutationObserver || r.WebkitMutationObserver,
                attach: function (e, t) {
                    void 0 === t && (t = {});
                    var i = this,
                        r = new(0, D.func)(function (e) {
                            e.forEach(function (e) {
                                i.emit("observerUpdate", e)
                            })
                        });
                    r.observe(e, {
                        attributes: void 0 === t.attributes || t.attributes,
                        childList: void 0 === t.childList || t.childList,
                        characterData: void 0 === t.characterData || t.characterData
                    }), i.observer.observers.push(r)
                },
                init: function () {
                    var e = this;
                    if (d.observer && e.params.observer) {
                        if (e.params.observeParents)
                            for (var t = e.$el.parents(), i = 0; i < t.length; i += 1) e.observer.attach(t[i]);
                        e.observer.attach(e.$el[0], {
                            childList: !1
                        }), e.observer.attach(e.$wrapperEl[0], {
                            attributes: !1
                        })
                    }
                },
                destroy: function () {
                    var e = this;
                    e.observer.observers.forEach(function (e) {
                        e.disconnect()
                    }), e.observer.observers = []
                }
            },
            I = {
                name: "observer",
                params: {
                    observer: !1,
                    observeParents: !1
                },
                create: function () {
                    var e = this;
                    o.extend(e, {
                        observer: {
                            init: D.init.bind(e),
                            attach: D.attach.bind(e),
                            destroy: D.destroy.bind(e),
                            observers: []
                        }
                    })
                },
                on: {
                    init: function () {
                        this.observer.init()
                    },
                    destroy: function () {
                        this.observer.destroy()
                    }
                }
            },
            L = {
                update: function (e) {
                    function t() {
                        i.updateSlides(), i.updateProgress(), i.updateSlidesClasses(), i.lazy && i.params.lazy.enabled && i.lazy.load()
                    }
                    var i = this,
                        r = i.params,
                        a = r.slidesPerView,
                        s = r.slidesPerGroup,
                        n = r.centeredSlides,
                        l = i.virtual,
                        d = l.from,
                        h = l.to,
                        c = l.slides,
                        u = l.slidesGrid,
                        p = l.renderSlide,
                        f = l.offset;
                    i.updateActiveIndex();
                    var m, v = i.activeIndex || 0;
                    m = i.rtl && i.isHorizontal() ? "right" : i.isHorizontal() ? "left" : "top";
                    var g, _;
                    n ? (g = Math.floor(a / 2) + s, _ = Math.floor(a / 2) + s) : (g = a + (s - 1), _ = s);
                    var y = Math.max((v || 0) - _, 0),
                        w = Math.min((v || 0) + g, c.length - 1),
                        b = (i.slidesGrid[y] || 0) - (i.slidesGrid[0] || 0);
                    if (o.extend(i.virtual, {
                            from: y,
                            to: w,
                            offset: b,
                            slidesGrid: i.slidesGrid
                        }), d === y && h === w && !e) return i.slidesGrid !== u && b !== f && i.slides.css(m, b + "px"), void i.updateProgress();
                    if (i.params.virtual.renderExternal) return i.params.virtual.renderExternal.call(i, {
                        offset: b,
                        from: y,
                        to: w,
                        slides: function () {
                            for (var e = [], t = y; t <= w; t += 1) e.push(c[t]);
                            return e
                        }()
                    }), void t();
                    var x = [],
                        T = [];
                    if (e) i.$wrapperEl.find("." + i.params.slideClass).remove();
                    else
                        for (var S = d; S <= h; S += 1)(S < y || S > w) && i.$wrapperEl.find("." + i.params.slideClass + '[data-swiper-slide-index="' + S + '"]').remove();
                    for (var E = 0; E < c.length; E += 1) E >= y && E <= w && (void 0 === h || e ? T.push(E) : (E > h && T.push(E), E < d && x.push(E)));
                    T.forEach(function (e) {
                        i.$wrapperEl.append(p(c[e], e))
                    }), x.sort(function (e, t) {
                        return e < t
                    }).forEach(function (e) {
                        i.$wrapperEl.prepend(p(c[e], e))
                    }), i.$wrapperEl.children(".swiper-slide").css(m, b + "px"), t()
                },
                renderSlide: function (t, i) {
                    var r = this,
                        a = r.params.virtual;
                    if (a.cache && r.virtual.cache[i]) return r.virtual.cache[i];
                    var s = e(a.renderSlide ? a.renderSlide.call(r, t, i) : '<div class="' + r.params.slideClass + '" data-swiper-slide-index="' + i + '">' + t + "</div>");
                    return s.attr("data-swiper-slide-index") || s.attr("data-swiper-slide-index", i), a.cache && (r.virtual.cache[i] = s), s
                },
                appendSlide: function (e) {
                    var t = this;
                    t.virtual.slides.push(e), t.virtual.update(!0)
                },
                prependSlide: function (e) {
                    var t = this;
                    if (t.virtual.slides.unshift(e), t.params.virtual.cache) {
                        var i = t.virtual.cache,
                            r = {};
                        Object.keys(i).forEach(function (e) {
                            r[e + 1] = i[e]
                        }), t.virtual.cache = r
                    }
                    t.virtual.update(!0), t.slideNext(0)
                }
            },
            N = {
                name: "virtual",
                params: {
                    virtual: {
                        enabled: !1,
                        slides: [],
                        cache: !0,
                        renderSlide: null,
                        renderExternal: null
                    }
                },
                create: function () {
                    var e = this;
                    o.extend(e, {
                        virtual: {
                            update: L.update.bind(e),
                            appendSlide: L.appendSlide.bind(e),
                            prependSlide: L.prependSlide.bind(e),
                            renderSlide: L.renderSlide.bind(e),
                            slides: e.params.virtual.slides,
                            cache: {}
                        }
                    })
                },
                on: {
                    beforeInit: function () {
                        var e = this;
                        if (e.params.virtual.enabled) {
                            e.classNames.push(e.params.containerModifierClass + "virtual");
                            var t = {
                                watchSlidesProgress: !0
                            };
                            o.extend(e.params, t), o.extend(e.originalParams, t), e.virtual.update()
                        }
                    },
                    setTranslate: function () {
                        var e = this;
                        e.params.virtual.enabled && e.virtual.update()
                    }
                }
            },
            $ = {
                handle: function (e) {
                    var t = this,
                        i = e;
                    i.originalEvent && (i = i.originalEvent);
                    var a = i.keyCode || i.charCode;
                    if (!t.allowSlideNext && (t.isHorizontal() && 39 === a || t.isVertical() && 40 === a)) return !1;
                    if (!t.allowSlidePrev && (t.isHorizontal() && 37 === a || t.isVertical() && 38 === a)) return !1;
                    if (!(i.shiftKey || i.altKey || i.ctrlKey || i.metaKey || l.activeElement && l.activeElement.nodeName && ("input" === l.activeElement.nodeName.toLowerCase() || "textarea" === l.activeElement.nodeName.toLowerCase()))) {
                        if (37 === a || 39 === a || 38 === a || 40 === a) {
                            var s = !1;
                            if (t.$el.parents("." + t.params.slideClass).length > 0 && 0 === t.$el.parents("." + t.params.slideActiveClass).length) return;
                            var n = {
                                    left: r.pageXOffset,
                                    top: r.pageYOffset
                                },
                                o = r.innerWidth,
                                d = r.innerHeight,
                                h = t.$el.offset();
                            t.rtl && (h.left -= t.$el[0].scrollLeft);
                            for (var c = [
                                    [h.left, h.top],
                                    [h.left + t.width, h.top],
                                    [h.left, h.top + t.height],
                                    [h.left + t.width, h.top + t.height]
                                ], u = 0; u < c.length; u += 1) {
                                var p = c[u];
                                p[0] >= n.left && p[0] <= n.left + o && p[1] >= n.top && p[1] <= n.top + d && (s = !0)
                            }
                            if (!s) return
                        }
                        t.isHorizontal() ? (37 !== a && 39 !== a || (i.preventDefault ? i.preventDefault() : i.returnValue = !1), (39 === a && !t.rtl || 37 === a && t.rtl) && t.slideNext(), (37 === a && !t.rtl || 39 === a && t.rtl) && t.slidePrev()) : (38 !== a && 40 !== a || (i.preventDefault ? i.preventDefault() : i.returnValue = !1), 40 === a && t.slideNext(), 38 === a && t.slidePrev()), t.emit("keyPress", a)
                    }
                },
                enable: function () {
                    var t = this;
                    t.keyboard.enabled || (e(l).on("keydown", t.keyboard.handle), t.keyboard.enabled = !0)
                },
                disable: function () {
                    var t = this;
                    t.keyboard.enabled && (e(l).off("keydown", t.keyboard.handle), t.keyboard.enabled = !1)
                }
            },
            F = {
                name: "keyboard",
                params: {
                    keyboard: {
                        enabled: !1
                    }
                },
                create: function () {
                    var e = this;
                    o.extend(e, {
                        keyboard: {
                            enabled: !1,
                            enable: $.enable.bind(e),
                            disable: $.disable.bind(e),
                            handle: $.handle.bind(e)
                        }
                    })
                },
                on: {
                    init: function () {
                        var e = this;
                        e.params.keyboard.enabled && e.keyboard.enable()
                    },
                    destroy: function () {
                        var e = this;
                        e.keyboard.enabled && e.keyboard.disable()
                    }
                }
            },
            X = {
                lastScrollTime: o.now(),
                event: r.navigator.userAgent.indexOf("firefox") > -1 ? "DOMMouseScroll" : function () {
                    var e = "onwheel" in l;
                    if (!e) {
                        var t = l.createElement("div");
                        t.setAttribute("onwheel", "return;"), e = "function" == typeof t.onwheel
                    }
                    return !e && l.implementation && l.implementation.hasFeature && !0 !== l.implementation.hasFeature("", "") && (e = l.implementation.hasFeature("Events.wheel", "3.0")), e
                }() ? "wheel" : "mousewheel",
                normalize: function (e) {
                    var t = 0,
                        i = 0,
                        r = 0,
                        a = 0;
                    return "detail" in e && (i = e.detail), "wheelDelta" in e && (i = -e.wheelDelta / 120), "wheelDeltaY" in e && (i = -e.wheelDeltaY / 120), "wheelDeltaX" in e && (t = -e.wheelDeltaX / 120), "axis" in e && e.axis === e.HORIZONTAL_AXIS && (t = i, i = 0), r = 10 * t, a = 10 * i, "deltaY" in e && (a = e.deltaY), "deltaX" in e && (r = e.deltaX), (r || a) && e.deltaMode && (1 === e.deltaMode ? (r *= 40, a *= 40) : (r *= 800, a *= 800)), r && !t && (t = r < 1 ? -1 : 1), a && !i && (i = a < 1 ? -1 : 1), {
                        spinX: t,
                        spinY: i,
                        pixelX: r,
                        pixelY: a
                    }
                },
                handle: function (e) {
                    var t = e,
                        i = this,
                        a = i.params.mousewheel;
                    t.originalEvent && (t = t.originalEvent);
                    var s = 0,
                        n = i.rtl ? -1 : 1,
                        l = X.normalize(t);
                    if (a.forceToAxis)
                        if (i.isHorizontal()) {
                            if (!(Math.abs(l.pixelX) > Math.abs(l.pixelY))) return !0;
                            s = l.pixelX * n
                        } else {
                            if (!(Math.abs(l.pixelY) > Math.abs(l.pixelX))) return !0;
                            s = l.pixelY
                        }
                    else s = Math.abs(l.pixelX) > Math.abs(l.pixelY) ? -l.pixelX * n : -l.pixelY;
                    if (0 === s) return !0;
                    if (a.invert && (s = -s), i.params.freeMode) {
                        var d = i.getTranslate() + s * a.sensitivity,
                            h = i.isBeginning,
                            c = i.isEnd;
                        if (d >= i.minTranslate() && (d = i.minTranslate()), d <= i.maxTranslate() && (d = i.maxTranslate()), i.setTransition(0), i.setTranslate(d), i.updateProgress(), i.updateActiveIndex(), i.updateSlidesClasses(), (!h && i.isBeginning || !c && i.isEnd) && i.updateSlidesClasses(), i.params.freeModeSticky && (clearTimeout(i.mousewheel.timeout), i.mousewheel.timeout = o.nextTick(function () {
                                i.slideReset()
                            }, 300)), i.emit("scroll", t), i.params.autoplay && i.params.autoplayDisableOnInteraction && i.stopAutoplay(), 0 === d || d === i.maxTranslate()) return !0
                    } else {
                        if (o.now() - i.mousewheel.lastScrollTime > 60)
                            if (s < 0)
                                if (i.isEnd && !i.params.loop || i.animating) {
                                    if (a.releaseOnEdges) return !0
                                } else i.slideNext(), i.emit("scroll", t);
                        else if (i.isBeginning && !i.params.loop || i.animating) {
                            if (a.releaseOnEdges) return !0
                        } else i.slidePrev(), i.emit("scroll", t);
                        i.mousewheel.lastScrollTime = (new r.Date).getTime()
                    }
                    return t.preventDefault ? t.preventDefault() : t.returnValue = !1, !1
                },
                enable: function () {
                    var t = this;
                    if (!X.event) return !1;
                    if (t.mousewheel.enabled) return !1;
                    var i = t.$el;
                    return "container" !== t.params.mousewheel.eventsTarged && (i = e(t.params.mousewheel.eventsTarged)), i.on(X.event, t.mousewheel.handle), t.mousewheel.enabled = !0, !0
                },
                disable: function () {
                    var t = this;
                    if (!X.event) return !1;
                    if (!t.mousewheel.enabled) return !1;
                    var i = t.$el;
                    return "container" !== t.params.mousewheel.eventsTarged && (i = e(t.params.mousewheel.eventsTarged)), i.off(X.event, t.mousewheel.handle), t.mousewheel.enabled = !1, !0
                }
            },
            Y = {
                name: "mousewheel",
                params: {
                    mousewheel: {
                        enabled: !1,
                        releaseOnEdges: !1,
                        invert: !1,
                        forceToAxis: !1,
                        sensitivity: 1,
                        eventsTarged: "container"
                    }
                },
                create: function () {
                    var e = this;
                    o.extend(e, {
                        mousewheel: {
                            enabled: !1,
                            enable: X.enable.bind(e),
                            disable: X.disable.bind(e),
                            handle: X.handle.bind(e),
                            lastScrollTime: o.now()
                        }
                    })
                },
                on: {
                    init: function () {
                        var e = this;
                        e.params.mousewheel.enabled && e.mousewheel.enable()
                    },
                    destroy: function () {
                        var e = this;
                        e.mousewheel.enabled && e.mousewheel.disable()
                    }
                }
            },
            B = {
                update: function () {
                    var e = this,
                        t = e.params.navigation;
                    if (!e.params.loop) {
                        var i = e.navigation,
                            r = i.$nextEl,
                            a = i.$prevEl;
                        a && a.length > 0 && (e.isBeginning ? a.addClass(t.disabledClass) : a.removeClass(t.disabledClass)), r && r.length > 0 && (e.isEnd ? r.addClass(t.disabledClass) : r.removeClass(t.disabledClass))
                    }
                },
                init: function () {
                    var t = this,
                        i = t.params.navigation;
                    if (i.nextEl || i.prevEl) {
                        var r, a;
                        i.nextEl && (r = e(i.nextEl), t.params.uniqueNavElements && "string" == typeof i.nextEl && r.length > 1 && 1 === t.$el.find(i.nextEl).length && (r = t.$el.find(i.nextEl))), i.prevEl && (a = e(i.prevEl), t.params.uniqueNavElements && "string" == typeof i.prevEl && a.length > 1 && 1 === t.$el.find(i.prevEl).length && (a = t.$el.find(i.prevEl))), r && r.length > 0 && r.on("click", function (e) {
                            e.preventDefault(), t.isEnd && !t.params.loop || t.slideNext()
                        }), a && a.length > 0 && a.on("click", function (e) {
                            e.preventDefault(), t.isBeginning && !t.params.loop || t.slidePrev()
                        }), o.extend(t.navigation, {
                            $nextEl: r,
                            nextEl: r && r[0],
                            $prevEl: a,
                            prevEl: a && a[0]
                        })
                    }
                },
                destroy: function () {
                    var e = this,
                        t = e.navigation,
                        i = t.$nextEl,
                        r = t.$prevEl;
                    i && i.length && (i.off("click"), i.removeClass(e.params.navigation.disabledClass)), r && r.length && (r.off("click"), r.removeClass(e.params.navigation.disabledClass))
                }
            },
            G = {
                name: "navigation",
                params: {
                    navigation: {
                        nextEl: null,
                        prevEl: null,
                        hideOnClick: !1,
                        disabledClass: "swiper-button-disabled",
                        hiddenClass: "swiper-button-hidden"
                    }
                },
                create: function () {
                    var e = this;
                    o.extend(e, {
                        navigation: {
                            init: B.init.bind(e),
                            update: B.update.bind(e),
                            destroy: B.destroy.bind(e)
                        }
                    })
                },
                on: {
                    init: function () {
                        var e = this;
                        e.navigation.init(), e.navigation.update()
                    },
                    toEdge: function () {
                        this.navigation.update()
                    },
                    fromEdge: function () {
                        this.navigation.update()
                    },
                    destroy: function () {
                        this.navigation.destroy()
                    },
                    click: function (t) {
                        var i = this,
                            r = i.navigation,
                            a = r.$nextEl,
                            s = r.$prevEl;
                        !i.params.navigation.hideOnClick || e(t.target).is(s) || e(t.target).is(a) || (a && a.toggleClass(i.params.navigation.hiddenClass), s && s.toggleClass(i.params.navigation.hiddenClass))
                    }
                }
            },
            H = {
                update: function () {
                    var t = this,
                        i = t.rtl,
                        r = t.params.pagination;
                    if (r.el && t.pagination.el && t.pagination.$el && 0 !== t.pagination.$el.length) {
                        var a, s = t.virtual && t.params.virtual.enabled ? t.virtual.slides.length : t.slides.length,
                            n = t.pagination.$el,
                            o = t.params.loop ? Math.ceil((s - 2 * t.loopedSlides) / t.params.slidesPerGroup) : t.snapGrid.length;
                        if (t.params.loop ? ((a = Math.ceil((t.activeIndex - t.loopedSlides) / t.params.slidesPerGroup)) > s - 1 - 2 * t.loopedSlides && (a -= s - 2 * t.loopedSlides), a > o - 1 && (a -= o), a < 0 && "bullets" !== t.params.paginationType && (a = o + a)) : a = void 0 !== t.snapIndex ? t.snapIndex : t.activeIndex || 0, "bullets" === r.type && t.pagination.bullets && t.pagination.bullets.length > 0) {
                            var l = t.pagination.bullets;
                            if (r.dynamicBullets && (t.pagination.bulletSize = l.eq(0)[t.isHorizontal() ? "outerWidth" : "outerHeight"](!0), n.css(t.isHorizontal() ? "width" : "height", 5 * t.pagination.bulletSize + "px")), l.removeClass(r.bulletActiveClass + " " + r.bulletActiveClass + "-next " + r.bulletActiveClass + "-next-next " + r.bulletActiveClass + "-prev " + r.bulletActiveClass + "-prev-prev"), n.length > 1) l.each(function (t, i) {
                                var s = e(i);
                                s.index() === a && (s.addClass(r.bulletActiveClass), r.dynamicBullets && (s.prev().addClass(r.bulletActiveClass + "-prev").prev().addClass(r.bulletActiveClass + "-prev-prev"), s.next().addClass(r.bulletActiveClass + "-next").next().addClass(r.bulletActiveClass + "-next-next")))
                            });
                            else {
                                var d = l.eq(a);
                                d.addClass(r.bulletActiveClass), r.dynamicBullets && (d.prev().addClass(r.bulletActiveClass + "-prev").prev().addClass(r.bulletActiveClass + "-prev-prev"), d.next().addClass(r.bulletActiveClass + "-next").next().addClass(r.bulletActiveClass + "-next-next"))
                            }
                            if (r.dynamicBullets) {
                                var h = Math.min(l.length, 5),
                                    c = (t.pagination.bulletSize * h - t.pagination.bulletSize) / 2 - a * t.pagination.bulletSize,
                                    u = i ? "right" : "left";
                                l.css(t.isHorizontal() ? u : "top", c + "px")
                            }
                        }
                        if ("fraction" === r.type && (n.find("." + r.currentClass).text(a + 1), n.find("." + r.totalClass).text(o)), "progressbar" === r.type) {
                            var p = (a + 1) / o,
                                f = p,
                                m = 1;
                            t.isHorizontal() || (m = p, f = 1), n.find("." + r.progressbarFillClass).transform("translate3d(0,0,0) scaleX(" + f + ") scaleY(" + m + ")").transition(t.params.speed)
                        }
                        "custom" === r.type && r.renderCustom ? (n.html(r.renderCustom(t, a + 1, o)), t.emit("paginationRender", t, n[0])) : t.emit("paginationUpdate", t, n[0])
                    }
                },
                render: function () {
                    var e = this,
                        t = e.params.pagination;
                    if (t.el && e.pagination.el && e.pagination.$el && 0 !== e.pagination.$el.length) {
                        var i = e.virtual && e.params.virtual.enabled ? e.virtual.slides.length : e.slides.length,
                            r = e.pagination.$el,
                            a = "";
                        if ("bullets" === t.type) {
                            for (var s = e.params.loop ? Math.ceil((i - 2 * e.loopedSlides) / e.params.slidesPerGroup) : e.snapGrid.length, n = 0; n < s; n += 1) t.renderBullet ? a += t.renderBullet.call(e, n, t.bulletClass) : a += "<" + t.bulletElement + ' class="' + t.bulletClass + '"></' + t.bulletElement + ">";
                            r.html(a), e.pagination.bullets = r.find("." + t.bulletClass)
                        }
                        "fraction" === t.type && (a = t.renderFraction ? t.renderFraction.call(e, t.currentClass, t.totalClass) : '<span class="' + t.currentClass + '"></span> / <span class="' + t.totalClass + '"></span>', r.html(a)), "progressbar" === t.type && (a = t.renderProgressbar ? t.renderProgressbar.call(e, t.progressbarFillClass) : '<span class="' + t.progressbarFillClass + '"></span>', r.html(a)), "custom" !== t.type && e.emit("paginationRender", e.pagination.$el[0])
                    }
                },
                init: function () {
                    var t = this,
                        i = t.params.pagination;
                    if (i.el) {
                        var r = e(i.el);
                        0 !== r.length && (t.params.uniqueNavElements && "string" == typeof i.el && r.length > 1 && 1 === t.$el.find(i.el).length && (r = t.$el.find(i.el)), "bullets" === i.type && i.clickable && r.addClass(i.clickableClass), r.addClass(i.modifierClass + i.type), "bullets" === i.type && i.dynamicBullets && r.addClass("" + i.modifierClass + i.type + "-dynamic"), i.clickable && r.on("click", "." + i.bulletClass, function (i) {
                            i.preventDefault();
                            var r = e(this).index() * t.params.slidesPerGroup;
                            t.params.loop && (r += t.loopedSlides), t.slideTo(r)
                        }), o.extend(t.pagination, {
                            $el: r,
                            el: r[0]
                        }))
                    }
                },
                destroy: function () {
                    var e = this,
                        t = e.params.pagination;
                    if (t.el && e.pagination.el && e.pagination.$el && 0 !== e.pagination.$el.length) {
                        var i = e.pagination.$el;
                        i.removeClass(t.hiddenClass), i.removeClass(t.modifierClass + t.type), e.pagination.bullets && e.pagination.bullets.removeClass(t.bulletActiveClass), t.clickable && i.off("click", "." + t.bulletClass)
                    }
                }
            },
            V = {
                name: "pagination",
                params: {
                    pagination: {
                        el: null,
                        bulletElement: "span",
                        clickable: !1,
                        hideOnClick: !1,
                        renderBullet: null,
                        renderProgressbar: null,
                        renderFraction: null,
                        renderCustom: null,
                        type: "bullets",
                        dynamicBullets: !1,
                        bulletClass: "swiper-pagination-bullet",
                        bulletActiveClass: "swiper-pagination-bullet-active",
                        modifierClass: "swiper-pagination-",
                        currentClass: "swiper-pagination-current",
                        totalClass: "swiper-pagination-total",
                        hiddenClass: "swiper-pagination-hidden",
                        progressbarFillClass: "swiper-pagination-progressbar-fill",
                        clickableClass: "swiper-pagination-clickable"
                    }
                },
                create: function () {
                    var e = this;
                    o.extend(e, {
                        pagination: {
                            init: H.init.bind(e),
                            render: H.render.bind(e),
                            update: H.update.bind(e),
                            destroy: H.destroy.bind(e)
                        }
                    })
                },
                on: {
                    init: function () {
                        var e = this;
                        e.pagination.init(), e.pagination.render(), e.pagination.update()
                    },
                    activeIndexChange: function () {
                        var e = this;
                        e.params.loop ? e.pagination.update() : void 0 === e.snapIndex && e.pagination.update()
                    },
                    snapIndexChange: function () {
                        var e = this;
                        e.params.loop || e.pagination.update()
                    },
                    slidesLengthChange: function () {
                        var e = this;
                        e.params.loop && (e.pagination.render(), e.pagination.update())
                    },
                    snapGridLengthChange: function () {
                        var e = this;
                        e.params.loop || (e.pagination.render(), e.pagination.update())
                    },
                    destroy: function () {
                        this.pagination.destroy()
                    },
                    click: function (t) {
                        var i = this;
                        i.params.pagination.el && i.params.pagination.hideOnClick && i.pagination.$el.length > 0 && !e(t.target).hasClass(i.params.pagination.bulletClass) && i.pagination.$el.toggleClass(i.params.pagination.hiddenClass)
                    }
                }
            },
            j = {
                setTranslate: function () {
                    var e = this;
                    if (e.params.scrollbar.el && e.scrollbar.el) {
                        var t = e.scrollbar,
                            i = e.rtl,
                            r = e.progress,
                            a = t.dragSize,
                            s = t.trackSize,
                            n = t.$dragEl,
                            o = t.$el,
                            l = e.params.scrollbar,
                            h = a,
                            c = (s - a) * r;
                        i && e.isHorizontal() ? (c = -c) > 0 ? (h = a - c, c = 0) : -c + a > s && (h = s + c) : c < 0 ? (h = a + c, c = 0) : c + a > s && (h = s - c), e.isHorizontal() ? (d.transforms3d ? n.transform("translate3d(" + c + "px, 0, 0)") : n.transform("translateX(" + c + "px)"), n[0].style.width = h + "px") : (d.transforms3d ? n.transform("translate3d(0px, " + c + "px, 0)") : n.transform("translateY(" + c + "px)"), n[0].style.height = h + "px"), l.hide && (clearTimeout(e.scrollbar.timeout), o[0].style.opacity = 1, e.scrollbar.timeout = setTimeout(function () {
                            o[0].style.opacity = 0, o.transition(400)
                        }, 1e3))
                    }
                },
                setTransition: function (e) {
                    var t = this;
                    t.params.scrollbar.el && t.scrollbar.el && t.scrollbar.$dragEl.transition(e)
                },
                updateSize: function () {
                    var e = this;
                    if (e.params.scrollbar.el && e.scrollbar.el) {
                        var t = e.scrollbar,
                            i = t.$dragEl,
                            r = t.$el;
                        i[0].style.width = "", i[0].style.height = "";
                        var a, s = e.isHorizontal() ? r[0].offsetWidth : r[0].offsetHeight,
                            n = e.size / e.virtualSize,
                            l = n * (s / e.size);
                        a = "auto" === e.params.scrollbar.dragSize ? s * n : parseInt(e.params.scrollbar.dragSize, 10), e.isHorizontal() ? i[0].style.width = a + "px" : i[0].style.height = a + "px", r[0].style.display = n >= 1 ? "none" : "", e.params.scrollbarHide && (r[0].style.opacity = 0), o.extend(t, {
                            trackSize: s,
                            divider: n,
                            moveDivider: l,
                            dragSize: a
                        })
                    }
                },
                setDragPosition: function (e) {
                    var t, i = this,
                        r = i.scrollbar,
                        a = r.$el,
                        s = r.dragSize,
                        n = r.trackSize;
                    t = ((i.isHorizontal() ? "touchstart" === e.type || "touchmove" === e.type ? e.targetTouches[0].pageX : e.pageX || e.clientX : "touchstart" === e.type || "touchmove" === e.type ? e.targetTouches[0].pageY : e.pageY || e.clientY) - a.offset()[i.isHorizontal() ? "left" : "top"] - s / 2) / (n - s), t = Math.max(Math.min(t, 1), 0), i.rtl && (t = 1 - t);
                    var o = i.minTranslate() + (i.maxTranslate() - i.minTranslate()) * t;
                    i.updateProgress(o), i.setTranslate(o), i.updateActiveIndex(), i.updateSlidesClasses()
                },
                onDragStart: function (e) {
                    var t = this,
                        i = t.params.scrollbar,
                        r = t.scrollbar,
                        a = t.$wrapperEl,
                        s = r.$el,
                        n = r.$dragEl;
                    t.scrollbar.isTouched = !0, e.preventDefault(), e.stopPropagation(), a.transition(100), n.transition(100), r.setDragPosition(e), clearTimeout(t.scrollbar.dragTimeout), s.transition(0), i.hide && s.css("opacity", 1), t.emit("scrollbarDragStart", e)
                },
                onDragMove: function (e) {
                    var t = this,
                        i = t.scrollbar,
                        r = t.$wrapperEl,
                        a = i.$el,
                        s = i.$dragEl;
                    t.scrollbar.isTouched && (e.preventDefault ? e.preventDefault() : e.returnValue = !1, i.setDragPosition(e), r.transition(0), a.transition(0), s.transition(0), t.emit("scrollbarDragMove", e))
                },
                onDragEnd: function (e) {
                    var t = this,
                        i = t.params.scrollbar,
                        r = t.scrollbar.$el;
                    t.scrollbar.isTouched && (t.scrollbar.isTouched = !1, i.hide && (clearTimeout(t.scrollbar.dragTimeout), t.scrollbar.dragTimeout = o.nextTick(function () {
                        r.css("opacity", 0), r.transition(400)
                    }, 1e3)), t.emit("scrollbarDragEnd", e), i.snapOnRelease && t.slideReset())
                },
                enableDraggable: function () {
                    var t = this;
                    if (t.params.scrollbar.el) {
                        var i = t.scrollbar.$el,
                            r = d.touch ? i[0] : document;
                        i.on(t.scrollbar.dragEvents.start, t.scrollbar.onDragStart), e(r).on(t.scrollbar.dragEvents.move, t.scrollbar.onDragMove), e(r).on(t.scrollbar.dragEvents.end, t.scrollbar.onDragEnd)
                    }
                },
                disableDraggable: function () {
                    var t = this;
                    if (t.params.scrollbar.el) {
                        var i = t.scrollbar.$el,
                            r = d.touch ? i[0] : document;
                        i.off(t.scrollbar.dragEvents.start), e(r).off(t.scrollbar.dragEvents.move), e(r).off(t.scrollbar.dragEvents.end)
                    }
                },
                init: function () {
                    var t = this;
                    if (t.params.scrollbar.el) {
                        var i = t.scrollbar,
                            r = t.$el,
                            a = t.touchEvents,
                            s = t.params.scrollbar,
                            n = e(s.el);
                        t.params.uniqueNavElements && "string" == typeof s.el && n.length > 1 && 1 === r.find(s.el).length && (n = r.find(s.el));
                        var l = n.find(".swiper-scrollbar-drag");
                        0 === l.length && (l = e('<div class="swiper-scrollbar-drag"></div>'), n.append(l)), t.scrollbar.dragEvents = !1 !== t.params.simulateTouch || d.touch ? a : {
                            start: "mousedown",
                            move: "mousemove",
                            end: "mouseup"
                        }, o.extend(i, {
                            $el: n,
                            el: n[0],
                            $dragEl: l,
                            dragEl: l[0]
                        }), s.draggable && i.enableDraggable()
                    }
                },
                destroy: function () {
                    this.scrollbar.disableDraggable()
                }
            },
            W = {
                name: "scrollbar",
                params: {
                    scrollbar: {
                        el: null,
                        dragSize: "auto",
                        hide: !1,
                        draggable: !1,
                        snapOnRelease: !0
                    }
                },
                create: function () {
                    var e = this;
                    o.extend(e, {
                        scrollbar: {
                            init: j.init.bind(e),
                            destroy: j.destroy.bind(e),
                            updateSize: j.updateSize.bind(e),
                            setTranslate: j.setTranslate.bind(e),
                            setTransition: j.setTransition.bind(e),
                            enableDraggable: j.enableDraggable.bind(e),
                            disableDraggable: j.disableDraggable.bind(e),
                            setDragPosition: j.setDragPosition.bind(e),
                            onDragStart: j.onDragStart.bind(e),
                            onDragMove: j.onDragMove.bind(e),
                            onDragEnd: j.onDragEnd.bind(e),
                            isTouched: !1,
                            timeout: null,
                            dragTimeout: null
                        }
                    })
                },
                on: {
                    init: function () {
                        var e = this;
                        e.scrollbar.init(), e.scrollbar.updateSize(), e.scrollbar.setTranslate()
                    },
                    update: function () {
                        this.scrollbar.updateSize()
                    },
                    resize: function () {
                        this.scrollbar.updateSize()
                    },
                    observerUpdate: function () {
                        this.scrollbar.updateSize()
                    },
                    setTranslate: function () {
                        this.scrollbar.setTranslate()
                    },
                    setTransition: function (e) {
                        this.scrollbar.setTransition(e)
                    },
                    destroy: function () {
                        this.scrollbar.destroy()
                    }
                }
            },
            U = {
                setTransform: function (t, i) {
                    var r = this,
                        a = r.rtl,
                        s = e(t),
                        n = a ? -1 : 1,
                        o = s.attr("data-swiper-parallax") || "0",
                        l = s.attr("data-swiper-parallax-x"),
                        d = s.attr("data-swiper-parallax-y"),
                        h = s.attr("data-swiper-parallax-scale"),
                        c = s.attr("data-swiper-parallax-opacity");
                    if (l || d ? (l = l || "0", d = d || "0") : r.isHorizontal() ? (l = o, d = "0") : (d = o, l = "0"), l = l.indexOf("%") >= 0 ? parseInt(l, 10) * i * n + "%" : l * i * n + "px", d = d.indexOf("%") >= 0 ? parseInt(d, 10) * i + "%" : d * i + "px", void 0 !== c && null !== c) {
                        var u = c - (c - 1) * (1 - Math.abs(i));
                        s[0].style.opacity = u
                    }
                    if (void 0 === h || null === h) s.transform("translate3d(" + l + ", " + d + ", 0px)");
                    else {
                        var p = h - (h - 1) * (1 - Math.abs(i));
                        s.transform("translate3d(" + l + ", " + d + ", 0px) scale(" + p + ")")
                    }
                },
                setTranslate: function () {
                    var t = this,
                        i = t.$el,
                        r = t.slides,
                        a = t.progress,
                        s = t.snapGrid;
                    i.children("[data-swiper-parallax], [data-swiper-parallax-x], [data-swiper-parallax-y]").each(function (e, i) {
                        t.parallax.setTransform(i, a)
                    }), r.each(function (i, r) {
                        var n = r.progress;
                        t.params.slidesPerGroup > 1 && "auto" !== t.params.slidesPerView && (n += Math.ceil(i / 2) - a * (s.length - 1)), n = Math.min(Math.max(n, -1), 1), e(r).find("[data-swiper-parallax], [data-swiper-parallax-x], [data-swiper-parallax-y]").each(function (e, i) {
                            t.parallax.setTransform(i, n)
                        })
                    })
                },
                setTransition: function (t) {
                    void 0 === t && (t = this.params.speed), this.$el.find("[data-swiper-parallax], [data-swiper-parallax-x], [data-swiper-parallax-y]").each(function (i, r) {
                        var a = e(r),
                            s = parseInt(a.attr("data-swiper-parallax-duration"), 10) || t;
                        0 === t && (s = 0), a.transition(s)
                    })
                }
            },
            q = {
                name: "parallax",
                params: {
                    parallax: {
                        enabled: !1
                    }
                },
                create: function () {
                    var e = this;
                    o.extend(e, {
                        parallax: {
                            setTransform: U.setTransform.bind(e),
                            setTranslate: U.setTranslate.bind(e),
                            setTransition: U.setTransition.bind(e)
                        }
                    })
                },
                on: {
                    beforeInit: function () {
                        this.params.watchSlidesProgress = !0
                    },
                    init: function () {
                        var e = this;
                        e.params.parallax && e.parallax.setTranslate()
                    },
                    setTranslate: function () {
                        var e = this;
                        e.params.parallax && e.parallax.setTranslate()
                    },
                    setTransition: function (e) {
                        var t = this;
                        t.params.parallax && t.parallax.setTransition(e)
                    }
                }
            },
            Z = {
                getDistanceBetweenTouches: function (e) {
                    if (e.targetTouches.length < 2) return 1;
                    var t = e.targetTouches[0].pageX,
                        i = e.targetTouches[0].pageY,
                        r = e.targetTouches[1].pageX,
                        a = e.targetTouches[1].pageY;
                    return Math.sqrt(Math.pow(r - t, 2) + Math.pow(a - i, 2))
                },
                onGestureStart: function (t) {
                    var i = this,
                        r = i.params.zoom,
                        a = i.zoom,
                        s = a.gesture;
                    if (a.fakeGestureTouched = !1, a.fakeGestureMoved = !1, !d.gestures) {
                        if ("touchstart" !== t.type || "touchstart" === t.type && t.targetTouches.length < 2) return;
                        a.fakeGestureTouched = !0, s.scaleStart = Z.getDistanceBetweenTouches(t)
                    }
                    s.$slideEl && s.$slideEl.length || (s.$slideEl = e(this), 0 === s.$slideEl.length && (s.$slideEl = i.slides.eq(i.activeIndex)), s.$imageEl = s.$slideEl.find("img, svg, canvas"), s.$imageWrapEl = s.$imageEl.parent("." + r.containerClass), s.maxRatio = s.$imageWrapEl.attr("data-swiper-zoom") || r.maxRatio, 0 !== s.$imageWrapEl.length) ? (s.$imageEl.transition(0), i.zoom.isScaling = !0) : s.$imageEl = void 0
                },
                onGestureChange: function (e) {
                    var t = this,
                        i = t.params.zoom,
                        r = t.zoom,
                        a = r.gesture;
                    if (!d.gestures) {
                        if ("touchmove" !== e.type || "touchmove" === e.type && e.targetTouches.length < 2) return;
                        r.fakeGestureMoved = !0, a.scaleMove = Z.getDistanceBetweenTouches(e)
                    }
                    a.$imageEl && 0 !== a.$imageEl.length && (d.gestures ? t.zoom.scale = e.scale * r.currentScale : r.scale = a.scaleMove / a.scaleStart * r.currentScale, r.scale > a.maxRatio && (r.scale = a.maxRatio - 1 + Math.pow(r.scale - a.maxRatio + 1, .5)), r.scale < i.minRatio && (r.scale = i.minRatio + 1 - Math.pow(i.minRatio - r.scale + 1, .5)), a.$imageEl.transform("translate3d(0,0,0) scale(" + r.scale + ")"))
                },
                onGestureEnd: function (e) {
                    var t = this,
                        i = t.params.zoom,
                        r = t.zoom,
                        a = r.gesture;
                    if (!d.gestures) {
                        if (!r.fakeGestureTouched || !r.fakeGestureMoved) return;
                        if ("touchend" !== e.type || "touchend" === e.type && e.changedTouches.length < 2 && !w.android) return;
                        r.fakeGestureTouched = !1, r.fakeGestureMoved = !1
                    }
                    a.$imageEl && 0 !== a.$imageEl.length && (r.scale = Math.max(Math.min(r.scale, a.maxRatio), i.minRatio), a.$imageEl.transition(t.params.speed).transform("translate3d(0,0,0) scale(" + r.scale + ")"), r.currentScale = r.scale, r.isScaling = !1, 1 === r.scale && (a.$slideEl = void 0))
                },
                onTouchStart: function (e) {
                    var t = this.zoom,
                        i = t.gesture,
                        r = t.image;
                    i.$imageEl && 0 !== i.$imageEl.length && (r.isTouched || (w.android && e.preventDefault(), r.isTouched = !0, r.touchesStart.x = "touchstart" === e.type ? e.targetTouches[0].pageX : e.pageX, r.touchesStart.y = "touchstart" === e.type ? e.targetTouches[0].pageY : e.pageY))
                },
                onTouchMove: function (e) {
                    var t = this,
                        i = t.zoom,
                        r = i.gesture,
                        a = i.image,
                        s = i.velocity;
                    if (r.$imageEl && 0 !== r.$imageEl.length && (t.allowClick = !1, a.isTouched && r.$slideEl)) {
                        a.isMoved || (a.width = r.$imageEl[0].offsetWidth, a.height = r.$imageEl[0].offsetHeight, a.startX = o.getTranslate(r.$imageWrapEl[0], "x") || 0, a.startY = o.getTranslate(r.$imageWrapEl[0], "y") || 0, r.slideWidth = r.$slideEl[0].offsetWidth, r.slideHeight = r.$slideEl[0].offsetHeight, r.$imageWrapEl.transition(0), t.rtl && (a.startX = -a.startX), t.rtl && (a.startY = -a.startY));
                        var n = a.width * i.scale,
                            l = a.height * i.scale;
                        if (!(n < r.slideWidth && l < r.slideHeight)) {
                            if (a.minX = Math.min(r.slideWidth / 2 - n / 2, 0), a.maxX = -a.minX, a.minY = Math.min(r.slideHeight / 2 - l / 2, 0), a.maxY = -a.minY, a.touchesCurrent.x = "touchmove" === e.type ? e.targetTouches[0].pageX : e.pageX, a.touchesCurrent.y = "touchmove" === e.type ? e.targetTouches[0].pageY : e.pageY, !a.isMoved && !i.isScaling) {
                                if (t.isHorizontal() && (Math.floor(a.minX) === Math.floor(a.startX) && a.touchesCurrent.x < a.touchesStart.x || Math.floor(a.maxX) === Math.floor(a.startX) && a.touchesCurrent.x > a.touchesStart.x)) return void(a.isTouched = !1);
                                if (!t.isHorizontal() && (Math.floor(a.minY) === Math.floor(a.startY) && a.touchesCurrent.y < a.touchesStart.y || Math.floor(a.maxY) === Math.floor(a.startY) && a.touchesCurrent.y > a.touchesStart.y)) return void(a.isTouched = !1)
                            }
                            e.preventDefault(), e.stopPropagation(), a.isMoved = !0, a.currentX = a.touchesCurrent.x - a.touchesStart.x + a.startX, a.currentY = a.touchesCurrent.y - a.touchesStart.y + a.startY, a.currentX < a.minX && (a.currentX = a.minX + 1 - Math.pow(a.minX - a.currentX + 1, .8)), a.currentX > a.maxX && (a.currentX = a.maxX - 1 + Math.pow(a.currentX - a.maxX + 1, .8)), a.currentY < a.minY && (a.currentY = a.minY + 1 - Math.pow(a.minY - a.currentY + 1, .8)), a.currentY > a.maxY && (a.currentY = a.maxY - 1 + Math.pow(a.currentY - a.maxY + 1, .8)), s.prevPositionX || (s.prevPositionX = a.touchesCurrent.x), s.prevPositionY || (s.prevPositionY = a.touchesCurrent.y), s.prevTime || (s.prevTime = Date.now()), s.x = (a.touchesCurrent.x - s.prevPositionX) / (Date.now() - s.prevTime) / 2, s.y = (a.touchesCurrent.y - s.prevPositionY) / (Date.now() - s.prevTime) / 2, Math.abs(a.touchesCurrent.x - s.prevPositionX) < 2 && (s.x = 0), Math.abs(a.touchesCurrent.y - s.prevPositionY) < 2 && (s.y = 0), s.prevPositionX = a.touchesCurrent.x, s.prevPositionY = a.touchesCurrent.y, s.prevTime = Date.now(), r.$imageWrapEl.transform("translate3d(" + a.currentX + "px, " + a.currentY + "px,0)")
                        }
                    }
                },
                onTouchEnd: function () {
                    var e = this.zoom,
                        t = e.gesture,
                        i = e.image,
                        r = e.velocity;
                    if (t.$imageEl && 0 !== t.$imageEl.length) {
                        if (!i.isTouched || !i.isMoved) return i.isTouched = !1, void(i.isMoved = !1);
                        i.isTouched = !1, i.isMoved = !1;
                        var a = 300,
                            s = 300,
                            n = r.x * a,
                            o = i.currentX + n,
                            l = r.y * s,
                            d = i.currentY + l;
                        0 !== r.x && (a = Math.abs((o - i.currentX) / r.x)), 0 !== r.y && (s = Math.abs((d - i.currentY) / r.y));
                        var h = Math.max(a, s);
                        i.currentX = o, i.currentY = d;
                        var c = i.width * e.scale,
                            u = i.height * e.scale;
                        i.minX = Math.min(t.slideWidth / 2 - c / 2, 0), i.maxX = -i.minX, i.minY = Math.min(t.slideHeight / 2 - u / 2, 0), i.maxY = -i.minY, i.currentX = Math.max(Math.min(i.currentX, i.maxX), i.minX), i.currentY = Math.max(Math.min(i.currentY, i.maxY), i.minY), t.$imageWrapEl.transition(h).transform("translate3d(" + i.currentX + "px, " + i.currentY + "px,0)")
                    }
                },
                onTransitionEnd: function () {
                    var e = this,
                        t = e.zoom,
                        i = t.gesture;
                    i.$slideEl && e.previousIndex !== e.activeIndex && (i.$imageEl.transform("translate3d(0,0,0) scale(1)"), i.$imageWrapEl.transform("translate3d(0,0,0)"), i.$slideEl = void 0, i.$imageEl = void 0, i.$imageWrapEl = void 0, t.scale = 1, t.currentScale = 1)
                },
                toggle: function (e) {
                    var t = this.zoom;
                    t.scale && 1 !== t.scale ? t.out() : t.in(e)
                },
                in: function (t) {
                    var i = this,
                        r = i.zoom,
                        a = i.params.zoom,
                        s = r.gesture,
                        n = r.image;
                    if (s.$slideEl || (s.$slideEl = i.clickedSlide ? e(i.clickedSlide) : i.slides.eq(i.activeIndex), s.$imageEl = s.$slideEl.find("img, svg, canvas"), s.$imageWrapEl = s.$imageEl.parent("." + a.containerClass)), s.$imageEl && 0 !== s.$imageEl.length) {
                        s.$slideEl.addClass("" + a.zoomedSlideClass);
                        var o, l, d, h, c, u, p, f, m, v, g, _, y, w, b, x;
                        void 0 === n.touchesStart.x && t ? (o = "touchend" === t.type ? t.changedTouches[0].pageX : t.pageX, l = "touchend" === t.type ? t.changedTouches[0].pageY : t.pageY) : (o = n.touchesStart.x, l = n.touchesStart.y), r.scale = s.$imageWrapEl.attr("data-swiper-zoom") || a.maxRatio, r.currentScale = s.$imageWrapEl.attr("data-swiper-zoom") || a.maxRatio, t ? (b = s.$slideEl[0].offsetWidth, x = s.$slideEl[0].offsetHeight, d = s.$slideEl.offset().left + b / 2 - o, h = s.$slideEl.offset().top + x / 2 - l, p = s.$imageEl[0].offsetWidth, f = s.$imageEl[0].offsetHeight, m = p * r.scale, v = f * r.scale, y = -(g = Math.min(b / 2 - m / 2, 0)), w = -(_ = Math.min(x / 2 - v / 2, 0)), c = d * r.scale, u = h * r.scale, c < g && (c = g), c > y && (c = y), u < _ && (u = _), u > w && (u = w)) : (c = 0, u = 0), s.$imageWrapEl.transition(300).transform("translate3d(" + c + "px, " + u + "px,0)"), s.$imageEl.transition(300).transform("translate3d(0,0,0) scale(" + r.scale + ")")
                    }
                },
                out: function () {
                    var t = this,
                        i = t.zoom,
                        r = t.params.zoom,
                        a = i.gesture;
                    a.$slideEl || (a.$slideEl = t.clickedSlide ? e(t.clickedSlide) : t.slides.eq(t.activeIndex), a.$imageEl = a.$slideEl.find("img, svg, canvas"), a.$imageWrapEl = a.$imageEl.parent("." + r.containerClass)), a.$imageEl && 0 !== a.$imageEl.length && (i.scale = 1, i.currentScale = 1, a.$imageWrapEl.transition(300).transform("translate3d(0,0,0)"), a.$imageEl.transition(300).transform("translate3d(0,0,0) scale(1)"), a.$slideEl.removeClass("" + r.zoomedSlideClass), a.$slideEl = void 0)
                },
                enable: function () {
                    var t = this,
                        i = t.zoom;
                    if (!i.enabled) {
                        i.enabled = !0;
                        var r = t.slides,
                            a = !("touchstart" !== t.touchEvents.start || !d.passiveListener || !t.params.passiveListeners) && {
                                passive: !0,
                                capture: !1
                            };
                        d.gestures ? (r.on("gesturestart", i.onGestureStart, a), r.on("gesturechange", i.onGestureChange, a), r.on("gestureend", i.onGestureEnd, a)) : "touchstart" === t.touchEvents.start && (r.on(t.touchEvents.start, i.onGestureStart, a), r.on(t.touchEvents.move, i.onGestureChange, a), r.on(t.touchEvents.end, i.onGestureEnd, a)), t.slides.each(function (r, a) {
                            var s = e(a);
                            s.find("." + t.params.zoom.containerClass).length > 0 && s.on(t.touchEvents.move, i.onTouchMove)
                        })
                    }
                },
                disable: function () {
                    var t = this,
                        i = t.zoom;
                    if (i.enabled) {
                        t.zoom.enabled = !1;
                        var r = t.slides,
                            a = !("touchstart" !== t.touchEvents.start || !d.passiveListener || !t.params.passiveListeners) && {
                                passive: !0,
                                capture: !1
                            };
                        d.gestures ? (r.off("gesturestart", i.onGestureStart, a), r.off("gesturechange", i.onGestureChange, a), r.off("gestureend", i.onGestureEnd, a)) : "touchstart" === t.touchEvents.start && (r.off(t.touchEvents.start, i.onGestureStart, a), r.off(t.touchEvents.move, i.onGestureChange, a), r.off(t.touchEvents.end, i.onGestureEnd, a)), t.slides.each(function (r, a) {
                            var s = e(a);
                            s.find("." + t.params.zoom.containerClass).length > 0 && s.off(t.touchEvents.move, i.onTouchMove)
                        })
                    }
                }
            },
            K = {
                name: "zoom",
                params: {
                    zoom: {
                        enabled: !1,
                        maxRatio: 3,
                        minRatio: 1,
                        toggle: !0,
                        containerClass: "swiper-zoom-container",
                        zoomedSlideClass: "swiper-slide-zoomed"
                    }
                },
                create: function () {
                    var e = this,
                        t = {
                            enabled: !1,
                            scale: 1,
                            currentScale: 1,
                            isScaling: !1,
                            gesture: {
                                $slideEl: void 0,
                                slideWidth: void 0,
                                slideHeight: void 0,
                                $imageEl: void 0,
                                $imageWrapEl: void 0,
                                maxRatio: 3
                            },
                            image: {
                                isTouched: void 0,
                                isMoved: void 0,
                                currentX: void 0,
                                currentY: void 0,
                                minX: void 0,
                                minY: void 0,
                                maxX: void 0,
                                maxY: void 0,
                                width: void 0,
                                height: void 0,
                                startX: void 0,
                                startY: void 0,
                                touchesStart: {},
                                touchesCurrent: {}
                            },
                            velocity: {
                                x: void 0,
                                y: void 0,
                                prevPositionX: void 0,
                                prevPositionY: void 0,
                                prevTime: void 0
                            }
                        };
                    "onGestureStart onGestureChange onGestureEnd onTouchStart onTouchMove onTouchEnd onTransitionEnd toggle enable disable in out".split(" ").forEach(function (i) {
                        t[i] = Z[i].bind(e)
                    }), o.extend(e, {
                        zoom: t
                    })
                },
                on: {
                    init: function () {
                        var e = this;
                        e.params.zoom.enabled && e.zoom.enable()
                    },
                    destroy: function () {
                        this.zoom.disable()
                    },
                    touchStart: function (e) {
                        var t = this;
                        t.zoom.enabled && t.zoom.onTouchStart(e)
                    },
                    touchEnd: function (e) {
                        var t = this;
                        t.zoom.enabled && t.zoom.onTouchEnd(e)
                    },
                    doubleTap: function (e) {
                        var t = this;
                        t.params.zoom.enabled && t.zoom.enabled && t.params.zoom.toggle && t.zoom.toggle(e)
                    },
                    transitionEnd: function () {
                        var e = this;
                        e.zoom.enabled && e.params.zoom.enabled && e.zoom.onTransitionEnd()
                    }
                }
            },
            Q = {
                loadInSlide: function (t, i) {
                    void 0 === i && (i = !0);
                    var r = this,
                        a = r.params.lazy;
                    if (void 0 !== t && 0 !== r.slides.length) {
                        var s = r.virtual && r.params.virtual.enabled ? r.$wrapperEl.children("." + r.params.slideClass + '[data-swiper-slide-index="' + t + '"]') : r.slides.eq(t),
                            n = s.find("." + a.elementClass + ":not(." + a.loadedClass + "):not(." + a.loadingClass + ")");
                        !s.hasClass(a.elementClass) || s.hasClass(a.loadedClass) || s.hasClass(a.loadingClass) || (n = n.add(s[0])), 0 !== n.length && n.each(function (t, n) {
                            var o = e(n);
                            o.addClass(a.loadingClass);
                            var l = o.attr("data-background"),
                                d = o.attr("data-src"),
                                h = o.attr("data-srcset"),
                                c = o.attr("data-sizes");
                            r.loadImage(o[0], d || l, h, c, !1, function () {
                                if (void 0 !== r && null !== r && r && (!r || r.params) && !r.destroyed) {
                                    if (l ? (o.css("background-image", 'url("' + l + '")'), o.removeAttr("data-background")) : (h && (o.attr("srcset", h), o.removeAttr("data-srcset")), c && (o.attr("sizes", c), o.removeAttr("data-sizes")), d && (o.attr("src", d), o.removeAttr("data-src"))), o.addClass(a.loadedClass).removeClass(a.loadingClass), s.find("." + a.preloaderClass).remove(), r.params.loop && i) {
                                        var e = s.attr("data-swiper-slide-index");
                                        if (s.hasClass(r.params.slideDuplicateClass)) {
                                            var t = r.$wrapperEl.children('[data-swiper-slide-index="' + e + '"]:not(.' + r.params.slideDuplicateClass + ")");
                                            r.lazy.loadInSlide(t.index(), !1)
                                        } else {
                                            var n = r.$wrapperEl.children("." + r.params.slideDuplicateClass + '[data-swiper-slide-index="' + e + '"]');
                                            r.lazy.loadInSlide(n.index(), !1)
                                        }
                                    }
                                    r.emit("lazyImageReady", s[0], o[0])
                                }
                            }), r.emit("lazyImageLoad", s[0], o[0])
                        })
                    }
                },
                load: function () {
                    function t(e) {
                        if (l) {
                            if (a.children("." + s.slideClass + '[data-swiper-slide-index="' + e + '"]').length) return !0
                        } else if (n[e]) return !0;
                        return !1
                    }

                    function i(t) {
                        return l ? e(t).attr("data-swiper-slide-index") : e(t).index()
                    }
                    var r = this,
                        a = r.$wrapperEl,
                        s = r.params,
                        n = r.slides,
                        o = r.activeIndex,
                        l = r.virtual && s.virtual.enabled,
                        d = s.lazy,
                        h = s.slidesPerView;
                    if ("auto" === h && (h = 0), r.lazy.initialImageLoaded || (r.lazy.initialImageLoaded = !0), r.params.watchSlidesVisibility) a.children("." + s.slideVisibleClass).each(function (t, i) {
                        var a = l ? e(i).attr("data-swiper-slide-index") : e(i).index();
                        r.lazy.loadInSlide(a)
                    });
                    else if (h > 1)
                        for (var c = o; c < o + h; c += 1) t(c) && r.lazy.loadInSlide(c);
                    else r.lazy.loadInSlide(o);
                    if (d.loadPrevNext)
                        if (h > 1 || d.loadPrevNextAmount && d.loadPrevNextAmount > 1) {
                            for (var u = d.loadPrevNextAmount, p = h, f = Math.min(o + p + Math.max(u, p), n.length), m = Math.max(o - Math.max(p, u), 0), v = o + h; v < f; v += 1) t(v) && r.lazy.loadInSlide(v);
                            for (var g = m; g < o; g += 1) t(g) && r.lazy.loadInSlide(g)
                        } else {
                            var _ = a.children("." + s.slideNextClass);
                            _.length > 0 && r.lazy.loadInSlide(i(_));
                            var y = a.children("." + s.slidePrevClass);
                            y.length > 0 && r.lazy.loadInSlide(i(y))
                        }
                }
            },
            J = {
                name: "lazy",
                params: {
                    lazy: {
                        enabled: !1,
                        loadPrevNext: !1,
                        loadPrevNextAmount: 1,
                        loadOnTransitionStart: !1,
                        elementClass: "swiper-lazy",
                        loadingClass: "swiper-lazy-loading",
                        loadedClass: "swiper-lazy-loaded",
                        preloaderClass: "swiper-lazy-preloader"
                    }
                },
                create: function () {
                    var e = this;
                    o.extend(e, {
                        lazy: {
                            initialImageLoaded: !1,
                            load: Q.load.bind(e),
                            loadInSlide: Q.loadInSlide.bind(e)
                        }
                    })
                },
                on: {
                    beforeInit: function () {
                        var e = this;
                        e.params.lazy.enabled && e.params.preloadImages && (e.params.preloadImages = !1)
                    },
                    init: function () {
                        var e = this;
                        e.params.lazy.enabled && !e.params.loop && 0 === e.params.initialSlide && e.lazy.load()
                    },
                    scroll: function () {
                        var e = this;
                        e.params.freeMode && !e.params.freeModeSticky && e.lazy.load()
                    },
                    resize: function () {
                        var e = this;
                        e.params.lazy.enabled && e.lazy.load()
                    },
                    scrollbarDragMove: function () {
                        var e = this;
                        e.params.lazy.enabled && e.lazy.load()
                    },
                    transitionStart: function () {
                        var e = this;
                        e.params.lazy.enabled && (e.params.lazy.loadOnTransitionStart || !e.params.lazy.loadOnTransitionStart && !e.lazy.initialImageLoaded) && e.lazy.load()
                    },
                    transitionEnd: function () {
                        var e = this;
                        e.params.lazy.enabled && !e.params.lazy.loadOnTransitionStart && e.lazy.load()
                    }
                }
            },
            ee = {
                LinearSpline: function (e, t) {
                    var i = function () {
                        var e, t, i;
                        return function (r, a) {
                            for (t = -1, e = r.length; e - t > 1;) r[i = e + t >> 1] <= a ? t = i : e = i;
                            return e
                        }
                    }();
                    this.x = e, this.y = t, this.lastIndex = e.length - 1;
                    var r, a;
                    return this.interpolate = function (e) {
                        return e ? (a = i(this.x, e), r = a - 1, (e - this.x[r]) * (this.y[a] - this.y[r]) / (this.x[a] - this.x[r]) + this.y[r]) : 0
                    }, this
                },
                getInterpolateFunction: function (e) {
                    var t = this;
                    t.controller.spline || (t.controller.spline = t.params.loop ? new ee.LinearSpline(t.slidesGrid, e.slidesGrid) : new ee.LinearSpline(t.snapGrid, e.snapGrid))
                },
                setTranslate: function (e, t) {
                    function i(e) {
                        var t = e.rtl && "horizontal" === e.params.direction ? -s.translate : s.translate;
                        "slide" === s.params.controller.by && (s.controller.getInterpolateFunction(e), a = -s.controller.spline.interpolate(-t)), a && "container" !== s.params.controller.by || (r = (e.maxTranslate() - e.minTranslate()) / (s.maxTranslate() - s.minTranslate()), a = (t - s.minTranslate()) * r + e.minTranslate()), s.params.controller.inverse && (a = e.maxTranslate() - a), e.updateProgress(a), e.setTranslate(a, s), e.updateActiveIndex(), e.updateSlidesClasses()
                    }
                    var r, a, s = this,
                        n = s.controller.control;
                    if (Array.isArray(n))
                        for (var o = 0; o < n.length; o += 1) n[o] !== t && n[o] instanceof k && i(n[o]);
                    else n instanceof k && t !== n && i(n)
                },
                setTransition: function (e, t) {
                    function i(t) {
                        t.setTransition(e, a), 0 !== e && (t.transitionStart(), t.$wrapperEl.transitionEnd(function () {
                            s && (t.params.loop && "slide" === a.params.controller.by && t.loopFix(), t.transitionEnd())
                        }))
                    }
                    var r, a = this,
                        s = a.controller.control;
                    if (Array.isArray(s))
                        for (r = 0; r < s.length; r += 1) s[r] !== t && s[r] instanceof k && i(s[r]);
                    else s instanceof k && t !== s && i(s)
                }
            },
            te = {
                name: "controller",
                params: {
                    controller: {
                        control: void 0,
                        inverse: !1,
                        by: "slide"
                    }
                },
                create: function () {
                    var e = this;
                    o.extend(e, {
                        controller: {
                            control: e.params.controller.control,
                            getInterpolateFunction: ee.getInterpolateFunction.bind(e),
                            setTranslate: ee.setTranslate.bind(e),
                            setTransition: ee.setTransition.bind(e)
                        }
                    })
                },
                on: {
                    update: function () {
                        var e = this;
                        e.controller.control && e.controller.spline && (e.controller.spline = void 0, delete e.controller.spline)
                    },
                    resize: function () {
                        var e = this;
                        e.controller.control && e.controller.spline && (e.controller.spline = void 0, delete e.controller.spline)
                    },
                    observerUpdate: function () {
                        var e = this;
                        e.controller.control && e.controller.spline && (e.controller.spline = void 0, delete e.controller.spline)
                    },
                    setTranslate: function (e, t) {
                        var i = this;
                        i.controller.control && i.controller.setTranslate(e, t)
                    },
                    setTransition: function (e, t) {
                        var i = this;
                        i.controller.control && i.controller.setTransition(e, t)
                    }
                }
            },
            ie = {
                makeElFocusable: function (e) {
                    return e.attr("tabIndex", "0"), e
                },
                addElRole: function (e, t) {
                    return e.attr("role", t), e
                },
                addElLabel: function (e, t) {
                    return e.attr("aria-label", t), e
                },
                disableEl: function (e) {
                    return e.attr("aria-disabled", !0), e
                },
                enableEl: function (e) {
                    return e.attr("aria-disabled", !1), e
                },
                onEnterKey: function (t) {
                    var i = this,
                        r = i.params.a11y;
                    if (13 === t.keyCode) {
                        var a = e(t.target);
                        i.navigation && i.navigation.$nextEl && a.is(i.navigation.$nextEl) && (i.isEnd && !i.params.loop || i.slideNext(), i.isEnd ? i.a11y.notify(r.lastSlideMessage) : i.a11y.notify(r.nextSlideMessage)), i.navigation && i.navigation.$prevEl && a.is(i.navigation.$prevEl) && (i.isBeginning && !i.params.loop || i.slidePrev(), i.isBeginning ? i.a11y.notify(r.firstSlideMessage) : i.a11y.notify(r.prevSlideMessage)), i.pagination && a.is("." + i.params.pagination.bulletClass) && a[0].click()
                    }
                },
                notify: function (e) {
                    var t = this.a11y.liveRegion;
                    0 !== t.length && (t.html(""), t.html(e))
                },
                updateNavigation: function () {
                    var e = this;
                    if (!e.params.loop) {
                        var t = e.navigation,
                            i = t.$nextEl,
                            r = t.$prevEl;
                        r && r.length > 0 && (e.isBeginning ? e.a11y.disableEl(r) : e.a11y.enableEl(r)), i && i.length > 0 && (e.isEnd ? e.a11y.disableEl(i) : e.a11y.enableEl(i))
                    }
                },
                updatePagination: function () {
                    var t = this,
                        i = t.params.a11y;
                    t.pagination && t.params.pagination.clickable && t.pagination.bullets && t.pagination.bullets.length && t.pagination.bullets.each(function (r, a) {
                        var s = e(a);
                        t.a11y.makeElFocusable(s), t.a11y.addElRole(s, "button"), t.a11y.addElLabel(s, i.paginationBulletMessage.replace(/{{index}}/, s.index() + 1))
                    })
                },
                init: function () {
                    var e = this;
                    e.$el.append(e.a11y.liveRegion);
                    var t, i, r = e.params.a11y;
                    e.navigation && e.navigation.$nextEl && (t = e.navigation.$nextEl), e.navigation && e.navigation.$prevEl && (i = e.navigation.$prevEl), t && (e.a11y.makeElFocusable(t), e.a11y.addElRole(t, "button"), e.a11y.addElLabel(t, r.nextSlideMessage), t.on("keydown", e.a11y.onEnterKey)), i && (e.a11y.makeElFocusable(i), e.a11y.addElRole(i, "button"), e.a11y.addElLabel(i, r.prevSlideMessage), i.on("keydown", e.a11y.onEnterKey)), e.pagination && e.params.pagination.clickable && e.pagination.bullets && e.pagination.bullets.length && e.pagination.$el.on("keydown", "." + e.params.pagination.bulletClass, e.a11y.onEnterKey)
                },
                destroy: function () {
                    var e = this;
                    e.a11y.liveRegion && e.a11y.liveRegion.length > 0 && e.a11y.liveRegion.remove();
                    var t, i;
                    e.navigation && e.navigation.$nextEl && (t = e.navigation.$nextEl), e.navigation && e.navigation.$prevEl && (i = e.navigation.$prevEl), t && t.off("keydown", e.a11y.onEnterKey), i && i.off("keydown", e.a11y.onEnterKey), e.pagination && e.params.pagination.clickable && e.pagination.bullets && e.pagination.bullets.length && e.pagination.$el.off("keydown", "." + e.params.pagination.bulletClass, e.a11y.onEnterKey)
                }
            },
            re = {
                name: "a11y",
                params: {
                    a11y: {
                        enabled: !1,
                        notificationClass: "swiper-notification",
                        prevSlideMessage: "Previous slide",
                        nextSlideMessage: "Next slide",
                        firstSlideMessage: "This is the first slide",
                        lastSlideMessage: "This is the last slide",
                        paginationBulletMessage: "Go to slide {{index}}"
                    }
                },
                create: function () {
                    var t = this;
                    o.extend(t, {
                        a11y: {
                            liveRegion: e('<span class="' + t.params.a11y.notificationClass + '" aria-live="assertive" aria-atomic="true"></span>')
                        }
                    }), Object.keys(ie).forEach(function (e) {
                        t.a11y[e] = ie[e].bind(t)
                    })
                },
                on: {
                    init: function () {
                        var e = this;
                        e.params.a11y.enabled && (e.a11y.init(), e.a11y.updateNavigation())
                    },
                    toEdge: function () {
                        var e = this;
                        e.params.a11y.enabled && e.a11y.updateNavigation()
                    },
                    fromEdge: function () {
                        var e = this;
                        e.params.a11y.enabled && e.a11y.updateNavigation()
                    },
                    paginationUpdate: function () {
                        var e = this;
                        e.params.a11y.enabled && e.a11y.updatePagination()
                    },
                    destroy: function () {
                        var e = this;
                        e.params.a11y.enabled && e.a11y.destroy()
                    }
                }
            },
            ae = {
                init: function () {
                    var e = this;
                    if (e.params.history) {
                        if (!r.history || !r.history.pushState) return e.params.history.enabled = !1, void(e.params.hashNavigation.enabled = !0);
                        var t = e.history;
                        t.initialized = !0, t.paths = ae.getPathValues(), (t.paths.key || t.paths.value) && (t.scrollToSlide(0, t.paths.value, e.params.runCallbacksOnInit), e.params.history.replaceState || r.addEventListener("popstate", e.history.setHistoryPopState))
                    }
                },
                destroy: function () {
                    var e = this;
                    e.params.history.replaceState || r.removeEventListener("popstate", e.history.setHistoryPopState)
                },
                setHistoryPopState: function () {
                    var e = this;
                    e.history.paths = ae.getPathValues(), e.history.scrollToSlide(e.params.speed, e.history.paths.value, !1)
                },
                getPathValues: function () {
                    var e = r.location.pathname.slice(1).split("/").filter(function (e) {
                            return "" !== e
                        }),
                        t = e.length;
                    return {
                        key: e[t - 2],
                        value: e[t - 1]
                    }
                },
                setHistory: function (e, t) {
                    var i = this;
                    if (i.history.initialized && i.params.history.enabled) {
                        var a = i.slides.eq(t),
                            s = ae.slugify(a.attr("data-history"));
                        r.location.pathname.includes(e) || (s = e + "/" + s);
                        var n = r.history.state;
                        n && n.value === s || (i.params.history.replaceState ? r.history.replaceState({
                            value: s
                        }, null, s) : r.history.pushState({
                            value: s
                        }, null, s))
                    }
                },
                slugify: function (e) {
                    return e.toString().toLowerCase().replace(/\s+/g, "-").replace(/[^\w-]+/g, "").replace(/--+/g, "-").replace(/^-+/, "").replace(/-+$/, "")
                },
                scrollToSlide: function (e, t, i) {
                    var r = this;
                    if (t)
                        for (var a = 0, s = r.slides.length; a < s; a += 1) {
                            var n = r.slides.eq(a);
                            if (ae.slugify(n.attr("data-history")) === t && !n.hasClass(r.params.slideDuplicateClass)) {
                                var o = n.index();
                                r.slideTo(o, e, i)
                            }
                        } else r.slideTo(0, e, i)
                }
            },
            se = {
                name: "history",
                params: {
                    history: {
                        enabled: !1,
                        replaceState: !1,
                        key: "slides"
                    }
                },
                create: function () {
                    var e = this;
                    o.extend(e, {
                        history: {
                            init: ae.init.bind(e),
                            setHistory: ae.setHistory.bind(e),
                            setHistoryPopState: ae.setHistoryPopState.bind(e),
                            scrollToSlide: ae.scrollToSlide.bind(e),
                            destroy: ae.destroy.bind(e)
                        }
                    })
                },
                on: {
                    init: function () {
                        var e = this;
                        e.params.history.enabled && e.history.init()
                    },
                    destroy: function () {
                        var e = this;
                        e.params.history.enabled && e.history.destroy()
                    },
                    transitionEnd: function () {
                        var e = this;
                        e.history.initialized && e.history.setHistory(e.params.history.key, e.activeIndex)
                    }
                }
            },
            ne = {
                onHashCange: function () {
                    var e = this,
                        t = l.location.hash.replace("#", "");
                    t !== e.slides.eq(e.activeIndex).attr("data-hash") && e.slideTo(e.$wrapperEl.children("." + e.params.slideClass + '[data-hash="' + t + '"]').index())
                },
                setHash: function () {
                    var e = this;
                    if (e.hashNavigation.initialized && e.params.hashNavigation.enabled)
                        if (e.params.hashNavigation.replaceState && r.history && r.history.replaceState) r.history.replaceState(null, null, "#" + e.slides.eq(e.activeIndex).attr("data-hash") || "");
                        else {
                            var t = e.slides.eq(e.activeIndex),
                                i = t.attr("data-hash") || t.attr("data-history");
                            l.location.hash = i || ""
                        }
                },
                init: function () {
                    var t = this;
                    if (!(!t.params.hashNavigation.enabled || t.params.history && t.params.history.enabled)) {
                        t.hashNavigation.initialized = !0;
                        var i = l.location.hash.replace("#", "");
                        if (i)
                            for (var a = 0, s = t.slides.length; a < s; a += 1) {
                                var n = t.slides.eq(a);
                                if ((n.attr("data-hash") || n.attr("data-history")) === i && !n.hasClass(t.params.slideDuplicateClass)) {
                                    var o = n.index();
                                    t.slideTo(o, 0, t.params.runCallbacksOnInit, !0)
                                }
                            }
                        t.params.hashNavigation.watchState && e(r).on("hashchange", t.hashNavigation.onHashCange)
                    }
                },
                destroy: function () {
                    var t = this;
                    t.params.hashNavigation.watchState && e(r).off("hashchange", t.hashNavigation.onHashCange)
                }
            },
            oe = {
                name: "hash-navigation",
                params: {
                    hashNavigation: {
                        enabled: !1,
                        replaceState: !1,
                        watchState: !1
                    }
                },
                create: function () {
                    var e = this;
                    o.extend(e, {
                        hashNavigation: {
                            initialized: !1,
                            init: ne.init.bind(e),
                            destroy: ne.destroy.bind(e),
                            setHash: ne.setHash.bind(e),
                            onHashCange: ne.onHashCange.bind(e)
                        }
                    })
                },
                on: {
                    init: function () {
                        var e = this;
                        e.params.hashNavigation.enabled && e.hashNavigation.init()
                    },
                    destroy: function () {
                        var e = this;
                        e.params.hashNavigation.enabled && e.hashNavigation.destroy()
                    },
                    transitionEnd: function () {
                        var e = this;
                        e.hashNavigation.initialized && e.hashNavigation.setHash()
                    }
                }
            },
            le = {
                run: function () {
                    var e = this,
                        t = e.slides.eq(e.activeIndex),
                        i = e.params.autoplay.delay;
                    t.attr("data-swiper-autoplay") && (i = t.attr("data-swiper-autoplay") || e.params.autoplay.delay), e.autoplay.timeout = o.nextTick(function () {
                        e.params.loop ? (e.loopFix(), e.slideNext(e.params.speed, !0, !0), e.emit("autoplay")) : e.isEnd ? e.params.autoplay.stopOnLastSlide ? e.autoplay.stop() : (e.slideTo(0, e.params.speed, !0, !0), e.emit("autoplay")) : (e.slideNext(e.params.speed, !0, !0), e.emit("autoplay"))
                    }, i)
                },
                start: function () {
                    var e = this;
                    return void 0 === e.autoplay.timeout && !e.autoplay.running && (e.autoplay.running = !0, e.emit("autoplayStart"), e.autoplay.run(), !0)
                },
                stop: function () {
                    var e = this;
                    return !!e.autoplay.running && void 0 !== e.autoplay.timeout && (e.autoplay.timeout && (clearTimeout(e.autoplay.timeout), e.autoplay.timeout = void 0), e.autoplay.running = !1, e.emit("autoplayStop"), !0)
                },
                pause: function (e) {
                    var t = this;
                    t.autoplay.running && (t.autoplay.paused || (t.autoplay.timeout && clearTimeout(t.autoplay.timeout), t.autoplay.paused = !0, 0 === e ? (t.autoplay.paused = !1, t.autoplay.run()) : t.$wrapperEl.transitionEnd(function () {
                        t && !t.destroyed && (t.autoplay.paused = !1, t.autoplay.running ? t.autoplay.run() : t.autoplay.stop())
                    })))
                }
            },
            de = {
                name: "autoplay",
                params: {
                    autoplay: {
                        enabled: !1,
                        delay: 3e3,
                        disableOnInteraction: !0,
                        stopOnLastSlide: !1
                    }
                },
                create: function () {
                    var e = this;
                    o.extend(e, {
                        autoplay: {
                            running: !1,
                            paused: !1,
                            run: le.run.bind(e),
                            start: le.start.bind(e),
                            stop: le.stop.bind(e),
                            pause: le.pause.bind(e)
                        }
                    })
                },
                on: {
                    init: function () {
                        var e = this;
                        e.params.autoplay.enabled && e.autoplay.start()
                    },
                    beforeTransitionStart: function (e, t) {
                        var i = this;
                        i.autoplay.running && (t || !i.params.autoplay.disableOnInteraction ? i.autoplay.pause(e) : i.autoplay.stop())
                    },
                    sliderFirstMove: function () {
                        var e = this;
                        e.autoplay.running && (e.params.autoplay.disableOnInteraction ? e.autoplay.stop() : e.autoplay.pause())
                    },
                    destroy: function () {
                        var e = this;
                        e.autoplay.running && e.autoplay.stop()
                    }
                }
            },
            he = {
                setTranslate: function () {
                    for (var e = this, t = e.slides, i = 0; i < t.length; i += 1) {
                        var r = e.slides.eq(i),
                            a = -r[0].swiperSlideOffset;
                        e.params.virtualTranslate || (a -= e.translate);
                        var s = 0;
                        e.isHorizontal() || (s = a, a = 0);
                        var n = e.params.fadeEffect.crossFade ? Math.max(1 - Math.abs(r[0].progress), 0) : 1 + Math.min(Math.max(r[0].progress, -1), 0);
                        r.css({
                            opacity: n
                        }).transform("translate3d(" + a + "px, " + s + "px, 0px)")
                    }
                },
                setTransition: function (e) {
                    var t = this,
                        i = t.slides,
                        r = t.$wrapperEl;
                    if (i.transition(e), t.params.virtualTranslate && 0 !== e) {
                        var a = !1;
                        i.transitionEnd(function () {
                            if (!a && t && !t.destroyed) {
                                a = !0, t.animating = !1;
                                for (var e = ["webkitTransitionEnd", "transitionend"], i = 0; i < e.length; i += 1) r.trigger(e[i])
                            }
                        })
                    }
                }
            },
            ce = {
                name: "effect-fade",
                params: {
                    fadeEffect: {
                        crossFade: !1
                    }
                },
                create: function () {
                    var e = this;
                    o.extend(e, {
                        fadeEffect: {
                            setTranslate: he.setTranslate.bind(e),
                            setTransition: he.setTransition.bind(e)
                        }
                    })
                },
                on: {
                    beforeInit: function () {
                        var e = this;
                        if ("fade" === e.params.effect) {
                            e.classNames.push(e.params.containerModifierClass + "fade");
                            var t = {
                                slidesPerView: 1,
                                slidesPerColumn: 1,
                                slidesPerGroup: 1,
                                watchSlidesProgress: !0,
                                spaceBetween: 0,
                                virtualTranslate: !0
                            };
                            o.extend(e.params, t), o.extend(e.originalParams, t)
                        }
                    },
                    setTranslate: function () {
                        var e = this;
                        "fade" === e.params.effect && e.fadeEffect.setTranslate()
                    },
                    setTransition: function (e) {
                        var t = this;
                        "fade" === t.params.effect && t.fadeEffect.setTransition(e)
                    }
                }
            },
            ue = {
                setTranslate: function () {
                    var t, i = this,
                        r = i.$el,
                        a = i.$wrapperEl,
                        s = i.slides,
                        n = i.width,
                        o = i.height,
                        l = i.rtl,
                        d = i.size,
                        h = i.params.cubeEffect,
                        c = i.isHorizontal(),
                        u = i.virtual && i.params.virtual.enabled,
                        p = 0;
                    h.shadow && (c ? (0 === (t = a.find(".swiper-cube-shadow")).length && (t = e('<div class="swiper-cube-shadow"></div>'), a.append(t)), t.css({
                        height: n + "px"
                    })) : 0 === (t = r.find(".swiper-cube-shadow")).length && (t = e('<div class="swiper-cube-shadow"></div>'), r.append(t)));
                    for (var f = 0; f < s.length; f += 1) {
                        var v = s.eq(f),
                            g = f;
                        u && (g = parseInt(v.attr("data-swiper-slide-index"), 10));
                        var _ = 90 * g,
                            y = Math.floor(_ / 360);
                        l && (_ = -_, y = Math.floor(-_ / 360));
                        var w = Math.max(Math.min(v[0].progress, 1), -1),
                            b = 0,
                            x = 0,
                            T = 0;
                        g % 4 == 0 ? (b = 4 * -y * d, T = 0) : (g - 1) % 4 == 0 ? (b = 0, T = 4 * -y * d) : (g - 2) % 4 == 0 ? (b = d + 4 * y * d, T = d) : (g - 3) % 4 == 0 && (b = -d, T = 3 * d + 4 * d * y), l && (b = -b), c || (x = b, b = 0);
                        var S = "rotateX(" + (c ? 0 : -_) + "deg) rotateY(" + (c ? _ : 0) + "deg) translate3d(" + b + "px, " + x + "px, " + T + "px)";
                        if (w <= 1 && w > -1 && (p = 90 * g + 90 * w, l && (p = 90 * -g - 90 * w)), v.transform(S), h.slideShadows) {
                            var E = c ? v.find(".swiper-slide-shadow-left") : v.find(".swiper-slide-shadow-top"),
                                C = c ? v.find(".swiper-slide-shadow-right") : v.find(".swiper-slide-shadow-bottom");
                            0 === E.length && (E = e('<div class="swiper-slide-shadow-' + (c ? "left" : "top") + '"></div>'), v.append(E)), 0 === C.length && (C = e('<div class="swiper-slide-shadow-' + (c ? "right" : "bottom") + '"></div>'), v.append(C)), E.length && (E[0].style.opacity = Math.max(-w, 0)), C.length && (C[0].style.opacity = Math.max(w, 0))
                        }
                    }
                    if (a.css({
                            "-webkit-transform-origin": "50% 50% -" + d / 2 + "px",
                            "-moz-transform-origin": "50% 50% -" + d / 2 + "px",
                            "-ms-transform-origin": "50% 50% -" + d / 2 + "px",
                            "transform-origin": "50% 50% -" + d / 2 + "px"
                        }), h.shadow)
                        if (c) t.transform("translate3d(0px, " + (n / 2 + h.shadowOffset) + "px, " + -n / 2 + "px) rotateX(90deg) rotateZ(0deg) scale(" + h.shadowScale + ")");
                        else {
                            var P = Math.abs(p) - 90 * Math.floor(Math.abs(p) / 90),
                                M = 1.5 - (Math.sin(2 * P * Math.PI / 360) / 2 + Math.cos(2 * P * Math.PI / 360) / 2),
                                k = h.shadowScale,
                                z = h.shadowScale / M,
                                R = h.shadowOffset;
                            t.transform("scale3d(" + k + ", 1, " + z + ") translate3d(0px, " + (o / 2 + R) + "px, " + -o / 2 / z + "px) rotateX(-90deg)")
                        } var O = m.isSafari || m.isUiWebView ? -d / 2 : 0;
                    a.transform("translate3d(0px,0," + O + "px) rotateX(" + (i.isHorizontal() ? 0 : p) + "deg) rotateY(" + (i.isHorizontal() ? -p : 0) + "deg)")
                },
                setTransition: function (e) {
                    var t = this,
                        i = t.$el;
                    t.slides.transition(e).find(".swiper-slide-shadow-top, .swiper-slide-shadow-right, .swiper-slide-shadow-bottom, .swiper-slide-shadow-left").transition(e), t.params.cubeEffect.shadow && !t.isHorizontal() && i.find(".swiper-cube-shadow").transition(e)
                }
            },
            pe = {
                name: "effect-cube",
                params: {
                    cubeEffect: {
                        slideShadows: !0,
                        shadow: !0,
                        shadowOffset: 20,
                        shadowScale: .94
                    }
                },
                create: function () {
                    var e = this;
                    o.extend(e, {
                        cubeEffect: {
                            setTranslate: ue.setTranslate.bind(e),
                            setTransition: ue.setTransition.bind(e)
                        }
                    })
                },
                on: {
                    beforeInit: function () {
                        var e = this;
                        if ("cube" === e.params.effect) {
                            e.classNames.push(e.params.containerModifierClass + "cube"), e.classNames.push(e.params.containerModifierClass + "3d");
                            var t = {
                                slidesPerView: 1,
                                slidesPerColumn: 1,
                                slidesPerGroup: 1,
                                watchSlidesProgress: !0,
                                resistanceRatio: 0,
                                spaceBetween: 0,
                                centeredSlides: !1,
                                virtualTranslate: !0
                            };
                            o.extend(e.params, t), o.extend(e.originalParams, t)
                        }
                    },
                    setTranslate: function () {
                        var e = this;
                        "cube" === e.params.effect && e.cubeEffect.setTranslate()
                    },
                    setTransition: function (e) {
                        var t = this;
                        "cube" === t.params.effect && t.cubeEffect.setTransition(e)
                    }
                }
            },
            fe = {
                setTranslate: function () {
                    for (var t = this, i = t.slides, r = 0; r < i.length; r += 1) {
                        var a = i.eq(r),
                            s = a[0].progress;
                        t.params.flipEffect.limitRotation && (s = Math.max(Math.min(a[0].progress, 1), -1));
                        var n = -180 * s,
                            o = 0,
                            l = -a[0].swiperSlideOffset,
                            d = 0;
                        if (t.isHorizontal() ? t.rtl && (n = -n) : (d = l, l = 0, o = -n, n = 0), a[0].style.zIndex = -Math.abs(Math.round(s)) + i.length, t.params.flipEffect.slideShadows) {
                            var h = t.isHorizontal() ? a.find(".swiper-slide-shadow-left") : a.find(".swiper-slide-shadow-top"),
                                c = t.isHorizontal() ? a.find(".swiper-slide-shadow-right") : a.find(".swiper-slide-shadow-bottom");
                            0 === h.length && (h = e('<div class="swiper-slide-shadow-' + (t.isHorizontal() ? "left" : "top") + '"></div>'), a.append(h)), 0 === c.length && (c = e('<div class="swiper-slide-shadow-' + (t.isHorizontal() ? "right" : "bottom") + '"></div>'), a.append(c)), h.length && (h[0].style.opacity = Math.max(-s, 0)), c.length && (c[0].style.opacity = Math.max(s, 0))
                        }
                        a.transform("translate3d(" + l + "px, " + d + "px, 0px) rotateX(" + o + "deg) rotateY(" + n + "deg)")
                    }
                },
                setTransition: function (e) {
                    var t = this,
                        i = t.slides,
                        r = t.activeIndex,
                        a = t.$wrapperEl;
                    if (i.transition(e).find(".swiper-slide-shadow-top, .swiper-slide-shadow-right, .swiper-slide-shadow-bottom, .swiper-slide-shadow-left").transition(e), t.params.virtualTranslate && 0 !== e) {
                        var s = !1;
                        i.eq(r).transitionEnd(function () {
                            if (!s && t && !t.destroyed) {
                                s = !0, t.animating = !1;
                                for (var e = ["webkitTransitionEnd", "transitionend"], i = 0; i < e.length; i += 1) a.trigger(e[i])
                            }
                        })
                    }
                }
            },
            me = {
                name: "effect-flip",
                params: {
                    flipEffect: {
                        slideShadows: !0,
                        limitRotation: !0
                    }
                },
                create: function () {
                    var e = this;
                    o.extend(e, {
                        flipEffect: {
                            setTranslate: fe.setTranslate.bind(e),
                            setTransition: fe.setTransition.bind(e)
                        }
                    })
                },
                on: {
                    beforeInit: function () {
                        var e = this;
                        if ("flip" === e.params.effect) {
                            e.classNames.push(e.params.containerModifierClass + "flip"), e.classNames.push(e.params.containerModifierClass + "3d");
                            var t = {
                                slidesPerView: 1,
                                slidesPerColumn: 1,
                                slidesPerGroup: 1,
                                watchSlidesProgress: !0,
                                spaceBetween: 0,
                                virtualTranslate: !0
                            };
                            o.extend(e.params, t), o.extend(e.originalParams, t)
                        }
                    },
                    setTranslate: function () {
                        var e = this;
                        "flip" === e.params.effect && e.flipEffect.setTranslate()
                    },
                    setTransition: function (e) {
                        var t = this;
                        "flip" === t.params.effect && t.flipEffect.setTransition(e)
                    }
                }
            },
            ve = {
                setTranslate: function () {
                    for (var t = this, i = t.width, r = t.height, a = t.slides, s = t.$wrapperEl, n = t.slidesSizesGrid, o = t.params.coverflowEffect, l = t.isHorizontal(), d = t.translate, h = l ? i / 2 - d : r / 2 - d, c = l ? o.rotate : -o.rotate, u = o.depth, p = 0, f = a.length; p < f; p += 1) {
                        var v = a.eq(p),
                            g = n[p],
                            _ = (h - v[0].swiperSlideOffset - g / 2) / g * o.modifier,
                            y = l ? c * _ : 0,
                            w = l ? 0 : c * _,
                            b = -u * Math.abs(_),
                            x = l ? 0 : o.stretch * _,
                            T = l ? o.stretch * _ : 0;
                        Math.abs(T) < .001 && (T = 0), Math.abs(x) < .001 && (x = 0), Math.abs(b) < .001 && (b = 0), Math.abs(y) < .001 && (y = 0), Math.abs(w) < .001 && (w = 0);
                        var S = "translate3d(" + T + "px," + x + "px," + b + "px)  rotateX(" + w + "deg) rotateY(" + y + "deg)";
                        if (v.transform(S), v[0].style.zIndex = 1 - Math.abs(Math.round(_)), o.slideShadows) {
                            var E = l ? v.find(".swiper-slide-shadow-left") : v.find(".swiper-slide-shadow-top"),
                                C = l ? v.find(".swiper-slide-shadow-right") : v.find(".swiper-slide-shadow-bottom");
                            0 === E.length && (E = e('<div class="swiper-slide-shadow-' + (l ? "left" : "top") + '"></div>'), v.append(E)), 0 === C.length && (C = e('<div class="swiper-slide-shadow-' + (l ? "right" : "bottom") + '"></div>'), v.append(C)), E.length && (E[0].style.opacity = _ > 0 ? _ : 0), C.length && (C[0].style.opacity = -_ > 0 ? -_ : 0)
                        }
                    }
                    m.ie && (s[0].style.perspectiveOrigin = h + "px 50%")
                },
                setTransition: function (e) {
                    this.slides.transition(e).find(".swiper-slide-shadow-top, .swiper-slide-shadow-right, .swiper-slide-shadow-bottom, .swiper-slide-shadow-left").transition(e)
                }
            },
            ge = {
                name: "effect-coverflow",
                params: {
                    coverflowEffect: {
                        rotate: 50,
                        stretch: 0,
                        depth: 100,
                        modifier: 1,
                        slideShadows: !0
                    }
                },
                create: function () {
                    var e = this;
                    o.extend(e, {
                        coverflowEffect: {
                            setTranslate: ve.setTranslate.bind(e),
                            setTransition: ve.setTransition.bind(e)
                        }
                    })
                },
                on: {
                    beforeInit: function () {
                        var e = this;
                        "coverflow" === e.params.effect && (e.classNames.push(e.params.containerModifierClass + "coverflow"), e.classNames.push(e.params.containerModifierClass + "3d"), e.params.watchSlidesProgress = !0, e.originalParams.watchSlidesProgress = !0)
                    },
                    setTranslate: function () {
                        var e = this;
                        "coverflow" === e.params.effect && e.coverflowEffect.setTranslate()
                    },
                    setTransition: function (e) {
                        var t = this;
                        "coverflow" === t.params.effect && t.coverflowEffect.setTransition(e)
                    }
                }
            };
        return k.use([z, R, O, A, I, N, F, Y, G, V, W, q, K, J, te, re, se, oe, de, ce, pe, me, ge]), k
    });
