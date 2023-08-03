var date_range = null;
var date_now = new Date();

$("#search_data").click(function (e) {
    e.preventDefault();
    var formData = new FormData(document.getElementById("report-viatic"));
    //AJAX
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "list_ajax_sensory_report",
        method: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (data) {
            if (data.errors) {
                console.log(data.errors)
            } else if (data.code == 500) {
                Swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: data.message
                });
            } else {
                //Botones email, whatsapp
                $('#mail_data').show();
                $('#whatsapp_data').show();
                //tabla
                $('#lista').dataTable({
                    "bDestroy": true
                }).fnDestroy();
                
                table = $('#lista').DataTable({
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                    },
                    order: false,
                    paging: false,
                    ordering: false,
                    info: false,
                    searching: false,
                    dom: 'Bfrtip',
                    buttons: [{
                        extend: 'excelHtml5',
                        text: 'Descargar Excel <i class="fas fa-file-excel"></i>',
                        titleAttr: 'Excel',
                        className: 'btn btn-success btn-flat btn-xs'
                    },
                    {
                        extend: 'pdfHtml5',
                        text: 'Descargar Pdf <i class="fas fa-file-pdf"></i>',
                        titleAttr: 'PDF',
                        className: 'btn btn-danger btn-flat btn-xs',
                        download: 'open',
                        orientation: 'landscape',
                        pageSize: 'LEGAL',
                        customize: function (doc) {
                            doc.styles = {
                                header: {
                                    fontSize: 18,
                                    bold: true,
                                    alignment: 'center'
                                },
                                subheader: {
                                    fontSize: 13,
                                    bold: true
                                },
                                quote: {
                                    italics: true
                                },
                                small: {
                                    fontSize: 8
                                },
                                tableHeader: {
                                    bold: true,
                                    fontSize: 11,
                                    color: 'white',
                                    fillColor: '#2d4154',
                                    alignment: 'center'
                                }
                            };
                            doc.content[1].table.widths = ['5%', '20%',
                                '15%', '15%', '15%', '15%', '15%'
                            ];
                            doc.content[1].margin = [0, 35, 0, 0];
                            doc.content[1].layout = {};
                            doc['footer'] = (function (page, pages) {
                                return {
                                    columns: [{
                                        alignment: 'left',
                                        text: ['Fecha de creación: ',
                                            {
                                                text: date_now
                                            }
                                        ]
                                    },
                                    {
                                        alignment: 'right',
                                        text: ['página ', {
                                            text: page
                                                .toString()
                                        }, ' de ', {
                                                text: pages
                                                    .toString()
                                            }]
                                    }
                                    ],
                                    margin: 20
                                }
                            });

                        }
                    }
                    ]
                });
                table.clear();
                var numero = 0;

                $.each(data.data, function (i, item) {
                    numero = numero + 1

                    table.row.add([
                        numero,
                        data.data[i].created_at,
                        data.data[i].sensory1,
                        data.data[i].sensory2,
                        data.data[i].sensory3,
                        data.data[i].sensory4,
                        data.data[i].sensory5,
                    ]);
                });
                table.draw();
            }
        },
        error: function (data) {
            Swal.fire({
                type: 'error',
                title: 'Oops...',
                text: 'Algo ha salido mal',
            });
        }
    });

    init_report_graph_line_chart();
    //FIN AJAX
});


//GRAFICA
function init_report_graph_line_chart() {
    begin = $('#begin').val();
    finish = $('#finish').val();

    $.ajax({
        url: 'list_ajax_sensory_report_graphic', //window.location.pathname
        type: 'POST',
        data: {
            'action': 'init_report_graph_line_chart',
            'start_date': begin,
            'end_date': finish,
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
            text: 'GRAFICA DE SENSORES'
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
            }
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


//Correo
$("#mail_data").click(function(e) {
    e.preventDefault();
    begin = $('#begin').val();
    finish = $('#finish').val();
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
    })

    swal.fire({
        title: 'Enviar un Correo Electronico',
        text:'Mail: hola.synho.sac@gmail.com',
        showCancelButton: true,
        confirmButtonText: '<i class="zmdi zmdi-run"></i> Si, Enviar!',
        cancelButtonText: '<i class="zmdi zmdi-close-circle"></i> No, Enviar!',
        confirmButtonColor: '#03A9F4',
        cancelButtonColor: '#F44336',
        reverseButtons: true
    }).then((result) => {
        
        if (result.value) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "list_ajax_sensory_report_email",
                method: 'POST',
                data: {
                    'begin': begin,
                    'finish': finish,
                },
                success: function(data) {
                    console.log(data);
                    if (data.errors) {
                        console.log(data.errors)
                    } else if (data.code == 500) {
                        Swal.fire({
                            type: 'error',
                            title: 'Oops...',
                            text: data.message
                        });
                    } else {
                        Swal.fire({
                            type: 'success',
                            title: 'Exito',
                            text: data.message,
                            timer: 2000
                        });
                    }
                },
                error: function(data) {
                    Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Algo ha salido mal'
                    });
                }
            }); //FIN DE AJAX 
        } else {
            //Vacio
        }
    });
});


//Correo
$("#whatsapp_data").click(function(e) {
    e.preventDefault();
    begin = $('#begin').val();
    finish = $('#finish').val();
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
    })

    swal.fire({
        title: 'Enviar una Notificacion',
        text:'Whatsapp: 910583486',
        showCancelButton: true,
        confirmButtonText: '<i class="zmdi zmdi-run"></i> Si, Enviar!',
        cancelButtonText: '<i class="zmdi zmdi-close-circle"></i> No, Enviar!',
        confirmButtonColor: '#03A9F4',
        cancelButtonColor: '#F44336',
        reverseButtons: true
    }).then((result) => {
        
        if (result.value) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "list_ajax_sensory_report_whatsapp",
                method: 'POST',
                data: {
                    'begin': begin,
                    'finish': finish,
                },
                success: function(data) {
                    console.log(data);
                    if (data.errors) {
                        console.log(data.errors)
                    } else if (data.code == 500) {
                        Swal.fire({
                            type: 'error',
                            title: 'Oops...',
                            text: data.message
                        });
                    } else {
                        Swal.fire({
                            type: 'success',
                            title: 'Exito',
                            text: data.message,
                            timer: 2000
                        });
                    }
                },
                error: function(data) {
                    Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Algo ha salido mal'
                    });
                }
            }); //FIN DE AJAX 
        } else {
            //Vacio
        }
    });
});