<?php

if ( preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF']) ) {
     die('You are not allowed to call this page directly.');
}

/**
 * initialize.php - Initialize the post type and set up rewrites
 *
 * @package Featured Content
 * @subpackage includes
 * @author GrandSlambert
 * @copyright 2009-2011
 * @access public
 * @since 0.1
 */
class featuredContentPlugin_Init {

     var $options;
     var $publicForm = false;

     /**
      * Initialize the plugin
      */
     function featuredContentPlugin_Init($options) {
          $this->options = $options;

          $this->pluginPath = WP_PLUGIN_DIR . '/' . basename(dirname(dirname(__FILE__)));
          $this->pluginURL = WP_PLUGIN_URL . '/' . basename(dirname(dirname(__FILE__)));

          add_action('init', array($this, 'create_post_type'));
          add_filter('manage_edit-feature_columns', array(&$this, 'featured_content_edit_columns'));
          add_action('manage_pages_custom_column', array(&$this, 'featured_content_custom_columns'));
          add_filter('post_type_link', array($this, 'post_link'), 10, 3);
     }

     /**
      * Create the post type.
      *
      * @global <object> $wp_rewrite
      */
     function create_post_type() {
          $labels = array(
               'name' => $this->options['plural-name'],
               'singular_name' => $this->options['singular-name'],
               'add_new' => __('Add New', 'featured-content'),
               'add_new_item' => sprintf(__('Add New %1$s', 'featured-content'), $this->options['singular-name']),
               'edit_item' => sprintf(__('Edit %1$s', 'featured-content'), $this->options['singular-name']),
               'edit' => __('Edit', 'featured-content'),
               'new_item' => sprintf(__('New %1$s', 'featured-content'), $this->options['singular-name']),
               'view_item' => sprintf(__('View %1$s', 'featured-content'), $this->options['singular-name']),
               'search_items' => sprintf(__('Search %1$s', 'featured-content'), $this->options['singular-name']),
               'not_found' => sprintf(__('No %1$s found', 'featured-content'), $this->options['plural-name']),
               'not_found_in_trash' => sprintf(__('No %1$s found in Trash', 'featured-content'), $this->options['plural-name']),
               'view' => sprintf(__('View %1$s', 'featured-content'), $this->options['singular-name']),
               'parent_item_colon' => ''
          );
          $args = array(
               'labels' => $labels,
               'public' => true,
               'publicly_queryable' => true,
               'show_ui' => true,
               'query_var' => true,
               'rewrite' => false,
               'capability_type' => 'post',
               'hierarchical' => true,
               'description' => __('Post type created by Featured Content plugin.', 'calendar-press'),
               'menu_position' => 5,
               'menu_icon' => $this->options['menu-icon'],
               'supports' => array('title', 'editor', 'author', 'excerpt'),
               'register_meta_box_cb' => array(&$this, 'init_metaboxes'),
          );

          if ( $this->options['use-custom-fields'] ) {
               $args['supports'][] = 'custom-fields';
          }

          if ( $this->options['use-thumbnails'] ) {
               $args['supports'][] = 'thumbnail';
          }

          if ( $this->options['use-comments'] ) {
               $args['supports'][] = 'comments';
          }

          if ( $this->options['use-trackbacks'] ) {
               $args['supports'][] = 'trackbacks';
          }

          if ( $this->options['use-revisions'] ) {
               $args['supports'][] = 'revisions';
          }

          if ( $this->options['use-taxonomies'] ) {
               $args['taxonomies'] = array('category', 'post_tag');
          }

          register_post_type('feature', $args);

          /* Flush the rewrite rules */
          global $wp_rewrite;
          $this->featured_content_rewrite_rules(array('identifier' => $this->options['identifier'], 'structure' => $this->options['permalink'], 'type' => 'feature'));

          if ( isset($this->options['use-form']) and $this->options['use-form'] ) {
               $this->featured_content_rewrite_rules(array('identifier' => $this->options['form-identifier'], 'structure' => $this->options['form-permalink'], 'type' => 'form'));
          }

          $wp_rewrite->flush_rules();
     }

