<?php

/**
 * WPPack App Fetch
 *
 * @package wppack
 * @author <sivankanat@gmail.com>
 * @since 1.0.0
 *
 */

class AppFetch
{

  public function __construct()
  {
    // add_action("wp_ajax_fetch_test", array($this, "fetch_test"));
    // add_action("wp_ajax_nopriv_fetch_test", array($this, "fetch_test"));
  }

  /* test */
  public function fetch_test()
  {
    //echo "fetch ok.";
    $request = json_decode(file_get_contents('php://input'), true);
    // end
    wp_die();
  }
}
