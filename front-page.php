<?php

/**
 *
 * The front page template file
 *
 * If the user has selected a static page for their homepage, this is what will
 * appear.
 * Learn more: https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Ourakea
 */

get_header();
?>

<section class="section-one">
    <div class="container">
        <div class="row row-center">
            <div class="col-md-6 column col-right">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/air-gun.jpg">
            </div>

            <div class="col-md-6 column align-center">
                <h2 class="col-heading">Cigar Humidor Advice & Tips</h2>
                <div class="paragraph">
                    <p>Learn how and why a cigar humidor is essential for any cigar lover.</p>
                    <p>Our articles, guides and tips are here to help make sure your cigars are always perfect.</p>
                </div>
                <a href="#" class="btn-uni">Learn More</a>
            </div>
        </div>
    </div>
</section>

<section class="section-two section-blog">
    <div class="container">
        <div class="row">
            <?php
						$ourakea_args              = array(
							'post_type'      => 'post',
							'posts_per_page' => 2,
							'category__in'   => $ourakea_category,
						);
								$ourakea_query = new WP_Query( $ourakea_args );
						while ( $ourakea_query->have_posts() ) :
							$ourakea_query->the_post();
							?>
            <div class="col-lg-4 col-sm-6 column">
                <div class="col-content">
                    <a href="<?php esc_url( the_permalink() ); ?>"><?php echo get_the_post_thumbnail(); ?></a>

                    <div class="blog-heading">
                        <a href="<?php esc_url( the_permalink() ); ?>"><?php the_title(); ?></a>
                    </div>
                </div>
            </div>
            <?php
						endwhile;
								wp_reset_postdata();
						?>
        </div>
    </div>
</section>

<section class="section-three">
    <div class="container">
        <div class="row row-center">
            <div class="col-md-6 column">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/air-gun.jpg">
            </div>

            <div class="col-md-6 column align-center">
                <h2 class="col-heading">Cigar Humidor Advice & Tips</h2>
                <div class="paragraph">
                    <p>Learn how and why a cigar humidor is essential for any cigar lover. Our articles, guides and tips
                        are here to help make sure your cigars are always perfect.</p>
                </div>
                <a href="#" class="btn-uni">Learn More</a>
            </div>
        </div>
    </div>
</section>

<section class="section-four section-blog">
    <div class="container">
        <div class="row">
            <?php
						$ourakea_args              = array(
							'post_type'      => 'post',
							'posts_per_page' => 2,
							'category__in'   => $ourakea_category,
						);
								$ourakea_query = new WP_Query( $ourakea_args );
						while ( $ourakea_query->have_posts() ) :
							$ourakea_query->the_post();
							?>
            <div class="col-lg-4 col-sm-6 column">
                <div class="col-content">
                    <a href="<?php esc_url( the_permalink() ); ?>"><?php echo get_the_post_thumbnail(); ?></a>

                    <div class="blog-heading">
                        <a href="<?php esc_url( the_permalink() ); ?>"><?php the_title(); ?></a>
                    </div>
                </div>
            </div>
            <?php
						endwhile;
								wp_reset_postdata();
						?>
        </div>
    </div>
</section>

<?php
get_footer();