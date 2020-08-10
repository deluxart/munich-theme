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
		'menu_position' => 5,
        'supports' => array( 'title', 'revisions'),
        // 'rewrite' => array('slug' => 'service'),
        'rewrite' => array('slug' => 'ma-services')
        // 'rewrite'    => array('slug' => '/' )
	);
	register_post_type('ma-services', $args);
}

/**
 * Remove the slug from published post permalinks.
 */
function custom_remove_cpt_slug($post_link, $post, $leavename)
{
    if ('ma-services' != $post->post_type || 'publish' != $post->post_status)
    {
        return $post_link;
    }
    $post_link = str_replace('/' . $post->post_type . '/', '/', $post_link);

    return $post_link;
}

add_filter('post_type_link', 'custom_remove_cpt_slug', 10, 3);

function custom_parse_request_tricksy($query)
{
    if (!$query->is_main_query())
        return;
    if (2 != count($query->query) || !isset($query->query['page']))
    {
        return;
    }
    if (!empty($query->query['name']))
    {
        $query->set('post_type', array('post', 'ma-services', 'page'));
    }
}
add_action('pre_get_posts', 'custom_parse_request_tricksy');















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