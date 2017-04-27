<!doctype html>
<html class="no-js" lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sports</title>
    <link rel="stylesheet" href="<?= base_url() ?>assets/frontend/css/foundation.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/frontend/css/app.css">
    <style type="text/css" media="screen">
    .loader{display:none;color:#fff;position:fixed;box-sizing:border-box;left:-9999px;top:-9999px;width:0;height:0;overflow:hidden;z-index:999999}.loader:after,.loader:before{box-sizing:border-box}.loader.is-active{background-color:rgba(0,0,0,0.85);width:100%;height:100%;left:0;top:0}@keyframes rotation{from{transform:rotate(0)}to{transform:rotate(359deg)}}@keyframes blink{from{opacity:.5}to{opacity:1}}.loader[data-text]:before{position:fixed;left:0;top:50%;color:currentColor;font-family:Helvetica,Arial,sans-serif;text-align:center;width:100%;font-size:14px}.loader[data-text='']:before{content:'Loading'}.loader:not([data-text='']):before{content:attr(data-text)}.loader[blink]:before{animation:blink 1s linear infinite alternate}.loader-default[data-text]:before{top:calc(50% - 63px)}.loader-default:after{content:'';position:fixed;width:48px;height:48px;border:solid 8px #fff;border-left-color:transparent;border-radius:50%;top:calc(50% - 24px);left:calc(50% - 24px);animation:rotation 1s linear infinite}.loader-default[half]:after{border-right-color:transparent}.loader-default[inverse]:after{animation-direction:reverse}.loader-double:after,.loader-double:before{content:'';position:fixed;border-radius:50%;border:solid 8px;animation:rotation 1s linear infinite}.loader-double:after{width:48px;height:48px;border-color:#fff;border-left-color:transparent;top:calc(50% - 24px);left:calc(50% - 24px)}.loader-double:before{width:64px;height:64px;border-color:#eb974e;border-right-color:transparent;animation-duration:2s;top:calc(50% - 32px);left:calc(50% - 32px)}.loader-bar[data-text]:before{top:calc(50% - 40px);color:#fff}.loader-bar:after{content:'';position:fixed;top:50%;left:50%;width:200px;height:20px;transform:translate(-50%, -50%);background:linear-gradient(-45deg, #4183d7 25%, #52b3d9 25%, #52b3d9 50%, #4183d7 50%, #4183d7 75%, #52b3d9 75%, #52b3d9);background-size:20px 20px;box-shadow:inset 0 10px 0 rgba(255,255,255,0.2),0 0 0 5px rgba(0,0,0,0.2);animation:moveBar 1.5s linear infinite}.loader-bar[rounded]:after{border-radius:15px}@keyframes moveBar{from{background-position:0 0}to{background-position:20px 20px}}@keyframes corners{6%{width:60px;height:15px}25%{width:15px;height:15px;left:calc(100% - 15px);top:0}31%{height:60px}50%{height:15px;top:calc(100% - 15px);left:calc(100% - 15px)}56%{width:60px}75%{width:15px;left:0;top:calc(100% - 15px)}81%{height:60px}}.loader-border[data-text]:before{color:#fff}.loader-border:after{content:'';position:absolute;top:0;left:0;width:15px;height:15px;background-color:#ff0;animation:corners 3s ease both infinite}.loader-ball:before{content:'';position:absolute;width:50px;height:50px;top:50%;left:50%;margin:-25px 0 0 -25px;background-color:#fff;border-radius:50%;z-index:1;animation:kick 1s infinite alternate ease-in both}.loader-ball[shadow]:before{box-shadow:-5px -5px 10px 0 rgba(0,0,0,0.5) inset}.loader-ball:after{content:'';position:absolute;background-color:rgba(0,0,0,0.3);border-radius:50%;width:45px;height:20px;top:calc(50% + 10px);left:50%;margin:0 0 0 -22.5px;z-index:0;animation:shadow 1s infinite alternate ease-out both}@keyframes shadow{0%,40%{background-color:transparent;transform:scale(0)}95%,100%{background-color:rgba(0,0,0,0.75);transform:scale(1)}}@keyframes kick{0%{transform:translateY(-80px) scaleX(0.95)}90%{border-radius:50%}100%{transform:translateY(0) scaleX(1);border-radius:50% 50% 20% 20%}}.loader-smartphone:after{content:'';color:#fff;font-size:12px;font-family:Helvetica,Arial,sans-serif;text-align:center;line-height:120px;position:fixed;left:50%;top:50%;width:70px;height:130px;margin:-65px 0 0 -35px;border:solid 5px gold;border-radius:10px;box-shadow:0 5px 0 0 gold inset;background:radial-gradient(circle at 50% 90%, rgba(0,0,0,0.5) 6px, transparent 6px),linear-gradient(to top, gold 22px, transparent 22px),linear-gradient(to top, rgba(0,0,0,0.5) 22px, rgba(0,0,0,0.5) 100%);animation:shake 2s cubic-bezier(0.36, 0.07, 0.19, 0.97) both infinite}.loader-smartphone[data-screen='']:after{content:'Loading'}.loader-smartphone:not([data-screen='']):after{content:attr(data-screen)}@keyframes shake{5%,15%,25%,35%,45%,55%{transform:translate3d(-1px, 0, 0)}10%,20%,30%,40%,50%{transform:translate3d(1px, 0, 0)}}.loader-clock:before{content:'';position:fixed;width:120px;height:120px;left:50%;top:50%;border-radius:50%;overflow:hidden;margin:-60px 0 0 -60px;background:linear-gradient(to bottom, transparent 50%, #f5f5f5 50%),linear-gradient(90deg, transparent 55px, #2ecc71 55px, #2ecc71 65px, transparent 65px),linear-gradient(to bottom, #f5f5f5 50%, #f5f5f5 50%);box-shadow:0 0 0 10px #f5f5f5 inset,0 0 0 5px #555,0 0 0 10px #7b7b7b;animation:rotation infinite 2s linear}.loader-clock:after{content:'';position:fixed;width:60px;height:40px;left:50%;top:50%;margin:-20px 0 0 -15px;border-radius:20px 0 0 20px;overflow:hidden;background:radial-gradient(circle at 14px 20px, #25a25a 10px, transparent 10px),radial-gradient(circle at 14px 20px, #1b7943 14px, transparent 14px),linear-gradient(180deg, transparent 15px, #2ecc71 15px, #2ecc71 25px, transparent 25px);animation:rotation infinite 24s linear;transform-origin:15px center}    
    </style>
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <script src="<?= base_url() ?>assets/frontend/js/vendor/jquery.js"></script>
    <script>  
        function showLoader(){
          $('#my_loader').show().addClass('is-active');
        }
        function hideLoader(){
          $('#my_loader').hide().removeClass('is-active');
        }
    </script>
</head>

<body ondragstart="return false;" ondrop="return false;">
    <div id="my_loader" class="loader loader-default"></div>
    <div class="off-canvas-wrapper">
        <div class="off-canvas-wrapper-inner" data-off-canvas-wrapper>
            <div class="off-canvas position-right" id="offCanvasRight" data-off-canvas>
                <ul class="vertical menu" data-drilldown>
                    <!-- start of the drilldown multi level menu -->
                    <?php if (has_web_logged_in()) {?>
                    <li><a href="<?= base_url() ?>user/signout">Sign Out</a></li>
                    <?php }?>
                </ul>
            </div>
            <div class="off-canvas-content" data-off-canvas-content>
                <div class="title-bar">
                    <div class="row">
                        <div class="logo-container">
                        	<a href="<?= base_url() ?>" style="color:#fefefe">
                            <img src="<?= base_url() ?>assets/frontend/images/logo.png">
                            <h1><span>C</span>hristian <span>S</span>ports <span>XI</span></h1>
                            </a>
                        </div>
                        <div class="title-bar-right">
                            <button class="menu-icon" type="button" data-open="offCanvasRight"></button>
                        </div>
                        
                         <?php if (has_web_logged_in()) {?>
                        <div class="profile-container">
                            <img src="<?= get_web_loggedin_person_image() ?>">
                            <div class="profile-info">
                                <h2><?=get_web_loggedin_person_name()?></h2>
                                <h2><?=get_web_loggedin_person_score()?> Points</h2>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>