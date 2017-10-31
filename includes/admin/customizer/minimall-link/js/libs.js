/*
 * Tpfw library
 * 
 * @license: GPLv3
 * @author: ThemesPond
 */


jQuery(function ($) {

    'use strict';

    var $document = $(document);

    $.fn.tpfwImagePicker = function () {

        var file_frames = {};

        var get_ids = function (input_value) {
            var ids = [];
            if (input_value != '') {
                var arr = input_value.split(',');
                for (var i in arr) {
                    var obj = arr[i].split('|');
                    ids.push(obj[0]);
                }
            }
            return ids;
        }

        $document.on('click', '.tpfw-image_picker .add_images', function (e) {

            e.preventDefault();
            var $this = $(this);
            var $field = $this.closest('.tpfw-image_picker');
            var $input = $field.find('input[type="hidden"]');
            if (file_frames[$field.attr('id')]) {
                file_frames[$field.attr('id')].open();
                return;
            }

            file_frames[$field.attr('id')] = wp.media.frames.file_frame = wp.media({
                title: 'Add Images',
                button: {
                    text: 'Add Images'
                },
                library: {
                    type: 'image'
                },
                multiple: $field.data('multiple')
            });

            file_frames[$field.attr('id')].on('open', function () {

                var ids, selection;
                ids = get_ids($input.val());
                if ('' != ids) {
                    selection = file_frames[$field.attr('id')].state().get('selection');
                    $(ids).each(function (index, element) {
                        var attachment;
                        attachment = wp.media.attachment(element);
                        attachment.fetch();
                        selection.add(attachment ? [attachment] : []);
                    });
                }
            });

            file_frames[$field.attr('id')].on('select', function () {

                var result, selection;
                result = [];
                selection = file_frames[$field.attr('id')].state().get('selection');
                var ids = get_ids($input.val());

                var item = '';
                selection.map(function (attachment) {

                    attachment = attachment.toJSON();
                    var src = attachment.sizes.hasOwnProperty('thumbnail') ? attachment.sizes.thumbnail.url : attachment.url;
                    if (ids == '' || $.inArray(attachment.id.toString(), ids) === -1) {
                        item += '<li class="added" data-id="' + attachment.id + '">\n\
                                    <div class="inner">\n\
                                        <img alt="' + attachment.title + '" src="' + src + '"/>\n\
                                    </div>\n\
                                    <a href="#" class="remove"></a>\n\
                                </li>';
                        src = src.replace(tpfw_var.upload_url, '');
                        result.push(attachment.id + '|' + encodeURIComponent(src));
                    }

                });


                if (result.length > 0) {
                    if ($field.data('multiple')) {
                        if (ids != '') {
                            result = ids.concat(result);
                        }
                        $field.find('.image_list').append(item);
                    } else {
                        $field.find('.image_list').html(item);
                    }

                    $input.val(result).change();
                }
            });

            file_frames[$field.attr('id')].open();
        });


        $document.on('click', '.tpfw-image_picker .remove', function (e) {
            e.preventDefault();
            var $this = $(this);
            var $input = $this.closest('.tpfw-image_picker').find('input[type="hidden"]');
            var ids = $input.val();
            var index = $this.closest('li').index();
            if (ids != '') {
                ids = ids.split(',');
                delete ids[index];
                ids = ids.filter(function (val) {
                    return val;
                });
            }

            $input.val(ids).change();
            $this.closest('li').remove();
        });


        if ($.fn.sortable) {
            $('.tpfw-image_picker .image_list').sortable({
                stop: function (e, ui) {
                    var ids = [];
                    var $list = $(ui.item[0]).parent();
                    $list.find('li').each(function () {
                        ids.push($(this).attr('data-id'));
                    });
                    $list.closest('.tpfw-image_picker').find('input[type="hidden"]').val(ids);
                }
            });
        }
    }

    $.fn.tpfwLink = function () {

        $document.on('click', '.tpfw-link .link_button', function (e) {
            console.log("Click!");
            e.preventDefault();
            var $block, $input, $url_label, $title_label, value_object, $link_submit, $tpfw_link_submit, $tpfw_link_nofollow, dialog;
            $block = $(this).closest(".tpfw-link");
            $input = $block.find("input.tpfw_value");
            $url_label = $block.find(".url-label");
            $title_label = $block.find(".title-label");
            value_object = $input.data("json");
            $link_submit = $("#wp-link-submit");
            $tpfw_link_submit = $('<input type="button" name="tpfw_link-submit" id="tpfw_link-submit" class="button-primary" value="Set Link">');
            $link_submit.hide();
            $("#tpfw_link-submit").remove();
            $tpfw_link_submit.insertBefore($link_submit);
            $tpfw_link_nofollow = $('<div class="link-target tpfw-link-nofollow"><label><span></span> <input type="checkbox" id="tpfw-link-nofollow"> Add nofollow option to link</label></div>');
            $("#link-options .tpfw-link-nofollow").remove();
            $tpfw_link_nofollow.insertAfter($("#link-options .link-target"));
            setTimeout(function () {
                var currentHeight = $("#most-recent-results").css("top");
                $("#most-recent-results").css("top", parseInt(currentHeight) + $tpfw_link_nofollow.height())
            }, 200);
            dialog = window.wpLink;
            dialog.open('content');

            if (typeof value_object.url == 'string' && $("#wp-link-url").length) {
                $("#wp-link-url").val(value_object.url);
            } else {
                $("#url-field").val(value_object.url);
            }

            if (typeof value_object.url == 'string' && $("#wp-link-text").length) {
                $("#wp-link-text").val(value_object.title);
            } else {
                $("#link-title-field").val(value_object.title);
            }

            if ($("#wp-link-target").length) {

                $("#wp-link-target").prop("checked", value_object.target.length);
            } else {
                $("#link-target-checkbox").prop("checked", value_object.target.length);
            }

            if ($("#tpfw-link-nofollow").length) {
                $("#tpfw-link-nofollow").prop("checked", value_object.rel.length);
            }


            $tpfw_link_submit.unbind("click.tpfwLink").bind("click.tpfwLink", function (e) {

                e.preventDefault();
                e.stopImmediatePropagation();
                var string, options = {};
                options.url = $("#wp-link-url").length ? $("#wp-link-url").val() : $("#url-field").val();
                options.title = $("#wp-link-text").length ? $("#wp-link-text").val() : $("#link-title-field").val();
                var $checkbox = $($("#wp-link-target").length ? "#wp-link-target" : "#link-target-checkbox");
                options.target = $checkbox[0].checked ? " _blank" : "";
                options.rel = $("#tpfw-link-nofollow")[0].checked ? "nofollow" : "";

                string = $.map(options, function (value, key) {
                    return typeof value == 'string' && 0 < value.length ? key + ":" + encodeURIComponent(value) : void 0
                }).join("|");

                $input.val(string).change();
                $input.data("json", options);
                $url_label.html(options.url + options.target);
                $title_label.html(options.title);
                dialog.close('noReset');
                window.wpLink.textarea = "";
                $link_submit.show();
                $tpfw_link_submit.unbind("click.tpfwLink");
                $tpfw_link_submit.remove();
                $("#wp-link-cancel").unbind("click.tpfwLink");
                $checkbox.attr("checked", false);
                $("#most-recent-results").css("top", "");
                $("#tpfw-link-nofollow").attr("checked", false);
                return false;
            });
            $("#wp-link-cancel").unbind("click.tpfwLink").bind("click.tpfwLink", function (e) {
                e.preventDefault();
                dialog.close('noReset');
                $tpfw_link_submit.unbind("click.tpfwLink");
                $tpfw_link_submit.remove();
                $("#wp-link-cancel").unbind("click.tpfwLink");
                $("#wp-link-close").unbind("click.tpfwCloseLink");
                window.wpLink.textarea = "";
                return false;
            });
            $('#wp-link-close').unbind('click').bind('click.tpfwCloseLink', function (e) {
                e.preventDefault();
                dialog.close('noReset');
                $tpfw_link_submit.unbind("click.tpfwLink");
                $tpfw_link_submit.remove();
                $("#wp-link-cancel").unbind("click.tpfwLink");
                $("#wp-link-close").unbind("click.tpfwCloseLink");
                window.wpLink.textarea = "";
                return false;
            });
        });
    }

    $.fn.tpfwMap = function () {
        if (window.hasOwnProperty('google')) {
            return this.each(function (index, item) {

                if (!item.id.includes('__i__')) {//check wp version < 4.7

                    var $this = $(this);


                    var map = {};
                    map.zoom = 14;
                    map.map = new google.maps.Map($this.find('.map_canvas')[0], {
                        zoom: 4,
                        center: new google.maps.LatLng(40.590377, -97.726872),
                    });
                    map.marker = null;
                    map.overideMap = function (center) {

                        if (map.marker != null) {
                            map.marker.setMap(null);
                            map.marker = null;
                        }

                        map.marker = new google.maps.Marker({
                            position: center,
                            draggable: true,
                            animation: google.maps.Animation.DROP,
                            icon: map.iconMarker
                        });
                        map.map.setCenter(center);
                        map.map.setZoom(map.zoom);
                        map.marker.setMap(map.map);
                        google.maps.event.addListener(map.marker, 'dragend', map.onDragMarker);
                        google.maps.event.addListener(map.map, 'zoom_changed', map.onZoomChanged);
                    }

                    map.onDragMarker = function (res) {
                        var latlng = res.latLng;
                        var string = latlng.lat() + ',' + latlng.lng() + '|' + map.zoom;
                        $this.find('input.tpfw_value').val(string).change();
                    }

                    map.onZoomChanged = function (res) {

                        map.zoom = map.map.getZoom();
                        var data = $this.find('input.tpfw_value').val();
                        if ($.trim(data) != '') {
                            data = data.split('|');
                            var string = data[0] + '|' + map.zoom;
                            $this.find('input.tpfw_value').val(string).change();
                        }
                    }

                    map.onLoad = function () {
                        var data = $this.find('input.tpfw_value').val();
                        $this.addClass('map_loaded');
                        if ($.trim(data) != '') {
                            data = data.split('|');
                            var latlng = data[0].split(',');
                            latlng = new google.maps.LatLng($.trim(latlng[0]), $.trim(latlng[1]));
                            map.zoom = $.trim(data[1]) != '' ? parseInt(data[1]) : 14;
                            map.overideMap(latlng);
                        }
                    }

                    $this.find('.js-map_search').geocomplete()
                            .bind("geocode:result", function (event, result) {

                                var latlng = result.geometry.location;
                                var string = latlng.lat() + ',' + latlng.lng() + '|' + map.zoom;
                                $this.find('input.tpfw_value').val(string).change();
                                map.overideMap(latlng);
                            });
                    setTimeout(map.onLoad, 500);
                }
            });
        }
    };

    $.fn.tpfwRepeater = function () {

        $(this).each(function () {
            var $repeater = $(this).repeater({
                defaultValues: {},
                show: function () {
                    $(this).slideDown();
                },
                hide: function (deleteElement) {
                    $(this).slideUp(deleteElement);
                },
                ready: function (setIndexes) {

                },
                render: {
                    image_picker: function ($field, name, val) {

                        var attach_images = val.split(',');

                        if (attach_images.length > 0) {

                            var image_item = '';

                            $.each(attach_images, function (index, image) {

                                image = image.split('|');
                                if (image.length === 2) {
                                    image_item += '<li class="added" data-id="' + image[0] + '">\n\
                                                    <div class="inner">\n\
                                                        <img alt="" src="' + tpfw_var.upload_url + decodeURIComponent(image[1]) + '"/>\n\
                                                    </div>\n\
                                                    <a href="#" class="remove"></a>\n\
                                                </li>';

                                }
                            });

                            $field.parent().find('.image_list').append(image_item);
                        }
                    },
                    color_picker: function ($field, name, val) {
                        $field.val(val);
                        $field.wpColorPicker({
                            change: function (e, ui) {
                                $(e.target).val(ui.color.toString()).change();
                            }
                        });
                    },
                    icon_picker: function ($field, name, val) {
                        $field.val(val).change();
                        $field.fontIconPicker();
                    },
                    checkbox: function ($field, name, val) {

                        if (val != '') {
                            val = val.split(',');
                            var $checboxes = $field.next();
                            for (var i in val) {
                                $checboxes.find('input[value="' + val[i] + '"]').attr('checked', 'checked');
                            }
                        }
                    },
                    select: function ($field, name, val) {

                        var $select = $field.parent().find('select');

                        if (val != '') {
                            if (typeof val == 'string') {
                                val = val.split(',');
                            }
                            for (var i in val) {
                                $select.find('option[value="' + val[i] + '"]').attr('selected', 'selected');
                            }
                            $select.change();
                        }

                        if (typeof $select.attr('multiple') != 'undefined') {
                            $select.selectize({
                                plugins: ['remove_button', 'drag_drop'],
                                onChange: function (value) {
                                    var $input = $(this)[0].$wrapper.closest('.repeater-col-field').find('input.tpfw_value');
                                    $input.val(value).change();
                                }
                            });
                        }
                    },
                    autocomplete: function ($field, name, val) {
                        var $select = $field.parent().find('select');

                        if (val != '') {
                            if (typeof val == 'string') {
                                val = val.split(',');
                            }
                            for (var i in val) {
                                $select.find('option[value="' + val[i] + '"]').attr('selected', 'selected');
                            }
                            $select.change();
                        }

                        $select.tpfwAutocomplete();
                    },
                    link: function ($field, name, val) {
                        var arr = val.split('|');
                        var data = {};
                        if (arr.length > 1) {
                            for (var i in arr) {
                                var child = arr[i].split(':');
                                data[child[0]] = decodeURIComponent(child[1]);
                            }
                            $field.data('json', data);
                            $field.parent().find('.url-label').html(data.url + data.target);
                            $field.parent().find('.title-label').html(data.title);
                        }
                    },
                    datetime: function ($field, name, val) {
                        $field.datetimepicker($field.data());
                    }
                }
            });

            var data = $repeater.data('value');

            if (typeof data == 'object') {
                $repeater.setList(data);
            }

            /**
             * Init dependency
             */
            if ($repeater.find('div[data-rpt_dependency]').length) {
                $repeater.find('div[data-rpt_dependency]').initRepeaterDependency();
            }
        });

        /**
         *Edit
         */
        $document.on('click', '.tpfw-repeater [data-repeater-edit], .tpfw-repeater .tpfw-widget-title h4', function (e) {

            var $parent = $(this).closest(".tpfw-widget");

            if ($parent.hasClass('open')) {
                $parent.find('.tpfw-widget-inside').slideUp('fast', function () {
                    $parent.removeClass('open');
                });

            } else {

                $parent.find('.tpfw-widget-inside').slideDown('fast', function () {
                    $parent.addClass('open');
                    $document.trigger('tpfw-repeater-item-opened', [$parent]);
                });
            }

            e.preventDefault();
        });

    };

    $.fn.tpfwTypography = function () {

        var typography_data = {};

        var is_font_changed = false;

        var font_changed = function ($wrapper, data, data2) {

            var font_formated = {
                'font-family': data.value
            };

            var $subsets = $wrapper.find('.subsets select');
            var $variants = $wrapper.find('.variants select');
            var $subsets_selectize = $subsets[0].selectize;
            var $variants_selectize = $variants[0].selectize;

            if (data.variants != '') {

                var variants = data.variants.split(',');
                var options = [];
                var _variants = tpfw_var.variants;


                for (var i in data.variants) {
                    var text = _variants.hasOwnProperty(variants[i]) ? _variants[variants[i]] : variants[i];
                    options.push({text: text, value: variants[i]});
                }

                $variants_selectize.enable();
                $variants_selectize.clearOptions();
                $variants_selectize.addOption(options);

                if (typeof data2 == 'object' && data2.hasOwnProperty('variants')) {
                    var selected_variants = data2.variants.split(',');
                    $variants_selectize.addItems(selected_variants);
                } else {

                    $variants_selectize.addItems(variants);
                }


                font_formated['variants'] = data.variants;
            } else {
                $variants_selectize.clearOptions();
                $variants_selectize.disable();
            }

            if (data.subsets != '') {

                var subsets = data.subsets.split(',');
                var options = [];
                var _subsets = tpfw_var.subsets;

                for (var i in subsets) {
                    var text = _subsets.hasOwnProperty(subsets[i]) ? _subsets[subsets[i]] : subsets[i];
                    options.push({text: text, value: subsets[i]});
                }

                $subsets_selectize.enable();
                $subsets_selectize.clearOptions();
                $subsets_selectize.addOption(options);

                if (typeof data2 == 'object' && data2.hasOwnProperty('subsets')) {
                    var selected_subsets = data2.subsets.split(',');
                    $subsets_selectize.addItems(selected_subsets);
                } else {
                    if ($.inArray('latin', subsets) >= 0) {
                        $subsets_selectize.addItem('latin');
                        font_formated['subsets'] = 'latin';
                    }
                }



            } else {
                $subsets_selectize.clearOptions();
                $subsets_selectize.disable();
            }

            if (typeof data2 == 'function') {
                data2(font_formated);
            }
        }

        var $typography = $(this);

        var $typo_font_family = $typography.find('.font_family select');

        $typography.find('.variants select').selectize({
            plugins: ['remove_button'],
            create: false,
            onChange: function (value) {
                if (!is_font_changed) {
                    var $field = $(this)[0].$wrapper.closest('.tpfw-typography');

                    var id = $field.data('id');

                    var _typography_data = typography_data[id];

                    var text = $field.data('value');

                    if (text != '') {

                        if (_typography_data.hasOwnProperty('variants')) {
                            _typography_data.variants = value.join(',');

                            var val = encodeURIComponent(JSON.stringify(_typography_data));
                            typography_data[id] = _typography_data;
                            $field.find('.tpfw_value').val(val).change();

                        }
                    }
                }
            }
        });

        $typography.find('.subsets select').selectize({
            plugins: ['remove_button'],
            create: false,
            onChange: function (value) {
                if (!is_font_changed) {
                    var $field = $(this)[0].$wrapper.closest('.tpfw-typography');

                    var id = $field.data('id');

                    var _typography_data = typography_data[id];

                    var text = $field.data('value');

                    if (text != '') {
                        if (_typography_data.hasOwnProperty('subsets')) {
                            _typography_data['subsets'] = value.join(',');
                            var val = encodeURIComponent(JSON.stringify(_typography_data));
                            typography_data[id] = _typography_data;
                            $field.find('.tpfw_value').val(val).change();
                        }
                    }

                }
            }
        });

        $typo_font_family.selectize({
            labelField: "label",
            valueField: "value",
            searchField: "label",
            create: false,
            options: tpfw_var.fonts,
            render: {
                option: function (item, escap) {
                    return "<div class='option' data-value='" + item.value + "' data-variants='" + item.variants + "' data-subsets='" + item.subsets + "'>" + item.label + " </div>";
                }
            },
            onInitialize: function () {

                var $field = $(this)[0].$wrapper.closest('.tpfw-typography');

                var id = $field.data('id');

                typography_data[id] = {};

                var value = $field.data('value');

                if (value != '') {

                    var data = JSON.parse(decodeURIComponent(value));

                    if (data.hasOwnProperty('font-family')) {
                        typography_data[id] = data;
                        $(this)[0].addItem(data['font-family']);
                    }
                }
            },
            onChange: function (value) {

                is_font_changed = true;

                if (value == '') {
                    return;
                }

                var $field = $(this)[0].$wrapper.closest('.tpfw-typography');

                var id = $field.data('id');

                var _typography_data = typography_data[id];

                if (_typography_data.hasOwnProperty('font-family') && _typography_data['font-family'] === value) {

                    font_changed($field, this.options[value], _typography_data);

                } else {

                    font_changed($field, this.options[value], function (data) {

                        _typography_data['font-family'] = data['font-family'];
                        _typography_data['subsets'] = data['subsets'];
                        _typography_data['variants'] = data['variants'];

                        var val = encodeURIComponent(JSON.stringify(_typography_data));

                        $field.find('.tpfw_value').val(val).change();

                        typography_data[id] = _typography_data;

                    });
                }

                is_font_changed = false;

            }
        });

        $typography.on('change', '.subrow input, .subrow select', function (e) {

            var key = $(this).data('key');

            var $this = $(this);

            var $field = $this.closest('.tpfw-typography');

            var id = $field.data('id');

            var value = $this.val();

            if (value != '') {

                typography_data[id][key] = $this.val();

                var val = encodeURIComponent(JSON.stringify(typography_data[id]));

                $field.find('.tpfw_value').val(val).change();
            }

            e.preventDefault();
        });
    }

    $.fn.tpfwAutocomplete = function () {
        $(this).selectize({
            valueField: 'value',
            searchField: 'label',
            labelField: 'label',
            options: [],
            create: false,
            plugins: ['remove_button', 'drag_drop'],
            render: {
                option: function (item, escape) {
                    return '<div class="option" data-value="' + item.value + '">#' + item.value + ' - ' + escape(item.label) + '</div>';
                }
            },
            load: function (query, callback) {

                var $container = $(this)[0].$wrapper.closest('.tpfw-field');

                var min_length = $container.data('min_length');

                if (query.length < parseInt(min_length))
                    return callback();

                var type = $container.data('ajax_type');

                var values = $container.data('ajax_value');

                $.ajax({
                    url: ajaxurl,
                    type: 'GET',
                    data: {
                        action: 'tpfw_autocomplete_' + type,
                        types: values,
                        s: query
                    },
                    error: function () {
                        callback();
                    },
                    success: function (data) {
                        callback(data);
                    }
                });
            }
        });
    };

    $.fn.initWidgetDependency = function () {

        $(this).each(function () {

            var dependency = $(this).data('dependency');
            var param_name = $(this).data('param_name');

            if (dependency != undefined && _.isObject(dependency)) {

                var widget_id = '#';
                if ($(this).closest('.widget').length) {
                    widget_id = '#widget-' + $(this).closest('.widget').find('input.widget-id').val() + '-';
                }

                var el = Object.keys(dependency);

                _.each(el, function (key) {
                    dependency[widget_id + key] = dependency[key];
                    delete(dependency[key]);
                });

                var $slave = $('#' + param_name + ".tpfw_value");

                $slave.dependsOn(dependency);
            }
        });
    }

    $.fn.initRepeaterDependency = function () {

        $(this).each(function () {

            var index = $(this).closest('.tpfw_repeater__item').index();
            var repeater_id = $(this).closest('.tpfw-repeater').attr('data-name') + '-' + index + '-';

            var dependency = $(this).data('rpt_dependency');
            var param_name = $(this).data('param_name');

            if (dependency != undefined && _.isObject(dependency)) {

                var el = Object.keys(dependency);

                _.each(el, function (key) {
                    dependency['#' + repeater_id + key] = dependency[key];
                    delete(dependency[key]);
                });

                var $slave = $('#' + repeater_id + param_name + ".tpfw_value");

                $slave.dependsOn(dependency);
            }
        });
    }

    $.fn.initMenuDependency = function () {

        $(this).each(function () {

            var dependency = $(this).data('dependency');
            var param_name = $(this).data('param_name');
            var menu_item = $(this).data('menu_item');

            if (dependency != undefined && typeof dependency == 'object') {

                var el = Object.keys(dependency);
                
                $.each(el, function (index, key) {
                    dependency['#' + key + '-' + menu_item] = dependency[key];
                    delete(dependency[key]);
                });

                var $slave = $('#' + param_name + ".tpfw_value");
                $slave.dependsOn(dependency);
            }

        });
    };

    $.fn.initDependency = function () {

        $(this).each(function () {

            var dependency = $(this).data('dependency');
            var param_name = $(this).data('param_name');

            if (dependency != undefined && typeof dependency == 'object') {

                var el = Object.keys(dependency);

                $.each(el, function (index, key) {
                    dependency['#' + key] = dependency[key];
                    delete(dependency[key]);
                });

                var $slave = $('#' + param_name + ".tpfw_value");

                $slave.dependsOn(dependency);
            }
        });

    }

});

var Tpfw_Repeater_Item = function ($list, $item, isAdd) {
    'use strict';

    var self = this;

    this.list = $list;

    this.container = $item;

    this.control = $list.prev('.tpfw_value');

    this.container.on('keyup change', '.tpfw_value', function (e) {
        self.setValues();
    });

    this.setValues = function () {

        var values = [];

        self.list.find('[data-repeater-item]').each(function () {

            var fields = {};

            jQuery(this).find('.tpfw_value').each(function () {
                var $this = jQuery(this);
                if ($this.attr('type') != 'radio' || ($this.attr('type') == 'radio' && $this.is(':checked'))) {
                    var key = jQuery(this).attr('name').match(/\[([^\]]*)(\]|\]\[\])$/)[1];
                    fields[key] = jQuery(this).val();
                }
            });

            values.push(fields);
        });

        self.control.val(JSON.stringify(values)).trigger('change');
    }

    if (isAdd) {
        self.setValues();
    }
}