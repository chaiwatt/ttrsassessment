import * as ThaiWord from './thaiword.js';
import * as CompanyProfile from './companyprofile.js';

$(document).on('keyup', '#companyprofile_input', function(e) {
    if (e.keyCode === 13) {
        console.log(ThaiWord.countCharTh('สวัสดี จ๊ะ'));

        var html = `<input type="text" name ="companyprofile[]" value="${$(this).val()}" class="form-control companyprofileclass" style="border: 0" >`;
        $(this).val('');
        $('#fulltbp_companyprofile_wrapper').append(html);
    }
});

$(document).on('keyup', '.companyprofileclass', function(e) {
    // console.log(ThaiWord.countCharTh($(this).val()));
    $('#companyprofiletextlength').html((90-ThaiWord.countCharTh($(this).val())));
});

$(document).on('click', '#btnaddcompanyprofile', function(e) {
    var lines = $('input[name="companyprofile[]"]').map(function(){ 
        return this.value; 
    }).get();
    // console.log(lines);
    CompanyProfile.addCompanyProfile(lines,$(this).data('id')).then(data => {
        console.log(data);
        Swal.fire({
            title: 'สำเร็จ...',
            text: 'เพิ่มประวัติบริษัทสำเร็จ!',
            });
    })
    .catch(error => {
        //console.log(error)
    })
});

$("#attachment").on('change', function() {
    console.log($(this).data('id'));

    var file = this.files[0];

    if (this.files[0].size/1024/1024*1000 > 1000 ){
        alert('ไฟล์ขนาดมากกว่า 1 MB');
        return ;
    }
    
    // var inpattachments = $('.input_attachment').map(function() {
    //     return $(this).val();
    // }).toArray();

    var formData = new FormData();
    formData.append('file',file);
    formData.append('id',$(this).data('id'));

        $.ajax({
            url: `${route.url}/api/fulltbp/companyprofile/attachement/add`,  //Server script to process data
            type: 'POST',
            headers: {"X-CSRF-TOKEN":route.token},
            data: formData,
            contentType: false,
            processData: false,
            success: function(data){
                console.log(data)
                var html = ``;
                data.forEach(function (attachment,index) {
                    html += `<tr >                                        
                        <td> ${attachment.name} </td>                                            
                        <td> 
                            <a href="${route.url}/${attachment.path}" class=" badge bg-primary">แก้ไข</a>
                            <a data-id="${attachment.id}" data-name="" onclick="confirmation(event)" class=" badge bg-danger">ลบ</a>                                       
                        </td>
                    </tr>`
                    });
                 $("#fulltbp_companyprofile_attachment_wrapper_tr").html(html);
        }
    });

});
