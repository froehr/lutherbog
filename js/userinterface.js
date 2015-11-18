// Datepicker per jQuery
$('.date').datepicker({ autoSize: true, dateFormat: "dd.mm.yy"});
// -----------------------------------------------

// Impressum unten rechts einblenden
$('#impressum').click(function() {
	$('#impressum-content').css('display', 'block');
});
// -----------------------------------------------

// Impressum unten rechts ausblenden
$('#impressum-content').click(function() {
	$('#impressum-content').css('display', 'none');
});
// -----------------------------------------------

// Usermanagement
$('#login').click(function() {
	if ($('#login-content').css('display') == 'none') {
		$('#login-content').css('display', 'block');
	}
	else{
		$('#login-content').css('display', 'none');
	}
});
// -----------------------------------------------

// Usermanagement small medium
$('#login').click(function() {
	if ($('#login-content2').css('display') == 'none') {
		$('#login-content2').css('display', 'block');
	}
	else{
		$('#login-content2').css('display', 'none');
	}
});
// -----------------------------------------------

// Anpassen der Breite der lis auf Grund der Anzahl in der Unternavigation
var length = 100 / $("div#switch ul li").length;
$('#switch ul li').css('width', length + "%");
// -----------------------------------------------

// viewuser button
$('#viewuser').click(function() {
	$('#viewuser').css('background-color', '#CCCCCC');
	$('#changeuser').css('background-color', '#3c4245');
	$('#adduser').css('background-color', '#3c4245');
	$('#viewuser-content').css('display', 'block');
	$('#changeuser-content').css('display', 'none');
	$('#adduser-content').css('display', 'none');
});
// -----------------------------------------------

// changeuser button
$('#changeuser').click(function() {
	$('#changeuser').css('background-color', '#CCCCCC');
	$('#viewuser').css('background-color', '#3c4245');
	$('#adduser').css('background-color', '#3c4245');
	$('#changeuser-content').css('display', 'block');
	$('#viewuser-content').css('display', 'none');
	$('#adduser-content').css('display', 'none');
});
// -----------------------------------------------

// adduser button
$('#adduser').click(function() {
	$('#adduser').css('background-color', '#CCCCCC');
	$('#changeuser').css('background-color', '#3c4245');
	$('#viewuser').css('background-color', '#3c4245');
	$('#adduser-content').css('display', 'block');
	$('#changeuser-content').css('display', 'none');
	$('#viewuser-content').css('display', 'none');
});
// -----------------------------------------------

// calibration button
$('#calibration').click(function() {
	$('#calibration').css('background-color', '#CCCCCC');
	$('#weather').css('background-color', '#3c4245');
	$('#viewuser').css('background-color', '#3c4245');
	$('#calibration-content').css('display', 'block');
	$('#weather-content').css('display', 'none');
	$('#viewuser-content').css('display', 'none');
});
// -----------------------------------------------

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

// Wetterplot updaten wenn Auswahl geändert wird
$('#weather-start-date, #weather-end-date, #weather-rain, #weather-par, #weather-temperatur, #weather-humidity, #weather-wind, #weather-gust').change(function(){
	weatherplot();
});
// -----------------------------------------------

// Dataplot updaten wenn Auswahl geändert wird
$('#data-start-date, #data-end-date, #data-temp, #data-gauge, #data-co2, #data-ch4, #data-site1, #data-site2, #data-site3, #data-site4').change(function(){
	dataplot();
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

// Switches Helpseite
$('#map-help').click(function() {
	$('#map-help').css('background-color', '#CCCCCC');
	$('#access-help').css('background-color', '#3c4245');
	$('#upload-help').css('background-color', '#3c4245');
	$('#technical-help').css('background-color', '#3c4245');
	$('#map-help-content').css('display', 'block');
	$('#access-help-content').css('display', 'none');
	$('#upload-help-content').css('display', 'none');
	$('#technical-help-content').css('display', 'none');
});

$('#access-help').click(function() {
	$('#access-help').css('background-color', '#CCCCCC');
	$('#map-help').css('background-color', '#3c4245');
	$('#upload-help').css('background-color', '#3c4245');
	$('#technical-help').css('background-color', '#3c4245');
	$('#access-help-content').css('display', 'block');
	$('#map-help-content').css('display', 'none');
	$('#upload-help-content').css('display', 'none');
	$('#technical-help-content').css('display', 'none');
});

$('#upload-help').click(function() {
	$('#upload-help').css('background-color', '#CCCCCC');
	$('#access-help').css('background-color', '#3c4245');
	$('#map-help').css('background-color', '#3c4245');
	$('#technical-help').css('background-color', '#3c4245');
	$('#upload-help-content').css('display', 'block');
	$('#access-help-content').css('display', 'none');
	$('#map-help-content').css('display', 'none');
	$('#technical-help-content').css('display', 'none');
});

$('#technical-help').click(function() {
	$('#technical-help').css('background-color', '#CCCCCC');
	$('#upload-help').css('background-color', '#3c4245');
	$('#access-help').css('background-color', '#3c4245');
	$('#map-help').css('background-color', '#3c4245');
	$('#technical-help-content').css('display', 'block');
	$('#upload-help-content').css('display', 'none');
	$('#access-help-content').css('display', 'none');
	$('#map-help-content').css('display', 'none');
});
// -----------------------------------------------

// Welcome zentrieren
var windowwidth = $(window).width();
$('#welcome').css('left', (windowwidth-1360)/2);
$(window).resize(function(){
	var windowwidth = $(window).width();
	$('#welcome').css('left', (windowwidth-1360)/2);
});

var windowheight = $(window).height();
$('#welcome-about').css('height', (windowheight-85-25-120));
$('#welcome-from').css('height', (windowheight-85-25-120));
$('#welcome-technologies').css('height', (windowheight-85-25-120));
$('#welcome-news').css('height', (windowheight-85-25-120));
$(window).resize(function(){
	var windowheight = $(window).height();
	$('#welcome-about').css('height', (windowheight-85-25-120));
	$('#welcome-from').css('height', (windowheight-85-25-120));
	$('#welcome-technologies').css('height', (windowheight-85-25-120));
	$('#welcome-news').css('height', (windowheight-85-25-120));
});
// -----------------------------------------------

// MUSS gelöscht werden:
$('#weather-content').css('display', 'block');

