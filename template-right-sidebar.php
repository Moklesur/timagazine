<?php
/**
 * Template Name: Right Sidebar
 *
 * @package timagazine
 * @subpackage timagazine
 */
get_header();
$mt_50 = '';
if ( ! is_front_page() ){
    $mt_50 = ' mt-50';
}
?>

    <main class="left-sidebar-page">
        <section>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-9 col-md-9<?php echo $mt_50; ?>">
                        <?php
                        while ( have_posts() ) : the_post();
                            get_template_part( 'template-parts/content', 'page' );

                            // If comments are open or we have at least one comment, load up the comment template.
                            if ( comments_open() || get_comments_number() ) :
                                comments_template();
                            endif;

                        endwhile; // End of the loop.
                        ?>
                    </div>
                    <?php get_sidebar(); ?>
                </div>
            </div>
        </section>
    </main><!-- #main -->

<?php

get_footer();