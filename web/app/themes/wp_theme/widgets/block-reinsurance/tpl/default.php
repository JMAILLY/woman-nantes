
    <section class="blockreinsurance">
        <div class="blockreinsurance-cards">
            <?php foreach($instance['reinsurance']['reinsurance_card'] as $card) : ?>
                <div class="card">
                    <?php if(!empty($card['image'])) : ?>
                        <div class="card-img">
                            <?php print wp_get_attachment_image( $card['image'], 'large'); ?>
                        </div>
                    <?php endif; ?>
                    <?php if(!empty($card['title']) || !empty($card['text'])) : ?>
                        <div class="card-text">
                            <?php if(!empty($card['title'])) : ?>
                                <div class="card-title">
                                    <?php print $card['title']; ?>
                                </div>
                            <?php endif; ?>
                            <?php if(!empty($card['text'])) : ?>
                                <?php print $card['text']; ?>
                            <?php endif; ?>
                            <?php if(!empty($card['button']['title_btn']) && !empty($card['button']['url_btn'])) : ?>
                                <a href="<?php echo sow_esc_url($card['button']['url_btn']); ?>" class="btn btn-main" <?php if($card['button']['target_btn']) { echo 'target="_blank"'; } ?>><?php print $card['button']['title_btn']; ?></a>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </section>