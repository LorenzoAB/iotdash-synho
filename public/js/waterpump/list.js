function list_ajax_waterpump() {
    $.ajax({
        url: "waterpump/list_ajax_waterpump",
        method: "GET",
        dataType: "json",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data) {
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

                $.each(data.data, function(i, item) {
                    numero = numero + 1
                   
                    table.row.add([
                        numero,
                        data.data[i].created_at,
                        data.data[i].input,
                        data.data[i].output,
                        data.data[i].constant,
                        data.data[i].level,
                        data.data[i].value,
                    ]);
                });
                table.draw();
            }
        },
        error: function(data) {
            console.log('Algo ha salido mal');
        }
    });
}

$(function () {
    list_ajax_waterpump();
});