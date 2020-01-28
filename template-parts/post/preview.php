<?php
/**
 * Template part for displaying posts preview on the Posts page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Ourakea
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<figure>
		<?php the_post_thumbnail(); ?>
	</figure>

	<div class="card-body">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<div class="entry-meta card-footer">
			<?php ourakea_posted_on(); ?>
			<?php ourakea_posted_by(); ?>
		</div>

		<div class="entry-summary card-text">
			<?php ourakea_entry_summary(); ?>
		</div>

		<footer class="entry-footer">
			<?php ourakea_entry_footer(); ?>
		</footer>
	</div>

</article><!-- #post-<?php the_ID(); ?> -->
