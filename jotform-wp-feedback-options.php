<?php

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit(0);
}
?>
<div class="wrap">
    <div class="icon32"><img src="<?php echo esc_url(JWPF_PLUGIN_DIR . '/images/feedback32x32.png'); ?>"/><br></div>
    <h2>Jotform Feedback Button</h2>
    <form method="post" action="options.php">
        <?php settings_fields('jotform-wp-feedback-options'); ?>
        <?php do_settings_fields('jotform-wp-feedback-options', "buttonOptions"); ?>
        <table class="form-table">
            <tbody>
                <tr valign="top">
                    <th scope="row"><label for="formID"><?php echo esc_html__("Form ID"); ?></label></th><td><input name="buttonOptions[formID]" type="text" id="formID" value="<?php echo esc_html(@$options['formID']); ?>" style="width:273px" class="regular-text"><img align="middle" style="margin-top:-8px; margin-left:4px;" src="<?php echo esc_url(JWPF_PLUGIN_DIR . '/images/browse-icon22x22.png');?>" id="pickForm"></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="formTitle"><?php echo esc_html__("Button Text"); ?></label></th>
                    <td>
                        <input name="buttonOptions[formTitle]" type="text" id="formTitle" value="<?php echo esc_html(@$options['formTitle']); ?>" class="regular-text">
                    </td>
                </tr>
                <tr valign="middle">
                    <th scope="row"><label for="formDimensions"><?php echo esc_html__("Form Dimensions (in px)"); ?></label></th>
                    <td> Width : <input name="buttonOptions[formWidth]" type="text" id="formWidth" value="<?php echo esc_html(@$options['formWidth']); ?>" class="regular-text" style="width:50px"> <?php echo esc_html__("Height"); ?> : <input name="buttonOptions[formHeight]" type="text" id="formHeight" value="<?php echo esc_html(@$options['formHeight']); ?>" class="regular-text" style="width:50px"></td>
                </tr>
                <tr>
                    <th scope="row"><?php echo esc_html__("Screen Alignment"); ?></th>
                    <td>
                        <fieldset><legend class="screen-reader-text"><span><?php echo esc_html__("Screen Alignment"); ?></span></legend>
                            <?php foreach (["top" => esc_html__("Top Side"), "right" => esc_html__("Right Side"), "bottom" => esc_html__("Bottom Side"), "left" => esc_html__("Left Side")] as $key => $value) { ?>
                            <label title="<?php echo esc_html($value);?>"><input type="radio" name="buttonOptions[screenAlignment]" <?php echo ((@$options["screenAlignment"] == $key) ? "checked=checked" : ""); ?> value="<?php echo esc_html($key);?>"> <span> <?php echo esc_html($value);?></span></label><br>
                            <?php } ?>
                        </fieldset>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><?php echo esc_html__("Horizontal Alignment"); ?></th>
                    <td>
                        <fieldset><legend class="screen-reader-text"><span><?php echo esc_html__("Horizontal Alignment"); ?></span></legend>
                            <?php foreach (["left" => esc_html__("Left"), "center" => esc_html__("Center"), "right" => esc_html__("Right")] as $key => $value) { ?>
                            <label title="<?php echo esc_html($value);?>"><input type="radio" name="buttonOptions[horizontalAlignment]" <?php echo esc_html((@$options["horizontalAlignment"] == $key) ? "checked=checked" : ""); ?> value="<?php echo esc_html($key);?>"> <span> <?php echo esc_html($value);?></span></label><br>
                            <?php } ?>
                        </fieldset>
                    </td>
                </tr>
                    <th scope="row"><?php echo esc_html__("Lightbox Style"); ?></th>
                    <td>
                        <fieldset>
                            <input type="hidden" id="lightBoxType" name="buttonOptions[lightBoxType]" value="<?php echo esc_html(@$options['lightBoxType']); ?>">
                            <legend class="screen-reader-text"><span><?php echo esc_html__("Horizontal Alignment"); ?></span></legend>
                            <fieldset class="widgetOptions styleLb">
                                <div class="styleBrowser">
                                    <div class="styleBox" data-value="false"></div>
                                </div>
                                <div class="styleBrowser midBrowser">
                                    <div class="styleBox styleBox1" data-value="1"></div>
                                </div>
                                <div class="styleBrowser">
                                    <div class="styleBox styleBox2" data-value="2"></div>
                                </div>
                        </fieldset>
                    </td>
                </tr>
                <?php
                $css_path = JWPF_PLUGIN_DIR . "/src/css/app.css";
                if (file_exists($css_path)) {
                    $custom_css = file_get_contents($css_path);
                    wp_register_style('jotform-feedback-button-style', false, [], JWPF_PLUGIN_VERSION);
                    wp_enqueue_style('jotform-feedback-button-style');
                    wp_add_inline_style('jotform-feedback-button-style', $custom_css);
                }
                ?>
                <tr valign="top">
                <th scope="row"><label for="feedbackColors"><?php echo esc_html__("Button and Label Colors"); ?></label></th>
                    <td> <?php echo esc_html__("Button"); ?> : <input name="buttonOptions[buttonColor]" type="text" id="buttonColor" value="<?php echo esc_html(@$options['buttonColor']); ?>" class="jotform-color-field regular-text" style="width:70px"> <?php echo esc_html__("Label"); ?> : <input name="buttonOptions[labelColor]" type="text" id="labelColor" value="<?php echo esc_html(@$options['labelColor']); ?>" class="jotform-color-field regular-text" style="width:70px"></td>
                </tr>
            </tbody>
        </table>
        <?php submit_button(); ?>
    </form>
</div>