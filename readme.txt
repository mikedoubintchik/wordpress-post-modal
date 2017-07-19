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

= What does this NOT do? =
These popups are not for getting the user's attention or having them sign up for access, etc. These are to give the user additional information without them leaving the page or site.

= What are the advantages of this popup? =
If your user needs additional information you will now be able to popup a window with that information. If the information is on a page or post within your site, you can have that popup with about 30 seconds worth of work. Information on an external site may take a minute or two longer to implement.

Most importantly, your user will not be taken to another page, on or off your site. The information will load quicker into the popup than going to the page itself.

= Where does the content of the popup come from? =
The content can come from any web page. If it is from a post or page (or any post-type) from your site, it will be the content that is in the editor in the back-end. In other words, the popup will not show your header, footer, nor sidebars. Just the primary content. If it is from another website, it will typically be the core or main content on that page.

You simply make a page or post with the contact you want, as you always do.

= How is the popup triggered? =
With a slightly modified link to the page or post. The user must actively click on the link for the popup to show.
If you link to your privacy policy with a link like this:
`<a href="http://my-site.com/privacy-policy/>Our Privacy Policy</a>`

Then edit that link in the text editor by adding class="modal-link" into the link to make this:
`<a class="modal-link" href="http://my-site.com/privacy-policy/>Our Privacy Policy</a>`

If the link goes to a page on an external site, you need to find the name of the DIV container that has the content you want. Once you know that, you need to add data-div="xx" to the link, where xx is the content container. `<a class="modal-link" href="https://en.wikipedia.org/wiki/Apple" data-div="bodyContent">What is an apple?</a>`

= Can I change the look of trigger link? =
Absolutely, any way you want. You can turn it into a button like this: `<a class="modal-link" href="http://my-site/privacy-policy/"><button type="button">Our Privacy Policy</button></a>`

= How do I change the look of the popup it self? =
You can change the look of the popup with CSS. That will be explained another time with documentation, etc.

= Can I have multiple popup on one page? =
As many as you like.

== Screenshots ==
1. How the modal looks with simple text page content
2. Style the popup within the WP Customizer
3. Activate basic styling in plugin settings
4. Easily insert popup link with custom button

== Changelog ==
1.0: Initial release
1.4: Add color overlay
1.4.1: Bug fix
1.4.2: Add click outside modal functionality
