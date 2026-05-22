(function () {
	'use strict';

	const throttle = (func, limit) => {
		let lastFunc;
		let lastRan;
		return function () {
			const context = this;
			const args = arguments;
			if (!lastRan) {
				func.apply(context, args);
				lastRan = Date.now();
			} else {
				clearTimeout(lastFunc);
				lastFunc = setTimeout(function () {
					if (Date.now() - lastRan >= limit) {
						func.apply(context, args);
						lastRan = Date.now();
					}
				}, limit - (Date.now() - lastRan));
			}
		};
	};

	const wrapper = document.getElementById('wrapper-id');
	const body = document.body;
	const siteHeader = document.getElementById('headerID');
	const hambBtn = document.getElementById('hmbrgID');
	const logoBtn = document.getElementById('logoBtnID');

	if (!wrapper || !siteHeader || !hambBtn || !logoBtn) {
		return;
	}

	let scrollDir = 'down';
	let lastScrollTop = 0;
	let scrollDist = 0;
	const scrollMin = 20;
	const navSwitches = document.querySelectorAll('.nav-switch');
	const preventDefaultLinks = document.querySelectorAll('.prevent-default');
	const observedItems = document.querySelectorAll('.scroll-trigger');

	function docLoaded() {
		window.removeEventListener('load', docLoaded);
		if (wrapper.classList.contains('loading')) {
			wrapper.classList.remove('loading');
		}
		setupIntersectionObserver();
		addMenuBtnListeners();
		bindPreventDefaults();
	}

	function bindPreventDefaults() {
		preventDefaultLinks.forEach((el) => {
			el.addEventListener('click', (event) => event.preventDefault());
		});
	}

	function setupIntersectionObserver() {
		const observer = new IntersectionObserver(
			(entries) => {
				entries.forEach((entry) => {
					if (entry.intersectionRatio > 0) {
						entry.target.classList.add('inView');
					}
				});
			},
			{
				rootMargin: '-100px 0px -100px 0px',
				threshold: 0,
			}
		);

		observedItems.forEach((item) => observer.observe(item));
	}

	window.addEventListener(
		'scroll',
		throttle(function () {
			body.classList.remove('firsttime-load');

			const scrollTop = window.pageYOffset;
			scrollDir = scrollTop > lastScrollTop ? 'down' : 'up';
			if (scrollDir === 'up') {
				scrollDist = lastScrollTop - scrollTop;
			}
			lastScrollTop = scrollTop;

			if (
				(scrollDir === 'up' && scrollTop < 150) ||
				(scrollDir === 'up' && scrollDist > scrollMin)
			) {
				toggleSiteHeader(false);
			} else if (scrollDir === 'down' && scrollTop > 150) {
				toggleSiteHeader(true);
			}
		}, 500)
	);

	function toggleSiteHeader(hide) {
		if (hide) {
			siteHeader.classList.add('header--scrolled');
		} else {
			siteHeader.classList.remove('header--scrolled');
		}
		hambBtn.checked = false;
		logoBtn.checked = false;
	}

	function addMenuBtnListeners() {
		navSwitches.forEach((navSwitch) => {
			navSwitch.addEventListener('click', menuBtnChange);
		});
	}

	function menuBtnChange(event) {
		navSwitches.forEach((navSwitch) => {
			if (navSwitch !== event.target) {
				navSwitch.checked = event.target.checked;
			}
		});
	}

	const isIOS = /iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream;
	const isAndroid = navigator.userAgent.toLowerCase().indexOf('android') > -1;

	if (!isIOS && !isAndroid) {
		wrapper.classList.add('is-desktop');
	}

	window.addEventListener('load', docLoaded);
})();
