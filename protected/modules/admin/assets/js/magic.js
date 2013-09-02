
$(document).ready(function() {
    $('input[id*=img_]:file').bind('change', handleFileSelect);
    $('.control-group .img_preview .deletePhoto').one('click', function(e) {
        var $this = $(this);
        deletePhoto($this);
    });
});



function handleFileSelect(evt) {
    var files = evt.target.files;
    var $el = $(evt.target);
    var elId = evt.target.id;
    for (var i = 0, f; f = files[i]; i++) {
        if (!f.type.match('image.*')) {
            continue;
        }
        var reader = new FileReader();
        reader.onload = (function(theFile) {
            return function(e) {
                var previewBlock = $el.next('.img_preview');
                $('img', previewBlock).remove();
                previewBlock.prepend('<img class="img-rounded" width="200" src="'+e.target.result+'" alt="">');
                $('.deletePhoto', previewBlock).show().unbind('click').bind('click', function() {
                    var $newEl = $("<input type='file' />").attr({
                        'name': $el.attr('name'),
                        'id': elId,
                        'class': $el.attr('class')
                    }).bind('change', handleFileSelect);
                    $el.replaceWith($newEl);
                    $('img', previewBlock).remove();
                    $(this).hide();
                });
            }
        })(f);
        reader.readAsDataURL(f);
    }
    delete files;
}



function deletePhoto(target) {
    var target = $(target);
    var data = {};
    data[target.data('modelname')] = {'deletePhoto': target.data('attributename')};
    console.log(data);
    $.ajax({
        type: 'POST',
        data: data,
        success: function(data) {
            target.hide().prev('img').remove();
        }
    });
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