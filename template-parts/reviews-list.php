					<div class="item swiper-slide">
                        <?php if ( get_field( 'logo' ) ) : ?>
                            <div class="logo"><img src="<?php the_field( 'logo' ); ?>" /></div>
                        <?php endif ?>
						<p class="addReadMore showlesscontent"><?php the_field( 'review_text' ); ?></p>
                        <?php if ( have_rows( 'author' ) ) : ?>
                        <ul class="foot">
                            <?php while ( have_rows( 'author' ) ) : the_row(); ?>
                                <li><a href="<?php the_sub_field( 'url_for_name' ); ?>"><?php the_sub_field( 'name' ); ?></a></li>
                                <li><?php the_sub_field( 'position' ); ?></li>
                            <?php endwhile; ?>
                        </ul>
                        <?php endif; ?>
					</div>