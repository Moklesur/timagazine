<?php
/**
 * Displays latest posts
 *
 */

class Timagazine_Widget_latest_Posts extends WP_Widget {

    public function __construct() {
        $widget_ops = array(
            'classname' => 'timagazine_widget_latest_posts',
            'description' => __( 'Displays Latest posts', 'timagazine' ),
            'customize_selective_refresh' => true,
        );
        parent::__construct( 'timagazine-widget-latest-posts', __( 'Latest Posts', 'timagazine' ), $widget_ops );
        $this->alt_option_name = 'timagazine_widget_latest_posts';
    }

    public function widget( $args, $instance ) {
        if ( ! isset( $args['widget_id'] ) ) {
            $args['widget_id'] = $this->id;
        }

        $title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : '';

        $number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 4;
        if ( ! $number )
            $number = 4;

        $query = new WP_Query( array(
            'posts_per_page'      => $number,
            'no_found_rows'       => true,
            'post_status'         => 'publish',
            'ignore_sticky_posts' => true,
        ) );

        if ($query->have_posts()) :

             echo $args['before_widget'];

             if ( $title ) { ?>
                 <div class="widgets-heading">
                    <?php echo $args['before_title'] . $title . $args['after_title']; ?>
                 </div>
             <?php } ?>

            <div class="widget-latest-posts latest-posts-carousel owl-carousel">

                <?php while ( $query->have_posts() ) : $query->the_post();

                    $cat_position = '';

                    if ( has_post_thumbnail() ){
                        $cat_position = ' cat-position';
                    }
                    ?>

                    <div class="d-flex align-items-center mt-30">
                        <div class="featured-mag-wrapper position-r">
                            <?php
                            if ( has_post_thumbnail() ) : ?>
                                <div class="featured-thumb mb-20">
                                    <a href="<?php echo esc_url( get_the_permalink() ); ?>">
                                        <?php the_post_thumbnail(); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                            <div class="latest-posts-contents">
                                <div class="category-bg<?php echo $cat_position; ?>">
                                    <?php

                                    $categories_list = get_the_category();
                                    foreach( $categories_list as $category ){

                                        $cat_bg_color = get_theme_mod( 'category_color_' . $category->term_id );

                                        if ( $cat_bg_color != '' ){
                                            echo '<a class="category-unique-bg" href="' . esc_url( get_category_link( $category->term_id ) ) . '" style="background:' . esc_attr( $cat_bg_color ) . '" rel="category tag">'. esc_html( $category->cat_name ) .'</a>';
                                        }else{
                                            echo '<a class="category-unique-empty" href="' . esc_url( get_category_link( $category->term_id ) ) . '" rel="category tag">'. esc_html( $category->cat_name ) .'</a>';
                                        }
                                    }
                                    ?>
                                </div>
                                <h6>
                                    <a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php the_title(); ?></a>
                                </h6>
                                <?php if ( 'post' === get_post_type() ) : ?>
                                    <div class="entry-meta">
                                        <?php timagazine_posted_on(); ?>
                                    </div><!-- .entry-meta -->
                                <?php endif; ?>

                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
            <?php echo $args['after_widget'];

            wp_reset_postdata();

        endif;
    }

    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = sanitize_text_field( $new_instance['title'] );
        $instance['number'] = (int) $new_instance['number'];
        return $instance;
    }

    public function form( $instance ) {
        $title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
        $number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 4;

        ?>

        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Heading:', 'timagazine' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:', 'timagazine' ); ?></label>
            <input class="tiny-text" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" step="1" min="1" value="<?php echo $number; ?>" size="3" />
        </p>

        <?php
    }
}