<?php

add_action( 'init', 'register_products_post_type' );
function register_products_post_type() {
	// Раздел вопроса - productscat
	register_taxonomy('productscat', array('products'), array(
		'label'                 => 'Categories', // определяется параметром $labels->name
		'labels'                => array(
			'name'              => 'Product categories',
			'singular_name'     => 'Categories',
			'search_items'      => 'Search category',
			'all_items'         => 'All categories',
			'parent_item'       => 'Parent category',
			'parent_item_colon' => 'Parent category:',
			'edit_item'         => 'Edit category',
			'update_item'       => 'Update category',
			'add_new_item'      => 'Add category',
			'new_item_name'     => 'Add new category',
			'menu_name'         => 'Categories',
		),
		'description'           => 'Categories for products', // описание таксономии
		'public'                => true,
		'show_in_nav_menus'     => false, // равен аргументу public
		'show_ui'               => true, // равен аргументу public
		'show_tagcloud'         => false, // равен аргументу show_ui
		'hierarchical'          => true,
		'rewrite'               => array('slug'=>'product', 'hierarchical'=>false, 'with_front'=>false, 'feed'=>false ),
		'show_admin_column'     => true, // Позволить или нет авто-создание колонки таксономии в таблице ассоциированного типа записи. (с версии 3.5)
    ) );

	// тип записи - вопросы - products
	register_post_type('mp_products', array(
		'label'               => 'Our products',
		'labels'              => array(
            'name' => 'Our products',
            'singular_name' => 'Product',
            'add_new' => 'Add product',
            'add_new_item' => 'Add new product',
            'edit_item' => 'Edit product',
            'new_item' => 'New Product',
            'all_items' => 'All products',
            'search_items' => 'Search',
            'not_found' =>  'Product not found.',
            'not_found_in_trash' => 'Products in trash not found.',
            'menu_name' => 'Products'
        ),
        'menu_icon' => 'dashicons-portfolio',
		'description'         => '',
		'public'              => true,
		'publicly_queryable'  => true,
		'show_ui'             => true,
        'show_in_rest'        => false,
        'menu_position' => 6,
		'rest_base'           => '',
		'show_in_menu'        => true,
		'exclude_from_search' => false,
		'capability_type'     => 'post',
		'map_meta_cap'        => true,
		'hierarchical'        => false,
		'rewrite'             => array( 'slug'=>'product/%productscat%', 'with_front'=>false, 'pages'=>false, 'feeds'=>false, 'feed'=>false ),
		'has_archive'         => true,
		'query_var'           => true,
		'supports'            => array( 'title', 'thumbnail', 'editor' ),
		'taxonomies'          => array( 'productscat' ),
	) );

}
## Отфильтруем ЧПУ произвольного типа
add_filter('post_type_link', 'products_permalink', 1, 2);
function products_permalink( $permalink, $post ){
	if( strpos($permalink, '%productscat%') === false )
		return $permalink;

	$terms = get_the_terms($post, 'productscat');
	if( ! is_wp_error($terms) && !empty($terms) && is_object($terms[0]) )
		$term_slug = array_pop($terms)->slug;
	else
		$term_slug = 'category';

	return str_replace('%productscat%', $term_slug, $permalink );
}



add_filter( 'astra_single_post_navigation_enabled', '__return_false' );





// add_shortcode('products', 'my_shortcode_function');
// function my_shortcode_function() {
//     $wp_query = new WP_Query( [
//       'post_type'      => 'mp_products',
//       'posts_per_page' => 6,
//       'paged'          => get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1
//     ] );
//     ob_start();
//     if ( $wp_query->have_posts() ) :
//       while ( $wp_query->have_posts() ) : $wp_query->the_post();
//         get_template_part( 'template-parts/products', get_post_format() );
//       endwhile;
//     else :
//       get_template_part( 'template-parts/content', 'none' );
//     endif;

//     // posts_nav_link();
//     $out = ob_get_clean();

//     return $out;
//   }


add_shortcode( 'products-slider', 'products_list_slider_shortcode' );
function products_list_slider_shortcode( $atts ) {
    ob_start();
    $args = shortcode_atts( array (
        'type' => 'mp_products',
        'posts' => -1,
        'public'   => true,
    ), $atts );
    $options = array(
        'post_type' => $args['type'],
        'posts_per_page' => $args['posts']
    );

    $query = new WP_Query( $options );
    if ( $query->have_posts() ) { ?>
            <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                <?php
                    get_template_part( 'template-parts/products-slider', get_post_format() );
                 ?>
            <?php endwhile;
            wp_reset_postdata(); ?>
    <?php $myvariable = ob_get_clean();
    return $myvariable;
    }
}
// < ?php echo do_shortcode('[products-slider]'); ? >






add_shortcode( 'products-s', 'related_posts_function' );
function related_posts_function ($atts){
	$atts = shortcode_atts( array(
		'id' => '',
		'count' => 3
		), $atts );

	$args = array(
		'post_type' => 'mp_products',
		'post_status' => 'publish',
		'posts_per_page' => $atts['count'],
		'include' => $atts['id']
		);
	$out_posts = get_posts( $args );
	$out = '<style>
		.art-rp{
		    background: #ddd;
		    padding: 20px 20px;
		}
	</style>';
	$out .= '<ul class="art-rp">';
	foreach ($out_posts as $post) {
		setup_postdata( $post );
		$out .= '<li><a href="'. get_the_permalink($post->ID) .'">'. get_the_title( $post->ID ) . '</a></li>';
	}
	$out .= '</ul>';
	wp_reset_postdata();

	return $out;
}

// [products-s id=""]



add_shortcode( 'product', 'product_by_slug' );
function product_by_slug( $atts ) {
    ob_start();
    $args = shortcode_atts( array (
		'type' => 'mp_products',
		'name' => array(),
        'posts' => 1,
        'public'   => true,
	), $atts );
	$slug = explode(',', $args['name']);
    $options = array(
		'post_type' => $args['type'],
		'post_name__in' => $slug,
    );

    $query = new WP_Query( $options );
    if ( $query->have_posts() ) { ?>
            <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                <?php
                    get_template_part( 'template-parts/product-post', get_post_format() );
                 ?>
            <?php endwhile;
            wp_reset_postdata(); ?>
    <?php $myvariable = ob_get_clean();
    return $myvariable;
    }
}



    add_filter( 'manage_edit-mp_products_columns', 'my_edit_programs_columns' ) ;
    function my_edit_programs_columns( $columns ) {
        $columns = array(
            'cb' => '&lt;input type="checkbox" />',
            'title' => __( 'Product name' ),
            'shortcode' => __( 'Shortcode' ),
            // 'cat_teatcher' => __( 'Курс' ),
            'date' => __( 'Date' )
        );
        return $columns;
    }


    add_action( 'manage_mp_products_posts_custom_column', 'my_manage_programs_columns', 10, 2 );
    function my_manage_programs_columns( $column, $post_id ) {
        global $post;

        switch( $column ) {
            case 'shortcode' :
                $shortcode = $post->post_name;
                if ( empty( $shortcode ) )
                    echo __( 'Unknown' );
                else
                    printf( __( '<input type="text" onfocus="this.select();" style="width: auto;max-width: 200px;" readonly="" value="[product name=%s]" class="large-text code">' ), $shortcode );
            break;

            default :
                break;
        }
    }
























?>
