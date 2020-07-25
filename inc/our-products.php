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
        'menu_position' => 5,
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





add_shortcode('products', 'my_shortcode_function');
function my_shortcode_function() {
    $wp_query = new WP_Query( [
      'post_type'      => 'mp_products',
      'posts_per_page' => 6,
      'paged'          => get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1
    ] );
    ob_start();
    if ( $wp_query->have_posts() ) :
      while ( $wp_query->have_posts() ) : $wp_query->the_post();
        get_template_part( 'template-parts/products', get_post_format() );
      endwhile;
    else :
      get_template_part( 'template-parts/content', 'none' );
    endif;

    // posts_nav_link();
    $out = ob_get_clean();

    return $out;
  }



add_shortcode('products-mini', 'my_shortcode_function_mini');
function my_shortcode_function_mini() {
	global $wp_query;
	$wp_query = new WP_Query(array(
		// 'category_name' => 'portfolio',
		'post_type' => 'mp_products',
		'posts_per_page' => '6',
		// 'paged' => get_query_var('paged') ?: 1
	));
ob_start();

	if ( have_posts() ) :
	        while ( have_posts() ) : the_post();

	            get_template_part( 'template-parts/products_home', get_post_format() );

	        endwhile;
	    else :
	        get_template_part( 'template-parts/content', 'none' );
	    endif;

	wp_reset_query(); // сброс $wp_query
	$out = ob_get_clean();
	return $out;
}








// add_filter( 'manage_edit-mp_products_columns', 'my_edit_mp_products_columns' ) ;
// function my_edit_mp_products_columns( $columns ) {
//     $columns = array(
//         'cb' => '&lt;input type="checkbox" />',
//         'course_icon' => __(''),
//         'title' => __( 'Название курса' ),
//         'data_starta' => __( 'Старт' ),
//         'stoimost' => __( 'Стоимость' ),
//         'grafik_zanyatij' => __( 'Расписание' ),
//         'cat_work' => __( 'Категория' ),
//         'otobrazhenie' => __( 'Открыт набор' ),
//     );
//     return $columns;
// }


// add_action( 'manage_mp_products_posts_custom_column', 'my_manage_mp_products_columns', 10, 2 );
// function my_manage_mp_products_columns( $column, $post_id ) {
//     global $post;

//     switch( $column ) {
//         case 'course_icon' :
//             $logo = get_field( "logo_url", $post->ID );
//             if ( empty( $logo ) );
//             else
//                 printf( __( '<img src="%s" style="display: block; max-width: 48px; max-height: 48px;" alt="" />' ), $logo );
//         break;

//         case 'data_starta' :
//             if ( have_rows( 'data_raspisanie_grafik' ) ) :
//                 while ( have_rows( 'data_raspisanie_grafik' ) ) : the_row();

//                 if ( have_rows( 'date_start' ) ) :
//                     while ( have_rows( 'date_start' ) ) : the_row();
//                         $start = get_sub_field( "start_rus", $post->ID );
//                     endwhile;
//                 endif;

//                 if ( empty( $start ) )
//                     echo __( 'Дата не указана' );
//                 else
//                     printf( $start );
//                 endwhile;
//             endif;
//         break;



//         case 'stoimost' :
//             if ( have_rows( 'stoimost_kursa' ) ) :
//                 while ( have_rows( 'stoimost_kursa' ) ) : the_row();

//                     $price = get_sub_field( "price_work", $post->ID );
//                     while ( have_rows( 'before_price' ) ) : the_row();
//                         $price_before = get_sub_field( "before_price_rus", $post->ID );
// 			        endwhile;
//                     $znachenie_czeny = get_sub_field( "units", $post->ID );

//                     if ( empty( $price ) )
//                         echo __( 'Не указана' );
//                     else
//                         printf( $price_before );
//                         echo __( ' ' );
//                         printf( __( '<strong>%s</strong>' ), $price );
//                         echo __( ' ' );
//                         printf( $znachenie_czeny );
//                     endwhile;
//                 endif;
//         break;


//         case 'grafik_zanyatij' :
//             if ( have_rows( 'data_raspisanie_grafik' ) ) :
//                 while ( have_rows( 'data_raspisanie_grafik' ) ) : the_row();

//                 if ( have_rows( 'schedule' ) ) :
//                     while ( have_rows( 'schedule' ) ) : the_row();
//                         $grafik = get_sub_field( "schedule_rus", $post->ID );
//                     endwhile;
//                 endif;

//                 if ( empty( $grafik ) )
//                     echo __( 'График не указан' );
//                 else
//                     printf( $grafik );
//                 endwhile;
//             endif;
//         break;


