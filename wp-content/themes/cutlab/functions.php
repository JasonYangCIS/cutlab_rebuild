<?php
/**
 * ReadyArtwork functions and definitions
 *
 * @package WordPress
 * @subpackage ReadyArtwork
 * @since ReadyArtwork HTML5 3.0
 */


if ( ! isset( $content_width ) ) $content_width = 590;

/*
  Enques jQuery from Google CDN. 
  Uses the currently registred WordPress jQuery version.
*/
  function appglobe_jquery_enqueue() { 

  /* 
     Probably not necessary if called with the 'wp_enqueue_scripts' action.
  */
     if (is_admin()) return; 

     global $wp_scripts; 

  /*
    Change  this flag to have the CDN script  
    triggered by wp_footer instead of wp_head.
    If Google CDN is unavailable for some reason the flag 
    will be ignored and the local WordPress 
    jQuery gets enqueued and included in the head
    by the wp_head function.
  */
    $cdn_script_in_footer = false; 
  /*
    Register jQuery from Google CDN.
  */
    if (is_a($wp_scripts, 'WP_Scripts') && isset($wp_scripts->registered['jquery'])) {
    /* 
       The WordPress jQuery version. 
    */
       $registered_jquery_version = $wp_scripts -> registered[jquery] -> ver; 

       if($registered_jquery_version) {
      /* 
	 The jQuery Google CDN URL. 
	 Makes a check for HTTP on top of SSL/TLS (HTTPS) 
	 to make sure the URL is correct.
      */
  $google_jquery_url = ($_SERVER['SERVER_PORT'] == 443 ? "https" : "http") . 
  "://ajax.googleapis.com/ajax/libs/jquery/$registered_jquery_version/jquery.min.js";

      /* 
	 Get the HTTP header response for the this URL, and check that its ok. 
	 If ok, include jQuery from Google CDN. 
      */
  if(200 === wp_remote_retrieve_response_code(wp_remote_head($google_jquery_url))) {
   wp_deregister_script('jquery');
   wp_register_script('jquery', $google_jquery_url , false, null, $cdn_script_in_footer);
 }
}
}
  /* 
     Enqueue jQuery from Google if available. 
     Fall back to the local WordPress default.
     If the local WordPress jQuery is called, it will get 
     included in the header no matter what the 
     $cdn_script_in_footer flag above is set to.
  */
     wp_enqueue_script('jquery'); 
   }
   add_action('wp_enqueue_scripts', 'appglobe_jquery_enqueue', 11);

/* 
   add our scripts here instead, and use wp_footer to load most scripts
*/

   function load_scripts() {
  // register your script location, dependencies and version
    wp_register_script('modernizer',get_template_directory_uri() . '/js/libs/modernizr-2.8.3.min.js',  '2.8.3',false );	 

    wp_register_script('plugins',get_template_directory_uri() . '/js/plugins.js',  array('jquery'),   '1.0' , true );	   
    wp_register_script('scripts',get_template_directory_uri() . '/js/script.js',  array('jquery'),   '1.0', true );	   

    wp_enqueue_script('modernizer');
    wp_enqueue_script('plugins');
    wp_enqueue_script('scripts');

  }
  add_action('wp_enqueue_scripts', 'load_scripts');

  /** Tell WordPress to run ReadyArtwork_setup() when the 'after_setup_theme' hook is run. */
  add_action( 'after_setup_theme', 'ReadyArtwork_setup' );

  if ( ! function_exists( 'ReadyArtwork_setup' ) ):
  /**
   * Sets up theme defaults and registers support for various WordPress features.
   *
   * @since ReadyArtwork HTML5 3.0
   */
function ReadyArtwork_setup() {


    // This theme uses post thumbnails
  add_theme_support( 'post-thumbnails' );

    // Add default posts and comments RSS feed links to head
  add_theme_support( 'automatic-feed-links' );

    // Make theme available for translation
    // Translations can be filed in the /languages/ directory
  load_theme_textdomain( 'ReadyArtwork', get_template_directory() . '/languages' );

  $locale = get_locale();
  $locale_file = get_template_directory() . "/languages/$locale.php";
  if ( is_readable( $locale_file ) )
    require_once( $locale_file );

  register_nav_menu( 'primary', __( 'Primary Menu', 'ReadyArtwork' ) );	

}
endif;

