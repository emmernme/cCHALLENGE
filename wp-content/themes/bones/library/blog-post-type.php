<?php
/* Bones Custom Post Type Example
This page walks you through creating 
a custom post type and taxonomies. You
can edit this one or copy the following code 
to create another one. 

I put this in a separate file so as to 
keep it organized. I find it easier to edit
and change things if they are concentrated
in their own file.

Developed by: Eddie Machado
URL: http://themble.com/bones/
*/

// Flush rewrite rules for custom post types
add_action( 'after_switch_theme', 'bones_flush_rewrite_rules' );

// Flush your rewrite rules
function bones_flush_rewrite_rules() {
	flush_rewrite_rules();
}

// let's create the function for the custom type
function custom_post_types() { 
	// creating (registering) the custom type 
	register_post_type( 'blog', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
		// let's now add all the options for this post type
		array( 'labels' => array(
			'name' => __( 'Blogg', 'bonestheme' ), /* This is the Title of the Group */
			'singular_name' => __( 'Blogginnlegg', 'bonestheme' ), /* This is the individual type */
			'all_items' => __( 'Alle blogginnlegg', 'bonestheme' ), /* the all items menu item */
			'add_new' => __( 'Nytt innlegg', 'bonestheme' ), /* The add new menu item */
			'add_new_item' => __( 'Nytt blogginnlegg', 'bonestheme' ), /* Add New Display Title */
			'edit' => __( 'Endre', 'bonestheme' ), /* Edit Dialog */
			'edit_item' => __( 'Endre blogginnlegg', 'bonestheme' ), /* Edit Display Title */
			'new_item' => __( 'Nytt blogginnlegg', 'bonestheme' ), /* New Display Title */
			'view_item' => __( 'Se blogginnlegg', 'bonestheme' ), /* View Display Title */
			'search_items' => __( 'Søk i blogginnlegg', 'bonestheme' ), /* Search Custom Type Title */ 
			'not_found' =>  __( 'Fant ingenting.', 'bonestheme' ), /* This displays if there are no entries yet */ 
			'not_found_in_trash' => __( 'Fant ingenting i søpla', 'bonestheme' ), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'Dette er blogginnlegg.', 'bonestheme' ), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon' => get_stylesheet_directory_uri() . '/library/images/custom-post-icon.png', /* the icon for the custom post type menu */
			//'rewrite'	=> array( 'slug' => '%author%', 'with_front' => false ), /* you can specify its url slug */
			'has_archive' => false, /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'sticky')
		) /* end of options */
	); /* end of register post type */


	register_post_type( 'reflection', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
		// let's now add all the options for this post type
		array( 'labels' => array(
			'name' => __( 'Refleksjon', 'bonestheme' ), /* This is the Title of the Group */
			'singular_name' => __( 'Refleksjon', 'bonestheme' ), /* This is the individual type */
			'all_items' => __( 'Alle refleksjoner', 'bonestheme' ), /* the all items menu item */
			'add_new' => __( 'Ny refleksjon', 'bonestheme' ), /* The add new menu item */
			'add_new_item' => __( 'Ny refleksjon', 'bonestheme' ), /* Add New Display Title */
			'edit' => __( 'Endre', 'bonestheme' ), /* Edit Dialog */
			'edit_item' => __( 'Endre refleksjon', 'bonestheme' ), /* Edit Display Title */
			'new_item' => __( 'Nytt refleksjon', 'bonestheme' ), /* New Display Title */
			'view_item' => __( 'Se refleksjon', 'bonestheme' ), /* View Display Title */
			'search_items' => __( 'Søk i refleksjoner', 'bonestheme' ), /* Search Custom Type Title */ 
			'not_found' =>  __( 'Fant ingenting.', 'bonestheme' ), /* This displays if there are no entries yet */ 
			'not_found_in_trash' => __( 'Fant ingenting i søpla', 'bonestheme' ), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'Dette er refleksjoner.', 'bonestheme' ), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon' => get_stylesheet_directory_uri() . '/library/images/custom-post-icon.png', /* the icon for the custom post type menu */
			'rewrite'	=> array( 'slug' => 'reflection', 'with_front' => false ), /* you can specify its url slug */
			'has_archive' => 'reflection', /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'sticky')
		) /* end of options */
	); /* end of register post type */

	
	/* this adds your post categories to your custom post type */
	register_taxonomy_for_object_type( 'category', 'blog' );
	/* this adds your post tags to your custom post type */
	register_taxonomy_for_object_type( 'post_tag', 'blog' );
	/* this adds your post categories to your custom post type */
	register_taxonomy_for_object_type( 'category', 'reflection');
	/* this adds your post tags to your custom post type */
	register_taxonomy_for_object_type( 'post_tag', 'reflection' );
	
}
add_post_type_support( 'blog', 'post-formats' );
add_post_type_support( 'reflection', 'post-formats' );

