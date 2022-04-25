<?php
/*
    Plugin Name: Jotform Feedback Button
    Plugin URI: http://www.jotform.com/labs/wordpress
    Description: Display a beautiful feedback button on the side of your blog. When a reader clicks on it a feedback form pops up. Completely customizable.
    Version: 1.0.4
    Author: Jotform.com
    Author URI: http://www.jotform.com
    License: MIT
*/

class JotFormWPFeedback {

    private $jfbConst;

    public function __construct() {
        $this->jfbConst = [
            "pluginUrl" => plugins_url('/', __FILE__ ),
            "defaultValues" => [
                "formTitle" => "Feedback",
                "buttonColor" => "#0A1551",
                "labelColor" => "#FFFFFF",
                "screenAlignment" => "bottom",
                "horizontalAlignment" => "right",
                "lightBoxType" => "1",
                "formWidth" => 700,
                "formHeight" => 500
            ]
        ];

        add_action( 'admin_menu',   array($this,'addAdminMenu') );
        add_action( 'admin_enqueue_scripts', array($this,'mw_enqueue_form_picker') );
        add_action( 'admin_init',   array($this, 'register_button_options') );
        add_action( 'wp_footer',    array($this, 'generateFeedBackCode') );
        add_action( 'wp_enqueue_scripts', array($this, 'loadJotFormFeedBack') );
    }

    public function loadJotFormFeedBack() {
        wp_enqueue_script(
            'jotform-feedback-button',
            '//www.jotform.com/static/feedbackWP.js',
            array( 'jquery','jquery-ui-core', 'jquery-ui-widget','jquery-ui-mouse','jquery-ui-draggable' )
        );
    }

    public function register_button_options() {
            register_setting( 'jotform-wp-feedback-options', 'buttonOptions' );
    }

    public function mw_enqueue_form_picker( $hook_suffix ) {
        if($hook_suffix == "settings_page_jotform-feedback") {
            wp_enqueue_style( 'wp-color-picker' );
            wp_enqueue_script( 'jotform-wp-feedback-js', plugins_url('jotform-wp-feedback.js', __FILE__ ), array( 'wp-color-picker' ), false, true );
            wp_localize_script(
                'jotform-wp-feedback-js',
                'JFBCONST',
                $this->jfbConst
            );
        }
    }

    public function addAdminMenu() {
        add_options_page( 'Jotform Feedback Button', 'Jotform Feedback Button', 'manage_options', 'jotform-feedback', array($this,'showOptions') );
    }

    public function showOptions() {
        if ( !current_user_can( 'manage_options' ) )  {
            wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
        }

        $options = get_option('buttonOptions') ? get_option('buttonOptions') : $this->jfbConst["defaultValues"];

        wp_enqueue_style( 'jfb-options-page-css', plugins_url('jotform-wp-feedback-options.css', __FILE__ ));
        include plugin_dir_path(__FILE__) . "jotform-wp-feedback-options.php";
    }

    public function generateFeedBackCode() {

            $options = get_option('buttonOptions');
            echo '<script type="text/javascript">
                      new JotformFeedback({
                         formId     : "'.   $options["formID"].'",
                         buttonText : "'.   $options["formTitle"] .'",
                         base       : "https://www.jotform.com/",
                         background : "'.   $options["buttonColor"].'",
                         hoverBackground : "'.   $options["buttonColor"].'",
                         fontColor  : "'.   $options["labelColor"] .'",
                         buttonSide : "'.   $options["screenAlignment"] .'",
                         buttonAlign: "'.   $options["horizontalAlignment"] .'",
                         type       : "'.   $options["lightBoxType"] .'",
                         width      : "'.   $options["formWidth"] .'",
                         height     : "'.   $options["formHeight"] .'",
                      });
                    </script>';
    }
}

$jotformwp = new JotFormWPFeedback();
