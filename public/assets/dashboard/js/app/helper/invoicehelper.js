$(document).on("click","#notifyuser",function(e){
    Swal.fire({
        title: 'โปรดยืนยัน',
        text: `ต้องการแจ้งใบแจ้งหนี้ `,
        // type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'ตกลง',
        cancelButtonText: 'ยกเลิก',
        closeOnConfirm: false,
        closeOnCancel: false
        }).then((result) => {
        if (result.value) {
            $("#spinicon").attr("hidden",false);
            updateInvoiceStatus($(this).data('id'),1).then(data => {
                window.location.reload();
           })
           .catch(error => {})
        }
    });
});

function updateInvoiceStatus(id,status){
    return new Promise((resolve, reject) => {
        $.ajax({
            url: `${route.url}/dashboard/admin/project/invoice/updatestatus`,
            type: 'POST',
            headers: {"X-CSRF-TOKEN":route.token},
            data: {
            id : id,
            status : status
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