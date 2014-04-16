<?php

// No direct Access
defined('ABSPATH') or die("Cannot access pages directly.");

/*
Author: Bamboothemes 
URL: bamboothemes.com

Built on Bones and Redux Options Panel 
*/


// LOAD BONES CORE (if you remove this, the theme will break)
require_once( 'library/bones.php' );

// USE THIS TEMPLATE TO CREATE CUSTOM POST TYPES EASILY
//require_once( 'library/custom-post-type.php' );


/************* Extra functionality for Bamboothemes separate files to make it easy to upgrade Bones *************/
require_once( 'library/bamboo/bamboo.php' ); 


// CUSTOMIZE THE WORDPRESS ADMIN (off by default)
//require_once( 'library/admin.php' );

/*********************
LAUNCH BONES
Let's get everything up and running.
*********************/

function bones_ahoy() {

  // let's get language support going, if you need it
  load_theme_textdomain( 'bonestheme', get_template_directory() . '/library/translation' );

  // launching operation cleanup
  add_action( 'init', 'bones_head_cleanup' );
  // A better title
  add_filter( 'wp_title', 'rw_title', 10, 3 );
  // remove WP version from RSS
  add_filter( 'the_generator', 'bones_rss_version' );
  // remove pesky injected css for recent comments widget
  add_filter( 'wp_head', 'bones_remove_wp_widget_recent_comments_style', 1 );
  // clean up comment styles in the head
  add_action( 'wp_head', 'bones_remove_recent_comments_style', 1 );
  // clean up gallery output in wp
  add_filter( 'gallery_style', 'bones_gallery_style' );

  // enqueue base scripts and styles
  add_action( 'wp_enqueue_scripts', 'bones_scripts_and_styles', 999 );
  // ie conditional wrapper

  // launching this stuff after theme setup
  bones_theme_support();

  // adding sidebars to Wordpress (these are created in functions.php)
  add_action( 'widgets_init', 'bones_register_sidebars' );

  // cleaning up random code around images
  add_filter( 'the_content', 'bones_filter_ptags_on_images' );
  // cleaning up excerpt
  add_filter( 'excerpt_more', 'bones_excerpt_more' );

} /* end bones ahoy */

// let's get this party started
add_action( 'after_setup_theme', 'bones_ahoy' );


/************* OEMBED SIZE OPTIONS *************/

if ( ! isset( $content_width ) ) {
	$content_width = 640;
}


/************* Redux Framework *************/

if ( !class_exists( 'ReduxFramework' ) && file_exists( dirname( __FILE__ ) . '/library/redux-framework/ReduxCore/framework.php' ) ) {
	require_once( dirname( __FILE__ ) . '/library/redux-framework/ReduxCore/framework.php' );
}
if ( !isset( $redux_demo ) && file_exists( dirname( __FILE__ ) . '/library/option-config.php' ) ) {
	require_once( dirname( __FILE__ ) . '/library/option-config.php' );
}

/************* THUMBNAIL SIZE OPTIONS *************/

// Thumbnail sizes
add_image_size( 'bones-thumb-600', 600, 150, true );
add_image_size( 'bones-thumb-300', 300, 100, true );
add_image_size( 'bones-thumb-900', 900, 300, true );


/*
to add more sizes, simply copy a line from above
and change the dimensions & name. As long as you
upload a "featured image" as large as the biggest
set width or height, all the other sizes will be
auto-cropped.

To call a different size, simply change the text
inside the thumbnail function.

For example, to call the 300 x 300 sized image,
we would use the function:
<?php the_post_thumbnail( 'bones-thumb-300' ); ?>
for the 600 x 100 image:
<?php the_post_thumbnail( 'bones-thumb-600' ); ?>

You can change the names and dimensions to whatever
you like. Enjoy!
*/

add_filter( 'image_size_names_choose', 'bones_custom_image_sizes' );

function bones_custom_image_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'bones-thumb-900' => __('900px by 300px'),
        'bones-thumb-600' => __('600px by 150px'),
        'bones-thumb-300' => __('300px by 100px'),
    ) );
}

 
 
/*
The function above adds the ability to use the dropdown menu to select 
the new images sizes you have just created from within the media manager 
when you add media to your content blocks. If you add more image sizes, 
duplicate one of the lines in the array and name it according to your 
new image size.
*/

/************* ACTIVE SIDEBARS ********************/

