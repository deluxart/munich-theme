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

<div class="nav-menu">
	<div class="nav-menu__content">
		<div class="container">
			<div class="fs-content">
                <?php
                    $menuParameters = array(
                        'menu'            => 'Menu 1',
                        'container'       => false,
                        'items_wrap'      => '<ul class="nav-menu__list">%3$s</ul>',
                        'depth'           => 0,
                        'echo'            => true,
                        'before'          => '',
                        'after'           => '',
                        'link_before'     => '',
                        'link_after'      => '',
						'walker'          => '',
						'add_li_class'  => 'nav-menu__list-item',
                        'walker_nav_menu_start_el'          => '',
                    );
                    echo strip_tags(wp_nav_menu( $menuParameters ), '<a>' );
                ?>
                <?php
                    $menuParameters = array(
                        'menu'            => 'Menu 2',
                        'container'       => false,
                        'items_wrap'      => '<ul class="black">%3$s</ul>',
                        'depth'           => 0,
                        'echo'            => true,
                        'before'          => '',
                        'after'           => '',
                        'link_before'     => '',
                        'link_after'      => '',
						'walker'          => '',
						'add_li_class'  => 'nav-menu__list-item',
                        'walker_nav_menu_start_el'          => '',
                    );
                    echo strip_tags(wp_nav_menu( $menuParameters ), '<a>' );
				?>
			<div class="lang-selector mobile">
			<?php pll_the_languages(array(
					'dropdown'=>1,
					'display_names_as' => 'slug'
					)); ?></div>
			<div class="fs-contacts">
				<ul>
					<li><span>adress</span>Südliche Münchner Str. <br/>60 82031 Grünwald <br/>Germany</li>
					<li><span>email</span><a href="mailto:info@munich-accessories.de">info@munich-accessories.de</a></li>
					<li><span>fax</span><a href="fax:+49089232418956">+49 (0) 89/2324189-56</a></li>
					<li><span>instagram</span><a href="#">@htfgjgfhfgh</a></li>
				</ul>
			</div>
			</div>
		</div>
	</div>
</div>


<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'my-site' ); ?></a>

	<header id="header">
			<div class="content">
				<div class="logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo get_template_directory_uri(); ?>/src/img/logo.png" alt=""></a></div>
				<div class="phone"><a href="tel:+49089232418950">+49 (0) 89/2324189-50</a></div>
				<div class="lang-selector"><?php pll_the_languages(array(
					'dropdown'=>1,
					'display_names_as' => 'slug'
					)); ?></div>
				<div class="nav">
					<div class="btn-menu">
						<div class="menu-icon">
						<span class="menu-icon__line menu-icon__line-left"></span>
						<span class="menu-icon__line"></span>
						<span class="menu-icon__line menu-icon__line-right"></span>
					</div>
						<span>Menu</span>
					</div>
				</div>
			</div>
	</header>

	<div id="content" class="site-content">
