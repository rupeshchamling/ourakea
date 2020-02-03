<?php
/**
 * Template part for displaying search form in the main-navbar-alt.php
 *
 * If you want to add another item instead of a form, use something like this:
 * <div class="my-2 my-md-0 d-none d-lg-inline">something</div>
 *
 * @package Ourakea
 */

?>

<div class="search_form nav-feature">
    <span class="btn-search clr-white"></span>

    <form class="form" method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
        <label class="assistive-text screen-reader-text" for="s">
            <?php esc_html_e( 'Search', 'ourakea' ); ?>
        </label>
        <div class="input-group">
            <input class="field form-control" id="s" name="s" type="text"
                placeholder="<?php esc_attr_e( 'Search &hellip;', 'ourakea' ); ?>"
                value="<?php the_search_query(); ?>">
            <span class="input-group-wrap">
                <button class="submit btn-uni" id="searchsubmit" name="submit" type="submit"
                    value="<?php esc_attr_e( 'Search', 'ourakea' ); ?>"><i class="search-icon"></i></button>
            </span>
        </div>
    </form>
</div>