<?php
/**
 * Template part for displaying posts preview on the Posts page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Ourakea
 */

?>

<article id="post-<?php the_ID(); ?>" class="blog-article box-shadow">

	<div class="row">
		<figure class="col-md-5">
			<?php the_post_thumbnail(); ?>
		</figure>

		<div class="col-md-7">
			<div class="col-content">
				<div class="entry-links">
					<?php ourakea_entry_footer(); ?>
				</div>

				<?php the_title( sprintf( '<h2 class="entry-title ln-height-0"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

				<?php
				if ( get_post_type() === 'post' ) {
					?>
				<div class="entry-meta">
					<?php ourakea_posted_by(); ?>
					<?php ourakea_posted_on(); ?>
				</div>
					<?php
				}
				?>
				<div class="entry-summary card-text">
					<?php ourakea_entry_summary(); ?>
				</div>
			</div>
		</div>
	</div>

</article><!-- #post-<?php the_ID(); ?> -->
