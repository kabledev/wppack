<?php

/**
 * WPPack App Menus
 * 
 * @see https://github.com/sivankanat/wppack
 * @package wppack
 * @since 1.0.0
 *
 */

class AppMenus
{

    public static function check_menu($menu = "")
    {
        if (($locations = get_nav_menu_locations()) && isset($locations[$menu])) {
            $menu  = wp_get_nav_menu_object($locations[$menu]);
            $items = wp_get_nav_menu_items($menu->term_id);
            return $items;
        }
    }

    public static function navbar($menu_id = "")
    {
        $menu  = "";
        $items = self::check_menu($menu_id);
        if ($items) :
            foreach ((array) $items as $item) :
            # $item->url
            # $item->title
            # $item->ID;
            # code ..
            endforeach;
        endif;
        return $menu;
    }

    /* get menu items */
    public static function get_items($menu_id = "")
    {
        $items = self::check_menu($menu_id);
        if ($items) :
            return $items;
        endif;
        return false;
    }

    /* menu title */
    public static function get_title($menu_name = "")
    {
        $title = "NaN!";
        if (($locations = get_nav_menu_locations()) && isset($locations[$menu_name])) :
            $title     = htmlspecialchars_decode(wp_get_nav_menu_object($locations[$menu_name])->name);
        endif;
        return $title;
    }

    /* dispyal html title */
    public static function display_title($name = "")
    {
        if (!empty(self::get_title($name))) :
            echo self::get_title($name);
        else :
            echo '<i class="fas fa-bars"></i><span>Menu</span>';
        endif;
    }
}
