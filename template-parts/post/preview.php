<?php
/**
 * Template part for displaying posts preview on the Posts page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Ourakea
 */

?>

<article id="post-<?php the_ID(); ?>" class="post article-post blog-article">

<?php if ( has_post_thumbnail() ) { ?>
	<div class="post-image-wrap">
		<?php
			ourakea_post_comments();
		?>

		<figure>
			<?php the_post_thumbnail(); ?>
		</figure>
	</div>
<?php } ?>

	<div class="post-wrap">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<div class="entry-meta">
			<?php ourakea_posted_by(); ?>
			<?php ourakea_posted_on(); ?>
			<?php ourakea_post_category(); ?>
		</div>

		<div class="entry-summary card-text">
			<?php ourakea_entry_summary(); ?>
			<?php ourakea_post_tag(); ?>
		</div>
		<?php ourakea_edit_link(); ?>
	</div>

</article><!-- #post-<?php the_ID(); ?> -->
