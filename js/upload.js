function handleFileSelect(evt) {
    var files = evt.target.files; // FileList object

    // files is a FileList of File objects. List some properties.
    var output = [];
    
    var fr = new FileReader();
    fr.onload = function(e) {
        // e.target.result should contain the text
    };
    fr.readAsText(file);
    
    
    document.getElementById('list').innerHTML = '<ul>' + output.join('') + '</ul>';
}

  document.getElementById('files').addEventListener('change', handleFileSelect, false);