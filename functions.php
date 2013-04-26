<?php
/*
Author: Eddie Machado
URL: htp://themble.com/bones/

This is where you can drop your custom functions or
just edit things like thumbnail sizes, header images,
sidebars, comments, ect.
*/

/************* INCLUDE NEEDED FILES ***************/

/*
1. library/bones.php
    - head cleanup (remove rsd, uri links, junk css, ect)
	- enqeueing scripts & styles
	- theme support functions
    - custom menu output & fallbacks
	- related post function
	- page-navi function
	- removing <p> from around images
	- customizing the post excerpt
	- custom google+ integration
	- adding custom fields to user profiles
*/
require_once('library/bones.php'); // if you remove this, bones will break
/*
2. library/custom-post-type.php
    - an example custom post type
    - example custom taxonomy (like categories)
    - example custom taxonomy (like tags)
*/
require_once('library/custom-post-type.php'); // you can disable this if you like
/*
3. library/admin.php
    - removing some default WordPress dashboard widgets
    - an example custom dashboard widget
    - adding custom login css
    - changing text in footer of admin
*/
// require_once('library/admin.php'); // this comes turned off by default
/*
4. library/translation/translation.php
    - adding support for other languages
*/
// require_once('library/translation/translation.php'); // this comes turned off by default

/************* THUMBNAIL SIZE OPTIONS *************/

// Thumbnail sizes
add_image_size( 'bones-thumb-600', 600, 150, true );
add_image_size( 'bones-thumb-300', 300, 100, true );
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

/************* ACTIVE SIDEBARS ********************/

// Sidebars & Widgetizes Areas
function bones_register_sidebars() {
    register_sidebar(array(
    	'id' => 'sidebar1',
    	'name' => 'Sidebar 1',
    	'description' => 'The first (primary) sidebar.',
    	'before_widget' => '<div id="%1$s" class="widget %2$s">',
    	'after_widget' => '</div>',
    	'before_title' => '<h4 class="widgettitle">',
    	'after_title' => '</h4>',
    ));

    /*
    to add more sidebars or widgetized areas, just copy
    and edit the above sidebar code. In order to call
    your new sidebar just use the following code:

    Just change the name to whatever your new
    sidebar's id is, for example:

    register_sidebar(array(
    	'id' => 'sidebar2',
    	'name' => 'Sidebar 2',
    	'description' => 'The second (secondary) sidebar.',
    	'before_widget' => '<div id="%1$s" class="widget %2$s">',
    	'after_widget' => '</div>',
    	'before_title' => '<h4 class="widgettitle">',
    	'after_title' => '</h4>',
    ));

    To call the sidebar in your template, you can just copy
    the sidebar.php file and rename it to your sidebar's name.
    So using the above example, it would be:
    sidebar-sidebar2.php

    */
} // don't remove this bracket!

/************* COMMENT LAYOUT *********************/

// Comment Layout
function bones_comments($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?>>
		<article id="comment-<?php comment_ID(); ?>" class="clearfix">
			<header class="comment-author vcard">
			    <?php /*
			        this is the new responsive optimized comment image. It used the new HTML5 data-attribute to display comment gravatars on larger screens only. What this means is that on larger posts, mobile sites don't have a ton of requests for comment images. This makes load time incredibly fast! If you'd like to change it back, just replace it with the regular wordpress gravatar call:
			        echo get_avatar($comment,$size='32',$default='<path_to_url>' );
			    */ ?>
			    <!-- custom gravatar call -->
			    <img data-gravatar="http://www.gravatar.com/avatar/<?php echo md5($bgauthemail); ?>&s=32" class="load-gravatar avatar avatar-48 photo" height="32" width="32" src="<?php echo get_template_directory_uri(); ?>/library/images/nothing.gif" />
			    <!-- end custom gravatar call -->
				<?php printf(__('<cite class="fn">%s</cite>'), get_comment_author_link()) ?>
				<time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time('F jS, Y'); ?> </a></time>
				<?php edit_comment_link(__('(Edit)', 'bonestheme'),'  ','') ?>
			</header>
			<?php if ($comment->comment_approved == '0') : ?>
       			<div class="alert info">
          			<p><?php _e('Your comment is awaiting moderation.', 'bonestheme') ?></p>
          		</div>
			<?php endif; ?>
			<section class="comment_content clearfix">
				<?php comment_text() ?>
			</section>
			<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
		</article>
    <!-- </li> is added by wordpress automatically -->
<?php
} // don't remove this bracket!

