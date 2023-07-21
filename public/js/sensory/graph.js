//Variables
var today = new Date();
var year = today.getFullYear()

/*VARIABLE GRAFICO DE BARRAS*/
/*
function init_graph_bar_chart() {
    $.ajax({
        url: 'list_ajax_sensory_graphic',
        type: 'POST',
        data: {
            'action': 'init_graph_bar_chart'
        },
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    }).done(function (data) {
        if (!data.hasOwnProperty('error')) {
            graphcolumn.addSeries(data);
            return false;
        }
        console.log(data.error);
    }).fail(function (jqXHR, textStatus, errorThrown) {
        alert(textStatus + ': ' + errorThrown);
    }).always(function (data) {

    });

    var graphcolumn = Highcharts.chart('container-bar', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Reporte de Cantidad de Sensores del año ' + year
        },
        subtitle: {
            text: 'Reporte de columnas'
        },
        xAxis: {
            categories: [
                'Enero',
                'Febrero',
                'Marzo',
                'Abril',
                'Mayo',
                'Junio',
                'Julio',
                'Agosto',
                'Septiembre',
                'Octubre',
                'Noviembre',
                'Diciembre'
            ],
            crosshair: true
        },
        yAxis: {
            title: {
                useHTML: true,
                text: 'Valores Variables'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f} Valores</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            },
        },
    });
}

function init_graph_pie_chart() {
    $.ajax({
        url: 'list_ajax_sensory_graphic',
        type: 'POST',
        data: {
            'action': 'init_graph_pie_chart'
        },
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    }).done(function (data) {
        if (!data.hasOwnProperty('error')) {
            graphpie.addSeries(data);
            return false;
        }
        console.log(data.error);
    }).fail(function (jqXHR, textStatus, errorThrown) {
        alert(textStatus + ': ' + errorThrown);
    }).always(function (data) {

    });
    var graphpie = Highcharts.chart('container-pie', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Porcentaje de cantidad de variables por mes del año ' + year
        },
        tooltip: {
            pointFormat: '{series.name}: <br>{point.percentage:.1f} %<br>total: {point.total}'
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>:<br>{point.percentage:.1f} %<br>value: {point.y}',
                }
            }
        },
    });
}*/

function init_graph_line_chart() {
    $.ajax({
        url: 'list_ajax_sensory_graphic',
        type: 'POST',
        data: {
            'action': 'init_graph_line_chart'
        },
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    }).done(function (data) {
        if (!data.hasOwnProperty('error')) {
            graphiemultilene.addSeries(data[0]);
            graphiemultilene.addSeries(data[1]);
            graphiemultilene.addSeries(data[2]);
            graphiemultilene.addSeries(data[3]);
            graphiemultilene.addSeries(data[4]);
            graphiemultilene.xAxis[0].update(data[5]);
            return false;
        }
        console.log(data.error);
    }).fail(function (jqXHR, textStatus, errorThrown) {
        alert(textStatus + ': ' + errorThrown);
    }).always(function (data) {

    });

    var graphiemultilene = Highcharts.chart('container-multiline', {
        chart: {
            scrollablePlotArea: {
                minWidth: 700
            }
        },
        title: {
            text: 'GRAFICA DE LAS 10 ULTIMAS VARIABLES DE LOS SENSORES'
        },

        subtitle: {
            text: 'SYNHO'
        },

        yAxis: {
            title: {
                text: 'Sensores',
            }
        },
        xAxis: {
            title: {
                text: 'Sensores'
            },
            scrollbar: {
                enabled: true
            },
        },

        legend: {
            align: 'left',
            verticalAlign: 'top',
            borderWidth: 0
        },

        tooltip: {
            shared: true,
            crosshairs: true
        },
        plotOptions: {
            series: {
                cursor: 'pointer',
                className: 'popup-on-click',
                marker: {
                    lineWidth: 1
                }
            }
        },

        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        }

    });
}

