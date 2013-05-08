jQuery(document).ready(function($){
    $('.jotform-color-field').wpColorPicker();
   
    if(jQuery("#lightBoxType").val() != "") {
        jQuery("[data-value='"+jQuery("#lightBoxType").val()+"']").parent().addClass("selectedStyle");
    }
    $('.styleBrowser').on("click",function(){
        $(".selectedStyle").removeClass("selectedStyle");
        $(this).addClass("selectedStyle");
        jQuery("#lightBoxType").val($(this).find("div").attr("data-value"));
    });
    $('#pickForm').on("click",function() {
        event.preventDefault();
        var jotformFormPicker = new JotFormFormPicker();
        jotformFormPicker.openWizard(setFormID);

    });
    function setFormID(formID){
        $("#formID").val(formID);
    }
});


function JotFormFormPicker () {
    this.url = "http://www.jotform.com/myforms3/form.picker.php";
    this.closeWizard = function() {
        jQuery(this.wizard).remove();
    };

    this.openWizard = function(callback) {
        $this = this;
        XD.receiveMessage(function(message){
            callback(message.data);
            $this.closeWizard();
        }, 'http://www.jotform.com');

        if(jQuery('#jotformFormWizard').length) {
            //console.log("wizard is already open");
        }
        else {
            var wizardStyles = {
                position : "absolute",
                width: "700px",
                height : "500px",
                left : "50%",
                top : "50%",
                border : "1px dashed black",
                "z-index" : "10000",
                opacity: 1,
                borderTopLeftRadius: "10px",
                borderTopRightRadius: "10px",
                borderBottomRightRadius: "10px",
                borderBottomLeftRadius: "10px",
                backgroundColor : "#FFF"
            };

            wizardStyles.marginLeft = "-"+(wizardStyles.width.replace("px","")/2)+"px";
            wizardStyles.marginTop = "-"+(wizardStyles.height.replace("px","")/2)+"px";


            this.wizard = document.createElement("div");
            this.wizardIFrame = document.createElement("iframe");
            this.closeButton = document.createElement("img");

            jQuery(this.closeButton).attr('src','http://www.jotform.com/images/close-wiz-white.png').css({"position":"absolute", "top":"-15px","right":"-15px"}).appendTo(this.wizard);
            jQuery(this.wizardIFrame).appendTo(jQuery(this.wizard)).attr("src",this.url+'#' + encodeURIComponent(document.location.href)).css({width : "100%", "height": "100%"});
            jQuery(this.wizard).appendTo(jQuery("body")).attr("id","jotformFormWizard").css(wizardStyles).on("click",function(){
                console.log("close wizard");
                $this.closeWizard();
            });
        }
    }
}


// everything is wrapped in the XD function to reduce namespace collisions
var XD = function(){

    var interval_id,
    last_hash,
    cache_bust = 1,
    attached_callback,
    window = this;

    return {
        postMessage : function(message, target_url, target) {
            if (!target_url) {
                return;
            }
            target = target || parent;  // default to parent
            if (window['postMessage']) {
                // the browser supports window.postMessage, so call it with a targetOrigin
                // set appropriately, based on the target_url parameter.
                target['postMessage'](message, target_url.replace( /([^:]+:\/\/[^\/]+).*/, '$1'));
            } else if (target_url) {
                // the browser does not support window.postMessage, so use the window.location.hash fragment hack
                target.location = target_url.replace(/#.*$/, '') + '#' + (+new Date) + (cache_bust++) + '&' + message;
            }
        },
        receiveMessage : function(callback, source_origin) {
            // browser supports window.postMessage
            if (window['postMessage']) {
                // bind the callback to the actual event associated with window.postMessage
                if (callback) {
                    attached_callback = function(e) {
                        if ((typeof source_origin === 'string' && e.origin !== source_origin)
                        || (Object.prototype.toString.call(source_origin) === "[object Function]" && source_origin(e.origin) === !1)) {
                             return !1;
                         }
                         callback(e);
                     };
                 }
                 if (window['addEventListener']) {
                     window[callback ? 'addEventListener' : 'removeEventListener']('message', attached_callback, !1);
                 } else {
                     window[callback ? 'attachEvent' : 'detachEvent']('onmessage', attached_callback);
                 }
             } else {
                 // a polling loop is started & callback is called whenever the location.hash changes
                 interval_id && clearInterval(interval_id);
                 interval_id = null;
                 if (callback) {
                     interval_id = setInterval(function() {
                         var hash = document.location.hash,
                         re = /^#?\d+&/;
                         if (hash !== last_hash && re.test(hash)) {
                             last_hash = hash;
                             callback({data: hash.replace(re, '')});
                         }
                     }, 100);
                 }
             }
         }
    };
}();

