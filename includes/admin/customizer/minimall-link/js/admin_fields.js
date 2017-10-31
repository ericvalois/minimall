/*
 * Core Fields js functions  
 * 
 * @author ThemesPond
 * @since 1.0.0
 */

jQuery(function ($) {

    'use strict';
    
    var $document = $(document);

    var prefix = '';



    /**
     * Field Image Picker
     */
    if (document.getElementsByClassName('tpfw-image_picker').length) {
        $('.tpfw-image_picker').tpfwImagePicker();
    }

    console.log("Fichier chargé");

    /**
     * Field Link
     */
    if (document.getElementsByClassName('tpfw-link').length) {
        console.log("Link detected");
        $('.tpfw-link').tpfwLink();
        
    }

    /**
     * Field Color
     */
    if ($('.tpfw-color:not(.child-field)').length) {
        $(prefix + '.tpfw-color:not(.child-field)').wpColorPicker();
    }

    /**
     * Field icon picker
     */
    if ($(prefix + '.tpfw-icon_picker:not(.child-field)').length) {
        $(prefix + '.tpfw-icon_picker:not(.child-field) select').fontIconPicker();
    }

    /**
     * Field datetime
     */
    if (document.getElementsByClassName('tpfw-datetime').length) {
        $(prefix + '.tpfw-datetime input').each(function () {
            var data = $(this).data();
            $(this).datetimepicker(data);
        });
    }

    /**
     * Field checkboxes
     */
    if (document.getElementsByClassName('tpfw-checkboxes')) {

        $document.on(
                'change', '.tpfw-checkboxes input[type="checkbox"]',
                function () {
                    var checkbox_values = $(this).closest('ul').find('input[type="checkbox"]:checked').map(
                            function () {
                                return this.value;
                            }
                    ).get().join(',');

                    $(this).closest('ul').prev('input.tpfw_value').val(checkbox_values).trigger('change');
                }
        );
    }

    /**
     * Field select multiple
     */
    if ($(prefix + '.tpfw-select-multiple').length) {

        $(prefix + '.tpfw-select-multiple:not(.child-field)').selectize({
            plugins: ['remove_button', 'drag_drop']
        });

        $document.on('change', prefix + '.tpfw-select-multiple', function () {
            $(this).closest('div').find('.tpfw_value').val($(this).val()).trigger('change');
        });
    }

    /**
     * Field Autocomplete
     */
    if ($(prefix + '.tpfw-autocomplete select').length) {

        $(prefix + '.tpfw-autocomplete:not(.child-field) select').tpfwAutocomplete();

        $document.on('change', prefix + '.tpfw-autocomplete select', function () {
            $(this).closest('div').find('.tpfw_value').val($(this).val()).trigger('change');
        });
    }

    var widget_content_init = function ($widgetRoot) {

        if (window.hasOwnProperty('google')) {
            var $map = $widgetRoot.find('.tpfw-map');
            if ($map.length) {
                $map.tpfwMap().addClass('map_loaded');
            }
        }

        var $color = $widgetRoot.find('.tpfw-color');
        if ($color.length) {
            $color.wpColorPicker();
        }


        var $icon_picker = $widgetRoot.find('.tpfw-icon_picker select');
        if ($icon_picker.length) {
            $icon_picker.fontIconPicker();
        }

        var $date_time = $widgetRoot.find('.tpfw-datetime input');
        if ($date_time.length) {
            $date_time.each(function () {
                var data = $(this).data();
                $(this).datetimepicker(data);
            });
        }

        //Repeater
        var $repeater = $widgetRoot.find('.tpfw-repeater');
        if ($repeater.length && !$repeater.hasClass('repeater_loaded')) {
            $repeater.addClass('repeater_loaded').tpfwRepeater();
        }

        //Selective
        var $selective = $widgetRoot.find('.tpfw-select-multiple');
        if ($selective.length) {
            $widgetRoot.find('.tpfw-select-multiple:not(.child-field)').selectize({
                plugins: ['remove_button', 'drag_drop']
            });
        }

        //Autocomplete
        var $autocomplete = $widgetRoot.find('.tpfw-autocomplete');
        if ($autocomplete.length) {
            $widgetRoot.find('.tpfw-autocomplete:not(.child-field) select').tpfwAutocomplete();
        }

        //Reinit dependency
        var $dependency = $widgetRoot.find("div[data-dependency]");
        if ($dependency.length) {
            $dependency.initWidgetDependency();
        }

    }

    $document.on('widget-updated', function (e, $widgetRoot) {
        widget_content_init($widgetRoot);
    });

    $document.on('widget-added', function (e, $widgetRoot) {
        widget_content_init($widgetRoot);
    });

    $document.on('click', '#widgets-right .widget-title', function (e) {

        var $this = $(this);

        setTimeout(function () {
            var $widget = $this.closest('.open');

            if ($widget.length) {
                //Map
                var $map = $widget.find('.tpfw-map');
                if ($map.length && !$map.hasClass('map_loaded')) {
                    $map.tpfwMap();
                }

                //Repeater
                var $repeater = $widget.find('.tpfw-repeater');
                if ($repeater.length && !$repeater.hasClass('repeater_loaded')) {
                    $repeater.addClass('repeater_loaded').tpfwRepeater();
                }
            }

        }, 300);

        e.preventDefault();
    });

    $document.on('tpfw-repeater-item-opened', function (e, $widget) {
        var $map = $widget.find('.tpfw-map');
        if ($map.length) {
            $map.tpfwMap();
        }
    });

    $document.on('click', '.tpfw_group .group_nav a', function (e) {

        var $this = $(this);
        var id = $this.attr('href');

        $this.closest('ul').find('.active').removeClass('active');
        $this.addClass('active');

        $('.tpfw_group .group_item.active').removeClass('active');

        var $panel = $('.tpfw_group ' + id);
        $panel.addClass('active');

        if ($('.tpfw_group ' + id + ' .map_loaded').length) {
            if (!$panel.find('.tpfw-map').hasClass('map_refresh')) {
                $panel.find('.tpfw-map').tpfwMap().addClass('map_refresh');
            }
        }

        $document.trigger('tpfw_group_active', [$panel]);

        e.preventDefault();
    });

    /**
     * On click menu iteme edit
     */

    $('#menu-to-edit .menu-item .item-edit').click(function (e) {
        var $this = $(this);

        setTimeout(function () {
            var $memuitem = $this.closest('.menu-item');

            if ($memuitem.length) {
                //Map
                var $map = $memuitem.find('.tpfw-map');
                if ($map.length && !$map.hasClass('map_loaded')) {
                    $map.tpfwMap();
                }
            }

        }, 300);

        e.preventDefault();
    });

    /**
     * Init dependency
     */
    if (window.hasOwnProperty('pagenow')) {

        if (pagenow === 'widgets') {
            var $dependency = $('#widgets-right').find("div[data-dependency]");
            if ($dependency.length) {
                $dependency.initWidgetDependency();
            }
        } else if (pagenow === 'nav-menus') {
            if ($("#menu-to-edit div[data-dependency]").length) {
                $("#menu-to-edit div[data-dependency]").initMenuDependency();
            }
        } else {
            $("[data-dependency]").initDependency();
        }

    } else if ($("[data-dependency]").length) {
        $("[data-dependency]").initDependency();
    }

    if ($('input.tpfw-manage_box').length) {

        $('input.tpfw-manage_box').each(function () {

            var $this = $(this);

            var checked = '';

            if ($this.val() == 1) {
                checked = 'checked';
                $this.closest('.postbox').removeClass('postbox--disabled');
            } else {
                $this.closest('.postbox').addClass('postbox--disabled');
            }

            $this.closest('.postbox').find('.hndle').before('<label class="tpfw-controlbox"><input type="checkbox" ' + checked + ' data-name="' + $this.attr('name') + '"/>' + $this.data('label') + '</label>');

        });

        $(document).on('change', '.tpfw-controlbox input', function (e) {
            var $this = $(this);

            var $postbox = $this.closest('.postbox');
            
            var val = 0;
            
            if ($this.is(':checked')) {
                $postbox.removeClass('postbox--disabled');
                val = 1;
            } else {
                $postbox.addClass('postbox--disabled');
            }

            $('input[name=' + $this.data('name') + ']').val(val).change();

            e.preventDefault();
            e.stopPropagation();
        });
    }

    if ($('.tpfw-manage_group').length) {

        $('input.tpfw-manage_group').on('change', function (e) {
            var $this = $(this);

            if ($this.is(':checked')) {
                $this.closest('.tpfw_form_row').removeClass('group-disabled');
            } else {
                $this.closest('.tpfw_form_row').addClass('group-disabled');
            }

            e.preventDefault();
        });

        $('input.tpfw-manage_group').change();
    }

});

