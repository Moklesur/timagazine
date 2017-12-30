<?php
/**
 * Displays Author
 *
 */

class Timagazine_Widget_Ads extends WP_Widget {

    public function __construct() {
        $widget_ops = array(
            'classname' => 'timagazine_widget_ads',
            'description' => __( 'Displays Ads', 'timagazine' ),
            'customize_selective_refresh' => true,
        );
        parent::__construct( 'timagazine-widget-ads', __( 'TM: Ads', 'timagazine' ), $widget_ops );
        $this->alt_option_name = 'timagazine_widget_ads';
    }
    public function widget( $args, $instance )
    {
        if ( !isset( $args['widget_id'] ) ) {
            $args['widget_id'] = $this->id;
        }

        $ads_url = ( !empty($instance['ads_url']) ) ? $instance['ads_url'] : '';
        $image_uri = ( !empty($instance['image_uri']) ) ? $instance['image_uri'] : '';

        echo $args['before_widget'];
            if ( $image_uri ) :
                echo '<div class="widget-ads mb-30"><a href="'. esc_url( $ads_url ) .'"><img src="'. esc_url( $image_uri ) .'" class="ads-image img-responsive" alt=""></a></div>';
            endif;
        echo $args['after_widget'];
    }
    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['ads_url'] = strip_tags( $new_instance['ads_url'] );
        $instance['image_uri'] = strip_tags( $new_instance['image_uri'] );

        return $instance;
    }
    public function form( $instance ) {
        $ads_url     = isset( $instance['ads_url'] ) ? esc_url( $instance['ads_url'] ) : '';
        $image_uri     = isset( $instance['image_uri'] ) ? esc_url( $instance['image_uri'] ) : '';

        ?>
        <div class="timagazine-wrap">
            <div class="full-width">
                <div class="col-6">
                    <h2>
                        <label for="<?php echo $this->get_field_id( 'ads_url' ); ?>"><?php _e( 'Ads URL', 'timagazine' ); ?></label>
                        <input class="widefat" id="<?php echo $this->get_field_id( 'ads_url' ); ?>" name="<?php echo $this->get_field_name( 'ads_url' ); ?>" type="url" value="<?php echo $ads_url; ?>" />
                    </h2>
                </div>
                <div class="col-6">
                    <h2>
                        <label for="<?php echo $this->get_field_id('image_uri'); ?>"><?php _e( 'Upload Ads Image', 'timagazine' ); ?></label>
                        <?php if ( $image_uri ) : ?>
                            <img class="custom_media_image" src="<?php echo $image_uri; ?>" style="margin:0;padding:0;max-width:100px;float:left;display:inline-block" /><br />
                        <?php endif; ?>
                        <input type="text" class="widefat custom_media_url" name="<?php echo $this->get_field_name('image_uri'); ?>" id="<?php echo $this->get_field_id('image_uri'); ?>" value="<?php echo $image_uri; ?>" style="margin-top:5px;">

                        <input type="button" class="button button-primary custom_media_button" id="custom_media_button" value="Upload Image" style="margin-top:5px;" />
                    </h2>
                    <script>
                        jQuery(document).ready( function($) {
                            function media_upload(button_class) {
                                var _custom_media = true,
                                    _orig_send_attachment = wp.media.editor.send.attachment;

                                $('body').on('click', button_class, function(e) {
                                    var button_id ='#'+$(this).attr('id');
                                    var self = $(button_id);
                                    var send_attachment_bkp = wp.media.editor.send.attachment;
                                    var button = $(button_id);
                                    var id = button.attr('id').replace('_button', '');
                                    _custom_media = true;
                                    wp.media.editor.send.attachment = function(props, attachment){
                                        if ( _custom_media  ) {
                                            $('.custom_media_id').val(attachment.id);
                                            $('.custom_media_url').val(attachment.url);
                                            $('.custom_media_image').attr('src',attachment.url).css('display','block');
                                        } else {
                                            return _orig_send_attachment.apply( button_id, [props, attachment] );
                                        }
                                    }
                                    wp.media.editor.open(button);
                                    return false;
                                });
                            }
                            media_upload('.custom_media_button.button');
                        });
                    </script>
                </div>
            </div>
        </div>
        <?php
    }
}