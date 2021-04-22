
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
                 <td> 
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
                console.log(data);
                var html = ``;
                data.forEach(function (expertdoc,index) {
                    html += `<tr >                                        
                        <td> ${expertdoc.order} </td>                                            
                        <td> ${expertdoc.detail} </td> 
                        <td> 
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
console.log($('#currentid').val());
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
                 <td> 
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
                            <a href="${route.url}/${expertdoc.path}" class=" btn btn-sm bg-primary" target="_blank">ดาวน์โหลด</a>
                            <a type="button" data-id="${expertdoc.id}" data-name="" class="btn btn-sm bg-danger deleteexpertdoc">ลบ</a>                                       
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
                        <td> 
                            <a href="${route.url}/${expertdoc.path}" class=" btn btn-sm bg-primary" data-toggle="modal" target="_blank">ดาวน์โหลด</a>
                            <a type="button" data-id="${expertdoc.id}" data-name="" class="btn btn-sm bg-danger deleteexpertdoc" data-toggle="modal">ลบ</a>                                       
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

$("#sameaddress").on('change', function() {
    if(this.checked) {
        $("#address1").val($('#address').val());
        $("#postalcode1").val($('#postalcode').val());
        
        Geo.province().then(data => {
            let  html = "";
            data.forEach((amphur,index) => 
                html += `<option value='${amphur.id}'>${amphur.name}</option>`
            )           
            $("#province1").html(html);
            $("#province1 option:contains("+$('#province').find("option:selected").text()+")").attr('selected', true).trigger('change');
        })
        .catch(error => {
            console.log(error)
        })
    }else{
       
    }
});

$(document).on('change', '#province1', function(e) {
    Geo.amphur($('#province').val()).then(data => {
        let  html = "";
        data.forEach((amphur,index) => 
            html += `<option value='${amphur.id}'>${amphur.name}</option>`
        )
        $("#amphur1").html(html);
        $("#amphur1 option:contains("+$('#amphur').find("option:selected").text()+")").attr('selected', true).trigger('change');
    })
    .catch(error => {
        console.log(error)
    })
});

$(document).on('change', '#amphur1', function(e) {
    Geo.tambol($('#amphur').val()).then(data => {
        let  html = "";
        data.forEach((tambol,index) => 
            html += `<option value='${tambol.id}'>${tambol.name}</option>`
        )
        $("#tambol1").html(html);
        $("#tambol1 option:contains("+$('#tambol').find("option:selected").text()+")").attr('selected', true).trigger('change');
    })
    .catch(error => {
        console.log(error)
    })
});