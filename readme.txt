=== WP Post Popup ===
Contributors: allurewebsolutions
Tags: modal, popup
Donate link: https://allurewebsolutions.com/product/donation
Requires at least: 3.0
Tested up to: 5.3
License: GPLv2
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Turn any page / post / external page into a popup instantly!

== Description ==
Turn any page / post / external page into a popup instantly!

Perfect for showing basic content pages without redirecting a user to the page.

== Features ==
 * Loads only the_content() field -- excludes header/footer/sidebars/etc.
 * Optionally load custom fields using a custom page template [See Documentation](https://allurewebsolutions.com/open-wordpress-post-modal-without-plugin#customize)
 * Trigger popup on page load using a URL a parameter
 * A page can have multiple popup links
 * Scroll to a specified anchor once the popup opens
 * Show external pages in popup
 * Show only a specific section from an external page
 * Works with shortcodes and some plugins, including Contact Form 7, BuddyPress, Visual Composer
 * Dynamically change URL in address bar to that of the the popped up page
 * Toggle simple styling
 * Visual Editor button for easy popup link creation
 * Set a breakpoint below which the page will load normally instead of a popup

== Useful Links ==
* [Demo Site](https://wp-post-modal.allureprojects.com/)
* [Contact us for feedback and bug reports](https://allurewebsolutions.com/contact)
* [Guidelines for submitting a support request](https://allurewebsolutions.com/open-wordpress-post-modal-without-plugin#support)

== Installation ==
1. Upload `wp-post-modal.zip` to the `/wp-content/plugins/` directory and extract
2. Activate the plugin through the "Plugins" menu in WordPress
3. Add the class `modal-link` to open the href of that link into a modal window.

== Frequently Asked Questions ==

= Where is the documentation? =
[See Documentation](http://wp-post-modal.allureprojects.com/documentation)

= Will these Popups be blocked by an Ad Blocker? =
They will not because these aren't "popups" in the sense of an Ad. The way this works is by creating a modal window which is a just a section of your page that is hidden until a click or some other action makes it visible.

= Where does the content of the popup come from? =
The content can come from any web page. If it is from a post or page (or any custom post type) from your site, it will
be the content that is in the WordPress editor (or from a custom template) . In other words, the popup will not show
your header, footer, nor sidebars. Just the primary content. If it is from another website, it will typically be the
core or main content on that page, but you define that.

You simply make a page or post with the content you want, as you always do.

= How is the popup triggered? =
[See Documentation](http://wp-post-modal.allureprojects.com/documentation)

= Can I use anchor links? =
Yes, you can add an anchor to the end of your URL (for internally linked pages) and the popup will scroll to the
position of the anchor.

= Using a custom div ID =
You can change the name of the default site-wide div ID to use in the plugin settings. Alternatively, you can change the div ID case-by-case by adding this attribute `data-div="DIVID"` to your modal links.

= What if my External Page isn't loading =
If your external page isn't working, then you can try using the [iFrame method](http://wp-post-modal.allureprojects.com/documentation). With the iFrame method the entire external page will load. You will not be able to specify a specific div to load.

There are two ways to use the iframe method:

1. Add the class `iframe` to your modal-link to selectively use the iframe method
1. Turn on the iframe method in the plugin settings to make all external links use the iframe method

= Can I change the look of trigger link? =
Absolutely, any way you want. You can turn it into a button like this: `<a class="modal-link" href="http://my-site/privacy-policy/"><button type="button">Our Privacy Policy</button></a>` or make it an image.

= How do I change the look of the popup it self? What settings are available? =
[See Documentation](http://wp-post-modal.allureprojects.com/documentation)

= Can I have multiple popups on one page? =
Yes, you can have as many as you like.

== Screenshots ==
1. How the modal looks with simple text page content
2. Style the popup within the WP Customizer
3. Available plugin settings
4. Easily insert popup link with custom button in Visual Editor

== Changelog ==
3.5.3: Updated how admin notices are dismissed
3.5.2: Minor bug fixes
3.5.1: Added redirection upon plugin activation
3.5.0: Enabled opening consecutive popups and minor bug fixes
3.4.2: Minor update to allow targeting of nested modal-links
3.4.1: Added aria label on modal wrapper
3.4.0: Added accessibility support for modal
3.3.1: Added plugin setting to disable native content wrapping
3.3.0: Added filter for changing default wrapping div id
3.2.6: Added data-div functionality for internal popups
3.2.5: Fix bug with popup being empty
3.2.4: Added setting for disabling body scrolling
3.2.3: Disabled popup for IE11
3.2.2: Fixed custom templates to work with URL parameter
3.2.1: Minor bug fix
3.2.0: Added setting for container ID, fixed minor JS bug, fixed bug with notifications
3.1.0: Added setting to toggle loading animation
3.0.1: Fix scrolling bug
3.0: Many improvements in plugin code
2.2: Add functionality to update URL in address bar
2.1.10: Allow preceding forward slash on anchor links, check if modal is open before running close modal function on window click
2.1.9: Refactor post with anchor functionality
2.1.8: Minor fix to move body to previously scrolled position after popup is closed
with port number
2.1.7: Changed slide down effect to fade in, prevented body scrolling when popup is open, recognize development URLs
2.1.6: Added support for anchor links and open with modal through URL
2.1.5: Add iframe method for loading more complicated external pages
2.1.4: Made Visual Editor button optional in plugin settings, improved error handling in ajax requests, refactor admin notice dismissal
2.1.3: Minor styling fixes
2.1.2: Close popup with esc key
2.1.1: Update remote admin notice functionality
2.1: Add legacy method with fallback, admin notices, remote notice, added support for buddypress profiles
2.0.5: Fix link when only slug is used
2.0.4: Works with all custom post types
2.0.3: Bug fix for if visual composer installed active
2.0.2: Minor styling fixes
2.0.1: AJAX method for loading external content
2.0: Version 2.0 contains new plugin settings, insert popup button in Visual Editor, refactored to using WP Rest API, and more!
1.4.2: Add click outside modal functionality
1.4.1: Bug fix
1.4: Add color overlay
1.0: Initial release
