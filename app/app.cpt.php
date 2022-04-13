<?php

/**
 * WPPack Custom post types and meta boxes
 *
 * @package wppack
 * @author <sivankanat@gmail.com>
 * @since 1.0.1
 * 
 *  supports: "title", "editor", "thumbnail", "excerpt", "trackbacks", "custom-fields", "comments", "revisions", "author", "page-attributes", "post-formats"
 *
 */

class AppCPT extends App
{

  public function __construct()
  {
    add_action('init', array($this, 'cpt_register'));
    if (is_admin()) :
    endif;
  }

  public function cpt_register()
  {
    register_post_type("book", $this->cpt_conf(array(
      "label" => "My Books", // Menude görünen
      "plural" => "Books", // eg: All Books
      "single" => "Book", // eg: All Books
      "slug" => "book", // eg: site.com/book/
      "has_archive" => true, // site.com/pacel arşiv sayfası
      "menu_icon" => "dashicons-heart",
      "supports" => ["title", "editor", "thumbnail", "excerpt", "trackbacks", "custom-fields", "comments", "revisions", "author", "page-attributes", "post-formats"]
    )));

    register_taxonomy("actor", ["book"], $this->tax_conf(array(
      "plural" => "Actors",
      "single" => "Actor",
      "slug" => "actor",
      "hierarchical" => true,
      "show_admin_col" => true
    )));
  }

  public function cpt_conf($opts = [])
  {
    $opts = (object) $opts;
    $args =  array(
      "label" => __("Books", $this->textdomain),
      "labels" => [
        "name" => __($opts->plural, $this->textdomain),
        "singular_name" => __($opts->single, $this->textdomain),
        "menu_name" => __($opts->plural, $this->textdomain),
        "all_items" => __("All $opts->plural", $this->textdomain),
        "add_new" => __("Add new", $this->textdomain),
        "add_new_item" => __("Add new $opts->single", $this->textdomain),
        "edit_item" => __("Edit $opts->single", $this->textdomain),
        "new_item" => __("New $opts->single", $this->textdomain),
        "view_item" => __("View $opts->single", $this->textdomain),
        "view_items" => __("View $opts->plural", $this->textdomain),
        "search_items" => __("Search $opts->plural", $this->textdomain),
        "not_found" => __("No $opts->plural found", $this->textdomain),
        "not_found_in_trash" => __("No $opts->plural found in trash", $this->textdomain),
        "parent" => __("Parent $opts->single:", $this->textdomain),
        "featured_image" => __("Featured image for this $opts->single", $this->textdomain),
        "set_featured_image" => __("Set featured image for this $opts->single", $this->textdomain),
        "remove_featured_image" => __("Remove featured image for this $opts->single", $this->textdomain),
        "use_featured_image" => __("Use as featured image for this $opts->single", $this->textdomain),
        "archives" => __("$opts->single archives", $this->textdomain),
        "insert_into_item" => __("Insert into $opts->single", $this->textdomain),
        "uploaded_to_this_item" => __("Upload to this $opts->single", $this->textdomain),
        "filter_items_list" => __("Filter $opts->plural list", $this->textdomain),
        "items_list_navigation" => __("$opts->plural list navigation", $this->textdomain),
        "items_list" => __("$opts->plural list", $this->textdomain),
        "attributes" => __("$opts->plural attributes", $this->textdomain),
        "name_admin_bar" => __($opts->single, $this->textdomain),
        "item_published" => __("$opts->single published", $this->textdomain),
        "item_published_privately" => __("$opts->single published privately.", $this->textdomain),
        "item_reverted_to_draft" => __("$opts->single reverted to draft.", $this->textdomain),
        "item_scheduled" => __("$opts->single scheduled", $this->textdomain),
        "item_updated" => __("$opts->single updated.", $this->textdomain),
        "parent_item_colon" => __("Parent $opts->single:", $this->textdomain),
      ],
      "description" => "",
      "public" => true,
      "publicly_queryable" => true,
      "show_ui" => true,
      "show_in_rest" => true,
      "rest_base" => "",
      "rest_controller_class" => "WP_REST_Posts_Controller",
      "has_archive" => $opts->has_archive,
      "show_in_menu" => true,
      "show_in_nav_menus" => true,
      "delete_with_user" => false,
      "exclude_from_search" => false,
      "capability_type" => "post",
      "map_meta_cap" => true,
      "hierarchical" => false,
      "can_export" => false,
      "rewrite" => ["slug" => $opts->slug, "with_front" => true],
      "query_var" => true,
      "menu_icon" => $opts->menu_icon,
      "supports" => $opts->supports,
      "show_in_graphql" => false,
    );
    return $args;
  }

  /**
   * Taxonomy: Actors.
   */
  public function  tax_conf($conf = [])
  {
    $conf = (object) $conf;
    $args = [
      "label" => __($conf->plural, $this->textdomain),
      "labels" => [
        "name" => __($conf->plural, $this->textdomain),
        "singular_name" => __($conf->single, $this->textdomain),
        "menu_name" => __($conf->plural, $this->textdomain),
        "all_items" => __("All $conf->plural", $this->textdomain),
        "edit_item" => __("Edit $conf->single", $this->textdomain),
        "view_item" => __("View $conf->single", $this->textdomain),
        "update_item" => __("Update $conf->single name", $this->textdomain),
        "add_new_item" => __("Add new $conf->single", $this->textdomain),
        "new_item_name" => __("New $conf->single name", $this->textdomain),
        "parent_item" => __("Parent $conf->single", $this->textdomain),
        "parent_item_colon" => __("Parent $conf->single:", $this->textdomain),
        "search_items" => __("Search $conf->plural", $this->textdomain),
        "popular_items" => __("Popular $conf->plural", $this->textdomain),
        "separate_items_with_commas" => __("Separate $conf->plural with commas", $this->textdomain),
        "add_or_remove_items" => __("Add or remove $conf->plural", $this->textdomain),
        "choose_from_most_used" => __("Choose from the most used $conf->plural", $this->textdomain),
        "not_found" => __("No $conf->plural found", $this->textdomain),
        "no_terms" => __("No $conf->plural", $this->textdomain),
        "items_list_navigation" => __("$conf->plural list navigation", $this->textdomain),
        "items_list" => __("$conf->plural list", $this->textdomain),
        "back_to_items" => __("Back to $conf->plural", $this->textdomain),
        "name_field_description" => __("The name is how it appears on your site.", $this->textdomain),
        "parent_field_description" => __("Assign a parent term to create a hierarchy. The term Jazz, for example, would be the parent of Bebop and Big Band.", $this->textdomain),
        "slug_field_description" => __("The slug is the URL-friendly version of the name. It is usually all lowercase and contains only letters, numbers, and hyphens.", $this->textdomain),
        "desc_field_description" => __("The description is not prominent by default; however, some themes may show it.", $this->textdomain),
      ],
      "public" => true,
      "publicly_queryable" => true,
      "hierarchical" =>  $conf->hierarchical,
      "show_ui" => true,
      "show_in_menu" => true,
      "show_in_nav_menus" => true,
      "query_var" => true,
      "rewrite" => ['slug' => $conf->slug, 'with_front' => true,],
      "show_admin_column" => $conf->show_admin_col,
      "show_in_rest" => true,
      "show_tagcloud" => false,
      "rest_base" => $conf->slug,
      "rest_controller_class" => "WP_REST_Terms_Controller",
      "show_in_quick_edit" => false,
      "sort" => false,
      "show_in_graphql" => false,
    ];
    return $args;
  }
}
