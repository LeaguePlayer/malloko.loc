$(document).ready(function() {
	
	myWidgets.newsRounder().init();
	
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
				return false;
			});
			prevBtn.click(function() {
				slide(-1);
				return false;
			});
		};
		
		return this;
	}
}