<?php /* Template Name: Template page archives articles */ ?>
<?php get_header(); ?>

<?php if(have_posts()) : while (have_posts()) : the_post(); ?>
    <section class="content">
        <?php get_template_part( 'template-parts/breadcrumb', 'none' ); ?>
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <a href="<?php the_permalink() ?>">
                <?php if('' != get_the_post_thumbnail()) : the_post_thumbnail( 'size' ); endif; ?>
                <?php the_time('j.m.Y'); ?>
                <?php the_title(); ?>
                <?php the_excerpt(); ?>
            </a>
        <?php endwhile; endif; ?>
        <?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } ?>
    </section>

    <section>
        <!-- Utilisation d'un sprite SVG -->
        <svg class="icon">
            <use xlink:href="./assets/images/sprites.svg#arrow-yellow"></use>
        </svg>

    </section>
<?php endwhile; endif; ?>

<?php get_footer(); ?>