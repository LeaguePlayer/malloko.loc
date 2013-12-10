jQuery(document).ready(function(){
	var typeIn = jQuery('#type');
	var curType = typeIn.val();

	//return form for type settings field
	var getForm = function getForm(type){
		jQuery.ajax({
			url: '/admin/settings/typeForm',
			data: {type: type},
			success: function(res){
				jQuery('#value-block').html(res);
			}
		});
	};

	//load current form
	//getForm(curType);

	typeIn.on('change', function(){
		var type = $(this).val();
		getForm(type);
	});
});