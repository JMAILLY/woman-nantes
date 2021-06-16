<?php
/**
 * THEME functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WORDPRESS_THEME
 */

/**************************************************************************
 ****************** Initialisation paramètres de base du thème ************
 *************************************************************************/

    if ( ! function_exists( 'setup' ) ) :
        function setup() {
            add_theme_support( 'automatic-feed-links' );
            add_theme_support( 'title-tag' );
            add_theme_support( 'post-thumbnails' );

            // Size of images
            add_image_size( 'header-cover', 1800, 670, array( 'center', 'center' ) );

            // This theme uses wp_nav_menu() in one location.
            register_nav_menu( 'primary', 'Menu Principal' );
            register_nav_menu( 'footer', 'Menu Footer' );
        }
    endif;
    add_action( 'after_setup_theme', 'setup' );

    function custom_enqueue_scripts() {
        wp_enqueue_style('style', get_template_directory_uri() .'/style.css', null, null);
        wp_enqueue_style('theme-style', get_template_directory_uri() .'/theme-style.css', null, null);

        wp_register_script('tarteaucitron', get_template_directory_uri() . '/tarteaucitron/tarteaucitron.js', array( 'jquery' ), false, true);
        wp_enqueue_script('tarteaucitron');

        wp_register_script('script-theme', get_template_directory_uri() . '/script.min.js', array( 'jquery' ), false, true);
        wp_enqueue_script('script-theme');
    }
    add_action('wp_enqueue_scripts', 'custom_enqueue_scripts', 101);

/**************************************************************************
 ****************** Disable the emoji's // Nettoyage du code du header ****
 *************************************************************************/

    function disable_emojis() {
        remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
        remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
        remove_action( 'wp_print_styles', 'print_emoji_styles' );
        remove_action( 'admin_print_styles', 'print_emoji_styles' );
        remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
        remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
        remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
        add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
        add_filter( 'wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2 );
    }
    add_action( 'init', 'disable_emojis' );

    function disable_emojis_tinymce( $plugins ) {
        if ( is_array( $plugins ) ) {
            return array_diff( $plugins, array( 'wpemoji' ) );
        } else {
            return array();
        }
    }

    function disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
        if ( 'dns-prefetch' == $relation_type ) {
            /** This filter is documented in wp-includes/formatting.php */
            $emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );

            $urls = array_diff( $urls, array( $emoji_svg_url ) );
        }

        return $urls;
    }


/**************************************************************************
 ********************* Créations de Widget dans le thème ******************
 *************************************************************************/

    /****** Exemple de Création d'un widget

    function widgets_init() {
    register_sidebar( array(
    'name' => 'Nom du widget',
    'id' => 'id-widget',
    'before_widget' => '<div class="widget">',
    'after_widget' => '</div>',
    'before_title' => '<div class="h3-title">',
    'after_title' => '</div>',
    ) );
    }

    add_action( 'widgets_init', 'widgets_init' );

     *********/


