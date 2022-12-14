<?php get_header(); ?>
<?php if ( have_posts() ) : ?>
    <div class="container">
    <div class="blog-posts">
        <h2 itemprop="name" class="entry-title secondary"><?php single_term_title(); ?></h2>
        <div class="archive-meta" itemprop="description"><?php if ( '' != get_the_archive_description() ) { echo esc_html( get_the_archive_description() ); } ?></div>

        <div class="post-grid">
            <?php
            if ( have_posts() ) : while ( have_posts() ) : the_post();
                $cats = wp_get_post_categories(get_the_ID());
                ?>
                <div class="grid">
                    <div class="card">
                        <div class="card__image">
                            <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(),'full') ?>" alt="">

                            <div class="card__overlay card__overlay--dark"   data-cat-color="<?php echo get_field('styling_color',get_term(reset($cats))); ?>">
                                <div class="card__overlay-content">
                                    <ul class="card__meta">
                                        <?php
                                        foreach ($cats as $cat){
                                            ?>
                                            <li><a href="<?php echo get_category_link($cat) ?>"><?php echo get_cat_name($cat)?></a></li>
                                            <?php
                                        }
                                        ?>
                                    </ul>

                                    <a href="<?php echo get_permalink(get_the_ID()) ?>" class="card__title"><?php echo get_the_title(get_the_ID())?></a>

                                    <ul class="card__meta card__meta--last">
                                        <li><a href="#">
                                                <?php
                                                echo prefix_estimated_reading_time(get_the_ID())
                                                ?>
                                            </a></li>
                                        <li><a href="<?php echo get_permalink(get_the_ID()) ?>"> Read more</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                $grid_first = false;
            endwhile; endif;
            wp_reset_query();
            ?>
        </div>
        <?php
        global $wp_query;
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        if ($paged<$wp_query->max_num_pages)
        {
            ?>
            <div class="blog-pagination">
                <a href="#" class="button paginate-next" data-current-query='<?php echo urlencode(json_encode($wp_query->query_vars)); ?>'>Load more</a>
            </div>
            <?php
        }
        ?>
    </div>

    <?php get_template_part( 'nav', 'below' ); ?>
<?php else : ?>
    <div class="container">
        <article id="post-0" class="post no-results not-found">
            <h2 itemprop="name" class="entry-title secondary"><?php esc_html_e( 'Nothing Found', 'idt' ); ?></h2>

            <div class="entry-content" itemprop="mainContentOfPage">
                <p><?php esc_html_e( 'Sorry, nothing matched your search. Please try again.', 'idt' ); ?></p>
            </div>
        </article>
    </div>
    </div>


<?php endif; ?>
<?php get_footer(); ?>

