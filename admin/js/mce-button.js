(function () {
    tinymce.create("tinymce.plugins.wp_post_modal", {

        //url argument holds the absolute url of our plugin directory
        init: function (ed, url) {
            //add new button
            ed.addButton('modal_link', {
                title: "Insert/Edit Popup Link",
                cmd: "add_modal_link",
                image: "https://maxcdn.icons8.com/Share/icon/Dusk/User_Interface//details_popup1600.png"
            });

            ed.addCommand('add_modal_link', function () {
                var anchorText = ed.selection.getContent();
                var node = ed.selection.getNode();
                var currentUrl,
                    currentContainer,
                    buddypress;
                if (node.href) {
                    currentUrl = node.href;
                    currentContainer = node.getAttribute('data-div');
                    buddypress = node.getAttribute('data-buddypress');
                }

                console.log(buddypress);

                ed.windowManager.open({
                    title: 'Insert/Edit Popup Link',
                    body: [
                        {
                            type: 'textbox',
                            name: 'url',
                            value: currentUrl,
                            label: 'URL'
                        },
                        {
                            type: 'textbox',
                            name: 'text',
                            value: (anchorText ? anchorText : ''),
                            label: 'Link Text'
                        },
                        {
                            type: 'container',
                            name: 'external',
                            html: '<p>If this is an external link, provide the container ID below:</p>'
                        },
                        {
                            type: 'textbox',
                            name: 'container',
                            value: currentContainer,
                            label: 'Container ID'
                        },
                        {
                            type: 'checkbox',
                            name: 'buddypress',
                            checked: (!!buddypress),
                            text: 'Is this a BuddyPress profile page?'
                        }
                    ],
                    onsubmit: function (e) {
                        // Insert content when the window form is submitted
                        var container = (e.data.container ? ' data-div="' + e.data.container + '"' : '');
                        var buddypress = (e.data.buddypress ? ' data-buddypress="yes"' : '');
                        var link = '<a href="' + e.data.url + '" class="modal-link"' + container + buddypress + '>' + e.data.text + '</a>';
                        ed.insertContent(link);
                    }
                });
            });

        },

        createControl: function (n, cm) {
            return null;
        },

        getInfo: function () {
            return {
                longname: 'WP Post Popup',
                author: 'Allure Web Solutions',
                version: '1'
            };
        }
    });

    tinymce.PluginManager.add('wp_post_modal', tinymce.plugins.wp_post_modal);
})();