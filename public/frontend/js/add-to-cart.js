$(document).ready(function () {
    $(document).on('click', '.add-to-cart', function (e) {
        e.preventDefault();
        var _this = $(this)
        var quantity = $('input[name="product-quatity"]').val() ? $('input[name="product-quatity"]').val() : 1;
        $.ajax({
            url: _this.data('url'),
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                id: _this.data('id'),
                price: _this.data('price'),
                quantity: quantity,
            },
            method: 'POST',
            dataType: 'json',
            success: function (response) {
                if (response.status == true) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Hoàn tất!',
                        text: 'Thêm sản phẩm thành công',
                        confirmButtonText: 'Đóng',
                    });

                    var currentCount = parseInt($('.left-info .product-quantity').text());

                    var newCount = currentCount + parseInt(quantity);

                    $('.left-info .product-quantity').text(newCount);

                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Lỗi!',
                        text: 'Sản phẩm đã đạt số lượng tối đa!',
                        confirmButtonText: 'Đóng',
                    });
                }

            },
            error: function (xhr, status, error) {
                if (xhr.status == 401) {
                    window.location.href = "/login";
                }
            }
        });
    })
});