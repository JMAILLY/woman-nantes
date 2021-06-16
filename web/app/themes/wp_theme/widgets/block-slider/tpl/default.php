
    <section class="blockslider">
        <div class="blockslider-slides">
            <?php foreach($instance['slider']['slide_repeat'] as $slide) : ?>
                <div class="slide">
                    <?php if(!empty($slide['image'])) : ?>
                        <div class="slide-img">
                            <?php print wp_get_attachment_image( $slide['image'], 'large'); ?>
                        </div>
                    <?php endif; ?>
                    <?php if(!empty($slide['title']) || !empty($slide['text'])) : ?>
                    <div class="slide-text">
                        <?php if(!empty($slide['title'])) : ?>
                            <div class="slide-title">
                                <?php print $slide['title']; ?>
                            </div>
                        <?php endif; ?>
                        <div class="slide-txt">
                            <?php if(!empty($slide['text'])) : ?>
                                <?php print $slide['text']; ?>
                            <?php endif; ?>
                        </div>
                        <?php if(!empty($slide['button']['title_btn']) && !empty($slide['button']['url_btn'])) : ?>
                            <a href="<?php echo sow_esc_url($slide['button']['url_btn']); ?>" class="btn btn-main" <?php if($slide['button']['target_btn']) { echo 'target="_blank"'; } ?>><?php print $slide['button']['title_btn']; ?></a>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </section>