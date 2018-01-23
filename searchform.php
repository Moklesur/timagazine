<?php
/**
 * The template for displaying search results pages
 *
 * @package timagazine
 */

?>
<form method="get" aria-labelledby="header-search-id" action="<?php echo esc_url( home_url( '/' )); ?>">
    <input type="search" class="search-field form-control"
           placeholder="<?php esc_attr_e( 'Search ...', 'timagazine' ); ?>"
           value="<?php echo get_search_query() ?>" name="s" />
</form>