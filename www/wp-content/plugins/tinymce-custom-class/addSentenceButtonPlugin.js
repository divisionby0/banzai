(function() {

    var spanId=-1;

    function getRandomColor() {
        var letters = 'BCDEF'.split('');
        var color = '#';
        for (var i = 0; i < 6; i++ ) {
            color += letters[Math.floor(Math.random() * letters.length)];
        }
        return color;
    }

    function generateRandomId(){
        return Math.round(Math.random()*45000);
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
            var selectedText = editor.selection.getContent({
                'format': 'html'
            });

            // TODO detect overlapping

            // Insert selected text back into editor, wrapping it in an anchor tag
            var selectionStylePrefix = 'style="border-style: solid; border-width: 1px; border-color:';
            var borderColor = getRandomColor();
            var selectionStylePostfix = '"';
            var style = selectionStylePrefix+borderColor+selectionStylePostfix;
            editor.execCommand('mceReplaceContent', false, '<span id="'+generateRandomId()+'" class="sentence" '+style+'>' + selectedText + '</span>');
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