     /**
      * Rewrite rules for custom feature permalinks.
      *
      * @global  $wp_rewrite
      * @param array $permastructure (identifier, structure, type)
      */
     function featured_content_rewrite_rules($permastructure) {
          global $wp_rewrite;
          $structure = $permastructure['structure'];
          $front = substr($structure, 0, strpos($structure, '%'));
          $type_query_var = 'feature';
          $structure = str_replace('%identifier%', $permastructure['identifier'], $structure);
          $rewrite_rules = $wp_rewrite->generate_rewrite_rules($structure, EP_NONE, true, true, true, true, true);

          //build a rewrite rule from just the identifier if it is the first token
          preg_match('/%.+?%/', $permastructure['structure'], $tokens);
          if ( $tokens[0] == '%identifier%' ) {
               $rewrite_rules = array_merge($wp_rewrite->generate_rewrite_rules($front . $permastructure['identifier'] . '/'), $rewrite_rules);
               $rewrite_rules[$front . $permastructure['identifier'] . '/?$'] = 'index.php?paged=1';
          }

          foreach ( $rewrite_rules as $regex => $redirect ) {
               if ( strpos($redirect, 'attachment=') === false ) {
                    //don't set the post_type for attachments

                    $redirect .= '&post_type=feature';
               }

               if ( 0 < preg_match_all('@\$([0-9])@', $redirect, $matches) ) {
                    for ( $i = 0; $i < count($matches[0]); $i++ ) {
                         $redirect = str_replace($matches[0][$i], '$matches[' . $matches[1][$i] . ']', $redirect);
                    }
               }

               $redirect = str_replace('name=', $type_query_var . '=', $redirect);

               add_rewrite_rule($regex, $redirect, 'top');
          }
     }

     /**
      * Permalink handling for post_type
      *
      * @param string $permalink
      * @param object $post
      * @param bool $leavename
      * @return string
      */
     public function post_link($permalink, $id, $leavename = false) {
          if ( is_object($id) && isset($id->filter) && 'sample' == $id->filter ) {
               $post = $id;
          } else {
               $post = &get_post($id);
          }

          if ( empty($post->ID) || $post->post_type != 'feature' )
               return $permalink;

          $rewritecode = array(
               '%identifier%',
               '%year%',
               '%monthnum%',
               '%day%',
               '%hour%',
               '%minute%',
               '%second%',
               $leavename ? '' : '%postname%',
               '%post_id%',
               '%category%',
               '%author%',
               $leavename ? '' : '%pagename%',
          );

          $permastructure = array('identifier' => $this->options['identifier'], 'structure' => $this->options['permalink']);
          $identifier = $permastructure['identifier'];
          $permalink = $permastructure['structure'];
          if ( '' != $permalink && !in_array($post->post_status, array('draft', 'pending', 'auto-draft')) ) {
               $unixtime = strtotime($post->post_date);

               $category = '';
               if ( strpos($permalink, '%category%') !== false ) {
                    $cats = get_the_category($post->ID);
                    if ( $cats ) {
                         usort($cats, '_usort_terms_by_ID'); // order by ID
                         $category = $cats[0]->slug;
                         if ( $parent = $cats[0]->parent )
                              $category = get_category_parents($parent, false, '/', true) . $category;
                    }
                    // show default category in permalinks, without
                    // having to assign it explicitly
                    if ( empty($category) ) {
                         $default_category = get_category(get_option('default_category'));
                         $category = is_wp_error($default_category) ? '' : $default_category->slug;
                    }
               }

               $author = '';
               if ( strpos($permalink, '%author%') !== false ) {
                    $authordata = get_userdata($post->post_author);
                    $author = $authordata->user_nicename;
               }

               $date = explode(" ", date('Y m d H i s', $unixtime));
               $rewritereplace =
                       array(
                            $identifier,
                            $date[0],
                            $date[1],
                            $date[2],
                            $date[3],
                            $date[4],
                            $date[5],
                            $post->post_name,
                            $post->ID,
                            $category,
                            $author,
                            $post->post_name,
               );
               $permalink = home_url(str_replace($rewritecode, $rewritereplace, $permalink));
               $permalink = user_trailingslashit($permalink, 'single');
          } else {
               $permalink = home_url('?p=' . $post->ID . '&post_type=' . urlencode('feature'));
          }
          return $permalink;
     }

     /**
      * Add extra columns to the edit features page.
      *
      * @param <array> $columns  Current columns.
      * @return <array>
      */
     function featured_content_edit_columns($columns) {
          $columns = array(
               'cb' => '<input type="checkbox" />',
               'thumbnail' => 'Image',
               'title' => 'feature Title',
               'intro' => 'Introduction',
               'author' => 'Author',
          );

          if ( $this->options['use-comments'] ) {
               $columns['comments'] = '<img src="' . get_option('siteurl') . '/wp-admin/images/comment-grey-bubble.png" alt="Comments">';
          }

          $columns['date'] = 'Date';

          return $columns;
     }

     /**
      * Display the content of the custom columns.
      *
      * @global <object> $post
      * @param <string> $column      Name of the column
      * @return <string>
      */
     function featured_content_custom_columns($column) {
          global $post, $featuredContentPlugin;

          if ( $post->post_type != 'feature' ) {
               return;
          }

          switch ($column) {
               case 'thumbnail':
                    if ( function_exists('has_post_thumbnail') && has_post_thumbnail() ) {
                         the_post_thumbnail('featured-content-thumb');
                    }
                    break;
               case 'intro':
                    echo $featuredContentPlugin->trim_excerpt($post->post_excerpt, 25);
                    break;
          }
     }

     /**
      * Adds additional meta boxes to the feature edit screen.
      */
     function init_metaboxes() {
          /* None at this time */
     }

}
