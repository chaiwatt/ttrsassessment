import * as Message from './message.js'
import * as Expert from './expert.js'
import * as Friend from './friend.js'
import * as SMS from './sms.js'
import * as Hid from './hid.js'
import * as Project from './project.js';
import * as Company from './company.js'

var a=0;
$(document).on("click","#btn_modal_expertexpience",function(e){
    if($("#expertexpienceposition").val() == '' || $("#expertexpiencecompany").val() == '' || $("#expertexpiencedetail").val() == '' || $("#fromyear").val() == '' || $("#toyear").val() == ''){
        return;
    }
    a++;
     var html = `
     <div class="row expertexpienceclass${a}" >							
        <div class="col-md-1">
            <div class="form-group">
                <input type="text" name="expertexpienceposition[${a}]" id="expertexpienceposition${a}" value="${$("#expertexpienceposition").val()}" class="form-control form-control-lg" hidden>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <input type="text" name="expertexpiencecompany[${a}]" id="expertexpiencecompany${a}" value="${$("#expertexpiencecompany").val()}" class="form-control form-control-lg" hidden>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <input type="text" name="expertexpiencedetail[${a}]" id="expertexpiencedetail${a}" value="${$("#expertexpiencedetail").val()}" class="form-control form-control-lg" hidden>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <input type="text" name="fromyear[${a}]" id="fromyear${a}" value="${$("#fromyear").val()}" class="form-control form-control-lg" hidden>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <input type="text" name="toyear[${a}]" id="toyear${a}" value="${$("#toyear").val()}" class="form-control form-control-lg" hidden>
            </div>
        </div>
    </div>`;
     $('#expertexpience_wrapper').append(html);
    var tr = `<tr class="expertexpienceclass${a}">	
    <td> ${$('#expertexpiencecompany').val()}</td>                                     
    <td> ${$('#expertexpienceposition').val()}</td>  
    <td> ${$('#fromyear').val()}</td>  
    <td> ${$('#toyear').val()}</td>    
    <td> <a type="button" data-id="expertexpienceclass${a}"  class="btn btn-danger-400 btn-sm deleteexpertexpienceclass" ><i class="icon-trash danger"></i></a></td>
    </tr>`;
    $('#expertexpience_wrapper_tr').append(tr);
});

$(document).on("click",".deleteexpertexpienceclass",function(e){
    $("."+$(this).data('id')).remove();
}); 

var b=0;
$(document).on("click","#btn_modal_experteducation",function(e){
    if($("#institute").val() == '' || $("#graduatedyear").val() == '' ){
        return;
    }
    b++;
     var html = `
     <div class="row experteducationclass${b}" >							
        <div class="col-md-1">
            <div class="form-group">
                <input type="text" name="educationlevel[${b}]" id="educationlevel${b}" value="${$("#educationlevel").val()}" class="form-control form-control-lg" hidden>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <input type="text" name="educationbranch[${b}]" id="educationbranch${b}" value="${$("#educationbranch").val()}" class="form-control form-control-lg" hidden>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <input type="text" name="institute[${b}]" id="institute${b}" value="${$("#institute").val()}" class="form-control form-control-lg" hidden>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <input type="text" name="country[${b}]" id="country${b}" value="${$("#country").val()}" class="form-control form-control-lg" hidden>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <input type="text" name="graduatedyear[${b}]" id="graduatedyear${b}" value="${$("#graduatedyear").val()}" class="form-control form-control-lg" hidden>
            </div>
        </div>
    </div>`;
     $('#experteducation_wrapper').append(html);
    var tr = `<tr class="experteducationclass${b}">	
    <td> ${$('#educationlevel').find(':selected').data('name')}</td>                                     
    <td> ${$('#educationbranch').find(':selected').data('name')}</td>  
    <td> ${$('#institute').val()}</td>  
    <td> <a type="button" data-id="experteducationclass${b}"  class="btn btn-danger-400 btn-sm deleteexperteducationclass" ><i class="icon-trash danger"></i></a></td>
    </tr>`;
    $('#experteducation_wrapper_tr').append(tr);
});

