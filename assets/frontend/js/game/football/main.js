function CGfxButton(a, e, b) {
    var c, f, g, h = [],
        d;
    this._init = function(b, a, e) {
        c = 1;
        f = [];
        g = [];
        d = createBitmap(e);
        d.x = b;
        d.y = a;
        d.regX = e.width / 2;
        d.regY = e.height / 2;
        s_oStage.addChild(d);
        this._initListener()
    };
    this.unload = function() {
        d.off("mousedown", this.buttonDown);
        d.off("pressup", this.buttonRelease);
        s_oStage.removeChild(d)
    };
    this.setVisible = function(b) {
        d.visible = b
    };
    this._initListener = function() {
        d.on("mousedown", this.buttonDown);
        d.on("pressup", this.buttonRelease)
    };
    this.addEventListener = function(b, a, c) {
        f[b] = a;
        g[b] =
            c
    };
    this.addEventListenerWithParams = function(b, a, c, d) {
        f[b] = a;
        g[b] = c;
        h = d
    };
    this.buttonRelease = function() {
        d.scaleX = c;
        d.scaleY = c;
        f[ON_MOUSE_UP] && f[ON_MOUSE_UP].call(g[ON_MOUSE_UP], h)
    };
    this.buttonDown = function() {
        d.scaleX = .9 * c;
        d.scaleY = .9 * c;
        f[ON_MOUSE_DOWN] && f[ON_MOUSE_DOWN].call(g[ON_MOUSE_DOWN], h)
    };
    this.setScale = function(b) {
        c = b;
        d.scaleX = b;
        d.scaleY = b
    };
    this.setPosition = function(b, a) {
        d.x = b;
        d.y = a
    };
    this.setX = function(b) {
        d.x = b
    };
    this.setY = function(b) {
        d.y = b
    };
    this.getButtonImage = function() {
        return d
    };
    this.getX =
        function() {
            return d.x
        };
    this.getY = function() {
        return d.y
    };
    this._init(a, e, b);
    return this
}

function CGame(a, e) {
    var b = 0,
        c, f = 0,
        g = 0,
        h = 0,
        d = 0,
        k = -1,
        l = -1,
        m = 0,
        q = ROUND,
        r = FIRST_TIME,
        t, n, u = !1,
        v = !1,
        z = !1,
        p = !1,
        G = !1,
        A, x, L = null,
        M, C, D, N, I, R = GOALKEEPER_X_POSITION,
        P = GOALKEEPER_Y_POSITION,
        O, H, w, E = !1,
        J, y, F, S, U, V, W, Q = !1,
        K = [],
        B, T;
    this._init = function() {
        0 !== r || !1 !== DISABLE_SOUND_MOBILE && !1 !== s_bMobile || (s_oSoundtrack.volume = 0, s_oCrowd = createjs.Sound.play("crowd", {
            loop: -1
        }));
        c = 1E3;
        l = k = -1;
        Q = p = z = v = !1;
        var b = createBitmap(s_oSpriteLibrary.getSprite("bg_game"));
        s_oStage.addChild(b);
        W = new CCrowd;
        0 === q ? this._initLevel() :
            (x = new CInterface(m), this.createViewThings());
        this._initKickPoints()
    };
    this._initLevel = function() {
        d = h = g = 0;
        l = k = -1;
        z = v = u = !1;
        J = new createjs.Container;
        s_oStage.addChild(J);
        t = new CLevel(m, f, J);
        0 === m && this.setLevelInfo()
    };
    this.setLevelInfo = function() {
        $(s_oMain).trigger("start_level", m);
        n = t.getLevelInfo(m);
        f = 0;
        g = n.goalToScore;
        h = n.kickLeft;
        x = new CInterface(m);
        this.createViewThings()
    };
    this.createViewThings = function() {
        F = t.getBallPosition(m, q);
        D = t.getPlayerPosition(m, q);
        B = t.getWallPosition(m, q);
        M = new createjs.Container;
        s_oStage.addChild(M);
        new CGoal(CANVAS_WIDTH / 2, CANVAS_HEIGHT / 2 + 20, M);
        O = new createjs.Container;
        s_oStage.addChild(O);
        I = new CGoalKeeper(O);
        I.showIdle(R, P);
        T = new createjs.Container;
        s_oStage.addChild(T);
        if (0 < B.num)
            for (var a = 0; a < B.num; a++) K[a] = new CWall(B.x, B.y, T, a), K[a].showIdle(a);
        S = new createjs.Container;
        s_oStage.addChild(S);
        y = new CBall(F.x, F.y, S);
        N = new createjs.Container;
        s_oStage.addChild(N);
        C = new CPlayer(N);
        C.showIdle(D.x, D.y, e);
        1 === t.getPlayerPosIndex(m, q) && C.changeAlpha();
        x.viewScore(b);
        x.viewGoalScored(f,
            g);
        x.viewKickLeft(h);
        x.viewScoreBonus(c, 1);
        x.refreshButtonPos(s_iOffsetX, s_iOffsetY);
        0 === r ? (x.help(), r = 1) : u = !0
    };
    this.animatePlayer = function(b, a) {
        U = A[b][a].x;
        V = A[b][a].y;
        v = !0;
        switch (b) {
            case 0:
            case 1:
            case 7:
            case 8:
                l = OUT;
                break;
            case 2:
                k = LOW_PERCENT;
                0 === a ? l = OUT : 1 === a ? l = HIGH_LEFT : 2 === a ? l = MED_LEFT : 3 === a && (l = DOWN_LEFT);
                break;
            case 3:
                k = MED_PERCENT;
                0 === a ? l = OUT : 1 === a ? l = HIGH_LEFT : 2 === a ? l = MED_LEFT : 3 === a && (l = DOWN_LEFT);
                break;
            case 4:
                k = HIGH_PERCENT;
                0 === a ? l = OUT : 1 === a || 2 === a ? l = CENTER_HIGH : 3 === a && (l = CENTER);
                break;
            case 5:
                k =
                    MED_PERCENT;
                0 === a ? l = OUT : 1 === a ? l = HIGH_RIGHT : 2 === a ? l = MED_RIGHT : 3 === a && (l = DOWN_RIGHT);
                break;
            case 6:
                k = LOW_PERCENT, 0 === a ? l = OUT : 1 === a ? l = HIGH_RIGHT : 2 === a ? l = MED_RIGHT : 3 === a && (l = DOWN_RIGHT)
        }
        C.showShot(D.x, D.y, e)
    };
    this.kickBall = function() {
        !1 !== DISABLE_SOUND_MOBILE && !1 !== s_bMobile || createjs.Sound.play("kick");
        y.ballKicked(U, V)
    };
    this.showMessage = function(a) {
        v = !1;
        C.showIdle(D.x, D.y, e);
        var d = this;
        !0 === a ? (y.fadeOut(), a = createBitmap(s_oSpriteLibrary.getSprite("missed_text")), a.scaleX = 0, a.scaleY = 0, a.alpha = 0, a.x = CANVAS_WIDTH /
            2, a.y = CANVAS_HEIGHT / 2, a.regX = 206.5, a.regY = 37, s_oStage.addChild(a), createjs.Tween.get(a).to({
                alpha: 1,
                scaleX: 1,
                scaleY: 1
            }, 500).wait(800).call(function() {
                d.controlIfCanContinue()
            })) : !0 === p ? (a = createBitmap(s_oSpriteLibrary.getSprite("missed_text")), a.scaleX = 0, a.scaleY = 0, a.alpha = 0, a.x = CANVAS_WIDTH / 2, a.y = CANVAS_HEIGHT / 2, a.regX = 206.5, a.regY = 37, s_oStage.addChild(a), createjs.Tween.get(a).to({
            alpha: 1,
            scaleX: 1,
            scaleY: 1
        }, 500).wait(800).call(function() {
            d.controlIfCanContinue()
        })) : l === OUT ? (a = createBitmap(s_oSpriteLibrary.getSprite("out_text")),
            a.scaleX = 0, a.scaleY = 0, a.alpha = 0, a.x = CANVAS_WIDTH / 2, a.y = CANVAS_HEIGHT / 2, a.regX = 130.5, a.regY = 35, s_oStage.addChild(a), !1 !== DISABLE_SOUND_MOBILE && !1 !== s_bMobile || createjs.Sound.play("miss_goal"), y.fadeOut(), createjs.Tween.get(a).to({
                alpha: 1,
                scaleX: 1,
                scaleY: 1
            }, 500).wait(800).call(function() {
                d.controlIfCanContinue()
            })) : H !== l && l !== OUT && (a = createBitmap(s_oSpriteLibrary.getSprite("goal_text")), a.scaleX = 0, a.scaleY = 0, a.alpha = 0, a.x = CANVAS_WIDTH / 2, a.y = CANVAS_HEIGHT / 2, a.regX = 399, a.regY = 38, s_oStage.addChild(a), !1 !== DISABLE_SOUND_MOBILE && !1 !== s_bMobile || createjs.Sound.play("goal"), y.fadeOut(), createjs.Tween.get(a).to({
            alpha: 1,
            scaleX: 1,
            scaleY: 1
        }, 500).wait(800).call(function() {
            d.controlIfCanContinue()
        }), f++, b += c, Q = !0)
    };
    this.controlWall = function() {
        var a = y.returnX(),
            b = y.returnY();
        0 < B.num && !0 === K[0].controlIfHitted(a, b, B.num) && (y.bounce(D.x, 0), !1 === DISABLE_SOUND_MOBILE || !1 === s_bMobile) && (createjs.Sound.play("keeper_save"), createjs.Sound.play("miss_goal"))
    };
    this.goalKeeperBounce = function() {
        if (!1 === DISABLE_SOUND_MOBILE ||
            !1 === s_bMobile) createjs.Sound.play("keeper_save"), createjs.Sound.play("miss_goal");
        y.bounce(D.x, 1)
    };
    this.controlIfCanContinue = function() {
        f >= g && 1 >= h ? (m++, q = 0, m === NUM_LEVEL ? (c = 0, L = CEndPanel(s_oSpriteLibrary.getSprite("bg_win"), s_oSpriteLibrary.getSprite("you_win")), L.win(b)) : (this.unload(), this._init())) : 1 >= h && this.gameOver();
        1 < h && (h--, q++, this.unload(), this._init())
    };
    this._initKickPoints = function() {
        A = [];
        for (var a = 0; a < RANGE_WIDTH; a++) {
            A[a] = [];
            for (var b = 0; b < RANGE_HEIGHT; b++) {
                var c = 0,
                    d = 0;
                A[a][b] = {
                    x: 0,
                    y: 0
                };
                c = Math.round((MATRIX_X_END - MATRIX_X_START) / RANGE_WIDTH * a + MATRIX_X_START) + 5;
                d = Math.round((MATRIX_Y_END - MATRIX_Y_START) / RANGE_HEIGHT * b + MATRIX_Y_START) + 5;
                A[a][b].x = c;
                A[a][b].y = d
            }
        }
    };
    this.unload = function() {
        x.unload();
        createjs.Tween.removeAllTweens();
        s_oStage.removeAllChildren()
    };
    this.onExit = function() {
        $(s_oMain).trigger("end_level", m);
        $(s_oMain).trigger("show_interlevel_ad");
        $(s_oMain).trigger("end_session");
        this.unload();
        s_oMain.gotoMenu();
        if (!1 === DISABLE_SOUND_MOBILE || !1 === s_bMobile) s_oCrowd.volume =
            0, s_oSoundtrack.volume = 1;
        $(s_oMain).trigger("restart")
    };
    this.gameOver = function() {
        c = q = 0;
        L = CEndPanel(s_oSpriteLibrary.getSprite("bg_next_level"), s_oSpriteLibrary.getSprite("game_over"));
        L.show(b)
    };
    this.setUpdate = function() {
        u = !u
    };
    this.setCrowdOff = function() {
        Q = !1
    };
    this.update = function() {
        if (u) {
            if (v && (d = C.getFrame(), 4 === d && !z)) {
                if (Math.floor(100 * Math.random()) <= k && 0 < l && 0 < k) H = l, l !== OUT && (p = !0);
                else {
                    do H = Math.floor(Math.random() * NUM_SAVE); while (H === l)
                }
                switch (H) {
                    case CENTER:
                        w = CENTER_INFO;
                        break;
                    case CENTER_HIGH:
                        w =
                            CENTER_HIGH_INFO;
                        break;
                    case DOWN_LEFT:
                        w = DOWN_LEFT_INFO;
                        break;
                    case DOWN_RIGHT:
                        w = DOWN_RIGHT_INFO;
                        break;
                    case HIGH_LEFT:
                        w = HIGH_LEFT_INFO;
                        break;
                    case HIGH_RIGHT:
                        w = HIGH_RIGHT_INFO;
                        break;
                    case MED_LEFT:
                        w = MED_LEFT_INFO;
                        break;
                    case MED_RIGHT:
                        w = MED_RIGHT_INFO
                }
                I.showAction(w.x, w.y, w.action, w.frames, w.width, w.height);
                if (0 < B.num) {
                    for (var a = 0; a < B.num; a++) K[a].showJump(a);
                    G = !0
                }
                this.kickBall();
                E = z = !0
            }
            E && I.getFrame() === w.frames && (I.stop(), E = !1);
            1 <= c - 3 && (c -= 3, x.viewScoreBonus(c, 0));
            !0 === Q && W.showAnim();
            if (0 < B.num && !0 ===
                G && K[0].getFrame() === K[0].frames) {
                for (a = 0; a < B.num; a++) K[a].showIdle();
                G = !1
            }
            y.update(B.num, p)
        }
    };
    SHOT_INDICATOR_SPEED = a.shot_indicator_spd;
    DECREASE_SHOT_INDICATOR_SPEED = a.decrease_shot_indicator_spd;
    s_oGame = this;
    this._init()
}
var s_oGame;

