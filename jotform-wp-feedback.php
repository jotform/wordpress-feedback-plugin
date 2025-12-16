<?php

/**
* Plugin Name: Feedback Button - Jotform
* Plugin URI: http://wordpress.org/plugins/jotform-feedback-button/
* Description: Display a beautiful feedback button on the side of your blog. When a reader clicks on it a feedback form pops up. Completely customizable.
* Author: Jotform
* License: GPLv2 or later
* License URI: https://www.gnu.org/licenses/gpl-2.0.html
* Version: 1.1.0
* Author URI: https://www.jotform.com/
*/

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit(0);
}

define('JWPF_PLUGIN_VERSION', '1.1.0');
define('JWPF_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('JWPF_PLUGIN_URL', plugin_dir_url(__FILE__));

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
            'https://cdn.jotfor.ms/s/static/latest/feedbackWP.js',
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
        register_setting(
            'jotform-wp-feedback-options',
            'buttonOptions',
            [
                'type'              => 'array',
                'sanitize_callback' => [$this, 'jotform_feedback_button_sanitize_options'],
            ]
        );
    }

    public function jotform_feedback_button_sanitize_options($input) {
        if (is_array($input)) {
            foreach ($input as $key => $value) {
                $input[$key] = sanitize_text_field($value);
            }
        } else {
            $input = sanitize_text_field($input);
        }
        return $input;
    }

    public function jwpf_mw_enqueue_form_picker($hook_suffix) {
        if ($hook_suffix == "settings_page_jotform-feedback") {
            wp_enqueue_style('wp-color-picker');
            wp_enqueue_script(
                'jotform-wp-feedback-js',
                JWPF_PLUGIN_URL . 'src/js/jotform-wp-feedback.js',
                ['wp-color-picker'],
                JWPF_PLUGIN_VERSION,
                true
            );
        }
    }

    public function jwpf_addAdminMenu() {
        add_options_page(
            esc_html__('Feedback Button'),
            esc_html__('Feedback Button'),
            'manage_options',
            'jotform-feedback',
            [$this, 'jwpf_showOptions']
        );
    }

    public function jwpf_showOptions() {
        if (!current_user_can('manage_options')) {
            wp_die(esc_html__('You do not have sufficient permissions to access this page.'));
        }

        $options = get_option('buttonOptions');
        if (!$options) {
            $options = [
                "formTitle" => esc_html__("Feedback"),
                "buttonColor" => "#F59202",
                "labelColor" => "#FFFFFF",
                "screenAlignment" => "bottom",
                "horizontalAlignment" => "right",
                "lightBoxType" => "false",
                "formWidth" => 700,
                "formHeight" => 500
            ];
        }
        include JWPF_PLUGIN_DIR . "/jotform-wp-feedback-options.php";
    }

    public function jwpf_generateFeedBackCode() {
        $options = get_option('buttonOptions');
        if (!empty($options["formID"])) {
            $data = [
                'formId' => esc_html($options["formID"]),
                'buttonText' => esc_html($options["formTitle"]),
                'base' => esc_url('https://www.jotform.com/'),
                'background' => esc_html($options["buttonColor"]),
                'fontColor ' => esc_html($options["labelColor"]),
                'buttonSide' => esc_html($options["screenAlignment"]),
                'buttonAlign' => esc_html($options["horizontalAlignment"]),
                'type' => esc_html($options["lightBoxType"]),
                'width' => esc_html($options["formWidth"]),
                'height' => esc_html($options["formHeight"])
            ];

            echo '
            <script type="text/javascript">
                new JotformFeedback(' . wp_json_encode($data) . ');
            </script>';
        }
    }
}

$jotformWPFeedback = new JotformWPFeedback();
