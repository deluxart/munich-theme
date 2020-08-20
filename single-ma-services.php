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



<?php if ( have_rows( 'slide_for_category' ) ) : ?>
	<?php while ( have_rows( 'slide_for_category' ) ) : the_row(); ?>
	<section id="home_slider">
		<div class="home_slider">
			<div class="content category">
				<div class="text">
					<h1><?php the_sub_field( 'slide_title' ); ?></h1>
					<p class="description desktop"><?php the_sub_field( 'slide_descriptio' ); ?></p>
					<div class="image mobile">
						<p class="description mobile"><?php the_sub_field( 'slide_descriptio' ); ?></p>
					<?php if ( get_sub_field( 'slide_image' ) ) : ?>
						<img src="<?php the_sub_field( 'slide_image' ); ?>" />
					<?php endif ?>
					</div>
					<?php if ( have_rows( 'slide_list' ) ) : ?>
						<ul class="square">
						<?php while ( have_rows( 'slide_list' ) ) : the_row(); ?>
							<li><?php the_sub_field( 'item' ); ?></li>
						<?php endwhile; ?>
						</ul>
					<?php else : ?>
						<?php // no rows found ?>
					<?php endif; ?>
					<?php if ( have_rows( 'slide_button' ) ) : ?>
						<?php while ( have_rows( 'slide_button' ) ) : the_row(); ?>
							<a href="<?php the_sub_field( 'link_for_button' ); ?>" class="btn border"><?php the_sub_field( 'button_title' ); ?></a>
						<?php endwhile; ?>
					<?php endif; ?>
					
				</div>
				<div class="image desktop">
					<?php if ( get_sub_field( 'slide_image' ) ) : ?>
						<img src="<?php the_sub_field( 'slide_image' ); ?>" />
					<?php endif ?>
				</div>
			</div>
		</div>
	</section>
	<?php endwhile; ?>
<?php endif; ?>


<?php if ( get_field( 'activate_section_services' ) == 1 ) : ?>


	<section id="services">
		<div class="container">
			<div class="content">
				<?php if ( have_rows( 'items_services' ) ) : ?>
					<?php while ( have_rows( 'items_services' ) ) : the_row(); ?>
								<a href="<?php the_sub_field( 'link' ); ?>">
									<div class="item">
										<h3><?php the_sub_field( 'title' ); ?></h3>
										<div class="icon">
											<?php if ( get_sub_field( 'icon' ) ) : ?>
												<img src="<?php the_sub_field( 'icon' ); ?>" />
											<?php endif ?>
										</div>
									</div>
								</a>
					<?php endwhile; ?>
				<?php else : ?>
					<?php // no rows found ?>
				<?php endif; ?>
			</div>
		</div>
	</section>

<?php else : ?>
	<?php // echo 'false'; ?>
<?php endif; ?>



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

	<section id="about">
		<div class="content">
			<div class="mobile"><h3 class="line"><?php the_field( 'section_title_about' ); ?></h3></div>
			<div class="images">
				<!-- <img src="<?php echo get_template_directory_uri(); ?>/src/img/about_1.png" alt="">
				<img src="<?php echo get_template_directory_uri(); ?>/src/img/about_2.png" alt="">
				<img src="<?php echo get_template_directory_uri(); ?>/src/img/about_3.png" alt=""> -->

				<?php if ( have_rows( 'images_about' ) ) : ?>
					<?php while ( have_rows( 'images_about' ) ) : the_row(); ?>
						<?php if ( get_sub_field( 'image' ) ) : ?>
							<img src="<?php the_sub_field( 'image' ); ?>" />
						<?php endif ?>
					<?php endwhile; ?>
				<?php else : ?>
					<?php // no rows found ?>
				<?php endif; ?>


			</div>
			<div class="text">
				<h3 class="desktop line"><?php the_field( 'section_title_about' ); ?></h3>
				<p><?php the_field( 'content_about' ); ?></p>
				
				<?php if ( have_rows( 'button_about' ) ) : ?>
					<?php while ( have_rows( 'button_about' ) ) : the_row(); ?>
						<a href="<?php the_sub_field( 'link' ); ?>" class="btn"><?php the_sub_field( 'title' ); ?></a>
					<?php endwhile; ?>
				<?php endif; ?>
			</div>
		</div>
	</section>


	<section id="textile">
		<div class="content">
			<div class="mobile"><h3 class="line"><?php the_field( 'section_title_textile' ); ?></h3></div>
			<div class="text">
				<div>
				<h3 class="desktop line"><?php the_field( 'section_title_textile' ); ?></h3>
					<p><?php the_field( 'content_textile' ); ?></p>
				</div>
			</div>
			<div class="image">
				<?php if ( get_field( 'image_textile' ) ) : ?>
					<img src="<?php the_field( 'image_textile' ); ?>" />
				<?php endif ?>
			</div>
		</div>
	</section>
	
