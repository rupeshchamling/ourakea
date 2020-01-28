<?php

/**
 * Template part for displaying main navigation top-bar
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Ourakea
 */

?>
<?php if ( get_theme_mod( 'mainmenu_dropdown_mode' ) !== 'bootstrap' ) { ?>

<nav class="navbar navbar-expand-lg main-navigation appear-left">
	<?php } else { ?>
	<nav class="navbar navbar-expand-lg main-navigation">
		<?php } ?>
		<div class="container">
			<?php if ( ! has_custom_logo() ) { ?>

				<?php if ( is_front_page() && is_home() ) : ?>

			<h1 class="navbar-brand mb-0"><a rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>"
					title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"
					itemprop="url"><?php bloginfo( 'name' ); ?></a></h1>

			<?php else : ?>

			<a class="navbar-brand" rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>"
				title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"
				itemprop="url"><?php bloginfo( 'name' ); ?></a>

			<?php endif; ?>


				<?php
			} else {
				the_custom_logo();
			}
			?>

			<?php if ( is_front_page() ) : ?>
			<a href="#buytheme" class="btn-uni btn-white br-round btn-buynow bold-7 m-0 btn-mob">Buy Now</a>
			<?php endif; ?>

			<button id="menu" class="navbar-toggler collapsed" type="button" data-toggle="collapse"
				data-target="#navbarmenus">
				<span></span>
				<span></span>
				<span></span>
			</button>

			<?php
			wp_nav_menu(
				array(
					'theme_location'  => 'primary',
					'container'       => 'div',
					'container_id'    => 'navbarmenus',
					'container_class' => 'collapse navbar-collapse justify-content-end',
					'menu_id'         => false,
					'depth'           => 8,
					'menu_class'      => 'navbar-nav',
					'fallback_cb'     => 'Ourakea_WP_Bootstrap_Navwalker::fallback',
				)
			);
			?>

			<?php if ( is_front_page() ) : ?>
				<a href="#buytheme" class="btn-uni btn-white br-round btn-buynow bold-7">Buy Now</a>
			<?php endif; ?>

		</div>
	</nav>
