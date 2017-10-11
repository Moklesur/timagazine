<?php
/**
 * Displays posts from a single category
 *
 */

class Timagazine_Widget_Category_Posts_A extends WP_Widget {

    public function __construct() {
        $widget_ops = array(
            'classname' => 'timagazine_widget_category_posts_a',
            'description' => __( 'Displays posts from a single category', 'timagazine' ),
            'customize_selective_refresh' => true,
        );
        parent::__construct( 'timagazine-widget-category-posts-a', __( 'Single category posts', 'timagazine' ), $widget_ops );
        $this->alt_option_name = 'timagazine_widget_category_posts_a';
    }

    public function widget( $args, $instance ) {
        if ( ! isset( $args['widget_id'] ) ) {
            $args['widget_id'] = $this->id;
        }


        $category_layout_style = isset( $instance['category_layout_style'] ) ? $instance['category_layout_style'] : '';
        $category = isset( $instance['category_dropdown'] ) ? $instance['category_dropdown'] : '';

        $number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
        if ( ! $number )
            $number = 5;

        $query = new WP_Query( array(
            'posts_per_page'      => $number,
            'no_found_rows'       => true,
            'post_status'         => 'publish',
            'ignore_sticky_posts' => true,
            'cat'		  		  => $category
        ) );

        if ($query->have_posts()) :

            echo $args['before_widget']; ?>

            <div class="widgets-heading">
                <h3 class="widget-title"><?php echo esc_html( get_cat_name( $category ) ); ?></h3>
            </div>

            <div class="widget-category-posts-a row">

                <?php $counter = 1;

                while ( $query->have_posts() ) : $query->the_post();

                 if( $counter == 1 ) {

                       $col = 'col-xl-12 col-lg-12 col-md-12 col-12 overflow-h';
                       $col2 = 'col-xl-8 col-lg-12 col-md-12 col-12 mt-30';
                       $col3 = 'col-xl-4 col-lg-12 col-md-12 col-12 mt-30';
                       $excerpt = '<p class="mt-20">'.get_the_excerpt().'</p>';
                       $title_tag = 'h5';
                       $d_bock = 'd-block';

                    if( $category_layout_style == 'category_layout_2' ){

                        $col = 'col-xl-12 col-lg-12 col-md-12 col-12 overflow-h';
                        $col2 = 'col-xl-12 col-lg-12 col-md-12 col-12 mt-30';
                        $col3 = 'col-xl-12 col-lg-12 col-md-12 col-12 mt-30';
                        $d_bock = 'd-block';

                    } elseif ( $category_layout_style == 'category_layout_3' ){

                        $col = 'col-xl-6 col-lg-12 col-md-12 col-12 overflow-h';
                        $col2 = 'col-xl-12 col-lg-12 col-md-12 col-12 mt-30';
                        $col3 = 'col-xl-12 col-lg-12 col-md-12 col-12 mt-30';
                        $d_bock = 'd-block';

                    }

                    } else {

                           $col = 'col-xl-6 col-lg-12 col-md-12 col-12 overflow-h';
                           $col2 = 'col-xl-5 col-lg-12 col-md-12 col-12 mt-30';
                           $col3 = 'col-xl-7 col-lg-12 col-md-12 col-12 mt-30';
                           $excerpt = '';
                           $title_tag = 'h6';
                           $d_bock = 'd-none';

                        if( $category_layout_style == 'category_layout_2' ){

                           $col = 'col-xl-12 col-lg-12 col-md-12 col-12 overflow-h';
                           $col2 = 'col-xl-6 col-lg-12 col-md-12 col-12 mt-30';
                           $col3 = 'col-xl-6 col-lg-12 col-md-12 col-12 mt-30';
                           $excerpt = '<p class="mt-20">'.get_the_excerpt().'</p>';
                           $d_bock = '';

                        } elseif ( $category_layout_style == 'category_layout_3' ){

                            $excerpt = '<p class="mt-20">'.get_the_excerpt().'</p>';
                            $col2 = 'col-xl-12 col-lg-12 col-md-12 col-12 mt-30';
                            $col3 = 'col-xl-12 col-lg-12 col-md-12 col-12 mt-30';
                            $d_bock = '';

                        }

                    }

                    ?>

                    <div class="<?php echo $col; ?>">
                        <div class="featured-mag-wrapper position-r row">
                            <?php
                            if ( has_post_thumbnail() ) : ?>
                                <div class="featured-thumb <?php echo $col2; ?>">
                                    <a href="<?php echo esc_url( get_the_permalink() ); ?>">
                                        <?php the_post_thumbnail(); ?>
                                    </a>
                                </div>
                            <?php endif; ?>

                            <div class="category-posts-a-contents <?php echo $col3; ?>">
                                <div class="category-bg <?php echo $d_bock; ?>">
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

                                <<?php echo $title_tag;?>>
                                    <a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php the_title(); ?></a>
                                </<?php echo $title_tag;?>>
                                <?php echo $excerpt; ?>
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
        $instance['category_layout_style'] = strip_tags( $new_instance['category_layout_style'] );
        $instance['category_dropdown'] = sanitize_text_field( $new_instance['category_dropdown'] );
        $instance['number'] = (int) $new_instance['number'];

        return $instance;
    }

