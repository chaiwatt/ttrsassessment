import * as Message from './message.js'
import * as Expert from './expert.js'
import * as Friend from './friend.js'

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
                <input type="text" name="expertexpienceposition[${a}]" id="expertexpienceposition${a}" value="${$("#expertexpienceposition").val()}" class="form-control" hidden>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <input type="text" name="expertexpiencecompany[${a}]" id="expertexpiencecompany${a}" value="${$("#expertexpiencecompany").val()}" class="form-control" hidden>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <input type="text" name="expertexpiencedetail[${a}]" id="expertexpiencedetail${a}" value="${$("#expertexpiencedetail").val()}" class="form-control" hidden>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <input type="text" name="fromyear[${a}]" id="fromyear${a}" value="${$("#fromyear").val()}" class="form-control" hidden>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <input type="text" name="toyear[${a}]" id="toyear${a}" value="${$("#toyear").val()}" class="form-control" hidden>
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
                <input type="text" name="educationlevel[${b}]" id="educationlevel${b}" value="${$("#educationlevel").val()}" class="form-control" hidden>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <input type="text" name="educationbranch[${b}]" id="educationbranch${b}" value="${$("#educationbranch").val()}" class="form-control" hidden>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <input type="text" name="institute[${b}]" id="institute${b}" value="${$("#institute").val()}" class="form-control" hidden>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <input type="text" name="country[${b}]" id="country${b}" value="${$("#country").val()}" class="form-control" hidden>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <input type="text" name="graduatedyear[${b}]" id="graduatedyear${b}" value="${$("#graduatedyear").val()}" class="form-control" hidden>
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
    $(this).removeClass("unread")
    Message.getMessage($(this).data('id')).then(data => {
        let html= '';
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

        $("#tablemessage").html(html);
        $("#messagetitle").html(data.message.messagebox.title);
        $("#messagebody").html(data.message.messagebox.body);
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
                            <a type="button" data-id="${friendrequest['id']}" class="badge bg-teal acceptfriendclass" id="acceptfriendclass_editview">ยืนยันตอบรับ</a>                                                                        
                            <a type="button" data-id="${friendrequest['id']}" class="badge bg-danger rejectfriendclass" id="rejectfriendclass_editview">ไม่รับ</a> 
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
                                <a type="button" data-id="${friend['id']}" class="badge bg-danger deletefriendclass" id="deletefriendclass_editview">ลบ</a>                                           
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
                                    <a type="button" data-id="${friend['id']}" class="badge bg-danger deletefriendclass" id="deletefriendclass_editview">ลบ</a> 
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
