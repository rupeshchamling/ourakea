<?php
/**
 * Helper functions.
 *
 * @package Ourakea
 */


/**
 *
 * Helper function for Contextual Control
 * Whether the static page is set to a front displays
 * https://developer.wordpress.org/reference/classes/wp_customize_control/active_callback/
 */


if ( ! function_exists( 'ourakea_header_page_title' ) ) :

	/**
	 * Display page title on header.
	 *
	 * @since 1.0.0
	 */
	function ourakea_header_page_title() {
		if ( is_front_page() ) :
			return;
		elseif ( is_home() ) :
			?>
<div class="page-content align-center">
    <div class="container">
        <h1 class="header-heading"><?php single_post_title(); ?></h1>
    </div>
</div>
<?php
		elseif ( is_archive() ) :
			?>
<div class="page-content">
    <div class="container">
        <h1 class="header-heading"><?php the_archive_title(); ?></h1>
    </div>
</div>

<?php
		elseif ( is_search() ) :
			?>
<div class="page-content">
    <div class="container">
        <h1 class="header-heading">
            <?php printf( esc_html__( 'Search Results for: %s', 'ourakea' ), get_search_query() ); ?>
        </h1>
    </div>
</div>
<?php
		elseif ( is_404() ) :
			?>
<div class="page-content">
    <div class="container">
        <h1 class="header-heading">
            <span><?php echo __( 'Oops!', 'ourakea' ); ?></span><?php echo esc_html__( ' That page can&#39;t be found.', 'ourakea' ); ?>
        </h1>

        <div class="error-404 not-found">
            <?php get_search_form(); ?>
        </div>
    </div>
</div>

<?php
		endif;
	}

endif;