//         case 'cat_work' :
//             $taxonomy = 'mp_products_cat';
//             $post_type = get_post_type($post_id);
//             $terms = get_the_terms($post_id, $taxonomy);

//             if (!empty($terms) ) {
//                 foreach ( $terms as $term )
//                 $post_terms[] ="<a href='edit.php?post_type={$post_type}&{$taxonomy}={$term->slug}'> " .esc_html(sanitize_term_field('name', $term->name, $term->term_id, $taxonomy, 'edit')) . "</a>";
//                 echo join('', $post_terms );
//             }
//              else echo '<i>Без категории</i>';
//         break;




//         case 'otobrazhenie' :

//             if ( have_rows( 'otkryt_nabor' ) ) :
//                 while ( have_rows( 'otkryt_nabor' ) ) : the_row();
//                     $otobrazhenie = get_sub_field( "nabor_otkryt", $post->ID );
//                     $sortdate = get_sub_field( "sortirovka", $post->ID );
//                     if ( $otobrazhenie == 1 )
//                     printf( __( '<strong>%s</strong>' ), $sortdate );
//                 else
//                     echo __( '<span style="background: #fe5151;border-radius: 30px; padding: 3px 6px;color: #fff;">Скрыто</span>');
//                 endwhile;
//             endif;
//     break;

//         default :
//             break;
//     }
// }




add_shortcode( 'list-open-courses', 'open_products_listing_parameters_shortcode' );
function open_products_listing_parameters_shortcode( $atts ) {
    ob_start();
    $args = shortcode_atts( array (
        'type' => 'mp_products',
        'posts' => -1,
        'public'   => true,
    ), $atts );
    $options = array(
        'post_type' => $args['type'],
        'meta_key'          => 'otkryt_nabor_sortirovka',
        'orderby'           => 'meta_value',
        'order'             => 'ASC',
        'posts_per_page' => $args['posts']
    );

    $query = new WP_Query( $options );
    if ( $query->have_posts() ) { ?>
            <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                <?php
                    get_template_part( 'template-parts/open-courses', get_post_format() );
                 ?>
            <?php endwhile;
            wp_reset_postdata(); ?>
    <?php $myvariable = ob_get_clean();
    return $myvariable;
    }
}


// Список курсов (блоков) для главной страницы
add_shortcode( 'courses', 'courses_listing_home' );
function courses_listing_home( $atts ) {
    ob_start();
    $args = shortcode_atts( array (
        'type' => 'mp_products',
        'posts' => -1,
        'category' => '',
        'public'   => true,
    ), $atts );
    $options = array(
        'post_type' => $args['type'],
        'meta_key'          => 'kol-vo_svobodnyh_mest',
        'orderby'           => 'meta_value',
        'order'             => 'DESC',
        'posts_per_page' => $args['posts'],
        // 'category_name' => $args['category'],
        'post_status' => 'publish',

        'tax_query'         => array( array(
        'taxonomy'  => 'mp_products_cat',
        'field'     => 'slug',
        'terms'     => array( sanitize_title( $atts['category'] ) )
        ) )
    );

    $query = new WP_Query( $options );
    if ( $query->have_posts() ) { ?>
            <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                <?php
                    get_template_part( 'template-parts/cards-course', get_post_format() );
                 ?>
            <?php endwhile;
            wp_reset_postdata(); ?>
    <?php $myvariable = ob_get_clean();
    return $myvariable;
    }
}



// Список курсов (по категориям) для посадочных страниц - "Продолжайте свое обучение"
add_shortcode( 'courses-pages', 'courses_listing_pages' );
function courses_listing_pages( $atts ) {
    ob_start();
    $args = shortcode_atts( array (
        'type' => 'mp_products',
        'posts' => -1,
        'category' => '',
        'public'   => true,
    ), $atts );
    $options = array(
        'post_type' => $args['type'],
        'meta_key'          => 'kol-vo_svobodnyh_mest',
        'orderby'           => 'meta_value',
        'order'             => 'DESC',
        'posts_per_page' => $args['posts'],
        // 'category_name' => $args['category'],
        'post_status' => 'publish',

        'tax_query'         => array( array(
        'taxonomy'  => 'mp_products_cat',
        'field'     => 'slug',
        'terms'     => array( sanitize_title( $atts['category'] ) )
        ) )
    );

    $query = new WP_Query( $options );
    if ( $query->have_posts() ) { ?>
            <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                <?php
                    get_template_part( 'template-parts/cards-course-pages', get_post_format() );
                 ?>
            <?php endwhile;
            wp_reset_postdata(); ?>
    <?php $myvariable = ob_get_clean();
    return $myvariable;
    }
}

?>
