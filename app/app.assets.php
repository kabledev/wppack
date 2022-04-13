<?php

/**
 * WPPack App Assets
 * 
 * @see https://github.com/sivankanat/wppack
 * @package wppack
 * @since 1.0.0
 *
 */

class AppAssets extends App
{

    public function __construct()
    {
        // add_action('wp_enqueue_scripts', array($this, 'assets_css'));
        // add_action('wp_enqueue_scripts', array($this, 'assets_js'));

        if (!is_admin()) :
            add_action('wp_print_styles', array($this, 'dequeue_css'));
            add_action('wp_print_scripts', array($this, 'dequeue_js'));

            remove_action('wp_head', 'print_emoji_detection_script', 7);
            remove_action('wp_print_styles', 'print_emoji_styles');
        endif;
    }

    public function assets_css()
    {
        wp_enqueue_style('app-css', self::uri('assets/dist/css/app.css'), array(), $this->version, 'all');
    }

    public function assets_js()
    {
        wp_enqueue_script('app-js', self::uri('assets/dist/js/app.js'), array(), $this->version, true);
    }

    public function add_footer()
    {
        # code ..

    }

    /* dequeue_css */
    public function dequeue_css()
    {
        wp_dequeue_style('wp-block-library');
        wp_deregister_style('wp-block-library');
    }

    /* dequeue js */
    public function dequeue_js()
    {
        wp_dequeue_script('wp-embed');
        wp_deregister_script('wp-embed');
    }
}
