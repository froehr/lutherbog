function login() {
	if ($('#username').val() == '' || $('#password').val() == ''){
		$('#input-error').css('display', 'block');
		$('#login-error').css('display', 'none');
		$('#login-content').css('height', '200px');
	}
	else{
		$('#input-error').css('display', 'none');
		jQuery.ajax({
                    type: "POST",
                    url: 'php/process/login.php',
                    dataType: 'html',
                    data: {username:$('#username').val(), password:$('#password').val()},
                    success: function(data) {
                        results = data;
                    },
                    async: false,
		});
		
		if (results == 'success'){
			$('#login-error').css('display', 'none');
			$('#input-error').css('display', 'none');
			$('#login-success').css('display', 'block');
			$('#login-content').css('height', '200px');
			setTimeout(function() {
				location.reload();
			}, 1500);
			
		}
		
		else{
			$('#login-error').css('display', 'block');
			$('#input-error').css('display', 'none');
			$('#login-content').css('height', '200px');
		}
	}
}

$('#input-error').css('display', 'none');

// Url depending on the location of the calling page. Without php/ if index.php calls
if((location.pathname).search("/php/") != -1){
    link = 'process/login.php';
}
else{
    link = 'php/process/login.php';
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
    $('#help-button').css('display', 'none');
}