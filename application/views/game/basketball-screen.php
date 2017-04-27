    <script type="text/javascript">
        var base_url = "<?php echo base_url();?>";
        var score_calc = false;
    </script>
    <script type="text/javascript" src="<?= base_url() ?>assets/frontend/js/game/basketball/cannon.min.js?v=1.0"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/frontend/js/game/basketball/createjs-2013.12.12.min.js?v=1.0"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/frontend/js/game/basketball/ctl_utils.js?v=1.0"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/frontend/js/game/basketball/sprite_lib.js?v=1.0"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/frontend/js/game/basketball/settings.js?v=1.0"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/frontend/js/game/basketball/CLang.js?v=1.0"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/frontend/js/game/basketball/CPreloader.js?v=1.0"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/frontend/js/game/basketball/CMain.js?v=1.0"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/frontend/js/game/basketball/CTextButton.js?v=1.0"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/frontend/js/game/basketball/CGfxButton.js?v=1.0"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/frontend/js/game/basketball/CToggle.js?v=1.0"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/frontend/js/game/basketball/CMenu.js?v=1.0"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/frontend/js/game/basketball/CHelpPanel.js?v=1.0"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/frontend/js/game/basketball/CGame.js?v=1.0"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/frontend/js/game/basketball/CBall.js?v=1.0"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/frontend/js/game/basketball/CInterface.js?v=1.0"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/frontend/js/game/basketball/CSceneStatic.js?v=1.0"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/frontend/js/game/basketball/CPlayer.js?v=1.0"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/frontend/js/game/basketball/CEndPanel.js?v=1.0"></script>
    <div class="content-wrapper " data-equalizer data-equalize-on="medium">
        <div class="row game-container" data-equalizer-watch>
            <div class="columns small-12">
                <script>
                    $(document).ready(function() {
                        var oMain = new CMain({
                            errorMultiplier: 1000, //INCREASE/DECREASE (500-1500) THIS VALUE TO INCREASE/DECREASE SHOT DIFFICULTY
                            timeAvailable: 60000, //GAME TIME IN MILLISECONDS
                            selectorSpeed: 15, //SELECTOR SPEED (DECREASE THIS TO GET A EASIER GAME
                            point_per_ball: 1, //POINTS TO ASSIGN WHEN PLAYER SCORES WITH NORMAL BALL
                            point_per_special_ball: 2 //POINTS TO ASSIGN WHEN PLAYER SCORES WITH SPECIAL BALL
                        });

                        $(oMain).on("game_start", function(evt) {
                            console.log("game_start");
                            $.post( base_url+"game/update_score/", {score: 0, game_life: 1}, function(data) {
                                console.log(data);
                            });
                        });

                        $(oMain).on("save_score", function(evt, iScore) {
                            console.log("iScore: "+iScore);
                            var my_score = iScore*10;
                            $.post( base_url+"game/update_score/", {score: my_score, game_life: 0}, function(data) {
                                console.log(data);
                                score_calc = true;
                            });
                        });

                        $(oMain).on("restart", function(evt) {
                            console.log("restart");
                        });

                        $(oMain).on("game_cancel", function(evt) {
                            console.log("game_cancel");
                            window.location = base_url;
                        });
                    });
                </script>
                <canvas id="canvas" class="ani_hack basket-ball-game" width="1024" height="768" style="width: 645.333px; height: 484px; left: 397.333px;"> </canvas>
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