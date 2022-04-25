<div class="jfb-page-container" style="display: none;position: relative;">
    <button class="jfb-preview-toggle-button" data-show="on">
        <img class="jfb-ptb-icon" src="<?= plugins_url('/images/hide-icon.svg', __FILE__) ?>">
        <p class="jfb-ptb-text">HIDE</p>
    </button>
    <div class="jfb-col jfb-options-col">
        <div class="jfb-page-title-container">
            <img src="<?= plugins_url('/images/jotform-icon.svg', __FILE__) ?>"> <h1 class="jfb-page-title">Jotform Feedback Button</h1>
        </div>
        <div class="jfb-divider"></div>
        <div class="jfb-main-form-container">
            <form id="jfbForm" method="post" action="options.php">
                <?php settings_fields('jotform-wp-feedback-options'); ?>
                <?php do_settings_fields('jotform-wp-feedback-options', "buttonOptions"); ?>
                <h2 class="jfb-form-title">Form Settings</h2>
                <div class="jfb-divider"></div>
                <div class="jfb-form-row">
                    <div class="jfb-form-col jfb-form-label">
                        <label>Form</label>
                    </div>
                    <div class="jfb-form-col-2 jfb-form-input">
                        <input type="hidden" name="buttonOptions[formID]" value="<?= $options["formID"] ?>" id="formID">
                        <input type="hidden" name="buttonOptions[formNativeTitle]" id="formNativeTitle"
                               value="<?= $options["formNativeTitle"] ?>">
                        <div class="jfb-form-picker" id="pickForm">

                            <?php
                                if (empty($options["formNativeTitle"])) {
                                    $formPickerIcon = plugins_url('/images/form-icon-empty.svg', __FILE__);
                                    $formPickerText = "Select a form to get data from";
                                    $saveButtonStatus = 'disabled="true"';
                                } else {
                                    $formPickerIcon = plugins_url('/images/form-icon.svg', __FILE__);
                                    $formPickerText = $options["formNativeTitle"];
                                    $saveButtonStatus = "";
                                }
                            ?>

                            <img class="jfb-form-picker-icon"
                                 src="<?= $formPickerIcon ?>">
                            <p id="formLabel">
                                <?= $formPickerText ?>
                            </p>
                            <img class="jfb-form-picker-arrow"
                                 src="<?= plugins_url('/images/form-picker-arrow.svg', __FILE__) ?>">
                        </div>
                    </div>
                </div>
                <div class="jfb-form-row">
                    <div class="jfb-form-col jfb-form-label">
                        <label>Lightbox Style</label>
                    </div>
                    <div class="jfb-form-col-2 jfb-form-input">
                        <div class="jfb-svg-choose-container">
                            <input  type="hidden" class="jfb-lightbox-style-value" name="buttonOptions[lightBoxType]" value="<?= $options["lightBoxType"] ?>">
                            <div class="jfb-lightbox-style jfb-svg-option" data-value="header">
                                <div class="jfb-svg-square jfb-svg-square-header"></div>
                            </div>
                            <div class="jfb-lightbox-style jfb-svg-option" data-value="border">
                                <div class="jfb-svg-square jfb-svg-square-border"></div>
                            </div>
                            <div class="jfb-lightbox-style jfb-svg-option" data-value="simple">
                                <div class="jfb-svg-square jfb-svg-square-filled"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="jfb-form-row">
                    <div class="jfb-form-col jfb-form-label">
                        <label>Lightbox Dimensions (in px)</label>
                    </div>
                    <div class="jfb-form-col-2 jfb-form-input jfb-display-flex">
                        <div class="jfb-form-size-container">
                            <label class="jfb-mr-1 jfb-36-width">Width</label>
                            <input type="number" class="jfb-form-input-element jfb-text-center"
                                   name="buttonOptions[formWidth]"
                                   value="<?= $options["formWidth"] ?>"
                                   id="jfbFormWidth">
                        </div>
                        <div class="jfb-form-size-container">
                            <label class="jfb-mr-1 jfb-36-width">Height</label>
                            <input type="number" class="jfb-form-input-element jfb-text-center"
                                   name="buttonOptions[formHeight]"
                                   value="<?= $options["formHeight"] ?>"
                                   id="jfbFormHeight">
                        </div>
                    </div>
                </div>
                <h2 class="jfb-form-title jfb-pt-3">Button Settings</h2>
                <div class="jfb-divider"></div>
                <div class="jfb-form-row">
                    <div class="jfb-form-col jfb-form-label">
                        <label>Button Text</label>
                    </div>
                    <div class="jfb-form-col-2 jfb-form-input">
                        <div class="jfb-button-text-field">
                            <input type="text" id="jfbButtonText" name="buttonOptions[formTitle]"
                                   value="<?= $options["formTitle"] ?>">
                        </div>
                    </div>
                </div>
                <div class="jfb-form-row">
                    <div class="jfb-form-col jfb-form-label">
                        <label>Button Position</label>
                    </div>
                    <div class="jfb-form-col-2 jfb-form-input">
                        <div class="jfb-svg-choose-container">
                            <input type="hidden"
                                   class="jfb-button-position-value"
                                   name="buttonOptions[screenAlignment]"
                                   value="<?= $options["screenAlignment"] ?>" >
                            <div class="jfb-button-position jfb-svg-option" data-value="left">
                                <div class="jfb-svg-square">
                                    <div class="jfb-svg-square-badged jfb-ssbp-left"></div>
                                </div>
                            </div>
                            <div class="jfb-button-position jfb-svg-option" data-value="right">
                                <div class="jfb-svg-square">
                                    <div class="jfb-svg-square-badged jfb-ssbp-right"></div>
                                </div>
                            </div>
                            <div class="jfb-button-position jfb-svg-option" data-value="bottom">
                                <div class="jfb-svg-square">
                                    <div class="jfb-svg-square-badged jfb-ssbp-bottom"></div>
                                </div>
                            </div>
                            <div class="jfb-button-position jfb-svg-option" data-value="top">
                                <div class="jfb-svg-square">
                                    <div class="jfb-svg-square-badged jfb-ssbp-top"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="jfb-form-row">
                    <div class="jfb-form-col jfb-form-label">
                        <label>Button Alignment</label>
                    </div>
                    <div class="jfb-form-col-2 jfb-form-input">
                        <div class="jfb-svg-choose-container">
                            <input type="hidden"
                                   class="jfb-button-alignment-value"
                                   name="buttonOptions[horizontalAlignment]"
                                   value="<?= $options["horizontalAlignment"]?>" >
                            <div class="jfb-button-alignment jfb-svg-option" data-value="left">
                                <div class="jfb-svg-square">
                                    <div class="jfb-ssba-left jfb-ssba-left-left"></div>
                                </div>
                            </div>
                            <div class="jfb-button-alignment jfb-svg-option" data-value="center">
                                <div class="jfb-svg-square">
                                    <div class="jfb-ssba-center jfb-ssba-left-center"></div>
                                </div>
                            </div>
                            <div class="jfb-button-alignment jfb-svg-option" data-value="right">
                                <div class="jfb-svg-square">
                                    <div class="jfb-ssba-right jfb-ssba-left-right"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="jfb-form-row">
                    <div class="jfb-form-col jfb-form-label">
                        <label>Button and Text Colors</label>
                    </div>
                    <div class="jfb-form-col-2 jfb-form-input jfb-display-flex jfb-space-between">
                        <div class="jfb-form-color-container">
                            <label class="jfb-mr-1 jfb-36-width">Button</label>
                            <div class="jfb-form-color-picker">
                                <input type="text" class="colorPicker"
                                       name="buttonOptions[buttonColor]"
                                       value="<?= $options["buttonColor"] ?>"
                                       id="jfbColorPickerButton">
                                <label class="jfb-color-picker-text"
                                       id="jfbColorPickerButtonVal">
                                    <?= $options["buttonColor"] ?>
                                </label>
                            </div>
                        </div>
                        <div class="jfb-form-color-container">
                            <label class="jfb-mr-1 jfb-36-width">Text</label>
                            <div class="jfb-form-color-picker">
                                <input type="text" class="colorPicker"
                                       name="buttonOptions[labelColor]"
                                       value="<?= $options["labelColor"] ?>"
                                       id="jfbColorPickerText">
                                <label class="jfb-color-picker-text"
                                       id="jfbColorPickerTextVal">
                                    <?= $options["labelColor"] ?>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="jfb-col jfb-preview-col" style="position: relative">
        <div class="jfb-preview-main-container">
            <img class="jfb-preview-svg" src="<?= plugins_url('/images/preview-bar.svg', __FILE__) ?>">
            <div class="jfb-preview-container">
                <img class="jfb-preview-svg" src="<?= plugins_url('/images/preview.svg', __FILE__) ?>">
                <div class="jfb-preview-form">
                    <div class="jfb-preview-form-header"><?= $options["formTitle"] ?></div>
                    <img class="jfb-preview-form-svg" src="<?= plugins_url('/images/preview-form.svg', __FILE__) ?>">
                </div>
                <div class="jfb-preview-badged">
                    <?= $options["formTitle"] ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="jfb-sticky-footer">
    <a class="jfb-footer-item jfb-send-feedback-button">Feedback</a>
    <button class="jfb-footer-item jfb-form-save-button" <?=$saveButtonStatus?> >save</button>
