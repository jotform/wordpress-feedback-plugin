/**
* Plugin Name: Jotform Feedback Button
* Plugin URI: http://wordpress.org/plugins/jotform-feedback-button/
* Description: Display a beautiful feedback button on the side of your blog. When a reader clicks on it a feedback form pops up. Completely customizable.
* Author: Jotform
* License: GPLv2 or later
* License URI: https://www.gnu.org/licenses/gpl-2.0.html
* Version: 1.0.7
* Author URI: https://www.jotform.com/
*/

jQuery(document).ready(function($){
    $.getScript("//js.jotform.com/JotFormFormPicker.js", function(data, textStatus, jqxhr) {
        $('#pickForm').on("click",function() {
            event.preventDefault();
            var jotformFormPicker = new JotFormFormPicker();
            jotformFormPicker.openWizard(setFormID);
        });
    });

    $('.jotform-color-field').wpColorPicker();

    if(jQuery("#lightBoxType").val() != "") {
        jQuery("[data-value='"+jQuery("#lightBoxType").val()+"']").parent().addClass("selectedStyle");
    }

    $('.styleBrowser').on("click",function(){
        $(".selectedStyle").removeClass("selectedStyle");
        $(this).addClass("selectedStyle");
        jQuery("#lightBoxType").val($(this).find("div").attr("data-value"));
    });

    function setFormID(formObject){
        $("#formID").val(formObject.id || false);
    }
});