/*
 *	Menu Fall back
 */
function ReadyArtwork_menu() {
  echo '<nav><ul><li><a href="'.home_url().'">Home</a></li>';
  wp_list_pages('title_li=');
  echo '</ul></nav>';
}



if ( ! function_exists( 'ReadyArtwork_comment' ) ) :
  /**
   * Template for comments and pingbacks.
   *
   * @since ReadyArtwork HTML5 3.0
   */
function ReadyArtwork_comment( $comment, $args, $depth ) {
  $GLOBALS['comment'] = $comment;
  switch ( $comment->comment_type ) :
  case '' :
  ?>
  <article <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
    <?php echo get_avatar( $comment, 40 ); ?>
    <?php printf( __( '%s says:', 'ReadyArtwork' ), sprintf( '%s', get_comment_author_link() ) ); ?>
    <?php if ( $comment->comment_approved == '0' ) : ?>
      <?php _e( 'Your comment is awaiting moderation.', 'ReadyArtwork' ); ?>
      <br />
    <?php endif; ?>

    <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
      <?php
      /* translators: 1: date, 2: time */
      printf( __( '%1$s at %2$s', 'ReadyArtwork' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', 'ReadyArtwork' ), ' ' );
      ?>

      <?php comment_text(); ?>

      <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>

      <?php
      break;
      case 'pingback'  :
      case 'trackback' :
      ?>
      <article <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
        <p><?php _e( 'Pingback:', 'ReadyArtwork' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'ReadyArtwork'), ' ' ); ?></p>
        <?php
        break;
        endswitch;
      }
      endif;




/**
 * Closes comments and pingbacks with </article> instead of </li>.
 *
 * @since ReadyArtwork HTML5 3.0
 */
function ReadyArtwork_comment_close() {
  echo '</article>';
}




/**
 * Adjusts the comment_form() input types for HTML5.
 *
 * @since ReadyArtwork HTML5 3.0
 */
function ReadyArtwork_fields($fields) {
  $commenter = wp_get_current_commenter();
  $req = get_option( 'require_name_email' );
  $aria_req = ( $req ? " aria-required='true'" : '' );
  $fields =  array(
   'author' => '<p><label for="author">' . __( 'Name' , 'ReadyArtwork' ) . '</label> ' . ( $req ? '*' : '' ) .
   '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>',
   'email'  => '<p><label for="email">' . __( 'Email' , 'ReadyArtwork'  ) . '</label> ' . ( $req ? '*' : '' ) .
   '<input id="email" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>',
   'url'    => '<p><label for="url">' . __( 'Website', 'ReadyArtwork'  ) . '</label>' .
   '<input id="url" name="url" type="url" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>',
   );
  return $fields;
}



/**
 * Register widgetized areas.
 *
 * @since ReadyArtwork HTML5 3.0
 */
function ReadyArtwork_widgets_init() {

  register_sidebar( array(
   'name' => __( 'Home Sidebar', 'ReadyArtwork'  ),
   'id' => 'sidebar-home',
   'description' => __( 'Edit Home Sidebars Here ', 'ReadyArtwork' ),
   'before_widget' => '<aside id="%1$s" class="widget %2$s">',
   'after_widget' => "</aside>",
   'before_title' => '<h3 class="widget-title">',
   'after_title' => '</h3>',
   ) );


  register_sidebar( array(
   'name' => __( 'Blog Sidebar', 'ReadyArtwork'  ),
   'id' => 'sidebar',
   'description' => __( 'Edit Blog Sidebars Here ', 'ReadyArtwork' ),
   'before_widget' => '<aside id="%1$s" class="widget %2$s">',
   'after_widget' => "</aside>",
   'before_title' => '<h3 class="widget-title">',
   'after_title' => '</h3>',
   ) );

  register_sidebar( array(
   'name' => __( 'Social Media Sidebar', 'ReadyArtwork' ),
   'id' => 'sidebar-social-media',
   'description' => __( 'Edit Social Media Sidebars Here ', 'ReadyArtwork'  ),
   'before_widget' => '<aside id="%1$s" class="widget %2$s">',
   'after_widget' => "</aside>",
   'before_title' => '<h3 class="widget-title">',
   'after_title' => '</h3>',
   ) );

 register_sidebar( array(
   'name' => __( 'Social Media Footer Sidebar', 'ReadyArtwork' ),
   'id' => 'sidebar-social-media-footer',
   'description' => __( 'Edit Social Media Footer Sidebars Here ', 'ReadyArtwork'  ),
   'before_widget' => '<aside id="%1$s" class="widget %2$s">',
   'after_widget' => "</aside>",
   'before_title' => '<h3 class="widget-title">',
   'after_title' => '</h3>',
   ) );

  register_sidebar( array(
   'name' => __( 'Desktop Logos Sidebar', 'ReadyArtwork' ),
   'id' => 'sidebar-desktop-logos',
   'description' => __( 'Edit Desktop Logos Sidebars Here ', 'ReadyArtwork'  ),
   'before_widget' => '<div class="logo-container">',
   'after_widget' => '</div>',
   'before_title' => '',
   'after_title' => '',
   ) );

  register_sidebar( array(
    'name' => __( 'Mobile Logos Sidebar', 'ReadyArtwork' ),
   'id' => 'sidebar-mobile-logos',
   'description' => __( 'Edit Mobile Logos Sidebars Here ', 'ReadyArtwork'  ),
   'before_widget' => '<div class="logo-container">',
   'after_widget' => '</div>',
   'before_title' => '',
   'after_title' => '',
   ) );


}
/** Register sidebars by running ReadyArtwork_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'ReadyArtwork_widgets_init' );


/**
 * Removes the default styles that are packaged with the Recent Comments widget.
 *
 * @updated ReadyArtwork HTML5 3.2
 */
function ReadyArtwork_remove_recent_comments_style() {
  add_filter( 'show_recent_comments_widget_style', '__return_false' );
}
add_action( 'widgets_init', 'ReadyArtwork_remove_recent_comments_style' );

if ( ! function_exists( 'ReadyArtwork_posted_on' ) ) :
  /**
   * Prints HTML with meta information for the current post—date/time and author.
   *
   * @since ReadyArtwork HTML5 3.0
   */
function ReadyArtwork_posted_on() {
  printf( __( '<div class="sep"><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a></div>', 'ReadyArtwork' ),
   esc_url( get_permalink() ),
   esc_attr( get_the_time() ),
   esc_attr( get_the_date( 'c' ) ),
   esc_html( get_the_date() ),
   esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
   esc_attr( sprintf( __( 'View all posts by %s', 'ReadyArtwork' ), get_the_author() ) ),
   get_the_author()
   );
}
endif;


if ( ! function_exists( 'ReadyArtwork_posted_in' ) ) :
  /**
   * Prints HTML with meta information for the current post (category, tags and permalink).
   *
   * @since ReadyArtwork HTML5 3.0
   */
function ReadyArtwork_posted_in() {
    // Retrieves tag list of current post, separated by commas.
  $tag_list = get_the_tag_list( '', ', ' );
  if ( $tag_list ) {
      //$posted_in = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'ReadyArtwork' );
  } elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
    $posted_in = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'ReadyArtwork' );
  } else {
    $posted_in = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'ReadyArtwork' );
  }
    // Prints the string, replacing the placeholders.
  printf(
    $posted_in,
    get_the_category_list( ', ' ),
    $tag_list,
    get_permalink(),
    the_title_attribute( 'echo=0' )
    );
}
endif;



