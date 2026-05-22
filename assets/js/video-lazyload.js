(function () {
	'use strict';

	if (window.__lkbaVideoLazyloadInit) {
		return;
	}
	window.__lkbaVideoLazyloadInit = true;

	const observerRootMargin = '200px 0px';
	const thumbExtension = '';

	function initVimeoLazyload() {
		const vimeoItems = document.querySelectorAll('.vi-lazyload');
		if (!vimeoItems.length) {
			return;
		}

		const templateWrap = document.createElement('div');
		const templateContent = document.createElement('div');
		const templatePlayBtn = document.createElement('div');
		const templatePlayBtnLabel = document.createElement('div');
		const templateLogo = document.createElement('a');
		const templateIframe = document.createElement('iframe');

		templateWrap.classList.add('vi-lazyload-wrap');
		templateContent.classList.add('vi-lazyload-content');
		templatePlayBtn.classList.add('vi-lazyload-playbtn', 'popup-trigger');
		templatePlayBtnLabel.classList.add('vi-lazyload-playbtn--label');
		templateLogo.classList.add('vi-lazyload-logo');
		templateLogo.target = '_blank';
		templateLogo.rel = 'noreferrer';
		templateIframe.setAttribute('allow', 'fullscreen');
		templateIframe.setAttribute('allowfullscreen', '');
		templateIframe.setAttribute('loading', 'lazy');

		const observer = new IntersectionObserver(
			(entries) => {
				entries.forEach((entry) => {
					if (!entry.isIntersecting) {
						return;
					}

					const element = entry.target;
					const dataId = String(element.dataset.id);
					const dataThumb = String(element.dataset.thumb);
					const dataBtnLabel = String(element.dataset.btnlabel);
					const dataLogo = element.dataset.logo;

					const wrap = templateWrap.cloneNode();
					element.append(wrap);

					const content = templateContent.cloneNode();
					wrap.append(content);

					content.style.setProperty(
						'--vi-lazyload-img',
						'url("' + dataThumb + '.' + thumbExtension + '")'
					);

					const playBtn = templatePlayBtn.cloneNode();
					content.append(playBtn);

					const playBtnLabel = templatePlayBtnLabel.cloneNode();
					playBtnLabel.innerHTML = dataBtnLabel;
					content.append(playBtnLabel);

					if (dataLogo !== '0') {
						const logo = templateLogo.cloneNode();
						logo.href = 'https://vimeo.com/' + dataId;
						content.append(logo);
					}

					playBtn.addEventListener('click', function () {
						const iframe = templateIframe.cloneNode();
						iframe.src =
							'https://player.vimeo.com/video/' +
							dataId +
							'?autoplay=1&autopause=0';
						content.append(iframe);
						this.style.zIndex = '-1';
					});

					observer.unobserve(element);
				});
			},
			{ rootMargin: observerRootMargin }
		);

		vimeoItems.forEach((item) => observer.observe(item));
	}

	function initYoutubeLazyload() {
		const youtubeItems = document.querySelectorAll('.youtube-lazyload');
		if (!youtubeItems.length) {
			return;
		}

		const popupContent = document.getElementById('popup_content_ID');
		const popupModal = document.getElementById('popupmodal_ID');
		const bodyBlackout = document.querySelector('.body-blackout');

		if (!popupContent || !popupModal || !bodyBlackout) {
			return;
		}

		const templateWrap = document.createElement('div');
		const templateContent = document.createElement('div');
		const templatePlayBtn = document.createElement('div');
		const templatePlayBtnLabel = document.createElement('div');
		const templateIframe = document.createElement('iframe');
		const thumbBaseUrl = 'https://img.youtube.com/vi/';
		const thumbSuffix = '/maxresdefault.jpg';

		templateWrap.classList.add('vi-lazyload-wrap');
		templateContent.classList.add('vi-lazyload-content');
		templatePlayBtn.classList.add('vi-lazyload-playbtn', 'popup-trigger');
		templatePlayBtnLabel.classList.add('vi-lazyload-playbtn--label');
		templateIframe.setAttribute('allow', 'fullscreen');
		templateIframe.setAttribute('allowfullscreen', '');
		templateIframe.setAttribute('loading', 'lazy');

		function openVideoPopup(iframe) {
			popupModal.classList.add('is--visible');
			bodyBlackout.classList.add('is-blacked-out');
			popupContent.replaceChildren(iframe);

			const closePopup = () => {
				popupModal.classList.remove('is--visible');
				bodyBlackout.classList.remove('is-blacked-out');
				popupContent.replaceChildren();
			};

			popupModal.querySelectorAll('.popup-modal__close').forEach((btn) => {
				btn.addEventListener('click', closePopup, { once: true });
			});

			bodyBlackout.addEventListener('click', closePopup, { once: true });
		}

		const observer = new IntersectionObserver(
			(entries) => {
				entries.forEach((entry) => {
					if (!entry.isIntersecting) {
						return;
					}

					const element = entry.target;
					const dataId = String(element.dataset.id);
					const dataBtnLabel = String(element.dataset.btnlabel);

					const wrap = templateWrap.cloneNode();
					element.append(wrap);

					const content = templateContent.cloneNode();
					wrap.append(content);

					content.style.setProperty(
						'--vi-lazyload-img',
						'url("' + thumbBaseUrl + dataId + thumbSuffix + '")'
					);

					const playBtn = templatePlayBtn.cloneNode();
					content.append(playBtn);

					const playBtnLabel = templatePlayBtnLabel.cloneNode();
					playBtnLabel.innerHTML = dataBtnLabel;
					content.append(playBtnLabel);

					playBtn.addEventListener('click', function () {
						const iframe = templateIframe.cloneNode();
						iframe.src =
							'https://www.youtube.com/embed/' +
							dataId +
							'?rel=0&autoplay=1';
						openVideoPopup(iframe);
					});

					observer.unobserve(element);
				});
			},
			{ rootMargin: observerRootMargin }
		);

		youtubeItems.forEach((item) => observer.observe(item));
	}

	initVimeoLazyload();
	initYoutubeLazyload();
})();
