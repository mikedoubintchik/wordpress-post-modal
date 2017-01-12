(function ($) {
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

    $(function () {
        // Close modal
        $('.close-modal').click(function () {
            $('.modal').toggleClass('show');
        });

        // Detect windows width function
        var $window = $(window);

        function checkWidth() {
            var windowsize = $window.width();

            // if the window is greater than 767px wide then do below. we don't want the modal to show on mobile devices and instead the link will be followed.
            if (windowsize > 767) {
                $('.modal-link').click(function (e) {
                    var modalContent = $('#modal-content');
                    var post_link = $(this).attr('href'); // this can be used in WordPress and it will pull the content of the page in the href

                    e.preventDefault(); // prevent link from being followed

                    $('.modal').addClass('show', 1000, 'easeOutSine'); // show class to display the previously hidden modal
                    modalContent.html('loading...'); // display loading animation or in this case static content
                    modalContent.load(post_link + ' #modal-ready'); // for dynamic content, change this to use the load() function instead of html()
                    $('html, body').animate({ // if you're below the fold this will animate and scroll to the modal
                        scrollTop: 0
                    }, 'slow');
                    return false;
                });
            }
        };

        checkWidth(); // excute function to check width on load
        $(window).resize(checkWidth); // execute function to check width on resize
    });


})(jQuery);
