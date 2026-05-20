<?php
add_action( 'after_setup_theme', 'lkba_theme_setup' );
function lkba_theme_setup() {
	load_theme_textdomain( 'lkba_vod', get_template_directory() . '/languages' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	global $content_width;
	if ( ! isset( $content_width ) ) $content_width = 640;


	register_nav_menus( array(
		'main-menu'    => __( 'Hlavni Menu', 'lkba_vod' ),
		'fcbk-insta' => __( 'Social links', 'lkba_vod' ),
		'lang-menu' => __( 'Languages', 'lkba_vod' ),
		// 'selekce-menu'    => __( 'Selection Menu', 'lkba_vod' ),
		// 'index-menu'    => __( 'Index Menu', 'lkba_vod' ),
		'footer-menu'    => __( 'Footer Menu', 'lkba_vod' ),
		// 'support' => __( 'Podpora', 'lkba_vod' ),
	) );
}

add_action( 'comment_form_before', 'lkba_theme_enqueue_comment_reply_script' );
function lkba_theme_enqueue_comment_reply_script() {
	if ( get_option( 'thread_comments' ) ) { wp_enqueue_script( 'comment-reply' ); }
}
add_filter( 'the_title', 'lkba_theme_title' );
function lkba_theme_title( $title ) {
	if ( $title == '' ) {
		return '&rarr;';
	} else {
		return $title;
	}
}

function wp_example_excerpt_length( $length ) {
    return 12;
}
add_filter( 'excerpt_length', 'wp_example_excerpt_length');

// REMOVE HARDCODED WIDTH & HEIGHT INLINE IN THUMBNAIL
add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10, 3 );

function remove_thumbnail_dimensions( $html, $post_id, $post_image_id ) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}
// END REMOVE WIDTH & HEIGHT

add_filter( 'wp_title', 'lkba_theme_filter_wp_title' );
function lkba_theme_filter_wp_title( $title ) {
	return $title . esc_attr( get_bloginfo( 'name' ) );
}
add_action( 'widgets_init', 'lkba_theme_widgets_init' );
function lkba_theme_widgets_init() {
	// Arguments used in all register_sidebar() calls.
	$shared_args = array(
		'before_title'  => '<!-- ',
		'after_title'   => ' -->',
		// 'before_widget' => '<div class="widget %2$s"><div class="widget-content">',
		'before_widget' => ' ',
		// 'after_widget'  => '</div></div>',
		'after_widget'  => ' ',
	);

	register_sidebar( 
		array_merge(
			$shared_args,
			array (
				'name' => __( 'Footer', 'lkba_vod' ),
				'id' => 'footer-widget-area',
				// 'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
				// 'after_widget' => "</li>",
				// 'before_title' => '<h3 class="widget-title">',
				// 'after_title' => '</h3>',
			)
		)
	);

	register_sidebar( 
		array_merge(
			$shared_args,
			array (
				'name' => __( 'Social links', 'lkba_vod' ),
				'id' => 'sociallinks-widget-area'
			)
		)
	);
}
function lkba_theme_custom_pings( $comment ) {
	$GLOBALS['comment'] = $comment;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php echo comment_author_link(); ?></li>
	<?php 
}
add_filter( 'get_comments_number', 'lkba_theme_comments_number' );

function lkba_theme_comments_number( $count ) {
	if ( !is_admin() ) {
		global $id;
		$temp_comments = get_comments( 'status=approve&post_id=' . $id );
		$comments_by_type = separate_comments( $temp_comments );
		return count( $comments_by_type['comment'] );
	} else {
		return $count;
	}
}

add_action( 'wp_enqueue_scripts', 'lkba_vod_scripts' );
function lkba_vod_scripts() {
	wp_register_script('lkba_vod-lazysizes', get_template_directory_uri() . '/assets/js/libs/lazysizes.min.js', array(), '1.0.1', true);
	wp_enqueue_script('lkba_vod-lazysizes');
	wp_register_script('lkba_vod-picturefill', get_template_directory_uri() . '/assets/js/libs/picturefill.min.js', array(), '1.0.1', true);
	wp_enqueue_script('lkba_vod-picturefill');
}
/* / — / — / — / — / — / — / — / — / — */
/* / — / — / — / — / — / — / — / — / — */
/* WRAP THE POST CONTENT IN CUSTOM DIV */
/* / — / — / — / — / — / — / — / — / — */
/* / — / — / — / — / — / — / — / — / — */
function wrap_content_in_div($content) {
    global $post;
    return '<div class="flow layout-grid">'.$content.'</div>';
}
// add_filter('the_content', 'wrap_content_in_div');
/* / — / — / — / — / — / — / — / — / — */
/* / — / — / — / — / — / — / — / — / — */
/* / — / — / — / — / — / — / — / — / — */
/* / — / — / — / — / — / — / — / — / — */