if ( ! function_exists( 'ReadyArtwork_comment' ) ) :
  /**
   * Template for comments and pingbacks.
   *
   * To override this walker in a child theme without modifying the comments template
   * simply create your own ReadyArtwork_comment(), and that function will be used instead.
   *
   * Used as a callback by wp_list_comments() for displaying the comments.
   *
   * @since Twenty Eleven 1.0
   */
function ReadyArtwork_comment( $comment, $args, $depth ) {
  $GLOBALS['comment'] = $comment;
  switch ( $comment->comment_type ) :
  case 'pingback' :
  case 'trackback' :
  ?>
  <li class="post pingback">
    <p><?php _e( 'Pingback:', 'ReadyArtwork' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'ReadyArtwork' ), '<span class="edit-link">', '</span>' ); ?></p>
    <?php
    break;
    default :
    ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
      <article id="comment-<?php comment_ID(); ?>" class="comment">
        <footer class="comment-meta">
          <div class="comment-author vcard">
            <div class="comment-author-name">Written By: <?php echo comment_author();?></div>
            <div class="comment-avatar">
             <?php
             $avatar_size = 68;
             if ( '0' != $comment->comment_parent )
              $avatar_size = 39;

            echo get_avatar( $comment, $avatar_size );

            /* translators: 1: comment author, 2: date and time */

            ?>
          </div>
          <div class="comment-content"><?php comment_text(); ?></div>
          <?php edit_comment_link( __( 'Edit', 'ReadyArtwork' ), '<span class="edit-link">', '</span>' ); ?>
        </div><!-- .comment-author .vcard -->

        <?php if ( $comment->comment_approved == '0' ) : ?>
          <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'ReadyArtwork' ); ?></em>
          <br />
        <?php endif; ?>

      </footer>

      

      <div class="comment-view">View all posts by: <?php echo  comment_author_link(); ?></div>
      <!-- .reply -->
    </article><!-- #comment-## -->

    <?php
    break;
    endswitch;
  }
