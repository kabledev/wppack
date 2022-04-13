<?php

/**
 * WPPack App Posts
 *
 * @see https://github.com/sivankanat/wppack
 * @package wppack
 * @since 1.0.0
 *
 */

class AppPosts extends App
{
    public function __construct()
    {
        // add_action('pre_get_posts', array($this, 'pre_query'), 1);
    }


    /**
     * 
     * @see https://developer.wordpress.org/reference/hooks/pre_get_posts/
     * 
     */
    public function pre_query($query)
    {
        if (!is_admin() && $query->is_main_query()) :
            $query->set('posts_per_page', 8);
            $this->pre_query_filter($query, true);
        endif;
    }


    /**
     * 
     * @uses type NUMERIC, BINARY, CHAR, DATE, DATETIME, DECIMAL, SIGNED, TIME, UNSIGNED. Default is CHAR.
     * 
     */
    protected function pre_query_filter($query, $accept = true)
    {
        if ($accept) :
            if ('GET' == $_SERVER['REQUEST_METHOD'] && isset($_REQUEST['action']) && $_REQUEST['action'] == '_pre_filter') :
                $get  = $_GET;
                $args = array('relation' => 'AND');
                /* meta_query */
                if (isset($get['_filter']) && !empty($get['_filter'])) :
                    $args[] = array(
                        'key'     => '_filter',
                        'value'   => $get['_filter'],
                        'compare' => '=',
                        'type'    => 'CHAR',
                    );
                endif;
                $query->set('meta_query', $args);
            endif;
        endif;
    }

    public static function get_summary($post_id, $limit)
    {
        return wp_trim_words(get_the_excerpt($post_id), $limit);
    }
}
