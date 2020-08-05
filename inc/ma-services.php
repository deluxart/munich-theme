<?php
add_action( 'init', 'ma_services' );

function ma_services() {
	$labels = array(
		'name' => 'Services',
		'singular_name' => 'Service',
		'add_new' => 'Add service',
		'add_new_item' => 'Add new service',
		'edit_item' => 'Edit service',
		'new_item' => 'New service',
		'all_items' => 'All services',
		'search_items' => 'Search service',
		'not_found' =>  'No services found.',
		'not_found_in_trash' => 'There are no services in the basket..',
		'menu_name' => 'Services'
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'show_ui' => true,
		'has_archive' => true,
		'menu_icon' => 'dashicons-welcome-widgets-menus',
		'menu_position' => 10,
        'supports' => array( 'title', 'revisions'),
        // 'rewrite' => array('slug' => 'service'),
        'rewrite'    => array('slug' => '/' )
	);
	register_post_type('ma-services', $args);
}








add_action( 'pre_get_posts', 'wpse_include_my_post_type_in_query' );
function wpse_include_my_post_type_in_query( $query ) {

     // Only noop the main query
     if ( ! $query->is_main_query() )
         return;

     // Only noop our very specific rewrite rule match
     if ( 2 != count( $query->query )
     || ! isset( $query->query['page'] ) )
          return;

      // Include my post type in the query
     if ( ! empty( $query->query['name'] ) )
          $query->set( 'post_type', array( 'post', 'page', 'ma-services' ) );
 }


add_action( 'parse_query', 'wpse_parse_query' );
function wpse_parse_query( $wp_query ) {

    if( get_page_by_path($wp_query->query_vars['name']) ) {
        $wp_query->is_single = false;
        $wp_query->is_page = true;
    }

}
















add_shortcode( 'services-list', 'services_listing_parameters_shortcode' );
function services_listing_parameters_shortcode( $atts ) {
    ob_start();
    $args = shortcode_atts( array (
        'type' => 'ma-services',
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
                    get_template_part( 'template-parts/services-list', get_post_format() );
                 ?>
            <?php endwhile;
            wp_reset_postdata(); ?>
    <?php $myvariable = ob_get_clean();
    return $myvariable;
    }
}
// < ?php echo do_shortcode('[services-list]'); ? >







?>