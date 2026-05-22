<?php
/**
 * Block Name: BLOCK-lesson-video
 *
 * This is the template that displays the featured news block.
 * @param   array $block The block settings and attributes.
 */

	
// Create class attribute allowing for custom "className" values.

	$VIDEO_HOST = get_field( 'video_host' );
	$VIDEO_ID = get_field( 'video_id' );
	$VIDEO_SELF_URL = get_field( 'video_selfhosted' );

	$VIDEO_BTN_LABEL = get_field( 'video_btn_label' );
?>
<div class="video-container scroll-trigger">
			<?php
				// echo '<h1>' . strval($VIDEO_ID) . '</h1>';
				if( $VIDEO_HOST === 'vimeo_public' || $VIDEO_HOST === 'vimeo_private' ) :
					$request = wp_remote_get( 'https://vimeo.com/api/oembed.json?url=https://vimeo.com/' . strval($VIDEO_ID) );
					$response = wp_remote_retrieve_body( $request );
					$video_array = json_decode( $response, true );
					$data_4_markup = $video_array["html"];
				endif;

				if( $VIDEO_HOST === 'vimeo_public' ) :
					$thumb_url = $video_array["thumbnail_url"];
				elseif( $VIDEO_HOST === 'vimeo_private' ) :
					$thumb_url = get_field( 'video_poster' );
				endif;

				if( $VIDEO_HOST === 'vimeo_public' || $VIDEO_HOST === 'vimeo_private' ) :
					$POSTER_MARKUP = '';
					$POSTER_MARKUP .= '<div class="video-item vi-lazyload" data-id="';
					$POSTER_MARKUP .= strval($VIDEO_ID);
					$POSTER_MARKUP .= '" data-thumb="';
					$POSTER_MARKUP .= esc_attr($thumb_url);
					$POSTER_MARKUP .= '" data-logo="0" data-btnlabel="';
					$POSTER_MARKUP .= $VIDEO_BTN_LABEL;
					$POSTER_MARKUP .= '" style="--video-ratio: 16/9;"></div>';
				elseif( $VIDEO_HOST === 'youtube' ) :
					$POSTER_MARKUP = '';
					$POSTER_MARKUP .= '<div class="video-item youtube-lazyload" data-id="';
					$POSTER_MARKUP .= strval($VIDEO_ID);
					$POSTER_MARKUP .= '" data-thumb="';
					// $POSTER_MARKUP .= esc_attr($thumb_url);
					$POSTER_MARKUP .= $VIDEO_ID;
					$POSTER_MARKUP .= '" data-logo="0" data-btnlabel="';
					$POSTER_MARKUP .= $VIDEO_BTN_LABEL;
					$POSTER_MARKUP .= '" style="--video-ratio: 16/9;"></div>';
				endif;
				print $POSTER_MARKUP;
			?>
			<!-- DYNAMICALY GENERATED VIDEO THUMB -->

	<div class="video-info">
		<div class="video-info--instructor">
			<?php 
				if(get_field('instructor_name')) :
			?>
			<span class="video-info--label plain"><?php _e('lektorka', 'lkba_vod'); ?></span>
			<strong>
				<?php 
					echo get_field('instructor_name');
					endif;
				?>
			</strong>
		</div>
		<div class="video-info--length">
			<?php 
				if(get_field('lesson_length')) :
			?>
			<span class="video-info--label plain"><?php _e('délka', 'lkba_vod'); ?></span>
			<strong>
				<?php 
					echo get_field('lesson_length');
					endif;
				?>&nbsp;min.</strong>
		</div>
	</div>
</div>