$(document).ready(function () {
    $(".select-tags").select2({
        tags: true,
        tokenSeparators: [',']
    })

    $('input[name="featured_image"]').change(function () {
        const file = this.files[0];
        const reader = new FileReader();
        const img = document.createElement('img');

        $(img).addClass('img-fluid img-thumbnail');

        const previewContainer = $('.featured-image-container').first();
        previewContainer.empty();
        previewContainer.append(img);

        reader.addEventListener('load', function () {
            img.setAttribute('src', reader.result);
        });

        reader.readAsDataURL(file);
    });

    $('input[name="product_images[]"]').change(function () {
        const files = this.files;
        const previewContainer = $('.product-image-container').first();
        previewContainer.empty();

        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            const reader = new FileReader();
            const div = document.createElement('div');
            div.setAttribute('class', 'col-sm-3 mb-3');

            const img = document.createElement('img');

            img.setAttribute('class', 'img-fluid img-thumbnail');

            reader.addEventListener('load', function () {
                img.setAttribute('src', reader.result);
            });

            reader.readAsDataURL(file);

            div.append(img);
            previewContainer.append(div);
        }
    });

    var options = {
        filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
        filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
        filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
        filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
    };
    CKEDITOR.replace('description', options);
});
