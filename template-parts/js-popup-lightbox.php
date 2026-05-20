<?php
/**
 * Displays lightbox popup for certificates
 *
 * @package WordPress
 * @subpackage lkba_vod
 * @since 1.0
 * * @version 1.0
 */

?>
<script>

(function () {
		/* POP UP MODAL */
        const modalTriggers = document.querySelectorAll('.popup-trigger');
        const modalCloseTrigger = document.querySelector('.popup-modal__close');
        const bodyBlackout = document.querySelector('.body-blackout');

        function addClickListeners() {
	        if(modalTriggers) {
	console.log("click");
	          for (var i = 0; i < modalTriggers.length; ++i) {
	            modalTriggers[i].addEventListener("click", function (event) {
					clickPopUpModalBTN(event.target);
	            	popupContent.append(this.href);
	            });
	          }
	        }
        }

        addClickListeners();


        function clickPopUpModalBTN (elem) {

          const popupModal = document.getElementById('popupmodal_ID');

          popupModal.classList.add('is--visible')
          bodyBlackout.classList.add('is-blacked-out')

          popupModal.querySelector('.popup-modal__close').addEventListener('click', function() {
            popupModal.classList.remove('is--visible')
            bodyBlackout.classList.remove('is-blacked-out')
            popupContent.replaceChildren();
          })

          bodyBlackout.addEventListener('click', function () {
            // const popupModal = document.querySelector(`[data-popup-modal="${popupTrigger}"]`)
            const popupModal = document.getElementById('popupmodal_ID');
            popupModal.classList.remove('is--visible');
            bodyBlackout.classList.remove('is-blacked-out');
            // popupContent.innerHTML = "";
            popupContent.replaceChildren();
          })
        }
})();</script>