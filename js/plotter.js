function dataplot() {
    // Benötigte Daten aus der Datenbank holen
    jQuery.ajax({
        type: "POST",
        url: 'process/get_plotter_data.php',
        dataType: 'json',
        data: { action:'dataplot',
                data_start_date:$('#data-start-date').val(),
                data_end_date:$('#data-end-date').val(),
                ch4:$('#data-ch4').is(':checked'),
                co2:$('#data-co2').is(':checked'),
                site1:$('#data-site1').is(':checked'),
                site2:$('#data-site2').is(':checked'),
                site3:$('#data-site3').is(':checked'),
                site4:$('#data-site4').is(':checked'),
                },
        beforeSend: function(data) {
            $('#plotter-loading').css('display','block');
        },
        success: function(data) {
            console.log(data);
            dataplotter(data);
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
    var serie = [];
    
    if ($('#data-temp').is(':checked')) {
        var xAxisTitle = 'Temperatur in °C';
        
        if ($('#data-ch4').is(':checked')) {
            var pointFormat = 'Temp: {point.x} °C, <br> CH4: {point.y} mmol/m^2';
            var yAxisTitle = 'CH4 Fluss in mmol/m^2';
            var i = 0;
            while (i < results.length) {
                var array = {showInLegend: false, color: 'rgba(223, 83, 83, .5)', marker: {symbol: 'circle'}, name: results[i]['ch4']['collar'] + " am " + results[i]['ch4']['date'], data: [[results[i]['ch4']['temp_value'] , results[i]['ch4']['ch4_value']]]};
                serie.push(array);
                i++;
            }
        }
        if ($('#data-co2').is(':checked')) {
            var pointFormat = 'Temp: {point.x} °C, <br> CO2: {point.y} mmol/m^2';
            var yAxisTitle = 'CO2 Fluss in mmol/m^2';
            var i = 0;
            while (i < results.length) {
                var array = {showInLegend: false, color: 'rgba(223, 83, 83, .5)', marker: {symbol: 'circle'}, name: results[i]['co2']['collar'] + " am " + results[i]['co2']['date'], data: [[results[i]['co2']['temp_value'] , results[i]['co2']['co2_value']]]};
                serie.push(array);
                i++;
            }
        }
    }
    if ($('#data-gauge').is(':checked')) {
        var xAxisTitle = 'Pegelstand in cm';
        
        if ($('#data-ch4').is(':checked')) {
            var pointFormat = 'Pegel: {point.x} cm, <br> CH4: {point.y} mmol/m^2';
            var yAxisTitle = 'CH4 Fluss in mmol/m^2';
            var i = 0;
            while (i < results.length) {
                var array = {showInLegend: false, color: 'rgba(223, 83, 83, .5)', marker: {symbol: 'circle'}, name: results[i]['ch4']['collar'] + " am " + results[i]['ch4']['date'], data: [[results[i]['ch4']['gauge_value'] , results[i]['ch4']['ch4_value']]]};
                serie.push(array);
                i++;
            }
        }
        if ($('#data-co2').is(':checked')) {
            var pointFormat = 'Pegel: {point.x} cm, <br> CO2: {point.y} mmol/m^2';
            var yAxisTitle = 'CO2 Fluss in mmol/m^2';
            var i = 0;
            while (i < results.length) {
                var array = {showInLegend: false, color: 'rgba(223, 83, 83, .5)', marker: {symbol: 'circle'}, name: results[i]['co2']['collar'] + " am " + results[i]['co2']['date'], data: [[results[i]['co2']['gauge_value'] , results[i]['co2']['co2_value']]]};
                serie.push(array);
                i++;
            }
        }
    }
    
    $('#dataplot').highcharts({
        chart: {
            type : 'scatter',
            zoomType: 'xy'
        },
        title: {
            text: 'Daten vom ' + $('#data-start-date').val() + ' bis zum ' + $('#data-end-date').val()
        },
        subtitle: {
            text: 'Daten Lutherbog Canada'
        },
        xAxis : {
            title: {
                text: xAxisTitle
            }
	},
        yAxis : {
            title: {
                text: yAxisTitle
            }
	},
        series: serie,
        plotOptions: {
            scatter: {
                tooltip: {
                    headerFormat: '<b>{series.name}</b><br>',
                    pointFormat: pointFormat
                }
            }
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
        var ChartColor = "#"+ $('#rain-color').val();
        yaxis.push({title: {text: 'Niederschlag in mm',style: {color: ChartColor}},
                    labels: {format: '{value} mm', style: {color: ChartColor}},
                    id: 'rain-axis'});
        serie.push({name: 'Niederschlag',
                    color: ChartColor,
                    type: 'spline',
                    tooltip: {valueSuffix: 'mm'},
                    yAxis: 'rain-axis',
                    data: raindata});
    }
    
    // PAR-Strahlung aktivieren
    if ($('#weather-par').is(':checked') == true) {
        var ChartColor = "#"+ $('#par-color').val();
        yaxis.push({title: {text: 'PAR-Strahlung in uE',style: {color: ChartColor}},
                    labels: {format: '{value}uE', style: {color: ChartColor}},
                    id: 'par-axis'});
        serie.push({name: 'PAR-Strahlung',
                    color: ChartColor,
                    type: 'spline',
                    tooltip: {valueSuffix: 'uE'},
                    yAxis: 'par-axis',
                    data: pardata});
    }
    
    // Temperatur aktivieren
    if ($('#weather-temperatur').is(':checked') == true) {
        var ChartColor = "#"+ $('#temperatur-color').val();
        yaxis.push({title: {text: 'Temperatur in °C',style: {color: ChartColor}},
                    labels: {format: '{value}°C', style: {color: ChartColor}},
                    id: 'temp-axis'});
        serie.push({name: 'Temperatur',
                    color: ChartColor,
                    type: 'spline',
                    tooltip: {valueSuffix: '°C'},
                    yAxis: 'temp-axis',
                    data: tempdata});
    }
    
    // Luftfeuchtigkeit aktivieren
    if ($('#weather-humidity').is(':checked') == true) {
        var ChartColor = "#"+ $('#humidity-color').val();
        yaxis.push({title: {text: 'Relative Luftfeuchte in %',style: {color: ChartColor}},
                    labels: {format: '{value}%', style: {color: ChartColor}},
                    id: 'rh-axis',
                    max: 100});
        serie.push({name: 'rel. Luftfeuchtigkeit',
                    color: ChartColor,
                    type: 'spline',
                    tooltip: {valueSuffix: '%'},
                    yAxis: 'rh-axis',
                    data: rhdata});
    }
    
    // Wind aktivieren
    if ($('#weather-wind').is(':checked') == true) {
        var ChartColor = "#"+ $('#wind-color').val();
        yaxis.push({title: {text: 'Windgeschwindigkeit in m/s',style: {color: ChartColor}},
                    labels: {format: '{value}m/s', style: {color: ChartColor}},
                    id: 'wind-axis'});
        serie.push({name: 'Windgeschwindigkeit',
                    color: ChartColor,
                    type: 'spline',
                    tooltip: {valueSuffix: 'm/s'},
                    yAxis: 'wind-axis',
                    data: winddata});
    }
    
    // Wind aktivieren
    if ($('#weather-gust').is(':checked') == true) {
        var ChartColor = "#"+ $('#gust-color').val();
        yaxis.push({title: {text: 'Böengeschwindigkeit in m/s',style: {color: ChartColor}},
                    labels: {format: '{value}m/s', style: {color: ChartColor}},
                    id: 'gust-axis'});
        serie.push({name: 'Böengeschwindigkeit',
                    color: ChartColor,
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