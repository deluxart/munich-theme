<div class="item swiper-slide">
	<div>
		<div class="img"><?php the_post_thumbnail( 'square-large' ); ?></div>
		<a href="<?php the_permalink() ?>"><h4 class="line"><?php the_title(); ?></h4></a>
		<p><?php the_field( 'short_description_product' ); ?></p>
        <?php if ( have_rows( 'product_filters' ) ) : ?>
            <?php while ( have_rows( 'product_filters' ) ) : the_row(); ?>
                <?php if ( have_rows( 'set_of_sizes' ) ) : ?>
                <ul class="sizes-item">
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
            <?php endwhile; ?>
        <?php endif; ?>
	</div>
</div>