</div>
<div class="jfb-feedback-popup">
    <div class="jfb-feedback-form-container">
        <button class="jfb-feedback-popup-close-button">
            <img src="<?= plugins_url('/images/close-icon.svg', __FILE__) ?>">
        </button>
        <iframe
                id="JotFormIFrame-221102730768046"
                title="Feedback Form"
                onload="window.parent.scrollTo(0,0)"
                allowtransparency="true"
                allowfullscreen="true"
                allow="geolocation; microphone; camera"
                src="https://form.jotform.com/221102730768046"
                frameborder="0"
                style="
      min-width: 100%;
      height:539px;
      border:none;"
                scrolling="no"
        >
        </iframe>
        <script type="text/javascript">
            var ifr = document.getElementById("JotFormIFrame-221102730768046");
            if (ifr) {
                var src = ifr.src;
                var iframeParams = [];
                if (window.location.href && window.location.href.indexOf("?") > -1) {
                    iframeParams = iframeParams.concat(window.location.href.substr(window.location.href.indexOf("?") + 1).split('&'));
                }
                if (src && src.indexOf("?") > -1) {
                    iframeParams = iframeParams.concat(src.substr(src.indexOf("?") + 1).split("&"));
                    src = src.substr(0, src.indexOf("?"))
                }
                iframeParams.push("isIframeEmbed=1");
                ifr.src = src + "?" + iframeParams.join('&');
            }
            window.handleIFrameMessage = function(e) {
                if (typeof e.data === 'object') { return; }
                var args = e.data.split(":");
                if (args.length > 2) { iframe = document.getElementById("JotFormIFrame-" + args[(args.length - 1)]); } else { iframe = document.getElementById("JotFormIFrame"); }
                if (!iframe) { return; }
                switch (args[0]) {
                    case "scrollIntoView":
                        iframe.scrollIntoView();
                        break;
                    case "setHeight":
                        iframe.style.height = args[1] + "px";
                        break;
                    case "collapseErrorPage":
                        if (iframe.clientHeight > window.innerHeight) {
                            iframe.style.height = window.innerHeight + "px";
                        }
                        break;
                    case "reloadPage":
                        window.location.reload();
                        break;
                    case "loadScript":
                        if( !window.isPermitted(e.origin, ['jotform.com', 'jotform.pro']) ) { break; }
                        var src = args[1];
                        if (args.length > 3) {
                            src = args[1] + ':' + args[2];
                        }
                        var script = document.createElement('script');
                        script.src = src;
                        script.type = 'text/javascript';
                        document.body.appendChild(script);
                        break;
                    case "exitFullscreen":
                        if      (window.document.exitFullscreen)        window.document.exitFullscreen();
                        else if (window.document.mozCancelFullScreen)   window.document.mozCancelFullScreen();
                        else if (window.document.mozCancelFullscreen)   window.document.mozCancelFullScreen();
                        else if (window.document.webkitExitFullscreen)  window.document.webkitExitFullscreen();
                        else if (window.document.msExitFullscreen)      window.document.msExitFullscreen();
                        break;
                }
                var isJotForm = (e.origin.indexOf("jotform") > -1) ? true : false;
                if(isJotForm && "contentWindow" in iframe && "postMessage" in iframe.contentWindow) {
                    var urls = {"docurl":encodeURIComponent(document.URL),"referrer":encodeURIComponent(document.referrer)};
                    iframe.contentWindow.postMessage(JSON.stringify({"type":"urls","value":urls}), "*");
                }
            };
            window.isPermitted = function(originUrl, whitelisted_domains) {
                var url = document.createElement('a');
                url.href = originUrl;
                var hostname = url.hostname;
                var result = false;
                if( typeof hostname !== 'undefined' ) {
                    whitelisted_domains.forEach(function(element) {
                        if( hostname.slice((-1 * element.length - 1)) === '.'.concat(element) ||  hostname === element ) {
                            result = true;
                        }
                    });
                    return result;
                }
            };
            if (window.addEventListener) {
                window.addEventListener("message", handleIFrameMessage, false);
            } else if (window.attachEvent) {
                window.attachEvent("onmessage", handleIFrameMessage);
            }
        </script>
    </div>
</div>