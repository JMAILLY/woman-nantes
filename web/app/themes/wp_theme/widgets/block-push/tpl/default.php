
    <section class="blockpush" <?php if(!empty($instance['bg_color'])) : ?>style="background-color: <?php print $instance['bg_color']; ?>"<?php endif; ?>>
        <?php if(!empty($instance['image'])) : ?>
        <div class="blockpush-img">
            <?php print wp_get_attachment_image( $instance['image'], 'large'); ?>
        </div>
        <?php endif; ?>
        <?php if(!empty($instance['title'])) : ?>
        <div class="blockpush-title">
            <?php print $instance['title']; ?>
        </div>
        <?php endif; ?>
        <div class="blockpush-text">
            <?php print $instance['text']; ?>
        </div>
        <?php if(!empty($instance['button']['title_btn']) && !empty($instance['button']['url_btn'])) : ?>
            <a href="<?php echo sow_esc_url($instance['button']['url_btn']); ?>" class="btn btn-main" <?php if($instance['button']['target_btn']) { echo 'target="_blank"'; } ?>><?php print $instance['button']['title_btn']; ?></a>
        <?php endif; ?>
    </section>