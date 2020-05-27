<?php
/*
Author: Emil Broll
*/

// LOAD BONES CORE (if you remove this, the theme will break)
require_once( 'library/bones.php' );

// CUSTOMIZE THE WORDPRESS ADMIN (off by default)
require_once( 'library/admin.php' );

/*********************
LAUNCH BONES
Let's get everything up and running.
*********************/
remove_action( 'shutdown', 'wp_ob_end_flush_all', 1 );

function bones_ahoy() {

  //Allow editor style.
  add_editor_style( get_stylesheet_directory_uri() . '/library/css/editor-style.css' );

  // Get post types inspiration (reflection) and blog
  require_once( 'library/blog-post-type.php' );

  // launching operation cleanup
  add_action( 'init', 'bones_head_cleanup' );
  // remove WP version from RSS
  add_filter( 'the_generator', 'bones_rss_version' );
  // clean up gallery output in wp
  add_filter( 'gallery_style', 'bones_gallery_style' );

  // enqueue base scripts and styles
  add_action( 'wp_enqueue_scripts', 'bones_scripts_and_styles', 999 );
  // ie conditional wrapper

  // launching this stuff after theme setup
  bones_theme_support();

  // cleaning up random code around images
  add_filter( 'the_content', 'bones_filter_ptags_on_images' );
  // cleaning up excerpt
  add_filter( 'excerpt_more', 'bones_excerpt_more' );

} /* end bones ahoy */
add_action( 'admin_enqueue_scripts', 'load_admin_style');
function load_admin_style() {
    wp_enqueue_style( 'admin_css', get_template_directory_uri() . '/library/css/admin.css', false );
}
function mypo_parse_query_useronly( $wp_query ) {
    if ( strpos( $_SERVER['REQUEST_URI'], '/wp-admin/edit.php' ) !== false && strpos($_SERVER['QUERY_STRING'], 'post_type=blog') !== false) {
        if ( !current_user_can( 'level_10' ) ) {
            global $current_user;
            $wp_query->set( 'author', $current_user->ID );
        }
    }
}
add_filter('parse_query', 'mypo_parse_query_useronly' );

function disallowed_admin_pages(){
    global $pagenow, $current_user;
    /* Check current admin page. */
    if(!current_user_can( 'level_10' ) && $pagenow == 'edit.php' && (!isset($_GET['post_type']) || $_GET['post_type'] != 'blog')){
        wp_redirect(admin_url('/edit.php?post_type=blog', 'http'), 301);
        exit;
    }
    if(!current_user_can( 'level_10' ) && $pagenow == 'post-new.php' && (!isset($_GET['post_type']) || $_GET['post_type'] != 'blog')){
        wp_redirect(admin_url('/edit.php?post_type=blog', 'http'), 301);
        exit;
    }
}
add_action('admin_init', 'disallowed_admin_pages');

// Get tweets
require "library/twitteroauth/autoload.php";
use Abraham\TwitterOAuth\TwitterOAuth;
function get_tweets(){
	$tweets = get_transient('tweets');
	if (false === $tweets){
		$connection = new TwitterOAuth('WPimxPjoDvWPImfxsywk36oRi', 'ilIomAPiMN32wVp9Q0RFg8dtgOfgPXQCERqp64jlPCFu0resTK');
		$tweets = $connection->get("statuses/user_timeline", array("screen_name" => 'cCHANGE_Climate', "count" => 20, "exclude_replies" => true, "include_rts" => false, "trim_user" => false));	
		if ($connection->getLastHttpCode() == 200 && $tweets){
			set_transient('tweets', $tweets, MINUTE_IN_SECONDS * 5);
		} else {
			return false;
		}
	}
	return $tweets;
}

/*
* Get thumb for blog posts to use on front page
*/
function gpi_find_image_id($post_id) {
    if (!$img_id = get_post_thumbnail_id ($post_id)) {
        /*$attachments = get_children(array(
            'post_parent' => $post_id,
            'post_type' => 'attachment',
            'numberposts' => 1,
            'post_mime_type' => 'image'
        ));
        if (is_array($attachments)) foreach ($attachments as $a)
            $img_id = $a->ID;*/
    }
    if ($img_id)
        return $img_id;
    return false;
}
function find_img_src($post) {
    if (!$img = gpi_find_image_id($post->ID))
        if ($img = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches)){
	        if ($img = preg_replace('/-\d+[Xx]\d+\./', '.', $matches[1][0])){
		        if ($attachment = get_attachment_id($img)){
			        set_post_thumbnail($post, $attachment);
			        $img = wp_get_attachment_image_src($attachment, 'large');
			        $img = $img[0];
					return $img;
		        }
		        return $img;
	        }
			if ($attachment = get_attachment_id($matches[1][0])){
		        set_post_thumbnail($post, $attachment);
		        $img = wp_get_attachment_image_src($attachment, 'large');
		        $img = $img[0];
				return $img;
	        }
	        return $matches[1][0];
        } else {
	        return false;
        }
    if ($img){
        $img = wp_get_attachment_image_src($img, 'large');
        $img = $img[0];
		return $img;
	}
}
function get_attachment_id($url){
	if ($img = attachment_url_to_postid($url)){
		return $img;
	}
}

