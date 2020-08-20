<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package munich
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="head_single">
			<h2 class="mobile"><?php the_title(); ?></h2>
			<div class="image"><?php the_post_thumbnail( 'spec_thumb' ); ?></div>
			<div class="excerpt">
				<ul class="post_info">
					<li><?php echo get_the_date(); ?></li>
					<?php $posttags = get_the_tags(); ?>
					<?php if( $posttags ){ ?>
					<li><span><?php the_tags('', ', ', '<br />'); ?></li>
					<?php } ?>
				</ul>
				<h2 class="desktop"><?php the_title(); ?></h2>
				<p class="text">
					<?php echo get_the_excerpt() ?>
				</p>
				<div class="author">
					<span><?php echo get_the_author(); ?></span>
				</div>

			</div>
	</div>

			

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
		<div class="foot_single">
			<div class="author"><?php echo get_the_author(); ?></div>
			<ul class="share">
				<li><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/src/img/instagram.svg" alt=""></a></li>
				<li><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/src/img/facebook.svg" alt=""></a></li>
			</ul>
		</div>
	</div><!-- .entry-content -->

	<!-- <footer class="entry-footer">
		< ?php munich_entry_footer(); ?>
	</footer> -->
</article><!-- #post-<?php the_ID(); ?> -->