$(document).on("click",".deleteexperteducationclass",function(e){
    $("."+$(this).data('id')).remove();
}); 

$(document).on("click",".messagelink",function(e){
    // console.log('new year');
    $(this).removeClass("unread")
    Message.getMessage($(this).data('id')).then(data => {
        let html= '';
        let html2= '';
        if(data.attachment.length > 0){
            html=`<hr><div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ไฟล์</th>                                                                           
                        <th style="width:120px">ดาวน์โหลด</th>
                    </tr>
                </thead>
                <tbody id="expertexpience_wrapper_tr">` ;
                data.attachment.forEach((item,index) => 
                        html += `<tr><td>${item.name}</td><td><a href="${route.url}/${item.attachment}" class="btn btn-info btn-icon rounded-round"><i class="icon-download4"></i></a></td></tr>`
                    )
                    html +=`</tbody></table></div>`
        }

        if(data.unreadmessages.length >= 0){
            $("#_newmessagecount").html(data.unreadmessages.length);
            $("#newmessagecount1").html(data.unreadmessages.length);
            $("#newmessagecount2").html(data.unreadmessages.length + ' ข้อความใหม่');
        }

        data.unreadmessages.forEach((unreadmsg,index) => 
        html2 += `<li class="media">
                    <div class="mr-3 position-relative">
                        <span class="btn bg-pink-400 rounded-circle btn-icon btn-sm">
                            <span class="letter-icon">J</span>
                        </span>
                    </div>
                    <div class="media-body">
                        <div class="media-title">
                            <span class="font-weight-semibold">${unreadmsg.sender['name']}  ${(unreadmsg.sender['lastname'] == null) ? "" : unreadmsg.sender['lastname']} </span>
                            <span class="text-muted float-right font-size-sm">${unreadmsg.timeago}</span>
                        </div>

                        <span class="text-muted">${unreadmsg['title']}</span>
                    </div>
                </li>`
            )

        console.log(data.unreadmessages);
        
        $("#tablemessage").html(html);
        $("#unreadmessages").html(html2);
        // $("#messagetitle").html(data.message.title);
        $("#messagetitle").html("ข้อความ");
        $("#messagebody").html(data.message.body);
        $('#modal_message').modal('show');
    })
    .catch(error => {
        //console.log(error)
    })
    // 
});

$(document).on("click","#deleteexpertexpienceclass_editview",function(e){
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
            Expert.deleteExpereince($(this).data('id')).then(data => {
                var html='';
                console.log(data);
                data.forEach(function (expereince,index) {
                    html += `<tr>
                                <td>${expereince.company} </td>
                                <td>${expereince.position}</td>
                                <td>${expereince.fromyear}</td>                   
                                <td>${expereince.toyear}</td> 
                                <td>                                                                                                      
                                <a type="button" data-id="${expereince['id']}"  class="btn btn-danger-400 btn-sm" id="deleteexpertexpienceclass_editview" ><i class="icon-trash danger"></i></a>
                                </td>
                            <tr>`
                    });
                 $("#expertexpience_wrapper_tr").html(html);
           })
           .catch(error => {
               // console.log(error)
           })
        }
    });
});

$(document).on("click","#deleteexperteducationclass_editview",function(e){
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
            Expert.deleteEducation($(this).data('id')).then(data => {
                var html='';
                data.forEach(function (education,index) {
                    html += `<tr>
                                <td>${education.educationlevel['name']} </td>
                                <td>${education.educationbranch['name']}</td>
                                <td>${education.institute}</td>          
                                <td>                                                                                                      
                                <a type="button" data-id="${education['id']}"  class="btn btn-danger-400 btn-sm" id="deleteexperteducationclass_editview" ><i class="icon-trash danger"></i></a>
                                </td>
                            <tr>`
                    });
                 $("#experteducation_wrapper_tr").html(html);
           })
           .catch(error => {
               // console.log(error)
           })
        }
    });
});