// Sidebars & Widgetizes Areas
function bones_register_sidebars() {
		

	register_sidebar( array(
	  'name'          => __( 'Search', 'bonestheme' ),
	  'id'            => 'search',
	  'before_widget' => '<section id="%1$s" class="widget %2$s">',
	  'after_widget'  => '</section>',
	  'before_title'  => '<h3>',
	  'after_title'   => '</h3>',
	));
	
	register_sidebar( array(
	  'name'          => __( 'Banner', 'bonestheme' ),
	  'id'            => 'banner',
	  'before_widget' => '<section id="%1$s" class="widget %2$s">',
	  'after_widget'  => '</section>',
	  'before_title'  => '<h3>',
	  'after_title'   => '</h3>',
	));
	
	register_sidebar( array(
	  'name'          => __( 'Above Content', 'bonestheme' ),
	  'id'            => 'above-content',
	  'before_widget' => '<section id="%1$s" class="widget %2$s">',
	  'after_widget'  => '</section>',
	  'before_title'  => '<h3>',
	  'after_title'   => '</h3>',
	));
	
	register_sidebar( array(
	  'name'          => __( 'Primary Sidebar', 'bonestheme' ),
	  'id'            => 'sidebar-primary',
	  'before_widget' => '<section id="%1$s" class="widget %2$s">',
	  'after_widget'  => '</section>',
	  'before_title'  => '<h3>',
	  'after_title'   => '</h3>',
	));	
	register_sidebar( array(
	  'name'          => __( 'Secondary Sidebar', 'bonestheme' ),
	  'id'            => 'sidebar-secondary',
	  'before_widget' => '<section id="%1$s" class="widget %2$s">',
	  'after_widget'  => '</section>',
	  'before_title'  => '<h3>',
	  'after_title'   => '</h3>',
	));
	
	register_sidebar( array(
	  'name'          => __( 'Offcanvas Above', 'bonestheme' ),
	  'id'            => 'offcanvas-above',
	  'before_widget' => '<section id="%1$s" class="widget %2$s">',
	  'after_widget'  => '</section>',
	  'before_title'  => '<h3>',
	  'after_title'   => '</h3>',
	));	
	
	register_sidebar( array(
	  'name'          => __( 'Offcanvas Below', 'bonestheme' ),
	  'id'            => 'offcanvas-below',
	  'before_widget' => '<section id="%1$s" class="widget %2$s">',
	  'after_widget'  => '</section>',
	  'before_title'  => '<h3>',
	  'after_title'   => '</h3>',
	));	
	
	
	register_sidebar( array(
	  'name'          => __( 'Below Content', 'bonestheme' ),
	  'id'            => 'below-content',
	  'before_widget' => '<section id="%1$s" class="widget %2$s">',
	  'after_widget'  => '</section>',
	  'before_title'  => '<h3>',
	  'after_title'   => '</h3>',
	));
	
	register_sidebar( array(
	  'name'          => __( 'Footer', 'bonestheme' ),
	  'id'            => 'footer',
	  'before_widget' => '<section id="%1$s" class="widget %2$s">',
	  'after_widget'  => '</section>',
	  'before_title'  => '<h3>',
	  'after_title'   => '</h3>',
	));
	

	/*
	to add more sidebars or widgetized areas, just copy
	and edit the above sidebar code. In order to call
	your new sidebar just use the following code:

	Just change the name to whatever your new
	sidebar's id is, for example:

	register_sidebar(array(
		'id' => 'sidebar2',
		'name' => __( 'Sidebar 2', 'bonestheme' ),
		'description' => __( 'The second (secondary) sidebar.', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>',
	));

	To call the sidebar in your template, you can just copy
	the sidebar.php file and rename it to your sidebar's name.
	So using the above example, it would be:
	sidebar-sidebar2.php

	*/
} // don't remove this bracket!

/************* COMMENT LAYOUT *********************/