<?php if ( have_rows( 'items_products' ) ) : ?>

	<section id="products">
		<div class="container">
			<div class="slider_pagination">
				<div>
					<div class="pagination"></div>
					<div class="button-prev"><img src="<?php echo get_template_directory_uri(); ?>/src/img/arrow_left.svg" alt=""></div>
					<div class="button-next"><img src="<?php echo get_template_directory_uri(); ?>/src/img/arrow_right.svg" alt=""></div>
				</div>
			</div>
		</div>
		<div class="productSliderCat">
			<div class="swiper-wrapper">


	<?php while ( have_rows( 'items_products' ) ) : the_row(); ?>
		<?php if ( have_rows( 'item' ) ) : ?>
			<?php while ( have_rows( 'item' ) ) : the_row(); ?>
			<div class="item swiper-slide">
				<?php if ( get_sub_field( 'image' ) ) : ?>
					<div class="img"><img src="<?php the_sub_field( 'image' ); ?>" /></div>
				<?php endif ?>
				<h3><?php the_sub_field( 'title' ); ?></h3>
				<p><?php the_sub_field( 'description' ); ?></p>
				<?php if ( have_rows( 'button' ) ) : ?>
					<?php while ( have_rows( 'button' ) ) : the_row(); ?>
						<a href="<?php the_sub_field( 'link' ); ?>" class="btn"><?php the_sub_field( 'title' ); ?></a>
					<?php endwhile; ?>
				<?php endif; ?>
				</div>
			<?php endwhile; ?>
		<?php endif; ?>
	<?php endwhile; ?>


			</div>
		</div>
		<div class="container scrollbar">
			<div class="swiper-scrollbar js-swiper-scrollbar"></div>
		</div>
	</section>
<?php else : ?>
	<?php // no rows found ?>
<?php endif; ?>

	<section id="drinks">
		<div class="content">
			<div class="text">
				<div>
					<div class="title">
						<h3 class="line"><?php the_field( 'section_title_drinks' ); ?></h3>
						<div class="paginationSlider">
							<div>
								<div class="pagination"></div>
								<div class="button-prev"><img src="<?php echo get_template_directory_uri(); ?>/src/img/arrow_left.svg" alt=""></div>
								<div class="button-next"><img src="<?php echo get_template_directory_uri(); ?>/src/img/arrow_right.svg" alt=""></div>
							</div>
						</div>
					</div>
					<p><?php the_field( 'description_drinks' ); ?></p>
					<?php if ( have_rows( 'button_drinks' ) ) : ?>
						<?php while ( have_rows( 'button_drinks' ) ) : the_row(); ?>
							<button data-name="orderModal" class="btn da-modal"><?php the_sub_field( 'title' ); ?></button>
						<?php endwhile; ?>
					<?php endif; ?>
				</div>
			</div>
			<div class="drinksSlider">
				<div class="swiper-wrapper">

					<?php $items_drinks = get_field( 'items_drinks' ); ?>
					<?php if ( $items_drinks ) : ?>
						<?php foreach ( $items_drinks as $post_ids ) : ?>
							<div class="item swiper-slide">
								<div>
									<?php if ( get_field( 'preview_image', $post_ids ) ) : ?>
										<div class="img"><img src="<?php the_field( 'preview_image', $post_ids ); ?>" /></div>
									<?php endif ?>
									<a href="<?php echo get_permalink( $post_ids ); ?>"><h4 class="line"><?php echo get_the_title( $post_ids ); ?></h4></a>
									<p><?php the_field( 'short_description_product', $post_ids ); ?></p>
								</div>
							</div>
						<?php endforeach; ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="swiper-scrollbar js-swiper-scrollbar"></div>
		</div>
	</section>


