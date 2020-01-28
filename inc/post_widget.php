<?php
/** Posts Widget **/

add_action( 'widgets_init', 'ourakea_post_widget_register' );

function ourakea_post_widget_register() {
	register_widget( 'ourakea_post_widget_class' );
}

// Creating the widget
class ourakea_post_widget_class extends WP_Widget {

	/**
	 * Widget Init.
	 */
	function __construct() {
		parent::__construct(
		// Base ID of your widget
			'ourakea_post_widget',
			// Widget name will appear in UI
			esc_html__( 'Ourakea: Posts Widget', 'ourakea' ),
			// Widget description
			array( 'description' => esc_html__( 'Display Recent Posts Widget', 'ourakea' ) )
		);
	}

	/**
	 * Creating widget front-end.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		$title      = apply_filters( 'widget_title', $instance['title'] );
		$categories = $instance['categories'];
		$number     = $instance['number'];

		$query = array(
			'showposts'           => $number,
			'nopaging'            => 0,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => 1,
			'cat'                 => $categories,
		);

		$loop = new WP_Query( $query );

		echo $before_widget;

		if ( $title ) {
			echo $before_title . $title . $after_title;
		}

		if ( $loop->have_posts() ) :
			?>
			<div class="recent-widget">
				<?php
				while ( $loop->have_posts() ) :
					$loop->the_post();
					?>
				
					<div class="post-widget">
						<?php if ( ( function_exists( 'has_post_thumbnail' ) ) && ( has_post_thumbnail() ) ) : ?>
						<div class="post-widget-img">
							<a href="<?php echo get_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail( 'ourakea-grid-list-thumb' ); ?></a>
						</div>
						<?php endif; ?>
						<h4>
							<a href="<?php echo get_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
							<span class="post-date"><?php echo get_the_date(); ?></span>
						</h4>
					</div>

				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>
				
			</div>
			<?php

		endif;

		echo $after_widget;

	}

	/**
	 * Creating widget back-end.
	 */
	function form( $instance ) {

		$defaults = array(
			'title'      => esc_html__( 'Latest Posts', 'ourakea' ),
			'number'     => 3,
			'categories' => '',
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'ourakea' ); ?></label>
			<input  type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_html( $instance['title'] ); ?>"  />
		</p>
		
		<p>
		<label for="<?php echo $this->get_field_id( 'categories' ); ?>"><?php esc_html_e( 'Filter By Category:', 'ourakea' ); ?></label> 
		<select id="<?php echo $this->get_field_id( 'categories' ); ?>" name="<?php echo $this->get_field_name( 'categories' ); ?>" class="widefat categories" style="width:100%;">
		
			<option value='all' 
			<?php
			if ( 'all' == $instance['categories'] ) {
				echo 'selected="selected"';}
			?>
			><?php esc_html_e( 'All Categories:', 'ourakea' ); ?></option>
			<?php $categories = get_categories( 'hide_empty=0&depth=1&type=post' ); ?>
			<?php foreach ( $categories as $category ) { ?>
			<option value='<?php echo $category->term_id; ?>' 
									  <?php
										if ( $category->term_id == $instance['categories'] ) {
											echo 'selected="selected"';}
										?>
			><?php echo $category->cat_name; ?></option>
			<?php } ?>
		</select>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php esc_html_e( 'Number of posts to show:', 'ourakea' ); ?></label>
			<input  type="text" class="widefat" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" value="<?php echo esc_html( $instance['number'] ); ?>" size="3" />
		</p>

		<?php
	}

	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title']      = strip_tags( $new_instance['title'] );
		$instance['categories'] = $new_instance['categories'];
		$instance['number']     = strip_tags( $new_instance['number'] );

		return $instance;
	}
}
?>
