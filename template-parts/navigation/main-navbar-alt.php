<?php

/**
 * Template part for alternative displaying main navigation top-bar.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Ourakea
 */

?>
<?php if ( get_theme_mod( 'mainmenu_dropdown_mode' ) !== 'bootstrap' ) { ?>

<div class="top-bar">
    <div class="container">
        <?php
			if ( ! has_custom_logo() ) {
				if ( is_front_page() && is_home() ) :
					?>

        <h1 class="navbar-brand mb-0"><a rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>"
                title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"
                itemprop="url"><?php bloginfo( 'name' ); ?></a></h1>
        <?php
				else :
					?>

        <a class="navbar-brand" rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>"
            title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"
            itemprop="url"><?php bloginfo( 'name' ); ?></a>

        <?php
				endif;
			} else {
				the_custom_logo();
			}
			?>

        <div class="shopping-wrap align-items-center">
            <?php
				get_template_part( 'template-parts/navigation/add-item', 'search-form' );
				?>
        </div>
    </div>
</div>

<nav class="navbar navbar-expand-lg main-navigation nav-search appear-left">
    <?php } else { ?>
    <nav class="navbar navbar-expand-lg main-navigation nav-search">
        <?php } ?>
        <div class="container">

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

        </div><!-- .container -->
    </nav><!-- .site-navigation -->