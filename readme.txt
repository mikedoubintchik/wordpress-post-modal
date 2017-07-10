=== WP Post Popup ===
Contributors: allurewebsolutions
Tags: modal, popup
Donate link: https://allurewebsolutions.com/product/donation
Requires at least: 3.0
Tested up to: 4.8
Stable tag: 1.4.2
License: GPLv2
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Turn any page or post into a popup instantly!

== Description ==
Turn any page or post into a popup instantly! Add a link anywhere, with a simple change, and the page or post (or any other post type) becomes a popup window. You can also have external web pages show in the popup as well.

Just the content of the page or post will show, the part you put into the editor when creating the page or post. No headers, footers, nor sidebars. Perfect for showing the Website Policy, or making an FAQ, etc., anywhere you need a user triggered popup window.

How simple is it? First, add a link to the page you want to show into your post (or page or widget or ...) and it will look like this in the text editor:

`<a href="http://my-site.com/privacy-policy/>Our Privacy Policy</a>`

Next, edit that link in the text editor by adding class="modal-link" into the link to make this:

`<a class="modal-link" href="http://my-site.com/privacy-policy/>Our Privacy Policy</a>`

[CLICK FOR DEMO](http://spedfaq.com/pop-up-test/)

And now you have a popup!

== Installation ==
1. Upload `wp-post-modal.zip` to the `/wp-content/plugins/` directory and extract
2. Activate the plugin through the \'Plugins\' menu in WordPress
3. Add the class `modal-link` to open the href of that link into a modal window.
4. If you want to show an external page in the modal, add the attribute `data-div="#id"` to your .modal-link where the <strong>id</strong> is the container on the target external page that you would like to display inside the modal
5. A page can have multiple modal links

== Frequently Asked Questions ==

= What content will be shown in the modal? =

Only the content of the page you write in the WordPress WYSIWYG editor will appear in the modal. Any headers, footers, etc will not appear.

== Screenshots ==
1. How the modal looks with simple text page content

== Changelog ==
1.0: Initial release
1.4: Add color overlay
1.4.1: Bug fix
1.4.2: Add click outside modal functionality
