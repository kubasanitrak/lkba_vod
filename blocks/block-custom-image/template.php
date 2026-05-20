<?php
/**
 * Block Name: BLOCK-custom-image
 *
 * This is the template that displays the featured news block.
 * @param   array $block The block settings and attributes.
 */
?>
<?php
    $CLS_W = 'section section-img scroll-trigger ';
    
    $IMG_ID = get_field('custom_img_id');

    $IS_CLIPPATH = get_field('is_clippath');
    if($IS_CLIPPATH) :
        $CLS_W .= ' ';
        $CLS_W .= 'scroll-trigger--clip_path';
    endif;

    $IS_WIDE = get_field('is_wide');
    if(!$IS_WIDE) :
        $CLS_W .= ' ';
        $CLS_W .= 'section-content--narrow';
    endif;

    $ROUNDED_CORNERS = get_field('has_round_corners');
    if($ROUNDED_CORNERS) :
        $CLS_W .= ' ';
        $CLS_W .= 'img-container--round-corners';
    endif;
    
    // Create class attribute allowing for custom "className" values.
    $classes = ( ! empty( $block['className'] ) ) ? sprintf( $CLS_W . ' %s', $block['className'] ) : $CLS_W;

    // Support custom id values.
    $block_id = '';
    if ( ! empty( $block['anchor'] ) ) :
        $block_id = esc_attr( $block['anchor'] );
    endif;
?>

<?php #if ( ! $is_preview ) { ?>
<div
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
<?php #} ?>

    <?php
        $img_src = wp_get_attachment_image_url( $IMG_ID, 'medium' );
        $img_srcset = wp_get_attachment_image_srcset( $IMG_ID, 'full' );
    ?>
    <img class="proj-list--item_img lazyload" data-srcset="<?php echo esc_attr( $img_srcset ); ?>" data-src="<?php echo esc_url( $img_src ); ?>" data-sizes="auto" alt="">
    
<?php #if ( ! $is_preview ) { ?>
    </div>
<?php #} ?>