$(document).on("click","#btn_modal_user",function(e){
    var requests = []; 
     $("#userrequest :selected").each(function(){
        requests.push($(this).val()); 
    });

    if(requests.length == 0) return ;

    Friend.addRequest($(this).data('id'),requests).then(data => {
        var html='';
        data.forEach(function (friendrequest,index) {
            html += `<tr>
                        <td>${index+1}</td>
                        <td>${friendrequest.request['name']}  ${(friendrequest.request['lastname'] == null) ? "" : friendrequest.request['lastname']}</td>
                        <td>${friendrequest.request.usertype['name']}</td>   
                        <td> <span class="badge badge-flat border-warning text-warning">รอการตอบรับ</span></td>                 
                        <td>                                                                                                      
                        <a type="button" data-id="${friendrequest['id']}"  class="btn btn-danger-400 btn-sm deleterequestfriendclass" id="deleterequestfriendclass_editview" ><i class="icon-trash danger"></i></a>
                        </td>
                    <tr>`
            });
         $("#requestfriend_wrapper_tr").html(html);
   })
   .catch(error => {
       // console.log(error)
   })
    return ;
});
                             
$(document).on("click","#deleterequestfriendclass_editview",function(e){
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
            Friend.deleteRequest($(this).data('id')).then(data => {
                var html='';
                data.forEach(function (friendrequest,index) {
                    html += `<tr>
                                <td>${index+1}</td>
                                <td>${friendrequest.request['name']}  ${(friendrequest.request['lastname'] == null) ? "" : friendrequest.request['lastname']}</td>
                                <td>${friendrequest.request.usertype['name']}</td>   
                                <td> <span class="badge badge-flat border-warning text-warning">รอการตอบรับ</span></td>                 
                                <td>                                                                                                      
                                <a type="button" data-id="${friendrequest['id']}"  class="btn btn-danger-400 btn-sm deleterequestfriendclass" id="deleterequestfriendclass_editview" ><i class="icon-trash danger"></i></a>
                                </td>
                            <tr>`
                    });
                 $("#requestfriend_wrapper_tr").html(html);
           })
           .catch(error => {
               // console.log(error)
           })
        }
    });
});

$(document).on("click","#acceptfriendclass_editview",function(e){
    Friend.acceptRequest($(this).data('id')).then(data => {
        var html='';
        data.comming.forEach(function (friendrequest,index) {
            html += `<tr>
                        <td>${index+1}</td>
                        <td>${friendrequest.requestcoming['name']}  ${(friendrequest.requestcoming['lastname'] == null) ? "" : friendrequest.requestcoming['lastname']}</td>
                        <td>${friendrequest.requestcoming.usertype['name']}</td>   
                        <td> <span class="badge badge-flat border-info text-info">ยังไม่ได้ตอบรับ</span> </td>                 
                        <td>                                                                                                      
                            <a type="button" data-id="${friendrequest['id']}" class="btn btn-sm bg-teal acceptfriendclass" id="acceptfriendclass_editview">ยืนยันตอบรับ</a>                                                                        
                            <a type="button" data-id="${friendrequest['id']}" class="btn btn-sm bg-danger rejectfriendclass" id="rejectfriendclass_editview">ไม่รับ</a> 
                        </td>
                    <tr>`
            });
            $("#comingrequestfriend_wrapper_tr").html(html);
            html='';
            data.friends.forEach(function (friend,index) {
                html += `<tr>
                            <td>${index+1}</td>
                            <td>${friend.user['name']}  ${(friend.user['lastname'] == null) ? "" : friend.user['lastname']}</td>
                            <td>${friend.user.usertype['name']}</td>                 
                            <td>                                                                                                      
                                <a type="button" data-id="${friend['id']}" class="btn btn-sm bg-danger deletefriendclass" id="deletefriendclass_editview">ลบ</a>                                           
                            </td>
                        <tr>`
                });
                if(data.comming.length >= 0){
                    $("#friendrequestcomingcount").html(data.comming.length);
                    $("#_friendrequestcomingcount").html(data.comming.length);
                }
                $("#friend_wrapper_tr").html(html);
    })
    .catch(error => {
        // console.log(error)
    })
});

