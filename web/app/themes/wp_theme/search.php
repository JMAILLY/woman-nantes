<?php get_header(); ?>

    <section class="main-content">
        <?php if(have_posts()) : ?>
        <div class="results-content">
            <?php while (have_posts()) : the_post(); ?>
             <a href="<?php the_permalink() ?>">
                 <div class="results-elem">
                     <div class="results-image"><?php if('' != get_the_post_thumbnail()) : ?><?php the_post_thumbnail('result-sample'); ?><?php else : ?><img src="<?php echo get_template_directory_uri(); ?>/images/post-sample.jpg" alt="post" width="360" height="250" /><?php endif; ?></div>
                    <div class="results-text">
                        <div class="results-infos">
                            <ul>
                                <li class="date"><?php the_time('j F Y'); ?></li>
                            </ul>
                        </div>
                        <div class="results-title"><h2 class="h4-title"><?php the_title(); ?></h2></div>
                        <button class="btn btn-black">Voir la page</button>
                    </div>
                </div>
            </a>
            <?php endwhile; ?>
            <?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } ?>
        </div>
        <?php  endif; ?>
    </section>

<?php get_footer(); ?>