endif; // ends check for ReadyArtwork_comment()



// custom post types here


// add_action('init', 'ready_slider_images');
// function ready_slider_images () {
//   $args = array(
//     'label' => __('Slider Images', 'ReadyArtwork' ),
//     'singular_label' => __('Slider Image', 'ReadyArtwork' ),
//     'public' => false,
//     'show_ui' => true,
//     'capability_type' => 'page',
//     'hierarchical' => false,
//     'rewrite' => false,		
//     'supports' => array('title','thumbnail' , 'page-attributes')
//     );
//   register_post_type('slider_images',$args);
// }

add_action('init', 'employees');
function employees () {
  $args = array(
    'label' => __('Employees', 'ReadyArtwork' ),
    'singular_label' => __('Employees', 'ReadyArtwork' ),
    'public' => true,
    'show_ui' => true,
    'capability_type' => 'page',
    'hierarchical' => false,
    'rewrite' => false,   
    'supports' => array('title','editor', 'thumbnail', 'page-attributes')
    );
  register_post_type('employees',$args);
}

// Add meta boxes functionality

// add_action("admin_init", "admin_init");  

// function admin_init(){  

//   add_meta_box("images-meta-link", "Image Link", "meta_options", "slider_images", "side", "high");

// }  


function meta_options(){ 
  global $post;   
  $custom = get_post_custom($post->ID);  
  $link1 = $custom["link1"][0];  
  ?>  
  <label>Path: </label><input name="link1"  value="<?php echo $link1; ?>" />  
  <?php  
}  


// function save_link($post_id){  
//   global $post;  
//   if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
//     return $post_id;
//   }
//   if( $post->post_type == 'slider_images'  ) {

//     if( isset($_POST['link1']) ) { 
//       update_post_meta($post->ID, "link1", $_POST["link1"]);  
//     }
//   }

// }
// add_action('save_post', 'save_link');  