function remove_default_image_sizes( $sizes) {
    unset( $sizes['medium']);     
    return $sizes;
}
add_filter('intermediate_image_sizes_advanced', 'remove_default_image_sizes');


// Only get one post per user for front page
function unique_user_posts() {
    global $wpdb;
    
    $where = " AND wp_posts.id = (select id from {$wpdb->prefix}posts p2 where p2.post_status = 'publish' and p2.post_type = 'blog' and p2.post_author = {$wpdb->prefix}posts.post_author order by p2.post_date desc limit 0,1)";
    return $where;
}

// Add links and stuff to tweets
function linkify_tweet($text) {
    //links (strips protocol+:// (not www though)
    $text = preg_replace('@(https?://([-\w\.]+)+(/([\w/_\.]*(\?\S+)?(#\S+)?)?)?)@', '<a href="$1">$2$3</a>', $text);
    //users
    $text = preg_replace('/@(\w+)/', '<a href="http://twitter.com/$1">@$1</a>', $text);
    //hashtags
    $text = preg_replace('/\s+#([\w\æøå]+)/', ' <a href="http://twitter.com/search?q=%23$1">#$1</a>', $text);
	return $text;
}

// Make share box for singles and author archives
function share_box($author, $post_id = false){
	global $post, $wp, $wp_query;
	echo "<!--";
	var_dump($wp_query);
	echo "-->";
	if (!$post_id){
		if ($wp_query->posts[0]){
			$post_id = $wp_query->posts[0]->ID;
		}
	}
	if ($post_id){
		$permalink = get_permalink($post_id);
	} else {
		$permalink = urlencode(home_url(add_query_arg(array(),$wp->request)));
	}
	$twitter_text = urlencode((($post_id)?'"'. get_the_title($post_id).'" by ':'') . get_the_author_meta('display_name', $author));
	echo	'<div id="author-share">
				<h3>SHARE THIS</h3>
				<a class="share" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u='. $permalink .'" id="facebook"></a>
				<a class="share" target="_blank" href="http://twitter.com/share?text='. $twitter_text .'&url='. $permalink .'&hashtags=cCHALLENGE" id="twitter"></a>
				<a class="share" target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&source=cCHALLENGE&url='. $permalink .'&title='. $twitter_text .'" id="linkedin"></a>
			</div>';
}

/**
 * Get post excerpt by post ID.
 *
 * @return string
 */
function get_post_excerpt_by_id( $post_id ) {
    global $post;
    $post = get_post( $post_id );
    setup_postdata( $post );
    $the_excerpt = get_the_excerpt();
    wp_reset_postdata();
    return $the_excerpt;
}

// Fix image and desc for author archives in Yoast SEO
add_filter('wpseo_metadesc','change_yoast_description',100,1);
function change_yoast_description($description) {
	global $wp_query;
	if (is_author()){
		$author = get_query_var('author');
		if ($wp_query->posts[0]){
			$post_id = $wp_query->posts[0]->ID;
			$description = get_post_excerpt_by_id($post_id);
		} else {
			$description = get_the_author_meta('description', $author);
		}
	}
	return $description;
}
add_filter('wpseo_title','change_yoast_title',100,1);
function change_yoast_title($title) {
	global $wp_query;
	if (is_author()){
		$author = get_query_var('author');
		if ($wp_query->posts[0]){
			$post_id = $wp_query->posts[0]->ID;
			$title = '"'.get_the_title($post_id) .'" by '. get_the_author_meta('display_name', $author) .' – cCHALLENGE';
		}
	} else if (is_singular("blog")) {
		global $post_id;
		$author = get_post_field( 'post_author', $post_id );
		$title = '"'.get_the_title($post_id) .'" by '. get_the_author_meta('display_name', $author) .' – cCHALLENGE';
	}
	return $title;
}
add_filter('wpseo_opengraph_image','change_yoast_image',100,1);
function change_yoast_image($image) {
	global $wp_query;
	if (is_author()){
		$author = get_query_var('author');
		if ($wp_query->posts[0]){
			$post = $wp_query->posts[0];
			if ($thumbnail = find_img_src($post)){
				return $thumbnail;
			}
		}
		$image = get_wp_user_avatar_src($author, 'large');
	} else if (is_singular("blog")) {
		global $post;
		if ($thumbnail = find_img_src($post)){
			return $thumbnail;
		}
	}
	return $image;
}
// Make facebook rescrape author page when published
function facebookScrape($ID, $post ) {
	$author = $post->post_author;
	$author_archive = get_author_posts_url($author);
	$access_token="1561605080796626|bd19382f3c42a9145e0e01d43bf41c4f"; //replace with your app details
	$params = array("id"=>$author_archive,"scrape"=>"true","access_token"=>$access_token);
	$ch = curl_init("https://graph.facebook.com");
	curl_setopt_array($ch, array(
	    CURLOPT_RETURNTRANSFER=>true,
	    CURLOPT_SSL_VERIFYHOST=>false,
	    CURLOPT_SSL_VERIFYPEER=>false,
	    CURLOPT_POST=>true,
	    CURLOPT_POSTFIELDS=>$params
	));
	$result = curl_exec($ch);
	$params["id"] = get_permalink($post);
	$ch = curl_init("https://graph.facebook.com");
	curl_setopt_array($ch, array(
	    CURLOPT_RETURNTRANSFER=>true,
	    CURLOPT_SSL_VERIFYHOST=>false,
	    CURLOPT_SSL_VERIFYPEER=>false,
	    CURLOPT_POST=>true,
	    CURLOPT_POSTFIELDS=>$params
	));
	$result = curl_exec($ch);
	error_log('Facebook scrape for '. $author .' and '. $ID);
 }
