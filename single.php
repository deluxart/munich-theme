<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package munich
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
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', get_post_type() );

			the_post_navigation();

			// If comments are open or we have at least one comment, load up the comment template.
			// if ( comments_open() || get_comments_number() ) :
			// 	comments_template();
			// endif;

		endwhile; // End of the loop.
		?>
<?php if (is_singular('post')) { ?>
<section id="articles" class="single">
		<div class="container">
			<div class="title">
				<h3>you may also like</h3>
				<div>
					<div class="paginationSlider">
						<div>
							<div class="pagination"></div>
							<div class="button-prev"><img src="<?php echo get_template_directory_uri(); ?>/src/img/arrow_left.svg" alt=""></div>
							<div class="button-next"><img src="<?php echo get_template_directory_uri(); ?>/src/img/arrow_right.svg" alt=""></div>
						</div>
					</div>
				</div>
			</div>
			<div class="blogSlider">
				<div class="swiper-wrapper">
						<?php echo do_shortcode('[recent_posts posts="'.get_field( 'show_items' ).'"]'); ?>
				</div>
			</div>
		</div>
		<div class="container scrollbar">
			<div class="swiper-scrollbar js-swiper-scrollbar"></div>
		</div>
	</section>
<? } ?>

			</div>
		</main><!-- #main -->
	</div><!-- #primary -->







<?php if (is_singular('post')) { ?>
<section id="gray_circle_text">
	<div class="container">
		<?php if ( have_rows( 'zum_produkte_button', 'option' ) ) : ?>
			<?php while ( have_rows( 'zum_produkte_button', 'option' ) ) : the_row(); ?>
				<a href="<?php the_sub_field( 'button_link', 'option' ); ?>" class="btn border"><?php the_sub_field( 'button_title', 'option' ); ?></a>
			<?php endwhile; ?>
		<?php endif; ?>
	</div>
</section>
<? } ?>

<?php
get_footer();
