jQuery(document).ready(function($) {

    function wop_u(e) {
        return ["0x" + e[1] + e[2] | 0, "0x" + e[3] + e[4] | 0, "0x" + e[5] + e[6] | 0];
    }
    var all_sliders = $('.ui-slider');
    $.each(all_sliders, function(index, obj) {
        var default_value = parseInt($(obj).data('value'));
        var min = parseInt($(obj).data('min'));
        var max = parseInt($(obj).data('max'));
        $(obj).slider({
            range: "min",
            value: default_value,
            min: min,
            max: max,
            change: function() {
                $(this).find('input[type="hidden"]').val($(this).slider('option', 'value'));
                var obj_type = $(this).find('input[type="hidden"]').attr('id');
                if (obj_type == 'overlay_width') {
                    $('.overlay').data('width', $(this).slider('option', 'value'));
                }
                if (obj_type == 'overlay_height') {
                    $('.overlay').data('height', $(this).slider('option', 'value'));
                }
                if (obj_type == 'animation_speed') {
                    $('.overlay').data('speed', $(this).slider('option', 'value'));
                }
                if (obj_type == 'opacity_value') {
                    var selected_value = $(this).slider('option', 'value');
                    var op;
                    if (selected_value == 100) op = "1.0";
                    else op = "0." + selected_value;
                    var r = $("input[name='overlay_color']").val();
                    r = "rgb(" + wop_u(r) + ")";
                    console.log(r);
                    var i = /rgb\((\d{1,3}),(\d{1,3}),(\d{1,3})\)/;
                    var s = i.exec(r);
                    if (s !== null) {
                        $('.overlay').data('color', "rgba(" + s[1] + "," + s[2] + "," + s[3] + "," + op + ")");
                    }
                }

            }
        });
    });

    $(".wpgmp-overview .color").wpColorPicker({
        hide: true,
        change: function(t, n) {
            var selected_value = $('input[name="opacity_value"]').val();
            console.log(selected_value);
            var op;
            if (selected_value == 100) op = "1.0";
            else op = "0." + selected_value;
            var r = $("a.wp-picker-open").css("background-color");
            r = r.replace(' ', '');
            r = r.replace(' ', '');
            console.log(r);
            var i = /rgb\((\d{1,3}),(\d{1,3}),(\d{1,3})\)/;
            var s = i.exec(r);
            console.log(s);
            if (s !== null) {
                $('.overlay').data('color', "rgba(" + s[1] + "," + s[2] + "," + s[3] + "," + op + ")");
            }
        }
    });

    $('select[name="slide_effect"]').change(function() {
        $('.overlay').data('in', $(this).val());
    });

    $('select[name="slide_effect_exit"]').change(function() {
        $('.overlay').data('out', $(this).val());
    });

    $('select[name="slide_text_position"]').change(function() {
        $('.overlay').find('div[rel="overlay-content-placeholder"]').removeClass().addClass($(this).val());
    });

    $('.wpgmp_datepicker').datepicker({
        dateFormat: 'dd-mm-yy'
    });

    var wpp_image_id = '';
    //intialize add more...
    $("body").on('click', ".repeat_button", function() {
        //find out which container we need to copy.
        var target = $(this).parent().parent();
        var new_element = $(target).clone();
        //incrase index here
        var inputs = $(new_element).find("input[type='text']");
        for (var i = 0; i < inputs.length; i++) {
            var element_name = $(inputs[i]).attr("name");
            var patt = new RegExp(/\[([0-9]+)\]/i);
            var res = patt.exec(element_name);
            var new_index = parseInt(res[1]) + 1;
            var name = element_name.replace(/\[([0-9]+)\]/i, "[" + new_index + "]");
            $(inputs[i]).attr("name", name);
        }
        $(new_element).find("input[type='text']").val("");
        $(target).find(".repeat_button").text("Remove");
        $(target).find(".repeat_button").removeClass("repeat_button").addClass("repeat_remove_button");
        $(target).after($(new_element));

    });
    //Delete add more...
    $("body").on('click', ".repeat_remove_button", function() {
        //find out which container we need to copy.
        var target = $(this).parent().parent();
        var temp = $(target).clone();
        $(target).remove();
        //reindexing
        var inputs = $(temp).find("input[type='text']");
        $.each(inputs, function(index, element) {
            var current_name = $(this).attr("name");
            var name = current_name.replace(/\[([0-9]+)\]/i, "");
            $.each($("*[name^='" + name + "']"), function(index, element) {
                current_name = $(this).attr('name');
                var name = current_name.replace(/\[([0-9]+)\]/i, "[" + index + "]");
                $(this).attr("name", name);
            });
        });

    });

    $('span.delete a').click(function() {

        if (confirm(wpp_js_lang.confirm))
            return true;

        return false;

    });

    $("div.wpp_form_horizontal .wpp_add_more_fields").click(function() {

        var wpp_length = $(".form-group").length + 1;

        var more_textbox = $('<div class="row form-group">' +
            '<div class="col-md-8"><input  placeholder="Enter name here..." class="form-control" type="text" name="name[]" id="txtbox' + wpp_length + '" /></div>' +
            '<div class="col-md-2"><a href="javascript:void(0);" class="btn btn-danger btn-xs wpp_remove_more_fields">Remove</a>' +
            '</div></div>');

        more_textbox.hide();
        $(".form-group:last").after(more_textbox);
        more_textbox.fadeIn("slow");

        return false;
    });


    $('div.wpp_form_horizontal').on('click', '.wpp_remove_more_fields', function() {

        var remove = confirm("Are you sure you want to delete ? ");
        if (remove == true) {
            var id = $(this).attr('id');
            $(this).parent().parent().css('background-color', '#FF6C6C');
            $(this).parent().parent().css('padding-top', '5px');
            $(this).parent().parent().fadeOut("slow", function() {

                $(this).remove();
                $('.label-numbers').each(function(index) {
                    $(this).text(index + 1);
                });

            });


            jQuery.ajax({
                type: "POST",
                url: wpp_local.urlforajax,
                data: {
                    action: 'wpp_ajax_operation',
                    'id': id
                },
                beforeSend: function() {},
                success: function(data) {}

            });
            return false;

        } else {
            return false;
        }



    });

    window.send_to_editor_default = window.send_to_editor;

    $('.choose_image').click(function() {
        var target = "icon_hidden_input";
        wpp_image_id = $(this).parent().parent().attr('id', target);
        window.send_to_editor = window.attach_image;
        tb_show('', 'media-upload.php?post_ID=0&target=' + target + '&type=image&TB_iframe=true');
        return false;
    });

    window.attach_image = function(html) {
        $('body').append('<div id="temp_image">' + html + '</div>');
        var img = $('#temp_image').find('img');
        imgurl = img.attr('src');
        imgclass = img.attr('class');
        imgid = parseInt(imgclass.replace(/\D/g, ''), 10);
        $(wpp_image_id).find('.remove_image').show();
        $(wpp_image_id).find('img.selected_image').attr('src', imgurl);
        var img_hidden_field = $(wpp_image_id).find('.choose_image').data('target');
        $(wpp_image_id).find('input[name="' + img_hidden_field + '"]').val(imgurl);
        try {
            tb_remove();
        } catch (e) {};
        $('#temp_image').remove();
        window.send_to_editor = window.send_to_editor_default;
    }


    $('.remove_image').click(function() {
        wpp_image_id = $(this).parent().parent();
        $(wpp_image_id).find('.selected_image').attr('src', '');
        $(wpp_image_id).find('input[name="' + $(this).data('target') + '"]').val('');
        $(this).hide();
        return false;
    });

    $('.switch_onoff').change(function() {
        var target = $(this).data('target');
        if ($(this).attr('type') == 'radio') {
            $(target).closest('.form-group').hide();
            target += '_' + $(this).val();
        }
        if ($(this).is(":checked")) {
            $(target).closest('.form-group').show();
        } else {
            $(target).closest('.form-group').hide();
            if ($(target).hasClass('switch_onoff')) {
                $(target).attr('checked', false);
                $(target).trigger("change");
            }
        }


    });

    $.each($('.switch_onoff'), function(index, element) {
        if (true == $(this).is(":checked")) {
            $(this).trigger("change");
        }

    });

    $("input[name='wpp_refresh']").trigger('change');
});

jQuery(document).ready(function(e) {
    e(".overlay-effect[rel='custom_overlay'] .img").mouseenter(function() {
        e(this).addClass("hover");
        target_object = e(this).parent().find(".overlay");
        target_object.css({
            "-webkit-animation-duration": target_object.data("speed") + "s",
            "-moz-animation-duration": target_object.data("speed") + "s",
            "-o-animation-duration": target_object.data("speed") + "s",
            "-animation-duration:": target_object.data("speed") + "s",
            "background-color": target_object.data("color")
        });
        var t = new String(target_object.data("height"));
        h_index = t.indexOf("px");
        if (h_index != -1) height = t;
        else height = t + "%";
        var n = new String(target_object.data("width"));
        w_index = n.indexOf("px");
        if (w_index != -1) width = n;
        else width = n + "%";
        target_object.css({
            height: height,
            width: width
        });
        in_effect = target_object.data("in");
        target_object.removeClass().addClass("overlay").addClass(in_effect + " animated ")
    }).mouseleave(function() {
        out_effect = e(this).parent().find(".overlay").data("out");
        e(this).parent().find(".overlay").removeClass().addClass("overlay").addClass(out_effect + " animated")
    })
})
