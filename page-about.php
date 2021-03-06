<?php
/*
Template Name: About page
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
				</div>
			<?php
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/content', 'about' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>
			<!-- </div> -->
		</main><!-- #main -->
	</div><!-- #primary -->


<div id="insta">
		<div class="container">
			<h3>follow on  instagram</h3>
			<div class="content">
				<img src="<?php echo get_template_directory_uri(); ?>/src/img/insta1.png" alt="">
				<img src="<?php echo get_template_directory_uri(); ?>/src/img/insta2.png" alt="">
				<img src="<?php echo get_template_directory_uri(); ?>/src/img/insta3.png" alt="">
				<img src="<?php echo get_template_directory_uri(); ?>/src/img/insta1.png" alt="">
				<img src="<?php echo get_template_directory_uri(); ?>/src/img/insta2.png" alt="">
				<img src="<?php echo get_template_directory_uri(); ?>/src/img/insta3.png" alt="">
			</div>
		</div>
	</div>


<?php
// get_sidebar();
get_footer();
