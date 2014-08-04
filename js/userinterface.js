$('.date').datepicker({ autoSize: true, dateFormat: "dd.mm.yy"});

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
// -----------------------------------------------

$('#viewuser').css('background-color', '#CCCCCC');

// logout button
$('#logout').hover(function() {
	$('#logout-content').css('display', 'block');
});

$('header').hover(function() {
	$('#logout-content').css('display', 'none');
});
// -----------------------------------------------


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
// -----------------------------------------------

// Wetterplot updaten wenn Auswahl ge�ndert wird
$('#weather-start-date').change(function(){
    weatherplot();
});

$('#weather-end-date').change(function(){
    weatherplot();
});

$('#weather-rain').change(function(){
    weatherplot();
});

$('#weather-par').change(function(){
    weatherplot();
});

$('#weather-temperatur').change(function(){
    weatherplot();
});

$('#weather-humidity').change(function(){
    weatherplot();
});

$('#weather-wind').change(function(){
    weatherplot();
});

$('#weather-gust').change(function(){
    weatherplot();
});

$('#weather-bat').change(function(){
    weatherplot();
});
// -----------------------------------------------

// Data bzw. Weatherplot ein und ausblenden
$('#plot-weather').click(function(){
	$('#weatherplot').css('display', 'block');
	$('#dataplot').css('display', 'none');
	weatherplot();
});

$('#plot-data').click(function(){
	$('#weatherplot').css('display', 'none');
	$('#dataplot').css('display', 'block');
	dataplot();
});
// -----------------------------------------------