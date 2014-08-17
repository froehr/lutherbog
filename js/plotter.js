function dataplot() {
    // Benötigte Daten aus der Datenbank holen
    jQuery.ajax({
        type: "POST",
        url: 'process/get_plotter_data.php',
        dataType: 'html',
        data: { action:'dataplot',
                data_start_date:$('#data-start-date').val(),
                data_end_date:$('#data-end-date').val(),
                ch4:$('#data-ch4').is(':checked'),
                co2:$('#data-co2').is(':checked'),
                site1:$('#data-site1').is(':checked'),
                site2:$('#data-site2').is(':checked'),
                site3:$('#data-site3').is(':checked'),
                site4:$('#data-site4').is(':checked'),
                site5:$('#data-site5').is(':checked'),
                site6:$('#data-site6').is(':checked'),
                },
        beforeSend: function(data) {
            $('#plotter-loading').css('display','block');
        },
        success: function(data) {
            weatherplotter(data);
            $('#plotter-success').css('display','block');
        },
        complete:function(data) {
            $('#plotter-loading').css('display','none');
            setTimeout(function() {
			$('#plotter-success').css('display','none');
	    }, 1000);
        }
    });
}

function dataplotter(results) {
    // Arrays für daten initialisieren
    var ch4data = [];
    var co2data = [];
    var yaxis = [];
    var serie = [];
    
    // Arrays mit daten aus JSON füllen, damit sie dargestellt werden können.
    var i = 0;
    while (i < results.length) {
        var date = new Date(results[i]['unixdate']);
        var time = Date.UTC(date.getFullYear(), date.getMonth(), date.getDate(), date.getHours(), date.getMinutes(), date.getSeconds());
        ch4data.push([time, results[i].ch4]);
        co2data.push([time, results[i].co2]);     
        i++;
    }
    
    // Ch4-Werte aktivieren
    if ($('#data-ch4').is(':checked') == true) {
        yaxis.push({title: {text: 'CH4-Werte in',style: {color: '#6699FF'}},
                    labels: {format: '{value} ', style: {color: '#6699FF'}},
                    id: 'ch4-axis'});
                    serie.push({name: 'CH4-Werte',
                    color: '#6699FF',
                    type: 'scatter',
                    tooltip: {valueSuffix: ''},
                    yAxis: 'ch4-axis',
                    data: ch4data});
    }
    
    // CO2-Werte aktivieren
    if ($('#data-co2').is(':checked') == true) {
        yaxis.push({title: {text: 'CO2-Werte in ',style: {color: '#FFFF00'}},
                    labels: {format: '{value}', style: {color: '#FFFF00'}},
                    id: 'co2-axis'});
                    serie.push({name: 'CO2-Werte',
                    color: '#FFFF00',
                    type: 'scatter',
                    tooltip: {valueSuffix: ''},
                    yAxis: 'co2-axis',
                    data: co2data});
    }
    
    $('#dataplot').highcharts({
        chart: {
            type : 'scatter',
            zoomType: 'xy'
        },
        title: {
            text: 'Daten von ' + $('#data-start-date').val() + ' bis ' + $('#data-end-date').val()
        },
        subtitle: {
            text: 'Daten Lutherbog Canada'
        },
        xAxis : {
            type : 'linear',
            plotLines : [{
                            dashStyle : 'longdashdot'
                    }
            ],
            title: {
                enabled: true,
                text: 'Temperatur'
            }
	},
        yAxis: yaxis,
        series: serie,
        tooltip : {
            crosshairs : true,
            shared : true
	},
    });
};

function weatherplot() {
    // Benötigte Daten aus der Datenbank holen
    jQuery.ajax({
        type: "POST",
        url: 'process/get_plotter_data.php',
        dataType: 'json',
        data: { action:'weatherplot',
                weather_start_date:$('#weather-start-date').val(),
                weather_end_date:$('#weather-end-date').val(),
                rain:$('#weather-rain').is(':checked'),
                par:$('#weather-par').is(':checked'),
                temp:$('#weather-temperatur').is(':checked'),
                rh:$('#weather-humidity').is(':checked'),
                wind_speed:$('#weather-wind').is(':checked'),
                gust_speed:$('#weather-gust').is(':checked')
                },
        beforeSend: function(data) {
            $('#plotter-loading').css('display','block');
        },
        success: function(data) {
            weatherplotter(data);
            $('#plotter-success').css('display','block');
        },
        complete:function(data) {
            $('#plotter-loading').css('display','none');
            setTimeout(function() {
			$('#plotter-success').css('display','none');
	    }, 1000);
        }
    });
}

