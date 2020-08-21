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
			<div class="mobile copyright">
				<div class="container">© MUNICH ACCESSORIES</div>
			</div>
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
<div id="orderModal" class="daModal da-modal-popup">
    <div class="content-modal universal">
		<div class="form">
			<?php echo do_shortcode('[contact-form-7 id="541" title="For popup"]'); ?>
		</div>
		<div class="image">
			<img src="<?php echo get_template_directory_uri(); ?>/src/img/modal_image.jpg" alt="">
		</div>
        <button class="closeModal">
			<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path d="M13.3259 12L23.7254 1.60046C24.0916 1.23432 24.0916 0.640698 23.7254 0.274605C23.3593 -0.0914881 22.7657 -0.091535 22.3996 0.274605L12 10.6742L1.60046 0.274605C1.23432 -0.091535 0.640698 -0.091535 0.274605 0.274605C-0.0914881 0.640745 -0.091535 1.23437 0.274605 1.60046L10.6741 12L0.274605 22.3996C-0.091535 22.7657 -0.091535 23.3593 0.274605 23.7254C0.457651 23.9085 0.697604 24 0.937557 24C1.17751 24 1.41742 23.9085 1.60051 23.7254L12 13.3259L22.3995 23.7254C22.5826 23.9085 22.8225 24 23.0625 24C23.3024 24 23.5423 23.9085 23.7254 23.7254C24.0916 23.3593 24.0916 22.7657 23.7254 22.3996L13.3259 12Z" fill="black"/>
			</svg>
		</button>
    </div>
</div>
<div class="da-modal-open-bg"></div>
<?php wp_footer(); ?>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>


</body>
</html>