// Comment Layout
function bones_comments( $comment, $args, $depth ) {
   $GLOBALS['comment'] = $comment; ?>
  <div id="comment-<?php comment_ID(); ?>" <?php comment_class('cf'); ?>>
    <article  class="cf">
      <header class="comment-author vcard">
        <?php
        /*
          this is the new responsive optimized comment image. It used the new HTML5 data-attribute to display comment gravatars on larger screens only. What this means is that on larger posts, mobile sites don't have a ton of requests for comment images. This makes load time incredibly fast! If you'd like to change it back, just replace it with the regular wordpress gravatar call:
          echo get_avatar($comment,$size='32',$default='<path_to_url>' );
        */
        ?>
        <?php // custom gravatar call ?>
        <?php
          // create variable
          $bgauthemail = get_comment_author_email();
        ?>
        <img data-gravatar="http://www.gravatar.com/avatar/<?php echo md5( $bgauthemail ); ?>?s=40" class="load-gravatar avatar avatar-48 photo" height="40" width="40" src="<?php echo get_template_directory_uri(); ?>/library/images/nothing.gif" />
        <?php // end custom gravatar call ?>
        <?php printf(__( '<cite class="fn">%1$s</cite> %2$s', 'bonestheme' ), get_comment_author_link(), edit_comment_link(__( '(Edit)', 'bonestheme' ),'  ','') ) ?>
        <time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time(__( 'F jS, Y', 'bonestheme' )); ?> </a></time>

      </header>
      <?php if ($comment->comment_approved == '0') : ?>
        <div class="alert alert-info">
          <p><?php _e( 'Your comment is awaiting moderation.', 'bonestheme' ) ?></p>
        </div>
      <?php endif; ?>
      <section class="comment_content cf">
        <?php comment_text() ?>
      </section>
      <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
    </article>
  <?php // </li> is added by WordPress automatically ?>
<?php
} // don't remove this bracket!



/************* Functions below are Bamboothemes specific. *************/
/**************************/


/************* Adds UI Kit core js files *************/


function add_theme_scripts() {
	wp_enqueue_script(
		'theme_scripts',
		get_stylesheet_directory_uri() . '/js/theme.lib.min.js',
		array( 'jquery' )
	);
	
}

add_action( 'wp_enqueue_scripts', 'add_theme_scripts' );



/************* Theme Breadcrumbs *************/
function the_breadcrumb() {
 	global $bamboo;
 	
 	if($bamboo['breadcrumb']) {
        
       	global $post;
        
        $separator = '<span class="breadcrumb-separator">'.$bamboo['breadcrumb-sep'].'</span>';
 
        if (!is_home()) {
 
            echo "<a href='";
            echo get_option('home');
            echo "'>";
            echo "Home";
            echo "</a>";
 
            if (is_category() || is_single()) {
 
                echo $separator;
                $cats = get_the_category( $post->ID );
 
                foreach ( $cats as $cat ){
                    echo $cat->cat_name;
                    echo $separator;
                }
                if (is_single()) {
                    the_title();
                }
            } elseif (is_page()) {
 
                if($post->post_parent){
                    $anc = get_post_ancestors( $post->ID );
                    $anc_link = get_page_link( $post->post_parent );
 
                    foreach ( $anc as $ancestor ) {
                        $output =  $separator.'<a href=".$anc_link.">".get_the_title($ancestor)."</a> "'.$separator;;
                    }
 
                    echo $output;
                    the_title();
 
                } else {
                     echo $separator;
                    echo the_title();
                }
            }
        }
	    elseif (is_tag()) {single_tag_title();}
	    elseif (is_day()) {echo"Archive: "; the_time('F jS, Y'); echo'</li>';}
	    elseif (is_month()) {echo"Archive: "; the_time('F, Y'); echo'</li>';}
	    elseif (is_year()) {echo"Archive: "; the_time('Y'); echo'</li>';}
	    elseif (is_author()) {echo"Author's archive: "; echo'</li>';}
	    elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {echo "Blogarchive: "; echo'';}
	    elseif (is_search()) {echo"Search results: "; }
    }
}


/************* Author Posts *************/
function my_get_display_author_posts() {
    global $authordata, $post;

    $authors_posts = get_posts( array( 'author' => $authordata->ID, 'post__not_in' => array( $post->ID ) ) );

    $output = '<ul>';
    foreach ( $authors_posts as $authors_post ) {
        $output .= '<li><a href="' . get_permalink( $authors_post->ID ) . '">' . apply_filters( 'the_title', $authors_post->post_title, $authors_post->ID ) . '</a></li>';
    }
    $output .= '</ul>';

    return $output;
}


/************* Register thes *************/
function offcanvas_menu() {
	register_nav_menu ('offcanvas', __( 'Off Canvas Menu', '' ));
}
add_action( 'after_setup_theme', 'offcanvas_menu' );


function sidebar_menu() {
	register_nav_menu ('sidebar', __( 'Sidebar Menu', '' ));
}
add_action( 'after_setup_theme', 'sidebar_menu' );

?>