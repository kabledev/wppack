<?php

/* asset */
function _asset($file)
{
  return get_template_directory_uri() . "/" . $file;
}

function tax_field($field, $term)
{
  return get_field($field, $term->taxonomy . '_' . $term->term_id);
}



//

if (!function_exists('_post_count')) :
  function _post_count($pt = "")
  {
    $the_args = array(
      "post_type" => $pt,
      "hide_empty" => false
    );
    $the_query = new WP_Query($the_args);
    wp_reset_query();

    return $the_query->found_posts;
  }
endif;

if (!function_exists('_tax_count')) :
  function _tax_count($term)
  {
    $terms = get_terms($term, array(
      'hide_empty' => false,
      'fields' => 'ids'
    ));

    return count($terms);
  }
endif;

/// check filter
if (!function_exists('_check')) :
  function _check($term)
  {
    $checked = "";
    if (isset($_SESSION['_filter_places']) && isset($_SESSION['_filter_places'][$term->taxonomy])) :
      if (in_array($term->term_id, $_SESSION['_filter_places'][$term->taxonomy])) :
        $checked = "checked";
      endif;
    endif;

    if ($req = get_queried_object()) :
      if ($req->term_id == $term->term_id) :
        $checked = "checked";
      endif;
    endif;
    return $checked;
  }
endif;

///
function _print($data)
{
  echo '<pre>';
  print_r($data);
  echo '</pre>';
}

///
function _array_unique($array, $key)
{
  $temp_array = array();
  $i = 0;
  $key_array = array();

  foreach ($array as $val) {
    if (!in_array($val->$key, $key_array)) {
      $key_array[$i] = $val->$key;
      $temp_array[$i] = $val;
    }
    $i++;
  }
  return $temp_array;
}