/************* SEARCH FORM LAYOUT *****************/

// Search Form
function bones_wpsearch($form) {
    $form = '<form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >
    <label class="screen-reader-text" for="s">' . __('Search for:', 'bonestheme') . '</label>
    <input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="'.esc_attr__('Search the Site...','bonestheme').'" />
    <input type="submit" id="searchsubmit" value="'. esc_attr__('Search') .'" />
    </form>';
    return $form;
} // don't remove this bracket!

/************* THEME MENU *****************/

//Initialize theme menu
function init_apperance_menu(){
     register_setting( 'theme_settings', 'theme_color');
     register_setting( 'theme_settings', 'theme_trackers' );
}

//Add theme menu
function add_appearance_menu(){
     add_theme_page("Theme Settings", "Theme Settings", "edit_theme_options","monModSettings", "monModSettings");
     }   

//Add actions to utilize above functions
add_action('admin_menu', 'add_appearance_menu');
add_action("admin_init", "init_apperance_menu");

//Render setting page
function monModSettings(){
    if ( ! isset( $_REQUEST['settings-updated'] ) )
    $_REQUEST['settings-updated'] = false;

?>

<div>

<div id="icon-options-general"></div>
<h2><?php _e( 'Theme Settings' ) //your admin panel title ?></h2>

<?php
//show saved options message
if ( false !== $_REQUEST['settings-updated'] ) { ?>
<div><p><strong><?php _e( 'Options saved' ); ?></strong></p></div>
<?php
$options = get_option('theme_color');
//Constructs stylesheet config file
$conf = "@alert-yellow:      #".$options['ay'].";
@alert-red:         #".$options["ar"].";
@alert-green:       #".$options["ag"].";
@alert-blue:        #".$options["ab"].";

@black:             #000;
@white:             #fff;

@base:              #".$options["base"].";
@link:              #".$options["link"].";
@bones-blue:        #1990db;
@content:           #".$options["content"].";";
file_put_contents(get_theme_root("Monarch Modern")."/MonarchModern-Dev/library/style/conf.inc.tmp", $conf); } ?>

<form method="post" action="options.php">
<?php settings_fields('theme_settings');
$options = get_option('theme_color');
$track = get_option('theme_trackers');
if(isset($theme_color[ay])) $theme_color = array();
add_action('admin_enqueue_scripts', 'my_admin_scripts');
function my_admin_scripts() {
        wp_enqueue_media();
        wp_register_script('upload-js', get_template_directory_uri().'/library/js/upload.js', array('jquery'));
        wp_enqueue_script('upload-js');
}?>
    <h2>Colors</h2>
<table>
<?//Alert Colors ?>
<tr valign="top">
<th scope="row"><?php _e( 'Alert(Yellow)' ); ?></th>
<td>#<input id="theme_settings[ay]" type="text" size="36" name="theme_color[ay]" value="<?php esc_attr_e( $options['ay'] ); ?>" />
<label for="theme_settings[ay]"></label></td>
</tr>

<tr valign="top">
<th scope="row"><?php _e( 'Alert(Red)' ); ?></th>
<td>#<input id="theme_settings[ar]" type="text" size="36" name="theme_color[ar]" value="<?php esc_attr_e( $options['ar'] ); ?>" />
<label for="theme_settings[ar]"></label></td>
</tr>

<tr valign="top">
<th scope="row"><?php _e( 'Alert(green)' ); ?></th>
<td>#<input id="theme_settings[ag]" type="text" size="36" name="theme_color[ag]" value="<?php esc_attr_e( $options['ag'] ); ?>" />
<label for="theme_settings[ag]"></label></td>
</tr>

<tr valign="top">
<th scope="row"><?php _e( 'Alert(Blue)' ); ?></th>
<td>#<input id="theme_settings[ab]" type="text" size="36" name="theme_color[ab]" value="<?php esc_attr_e( $options['ab'] ); ?>" />
<label for="theme_settings[ab]"></label></td>
</tr>

<tr valign="top">
<th scope="row"><?php _e( 'Base Color' ); ?></th>
<td>#<input id="theme_settings[base]" type="text" size="36" name="theme_color[base]" value="<?php esc_attr_e( $options['base'] ); ?>" />
<label for="theme_settings[base]"></label></td>
</tr>

<tr valign="top">
<th scope="row"><?php _e( 'Hyperlink Color' ); ?></th>
<td>#<input id="theme_settings[link]" type="text" size="36" name="theme_color[link]" value="<?php esc_attr_e( $options['link'] ); ?>" />
<label for="theme_settings[link]"></label></td>
</tr>

<tr valign="top">
<th scope="row"><?php _e( 'Content Color' ); ?></th>
<td>#<input id="theme_settings[content]" type="text" size="36" name="theme_color[content]" value="<?php esc_attr_e( $options['content'] ); ?>" />
<label for="theme_settings[content]"></label></td>
</tr>
</table>
    
    <h2>Icons and Stuff</h2>
<label for="upload_image"><h3>Logo</h3><br/>
    <input id="upload_image" type="text" size="36" name="theme_color[image]" value="<?php if (isset($theme_color["image"])) echo $theme_color["image"]; else echo "http://";?>" /> 
    <input id="upload_image_button" class="button" type="button" value="Upload Image" />
    <br />Enter a URL or upload an image
</label>
<br/>
<label for="upload_image"><h3>Favicon</h3><br/>
    <input id="upload_image" type="text" size="36" name="theme_color[image]" value="<?php if (isset($theme_color["image"])) echo $theme_color["image"]; else echo "http://";?>" /> 
    <input id="upload_image_button" class="button" type="button" value="Upload Image" />
    <br />Enter a URL or upload an image
</label>

<h2>Trackers</h2>

<table>
<tr valign="top">
<th scope="row"><?php _e( 'Tracking Code' ); ?></th>
<td><label for="theme_trackers[tracking]"><?php _e( 'Enter your Google Analytics tracking code <b>(UA-XXXXXXXX-X)</b>' ); ?></label>
<br />
<input type="text" id="theme_trackers[tracking]" name="theme_trackers[tracking]" size="36" value="<?php esc_attr_e( $track['tracking'] ); ?>"></td>
</tr>

<tr valign="top">
<th scope="row"><?php _e( 'Flag Counter' ); ?></th>
<td><label for="theme_settings[flag]"><?php _e( 'Enter your Flag Counter code from <a href = "http://flagcounter.com/">http://flagcounter.com/</a>(http://sXX.flagcounter.com/count/<b>XXXX</b>/...)' ); ?></label>
<br />
<input type="text" size="36" id="theme_trackers[flag]" name="theme_trackers[flag]" value="<?php esc_attr_e( $track['flag'] ); ?>"></td>
</tr>

<tr valign="top">
<th scope="row">Server Number</th>
<td>
<label for="theme_settings[server]"><?php _e("http://s<b>XX</b>.flagcounter.com/count...");?></label>
<br/>
<input type="text" size="36" id="theme_trackers[server]" name="theme_trackers[server]" value="<?php echo $track['server'];?>">
</td>
</tr>
</table>
<input name="updated" id="updated" value="1" type="hidden">
<p><input name="submit" id="submit" value="Save Changes" type="submit"></p>
</form>
</div><!-- END wrap -->

<?php
}
?>