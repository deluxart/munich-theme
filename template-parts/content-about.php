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
		<div class="container">
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
		</div>
	</section>

	<section id="history">
		<div class="container">
			<div class="content">
				<div class="text">
					<h2><?php the_field( 'section_title_history' ); ?></h2>
					<?php the_field( 'section_content_history' ); ?>
				</div>
				<div class="image">
					<?php if ( get_field( 'section_image_history' ) ) : ?>
						<img src="<?php the_field( 'section_image_history' ); ?>" />
					<?php endif ?>
				</div>
			</div>
		</div>
	</section>


	<section id="about_video">
		<div class="container">
		<!-- <img src="http://dev.seiten.co/wp-munich-accessories-de/wp-content/uploads/2020/08/video_img.jpg" alt=""> -->
		<div class="video_block desktop">
			<!-- <video autoplay muted loop id="myVideo"> -->
			<video loop id="myVideo">
				<source src="http://dev.seiten.co/wp-munich-accessories-de/wp-content/uploads/2020/08/about_ma.mp4" type="video/mp4">
			</video>
			<button id="maVideoBtn" onclick="myFunction()"></button>
		</div>
		<div class="video_section mobile">
			<!-- <video autoplay muted loop id="myVideo"> -->
			<video loop id="video_click">
				<source src="http://dev.seiten.co/wp-munich-accessories-de/wp-content/uploads/2020/08/about_ma.mp4" type="video/mp4">
			</video>
			<button class="video_play"></button>
		</div>
		</div>
	</section>


	<section id="our_clients">
		<div class="container">
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
			<div class="swiper-wrapper">
			<?php if ( have_rows( 'client_about' ) ) : ?>
				
				<?php while ( have_rows( 'client_about' ) ) : the_row(); ?>
				<div class="item swiper-slide">
					<a href="<?php the_sub_field( 'link' ); ?>"><?php if ( get_sub_field( 'logo' ) ) : ?>
						<img src="<?php the_sub_field( 'logo' ); ?>" />
					<?php endif ?></a>
				</div>
				<?php endwhile; ?>
				
			<?php else : ?>
				<?php // no rows found ?>
			<?php endif; ?>
			</div>
		</div>
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
		<div class="container">
		<div class="team-content">
			<div class="swiper-wrapper">
			<?php if ( have_rows( 'user_team' ) ) : ?>
				<?php while ( have_rows( 'user_team' ) ) : the_row(); ?>
					<div class="item swiper-slide">
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
		</div>
		</div>
	</section>


	<section id="contact-form">
		<div class="container">
			<h3><?php the_field( 'section_title_contact' ); ?></h3>
			<div class="form-prod">
			<?php
				$contacts_form = get_post_meta($post->ID,'form_shortcode',true);
				echo do_shortcode($contacts_form);
 			?>
			</div>
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
			<div class="swiper-scrollbar js-swiper-scrollbar"></div>
	</section>


	</div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->
