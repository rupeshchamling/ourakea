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

		if ( have_posts() ) {
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
						<?php printf( __( 'Search Results <span>%s</span>', 'ourakea' ), get_search_query() ); ?>
		</h1>
	</div>
</div>
					<?php
				endif;
		} else {
			if ( is_404() ) :
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
			<?php else : ?>
		<div class="page-content">
	<div class="container">
		<h1 class="header-heading"><?php esc_html_e( 'Not Found', 'ourakea' ); ?></h1>
				<?php
				if ( is_home() && current_user_can( 'publish_posts' ) ) :

					printf(
						'<span>' . wp_kses(
						/* translators: 1: link to WP admin new post page. */
							__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'ourakea' ),
							array(
								'a' => array(
									'href' => array(),
								),
							)
						) . '</span>',
						esc_url( admin_url( 'post-new.php' ) )
					);

				elseif ( is_search() ) :
					?>

					<span><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'ourakea' ); ?></span>
					<?php
					get_search_form();

						else :
							?>

					<span><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'ourakea' ); ?></span>
							<?php
							get_search_form();

						endif;
						?>
	</div>
</div>
				<?php
				endif;
		}
	}
endif;
