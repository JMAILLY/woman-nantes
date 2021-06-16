<div class="fadebg"></div>
<nav class="navigation">
    <a href="<?php echo home_url(); ?>" class="navigation-logo"><img src="<?php echo get_template_directory_uri(); ?>/images/logo.svg" width="230" height="95" alt="Log" /></a>
    <div class="navigation-menu">
        <?php
        $defaults = array(
            'theme_location'  => 'primary',
            'menu'            => 'Menu Principal',
            'container'       =>  false,
            'menu_class'      => 'menu',
            'menu_id'         => 'mainav',
            'echo'            => true,
        );

        wp_nav_menu( $defaults );
        ?>
    </div>
</nav>
<a class="burger" aria-label="Menu">
    <div class="burger-line"></div>
    <div class="burger-line"></div>
    <div class="burger-line"></div>
</a>