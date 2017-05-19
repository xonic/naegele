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

// Add footer widgets
register_sidebar( array(
  'name' => 'Footer Sidebar 1',
  'id' => 'footer-sidebar-1',
  'description' => 'Appears in the footer area',
  'before_widget' => '<aside id="%1$s" class="widget %2$s">',
  'after_widget' => '</aside>',
  'before_title' => '<h2 class="section__title">',
  'after_title' => '</h2>',
) );
register_sidebar( array(
  'name' => 'Footer Sidebar 2',
  'id' => 'footer-sidebar-2',
  'description' => 'Appears in the footer area',
  'before_widget' => '<aside id="%1$s" class="widget %2$s">',
  'after_widget' => '</aside>',
  'before_title' => '<h2 class="section__title">',
  'after_title' => '</h2>',
) );

// Add support for product thumbnails
add_theme_support( 'post-thumbnails' );

// Add custom size for product thumbnails
function add_custom_sizes() {
    add_image_size( 'product-thumb', 350, 400, true );
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
    'name'              => __('Produktkategorien', 'naegele'),
    'singular_name'     => __('Produktkategorie', 'naegele'),
    'search_items'      => __('Suche Produktkategorie', 'naegele'),
    'all_items'         => __('Alle Produktkategorien', 'naegele'),
    'parent_item'       => __('Übergeordnete Produktkategorie', 'naegele'),
    'parent_item_colon' => __('Übergeordnete Produktkategorie:', 'naegele'),
    'edit_item'         => __('Produktkategorie editieren', 'naegele'),
    'update_item'       => __('Produktkategorie aktualisieren', 'naegele'),
    'add_new_item'      => __('Neue Produktkategorie hinzufügen', 'naegele'),
    'new_item_name'     => __('Neuer Produktkategoriename', 'naegele'),
    'menu_name'         => __('Produktkategorien', 'naegele'),
  );

  $args = array(
    'hierarchical'      => true,
    'labels'            => $labels,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'rewrite'           => array( 'slug' => __('produkt-kategorie', 'naegele')   , 'with_front' => false ),
  );

  register_taxonomy('product_category', array('product'),$args);
}
add_action( 'init', 'product_category_init');

function product_init() {
  $labels = array(
    'name'               => __('Produkte', 'naegele'),
    'singular_name'      => __('Produkt', 'naegele'),
    'menu_name'          => __('Produkte', 'naegele'),
    'name_admin_bar'     => __('Produkt', 'naegele'),
    'add_new'            => __('Neu hinzufügen', 'naegele'),
    'add_new_item'       => __('Neues Produkt hinzufügen', 'naegele'),
    'new_item'           => __('Neues Produkt', 'naegele'),
    'edit_item'          => __('Produkt editieren', 'naegele'),
    'view_item'          => __('Produkt anzeigen', 'naegele'),
    'all_items'          => __('Alle Produkte', 'naegele'),
    'search_items'       => __('Produkte suchen', 'naegele'),
    'parent_item_colon'  => __('Übergeordnetes Produkt', 'naegele'),
    'not_found'          => __('Keine Produkte gefunden', 'naegele'),
    'not_found_in_trash' => __('Keine Produkte im Papierkorb gefunden', 'naegele')
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
    'has_archive'         => true,
    'query_var'           => true
  );

  register_post_type( 'product', $args );
}
add_action( 'init', 'product_init');

function product_change_title_text( $title ){
     $screen = get_current_screen();

     if  ( 'product' == $screen->post_type ) {
          $title = __('Produktname', 'naegele');
     }

     return $title;
}
add_filter( 'enter_title_here', 'product_change_title_text' );

function employee_init() {
  $labels = array(
    'name'               => __('Mitarbeiter', 'naegele'),
    'singular_name'      => __('Mitarbeiter', 'naegele'),
    'menu_name'          => __('Mitarbeiter', 'naegele'),
    'name_admin_bar'     => __('Mitarbeiter', 'naegele'),
    'add_new'            => __('Neu hinzufügen', 'naegele'),
    'add_new_item'       => __('Neuen Mitarbeiter hinzufügen', 'naegele'),
    'new_item'           => __('Neuer Mitarbeiter', 'naegele'),
    'edit_item'          => __('Mitarbeiter editieren', 'naegele'),
    'view_item'          => __('Mitarbeiter anzeigen', 'naegele'),
    'all_items'          => __('Alle Mitarbeiter', 'naegele'),
    'search_items'       => __('Mitarbeiter suchen', 'naegele'),
    'parent_item_colon'  => __('Übergeordneter Mitarbeiter', 'naegele'),
    'not_found'          => __('Kein Mitarbeiter gefunden', 'naegele'),
    'not_found_in_trash' => __('Kein Mitarbeiter im Papierkorb gefunden', 'naegele')
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
              'function' => __('Funktion', 'naegele'),
              'description' => __('Beschreibung', 'naegele'),
              'date' => __('Datum', 'naegele'),
              'author' => __('Autor', 'naegele')
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
          $title = __('Name des Mitarbeiters', 'naegele');
     }

     return $title;
}
add_filter( 'enter_title_here', 'employee_change_title_text' );


?>