function weatherplotter(results) {
    
    // Arrays für daten initialisieren
    var raindata = [];
    var pardata = [];
    var tempdata = [];
    var rhdata = [];
    var winddata = [];
    var gustdata = [];
    var batdata = [];
    var yaxis = [];
    var serie = [];
    
    // Arrays mit daten aus JSON füllen, damit sie dargestellt werden können.
    var i = 0;
    while (i < results.length) {
        var date = new Date(results[i]['unixdate']);
        var time = Date.UTC(date.getFullYear(), date.getMonth(), date.getDate(), date.getHours(), date.getMinutes(), date.getSeconds());
        raindata.push([time, results[i].rain]);
        pardata.push([time, results[i].par]);
        tempdata.push([time, results[i].temp]);
        rhdata.push([time, results[i].rh]);
        winddata.push([time, results[i].wind_speed]);
        gustdata.push([time, results[i].gust_speed]);       
        i++;
    }
    
    // Niederschlagsdaten aktivieren
    if ($('#weather-rain').is(':checked') == true) {
        yaxis.push({title: {text: 'Niederschlag in mm',style: {color: '#6699FF'}},
                    labels: {format: '{value} mm', style: {color: '#6699FF'}},
                    id: 'rain-axis'});
        serie.push({name: 'Niederschlag',
                    color: '#6699FF',
                    type: 'spline',
                    tooltip: {valueSuffix: 'mm'},
                    yAxis: 'rain-axis',
                    data: raindata});
    }
    
    // PAR-Strahlung aktivieren
    if ($('#weather-par').is(':checked') == true) {
        yaxis.push({title: {text: 'PAR-Strahlung in uE',style: {color: '#FFFF00'}},
                    labels: {format: '{value}uE', style: {color: '#FFFF00'}},
                    id: 'par-axis'});
        serie.push({name: 'PAR-Strahlung',
                    color: '#FFFF00',
                    type: 'spline',
                    tooltip: {valueSuffix: 'uE'},
                    yAxis: 'par-axis',
                    data: pardata});
    }
    
    // Temperatur aktivieren
    if ($('#weather-temperatur').is(':checked') == true) {
        yaxis.push({title: {text: 'Temperatur in °C',style: {color: '#FF0000'}},
                    labels: {format: '{value}°C', style: {color: '#FF0000'}},
                    id: 'temp-axis'});
        serie.push({name: 'Temperatur',
                    color: '#FF0000',
                    type: 'spline',
                    tooltip: {valueSuffix: '°C'},
                    yAxis: 'temp-axis',
                    data: tempdata});
    }
    
    // Luftfeuchtigkeit aktivieren
    if ($('#weather-humidity').is(':checked') == true) {
        yaxis.push({title: {text: 'Relative Luftfeuchte in %',style: {color: '#FF0000'}},
                    labels: {format: '{value}%', style: {color: '#FF0000'}},
                    id: 'rh-axis',
                    max: 100});
        serie.push({name: 'rel. Luftfeuchtigkeit',
                    color: '#FF0000',
                    type: 'spline',
                    tooltip: {valueSuffix: '%'},
                    yAxis: 'rh-axis',
                    data: rhdata});
    }
    
    // Wind aktivieren
    if ($('#weather-wind').is(':checked') == true) {
        yaxis.push({title: {text: 'Windgeschwindigkeit in m/s',style: {color: '#FF0000'}},
                    labels: {format: '{value}m/s', style: {color: '#FF0000'}},
                    id: 'wind-axis'});
        serie.push({name: 'Windgeschwindigkeit',
                    color: '#FF0000',
                    type: 'spline',
                    tooltip: {valueSuffix: 'm/s'},
                    yAxis: 'wind-axis',
                    data: winddata});
    }
    
    // Wind aktivieren
    if ($('#weather-gust').is(':checked') == true) {
        yaxis.push({title: {text: 'Böengeschwindigkeit in m/s',style: {color: '#FF0000'}},
                    labels: {format: '{value}m/s', style: {color: '#FF0000'}},
                    id: 'gust-axis'});
        serie.push({name: 'Böengeschwindigkeit',
                    color: '#FF0000',
                    type: 'spline',
                    tooltip: {valueSuffix: 'm/s'},
                    yAxis: 'gust-axis',
                    data: gustdata});
    }
    
    
    // Daten mit Highcharts anzeigen
    $('#weatherplot').highcharts({
        chart: {
            type : 'spline',
            zoomType: 'xy'
        },
        title: {
            text: 'Wetterdaten von ' + $('#weather-start-date').val() + ' bis ' + $('#weather-end-date').val()
        },
        subtitle: {
            text: 'Daten Lutherbog Canada'
        },
        xAxis : {
            type : 'datetime',
            plotLines : [{
                            dashStyle : 'longdashdot'
                    }
            ],
            title: {
                enabled: true,
                text: 'Datum'
            }
	},
        yAxis: yaxis,
        series: serie,
        tooltip : {
            crosshairs : true,
            shared : true
	},
    });
};

// Position von Loading anzeige anpassen
left = $('#scatterplot').offset().left;
up = $('#scatterplot').offset().top;
width = $('#scatterplot').width()/2-100;
height = $('#scatterplot').height()/2-210;
$('.plotter-processing').css('left',left + width);
$('.plotter-processing').css('top',up + height);

$(window).resize(function(){
    left = $('#scatterplot').offset().left;
    up = $('#scatterplot').offset().top;
    width = $('#scatterplot').width()/2-100;
    height = $('#scatterplot').height()/2-210;
    $('.plotter-processing').css('left',left + width);
    $('.plotter-processing').css('top',up + height);        
});

$('.plotter-processing').click(function(){
	$('#plotter-loading').css('display','none');
	$('#plotter-success').css('display','none');
});