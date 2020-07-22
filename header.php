<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package munich
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<!-- <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/src/css/swiper.min.css"> -->
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'my-site' ); ?></a>

	<header id="header">
			<div class="content">
				<div class="logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo get_template_directory_uri(); ?>/src/img/logo.png" alt=""></a></div>
				<div class="phone"><a href="tel:+49089232418950">+49 (0) 89/2324189-50</a></div>
				<div class="nav">
					<div class="btn-menu">
						<img src="<?php echo get_template_directory_uri(); ?>/src/img/menu.svg" alt="">
						<span>Menu</span>
					</div>
				</div>
			</div>
	</header>

	<div id="content" class="site-content">
