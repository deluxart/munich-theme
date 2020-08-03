<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package munich
 */

?>









		<!-- <div class="breadcrumbs">
			<ul>
				<li><a href="#">Main</a></li>
				<li><a href="#">Catalog</a></li>
				<li><a href="#">Textile</a></li>
				<li>MIAMI</li>
			</ul>
		</div> -->
		<!-- < ?php if ( function_exists( 'dimox_breadcrumbs' ) ) dimox_breadcrumbs(); ?> -->


<?php if(function_exists('bcn_display')) { 
	echo '<div class="breadcrumbs"><ul>';
		bcn_display(); 
	echo '</ul></div>';
	}
?>

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
			<!-- <div class="pageNav">
				<ul>
					<li><a href="#information">Information</a></li>
					<li><a href="#fabric">Fabric</a></li>
					<li><a href="#colors">Colors</a></li>
					<li><a href="#care">Care</a></li>
				</ul>
			</div> -->


	<div class="pageNav">
		<ul>
		<?php if ( have_rows( 'content_tabs_product' ) ) : ?>
			<?php while ( have_rows( 'content_tabs_product' ) ) : the_row(); ?>
			<?php if ( get_sub_field( 'display_tab_in_navigation' ) == 1 ) : ?>
				<li><a href="#<?php the_sub_field( 'tab_name' ); ?>"><?php the_sub_field( 'tab_name' ); ?></a></li>
				<?php endif; ?>
			<?php endwhile; ?>
		<?php endif; ?>
		<li><a href="#colors">COLOUR</a></li>
<?php if ( have_rows( 'privat_label_product' ) ) : ?>
	<?php while ( have_rows( 'privat_label_product' ) ) : the_row(); ?>
		<li><a href="#privat_label"><?php the_sub_field( 'tab_title' ); ?></a></li>
		<?php endwhile; ?>
<?php endif; ?>	

		</ul>
	</div>




<?php if ( have_rows( 'content_tabs_product' ) ) : ?>
	<?php while ( have_rows( 'content_tabs_product' ) ) : the_row(); ?>
		<h4 id="<?php the_sub_field( 'tab_name' ); ?>" class="title"><?php the_sub_field( 'tab_name' ); ?></h4>
		<p><?php the_sub_field( 'tab_content' ); ?></p>
	<?php endwhile; ?>
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


<?php if ( have_rows( 'privat_label_product' ) ) : ?>
	<?php while ( have_rows( 'privat_label_product' ) ) : the_row(); ?>
		<h4 id="privat_label" class="title"><?php the_sub_field( 'tab_title' ); ?></h4>
		<p><?php the_sub_field( 'content' ); ?></p>
	<?php endwhile; ?>
<?php endif; ?>


				<div class="moreProducts">
					<div class="title">
						<h3><?php the_field( 'section_title_also_like' ); ?></h3>
						<div class="paginationSlider">
							<div>
								<div class="pagination"></div>
								<div class="button-prev"><img src="<?php echo get_template_directory_uri(); ?>/src/img/arrow_left.svg" alt=""></div>
								<div class="button-next"><img src="<?php echo get_template_directory_uri(); ?>/src/img/arrow_right.svg" alt=""></div>
							</div>
						</div>
					</div>
					




					<div class="prodAfterSlider">
						<div class="swiper-wrapper">





<?php $products = get_field( 'products' ); ?>
<?php if ( $products ) : ?>
	<?php foreach ( $products as $post_ids ) : ?>
		<div class="item swiper-slide">
			<div>
				<div class="img"><?php the_post_thumbnail( 'square-large', $post_ids ); ?></div>
				<a href="<?php echo get_permalink( $post_ids ); ?>"><h4 class="line"><?php echo get_the_title( $post_ids ); ?></h4></a>
				<p><?php the_field( 'short_description_product', $post_ids ); ?></p>
				<?php if ( have_rows( 'product_filters', $post_ids ) ) : ?>
					<?php while ( have_rows( 'product_filters', $post_ids ) ) : the_row(); ?>
						<?php if ( have_rows( 'set_of_sizes', $post_ids ) ) : ?>
						<ul class="sizes-item">
							<?php while ( have_rows( 'set_of_sizes', $post_ids ) ) : the_row(); ?>
								<?php $select_sizes_checked_values = get_sub_field( 'select_sizes', $post_ids ); ?>
								<?php if ( $select_sizes_checked_values ) : ?>
									<?php foreach ( $select_sizes_checked_values as $select_sizes_value ): ?>
										<li><?php echo esc_html( $select_sizes_value ); ?></li>
									<?php endforeach; ?>
								<?php endif; ?>
							<?php endwhile; ?>
						</ul>
						<?php endif; ?>
					<?php endwhile; ?>
				<?php endif; ?>
			</div>
		</div>
	<?php endforeach; ?>
<?php endif; ?>







							<!-- < ?php if ( have_rows( 'select_products' ) ) : ?>
								< ?php while ( have_rows( 'select_products' ) ) : the_row(); ?>
									< ?php $product = get_sub_field( 'product' ); ?>
									< ?php if ( $product ) : ?>
										< ?php foreach ( $product as $post_ids ) : ?>
											< ?php echo do_shortcode('[products-slider]'); ?>
										< ?php endforeach; ?>
									< ?php endif; ?>
								< ?php endwhile; ?>
							< ?php else : ?>
								< ?php // no rows found ?>
							< ?php endif; ?> -->
						</div>
					</div>
				</div>



</div>


<div class="productName mobile">
			<h3><?php the_title(); ?></h3>
			<p><?php the_field( 'short_description_product' ); ?></p>
</div>


<div class="productSidebar">
	<div>
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
	</div>