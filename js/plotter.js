function weatherplot() {
    
    // Benštigte Daten aus der Datenbank holen
    jQuery.ajax({
            type: "POST",
            url: 'process/get_plotter_data.php',
            dataType: 'json',
            data: { weather_start_date:$('#weather-start-date').val(),
                    weather_end_date:$('#weather-end-date').val(),
                    rain:$('#weather-rain').is(':checked'),
                    par:$('#weather-par').is(':checked'),
                    temp:$('#weather-temperatur').is(':checked'),
                    rh:$('#weather-humidity').is(':checked'),
                    wind_speed:$('#weather-wind').is(':checked'),
                    gust_speed:$('#weather-gust').is(':checked'),
                    bat:$('#weather-bat').is(':checked')
                    },
            success: function(data) {
                results = data;
            },
            async: false,
        });
    console.log(results);
    
    var rainfalldata = [];
    var i = 0;
    var part = []
    while (i < results.length) {
        var date = new Date(results[i]['unixdate']*1000);
        
        part = [Date.UTC(date.getFullYear(), date.getMonth(), date.getDate()), parseFloat(results[i].temp)];
        rainfalldata.push(part);
        i++;
    }
    
    //console.log(rainfalldata);
    
    var yaxis = [{
            title: {
                text: 'Temperature',
                style: {
                    color: '#BF0B23'
                }
            },
            labels: {
                format: '{value} \xB0C',
                style: {
                    color: '#BF0B23'
                }
            }
        }];
        
    var serie = [{
            name: 'Rainfall',
            color: '#5C9DFF',
            type: 'spline',
            tooltip: {
                valueSuffix: ' mm'
            },
            data: rainfalldata
        }];
    
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
        plotOptions : {
			series : {
				pointStart : '',
				pointInterval : 24 * 3600 * 1000  // ~ten days
			}
		},
        
        series: serie
    });
};
    


function dataplot() {
    // Benštigte Daten aus der Datenbank holen
    jQuery.ajax({
            type: "POST",
            url: 'process/get_plotter_data.php',
            dataType: 'html',
            data: { weather_start_date:$('#weather-start-date').val(),
                    weather_end_date:$('#weather-end-date').val(),
                    rain:$('#weather-rain').is(':checked'),
                    par:$('#weather-par').is(':checked'),
                    temp:$('#weather-temperatur').is(':checked'),
                    rh:$('#weather-humidity').is(':checked'),
                    wind_speed:$('#weather-wind').is(':checked'),
                    gust_speed:$('#weather-gust').is(':checked'),
                    bat:$('#weather-bat').is(':checked')
                    },
            success: function(data) {
                results = data;
            },
            async: false,
        });
    
    $('#dataplot').highcharts({
        chart: {
            type: 'scatter',
            zoomType: 'xy'
        },
        title: {
            text: 'CH4 und CO2 Werte gegen Temperatur geplottet'
        },
        subtitle: {
            text: 'Daten Lutherbog Canada'
        },
        xAxis: {
            title: {
                enabled: true,
                text: 'Temperatur in Grad Celsius'
            }
        },
        yAxis: {
            title: {
                text: ''
            },
            startOnTick: true,
            endOnTick: true,
            showLastLabel: true
        },
        legend: {
            layout: 'vertical',
            align: 'left',
            verticalAlign: 'top',
            x: 100,
            y: 70,
            floating: true,
            backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF',
            borderWidth: 1
        },
        plotOptions: {
            scatter: {
                marker: {
                    radius: 5,
                    states: {
                        hover: {
                            enabled: true,
                            lineColor: 'rgb(100,100,100)'
                        }
                    }
                },
                states: {
                    hover: {
                        marker: {
                            enabled: false
                        }
                    }
                },
                tooltip: {
                    headerFormat: '<b>{series.name}</b><br>',
                    pointFormat: '{point.x} cm, {point.y} kg'
                }
            }
        },
        series: [{
            name: 'Female',
            color: 'rgba(223, 83, 83, .5)',
            data: [[163.8, 67.3]]

        }, {
            name: 'Male',
            color: 'rgba(119, 152, 191, .5)',
            data: [[174.0, 65.6]]
        }]
    });
};

   
