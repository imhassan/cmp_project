<?php $this->load->view('common/header'); ?>                
                <div class="content-wrapper">
                    <div class="row">
                        <div class="columns small-12 medium-8">
                            <div class="columns small-12 zeropadding">
                                <div class="play-now-conatiner">
                                    <div class="play-now-head">
                                        <div class="columns small-12">
                                            <h3>Test Your Religous Knowledge</h3>
                                        </div>
                                    </div>
                                    <div class="games-to-play">
                                        <div class="columns small-12 medium-4">
                                            <div class="game-image"><img src="<?= base_url() ?>assets/frontend/images/basketball.jpg">
                                                <img class="play-game" src="<?= base_url() ?>assets/frontend/images/play-button.svg">
                                                <div class="overlay"></div>
                                            </div>
                                            <h4>Basketball</h4>
                                        </div>
                                        <div class="columns small-12 medium-4">
                                            <div class="game-image"><img src="<?= base_url() ?>assets/frontend/images/golf.jpg">
                                                <img class="play-game" src="<?= base_url() ?>assets/frontend/images/play-button.svg">
                                                <div class="overlay"></div>
                                            </div>
                                            <h4>Football</h4>
                                        </div>
                                        <div class="columns small-12 medium-4">
                                            <div class="game-image"><img src="<?= base_url() ?>assets/frontend/images/bowling.jpg">
                                                <img class="play-game" src="<?= base_url() ?>assets/frontend/images/play-button.svg">
                                                <div class="overlay"></div>
                                            </div>
                                            <h4>Bowling</h4>
                                        </div>
                                    </div>
                                    <div class="signup">
                                        <a href="<?=$facebookLoginUrl?>" class="signup_link"><img src="<?= base_url() ?>assets/frontend/images/facebook.png"></a>
                                        <h4>Signup Now to Play Amazing Games For A Chance To Win Prizes Every Week</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="columns small-12 medium-4">
                            <?php $this->load->view("sidebar/leaderboard"); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="reveal" id="exampleModal1" data-reveal>
        <div class="modal-head">
            <h4>You Need Lives To Play</h4>
            <div class="live-box">
                <h4>0 x</h4><img src="<?= base_url() ?>assets/frontend/images/life.png">
            </div>
        </div>
        <div class="modal-body">
            <h3>Take Bible Quiz To Earn Lives And Continue Playing</h3>
            <a href="<?= base_url()?>quiz" class="button-sytle1">Start Bible Quiz</a>
        </div>
        <!-- <button class="close-button" data-close aria-label="Close modal" type="button">
            <span aria-hidden="true">&times;</span>
        </button> -->
    </div>
    <?php $this->load->view('common/footer'); ?>
    <script type="text/javascript">
        $(document).ready(function() {
            $(".games-to-play > div").click(function(){
                /*var $modal = $('#exampleModal1');
                $modal.foundation('open');*/
                window.location = "<?=$facebookLoginUrl?>";
            });
        });
    </script>