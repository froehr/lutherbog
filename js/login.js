$('#input-error').css('display', 'none');

// Url depending on the location of the calling page. Without php/ if index.php calls
if((location.pathname).search("/php/") != -1){
    link = 'login.php';
}
else{
    link = 'php/login.php';
}
    
jQuery.ajax({
        type: "POST",
        url: link,
        dataType: 'html',
        data: {userinterface:"ui"},
        success: function(data) {
            results = data;
        },
        async: false,
});

if (results == 'true') {
    $('#login').css('display', 'none');
    $('#logout').css('display', 'block');
    $('#webgis').css('display', 'block');
    $('#admin').css('display', 'block');    
}


