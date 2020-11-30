
import * as Expert from './expert.js'

$("#btn_modal_add_expertfield").on('click', function() {
   Expert.addExpertfield($('#expertfieldnum').val(),$('#expertfielddetail').val()).then(data => {
       if($('#expertfieldnum').val() =='' || $('#expertfielddetail').val() =='')return;
       var html ='';
       data.forEach(function (expertdoc,index) {
        html += `<tr >                                        
            <td> ${expertdoc.order} </td>                                            
            <td> ${expertdoc.detail} </td> 
            <td> 
                <a type="button" data-id="${expertdoc.id}" data-name="" class="btn btn-sm bg-danger deleteexpertfield">ลบ</a>                                       
            </td>
        </tr>`
        });
     $("#expertfield_wrapper_tr").html(html);
     if(data.length > 0){
        $("#inpexpertfield").val(data.length);
     }else{
        $("#inpexpertfield").val('');
     }
     
    }).catch(error => {})
});

$(document).on("click",".deleteexpertfield",function(e){
    Swal.fire({
        title: 'คำเตือน!',
        text: `ต้องการลบรายการ หรือไม่`,
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'ยืนยันลบ',
        cancelButtonText: 'ยกเลิก',
        closeOnConfirm: false,
        closeOnCancel: false
        }).then((result) => {
        if (result.value) {
            Expert.deleteExpertfield($(this).data('id')).then(data => {
                console.log(data);
                var html = ``;
                data.forEach(function (expertdoc,index) {
                    html += `<tr >                                        
                        <td> ${expertdoc.order} </td>                                            
                        <td> ${expertdoc.detail} </td> 
                        <td> 
                            <a type="button" data-id="${expertdoc.id}" data-name="" class="btn btn-sm bg-danger deleteexpertfield">ลบ</a>                                       
                        </td>
                    </tr>`
                    });
                 $("#expertfield_wrapper_tr").html(html);
                 if(data.length > 0){
                    $("#inpexpertfield").val(data.length);
                 }else{
                    $("#inpexpertfield").val('');
                 }
                 
           })
           .catch(error => {})
        }
    });
}); 


$("#expertdoc").on('change', function() {
    if($('#expertdocname').val() == '')return ;
    var file = this.files[0];
    console.log(file);
    if (this.files[0].size/1024/1024*1000 > 2000 ){
        alert('ไฟล์ขนาดมากกว่า 2 MB');
        return ;
    }
    var formData = new FormData();
    formData.append('file',file);
    formData.append('id',$(this).data('id'));
    formData.append('expertdocname',$('#expertdocname').val());
    console.log(formData);
        $.ajax({
            url: `${route.url}/api/expert/addexpertdoc`,  //Server script to process data
            type: 'POST',
            headers: {"X-CSRF-TOKEN":route.token},
            data: formData,
            contentType: false,
            processData: false,
            success: function(data){
                console.log(data)
                var html = ``;
                data.forEach(function (expertdoc,index) {
                    html += `<tr >                                        
                        <td> ${expertdoc.name} </td>                                            
                        <td> 
                            <a href="${route.url}/${expertdoc.path}" class=" btn btn-sm bg-primary">ดาวน์โหลด</a>
                            <a type="button" data-id="${expertdoc.id}" data-name="" class="btn btn-sm bg-danger deleteexpertdoc">ลบ</a>                                       
                        </td>
                    </tr>`
                    });
                 $("#fulltbp_expertdoc_wrapper_tr").html(html);
                 $('#modal_add_expertdoc').modal('hide');
        }
    });
});

$(document).on("click",".deleteexpertdoc",function(e){
    Swal.fire({
        title: 'คำเตือน!',
        text: `ต้องการลบรายการ หรือไม่`,
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'ยืนยันลบ',
        cancelButtonText: 'ยกเลิก',
        closeOnConfirm: false,
        closeOnCancel: false
        }).then((result) => {
        if (result.value) {
            Expert.deleteExpertDoc($(this).data('id')).then(data => {
                var html = ``;
                data.forEach(function (expertdoc,index) {
                    html += `<tr >                                        
                        <td> ${expertdoc.name} </td>                                            
                        <td> 
                            <a href="${route.url}/${expertdoc.path}" class=" btn btn-sm bg-primary">ดาวน์โหลด</a>
                            <a type="button" data-id="${expertdoc.id}" data-name="" class="btn btn-sm bg-danger deleteexpertdoc">ลบ</a>                                       
                        </td>
                    </tr>`
                    });
                 $("#fulltbp_expertdoc_wrapper_tr").html(html);
           })
           .catch(error => {})
        }
    });
}); 
$("#coverimg").on('change', function() {
    var file = this.files[0];

    if (this.files[0].size/1024/1024*1000 > 1000 ){
        alert('ไฟล์ขนาดมากกว่า 1 MB');
        return ;
    }
    var formData = new FormData();
    formData.append('file',file);

    $.ajax({
        url: `${route.url}/api/coverimage/add`,  //Server script to process data
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: formData,
        contentType: false,
        processData: false,
        success: function(data){
            var html = `<div class="profile-cover-img" style="background-image: url(${route.url}/${data.cover})"></div>`;
            $("#bgcover").html(html);
    }
});
});

$("#avatarimg").on('change', function() {
    var file = this.files[0];

    if (this.files[0].size/1024/1024*1000 > 1000 ){
        alert('ไฟล์ขนาดมากกว่า 1 MB');
        return ;
    }
    var formData = new FormData();
    formData.append('file',file);

    $.ajax({
        url: `${route.url}/api/coverimage/addavatar`,  //Server script to process data
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: formData,
        contentType: false,
        processData: false,
        success: function(data){
            var html = `<img src="${route.url}/${data.picture}" class="border-white rounded-circle" width="48" height="48" alt="">`;
            $("#avatar").html(html);
    }
 });
});