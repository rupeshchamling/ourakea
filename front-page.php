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
				<img src="<?php echo esc_url( get_theme_mod( 'section_one_img' ) ); ?>">
			</div>

			<div class="col-md-6 column align-center">
			<?php if ( get_theme_mod( 'section_one_title' ) ) : ?>
				<h2 class="col-heading"><?php echo esc_html( get_theme_mod( 'section_one_title' ) ); ?></h2>
				<?php endif; ?>
				<?php if ( get_theme_mod( 'section_one_desc' ) ) : ?>
				<div class="paragraph">
					<?php echo wp_kses_post( wpautop( get_theme_mod( 'section_one_desc' ) ) ); ?>
				</div>
				<?php endif; ?>
				<?php if ( get_theme_mod( 'section_one_btn_label' ) || get_theme_mod( 'section_one_btn_link' ) ) : ?>
				<a href="<?php echo esc_url( get_theme_mod( 'section_one_btn_link' ) ); ?>" class="btn-uni"><?php echo esc_html( get_theme_mod( 'section_one_btn_label' ) ); ?></a>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>

<section class="section-two section-blog">
	<div class="container">
		<div class="row">
		<?php
		if ( get_theme_mod( 'section_two_posts' ) ) {
			foreach ( get_theme_mod( 'section_two_posts' ) as $section_two_post ) :
				if ( count( get_theme_mod( 'section_two_posts' ) ) === 3 || count( get_theme_mod( 'section_two_posts' ) ) === 6 ) {
					$section_two_class = 'col-lg-4 col-md-3';
				} else {
					$section_two_class = 'col-lg-3 col-md-6';
				}

				?>
			<div class="<?php echo esc_html( $section_two_class ); ?> col-sm-6 column">
				<div class="col-content">
					<a href="<?php echo esc_url( get_the_permalink( $section_two_post ) ); ?>"><?php echo get_the_post_thumbnail( $section_two_post ); ?></a>

					<div class="blog-heading">
						<a href="<?php echo esc_url( get_the_permalink( $section_two_post ) ); ?>"><?php echo esc_html( get_the_title( $section_two_post ) ); ?></a>
					</div>
				</div>
			</div>
				<?php
		endforeach;
		}
		?>
		</div>
	</div>
</section>

<section class="section-three">
	<div class="container">
		<div class="row row-center">
			<div class="col-md-6 column">
			<img src="<?php echo esc_url( get_theme_mod( 'section_three_img' ) ); ?>">
			</div>


			<div class="col-md-6 column align-center">
			<?php if ( get_theme_mod( 'section_three_title' ) ) : ?>
				<h2 class="col-heading"><?php echo esc_html( get_theme_mod( 'section_three_title' ) ); ?></h2>
				<?php endif; ?>
				<?php if ( get_theme_mod( 'section_three_desc' ) ) : ?>
				<div class="paragraph">
					<?php echo wp_kses_post( wpautop( get_theme_mod( 'section_three_desc' ) ) ); ?>
				</div>
				<?php endif; ?>
				<?php if ( get_theme_mod( 'section_three_btn_label' ) || get_theme_mod( 'section_three_btn_link' ) ) : ?>
				<a href="<?php echo esc_url( get_theme_mod( 'section_three_btn_link' ) ); ?>" class="btn-uni"><?php echo esc_html( get_theme_mod( 'section_three_btn_label' ) ); ?></a>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>

<section class="section-four section-blog">
	<div class="container">
		<div class="row">
		<?php
		if ( get_theme_mod( 'section_four_posts' ) ) {
			foreach ( get_theme_mod( 'section_four_posts' ) as $section_four_post ) :
				if ( count( get_theme_mod( 'section_four_posts' ) ) === 3 || count( get_theme_mod( 'section_four_posts' ) ) === 6 ) {
					$section_four_class = 'col-lg-4 col-md-3';
				} else {
					$section_four_class = 'col-lg-3 col-md-6';
				}

				?>
			<div class="<?php echo esc_html( $section_four_class ); ?> col-sm-6 column">
				<div class="col-content">
					<a href="<?php echo esc_url( get_the_permalink( $section_four_post ) ); ?>"><?php echo get_the_post_thumbnail( $section_four_post ); ?></a>

					<div class="blog-heading">
						<a href="<?php echo esc_url( get_the_permalink( $section_four_post ) ); ?>"><?php echo esc_html( get_the_title( $section_four_post ) ); ?></a>
					</div>
				</div>
			</div>
				<?php
		endforeach;
		}
		?>
		</div>
	</div>
</section>

<?php
get_footer();
