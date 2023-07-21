function list_ajax_user() {
    $.ajax({
        url: "{{ route('list-ajax-user') }}",
        method: "GET",
        dataType: "json",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data) {
            if (data.code == 500) {
                Swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: data.message
                });
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
                    show = '<a href="{{ url('/show-user') }}/' + data.data[i].id +
                        '" class="btn btn-success"><i class="fas fa-eye"></i></a>'
                    edit = ''
                    if ({{ Auth::check() }} == true && '{{ Auth::user()->status }}' ==
                        'administrator') {
                        edit = ' <a href="{{ url('/edit-user') }}/' + data.data[i].id +
                            '" class="btn btn-warning"><i class="fas fa-edit"></i></a>'
                        delet = ' <a onclick="delete_record(' + data.data[i].id +
                            ')" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>'
                    } else {
                        delet = ''
                    }
                    
                    table.row.add([
                        numero,
                        data.data[i].name,
                        data.data[i].email,
                        data.data[i].phone,
                        data.data[i].status,
                        show + edit + delet
                    ]);
                });
                table.draw();
            }
        },
        error: function(data) {
            Swal.fire({
                type: 'error',
                title: 'Oops...',
                text: 'Algo ha salido mal'
            });
        }
    });
}

function delete_record(id) {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
    })

    swal.fire({
        title: 'Mensaje del sistema',
        text: "¿Quieres eliminar este registro?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: '<i class="zmdi zmdi-run"></i> Si, Eliminar!',
        cancelButtonText: '<i class="zmdi zmdi-close-circle"></i> No, Eliminar!',
        confirmButtonColor: '#03A9F4',
        cancelButtonColor: '#F44336',
        reverseButtons: true
    }).then((result) => {

        if (result.value) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('destroy-user') }}",
                method: 'POST',
                data: {
                    id: id
                },
                success: function(data) {
                    if (data.errors) {
                        message_error(data.errors)
                    } else if (data.code == 500) {
                        console.log(data.message);
                    } else {
                        console.log(data.message);
                        list_ajax_user();
                    }
                },
                error: function(data) {
                    console.log('Algo ha salido mal');
                }
            }); //FIN DE AJAX 
        } else {
            //Vacio
        }
    });
}

$(function () {
    list_ajax_user();
});