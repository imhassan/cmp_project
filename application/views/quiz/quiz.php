
                <div class="content-wrapper">
                    <div class="row">
                        <div class="columns small-12 questions">
                            <div class="question-head">
                                <h2>Correct Answers Will give You Lives </h2>
                                <div class="live-box">
                                    <h4><?=$user_data['game_life']?> x</h4><img src="<?= base_url() ?>assets/frontend/images/life.png">
                                </div>
                            </div>
                            <?php foreach ($question as $key => $value) {?>                            
                            <div class="question-content" data-question-id="<?php echo $value['question_id'];?>" style="display:<?php echo ($key == 0)?'block':'none';?>">
                                <div class="question-content-head">
                                    <div class="question-asked">
                                        <h3>Question <?php echo $key+1; ?>.</h3>
                                        <h4><?php echo $value['question_text']; ?></h4>
                                    </div>
                                    <div class="live-box timer-box" style="max-width:120px;">
                                        <img src="<?= base_url() ?>assets/frontend/images/watch.png">
                                        <h4 style="width: 65px;">10 Sec</h4>
                                    </div>
                                </div>
                                <div class="question-content-body">
                                    <ul>
                                    <?php foreach ($value['options'] as $k => $opt) {?>
                                        <li>
                                            <input type="radio" id="f-option_<?php echo $key.'_'.$k; ?>" name="selector" value="<?php echo $opt['id'] ?>" data-question-id="<?php echo $value['question_id'];?>">
                                            <label for="f-option_<?php echo $key.'_'.$k; ?>"><?php echo $opt['option_text'] ?></label>
                                            <div class="check"></div>
                                        </li>
                                    <?php }?>                                           
                                    </ul>
                                </div>
                            </div>
                            <?php }?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="reveal" id="successmodal" data-reveal>
        <div class="modal-head">
            <h4>Quiz Result</h4>
            <!-- <div class="live-box">
                <h4>0 x</h4><img src="<?= base_url() ?>assets/frontend/images/life.png">
            </div> -->
        </div>
        <div class="modal-body">
            <h3>You have Got One Life. Press Start Button to Play</h3>
            <a href="<?= base_url()?>home" class="button-sytle1">Choose Game</a>
        </div>
    </div>
    <div class="reveal" id="failmodal" data-reveal>
        <div class="modal-head">
            <h4>Quiz Result</h4>
            <!-- <div class="live-box">
                <h4>0 x</h4><img src="<?= base_url() ?>assets/frontend/images/life.png">
            </div> -->
        </div>
        <div class="modal-body">
            <h3>Failed! Take Bible Quiz To Earn Lives And Continue Playing</h3>
            <a href="<?= base_url()?>quiz" class="button-sytle1">Start Bible Quiz Again</a>
        </div>
    </div>
    <script type="text/javascript">
        var user_answers = [];
        var x;
        var sec = 10;
        var parent;
        var is_last_question = false;
        var correct_answer = 0;
        var success_audio, fail_audio;
        $(document).ready(function() {
            parent = $('.question-content').first();
            success_audio = new Audio('<?=base_url()?>assets/frontend/sounds/Bing-sound.mp3');
            fail_audio = new Audio('<?=base_url()?>assets/frontend/sounds/Wrong-answer-sound-effect.mp3');
            
            start_timer();
            $("input[type=radio]").on("click", function() {
                stop_timer();
                var option_id = $(this).val();
                var question_id = $(this).data('question-id');
                user_answers.push({"question_id":question_id,"option_id":option_id});
                console.log("question_id: "+question_id+" option_id: "+option_id);
                console.log(user_answers);
                parent = $(this).closest('.question-content');
                
                check_answer({
                    question_id: question_id,
                    answer: option_id,
                });
            });

            function start_timer() {
                console.log("start_timer");
                parent = $(".questions .question-content:visible");
                sec = 10;
                $(".timer-box h4").html(sec+" Sec");
                is_last_question = $(parent).is(':last-child');

                // Update the count down every 1 second
                x = setInterval(function () {
                    sec--;
                    $(".timer-box h4").html(sec+" Sec");
                    // If the count down is finished, write some text 
                    if (sec <= 0) {
                        stop_timer();

                        // check if its last question
                        /*if($(parent).is(':last-child')) {
                            console.log("last child");
                            check_answer();
                            return false;
                        }*/
                        check_answer({
                            question_id: parent.data('question-id'),
                            answer: 0,
                        });                        
                    }
                }, 1000);
            }

            function stop_timer() {
                console.log("stop_timer");
                clearInterval(x);
            }

            function next_question(elem) {
                $(elem).hide();
                $(elem).next().show();
                start_timer();
            }

            function check_answer(ans) {
                showLoader();
                console.log(JSON.stringify(user_answers));
                console.log(JSON.stringify(ans));
                ans['is_last'] = is_last_question;
                ans['correct_answer'] = correct_answer;
                $.post( "<?php echo base_url();?>quiz/check_answer/", ans, function(data) {
                    console.log(data);                      
                    hideLoader();
                    correct_answer = data.total_correct;

                    if(data.status) {
                        console.log("success");
                        success_audio.play();
                        var img = "tick.png";
                    }
                    else{
                        console.log("fail");
                        fail_audio.play();
                        var img = "cross.png";
                    }
                    parent.find(".timer-box img").attr("src", "<?=base_url()?>assets/frontend/images/"+img);
                    parent.find(".timer-box h4").remove();
                    parent.find("input[type=radio]").off("click");

                    setTimeout(function() {
                        // show next question
                        if(!is_last_question) {                            
                            next_question(parent);
                            return false;
                        }

                        if(data.total_correct > 4) {
                            console.log("success popup");
                            $('#successmodal .modal-body h3').html("Your total correct answer are "+data.total_correct+" out of 10. You got "+data.game_life+" Life. Press Start Button to Play.");
                            $('#successmodal').foundation('open');
                            $('#successmodal').on('closed.zf.reveal', function() {
                                console.log("closed.zf.reveal");
                                window.location = "<?=base_url()?>home";
                            });
                        }
                        else{
                            console.log("fail popup");
                            $('#failmodal').foundation('open');
                            $('#failmodal').on('closed.zf.reveal', function() {
                                console.log("closed.zf.reveal");
                                window.location = "<?=base_url()?>quiz";
                            });   
                        }
                    }, 2000);                      
                }, "json");
            }

            /*function check_answer(ans) {
                showLoader();
                console.log(JSON.stringify(user_answers));
                console.log(JSON.stringify(ans));
                $.post( "<?php echo base_url();?>quiz/check_answer/", ans, function(data) {
                  console.log(data);                      
                  setTimeout(function() {
                    hideLoader();
                    if(data.status) {
                        console.log("success");
                        $('#successmodal').foundation('open');
                        $('#successmodal').on('closed.zf.reveal', function() {
                            console.log("closed.zf.reveal");
                            window.location = "<?=base_url()?>home";
                        });
                    }
                    else{
                        console.log("fail");
                        $('#failmodal').foundation('open');
                        $('#failmodal').on('closed.zf.reveal', function() {
                            console.log("closed.zf.reveal");
                            window.location = "<?=base_url()?>quiz";
                        });   
                    }

                  }, 1000);                      
                }, "json");
            }*/

        });
    </script>