function init_graph_guage_sensory1_chart() {
    $.ajax({
        url: 'list_ajax_sensory_graphic',
        type: 'POST',
        data: {
            'action': 'init_graph_guage_sensory1_chart'
        },
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    }).done(function (data) {
        if (!data.hasOwnProperty('error')) {
            gaugeOptions.addSeries(data);
            return false;
        }
        console.log(data.error);
    }).fail(function (jqXHR, textStatus, errorThrown) {
        alert(textStatus + ': ' + errorThrown);
    }).always(function (data) {

    });
    var gaugeOptions = Highcharts.chart('container-guage-sensory1', {
        chart: {
            type: 'gauge',
            plotBackgroundColor: null,
            plotBackgroundImage: null,
            plotBorderWidth: 0,
            plotShadow: false,
            height: '80%'
        },

        title: {
            text: 'Sensor 1'
        },

        pane: {
            startAngle: -90,
            endAngle: 89.9,
            background: null,
            center: ['50%', '75%'],
            size: '110%'
        },

        // the value axis
        yAxis: {
            min: 0,
            max: 100,
            tickPixelInterval: 72,
            tickPosition: 'inside',
            tickColor: Highcharts.defaultOptions.chart.backgroundColor || '#FFFFFF',
            tickLength: 20,
            tickWidth: 2,
            minorTickInterval: null,
            labels: {
                distance: 20,
                style: {
                    fontSize: '14px'
                }
            },
            lineWidth: 0,
            plotBands: [{
                from: 0,
                to: 50,
                color: '#55BF3B', // green
                thickness: 20
            }, {
                from: 50,
                to: 75,
                color: '#DDDF0D', // yellow
                thickness: 20
            }, {
                from: 75,
                to: 100,
                color: '#DF5353', // red
                thickness: 20
            }]
        },
    });
}

function init_graph_guage_sensory2_chart() {
    $.ajax({
        url: 'list_ajax_sensory_graphic',
        type: 'POST',
        data: {
            'action': 'init_graph_guage_sensory2_chart'
        },
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    }).done(function (data) {
        if (!data.hasOwnProperty('error')) {
            gaugeOptions.addSeries(data);
            return false;
        }
        console.log(data.error);
    }).fail(function (jqXHR, textStatus, errorThrown) {
        alert(textStatus + ': ' + errorThrown);
    }).always(function (data) {

    });
    var gaugeOptions = Highcharts.chart('container-guage-sensory2', {
        chart: {
            type: 'gauge',
            plotBackgroundColor: null,
            plotBackgroundImage: null,
            plotBorderWidth: 0,
            plotShadow: false,
            height: '80%'
        },

        title: {
            text: 'Sensor 2'
        },

        pane: {
            startAngle: -90,
            endAngle: 89.9,
            background: null,
            center: ['50%', '75%'],
            size: '110%'
        },

        // the value axis
        yAxis: {
            min: 0,
            max: 100,
            tickPixelInterval: 72,
            tickPosition: 'inside',
            tickColor: Highcharts.defaultOptions.chart.backgroundColor || '#FFFFFF',
            tickLength: 20,
            tickWidth: 2,
            minorTickInterval: null,
            labels: {
                distance: 20,
                style: {
                    fontSize: '14px'
                }
            },
            lineWidth: 0,
            plotBands: [{
                from: 0,
                to: 50,
                color: '#55BF3B', // green
                thickness: 20
            }, {
                from: 50,
                to: 75,
                color: '#DDDF0D', // yellow
                thickness: 20
            }, {
                from: 75,
                to: 100,
                color: '#DF5353', // red
                thickness: 20
            }]
        },
    });
}

function init_graph_guage_sensory3_chart() {
    $.ajax({
        url: 'list_ajax_sensory_graphic',
        type: 'POST',
        data: {
            'action': 'init_graph_guage_sensory3_chart'
        },
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    }).done(function (data) {
        if (!data.hasOwnProperty('error')) {
            gaugeOptions.addSeries(data);
            return false;
        }
        console.log(data.error);
    }).fail(function (jqXHR, textStatus, errorThrown) {
        alert(textStatus + ': ' + errorThrown);
    }).always(function (data) {

    });
    var gaugeOptions = Highcharts.chart('container-guage-sensory3', {
        chart: {
            type: 'gauge',
            plotBackgroundColor: null,
            plotBackgroundImage: null,
            plotBorderWidth: 0,
            plotShadow: false,
            height: '80%'
        },

        title: {
            text: 'Sensor 3'
        },

        pane: {
            startAngle: -90,
            endAngle: 89.9,
            background: null,
            center: ['50%', '75%'],
            size: '110%'
        },

        // the value axis
        yAxis: {
            min: 0,
            max: 100,
            tickPixelInterval: 72,
            tickPosition: 'inside',
            tickColor: Highcharts.defaultOptions.chart.backgroundColor || '#FFFFFF',
            tickLength: 20,
            tickWidth: 2,
            minorTickInterval: null,
            labels: {
                distance: 20,
                style: {
                    fontSize: '14px'
                }
            },
            lineWidth: 0,
            plotBands: [{
                from: 0,
                to: 50,
                color: '#55BF3B', // green
                thickness: 20
            }, {
                from: 50,
                to: 75,
                color: '#DDDF0D', // yellow
                thickness: 20
            }, {
                from: 75,
                to: 100,
                color: '#DF5353', // red
                thickness: 20
            }]
        },
    });
}

