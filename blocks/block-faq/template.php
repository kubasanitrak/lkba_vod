<?php
/**
 * Block Name: BLOCK-faq
 *
 * This is the template that displays the featured news block.
 * @param   array $block The block settings and attributes.
 */
?>
<?php
    $CLS_W = 'accord-item ';
    // $ROUNDED_CORNERS = get_field('has_round_corners');

    $classes = ( ! empty( $block['className'] ) ) ? sprintf( $CLS_W . ' %s', $block['className'] ) : $CLS_W;
    $block_id = '';
    if ( ! empty( $block['anchor'] ) ) :
        $block_id = esc_attr( $block['anchor'] );
    endif;
?>

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
    <?php $RAND_ID = rand(1, 999); ?>
    <input type="checkbox" id="accord-switch-<?php echo strval($RAND_ID); ?>_ID" class="accord-item--input">
    <label for="accord-switch-<?php echo strval($RAND_ID); ?>_ID" class="accord-item--switch">
        <div class="circ"></div>
        <div class="btn-icon btn-icon--plus" id="">
            <div class="btn-icon--inner">
                <span class="btn-icon--bar btn-icon--bar_H"></span>
                <span class="btn-icon--bar btn-icon--bar_V"></span>
            </div>
        </div>
    </label> 

    <div class="accord-item--header">
        <h5 class="accord-item--title sans-serif caps"><?php echo get_field('faq_title'); ?></h5>
    </div>
    
    <div class="accord-item--content">
        <InnerBlocks/>
    </div>
</div>