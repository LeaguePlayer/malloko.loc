(function ($) {

    var defaults = {
        addGalleryUrl: '',
        selectGalleryUrl: '',
        deleteGalleryUrl: '',
        unlinkGalleryUrl: ''
    }


    function galleryContainer(el, options) {
        var opts = $.extend({}, defaults, options);
        var csrfParams = opts.csrfToken ? '&' + opts.csrfTokenName + '=' + opts.csrfToken : '';

        var $container = $(el);
        var $createGalleryModal = $('.create_gallery-modal', $container);
        var $createGalleryForm = $('.gform', $createGalleryModal);
        var $method_tpl = $('.method-tpl', $createGalleryModal);
        var $selectGalleryModal = $('.select_gallery', $container);

        var disabledInputs = function() {
            $('input, select', $createGalleryModal).attr('disabled', true);
            $('input, select', $selectGalleryModal).attr('disabled', true);
        }

        var enabledInputs = function() {
            $('input, select', $createGalleryModal).removeAttr('disabled', true);
            $('input, select', $selectGalleryModal).removeAttr('disabled', true);
        }


        var clearForm = function() {
            $('#Gallery_gallery_name', $createGalleryForm).val('');
            $('.thumbs-settings tbody tr', $createGalleryForm).remove();
            createThumb();
            var row = $('.thumbs-settings tbody tr', $createGalleryForm).first();
            $('input.thumb-prefix', row).val('small');
            var medium = row.clone();
            $('input.thumb-prefix', medium).val('medium');
            $('.thumbs-settings tbody', $createGalleryModal).append(medium);
            var big = row.clone();
            $('input.thumb-prefix', big).val('big');
            $('.thumbs-settings tbody', $createGalleryModal).append(big);
        }


        var createMethod = function(row) {
            $('.thumb-methods', row).append( $method_tpl.clone().removeClass('method-tpl') );
        }


        var createThumb = function() {
            var row = $('<tr></tr>');
            row.append('<td><input type="text" placeholder="Префикс" class="thumb-prefix"></td>');
            row.append('<td><div class="thumb-methods"></div><a class="btn btn-link add-method" href="#"><b>+ </b>Еще метод</a></td>');
            $('.thumb-methods', row).append( $method_tpl.clone().removeClass('method-tpl') );
            $('.thumbs-settings tbody', $createGalleryModal).append(row);
        }


        var resolveRowsMethods = function() {
            var rows = $('.thumbs-settings tr', $createGalleryForm);
            for ( var i = 0; i < rows.length; i++ ) {
                var row = rows.eq(i);
                $('.thumb-prefix', row).attr('name', 'Gallery[versions]['+i+'][prefix]');
                var methods = $('.thumb-method', row);
                for ( var k = 0; k < methods.length; k++ ) {
                    var method = methods.eq(k);
                    $('.select_method', method).attr('name', 'Gallery[versions]['+i+'][methods]['+k+'][method]');
                    $('.thumb_param-x', method).attr('name', 'Gallery[versions]['+i+'][methods]['+k+'][x]');
                    $('.thumb_param-y', method).attr('name', 'Gallery[versions]['+i+'][methods]['+k+'][y]');
                    $('.thumb_param-w', method).attr('name', 'Gallery[versions]['+i+'][methods]['+k+'][w]');
                    $('.thumb_param-h', method).attr('name', 'Gallery[versions]['+i+'][methods]['+k+'][h]');
                }
            }
        }





        $createGalleryModal.on('hide.bs.modal', function(e) {
            disabledInputs();
        });

        $selectGalleryModal.on('hide.bs.modal', function(e) {
            disabledInputs();
        });


        $('.addgallery', $container).click(function(e) {
            e.preventDefault();
            clearForm();
            resolveRowsMethods();
            enabledInputs();
            $('.select_method', $createGalleryModal).trigger('change');
            $createGalleryModal.modal('show');
            return false;
        });

        $('.add-thumb', $createGalleryModal).click(function(e) {
            createThumb();
            resolveRowsMethods();
            return false;
        });

        $createGalleryModal.on('click', '.add-method', function(e) {
            createMethod($(this).closest('tr'));
            resolveRowsMethods();
            return false;
        });

        $createGalleryModal.on('click', '.remove-method', function(e) {
            var row = $(this).closest('tr');
            var methods_count = $('.thumb-method', row).size();
            if ( methods_count > 1 ) {
                $(this).closest('.thumb-method').remove();
            } else {
                row.remove();
            }
            resolveRowsMethods();
            return false;
        });


        $createGalleryModal.on('change', '.select_method', function(e) {
            var method = $(this).val();
            var params = $(this).closest('.thumb-method').find('input');
            if ( method == 'crop' ) {
                params.filter('[name$="[x]"]').removeAttr('disabled');
                params.filter('[name$="[y]"]').removeAttr('disabled');
                params.filter('[name$="[w]"]').removeAttr('disabled');
                params.filter('[name$="[h]"]').removeAttr('disabled');
            } else if ( method == 'resize' || method == 'adaptiveResize' || method == 'centeredpreview' ) {
                params.filter('[name$="[x]"]').attr('disabled', true);
                params.filter('[name$="[y]"]').attr('disabled', true);
                params.filter('[name$="[w]"]').removeAttr('disabled');
                params.filter('[name$="[h]"]').removeAttr('disabled');
            } else {
                params.filter('[name$="[x]"]').attr('disabled', true);
                params.filter('[name$="[y]"]').attr('disabled', true);
                params.filter('[name$="[w]"]').attr('disabled', true);
                params.filter('[name$="[h]"]').attr('disabled', true);
            }
        });


        $createGalleryForm.on('focus', 'input, select', function() {
            var controlGroup = $(this).closest('.control-group').removeClass('error');
            $('.help-block', controlGroup).hide();
        });


        $('.save-changes', $createGalleryModal).click(function(e) {
            $.ajax({
                url: opts.addGalleryUrl,
                type: 'POST',
                data: $('input, select', $createGalleryForm).serialize(),
                dataType: 'json',
                success: function(data) {
                    if ( data.errors ) {
                        for ( var key in data.errors ) {
                            var input = $('[name*="'+key+'"]');
                            var controlGroup = input.closest('.control-group');
                            controlGroup.addClass('error');
                            var error_message = $('.help-block', controlGroup);
                            if ( !error_message.length ) {
                                error_message = $('<div class="help-block"></div>');
                                controlGroup.append(error_message);
                            }
                            error_message.html( data.errors[key].join('<br>')).show();
                        }
                        return;
                    }
                    $('#all_galleries', $container).append(data.widget);
                    options = data.options;
                    $createGalleryModal.modal('hide');
                    return $('#all_galleries .GalleryEditor').last().galleryManager(options);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    return console.log(jqXHR);
                }
            });
            return false;
        });


        $('.select-gallery-btn').click(function(e) {
            e.preventDefault();
            e.stopPropagation();
            enabledInputs();
            $selectGalleryModal.modal('show');
        });


        $('.save-changes', $selectGalleryModal).click(function(e) {
            var val = $('select', $selectGalleryModal).val();
            $.ajax({
                url: opts.selectGalleryUrl,
                type: 'GET',
                data: { id: val },
                dataType: 'json',
                success: function(data) {
                    $('#all_galleries', $container).append(data.widget);
                    options = data.options;
                    $('select option[value="'+val+'"]', $selectGalleryModal).remove();
                    $selectGalleryModal.modal('hide');
                    return $('#all_galleries .GalleryEditor').last().galleryManager(options);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    return console.log(jqXHR);
                }
            });
            return false;
        });


        $container.on('click', '.remove-gallery', function(e) {
            if ( confirm('Вы уверены, что хотите безвозвратно удалить галерею?') ) {
                var self = $(this);
                $.ajax({
                    url: opts.deleteGalleryUrl,
                    data: {id: self.data('id')},
                    success: function(t) {
                        if ( t == 'OK' ) {
                            var $gallery = self.closest('.GalleryEditor');
                            $gallery.fadeOut(200, function() {
                                $gallery.remove();
                            });
                        } else {
                            alert(t);
                        }
                    }
                });
            }
        });


        $container.on('click', '.unlink-gallery', function(e) {
            if ( confirm('Отлинковать галерею?') ) {
                var self = $(this);
                $.ajax({
                    url: opts.unlinkGalleryUrl,
                    data: {
                        id: self.data('id'),
                        entity_type: opts.entity_type,
                        entity_id: opts.entity_id
                    },
                    success: function(t) {
                        if ( t == 'OK' ) {
                            var $gallery = self.closest('.GalleryEditor');
                            var $gallery_name = $('.gallery_name', $gallery).text();
                            $gallery.fadeOut(200, function() {
                                $gallery.remove();
                            });
                            $('select', $selectGalleryModal).append($('<option value="'+self.data('id')+'">'+$gallery_name+'</option>'));
                        } else {
                            alert(t);
                        }
                    }
                });
            }
        });

    }

    // The actual plugin
    $.fn.galleryContainer = function (options) {
        if (this.length) {
            this.each(function () {
                galleryContainer(this, options);
            });
        }
    };

})(jQuery);