/**************************************************************************
 ********************* Créations de Custom Post Type **********************
 *************************************************************************/

    /****** Custom Post Type : Exemple de Création d'un type de contenu personnalisé

    function create_post_type_offers() {
        $labels = array(
        'name'                => _x( 'Nos offres', 'Post Type General Name'),
        'singular_name'       => _x( 'Offre', 'Post Type Singular Name'),
        'menu_name'           => __( 'Offres'),
        'all_items'           => __( 'Toutes les offres'),
        'view_item'           => __( 'Voir les offres'),
        'add_new_item'        => __( 'Ajouter une offre'),
        'add_new'             => __( 'Ajouter'),
        'edit_item'           => __( 'Editer l\'offre'),
        'update_item'         => __( 'Modifier l\'offre'),
        'search_items'        => __( 'Rechercher une offre'),
        'not_found'           => __( 'Non trouvée'),
        'not_found_in_trash'  => __( 'Non trouvée dans la corbeille'),
    );

    $args = array(
        'label'               => __( 'Nos Offres'),
        'description'         => __( 'Nos Offres'),
        'labels'              => $labels,
        'supports'            => array( 'title', 'editor', 'thumbnail', 'excerpt'),
        'public'              => true,
        'publicly_queryable'  => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'query_var'           => true,
        'exclude_from_search' => false,
        'has_archive'         => true,
        'hierarchical'        => false,
        'show_in_rest'        => true,
        'rest_base'           => false,
        'menu_position'       => null,
        'capability_type'     => 'post',
        'menu_icon'           => 'dashicons-welcome-add-page',
        'rewrite'			  => array( 'slug' => 'offres', 'with_front' => false),
    );

    register_post_type( 'offres', $args );
    }

    add_action( 'init', 'create_post_type_offers', 0 );

     *********/

    /****** Custom Post Type : Exemple de Création d'une taxonomie sur un type de contenu personnalisé

    function types_taxonomy() {
        $labels = array(
        'name'                       => _x( 'Nom Taxonomie', 'Taxonomy General Name', 'text_domain' ),
        'singular_name'              => _x( 'Nom singulier', 'Taxonomy Singular Name', 'text_domain' ),
        'menu_name'                  => __( 'Nom dans le menu', 'text_domain' ),
        'all_items'                  => __( 'Tous les...', 'text_domain' ),
        'new_item_name'              => __( 'Ajouter...', 'text_domain' ),
        'add_new_item'               => __( 'Ajouter...', 'text_domain' ),
        'edit_item'                  => __( 'Editer...', 'text_domain' ),
        'update_item'                => __( 'Mettre à jour...', 'text_domain' ),
        'view_item'                  => __( 'Voir...', 'text_domain' ),
        );
        $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'query_var'                  => true,
        'show_in_nav_menus'          => true,
        'has_archive'                => true,
        'show_in_rest'               => true,
        'rewrite'           => array( 'slug' => 'taxonomieperso' ),
        );
        register_taxonomy( 'taxonomieperso', 'nom_type_contenu_attache_a_la_taxo', $args );
    }
    add_action( 'init', 'types_taxonomy', 0 );

     *********/


/**************************************************************************
 **************************** Editer le TinyMCE ***************************
 *************************************************************************/

    /*** Editer le style de l'éditeur WYSIWYG dans le Back Office **/
    function gn_ajouter_styles_editeur() {
        add_editor_style( 'editor-style.css' );
    }
    add_action( 'init', 'gn_ajouter_styles_editeur' );

    function gn_tinymce_filtre($arr){
        $arr['block_formats'] = 'Paragraph=p;Heading 3=h3;Heading 4=h4;Heading 5=h5;Heading 6=h6;';
        return $arr;
    }
    add_filter('tiny_mce_before_init', 'gn_tinymce_filtre');

    add_filter( 'tiny_mce_before_init', 'my_mce_before_init' );
    function my_mce_before_init( $settings ) {
        $style_formats = array(
            array(
                'title' => 'Bouton',
                'block' => 'a',
                'classes' => 'btn btn-main',
            ),
            array(
                'title' => 'Bouton de Téléchargement',
                'block' => 'a',
                'classes' => 'btn btn-download',
            )
        );
        $settings['style_formats'] = json_encode( $style_formats );
        return $settings;
    }