/*	 — — —  — — — — — — — — — — — — */
/*	 — — —  — — — — — — — — — — — — */
/*	 — — —  — — — — — — — — — — — — */
/*	 — — —  — — — — — — — — — — — — */
/* ACF CUSTOM BLOCKS
/*	 — — —  — — — — — — — — — — — — */

/*/
add_action( 'init', 'register_acf_blocks', 5 );
function register_acf_blocks() {
    register_block_type( __DIR__ . '/blocks/block-gmap' );
    register_block_type( __DIR__ . '/blocks/block-cenik-table' );
    register_block_type( __DIR__ . '/blocks/block-rozvrh-table' );
    register_block_type( __DIR__ . '/blocks/block-custom-columns' );
    register_block_type( __DIR__ . '/blocks/block-custom-column-item' );
    // register_block_type( __DIR__ . '/blocks/block-hp-grid-item');
    // register_block_type( __DIR__ . '/blocks/block-grid-row' );
}
/*/

add_action( 'init', 'register_acf_blocks', 5 );
function register_acf_blocks() {
    foreach ( glob( __DIR__ . '/blocks/block-*' ) as $block_path ) {
        register_block_type( $block_path );
    }
    // Register js files in block directories
    // You'll have to name your js file "block-my-block-name.js" so that it adds the right name space for the block.
    foreach ( glob(__DIR__ . '/blocks/block-*/*.js') as $path) {
        $file_name = pathinfo($path, PATHINFO_FILENAME);
        wp_register_script( $file_name, get_stylesheet_directory_uri() . '/blocks/' . $file_name . '/' . $file_name . '.js', '', '');
        wp_enqueue_script( $file_name );
    }
    foreach ( glob(__DIR__ . '/blocks/block-*/*.css') as $path) {
        $style_name = pathinfo($path, PATHINFO_FILENAME);
        // wp_register_style( $style_name, get_stylesheet_directory_uri() . '/blocks/' . $style_name . '/' . $style_name . '.css', '', '');
        // wp_enqueue_style( $style_name );
    }
}
add_filter( 'acf/blocks/wrap_frontend_innerblocks', 'acf_should_wrap_innerblocks', 10, 2 );
function acf_should_wrap_innerblocks( $wrap, $name ) {
    // if ( $name == 'acf/test-block' ) {
        // return true;
    // }
    return false;
}
//*/


// Gutenberg custom stylesheet
#add_theme_support('editor-styles');
#add_editor_style( 'editor-style.css' ); // make sure path reflects where the file is located

/* / — / — / — / — / — / – */
/* / — / — / — / — / — / – */
/* CUSTOMIZE WP LOGIN PAGE */
/* / — / — / — / — / — / – */

