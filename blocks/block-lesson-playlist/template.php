<?php
/**
 * Block Name: BLOCK-lesson-playlist
 * 
 * @param   array $block The block settings and attributes.
 * 
 */
?>

<?php
// Create class attribute allowing for custom "className" values.
    $CLS_W = 'playlist';
    
    // Create class attribute allowing for custom "className" values.
    $classes = ( ! empty( $block['className'] ) ) ? sprintf( $CLS_W . ' %s', $block['className'] ) : $CLS_W;
    
?>


    <div class="<?php echo esc_attr($classes); ?>">

        <?php #if(get_field("timetable_label")): ?>
            <!-- <div class="customtable-header"><p class="strong"><?php #echo get_field("timetable_label"); ?></p></div> -->
        <?php #endif; ?>
            <div class="playlist-header">
                <h2 class="playlist-title"><?php _e('Playlist', 'lkba_vod'); ?></h2>
            </div>
            <div class="playlist-caption">
                <?php echo get_field('playlist_perex'); ?>
            </div>

        <?php
            if( have_rows('playlist') ):
            $TEMP_MARKUP = "";

            // $BOOKING_URL = "";
            // $CURR_LANG = pll_current_language( 'slug' );
            // $BTN_LABEL = str_contains(strtolower($CURR_LANG), 'cs') ? 'Rezervovat' : 'Book';

        ?>
        <?php
                
                // Loop through rows.
                while( have_rows('playlist') ) : 
                    the_row();

                    
                    $TEMP_MARKUP .= '<div class="playlist-row mar-T-0">';
                    
                    if(get_sub_field("playlist_track_link")):
                        $TEMP_MARKUP .= '<a class="playlist-row--item_link" href="';
                        $TEMP_MARKUP .= get_sub_field("playlist_track_link"); 
                        $TEMP_MARKUP .= '">';
                    endif;
                        $TEMP_MARKUP .= get_sub_field('playlist_track_name');
                    if(get_sub_field("playlist_track_link")):
                        $TEMP_MARKUP .= '</a>';
                    endif;
                    
                    $TEMP_MARKUP .= '</div><!-- END ROW -->';

                // End loop.
                endwhile;
                print $TEMP_MARKUP;
        ?>
        <?php
            endif;
        ?>
        <div class="playlist-spotify--container">
            <?php echo get_field('playlist_link'); ?>
        </div>
    </div>