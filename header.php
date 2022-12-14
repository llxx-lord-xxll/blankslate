<!DOCTYPE html>
<html <?php language_attributes(); ?> <?php idt_schema_type(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="wp-ajax" content="<?php echo admin_url('admin-ajax.php'); ?>">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="wrapper" class="hfeed">
    <header id="header" role="banner">
        <div class="container">
            <div id="block-1">
                <div id="search"><?php get_search_form(); ?></div>
            </div>
            <div id="branding" class="block-2">
                <div id="site-title" itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
                    <?php
                    if (is_front_page() || is_home() || is_front_page() && is_home()) {
                        echo '<h1>';
                    }
                    echo '<a href="' . esc_url(home_url('/')) . '" title="' . esc_attr(get_bloginfo('name')) . '" rel="home" itemprop="url"><span itemprop="name">' . esc_html(get_bloginfo('name')) . '</span></a>';
                    if (is_front_page() || is_home() || is_front_page() && is_home()) {
                        echo '</h1>';
                    }
                    ?>
                </div>
                <div id="site-description"<?php if (!is_single()) {
                    echo ' itemprop="description"';
                } ?>><?php bloginfo('description'); ?></div>
            </div>
            <div class="block-3">
                <a class="button" href="#ex1" rel="modal:open"><i class="far fa-envelope"></i> Subscribe</a>
            </div>
            <div class="break"></div>
            <nav id="menu" role="navigation" itemscope itemtype="https://schema.org/SiteNavigationElement">
                <?php wp_nav_menu(array('theme_location' => 'main-menu', 'link_before' => '<span itemprop="name">', 'link_after' => '</span>')); ?>
            </nav>
        </div>
    </header>
    <div class="page-container">
        <main id="content" role="main">