function my_login_logo() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 300 150'%3E%3Cpath fill='%2312120D' d='m117.879 64.878 1.679-13.17h-1.049c-2.781 8.973-5.352 11.281-14.796 11.281h-1.626c-1.627 0-2.151-.42-2.151-2.151v-26.39c0-5.457.157-6.034 5.194-6.716v-.945H87.554v.945c5.036.682 5.194 1.259 5.194 6.715v22.718c0 5.352-.158 6.139-5.195 6.716v.944h19.623c2.046 0 8.237.053 10.703.053Zm2.256 52.326-13.851-15.897 8.395-7.765c5.823-5.404 7.187-6.558 10.598-6.978v-.944h-12.959v.944c5.561.42 4.669 2.256-.578 7.083l-11.7 10.86h-.052l12.33 14.376c1.836 2.151 1.783 3.568-1.732 3.83v.945h16.894v-.945c-3.148-.42-4.197-1.784-7.345-5.509Zm-20.2-1.154V93.332c0-5.456.158-6.034 5.195-6.716v-.944H87.554v.944c5.036.682 5.194 1.26 5.194 6.716v22.718c0 5.351-.158 6.138-5.195 6.716v.944h17.577v-.944c-5.037-.578-5.194-1.365-5.194-6.716ZM208.89 53.405c0-5.124-2.623-7.625-5.823-9.077 2.291-1.434 4.319-4.634 4.319-8.272 0-7.94-6.925-9.863-13.921-9.863h-14.568V64.86h15.53c7.888 0 14.463-3.148 14.463-11.472v.017Zm-23.207-21.773h8.429c3.848 0 6.401 1.766 6.401 5.176 0 3.848-2.396 5.544-6.401 5.544h-8.429v-10.72Zm0 15.897h8.639c5.177 0 7.573 1.871 7.573 5.876 0 4.005-2.344 6.034-7.205 6.034h-9.007v-11.91Zm10.878 37.443h-7.153l-14.411 38.668h6.926l2.99-8.587h15.688l3.043 8.587h7.415l-14.516-38.668h.018Zm-9.654 24.432 5.824-16.597 5.876 16.597H186.907Zm-37.408 33.579h3.497V6.85h-3.497V143v-.017Z'/%3E%3C/svg%3E");
			height:150px;
			width:320px;
			background-size: contain;
			background-repeat: no-repeat;
			padding-bottom: 30px;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );

function my_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

function my_login_logo_url_title() {
    return esc_attr( get_bloginfo( 'name' ) );
    // return $title . esc_attr( get_bloginfo( 'name' ) );
}
add_filter( 'login_headertext', 'my_login_logo_url_title' );

/* / — / — / — / — / — / – */
/* CUSTOMIZE WP LOGIN PAGE */
/* / — / — / — / — / — / – */
/* / — / — / — / — / — / – */



// Adds support for editor color palette.

function my_theme_add_new_features() {

    // The new colors we are going to add
    $newColorPalette = [
        [
            'name'  => __( 'Krémová', 'lkba_vod' ),
			'slug'  => 'cream',
			'color'	=> '#EEE7D6',
        ],
        [
            'name'  => __( 'Rudá', 'lkba_vod' ),
			'slug'  => 'red',
			'color'	=> '#E92F3D',
        ],
        [
            'name'  => __( 'Zelená', 'lkba_vod' ),
			'slug'  => 'green',
			'color' => '#00573F',
        ],
        [
            'name'  => __( 'Dark', 'lkba_vod' ),
			'slug'  => 'black',
			'color' => '#000000',
        ],
    ];

    // Apply the color palette containing the original colors and 2 new colors:
    add_theme_support( 'editor-color-palette', $newColorPalette);
    // Disables color picker in block color palette.
    add_theme_support( 'disable-custom-colors' );
}
add_action( 'after_setup_theme', 'my_theme_add_new_features' );

/* / — / — / — / — / — / – / — / — / — / — / – */
/* / — / — / — / — / — / – / — / — / — / — / – */
/* KEEP TAGS ORDER AS INSERTED IN POST DETAILS */
/* / — / — / — / — / — / – / — / — / — / — / – */
/* / — / — / — / — / — / – / — / — / — / — / – */
require_once('includes/SlashAdmin.php');
$class = new TaxonomyOrder();

// Load Gutenberg Editor Styles
function custom_gutenberg_editor_styles() {
    wp_enqueue_style(
        'admin-styles',
        get_stylesheet_directory_uri().'/style-editor.css?v02-11-2023.01'
    );
}
add_action( 'admin_enqueue_scripts', 'custom_gutenberg_editor_styles' );

// add_post_type_support( 'post', 'page-attributes' );

/* WORK AROUND WP NASTY BUG PREPENDING AUTO TO SIZES ATTR */
add_filter(
        'wp_content_img_tag',
        static function ( $image ) {
                return str_replace( ' sizes="auto, ', ' sizes="', $image );
        }
);
add_filter(
        'wp_get_attachment_image_attributes',
        static function ( $attr ) {
                if ( isset( $attr['sizes'] ) ) {
                        $attr['sizes'] = preg_replace( '/^auto, /', '', $attr['sizes'] );
                }
                return $attr;
        }
);

