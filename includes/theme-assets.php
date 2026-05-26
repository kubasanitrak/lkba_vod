<?php
/**
 * Front-end and editor asset registration.
 *
 * @package lkba_vod
 */

function lkba_vod_asset_version( $relative_path ) {
	$path = get_template_directory() . $relative_path;
	return file_exists( $path ) ? (string) filemtime( $path ) : '1.0.6';
}

function lkba_vod_enqueue_frontend_assets() {
	if ( is_admin() ) {
		return;
	}

	$theme_uri = get_template_directory_uri();

	wp_dequeue_style( get_stylesheet() );
	wp_deregister_style( get_stylesheet() );

	wp_enqueue_style(
		'lkba-vod-style',
		$theme_uri . '/assets/css/style.css',
		array(),
		lkba_vod_asset_version( '/assets/css/style.css' )
	);
	/*
	wp_enqueue_style(
		'lkba-vod-public',
		$theme_uri . '/assets/css/public.css',
		array( 'lkba-vod-style' ),
		lkba_vod_asset_version( '/assets/css/public.css' )
	);
	*/

	wp_enqueue_style(
		'lkba-vod-wp-block-fix',
		$theme_uri . '/assets/css/wp-block-fix-style.css',
		array( 'lkba-vod-style' ),
		lkba_vod_asset_version( '/assets/css/wp-block-fix-style.css' )
	);

	wp_enqueue_style( 'dashicons' );

	wp_enqueue_script(
		'lkba-vod-lazysizes',
		$theme_uri . '/assets/js/libs/lazysizes.min.js',
		array(),
		lkba_vod_asset_version( '/assets/js/libs/lazysizes.min.js' ),
		true
	);

	wp_enqueue_script(
		'lkba-vod-unveilhooks',
		$theme_uri . '/assets/js/libs/ls.unveilhooks.min.js',
		array( 'lkba-vod-lazysizes' ),
		lkba_vod_asset_version( '/assets/js/libs/ls.unveilhooks.min.js' ),
		true
	);

	wp_enqueue_script(
		'lkba-vod-theme-front',
		$theme_uri . '/assets/js/theme-front.js',
		array(),
		lkba_vod_asset_version( '/assets/js/theme-front.js' ),
		true
	);

	wp_enqueue_script(
		'lkba-vod-video-lazyload',
		$theme_uri . '/assets/js/video-lazyload.js',
		array(),
		lkba_vod_asset_version( '/assets/js/video-lazyload.js' ),
		true
	);
}
add_action( 'wp_enqueue_scripts', 'lkba_vod_enqueue_frontend_assets', 20 );

function lkba_vod_enqueue_editor_styles() {
	wp_enqueue_style(
		'lkba-vod-editor',
		get_stylesheet_directory_uri() . '/style-editor.css',
		array(),
		lkba_vod_asset_version( '/style-editor.css' )
	);
}
add_action( 'admin_enqueue_scripts', 'lkba_vod_enqueue_editor_styles' );