    public function form( $instance ) {

        $category_layout_style = isset( $instance['category_layout_style'] ) ? esc_attr( $instance['category_layout_style'] ) : 'category_layout_1';

        $category_dropdown  = isset( $instance['category_dropdown'] ) ? esc_attr( $instance['category_dropdown'] ) : '';
        $number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
        ?>

        <p>
        <label for="<?php echo $this->get_field_id('text_area'); ?>">
            <?php _e( 'Select Category Layout Style', 'timagazine' ); ?>
        </label>
        </p>
        <p>
        <label for="<?php echo $this->get_field_id('category_layout_1'); ?>">
            <?php _e('Layout Style 1  ', 'timagazine'); ?>
            <input class="" id="<?php echo $this->get_field_id('category_layout_1'); ?>" name="<?php echo $this->get_field_name('category_layout_style'); ?>" type="radio" value="category_layout_1" <?php if($category_layout_style === 'category_layout_1'){ echo 'checked="checked"'; } ?> />
        </label>
        </p>
        <p>
        <label  for="<?php echo $this->get_field_id('category_layout_2'); ?>">
            <?php _e('Layout Style 2  ', 'timagazine'); ?>
            <input class="" id="<?php echo $this->get_field_id('category_layout_2'); ?>" name="<?php echo $this->get_field_name('category_layout_style'); ?>" type="radio" value="category_layout_2" <?php if($category_layout_style === 'category_layout_2'){ echo 'checked="checked"'; } ?> />
        </label>

        </p>

    <p>
    <label  for="<?php echo $this->get_field_id('category_layout_3'); ?>">
        <?php _e('Layout Style 3  ', 'timagazine'); ?>
        <input class="" id="<?php echo $this->get_field_id('category_layout_3'); ?>" name="<?php echo $this->get_field_name('category_layout_style'); ?>" type="radio" value="category_layout_3" <?php if($category_layout_style === 'category_layout_3'){ echo 'checked="checked"'; } ?> />
    </label>

    </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:', 'timagazine' ); ?></label>
            <input class="tiny-text" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" step="1" min="1" value="<?php echo $number; ?>" size="5" />
        </p>

        <p>
        <label for="<?php echo $this->get_field_id('category_dropdown'); ?>"><?php _e('Choose your category:', 'timagazine'); ?></label>
            <?php $args = array(
                'name'               => $this->get_field_name('category_dropdown'),
                'id'                 => $this->get_field_id('category_dropdown'),
                'class'              => 'chosen-dropdown-1',
                'selected'			=> $category_dropdown,
            ); ?>
            <?php wp_dropdown_categories($args); ?>
        </p>

        <?php
    }
}