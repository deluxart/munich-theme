<?php
/*
Template Name: Text page
*/
get_header();
?>

	<div id="primary" class="content-area subpage">
		<main id="main" class="site-main">
			<div class="container">
			<?php if ( function_exists( 'dimox_breadcrumbs' ) ) dimox_breadcrumbs(); ?>
			<?php
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/content', 'text' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
// get_sidebar();
get_footer();
