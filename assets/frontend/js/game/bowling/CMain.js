function CMain(oData) {
    var _bUpdate;
    var _iCurResource = 0;
    var RESOURCE_TO_LOAD = 0;
    var _iState = STATE_LOADING;
    var _oData;

    var _oPreloader;
    var _oMenu;
    var _oHelp;
    var _oGame;

    this.initContainer = function () {
        var canvas = document.getElementById("canvas");
        s_oStage = new createjs.Stage(canvas);
        createjs.Touch.enable(s_oStage);
        s_oStage.preventSelection = false;

        s_bMobile = jQuery.browser.mobile;
        if (s_bMobile === false) {
            s_oStage.enableMouseOver(20);
            $('body').on('contextmenu', '#canvas', function (e) {
                return false;
            });
            FPS = FPS_DESKTOP;
            FPS_TIME = 1 / FPS;
            BUFFER_ANIM_MONITOR = 20 * (FPS / 30);
            PHYSICS_STEP = 1 / (FPS * STEP_RATE);
            ROLL_BALL_RATE = 60 / FPS;
        } else {
            BALL_VELOCITY_MULTIPLIER = 0.8;
        }

        s_iPrevTime = new Date().getTime();

        createjs.Ticker.addEventListener("tick", this._update);
        createjs.Ticker.setFPS(FPS);

        if (navigator.userAgent.match(/Windows Phone/i)) {
            DISABLE_SOUND_MOBILE = true;
        }

        s_oSpriteLibrary = new CSpriteLibrary();

        //ADD PRELOADER
        _oPreloader = new CPreloader();

        _bUpdate = true;
    };

    this.soundLoaded = function () {
        _iCurResource++;
        var iPerc = Math.floor(_iCurResource / RESOURCE_TO_LOAD * 100);
        _oPreloader.refreshLoader(iPerc);

        if (_iCurResource === RESOURCE_TO_LOAD) {
            _oPreloader.unload();

            if (DISABLE_SOUND_MOBILE === false || s_bMobile === false) {
                s_oSoundTrack = createjs.Sound.play("soundtrack", {loop: -1});
            }
            this.gotoMenu();
        }
    };

    this._initSounds = function () {
        if (!createjs.Sound.initializeDefaultPlugins()) {
            return;
        }

        if (navigator.userAgent.indexOf("Opera") > 0 || navigator.userAgent.indexOf("OPR") > 0) {
            createjs.Sound.alternateExtensions = ["mp3"];
            createjs.Sound.addEventListener("fileload", createjs.proxy(this.soundLoaded, this));

            createjs.Sound.registerSound(base_url+"assets/frontend/js/game/bowling/sounds/click.ogg", "click");
            createjs.Sound.registerSound(base_url+"assets/frontend/js/game/bowling/sounds/ball_hitting.ogg", "ball_hitting");
            createjs.Sound.registerSound(base_url+"assets/frontend/js/game/bowling/sounds/soundtrack.ogg", "soundtrack");
            createjs.Sound.registerSound(base_url+"assets/frontend/js/game/bowling/sounds/ball_crash.ogg", "ball_crash");
            createjs.Sound.registerSound(base_url+"assets/frontend/js/game/bowling/sounds/binder.ogg", "binder");
            createjs.Sound.registerSound(base_url+"assets/frontend/js/game/bowling/sounds/pin_hitted.ogg", "pin_hitted");
            createjs.Sound.registerSound(base_url+"assets/frontend/js/game/bowling/sounds/gingle_gutterball.ogg", "gingle_gutterball");
            createjs.Sound.registerSound(base_url+"assets/frontend/js/game/bowling/sounds/gingle_spare.ogg", "gingle_spare");
            createjs.Sound.registerSound(base_url+"assets/frontend/js/game/bowling/sounds/gingle_strike.ogg", "gingle_strike");
            createjs.Sound.registerSound(base_url+"assets/frontend/js/game/bowling/sounds/ambience.ogg", "ambience");

        } else {
            createjs.Sound.alternateExtensions = ["ogg"];
            createjs.Sound.addEventListener("fileload", createjs.proxy(this.soundLoaded, this));

            createjs.Sound.registerSound(base_url+"assets/frontend/js/game/bowling/sounds/click.mp3", "click");
            createjs.Sound.registerSound(base_url+"assets/frontend/js/game/bowling/sounds/ball_hitting.mp3", "ball_hitting");
            createjs.Sound.registerSound(base_url+"assets/frontend/js/game/bowling/sounds/soundtrack.mp3", "soundtrack");
            createjs.Sound.registerSound(base_url+"assets/frontend/js/game/bowling/sounds/ball_crash.mp3", "ball_crash");
            createjs.Sound.registerSound(base_url+"assets/frontend/js/game/bowling/sounds/binder.mp3", "binder");
            createjs.Sound.registerSound(base_url+"assets/frontend/js/game/bowling/sounds/pin_hitted.mp3", "pin_hitted");
            createjs.Sound.registerSound(base_url+"assets/frontend/js/game/bowling/sounds/gingle_gutterball.mp3", "gingle_gutterball");
            createjs.Sound.registerSound(base_url+"assets/frontend/js/game/bowling/sounds/gingle_spare.mp3", "gingle_spare");
            createjs.Sound.registerSound(base_url+"assets/frontend/js/game/bowling/sounds/gingle_strike.mp3", "gingle_strike");
            createjs.Sound.registerSound(base_url+"assets/frontend/js/game/bowling/sounds/ambience.mp3", "ambience");

        }

        RESOURCE_TO_LOAD += 10;

    };

    this._loadImages = function () {
        s_oSpriteLibrary.init(this._onImagesLoaded, this._onAllImagesLoaded, this);

        s_oSpriteLibrary.addSprite("but_play", base_url+"assets/frontend/js/game/bowling/sprites/but_play.png");
        s_oSpriteLibrary.addSprite("but_exit", base_url+"assets/frontend/js/game/bowling/sprites/but_exit.png");
        s_oSpriteLibrary.addSprite("bg_menu", base_url+"assets/frontend/js/game/bowling/sprites/bg_menu.jpg");
        s_oSpriteLibrary.addSprite("msg_box", base_url+"assets/frontend/js/game/bowling/sprites/msg_box.png");
        s_oSpriteLibrary.addSprite("audio_icon", base_url+"assets/frontend/js/game/bowling/sprites/audio_icon.png");
        s_oSpriteLibrary.addSprite("but_home", base_url+"assets/frontend/js/game/bowling/sprites/but_home.png");
        s_oSpriteLibrary.addSprite("but_restart", base_url+"assets/frontend/js/game/bowling/sprites/but_restart.png");
        s_oSpriteLibrary.addSprite("ball", base_url+"assets/frontend/js/game/bowling/sprites/ball.png");
        s_oSpriteLibrary.addSprite("but_continue", base_url+"assets/frontend/js/game/bowling/sprites/but_continue.png");
        s_oSpriteLibrary.addSprite("but_yes", base_url+"assets/frontend/js/game/bowling/sprites/but_yes.png");
        s_oSpriteLibrary.addSprite("but_no", base_url+"assets/frontend/js/game/bowling/sprites/but_no.png");
        s_oSpriteLibrary.addSprite("but_info", base_url+"assets/frontend/js/game/bowling/sprites/but_info.png");
        s_oSpriteLibrary.addSprite("logo_ctl", base_url+"assets/frontend/js/game/bowling/sprites/logo_ctl.png");
        s_oSpriteLibrary.addSprite("arrow_right", base_url+"assets/frontend/js/game/bowling/sprites/arrow_right.png");
        s_oSpriteLibrary.addSprite("arrow_left", base_url+"assets/frontend/js/game/bowling/sprites/arrow_left.png");
        s_oSpriteLibrary.addSprite("ball_shadow", base_url+"assets/frontend/js/game/bowling/sprites/ball_shadow.png");
        s_oSpriteLibrary.addSprite("pin", base_url+"assets/frontend/js/game/bowling/sprites/pin.png");

        s_oSpriteLibrary.addSprite("ball_ref", base_url+"assets/frontend/js/game/bowling/sprites/ball_ref.png");
        s_oSpriteLibrary.addSprite("bg_help", base_url+"assets/frontend/js/game/bowling/sprites/bg_help.png");

        s_oSpriteLibrary.addSprite("power_bar_bg", base_url+"assets/frontend/js/game/bowling/sprites/power_bar_bg.png");
        s_oSpriteLibrary.addSprite("power_bar_fill", base_url+"assets/frontend/js/game/bowling/sprites/power_bar_fill.png");
        s_oSpriteLibrary.addSprite("power_bar_frame", base_url+"assets/frontend/js/game/bowling/sprites/power_bar_frame.png");
        s_oSpriteLibrary.addSprite("effect_arrow", base_url+"assets/frontend/js/game/bowling/sprites/effect_arrow.png");

        s_oSpriteLibrary.addSprite("key_left", base_url+"assets/frontend/js/game/bowling/sprites/key_left.png");
        s_oSpriteLibrary.addSprite("key_right", base_url+"assets/frontend/js/game/bowling/sprites/key_right.png");

        s_oSpriteLibrary.addSprite("turn_board", base_url+"assets/frontend/js/game/bowling/sprites/turn_board.png");
        s_oSpriteLibrary.addSprite("bowling_track", base_url+"assets/frontend/js/game/bowling/sprites/bowling_track.png");
        s_oSpriteLibrary.addSprite("monitor", base_url+"assets/frontend/js/game/bowling/sprites/monitor.jpg");
        s_oSpriteLibrary.addSprite("pattern_monitor", base_url+"assets/frontend/js/game/bowling/sprites/pattern_monitor.png");

        s_oSpriteLibrary.addSprite("pin_binder", base_url+"assets/frontend/js/game/bowling/sprites/pin_binder.png");
        s_oSpriteLibrary.addSprite("semaphore", base_url+"assets/frontend/js/game/bowling/sprites/semaphore.png");
        s_oSpriteLibrary.addSprite("total_board", base_url+"assets/frontend/js/game/bowling/sprites/total_board.png");
        s_oSpriteLibrary.addSprite("last_turn_board", base_url+"assets/frontend/js/game/bowling/sprites/last_turn_board.png");

        for (var i = 0; i < NUM_SPRITE_MONITOR; i++) {
            s_oSpriteLibrary.addSprite("monitor_strike_" + i, base_url+"assets/frontend/js/game/bowling/sprites/monitor_strike/monitor_strike_" + i + ".jpg");
            s_oSpriteLibrary.addSprite("monitor_spare_" + i, base_url+"assets/frontend/js/game/bowling/sprites/monitor_spare/monitor_spare_" + i + ".jpg");
            s_oSpriteLibrary.addSprite("monitor_gutterball_" + i, base_url+"assets/frontend/js/game/bowling/sprites/monitor_gutterball/monitor_gutterball_" + i + ".jpg");
        }

        for (var i = 0; i < NUM_SPRITE_PLAYER; i++) {
            s_oSpriteLibrary.addSprite("player_" + i, base_url+"assets/frontend/js/game/bowling/sprites/player_anim/player_" + i + ".png");
        }

        RESOURCE_TO_LOAD += s_oSpriteLibrary.getNumSprites();
        s_oSpriteLibrary.loadSprites();
    };

    this._onImagesLoaded = function () {
        _iCurResource++;
        var iPerc = Math.floor(_iCurResource / RESOURCE_TO_LOAD * 100);
        _oPreloader.refreshLoader(iPerc);
        if (_iCurResource === RESOURCE_TO_LOAD) {
            _oPreloader.unload();
            if (DISABLE_SOUND_MOBILE === false || s_bMobile === false) {
                s_oSoundTrack = createjs.Sound.play("soundtrack", {loop: -1});
            }
            this.gotoMenu();
        }
    };

    this._onAllImagesLoaded = function () {

    };

    this.onAllPreloaderImagesLoaded = function () {
        this._loadImages();
    };

    this.preloaderReady = function () {
        if (DISABLE_SOUND_MOBILE === false || s_bMobile === false) {
            this._initSounds();
            s_oSoundTrack = createjs.Sound.play("soundtrack", {loop: -1});
        }

        this._loadImages();
        _bUpdate = true;
    };

    this.gotoMenu = function () {
        _oMenu = new CMenu();
        _iState = STATE_MENU;
    };

    this.gotoGame = function () {
        _oGame = new CGame(_oData);

        _iState = STATE_GAME;
    };

    this.gotoHelp = function () {
        _oHelp = new CHelp();
        _iState = STATE_HELP;
    };

    this.stopUpdate = function () {
        _bUpdate = false;
        createjs.Ticker.paused = true;
        $("#block_game").css("display", "block");
    };

    this.startUpdate = function () {
        s_iPrevTime = new Date().getTime();
        _bUpdate = true;
        createjs.Ticker.paused = false;
        $("#block_game").css("display", "none");
    };

    this._update = function (event) {
        if (_bUpdate === false) {
            return;
        }
        var iCurTime = new Date().getTime();
        s_iTimeElaps = iCurTime - s_iPrevTime;
        s_iCntTime += s_iTimeElaps;
        s_iCntFps++;
        s_iPrevTime = iCurTime;

        if (s_iCntTime >= 1000) {
            s_iCurFps = s_iCntFps;
            s_iCntTime -= 1000;
            s_iCntFps = 0;
        }

        if (_iState === STATE_GAME) {
            _oGame.update();
        }

        s_oStage.update(event);

    };

    s_oMain = this;

    _oData = oData;

    this.initContainer();
}
var s_bMobile;
var s_bAudioActive = true;
var s_iCntTime = 0;
var s_iTimeElaps = 0;
var s_iPrevTime = 0;
var s_iCntFps = 0;
var s_iCurFps = 0;
var s_iCanvasResizeHeight;
var s_iCanvasResizeWidth;
var s_iCanvasOffsetHeight;
var s_iCanvasOffsetWidth;
var s_iAdsLevel = 1;

var s_oDrawLayer;
var s_oStage;
var s_oMain;
var s_oSpriteLibrary;
var s_oSoundTrack;