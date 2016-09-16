(function() {

    function getRandomColor() {
        var letters = 'BCDEF'.split('');
        var color = '#';
        for (var i = 0; i < 6; i++ ) {
            color += letters[Math.floor(Math.random() * letters.length)];
        }
        return color;
    }


    tinymce.PluginManager.add( 'addSentenceButton', function( editor, url ) {
        // Add Button to Visual Editor Toolbar
        editor.addButton('addSentenceButton', {
            title: 'Insert Sentence',
            cmd: 'addSentenceButton',
            image: url + '/addSentencesIcon.png'
        });
 
        // Add Command when Button Clicked
        editor.addCommand('addSentenceButton', function() {
            // Check we have selected some text selected
            var text = editor.selection.getContent({
                'format': 'html'
            });

            // Insert selected text back into editor, wrapping it in an anchor tag
            editor.execCommand('mceReplaceContent', false, '<span class="sentence" style="border-style: solid; border-width: 1px; border-color: "+getRandomColor()+";">' + text + '</span>');
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