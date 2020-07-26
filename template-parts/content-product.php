<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package munich
 */

?>









		<div class="breadcrumbs">
			<ul>
				<li><a href="#">Main</a></li>
				<li><a href="#">Catalog</a></li>
				<li><a href="#">Textile</a></li>
				<li>MIAMI</li>
			</ul>
		</div>


	<div class="product" id="product-<?php the_ID(); ?>">


<?php if ( have_rows( 'photos_product' ) ) : ?>
	<div class="productSlider">
		<div class="slider">
			<div class="productPhoto gallery-top">
				<div class="swiper-wrapper">
					<?php while ( have_rows( 'photos_product' ) ) : the_row(); ?>
						<?php $image_product = get_sub_field( 'image_product' ); ?>
						<?php if ( $image_product ) : ?>
							<div class="swiper-slide"><img src="<?php echo esc_url( $image_product['url'] ); ?>" alt="<?php echo esc_attr( $image_product['alt'] ); ?>" /></div>
						<?php endif; ?>
					<?php endwhile; ?>
				</div>
			</div>
			<div class="swiper-button-next swiper-button-black"></div>
			<div class="swiper-button-prev swiper-button-black"></div>
		</div>
		<div class="swiper-container gallery-thumbs">
			<div class="swiper-wrapper">
					<?php while ( have_rows( 'photos_product' ) ) : the_row(); ?>
						<?php $image_product = get_sub_field( 'image_product' ); ?>
						<?php if ( $image_product ) : ?>
							<div class="swiper-slide"><img src="<?php echo esc_url( $image_product['url'] ); ?>" alt="<?php echo esc_attr( $image_product['alt'] ); ?>" /></div>
						<?php endif; ?>
					<?php endwhile; ?>
			</div>
		</div>
	</div>
<?php else : ?>
	<?php the_post_thumbnail('full'); ?>
<?php endif; ?>

		<div class="productCont">
			<div class="pageNav sticky" data-margin-top="79" data-sticky-for="1023" data-sticky-class="moreProducts">
				<ul>
					<li><a href="#information">Information</a></li>
					<li><a href="#fabric">Fabric</a></li>
					<li><a href="#colors">Colors</a></li>
					<li><a href="#care">Care</a></li>
				</ul>
			</div>


<?php if ( have_rows( 'content_tabs_product' ) ) : ?>
	<?php while ( have_rows( 'content_tabs_product' ) ) : the_row(); ?>
		<h4><?php the_sub_field( 'tab_name' ); ?></h4>
		<p><?php the_sub_field( 'tab_content' ); ?></p>
	<?php endwhile; ?>
<?php else : ?>
	<?php // no rows found ?>
<?php endif; ?>







<?php if ( have_rows( 'product_filters' ) ) : ?>
	<?php while ( have_rows( 'product_filters' ) ) : the_row(); ?>
		<?php if ( have_rows( 'colour' ) ) : ?>
			<?php while ( have_rows( 'colour' ) ) : the_row(); ?>
				<h4 id="colors" class="title"><?php the_sub_field( 'filter_name' ); ?></h4>
				<?php if ( have_rows( 'color_set' ) ) : ?>
				<div class="colors-block">
					<ul class="colors-prod">
					<?php while ( have_rows( 'color_set' ) ) : the_row(); ?>
						<li><span title="<?php the_sub_field( 'color_name' ); ?>" style="background: <?php the_sub_field( 'solor' ); ?>;"></span><p><?php the_sub_field( 'color_name' ); ?></p></li>
					<?php endwhile; ?>
					</ul>
				</div>
				<?php else : ?>
					<?php // no rows found ?>
				<?php endif; ?>
			<?php endwhile; ?>
		<?php endif; ?>
	<?php endwhile; ?>
<?php endif; ?>


				<div class="moreProducts">
					<div class="title">
						<h3>you may also like</h3>
						<div class="paginationSlider">
							<div>
								<div class="pagination"></div>
								<div class="button-prev"><img src="img/arrow_left.svg" alt=""></div>
								<div class="button-next"><img src="img/arrow_right.svg" alt=""></div>
							</div>
						</div>
					</div>
					<div class="prodAfterSlider">
						<div class="swiper-wrapper">
							<div class="item swiper-slide">
								<div>
									<div class="img"><img src="img/acc_1.png" alt=""></div>
									<a href="#"><h4 class="line">Cosmetics</h4></a>
									<p>Kurzmantel mit Kapuze und Waffelpikee Kontrast, Walkfrottier, 100% Cotton, 380 g/m</p>
									<ul class="sizes-item">
										<li>S</li>
										<li>M</li>
										<li>L</li>
										<li>XL</li>
										<li>XXL</li>
									</ul>
								</div>
							</div>
							<div class="item swiper-slide">
								<div>
									<div class="img"><img src="img/acc_2.png" alt=""></div>
									<a href="#"><h4 class="line">Cover</h4></a>
									<p>Kurzmantel mit Kapuze und Waffelpikee Kontrast, Walkfrottier, 100% Cotton, 380 g/m</p>
									<ul class="sizes-item">
										<li>S</li>
										<li>M</li>
										<li>L</li>
										<li>XL</li>
										<li>XXL</li>
									</ul>
								</div>
							</div>
							<div class="item swiper-slide">
								<div>
									<div class="img"><img src="img/acc_3.png" alt=""></div>
									<a href="#"><h4 class="line">Feel good</h4></a>
									<p>Kurzmantel mit Kapuze und Waffelpikee Kontrast, Walkfrottier, 100% Cotton, 380 g/m</p>
									<ul class="sizes-item">
										<li>S</li>
										<li>M</li>
										<li>L</li>
										<li>XL</li>
										<li>XXL</li>
									</ul>
								</div>
							</div>
							<div class="item swiper-slide">
								<div>
									<div class="img"><img src="img/acc_4.png" alt=""></div>
									<a href="#"><h4 class="line">Nail</h4></a>
									<p>Kurzmantel mit Kapuze und Waffelpikee Kontrast, Walkfrottier, 100% Cotton, 380 g/m</p>
									<ul class="sizes-item">
										<li>S</li>
										<li>M</li>
										<li>L</li>
										<li>XL</li>
										<li>XXL</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>



