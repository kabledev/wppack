<?php

/**
 * WPPack App
 *
 * @see https://github.com/sivankanat/wppack
 * @package wppack
 * @since 1.0.0
 *
 */

class App
{
    public $textdomain = "wppack";
    public $version;

    public function __construct()
    {
        $this->version = wp_get_theme()->Version;
    }


    public static function uri($path = "")
    {
        return get_template_directory_uri() . "/" . $path;
        /* or get_stylesheet_directory_uri() */
    }

    public static function logo($bool = false)
    {
        if (has_custom_logo()) :
            $custom_logo_id = get_theme_mod('custom_logo');
            $logo_src       = wp_get_attachment_image_src($custom_logo_id, 'full');
            if ($bool) :
                return '<img src="' . $logo_src[0] . '" alt="' . get_bloginfo('name') . '">';
            else :
                return $logo_src[0];
            endif;
        endif;
        return "<h1>Logo</h1>";
    }
}
