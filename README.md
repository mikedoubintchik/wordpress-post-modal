#=== WP Post Popup ===
Contributors: allurewebsolutions
Tags: modal, popup
Donate link: https://allurewebsolutions.com/product/donation
Requires at least: 3.0
Tested up to: 4.9.7
Stable tag: 2.2
License: GPLv2
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Turn any page or post into a popup instantly!

##== Description ==
Turn any page or post into a popup instantly! Add a link anywhere, with a simple change, and the page or post (or any other post type) becomes a popup window. You can also have external web pages show in the popup as well.

Just the content of the page or post will show, the part you put into the editor when creating the page or post. No headers, footers, nor sidebars. Perfect for showing the Website Policy, or making an FAQ, etc., anywhere you need a user triggered popup window.

How simple is it? First, add a link to the page you want to show into your post (or page or widget or ...) and it will look like this in the text editor:

`<a href="http://my-site.com/privacy-policy/>Our Privacy Policy</a>`

Next, edit that link in the text editor by adding class="modal-link" into the link to make this:

`<a class="modal-link" href="http://my-site.com/privacy-policy/>Our Privacy Policy</a>`

Or use our new Visual Editor button to quickly and easily insert the link!

[CLICK FOR DEMO](https://wp-post-modal.allureprojects.com/)

[Contact us for feedback and bug reports](https://allurewebsolutions.com/contact)

##== Installation ==
1. Upload `wp-post-modal.zip` to the `/wp-content/plugins/` directory and extract
2. Activate the plugin through the "Plugins" menu in WordPress
3. Add the class `modal-link` to open the href of that link into a modal window.
4. If you want to show an external page in the modal, add the attribute `data-div="#id"` to your .modal-link where the <strong>id</strong> is the container on the target external page that you would like to display inside the modal
5. A page can have multiple modal links

##== Frequently Asked Questions ==

= What does this NOT do? =
These popups are not for getting the user's attention nor having them sign up for access, etc. These are to give the user additional information without leaving the page or site.

= What are the advantages of this popup? =
If your user needs additional information you will now be able to popup a window with that information. If the information is on a page or post within your site, you can have that popup with about 30 seconds worth of work. Information on an external site may take a minute or two longer to implement.

Most importantly, your user will not be taken to another page, on or off your site. The information will load quicker into the popup than going to the page itself.

= Will these Popups be blocked by an Ad Blocker =
They will not because these aren't "popups" in the sense of an Ad. The way this works is by creating a modal window which is a just a website block that is hidden until a click or some other action makes it visible.

= Where does the content of the popup come from? =
The content can come from any web page. If it is from a post or page (or any post-type) from your site, it will be the content that is in the editor in the back-end. In other words, the popup will not show your header, footer, nor sidebars. Just the primary content. If it is from another website, it will typically be the core or main content on that page.

You simply make a page or post with the content you want, as you always do.

= How is the popup triggered? =
With a slightly modified link to the page or post. The user must actively click on the link for the popup to show.
If you link to your privacy policy with a link like this:
`<a href="http://my-site.com/privacy-policy/>Our Privacy Policy</a>`

Then edit that link in the text editor by adding class="modal-link" into the link to make this:
`<a class="modal-link" href="http://my-site.com/privacy-policy/>Our Privacy Policy</a>`

If the link goes to a page on an external site, you need to find a container that has the content you want and a suitable ID. Once you know that, you need to add data-div="xx" to the link, where xx is the ID of content container. It also needs the class="modal-link" as well.  `<a class="modal-link" href="https://en.wikipedia.org/wiki/Apple" data-div="bodyContent">What is an apple?</a>`

The popup can be initiated in one more way through using a the `modal-link` URL parameter. Structure:
https://wp-post-modal.allureprojects.com?modal-link=[SLUG/URL] -- replace the SLUG/URL with the URL or slug of the page
you are trying to open in your popup. This will only work for internal pages.

= Can I use anchor links? =
Yes, you can add an anchor to the end of your URL (for internally linked pages) and the popup will scroll to the
position of the anchor.

= What if my External Page isn't loading =
If your external page isn't working with the normal or legacy method, then you can try using the "iFrame method." There are two ways to use the iframe method.

1. Add the class `iframe` to your modal-link to selectively use the iframe method
1. Turn on the iframe method in the plugin settings to make all external links use the iframe method

= Can I change the look of trigger link? =
Absolutely, any way you want. You can turn it into a button like this: `<a class="modal-link" href="http://my-site/privacy-policy/"><button type="button">Our Privacy Policy</button></a>` or make it an image.

= How do I change the look of the popup it self? What settings are available? =
You can change the look of the popup with CSS. When the plugin is installed, basic CSS is installed. The options page (Settings -> WP Post Popup) has several options.

The first is what symbol to use for the 'close button.' By default, the "×" character is used. You can change this to any character you like, or even to the word "close" or a blank space.

There is also what we call a "breakpoint" value, this is the smallest number of pixels in width you want the popup. If the screen the user is using is smaller than this number, instead of a popup, the user will be taken to the link target itself. The default is 768, so by default, a smartphone and most tablets will not show a popup, it will go to the link. You can put any value in this location, including zero.

Next you have the option to have the popup ignore the basic CSS that comes with the plugin. There is a link to show you what this CSS is. Note that you can use the Customizer (Appearance -> Customize -> Additional CSS) to modify the basic css, or to have a complete replacement.

= Can I have multiple popups on one page? =
Yes, you can have as many as you like.

##== Screenshots ==
1. How the modal looks with simple text page content
2. Style the popup within the WP Customizer
3. Available plugin settings
4. Easily insert popup link with custom button in Visual Editor

##== Changelog ==
1.0: Initial release
1.4: Add color overlay
1.4.1: Bug fix
1.4.2: Add click outside modal functionality
2.0: Version 2.0 contains new plugin settings, insert popup button in Visual Editor, refactored to using WP Rest API, and more!
2.0.1: AJAX method for loading external content
2.0.2: Minor styling fixes
2.0.3: Bug fix for if visual composer installed active
2.0.4: Works with all custom post types
2.0.5: Fix link when only slug is used
2.1: Add legacy method with fallback, admin notices, remote notice, added support for buddypress profiles
2.1.1: Update remote admin notice functionality
2.1.2: Close popup with esc key
2.1.3: Minor styling fixes
2.1.4: Made Visual Editor button optional in plugin settings, improved error handling in ajax requests, refactor admin notice dismissal
2.1.5: Add iframe method for loading more complicated external pages
2.1.6: Added support for anchor links and open with modal through URL
2.1.7: Changed slide down effect to fade in, prevented body scrolling when popup is open, recognize development URLs with port number
2.1.8: Minor fix to move body to previously scrolled position after popup is closed
2.1.9: Refactor post with anchor functionality
2.1.10: Allow preceding forward slash on anchor links, check if modal is open before running close modal function on window click
2.2: Add functionality to update URL in address bar