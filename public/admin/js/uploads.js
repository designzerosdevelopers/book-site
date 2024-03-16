// uploads.js

$(document).ready(function() {
    // Add click event handler to all image thumbnails
    $('.file-thumbnail').click(function() {
        const pdfUrl = $(this).data('pdf');
        const pdfName = $(this).data('name');
        const deleteId = $(this).data('id');

        if (pdfUrl && pdfName && deleteId) {
            displayPdf(pdfUrl, pdfName);
        }
    });

    // Function to display PDF details
    function displayPdf(pdfUrl, pdfName) {
        $('#upload-viewer').html(`
            <embed src="${pdfUrl}" height="150px" />
            <p>Name: ${pdfName}</p>
            <div class="input-group my-3">
                <input type="text" class="form-control" value="${pdfUrl}" readonly>
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary btn-copy" type="button">Copy</button>
                </div>
            </div>
            <span class="copy-success" style="display: none;">URL Copied!</span>`
        );

        // Add click event handler to the copy button
        $('.btn-copy').click(function() {
            const urlText = $(this).closest('.input-group').find('input').val();
            copyToClipboard(urlText);
        });
    }

    // Function to copy URL to clipboard
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(function() {
            $('.copy-success').fadeIn().delay(1500).fadeOut();
        }).catch(function(err) {
            console.error('Could not copy text: ', err);
            // Provide a user-friendly error message
            alert('Failed to copy URL. Please try again.');
        });
    }
});





