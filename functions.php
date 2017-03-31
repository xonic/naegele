<?php

function get_related_posts( $taxonomy = '', $args = [] ) {
    /*
     * Before we do anything and waste unnecessary time and resources, first check if we are on a single post page
     * If not, bail early and return false
     */
    if ( !is_single() )
        return false;

    /*
     * Check if we have a valid taxonomy and also if the taxonomy exists to avoid bugs further down.
     * Return false if taxonomy is invalid or does not exist
     */
    if ( !$taxonomy )
        return false;

    $taxonomy = filter_var( $taxonomy, FILTER_SANITIZE_STRING );
    if ( !taxonomy_exists( $taxonomy ) )
        return false;

    /*
     * We have made it to here, so we should start getting our stuff togther.
     * Get the current post object to start of
     */
    $current_post = get_queried_object();

    /*
     * Get the post terms, just the ids
     */
    $terms = wp_get_post_terms( $current_post->ID, $taxonomy, ['fields' => 'ids'] );

    /*
     * Lets only continue if we actually have post terms and if we don't have an WP_Error object. If not, return false
     */
    if ( !$terms || is_wp_error( $terms ) )
        return false;

    /*
     * Set the default query arguments
     */
    $defaults = [
        'post_type' => $current_post->post_type,
        'post__not_in' => [$current_post->ID],
        'orderby' => 'rand',
        'tax_query' => [
            [
                'taxonomy' => $taxonomy,
                'terms' => $terms,
                'include_children' => false
            ],
        ],
    ];

    /*
     * Validate and merge the defaults with the user passed arguments
     */
    if ( is_array( $args ) ) {
        $args = wp_parse_args( $args, $defaults );
    } else {
        $args = $defaults;
    }

    /*
     * Now we can query our related posts and return them
     */
    $q = get_posts( $args );

    return $q;
}

// Edit footer text in WP admin section
function remove_footer_admin () {

  echo 'Designed by <a href="http://xon1c.com" target="_blank">xon1c &middot; Tom Nägele</a>';
}

add_filter('admin_footer_text', 'remove_footer_admin');

// Add support for product thumbnails
add_theme_support( 'post-thumbnails' );

// Add custom size for product thumbnails
function add_custom_sizes() {
    add_image_size( 'product-thumb', 300, 400, true );
}
add_action('after_setup_theme','add_custom_sizes');

