$(function() {
	var $debug = $('.emailDebug'),
		$tab = $debug.find('.emailsTab'),
		$emails = $debug.find('.email');

	$tab.empty();
	if ($emails.size() > 1) {
		$emails.each(function(i) {
			var $email = $(this);

			var $a = $('<a href="#" />')
				.text('Email #' + (i+1))
				.appendTo($tab)
				.click(function() {
					$tab.find('a').removeClass('active');
					$(this).addClass('active');
					$emails.hide();
					$email.show();
					return false;
				});

			if (i > 0) $email.hide();
			else {
				$email.show();
				$a.addClass('active');
			}
		});
	}
});
