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
    <p>Thanks for clicking. That felt good.</p>
    <a href="#" rel="modal:close">Close</a>
</div>
</body>
</html>
