<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package event-management
 */

?>

	<footer id="colophon" class="site-footer">
		
		<div class="container mx-auto bg-[#263877]">
			<div class="footer_banner">
				<img src="<?php echo get_template_directory_uri(); ?>/inc/images/banner.jpg" alt="">
			</div>
			<div class="footer_bottom px-12 h-[420px] flex items-center justify-between">
				<div class="footer_logo w-1/2">
					<img src="<?php echo get_template_directory_uri(); ?>/inc/images/footer_logo.jpg" alt="">
				</div>
				<div class="login_settings">
					<h3 class="bg-[#E92F31] px-7 py-2 text-white uppercase cursor-pointer rounded-sm">Login</h3>
				</div>
				<div class="footer_menu">
					<nav id="footer-navigation" class="footer-navigation">
						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'footer_menu',
								'menu_id'        => 'footer-menu',
							)
						);
						?>
					</nav><!-- #footer-navigation -->
				</div>
			</div>
			<div class="site-info text-center pb-4 uppercase text-white">
				<?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'COPYright 2023 © All Rights Reserved.', 'event-management' ));
				?>
			</div><!-- .site-info -->
		</div><!--end container-->
		
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