add_action( 'publish_blog', 'facebookScrape', 10, 2 );
add_action('new_to_publish_blog', 'facebookScrape', 10, 2);		
add_action('draft_to_publish_blog', 'facebookScrape', 10, 2);		
add_action('pending_to_publish_blog', 'facebookScrape', 10, 2);

/*
*Add link to archive for inspiration menu item
*/
add_action('admin_head-nav-menus.php', 'wpclean_add_metabox_menu_posttype_archive');
function wpclean_add_metabox_menu_posttype_archive() {
	add_meta_box('wpclean-metabox-nav-menu-posttype', 'Custom Post Type Archives', 'wpclean_metabox_menu_posttype_archive', 'nav-menus', 'side', 'default');
}
function wpclean_metabox_menu_posttype_archive() {
	$post_types = get_post_types(array('show_in_nav_menus' => true, 'has_archive' => true), 'object');

	if ($post_types) :
	    $items = array();
	    $loop_index = 999999;
	    foreach ($post_types as $post_type) {
	        $item = new stdClass();
	        $loop_index++;	
	        $item->object_id = $loop_index;
	        $item->db_id = 0;
	        $item->object = 'post_type_' . $post_type->query_var;
	        $item->menu_item_parent = 0;
	        $item->type = 'custom';
	        $item->title = $post_type->labels->name;
	        $item->url = get_post_type_archive_link($post_type->query_var);
	        $item->target = '';
	        $item->attr_title = '';
	        $item->classes = array();
	        $item->xfn = '';
	        $items[] = $item;
	    }
	    $walker = new Walker_Nav_Menu_Checklist(array());
	    echo '<div id="posttype-archive" class="posttypediv">';
	    echo '<div id="tabs-panel-posttype-archive" class="tabs-panel tabs-panel-active">';
	    echo '<ul id="posttype-archive-checklist" class="categorychecklist form-no-clear">';
	    echo walk_nav_menu_tree(array_map('wp_setup_nav_menu_item', $items), 0, (object) array('walker' => $walker));
	    echo '</ul>';
	    echo '</div>';
	    echo '</div>';
	    echo '<p class="button-controls">';
	    echo '<span class="add-to-menu">';
	    echo '<input type="submit"' . disabled(1, 0) . ' class="button-secondary submit-add-to-menu right" value="' . __('Add to Menu', 'andromedamedia') . '" name="add-posttype-archive-menu-item" id="submit-posttype-archive" />';
	    echo '<span class="spinner"></span>';
	    echo '</span>';
	    echo '</p>';
	endif;
}


// Add field for "My cCHALLENGE" in user profiles
function modify_contact_methods($profile_fields) {
	// Add new fields
	//$profile_fields['twitter'] = 'Twitter Username';
	//$profile_fields['facebook'] = 'Facebook URL';
	//$profile_fields['linkedin'] = 'LinkedIn URL';
	$profile_fields['cCHALLENGE'] = 'My cCHANGE challenge';
	return $profile_fields;
}
add_filter('user_contactmethods', 'modify_contact_methods');
// Retrieve with get_the_author_meta('cCHALLENGE')

// Get only blog posts in author archive
function get_all_post_types_for_user(&$query) {
    if ($query->is_author){
        $query->set('post_type', array('blog'));
        $query->set('posts_per_page', 4);
    }
    remove_action('pre_get_posts', 'get_all_post_types_for_user'); // run once!
}
add_action('pre_get_posts', 'get_all_post_types_for_user');


// let's get this party started
add_action( 'after_setup_theme', 'bones_ahoy' );


/************* OEMBED SIZE OPTIONS *************/

if ( ! isset( $content_width ) ) {
	$content_width = 680;
}
/* DON'T DELETE THIS CLOSING TAG */ ?>
