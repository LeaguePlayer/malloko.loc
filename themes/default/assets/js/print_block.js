$(document).ready(function() {
	
	$('.printBlock').click(function(){
		$('body').addClass('printSelected');
		$('body').append("<div class='printSelection'></div>");
		var targetBlock = $(this).data('target_selector');
		$(targetBlock).clone().appendTo('.printSelection');
		
		window.print(); // выводи на печать
		window.setTimeout(pageCleaner, 0); // затираем следы
		return false;
	})
	
	function pageCleaner(){
		$('body').removeClass('printSelected');
		$('.printSelection').remove();
	}
});