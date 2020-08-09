<?php
/*
Template Name: Blog
*/

get_header();
?>



	<div id="primary" class="content-area subpage">
		<main id="main" class="site-main">
			<div class="container">
				<?php if(function_exists('bcn_display')) { 
					echo '<div class="breadcrumbs"><ul>';
						bcn_display(); 
					echo '</ul></div>';
					}
				?>
			<?php
			if ( have_posts() ) :
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/content', 'posts' );
				endwhile; // End of the loop.
			endif;
			?>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
