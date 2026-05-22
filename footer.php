<?php
/**
 * Theme footer.
 *
 * @package lkba_vod
 */
?>

<div class="section section-footer scroll-trigger mar-T full-bleed">
	<div class="padded-content footer-cols">
		<div class="footer-col footer-col_LABEL">
			<h2 class="footer-col--headline"><?php esc_html_e( 'Sledujte nás', 'lkba_vod' ); ?></h2>
		</div>

		<?php
		wp_nav_menu(
			array(
				'theme_location' => 'fcbk-insta',
				'container'      => '',
				'menu_class'     => 'footer-col footer-col_LINKS menu-social-links-menu-container nav-list list-none',
			)
		);
		?>
	</div>

	<div class="padded-content footer-menu">
		<?php
		wp_nav_menu(
			array(
				'theme_location' => 'footer-menu',
				'container'      => '',
				'menu_class'     => 'foot-nav-list nav-list list-none',
			)
		);
		?>
	</div>
</div>

</div><!-- END WRAPPER -->

<?php get_template_part( 'template-parts/video', 'popup' ); ?>

<?php wp_footer(); ?>
</body>
</html>
