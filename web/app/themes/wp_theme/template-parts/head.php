<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head itemscope itemtype="http://schema.org/WebSite">
    <meta charset="UTF-8">
    <script>(function(H){H.className=H.className.replace(/\bno-js\b/,'js')})(document.documentElement)</script>

    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="MobileOptimized" content="width" />
    <meta name="HandheldFriendly" content="true" />
    <meta name="viewport" content="initial-scale=1, minimum-scale=1, width=device-width, height=device-height" />

    <!-- Inclure vos GOOGLE FONTS ICI -->
    <link rel="alternate" type="application/rss+xml" title="Site Title &raquo; Flux" href="<?php echo home_url(); ?>/feed/" />

    <link rel="shortcut icon" type="image/x-icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/apple-touch-icon.png">
    <link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon-32x32.png" sizes="32x32">
    <link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon-16x16.png" sizes="16x16">

    <?php wp_head();  ?>
</head>
<body <?php if(is_front_page()) { echo 'class="homepage"'; }else { body_class(); } ?>>