function init_graph_guage_sensory4_chart() {
    $.ajax({
        url: 'list_ajax_sensory_graphic',
        type: 'POST',
        data: {
            'action': 'init_graph_guage_sensory4_chart'
        },
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    }).done(function (data) {
        if (!data.hasOwnProperty('error')) {
            gaugeOptions.addSeries(data);
            return false;
        }
        console.log(data.error);
    }).fail(function (jqXHR, textStatus, errorThrown) {
        alert(textStatus + ': ' + errorThrown);
    }).always(function (data) {

    });
    var gaugeOptions = Highcharts.chart('container-guage-sensory4', {
        chart: {
            type: 'gauge',
            plotBackgroundColor: null,
            plotBackgroundImage: null,
            plotBorderWidth: 0,
            plotShadow: false,
            height: '80%'
        },

        title: {
            text: 'Sensor 4'
        },

        pane: {
            startAngle: -90,
            endAngle: 89.9,
            background: null,
            center: ['50%', '75%'],
            size: '110%'
        },

        // the value axis
        yAxis: {
            min: 0,
            max: 100,
            tickPixelInterval: 72,
            tickPosition: 'inside',
            tickColor: Highcharts.defaultOptions.chart.backgroundColor || '#FFFFFF',
            tickLength: 20,
            tickWidth: 2,
            minorTickInterval: null,
            labels: {
                distance: 20,
                style: {
                    fontSize: '14px'
                }
            },
            lineWidth: 0,
            plotBands: [{
                from: 0,
                to: 50,
                color: '#55BF3B', // green
                thickness: 20
            }, {
                from: 50,
                to: 75,
                color: '#DDDF0D', // yellow
                thickness: 20
            }, {
                from: 75,
                to: 100,
                color: '#DF5353', // red
                thickness: 20
            }]
        },
    });
}
function init_graph_guage_sensory5_chart() {
    $.ajax({
        url: 'list_ajax_sensory_graphic',
        type: 'POST',
        data: {
            'action': 'init_graph_guage_sensory5_chart'
        },
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    }).done(function (data) {
        if (!data.hasOwnProperty('error')) {
            gaugeOptions.addSeries(data);
            return false;
        }
        console.log(data.error);
    }).fail(function (jqXHR, textStatus, errorThrown) {
        alert(textStatus + ': ' + errorThrown);
    }).always(function (data) {

    });
    var gaugeOptions = Highcharts.chart('container-guage-sensory5', {
        chart: {
            type: 'gauge',
            plotBackgroundColor: null,
            plotBackgroundImage: null,
            plotBorderWidth: 0,
            plotShadow: false,
            height: '80%'
        },

        title: {
            text: 'Sensor 5'
        },

        pane: {
            startAngle: -90,
            endAngle: 89.9,
            background: null,
            center: ['50%', '75%'],
            size: '110%'
        },

        // the value axis
        yAxis: {
            min: 0,
            max: 100,
            tickPixelInterval: 72,
            tickPosition: 'inside',
            tickColor: Highcharts.defaultOptions.chart.backgroundColor || '#FFFFFF',
            tickLength: 20,
            tickWidth: 2,
            minorTickInterval: null,
            labels: {
                distance: 20,
                style: {
                    fontSize: '14px'
                }
            },
            lineWidth: 0,
            plotBands: [{
                from: 0,
                to: 50,
                color: '#55BF3B', // green
                thickness: 20
            }, {
                from: 50,
                to: 75,
                color: '#DDDF0D', // yellow
                thickness: 20
            }, {
                from: 75,
                to: 100,
                color: '#DF5353', // red
                thickness: 20
            }]
        },
    });
}

$(function () {
    //init_graph_bar_chart();
    //init_graph_pie_chart();
    init_graph_line_chart();
    init_graph_guage_sensory1_chart();
    init_graph_guage_sensory2_chart();
    init_graph_guage_sensory3_chart();
    init_graph_guage_sensory4_chart();
    init_graph_guage_sensory5_chart();
});