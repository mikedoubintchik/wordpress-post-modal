(function ($) {
    'use strict';

    /**
     * All of the code for your admin-facing JavaScript source
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
        function addDays(date, days) {
            var result = new Date(date);
            result.setDate(result.getDate() + days);
            return result;
        }

        // show notices when page loads
        $.when($('.notice-success').removeClass('hidden')).done(function () {
            // if admin notice installed is dismissed
            if (localStorage.admin_notice_installed_dismissed && new Date() < addDays(localStorage.admin_notice_installed_dismissed, 14))
                $('.admin-notice-installed').addClass('hidden');

            // hide admin notice installed when dismissing notification
            $(document).on('click', '.admin-notice-installed .notice-dismiss', function () {
                localStorage.admin_notice_installed_dismissed = new Date();
            });

            var currentNoticeContent = $('.admin-notice-remote .notice-content').html();

            // hide remote notice if current remote notice content equals saved notice content
            if (localStorage.admin_notice_remote_dismissed) {
                if (JSON.parse(localStorage.admin_notice_remote_dismissed).content === currentNoticeContent)
                    $('.admin-notice-remote').addClass('hidden');
            }

            // hide admin notice installed when dismissing notification
            $(document).on('click', '.admin-notice-remote .notice-dismiss', function () {
                var noticeData = {
                    date: new Date(),
                    content: currentNoticeContent
                };

                localStorage.admin_notice_remote_dismissed = JSON.stringify(noticeData);
            });

        });


    });

})(jQuery);
