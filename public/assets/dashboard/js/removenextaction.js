
    $(".linknextaction").on('click', function() {
        console.log($(this).data('id'));
        deleteAlertQ($(this).data('id')).then(data => {

        }).catch(error => {})

    });

    $(".dmyformat").on('change', function() {
       var str = $(this).val();
       var lastSlash = str.lastIndexOf("/");
       var year = str.substring(lastSlash+1);
       if(year.length != 4){
        Swal.fire({
            title: 'ผิดพลาด',
            text: 'รูปแบบวันที่ไม่ถูกต้อง!',
            });
            $(this).val('');
       }else{
           if(parseInt(year) < 2400 || parseInt(year) > 3000){
            Swal.fire({
                title: 'ผิดพลาด',
                text: 'กรุณากรอกปี พ.ศ. ระหว่าง 2400 - 3000',
                });
                $(this).val('');
           }
       }
    });

    

    function deleteAlertQ(id) {
        return new Promise((resolve, reject) => {
            $.ajax({
                url: `${route.url}/api/alert/deletealertq`,
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