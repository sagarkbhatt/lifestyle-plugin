(function( $ ) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */
	var lifestyleplugin= {
		init:function () {
			this.createSlider();
        },
        createSlider: function () {
            if ($('.slider').length) {
                console.log('Slider Activated');
                $('.slider').slick({
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    dots: true,
                    infinite: true,
                    cssEase: 'linear'
                });
            }

            $('.single-item').slick({
                    autoplay: true,
                    autoplaySpeed: 2000,
                    dots: true
                }
            );
            $('.slider-for').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: true,
                fade: true,
                asNavFor: '.slider-nav',
                dots: false
            });
            $('.slider-nav').slick({
                slidesToShow: 3,
                slidesToScroll: 1,
                asNavFor: '.slider-for',
                dots: false,
                centerMode: true,
                focusOnSelect: true,
                arrows: true,
                autoplay: true,
                autoplaySpeed: 2000
            });
        }
    }
    lifestyleplugin.init();

})( jQuery );
