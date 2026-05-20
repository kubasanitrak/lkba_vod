<?php
/**
 * @package WordPress
 * @subpackage lkba_vod
 * @since 1.0
 */
?>

<?php
    
    
    
?>

<script src="<?php echo  get_template_directory_uri(); ?>/assets/js/libs/gsap.min.js"></script>
<script src="<?php echo  get_template_directory_uri(); ?>/assets/js/libs/ScrollToPlugin.min.js"></script>
<script src='<?php echo  get_template_directory_uri(); ?>/assets/js/libs/jquery-3.6.1.min.js'></script>

<script>
    (function(){
        
// console.log("booking custom script");

        const _scrollContainer = document.getElementById('bpa-front-tabs').querySelector('.bpa-front-dc--body'),
        _urlParam = 'lessonID',
        transT = 1.0;

        // _scrollContainer.classList.add('TEST');

       // THROTTLE
                        const throttle = (func, limit) => {
                            let lastFunc;
                            let lastRan;
                            return function() {
                                const context = this;
                                const args = arguments;
                                if (!lastRan) {
                                    func.apply(context, args)
                                    lastRan = Date.now();
                                } else {
                                    clearTimeout(lastFunc);
                                    lastFunc = setTimeout(function() {
                                            if ((Date.now() - lastRan) >= limit) {
                                                func.apply(context, args);
                                                lastRan = Date.now();
                                            }
                                     }, limit - (Date.now() - lastRan));
                                }
                            }
                        }
                        _scrollContainer.classList.add("TEST");

        _scrollContainer.addEventListener('scroll', 
            throttle(function () {
                console.log("scrolling");
            }, 500)
        );
        _scrollContainer.addEventListener("scroll", function(){
                console.log("scrolling");
        });

        window.addEventListener('load', function(){
            // TODO WHEN WP_ENQUE_SCRIPT IS IMPLEMENTED
            /*/
            checkUrl(_urlParam);
            //*/ gsap.delayedCall(3, checkUrl, [_urlParam])
            // END TODO
        }, false);
                        
        function checkUrl(passedUrlParam) {
            window.removeEventListener('load', checkUrl);
            const queryString = window.location.search;
            const urlParams = new URLSearchParams(queryString);
            let _tmpParam = urlParams.get(passedUrlParam),
                _scrollToID = "",
                _scrollToEl,
                _scrollToValue;
            // let _tmpSerie = "Limited Edition";
            if(_tmpParam) {
                _scrollToID = "bap-service-" + _tmpParam;
console.log(_scrollToID);
                _scrollToEl = document.getElementById(_scrollToID).parentNode;
                _scrollToValue = _scrollToEl.offsetTop;
_scrollToEl.classList.add('__bpa-is-selected');
// TODO
// _scrollToEl.classList.add('__bpa-is-preselected');
// END TODO

                // SCROLL TO LIMITED SECTION
                // TweenMax.to(_scrollContainer, transT, {
                TweenMax.to('.bpa-front-default-card .bpa-front-dc--body', transT, {
                    scrollTo: {
                        y: _scrollToValue,
                        autoKill: false
                    },
                    ease:Power3.easeInOut,
                    delay: 0.55
                } );
            }
        }

        function animScroll(paramID) {
            // $len = transT + ($(".wrapper").scrollTop() / $(".wrapper").innerHeight()) * 0.15;

            let $len = 10;

            let _offset = 100;

            TweenMax.to(wrapper, $len, {
                scrollTo: {
                    y: paramID,
                    offsetY: _offset,
                    autoKill: false
                },
                ease: Power1.easeInOut
            });

            var hash = "#" + paramID.split("#")[1];
            history.pushState(null, null, hash);
        }

    })();
</script>