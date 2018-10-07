<?php
function scratch_enqueue_scripts(){
  wp_enqueue_style('style', get_stylesheet_uri());
  // wp_enqueue_script('script-name', get_template_directory_uri());
}
function register_sidebar_locations() {
  register_sidebar(
    array(
      'id'            => 'primary-sidebar',
      'name'          => __( 'Primary Sidebar' ),
      'description'   => __( 'Main sidebar displaying the usual post info' ),
      'before_widget' => '<div id="%1$s" class="widget %2$s">',
      'after_widget'  => '</div>',
      'before_title'  => '<h3 class="widget-title">',
      'after_title'   => '</h3>',
    )
  );
}
add_action( 'widgets_init', 'register_sidebar_locations' );
add_action('wp_enqueue_scripts', 'scratch_enqueue_scripts');
function tx_allergen() {
	$labels = array(
		'name' => _x( 'Allergens', 'Taxonomy General Name', 'text_domain' ),
		'singular_name' => _x( 'Allergen', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name' => __( 'Allergen', 'text_domain' )
	);
	$args = array(
		'labels' => $labels,
		'hierarchical' => true
	);
	register_taxonomy( 'tx_allergen', array( 'recipe' ), $args );
}
add_action( 'init', 'tx_allergen', 0 );
function tx_difficulty() {
	$labels = array(
		'name' => _x( 'Difficulties', 'Taxonomy General Name', 'text_domain' ),
		'singular_name' => _x( 'Difficulty', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name' => __( 'Difficulty', 'text_domain' )
	);
	$args = array(
		'labels' => $labels,
    'hierarchical' => true
	);
	register_taxonomy( 'tx_difficulty', array( 'recipe' ), $args );
}
add_action( 'init', 'tx_difficulty', 0 );
#register recipes
function manatran_register_recipes(){
  $labels = array(
    'name' => __('Recipes', 'manatran'),
    'singular_name' => __('Recipe', 'manatran'),
    'add_new' => __('Add new recipe', 'manatran'),
    'all_items' => __('All recipes', 'manatran'),
    'add_new_item' => __('Add new recipe', 'manatran'),
    'edit_item' => __('Edit recipe', 'manatran'),
    'new_item' => __('New recipe', 'manatran'),
    'view_item' => __('View recipe', 'manatran'),
    'search_item' => __('Search recipe', 'manatran'),
    'not_found' => __('Recipe not found', 'manatran'),
    'not_found_in_trash' => __('Recipe not found in trash', 'manatran'),
    'parent_item_colon' => __('Parent recipe', 'manatran')
  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'has_archive' => true,
    'publicly_queryable' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'recipes' ),
    'capability_type' => 'post',
    'hierarchical' => false,
    'supports' => array(
      'title',
      'editor',
      'custom-fields',
      'excerpt',
      'thumbnail',
      'revisions'
    ),
    'taxonomies' => array(
      'category',
    ),
    'menu_position' => 5,
    'exclude_from_search' => false
  );
  register_post_type('recipe', $args);
}
add_action('init', 'manatran_register_recipes');
# custom fields toevoegen
function custom_fields_recipe() {
  $screens = array('recipe');
  foreach( $screens as $screen ){
    add_meta_box(
      'recipe_box',
      __('Our custom recipe fields', 'manatran'),
      'recipe_meta_box_callback',
      $screen
    );
  }
}
function recipe_meta_box_callback($post){
  // nonce field for security
  wp_nonce_field('recipe_save_meta_box_data', 'recipe_meta_box_nonce');
  $subtitle = get_post_meta($post->ID, '_recipe_subtitle', true);
  echo('<label for="recipe_subtitle">' . __('Subtitle', 'manatran') . '</label>');
  echo('<input style="width:100%;margin:0;" type="text" size="255" name="recipe_subtitle" value="'. $subtitle .'">');
  $ingredients = get_post_meta($post->ID, '_recipe_ingredients', true);
  echo('<label for="recipe_ingredients">' . __('Ingredients', 'manatran') . '</label>');
  echo('<input style="width:100%;margin:0;" type="text" size="255" name="recipe_ingredients" value="'. $ingredients .'">');
}
add_action('add_meta_box', 'custom_fields_recipe');
function save_recipe($postid){
  # return false for security
  if( ! isset( $_POST['recipe_meta_box_nonce']) ){ return; }
  if( ! wp_verify_nonce( $_POST['recipe_meta_box_nonce'], 'recipe_save_meta_box_data' )){ return; }
  if( defined('DOING_autosave') && DOING_AUTOSAVE ){ return; }
  # check if user is authorized
  if( ! current_user_can('edit_post', $post_id) ){ return; }
  # check post value
  if( ( ! isset($POST['recipe_subtitle'] ) && ( ! isset($POST['recipe_ingredients'])) ) ){ return; }
  # custom data uit post halen
  $subtitle = sanitize_text_field($POST['recipe_subtitle']);
  $ingredients = sanitize_text_field($POST['recipe_ingredients']);
  # post meta updaten
  update_post_meta($postid, '_recipe_subtitle', $subtitle);
  update_post_meta($postid, '_recipe_ingredients', $ingredients);
}
add_action('save_post', 'save_recipe');
function tx_province() {
	$labels = array(
		'name' => _x( 'Provinces', 'Taxonomy General Name', 'text_domain' ),
		'singular_name' => _x( 'Province', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name' => __( 'Province', 'text_domain' )
	);
	$args = array(
		'labels' => $labels,
		'hierarchical' => true
	);
	register_taxonomy( 'tx_province', array( 'event' ), $args );
}
add_action( 'init', 'tx_province', 0 );
function tx_setting() {
	$labels = array(
		'name' => _x( 'Settings', 'Taxonomy General Name', 'text_domain' ),
		'singular_name' => _x( 'Setting', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name' => __( 'Setting', 'text_domain' )
	);
	$args = array(
		'labels' => $labels,
		'hierarchical' => true
  );
	register_taxonomy( 'tx_setting', array( 'event' ), $args );
}
add_action( 'init', 'tx_setting', 0 );
#register events
function manatran_register_events(){
  $labels = array(
    'name' => __('Events', 'manatran'),
    'singular_name' => __('Event', 'manatran'),
    'add_new' => __('Add new event', 'manatran'),
    'all_items' => __('All events', 'manatran'),
    'add_new_item' => __('Add new event', 'manatran'),
    'edit_item' => __('Edit events', 'manatran'),
    'new_item' => __('New event', 'manatran'),
    'view_item' => __('View event', 'manatran'),
    'search_item' => __('Search event', 'manatran'),
    'not_found' => __('Event not found', 'manatran'),
    'not_found_in_trash' => __('Event not found in trash', 'manatran'),
    'parent_item_colon' => __('Parent event', 'manatran')
  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'has_archive' => true,
    'publicly_queryable' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'events' ),
    'capability_type' => 'post',
    'hierarchical' => false,
    'supports' => array(
      'title',
      'editor',
      'excerpt',
      'thumbnail',
      'revisions'
    ),
    'taxonomies' => array(
      'post_tag',
    ),
    'menu_position' => 5,
    'exclude_from_search' => false
  );
  register_post_type('event', $args);
}
add_action('init', 'manatran_register_events');
#register instagrampost
function manatran_register_instaposts(){
  $labels = array(
    'name' => __('Instagram posts', 'manatran'),
    'singular_name' => __('Instagram post', 'manatran'),
    'add_new' => __('Add new instagram post', 'manatran'),
    'all_items' => __('All instagram posts', 'manatran'),
    'add_new_item' => __('Add new instagram post', 'manatran'),
    'edit_item' => __('Edit instagram posts', 'manatran'),
    'new_item' => __('New instagram post', 'manatran'),
    'view_item' => __('View instagram post', 'manatran'),
    'search_item' => __('Search instagram post', 'manatran'),
    'not_found' => __('Instagram post not found', 'manatran'),
    'not_found_in_trash' => __('Instagram post not found in trash', 'manatran'),
    'parent_item_colon' => __('Parent instagram post', 'manatran')
  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'has_archive' => true,
    'publicly_queryable' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'instaposts' ),
    'capability_type' => 'post',
    'hierarchical' => false,
    'supports' => array(
      'title',
      'editor',
      'thumbnail',
      'revisions'
    ),
    'taxonomies' => array(
      'category',
    ),
    'menu_position' => 5,
    'exclude_from_search' => false
  );
  register_post_type('instapost', $args);
}
add_action('init', 'manatran_register_instaposts');
remove_action( 'shutdown', 'wp_ob_end_flush_all', 1 );
?>