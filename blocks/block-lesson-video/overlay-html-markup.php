<style>
	.body-blackout {
	 position: fixed;
	 z-index: 1010;
	 left: 0;
	 top: 0;
	 width: 100%;
	 height: 100vh;
	 background-color: rgba(0, 0, 0, 0.95);
	 display: none;
}
 .popup-modal {
	 width: 90%;
	 height: auto;
	 max-height: 90vh;
	 max-width: 95vw;
	 position: fixed;
	 left: 50%;
	 top: 50%;
	 transform: translate(-50%, -50%);
	 opacity: 0;
	 pointer-events: none;
	 transition: all 300ms ease-in-out;
	 z-index: 1011;
	 display: flex;
	 flex-direction: column;
}
</style>
<!-- BODY OVERLAY -->
		<div class="body-blackout"></div>
    <!-- MODAL POPUP -->
<div class="popup-modal" id="popupmodal_ID">
	<button class="btn popup-close-btn fas fa-2x fa-times text-white bg-primary p-3 popup-modal__close">close</button>
	<div class="popup-modal-content" id="popup_content_ID"></div>
</div>