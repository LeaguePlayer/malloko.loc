$(document).ready(function() {
	
	myWidgets.newsRounder().init();
	
	if ( $('#slides').size() > 0 ) {
		$('#slides').slidesjs({
			width: 940,
			height: 528,
			navigation: {
				effect: "fade"
			},
			pagination: {
				active: false,
			},
			effect: {
				fade: {
				  speed: 800
				}
			},
			play: {
				active: true,
				effect: "fade",
				interval: 5000,
				auto: true,
				swap: false,
				pauseOnHover: false,
				restartDelay: 2500
			}
		});
	}
	
	$(".stalactite").stalactite({
		duration: 200,
		complete: function() {
			$('.fancy').fancybox();
		}
	});
	
	$('.fancybox').fancybox();
	
	$('.fancybox-ajax').fancybox({
		type: 'ajax',
		afterShow: function() {
			var $this = this;
			var btnEvent = function(button) {
				button.click(function() {
					$.ajax({
						url: $this.href,
						type: 'POST',
						data: $this.inner.find('form').serialize(),
						success: function(data) {
							btnEvent( $this.inner.html(data).find('button') );
							$.fancybox.reposition();
						}
					});
					return false;
				});
			}
			btnEvent( $this.inner.find('button') );
		}
	});
});




var myWidgets = {
	
	newsRounder: function(options) {
		var options = $.extend({
			itemWidth: 350
		}, options || {});
		
		var rounder;
		var feed;
		var items;
		var prevBtn;
		var nextBtn;
		var currentPos = 0;
		
		var checkPos = function() {
			if ( items.size() <= 2 ) {
				prevBtn.hide();
				nextBtn.hide();
				return;
			}
			
			if ( currentPos == 0 ) {
				prevBtn.hide();
				nextBtn.show();
			} else if ( currentPos >= items.size() - 2 ) {
				prevBtn.show();
				nextBtn.hide();
			}
		}
		
		var slide = function(direction) {
			currentPos += direction;
			checkPos();
			feed.stop().animate({left: -options.itemWidth * currentPos}, 300);
		}
		
		this.init = function() {
			rounder = $('.news_rounder');
			if ( rounder.size() === 0 ) {
				return;
			}
			feed = rounder.find('ul.round');
			items = rounder.find('ul.round > li');
			prevBtn = rounder.find('a.prev');
			nextBtn = rounder.find('a.next');
			
			var startTimestamp = rounder.data('startTimestamp');
			items.each(function() {
				var timestamp = $(this).data('timestamp');
				if ( timestamp >= startTimestamp )
					return false;
				currentPos++;
			});
			currentPos -= 2;
			if ( currentPos < 0 ) currentPos = 0;
			checkPos();
			
			feed.css({
				left: -options.itemWidth * currentPos,
			});
			
			nextBtn.click(function() {
				slide(1);
				prevBtn.show();
				return false;
			});
			prevBtn.click(function() {
				slide(-1);
				nextBtn.show();
				return false;
			});
		};
		
		return this;
	}
}