/**************************************************************************
 **************************** Fonctions Utiles ****************************
 *************************************************************************/

    /* Ajout d'options ACF générale dans le dashboard
    if( function_exists('acf_add_options_page') ) {
        acf_add_options_page();
        acf_add_options_sub_page(
            array(
                'page_title' 	=> 'Options',
                'menu_slug' 	=> 'wp_theme',
                'capability'	=> 'edit_posts',
                'redirect'		=> false
            )
        );
    }*/

    // Fonction qui permet de mettre à jour les caches des templates WP
    function wp_42573_fix_template_caching( WP_Screen $current_screen ) {
        // Only flush the file cache with each request to post list table, edit post screen, or theme editor.
        if ( ! in_array( $current_screen->base, array( 'post', 'edit', 'theme-editor' ), true ) ) {
            return;
        }
        $theme = wp_get_theme();
        if ( ! $theme ) {
            return;
        }
        $cache_hash = md5( $theme->get_theme_root() . '/' . $theme->get_stylesheet() );
        $label = sanitize_key( 'files_' . $cache_hash . '-' . $theme->get( 'Version' ) );
        $transient_key = substr( $label, 0, 29 ) . md5( $label );
        delete_transient( $transient_key );
    }
    add_action( 'current_screen', 'wp_42573_fix_template_caching' );

    // If more than one page exists, return TRUE
    function show_posts_nav() {
        global $wp_query;
        return ($wp_query->max_num_pages > 1);
    }

    // Change Excerpt Length
    function custom_excerpt_length( $length ) {
        return 20;
    }
    add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

    // Fonction Excerpt
    function excerpt_text($text, $limit) {
        $text_nohtml = strip_tags($text, ' ');
        $excerpt = explode(' ', $text_nohtml, $limit);
        if (count($excerpt)>=$limit) {
            array_pop($excerpt);
            $excerpt = implode(" ",$excerpt).'...';
        } else {
            $excerpt = implode(" ",$excerpt);
        }
        $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
        return $excerpt;
    }

    // Ajustements Contact Form
    add_filter('wpcf7_form_elements', function($content) {
        $content = preg_replace('/<(span).*?class="\s*(?:.*\s)?wpcf7-form-control-wrap(?:\s[^"]+)?\s*"[^\>]*>(.*)<\/\1>/i', '\2', $content);
        return $content;
    });

    // Fonction qui permet d'améliorer l'affichage des exports CSV Flamingo
    function custom_flamingo_change_csv_delimiter($delimiter){
        $delimiter = ';';
        return $delimiter;
    }
    add_filter('flamingo_csv_value_separator', 'custom_flamingo_change_csv_delimiter');
    add_filter( 'flamingo_csv_field_prefix', '__return_empty_string' );

    // Fonction qui permet d'utiliser la dernière version de jQuery
    function replace_core_jquery_version() {
        wp_deregister_script( 'jquery-core' );
        wp_register_script( 'jquery-core', "https://code.jquery.com/jquery-3.1.1.min.js", array(), '3.1.1' );
        wp_deregister_script( 'jquery-migrate' );
        wp_register_script( 'jquery-migrate', "https://code.jquery.com/jquery-migrate-3.0.0.min.js", array(), '3.0.0' );
    }

    // Copier le contenu d'une page ou d'un post à la création d'une traduction
    function traduction_content_copy( $content ) {
        if ( isset( $_GET['from_post'] ) ) {
            $my_post = get_post( $_GET['from_post'] );
            if ( $my_post )
                return $my_post->post_content;
        }
        return $content;
    }
    add_filter( 'default_content', 'traduction_content_copy' );

    // Retirer des pages du résultat de recherche
    /*
    add_filter( 'pre_get_posts', 'exclude_pages_search' );
    function exclude_pages_search($query) {
        if ( $query->is_search )
            $query->set( 'post__not_in', array( 101 ) );
        return $query;
    }*/


/**************************************************************************
 ******************* UTILISATION DE SITE ORIGIN BUILDER *******************
 *************************************************************************/

    // ADD CUSTOM WIDGET SITE ORIGIN POUR LES BUILDER
    function add_custom_widgets_collection($folders){
        $folders[] = get_template_directory() . '/widgets/';
        return $folders;
    }
    add_filter('siteorigin_widgets_widget_folders', 'add_custom_widgets_collection');

    // ADD CUSTOM TAB
    function theme_add_widget_tabs($tabs) {
        $tabs[] = array(
            'title' => __('Widget du Thème', 'wp_theme'),
            'filter' => array(
                'groups' => array('wp_theme')
            )
        );

        return $tabs;
    }
    add_filter('siteorigin_panels_widget_dialog_tabs', 'theme_add_widget_tabs', 20);