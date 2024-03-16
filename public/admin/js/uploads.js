$(document).ready(function() {
    // Add click event handler to all image thumbnails
    $('.file-thumbnail').click(function() {

        const pdfUrl = $(this).data('pdf');
        const pdfName = $(this).data('name');
        var deleteid = $(this).data('id');

        

        if (pdfUrl && pdfName && deleteid) {
            // Load PDF into the col-4 section
            $('#upload-viewer').html(`
                <embed src="${pdfUrl}" width="250px" id="singleimg"/>
                <p>Name: ${pdfName}</p>
                <a style="text-decoration: none;" href="/deleteuploads?deleteid=${deleteid}" id="delete-pdf">Delete Permanently</a>
                <div class="input-group my-3">
                    <input type="text" class="form-control" value="${pdfUrl}" readonly>
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary btn-copy" type="button">Copy</button>
                    </div>
                </div>
                <span class="copy-success" style="display: none;">URL Copied!</span>`
            );
        }
        


        // Add click event handler to the copy button
        $('.btn-copy').click(function() {
            const urlText = $(this).closest('.input-group').find('input').val(); // Get the URL text from input field
            navigator.clipboard.writeText(urlText).then(function() {
                // Show copying success message
                $('.copy-success').fadeIn().delay(1500).fadeOut();
            }).catch(function(err) {
                console.error('Could not copy text: ', err);
            });
        });
    });
});
function copyImageUrl(url, iconElement) {
    var tempInput = document.createElement('input');
    tempInput.style = "position: absolute; left: -1000px; top: -1000px";
    tempInput.value = url;
    document.body.appendChild(tempInput);
    tempInput.select();
    document.execCommand('copy');
    document.body.removeChild(tempInput);

    var messageContainer = document.createElement('div');
    messageContainer.style = "position: absolute; top: 80%; left: 38%; transform: translate(-45%, -50%); background-color: rgba(0, 0, 0, 0.8); color: #fff; padding: 2px; border-radius: 3px; z-index: 9999; font-size: 12px;"; // Adjust font-size as needed
    messageContainer.textContent = 'URL copied!';
    iconElement.parentNode.appendChild(messageContainer);

    setTimeout(function() {
        iconElement.parentNode.removeChild(messageContainer);
    }, 2000); // 2000 milliseconds = 2 seconds, adjust as needed
}




