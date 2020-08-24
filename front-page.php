<?php
/*
Template Name: Home
*/

get_header();
?>
	<section id="home_slider" class="slider">
		<div class="home_slider">
		<div class="swiper-wrapper">
			<?php if ( have_rows( 'slide' ) ) : $count = 0; ?>
				<?php while ( have_rows( 'slide' ) ) : the_row(); ?>
				<div class="content swiper-slide" data-name="<?php the_sub_field( 'slide_list' ); ?>">
					<div class="text">
						<?php if (!$count) { ?>
							<h1><?php the_sub_field( 'slide_title' ); ?></h1>
						<?php } else { ?>
							<h1><?php the_sub_field( 'slide_title' ); ?></h1>
						<?php } ?>
							<p class="description main"><?php the_sub_field( 'slide_descriptio' ); ?></p>
						<?php if ( have_rows( 'slide_button' ) ) : ?>
							<?php while ( have_rows( 'slide_button' ) ) : the_row(); ?>
								<button data-name="orderModal" class="btn black border da-modal"><?php the_sub_field( 'button_title' ); ?></button>
							<?php endwhile; ?>
						<?php endif; ?>
					</div>

					<div class="image">
						<?php if ( get_sub_field( 'slide_image' ) ) : ?>
							<img src="<?php the_sub_field( 'slide_image' ); ?>" class="home" />
						<?php endif ?>
					</div>

				</div>
				<?php endwhile; ?>
			<?php else : ?>
				<?php // no rows found ?>
			<?php endif; ?>
			</div>
			</div>
			  <!-- Add Pagination -->
		<div class="swiper-pagination pag-shoes"></div>
	</section>

	<section id="about">
		<div class="content">
			<h3 class="mobile line"><?php the_field( 'section_title_about' ); ?></h3>
			<div class="images" data-ix="fade-from-left">
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
			<div class="text" data-ix="fade-from-right">
				<h3 class="desktop line"><?php the_field( 'section_title_about' ); ?></h3>
				<p><?php the_field( 'content_about' ); ?></p>
				
				<?php if ( have_rows( 'button_about' ) ) : ?>
					<?php while ( have_rows( 'button_about' ) ) : the_row(); ?>
						<button data-name="orderModal" class="btn da-modal"><?php the_sub_field( 'title' ); ?></button>
					<?php endwhile; ?>
				<?php endif; ?>
			</div>
		</div>
	</section>

	<section id="services">
		<div class="container">
			<div class="content">
				<?php if ( have_rows( 'items_services' ) ) : ?>
					<?php while ( have_rows( 'items_services' ) ) : the_row(); ?>
								<a href="<?php the_sub_field( 'link' ); ?>" data-ix="fade-from-top">
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

	<section id="posts">
		<div class="container">
			<div class="title">
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
			<div class="postsSlider">
				<div class="swiper-wrapper">
					<div class="item swiper-slide" data-ix="fade-from-top">
						<div class="image"><img src="<?php echo get_template_directory_uri(); ?>/src/img/post_1.png" alt=""></div>
						<a href="#"><h3 class="line">Hotels</h3></a>
						<div class="text">
							<p>And here is lorem ipsum forever, lorem ipsum forever, lorem ipsum forever, lorem ipsum forever, lorem ipsum forever.</p>
						</div>
						<div class="cats">
							<ul>
								<li><a href="#">PIKEE</a></li>
								<li><a href="#">BADEVORLEGER</a></li>
							</ul>
						</div>
					</div>
					<div class="item swiper-slide" data-ix="fade-from-top">
						<div class="image"><img src="<?php echo get_template_directory_uri(); ?>/src/img/post_2.png" alt=""></div>
						<a href="#"><h3 class="line">Hotels</h3></a>
						<div class="text">
							<p>And here is lorem ipsum forever, lorem ipsum forever, lorem ipsum forever, lorem ipsum forever, lorem ipsum forever.</p>
						</div>
						<div class="cats">
							<ul>
								<li><a href="#">PIKEE</a></li>
								<li><a href="#">BADEVORLEGER</a></li>
							</ul>
						</div>
					</div>
					<div class="item swiper-slide" data-ix="fade-from-top">
						<div class="image"><img src="<?php echo get_template_directory_uri(); ?>/src/img/post_3.png" alt=""></div>
						<a href="#"><h3 class="line">Hotels</h3></a>
						<div class="text">
							<p>And here is lorem ipsum forever, lorem ipsum forever, lorem ipsum forever, lorem ipsum forever, lorem ipsum forever.</p>
						</div>
						<div class="cats">
							<ul>
								<li><a href="#">PIKEE</a></li>
								<li><a href="#">BADEVORLEGER</a></li>
							</ul>
						</div>
					</div>
					<div class="item swiper-slide" data-ix="fade-from-top">
						<div class="image"><img src="<?php echo get_template_directory_uri(); ?>/src/img/post_1.png" alt=""></div>
						<h3 class="line">Thermen </h3>
						<div class="text">
							<p>And here is lorem ipsum forever, lorem ipsum forever, lorem ipsum forever, lorem ipsum forever, lorem ipsum forever.</p>
						</div>
						<div class="cats">
							<ul>
								<li><a href="#">PIKEE</a></li>
								<li><a href="#">BADEVORLEGER</a></li>
							</ul>
						</div>
					</div>
					<div class="item swiper-slide" data-ix="fade-from-top">
						<div class="image"><img src="<?php echo get_template_directory_uri(); ?>/src/img/post_2.png" alt=""></div>
						<h3 class="line">Hotels</h3>
						<div class="text">
							<p>And here is lorem ipsum forever, lorem ipsum forever, lorem ipsum forever, lorem ipsum forever, lorem ipsum forever.</p>
						</div>
						<div class="cats">
							<ul>
								<li><a href="#">PIKEE</a></li>
								<li><a href="#">BADEVORLEGER</a></li>
							</ul>
						</div>
					</div>
					<div class="item swiper-slide" data-ix="fade-from-top">
						<div class="image"><img src="<?php echo get_template_directory_uri(); ?>/src/img/post_3.png" alt=""></div>
						<h3 class="line">Friseursalone</h3>
						<div class="text">
							<p>And here is lorem ipsum forever, lorem ipsum forever, lorem ipsum forever, lorem ipsum forever, lorem ipsum forever.</p>
						</div>
						<div class="cats">
							<ul>
								<li><a href="#">PIKEE</a></li>
								<li><a href="#">BADEVORLEGER</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="container scroll-bar">
				<div class="swiper-scrollbar js-swiper-scrollbar"></div>
			</div>
		</div>
	</section>

	<section id="drinks">
		<div class="content">
			<div class="text" data-ix="fade-from-left">
				<div>
					<div class="title main">
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
			<div class="drinksSlider" data-ix="fade-from-right">
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
			<div class="accSlider" data-ix="fade-from-left">
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
			<div class="text" data-ix="fade-from-right">
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

	<section id="grid">
		<div class="content">
			<?php if ( have_rows( 'munich_textile' ) ) : ?>
				<?php while ( have_rows( 'munich_textile' ) ) : the_row(); ?>
						<div class="image" data-ix="fade-from-top">
							<?php if ( get_sub_field( 'image' ) ) : ?>
								<img src="<?php the_sub_field( 'image' ); ?>" />
							<?php endif ?>
						</div>
						<div class="text" data-ix="fade-from-top">
							<h3 class="line"><?php the_sub_field( 'sectipn_title' ); ?>e</h3>
							<p><?php the_sub_field( 'description' ); ?></p>

							<?php if ( have_rows( 'list' ) ) : ?>
							<ul class="grid-links">
								<?php while ( have_rows( 'list' ) ) : the_row(); ?>
									<li><a href="<?php the_sub_field( 'link' ); ?>"><?php the_sub_field( 'item' ); ?></li></a>
								<?php endwhile; ?>
							</ul>
							<?php else : ?>
								<?php // no rows found ?>
							<?php endif; ?>
						</div>
				<?php endwhile; ?>
			<?php endif; ?>
		</div>
		<div class="content last" data-ix="fade-from-top">
			<?php if ( have_rows( 'munich_textile_drinks' ) ) : ?>
				<?php while ( have_rows( 'munich_textile_drinks' ) ) : the_row(); ?>
						<div class="text">
							<h3 class="line"><?php the_sub_field( 'sectipn_title' ); ?>e</h3>
							<p><?php the_sub_field( 'description' ); ?></p>

							<?php if ( have_rows( 'list' ) ) : ?>
							<ul class="grid-links">
								<?php while ( have_rows( 'list' ) ) : the_row(); ?>
									<li><a href="<?php the_sub_field( 'link' ); ?>"><?php the_sub_field( 'item' ); ?></li></a>
								<?php endwhile; ?>
							</ul>
							<?php else : ?>
								<?php // no rows found ?>
							<?php endif; ?>
						</div>
						<div class="image" data-ix="fade-from-top">
							<?php if ( get_sub_field( 'image' ) ) : ?>
								<img src="<?php the_sub_field( 'image' ); ?>" />
							<?php endif ?>
						</div>
				<?php endwhile; ?>
			<?php endif; ?>
		</div>
	</section>



