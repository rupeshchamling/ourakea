<?php
/**
 * Template part for displaying page content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Ourakea
 */

?>

<article id="post-<?php the_ID(); ?>">

<?php
	the_post_thumbnail(
		'ourakea-featured-900-600',
		array(
			'class' => 'img-fluid mb-2',
		)
	);
	?>

<div class="card-body">

	<header class="entry-header pb-4">
		<?php the_title( '<h1 class="uppercase clr-blu bold-9">', '</h1>' ); ?>
	</header>

	<div class="entry-content">
		<?php
		the_content();

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'ourakea' ),
				'after'  => '</div>',
			)
		);
		?>
	</div>

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
				edit_post_link(
					sprintf(
						/* translators: %s: Name of current page */
						__( 'Edit<span class="screen-reader-text"> "%s"</span>', 'ourakea' ),
						get_the_title()
					),
					'<footer class="entry-footer"><span class="edit-link">',
					'</span></footer>'
				);
			?>
		</footer>
	<?php endif; ?>

</div><!-- .card-body -->
</article><!-- #post-<?php the_ID(); ?> -->
