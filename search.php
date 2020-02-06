<?php
/**
 * The template for displaying search results
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Ourakea
 */

get_header();
?>

<section class="section-search">
	<div class="container">
	<div class="row">
		<div id="primary" class="content-area<?php ourakea_content_class(); ?> column">
			<main id="main" class="site-main" role="main">

				<?php
				if ( have_posts() ) :
					?>

					<?php
						/* Start the Loop */
					while ( have_posts() ) :
						the_post();

						/**
						 * Run the loop for the search to output the results.
						 * If you want to overload this in a child theme then include a file
						 * called search-result.php in the template-parts folder.
						 */
						get_template_part( 'template-parts/search', 'result' );

						endwhile;
					?>

					<?php
					if ( get_theme_mod( 'blog_pagination_mode' ) === 'numeric' ) {
						the_posts_pagination(
							array(
								'mid_size'  => 2,
								'prev_text' => __( '&#60;', 'textdomain' ),
								'next_text' => __( '&#62;', 'textdomain' ),
							)
						);
					} else {
						the_posts_navigation();
					}
			else :
				get_template_part( 'template-parts/content', 'none' );
		endif;
			?>

			</main>
		</div><!-- #primary -->
		<?php
		if ( have_posts() ) :
			/* Get Sidebar #secondary */
			get_sidebar();
		endif;
		?>

	</div><!-- /.row -->
	</div><!-- /.container -->
</section><!-- /.section-search -->

<?php
get_footer();
