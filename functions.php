<?php

function naegele_styles() {
    wp_enqueue_style( 'style', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'naegele_styles' );

function register_main_nav() {
  register_nav_menu('main-nav',__( 'Main navigation' ));
}
add_action( 'init', 'register_main_nav' );

class product {

	function product() {
		add_action('init',array($this,'create_post_type'));
		add_action('init',array($this,'create_taxonomies'));
		// add_action('manage_product_posts_columns',array($this,'columns'),10,2);
		// add_action('manage_product_posts_custom_column',array($this,'column_data'),11,2);
		// add_filter('posts_join',array($this,'join'),10,1);
		// add_filter('posts_orderby',array($this,'set_default_sort'),20,2);
	}

	function create_post_type() {
		$labels = array(
			'name'               => 'Products',
			'singular_name'      => 'Product',
			'menu_name'          => 'Products',
			'name_admin_bar'     => 'Product',
			'add_new'            => 'Add New',
			'add_new_item'       => 'Add New Product',
			'new_item'           => 'New Product',
			'edit_item'          => 'Edit Product',
			'view_item'          => 'View Product',
			'all_items'          => 'All Products',
			'search_items'       => 'Search Products',
			'parent_item_colon'  => 'Parent Product',
			'not_found'          => 'No Products Found',
			'not_found_in_trash' => 'No Products Found in Trash'
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
			'supports'            => array( 'title', 'editor', 'author', 'thumbnail', 'custom-fields' ),
			'has_archive'         => true,
			'rewrite'             => array( 'slug' => 'products' ),
			'query_var'           => true
		);

		register_post_type( 'product', $args );
	}

	function create_taxonomies() {

		// Add new taxonomy, make it hierarchical (like categories)
		$labels = array(
			'name'              => 'Product Categories',
			'singular_name'     => 'Product Category',
			'search_items'      => 'Search Product Categories',
			'all_items'         => 'All Product Categories',
			'parent_item'       => 'Parent Product Category',
			'parent_item_colon' => 'Parent Product Category:',
			'edit_item'         => 'Edit Product Category',
			'update_item'       => 'Update Product Category',
			'add_new_item'      => 'Add New Product Category',
			'new_item_name'     => 'New Product Category Name',
			'menu_name'         => 'Product Categories',
		);

		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'category' ),
		);

		register_taxonomy('product_category',array('product'),$args);

		// Add new taxonomy, NOT hierarchical (like tags)
		$labels = array(
			'name'                       => 'Product Tags',
			'singular_name'              => 'Product Tag',
			'search_items'               => 'Product Tags',
			'popular_items'              => 'Popular Product Tags',
			'all_items'                  => 'All Product Tags',
			'parent_item'                => null,
			'parent_item_colon'          => null,
			'edit_item'                  => 'Edit Product Tag',
			'update_item'                => 'Update Product Tag',
			'add_new_item'               => 'Add New Product Tag',
			'new_item_name'              => 'New Product Tag Name',
			'separate_items_with_commas' => 'Separate Product Tag with commas',
			'add_or_remove_items'        => 'Add or remove Product Tags',
			'choose_from_most_used'      => 'Choose from most used Product Tags',
			'not_found'                  => 'No Product Tags found',
			'menu_name'                  => 'Product Tags',
		);

		$args = array(
			'hierarchical'          => false,
			'labels'                => $labels,
			'show_ui'               => true,
			'show_admin_column'     => true,
			'update_count_callback' => '_update_post_term_count',
			'query_var'             => true,
			'rewrite'               => array( 'slug' => 'tag' ),
		);

		register_taxonomy('product_attribute','product',$args);
	}

	function columns($columns) {
		unset($columns['date']);
		unset($columns['taxonomy-product_category']);
		unset($columns['comments']);
		unset($columns['author']);
		return array_merge(
			$columns,
			array(
				'sm_awards' => 'Awards',
				'sm_timeframe' => 'Timeframe'
			));
	}

	function column_data($column,$post_id) {
		switch($column) {
			case 'sm_awards' :
				echo get_post_meta($post_id,'awards',1);
				break;
			case 'sm_timeframe' :
				echo get_post_meta($post_id,'timeframe',1);
				break;
		}
	}

	function join($wp_join) {
		global $wpdb;
		if(get_query_var('post_type') == 'product') {
			$wp_join .= " LEFT JOIN (
					SELECT post_id, meta_value AS awards
					FROM $wpdb->postmeta
					WHERE meta_key = 'awards' ) AS meta
					ON $wpdb->posts.ID = meta.post_id ";
		}
		return ($wp_join);
	}

	function set_default_sort($orderby,&$query) {
		global $wpdb;
		if(get_query_var('post_type') == 'product') {
			return "meta.awards DESC";
		}
	 	return $orderby;
	}
}

new product();
?>
