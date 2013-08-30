$('.model_select').change(function(){
    var self = $(this);
    $.ajax({
        url: '/admin/mainBlock/getItems',
        data: {model: self.val()},
        type: 'GET',
        dataType: 'json',
        success: function(res){
            var i = self.data('index'),
                options = [];

            $.each(res, function(key, value) {
                options.push($("<option/>", {
                    value: value.id,
                    text: value.text
                }));
            });
            
            $('#select' + i).html(options);
            $('#select' + i).select2('val', 0);
            //$('#select' + i).select2('data', res);
        }
    });
});

$('.row-fluid').sortable({
    forcePlaceholderSize: true,
    //forceHelperSize: true,
    items: '.span3',
    handle: '.handler',
    update : function (event, ui) {
        ui.item.closest('form').find('.input_sort').each(function(i){
            $(this).val(i);
        });
    },
    helper: fixHelper
});