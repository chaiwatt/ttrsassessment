import * as Message from './message.js'
import * as Expert from './expert.js'

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
                <input type="text" name="expertexpienceposition[${a}]" id="expertexpienceposition${a}" value="${$("#expertexpienceposition").val()}" class="form-control" >
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <input type="text" name="expertexpiencecompany[${a}]" id="expertexpiencecompany${a}" value="${$("#expertexpiencecompany").val()}" class="form-control" >
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <input type="text" name="expertexpiencedetail[${a}]" id="expertexpiencedetail${a}" value="${$("#expertexpiencedetail").val()}" class="form-control" >
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <input type="text" name="fromyear[${a}]" id="fromyear${a}" value="${$("#fromyear").val()}" class="form-control" >
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <input type="text" name="toyear[${a}]" id="toyear${a}" value="${$("#toyear").val()}" class="form-control" >
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
                <input type="text" name="educationlevel[${b}]" id="educationlevel${b}" value="${$("#educationlevel").val()}" class="form-control" >
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <input type="text" name="educationbranch[${b}]" id="educationbranch${b}" value="${$("#educationbranch").val()}" class="form-control" >
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <input type="text" name="institute[${b}]" id="institute${b}" value="${$("#institute").val()}" class="form-control" >
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <input type="text" name="country[${b}]" id="country${b}" value="${$("#country").val()}" class="form-control" >
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <input type="text" name="graduatedyear[${b}]" id="graduatedyear${b}" value="${$("#graduatedyear").val()}" class="form-control" >
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

$(document).on("click","#maillink",function(e){
    // alert($(this).data('id'));
    Message.getMessage($(this).data('id')).then(data => {
        // console.log(data.message.messagebox.title);
        console.log(data.attachment);
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
                    html +=`</tbody>
                            </table>
                            </div>`
                
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



                             
