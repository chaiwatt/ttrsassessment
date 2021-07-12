
import * as Expert from './expert.js'
import * as Geo from './location.js'
var globaldata = [];
$("#btn_modal_add_expertfield").on('click', function() {
    if($('#expertfieldnum').val() == '' || $('#expertfielddetail').val() == ''){
        Swal.fire({
            title: 'ผิดพลาด...',
            text: 'กรุณากรอกข้อมูลให้ครบ!',
        });
        return;
    }
    var cellIndexMapping = { 0: true };
    var data = [];
    
    $("#expertfield_wrapper tr").each(function(rowIndex) {
        $(this).find("td").each(function(cellIndex) {
            if (cellIndexMapping[cellIndex])
                data.push(parseInt($(this).text()));
        });
    });

    if(data.indexOf(parseInt($('#expertfieldnum').val())) != -1){
        Swal.fire({
            title: 'ผิดพลาด...',
            text: 'ไม่สามารถใช้ลำดับซ้ำได้!',
        });
        return;
    }else{
        Expert.addExpertfield($('#expertfieldnum').val(),$('#expertfielddetail').val()).then(data => {
            if($('#expertfieldnum').val() == '' || $('#expertfielddetail').val() == '')return;
            var html ='';
            data.forEach(function (expertdoc,index) {
             html += `<tr >                                        
                 <td> ${expertdoc.order} </td>                                            
                 <td> ${expertdoc.detail} </td> 
                 <td style="width:1%;white-space: nowrap"> 
                 <a href="#" data-id="${expertdoc.id}" data-name="" class="btn btn-sm bg-danger deleteexpertfield" data-toggle="modal">ลบ</a>
                 <a href="#" data-id="${expertdoc.id}" class="btn btn-sm bg-info editexpertfield" data-toggle="modal" >แก้ไข</a>                                        
                 </td>
             </tr>`
             });
          $("#expertfield_wrapper_tr").html(html);
          if(data.length > 0){
             $("#inpexpertfield").val(data.length);
          }else{
             $("#inpexpertfield").val('');
          }
          $("#expertfieldnum").val("");
          $("#expertfielddetail").val("");
          $('#modal_add_expertfield').modal('hide');
         }).catch(error => {})
    }

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
                var html = ``;
                data.forEach(function (expertdoc,index) {
                    html += `<tr >                                        
                        <td> ${expertdoc.order} </td>                                            
                        <td> ${expertdoc.detail} </td> 
                        <td style="width:1%;white-space: nowrap"> 
                        <a href="#" data-id="${expertdoc.id}" data-name="" class="btn btn-sm bg-danger deleteexpertfield" data-toggle="modal">ลบ</a>
                        <a href="#" data-id="${expertdoc.id}" class="btn btn-sm bg-info editexpertfield" data-toggle="modal" >แก้ไข</a>                                       
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

$(document).on("click",".editexpertfield",function(e){
    var cellIndexMapping = { 0: true };
    
    globaldata = [];
    $("#expertfield_wrapper tr").each(function(rowIndex) {
        $(this).find("td").each(function(cellIndex) {
            if (cellIndexMapping[cellIndex])
                globaldata.push(parseInt($(this).text()));
        });
    });
    $("#expertfieldid").val($(this).data('id')); 
        Expert.getExpertfield($(this).data('id')).then(data => {
            $("#expertfieldnum_edit").val(data.order);     
            $("#expertfielddetail_edit").val(data.detail); 
            $("#currentid").val(data.order); 
            
            $('#modal_edit_expertfield').modal('show');
        })
    .catch(error => {})

}); 
$("#btn_modal_edit_expertfield").on('click', function() {
    if($('#expertfieldnum_edit').val() == '' || $('#expertfielddetail_edit').val() == ''){
        Swal.fire({
            title: 'ผิดพลาด...',
            text: 'กรุณากรอกข้อมูลให้ครบ!',
        });
        return;
    }
    if(globaldata.indexOf(parseInt($('#expertfieldnum_edit').val())) != -1 && (parseInt($('#expertfieldnum_edit').val()) != parseInt($('#currentid').val()))){
        Swal.fire({
            title: 'ผิดพลาด...',
            text: 'ไม่สามารถใช้ลำดับซ้ำได้!',
        });
        return;
    }else{
        Expert.editExpertfield( $("#expertfieldid").val(),$('#expertfieldnum_edit').val(),$('#expertfielddetail_edit').val()).then(data => {
           
            var html ='';
            data.forEach(function (expertdoc,index) {
             html += `<tr >                                        
                 <td> ${expertdoc.order} </td>                                            
                 <td> ${expertdoc.detail} </td> 
                 <td style="width:1%;white-space: nowrap"> 
                     <a href="#" data-id="${expertdoc.id}" data-name="" class="btn btn-sm bg-danger deleteexpertfield" data-toggle="modal">ลบ</a>
                     <a href="#" data-id="${expertdoc.id}" class="btn btn-sm bg-info editexpertfield" data-toggle="modal" >แก้ไข</a>                                                                              
                 </td>
             </tr>`
             });
          $("#expertfield_wrapper_tr").html(html);
          if(data.length > 0){
             $("#inpexpertfield").val(data.length);
          }else{
             $("#inpexpertfield").val('');
          }
          $('#modal_edit_expertfield').modal('hide');
         }).catch(error => {})
    }

});
$("#expertdoc").on('change', function() {
    // if($('#expertdocname').val() == '')return ;
    var file = this.files[0];

    var fextension = file.name.substring(file.name.lastIndexOf('.')+1);
    var validExtensions = ["jpg","pdf","jpeg","gif","png","bmp"];
    if(!validExtensions.includes(fextension)){
        Swal.fire({
            title: 'ผิดพลาด...',
            text: 'รูปแบบไฟล์ไม่ถูกต้อง!',
            });
        this.value = "";
        return false;
    }

    if (this.files[0].size/1024/1024*1000 > 2000 ){
        Swal.fire({
            title: 'ผิดพลาด...',
            text: 'ไฟล์ขนาดมากกว่า 2 MB!',
            });
        return ;
    }
    var formData = new FormData();
    formData.append('file',file);
    formData.append('id',$(this).data('id'));
    // formData.append('expertdocname',$('#expertdocname').val());
        $.ajax({
            url: `${route.url}/api/expert/addexpertdoc`,  //Server script to process data
            type: 'POST',
            headers: {"X-CSRF-TOKEN":route.token},
            data: formData,
            contentType: false,
            processData: false,
            success: function(data){
                var html = ``;
                data.forEach(function (expertdoc,index) {
                    html += `<tr >                                        
                        <td> ${expertdoc.name} </td>                                            
                        <td style="width:1%;white-space: nowrap"> 
                            <a href="${route.url}/${expertdoc.path}" class=" btn btn-sm bg-primary" target="_blank">ดูเอกสาร</a>
                            <a data-id="${expertdoc.id}" data-name="" class="btn btn-sm bg-danger deleteexpertdoc">ลบ</a>                                       
                        </td>
                    </tr>`
                    });
                 $("#fulltbp_expertdoc_wrapper_tr").html(html);
                 $('#modal_add_expertdoc').modal('hide');
                 $('#expertdocname').val('');
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
                        <td style="width:1%;white-space: nowrap"> 
                            <a href="${route.url}/${expertdoc.path}" class=" btn btn-sm bg-primary" data-toggle="modal" target="_blank">ดูเอกสาร</a>
                            <a data-id="${expertdoc.id}" data-name="" class="btn btn-sm bg-danger deleteexpertdoc" data-toggle="modal">ลบ</a>                                       
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
    var fextension = file.name.substring(file.name.lastIndexOf('.')+1);
    var validExtensions = ["jpg","pdf","jpeg","gif","png","bmp"];
    if(!validExtensions.includes(fextension)){
        Swal.fire({
            title: 'ผิดพลาด...',
            text: 'รูปแบบไฟล์ไม่ถูกต้อง!',
            });
        this.value = "";
        return false;
    }
    if (this.files[0].size/1024/1024*1000 > 1000 ){
        Swal.fire({
            title: 'ผิดพลาด...',
            text: 'ไฟล์ขนาดมากกว่า 1 MB!',
            });
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
    var fextension = file.name.substring(file.name.lastIndexOf('.')+1);
    var validExtensions = ["jpg","pdf","jpeg","gif","png","bmp"];
    if(!validExtensions.includes(fextension)){
        Swal.fire({
            title: 'ผิดพลาด...',
            text: 'รูปแบบไฟล์ไม่ถูกต้อง!',
            });
        this.value = "";
        return false;
    }
    if (this.files[0].size/1024/1024*1000 > 1000 ){
        Swal.fire({
            title: 'ผิดพลาด...',
            text: 'ไฟล์ขนาดมากกว่า 1 MB!',
            });
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

$("#sameaddress").on('change', function() {
    if($("#province").val() == ''){
        Swal.fire({
            title: 'ผิดพลาด...',
            text: 'ยังไม่ได้เพิ่มที่อยู่ตามบัตรประจำตัวประชาชน',
            });
        return ;
    }
    if(this.checked) {
        $("#contact_address_wrapper").attr("hidden",true);
        $("#address1").val($('#address').val());
        $("#postalcode1").val($('#postalcode').val());
        
        // Geo.province().then(data => {
        //     let  html = "<option value='0'>===เลือกจังหวัด===</option>";
        //     data.forEach((amphur,index) => 
        //         html += `<option value='${amphur.id}'>${amphur.name}</option>`
        //     )           
        //     $("#province1").html(html);
        //     if(($("#province1").val() !== '' || $("#province1").val() !== 0)  &&  $('#sameaddress').is(":checked") == true){
        //         $("#province1 option:contains("+$('#province').find("option:selected").text()+")").attr('selected', true).trigger('change');
        //     }
        // })
        // .catch(error => {

        // })
    }else{
        $("#contact_address_wrapper").attr("hidden",false);
    }
});

$(document).on('change', '#province1', function(e) {
    if($('#sameaddress').is(":checked") == false){
        $('#postalcode1').val('');
        $("#tambol1").html('');
    }
    Geo.amphur($('#province1').val()).then(data => {
        let  html = "<option value='0'>===เลือกอำเภอ===</option>";
        // data.forEach((amphur,index) => 
        //     html += `<option value='${amphur.id}'>${amphur.name}</option>`
        // )

        var i;
        for (i = 0; i < data.length; i++) {
            var str = data[i]['name'];
            var n = str.indexOf("*");
            if(n == -1){
                html += `<option value='${data[i]['id']}'>${data[i]['name']}</option>`
            }
        }

        $("#amphur1").html(html);
        // if(($("#amphur").val() !== '' || $("#amphur").val() !== 0) &&  $('#sameaddress').is(":checked") == true){
        //     console.log('ww');
        //     $("#amphur1 option[value="+$("#amphur").val()+"]").attr('selected', true).trigger('change');
        // }   
    })
    .catch(error => {

    })
});

$(document).on('change', '#amphur1', function(e) {
    Geo.tambol($('#amphur1').val()).then(data => {
        let  html = "<option value='0'>===เลือกตำบล===</option>";
        var i;
        for (i = 0; i < data.length; i++) {
            var n = data[i]['name'].includes("*");
            if(n == false){
                html += `<option data-id='${data[i]['postal']}' value='${data[i]['id']}'>${data[i]['name']}</option>`
            }
        }

        $("#tambol1").html(html);
        // if(($("#tambol").val() !== '' || $("#tambol").val() !== 0) &&  $('#sameaddress').is(":checked") == true){
        //     // $("#tambol1 option[value="+$("#tambol").val()+"]").attr('selected', true).trigger('change');
        //     $("#tambol1 option:contains("+$('#tambol').find("option:selected").text()+")").attr('selected', true).trigger('change');
        // }
        // else{
        //     console.log('d');
        //     $("#tambol1 option:contains("+$('#tambol1').find("option:selected").text()+")").attr('selected', true).trigger('change');
        // }    

    })
    .catch(error => {
        
    })
});