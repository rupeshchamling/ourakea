<?php
/**
 * The template for displaying search forms
 *
 * @package Ourakea
 */

?>

<!-- Search Form Widget -->
<div class="search-form">
	<div class="content">
		<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
			<div class="input-group">
				<input class="field form-control" id="s" name="s" type="text"
					placeholder="<?php esc_attr_e( 'Search &hellip;', 'ourakea' ); ?>"
					value="<?php the_search_query(); ?>">
				<span class="input-group-append">
					<input class="submit btn-ubi" id="searchsubmit" name="submit" type="submit"
						value="<?php esc_attr_e( 'Search', 'ourakea' ); ?>">
				</span>
			</div>
		</form>
	</div>
</div>


