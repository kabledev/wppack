<?php

/**
 * WPPack meta boxes
 *
 * @package wppack
 * @author <sivankanat@gmail.com>
 * @since 1.0.1
 *
 */

class AppMetabox extends App
{

  public function __construct()
  {

    // if (is_admin()) :
    //     add_action('add_meta_boxes', array($this, 'create_meta_box'));
    //     add_action('save_post', array($this, 'save_meta_box'));
    // endif;

  }
  /**
   * 
   * Meta Boxes
   * 
   * @uses change post types [post_type_1, post_type_2]
   * 
   */
  public function create_meta_box()
  {
    $post_types = array('post');
    return add_meta_box(
      'wppack_fields_meta_box',
      'WPPack Custom Fields',
      array($this, 'render_meta_box'),
      $post_types,
      'advanced',
      'high'
    );
  }
  public function render_meta_box()
  {
    global $post;
    /* $meta  = ($x = get_post_meta($post->ID, 'wppack_fields', true)) ? $x : []; */
    $nonce = wp_create_nonce(basename(__FILE__));
    echo '<input type="hidden" name="wppack_fields_nonce" value="' . $nonce . '">';
    $the_post_type = $post->post_type; /* get the post type */

    /* create post type folder in the dir */
    include PARTDIR . '/metabox//' . $the_post_type . '/table.php';
  }

  public function save_meta_box($post_id)
  {
    if (isset($_POST['wppack_fields'])) :

      if (!wp_verify_nonce($_POST['wppack_fields_nonce'], basename(__FILE__))) :
        return $post_id;
      endif;

      if (!current_user_can('edit_post', $post_id)) :
        return $post_id;
      endif;

      foreach ($_POST['wppack_fields'] as $key => $val) :
        update_post_meta($post_id, $key, $val);
      endforeach;

    endif;
  }
  public static function getmeta($key)
  {
    global $post;
    $meta = get_post_meta($post->ID, $key, true);
    if ($meta) :
      return $meta;
    endif;
    return "";
  }
  public function get_all_meta()
  {
    global $post;
    $meta = get_post_meta($post->ID);
    return $meta;
  }
  public static function __editor($cont, $id, $args = [])
  {
    $set = ['editor_height' => 105, 'textarea_rows' => 50, "media_buttons" => false];
    return wp_editor($cont, $id, $set);
  }
}
