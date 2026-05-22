<?php
/**
 * Theme bootstrap.
 *
 * @package lkba_vod
 */

require_once get_template_directory() . '/includes/theme-assets.php';
require_once get_template_directory() . '/includes/SlashAdmin.php';

add_action( 'after_setup_theme', 'lkba_theme_setup' );
function lkba_theme_setup() {
	load_theme_textdomain( 'lkba_vod', get_template_directory() . '/languages' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );

	global $content_width;
	if ( ! isset( $content_width ) ) {
		$content_width = 640;
	}

	register_nav_menus(
		array(
			'main-menu'   => __( 'Hlavni Menu', 'lkba_vod' ),
			'fcbk-insta'  => __( 'Social links', 'lkba_vod' ),
			'lang-menu'   => __( 'Languages', 'lkba_vod' ),
			'footer-menu' => __( 'Footer Menu', 'lkba_vod' ),
		)
	);
}

add_filter( 'the_title', 'lkba_theme_title' );
function lkba_theme_title( $title ) {
	if ( '' === $title ) {
		return '&rarr;';
	}
	return $title;
}

function lkba_theme_excerpt_length( $length ) {
	return 12;
}
add_filter( 'excerpt_length', 'lkba_theme_excerpt_length' );

add_filter( 'post_thumbnail_html', 'lkba_remove_thumbnail_dimensions', 10, 3 );
function lkba_remove_thumbnail_dimensions( $html ) {
	return preg_replace( '/(width|height)=\"\d*\"\s/', '', $html );
}

add_action( 'widgets_init', 'lkba_theme_widgets_init' );
function lkba_theme_widgets_init() {
	$shared_args = array(
		'before_title'  => '<!-- ',
		'after_title'   => ' -->',
		'before_widget' => ' ',
		'after_widget'  => ' ',
	);

	register_sidebar(
		array_merge(
			$shared_args,
			array(
				'name' => __( 'Footer', 'lkba_vod' ),
				'id'   => 'footer-widget-area',
			)
		)
	);

	register_sidebar(
		array_merge(
			$shared_args,
			array(
				'name' => __( 'Social links', 'lkba_vod' ),
				'id'   => 'sociallinks-widget-area',
			)
		)
	);
}

add_action( 'init', 'lkba_register_acf_blocks', 5 );
function lkba_register_acf_blocks() {
	foreach ( glob( get_template_directory() . '/blocks/block-*' ) as $block_path ) {
		if ( is_dir( $block_path ) ) {
			register_block_type( $block_path );
		}
	}
}

add_filter( 'acf/blocks/wrap_frontend_innerblocks', 'lkba_acf_should_wrap_innerblocks', 10, 2 );
function lkba_acf_should_wrap_innerblocks( $wrap, $name ) {
	unset( $wrap, $name );
	return false;
}

add_action( 'after_setup_theme', 'lkba_theme_editor_features' );
function lkba_theme_editor_features() {
	add_theme_support(
		'editor-color-palette',
		array(
			array(
				'name'  => __( 'Krémová', 'lkba_vod' ),
				'slug'  => 'cream',
				'color' => '#EEE7D6',
			),
			array(
				'name'  => __( 'Rudá', 'lkba_vod' ),
				'slug'  => 'red',
				'color' => '#E92F3D',
			),
			array(
				'name'  => __( 'Zelená', 'lkba_vod' ),
				'slug'  => 'green',
				'color' => '#00573F',
			),
			array(
				'name'  => __( 'Dark', 'lkba_vod' ),
				'slug'  => 'black',
				'color' => '#000000',
			),
		)
	);
	add_theme_support( 'disable-custom-colors' );
}

new TaxonomyOrder( array( 'post', 'page' ), array( 'category', 'post_tag' ) );

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

