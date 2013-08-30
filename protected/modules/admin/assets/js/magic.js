
$(document).ready(function() {
    $('input[id*=img_]:file').bind('change', handleFileSelect);
});



function handleFileSelect(evt) {
    var files = evt.target.files;
    var elId = evt.target.id;
    for (var i = 0, f; f = files[i]; i++) {
        if (!f.type.match('image.*')) {
            continue;
        }
        var reader = new FileReader();
        reader.onload = (function(theFile) {
            return function(e) {
                $('#'+elId).next('img').remove();
                $('#'+elId).after('<img class="img-polaroid" width="200" src="'+e.target.result+'" alt="">');
                $('.image_delete').click(function(){
                    $('#'+elId).replaceWith($('#'+elId).clone(true));
                    document.getElementById('Brands_image').addEventListener('change', handleFileSelect, false);
                    $('#image').children('li').fadeOut(500, function(){
                        $('#image').children('li').remove();
                    });
                });
            }
        })(f);
        reader.readAsDataURL(f);
    }
    delete files;
}




function fixHelper(e, ui) {
    ui.children().each(function() {
        $(this).width($(this).width());
    });
    return ui;
};




function sortGrid(gridId) {
    var grid = $('#'+gridId+'-grid table.items tbody');
    grid.sortable({
        forcePlaceholderSize: true,
        forceHelperSize: true,
        items: 'tr',
        update : function () {
            var serial = grid.sortable('serialize', {key: 'items[]', attribute: 'id'});
            $.ajax({
                'url': '/admin/'+gridId+'/sort',
                'type': 'post',
                'data': serial,
                'success': function(data){},
                'error': function(request, status, error) {
                    alert('Сортировка сейчас недоступна');
                }
            });
        },
        helper: fixHelper
    }).disableSelection();
}