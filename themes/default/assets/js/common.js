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
				interval: 3000,
				auto: true,
				swap: false,
				pauseOnHover: false,
				restartDelay: 2500
			}
		});
	}
	
	$('.fancy').fancybox();
	$(".stalactite").stalactite({
		duration: 200,                        // Duration of animation.
		easing: 'swing',                      // Easing method.
		cssPrefix: '.stalactite',             // The css naming convention.
		cssPrep: true,                        // Should stalactite structurally modify css of children?
		fluid: true,                          // Should stalactite recalculate on window resize?
		loader: '<img />',                    // The contents of the loader. Defaults to a dataURL animated gif.
		styles: {},                           // A style object to place on the child elements
		complete: function() {
			//
		}
	});
	
	$('.fancybox').fancybox();
	
	$('.fancybox-ajax').fancybox({
		type: 'ajax',
		afterShow: function() {
			var $this = this;
			var bindEvents = function(content) {
				content.find('button').click(function() {
					$.ajax({
						url: $this.href,
						type: 'POST',
						data: $this.inner.find('form').serialize(),
						success: function(data) {
							bindEvents( $this.inner.html(data) );
							$.fancybox.reposition();
						}
					});
					return false;
				});
				
				$('#OrderForm_date').datetimepicker({'controlType':'select'});
			}
			bindEvents( $this.inner );
		}
	});
	
	$('.adipoli').adipoli({ startEffect:'overlay', hoverEffect:'foldLeft' });
	
	$('.job-description').hide();
	$('.jobs-list h3').click(function() {
		$(this).parent().find('.job-description').stop().slideToggle(300);
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
			if (currentPos > 0) {
				prevBtn.show();
			} else {
				prevBtn.hide();
			}
			if ( currentPos  == items.size() - 2 ) {
				nextBtn.hide();
			} else {
				nextBtn.show();
			}
		}
		
		
		
		var slide = function(direction) {
			currentPos += direction;
			checkPos();
			feed.stop().animate({left: -currentPos * options.itemWidth}, 300);
		}
		
		
		
		this.init = function() {
			rounder = $('.news_rounder');
			if ( rounder.size() === 0 ) {
				return;
			}
			feed = rounder.find('ul.round');
			prevBtn = rounder.find('a.prev');
			nextBtn = rounder.find('a.next');
			items = rounder.find('ul.round > li');
			
			if ( items.size() <= 2 ) {
				return;
			}
			
			feed.width( items.size() * options.itemWidth );
			
			currentPos = 0;
			var startTimestamp = rounder.data('start_timestamp');
			items.each(function() {
				if ( startTimestamp < $(this).data('timestamp') ) {
					return false;
				}
				currentPos++;
			});
			
			if ( currentPos > 1 ) {
				if ( currentPos == items.size() ) {
					currentPos = items.size() - 2;
				} else {
					currentPos -= 1;
				}
			} else if ( currentPos == 1 ) {
				currentPos = 0;
			}
			
			checkPos();
			
			feed.css({
				left: -currentPos * options.itemWidth,
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