<?php

/**
 * Description of RTMediaUploadShortcode
 *
 * rtMedia uploader shortcode
 *
 * @author joshua
 */
class RTMediaUploadShortcode {

    static $add_sc_script = false;
    var $deprecated = false;
    static $uploader_displayed = false;

    /**
     *
     */
    public function __construct () {



        add_shortcode ( 'rtmedia_uploader', array( 'RTMediaUploadShortcode', 'pre_render' ) );
        $method_name = strtolower ( str_replace ( 'RTMedia', '', __CLASS__ ) );

        if ( is_callable ( "RTMediaDeprecated::{$method_name}", true, $callable_name ) ) {
            $this->deprecated = RTMediaDeprecated::$method_name ();
        }
    }

    /**
     * Helper function to check whether the shortcode should be rendered or not
     *
     * @return type
     */
    static function display_allowed () {

        $flag = ( ! (is_home () || is_post_type_archive () || is_author ())) && is_user_logged_in () && (is_rtmedia_upload_music_enabled () || is_rtmedia_upload_photo_enabled () || is_rtmedia_upload_video_enabled ());
        $flag = apply_filters ( 'before_rtmedia_uploader_display', $flag );
        return $flag;
    }

    /**
     * Render the uploader shortcode and attach the uploader panel
     *
     * @param type $attr
     */
    static function pre_render ( $attr ) {
        global $post;
        global $rtmedia_query;
        if( !isset($attr['is_up_shortcode']) || $attr['is_up_shortcode'] !== false) {
            $rtmedia_query->is_upload_shortcode = true;// set is_upload_shortcode in rtmedia query as true
        } else {
            $rtmedia_query->is_upload_shortcode = false;// set is_upload_shortcode in rtmedia query as true
        }
        if ( isset ( $attr ) && !empty($attr)) {
            if ( ! is_array ( $attr ) ) {
                $attr = Array( );
            }
            if ( ! isset ( $attr[ "context_id" ] ) && isset ( $post->ID ) ) {
                $attr[ "context_id" ] = $post->ID;
            }
            if ( ! isset ( $attr[ "context" ] ) && isset ( $post->post_type ) ) {
                $attr[ "context" ] = $post->post_type;
            }
        }

        if ( self::display_allowed () || ( isset( $attr['allow_anonymous'] ) && $attr['allow_anonymous'] === true ) ) {
            if ( ! _device_can_upload () ) {
                echo '<p>' . __( 'The web browser on your device cannot be used to upload files.', 'rtmedia' ) . '</p>';
                return;
            }
            ob_start ();

            self::$add_sc_script = true;
            RTMediaUploadTemplate::render ( $attr );

            self::$uploader_displayed = true;
            return ob_get_clean ();
        }
    }

}
