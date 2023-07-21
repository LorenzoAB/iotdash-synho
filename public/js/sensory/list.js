function list_ajax_sensory() {
    $.ajax({
        url: 'sensory/list_ajax_sensory',
        method: 'GET',
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            if (data.code == 500) {
                console.log(data.message);
            } else {
                $('#lista').dataTable({
                    "bDestroy": true
                }).fnDestroy();

                table = $('#lista').DataTable({
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                    },
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
            console.log('Algo ha salido mal');
        }
    });
}

$(function () {
    list_ajax_sensory();
});