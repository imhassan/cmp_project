                 
    <script type="text/javascript">
        var base_url = "<?php echo base_url();?>";
        var score_calc = false;
    </script>
    <script type="text/javascript" src="<?= base_url() ?>assets/frontend/js/game/bowling/createjs-2015.11.26.min.js?v=1.2"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/frontend/js/game/bowling/ctl_utils.js?v=1.2"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/frontend/js/game/bowling/sprite_lib.js?v=1.2"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/frontend/js/game/bowling/settings.js?v=1.2"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/frontend/js/game/bowling/CLang.js?v=1.2"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/frontend/js/game/bowling/CPreloader.js?v=1.2"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/frontend/js/game/bowling/CMain.js?v=1.2"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/frontend/js/game/bowling/CTextButton.js?v=1.2"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/frontend/js/game/bowling/CToggle.js?v=1.2"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/frontend/js/game/bowling/CGfxButton.js?v=1.2"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/frontend/js/game/bowling/CMenu.js?v=1.2"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/frontend/js/game/bowling/CGame.js?v=1.2"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/frontend/js/game/bowling/CInterface.js?v=1.2"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/frontend/js/game/bowling/CHelpPanel.js?v=1.2"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/frontend/js/game/bowling/cannon.js?v=1.2"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/frontend/js/game/bowling/cannon.demo.js?v=1.2"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/frontend/js/game/bowling/CBall.js?v=1.2"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/frontend/js/game/bowling/CScenario.js?v=1.2"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/frontend/js/game/bowling/Three.js?v=1.2"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/frontend/js/game/bowling/Detector.js?v=1.2"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/frontend/js/game/bowling/smoothie.js?v=1.2"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/frontend/js/game/bowling/Stats.js?v=1.2"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/frontend/js/game/bowling/TrackballControls.js?v=1.2"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/frontend/js/game/bowling/dat.gui.js?v=1.2"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/frontend/js/game/bowling/CAreYouSurePanel.js?v=1.2"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/frontend/js/game/bowling/CCreditsPanel.js?v=1.2"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/frontend/js/game/bowling/CPin.js?v=1.2"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/frontend/js/game/bowling/CPowerBar.js?v=1.2"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/frontend/js/game/bowling/CTurnsBoard.js?v=1.2"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/frontend/js/game/bowling/CTurnBoard.js?v=1.2"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/frontend/js/game/bowling/CTrack.js?v=1.2"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/frontend/js/game/bowling/CEffectArray.js?v=1.2"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/frontend/js/game/bowling/CCharacter.js?v=1.2"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/frontend/js/game/bowling/CAnimMonitor.js?v=1.2"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/frontend/js/game/bowling/CPinDragger.js?v=1.2"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/frontend/js/game/bowling/CSemaphore.js?v=1.2"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/frontend/js/game/bowling/CTotalScoreBoard.js?v=1.2"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/frontend/js/game/bowling/CEndPanel.js?v=1.2"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/frontend/js/game/bowling/CController.js?v=1.2"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/frontend/js/game/bowling/FBXLoader.js?v=1.2"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/frontend/js/game/bowling/TransformControls.js?v=1.2"></script>
                <div class="content-wrapper " data-equalizer data-equalize-on="medium">
                    <div class="row game-container" data-equalizer-watch>
                        <div class="columns small-12">
                            <script>
                            $(document).ready(function() {
                                var oMain = new CMain({
                                    time_power_bar: 750, // TIME FOR FILL POWER BAR IN MILLISECONDS
                                    speed_effect_arrow: 60, //ANIMATION SPEED OF EFFECT ARROW IN FRAME PER SECONDS
                                    num_levels_for_ads: 1 //NUMBER OF TURNS PLAYED BEFORE AD SHOWING //
                                        //////// THIS FEATURE  IS ACTIVATED ONLY WITH CTL ARCADE PLUGIN./////////////////////////// 
                                        /////////////////// YOU CAN GET IT AT: ///////////////////////////////////////////////////////// 
                                        // http://codecanyon.net/item/ctl-arcade-wordpress-plugin/13856421 ///////////
                                });
                                $(oMain).on("game_start", function(evt) {
                                    console.log("game_start");
                                    if (getParamValue('ctl-arcade') === "true") {
                                        parent.__ctlArcadeStartSession();
                                    }
                                    $.post( base_url+"game/update_score/", {score: 0, game_life:1}, function(data) {
                                        console.log(data);
                                    });
                                });
                                $(oMain).on("start_session", function(evt) {
                                    if (getParamValue('ctl-arcade') === "true") {
                                        parent.__ctlArcadeStartSession();
                                    }
                                });

                                $(oMain).on("end_session", function(evt) {
                                    console.log("end_session");
                                    if (getParamValue('ctl-arcade') === "true") {
                                        parent.__ctlArcadeEndSession();
                                    }
                                    console.log("Home button clicked");
                                    window.location = base_url;
                                });

                                $(oMain).on("start_level", function(evt, iLevel) {
                                    if (getParamValue('ctl-arcade') === "true") {
                                        parent.__ctlArcadeStartLevel({
                                            level: iLevel
                                        });
                                    }
                                });

                                $(oMain).on("restart_level", function(evt, iLevel) {
                                    if (getParamValue('ctl-arcade') === "true") {
                                        parent.__ctlArcadeRestartLevel({
                                            level: iLevel
                                        });
                                    }
                                });

                                $(oMain).on("end_level", function(evt, iLevel) {
                                    if (getParamValue('ctl-arcade') === "true") {
                                        parent.__ctlArcadeEndLevel({
                                            level: iLevel
                                        });
                                    }
                                });

                                $(oMain).on("save_score", function(evt, iScore, szMode) {
                                    console.log("iScore: "+iScore);
                                    if (getParamValue('ctl-arcade') === "true") {
                                        parent.__ctlArcadeSaveScore({
                                            score: iScore,
                                            mode: szMode
                                        });
                                    }

                                    $.post( base_url+"game/update_score/", {score: iScore, game_life:0}, function(data) {
                                        console.log(data);
                                        score_calc = true;
                                    });
                                });

                                $(oMain).on("show_interlevel_ad", function(evt) {
                                    if (getParamValue('ctl-arcade') === "true") {
                                        parent.__ctlArcadeShowInterlevelAD();
                                    }
                                });

                                $(oMain).on("share_event", function(evt, iScore) {
                                    if (getParamValue('ctl-arcade') === "true") {
                                        parent.__ctlArcadeShareEvent({
                                            img: TEXT_SHARE_IMAGE,
                                            title: TEXT_SHARE_TITLE,
                                            msg: TEXT_SHARE_MSG1 + iScore + TEXT_SHARE_MSG2,
                                            msg_share: TEXT_SHARE_SHARE1 + iScore + TEXT_SHARE_SHARE1
                                        });
                                    }
                                });


                                if (isIOS()) {
                                    setTimeout(function() {
                                        sizeHandler();
                                    }, 200);
                                } else {
                                    sizeHandler();
                                }
                            });
                            </script>
                            <canvas id="canvas" class='ani_hack bowling-game' width="790" height="1410"> </canvas>
       
                        </div>
                    </div>
                    <div class="game-sidebar" data-equalizer-watch>
                        <div class="live-box">
                            <h4><?=$user_data['game_life']?> x</h4><img src="<?= base_url() ?>assets/frontend/images/life.png">
                        </div>
                        <div class="back-container">
                            <a href="<?php echo base_url();?>" class="button-sytle1">BACK</a>
                            <h3>The Points You Earn Will Only Be Added To Your Account If You Play Till The End Of The Game </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="reveal" id="exampleModal1" data-reveal>
        <div class="modal-head">
            <h4>You Need Lives To Play</h4>
        </div>
        <div class="modal-body">
            <h3>Take Bible Quiz To Earn Lives And Continue Playing</h3>
            <a href="#" class="button-sytle1">Start Bible Quiz</a>
        </div>
        <!-- <button class="close-button" data-close aria-label="Close modal" type="button">
            <span aria-hidden="true">&times;</span>
        </button> -->
    </div>