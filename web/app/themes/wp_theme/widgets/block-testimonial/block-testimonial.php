<?php

/*
Widget Name: Bloc Témoignage
Description: Bloc temoignage avec ou sans image d'illustration.
Author: Gingerminds
Author URI: http://www.gingerminds.fr
Documentation : https://siteorigin.com/docs/widgets-bundle/
*/

class Block_Testimony extends SiteOrigin_Widget {

    function __construct() {
        //Here you can do any preparation required before calling the parent constructor, such as including additional files or initializing variables.
        //Call the parent constructor with the required arguments.
        parent::__construct(
        // The unique id for your widget.
            'block-testimonial-widget',
            // The name of the widget for display purposes.
            __('Bloc Témoignage', 'block-testimonial-widget'),
            // The $widget_options array, which is passed through to WP_Widget.
            // It has a couple of extras like the optional help URL, which should link to your sites help or support page.
            array(
                'description' => __('Bloc temoignage, avec ou sans image d\'illustration.', 'picto-facts-widget-text-domain'),
                'panels_groups' => array('wp_theme'),
                'panels_icon' => 'dashicons dashicons-businessman'
            ),

            //The $control_options array, which is passed through to WP_Widget
            array(
            ),

            //The $form_options array, which describes the form fields used to configure SiteOrigin widgets. We'll explain these in more detail later.
            array(
                'title' => array(
                    'type' => 'text',
                    'label' => __('Titre du témoignage', 'siteorigin-widgets'),
                    'default' => ''
                ),
                'img_illus' => array(
                    'type' => 'media',
                    'label' => __( 'Image d\'illustration' , 'widget-form-fields-text-domain' ),
                    'choose' => __( 'Ajouter le visuel', 'widget-form-fields-text-domain' ),
                    'update' => __( 'Modifier le visuel', 'widget-form-fields-text-domain' ),
                    'library' => 'image',
                    'fallback' => false
                ),
                'name' => array(
                    'type' => 'text',
                    'label' => __('Nom de la personne qui témoigne', 'siteorigin-widgets'),
                    'default' => ''
                ),
                'job' => array(
                    'type' => 'text',
                    'label' => __('Poste de la personne qui témoigne', 'siteorigin-widgets'),
                    'default' => ''
                ),
                'text' => array(
                    'type' => 'tinymce',
                    'label' => __( 'Editer le texte du bloc', 'widget-form-fields-text-domain' ),
                    'default' => '',
                    'rows' => 10,
                    'required' => true,
                    'default_editor' => 'tinymce',
                    'button_filters' => array(
                        'mce_buttons' => array( $this, 'filter_mce_buttons' ),
                        'mce_buttons_2' => array( $this, 'filter_mce_buttons_2' ),
                        'mce_buttons_3' => array( $this, 'filter_mce_buttons_3' ),
                        'mce_buttons_4' => array( $this, 'filter_mce_buttons_5' ),
                        'quicktags_settings' => array( $this, 'filter_quicktags_settings' ),
                    ),
                ),
                'button' => array(
                    'type' => 'widget',
                    'label' => __( 'Ajouter un Bouton d\'action', 'widget-form-fields-text-domain' ),
                    'class' => 'Button_Widget',
                    'hide' => true
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

siteorigin_widget_register('block-testimonial-widget', __FILE__, 'Block_Testimony');