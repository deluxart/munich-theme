<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package munich
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="about-page">
		

	<section id="aboutus">
		<div class="content">
			<div class="image">
				<?php if ( get_field( 'about_section_image' ) ) : ?>
					<img src="<?php the_field( 'about_section_image' ); ?>" />
				<?php endif ?>
			</div>
			<div class="text">
				<h2><?php the_field( 'about_section_title' ); ?></h2>
				<?php the_field( 'about_section_content' ); ?>
			</div>
		</div>
	</section>

	<section id="history">
		<h2><?php the_field( 'section_title_history' ); ?></h2>
		<div class="content">
			<div class="text">
				<?php the_field( 'section_content_history' ); ?>
			</div>
			<div class="image">
				<?php if ( get_field( 'section_image_history' ) ) : ?>
					<img src="<?php the_field( 'section_image_history' ); ?>" />
				<?php endif ?>
			</div>
		</div>
	</section>


	<section id="about_video">

	</section>


	<section id="our_clients">
		<div class="title">
			<h3 class="line"><?php the_field( 'section_title_clients' ); ?></h3>
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
		<div class="clients_slider">

			<?php if ( have_rows( 'client_about' ) ) : ?>
				<div class="item">
				<?php while ( have_rows( 'client_about' ) ) : the_row(); ?>
					<a href="<?php the_sub_field( 'link' ); ?>"><?php if ( get_sub_field( 'logo' ) ) : ?>
						<img src="<?php the_sub_field( 'logo' ); ?>" />
					<?php endif ?></a>
					
				<?php endwhile; ?>
				</div>
			<?php else : ?>
				<?php // no rows found ?>
			<?php endif; ?>

		</div>
	</section>


	<section id="unser">
		<div class="container">
			<div class="content">
				<div class="item first">
					<h3 class="line"><?php the_field( 'section_title_unser' ); ?></h3>
					<p><?php the_field( 'section_description_unser' ); ?></p>
				</div>
				<?php if ( have_rows( 'items_unser' ) ) : ?>
					<?php while ( have_rows( 'items_unser' ) ) : the_row(); ?>
								<div class="item">
									<div class="icon">
										<img src="<?php echo get_template_directory_uri(); ?>/src/img/star.svg" alt="">
									</div>
									<p><?php the_sub_field( 'item' ); ?></p>
								</div>
					<?php endwhile; ?>
				<?php else : ?>
					<?php // no rows found ?>
				<?php endif; ?>
			</div>
		</div>
	</section>


	<section id="team">
		<div class="team-content">

			<?php if ( have_rows( 'user_team' ) ) : ?>
				<?php while ( have_rows( 'user_team' ) ) : the_row(); ?>
					<div class="item">
					<?php if ( get_sub_field( 'photo' ) ) : ?>
						<div class="photo"><img src="<?php the_sub_field( 'photo' ); ?>" /></div>
					<?php endif ?>
					<h3><?php the_sub_field( 'name' ); ?></h3>
					<p><?php the_sub_field( 'position' ); ?></p>
					</div>
				<?php endwhile; ?>
			<?php else : ?>
				<?php // no rows found ?>
			<?php endif; ?>
		</div>
	</section>


	<section class="contact-form">
			<h3><?php the_field( 'section_title_contact' ); ?></h3>
			<div class="form-prod">
			<?php
				$contacts_form = get_post_meta($post->ID,'form_shortcode',true);
				echo do_shortcode($contacts_form);
 			?>
			</div>
	</section>



	<section id="reviews">
			<div class="title">
				<h3 class="line"><?php the_field( 'section_title_reviews' ); ?></h3>
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
			<div class="reviewsSlider">
				<div class="swiper-wrapper">
					<?php echo do_shortcode('[reviews-list]'); ?>
				</div>
			</div>
	</section>


	</div><!-- .entry-content -->

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
			edit_post_link(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Edit <span class="screen-reader-text">%s</span>', 'my-site' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				),
				'<span class="edit-link">',
				'</span>'
			);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
