$(document).on('click', '.downloadlink', function(e) {
    download($(this).data('docname')).then(data => {
        // console.log(data);
    })
    .catch(error => {})
});

function download(document){
    return new Promise((resolve, reject) => {
        $.ajax({
            url: `${route.url}/api/download/add`,
            type: 'POST',
            headers: {"X-CSRF-TOKEN":route.token},
            data: {
                document : document
            },
            success: function(data) {
            resolve(data)
            },
            error: function(error) {
            reject(error)
            },
        })
    })
}