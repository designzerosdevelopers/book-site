function initializeTinyMCE(selector, fileUploadEndpoint) {
    tinymce.init({
        selector: selector,
        width: '100%', // Use percentage for responsiveness
        height: 400, // Adjust height as needed
        plugins: [
            'advlist', 'autolink', 'link', 'image', 'lists', 'charmap', 'preview', 'anchor',
            'pagebreak',
            'searchreplace', 'wordcount', 'visualblocks', 'code', 'fullscreen', 'insertdatetime',
            'media',
            'table', 'emoticons', 'template', 'codesample'
        ],
        toolbar: 'undo redo | styleselect | bold italic underline | alignleft aligncenter alignright alignjustify |' +
            'bullist numlist outdent indent | link image | print preview media fullscreen | ' +
            'forecolor backcolor emoticons',
        // enable title field in the Image dialog
        image_title: true,
        branding: false,
        // enable automatic uploads of images represented by blob or data URIs
        automatic_uploads: true,
        // add custom filepicker only to Image dialog
        file_picker_types: 'image',
        menu: {
            favs: {
                title: 'Menu',
                items: 'code visualaid | searchreplace | emoticons'
            }
        },
        menubar: 'favs file edit view insert format tools table',
        content_css: [
            'clientside/js-css-other/style.css',
            "https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css"
        ],
        file_picker_callback: function(cb, value, meta) {
            var input = document.createElement('input');
            input.setAttribute('type', 'file');
            input.setAttribute('accept', 'image/*');

            input.onchange = function() {
                var file = this.files[0];

                var formData = new FormData();
                formData.append('image', file);


                $.ajax({
                    url: fileUploadEndpoint,
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        var imageUrl = response.url;
                        cb(imageUrl, {
                            src: imageUrl,
                            title: file.name
                        });
                    },
                    error: function(xhr, status, error) {
                        console.log('image could not be uploaded.')
                    }
                });

            };

            input.click();
        }
    });
}

initializeTinyMCE('#editor1', '/updatepage');
initializeTinyMCE('#editor2', '/updatepage');




