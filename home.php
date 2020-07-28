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
					<button href="<?php the_sub_field( 'link_for_button' ); ?>" class="btn black border da-modal"><?php the_sub_field( 'button_title' ); ?></button>
				<?php endwhile; ?>
			<?php endif; ?>
		</div>

		<div class="image">
			<?php if ( get_sub_field( 'slide_image' ) ) : ?>
				<img src="<?php the_sub_field( 'slide_image' ); ?>" />
			<?php endif ?>
		</div>

	</div>
	<?php endwhile; ?>
<?php else : ?>
	<?php // no rows found ?>
<?php endif; ?>

<!-- 

			<div class="content swiper-slide" data-name="textile">
				<div class="text">
					<h1>Hotelausstatter</h1>
					<p class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</p>
					<ul class="square">
						<li>Lorem ipsum dolor sit amet, consectetur </li>
						<li>Lorem ipsum dolor sit amet, consectetur </li>
						<li>Lorem ipsum dolor sit amet, consectetur</li>
					</ul>
					<a href="#" class="btn black border">JETZT ANFRAGEN</a>
				</div>
				<div class="image">
					<img src="< ?php echo get_template_directory_uri(); ?>/src/img/head_img.jpg" alt="">
				</div>
			</div>

			<div class="content swiper-slide" data-name="drinks">
				<div class="text">
					<h1>Hotelausstatter</h1>
					<p class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</p>
					<ul class="square">
						<li>Lorem ipsum dolor sit amet, consectetur </li>
						<li>Lorem ipsum dolor sit amet, consectetur </li>
						<li>Lorem ipsum dolor sit amet, consectetur</li>
					</ul>
					<a href="#" class="btn black border">JETZT ANFRAGEN</a>
				</div>
				<div class="image">
					<img src="< ?php echo get_template_directory_uri(); ?>/src/img/head_img.jpg" alt="">
				</div>
			</div>

			<div class="content swiper-slide" data-name="accesories">
				<div class="text">
					<h1>Hotelausstatter</h1>
					<p class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</p>
					<ul class="square">
						<li>Lorem ipsum dolor sit amet, consectetur </li>
						<li>Lorem ipsum dolor sit amet, consectetur </li>
						<li>Lorem ipsum dolor sit amet, consectetur</li>
					</ul>
					<a href="#" class="btn black border">JETZT ANFRAGEN</a>
				</div>
				<div class="image">
					<img src="< ?php echo get_template_directory_uri(); ?>/src/img/head_img.jpg" alt="">
				</div>
			</div> -->


			</div>
			</div>
			  <!-- Add Pagination -->
  <div class="swiper-pagination pag-shoes"></div>
	</section>





	<section id="about">
		<div class="content">
			<h3 class="mobile line"><?php the_field( 'section_title_about' ); ?></h3>
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
						<button href="<?php the_sub_field( 'link' ); ?>" class="btn da-modal"><?php the_sub_field( 'title' ); ?></button>
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
					<div class="item swiper-slide">
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
					<div class="item swiper-slide">
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
					<div class="item swiper-slide">
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
					<div class="item swiper-slide">
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
					<div class="item swiper-slide">
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
					<div class="item swiper-slide">
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
		</div>
	</section>





	<section id="drinks">
		<div class="content">
			<div class="text">
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
							<button href="<?php the_sub_field( 'link' ); ?>" class="btn da-modal"><?php the_sub_field( 'title' ); ?></button>
						<?php endwhile; ?>
					<?php endif; ?>
				</div>
			</div>
			<div class="drinksSlider">
				<div class="swiper-wrapper">
					<?php if ( have_rows( 'items_drinks' ) ) : ?>
						<?php while ( have_rows( 'items_drinks' ) ) : the_row(); ?>
							<?php if ( have_rows( 'item' ) ) : ?>
									<?php while ( have_rows( 'item' ) ) : the_row(); ?>
									<div class="item swiper-slide">
										<div>
										<?php if ( get_sub_field( 'image' ) ) : ?>
											<div class="img"><img src="<?php the_sub_field( 'image' ); ?>" /></div>
										<?php endif ?>
										<a href="<?php the_sub_field( 'link' ); ?>"><h4 class="line"><?php the_sub_field( 'title' ); ?></h4></a>
										<p><?php the_sub_field( 'description' ); ?></p>
										</div>
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