/*
add_filter( 'post_type_link', 'bones_post_type_link', 10, 4 );
function bones_post_type_link( $post_link, $post, $leavename, $sample )
{
    if ( 'blog' == $post->post_type ) {
	    
        $authordata = get_userdata( $post->post_author );
        $author = $authordata->user_nicename;
        $post_link = str_replace( '%author%', $author, $post_link );
    }
    return $post_link;
}
*/
// adding the function to the Wordpress init
add_action( 'init', 'custom_post_types');


// Add custom box for day in blog posts

if ( file_exists( dirname( __FILE__ ) . '/cmb2/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/cmb2/init.php';
} elseif ( file_exists( dirname( __FILE__ ) . '/CMB2/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/CMB2/init.php';
}
add_action( 'cmb2_admin_init', 'register_day_metabox' );
/**
 * Hook in and add a demo metabox. Can only happen on the 'cmb2_admin_init' or 'cmb2_init' hook.
 */
function register_day_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_blog_day';

	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$cmb_demo = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => __( 'Extra info', 'cmb2' ),
		'object_types'  => array( 'blog', ), // Post type
	) );

	$cmb_demo->add_field( array(
		'name' => __( 'Day', 'cmb2' ),
		'desc' => __( "Which day are you blogging about? Required field.", 'cmb2' ),
		'id'   => $prefix . 'day',
		'type' => 'select',
	    'options' => array('1' =>'1','2' =>'2','3' =>'3','4' =>'4','5' =>'5','6' =>'6','7' =>'7','8' =>'8','9' =>'9','10' =>'10','11' =>'11','12' =>'12','13' =>'13','14' =>'14','15' =>'15','16' =>'16','17' =>'17','18' =>'18','19' =>'19','20' =>'20','21' =>'21','22' =>'22','23' =>'23','24' =>'24','25' =>'25','26' =>'26','27' =>'27','28' =>'28','29' =>'29','30' =>'30','31' =>'31',)
	));


}

// Participants page ID: 49
add_action( 'cmb2_admin_init', 'register_subtitle_metabox' );
/**
 * Hook in and add a demo metabox. Can only happen on the 'cmb2_admin_init' or 'cmb2_init' hook.
 */
function register_subtitle_metabox() {
	// Start with an underscore to hide fields from custom fields list
	$prefix = '_participants_page';

	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$cmb_demo = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => __( 'Sub-title', 'cmb2' ),
        'object_types' => array('page'), // post type
        'show_on'      => array('key' => 'id', 'value' => '49'),
        'context'      => 'normal', //  'normal', 'advanced', or 'side'
        'priority'     => 'core',  //  'high', 'core', 'default' or 'low'
        'show_names'   => false, // Show field names on the left

	) );

	$cmb_demo->add_field( array(
		'desc' => __( "Title to be displayed below first title.", 'cmb2' ),
		'id'   => $prefix . 'subtitle',
		'type' => 'text',
	));


}


?>