<script>
	(function(){
		/* POP UP SIGNUP FORM */
        const
        	modalTriggers = document.querySelectorAll('.popup-trigger'),
        	modalCloseTrigger = document.querySelector('.popup-modal__close'),
        	bodyBlackout = document.querySelector('.body-blackout'),
					popupModal = document.getElementById('popupmodal_ID'),
					popupModalContent = document.getElementById('popup_content_ID');


        function showPopUpModal () {
          popupModal.classList.add('is--visible');
          bodyBlackout.classList.add('is-blacked-out');

          document.getElementById('popup_confirm_ID').addEventListener('click', function () {
            hidePopUpModal(true);
        })
          _clsBTN = popupModal.querySelectorAll('.popup-modal__close');
          _clsBTN.forEach(function(button) {
			button.addEventListener('click', function() {
	            hidePopUpModal(false);
// TODO SET COOKIE FOR NOT SHOWING POP UP AGAIN IN SHORT INTERVAL
            // popupContent.replaceChildren(); ???
	          })
          })

          bodyBlackout.addEventListener('click', function () {
            hidePopUpModal(false);
// TODO SET COOKIE FOR NOT SHOWING POP UP AGAIN IN SHORT INTERVAL
            // popupContent.innerHTML = ""; ???
            // popupContent.replaceChildren(); ???
          })
        }
        function hidePopUpModal(confirm) {
        	const popupModal = document.getElementById('popupmodal_ID');
            popupModal.classList.remove('is--visible');
            bodyBlackout.classList.remove('is-blacked-out'); 
			
			if(!confirm) {
	            showPopUpModalAfterTimeOut();
	            return;
	        }
	        // console.log("button OK clicked, confirmation cookie set");
			setPopUpCookie();

        }
        function showPopUpModalAfterTimeOut() {
        	setTimeout(
		        function open(event){
		            showPopUpModal();// document.querySelector(".popup").style.display = "block";
		        },
		        3000
		    )
        }

		function getCookie (name) {
			let value = `; ${document.cookie}`;
			let parts = value.split(`; ${name}=`);
			if (parts.length === 2) return parts.pop().split(';').shift();
		}

        function setPopUpCookie() {
        	document.cookie = `lesson_price=noticed; path=/; max-age=${60 * 60 * 24 * 3};`; // max-age=${60 * 60 * 24 * 14};` == expires in two weeks: 60 seconds x 60 minutes x 24 hours x 14 days
        }
        function clearPopUpCookie() {
        	document.cookie = `lesson_price=noticed; path=/; max-age=0;`;
        }

        function setUpPopUpModal() {
        	/* /
        	showPopUpModal();
        	/*/
        	showPopUpModalAfterTimeOut();
		    //*/
        }
        document.addEventListener("DOMContentLoaded", () => {
        	if(!getCookie('lesson_price')) showPopUpModalAfterTimeOut();
		});

		})();
</script>