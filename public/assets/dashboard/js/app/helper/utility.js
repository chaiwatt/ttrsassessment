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