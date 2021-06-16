<?php

/*
Widget Name: Bouton CTA
Description: Bouton de call to actions.
Author: Gingerminds
Author URI: http://www.gingerminds.fr
*/

class Button_Widget extends SiteOrigin_Widget {

    function __construct() {
        //Here you can do any preparation required before calling the parent constructor, such as including additional files or initializing variables.
        //Call the parent constructor with the required arguments.
        parent::__construct(
        // The unique id for your widget.
            'button-widget',
            // The name of the widget for display purposes.
            __('Bouton', 'button-widget'),
            // The $widget_options array, which is passed through to WP_Widget.
            // It has a couple of extras like the optional help URL, which should link to your sites help or support page.
            array(
                'description' => __('Bouton de call to actions.', 'picto-facts-widget-text-domain'),
                'panels_groups' => array('grignon')
            ),

            //The $control_options array, which is passed through to WP_Widget
            array(
            ),

            //The $form_options array, which describes the form fields used to configure SiteOrigin widgets. We'll explain these in more detail later.
            array(
                'title_btn' => array(
                    'type' => 'text',
                    'label' => __('Texte du bouton', 'siteorigin-widgets'),
                    'default' => '',
                    'required' => true,
                    'rows' => 4,
                ),
                'url_btn' => array(
                    'type' => 'link',
                    'label' => __('URL du bouton', 'widget-form-fields-text-domain'),
                    'required' => true,
                    'default' => '',
                ),
                'target_btn' => array(
                    'type' => 'checkbox',
                    'label' => __('Ouvrir le lien dans une nouvelle fenêtre ?', 'widget-form-fields-text-domain'),
                    'required' => true,
                    'default' => false,
                )
            ),

            //The $base_folder path string.
            plugin_dir_path(__FILE__)
        );
    }

    function get_template_name($instance) {
        return 'default';
    }

    function get_template_dir($instance) {
        return 'tpl';
    }

    function get_style_name($instance) {
        return '';
    }
}

siteorigin_widget_register('button-widget', __FILE__, 'Button_Widget');