<?php
/**
 * Template part for displaying posts preview on the Posts page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Ourakea
 */

?>

<article id="post-<?php the_ID(); ?>" class="post article-post blog-article" >

    <figure>
        <?php the_post_thumbnail(); ?>
    </figure>

    <div class="post-wrap">
        <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

        <div class="entry-meta">
            <?php ourakea_posted_by(); ?>
            <?php ourakea_posted_on(); ?>
            <?php ourakea_entry_footer(); ?>
        </div>

        <div class="entry-summary card-text">
            <?php ourakea_entry_summary(); ?>
        </div>
    </div>

</article><!-- #post-<?php the_ID(); ?> -->