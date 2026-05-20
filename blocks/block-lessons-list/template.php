<?php
/**
 * Block Name: BLOCK-lessons-list
 *
 * This is the template that displays Lessons in grid.
 * @param   array $block The block settings and attributes.
 */
?>
<?php
    $IS_LINKS_GRID = get_field('is_links_grid');

    $CLS_W = ' section section-lesson_grid full-bleed scroll-trigger scroll-trigger--grid';

    $classes = ( ! empty( $block['className'] ) ) ? sprintf( $CLS_W . ' %s', $block['className'] ) : $CLS_W;

    // Support custom id values.
    $block_id = '';
    if ( ! empty( $block['anchor'] ) ) :
        $block_id = esc_attr( $block['anchor'] );
    endif;
?>

<?php
    $argType = get_field( 'loop_argument_type' );

    if( $argType == "count" ) :
      $args = array(
        // AN ARRAY OF CATEGORY IDS A POST SHOULD HAVE.
        // 'category__and' => $CAT_IDS, // array(5,1))) 
        'post_type' => 'lesson',
        'order' => 'ASC',
        'posts_per_page' => get_field( 'lesson_count' )
      );
    else:
      $todisplay = get_field( 'select_events' );
      $args = array( 
        'post_type' => 'lesson',
        'order' => 'ASC',
        'post__in' => $todisplay
      );
    endif;


    $the_query = new WP_Query( $args );

    if ( $the_query->have_posts() ) : 

        ?>
    <div data-theme="default"
        <?php
        echo wp_kses_data(
            get_block_wrapper_attributes(
                array(
                    'id'    => $block_id,
                    'class' => esc_attr( $classes ),
                )
            )
        );
        ?>
    >
        <div class="section-lesson_grid--title">
            <h1 class=""><?php echo get_field( 'lesson_grid_title' ); ?></h1>
        </div>
        <div class="list-grid list-grid--lessons">
                        
        <?php 
            while ( $the_query->have_posts() ) : $the_query->the_post();
        ?>
        <?php
            $POST_ID = get_the_ID();
            $POST_TITLE = get_the_title();
        ?>
            <div class="grid-item" >
                <div class="grid-item--img_container">
                    <?php
                        $IMG_ID = get_field('lesson_tile_img_id', $POST_ID);
                        if($IMG_ID) :
                            $img_src = wp_get_attachment_image_url( $IMG_ID, 'medium' );
                            $img_srcset = wp_get_attachment_image_srcset( $IMG_ID, 'full' );
                        ?>
                            <img class="grid-item--img lazyload" data-srcset="<?php echo esc_attr( $img_srcset ); ?>" data-src="<?php echo esc_url( $img_src ); ?>" data-sizes="auto" alt="<?php echo $POST_TITLE; ?>" title="<?php echo $POST_TITLE; ?>" >
                    <?php 
                        endif;
                    ?>
                </div>
                <div class="grid-item--label">
                    <h4 class="grid-item--title"> <?php the_title(); ?> </h4>
                </div>
                <?php if ( ! $is_preview && $IS_LINKS_GRID ) : ?>
                    <a href="<?php the_permalink(); ?>" class="abs-link grid-item--title_link"></a>
                <?php endif; ?>
            </div>
        <?php
            endwhile;
        ?>
        </div>
    </div>

<?php else: __( 'Sorry, there are no posts to display', 'lkba_vod' ); ?>
<?php endif;  ?>
                    