function naegele_styles() {
    wp_enqueue_style( 'style', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'naegele_styles' );

function register_main_nav() {
  register_nav_menu('main-nav',__( 'Main navigation' ));
}
add_action( 'init', 'register_main_nav' );

function product_category_init() {
  // Add new taxonomy, make it hierarchical (like categories)
  $labels = array(
    'name'              => __('Produktkategorien'),
    'singular_name'     => __('Produktkategorie'),
    'search_items'      => __('Suche Produktkategorie'),
    'all_items'         => __('Alle Produktkategorien'),
    'parent_item'       => __('Übergeordnete Produktkategorie'),
    'parent_item_colon' => __('Übergeordnete Produktkategorie:'),
    'edit_item'         => __('Produktkategorie editieren'),
    'update_item'       => __('Produktkategorie aktualisieren'),
    'add_new_item'      => __('Neue Produktkategorie hinzufügen'),
    'new_item_name'     => __('Neuer Produktkategoriename'),
    'menu_name'         => __('Produktkategorien'),
  );

  $args = array(
    'hierarchical'      => true,
    'labels'            => $labels,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'rewrite'           => array( 'slug' => __('produkt-kategorie')   , 'with_front' => false ),
  );

  register_taxonomy('product_category', array('product'),$args);
}
add_action( 'init', 'product_category_init');

function product_init() {
  $labels = array(
    'name'               => __('Produkte'),
    'singular_name'      => __('Produkt'),
    'menu_name'          => __('Produkte'),
    'name_admin_bar'     => __('Produkt'),
    'add_new'            => __('Neu hinzufügen'),
    'add_new_item'       => __('Neues Produkt hinzufügen'),
    'new_item'           => __('Neues Produkt'),
    'edit_item'          => __('Produkt editieren'),
    'view_item'          => __('Produkt anzeigen'),
    'all_items'          => __('Alle Produkte'),
    'search_items'       => __('Produkte suchen'),
    'parent_item_colon'  => __('Übergeordnetes Produkt'),
    'not_found'          => __('Keine Produkte gefunden'),
    'not_found_in_trash' => __('Keine Produkte im Papierkorb gefunden')
  );

  $args = array(
    'labels'              => $labels,
    'public'              => true,
    'exclude_from_search' => false,
    'publicly_queryable'  => true,
    'show_ui'             => true,
    'show_in_nav_menus'   => true,
    'show_in_menu'        => true,
    'show_in_admin_bar'   => true,
    'menu_position'       => 5,
    'menu_icon'           => 'dashicons-products',
    'capability_type'     => 'post',
    'hierarchical'        => false,
    'supports'            => array( 'title', 'thumbnail' ),
    'has_archive'         => __('produkte'),
    'rewrite'             => array( 'slug' => __('produkt') ),
    'query_var'           => true
  );

  register_post_type( 'product', $args );
}
add_action( 'init', 'product_init');

function employee_init() {
  $labels = array(
    'name'               => __('Mitarbeiter'),
    'singular_name'      => __('Mitarbeiter'),
    'menu_name'          => __('Mitarbeiter'),
    'name_admin_bar'     => __('Mitarbeiter'),
    'add_new'            => __('Neu hinzufügen'),
    'add_new_item'       => __('Neuen Mitarbeiter hinzufügen'),
    'new_item'           => __('Neuer Mitarbeiter'),
    'edit_item'          => __('Mitarbeiter editieren'),
    'view_item'          => __('Mitarbeiter anzeigen'),
    'all_items'          => __('Alle Mitarbeiter'),
    'search_items'       => __('Mitarbeiter suchen'),
    'parent_item_colon'  => __('Übergeordneter Mitarbeiter'),
    'not_found'          => __('Kein Mitarbeiter gefunden'),
    'not_found_in_trash' => __('Kein Mitarbeiter im Papierkorb gefunden')
  );

  $args = array(
    'labels'              => $labels,
    'public'              => true,
    'exclude_from_search' => true,
    'publicly_queryable'  => false,
    'show_ui'             => true,
    'show_in_nav_menus'   => true,
    'show_in_menu'        => true,
    'show_in_admin_bar'   => true,
    'menu_position'       => 5,
    'menu_icon'           => 'dashicons-admin-users',
    'capability_type'     => 'post',
    'hierarchical'        => false,
    'supports'            => array( 'title', 'thumbnail' ),
    'has_archive'         => false,
    'rewrite'             => false,
    'query_var'           => true
  );

  register_post_type( 'employee', $args );
}
add_action( 'init', 'employee_init');

function add_employee_columns($columns) {
  return array_merge($columns,
            array(
              'function' => __('Funktion'),
              'description' => __('Beschreibung'),
              'date' => __('Datum'),
              'author' => __('Autor')
            ));
}
add_filter('manage_employee_posts_columns', 'add_employee_columns');

function manage_employee_columns($column_name, $id) {
  global $wpdb;
    switch ($column_name) {

      case 'function':
          $var = get_post_meta( $id, 'employee_function', true);
          echo $var;
          break;

      case 'description':
          $var = get_post_meta( $id, 'employee_description', true);
          echo $var;
          break;

      default:
          break;
    } // end switch
}
add_action('manage_employee_posts_custom_column', 'manage_employee_columns', 10, 2);

function employee_change_title_text( $title ){
     $screen = get_current_screen();

     if  ( 'employee' == $screen->post_type ) {
          $title = __('Name des Mitarbeiters');
     }

     return $title;
}
add_filter( 'enter_title_here', 'employee_change_title_text' );


?>
