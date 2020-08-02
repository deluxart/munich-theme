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
	<div class="contacts-page">

		<h3><?php the_field( 'page_title' ); ?></h3>
		<div class="top_side">
			<div class="map">
				<?php the_field( 'map_frame' ); ?>
			</div>
			<?php if ( have_rows( 'contacts_block' ) ) : ?>
				<?php while ( have_rows( 'contacts_block' ) ) : the_row(); ?>
						<div class="contacts-block">
							<ul>
								<li><span>adress</span><?php the_sub_field( 'adress' ); ?></li>
								<li><span>phone</span><a href="fax:<?php the_sub_field( 'phone' ); ?>"><?php the_sub_field( 'phone' ); ?></a></li>
								<li><span>phone</span><a href="fax:<?php the_sub_field( 'phone' ); ?>"><?php the_sub_field( 'phone' ); ?></a></li>
								<li><span>fax</span><a href="fax:<?php the_sub_field( 'fax' ); ?>"><?php the_sub_field( 'fax' ); ?></a></li>
							</ul>
						</div>
				<?php endwhile; ?>
			<?php endif; ?>
		</div>

		<div class="contact-form">
			<h3><?php the_field( 'contacts_form_title' ); ?></h3>
			<div class="form-prod">
			<?php
				$contacts_form = get_post_meta($post->ID,'contacts_form_-_shortcode',true);
				echo do_shortcode($contacts_form);
 			?>
			</div>
		</div>
	
	</div>

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
