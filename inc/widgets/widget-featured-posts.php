<?php
/**
 * Featured posts
 *
 */

class Timagazine_Widget_Featured_Posts extends WP_Widget {

    public function __construct() {
        $widget_ops = array(
            'classname' => 'widget-featured-posts',
            'description' => __( '5 featured posts displayed', 'timagazine' ),
            'customize_selective_refresh' => true,
        );
        parent::__construct( 'timagazine-widget', __( 'Featured Posts', 'timagazine' ), $widget_ops );
        $this->alt_option_name = 'widget-featured-posts';
    }

    public function widget( $args, $instance ) {
        if ( ! isset( $args['widget_id'] ) ) {
            $args['widget_id'] = $this->id;
        }

        $posts = isset( $instance['posts_dropdown'] ) ? $instance['posts_dropdown'] : '';


        $query = new WP_Query( array(
            'posts_per_page'      => 10,
            'no_found_rows'       => true,
            'post_status'         => 'publish',
            'ignore_sticky_posts' => true,
            'post__in'			  => $posts
        ) );

        if ($query->have_posts()) :
            ?>
            <?php echo $args['before_widget']; ?>

            <div class="featured-mag-post-widget">


                <?php $counter = 1; ?>
                <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                    <?php if( $counter == 1 ) {
                        $col = 'featured-col-6';
                    } elseif ( $counter == 6) {
                        $col = 'featured-col-6 float-right';

                    }else{
                        $col = 'featured-col-3';
                    } ?>


                    <div class="<?php echo $col; ?>">
                        <div class="featured-mag-wrapper position-r"><?php

                            if ( has_post_thumbnail() ) : ?>
                                <div class="featured-mag-thumb">
                                    <a href="<?php echo esc_url( get_the_permalink() ); ?>">
                                        <?php the_post_thumbnail(); ?>
                                    </a>
                                </div>
                            <?php endif; ?>

                            <div class="featured-mag-contents<?php if ( has_post_thumbnail() ) {}else{ echo " featured-img-contents-fix";}?>">
                                <div class="category-bg">
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

                                <h4>
                                    <a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php the_title(); ?></a>
                                </h4>

                                <?php if ( 'post' === get_post_type() ) : ?>
                                    <div class="entry-meta">
                                        <?php timagazine_posted_on(); ?>
                                    </div><!-- .entry-meta -->
                                <?php endif; ?>
                            </div>

                        </div>
                    </div>

                    <?php  $counter++; ?>
                <?php endwhile; ?>
            </div>

            <?php echo $args['after_widget']; ?>

            <?php
            wp_reset_postdata();

        endif;
    }

    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['posts_dropdown'] = array_map( 'sanitize_text_field', (array) $new_instance['posts_dropdown'] );

        return $instance;
    }

    public function form( $instance ) {
        $posts_dropdown  = isset( $instance['posts_dropdown'] ) ? array_map( 'esc_attr', $instance['posts_dropdown'] ) : '';

        ?>
        <p><em><?php _e('Please note: you can select up to five posts to display in this widget.', 'timagazine'); ?></em></p>
        <p><label for="<?php echo $this->get_field_id('posts_dropdown'); ?>"><?php _e('Choose your posts', 'timagazine'); ?></label>
            <select data-placeholder="<?php echo esc_attr__('Select five posts to display in this widget', 'timagazine'); ?>" multiple="multiple" name="<?php echo $this->get_field_name('posts_dropdown'); ?>" id="<?php echo $this->get_field_id( 'posts_dropdown' ); ?>" class="widefat chosen-dropdown-10">
                <?php
                global $post;
                $args = array( 'numberposts' => -1 );
                $posts = get_posts( $args );
                foreach( $posts as $post ) : setup_postdata( $post ); ?>
                    <?php printf(
                        '<option value="%s" %s>%s</option>',
                        $post->ID,
                        in_array( $post->ID, (array)$posts_dropdown ) ? 'selected="selected"' : '',
                        $post->post_title
                    );?>
                <?php endforeach; ?>
            </select>
        </p>

        <?php
    }
}