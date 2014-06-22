( function() {

    tinymce.PluginManager.add( 'wpeetd_custom_button', function( editor, url ) {

        editor.addCommand('InsertCustomContent', function() {

            editor.windowManager.open( {
                title: 'Example plugin',
                body: [{
                    type: 'textbox',
                    name: 'title',
                    label: 'Title'
                }],
                onsubmit: function( e ) {
                    var content = '[custom text="' + e.data.title + '"]';
                    editor.insertContent( content );
                }

            } );

        });

        editor.addButton( 'wpeetd_custom_button', {
            tooltip: 'Insert test content',
            icon: 'format-aside',
            onclick: function() {
                editor.execCommand( 'InsertCustomContent' );
            }
        } );

        /**
         * Replace shortcodes with our custom markup
         *
         * @param  string content markup
         * @return string content markup
         */
        function replaceShortcodes( content ) {
            return content.replace( /\[custom ([^\]]*)\]/g, function( match ) {
                var text = match.match( /text="([^\"]+)"/ );
                return html( { text: text[1] } );
            });
        }

        /**
         * Get HTML markup for custom elemnt.
         * @param  object data
         * @return string
         */
        function html( data ) {
           return '<h1 class="custom-header">' +  data.text + '</h1>';
        }

        /**
         * Replace custom header markup with shortcode.
         *
         * @param  string content markup
         * @return string content markup
         */
        function restoreShortcodes( content ) {
            content = content.replace( /<h1[^>]+>([^<]+)<\/h1>/g, function( match, text ) {
                return '<p>[custom text="' + text + '"]</p>';
            } );
            return content;
        }

        editor.on( 'BeforeSetContent', function( event ) {
            // event.content = replaceShortcodes( event.content );
        });

        editor.on( 'PostProcess', function( event ) {
            event.content = restoreShortcodes( event.content );
        });

    });

} )();