$('#impressum').click(function() {
	$('#impressum-content').css('display', 'block');
});

$('#impressum-content').click(function() {
	$('#impressum-content').css('display', 'none');
});

// Usermanagement
$('#login').click(function() {
	if ($('#login-content').css('display') == 'none') {
		$('#login-content').css('display', 'block');
	}
	else{
		$('#login-content').css('display', 'none');
	}
});