function CEndPanel(a, e) {
    var b, c, f, g, h, d, k, l;
    this._init = function(a, e) {
        f = createBitmap(a);
        d = createBitmap(e);
        d.x = CANVAS_WIDTH / 2 - 400;
        d.y = CANVAS_HEIGHT / 2 - 200;
        l = new createjs.Text("", " 50px " + TEXT, "#000000");
        l.x = CANVAS_WIDTH / 2;
        l.y = CANVAS_HEIGHT / 2;
        l.textAlign = "center";
        l.textBaseline = "alphabetic";
        l.lineWidth = 650;
        l.outline = 3;
        k = new createjs.Text("", " 50px " + TEXT, "#ffe51f");
        k.x = CANVAS_WIDTH / 2;
        k.y = CANVAS_HEIGHT / 2;
        k.textAlign = "center";
        k.textBaseline = "alphabetic";
        k.lineWidth = 500;
        g = new createjs.Container;
        g.alpha =
            0;
        g.visible = !1;
        g.addChild(f, l, k, d);
        s_oStage.addChild(g);
        var r = s_oSpriteLibrary.getSprite("but_restart");
        b = CANVAS_WIDTH / 2 + 300;
        c = CANVAS_HEIGHT - 130;
        h = new CGfxButton(b, c, r);
        h.addEventListener(ON_MOUSE_UP, this._onExit, this);
        this.refreshButtonPos(s_iOffsetX, s_iOffsetY)
    };
    this.show = function(a) {
        !1 !== DISABLE_SOUND_MOBILE && !1 !== s_bMobile || createjs.Sound.play("game_over");
        l.text = TEXT_SCORE + a;
        k.text = TEXT_SCORE + a;
        g.visible = !0;
        createjs.Tween.get(g).to({
            alpha: 1
        }, 500).call(function() {});
        $(s_oMain).trigger("share_event",
            a);
        $(s_oMain).trigger("save_score", [a])
    };
    this.win = function(a) {
        !1 !== DISABLE_SOUND_MOBILE && !1 !== s_bMobile || createjs.Sound.play("applause");
        l.text = TEXT_SCORE + a;
        l.x = CANVAS_WIDTH / 2 - 150;
        l.y = CANVAS_HEIGHT / 2 + 120;
        l.rotation = 17;
        k.text = TEXT_SCORE + a;
        k.x = CANVAS_WIDTH / 2 - 150;
        k.y = CANVAS_HEIGHT / 2 + 120;
        k.rotation = 17;
        g.visible = !0;
        createjs.Tween.get(g).to({
            alpha: 1
        }, 500).call(function() {});
        $(s_oMain).trigger("share_event", a);
        $(s_oMain).trigger("save_score", [a])
    };
    this._onExit = function() {
        s_oStage.removeChild(g);
        h.unload();
        s_oGame.onExit()
    };
    this.refreshButtonPos = function(a, d) {
        h.setPosition(b, c - d)
    };
    this._init(a, e);
    return this
}

function CCrowd() {
    var a = [],
        e = 0,
        b = 0;
    this._init = function() {
        for (var b = 0; b < NUM_CROWD; b++) a.push(createBitmap(s_oSpriteLibrary.getSprite("supporters_" + b))), a[b].x = 0, a[b].y = 90, a[b].visible = !1, s_oStage.addChild(a[b]);
        a[0].visible = !0
    };
    this.exult = function() {
        a[e].visible = !1;
        e++;
        a[e].visible = !0
    };
    this.showAnim = function() {
        b += s_iTimeElaps;
        30 <= b && (this.exult(), e === NUM_CROWD - 1 && (a[e].visible = !1, e = 0, a[e].visible = !0, s_oGame.setCrowdOff()), b = 0)
    };
    s_oPlayer = this;
    this._init()
}
s_oPlayer = null;

function CBall(a, e, b) {
    var c = 0,
        f = !1,
        g = !0,
        h, d, k, l = {
            x: 0,
            y: 0
        },
        m = {
            x: 0,
            y: 0
        };
    this._init = function(a, b, c) {
        h = {
            images: [s_oSpriteLibrary.getSprite("ball")],
            framerate: 20,
            frames: {
                width: BALL_WIDTH,
                height: BALL_HEIGHT,
                regX: BALL_WIDTH / 2,
                regY: BALL_WIDTH / 2
            },
            animations: {
                idle: 0,
                thrown: [0, 6, "thrown"]
            }
        };
        var f = new createjs.SpriteSheet(h);
        d = createSprite(f, "idle", 0, 0, BALL_WIDTH, BALL_HEIGHT);
        d.x = a;
        d.y = b;
        d.rotation = 0;
        c.addChild(d);
        d.gotoAndStop("idle");
        l.x = d.x;
        l.y = d.y
    };
    this._calculateMid = function(a, b) {
        var c;
        c = Math.floor(50 * Math.random()) +
            1;
        c = b.x < CANVAS_WIDTH / 2 ? b.y > CANVAS_HEIGHT / 2 ? new createjs.Point(Math.floor(CANVAS_WIDTH / 2 * Math.random()) + 100, CANVAS_HEIGHT / 2 - 200 - c) : new createjs.Point(Math.floor(CANVAS_WIDTH / 2 * Math.random()) + 100, CANVAS_HEIGHT / 2 - 200 + c) : b.x > CANVAS_WIDTH / 2 ? b.y > CANVAS_HEIGHT / 2 ? new createjs.Point(Math.floor(CANVAS_WIDTH / 2 * Math.random()) + 300, CANVAS_HEIGHT / 2 - 200 - c) : new createjs.Point(Math.floor(CANVAS_WIDTH / 2 * Math.random()) + 300, CANVAS_HEIGHT / 2 - 200 + c) : b.x > CANVAS_WIDTH / 2 ? new createjs.Point(CANVAS_WIDTH / 2 - 50, Math.floor(CANVAS_HEIGHT /
            2 * Math.random() - 100) + 100) : new createjs.Point(CANVAS_WIDTH / 2 + 50, Math.floor(CANVAS_HEIGHT / 2 * Math.random() - 100) + 100);
        k = {
            start: a,
            end: b,
            traj: c
        }
    };
    this.fadeOut = function() {
        createjs.Tween.get(d).to({
            alpha: 0
        }, 200).call(function() {
            d.gotoAndStop("idle")
        })
    };
    this.ballKicked = function(a, b) {
        m.x = a;
        m.y = b;
        k = {
            start: l,
            end: m,
            traj: m
        };
        f = !0;
        g = !1;
        d.gotoAndPlay("thrown")
    };
    this.returnX = function() {
        return d.x
    };
    this.returnY = function() {
        return d.y
    };
    this._updateBall = function(a, b) {
        c += STEP_SPEED_BALL_HITTED;
        d.rotation += 5;
        40 < c && (c = 0,
            f = !1, g = !0, s_oGame.showMessage(!1));
        if (!g) {
            var e;
            e = easeOutCubic(c, 0, 1, 40);
            e = getTrajectoryPoint(e, k);
            d.x = e.x;
            d.y = e.y;
            !0 === b && .7 >= d.scaleX && s_oGame.goalKeeperBounce();
            0 < a && .75 >= d.scaleX && s_oGame.controlWall();.4 <= d.scaleX && (d.scaleX -= .03, d.scaleY -= .03)
        }
    };
    this.bounce = function(a, b) {
        f = !1;
        0 === b ? a < CANVAS_WIDTH / 2 ? createjs.Tween.get(d).to({
                x: d.x + 100,
                y: CANVAS_HEIGHT + 50
            }, 500).call(function() {
                s_oGame.showMessage(!0)
            }) : createjs.Tween.get(d).to({
                x: d.x - 100,
                y: CANVAS_HEIGHT + 50
            }, 500).call(function() {
                s_oGame.showMessage(!0)
            }) :
            a < CANVAS_WIDTH / 2 ? createjs.Tween.get(d).to({
                x: d.x + 100,
                y: CANVAS_HEIGHT + 50
            }, 700).call(function() {
                s_oGame.showMessage(!1)
            }) : createjs.Tween.get(d).to({
                x: d.x - 100,
                y: CANVAS_HEIGHT + 50
            }, 700).call(function() {
                s_oGame.showMessage(!1)
            })
    };
    this.unload = function() {
        d = null;
        b.removeAllChildren()
    };
    this.update = function(a, b) {
        f && this._updateBall(a, b)
    };
    s_oBall = this;
    this._init(a, e, b)
}
s_oBall = null;

function CSpriteLibrary() {
    var a, e, b, c, f, g;
    this.init = function(h, d, k) {
        b = e = 0;
        c = h;
        f = d;
        g = k;
        a = {}
    };
    this.addSprite = function(b, c) {
        a.hasOwnProperty(b) || (a[b] = {
            szPath: c,
            oSprite: new Image
        }, e++)
    };
    this.getSprite = function(b) {
        return a.hasOwnProperty(b) ? a[b].oSprite : null
    };
    this._onSpritesLoaded = function() {
        f.call(g)
    };
    this._onSpriteLoaded = function() {
        c.call(g);
        ++b == e && this._onSpritesLoaded()
    };
    this.loadSprites = function() {
        for (var b in a) a[b].oSprite.oSpriteLibrary = this, a[b].oSprite.onload = function() {
                this.oSpriteLibrary._onSpriteLoaded()
            },
            a[b].oSprite.src = a[b].szPath
    };
    this.getNumSprites = function() {
        return e
    }
}
var CANVAS_WIDTH = 1360,
    CANVAS_HEIGHT = 640,
    EDGEBOARD_X = 275,
    EDGEBOARD_Y = 80,
    TEXT = "walibi0615bold",
    NUM_CROWD = 31,
    NUM_LEVEL = 6,
    NUM_KICK = 5,
    SPACE_BAR = 32,
    LEFT = 37,
    RIGHT = 39,
    UP = 38,
    DOWN = 40,
    SHOT_INDICATOR_SPEED, DECREASE_SHOT_INDICATOR_SPEED, RANGE_WIDTH = 9,
    RANGE_HEIGHT = 4,
    LOW_PERCENT = 5,
    MED_PERCENT = 50,
    HIGH_PERCENT = 90,
    MATRIX_X_START = 380,
    MATRIX_X_END = 1040,
    MATRIX_Y_START = 235,
    MATRIX_Y_END = 430,
    ROUND = 0,
    MSG_BOX_WIDTH = 744,
    MSG_BOX_HEIGHT = 450,
    GOAL_WIDTH = 390,
    GOAL_HEIGHT = 145,
    PLAYER_WIDTH = 160,
    PLAYER_HEIGHT = 239,
    WALL_WIDTH = 119,
    WALL_HEIGHT =
    179,
    BALL_WIDTH = 60,
    BALL_HEIGHT = 60,
    STEP_SPEED_BALL_HITTED = 2.4,
    FPS_TIME = 1E3 / 24,
    DISABLE_SOUND_MOBILE = !1,
    TOP_BARX = 784,
    TOP_BARY = 48,
    RIGHT_BARX = 44,
    RIGHT_BARY = 359,
    CURSOR_X = 41,
    CURSOR_Y = 41,
    PLAYER_X_POSITION_IN_SELECTION = CANVAS_WIDTH / 2,
    PLAYER_Y_POSITION_IN_SELECTION = 350,
    ARGENTINA = 0,
    BRAZIL = 1,
    GERMANY = 2,
    ENGLAND = 3,
    ITALY = 4,
    FRANCE = 5,
    FIRST_TIME = 0,
    STATE_LOADING = 0,
    STATE_MENU = 1,
    STATE_HELP = 1,
    STATE_GAME = 3,
    ON_MOUSE_DOWN = 0,
    ON_MOUSE_UP = 1,
    ON_MOUSE_OVER = 2,
    ON_MOUSE_OUT = 3,
    ON_DRAG_START = 4,
    ON_DRAG_END = 5,
    NUM_SAVE = 8,
    GOALKEEPER_X_POSITION =
    CANVAS_WIDTH / 2,
    GOALKEEPER_Y_POSITION = 390,
    GOALKEEPER_WIDTH = 91,
    GOALKEEPER_HEIGHT = 122,
    CENTER_INFO = {
        action: "center",
        width: 91,
        height: 122,
        x: CANVAS_WIDTH / 2,
        y: 420,
        frames: 4
    },
    CENTER_HIGH_INFO = {
        action: "center_high",
        width: 106,
        height: 163,
        x: CANVAS_WIDTH / 2,
        y: 420,
        frames: 9
    },
    DOWN_LEFT_INFO = {
        action: "down_left",
        width: 185,
        height: 118,
        x: CANVAS_WIDTH / 2 - 45,
        y: 420,
        frames: 16
    },
    DOWN_RIGHT_INFO = {
        action: "down_right",
        width: 185,
        height: 118,
        x: CANVAS_WIDTH / 2 + 45,
        y: 420,
        frames: 17
    },
    HIGH_LEFT_INFO = {
        action: "high_left",
        width: 295,
        height: 163,
        x: CANVAS_WIDTH / 2 - 100,
        y: 420,
        frames: 17
    },
    HIGH_RIGHT_INFO = {
        action: "high_right",
        width: 275,
        height: 163,
        x: CANVAS_WIDTH / 2 + 90,
        y: 420,
        frames: 17
    },
    MED_LEFT_INFO = {
        action: "med_left",
        width: 229,
        height: 113,
        x: CANVAS_WIDTH / 2 - 65,
        y: 420,
        frames: 16
    },
    MED_RIGHT_INFO = {
        action: "med_right",
        width: 229,
        height: 118,
        x: CANVAS_WIDTH / 2 + 65,
        y: 420,
        frames: 16
    },
    CENTER = 0,
    CENTER_HIGH = 1,
    DOWN_LEFT = 2,
    DOWN_RIGHT = 3,
    HIGH_LEFT = 4,
    HIGH_RIGHT = 5,
    MED_LEFT = 6,
    MED_RIGHT = 7,
    OUT = 8;

