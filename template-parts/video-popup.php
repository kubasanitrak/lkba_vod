<?php
/**
 * Shared video lightbox markup (YouTube embeds).
 *
 * @package lkba_vod
 */
?>
<div class="body-blackout" aria-hidden="true"></div>
<div class="popup-modal" id="popupmodal_ID" role="dialog" aria-modal="true" aria-label="<?php esc_attr_e( 'Video', 'lkba_vod' ); ?>">
	<button type="button" class="popup-modal__close"><?php esc_html_e( 'Zavřít', 'lkba_vod' ); ?></button>
	<div class="popup-modal-content" id="popup_content_ID"></div>
</div>
