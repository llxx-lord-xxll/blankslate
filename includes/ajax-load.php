<?php
function idt_get_next_post() {
    $args = (array)json_decode(urldecode($_POST['query']));
    $args['paged'] = $args['paged'] + 1;
    $query = new WP_Query($args);
    $posts = array();
    foreach ($query->get_posts() as $post){
        $rpost = array();
        $rpost['thumb'] = get_the_post_thumbnail_url($post->ID,'full');
        $rpost['cats'] = "";
        $cats = wp_get_post_categories($post->ID);
        foreach ($cats as $cat){
            $rpost['cats'] = $rpost['cats'] . '<li><a href="' . get_category_link($cat) . '">' . get_cat_name($cat) .'</a></li>';
        }
        $rpost['permalink'] = get_permalink($post->ID);
        $rpost['title'] = get_the_title($post->ID);
        $rpost['reading'] = prefix_estimated_reading_time($post->ID);
        array_push($posts,$rpost);
    }
    if ($args['paged']<$query->max_num_pages){
        echo json_encode(array('posts'=> $posts, 'query' => urlencode(json_encode($args)),'end' => false));
    }
    else{
        echo json_encode(array('posts'=> $posts, 'query' => urlencode(json_encode($args)),'end' => true));
    }

    wp_die();  //die();
}

function idt_custom_number_of_posts( $query ) {
    $query->set('posts_per_page', 9 );
}
add_action( 'pre_get_posts', 'idt_custom_number_of_posts', 1 );


add_action( 'wp_ajax_nopriv_get_next_post', 'idt_get_next_post' );
add_action( 'wp_ajax_get_next_post', 'idt_get_next_post' );