function lkba_login_logo() {
	?>
	<style type="text/css">
		#login h1 a, .login h1 a {
			background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 300 150'%3E%3Cpath fill='%2312120D' d='m117.879 64.878 1.679-13.17h-1.049c-2.781 8.973-5.352 11.281-14.796 11.281h-1.626c-1.627 0-2.151-.42-2.151-2.151v-26.39c0-5.457.157-6.034 5.194-6.716v-.945H87.554v.945c5.036.682 5.194 1.259 5.194 6.715v22.718c0 5.352-.158 6.139-5.195 6.716v.944h19.623c2.046 0 8.237.053 10.703.053Zm2.256 52.326-13.851-15.897 8.395-7.765c5.823-5.404 7.187-6.558 10.598-6.978v-.944h-12.959v.944c5.561.42 4.669 2.256-.578 7.083l-11.7 10.86h-.052l12.33 14.376c1.836 2.151 1.783 3.568-1.732 3.83v.945h16.894v-.945c-3.148-.42-4.197-1.784-7.345-5.509Zm-20.2-1.154V93.332c0-5.456.158-6.034 5.195-6.716v-.944H87.554v.944c5.036.682 5.194 1.26 5.194 6.716v22.718c0 5.351-.158 6.138-5.195 6.716v.944h17.577v-.944c-5.037-.578-5.194-1.365-5.194-6.716ZM208.89 53.405c0-5.124-2.623-7.625-5.823-9.077 2.291-1.434 4.319-4.634 4.319-8.272 0-7.94-6.925-9.863-13.921-9.863h-14.568V64.86h15.53c7.888 0 14.463-3.148 14.463-11.472v.017Zm-23.207-21.773h8.429c3.848 0 6.401 1.766 6.401 5.176 0 3.848-2.396 5.544-6.401 5.544h-8.429v-10.72Zm0 15.897h8.639c5.177 0 7.573 1.871 7.573 5.876 0 4.005-2.344 6.034-7.205 6.034h-9.007v-11.91Zm10.878 37.443h-7.153l-14.411 38.668h6.926l2.99-8.587h15.688l3.043 8.587h7.415l-14.516-38.668h.018Zm-9.654 24.432 5.824-16.597 5.876 16.597H186.907Zm-37.408 33.579h3.497V6.85h-3.497V143v-.017Z'/%3E%3C/svg%3E");
			height: 150px;
			width: 320px;
			background-size: contain;
			background-repeat: no-repeat;
			padding-bottom: 30px;
		}
	</style>
	<?php
}
add_action( 'login_enqueue_scripts', 'lkba_login_logo' );

add_filter(
	'login_headerurl',
	static function () {
		return home_url();
	}
);
add_filter( 'login_headertext', 'lkba_login_headertext' );
function lkba_login_headertext() {
	return esc_attr( get_bloginfo( 'name' ) );
}

function lkba_login_logout_shortcode() {
	if ( is_user_logged_in() ) {
		$link = wp_logout_url( home_url() );
		$text = __( 'Logout', 'lkba_vod' );
	} else {
		$link = wp_login_url( get_permalink() );
		$text = __( 'Login', 'lkba_vod' );
	}

	return '<div class="wp-block-button is-style-outline button"><a class="wp-block-button__link wp-element-button" href="' . esc_url( $link ) . '">' . esc_html( $text ) . '</a></div>';
}
add_shortcode( 'login_logout_link', 'lkba_login_logout_shortcode' );

function lkba_register_shortcode() {
	if ( is_user_logged_in() ) {
		return '';
	}

	$link = home_url( '/register/' );
	$text = __( 'Register', 'lkba_vod' );

	return '<div class="wp-block-button is-style-outline button"><a class="wp-block-button__link wp-element-button" href="' . esc_url( $link ) . '">' . esc_html( $text ) . '</a></div>';
}
add_shortcode( 'register_link', 'lkba_register_shortcode' );

function lkba_password_shortcode() {
	if ( ! is_user_logged_in() ) {
		return '';
	}

	$link = home_url( '/nastavte-si-heslo/' );
	$text = __( 'Reset password', 'lkba_vod' );

	return '<div class="wp-block-button is-style-filled button"><a class="wp-block-button__link wp-element-button" href="' . esc_url( $link ) . '">' . esc_html( $text ) . '</a></div>';
}
add_shortcode( 'password_link', 'lkba_password_shortcode' );

function lkba_hide_admin_bar_for_subscribers() {
	if ( current_user_can( 'subscriber' ) ) {
		show_admin_bar( false );
	}
}
add_action( 'after_setup_theme', 'lkba_hide_admin_bar_for_subscribers' );

function lkba_restrict_admin_access() {
	if ( is_admin() && ! current_user_can( 'edit_posts' ) && ! wp_doing_ajax() ) {
		wp_safe_redirect( home_url() );
		exit;
	}
}
add_action( 'init', 'lkba_restrict_admin_access' );
