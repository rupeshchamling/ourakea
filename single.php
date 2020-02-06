<?php
/**
 * The template for displaying a single post
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Ourakea
 */

get_header();
?>

<div class="container">
    <div id="primary" class="content-area column mx-auto">
        <main id="main" class="site-main">
            <?php
			while ( have_posts() ) :
				the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-single-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/post/single', get_post_format() );

				?>

            <?php if ( ! is_attachment() ) { ?>
            <nav class="navigation card-footer">
                <div class="nav_direction">
                    <?php
							$prev_post = get_previous_post( true );
					if ( $prev_post ) {
						?>
                    <div class="previous_post column">
                        <div class="prev_title">
                            <span>Previous Post</span>
                            <?php previous_post_link( '%link', "<div class='detials'><h4>%title</h4></div>", true ); ?>
                        </div>
                    </div>

                    <?php
					}
							$next_post = get_next_post( true );
					if ( $next_post ) {
						?>
                    <div class="next_post column">
                        <div class="next_title">
                            <span>Next Post</span>
                            <?php next_post_link( '%link', "<div class='detials'><h4>%title</h4></div>", true ); ?>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </nav>
            <?php } ?>

            <?php
				// Query random posts.
				$the_query = ourakea_related_post_query( get_the_ID(), 2 );
				?>
            <?php
				// If we have posts lets show them.
				if ( $the_query->have_posts() ) :
					?>
            <div id="related-post">
                <h2 class="related-post-title"><?php esc_html_e( 'Related Posts', 'ourakea' ); ?></h2>

                <div class="row">
                    <?php
						// Loop through the posts.
						while ( $the_query->have_posts() ) :
							$the_query->the_post();
							?>
                    <div class="col-sm-6 column">
                        <article class="post-content">
                            <figure>
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail(); ?>
                                </a>
                                <?php ourakea_post_category(); ?>
                            </figure>

                            <div class="blog_content">
                                <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
                                <?php ourakea_posted_by(); ?>
                                <span class="divider">-</span>
                                <?php ourakea_posted_on(); ?>
                            </div>
                        </article>
                    </div>
                    <?php endwhile; ?>
                </div>
                <?php wp_reset_postdata(); ?>
            </div>
            <?php endif; ?>
            <?php
					// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
					endif;

		endwhile; // End of the loop.
			?>

        </main><!-- #main -->
    </div><!-- #primary -->
</div><!-- /.container -->

<?php
get_footer();