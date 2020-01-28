<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Ourakea
 */

?>

</div><!-- #content -->


<footer id="footer">

	<div class="container">
		<?php
		$active = array();
		for ( $i = 1; $i <= 4; $i++ ) {
			if ( is_active_sidebar( 'footer-' . $i ) ) {
				$active[] = $i;
			}
		}
		?>
		<?php if ( 0 !== count( $active ) ) { ?>
		<div id="footer-widgets" class="row content">
			<?php foreach ( $active as $footer_widget_id ) : ?>
			<div class="col-lg-4 column">
				<?php dynamic_sidebar( 'footer-' . $footer_widget_id ); ?>
			</div>
			<?php endforeach; ?>
		</div><!-- #footer-widgets -->
		<?php } ?>

		<div class="footer_content_wrap content">
			<?php
			if ( has_nav_menu( 'footer-menu' ) ) :
				wp_nav_menu(
					array(
						'theme_location' => 'footer-menu',
						'menu_id'        => 'footer-menu',
						'menu_class'     => 'footer-nav align-center mb-0',
					)
				);
		endif;
			?>

			<?php
			if ( has_nav_menu( 'social' ) ) :
				wp_nav_menu(
					array(
						'theme_location' => 'social',
						'menu_id'        => 'social-menu',
						'menu_class'     => 'footer-social-nav',
					)
				);
			endif;
			?>

			<div class="site-info">
				<p>© 2020 Producer Themes. All Rights Reserved.</p>
			</div><!-- .site-info -->

		</div>
	</div><!-- .container -->
	<button class="up-btn" id="up-btn" title="<?php echo esc_html( __( 'Go to top', 'ghumgham' ) ); ?>"
		style="display: block;"><i class="fas fa-chevron-up"></i></button>
</footer>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>
