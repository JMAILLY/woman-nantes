
    <section class="blocktextimg <?php print $instance['align_img']; ?>">
        <div class="blocktextimg-text">
            <?php if(!empty($instance['title'])) : ?>
                <h2 class="h2-title"><?php print $instance['title']; ?></h2>
            <?php endif; ?>
            <?php print $instance['text']; ?>
            <?php if(!empty($instance['button']['title_btn']) && !empty($instance['button']['url_btn'])) : ?>
                <a href="<?php echo sow_esc_url($instance['button']['url_btn']); ?>" class="btn btn-main" <?php if($instance['button']['target_btn']) { echo 'target="_blank"'; } ?>><?php print $instance['button']['title_btn']; ?></a>
            <?php endif; ?>
        </div>
        <div class="blocktextimg-media <?php if(!empty($instance['id_video'])) { echo 'has-video'; } ?>">
            <?php if(!empty($instance['image'])) : ?>
                <?php print wp_get_attachment_image( $instance['image'], 'large'); ?>
            <?php endif; ?>
            <?php if(!empty($instance['id_video']) && !empty($instance['image'])) : ?>
                <svg class="icon icon-play">
                    <use xlink:href="<?php echo get_template_directory_uri(); ?>/images/sprites.svg#icone-play"></use>
                </svg>
            <?php endif; ?>
            <?php if(!empty($instance['id_video'])) : ?>
                <div class="youtube_player" videoID="<?php print $instance['id_video']; ?>" width="1920" height="1080" theme="light" rel="0" controls="1" showinfo="0" autoplay="0"></div>
            <?php endif; ?>
        </div>
    </section>