// get images? 
if ( ! function_exists( 'get_images' ) ):
  function get_images($size = 'thumbnail') {
    global $post;
    $images = get_children( array('post_parent' => $post->ID, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID') );
    $out = array();
    $tId = get_post_thumbnail_id($post->ID);
    if ($images) {
      foreach ($images as $image) {
       if ($tId != $image->ID){		  
         $out[] = wp_get_attachment_image($image->ID, $size);
       }
     }
   }
   return $out;
 }
 endif;

/*
 * Gets the first image or iframe in a post just call the function in a post loop
 *
 */
function catch_that_image($type) {
  global $post, $posts;
  $first_img = '';
  $result = '';
  ob_start();
  ob_end_clean();
  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
  $first_img = $matches [1] [0];
  $iframe = false;
  if(empty($first_img)){ 
    // find the iframe instead, if no iframe then put the placeholder
    $output = preg_match_all('/<iframe.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
    $first_img = $matches [1] [0];
    if ( $first_img ) {
      $iframe = true;
    }
  }    
  if(empty($first_img)){ 
    // uncomment to use placeholder
    $first_img = get_template_directory_uri()."/img/placeholder.png";
  }
  if($type=='url') {
    $result = $first_img;
  }
  else {
    if ( $iframe == true) {
      $result = "<iframe src='".$first_img."'></iframe>"; 
    } else { 
      $result = "<img src='".$first_img."'alt='".get_the_title($post)."'/>";
    }
  }
  return $result;
}

function catch_that_anchor_image() {
  global $post, $posts;
  $first_anchor = '';
  ob_start();
  ob_end_clean();
  $output = preg_match_all('#<a\s+.*?href=[\'"]([^\'"]+)[\'"]\s*(?:title=[\'"]([^\'"]+)[\'"])?.*?>((?:(?!</a>).)*)</a>#i', $post->post_content, $matches);
  $first_anchor = $matches [1] [0];
  $first_img = catch_that_image('image'); 
  return '<a href="' . $first_anchor . '">' . $first_img . '</a>';
}


//footer admin area
function modify_footer_admin () {
  echo 'Website Designed by <a href="http://www.readyartwork.com" target="_blank">Ready Artwork</a>';
  echo " Powered by <a href='http://WordPress.org'>WordPress</a>.";
}

add_filter('admin_footer_text', 'modify_footer_admin');


/******************************************************************************
* @Author: Boutros AbiChedid 
* @Date:   June 20, 2011
* @Websites: http://bacsoftwareconsulting.com/ ; http://blueoliveonline.com/
* @Description: Preserves HTML formating to the automatically generated Excerpt.
* Also Code modifies the default excerpt_length and excerpt_more filters.
* @Tested: Up to WordPress version 3.1.3
*******************************************************************************/
function custom_wp_trim_excerpt($text) {
  $raw_excerpt = $text;
  if ( '' == $text ) {
    //Retrieve the post content. 
    $text = get_the_content('');
    
    //Delete all shortcode tags from the content. 
    $text = strip_shortcodes( $text );
    
    $text = apply_filters('the_content', $text);
    $text = str_replace(']]>', ']]&gt;', $text);
    
    $allowed_tags = '<a>'; /*** MODIFY THIS. Add the allowed HTML tags separated by a comma.***/
    $text = strip_tags($text, $allowed_tags);
    
    $excerpt_word_count = 55; /*** MODIFY THIS. change the excerpt word count to any integer you like.***/
    $excerpt_length = apply_filters('excerpt_length', $excerpt_word_count); 
    
    $excerpt_end = '<div class="read-more"><a href="'. get_permalink($post->ID) . '">More</a></div>'; /*** MODIFY THIS. change the excerpt endind to something else.***/
    $excerpt_more = apply_filters('excerpt_more', ' ' . $excerpt_end);
    
    $words = preg_split("/[\n\r\t ]+/", $text, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY);
    if ( count($words) > $excerpt_length ) {
      array_pop($words);
      $text = implode(' ', $words);
      $text = $text . $excerpt_more;
    } else {
      $text = implode(' ', $words);
    }
  }
  return apply_filters('wp_trim_excerpt', $text, $raw_excerpt);
}
remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt', 'custom_wp_trim_excerpt');

add_action('admin_menu','wphidenag');
function wphidenag() {
  remove_action( 'admin_notices', 'update_nag', 3 );
}

//Custom Gallery
add_shortcode('gallery', 'my_gallery_shortcode');    
function my_gallery_shortcode($attr) {
  $post = get_post();

  static $instance = 0;
  $instance++;

  if ( ! empty( $attr['ids'] ) ) {
    // 'ids' is explicitly ordered, unless you specify otherwise.
    if ( empty( $attr['orderby'] ) )
      $attr['orderby'] = 'post__in';
    $attr['include'] = $attr['ids'];
  }

// Allow plugins/themes to override the default gallery template.
  $output = apply_filters('post_gallery', '', $attr);
  if ( $output != '' )
    return $output;

// We're trusting author input, so let's at least make sure it looks like a valid orderby statement
  if ( isset( $attr['orderby'] ) ) {
    $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
    if ( !$attr['orderby'] )
      unset( $attr['orderby'] );
  }

  extract(shortcode_atts(array(
    'order'      => 'ASC',
    'orderby'    => 'menu_order ID',
    'id'         => $post->ID,
    'itemtag'    => 'dl',
    'icontag'    => 'dt',
    'captiontag' => 'dd',
    'columns'    => 3,
    'size'       => $attr['size'],
    'include'    => '',
    'exclude'    => ''
    ), $attr));

  $id = intval($id);
  if ( 'RAND' == $order )
    $orderby = 'none';

  if ( !empty($include) ) {
    $_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

    $attachments = array();
    foreach ( $_attachments as $key => $val ) {
      $attachments[$val->ID] = $_attachments[$key];
    }
  } elseif ( !empty($exclude) ) {
    $attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
  } else {
    $attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
  }

  if ( empty($attachments) )
    return '';

  if ( is_feed() ) {
    $output = "\n";
    foreach ( $attachments as $att_id => $attachment )
      $output .= wp_get_attachment_link($att_id, $size, true) . "\n";
    return $output;
  }

  $itemtag = tag_escape($itemtag);
  $captiontag = tag_escape($captiontag);
  $icontag = tag_escape($icontag);
  $valid_tags = wp_kses_allowed_html( 'post' );
  if ( ! isset( $valid_tags[ $itemtag ] ) )
    $itemtag = 'dl';
  if ( ! isset( $valid_tags[ $captiontag ] ) )
    $captiontag = 'dd';
  if ( ! isset( $valid_tags[ $icontag ] ) )
    $icontag = 'dt';

  $columns = intval($columns);
  $itemwidth = $columns > 0 ? floor(100/$columns) : 100;
  $float = is_rtl() ? 'right' : 'left';

  $selector = "gallery-{$instance}";

  $gallery_style = $gallery_div = '';
  if ( apply_filters( 'use_default_gallery_style', true ) )
    $gallery_style = "
  <style type='text/css'>
        #{$selector} {
    margin: auto;
  }
        #{$selector} .gallery-item {
  float: {$float};
  margin-top: 10px;
  text-align: center;
  width: {$itemwidth}%;
}
        #{$selector} img {
border: 2px solid #cfcfcf;
}
        #{$selector} .gallery-caption {
margin-left: 0;
}
</style>
<!-- see gallery_shortcode() in wp-includes/media.php -->";
$size_class = sanitize_html_class( $size );
$gallery_div = "<div id='$selector' class='gallery galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class}'>";
$output = apply_filters( 'gallery_style', $gallery_style . "\n\t\t" . $gallery_div );

