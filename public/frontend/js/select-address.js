$(document).ready(function () {
    $('#province').on('change', function (e) {
        var provinceId = $(this).val()
        if (provinceId) {
            $.ajax({
                type: "GET",
                url: "/get-districts",
                data: {
                    provinceId: provinceId
                },
                dataType: "json",
                success: function (response) {
                    $('#district').html('<option selected="" disabled="" value="-1">--- Vui lòng chọn quận/huyện ---</option>')
                    $('#ward').html('<option selected="" disabled="" value="-1">--- Vui lòng chọn phường/xã ---</option>')
                    $.each(response, function (index, district) {
                        $('#district').append('<option value="' + district.id + '">' + district.name + '</option>')
                    });
                }
            });
        }
    })

    $('#district').on('change', function (e) {
        var districtId = $(this).val()
        if (districtId) {
            $.ajax({
                type: "GET",
                url: "/get-wards",
                data: {
                    districtId: districtId
                },
                dataType: "json",
                success: function (response) {
                    $('#ward').html('<option selected="" disabled="" value="-1">--- Vui lòng chọn phường/xã ---</option>')
                    $.each(response, function (index, ward) {
                        $('#ward').append('<option value="' + ward.id + '">' + ward.name + '</option>')
                    });
                }
            });
        }
    })
});