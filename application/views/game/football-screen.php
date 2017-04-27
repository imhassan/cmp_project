    <script type="text/javascript">
        var base_url = "<?php echo base_url();?>";
        var score_calc = false;
    </script>
    <script type="text/javascript" src="<?= base_url() ?>assets/frontend/js/game/football/createjs-2014.12.12.min.js?v=1.1"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/frontend/js/game/football/main.js?v=1.1"></script>
    <div class="content-wrapper " data-equalizer data-equalize-on="medium">
        <div class="row game-container" data-equalizer-watch>
            <div class="columns small-12">
                <script>
                    $(document).ready(function() {
                        var oMain = new CMain({
                            shot_indicator_spd: 1000, //STARTING TIME IT TAKES THE TOKEN TO GO FROM SIDE TO SIDE OF THE KICKING BAR.  
                            //IT IS EXPRESSED IN MILLISECONDS
                            //INCREASE THIS VALUE IF YOU WANT TO SLOW DOWN THE TOKEN
                            decrease_shot_indicator_spd: 100 //EVERY NEW LEVEL, THE GAME WILL DECREASE THIS AMOUNT FROM THE STARTING TIME ABOVE
                                //DECREAE THIS VALUE TO MAKE THE GAME EASIER
                        });

                        $(oMain).on("game_start", function(evt) {
                            console.log("game_start");                            
                            $.post( base_url+"game/update_score/", {score: 0, game_life:1}, function(data) {
                                console.log(data);
                            });
                        });

                        $(oMain).on("start_session", function(evt) {
                            if (getParamValue('ctl-arcade') === "true") {
                                parent.__ctlArcadeStartSession();
                            }
                            //...ADD YOUR CODE HERE EVENTUALLY
                        });

                        $(oMain).on("end_session", function(evt) {
                            console.log("end_session");
                            if (getParamValue('ctl-arcade') === "true") {
                                parent.__ctlArcadeEndSession();
                            }
                            
                            window.location = base_url;
                        });

                        $(oMain).on("save_score", function(evt, iScore) {
                            console.log("iScore: "+iScore);
                            var my_score = Math.round(iScore/45);
                            $.post( base_url+"game/update_score/", {score: my_score, game_life:0}, function(data) {
                                score_calc = true;
                                console.log(data);
                            });
                            if (getParamValue('ctl-arcade') === "true") {
                                parent.__ctlArcadeSaveScore({
                                    score: iScore
                                });
                            }
                            //...ADD YOUR CODE HERE EVENTUALLY
                        });

                        $(oMain).on("start_level", function(evt, iLevel) {
                            if (getParamValue('ctl-arcade') === "true") {
                                parent.__ctlArcadeStartLevel({
                                    level: iLevel
                                });
                            }
                            //...ADD YOUR CODE HERE EVENTUALLY
                        });

                        $(oMain).on("end_level", function(evt, iLevel) {
                            if (getParamValue('ctl-arcade') === "true") {
                                parent.__ctlArcadeEndLevel({
                                    level: iLevel
                                });
                            }
                            //...ADD YOUR CODE HERE EVENTUALLY
                        });

                        $(oMain).on("show_interlevel_ad", function(evt) {
                            if (getParamValue('ctl-arcade') === "true") {
                                parent.__ctlArcadeShowInterlevelAD();
                            }
                            //...ADD YOUR CODE HERE EVENTUALLY
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
                            $("#canvas").css({
                                width: '95%',
                                height: '95%'
                            });
                        }
                    });
                </script>
                <canvas id="canvas" class="ani_hack football-game" width="1360" height="640" style="width: 95%; height: 95%; top: -80.6667px; left: 34.3333px;"> </canvas>
                <div id="block_game" style="position: fixed; background-color: transparent; top: 0px; left: 0px; width: 100%; height: 100%; display:none"></div>
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