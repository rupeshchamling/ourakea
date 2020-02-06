<?php
/**
 * Load files
 *
 * @package Ourakea
 */

/**
 * Load WordPress nav walker.
 */
require get_template_directory() . '/inc/class-ourakea-wp-bootstrap-navwalker.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

if ( ! class_exists( 'Kirki' ) ) {
	require get_template_directory() . '/kirki/kirki.php';
}

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Sanitize functions.
 */
require get_template_directory() . '/inc/helpers.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}


