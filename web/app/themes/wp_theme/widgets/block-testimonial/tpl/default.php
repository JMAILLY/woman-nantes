
    <section class="blocktestimony">
        <?php if(!empty($instance['img_illus'])) : ?>
            <div class="blocktestimony-img">
                <?php print wp_get_attachment_image( $instance['img_illus'], 'large'); ?>
            </div>
        <?php endif; ?>
        <div class="blocktestimony-text">
            <?php if(!empty($instance['title'])) : ?>
                <h2 class="blocktext-title <?php print $instance['align_title']; ?> <?php print $instance['style_title']; ?>">
                    <?php print $instance['title']; ?>
                </h2>
            <?php endif; ?>
            <?php print wpautop($instance['text']); ?>
            <?php if(!empty($instance['name'])) : ?><div class="name"><?php print $instance['name']; ?></div><?php endif; ?>
            <?php if(!empty($instance['job'])) : ?><div class="job"><?php print $instance['job']; ?></div><?php endif; ?>
            <?php if(!empty($instance['button']['title_btn']) && !empty($instance['button']['url_btn'])) : ?>
                <a href="<?php echo sow_esc_url($instance['button']['url_btn']); ?>" class="btn btn-main" <?php if($instance['button']['target_btn']) { echo 'target="_blank"'; } ?>><?php print $instance['button']['title_btn']; ?></a>
            <?php endif; ?>
        </div>
    </section>