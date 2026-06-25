<?php
/**
 * Lesson archive – lightweight grid only (no full lesson content per post).
 *
 * @package lkba_vod
 */

get_header();

$archive_title = post_type_archive_title( '', false );
$grid_shortcode  = sprintf(
	'[dl_lessons_grid exclude_current="false" exclude_purchased="false" layout="section" title="%s"]',
	esc_attr( $archive_title )
);
?>

<div class="section section-mar-T full-bleed scroll-trigger">
	<div class="flow layout-grid">
		<?php echo do_shortcode( $grid_shortcode ); ?>
	</div>
</div>

<?php
get_footer();
