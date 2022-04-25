/*
    Plugin Name: Jotform Feedback Button
    Plugin URI: http://www.jotform.com/labs/wordpress
    Description: Display a beautiful feedback button on the side of your blog. When a reader clicks on it a feedback form pops up. Completely customizable.
    Version: 1.0.4
    Author: Jotform.com
    Author URI: http://www.jotform.com
    License: MIT
*/

jQuery(document).ready(function ($) {

    var defaultVales = JFBCONST.defaultValues;

    setSelectedOptions();

    $(window).resize(function (e) {
        setStickyFooterWidth();
    });

    $.getScript("//js.jotform.com/JotFormFormPicker.js", function (data, textStatus, jqxhr) {
        $('#pickForm').on("click", function () {
            event.preventDefault();
            var jotformFormPicker = new JotFormFormPicker();
            jotformFormPicker.openWizard(setFormID);
        });
    });

    $('#jfbColorPickerButton, #jfbColorPickerText').wpColorPicker({
        defaultColor: true,
        change: function (e, ui) {
            $('#' + $(e.target).attr('id') + "Val").text(ui.color.toString());
            setPreviewColors($(e.target).attr('id'), ui.color.toString());
        }
    });


    $(".jfb-button-position-value").on("change", function (e) {
        setButtonPositionOptionsSrc($(this).val());
        setPreview();
    });

    $(".jfb-button-alignment-value").on("change", function (e) {
        setPreview();
    });

    $('#jfbButtonText').on('change keyup', function (e) {
        if ($(this).val().length > 30) {
            $(this).val($(this).val().substr(0, 30));
            return;
        }

        $('.jfb-preview-badged').text($(this).val());
        $('.jfb-preview-form-header').text($(this).val());
    });

    $('#jfbForm').submit(function (e) {
        if ($('#jfbButtonText').val().trim().length == 0) {
            $('#jfbButtonText').val(defaultVales.formTitle);
        }

        if (!Number($('#jfbFormHeight').val())) {
            $('#jfbFormHeight').val(defaultVales.formHeight);
        }

        if (!Number($('#jfbFormWidth').val())) {
            $('#jfbFormWidth').val(defaultVales.formWidth);
        }

        return true;
    });

    $('.jfb-form-save-button').on('click', function(e) {
        $('#jfbForm').trigger('submit');
    });

    $('.jfb-svg-option').on('click', function (e) {
        $(this).parent().children('.jfb-svg-option').removeClass("jfb-svg-option-selected");
        $(this).parent().children('input').val($(this).attr('data-value')).change();
        $(this).addClass("jfb-svg-option-selected");
    });

    $('.jfb-preview-toggle-button').on('click', function (e) {
        if ($(this).attr('data-show') === "on") {
            $(this).animate({left:"90%"}, 2000);
            $(this).attr('data-show', 'off');
            $('.jfb-ptb-icon').attr('src', (JFBCONST.pluginUrl + "/images/preview-icon.svg"));
            $('.jfb-ptb-text').text('PREVIEW');
            $('.jfb-preview-col').fadeOut();
            return;
        }

        $(this).animate({left:"60%"}, 2000);
        $(this).attr('data-show', 'on');
        $('.jfb-ptb-icon').attr('src', (JFBCONST.pluginUrl + "/images/hide-icon.svg"));
        $('.jfb-ptb-text').text('HIDE');
        $('.jfb-preview-col').fadeIn();
    });

    $('.jfb-lightbox-style').on('click', function (e) {
        setLightbox();
        setPreviewColors();
    });

    $('.jfb-send-feedback-button').on('click', function (e) {
        $('.jfb-feedback-popup').fadeIn(500);
    });

    $('.jfb-feedback-popup-close-button').on('click', function (e) {
        $('.jfb-feedback-popup').fadeOut(500);
    });


    function setFormID(formObject) {
        $("#formID").val(formObject.id || false);
        $("#formNativeTitle").val(formObject.title || null);
        $("#formLabel").text(formObject.title);

        $('.jfb-form-save-button').attr('disabled', false);
        $('.jfb-form-picker-icon').attr('src', (JFBCONST.pluginUrl + "/images/form-icon.svg"));
    }

    function setSelectedOptions() {
        var lsVal = $('.jfb-lightbox-style-value').val();
        var bpVal = $('.jfb-button-position-value').val();
        var baVal = $('.jfb-button-alignment-value').val();

        $(".jfb-lightbox-style[data-value="+lsVal+"]").addClass("jfb-svg-option-selected");
        $(".jfb-button-position[data-value="+bpVal+"]").addClass("jfb-svg-option-selected");
        $(".jfb-button-alignment[data-value="+baVal+"]").addClass("jfb-svg-option-selected");

        var position = $(".jfb-button-position + .jfb-svg-option-selected").attr('data-value');
        setLightbox();
        setButtonPositionOptionsSrc(position);
        setStickyFooterWidth();
        setPreview();

        $('.jfb-page-container').css("display", "flex");
    }

    function setPreview() {
        var previewBadged = $(".jfb-preview-badged");

        var position = $(".jfb-button-position-value").val();
        var aligment = $(".jfb-button-alignment-value").val();
        var positionClass = "jfb-badged-position-" + aligment + "-" + position;

        previewBadged.removeClass();
        previewBadged.addClass(("jfb-preview-badged " + positionClass));

        setPreviewColors();
    }

    function setPreviewColors(objType, color) {
        var buttonColor,
            textColor,
            lightboxCheck = $('.jfb-preview-form').hasClass('jfb-preview-form-selected-simple');

        if (objType === 'jfbColorPickerButton') {
            buttonColor = color;
        } else {
            buttonColor = $('#jfbColorPickerButton').val();
        }

        if (objType === 'jfbColorPickerText') {
            textColor = color;
        } else {
            textColor = $('#jfbColorPickerText').val();
        }

        $(".jfb-preview-badged").css("background-color", buttonColor);
        $(".jfb-preview-badged").css("color", textColor);
        $('.jfb-preview-form-header').css('background-color', buttonColor);
        $('.jfb-preview-form').css('border-color', (lightboxCheck ? "#000" : buttonColor));
    }

    function setButtonPositionOptionsSrc(position) {
        $(".jfb-ssba-left").removeClass().addClass("jfb-ssba-left jfb-ssba-"+position+"-left");
        $(".jfb-ssba-center").removeClass().addClass("jfb-ssba-center jfb-ssba-"+position+"-center");
        $(".jfb-ssba-right").removeClass().addClass("jfb-ssba-right jfb-ssba-"+position+"-right");
    }

    function setStickyFooterWidth() {
        var reduceWidth = $('#adminmenuwrap').css('width');

        if ($('#adminmenuwrap').css('display') === 'none') {
            reduceWidth = 0;
        }

        $('.jfb-sticky-footer').css('width', ('calc(100% - ' + reduceWidth + ')'));
    }

    function setLightbox() {
        if ($('.jfb-lightbox-style-value').val() === 'border') {
            $('.jfb-preview-form').removeClass().addClass('jfb-preview-form jfb-preview-form-selected-border');
        } else if ($('.jfb-lightbox-style-value').val() === 'simple') {
            $('.jfb-preview-form').removeClass().addClass('jfb-preview-form jfb-preview-form-selected-simple');
        } else {
            $('.jfb-preview-form').removeClass().addClass('jfb-preview-form');
        }
    }
});

