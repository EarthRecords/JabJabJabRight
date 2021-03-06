<?php
/*
* Pinacle Image Widget for compatiblity
*/

if ( ! class_exists( 'kad_image_widget' ) ) {
	class kad_image_widget extends WP_Widget{

	private static $instance = 0;
    public function __construct() {
        $widget_ops = array('classname' => 'kadence_simple_image', 'description' => __('This allows for an image and a simple about text.', 'virtue-toolkit'));
        parent::__construct('kadence_simple_image', __('Pinnacle: Image', 'virtue-toolkit'), $widget_ops);
    }

    public function widget($args, $instance){ 
        extract( $args );
        if (!empty($instance['image_link_open']) && $instance['image_link_open'] == "none") {
          $uselink = false;
          $link = '';
          $linktype = '';
        } else if(empty($instance['image_link_open']) || $instance['image_link_open'] == "lightbox") {
          $uselink = true;
          $link = esc_url($instance['image_uri']);
          $linktype = 'data-rel="lightbox"';
        } else if($instance['image_link_open'] == "_blank") {
          $uselink = true;
          if(!empty($instance['image_link'])) {$link = $instance['image_link'];} else {$link = esc_url($instance['image_uri']);}
          $linktype = 'target="_blank"';
        } else if($instance['image_link_open'] == "_self") {
          $uselink = true;
          if(!empty($instance['image_link'])) {$link = $instance['image_link'];} else {$link = esc_url($instance['image_uri']);}
          $linktype = 'target="_self"';
        }
        $image_id = attachment_url_to_postid( $instance['image_uri'] );
        if(isset($image_id) && $image_id != '0') {
          $alt_text = get_post_meta($image_id, '_wp_attachment_image_alt', true);
        } else {
          $alt_text = '';
        }
    ?>
     <?php echo $before_widget; ?>
    <div class="kad_img_upload_widget">
        <?php if($uselink == true) {echo '<a href="'.esc_url($link).'" '.$linktype.'>';} ?>
        <img src="<?php echo esc_url($instance['image_uri']); ?>" alt="<?php echo esc_attr($alt_text); ?>" />
        <?php if($uselink == true) {echo '</a>'; }?>
        <?php if(!empty($instance['text'])) { ?> <p class="kadence_image_widget_caption"><?php echo esc_html($instance['text']); ?></p><?php }?>
    </div>

    <?php echo $after_widget; ?>
    <?php }

  public function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['text'] = strip_tags( $new_instance['text'] );
        $instance['image_uri'] = strip_tags( $new_instance['image_uri'] );
        $instance['image_link'] = $new_instance['image_link'];
        $instance['image_link_open'] = $new_instance['image_link_open'];

        return $instance;
    }

  public function form($instance){ 
    $image_uri = isset($instance['image_uri']) ? esc_attr($instance['image_uri']) : '';
    $image_link = isset($instance['image_link']) ? esc_attr($instance['image_link']) : '';
    if (isset($instance['image_link_open'])) { $image_link_open = esc_attr($instance['image_link_open']); } else {$image_link_open = 'lightbox';}
    $link_options = array();
    $link_options_array = array();
    $link_options[] = array("slug" => "lightbox", "name" => __('Lightbox', 'virtue-toolkit'));
    $link_options[] = array("slug" => "_blank", "name" => __('New Window', 'virtue-toolkit'));
    $link_options[] = array("slug" => "_self", "name" => __('Same Window', 'virtue-toolkit'));
    $link_options[] = array("slug" => "none", "name" => __('No Link', 'virtue-toolkit'));

    foreach ($link_options as $link_option) {
      if ($image_link_open == $link_option['slug']) { $selected=' selected="selected"';} else { $selected=""; }
      $link_options_array[] = '<option value="' . $link_option['slug'] .'"' . $selected . '>' . $link_option['name'] . '</option>';
    }
    ?>
  <div class="kad_img_upload_widget">
    <p>
        <img class="kad_custom_media_image" src="<?php if(!empty($instance['image_uri'])){echo $instance['image_uri'];} ?>" style="margin:0;padding:0;max-width:100px;display:block" />
    </p>
    <p>
        <label for="<?php echo $this->get_field_id('image_uri'); ?>"><?php _e('Image URL', 'virtue-toolkit'); ?></label><br />
        <input type="text" class="widefat kad_custom_media_url" name="<?php echo $this->get_field_name('image_uri'); ?>" id="<?php echo $this->get_field_id('image_uri'); ?>" value="<?php echo $image_uri; ?>">
        <input type="button" value="<?php _e('Upload', 'virtue-toolkit'); ?>" class="button kad_custom_media_upload" id="kad_custom_image_uploader" />
    </p>
    <p>
        <label for="<?php echo $this->get_field_id('image_link_open'); ?>"><?php _e('Image opens in', 'virtue-toolkit'); ?></label><br />
        <select id="<?php echo $this->get_field_id('image_link_open'); ?>" name="<?php echo $this->get_field_name('image_link_open'); ?>"><?php echo implode('', $link_options_array);?></select>
    </p>
    <p>
        <label for="<?php echo $this->get_field_id('image_link'); ?>"><?php _e('Image Link (optional)', 'virtue-toolkit'); ?></label><br />
        <input type="text" class="widefat kad_img_widget_link" name="<?php echo $this->get_field_name('image_link'); ?>" id="<?php echo $this->get_field_id('image_link'); ?>" value="<?php echo $image_link; ?>">
    </p>
    <p>
      <label for="<?php echo $this->get_field_id('text'); ?>"><?php _e('Text/Caption (optional)', 'virtue-toolkit'); ?></label><br />
      <textarea name="<?php echo $this->get_field_name('text'); ?>" id="<?php echo $this->get_field_id('text'); ?>" class="widefat" ><?php if(!empty($instance['text'])) echo $instance['text']; ?></textarea>
    </p>
  </div>
    <?php
  }


}

}