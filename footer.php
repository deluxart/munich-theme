<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package munich
 */

?>

	</div><!-- #content -->


	<footer id="footer">
		<div class="container">
			<div class="content">
				<a href="#"><img src="<?php echo get_template_directory_uri(); ?>/src/img/logo_footer.png" alt=""></a>
				<div class="widgets">


				<?php if ( function_exists('dynamic_sidebar') ) dynamic_sidebar('footer-1'); ?>
				<?php if ( function_exists('dynamic_sidebar') ) dynamic_sidebar('footer-2'); ?>
				<?php if ( function_exists('dynamic_sidebar') ) dynamic_sidebar('footer-3'); ?>
				<?php if ( function_exists('dynamic_sidebar') ) dynamic_sidebar('footer-4'); ?>

					<!-- <div class="widget">
						<h4>our contacts</h4>
						<ul>
							<li>Südliche Münchner Str. 60 · 82031 <span>Grünwald · </span></li>
							<li>
								<span>+49 (0) 89/2324189-50</span>
								<span>Fax: +49 (0) 89/2324189-56</span>
							</li>
							<li>
								<span>sales@munich-accessories.de</span>
								<span>munich-accessories.de</span>
							</li>
						</ul>
					</div> -->

					<!-- <div class="widget">
						<h4>Links</h4>
						<ul class="nav">
							<li><a href="#">Hotels</a></li>
							<li><a href="#">Friseursalone</a></li>
							<li><a href="#">Thermen</a></li>
						</ul>
					</div> -->

					<!-- <div class="widget">
						<h4>certificates</h4>
						<div>
							<div class="certificats">
								<img src="<?php echo get_template_directory_uri(); ?>/src/img/c1.png" alt="">
								<img src="<?php echo get_template_directory_uri(); ?>/src/img/c2.png" alt="">
								<img src="<?php echo get_template_directory_uri(); ?>/src/img/c3.png" alt="">
								<img src="<?php echo get_template_directory_uri(); ?>/src/img/c4.png" alt="">
							</div>
						</div>
					</div> -->

				</div>
			</div>
		</div>
		<div class="foot">
			<div class="container">
 				<?php
                    $menuParameters = array(
                        'menu'            => 'Footer menu (bottom)',
                        'container'       => false,
                        'items_wrap'      => '<ul>%3$s</ul>',
                        'depth'           => 0,
                        'echo'            => true,
                        'before'          => '',
                        'after'           => '',
                        'link_before'     => '',
                        'link_after'      => '',
						'walker'          => '',
                        'walker_nav_menu_start_el'          => '',
                    );
                    echo strip_tags(wp_nav_menu( $menuParameters ), '<a>' );
                ?>
			</div>
		</div>
	</footer>
</div><!-- #page -->

<?php wp_footer(); ?>

<div id="orderModal" class="daModal da-modal-popup">
    <div class="content-modal universal">
		<div class="form">
			<?php echo do_shortcode('[contact-form-7 id="541" title="For popup"]'); ?>
		</div>
		<div class="image">
			<img src="<?php echo get_template_directory_uri(); ?>/src/img/foot_section_bg.png" alt="">
		</div>
        <button class="closeModal">
			<svg enable-background="new 0 0 386.667 386.667" height="512" viewBox="0 0 386.667 386.667" width="512" xmlns="http://www.w3.org/2000/svg"><path d="m386.667 45.564-45.564-45.564-147.77 147.769-147.769-147.769-45.564 45.564 147.769 147.769-147.769 147.77 45.564 45.564 147.769-147.769 147.769 147.769 45.564-45.564-147.768-147.77z"></path></svg>
		</button>
    </div>
</div>
<div class="da-modal-open-bg"></div>



<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>


</body>
</html>
