<?php

/*
Widget Name: Bloc Média (Image/Vidéo)
Description: Bloc média (image ou vidéo) en largeur full width.
Author: Gingerminds
Author URI: http://www.gingerminds.fr
Documentation : https://siteorigin.com/docs/widgets-bundle/
*/

class Block_Media extends SiteOrigin_Widget {

    function __construct() {
        //Here you can do any preparation required before calling the parent constructor, such as including additional files or initializing variables.
        //Call the parent constructor with the required arguments.
        parent::__construct(
        // The unique id for your widget.
            'block-media-widget',
            // The name of the widget for display purposes.
            __('Bloc Média (Image/Vidéo)', 'block-media-widget'),
            // The $widget_options array, which is passed through to WP_Widget.
            // It has a couple of extras like the optional help URL, which should link to your sites help or support page.
            array(
                'description' => __('Bloc média (image ou vidéo) en largeur full width.', 'picto-facts-widget-text-domain'),
                'panels_groups' => array('wp_theme'),
                'panels_icon' => 'dashicons dashicons-format-video'
            ),

            //The $control_options array, which is passed through to WP_Widget
            array(
            ),

            //The $form_options array, which describes the form fields used to configure SiteOrigin widgets. We'll explain these in more detail later.
            array(
                'image' => array(
                    'type' => 'media',
                    'label' => __( 'Image', 'widget-form-fields-text-domain' ),
                    'choose' => __( 'Ajouter le visuel', 'widget-form-fields-text-domain' ),
                    'update' => __( 'Modifier le visuel', 'widget-form-fields-text-domain' ),
                    'library' => 'image',
                    'required' => true,
                    'fallback' => false
                ),
                'title' => array(
                    'type' => 'text',
                    'label' => __('Titre à afficher', 'siteorigin-widgets'),
                    'default' => ''
                ),
                'id_video' => array(
                    'type' => 'text',
                    'label' => __('ID de la vidéo Youtube (ex: ZMuLNsy0d0Y)', 'widget-form-fields-text-domain'),
                    'required' => true,
                    'default' => '',
                ),
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

siteorigin_widget_register('block-media-widget', __FILE__, 'Block_Media');