function CWall(a, e, b, c) {
    var f = null,
        g = null,
        h;
    this._init = function(a, c, e) {
        0 === e && (b.x = a, b.y = c)
    };
    this.showIdle = function(a) {
        var b = {
            images: [s_oSpriteLibrary.getSprite("wall_idle")],
            framerate: 10,
            frames: {
                width: WALL_WIDTH,
                height: WALL_HEIGHT,
                regX: WALL_WIDTH / 2,
                regY: 0
            },
            animations: {
                idle: [0, 23, "idle"]
            }
        };
        f = new createjs.SpriteSheet(b);
        null === g ? g = new createjs.Sprite(f, "idle") : g.spriteSheet = f;
        g.x = (WALL_WIDTH - 40) * a;
        g.y = 0;
        g.currentAnimationFrame = 0;
        h.addChild(g)
    };
    this.showJump = function(a) {
        null !== g && h.removeChild(g);
        var b = {
                images: [s_oSpriteLibrary.getSprite("wall_jump")],
                framerate: 15,
                frames: {
                    width: WALL_WIDTH,
                    height: WALL_HEIGHT,
                    regX: WALL_WIDTH / 2
                },
                animations: {
                    start: [0],
                    jump: [0, 20, "start"]
                }
            },
            b = new createjs.SpriteSheet(b);
        g = new createjs.Sprite(b, "jump");
        g.x = (WALL_WIDTH - 40) * a;
        h.addChild(g)
    };
    this.stopAction = function() {
        g.stop(0)
    };
    this.getFrame = function() {
        return g.currentFrame
    };
    this.getX = function() {
        return g.x
    };
    this.controlIfHitted = function(a, b, c) {
        if (b < h.y + WALL_HEIGHT && b > h.y && a > h.x && a < h.x + (WALL_WIDTH - 60) * c) return !0
    };
    this.unload =
        function() {
            g = null;
            h.removeChild(g)
        };
    s_oPlayer = this;
    h = b;
    this._init(a, e, c)
}
s_oPlayer = null;

function CVector2(a, e) {
    var b, c;
    this._init = function(a, e) {
        b = a;
        c = e
    };
    this.add = function(a, e) {
        b += a;
        c += e
    };
    this.addV = function(a) {
        b += a.getX();
        c += a.getY()
    };
    this.scalarDivision = function(a) {
        b /= a;
        c /= a
    };
    this.subV = function(a) {
        b -= a.getX();
        c -= a.getY()
    };
    this.scalarProduct = function(a) {
        b *= a;
        c *= a
    };
    this.invert = function() {
        b *= -1;
        c *= -1
    };
    this.dotProduct = function(a) {
        return b * a.getX() + c * a.getY()
    };
    this.set = function(a, e) {
        b = a;
        c = e
    };
    this.setV = function(a) {
        b = a.getX();
        c = a.getY()
    };
    this.length = function() {
        return Math.sqrt(b * b + c * c)
    };
    this.length2 =
        function() {
            return b * b + c * c
        };
    this.normalize = function() {
        var a = this.length();
        0 < a && (b /= a, c /= a)
    };
    this.getNormalize = function(a) {
        this.length();
        a.set(b, c);
        a.normalize()
    };
    this.rot90CCW = function() {
        var a = b;
        b = -c;
        c = a
    };
    this.rot90CW = function() {
        var a = b;
        b = c;
        c = -a
    };
    this.getRotCCW = function(a) {
        a.set(b, c);
        a.rot90CCW()
    };
    this.getRotCW = function(a) {
        a.set(b, c);
        a.rot90CW()
    };
    this.ceil = function() {
        b = Math.ceil(b);
        c = Math.ceil(c)
    };
    this.round = function() {
        b = Math.round(b);
        c = Math.round(c)
    };
    this.toString = function() {
        return "Vector2: " + b + ", " +
            c
    };
    this.print = function() {
        trace("Vector2: " + b + ", " + c + "")
    };
    this.getX = function() {
        return b
    };
    this.getY = function() {
        return c
    };
    this._init(a, e)
}