$(document).on("click","#deletefriendclass_editview",function(e){
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
            Friend.deleteFriend($(this).data('id')).then(data => {
                var html='';
                data.forEach(function (friend,index) {
                    html += `<tr>
                                <td>${index+1}</td>
                                <td>${friend.user['name']}  ${(friend.user['lastname'] == null) ? "" : friend.user['lastname']}</td>
                                <td>${friend.user.usertype['name']}</td>                 
                                <td>                                                                                                                                                                             
                                    <a type="button" data-id="${friend['id']}" class="btn btn-sm bg-danger deletefriendclass" id="deletefriendclass_editview">ลบ</a> 
                                </td>
                            <tr>`
                    });
                    $("#friend_wrapper_tr").html(html);
            })
            .catch(error => {
                // console.log(error)
            })
        }
    });

});

$("#attachment").on('change', function() {
    var file = this.files[0];

    if (this.files[0].size/1024/1024*1000 > 1000 ){
        alert('ไฟล์ขนาดมากกว่า 1 MB');
        return ;
    }
    
    var inpattachments = $('.input_attachment').map(function() {
        return $(this).val();
    }).toArray();

    var formData = new FormData();
    formData.append('file',file);
    formData.append('inpattachments',JSON.stringify(inpattachments));

        $.ajax({
            url: `${route.url}/api/message/uploadattachment`,  //Server script to process data
            type: 'POST',
            headers: {"X-CSRF-TOKEN":route.token},
            data: formData,
            contentType: false,
            processData: false,
            success: function(data){
                console.log(data)
                var inp = `<input name="input_attachment[]" value="${data.file.id}" data-id="${data.file.id}" class="input_attachment" hidden>`;
                $('#input_attachment_wrapper').append(inp);
                var html = `<ul class="media-list">`;
                data.messageboxattachments.forEach(function (messageboxattachment,index) {
                    html += 
                        `<li class="media">	
                            <div class="media-body">
                                <div class="text-muted">${messageboxattachment.name}</div>
                            </div>
                            <div class="ml-3 align-self-center">
                                <a href="#" class="list-icons-item" id="deleteattachment" data-id="${messageboxattachment.id}"><i class="icon-trash text-muted"></i></a>
                            </div>
                        </li>`
                    });
                    html +=`</ul>`;
                 $("#attachment_wrapper").html(html);
        }
    });

});


