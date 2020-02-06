<?php
/**
 * Template part for displaying Single post
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Ourakea
 */

?>

<article id="post-<?php the_ID(); ?>" class="single-article">

    <div class="single-content">

        <h1 class="post-title align-center"><?php single_post_title(); ?></h1>
        <div class="entry-meta align-center">
            <?php ourakea_posted_by(); ?>
			<?php ourakea_posted_on(); ?>
			<?php ourakea_post_category(); ?>
        </div>

        <figure class="post-thumbnail">
			<?php the_post_thumbnail(); ?>
			<?php ourakea_post_tag(); ?>
        </figure>

        <?php
		if ( has_excerpt() ) :
			?>
        <div class="lead"><?php the_excerpt(); ?></div>
        <?php
		endif;
		?>

        <div class="entry-content mx-auto">
            <?php
			the_content(
				sprintf(
					/* translators: %s: Name of current post. Only visible to screen readers */
					esc_html__( 'Continue reading%s', 'ourakea' ),
					'<span class="screen-reader-text">' . get_the_title() . '</span>'
				)
			);

			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'ourakea' ),
					'after'  => '</div>',
				)
			);
			?>
        </div><!-- .entry-content -->

    </div><!-- .card-body -->
</article><!-- #post-<?php the_ID(); ?> -->