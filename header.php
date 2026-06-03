<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
<meta name="robots" content="index, follow">
<meta name="author" content="Lenka Krejčová Barre Academy">

<link rel="icon" href="<?php echo esc_url( get_template_directory_uri() . '/assets/favicon.ico' ); ?>" sizes="any">
<link rel="icon" href="<?php echo esc_url( get_template_directory_uri() . '/assets/icon.svg' ); ?>" type="image/svg+xml">
<link rel="apple-touch-icon" href="<?php echo esc_url( get_template_directory_uri() . '/assets/apple-touch-icon.png' ); ?>">
<link rel="manifest" href="<?php echo esc_url( get_template_directory_uri() . '/manifest.webmanifest' ); ?>">

<?php wp_head(); ?>

<style>
	@supports (--custom:property) {
		[style*="--aspect-ratio"] { position: relative; padding-bottom: 0; }
		[style*="--aspect-ratio"]::before { padding-bottom: calc(100% / (var(--aspect-ratio))); display: block; content: ""; width: 100%;}
		[style*="--aspect-ratio"] > :first-child:not(.play-button) { position: absolute; top: 0; left: 0; height: 100%; }
		[style*="--video-ratio"] { position: relative; padding-bottom: 0; }
		[style*="--video-ratio"]::before { padding-bottom: calc(100% / (var(--video-ratio))); display: block; content: ""; width: 100%;}
		[style*="--video-ratio"] > :first-child:not(.play-button) { position: absolute; top: 0; left: 0; height: 100%; }
	}
</style>
<!--PrivateStater-Getter-->
<!-- <script>window.PrivateStaterConfig = { prstSite: 'barreacademy' }</script>
<script src="https://privatestater.com/privatestater.js"></script> -->
</head>
<body <?php body_class(); ?> data-theme="">
<script>document.body.classList.add('js');</script>

<div class="wrapper loading" id="wrapper-id">
	<div class="header" id="headerID">
		<div class="hotspot reveal-menu-on-hover" id="navigation-hotspot">&nbsp;</div>
		<?php get_template_part( 'template-parts/navigation', 'top' ); ?>
	</div>