function CToggle(a, e, b, c) {
    var f, g, h, d = [],
        k;
    this._init = function(a, b, c, d) {
        g = [];
        h = [];
        var e = new createjs.SpriteSheet({
            images: [c],
            frames: {
                width: c.width / 2,
                height: c.height,
                regX: c.width / 2 / 2,
                regY: c.height / 2
            },
            animations: {
                state_true: [0],
                state_false: [1]
            }
        });
        f = d;
        k = createSprite(e, "state_" + f, c.width / 2 / 2, c.height / 2, c.width / 2, c.height);
        k.x = a;
        k.y = b;
        k.stop();
        s_oStage.addChild(k);
        this._initListener()
    };
    this.unload = function() {
        k.off("mousedown", this.buttonDown);
        k.off("pressup", this.buttonRelease);
        s_oStage.removeChild(k)
    };
    this._initListener = function() {
        k.on("mousedown", this.buttonDown);
        k.on("pressup", this.buttonRelease)
    };
    this.addEventListener = function(a, b, c) {
        g[a] = b;
        h[a] = c
    };
    this.addEventListenerWithParams = function(a, b, c, e) {
        g[a] = b;
        h[a] = c;
        d = e
    };
    this.setActive = function(a) {
        f = a;
        k.gotoAndStop("state_" + f)
    };
    this.buttonRelease = function() {
        k.scaleX = 1;
        k.scaleY = 1;
        !1 !== DISABLE_SOUND_MOBILE && !1 !== s_bMobile || createjs.Sound.play("click");
        f = !f;
        k.gotoAndStop("state_" + f);
        g[ON_MOUSE_UP] && g[ON_MOUSE_UP].call(h[ON_MOUSE_UP], d)
    };
    this.buttonDown =
        function() {
            k.scaleX = .9;
            k.scaleY = .9;
            g[ON_MOUSE_DOWN] && g[ON_MOUSE_DOWN].call(h[ON_MOUSE_DOWN], d)
        };
    this.setPosition = function(a, b) {
        k.x = a;
        k.y = b
    };
    this.setVisible = function(a) {
        k.visible = a
    };
    this._init(a, e, b, c)
}
(function(a) {
    (jQuery.browser = jQuery.browser || {}).mobile = /android|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(ad|hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|symbian|tablet|treo|up\.(browser|link)|vodafone|wap|webos|windows (ce|phone)|xda|xiino/i.test(a) || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|e\-|e\/|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(di|rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|xda(\-|2|g)|yas\-|your|zeto|zte\-/i.test(a.substr(0,
        4))
})(navigator.userAgent || navigator.vendor || window.opera);

function trace(a) {
    console.log(a)
}
$(window).resize(function() {
    sizeHandler()
});

function isIOS() {
    for (var a = "iPad Simulator;iPhone Simulator;iPod Simulator;iPad;iPhone;iPod".split(";"); a.length;)
        if (navigator.platform === a.pop()) return s_bIsIphone = !0;
    return s_bIsIphone = !1
}

function getSize(a) {
    var e = a.toLowerCase(),
        b = window.document,
        c = b.documentElement;
    if (void 0 === window["inner" + a]) a = c["client" + a];
    else if (window["inner" + a] != c["client" + a]) {
        var f = b.createElement("body");
        f.id = "vpw-test-b";
        f.style.cssText = "overflow:scroll";
        var g = b.createElement("div");
        g.id = "vpw-test-d";
        g.style.cssText = "position:absolute;top:-1000px";
        g.innerHTML = "<style>@media(" + e + ":" + c["client" + a] + "px){body#vpw-test-b div#vpw-test-d{" + e + ":7px!important}}</style>";
        f.appendChild(g);
        c.insertBefore(f, b.head);
        a = 7 == g["offset" + a] ? c["client" + a] : window["inner" + a];
        c.removeChild(f)
    } else a = window["inner" + a];
    return a
}
window.addEventListener("orientationchange", onOrientationChange);

function onOrientationChange() {
    window.matchMedia("(orientation: portrait)").matches && sizeHandler();
    window.matchMedia("(orientation: landscape)").matches && sizeHandler()
}

function getIOSWindowHeight() {
    return document.documentElement.clientWidth / window.innerWidth * window.innerHeight
}

function getHeightOfIOSToolbars() {
    var a = (0 === window.orientation ? screen.height : screen.width) - getIOSWindowHeight();
    return 1 < a ? a : 0
}

function sizeHandler() {
    window.scrollTo(0, 1);
    if ($("#canvas")) {
        var a;
        a = navigator.userAgent.match(/(iPad|iPhone|iPod)/g) ? getIOSWindowHeight() : getSize("Height");
        var e = getSize("Width"),
            b = Math.min(a / CANVAS_HEIGHT, e / CANVAS_WIDTH),
            c = CANVAS_WIDTH * b,
            b = CANVAS_HEIGHT * b,
            f = 0;
        b < a ? (f = a - b, b += f, c += CANVAS_WIDTH / CANVAS_HEIGHT * f) : c < e && (f = e - c, c += f, b += CANVAS_HEIGHT / CANVAS_WIDTH * f);
        var f = a / 2 - b / 2,
            g = e / 2 - c / 2,
            h = CANVAS_WIDTH / c;
        if (g * h < -EDGEBOARD_X || f * h < -EDGEBOARD_Y) b = Math.min(a / (CANVAS_HEIGHT - 2 * EDGEBOARD_Y), e / (CANVAS_WIDTH - 2 *
            EDGEBOARD_X)), c = CANVAS_WIDTH * b, b *= CANVAS_HEIGHT, f = (a - b) / 2, g = (e - c) / 2, h = CANVAS_WIDTH / c;
        s_iOffsetX = -1 * g * h;
        s_iOffsetY = -1 * f * h;
        0 <= f && (s_iOffsetY = 0);
        0 <= g && (s_iOffsetX = 0);
        null !== s_oInterface && s_oInterface.refreshButtonPos(s_iOffsetX, s_iOffsetY);
        null !== s_oMenu && s_oMenu.refreshButtonPos(s_iOffsetX, s_iOffsetY);
        null !== s_oSelectTeam && s_oSelectTeam.refreshButtonPos(s_iOffsetX, s_iOffsetY);
        $("#canvas").css("width", c + "px");
        $("#canvas").css("height", b + "px");
        0 > f ? $("#canvas").css("top", f + "px") : $("#canvas").css("top",
            "0px");
        $("#canvas").css("left", g + "px")
    }
}

function createBitmap(a, e, b) {
    var c = new createjs.Bitmap(a),
        f = new createjs.Shape;
    e && b ? f.graphics.beginFill("#fff").drawRect(0, 0, e, b) : f.graphics.beginFill("#ff0").drawRect(0, 0, a.width, a.height);
    c.hitArea = f;
    return c
}

function createSprite(a, e, b, c, f, g) {
    a = null !== e ? new createjs.Sprite(a, e) : new createjs.Sprite(a);
    e = new createjs.Shape;
    e.graphics.beginFill("#000000").drawRect(-b, -c, f, g);
    a.hitArea = e;
    return a
}

function randomFloatBetween(a, e, b) {
    "undefined" === typeof b && (b = 2);
    return parseFloat(Math.min(a + Math.random() * (e - a), e).toFixed(b))
}

function rotateVector2D(a, e) {
    var b = e.getX() * Math.cos(a) + e.getY() * Math.sin(a),
        c = e.getX() * -Math.sin(a) + e.getY() * Math.cos(a);
    e.set(b, c)
}

function tweenVectorsOnX(a, e, b) {
    return a + b * (e - a)
}

function shuffle(a) {
    for (var e = a.length, b, c; 0 !== e;) c = Math.floor(Math.random() * e), --e, b = a[e], a[e] = a[c], a[c] = b;
    return a
}

function bubbleSort(a) {
    var e;
    do {
        e = !1;
        for (var b = 0; b < a.length - 1; b++) a[b] > a[b + 1] && (e = a[b], a[b] = a[b + 1], a[b + 1] = e, e = !0)
    } while (e)
}

function compare(a, e) {
    return a.index > e.index ? -1 : a.index < e.index ? 1 : 0
}

function easeLinear(a, e, b, c) {
    return b * a / c + e
}

function easeInQuad(a, e, b, c) {
    return b * (a /= c) * a + e
}

function easeInSine(a, e, b, c) {
    return -b * Math.cos(a / c * (Math.PI / 2)) + b + e
}

function easeInCubic(a, e, b, c) {
    return b * (a /= c) * a * a + e
}

function easeOutCubic(a, e, b, c, f) {
    return b * ((a = a / c - 1) * a * a + 1) + e
}

function getTrajectoryPoint(a, e) {
    var b = new createjs.Point,
        c = (1 - a) * (1 - a),
        f = a * a;
    b.x = c * e.start.x + 2 * (1 - a) * a * e.traj.x + f * e.end.x;
    b.y = c * e.start.y + 2 * (1 - a) * a * e.traj.y + f * e.end.y;
    return b
}

function formatTime(a) {
    a /= 1E3;
    var e = Math.floor(a / 60);
    a = Math.floor(a - 60 * e);
    var b = "",
        b = 10 > e ? b + ("0" + e + ":") : b + (e + ":");
    return 10 > a ? b + ("0" + a) : b + a
}

function degreesToRadians(a) {
    return a * Math.PI / 180
}

function checkRectCollision(a, e) {
    var b, c;
    b = getBounds(a, .9);
    c = getBounds(e, .98);
    return calculateIntersection(b, c)
}

function calculateIntersection(a, e) {
    var b, c, f, g, h, d, k, l;
    b = a.x + (f = a.width / 2);
    c = a.y + (g = a.height / 2);
    h = e.x + (d = e.width / 2);
    k = e.y + (l = e.height / 2);
    b = Math.abs(b - h) - (f + d);
    c = Math.abs(c - k) - (g + l);
    return 0 > b && 0 > c ? (b = Math.min(Math.min(a.width, e.width), -b), c = Math.min(Math.min(a.height, e.height), -c), {
        x: Math.max(a.x, e.x),
        y: Math.max(a.y, e.y),
        width: b,
        height: c,
        rect1: a,
        rect2: e
    }) : null
}

function getBounds(a, e) {
    var b = {
        x: Infinity,
        y: Infinity,
        width: 0,
        height: 0
    };
    if (a instanceof createjs.Container) {
        b.x2 = -Infinity;
        b.y2 = -Infinity;
        var c = a.children,
            f = c.length,
            g, h;
        for (h = 0; h < f; h++) g = getBounds(c[h], 1), g.x < b.x && (b.x = g.x), g.y < b.y && (b.y = g.y), g.x + g.width > b.x2 && (b.x2 = g.x + g.width), g.y + g.height > b.y2 && (b.y2 = g.y + g.height);
        Infinity == b.x && (b.x = 0);
        Infinity == b.y && (b.y = 0);
        Infinity == b.x2 && (b.x2 = 0);
        Infinity == b.y2 && (b.y2 = 0);
        b.width = b.x2 - b.x;
        b.height = b.y2 - b.y;
        delete b.x2;
        delete b.y2
    } else {
        var d, k;
        a instanceof createjs.Bitmap ?
            (f = a.sourceRect || a.image, h = f.width * e, d = f.height * e) : a instanceof createjs.Sprite ? a.spriteSheet._frames && a.spriteSheet._frames[a.currentFrame] && a.spriteSheet._frames[a.currentFrame].image ? (f = a.spriteSheet.getFrame(a.currentFrame), h = f.rect.width, d = f.rect.height, c = f.regX, k = f.regY) : (b.x = a.x || 0, b.y = a.y || 0) : (b.x = a.x || 0, b.y = a.y || 0);
        c = c || 0;
        h = h || 0;
        k = k || 0;
        d = d || 0;
        b.regX = c;
        b.regY = k;
        f = a.localToGlobal(0 - c, 0 - k);
        g = a.localToGlobal(h - c, d - k);
        h = a.localToGlobal(h - c, 0 - k);
        c = a.localToGlobal(0 - c, d - k);
        b.x = Math.min(Math.min(Math.min(f.x,
            g.x), h.x), c.x);
        b.y = Math.min(Math.min(Math.min(f.y, g.y), h.y), c.y);
        b.width = Math.max(Math.max(Math.max(f.x, g.x), h.x), c.x) - b.x;
        b.height = Math.max(Math.max(Math.max(f.y, g.y), h.y), c.y) - b.y
    }
    return b
}

function NoClickDelay(a) {
    this.element = a;
    window.Touch && this.element.addEventListener("touchstart", this, !1)
}

function shuffle(a) {
    for (var e = a.length, b, c; 0 < e;) c = Math.floor(Math.random() * e), e--, b = a[e], a[e] = a[c], a[c] = b;
    return a
}
NoClickDelay.prototype = {
    handleEvent: function(a) {
        switch (a.type) {
            case "touchstart":
                this.onTouchStart(a);
                break;
            case "touchmove":
                this.onTouchMove(a);
                break;
            case "touchend":
                this.onTouchEnd(a)
        }
    },
    onTouchStart: function(a) {
        a.preventDefault();
        this.moved = !1;
        this.element.addEventListener("touchmove", this, !1);
        this.element.addEventListener("touchend", this, !1)
    },
    onTouchMove: function(a) {
        this.moved = !0
    },
    onTouchEnd: function(a) {
        this.element.removeEventListener("touchmove", this, !1);
        this.element.removeEventListener("touchend",
            this, !1);
        if (!this.moved) {
            a = document.elementFromPoint(a.changedTouches[0].clientX, a.changedTouches[0].clientY);
            3 == a.nodeType && (a = a.parentNode);
            var e = document.createEvent("MouseEvents");
            e.initEvent("click", !0, !0);
            a.dispatchEvent(e)
        }
    }
};
(function() {
    function a(a) {
        var c = {
            focus: "visible",
            focusin: "visible",
            pageshow: "visible",
            blur: "hidden",
            focusout: "hidden",
            pagehide: "hidden"
        };
        a = a || window.event;
        a.type in c ? document.body.className = c[a.type] : (document.body.className = this[e] ? "hidden" : "visible", "hidden" === document.body.className ? s_oMain.stopUpdate() : s_oMain.startUpdate())
    }
    var e = "hidden";
    e in document ? document.addEventListener("visibilitychange", a) : (e = "mozHidden") in document ? document.addEventListener("mozvisibilitychange", a) : (e = "webkitHidden") in
        document ? document.addEventListener("webkitvisibilitychange", a) : (e = "msHidden") in document ? document.addEventListener("msvisibilitychange", a) : "onfocusin" in document ? document.onfocusin = document.onfocusout = a : window.onpageshow = window.onpagehide = window.onfocus = window.onblur = a
})();

function ctlArcadeResume() {
    null !== s_oMain && s_oMain.startUpdate()
}

function ctlArcadePause() {
    null !== s_oMain && s_oMain.stopUpdate()
}

function getParamValue(a) {
    for (var e = window.location.search.substring(1).split("&"), b = 0; b < e.length; b++) {
        var c = e[b].split("=");
        if (c[0] == a) return c[1]
    }
}

function CTextButton(a, e, b, c, f, g, h) {
    var d, k, l, m, q;
    this._init = function(a, b, c, e, g, h, f) {
        d = [];
        k = [];
        var G = createBitmap(c),
            A = Math.ceil(f / 20);
        q = new createjs.Text(e, "bold " + f + "px " + g, "#000000");
        q.textAlign = "center";
        q.textBaseline = "alphabetic";
        var x = q.getBounds();
        q.x = c.width / 2 + A;
        q.y = Math.floor(c.height / 2) + x.height / 3 + A;
        m = new createjs.Text(e, "bold " + f + "px " + g, h);
        m.textAlign = "center";
        m.textBaseline = "alphabetic";
        x = m.getBounds();
        m.x = c.width / 2;
        m.y = Math.floor(c.height / 2) + x.height / 3;
        l = new createjs.Container;
        l.x = a;
        l.y = b;
        l.regX = c.width / 2;
        l.regY = c.height / 2;
        l.addChild(G, q, m);
        s_oStage.addChild(l);
        this._initListener()
    };
    this.unload = function() {
        l.off("mousedown");
        l.off("pressup");
        s_oStage.removeChild(l)
    };
    this.setVisible = function(a) {
        l.visible = a
    };
    this._initListener = function() {
        oParent = this;
        l.on("mousedown", this.buttonDown);
        l.on("pressup", this.buttonRelease)
    };
    this.addEventListener = function(a, b, c) {
        d[a] = b;
        k[a] = c
    };
    this.buttonRelease = function() {
        l.scaleX = 1;
        l.scaleY = 1;
        d[ON_MOUSE_UP] && d[ON_MOUSE_UP].call(k[ON_MOUSE_UP])
    };
    this.buttonDown =
        function() {
            l.scaleX = .9;
            l.scaleY = .9;
            d[ON_MOUSE_DOWN] && d[ON_MOUSE_DOWN].call(k[ON_MOUSE_DOWN])
        };
    this.setTextPosition = function(a) {
        m.y = a;
        q.y = a + 2
    };
    this.setPosition = function(a, b) {
        l.x = a;
        l.y = b
    };
    this.setX = function(a) {
        l.x = a
    };
    this.setY = function(a) {
        l.y = a
    };
    this.getButtonImage = function() {
        return l
    };
    this.getX = function() {
        return l.x
    };
    this.getY = function() {
        return l.y
    };
    this._init(a, e, b, c, f, g, h);
    return this
}

function CShotIndicatorController(a, e) {
    var b, c, f, g, h = !0,
        d, k, l, m, q, r, t, n, u = !0,
        v = !0;
    this.init = function(a, e) {
        l = a;
        r = new createjs.Container;
        s_oStage.addChild(r);
        d = e;
        if (!1 === e) {
            var h = s_oSpriteLibrary.getSprite("high_bar");
            t = createBitmap(h);
            r.addChild(t);
            r.x = 290;
            r.y = CANVAS_HEIGHT / 2 - 170;
            h = s_oSpriteLibrary.getSprite("arrow_bar");
            n = createBitmap(h);
            n.x = 0;
            n.y = -10;
            r.addChild(n);
            f = 20;
            g = CANVAS_HEIGHT / 2 - 150;
            b = TOP_BARX - 50;
            c = CANVAS_HEIGHT / 2 - 150
        } else h = s_oSpriteLibrary.getSprite("right_bar"), h = createBitmap(h), r.addChild(h),
            r.x = CANVAS_WIDTH / 2 + 345, r.y = CANVAS_HEIGHT / 2 - 130, h = s_oSpriteLibrary.getSprite("arrow_bar"), n = createBitmap(h), n.x = 60, n.y = 0, n.rotation = 90, r.addChild(n), f = CANVAS_WIDTH / 2 + 375, g = 0, b = CANVAS_WIDTH / 2 + 375, c = RIGHT_BARY - 50;
        this.reset()
    };
    this.reset = function() {
        k = SHOT_INDICATOR_SPEED;
        m = new CVector2;
        m.set(f, g);
        q = new CVector2;
        q.set(b, c)
    };
    this.increaseSpeed = function() {
        k -= DECREASE_SHOT_INDICATOR_SPEED
    };
    this.show = function() {
        h = !0;
        r.visible = h
    };
    this.hide = function() {
        h = !1;
        r.visible = h
    };
    this.getPositionBallEnd = function() {
        return d ?
            Math.floor(n.y / l) : Math.floor(n.x / l)
    };
    this.startAnimation = function() {
        var a = this;
        d ? v ? createjs.Tween.get(n, {
            override: !0
        }).to({
            y: c
        }, k, createjs.Ease.quadInOut).call(function() {
            v = !v;
            a.startAnimation()
        }) : createjs.Tween.get(n, {
            override: !0
        }).to({
            y: g
        }, k, createjs.Ease.quadInOut).call(function() {
            v = !v;
            a.startAnimation()
        }) : u ? createjs.Tween.get(n, {
            override: !0
        }).to({
            x: b
        }, k, createjs.Ease.quadInOut).call(function() {
            u = !u;
            a.startAnimation()
        }) : createjs.Tween.get(n, {
            override: !0
        }).to({
            x: f
        }, k, createjs.Ease.quadInOut).call(function() {
            u = !u;
            a.startAnimation()
        })
    };
    this.endAnimation = function() {
        d ? createjs.Tween.get(n, {
            override: !0
        }).to({
            y: n.y
        }, 0).call(function() {}) : createjs.Tween.get(n, {
            override: !0
        }).to({
            x: n.x
        }, 0).call(function() {})
    };
    this.update = function() {};
    this.init(a, e)
}

function CSelectTeam() {
    var a, e, b, c, f = 0,
        g, h, d, k, l, m, q, r, t, n, u, v;
    this._init = function() {
        u = createBitmap(s_oSpriteLibrary.getSprite("bg_select_team"));
        s_oStage.addChild(u);
        var f = s_oSpriteLibrary.getSprite("but_continue");
        a = CANVAS_WIDTH / 2 + 300;
        e = CANVAS_HEIGHT - 110;
        k = new CGfxButton(a, e, f, s_oStage);
        k.addEventListener(ON_MOUSE_UP, this._onButNextRelease, this);
        f = s_oSpriteLibrary.getSprite("but_exit");
        b = CANVAS_WIDTH - f.height / 2 - 10;
        c = f.height / 2 + 10;
        v = new CGfxButton(b, c, f, s_oStage);
        v.addEventListener(ON_MOUSE_UP, this._onExit,
            this);
        h = new createjs.Container;
        s_oStage.addChild(h);
        d = new CPlayer(h);
        d.showIdle(PLAYER_X_POSITION_IN_SELECTION, PLAYER_Y_POSITION_IN_SELECTION, s_szTeamSelectedSprite);
        f = s_oSpriteLibrary.getSprite("argentina");
        l = new CToggle(CANVAS_WIDTH / 2 - 150, CANVAS_HEIGHT / 2 - 125, f, !1);
        l.addEventListenerWithParams(ON_MOUSE_UP, this._onModeToggle, this, ARGENTINA);
        f = s_oSpriteLibrary.getSprite("brazil");
        m = new CToggle(CANVAS_WIDTH / 2 + 120, CANVAS_HEIGHT / 2 - 125, f, !0);
        m.addEventListenerWithParams(ON_MOUSE_UP, this._onModeToggle,
            this, BRAZIL);
        f = s_oSpriteLibrary.getSprite("germany");
        t = new CToggle(CANVAS_WIDTH / 2 - 210, CANVAS_HEIGHT / 2, f, !0);
        t.addEventListenerWithParams(ON_MOUSE_UP, this._onModeToggle, this, GERMANY);
        f = s_oSpriteLibrary.getSprite("england");
        q = new CToggle(CANVAS_WIDTH / 2 + 180, CANVAS_HEIGHT / 2, f, !0);
        q.addEventListenerWithParams(ON_MOUSE_UP, this._onModeToggle, this, ENGLAND);
        f = s_oSpriteLibrary.getSprite("italy");
        n = new CToggle(CANVAS_WIDTH / 2 - 175, CANVAS_HEIGHT / 2 + 125, f, !0);
        n.addEventListenerWithParams(ON_MOUSE_UP, this._onModeToggle,
            this, ITALY);
        f = s_oSpriteLibrary.getSprite("france");
        r = new CToggle(CANVAS_WIDTH / 2 + 150, CANVAS_HEIGHT / 2 + 125, f, !0);
        r.addEventListenerWithParams(ON_MOUSE_UP, this._onModeToggle, this, FRANCE);
        g = new createjs.Text("ARGENTINA", " 25px " + TEXT, "#080863");
        g.x = CANVAS_WIDTH / 2 - 10;
        g.y = CANVAS_HEIGHT / 2 + 150;
        g.textAlign = "center";
        g.textBaseline = "alphabetic";
        s_oStage.addChild(g);
        this.refreshButtonPos(s_iOffsetX, s_iOffsetY)
    };
    this._onModeToggle = function(a) {
        !1 !== DISABLE_SOUND_MOBILE && !1 !== s_bMobile || createjs.Sound.play("select_team");
        switch (a) {
            case 0:
                l.setActive(!1);
                m.setActive(!0);
                t.setActive(!0);
                q.setActive(!0);
                n.setActive(!0);
                r.setActive(!0);
                f = ARGENTINA;
                g.text = "ARGENTINA";
                d.unload();
                d.showIdle(PLAYER_X_POSITION_IN_SELECTION, PLAYER_Y_POSITION_IN_SELECTION, "argentina");
                break;
            case 1:
                l.setActive(!0);
                m.setActive(!1);
                t.setActive(!0);
                q.setActive(!0);
                n.setActive(!0);
                r.setActive(!0);
                f = BRAZIL;
                g.text = "BRAZIL";
                d.unload();
                d.showIdle(PLAYER_X_POSITION_IN_SELECTION, PLAYER_Y_POSITION_IN_SELECTION, "brazil");
                break;
            case 2:
                l.setActive(!0);
                m.setActive(!0);
                t.setActive(!1);
                q.setActive(!0);
                n.setActive(!0);
                r.setActive(!0);
                f = GERMANY;
                g.text = "GERMANY";
                d.unload();
                d.showIdle(PLAYER_X_POSITION_IN_SELECTION, PLAYER_Y_POSITION_IN_SELECTION, "germany");
                break;
            case 3:
                l.setActive(!0);
                m.setActive(!0);
                t.setActive(!0);
                q.setActive(!1);
                n.setActive(!0);
                r.setActive(!0);
                f = ENGLAND;
                g.text = "ENGLAND";
                d.unload();
                d.showIdle(PLAYER_X_POSITION_IN_SELECTION, PLAYER_Y_POSITION_IN_SELECTION, "england");
                break;
            case 4:
                l.setActive(!0);
                m.setActive(!0);
                t.setActive(!0);
                q.setActive(!0);
                n.setActive(!1);
                r.setActive(!0);
                f = ITALY;
                g.text = "ITALY";
                d.unload();
                d.showIdle(PLAYER_X_POSITION_IN_SELECTION, PLAYER_Y_POSITION_IN_SELECTION, "italy");
                break;
            case 5:
                l.setActive(!0), m.setActive(!0), t.setActive(!0), q.setActive(!0), n.setActive(!0), r.setActive(!1), f = FRANCE, g.text = "FRANCE", d.unload(), d.showIdle(PLAYER_X_POSITION_IN_SELECTION, PLAYER_Y_POSITION_IN_SELECTION, "france")
        }
        s_iTeamSelected = f
    };
    this._onExit = function() {
        s_oMain.gotoMenu()
    };
    this.unload = function() {
        l.unload();
        m.unload();
        t.unload();
        q.unload();
        n.unload();
        r.unload();
        d.unload();
        s_oSelectTeam = null;
        s_oStage.removeAllChildren()
    };
    this.refreshButtonPos = function(d, f) {
        v.setPosition(b - d, f + c);
        k.setPosition(a, e - f)
    };
    this._onButNextRelease = function() {
        this.unload();
        !1 !== DISABLE_SOUND_MOBILE && !1 !== s_bMobile || createjs.Sound.play("click");
        var a;
        switch (f) {
            case 0:
                a = "argentina";
                break;
            case 1:
                a = "brazil";
                break;
            case 2:
                a = "germany";
                break;
            case 3:
                a = "england";
                break;
            case 4:
                a = "italy";
                break;
            case 5:
                a = "france"
        }
        s_oMain.gotoGame(a)
    };
    s_oSelectTeam = this;
    this._init()
}
var s_oSelectTeam = null;

function CPreloader() {
    var a, e, b, c, f, g, h;
    this._init = function() {
        s_oSpriteLibrary.init(this._onImagesLoaded, this._onAllImagesLoaded, this);
        s_oSpriteLibrary.addSprite("bg_menu", base_url + "assets/frontend/js/game/football/sprites/bg_menu.jpg");
        s_oSpriteLibrary.addSprite("progress_bar", base_url + "assets/frontend/js/game/football/sprites/progress_bar.png");
        s_oSpriteLibrary.loadSprites();
        h = new createjs.Container;
        s_oStage.addChild(h)
    };
    this.unload = function() {
        h.removeAllChildren()
    };
    this.hide = function() {
        var a = this;
        setTimeout(function() {
            createjs.Tween.get(g).to({
                alpha: 1
            }, 500).call(function() {
                a.unload();
                s_oMain.gotoMenu()
            })
        }, 1E3)
    };
    this._onImagesLoaded = function() {};
    this._onAllImagesLoaded = function() {
        this.attachSprites();
        s_oMain.preloaderReady()
    };
    this.attachSprites = function() {
        var d = createBitmap(s_oSpriteLibrary.getSprite("bg_menu"));
        h.addChild(d);
        d = s_oSpriteLibrary.getSprite("progress_bar");
        c = createBitmap(d);
        c.x = CANVAS_WIDTH / 2 - d.width / 2;
        c.y = CANVAS_HEIGHT - 145;
        h.addChild(c);
        a = d.width;
        e = d.height;
        f = new createjs.Shape;
        f.graphics.beginFill("rgba(255,255,255,0.01)").drawRect(c.x, c.y, 1, e);
        h.addChild(f);
        c.mask =
            f;
        b = new createjs.Text("", "30px Arial", "#fff");
        b.x = CANVAS_WIDTH / 2;
        b.y = CANVAS_HEIGHT - 150;
        b.shadow = new createjs.Shadow("#000", 2, 2, 2);
        b.textBaseline = "alphabetic";
        b.textAlign = "center";
        h.addChild(b);
        g = new createjs.Shape;
        g.graphics.beginFill("black").drawRect(0, 0, CANVAS_WIDTH, CANVAS_HEIGHT);
        g.alpha = 0;
        h.addChild(g)
    };
    this.refreshLoader = function(d) {
        b.text = d + "%";
        f.graphics.clear();
        d = Math.floor(d * a / 100);
        f.graphics.beginFill("rgba(255,255,255,0.01)").drawRect(c.x, c.y, d, e)
    };
    this._init()
}

function CPlayer(a) {
    var e, b = null,
        c = null;
    this._init = function() {};
    this.showIdle = function(f, g, h) {
        e = {
            images: [s_oSpriteLibrary.getSprite(h + "_idle")],
            framerate: 10,
            frames: {
                width: PLAYER_WIDTH,
                height: PLAYER_HEIGHT,
                regX: PLAYER_WIDTH / 2,
                regY: PLAYER_WIDTH
            },
            animations: {
                idle: [0, 23, "idle"]
            }
        };
        b = new createjs.SpriteSheet(e);
        null === c ? c = new createjs.Sprite(b, "idle") : c.spriteSheet = b;
        c.x = f;
        c.y = g;
        c.currentAnimationFrame = 0;
        a.addChild(c)
    };
    this.showShot = function(f, g, h) {
        e = {
            images: [s_oSpriteLibrary.getSprite(h + "_shot")],
            framerate: 15,
            frames: {
                width: PLAYER_WIDTH,
                height: PLAYER_HEIGHT,
                regX: PLAYER_WIDTH / 2,
                regY: PLAYER_WIDTH
            },
            animations: {
                idle: [0, 20, "idle"]
            }
        };
        b = new createjs.SpriteSheet(e);
        null === c ? c = new createjs.Sprite(b, "idle") : c.spriteSheet = b;
        c.x = f;
        c.y = g;
        c.currentAnimationFrame = 0;
        a.addChild(c)
    };
    this.changeAlpha = function() {
        c.alpha = .5
    };
    this.getFrame = function() {
        return c.currentFrame
    };
    this.unload = function() {
        a.removeAllChildren()
    };
    s_oPlayer = this;
    this._init(a)
}
s_oPlayer = null;

function CMenu() {
    var a, e, b, c, f, g, h, d;
    this._init = function() {
        f = createBitmap(s_oSpriteLibrary.getSprite("bg_menu"));
        s_oStage.addChild(f);
        var k = s_oSpriteLibrary.getSprite("but_play");
        a = CANVAS_WIDTH / 2 + 300;
        e = CANVAS_HEIGHT - 110;
        g = new CGfxButton(a, e, k);
        g.addEventListener(ON_MOUSE_UP, this._onButPlayRelease, this);
        if (!1 === DISABLE_SOUND_MOBILE || !1 === s_bMobile) k = s_oSpriteLibrary.getSprite("audio_icon"), b = CANVAS_WIDTH - k.height / 2 - 10, c = k.height / 2 + 10, d = new CToggle(b, c, k, s_bAudioActive), d.addEventListener(ON_MOUSE_UP,
            this._onAudioToggle, this);
        h = new createjs.Shape;
        h.graphics.beginFill("black").drawRect(0, 0, CANVAS_WIDTH, CANVAS_HEIGHT);
        s_oStage.addChild(h);
        createjs.Tween.get(h).to({
            alpha: 0
        }, 1E3).call(function() {
            h.visible = !1
        });
        this.refreshButtonPos(s_iOffsetX, s_iOffsetY)
    };
    this.unload = function() {
        g.unload();
        g = null;
        h.visible = !1;
        if (!1 === DISABLE_SOUND_MOBILE || !1 === s_bMobile) d.unload(), d = null;
        s_oStage.removeChild(f);
        s_oMenu = f = null
    };
    this.refreshButtonPos = function(f, h) {
        d.setPosition(b - f, h + c);
        g.setPosition(a, e - h)
    };
    this._onAudioToggle =
        function() {
            createjs.Sound.setMute(s_bAudioActive);
            s_bAudioActive = !s_bAudioActive
        };
    this._onButPlayRelease = function() {
        $(s_oMain).trigger("start_session");
        this.unload();
        !1 !== DISABLE_SOUND_MOBILE && !1 !== s_bMobile || createjs.Sound.play("click");
        s_oMain.gotoSelectTeam()
    };
    s_oMenu = this;
    this._init()
}
var s_oMenu = null;

function CMain(a) {
    var e, b = 0,
        c = 0,
        f = STATE_LOADING,
        g, h, d;
    this.initContainer = function() {
        s_oCanvas = document.getElementById("canvas");
        s_oStage = new createjs.Stage(s_oCanvas);
        s_oStage.preventSelection = !1;
        createjs.Touch.enable(s_oStage);
        s_bMobile = jQuery.browser.mobile;
        !1 === s_bMobile && (s_oStage.enableMouseOver(20), $("body").on("contextmenu", "#canvas", function(a) {
            return !1
        }));
        s_iPrevTime = (new Date).getTime();
        createjs.Ticker.addEventListener("tick", this._update);
        createjs.Ticker.setFPS(30);
        navigator.userAgent.match(/Windows Phone/i) &&
            (DISABLE_SOUND_MOBILE = !0);
        s_oSpriteLibrary = new CSpriteLibrary;
        h = new CPreloader
    };
    this.preloaderReady = function() {
        !1 !== DISABLE_SOUND_MOBILE && !1 !== s_bMobile || this._initSounds();
        this._loadImages();
        e = !0
    };
    this.soundLoaded = function() {
        b++;
        h.refreshLoader(Math.floor(b / c * 100));
        if (b === c) {
            h.unload();
            if (!1 === DISABLE_SOUND_MOBILE || !1 === s_bMobile) s_oCrowd = createjs.Sound.play("crowd", {
                loop: -1
            }), s_oSoundtrack = createjs.Sound.play("soundtrack", {
                loop: -1
            });
            this.gotoMenu()
        }
    };
    this._initSounds = function() {
        createjs.Sound.initializeDefaultPlugins() &&
            (0 < navigator.userAgent.indexOf("Opera") || 0 < navigator.userAgent.indexOf("OPR") ? (createjs.Sound.alternateExtensions = ["mp3"], createjs.Sound.addEventListener("fileload", createjs.proxy(this.soundLoaded, this)), createjs.Sound.registerSound(base_url + "assets/frontend/js/game/football/sounds/soundtrack.ogg", "soundtrack"), createjs.Sound.registerSound(base_url + "assets/frontend/js/game/football/sounds/press_but.ogg", "click"), createjs.Sound.registerSound(base_url + "assets/frontend/js/game/football/sounds/applause.ogg", "applause"), createjs.Sound.registerSound(base_url + "assets/frontend/js/game/football/sounds/crowd.ogg", "crowd"), createjs.Sound.registerSound(base_url + "assets/frontend/js/game/football/sounds/goal.ogg",
                "goal"), createjs.Sound.registerSound(base_url + "assets/frontend/js/game/football/sounds/keeper_save.ogg", "keeper_save"), createjs.Sound.registerSound(base_url + "assets/frontend/js/game/football/sounds/kick.ogg", "kick"), createjs.Sound.registerSound(base_url + "assets/frontend/js/game/football/sounds/miss_goal.ogg", "miss_goal"), createjs.Sound.registerSound(base_url + "assets/frontend/js/game/football/sounds/select_team.ogg", "select_team"), createjs.Sound.registerSound(base_url + "assets/frontend/js/game/football/sounds/game_over.ogg", "game_over"), createjs.Sound.registerSound(base_url + "assets/frontend/js/game/football/sounds/stop_indicator.ogg", "stop_indicator")) : (createjs.Sound.alternateExtensions = ["ogg"], createjs.Sound.addEventListener("fileload",
                createjs.proxy(this.soundLoaded, this)), createjs.Sound.registerSound(base_url + "assets/frontend/js/game/football/sounds/soundtrack.mp3", "soundtrack"), createjs.Sound.registerSound(base_url + "assets/frontend/js/game/football/sounds/press_but.mp3", "click"), createjs.Sound.registerSound(base_url + "assets/frontend/js/game/football/sounds/applause.mp3", "applause"), createjs.Sound.registerSound(base_url + "assets/frontend/js/game/football/sounds/crowd.mp3", "crowd"), createjs.Sound.registerSound(base_url + "assets/frontend/js/game/football/sounds/goal.mp3", "goal"), createjs.Sound.registerSound(base_url + "assets/frontend/js/game/football/sounds/keeper_save.mp3", "keeper_save"), createjs.Sound.registerSound(base_url + "assets/frontend/js/game/football/sounds/kick.mp3", "kick"), createjs.Sound.registerSound(base_url + "assets/frontend/js/game/football/sounds/miss_goal.mp3",
                "miss_goal"), createjs.Sound.registerSound(base_url + "assets/frontend/js/game/football/sounds/select_team.mp3", "select_team"), createjs.Sound.registerSound(base_url + "assets/frontend/js/game/football/sounds/game_over.mp3", "game_over"), createjs.Sound.registerSound(base_url + "assets/frontend/js/game/football/sounds/stop_indicator.mp3", "stop_indicator")), c += 11)
    };
    this._loadImages = function() {
        s_oSpriteLibrary.init(this._onImagesLoaded, this._onAllImagesLoaded, this);
        s_oSpriteLibrary.addSprite("but_play", base_url + "assets/frontend/js/game/football/sprites/but_play.png");
        s_oSpriteLibrary.addSprite("msg_box", base_url + "assets/frontend/js/game/football/sprites/msg_box.png");
        s_oSpriteLibrary.addSprite("but_restart",
            base_url + "assets/frontend/js/game/football/sprites/but_restart.png");
        s_oSpriteLibrary.addSprite("bg_menu", base_url + "assets/frontend/js/game/football/sprites/bg_menu.jpg");
        s_oSpriteLibrary.addSprite("bg_game", base_url + "assets/frontend/js/game/football/sprites/bg_game.jpg");
        s_oSpriteLibrary.addSprite("bg_select_team", base_url + "assets/frontend/js/game/football/sprites/bg_select_team.jpg");
        s_oSpriteLibrary.addSprite("bg_next_level", base_url + "assets/frontend/js/game/football/sprites/bg_next_level.jpg");
        s_oSpriteLibrary.addSprite("bg_win", base_url + "assets/frontend/js/game/football/sprites/bg_win.jpg");
        s_oSpriteLibrary.addSprite("you_win", base_url + "assets/frontend/js/game/football/sprites/you_win.png");
        s_oSpriteLibrary.addSprite("game_over", base_url + "assets/frontend/js/game/football/sprites/game_over.png");
        s_oSpriteLibrary.addSprite("ball_kick_left",
            base_url + "assets/frontend/js/game/football/sprites/ball_kick_left.png");
        s_oSpriteLibrary.addSprite("_oButNext", base_url + "assets/frontend/js/game/football/sprites/arrow.png");
        s_oSpriteLibrary.addSprite("arrow_bar", base_url + "assets/frontend/js/game/football/sprites/arrow_bar.png");
        s_oSpriteLibrary.addSprite("but_continue", base_url + "assets/frontend/js/game/football/sprites/but_continue.png");
        s_oSpriteLibrary.addSprite("but_continue_small", base_url + "assets/frontend/js/game/football/sprites/but_continue_small.png");
        s_oSpriteLibrary.addSprite("argentina", base_url + "assets/frontend/js/game/football/sprites/flag_argentina.png");
        s_oSpriteLibrary.addSprite("brazil", base_url + "assets/frontend/js/game/football/sprites/flag_brazil.png");
        s_oSpriteLibrary.addSprite("germany", base_url + "assets/frontend/js/game/football/sprites/flag_germany.png");
        s_oSpriteLibrary.addSprite("england", base_url + "assets/frontend/js/game/football/sprites/flag_england.png");
        s_oSpriteLibrary.addSprite("italy", base_url + "assets/frontend/js/game/football/sprites/flag_italy.png");
        s_oSpriteLibrary.addSprite("france", base_url + "assets/frontend/js/game/football/sprites/flag_france.png");
        s_oSpriteLibrary.addSprite("goal", base_url + "assets/frontend/js/game/football/sprites/goal.png");
        s_oSpriteLibrary.addSprite("high_bar", base_url + "assets/frontend/js/game/football/sprites/high_bar.png");
        s_oSpriteLibrary.addSprite("right_bar", base_url + "assets/frontend/js/game/football/sprites/right_bar.png");
        s_oSpriteLibrary.addSprite("but_exit", base_url + "assets/frontend/js/game/football/sprites/but_exit.png");
        s_oSpriteLibrary.addSprite("audio_icon", base_url + "assets/frontend/js/game/football/sprites/audio_icon.png");
        s_oSpriteLibrary.addSprite("icon_goal", base_url + "assets/frontend/js/game/football/sprites/icon_goal.png");
        s_oSpriteLibrary.addSprite("icon_kick", base_url + "assets/frontend/js/game/football/sprites/icon_kick.png");
        s_oSpriteLibrary.addSprite("goal_text", base_url + "assets/frontend/js/game/football/sprites/goal_text.png");
        s_oSpriteLibrary.addSprite("missed_text", base_url + "assets/frontend/js/game/football/sprites/missed_text.png");
        s_oSpriteLibrary.addSprite("out_text", base_url + "assets/frontend/js/game/football/sprites/out_text.png");
        s_oSpriteLibrary.addSprite("argentina_idle", base_url + "assets/frontend/js/game/football/sprites/players/argentina_idle.png");
        s_oSpriteLibrary.addSprite("brazil_idle", base_url + "assets/frontend/js/game/football/sprites/players/brazil_idle.png");
        s_oSpriteLibrary.addSprite("germany_idle",
            base_url + "assets/frontend/js/game/football/sprites/players/germany_idle.png");
        s_oSpriteLibrary.addSprite("england_idle", base_url + "assets/frontend/js/game/football/sprites/players/england_idle.png");
        s_oSpriteLibrary.addSprite("italy_idle", base_url + "assets/frontend/js/game/football/sprites/players/italy_idle.png");
        s_oSpriteLibrary.addSprite("france_idle", base_url + "assets/frontend/js/game/football/sprites/players/france_idle.png");
        s_oSpriteLibrary.addSprite("argentina_shot", base_url + "assets/frontend/js/game/football/sprites/players/argentina_shot.png");
        s_oSpriteLibrary.addSprite("brazil_shot", base_url + "assets/frontend/js/game/football/sprites/players/brazil_shot.png");
        s_oSpriteLibrary.addSprite("germany_shot", base_url + "assets/frontend/js/game/football/sprites/players/germany_shot.png");
        s_oSpriteLibrary.addSprite("england_shot", base_url + "assets/frontend/js/game/football/sprites/players/england_shot.png");
        s_oSpriteLibrary.addSprite("italy_shot", base_url + "assets/frontend/js/game/football/sprites/players/italy_shot.png");
        s_oSpriteLibrary.addSprite("france_shot", base_url + "assets/frontend/js/game/football/sprites/players/france_shot.png");
        s_oSpriteLibrary.addSprite("goalkeeper_idle", base_url + "assets/frontend/js/game/football/sprites/players/goalkeeper_idle.png");
        s_oSpriteLibrary.addSprite("goalkeeper_center", base_url + "assets/frontend/js/game/football/sprites/players/goalkeeper_center.png");
        s_oSpriteLibrary.addSprite("goalkeeper_center_high", base_url + "assets/frontend/js/game/football/sprites/players/goalkeeper_center_high.png");
        s_oSpriteLibrary.addSprite("goalkeeper_down_left", base_url + "assets/frontend/js/game/football/sprites/players/goalkeeper_down_left.png");
        s_oSpriteLibrary.addSprite("goalkeeper_down_right", base_url + "assets/frontend/js/game/football/sprites/players/goalkeeper_down_right.png");
        s_oSpriteLibrary.addSprite("goalkeeper_high_left", base_url + "assets/frontend/js/game/football/sprites/players/goalkeeper_high_left.png");
        s_oSpriteLibrary.addSprite("goalkeeper_high_right", base_url + "assets/frontend/js/game/football/sprites/players/goalkeeper_high_right.png");
        s_oSpriteLibrary.addSprite("goalkeeper_med_left", base_url + "assets/frontend/js/game/football/sprites/players/goalkeeper_med_left.png");
        s_oSpriteLibrary.addSprite("goalkeeper_med_right",
            base_url + "assets/frontend/js/game/football/sprites/players/goalkeeper_med_right.png");
        s_oSpriteLibrary.addSprite("wall_idle", base_url + "assets/frontend/js/game/football/sprites/players/wall_idle.png");
        s_oSpriteLibrary.addSprite("wall_jump", base_url + "assets/frontend/js/game/football/sprites/players/wall_jump.png");
        s_oSpriteLibrary.addSprite("ball", base_url + "assets/frontend/js/game/football/sprites/ball.png");
        for (var a = 0; a < NUM_CROWD; a++) s_oSpriteLibrary.addSprite("supporters_" + a, base_url + "assets/frontend/js/game/football/sprites/supporters/supporters_" + a + ".png");
        c += s_oSpriteLibrary.getNumSprites();
        s_oSpriteLibrary.loadSprites()
    };
    this._onImagesLoaded = function() {
        b++;
        h.refreshLoader(Math.floor(b / c *
            100));
        if (b === c) {
            h.unload();
            if (!1 === DISABLE_SOUND_MOBILE || !1 === s_bMobile) s_oSoundtrack = createjs.Sound.play("soundtrack", {
                loop: -1
            });
            this.gotoMenu()
        }
    };
    this._onAllImagesLoaded = function() {};
    this.onAllPreloaderImagesLoaded = function() {
        this._loadImages()
    };
    this.gotoMenu = function() {
        new CMenu;
        f = STATE_MENU
    };
    this.gotoSelectTeam = function() {
        new CSelectTeam;
        f = STATE_MENU
    };
    this.gotoGame = function(a) {
    	$(s_oMain).trigger("game_start");
        d = new CGame(g, a);
        f = STATE_GAME
    };
    this.gotoHelp = function() {
        new CHelp;
        f = STATE_HELP
    };
    this.stopUpdate = function() {
        e = !1;
        createjs.Ticker.paused = !0;
        $("#block_game").css("display", "block")
    };
    this.startUpdate = function() {
        s_iPrevTime = (new Date).getTime();
        e = !0;
        createjs.Ticker.paused = !1;
        $("#block_game").css("display", "none")
    };
    this._update = function(a) {
        if (!1 !== e) {
            var b = (new Date).getTime();
            s_iTimeElaps = b - s_iPrevTime;
            s_iCntTime += s_iTimeElaps;
            s_iCntFps++;
            s_iPrevTime = b;
            1E3 <= s_iCntTime && (s_iCurFps = s_iCntFps, s_iCntTime -= 1E3, s_iCntFps = 0);
            f === STATE_GAME && d.update();
            s_oStage.update(a)
        }
    };
    s_oMain = this;
    g = a;
    this.initContainer()
}
var s_bMobile, s_bAudioActive = !0,
    s_iCntTime = 0,
    s_iTimeElaps = 0,
    s_iPrevTime = 0,
    s_iCntFps = 0,
    s_iCurFps = 0,
    s_iMode, s_szImage, s_bNumActive, s_iTeamSelected = ARGENTINA,
    s_szTeamSelectedSprite = "argentina",
    s_oDrawLayer, s_oStage, s_oMain, s_oSpriteLibrary, s_oSoundtrack, s_oCrowd, s_oCanvas;

function CLevel(a, e, b) {
    var c, f, g = [],
        h = [],
        d = [],
        k = Array(NUM_LEVEL),
        l = Array(NUM_LEVEL),
        m = Array(NUM_LEVEL),
        q, r, t, n, u, v, z = [],
        p = [];
    this._init = function(a, b) {
        a++;
        1 < a && (this.viewNextLevelPanel(), this.refreshButtonPos(s_iOffsetX, s_iOffsetY));
        for (var c = 0; c < NUM_LEVEL; c++) k[c] = Array(NUM_KICK), l[c] = Array(NUM_KICK), m[c] = Array(NUM_KICK);
        g.push({
            goalToScore: 1,
            kickLeft: 5
        });
        g.push({
            goalToScore: 2,
            kickLeft: 5
        });
        g.push({
            goalToScore: 2,
            kickLeft: 5
        });
        g.push({
            goalToScore: 3,
            kickLeft: 5
        });
        g.push({
            goalToScore: 3,
            kickLeft: 5
        });
        g.push({
            goalToScore: 4,
            kickLeft: 5
        });
        h.push({
            x: 430,
            y: 530
        });
        h.push({
            x: 680,
            y: 530
        });
        h.push({
            x: 940,
            y: 530
        });
        d.push({
            x: 380,
            y: 500
        });
        d.push({
            x: 660,
            y: 500
        });
        d.push({
            x: 930,
            y: 500
        });
        k[0][0] = h[0];
        k[0][1] = h[0];
        k[0][2] = h[0];
        k[0][3] = h[0];
        k[0][4] = h[0];
        k[1][0] = h[0];
        k[1][1] = h[0];
        k[1][2] = h[0];
        k[1][3] = h[1];
        k[1][4] = h[1];
        k[2][0] = h[1];
        k[2][1] = h[0];
        k[2][2] = h[0];
        k[2][3] = h[0];
        k[2][4] = h[2];
        k[3][0] = h[1];
        k[3][1] = h[2];
        k[3][2] = h[0];
        k[3][3] = h[1];
        k[3][4] = h[2];
        k[4][0] = h[0];
        k[4][1] = h[1];
        k[4][2] = h[2];
        k[4][3] = h[2];
        k[4][4] = h[2];
        k[5][0] = h[2];
        k[5][1] = h[1];
        k[5][2] =
            h[1];
        k[5][3] = h[1];
        k[5][4] = h[1];
        l[0][0] = d[0];
        l[0][1] = d[0];
        l[0][2] = d[0];
        l[0][3] = d[0];
        l[0][4] = d[0];
        l[1][0] = d[0];
        l[1][1] = d[0];
        l[1][2] = d[0];
        l[1][3] = d[1];
        l[1][4] = d[1];
        l[2][0] = d[1];
        l[2][1] = d[0];
        l[2][2] = d[0];
        l[2][3] = d[0];
        l[2][4] = d[2];
        l[3][0] = d[1];
        l[3][1] = d[2];
        l[3][2] = d[0];
        l[3][3] = d[1];
        l[3][4] = d[2];
        l[4][0] = d[0];
        l[4][1] = d[1];
        l[4][2] = d[2];
        l[4][3] = d[2];
        l[4][4] = d[2];
        l[5][0] = d[2];
        l[5][1] = d[1];
        l[5][2] = d[1];
        l[5][3] = d[1];
        l[5][4] = d[1];
        p.push({
            x: 0,
            y: 0,
            num: 0
        });
        p.push({
            x: 525,
            y: CANVAS_HEIGHT / 2 - 25,
            num: 1
        });
        p.push({
            x: 750,
            y: CANVAS_HEIGHT / 2 - 25,
            num: 1
        });
        p.push({
            x: 525,
            y: CANVAS_HEIGHT / 2 - 25,
            num: 2
        });
        p.push({
            x: 750,
            y: CANVAS_HEIGHT / 2 - 25,
            num: 2
        });
        p.push({
            x: 525,
            y: CANVAS_HEIGHT / 2 - 25,
            num: 1
        });
        p.push({
            x: 525,
            y: CANVAS_HEIGHT / 2 - 25,
            num: 1
        });
        p.push({
            x: 525,
            y: CANVAS_HEIGHT / 2 - 25,
            num: 3
        });
        p.push({
            x: 525,
            y: CANVAS_HEIGHT / 2 - 25,
            num: 2
        });
        m[0][0] = p[0];
        m[0][1] = p[0];
        m[0][2] = p[0];
        m[0][3] = p[0];
        m[0][4] = p[0];
        m[1][0] = p[1];
        m[1][1] = p[1];
        m[1][2] = p[1];
        m[1][3] = p[2];
        m[1][4] = p[2];
        m[2][0] = p[4];
        m[2][1] = p[3];
        m[2][2] = p[2];
        m[2][3] = p[2];
        m[2][4] = p[2];
        m[3][0] = p[2];
        m[3][1] =
            p[1];
        m[3][2] = p[1];
        m[3][3] = p[5];
        m[3][4] = p[1];
        m[4][0] = p[1];
        m[4][1] = p[2];
        m[4][2] = p[2];
        m[4][3] = p[6];
        m[4][4] = p[6];
        m[5][0] = p[5];
        m[5][1] = p[2];
        m[5][2] = p[7];
        m[5][3] = p[5];
        m[5][4] = p[1]
    };
    this._onButContinueRelease = function() {
        this.unload();
        !1 !== DISABLE_SOUND_MOBILE && !1 !== s_bMobile || createjs.Sound.play("click");
        s_oGame.setLevelInfo()
    };
    this.getLevel = function(a) {
        return a
    };
    this.getPlayerPosIndex = function(a, b) {
        if (l[a][b] === d[0]) return 0;
        if (l[a][b] === d[1]) return 1;
        if (l[a][b] === d[2]) return 2
    };
    this.getBallPosition = function(a,
        b) {
        return k[a][b]
    };
    this.getPlayerPosition = function(a, b) {
        return l[a][b]
    };
    this.getWallPosition = function(a, b) {
        return m[a][b]
    };
    this.getLevelInfo = function(a) {
        return g[a]
    };
    this.viewNextLevelPanel = function() {
        $(s_oMain).trigger("end_level");
        var a = 0;
        r = createBitmap(s_oSpriteLibrary.getSprite("bg_next_level"));
        b.addChild(r);
        var d = s_oSpriteLibrary.getSprite("but_continue");
        c = CANVAS_WIDTH / 2 + 300;
        f = CANVAS_HEIGHT - 150;
        q = new CGfxButton(c, f, d);
        q.addEventListener(ON_MOUSE_UP, this._onButContinueRelease, this);
        t = new createjs.Text("CONGRATULATIONS!! ",
            " 60px " + TEXT, "#000000");
        t.x = CANVAS_WIDTH / 2 - 350;
        t.y = 175;
        t.textAlign = "left";
        t.textBaseline = "alphabetic";
        t.lineWidth = 650;
        t.outline = 3;
        b.addChild(t);
        n = new createjs.Text("CONGRATULATIONS!! ", " 60px " + TEXT, "#ffe51f");
        n.x = CANVAS_WIDTH / 2 - 350;
        n.y = 175;
        n.textAlign = "left";
        n.textBaseline = "alphabetic";
        n.lineWidth = 650;
        b.addChild(n);
        u = new createjs.Text("GOAL SCORED: ", " 40px " + TEXT, "#000000");
        u.x = CANVAS_WIDTH / 2 - 300;
        u.y = 275;
        u.textAlign = "left";
        u.textBaseline = "alphabetic";
        u.lineWidth = 650;
        u.outline = 3;
        b.addChild(u);
        v =
            new createjs.Text("GOAL SCORED: ", " 40px " + TEXT, "#ffe51f");
        v.x = CANVAS_WIDTH / 2 - 300;
        v.y = 275;
        v.textAlign = "left";
        v.textBaseline = "alphabetic";
        v.lineWidth = 650;
        b.addChild(v);
        for (d = 0; d < e; d++, a += 26) z.push(createBitmap(s_oSpriteLibrary.getSprite("ball_kick_left"))), z[d].x = CANVAS_WIDTH / 2 + 50 + a, z[d].y = 250, b.addChild(z[d])
    };
    this.refreshButtonPos = function(a, b) {
        q.setPosition(c, f - b)
    };
    this.unload = function() {
        q.unload();
        q = null;
        s_oStage.removeChild(b);
        r = null
    };
    this._init(a, e)
}
TEXT_SCORE = "SCORE: ";
TEXT_PAUSE = "PAUSE";
HELP_TEXT_DESKTOP = "PRESS SPACEBAR TO CHOSE POINT WHERE KICKING BALL ON HORIZONTAL AND VERTICAL AXIS!!";
HELP_TEXT_MOBILE = "TAP ON THE SCREEN TO CHOSE POINT WHERE KICKING BALL ON HORIZONTAL AND VERTICAL AXIS!!";
HELP_TEXT = "TRY TO BE QUICK! THE BONUS MULTIPLIER DECREASES RAPIDLY EACH SECOND. EVERY GOAL INCREASES YOUR SCORE, MULTIPLYING IT BY THE MULTIPLIER!";
TEXT_SHARE_IMAGE = "200x200.jpg";
TEXT_SHARE_TITLE = "Congratulations!";
TEXT_SHARE_MSG1 = "You collected <strong>";
TEXT_SHARE_MSG2 = " points</strong>!<br><br>Share your score with your friends!";
TEXT_SHARE_SHARE1 = "My score is ";
TEXT_SHARE_SHARE2 = " points! Can you do better";

function CInterface(a) {
    var e, b, c, f;

    function g(a) {
        a || (a = window.event);
        switch (a.keyCode) {
            case SPACE_BAR:
                return P._handleClick(), a.preventDefault(), !1;
            case LEFT:
                return a.preventDefault(), !1;
            case UP:
                return a.preventDefault(), !1;
            case RIGHT:
                return a.preventDefault(), !1;
            case DOWN:
                return a.preventDefault(), !1
        }
    }
    var h, d, k, l, m, q, r, t, n, u, v, z, p = CANVAS_WIDTH / 2 - 350,
        G = CANVAS_WIDTH / 2 - 300,
        A = CANVAS_HEIGHT - 20,
        x = CANVAS_WIDTH / 2 + 180,
        L = CANVAS_HEIGHT - 45,
        M = CANVAS_WIDTH / 2 - 10,
        C = CANVAS_HEIGHT - 20,
        D = CANVAS_WIDTH / 2 - 80,
        N = CANVAS_HEIGHT -
        50,
        I = CANVAS_WIDTH / 2 + 100,
        R = CANVAS_HEIGHT - 50,
        P = this,
        O = 0,
        H = 0,
        w, E, J = !0,
        y = 0,
        F;
    this._init = function() {
        y = 0;
        var k = s_oSpriteLibrary.getSprite("but_exit");
        c = CANVAS_WIDTH - k.height / 2 - 10;
        f = k.height / 2 + 10;
        d = new CGfxButton(c, f, k, s_oStage);
        d.addEventListener(ON_MOUSE_UP, this._onExit, this);
        e = CANVAS_WIDTH - k.width / 2 - 90;
        b = k.height / 2 + 10;
        if (!1 === DISABLE_SOUND_MOBILE || !1 === s_bMobile) k = s_oSpriteLibrary.getSprite("audio_icon"), h = new CToggle(e, b, k, s_bAudioActive), h.addEventListener(ON_MOUSE_UP, this._onAudioToggle, this);
        l = new createjs.Container;
        s_oStage.addChild(l);
        k = TOP_BARX / RANGE_WIDTH;
        w = new CShotIndicatorController(k, !1);
        k = RIGHT_BARY / RANGE_HEIGHT;
        E = new CShotIndicatorController(k, !0);
        for (k = 0; k < a; k++) w.increaseSpeed(), E.increaseSpeed();
        F = new createjs.Shape;
        F.graphics.beginFill("Black").drawRect(0, 160, CANVAS_WIDTH, CANVAS_HEIGHT - 160);
        F.alpha = .01;
        s_oStage.addChild(F);
        F.on("mousedown", this._handleClick, this);
        s_bMobile || (document.onkeydown = g);
        this.controlState()
    };
    this._handleClick = function(a) {
        if (!0 === J) switch (y) {
            case 0:
                !1 !== DISABLE_SOUND_MOBILE &&
                    !1 !== s_bMobile || createjs.Sound.play("stop_indicator");
                w.endAnimation();
                O = w.getPositionBallEnd();
                y++;
                P.controlState();
                break;
            case 1:
                !1 !== DISABLE_SOUND_MOBILE && !1 !== s_bMobile || createjs.Sound.play("stop_indicator"), E.endAnimation(), H = E.getPositionBallEnd(), y++, P.controlState()
        }
    };
    this.controlState = function() {
        switch (y) {
            case 0:
                w.startAnimation();
                break;
            case 1:
                E.startAnimation();
                break;
            case 2:
                w.hide(), E.hide(), s_oGame.animatePlayer(O, H)
        }
    };
    this.viewScoreBonus = function(a, b) {
        1 === b ? (t = new createjs.Text("BONUS x " +
            a, " 25px " + TEXT, "#000000"), t.x = p, t.y = 50, t.textAlign = "left", t.textBaseline = "alphabetic", t.lineWidth = 650, t.outline = 3, s_oStage.addChild(t), r = new createjs.Text("BONUS x " + a, " 25px " + TEXT, "#ffffff"), r.x = p, r.y = 50, r.textAlign = "left", r.textBaseline = "alphabetic", r.lineWidth = 650, s_oStage.addChild(r)) : (t.text = "BONUS x " + a, r.text = "BONUS x " + a)
    };
    this.viewScore = function(a) {
        q = new createjs.Text("SCORE: " + a, " 25px " + TEXT, "#000000");
        q.x = G;
        q.y = A;
        q.textAlign = "left";
        q.textBaseline = "alphabetic";
        q.lineWidth = 650;
        q.outline =
            3;
        s_oStage.addChild(q);
        m = new createjs.Text("SCORE: " + a, " 25px " + TEXT, "#ffffff");
        m.x = G;
        m.y = A;
        m.textAlign = "left";
        m.textBaseline = "alphabetic";
        m.lineWidth = 650;
        s_oStage.addChild(m)
    };
    this.viewGoalScored = function(a, b) {
        z = createBitmap(s_oSpriteLibrary.getSprite("icon_goal"));
        z.x = D;
        z.y = N;
        s_oStage.addChild(z);
        u = new createjs.Text(a + "/" + b, " 25px " + TEXT, "#000000");
        u.x = M;
        u.y = C;
        u.textAlign = "left";
        u.textBaseline = "alphabetic";
        u.lineWidth = 650;
        u.outline = 3;
        s_oStage.addChild(u);
        n = new createjs.Text(a + "/" + b, " 25px " + TEXT,
            "#ffffff");
        n.x = M;
        n.y = C;
        n.textAlign = "left";
        n.textBaseline = "alphabetic";
        n.lineWidth = 650;
        s_oStage.addChild(n)
    };
    this.viewKickLeft = function(a) {
        var b, c = 0;
        l.removeAllChildren();
        l.y = R;
        v = createBitmap(s_oSpriteLibrary.getSprite("icon_kick"));
        v.x = I;
        v.y = 0;
        l.addChild(v);
        for (var d = 0; d < a; d++, c += 26) b = createBitmap(s_oSpriteLibrary.getSprite("ball_kick_left")), b.x = x + c, b.y = 0, l.addChild(b)
    };
    this.unload = function() {
        if (!1 === DISABLE_SOUND_MOBILE || !1 === s_bMobile) h.unload(), h = null;
        d.unload();
        s_oInterface = null
    };
    this.help = function() {
        J = !1;
        k = new createjs.Container;
        s_oStage.addChild(k);
        var a = createBitmap(s_oSpriteLibrary.getSprite("msg_box"));
        a.x = CANVAS_WIDTH / 2;
        a.y = CANVAS_HEIGHT / 2;
        a.regX = MSG_BOX_WIDTH / 2;
        a.regY = MSG_BOX_HEIGHT / 2;
        k.addChild(a);
        a = !1 === s_bMobile ? new createjs.Text(HELP_TEXT_DESKTOP, " 25px " + TEXT, "#ffffff") : new createjs.Text(HELP_TEXT_MOBILE, " 25px " + TEXT, "#ffffff");
        a.x = CANVAS_WIDTH / 2;
        a.y = 180;
        a.textAlign = "center";
        a.textBaseline = "alphabetic";
        a.lineWidth = 650;
        k.addChild(a);
        a = createBitmap(s_oSpriteLibrary.getSprite("high_bar"));
        a.x = CANVAS_WIDTH / 2;
        a.y = 300;
        a.regX = TOP_BARX / 2;
        a.regY = TOP_BARY / 2;
        a.scaleX = .8;
        a.scaleY = .8;
        k.addChild(a);
        a = createBitmap(s_oSpriteLibrary.getSprite("arrow_bar"));
        a.x = CANVAS_WIDTH / 2 - 130;
        a.y = 290;
        a.regX = CURSOR_X / 2;
        a.regY = CURSOR_Y / 2;
        a.scaleX = .8;
        a.scaleY = .8;
        k.addChild(a);
        a = new createjs.Text(HELP_TEXT, " 25px " + TEXT, "#ffffff");
        a.x = CANVAS_WIDTH / 2;
        a.y = 380;
        a.textAlign = "center";
        a.textBaseline = "alphabetic";
        a.lineWidth = 650;
        k.addChild(a);
        k.on("mousedown", this._onButHelpRelease)
    };
    this.refreshButtonPos = function(a, g) {
        d.setPosition(c -
            a, g + f);
        !1 !== DISABLE_SOUND_MOBILE && !1 !== s_bMobile || h.setPosition(e - a, g + b);
        t.y = 50 + g;
        r.y = 50 + g;
        q.y = A - g;
        m.y = A - g;
        u.y = C - g;
        n.y = C - g;
        z.y = N - g;
        l.y = L - g
    };
    this._onButHelpRelease = function() {
        s_oStage.removeChild(k);
        k.off("mousedown", this._onButHelpRelease);
        J = !0;
        s_oGame.setUpdate()
    };
    this._onButRestartRelease = function() {
        s_oGame.restartGame()
    };
    this.onExitFromHelp = function() {
        null.unload()
    };
    this._onAudioToggle = function() {
        createjs.Sound.setMute(s_bAudioActive);
        s_bAudioActive = !s_bAudioActive
    };
    this._onExit = function() {
        s_oGame.onExit()
    };
    s_oInterface = this;
    this._init();
    return this
}
var s_oInterface = null;

function CGoalKeeper(a) {
    var e, b = null,
        c = null;
    this._init = function() {};
    this.showIdle = function(f, g) {
        e = {
            images: [s_oSpriteLibrary.getSprite("goalkeeper_idle")],
            framerate: 15,
            frames: {
                width: GOALKEEPER_WIDTH,
                height: GOALKEEPER_HEIGHT,
                regX: GOALKEEPER_WIDTH / 2,
                regY: GOALKEEPER_WIDTH
            },
            animations: {
                idle: [0, 19, "idle"]
            }
        };
        b = new createjs.SpriteSheet(e);
        null === c ? c = new createjs.Sprite(b, "idle") : c.spriteSheet = b;
        c.x = f;
        c.y = g;
        a.addChild(c);
        c.gotoAndPlay("idle")
    };
    this.showAction = function(f, g, h, d, k, l) {
        e = {
            images: [s_oSpriteLibrary.getSprite("goalkeeper_" +
                h)],
            framerate: 15,
            frames: {
                width: k,
                height: l,
                regX: k / 2,
                regY: l
            },
            animations: {
                idle: [0, d]
            }
        };
        b = new createjs.SpriteSheet(e);
        null === c ? c = new createjs.Sprite(b, "idle") : c.spriteSheet = b;
        c.x = f;
        c.y = g;
        a.addChild(c);
        c.gotoAndPlay("idle")
    };
    this.stop = function() {
        c.paused = !0
    };
    this.getFrame = function() {
        return c.currentFrame
    };
    this.unload = function() {
        a.removeAllChildren()
    };
    s_oPlayer = this;
    this._init(a)
}
s_oPlayer = null;

function CGoal(a, e, b) {
    var c;
    this._init = function(a, b, e) {
        c = createBitmap(s_oSpriteLibrary.getSprite("goal"));
        c.x = a;
        c.y = b;
        c.regX = GOAL_WIDTH / 2;
        c.regY = GOAL_HEIGHT / 2;
        e.addChild(c)
    };
    this._init(a, e, b)
}
s_oBatter = null;