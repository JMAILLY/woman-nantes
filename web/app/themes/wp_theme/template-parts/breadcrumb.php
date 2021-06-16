<?php
/*
Navigation interne (fil d'ariane) des pages avec comportement normal
*/
?>

<div class="breadcrumb">
    <ul>
        <li>
            <a href="<?php echo home_url(); ?>">Accueil</a>
        </li>
        <?php //Variables parent 1er niveau et 2eme niveau
        $parent = get_post($post->post_parent);
        $parent_title = get_the_title($parent);
        $grandparent = $parent->post_parent;
        $grandparent_title = get_the_title($grandparent); ?>
        <?php if ($grandparent == is_page('0')) { ?>
            <li><a href="<?php echo get_permalink($grandparent); ?>"><?php echo $grandparent_title; ?></a></li>
            <li><a href="<?php echo get_permalink($post->post_parent); ?>"><?php echo $parent_title; ?></a></li>
        <?php } elseif ($post->post_parent == is_page('0')) { ?>
            <li><a href="<?php echo get_permalink($post->post_parent) ?>"><?php echo $parent_title; ?></a></li>
        <?php }?><li><?php the_title(); ?></li>
    </ul>
</div>