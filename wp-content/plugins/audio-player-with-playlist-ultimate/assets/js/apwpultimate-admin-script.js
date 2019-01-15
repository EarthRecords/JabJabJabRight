jQuery(document).ready(function($) {
	
	$('.apwpultimate-color-box').wpColorPicker();
	
	 // Media Uploader
    $( document ).on( 'click', '.apwpultimate-audio-file-uploader', function() {       
       
            
            var file_frame;
            
            //new media uploader
            var button = jQuery(this);
        
            // If the media frame already exists, reopen it.
            if ( file_frame ) {
                file_frame.open();
              return;
            }
    
            // Create the media frame.
            file_frame = wp.media.frames.file_frame = wp.media({
                frame: 'post',
                state: 'insert',
                title: button.data( 'uploader-title' ),
                button: {
                    text: button.data( 'uploader-button-text' ),
                },
                multiple: false  // Set to true to allow multiple files to be selected
            });
    
            file_frame.on( 'menu:render:default', function(view) {
                // Store our views in an object.
                var views = {};
    
                // Unset default menu items
                view.unset('library-separator');
                view.unset('gallery');
                view.unset('featured-image');
                view.unset('embed');
    
                // Initialize the views in our view object.
                view.set(views);
            });
    
            // When an image is selected, run a callback.
            file_frame.on( 'insert', function() {
    
                // Get selected size from media uploader
                var selected_size = $('.attachment-display-settings .size').val();
                
                var selection = file_frame.state().get('selection');
                selection.each( function( attachment, index ) {
                    attachment = attachment.toJSON();
                    //console.log(attachment);
                    // Selected attachment url from media uploader
                    var artist_name = attachment.meta.artist;
                    //console.log(artist_name);
                    if(artist_name == false){ artist_name = ''; }
                    var attachment_url = attachment.url;
                    $("#apwpultimate-audio-file").val(attachment_url); 
                    $("#apwpultimate-duration").val(attachment.fileLength);
                    $("#apwpultimate-artist-name").val(artist_name);

                    
                });
            });
    
            // Finally, open the modal
            file_frame.open();
        
    });  
	 // Clear Media
    $( document ).on( 'click', '.audio-file-clear', function() {
        $(this).parent().find('.apwpultimate-audio-file').val('');      
    });	
});