// if(! has_filter('wp_nav_menu', 'do_shortcode')) :
// 	add_filter('wp_nav_menu', 'shortcode_unautop'); 
// 	add_filter('wp_nav_menu', 'do_shortcode', 20); 
// endif;

function custom_login_logout_shortcode() {
	if( is_user_logged_in() ) :
		// USER IS LOGGED IN
		$link = wp_logout_url( home_url() );
		$text = 'Logout';
	else:
		$link = wp_login_url( get_permalink() );
		$text = 'Login';
	endif;

	// return '<a href="' . esc_url( $link ) . '">' . esc_html($text) . '</a>';
	return '<div class="wp-block-button is-style-outline button"><a class="wp-block-button__link wp-element-button" href="' . esc_url( $link ) . '">' . __($text) . '</a></div>';
}
add_shortcode( 'login_logout_link', 'custom_login_logout_shortcode' ); // [login_logout_link]

function custom_register_shortcode() {
	if( !is_user_logged_in() ) :
		$link = '/register/';
		$text = 'Register';
	else :
		return;
	endif;
	
	// return '<a href="' . esc_url( $link ) . '">' . esc_html($text) . '</a>';
	return '<div class="wp-block-button is-style-outline button"><a class="wp-block-button__link wp-element-button" href="' . esc_url( $link ) . '">' . __($text) . '</a></div>';
}

add_shortcode( 'register_link', 'custom_register_shortcode' ); // [register_link]

function custom_password_shortcode() {
	if( is_user_logged_in() ) :
		$link = '/nastavte-si-heslo/';
		$text = 'Reset password';
	else :
		return;
	endif;

	// return '<a href="' . esc_url( $link ) . '">' . esc_html($text) . '</a>';
	return '<div class="wp-block-button is-style-filled button"><a class="wp-block-button__link wp-element-button" href="' . esc_url( $link ) . '">' . __($text) . '</a></div>';
}
add_shortcode( 'password_link', 'custom_password_shortcode' ); // [password_link]


// HIDE WP ADMIN BAR FOR VOD MEMBERS = WP SUBSCRIBERS
function hide_admin_bar_for_subscribers() {
	if( current_user_can('subscriber')) :
		show_admin_bar(false);
	endif;
}
add_action('after_setup_theme', 'hide_admin_bar_for_subscribers');

// REDIRECT WHEN NONADMIN TRIES TO ACCESS ADMIN PAGE
function restrict_admin_access() {
	if( is_admin() && !current_user_can('edit_posts') && !wp_doing_ajax() ) :
		wp_redirect(home_url());
		exit;
	endif;
}
add_action('init', 'restrict_admin_access');

/**
 * Load translations for wpdocs_theme
 */
function wpdocs_theme_setup(){
    load_theme_textdomain('lkba_vod', get_template_directory() . '/languages');
}

function ww_load_dashicons(){
	wp_enqueue_style('dashicons');
}
add_action('wp_enqueue_scripts', 'ww_load_dashicons');

/* / — / — / — / — / — / – / — / — / — / — / – */
/* / — / — / — / — / — / – / — / — / — / — / – */
/*  / — / — / FIX CREATE ORDER ERROR / — / — / */
/* / — / — / — / — / — / – / — / — / — / — / – */
/* / — / — / — / — / — / – / — / — / — / — / – */
// Run once to add missing column - remove after running
/*
add_action('init', function() {
    if (isset($_GET['dl_fix_db']) && current_user_can('manage_options')) {
        global $wpdb;
        $orders_table = $wpdb->prefix . 'dl_orders';
        
        $column_exists = $wpdb->get_results("SHOW COLUMNS FROM $orders_table LIKE 'invoice_data'");
        
        if (empty($column_exists)) {
            $wpdb->query("ALTER TABLE $orders_table ADD COLUMN invoice_data longtext DEFAULT NULL AFTER transaction_id");
            echo 'Column added!';
        } else {
            echo 'Column already exists.';
        }
        exit;
    }
});
// THEN VISIT
// https://yoursite.com/?dl_fix_db=1
// THEN REMOVE THIS FUNCTION
*/