<?php

/**
 * WPPack App Setup
 *
 * @see https://github.com/sivankanat/wppack
 * @package wppack
 * @since 1.0.0
 *
 */

class AppSetup extends App
{
    public function __construct()
    {
        add_action('init', array($this, 'setup'));

        add_action('after_setup_theme', array($this, 'custom_logo'));
        add_action('widgets_init', array($this, 'widget_init'));

        // add static pages
        add_action("init", array($this, "add_static_pages"));

        // disable block editor
        // add_filter('use_block_editor_for_post', array($this, 'disable_gutenberg_for_posts'), 10, 2);
    }


    /**
     * setup
     * 
     */
    public function setup()
    {
        load_theme_textdomain($this->textdomain);
        add_theme_support('automatic-feed-links');
        add_theme_support('title-tag');
        add_theme_support('menus');
        show_admin_bar(false);

        add_theme_support('post-thumbnails');
        /* set_post_thumbnail_size(500, 500, array('left', 'top')); */
        add_image_size("custom", 420, 500, array("left", "top"), true);
        add_image_size("custom2", 300, 300, array("left", "top"), true);

        // menus
        register_nav_menus(
            array(
                'navbar'   => __('Navbar Menu', $this->textdomain),
                'footer-1' => __('Footer Menu 1', $this->textdomain),
                'footer-2' => __('Footer Menu 2', $this->textdomain),
                'footer-3' => __('Footer Menu 3', $this->textdomain),
            )
        );

        add_theme_support(
            'html5',
            array(
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
                'widgets',
                'style',
                'script',
            )
        );
    }

    /**
     * Add static pages
     */
    public function add_static_pages()
    {
        $pagelist = array(
            "Home",
            "Blog",
            "Changelog",
            "Test"
        );

        foreach ($pagelist as $pg) :
            if (!get_page_by_title($pg, OBJECT, 'page')) :
                wp_insert_post(array("post_title" => $pg, "post_status" => "publish", "post_type" => "page", "post_content" => "<p></p>"));
            endif;
        endforeach;
    }


    /**
     * @see https://developer.wordpress.org/themes/functionality/custom-logo/
     *  logo */
    public function custom_logo()
    {
        $defaults = array(
            'width'                => 317,
            'height'               => 120,
            'flex-height'          => true,
            'flex-width'           => true,
            'header-text'          => array('site-title', 'site-description'),
            'unlink-homepage-logo' => true,
        );
        add_theme_support('custom-logo', $defaults);
    }

    /* widgets */
    public function widget_init()
    {
        register_sidebar(
            array(
                'name'          => __('Sidebar', $this->textdomain),
                'id'            => 'sidebar',
                'description'   => __('Sidebar', $this->textdomain),
                'before_widget' => '<div id="%1$s" class="widget %2$s mb:lg">',
                'after_widget'  => '</div>',
                'before_title'  => '<h2 class="widget-title">',
                'after_title'   => '</h2>',
            )
        );
    }
    public function disable_gutenberg_for_posts($u, $post)
    {
        if ($post->post_name == "postname") :
            return false;
        endif;
        return true;
    }
}
