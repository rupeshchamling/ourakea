<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Ourakea
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) :
		?>
	<div class="comment-wrap">
		<h2 class="comments-title">
			<?php
			$ourakea_comment_count = get_comments_number();
			if ( '1' === $ourakea_comment_count ) {
				printf( // WPCS: XSS OK.
					/* translators: 1: title. */
					esc_html__( 'One thought on &ldquo;%1$s&rdquo;', 'ourakea' ),
					'<span>' . get_the_title() . '</span>'
				);
			} else {
				printf( // WPCS: XSS OK.
					/* translators: 1: comment count number, 2: title. */
					esc_html( _nx( '%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', $ourakea_comment_count, 'comments title', 'ourakea' ) ),
					number_format_i18n( $ourakea_comment_count ),
					'<span>' . get_the_title() . '</span>'
				);
			}
			?>
		</h2><!-- .comments-title -->


		<ol class="comment-list">
			<?php
			wp_list_comments(
				array(
					'style'       => 'ol',
					'short_ping'  => true,
					'avatar_size' => 55,
				)
			);
			?>
		</ol><!-- .comment-list -->

		<div class="comment_pagination">
			<?php
			paginate_comments_links(
				array(
					'mid_size'  => 2,
					'prev_text' => '<span class="previous">' . __( 'Prev', 'ourakea' ),
					'next_text' => '<span class="next">' . __( 'Next', 'ourakea' ),
				)
			);
			?>
		</div>

		<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() ) :
			?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'ourakea' ); ?></p>
			<?php
		endif;

		?>
	</div>

		<?php
	endif; // Check for have_comments().

	comment_form();
	?>

</div><!-- #comments -->
