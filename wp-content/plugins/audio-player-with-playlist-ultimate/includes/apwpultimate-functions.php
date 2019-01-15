<?php
/**
 * Plugin generic functions file
 *
 * @package audio-player-with-playlist-ultimate
 * @since 1.0.0
 */

 // Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Function to get unique value number
 * 
 * @package audio-player-with-playlist-ultimate
 * @since 1.0
 */
function apwpultimate_get_unique() {
	static $unique = 0;
	$unique++;
	return $unique;
}


/* Convert hexdec color string to rgb(a) string */
 
function hex2rgba($color, $opacity = false) {
 
	$default = 'rgb(0,0,0)';
 
	//Return default if no color provided
	if(empty($color))
          return $default; 
 
	//Sanitize $color if "#" is provided 
        if ($color[0] == '#' ) {
        	$color = substr( $color, 1 );
        }
 
        //Check if color has 6 or 3 characters and get values
        if (strlen($color) == 6) {
                $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
        } elseif ( strlen( $color ) == 3 ) {
                $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
        } else {
                return $default;
        }
 
        //Convert hexadec to rgb
        $rgb =  array_map('hexdec', $hex);
 
        //Check if opacity is set(rgba or rgb)
        if($opacity){
        	if(abs($opacity) > 1)
        		$opacity = 1.0;
        	$output = 'rgba('.implode(",",$rgb).','.$opacity.')';
        } else {
        	$output = 'rgb('.implode(",",$rgb).')';
        }
 
        //Return rgb(a) color string
        return $output;
}

/**
 * Get an option
 * Looks to see if the specified setting exists, returns default if not
 * 
 * @package WP Logo Showcase Responsive Slider Pro
 * @since 1.0.0
 */
function apwpultimate_ultimate_get_option( $key = '', $default = false ) {
	global $apwpultimate_ultimate_options;
	
	$value = ! empty( $apwpultimate_ultimate_options[ $key ] ) ? $apwpultimate_ultimate_options[ $key ] : $default;
	$value = apply_filters( 'apwpultimate_ultimate_get_option', $value, $key, $default );
	return apply_filters( 'apwpultimate_ultimate_get_option_' . $key, $value, $key, $default );
}

/* Function to add array after specific key
 * 
 * @package WP Logo Showcase Responsive Slider Pro
 * @since 1.0.0
 */
function apwpultimate_ultimate_add_array(&$array, $value, $index, $from_last = false) {
    
    if( is_array($array) && is_array($value) ) {

        if( $from_last ) {
            $total_count    = count($array);
            $index          = (!empty($total_count) && ($total_count > $index)) ? ($total_count-$index): $index;
        }
        
        $split_arr  = array_splice($array, max(0, $index));
        $array      = array_merge( $array, $value, $split_arr);
    }
    
    return $array;
}

/**
 * Set Settings Default Option Page
 * 
 * Handles to return all settings value
 * 
 * @package WP Audio Player Pro
 * @since 1.0.0
 */

