
    <section class="blocktext">
        <?php if(!empty($instance['title'])) : ?>
        <h2 class="blocktext-title <?php print $instance['align_title']; ?> <?php print $instance['style_title']; ?>">
            <?php print $instance['title']; ?>
        </h2>
        <?php endif; ?>
        <div class="blocktext-text wysiwyg">
            <?php print $instance['text']; ?>
            <?php if(!empty($instance['button']['title_btn']) && !empty($instance['button']['url_btn'])) : ?>
                <a href="<?php echo sow_esc_url($instance['button']['url_btn']); ?>" class="btn btn-main" <?php if($instance['button']['target_btn']) { echo 'target="_blank"'; } ?>><?php print $instance['button']['title_btn']; ?></a>
            <?php endif; ?>
        </div>
    </section>