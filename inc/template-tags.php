<?php
/**
 * Ourakea Standalone Functions.
 *
 * Some of the functionality here could be replaced by core features.
 *
 * @package Ourakea
 */

if ( ! function_exists( 'tihar_post_comments' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function ourakea_post_comments() {
		if ( comments_open() ) {
			?><span class="post-comments"><i class="far fa-comments"></i><?php comments_popup_link( '0', '1', '%', '', '' ); ?></span>
			<?php
		}
	}
	endif;

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
		global $post;
		$avatar = get_avatar_url( get_the_author_meta( 'ID' ), array( 'size' => '36' ) );

		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( ' %s', 'post author', 'ourakea' ),
			'<a class="author" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline"> <img src="' . $avatar . '" class="avatar-img">' . $byline; // WPCS: XSS OK.

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

if ( ! function_exists( 'ourakea_post_tag' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function ourakea_post_tag() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ' ', 'list item separator', 'ourakea' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( '%1$s', 'ourakea' ) . '</span>', $tags_list ); // WPCS: XSS OK.
			}
		}
	}
endif;
if ( ! function_exists( 'ourakea_post_category' ) ) :
	/**
	 * Prints HTML with meta information for the categories.
	 */
	function ourakea_post_category() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'ourakea' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links">' . esc_html__( '%1$s', 'ourakea' ) . '</span>', $categories_list ); // WPCS: XSS OK.
			}
		}
	}
endif;

if ( ! function_exists( 'ourakea_edit_link' ) ) :
	/**
	 * Prints HTML with meta information edit link.
	 */
	function ourakea_edit_link() {

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit : <span class="screen-reader-text">%s</span>', 'ourakea' ),
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
		// Get correct tag used for the comments.
		if ( 'div' === $args['style'] ) {
			$tag       = 'div';
			$add_below = 'comment';
		} else {
			$tag       = 'li';
			$add_below = 'div-comment';
		}
		?>

<<?php echo $tag; ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?>
	id="comment-<?php comment_ID(); ?>">

		<?php
			// Switch between different comment types.
		switch ( $comment->comment_type ) :
			case 'pingback':
			case 'trackback':
				?>
	<div class="pingback-entry"><span class="pingback-heading"><?php esc_html_e( 'Pingback:', 'ourakea' ); ?></span>
				<?php comment_author_link(); ?></div>
				<?php
				break;
			default:
				if ( 'div' != $args['style'] ) {
					?>
	<div id="div-comment-<?php comment_ID(); ?>" class="comment-meta">
		<?php } ?>
		<div class="comment-author vcard">
			<figure>
				<?php
						// Display avatar unless size is set to 0.
				if ( $args['avatar_size'] != 0 ) {
					$avatar_size = ! empty( $args['avatar_size'] ) ? $args['avatar_size'] : 70; // set default avatar size
					echo get_avatar( $comment, $avatar_size );
				}
				?>
			</figure>

			<div class="comment-metadata">
				<?php
						// Display author name.
						printf( __( '<span class="fn">%s</span> ', 'ourakea' ), get_comment_author_link() );
				?>
				<a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>" class="date">
					<?php
							/* translators: 1: date, 2: time */
							printf(
								__( '%1$s at %2$s', 'ourakea' ),
								get_comment_date(),
								get_comment_time()
							);
					?>
				</a>

				<div class="comment-details">
					<div class="comment-text"><?php comment_text(); ?></div><!-- .comment-text -->
					<?php
							// Display comment moderation text.
					if ( $comment->comment_approved === '0' ) {
						?>
					<em
						class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'ourakea' ); ?></em><br />
						<?php
					}
					?>

				</div><!-- .comment-details -->
				<?php
						edit_comment_link( __( '(Edit)', 'ourakea' ), '  ', '' );
				?>
			</div><!-- .comment-meta -->
			<div class="reply">
				<?php
						// Display comment reply link.
						comment_reply_link(
							array_merge(
								$args,
								array(
									'add_below' => $add_below,
									'depth'     => $depth,
									'max_depth' => $args['max_depth'],
								)
							)
						);
				?>
			</div>
		</div><!-- .comment-author -->
				<?php
				if ( 'div' !== $args['style'] ) {
					?>
	</div>
					<?php
				}
				// IMPORTANT: Note that we do NOT close the opening tag, WordPress does this for us.
				break;
		endswitch; // End comment_type check.
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