$i = 0;
foreach ( $attachments as $id => $attachment ) {
    //$link = isset($attr['link']) && 'file' == $attr['link'] ? wp_get_attachment_link($id, $size, false, false) : wp_get_attachment_link($id, $size, true, false);
  $thumb = $attachments[$id];
  $thumburl = ($attr['size'] == 'full') ? wp_get_attachment_url($id) : wp_get_attachment_thumb_url($id);
  $link=$thumb->guid;
  $title=get_the_title($id);
  $alt = get_post_meta($id, '_wp_attachment_image_alt', true);
  $caption = $attachment->post_excerpt;
  $thumbhtml = '<img src="' . $thumburl . '" alt="' . $alt . '" />';
  $output .= "<{$itemtag} class='gallery-item'>";
  $output .= "
  <{$icontag} class='gallery-icon'><a href='" . $link . "'' title='" . $title . "'><div class='gallery-img-container'>
  $thumbhtml
</div><div class='gallery-title'>". $title ."</div></a>";


if ( $captiontag && trim($attachment->post_excerpt) ) {
  $output .= "
  <div class='gallery-caption'>
    " . wptexturize($attachment->post_excerpt) . "
  </div>";
}
$output .= " </{$icontag}></{$itemtag}>";
$i++;
}

$output .= "
<br style='clear: both;' />
</div>\n";

return $output;

}

function base_pagination() {
  global $wp_query;

    $big = 999999999; // This needs to be an unlikely integer

    // For more options and info view the docs for paginate_links()
    // http://codex.wordpress.org/Function_Reference/paginate_links

    $paginate_links = paginate_links( array(
      'base' => str_replace( $big, '%#%', get_pagenum_link($big) ),
      'current' => max( 1, get_query_var('paged') ),
      'total' => $wp_query->max_num_pages,
      'mid_size' => 5,
      'prev_text'    => '',
      'next_text'    => '',
      ) );

    // Display the pagination if more than one page is found
    if ( $paginate_links ) {

      echo '<div class="pagination">';
      echo 'Pages: ';
      echo $paginate_links;
      echo '</div><!--// end .pagination -->';
    }
  }

