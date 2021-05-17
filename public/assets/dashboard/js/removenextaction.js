
    $(".linknextaction").on('click', function() {
        deleteAlert($(this).data('id')).then(data => {

        }).catch(error => {})

    });

    $(".dmyformat").on('change', function() {
       var str = $(this).val();
       var lastSlash = str.lastIndexOf("/");
       if(str.substring(lastSlash+1).length != 4){
        Swal.fire({
            title: 'ผิดพลาด',
            text: 'รูปแบบวันที่ไม่ถูกต้อง!',
            });
            $(this).val('');
       }
    });

    

    function deleteAlert(id) {
        return new Promise((resolve, reject) => {
            $.ajax({
                url: `${route.url}/api/alert/deletealert`,
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