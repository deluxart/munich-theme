<?php
add_action( 'init', 'courses_programs' );

function courses_programs() {
	$labels = array(
		'name' => 'Reviews',
		'singular_name' => 'Review',
		'add_new' => 'Add review',
		'add_new_item' => 'Add new review',
		'edit_item' => 'Edit review',
		'new_item' => 'New review',
		'all_items' => 'All reviews',
		'search_items' => 'Search review',
		'not_found' =>  'No review found.',
		'not_found_in_trash' => 'There are no reviews in the basket..',
		'menu_name' => 'Reviews'
	);
	$args = array(
		'labels' => $labels,
		'public' => false,
		'show_ui' => true,
		'has_archive' => true,
		'menu_icon' => 'dashicons-format-status',
		'menu_position' => 7,
		'supports' => array( 'title', 'revisions')
	);
	register_post_type('ma-reviews', $args);
}






add_shortcode( 'reviews-list', 'open_courses_listing_parameters_shortcode' );
function open_courses_listing_parameters_shortcode( $atts ) {
    ob_start();
    $args = shortcode_atts( array (
        'type' => 'ma-reviews',
        'posts' => -1,
        'public'   => true,
    ), $atts );
    $options = array(
        'post_type' => $args['type'],
        // 'meta_key'          => 'otkryt_nabor_sortirovka',
        // 'orderby'           => 'meta_value',
        // 'order'             => 'ASC',
        'posts_per_page' => $args['posts']
    );

    $query = new WP_Query( $options );
    if ( $query->have_posts() ) { ?>
            <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                <?php
                    get_template_part( 'template-parts/reviews-list', get_post_format() );
                 ?>
            <?php endwhile;
            wp_reset_postdata(); ?>
    <?php $myvariable = ob_get_clean();
    return $myvariable;
    }
}
// < ?php echo do_shortcode('[reviews-list]'); ? >







?>