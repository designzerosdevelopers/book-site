ClassicEditor
    .create(document.querySelector('#editor11'), {
        allowedContent: [
            {
                name: 'element',
                attributes: ['class', 'style', 'href', 'target'], // Allow class, style, href (for links), and target (for links)
                styles: ['color', 'font-size', 'background-color', 'text-decoration'] // Allow specific CSS properties
            }
        ]
    })
    .then(editor => {
        console.log(editor);
    })
    .catch(error => {
        console.error(error);
    });





//cart count update


