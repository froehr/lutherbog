function register() {
    
    var username = false;
    var password = false;
    var password1 = false;
    var name = false;
    var surname = false;
    var email = false
    var mapaccess = false;
    var dataaccess = false;
    var adminaccess = false;
    
    // Testen ob alle Felder gefüllt sind
    if ($('#username').val() == ''){
        $('#user-empty').css('display', 'block');
        username = false;
    }
    else{
        $('#user-empty').css('display', 'none');
    }
    if ($('#password').val() == ''){
        $('#password-empty').css('display', 'block');
        password = false;
    }
    else{
        $('#password-empty').css('display', 'none');
    }
    if ($('#password1').val() == ''){
        $('#password1-empty').css('display', 'block');
        password1 = false;
    }
    else{
        $('#password1-empty').css('display', 'none');
    }
    if ($('#name').val() == ''){
        $('#name-empty').css('display', 'block');
        name = false;
    }
    else{
        $('#name-empty').css('display', 'none');
        name = true;
    }
    if ($('#surname').val() == ''){
        $('#surname-empty').css('display', 'block');
        surname = false;
    }
    else{
        $('#surname-empty').css('display', 'none');
        surname = true;
    }
    if ($('#email').val() == ''){
        $('#email-empty').css('display', 'block');
        email = false;
    }
    else{
        $('#email-empty').css('display', 'none');
        email = true;
    }
    if ($('#map-access').val() == 'x'){
        $('#map-empty').css('display', 'block');
        mapaccess = false;
    }
    else{
        $('#map-empty').css('display', 'none');
        mapaccess = true;
    }
    if ($('#data-access').val() == 'x'){
        $('#data-empty').css('display', 'block');
        dataaccess = false;
    }
    else{
        $('#data-empty').css('display', 'none');
        dataaccess = true;
    }
    if ($('#admin-access').val() == 'x'){
        $('#admin-empty').css('display', 'block');
        adminaccess = false;
    }
    else{
        $('#admin-empty').css('display', 'none');
        adminaccess = true;
    }

    // Testen ob Benutzername schon vorhanden ist
    if ($('#username').val() != ''){
        jQuery.ajax({
            type: "POST",
            url: 'register_user.php',
            dataType: 'html',
            data: {username:$('#username').val(), action:'testUsername'},
            success: function(data) {
                results = data;
            },
            async: false,
        });
        
        if (results == 'error') {
            $('#user-error').css('display', 'block');
        }
        else {
            $('#user-error').css('display', 'none');
            username = true;
        }
    }
    
    if ($('#password').val() == $('#password1').val() && $('#password').val() != '') {
        $('#password-error').css('display', 'none');
        password = true;
        password1 = true;
    }
    else {
        $('#password-error').css('display', 'block');
        $('#password-empty').css('display', 'none');
        $('#password1-empty').css('display', 'none');
    }  
    
    if (username == true && password == true && password1 == true && name == true && surname == true && email == true && mapaccess == true && dataaccess == true && adminaccess == true) {
        jQuery.ajax({
            type: "POST",
            url: 'register_user.php',
            dataType: 'html',
            data: {username:$('#username').val(), password:$('#password').val(), name:$('#name').val(), surname:$('#surname').val(), email:$('#email').val(), mapaccess:$('#map-access').val(), dataaccess:$('#data-access').val(), adminaccess:$('#admin-access').val(), action:'insertIntoDB'},
            success: function(data) {
                results = data;
            },
            async: false,
        });
        if (results == 'success') {
            $('#register-success').css('display', 'block');
            setTimeout(function() {
		$('#register-success').css('display', 'none');
                $('#username').val('');
                $('#password').val('');
                $('#password1').val('');
                $('#name').val('');
                $('#surname').val('');
                $('#email').val('');
                $('#map-access').val('');
                $('#data-access').val('');
                $('#admin-access').val('');
	    }, 1500);
        }
        else {
            console.log(results);
            $('#register-error').css('display', 'block');
        }
    }
}

