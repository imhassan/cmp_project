$(document).ready(function (){	
	
	
	$(".recent-nav a").click(function(){
		$(this).parent("div").children("a").removeClass("active");
		$(this).addClass("active"); 
		var currentActive = $(this).attr("data-url");
		
		$(".rco-contents").children(".rco-none").transition({ scale: 0, delay: 200 });
		$(".rco-contents").children(".rco-none").hide(100);
		
		$(".rco-contents").children("#"+currentActive).show(100);
		$(".rco-contents").children("#"+currentActive).transition({ scale: 1, delay: 100 });
		
	});
	
	
	
	$(".img-box").hover(
		function(){
			//$(this).children("span").fadeOut();
			$(this).children("span").fadeIn();
			$(this).children(".view-text").fadeIn();
		},
		function(){
			//$(this).children("span").fadeIn();
			$(this).children("span").stop().fadeOut();
			$(this).children(".view-text").stop().fadeOut();				
		}
	
	);
	
	$(".team-box").hover(
		function(){
			//$(this).children("span").fadeOut();
			$(this).children(".team-overlay").fadeIn();
			$(this).children(".social-icon").fadeIn();
		},
		function(){
			//$(this).children("span").fadeIn();
			$(this).children(".team-overlay").stop().fadeOut();
			$(this).children(".social-icon").stop().fadeOut();				
		}
	
	);
	$(".feature-box-lg").hover(
		function(){
			//$(this).children("span").fadeOut();
			$(this).children("span").fadeIn();
			$(this).children("b").fadeIn();
		},
		function(){
			//$(this).children("span").fadeIn();
			$(this).children("span").stop().fadeOut();
			$(this).children("b").stop().fadeOut();				
		}
	
	);
	
	$(".att-box").hover(
		function(){
			//$(this).children("span").fadeOut();
			$(this).children(".title").fadeOut();
			$(this).children(".title-detail").fadeIn("slow");
		},
		function(){
			//$(this).children("span").fadeIn();
			$(this).children(".title").stop().fadeIn("slow");
			$(this).children(".title-detail").stop().fadeOut();				
		}
	
	);
	$(".downlist").hover(
		function(){
			$(this).children(".down-nav").slideDown("slow");
		},
		function(){
			//$(this).children("span").fadeIn();
			$(this).children(".down-nav").stop().slideUp();				
		}
	
	);
	$(".feature-box").hover(
		function(){
			//$(this).children("span").fadeOut();
			$(this).children("span").fadeIn();
			$(this).children("b").fadeIn();
		},
		function(){
			//$(this).children("span").fadeIn();
			$(this).children("span").stop().fadeOut();
			$(this).children("b").stop().fadeOut();				
		}
	
	);
	$(".plus-neg-box").click(function(){
		
		if($(this).text() == '+')
			$(this).html("-");
		else
			$(this).html("+");
		
		$(this).parent("div").toggleClass("open-tab");
		$(this).parent("div").children(".hide-contenct").slideToggle();
		
	});
	
	$(".hist-nav a").click(function(){
		
		$(".hist-nav a").removeClass("active");
		
		var currentActive = $(this).attr("data-detail");
		$(".hist-text").children(".row").transition({ scale: 0, delay: 200 });
		$(".hist-text").children(".row").hide(100);
		$("#"+currentActive).show(100);
		$("#"+currentActive).transition({ scale: 1, delay: 100 });
		
		$(this).addClass("active");
		
		
		var x = $(this).offset();
		var y = $(".hist-nav-contents").offset();
    	var barwidth = (x.left - y.left) + ($(this).width() /2);
		barwidth = (barwidth/$(".hist-nav").width()) * 100;
		var spanwidth = barwidth + "%";
		
		$(".fill-bar span").animate({width: spanwidth});
		
	});
	
	$(".down-up-btn").click(function(){
		$(".book-slide").slideToggle();
		
			if($(this).attr("rotate") == 0 )
			{
				$(".book-villa-content").animate({top: '0px' });
				$(this).attr("rotate", "1");
			}
			else{
				$(".book-villa-content").animate({top: '-220px' });
				$(this).attr("rotate", "0");
			}
	
		$(this).children("img").toggleClass("rotate");
		
	});

	setTimeout(function(){
		$(".down-up-btn").trigger("click");
	}, 3000);

	$(".playback").click(function(e) {
    	e.preventDefault();

       	// This next line will get the audio element
       	// that is adjacent to the link that was clicked.
       	var song = $(this).children('audio').get(0);
       	if (song.paused){
        	song.play();
			$('#play').removeClass("glyphicon glyphicon-volume-off");
  			$('#play').addClass("glyphicon glyphicon-volume-up");
	   	}
       	else {
        	song.pause();
			$('#play').removeClass("glyphicon glyphicon-volume-up");
  			$('#play').addClass("glyphicon glyphicon-volume-off");
	   }
    });

	

});// JavaScript Document