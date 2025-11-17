<?php

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

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit(0);
}

class JotformWPFeedback {
    public function __construct() {
        add_action('admin_menu', [$this, 'jwpf_addAdminMenu']);
        add_action('admin_enqueue_scripts', [$this,'jwpf_mw_enqueue_form_picker']);
        add_action('admin_init', [$this, 'jwpf_register_button_options']);
        add_action('wp_footer', [$this, 'jwpf_generateFeedBackCode']);
        add_action('wp_enqueue_scripts', [$this, 'jwpf_loadJotFormFeedBack']);
    }

    public function jwpf_loadJotFormFeedBack() {
        wp_enqueue_script(
            'jotform-feedback-button',
            'https://www.jotform.com/static/feedbackWP.js',
            [
                'jquery',
                'jquery-ui-core',
                'jquery-ui-widget',
                'jquery-ui-mouse',
                'jquery-ui-draggable'
            ]
        );
    }

    public function jwpf_register_button_options() {
        register_setting('jotform-wp-feedback-options', 'buttonOptions');
    }

    public function jwpf_mw_enqueue_form_picker($hook_suffix) {
        if ($hook_suffix == "settings_page_jotform-feedback") {
            wp_enqueue_style('wp-color-picker');
            wp_enqueue_script('jotform-wp-feedback-js', plugins_url('jotform-wp-feedback.js', __FILE__), ['wp-color-picker'], false, true);
        }
    }

    public function jwpf_addAdminMenu() {
        add_options_page('Jotform Feedback Button', 'Jotform Feedback Button', 'manage_options', 'jotform-feedback', [$this, 'jwpf_showOptions']);
    }

    public function jwpf_showOptions() {
        if (!current_user_can('manage_options')) {
            wp_die(esc_html(__('You do not have sufficient permissions to access this page.')));
        }

        $options = get_option('buttonOptions');
        if (!$options) {
            $options = [
                "formTitle" => "Feedback",
                "buttonColor" => "#F59202",
                "labelColor" => "#FFFFFF",
                "screenAlignment" => "bottom",
                "horizontalAlignment" => "right",
                "lightBoxType" => "false",
                "formWidth" => 700,
                "formHeight" => 500
            ];
        }
        include plugin_dir_path(__FILE__) . "jotform-wp-feedback-options.php";
    }

    public function jwpf_generateFeedBackCode() {
        $options = get_option('buttonOptions');
        if (!empty($options["formID"])) {
            $data = [
                'formId' => $options["formID"],
                'buttonText' => $options["formTitle"],
                'base' => 'https://www.jotform.com/',
                'background' => $options["buttonColor"],
                'fontColor ' => $options["labelColor"],
                'buttonSide' => $options["screenAlignment"],
                'buttonAlign' => $options["horizontalAlignment"],
                'type' => $options["lightBoxType"],
                'width' => $options["formWidth"],
                'height' => $options["formHeight"]
            ];

            echo '
            <script type="text/javascript">
                new JotformFeedback(' . wp_json_encode($data) . ');
            </script>';
        }
    }
}

$jotformWPFeedback = new JotformWPFeedback();
