import * as User from './user.js'

$(document).on('click', '.user', function(e) {
    var status = 1;
    if($(this).data('status') == 1 ){
        status = 2;
    }

    Swal.fire({
        title: 'ยืนยัน!',
        text: `ต้องการทำรายการ หรือไม่`,
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'ตกลง',
        cancelButtonText: 'ยกเลิก',
        closeOnConfirm: false,
        closeOnCancel: false
        }).then((result) => {
        if (result.value) {
            User.updateVerifyExpert($(this).data('id'),status).then(data => {
                Swal.fire({
                    title: 'สำเร็จ...',
                    text: 'แก้ไขรายการสำเร็จ!',
                }).then((result) => {
                    window.location.reload();
                });
            })
            .catch(error => {})
        }
    });
});