</div>


<div class="productName mobile">
			<h3><?php the_title(); ?></h3>
			<p><?php the_field( 'short_description_product' ); ?></p>
</div>


<div class="productSidebar">

			<div class="productName desktop">
						<h3><?php the_title(); ?></h3>
						<p><?php the_field( 'short_description_product' ); ?></p>
			</div>




<?php if ( have_rows( 'product_filters' ) ) : ?>
	<?php while ( have_rows( 'product_filters' ) ) : the_row(); ?>
		<?php if ( get_sub_field( 'size' ) == 1 ) : ?>
			<?php // echo 'true'; ?>
		<?php else : ?>
			<?php // echo 'false'; ?>
		<?php endif; ?>
		<?php if ( have_rows( 'set_of_sizes' ) ) : ?>
			<h4>Size</h4>
			<ul class="sizes-prod">
			<?php while ( have_rows( 'set_of_sizes' ) ) : the_row(); ?>
				<?php $select_sizes_checked_values = get_sub_field( 'select_sizes' ); ?>
				<?php if ( $select_sizes_checked_values ) : ?>
					<?php foreach ( $select_sizes_checked_values as $select_sizes_value ): ?>
						<li><?php echo esc_html( $select_sizes_value ); ?></li>
					<?php endforeach; ?>
				<?php endif; ?>
			<?php endwhile; ?>
			</ul>
		<?php endif; ?>

		<?php if ( get_sub_field( 'colour_filter' ) == 1 ) : ?>
			<?php // echo 'true'; ?>
		<?php else : ?>
			<?php // echo 'false'; ?>
		<?php endif; ?>
		<?php if ( have_rows( 'colour' ) ) : ?>
			<?php while ( have_rows( 'colour' ) ) : the_row(); ?>
				<h4><?php the_sub_field( 'filter_name' ); ?></h4>
				<div class="colors-block">
				<ul class="colors-prod">
				<?php if ( have_rows( 'color_set' ) ) : ?>
					<?php while ( have_rows( 'color_set' ) ) : the_row(); ?>
						<li><span title="<?php the_sub_field( 'color_name' ); ?>" style="background: <?php the_sub_field( 'solor' ); ?>;"></span></li>
					<?php endwhile; ?>
				<?php else : ?>
					<?php // no rows found ?>
				<?php endif; ?>
				</ul>
				</div>
			<?php endwhile; ?>
		<?php endif; ?>

	<?php endwhile; ?>
<?php endif; ?>

			<h3><?php the_field( 'form_title' ); ?></h3>
			<div class="form-prod">
				<?php $contactform = get_field('form_short-code_cf7'); ?>
				<?php echo do_shortcode($contactform) ?>
				<!-- < ?php the_field( 'form_short-code_cf7' ); ?> -->
				<!-- <form>
						<input type="text" placeholder="Name" />
						<input type="text" placeholder="Phone number" />
						<input type="email" placeholder="Email" />
						<input type="text" placeholder="Your comment" />
						
						<span class="wpcf7-checkbox">
							<label class="control control--checkbox">
							<span class="wpcf7-list-item first last">
								<input type="checkbox" name="your-policy[]" value="" checked="checked" />
								<span class="wpcf7-list-item-label"></span>
							</span>
							 <span class="checkbox-text"> Lorem ipsum dolor sit amet, consectetur adipiscing </span>
							</label>
						</span>
						<div><button class="btn">Beratung anfordern</button></div>
				</form> -->
				<?php if ( have_rows( 'check_list' ) ) : ?>
					<ul class="check">
					<?php while ( have_rows( 'check_list' ) ) : the_row(); ?>
						<li><?php the_sub_field( 'item' ); ?></li>
					<?php endwhile; ?>
					</ul>
				<?php else : ?>
					<?php // no rows found ?>
				<?php endif; ?>
			</div>
		</div>



		</div>
	</div>




























<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) :
			?>
			<div class="entry-meta">
				<?php
				munich_posted_on();
				munich_posted_by();
				?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php munich_post_thumbnail(); ?>

	<div class="entry-content">
		<?php
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'my-site' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			)
		);

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'my-site' ),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php munich_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->