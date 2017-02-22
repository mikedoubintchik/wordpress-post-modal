(function($) {
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


    $.fn.isExternal = function() {

        var host = new RegExp('/' + window.location.host + '/');
        var link = 'http://' + window.location.host + this.attr('href');
        return !host.test(link);

    };

    console.log('referrer: ' + document.referrer.split('/')[2]);
    console.log('host: ' + window.location.host);

    $(function() {

        // Close modal
        $('.close-modal').click(function() {
        	$('.modal-wrapper').removeClass('show')
            $('.modal').removeClass('show');
        });

        // Detect windows width function
        var $window = $(window);

        function checkWidth() {
            var windowsize = $window.width();

            // if the window is greater than 767px wide then do below. we don't want the modal to show on mobile devices and instead the link will be followed.
            if (windowsize > 767) {
                $('.modal-link').click(function(e) {

                    // Define variables
                    var modalContent = $('#modal-content');
                    var $this = $(this);
                    var postLink = $this.attr('href');
                    var dataDiv = $this.attr('data-div');
                    var $pluginUrl = $('#modal-ready').attr('data-plugin-path');
                    var loader = '<img class="loading" src="' + $pluginUrl + '/wp-post-modal/public/images/loading.gif" />';

                    // prevent link from being followed
                    e.preventDefault();

                    // display loading animation or in this case static content
                    modalContent.html(loader);

                    // Load content from external
                    if ($this.isExternal()) {
                        modalContent.load($pluginUrl + '/wp-post-modal/public/includes/proxy.php?url=' + encodeURI($this.attr('href')) + ' #' + dataDiv);
                    }
                    // Load content from internal
                    else {
                        modalContent.load(postLink + ' #modal-ready');
                    }

                    // show class to display the previously hidden modal
                    $('.modal-wrapper').slideDown("slow", function() {
                        $(this).addClass('show');
                        $('.modal').addClass('show');
                    });

                    // if you're below the fold this will animate and scroll to the modal
                    $('html, body').animate({
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
