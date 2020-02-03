<?php
/**
 * Ourakea Standalone Functions.
 *
 * Some of the functionality here could be replaced by core features.
 *
 * @package Ourakea
 */

if ( ! function_exists( 'ourakea_entry_summary' ) ) :
	/**
	 *
	 * Template part which displays post excerpts on the posts page.
	 */
	function ourakea_entry_summary() {

		global $post;
		$has_more = strpos( $post->post_content, '<!--more' );

		if ( $has_more ) {
			the_content();
		} else {
			the_excerpt();
		}

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'ourakea' ),
				'after'  => '</div>',
			)
		);
	}
endif;

if ( ! function_exists( 'ourakea_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function ourakea_posted_by() {

		$avatar = get_avatar_url( get_the_author_meta( 'ID' ), ['size' => '36'] );

		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( ' %s', 'post author', 'ourakea' ),
			'<a class="author" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline"> <img src="'.$avatar.'" class="avatar-img">' . $byline; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'ourakea_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function ourakea_posted_on() {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( ' %s', 'post date', 'ourakea' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.
	}
endif;

if ( ! function_exists( 'ourakea_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function ourakea_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'ourakea' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links">' . esc_html__( '%1$s', 'ourakea' ) . '</span>', $categories_list ); // WPCS: XSS OK.
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'ourakea' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( '%1$s', 'ourakea' ) . '</span>', $tags_list ); // WPCS: XSS OK.
			}
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'ourakea' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;


if ( ! function_exists( 'ourakea_comment' ) ) :
	/**
	 * Used as a callback by wp_list_comments() for displaying the comments.
	 *
	 * @param string $comment actual comment.
	 * @param string $args arguments.
	 * @param string $depth depth.
	 */
	function ourakea_comment( $comment, $args, $depth ) {
		if ( 'pingback' === $comment->comment_type || 'trackback' === $comment->comment_type ) : ?>

<li id="comment-<?php comment_ID(); ?>" <?php comment_class( 'media' ); ?>>
	<div class="comment-body">
			<?php esc_html_e( 'Pingback:', 'ourakea' ); ?> <?php comment_author_link(); ?>
			<?php edit_comment_link( __( 'Edit', 'ourakea' ), '<span class="edit-link">', '</span>' ); ?>
	</div>

			<?php
		else :
			?>

<li id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?>>
	<article id="div-comment-<?php comment_ID(); ?>" class="comment-body media mb-4">
		<a class="pull-left" href="#">
			<?php
			if ( 0 !== $args['avatar_size'] ) {
				echo get_avatar( $comment, $args['avatar_size'], '', '', array( 'class' => 'rounded-circle' ) );}
			?>
		</a>

		<div class="media-body">
			<div class="media-body-wrap card">
				<div class="card-header">
					<h5 class="mt-0">
						<?php
							printf( /* translators: %s: comment author link */
								__( '%s <span class="says">says:</span>', 'ourakea' ),
								sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() )
							);
						?>
					</h5>
					<div class="comment-meta">
						<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
							<time datetime="<?php comment_time( 'c' ); ?>">
								<?php
										printf( /* translators: %s: comment time */
											esc_html_x( '%1$s at %2$s', '1: date, 2: time', 'ourakea' ),
											get_comment_date(),
											get_comment_time()
										); // WPCS: XSS OK.
								?>
							</time>
						</a>
						<?php edit_comment_link( __( '<span style="margin-left: 5px;" class="glyphicon glyphicon-edit"></span> Edit', 'ourakea' ), '<span class="edit-link">', '</span>' ); ?>
					</div>
				</div>

				<?php if ( '0' === $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation">
					<?php esc_html_e( 'Your comment is awaiting moderation.', 'ourakea' ); ?></p>
				<?php endif; ?>

				<div class="comment-content card-block">
					<?php comment_text(); ?>
				</div><!-- .comment-content -->

				<?php
						$args = array();
						comment_reply_link(
							array_merge(
								$args,
								array(
									'add_below' => 'div-comment',
									'depth'     => $depth,
									'max_depth' => $args['max_depth'],
									'before'    => '<footer class="reply comment-reply card-footer">',
									'after'     => '</footer>',
								)
							)
						);
				?>

			</div>
		</div><!-- .media-body -->

	</article>
</li>

			<?php
		endif;
	}
endif;


/**
 * Display the class for layout div wrapper.
 *
 * @param array $classes One or more classes to add to the class list.
 */
function ourakea_layout_class( $classes = '' ) {
	// Separates classes with a single space.
	echo 'class="' . join( ' ', ourakea_set_layout_class( $classes ) ) . '"'; // WPCS: XSS OK.
}

/**
 * Adds custom class.
 *
 * @param array $class Classes for the div element.
 * @return array
 */
function ourakea_set_layout_class( $class = '' ) {

	// Define classes array.
	$classes = array();

	// Grid classes.
	if ( ( is_home() || is_archive() ) && ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = '';
	}

	$classes = array_map( 'esc_attr', $classes );

	// Apply filters to entry post class for child theming.
	$classes = apply_filters( 'ourakea_set_layout_class', $classes );

	// Classes array.
	return array_unique( $classes );
}

/**
 * Display the class for content wrapper div.
 *
 * @param array $classes One or more classes to add to the class list.
 */
function ourakea_content_class( $classes = '' ) {
	// Separates classes with a single space.
	echo ' ' . join( ' ', ourakea_set_content_class( $classes ) );// WPCS: XSS OK.
}

/**
 * Adds custom class.
 *
 * @param array $class Classes for the div element.
 * @return array
 */
function ourakea_set_content_class( $class = '' ) {

	// Define classes array.
	$classes = array();

	$classes[] = 'col-lg-8';

	// Centered.
	if ( ! is_active_sidebar( 'sidebar-1' ) || get_theme_mod( 'sidebar_position' ) === 'none' ) {
		$classes[] = 'offset-md-2';
	}

	$classes = array_map( 'esc_attr', $classes );

	// Apply filters to entry post class for child theming.
	$classes = apply_filters( 'ourakea_set_content_class', $classes );

	// Classes array.
	return array_unique( $classes );
}

/**
 * Condition function.
 * This is a static front page and not the latest posts page.
 */
function ourakea_is_frontpage() {
	return ( is_front_page() && ! is_home() );
}
