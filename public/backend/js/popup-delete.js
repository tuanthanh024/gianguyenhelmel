$('button.delete').on('click', function () {
    var btn = $(this)
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#26c6da',
        cancelButtonColor: '#fc4b6c',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: btn.data('url'),
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    id: btn.data('id')
                },
                method: 'POST',
                dataType: 'json',
                success: function (response) {
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    ).then(() => {
                        btn.closest('tr').fadeOut(500, function () {
                            $(this).slideUp(1000);
                        });
                        if (response.empty == true) {
                            var tdCount = $('#data-table tr:first th').length;
                            $('#data-table').append(
                                '<tr><td colspan="' + tdCount + '">' + response.message + '</td></tr>'
                            )
                        }
                    })
                },
                error: function (xhr) {
                    Swal.fire(
                        'Error!',
                        'Your file could not be deleted.',
                        'error'
                    )
                }
            });
        }
    })
});