<?php if ( have_rows( 'privat_content' ) ) : ?>
	<?php while ( have_rows( 'privat_content' ) ) : the_row(); ?>
	<section id="privat">
		<div class="container">
			<h3 class="line" data-ix="fade-in-heading"><?php the_sub_field( 'section_title_privat' ); ?></h3>
			<div class="content">
				<div class="black" data-ix="fade-from-left">
				<p><?php the_sub_field( 'left_side_text' ); ?></p>
				<?php if ( have_rows( 'left_side_categories' ) ) : ?>
					<ul>
					<?php while ( have_rows( 'left_side_categories' ) ) : the_row(); ?>
						<?php if ( have_rows( 'item' ) ) : ?>
							<?php while ( have_rows( 'item' ) ) : the_row(); ?>
								<li><a href="<?php the_sub_field( 'link' ); ?>"><?php the_sub_field( 'title' ); ?></a></li>
							<?php endwhile; ?>
						<?php endif; ?>
					<?php endwhile; ?>
					</ul>
				<?php endif; ?>
				<?php if ( have_rows( 'right_side_button' ) ) : ?>
					<?php while ( have_rows( 'right_side_button' ) ) : the_row(); ?>
						<div class="mobile"><button data-name="orderModal" class="btn border da-modal"><?php the_sub_field( 'title' ); ?></button></div>
					<?php endwhile; ?>
				<?php endif; ?>
				</div>
				<div class="text" data-ix="fade-from-right">
				<p><?php the_sub_field( 'right_side_text' ); ?></p>
				<?php if ( have_rows( 'right_side_button' ) ) : ?>
					<?php while ( have_rows( 'right_side_button' ) ) : the_row(); ?>
					<div class="desktop"><button data-name="orderModal" class="btn da-modal"><?php the_sub_field( 'title' ); ?></button></div>
					<?php endwhile; ?>
				<?php endif; ?>
				<div class="mobile"><img src="<?php echo get_template_directory_uri(); ?>/src/img/otp.png" alt=""></div>
				</div>
			</div>
		</div>
	</section>
	<?php endwhile; ?>
