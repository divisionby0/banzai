(function() {

    var $ = jQuery;

    function removeAllSpans(string){
        return string.replace(/<\/?span[^>]*>/g,"");
    }

    tinymce.PluginManager.add( 'removeSentencesButton', function( editor, url ) {
        // Add Button to Visual Editor Toolbar
        editor.addButton('removeSentencesButton', {
            title: 'Remove all sentences',
            cmd: 'removeSentencesButton',
            image: url + '/removeSentencesIcon.png'
        });
 

        editor.addCommand('removeSentencesButton', function() {
            var text = editor.getContent({
                'format': 'html'
            });

            var htmlWithoutSpans = removeAllSpans(text);
            tinyMCE.activeEditor.setContent(htmlWithoutSpans);
        });

        // Enable/disable the button on the node change event
        editor.onNodeChange.add(function( editor ) {
            // Get selected text, and assume we'll disable our button
            var selection = editor.selection.getContent();
            var disable = true;

            // If we have some text selected, don't disable the button
            if ( selection ) {
                disable = false;
            }

            // Define whether our button should be enabled or disabled
            editor.controlManager.setDisabled( 'addSentenceButton', disable );
        });
    });
})();