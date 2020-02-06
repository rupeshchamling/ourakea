<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Ourakea
 */

get_header();

/**
 *
 * Include a template part that displays a featured post.
 */
if ( is_home() ) {
	get_template_part( 'template-parts/post/featured' );
}
?>

<div class="container">
	<div class="row">

		<div id="primary" class="content-area<?php ourakea_content_class(); ?> column">
			<main id="main" class="site-main" role="main">

				<?php
				if ( have_posts() ) :

					/* Start the Loop */
					while ( have_posts() ) :
						the_post();

						/*
						 * Include the Post-Type-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
						 */
						get_template_part( 'template-parts/content', get_post_type() );

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
							endif;

						endwhile;

					if ( get_theme_mod( 'blog_pagination_mode' ) === 'numeric' ) {
						the_posts_pagination();
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
		/* Get Sidebar #secondary */
		get_sidebar();
		?>

	</div><!-- /.row -->
</div><!-- /.container -->

<?php
get_footer();
