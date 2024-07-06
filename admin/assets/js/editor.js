ClassicEditor
    .create(document.querySelector('#editor'), {
        toolbar: {
            items: [
                'heading',
                '|',
                'bold',
                'italic',
                'link',
                '|',
                'bulletedList',
                'numberedList',
                '|',
                'insertTable', // Include the table button here
                '|',
                'undo',
                'redo'
            ]
        },
        language: 'en',
        licenseKey: '',
        image: {
            toolbar: []
        }
    })
    .catch(error => {
        console.error(error);
    });