<section id="accessories">
		<div class="content">
			<div class="accSlider">
				<div class="swiper-wrapper">


					<?php if ( have_rows( 'items_accessories' ) ) : ?>
						<?php while ( have_rows( 'items_accessories' ) ) : the_row(); ?>
							<?php if ( have_rows( 'item' ) ) : ?>
									<?php while ( have_rows( 'item' ) ) : the_row(); ?>
									<div class="item swiper-slide">
										<div>
										<?php if ( get_sub_field( 'image' ) ) : ?>
											<div class="img"><img src="<?php the_sub_field( 'image' ); ?>" /></div>
										<?php endif ?>
										<a href="<?php the_sub_field( 'link' ); ?>"><h4 class="line"><?php the_sub_field( 'title' ); ?></h4></a>
										<p><?php the_sub_field( 'description' ); ?></p>
										</div>
									</div>
									<?php endwhile; ?>
							<?php endif; ?>
						<?php endwhile; ?>
					<?php else : ?>
						<?php // no rows found ?>
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
							<button href="<?php the_sub_field( 'link' ); ?>" class="btn da-modal"><?php the_sub_field( 'title' ); ?></button>
						<?php endwhile; ?>
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
		<div class="content last">


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
			<div class="image">
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
			<h3 class="line"><?php the_sub_field( 'section_title_privat' ); ?></h3>
			<div class="content">
				<div class="black">
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
				</div>
				<div class="text">
				<p><?php the_sub_field( 'right_side_text' ); ?></p>
				<?php if ( have_rows( 'right_side_button' ) ) : ?>
					<?php while ( have_rows( 'right_side_button' ) ) : the_row(); ?>
					<div class="desktop"><button href="<?php the_sub_field( 'link' ); ?>" class="btn da-modal"><?php the_sub_field( 'title' ); ?></button></div>
					<?php endwhile; ?>
				<?php endif; ?>
				<div class="mobile"><img src="<?php echo get_template_directory_uri(); ?>/src/img/otp.png" alt=""></div>
				</div>
			</div>
		</div>
	</section>
	<?php endwhile; ?>
<?php endif; ?>



<!-- 

	
	<section id="privat">
		<div class="container">
			<h3 class="line">Privat label</h3>

			<div class="content">
				<div class="black">
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit dolor sit amet, consecteturl orem ipsum dolor sit amet, consectetur adipiscing elit dolor sit amet, consectetur lorem ipsum dolor sit amet, consectetur adipiscing elit dolor sit amet, consecteturl orem ipsum dolor sit amet, consectetur adipiscing  Lorem ipsum dolor sit amet, consect</p>
					<ul>
						<li><a href="#">categorie</a></li>
						<li><a href="#">categorie</a></li>
						<li><a href="#">categorie</a></li>
					</ul>
					<div class="mobile"><a href="#" class="btn border">JETZT ANFRAGEN</a></div>
				</div>
				<div class="text">
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit dolor sit amet, consecteturl orem ipsum dolor sit amet, consectetur adipiscing elit dolor sit amet, consectetur lorem ipsum dolor sit amet, consectetur adipiscing elit dolor sit amet, consecteturl orem ipsum dolor sit amet, consectetur adipiscing  Lorem ipsum dolor sit amet, consect</p>
					<div class="desktop"><a href="#" class="btn">JETZT ANFRAGEN</a></div>
					<div class="mobile"><img src="<?php echo get_template_directory_uri(); ?>/src/img/otp.png" alt=""></div>
				</div>
			</div>


		</div>
	</section> -->




<?php if ( have_rows( 'artmunich_content' ) ) : ?>
	<div id="artmunich">
		<div class="container">
			<div class="content">
				<?php while ( have_rows( 'artmunich_content' ) ) : the_row(); ?>
					<div class="text">
						<h3 class="line"><?php the_sub_field( 'section_title_art' ); ?></h3>
						<p><?php the_sub_field( 'text' ); ?></p>
					</div>	
					<?php if ( get_sub_field( 'image' ) ) : ?>
						<div class="image">
							<img src="<?php the_sub_field( 'image' ); ?>" />
						</div>
					<?php endif ?>
				<?php endwhile; ?>
			</div>
		</div>
	</div>	
<?php endif; ?>


<!-- 	
	<div id="artmunich">
		<div class="container">
			<div class="content">
				<div class="text">
					<h3 class="line">Art munich collection</h3>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
				</div>
				<div class="image">
					<img src="<?php echo get_template_directory_uri(); ?>/src/img/ArtMunich.png" alt="">
				</div>
			</div>
		</div>
	</div>	 -->

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
		<div class="productSlider">
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

<?php if ( have_rows( 'reviews_block' ) ) : ?>
	<?php while ( have_rows( 'reviews_block' ) ) : the_row(); ?>
		<?php if ( have_rows( 'reviews' ) ) : ?>
			<div class="item swiper-slide">
			<?php while ( have_rows( 'reviews' ) ) : the_row(); ?>
				<?php if ( get_sub_field( 'logo' ) ) : ?>
					<div class="logo"><img src="<?php the_sub_field( 'logo' ); ?>" /></div>
				<?php endif ?>
				<p class="addReadMore showlesscontent"><?php the_sub_field( 'content' ); ?></p>
				<?php if ( have_rows( 'author' ) ) : ?>
					<ul class="foot">
					<?php while ( have_rows( 'author' ) ) : the_row(); ?>
						<li><a href="<?php the_sub_field( 'link' ); ?>"><?php the_sub_field( 'name' ); ?></a></li>
						<li><?php the_sub_field( 'position' ); ?></li>
					<?php endwhile; ?>
					</ul>
				<?php endif; ?>
			<?php endwhile; ?>
			</div>
		<?php endif; ?>
	<?php endwhile; ?>