<section id="accessories">
		<div class="content">
			<div class="accSlider">
				<div class="swiper-wrapper">
					<?php $items_accessories = get_field( 'items_accessories' ); ?>
					<?php if ( $items_accessories ) : ?>
						<?php foreach ( $items_accessories as $post_ids ) : ?>
							<div class="item swiper-slide">
								<div>
									<?php if ( get_field( 'preview_image', $post_ids ) ) : ?>
										<div class="img"><img src="<?php the_field( 'preview_image', $post_ids ); ?>" /></div>
									<?php endif ?>
									<a href="<?php echo get_permalink( $post_ids ); ?>"><h4 class="line"><?php echo get_the_title( $post_ids ); ?></h4></a>
									<p><?php the_field( 'short_description_product', $post_ids ); ?></p>
								</div>
							</div>
						<?php endforeach; ?>
					<?php endif; ?>
				</div>
			</div>
			<div class="text">
				<div>
					<div class="title">
						<h3 class="line"><?php the_field( 'section_title_accessories' ); ?></h3>
						<div class="paginationSlider">
							<div>
								<div class="pagination"></div>
								<div class="button-prev"><img src="<?php echo get_template_directory_uri(); ?>/src/img/arrow_left.svg" alt=""></div>
								<div class="button-next"><img src="<?php echo get_template_directory_uri(); ?>/src/img/arrow_right.svg" alt=""></div>
							</div>
						</div>
					</div>
					<p><?php the_field( 'description_accessories' ); ?></p>
					<?php if ( have_rows( 'button_accessories' ) ) : ?>
						<?php while ( have_rows( 'button_accessories' ) ) : the_row(); ?>
							<button data-name="orderModal" class="btn da-modal"><?php the_sub_field( 'title' ); ?></button>
						<?php endwhile; ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="swiper-scrollbar js-swiper-scrollbar"></div>
		</div>
	</section>


	<section id="other">
		<div class="content">
			<div class="image">
			<?php if ( get_field( 'image_otherproducts' ) ) : ?>
				<img src="<?php the_field( 'image_otherproducts' ); ?>" />
			<?php endif ?>
			</div>
			<div class="text">
				<h3 class="line"><?php the_field( 'section_title_otherproducts' ); ?></h3>
				<p><?php the_field( 'description_otherproducts' ); ?></p>
				<?php if ( have_rows( 'list_otherproducts' ) ) : ?>
				<ul class="square">
					<?php while ( have_rows( 'list_otherproducts' ) ) : the_row(); ?>
						<li><?php the_sub_field( 'item' ); ?></li>
					<?php endwhile; ?>
				</ul>
				<?php else : ?>
					<?php // no rows found ?>
				<?php endif; ?>
			</div>
		</div>
	</section>


	<section id="unsere">
		<div class="container">
			<div class="title">
				<h3><?php the_field( 'section_title_up' ); ?></h3> 
				<p><?php the_field( 'description_up' ); ?></p>
			</div>
			<div class="content unserSlider">
				<div class="swiper-wrapper">
					<?php if ( have_rows( 'items_up' ) ) : ?>
						<?php while ( have_rows( 'items_up' ) ) : the_row(); ?>
							<?php if ( have_rows( 'item' ) ) : ?>
								<?php while ( have_rows( 'item' ) ) : the_row(); ?>
								<div class="item  swiper-slide">

									<?php if ( get_sub_field( 'icon' ) ) : ?>
										<img src="<?php the_sub_field( 'icon' ); ?>" />
									<?php endif ?>
									<h3><?php the_sub_field( 'title' ); ?></h3>
									<p><?php the_sub_field( 'description' ); ?></p>
									<?php if ( have_rows( 'list' ) ) : ?>
									<div>
										<ul class="square">
										<?php while ( have_rows( 'list' ) ) : the_row(); ?>
											<li><?php the_sub_field( 'item' ); ?></li>
										<?php endwhile; ?>
										</ul>
									</div>
									<?php else : ?>
										<?php // no rows found ?>
									<?php endif; ?>
								</div>
								<?php endwhile; ?>
							<?php endif; ?>
						<?php endwhile; ?>
					<?php else : ?>
						<?php // no rows found ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</section>



	<section id="grid">
		<div class="content">
			<?php if ( have_rows( 'munich_textile' ) ) : ?>
				<?php while ( have_rows( 'munich_textile' ) ) : the_row(); ?>
						<div class="image">
							<?php if ( get_sub_field( 'image' ) ) : ?>
								<img src="<?php the_sub_field( 'image' ); ?>" />
							<?php endif ?>
						</div>
						<div class="text">
							<h3 class="line"><?php the_sub_field( 'sectipn_title' ); ?>e</h3>
							<p><?php the_sub_field( 'description' ); ?></p>

							<?php if ( have_rows( 'list' ) ) : ?>
							<ul class="square">
								<?php while ( have_rows( 'list' ) ) : the_row(); ?>
									<li><?php the_sub_field( 'item' ); ?></li>
								<?php endwhile; ?>
							</ul>
							<?php else : ?>
								<?php // no rows found ?>
							<?php endif; ?>
						</div>
				<?php endwhile; ?>
			<?php endif; ?>
		</div>
		<div class="content last">
			<?php if ( have_rows( 'munich_textile_drinks' ) ) : ?>
				<?php while ( have_rows( 'munich_textile_drinks' ) ) : the_row(); ?>
						<div class="text">
							<h3 class="line"><?php the_sub_field( 'sectipn_title' ); ?>e</h3>
							<p><?php the_sub_field( 'description' ); ?></p>

							<?php if ( have_rows( 'list' ) ) : ?>
							<ul class="square">
								<?php while ( have_rows( 'list' ) ) : the_row(); ?>
									<li><?php the_sub_field( 'item' ); ?></li>
								<?php endwhile; ?>
							</ul>
							<?php else : ?>
								<?php // no rows found ?>
							<?php endif; ?>
						</div>
						<div class="image">
							<?php if ( get_sub_field( 'image' ) ) : ?>
								<img src="<?php the_sub_field( 'image' ); ?>" />
							<?php endif ?>
						</div>
				<?php endwhile; ?>
			<?php endif; ?>
		</div>
	</section>


	<section id="formhome">
		<div class="container">
			<div class="content">
				<?php
					$ihr_produkt = get_post_meta($post->ID,'select_contact_form',true);
					echo do_shortcode($ihr_produkt);
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


	<section id="faq">
		<div class="container">
			<h3><?php the_field( 'section_title_faq' ); ?></h3>
			<div class="content">

			<?php if ( have_rows( 'questions_answers' ) ) : ?>
				<?php while ( have_rows( 'questions_answers' ) ) : the_row(); ?>
					<?php if ( have_rows( 'question' ) ) : ?>
						<?php while ( have_rows( 'question' ) ) : the_row(); ?>
						<div class="spoiler">
							<div class="head"><?php the_sub_field( 'question' ); ?></div>
							<div class="cont"><?php the_sub_field( 'answer' ); ?></div>
						</div>
						<?php endwhile; ?>
					<?php endif; ?>
				<?php endwhile; ?>
			<?php else : ?>
				<?php // no rows found ?>
			<?php endif; ?>
			</div>
		</div>
	</section>



	<section id="articles">
		<div class="container">
			<div class="title">
				<h3 class="line"><?php the_field( 'section_title_blog' ); ?></h3>
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

	<section id="offer">
			<div class="content">
				<img src="<?php echo get_template_directory_uri(); ?>/src/img/foot_section_bg.gif" alt="">
				<div class="text">
					<div class="container">
						<h4 class="one"><?php the_field( 'offer_text_1' ); ?></h4>
						<h4 class="two"><?php the_field( 'offer_text_2' ); ?></h4>
						<?php if ( have_rows( 'button' ) ) : ?>
						<div class="button">
							<?php while ( have_rows( 'button' ) ) : the_row(); ?>
								<button data-name="orderModal" class="btn border da-modal"><?php the_sub_field( 'title' ); ?></button>
							<?php endwhile; ?>
						</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
	</section>

<?php
get_footer();