function apwpultimate_default_settings() {	
	global $apwpultimate_ultimate_options;	
	$theme_color			= ( $apwpultimate_ultimate_options['theme_color'] != '')				? $apwpultimate_ultimate_options['theme_color']			: '#ff6347';
	$playlist_bg_color		= ( $apwpultimate_ultimate_options['playlist_bg_color'] != '')		? $apwpultimate_ultimate_options['playlist_bg_color']		: '#f7f7f7';
	$playlist_font_color	= ( $apwpultimate_ultimate_options['playlist_font_color'] != '')		? $apwpultimate_ultimate_options['playlist_font_color']	: '#000000';
	$audio_title_font_color	= ( $apwpultimate_ultimate_options['audio_title_font_color'] != '')	? $apwpultimate_ultimate_options['audio_title_font_color']: '#ffffff';
	$title_bg_color			= ( $apwpultimate_ultimate_options['title_bg_color'] != '')			? $apwpultimate_ultimate_options['title_bg_color']		: '#000000';
	$audio_title_font_size	= ( $apwpultimate_ultimate_options['audio_title_font_size'] != '')	? $apwpultimate_ultimate_options['audio_title_font_size']	: '22';
	$playlist_font_size		= ( $apwpultimate_ultimate_options['playlist_font_size'] != '')		? $apwpultimate_ultimate_options['playlist_font_size']	: '18';	
	$apwpultimate_ultimate_options = array(
		'theme_color'				=> $theme_color,
		'playlist_bg_color'			=> $playlist_bg_color,
		'playlist_font_color'		=> $playlist_font_color,
		'audio_title_font_color'	=> $audio_title_font_color,
		'title_bg_color'			=> $title_bg_color,
		'audio_title_font_size'		=> $audio_title_font_size,
		'playlist_font_size'		=> $playlist_font_size,
	);
	$default_options = apply_filters('apwpultimate_default_settings', $apwpultimate_ultimate_options );	
	// Update default options
	update_option( 'apwpultimate_ultimate_options', $default_options );
	// Overwrite global variable when option is update
	$wpls_pro_options = apwpultimate_ultimate_get_settings();
}

/**
 * Get Settings From Option Page
 * 
 * Handles to return all settings value
 * 
 * @package WP Logo Showcase Responsive Slider Pro
 * @since 1.0.0
 */
function apwpultimate_ultimate_get_settings() {
	
	$options = get_option('apwpultimate_ultimate_options');
	
	$settings = is_array($options) 	? $options : array();
	
	return $settings;
}

/**
 * Escape Tags & Slashes
 *
 * Handles escapping the slashes and tags
 *
 * @package WP Logo Showcase Responsive Slider Pro
 * @since 1.0.0
 */
function apwpultimate_ultimate_esc_attr($data) {
	return esc_attr( stripslashes($data) );
}

/**
 * Function to get button style type
 * 
 * @package audio-player-with-playlist-ultimate
 * @since 1.0.0
 */
function apwpultimate_player_layout() {
	$player_layout = array(
						'layout-1'			 => __('Layout 1','audio-player-with-playlist-ultimate'),	
					);
	return apply_filters('apwpultimate_player_layout', $player_layout );
}


/**
 * Escape Tags & Slashes
 *
 * Handles escapping the slashes and tags
 *
 * @package audio-player-with-playlist-ultimate
 * @since 1.0.0
 */
function apwpultimate_esc_attr($data) {
    return esc_attr( stripslashes($data) );
}

/**
 * Strip Slashes From Array
 *
 * @package audio-player-with-playlist-ultimate
 * @since 1.0.0
 */
function apwpultimate_ultimate_slashes_deep($data = array(), $flag = false) {
  
    if($flag != true) {
        $data = apwpultimate_nohtml_kses($data);
    }
    $data = stripslashes_deep($data);
    return $data;
}

/**
 * Strip Html Tags 
 * 
 * It will sanitize text input (strip html tags, and escape characters)
 * 
 * @package audio-player-with-playlist-ultimate
 * @since 1.0.0
 */

function apwpultimate_nohtml_kses($data = array()) {
  
  if ( is_array($data) ) {
    
    $data = array_map('apwpultimate_nohtml_kses', $data);
    
  } elseif ( is_string( $data ) ) {
    $data = trim( $data );
    $data = wp_filter_nohtml_kses($data);
  }
  
  return $data;
}

/**
 * Function to add array after specific key
 * 
 * @package audio-player-with-playlist-ultimate
 * @since 1.0.0
 */
function apwpultimate_add_array(&$array, $value, $index, $from_last = false) {

    if( is_array($array) && is_array($value) ) {

        if( $from_last ) {
            $total_count    = count($array);
            $index          = (!empty($total_count) && ($total_count > $index)) ? ($total_count-$index): $index;
        }
        
        $split_arr  = array_splice($array, max(0, $index));
        $array      = array_merge( $array, $value, $split_arr);
    }
    
    return $array;
}