<?php else : ?>
	<?php // no rows found ?>
<?php endif; ?>


<!-- 
					<div class="item swiper-slide">
						<div class="logo"><img src="img/logo_1.png" alt=""></div>
						<p class="addReadMore showlesscontent">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis Ut enim ad minim veniam, quis sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis labore et dolore magna aliqua. Ut enim ad minim veniam, quis Ut enim ad minim veniam, quis sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis </p>
						<ul class="foot">
							<li><a href="#">Alan Jones</a></li>
							<li>CEO&FOUNDER</li>
						</ul>
					</div>
					<div class="item swiper-slide">
						<div class="logo"><img src="img/logo_2.png" alt=""></div>
						<p class="addReadMore showlesscontent">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis Ut enim ad minim veniam, quis sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis labore et dolore magna aliqua. Ut enim ad minim veniam, quis Ut enim ad minim veniam, quis sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis </p>
						<ul class="foot">
							<li><a href="#">Alan Jones</a></li>
							<li>CEO&FOUNDER</li>
						</ul>
					</div>
					<div class="item swiper-slide">
						<div class="logo"><img src="img/logo_4.png" alt=""></div>
						<p class="addReadMore showlesscontent">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis Ut enim ad minim veniam, quis sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis labore et dolore magna aliqua. Ut enim ad minim veniam, quis Ut enim ad minim veniam, quis sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis </p>
						<ul class="foot">
							<li><a href="#">Alan Jones</a></li>
							<li>CEO&FOUNDER</li>
						</ul>
					</div>
					<div class="item swiper-slide">
						<div class="logo"><img src="img/logo_3.png" alt=""></div>
						<p class="addReadMore showlesscontent">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis Ut enim ad minim veniam, quis sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis labore et dolore magna aliqua. Ut enim ad minim veniam, quis Ut enim ad minim veniam, quis sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis </p>
						<ul class="foot">
							<li><a href="#">Alan Jones</a></li>
							<li>CEO&FOUNDER</li>
						</ul>
					</div> -->



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
					<div class="item swiper-slide">
						<div class="image"><img src="<?php echo get_template_directory_uri(); ?>/src/img/blog_1.png" alt=""></div>
						<div class="info">
							<ul>
								<li>sep 02, 2018</li>
								<li>hotels, design</li>
							</ul>
						</div>
						<a href="#" class="title">Amazingly interesting text about beauty of the world</a>
						<div class="text">
							<p>And here is lorem ipsum forever, lorem ipsum forever, lorem ipsum forever, lorem ipsum forever, lorem ipsum forever.</p>
						</div>
						<a href="#">read <img src="<?php echo get_template_directory_uri(); ?>/src/img/article_arrow.svg" alt=""></a>
					</div>
					<div class="item swiper-slide">
						<div class="image"><img src="<?php echo get_template_directory_uri(); ?>/src/img/blog_2.png" alt=""></div>
						<div class="info">
							<ul>
								<li>sep 02, 2018</li>
								<li>hotels, design</li>
							</ul>
						</div>
						<a href="#" class="title">Amazingly interesting text about beauty of the world</a>
						<div class="text">
							<p>And here is lorem ipsum forever, lorem ipsum forever, lorem ipsum forever, lorem ipsum forever, lorem ipsum forever.</p>
						</div>
						<a href="#">read <img src="<?php echo get_template_directory_uri(); ?>/src/img/article_arrow.svg" alt=""></a>
					</div>
					<div class="item swiper-slide">
						<div class="image"><img src="<?php echo get_template_directory_uri(); ?>/src/img/blog_3.png" alt=""></div>
						<div class="info">
							<ul>
								<li>sep 02, 2018</li>
								<li>hotels, design</li>
							</ul>
						</div>
						<a href="#" class="title">Amazingly interesting text about beauty of the world</a>
						<div class="text">
							<p>And here is lorem ipsum forever, lorem ipsum forever, lorem ipsum forever, lorem ipsum forever, lorem ipsum forever.</p>
						</div>
						<a href="#">read <img src="<?php echo get_template_directory_uri(); ?>/src/img/article_arrow.svg" alt=""></a>
					</div>
				</div>
			</div>
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
								<button href="<?php the_sub_field( 'link' ); ?>" class="btn border da-modal"><?php the_sub_field( 'title' ); ?></button>
							<?php endwhile; ?>
						</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
	</section>

<?php
get_footer();
