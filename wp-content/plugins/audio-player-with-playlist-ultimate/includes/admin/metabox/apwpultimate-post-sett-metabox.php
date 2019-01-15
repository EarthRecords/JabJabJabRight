<?php
/**
 * Handles Post Setting metabox HTML
 *
 * @package Buttons With Style Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

global $post, $wp_version;

// Taking some variables
$prefix 					= APWPULTIMATE_META_PREFIX; // Metabox prefix

// Getting saved values
$artist_name 			= get_post_meta( $post->ID, $prefix.'artist_name', true );
$audio_file  			= get_post_meta( $post->ID, $prefix.'audio_file', true );
$duration				= get_post_meta( $post->ID, $prefix.'duration', true );

?>
<table class="form-table apwpultimate-post-sett-tbl">
	<tbody>
		
		<tr>
			<th>
				<?php _e('Upload Audio File','audio-player-with-playlist-ultimate');?>
						</th>
						<td>
							<input type="text" name="<?php echo $prefix.'audio_file';?>" value="<?php echo $audio_file;?>" id="apwpultimate-audio-file" class="regular-text apwpultimate-audio-file" />
							<input type="button" name="banner_default_img" class="button-secondary apwpultimate-audio-file-uploader" value="<?php _e( 'Upload audio file', 'audio-player-with-playlist-ultimate'); ?>" />
							<input type="button" name="popu_default_file_clear" id="audio-default-file-clear" class="button button-secondary audio-file-clear" value="<?php _e( 'Clear', 'audio-player-with-playlist-ultimate'); ?>" /> <br />
							<span class="description"><?php _e( 'Upload audio file.','audio-player-with-playlist-ultimate' ); ?></span>
							
						</td>
		</tr>	
		<!-- artist_name -->	
		<tr valign="top">
			<th scope="row">
				<label for="apwpultimate-artist-name"><?php _e('Artist Name', 'audio-player-with-playlist-ultimate'); ?></label>
			</th>
			<td class="row-meta">			
				<input type="text" name="<?php echo $prefix;?>artist_name" id="apwpultimate-artist-name" value="<?php echo $artist_name; ?>" class="regular-text" placeholder="<?php _e('Ninja', 'audio-player-with-playlist-ultimate'); ?>" /><br/>
				<span class="description"><?php _e('Enter artist name', 'audio-player-with-playlist-ultimate'); ?></span>
			</td>			
		</tr>
		<!-- artist_name -->	
		<tr valign="top">
			<th scope="row">
				<label for="apwpultimate-duration"><?php _e('Audio Duration', 'audio-player-with-playlist-ultimate'); ?></label>
			</th>
			<td class="row-meta">			
				<input type="text" name="<?php echo $prefix;?>duration" id="apwpultimate-duration" value="<?php echo $duration; ?>" class="regular-text" placeholder="<?php _e('3:30', 'audio-player-with-playlist-ultimate'); ?>" /><br/>
				<span class="description"><?php _e('Enter audio duration', 'audio-player-with-playlist-ultimate'); ?></span>
			</td>			
		</tr>
	
		
	</tbody>
</table><!-- end .apwpultimate-post-sett-tbl -->