$(document).on('click', '#deleteattachment', function (e) {
    e.preventDefault();
    var inpattachments = $('.input_attachment').map(function() {
        return $(this).val();
    }).toArray();

    var formData = new FormData();
    formData.append('id',$(this).data('id'));
    formData.append('inpattachments',JSON.stringify(inpattachments));

    $.ajax({
        url: `${route.url}/api/message/deleteattachment`,  //Server script to process data
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: formData,
        contentType: false,
        processData: false,
        success: function(data){
            console.log(data.id);
            $("input[name='input_attachment[]'][data-id='" + data.id + "']").remove();
            var html = `<ul class="media-list">`;
            data.messageboxattachments.forEach(function (messageboxattachment,index) {
                html += 
                    `<li class="media">	
                        <div class="media-body">
                            <div class="text-muted">${messageboxattachment.name}</div>
                        </div>
                        <div class="ml-3 align-self-center">
                            <a href="#" class="list-icons-item" id="deleteattachment" data-id="${messageboxattachment.id}"><i class="icon-trash text-muted"></i></a>
                        </div>
                    </li>`
                });
                html +=`</ul>`;
             $("#attachment_wrapper").html(html);
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




$("#usergroup").on('change', function() {
    if($(this).val() == 2) {
        $('#vatno').attr('readonly', true);
        $('#vatno').val('');
    } else { 
        $('#vatno').attr('readonly', false);
    }
});


// $("#vatno").change(function(){
$("#vatno").on('change', function() {
    $('#msg').removeClass();
    var vatid = $(this).val();
    if(vatid.length != 13){ 
        $('#msg').addClass('text-danger');    
        $('#msg').html(" เลขประจำตัวผู้เสียภาษีอากรไม่ถูกต้อง")
        $('#vatno').val('');
        return ;
    }
    checkTinPin($(this).val()).then(data => {
        $('#msg').removeClass();
        if(data.length != 0 ){ 
            if(data[0].exist == 'n'){
                $('#msg').addClass('text-success'); 
                $('#msg').html( data[0].title + data[0].name)
            }else if(data[0].exist == 'y') {
                $('#msg').addClass('text-danger');   
                $('#msg').html(" เลขประจำตัวผู้เสียภาษีอากรนี้ลงทะเบียนแล้ว");
            }
        }else{
            $('#msg').addClass('text-danger');   
            $('#msg').html(" ไม่พบเลขประจำตัวผู้เสียภาษีอากร");
            $('#vatno').val('');
        }
    })
    .catch(error => {
        console.log(error)
    })
});

function checkTinPin(vatid){
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/api/tinpin/companyinfo`,
          type: 'POST',
          headers: {"X-CSRF-TOKEN":route.token},
          data: {
            vatid : vatid
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

$(document).on("click","#getotp",function(e){
    // console.log($('#phone').val());
    if($('#phone').val() == ''){
        return ;
    }
    var tmpotp =';'
    Swal.fire({
        title: 'ยืนยันเบอร์โทรศัพท์!',
        text: `ต้องการยืนยันเบอร์โทรศัพท์ หรือไม่`,
        type: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'ตกลง',
        cancelButtonText: 'ยกเลิก',
        closeOnConfirm: false,
        closeOnCancel: false
        }).then((result) => {
        if (result.value) {
            Swal.fire({
                title: 'โปรดรับรหัส OTP',
                // input: 'text',
                text: 'รหัส OTP จะส่งไปยังโทรศัพท์หมายเลข ' + $('#phone').val() ,
                inputAttributes: {
                  autocapitalize: 'off'
                },
                showCancelButton: true,
                confirmButtonText: 'ต่อไป',
                cancelButtonText: 'ยกเลิก',
                showLoaderOnConfirm: true,
                preConfirm: (login) => {
                    SMS.sendSMS($('#phone').val()).then(data => {
                        console.log(data);
                        tmpotp = data;
                    })
                    .catch(error => {
                        // console.log(error)
                    })
                },
                allowOutsideClick: false
              }).then((result) => {
                if (result.value) {
                    Swal.fire({
                        title: 'กรอกรหัส OTP',
                        input: 'text',
                        text: 'โปรดกรอกสอบรหัส OTP' ,
                        inputAttributes: {
                          autocapitalize: 'off'
                        },
                        showCancelButton: true,
                        confirmButtonText: 'ตกลง',
                        cancelButtonText: 'ยกเลิก',
                        showLoaderOnConfirm: true,
                        preConfirm: (inp) => {
                          SMS.saveOTP(tmpotp,inp).then(data => {
                                console.log('my otp: ' + data);
                                location.reload();
                            })
                            .catch(error => {
                                // console.log(error)
                            })
                        },
                        allowOutsideClick: false
                      })
                }
              })
        }
    });
});

// $("#hid").change(function(){
$("#hid").on('change', function() {
     if($(this).val() == ""){
         if($(this).hasClass("border-danger")){
             $("#hidinvalid").attr("hidden",true);
             $(this).removeClass('border-danger');            
             $("#hidinvalid").text('');
         }
         return ;
     }
     Hid.check($(this).val()).then(data => {
         if(data[0].success){
             $("#hidinvalid").attr("hidden",true);
             $(this).removeClass('border-danger');
         }else{
             $("#hidinvalid").attr("hidden",false);
             $("#hidinvalid").text(data[0].message);            
             $(this).addClass('border-danger');
             $(this).val('');
         }
     })
     .catch(error => {
         console.log(error)
     })
 });

 $("#addposition").on('click', function() {
    $('#modal_add_position').modal('show');
 });

 $("#btn_modal_add_position").on('click', function() {
     if($('#modalposition').val()=='')return;

     addUserPosition($('#modalposition').val()).then(data => {
        var html =``;
        data.forEach(function (position,index) {
                html += `<option value="${position['id']}" >${position['name']}</option>`
            });
        $("#userposition").html(html);
        
        })
    .catch(error => {})
 });

 function addUserPosition(position){
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/api/profile/adduserposition`,
          type: 'POST',
          headers: {"X-CSRF-TOKEN":route.token},
          data: {
            position : position
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


$("#companydoc").on('change', function() {
    if($('#companydocname').val() == '')return ;
    var file = this.files[0];
    console.log(file);
    if (this.files[0].size/1024/1024*1000 > 2000 ){
        alert('ไฟล์ขนาดมากกว่า 2 MB');
        return ;
    }
    var formData = new FormData();
    formData.append('file',file);
    formData.append('id',$(this).data('id'));
    formData.append('companydocname',$('#companydocname').val());
        $.ajax({
            url: `${route.url}/api/fulltbp/companydoc/add`,  //Server script to process data
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
                            <a href="${route.url}/${attachment.path}" class=" btn btn-sm bg-primary">ดาวน์โหลด</a>
                            <a type="button" data-id="${attachment.id}" data-name="" class="btn btn-sm bg-danger deletefulltbpcompanydocattachment">ลบ</a>                                       
                        </td>
                    </tr>`
                    });
                 $("#fulltbp_companydoc_wrapper_tr").html(html);
                 $('#modal_add_companydoc').modal('hide');
        }
    });
});

$(document).on("click",".deletefulltbpcompanydocattachment",function(e){
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
            Project.deleteCompanydoc($(this).data('id')).then(data => {
                var html = ``;
                data.forEach(function (attachment,index) {
                    html += `<tr >                                        
                        <td> ${attachment.name} </td>                                            
                        <td> 
                            <a href="${route.url}/${attachment.path}" class=" btn btn-sm bg-primary">ดาวน์โหลด</a>
                            <a type="button" data-id="${attachment.id}" data-name="" class="btn btn-sm bg-danger deletefulltbpcompanydocattachment">ลบ</a>                                       
                        </td>
                    </tr>`
                    });
                 $("#fulltbp_companydoc_wrapper_tr").html(html);
           })
           .catch(error => {})
        }
    });
});

$(document).on('click', '#btn_modal_add_authorized_director', function(e) {
    console.log($('#directorposition').val());
    if($('#directorname').val() =='' || $('#directorlastname').val() =='' || $('#directorposition').val() == ''){
        return ;
    }
    addAuthorizedDirector($(this).data('id'),$('#directorprefix').val(),$('#directorname').val(),$('#directorlastname').val(),$('#directorposition').val(),$('#signatureid').val()).then(data => {
        var html = ``;
        //
        data.forEach(function (director,index) {
            var check = '<span class="badge badge-flat border-warning text-warning">ไม่พบลายมือชื่อ</span>';
            if(director.signature_id != null){
                check =  '<span class="badge badge-flat border-success text-success">มีลายมือชื่อแล้ว</span>'
            }
            html += `<tr >                                        
                <td> ${director.prefix['name']}${director.name}  ${director.lastname} </td>                                            
                <td> ${director.employposition['name']} </td>  
                <td>
                    ${check}
                </td>   
                <td>
                    <a type="button" data-id="${director.id}" class="btn btn-sm bg-info editauthorizeddirector">แก้ไข</a>  
                    <a type="button" data-id="${director.id}" class="btn btn-sm bg-danger deleteauthorizeddirector">ลบ</a>  
                </td> 
            </tr>`
            });
         $('#authorizeddirector').val(data.length);
         $("#authorized_director_wrapper_tr").html(html);
         $('#modal_add_authorized_director').modal('hide');
    })
    .catch(error => {})
});

function addAuthorizedDirector(id,prefix,name,lastname,position,signature) {
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/api/company/addauthorizeddirector`,
          type: 'POST',
          dataType: "json",
          headers: {"X-CSRF-TOKEN":route.token},
          data: {
            id : id,
            prefix : prefix,
            name : name,
            lastname : lastname,
            position : position,
            signature : signature
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
  $(document).on('click', '.deleteauthorizeddirector', function(e) {
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
            deleteAuthorizedDirector($(this).data('id')).then(data => {
                var html = ``;
                console.log(data.length);
                data.forEach(function (director,index) {
                    var check = '<span class="badge badge-flat border-warning text-warning">ไม่พบลายมือชื่อ</span>';
                    if(director.signature_id != null){
                        check =  '<span class="badge badge-flat border-success text-success">มีลายมือชื่อแล้ว</span>'
                    }
                    html += `<tr >                                        
                        <td> ${director.prefix['name']}${director.name}  ${director.lastname} </td>                                            
                        <td> ${director.employposition['name']} </td>  
                        <td>
                            ${check}
                        </td>   
                        <td>
                            <a type="button" data-id="${director.id}" class="btn btn-sm bg-info editauthorizeddirector">แก้ไข</a>  
                            <a type="button" data-id="${director.id}" class="btn btn-sm bg-danger deleteauthorizeddirector">ลบ</a>  
                        </td> 
                    </tr>`
                    });
                 $('#authorizeddirector').val(data.length);
                 $("#authorized_director_wrapper_tr").html(html);
            })
            .catch(error => {})        
        }
    });
});
  function deleteAuthorizedDirector(id) {
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/api/company/deleteauthorizeddirector`,
          type: 'POST',
          dataType: "json",
          headers: {"X-CSRF-TOKEN":route.token},
          data: {
            id : id
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

 
  $(document).on('change', '#isic', function(e) {
    Company.getSubIsic($(this).val()).then(data => {
        var html = ``;
        var companysubisic= data.company.isic_sub_id;
        data.subisics.forEach(function (subisic,index) {
            var select ='';
            if(data.company.isic_sub_id == subisic['id']){
                select = 'selected'
            }
            html +=`<option value="${subisic['id']}" ${select}>${subisic['name']}</option>`
            });
         $("#subisic").html(html);
    })
    .catch(error => {})
});

$(document).on('click', '#btn_modal_add_address', function(e) {
    addAddress($(this).data('id'),$('#addressname').val(),$('#address').val(),$('#provincemodal').val(),$('#amphurmodal').val(),$('#tambolmodal').val(),$('#postalcode').val(),$('#lat').val(),$('#lng').val()).then(data => {
        var html = ``;
        data.forEach(function (address,index) {
            html += `<tr >                                        
                <td> ${address.addresstype} </td>                                            
                <td> ${address.address} </td> 
                <td> ${address.tambol['name']} </td> 
                <td> ${address.amphur['name']} </td> 
                <td> ${address.province['name']} </td> 
                <td> ${address.postalcode} </td> 
                <td><a type="button" data-id="${address.id}" class="btn btn-sm bg-danger deleteaddress">ลบ</a>  </td> 
            </tr>`
            });
            console.log(data.length);
            if (data.length >= 1) {
                $("#other_address_wrapper").attr("hidden",false);
            }else{
                $("#other_address_wrapper").attr("hidden",true);
            }
         $("#authorized_address_wrapper_tr").html(html);
    }).catch(error => {})
});

$(document).on('click', '.deleteaddress', function(e) {
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
            deleteAddress($(this).data('id')).then(data => {
                var html = ``;
                data.forEach(function (address,index) {
                    html += `<tr >                                        
                        <td> ${address.addresstype} </td>                                            
                        <td> ${address.address} </td> 
                        <td> ${address.tambol['name']} </td> 
                        <td> ${address.amphur['name']} </td> 
                        <td> ${address.province['name']} </td> 
                        <td> ${address.postalcode} </td> 
                        <td><a type="button" data-id="${address.id}" class="btn btn-sm bg-danger deleteaddress">ลบ</a>  </td> 
                    </tr>`
                    });
                    if (data.length >= 1) {
                        $("#other_address_wrapper").attr("hidden",false);
                    }else{
                        $("#other_address_wrapper").attr("hidden",true);
                    }
                 $("#authorized_address_wrapper_tr").html(html);
            }).catch(error => {})     
        }
    });
});

function addAddress(id,addressname,address,provincemodal,amphurmodal,tambolmodal,postalcode,lat,lng){
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/api/profile/addaddress`,
          type: 'POST',
          headers: {"X-CSRF-TOKEN":route.token},
          data: {
            id : id,
            addressname : addressname,
            address : address,
            provincemodal : provincemodal,
            amphurmodal : amphurmodal,
            tambolmodal : tambolmodal,
            postalcode : postalcode,
            lat : lat,
            lng : lng
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

function deleteAddress(id){
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/api/profile/deleteaddress`,
          type: 'POST',
          headers: {"X-CSRF-TOKEN":route.token},
          data: {
            id : id
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

$(document).on('click', '#btn_add_authorized_director', function(e) {
    $('#signature_type').val('1');
    $('#signatureid').val('');
    $("#sigdiv").html('');
    $('#modal_add_authorized_director').modal('show');
});

$(document).on('click', '.editauthorizeddirector', function(e) {
    $('#signature_type').val('2');
    getAuthorizedDirector($(this).data('id')).then(data => {
        var html =``;
        var html1 =``;
        // console.log(data.companyemploy['employ_position_id']);
        data.employpositions.forEach(function (position,index) {
                var selectposition = '';
                if(position.id == data.companyemploy['employ_position_id']){
                    console.log('ok');
                    selectposition = 'selected';
                }
                html += `<option value="${position['id']}" ${selectposition} >${position['name']}</option>`
            });
        data.prefixes.forEach(function (prefix,index) {
            var selectprefix = '';
            if(prefix.id == data.companyemploy['prefix_id']){
                selectprefix = 'selected';
            }
            html1 += `<option value="${prefix['id']}" ${selectprefix}>${prefix['name']}</option>`
        });
        
        if(data.$signature != ''){            
            $("#sigdiv_edit").html(`<img src="${route.url}/${data.$signature}" style="width: 180px;height:45px" alt=""></img>`);
        }else{
            $("#sigdiv_edit").html(`ไม่พบลายมือชื่อ`);
        }

        $("#directorname_edit").val(data.companyemploy['name']);
        $("#directorlastname_edit").val(data.companyemploy['lastname']);
        $("#directorposition_edit").html(html);
        $("#directorprefix_edit").html(html1);
        $("#authorized_director_id").val(data.companyemploy['id']);
        
        $('#modal_edit_authorized_director').modal('show');
    }).catch(error => {}) 
});

    function getAuthorizedDirector(id) {
        return new Promise((resolve, reject) => {
            $.ajax({
              url: `${route.url}/api/company/getauthorizeddirector`,
              type: 'POST',
              dataType: "json",
              headers: {"X-CSRF-TOKEN":route.token},
              data: {
                id : id
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


      function editAuthorizedDirector(id,prefix,name,lastname,position,signature) {
        return new Promise((resolve, reject) => {
            $.ajax({
              url: `${route.url}/api/company/editauthorizeddirector`,
              type: 'POST',
              dataType: "json",
              headers: {"X-CSRF-TOKEN":route.token},
              data: {
                id : id,
                prefix : prefix,
                name : name,
                lastname : lastname,
                position : position,
                signature : signature
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

      

      $(document).on('click', '#btn_modal_edit_authorized_director', function(e) {
        editAuthorizedDirector($('#authorized_director_id').val(),$('#directorprefix_edit').val(),$('#directorname_edit').val(),$('#directorlastname_edit').val(),$('#directorposition_edit').val(),$('#signatureid').val()).then(data => {
            var html = ``;
            console.log(data);
            data.forEach(function (director,index) {
                var check = '<span class="badge badge-flat border-warning text-warning">ไม่พบลายมือชื่อ</span>';
                if(director.signature_id){
                    check =  '<span class="badge badge-flat border-success text-success">มีลายมือชื่อแล้ว</span>'
                }
                html += `<tr >                                        
                    <td> ${director.prefix['name']}${director.name}  ${director.lastname} </td>                                            
                    <td> ${director.employposition['name']} </td>  
                    <td>
                        ${check}
                    </td>   
                    <td>
                        <a type="button" data-id="${director.id}" class="btn btn-sm bg-info editauthorizeddirector">แก้ไข</a>  
                        <a type="button" data-id="${director.id}" class="btn btn-sm bg-danger deleteauthorizeddirector">ลบ</a>  
                    </td> 
                </tr>`
                });
             $('#authorizeddirector').val(data.length);
             $("#authorized_director_wrapper_tr").html(html);
        })
        .catch(error => {})
    });