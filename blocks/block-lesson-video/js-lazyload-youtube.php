 <!-- LAZYLOAD youtube -->
<script>

(function () {
  /********************************************************************
  ************************** MAIN VARIABLES ***************************
  *********************************************************************/
  var youtube = document.querySelectorAll('.youtube-lazyload'),
      youtube_observer,
      popupContent = document.getElementById("popup_content_ID"),
      //Intersection Observer API
  template_wrap,
      template_content,
      template_playbtn,
      template_logo,
      template_iframe,
      settings_observer_rootMargin = '200px 0px',
      //Intersection Observer API option - rootMargin (Y, X)
  settings_thumb_base_url = 'https://img.youtube.com/vi/',
      //Base URL where thumbnails are stored
  settings_thumb_extension = '/maxresdefault.jpg'; //Thumbnail extension

  /********************************************************************
  ************************ IF ELEMENTS EXIST **************************
  *********************************************************************/

  if (youtube.length > 0) {
    //create elements
    template_wrap = document.createElement('div');
    template_content = document.createElement('div');
    template_playbtn = document.createElement('div');
    template_playbtnlabel = document.createElement('div');
    template_logo = document.createElement('a');
    template_iframe = document.createElement('iframe'); //set attributes

    template_wrap.classList.add('vi-lazyload-wrap');
    template_content.classList.add('vi-lazyload-content');
    template_playbtn.classList.add('vi-lazyload-playbtn');
    template_playbtn.classList.add('popup-trigger');
    template_playbtnlabel.classList.add('vi-lazyload-playbtn--label');
    template_logo.classList.add('vi-lazyload-logo');
    template_logo.target = '_blank';
    template_logo.rel = 'noreferrer';
    template_iframe.setAttribute('allow', 'fullscreen');
    template_iframe.setAttribute('allowfullscreen', '');
    template_iframe.setAttribute('loading', 'lazy');
    /********************************************************************
    ********************* INTERSECTION OBSERVER API *********************
    *********************************************************************/

    youtube_observer = new IntersectionObserver(function (elements) {
      elements.forEach(function (e) {
        //VARIABLES
        var this_element = e.target,
            this_wrap,
            this_content,
            this_playbtn,
            this_playbtnlabel,
            this_logo,
            this_iframe,
            // this_data_id = e.target.dataset.id,
            this_data_id = String(e.target.dataset.id),
            // this_data_thumb = e.target.dataset.thumb,
            this_data_thumb = String(e.target.dataset.thumb),
            this_data_btnlabel = String(e.target.dataset.btnlabel),
            this_data_logo = e.target.dataset.logo; //if element appears in viewport

        if (e.isIntersecting === true) {
          //wrap
          this_wrap = template_wrap.cloneNode();
          this_element.append(this_wrap); //content

          this_content = template_content.cloneNode();
          this_wrap.append(this_content); //background-image

          // this_content.style.setProperty('--vi-lazyload-img', 'url("' + settings_thumb_base_url + this_data_id + this_data_thumb + '.' + settings_thumb_extension + '")'); //play btn
          this_content.style.setProperty('--vi-lazyload-img', 'url("' + settings_thumb_base_url + this_data_id + settings_thumb_extension + '")');

          this_playbtn = template_playbtn.cloneNode();
          // this_playbtn.innerHTML = this_data_btnlabel;
          // this_playbtn.textContent = this_data_btnlabel;
          this_content.append(this_playbtn); //logo link

          this_playbtnlabel = template_playbtnlabel.cloneNode();
          this_playbtnlabel.innerHTML = this_data_btnlabel;
          this_content.append(this_playbtnlabel);

          if (this_data_logo !== '0') {
            // this_logo = template_logo.cloneNode();
            // this_logo.href = 'https://vimeo.com/' + this_data_id;
            // this_content.append(this_logo);
          } //onclick create iframe


          this_playbtn.addEventListener('click', function (event) {
            // console.log("click");
            this_iframe = template_iframe.cloneNode();
            // this_iframe.src = 'https://player.vimeo.com/video/' + this_data_id + '?autoplay=1&autopause=0';
            this_iframe.src = "https://www.youtube.com/embed/" + this_data_id + "?rel=0&showinfo=0&autoplay=1";
            // this_content.append(this_iframe);
            clickPopUpModalBTN(event.target);
            popupContent.append(this_iframe);
          }); //Unobserve after image lazyloaded

          youtube_observer.unobserve(this_element); //LOG
          //console.log('DONE - ' + this_data_id);
        }
      });
    }, {
      rootMargin: settings_observer_rootMargin
    });
    /********************************************************************
    ********************* ITERATE THROUGH ELEMENTS **********************
    *********************************************************************/

    youtube.forEach(function (e) {
      //Intersection Observer API - observe elements
      youtube_observer.observe(e);
    });
  }
/* POP UP SIGNUP FORM */
        const modalTriggers = document.querySelectorAll('.popup-trigger')
        const modalCloseTrigger = document.querySelector('.popup-modal__close')
        const bodyBlackout = document.querySelector('.body-blackout')

        // if(modalTriggers) {
        //   for (var i = 0; i < modalTriggers.length; ++i) {
        //     modalTriggers[i].addEventListener("click", function (event) {
        //       clickPopUpModalBTN(event.target);
        //     });
        //   }
        // }

        function clickPopUpModalBTN (elem) {
          // const { popupTrigger } = elem.dataset;
          // const popupModal = document.querySelector(`[data-popup-modal="${popupTrigger}"]`)
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