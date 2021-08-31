function confirmation(e) {
    e.preventDefault();
    var urlToRedirect = e.currentTarget.getAttribute('href');
    Swal.fire({
            title: 'คำเตือน!',
            text: `ต้องการลบรายการหรือไม่ `,
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

function cancelproject(e) {
    e.preventDefault();
    var urlToRedirect = e.currentTarget.getAttribute('href');
    Swal.fire({
            title: 'คำเตือน!',
            text: `ต้องการยกเลิกโครงการหรือไม่ `,
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'ยืนยัน',
            cancelButtonText: 'ยกเลิก',
            closeOnConfirm: false,
            closeOnCancel: false
        }).then((result) => {
        if (result.value) {
            window.location.href = urlToRedirect;
        }
    });
}

function confirmsubmit(e,data) {
    e.preventDefault();
    var frm = e.target.form;
    Swal.fire({
            title: 'บันทึกรายการ',
            text: `ต้องการบันทึก ${data} หรือไม่ `,
            type: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'ตกลง',
            cancelButtonText: 'ยกเลิก',
            closeOnConfirm: false,
            closeOnCancel: false
        }).then((result) => {
        if (result.value) {
            frm.submit();
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

function maxRepeating(str)
{
   var _str = str.replace(/\s/g, "");
    let len = _str.length;
    let count = 0;

    let res = _str[0];
    for (let i=0; i<len; i++)
    {
        let cur_count = 1;
        for (let j=i+1; j<len; j++)
        {
            if (_str[i] != _str[j])
                break;
            cur_count++;
        }

        // Update result if required
        if (cur_count > count)
        {
            count = cur_count;
            res = _str[i];
        }
    }
    return count;
}