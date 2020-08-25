<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package munich
 */

get_header();
?>

	<div id="primary" class="content-area subpage">
		<main id="main" class="site-main">
		<div class="container">
		<?php


if (is_blog()) {

				 if(function_exists('bcn_display')) { 
					echo '<div class="breadcrumbs"><ul>';
						bcn_display(); 
					echo '</ul></div>';
					}
				
		if ( have_posts() ) :
			if ( is_home() && ! is_front_page() ) :
				?>
				<header>
					<h3 class="page-title"><?php single_post_title(); ?></h3>
				</header>
				<?php
			endif;
			echo '<div class="blog-posts">';
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/content-posts', get_post_type() );
			endwhile;
			echo '</div>';

			the_posts_navigation();
		else :
			get_template_part( 'template-parts/content', 'none' );
		endif;


} else {


		if ( have_posts() ) :
			if ( is_home() && ! is_front_page() ) :
				?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>
				<?php
			endif;
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/content', get_post_type() );
			endwhile;
			the_posts_navigation();
		else :
			get_template_part( 'template-parts/content', 'none' );
		endif;


}
		?>
		</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php if (is_blog()) { ?>
<section id="gray_circle_text">
	<div class="container">
		<?php if ( have_rows( 'zum_produkte_button' ) ) : ?>
			<?php while ( have_rows( 'zum_produkte_button' ) ) : the_row(); ?>
				<a href="<?php the_sub_field( 'button_link' ); ?>" class="btn border"><?php the_sub_field( 'button_title' ); ?></a>
			<?php endwhile; ?>
		<?php endif; ?>
	</div>
</section>
<? } ?>


<?php
get_footer();
