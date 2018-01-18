<?php
/**
 * The template for displaying search results pages
 *
 * @package timagazine
 */

?>
<div class="dropdown show search-dropdown">
    <a class="" href="#" role="button" id="header-search-id" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-search"></i></a>
    <form method="get" class="dropdown-menu"  aria-labelledby="header-search-id" action="<?php echo esc_url( home_url( '/' )); ?>">
        <input type="search" class="search-field form-control"
               placeholder="<?php esc_attr_e( 'Search ...', 'timagazine' ); ?>"
               value="<?php echo get_search_query() ?>" name="s" />
    </form>
</div>