<?php endif; ?>

<?php if ( have_rows( 'artmunich_content' ) ) : ?>
	<div id="artmunich">
		<div class="container">
			<div class="content">
				<?php while ( have_rows( 'artmunich_content' ) ) : the_row(); ?>
					<div class="text" data-ix="fade-from-left">
						<h3 class="line" data-ix="fade-in-heading"><?php the_sub_field( 'section_title_art' ); ?></h3>
						<p><?php the_sub_field( 'text' ); ?></p>
					</div>	
					<?php if ( get_sub_field( 'image' ) ) : ?>
						<div class="image" data-ix="fade-from-right">
							<img src="<?php the_sub_field( 'image' ); ?>" />
						</div>
					<?php endif ?>
				<?php endwhile; ?>
			</div>
		</div>
	</div>	
<?php endif; ?>

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
		<div class="productSliderCat" data-ix="fade-from-top">
			<div class="swiper-wrapper">

				<?php if ( have_rows( 'items_products' ) ) : ?>
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
				<?php else : ?>
					<?php // no rows found ?>
				<?php endif; ?>

			</div>
		</div>
		<div class="container scrollbar">
			<div class="swiper-scrollbar js-swiper-scrollbar"></div>
		</div>
	</section>


	<section id="reviews">
			<div class="title">
				<h3 class="line" data-ix="fade-in-heading"><?php the_field( 'section_title_reviews' ); ?></h3>
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
			<div class="reviewsSlider" data-ix="fade-from-top">
				<div class="swiper-wrapper">
					<?php echo do_shortcode('[reviews-list]'); ?>
				</div>
			</div>
			<div class="swiper-scrollbar js-swiper-scrollbar"></div>
	</section>


	<section id="articles">
		<div class="container">
			<div class="title">
				<h3 class="line" data-ix="fade-in-heading"><?php the_field( 'section_title_blog' ); ?></h3>
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
			<div class="blogSlider" data-ix="fade-from-top">
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
						<h4 class="one" data-ix="fade-in-heading"><?php the_field( 'offer_text_1' ); ?></h4>
						<h4 class="two" data-ix="fade-in-heading-2"><?php the_field( 'offer_text_2' ); ?></h4>
						<?php if ( have_rows( 'button' ) ) : ?>
						<div class="button">
							<?php while ( have_rows( 'button' ) ) : the_row(); ?>
								<button data-name="orderModal" data-ix="fade-in-heading-3" class="btn border da-modal"><?php the_sub_field( 'title' ); ?></button>
							<?php endwhile; ?>
						</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
	</section>

<?php
get_footer();
