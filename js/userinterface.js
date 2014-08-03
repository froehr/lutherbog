$.datepicker.formatDate("dd.mm.yy");
$('.date').datepicker({ autoSize: true, defaultDate: +7 });

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

// Anpassen der Breite der lis auf Grund der Anzahl in der Unternavigation
var length = 100 / $("div#switch ul li").length;
$('#switch ul li').css('width', length + "%");

// viewuser button
$('#viewuser').click(function() {
	$('#viewuser').css('background-color', '#CCCCCC');
	$('#changeuser').css('background-color', '#3c4245');
	$('#adduser').css('background-color', '#3c4245');
	$('#viewuser-content').css('display', 'block');
	$('#changeuser-content').css('display', 'none');
	$('#adduser-content').css('display', 'none');
});

// changeuser button
$('#changeuser').click(function() {
	$('#changeuser').css('background-color', '#CCCCCC');
	$('#viewuser').css('background-color', '#3c4245');
	$('#adduser').css('background-color', '#3c4245');
	$('#changeuser-content').css('display', 'block');
	$('#viewuser-content').css('display', 'none');
	$('#adduser-content').css('display', 'none');
});

// adduser button
$('#adduser').click(function() {
	$('#adduser').css('background-color', '#CCCCCC');
	$('#changeuser').css('background-color', '#3c4245');
	$('#viewuser').css('background-color', '#3c4245');
	$('#adduser-content').css('display', 'block');
	$('#changeuser-content').css('display', 'none');
	$('#viewuser-content').css('display', 'none');
});

// calibration button
$('#calibration').click(function() {
	$('#calibration').css('background-color', '#CCCCCC');
	$('#weather').css('background-color', '#3c4245');
	$('#viewuser').css('background-color', '#3c4245');
	$('#calibration-content').css('display', 'block');
	$('#weather-content').css('display', 'none');
	$('#viewuser-content').css('display', 'none');
});

// weather button
$('#weather').click(function() {
	$('#weather').css('background-color', '#CCCCCC');
	$('#calibration').css('background-color', '#3c4245');
	$('#viewuser').css('background-color', '#3c4245');
	$('#weather-content').css('display', 'block');
	$('#calibration-content').css('display', 'none');
	$('#viewuser-content').css('display', 'none');
});

$('#viewuser').css('background-color', '#CCCCCC');

// logout button
$('#logout').hover(function() {
	$('#logout-content').css('display', 'block');
});

$('header').hover(function() {
	$('#logout-content').css('display', 'none');
});


// Register new users
$('#login-button').click(function(){
	login();
});

$('#register-button').click(function(){
	register();
});

$('#data-access').change(function(){
        if ($('#data-access').val() == 2) {
            $('#map-access').val('2');
        }
});

$('#admin-access').change(function(){
        if ($('#admin-access').val() == 1) {
            $('#map-access').val('2');
	    $('#data-access').val('2');
        }
});

// Wetterplot updaten wenn Datum geändert wird
$('#weather-start-date').change(function(){
    weatherplot();
});

$('#weather-end-date').change(function(){
    weatherplot();
});
// -----------------------------------------------