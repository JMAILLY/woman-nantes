<footer class="footer">
    <div class="footer-wrapper">
        <div class="footer-about">
            <a href="<?php echo home_url(); ?>" class="logo"><img src="<?php echo get_template_directory_uri(); ?>/images/logo-footer.svg" width="160" height="67" alt="Logo" /></a>
        </div>
        <nav class="footer-menu">
            <?php
            $defaults = array(
                'theme_location'  => 'footer',
                'menu'            => 'Menu Footer',
                'container'       =>  false,
                'menu_class'      => '',
                'menu_id'         => 'mainavfooter',
                'echo'            => true,
            );

            wp_nav_menu( $defaults );
            ?>
        </nav>
    </div>
</footer>
<button class="btn btn-topage">Retour en haut de page</button>
<?php wp_footer(); ?>
</body>
</html>
