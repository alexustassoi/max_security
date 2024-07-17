(function () {
    tinymce.create('tinymce.plugins.Wptuts', {
        /**
         * Initializes the plugin, this will be executed after the plugin has been created.
         * This call is done before the editor instance has finished it's initialization so use the onInit event
         * of the editor instance to intercept that event.
         *
         * @param {tinymce.Editor} ed Editor instance that the plugin is initialized in.
         * @param {string} url Absolute URL to where the plugin is located.
         */
        init(ed, url) {
            /** **** orange btn shortcode ****** */
            ed.addButton('styled_heading_tag', {
                title: 'Add Styled Heading Tag',
                cmd: 'styled_heading_tag',
                // image : url + '/moon.png'
                text: 'Styled Heading Tag',
            });

            ed.addButton('styled_custom_button', {
                title: 'Add Styled Custom Button',
                cmd: 'styled_custom_button',
                // image : url + '/moon.png'
                text: 'Styled Custom Button',
            });

            /* ed.addCommand('styled_heading_tag', function () {
                const url = prompt('Please add URL to link');
                const btn_text = prompt('Please add text to link');
                let btn_class = prompt('Please add class to link');

                btn_class = btn_class || 'btn-primary';

                if (url !== null) {
                    const return_text = `[link]<a class="${btn_class}" href="${url}">${btn_text}</a>[/link]`;
                    ed.execCommand('mceInsertContent', 0, return_text);
                }
            }); */

            ed.addCommand('styled_heading_tag', function () {
                const tagName = prompt(
                    'Please specify what tag you want to use(H1, H2, H3, H4, H5, H6)'
                );
                const tagText = prompt('Please add text to tag');
                const tagClass = prompt(
                    'Please coloured tag: family-office-services, intelligence, max-academy, protection or leave it empty'
                );

                if (tagName !== null && tagText !== null && tagClass !== null) {
                    const return_text = `[styled_heading_tag tag_name=${tagName} tag_class=${tagClass}]${tagText}[/styled_heading_tag]`;
                    ed.execCommand('mceInsertContent', 0, return_text);
                }
            });

            ed.addCommand('styled_custom_button', function () {
                const btnType = prompt(
                    'Please specify what button you want to use(transparent-orange-btn, transparent-orange-dark-text-btn, blue-btn, orange-btn, orange-transparent-btn)'
                );
                const btnText = prompt('Please add text to button');
                const btnLink = prompt(
                    'Please provide a link for the button'
                );
                const btnSize = prompt(
                    'Please specify the button size (large-btn, medium-btn, small-btn)'
                );
                const isBtnPopup = prompt(
                    'Please indicate whether the button will cause a popup? ( yes/no )'
                );

                if (btnType !== null && btnText !== null && btnLink !== null && isBtnPopup !== null && btnSize !== null) {
                    const return_text = `[styled_custom_button btn_type=${btnType} btn_link=${btnLink} btn_size=${btnSize} is_btn_popup=${isBtnPopup}]${btnText}[/styled_custom_button]`;
                    ed.execCommand('mceInsertContent', 0, return_text);
                }
            });
        },

        /**
         * Creates control instances based in the incomming name. This method is normally not
         * needed since the addButton method of the tinymce.Editor class is a more easy way of adding buttons
         * but you sometimes need to create more complex controls like listboxes, split buttons etc then this
         * method can be used to create those.
         *
         * @param {string} n Name of the control to create.
         * @param {tinymce.ControlManager} cm Control manager to use inorder to create new control.
         * @return {tinymce.ui.Control} New control instance or null if no control was created.
         */
        createControl(n, cm) {
            return null;
        },

        /**
         * Returns information about the plugin as a name/value array.
         * The current keys are longname, author, authorurl, infourl and version.
         *
         * @return {Object} Name/value array containing information about the plugin.
         */
        getInfo() {
            return {
                longname: 'Wptuts Buttons',
                author: 'Lee',
                authorurl: 'http://wp.tutsplus.com/author/leepham',
                infourl:
                    'http://wiki.moxiecode.com/index.php/TinyMCE:Plugins/example',
                version: '0.1',
            };
        },
    });

    // Register plugin
    tinymce.PluginManager.add('wptuts', tinymce.plugins.Wptuts);
})();
