</main>
<?php get_sidebar(); ?>
</div>
<footer id="footer" role="contentinfo">
<div class="container">
    <div class="block-1">
        <nav id="menu" role="navigation" itemscope itemtype="https://schema.org/SiteNavigationElement">
            <?php wp_nav_menu(array('theme_location' => 'main-menu', 'link_before' => '<span itemprop="name">', 'link_after' => '</span>')); ?>
        </nav>
    </div>
    <div class="block-2">
        <p>Subscribe for our newsletter</p>
        <a class="button" href="#ex1" rel="modal:open"><i class="far fa-envelope"></i> Subscribe</a>
    </div>
    <div class="break"></div>
    <div id="copyright">
        &copy; <?php echo esc_html( date_i18n( __( 'Y', 'idt' ) ) ); ?> <?php echo esc_html( get_bloginfo( 'name' ) ); ?>
    </div>
</div>
</footer>
</div>
<?php wp_footer(); ?>
<!-- Modal HTML embedded directly into document -->
<div id="ex1" class="modal">
    <p style="text-align: center; padding-bottom: 0">Subscribe to our daily newsletter</p>
    <?php echo do_shortcode('[contact-form-7 id="29" title="Newsletter"]'); ?>
</div>
</body>
</html>
