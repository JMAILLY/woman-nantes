
    <section class="blockmedia">
        <?php if(!empty($instance['title'])) : ?>
            <h2 class="blockmedia-title h2-title"><?php print $instance['title']; ?></h2>
        <?php endif; ?>
        <div class="blockmedia-media <?php if(!empty($instance['id_video'])) { echo 'has-video'; } ?>">
            <?php if(!empty($instance['id_video']) && !empty($instance['image'])) : ?>
                <svg class="icon icon-play">
                    <use xlink:href="<?php echo get_template_directory_uri(); ?>/images/sprites.svg#icone-play"></use>
                </svg>
            <?php endif; ?>
            <?php if(!empty($instance['id_video'])) : ?>
                <div class="youtube_player blockmedia-iframe" videoID="<?php print $instance['id_video']; ?>" width="1920" height="1080" theme="light" rel="0" controls="1" showinfo="0" autoplay="0"></div>
            <?php endif; ?>
            <?php if(!empty($instance['image'])) : ?>
                <div class="blockmedia-image"><?php print wp_get_attachment_image( $instance['image'], 'large' ); ?></div>
            <?php endif; ?>
        </div>
    </section>