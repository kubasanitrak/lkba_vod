<?php
/**
 * Template Name: SINGLE POST
 *
 * Learn more: https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage lkba_vod
 * @since 1.0
 * * @version 1.0
 */
	$IS_LINES = "";
   get_header(); 
?>

<style>
</style>


			<?php
				#$COUNTER = 0; 
			?>

		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

			
				<div class="section section-mar-T full-bleed lesson-content--container">
					<?php the_content(); ?>
				</div><!-- END SECTION CONTENT -->

		<?php endwhile; endif; ?>
		

<!-- MENU + SOCIAL LINKS -->
	<?php get_footer(); ?>