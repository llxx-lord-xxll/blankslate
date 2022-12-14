<?php
get_header();
?>

<?php
$sticky = get_option( 'sticky_posts' );
if (!empty($sticky)):
    $hero = array_shift($sticky);
    $hero_cats = wp_get_post_categories($hero);

    ?>
    <div class="idt-hero-post" style="background-image: url('<?php echo get_the_post_thumbnail_url($hero,'full') ?>')" >
        <div class="post-details">
            <ul class="categories">
                <li><a href="#">Featured</a></li>
                <?php
                foreach ($hero_cats as $cat){
                    ?>
                    <li><a href="<?php echo get_category_link($cat) ?>"><?php echo get_cat_name($cat)?></a></li>
                    <?php
                }
                ?>
            </ul>
            <h2><?php echo get_the_title($hero)?></h2>
            <ul class="estimation">
                <li>
                    <?php
                    echo prefix_estimated_reading_time($hero)
                    ?>
                </li>
                <li>
                    <a href="<?php echo get_permalink($hero) ?>">Read more</a>
                </li>
            </ul>
        </div>
    </div>
<?php
endif;
wp_reset_query();

?>
    <div class="container">
        <div class="featured-posts">
            <?php
            if (!empty($sticky)):
                $args   = array(
                    'numberposts' => 3,
                    'include' => $sticky,
                    'post_type'   => 'post',
                    'post_status'    => 'publish'
                );
                $sticky_posts  = get_posts( $args );
                ?>
                <div class="post-grid">
                    <?php
                    $grid_count = 0;
                    foreach ( $sticky_posts as $sticky_post ) {
                        $sticky_post_id = $sticky_post->ID;
                        $sticky_cats = wp_get_post_categories($sticky_post_id);
                        $grid_count++;
                        ?>
                        <div class="grid <?php if ($grid_count % 3 == 0) echo 'tall'?>">
                            <div class="card">
                                <div class="card__image">
                                    <img src="<?php echo get_the_post_thumbnail_url($sticky_post_id,'full') ?>" alt="">

                                    <div class="card__overlay card__overlay--dark" data-cat-color="<?php echo get_field('styling_color',get_term(reset($sticky_cats))); ?>">
                                        <div class="card__overlay-content">
                                            <ul class="card__meta">
                                                <li><a href="#">Featured</a></li>
                                                <?php
                                                foreach ($sticky_cats as $cat){
                                                    ?>
                                                    <li><a href="<?php echo get_category_link($cat) ?>"><?php echo get_cat_name($cat)?></a></li>
                                                    <?php
                                                }
                                                ?>
                                            </ul>

                                            <a href="<?php echo get_permalink($sticky_post_id) ?>" class="card__title"><?php echo get_the_title($sticky_post_id)?></a>

                                            <ul class="card__meta card__meta--last">
                                                <li><a href="#0">
                                                        <?php
                                                        echo prefix_estimated_reading_time($sticky_post_id)
                                                        ?>
                                                    </a></li>
                                                <li><a href="<?php echo get_permalink($sticky_post_id) ?>"> Read more</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            <?php
            endif;
            wp_reset_query();
            ?>
        </div>
        <div class="trending-posts">
            <h2 class="secondary">Trending Posts</h2>
            <div class="post-grid">
                <?php
                $trendy_posts  = array_slice(get_posts( array( 'post_type' => 'post', 'meta_key' => 'post_views_count', 'orderby' => 'meta_value_num', 'order' => 'DESC', 'numberposts ' => 3) ),0,3);
                $grid_first = true;
                foreach ( $trendy_posts as $trendy_post ) {
                    $trendy_post_id = $trendy_post->ID;
                    $trendy_cats = wp_get_post_categories($trendy_post_id);
                    ?>
                    <div class="grid <?php if ($grid_first) echo 'tall'?>">
                        <div class="card">
                            <div class="card__image">
                                <img src="<?php echo get_the_post_thumbnail_url($trendy_post_id,'full') ?>" alt="">

                                <div class="card__overlay card__overlay--dark"  data-cat-color="<?php echo get_field('styling_color',get_term(reset($trendy_cats))); ?>">
                                    <div class="card__overlay-content">
                                        <ul class="card__meta">
                                            <li><a href="#">Trending</a></li>
                                            <?php
                                            foreach ($trendy_cats as $cat){
                                                ?>
                                                <li><a href="<?php echo get_category_link($cat) ?>"><?php echo get_cat_name($cat)?></a></li>
                                                <?php
                                            }
                                            ?>
                                        </ul>

                                        <a href="<?php echo get_permalink($trendy_post_id) ?>" class="card__title"><?php echo get_the_title($trendy_post_id)?></a>

                                        <ul class="card__meta card__meta--last">
                                            <li><a href="#0">
                                                    <?php
                                                    echo prefix_estimated_reading_time($trendy_post_id)
                                                    ?>
                                                </a></li>
                                            <li><a href="<?php echo get_permalink($trendy_post_id) ?>"> Read more</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    $grid_first = false;
                }
                ?>
            </div>
        </div>

    <div class="blog-posts">
        <h2 class="secondary">Latest Article</h2>
        <div class="post-grid">
            <?php
            if ( have_posts() ) : while ( have_posts() ) : the_post();
                $cats = wp_get_post_categories(get_the_ID());
                ?>
                <div class="grid">
                    <div class="card">
                        <div class="card__image">
                            <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(),'full') ?>" alt="">

                            <div class="card__overlay card__overlay--dark"  data-cat-color="<?php echo get_field('styling_color',get_term(reset($cats))); ?>">
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
    </div>
<?php


get_footer();
