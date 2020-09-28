function confirmation(e) {
    e.preventDefault();
    var urlToRedirect = e.currentTarget.getAttribute('href');
    Swal.fire({
            title: 'คำเตือน!',
            text: `ต้องการลบรายการหรือไม่? `,
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'ยืนยันลบ',
            cancelButtonText: 'ยกเลิก',
            closeOnConfirm: false,
            closeOnCancel: false
        }).then((result) => {
        if (result.value) {
            window.location.href = urlToRedirect;
        }
    });
}

$(document).on('click', '.alertmessage', function(e) {
    deleteAlert($(this).data('id')).then(data => {
        data.forEach(function (alert,index) {
            html += `<div class="alert alert-info alert-styled-left alert-dismissible">
                        <button type="button" data-id ="${alert.id}" class="close alertmessage" data-dismiss="alert"><span>&times;</span></button>${alert.detail}
                    </div>`
        });
        $("#alertmessage_wrapper").html(html);
    }).catch(error => {})
});

function deleteAlert(id) {
    return new Promise((resolve, reject) => {
        $.ajax({
            url: `${route.url}/api/alert/delete`,
            type: 'POST',
            headers: {"X-CSRF-TOKEN":route.token},
            data: {
                id : id,
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