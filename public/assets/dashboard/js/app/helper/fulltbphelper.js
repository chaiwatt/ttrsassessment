import * as ThaiWord from './thaiword.js';
import * as CompanyProfile from './companyprofile.js';
import * as CompanyProfileAttachment from './companyprofileattachment.js';
import * as Employ from './employ.js';
import * as StockHolder from './stockholder.js';
import * as Project from './project.js';

$(document).on('keyup', '#companyprofile_input', function(e) {
    if (e.keyCode === 13) {
        var html = `<input type="text" name ="companyprofile[]" value="${$(this).val()}" class="form-control companyprofileclass" style="border: 0" >`;
        $(this).val('');
        $('#fulltbp_companyprofile_wrapper').append(html);
    }
});

$(document).on('keyup', '.companyprofileclass', function(e) {
    $('#companyprofiletextlength').html((90-ThaiWord.countCharTh($(this).val())));
});

$(document).on('click', '#btnaddcompanyprofile', function(e) {
    var lines = $('input[name="companyprofile[]"]').map(function(){ 
        return this.value; 
    }).get();
    CompanyProfile.addCompanyProfile(lines,$(this).data('id')).then(data => {
        console.log(data);
        Swal.fire({
            title: 'สำเร็จ...',
            text: 'เพิ่มประวัติบริษัทสำเร็จ!',
            });
    })
    .catch(error => {})
});

$("#attachment").on('change', function() {
    console.log($(this).data('id'));

    var file = this.files[0];

    if (this.files[0].size/1024/1024*1000 > 1000 ){
        alert('ไฟล์ขนาดมากกว่า 1 MB');
        return ;
    }
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
                            <a href="${route.url}/${attachment.path}" class=" badge bg-primary">ดาวน์โหลด</a>
                            <a type="button" data-id="${attachment.id}" data-name="" class="btn badge bg-danger deletefulltbpcompanyprofileattachment">ลบ</a>                                       
                        </td>
                    </tr>`
                    });
                 $("#fulltbp_companyprofile_attachment_wrapper_tr").html(html);
        }
    });

});

$(document).on("click",".deletefulltbpcompanyprofileattachment",function(e){
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
            CompanyProfileAttachment.deleteAttachement($(this).data('id')).then(data => {
                var html = ``;
                // console.log(data);
                data.forEach(function (attachment,index) {
                    html += `<tr >                                        
                        <td> ${attachment.name} </td>                                            
                        <td> 
                            <a href="${route.url}/${attachment.path}" class=" badge bg-primary">ดาวน์โหลด</a>
                            <a type="button" data-id="${attachment.id}" data-name="" class="btn badge bg-danger deletefulltbpcompanyprofileattachment">ลบ</a>                                       
                        </td>
                    </tr>`
                    });
                 $("#fulltbp_companyprofile_attachment_wrapper_tr").html(html);
           })
           .catch(error => {})
        }
    });
}); 


$(document).on('click', '#btn_modal_add_employ', function(e) {
    Employ.saveEmploy($('#employprefix').val(),$('#employname').val(),$('#employlastname').val(),$('#employposition').val(),$('#employphone').val(),$('#employworkphone').val()).then(data => {
        console.log(data);
        var html = ``;
        data.forEach(function (employ,index) {
            html += `<tr >                                        
                <td> ${employ.name}${employ.lastname} </td>                                            
                <td> ${employ.employposition['name']} </td> 
                <td> ${employ.phone} </td>                                            
                <td> ${employ.workphone} </td> 
                <td> <a type="button" data-id="${employ.id}" class="btn badge bg-info editEmployinfo">แก้ไข</a> 
                <a type="button" data-id="${employ.id}" class="btn badge bg-warning deletecompanyemploy">ลบ</a>  </td> 
            </tr>`
            });
         $("#fulltbp_companyemploy_wrapper_tr").html(html);
    })
    .catch(error => {})
});

$(document).on('click', '.editEmployinfo', function(e) {
    Employ.getEmploy($(this).data('id')).then(data => {
        var selectprefix = `<select id="employprefix_edit" data-placeholder="คำนำหน้าชื่อ" class="form-control form-control-select2">`;
        data.prefixes.forEach(function (prefix,index) {
            var selected = '';
            if(data.employ['prefix_id'] == prefix['id']){
                selected = 'selected';
            }
            selectprefix += `<option value="${prefix['id']}" ${selected} >${prefix['name']}</option>`
            });
            selectprefix += `</select>`;
        $("#employprefix_wrapper").html(selectprefix);

        var selectemployposition = `<select id="employposition_edit" data-placeholder="คำนำหน้าชื่อ" class="form-control form-control-select2">`;
        data.employpositions.forEach(function (position,index) {
            var selected = '';
            if(data.employ['employ_position_id'] == position['id']){
                selected = 'selected';
            }
            selectemployposition += `<option value="${position['id']}" ${selected} >${position['name']}</option>`
            });
            selectemployposition += `</select>`;

        var employeducationtable = '';
        data.employeducations.forEach(function (education,index) {
            employeducationtable += `<tr >                                        
                <td> ${education.employeducationlevel} </td>                                            
                <td> ${education.employeducationinstitute} </td> 
                <td> ${education.employeducationmajor} </td>                                            
                <td> ${education.employeducationyear} </td> 
                <td> <a type="button" data-id="${education.id}" class="btn badge bg-danger deleteemployeducation">ลบ</a> </td> 
            </tr>`
            });
        $("#fulltbp_companyemployeducation_wrapper_tr").html(employeducationtable);

        var experiencetable = '';
        data.employexperiences.forEach(function (experience,index) {
            experiencetable += `<tr >                                        
                <td> ${experience.startdateth} - ${experience.enddateth}</td>                                            
                <td> ${experience.company} </td> 
                <td> ${experience.businesstype} </td>                                            
                <td> ${experience.startposition} </td> 
                <td> ${experience.endposition} </td> 
                <td> <a type="button" data-id="${experience.id}" class="btn badge bg-danger deleteemployexperience">ลบ</a> </td> 
            </tr>`
            });
         $("#fulltbp_companyemployexperience_wrapper_tr").html(experiencetable);

         var trainingtable = '';
         data.employtrainings.forEach(function (training,index) {
            trainingtable += `<tr >                                        
                 <td> ${training.trainingdateth}</td>                                            
                 <td> ${training.course} </td> 
                 <td> ${training.owner} </td>                                            
                 <td> <a type="button" data-id="${training.id}" class="btn badge bg-danger deleteemploytraining">ลบ</a> </td> 
             </tr>`
             });
          $("#fulltbp_companyemploytraining_wrapper_tr").html(trainingtable);

        $("#employposition_wrapper").html(selectemployposition);
        $('#employid').val(data.employ['id'])
        $('#employname_edit').val(data.employ['name'])
        $('#employlastname_edit').val(data.employ['lastname'])
        $('#employphone_edit').val(data.employ['phone'])
        $('#employworkphone_edit').val(data.employ['workphone']) 
    })
    .catch(error => {})
    $('#modal_edit_employ').modal('show');
});

$(document).on('click', '#btn_edit_employ', function(e) {
    console.log($(this).data('id'));
    Employ.editEmploy($('#employid').val(),$('#employname_edit').val(),$('#employlastname_edit').val(),$('#employposition_edit').val(),$('#employphone_edit').val(),$('#employworkphone_edit').val()).then(data => {
        console.log(data);
        var html = ``;
        data.forEach(function (employ,index) {
            html += `<tr >                                        
                <td> ${employ.name}${employ.lastname} </td>                                            
                <td> ${employ.employposition['name']} </td> 
                <td> ${employ.phone} </td>                                            
                <td> ${employ.workphone} </td> 
                <td> <a type="button" data-id="${employ.id}" class="btn badge bg-info editEmployinfo">แก้ไข</a> 
                <a type="button" data-id="${employ.id}" class="btn badge bg-warning deletecompanyemploy">ลบ</a>  </td>  
            </tr>`
            });
         $("#fulltbp_companyemploy_wrapper_tr").html(html);
    })
    .catch(error => {})
    $('#modal_edit_employ').modal('show');
});


$(document).on("click",".deletecompanyemploy",function(e){
    console.log($(this).data('id'));
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
            Employ.deleteEmployInfo($(this).data('id')).then(data => {
                var html = ``;
                data.forEach(function (employ,index) {
                    html += `<tr >                                        
                        <td> ${employ.name}${employ.lastname} </td>                                            
                        <td> ${employ.employposition['name']} </td> 
                        <td> ${employ.phone} </td>                                            
                        <td> ${employ.workphone} </td> 
                        <td> <a type="button" data-id="${employ.id}" class="btn badge bg-info editEmployinfo">แก้ไข</a> 
                        <a type="button" data-id="${employ.id}" class="btn badge bg-warning deletecompanyemploy">ลบ</a>  </td>  
                    </tr>`
                    });
                 $("#fulltbp_companyemploy_wrapper_tr").html(html);
            })
           .catch(error => {})
        }
    });

}); 

$(document).on('click', '#btn_modal_add_employeducation', function(e) {
    Employ.addEmployEducation($('#employid').val(),$('#employeducationlevel').val(),$('#employeducationinstitute').val(),$('#employeducationmajor').val(),$('#employeducationyear').val()).then(data => {
        console.log(data);
        var html = '';
        data.forEach(function (education,index) {
            html += `<tr >                                        
                <td> ${education.employeducationlevel} </td>                                            
                <td> ${education.employeducationinstitute} </td> 
                <td> ${education.employeducationmajor} </td>                                            
                <td> ${education.employeducationyear} </td> 
                <td> <a type="button" data-id="${education.id}" class="btn badge bg-danger deleteemployeducation">ลบ</a> </td> 
            </tr>`
            });
         $("#fulltbp_companyemployeducation_wrapper_tr").html(html);
    })
    // .catch(error => {})
});

$(function () {
    $('#employexperiencestartdate').bootstrapMaterialDatePicker({
        format: 'DD/MM/YYYY',
        clearButton: true,
        weekStart: 1,
        cancelText: "ยกเลิก",
        okText: "ตกลง",
        clearText: "เคลียร์",
        time: false
    });
});

$(function () {
    $('#employexperienceenddate').bootstrapMaterialDatePicker({
        format: 'DD/MM/YYYY',
        clearButton: true,
        weekStart: 1,
        cancelText: "ยกเลิก",
        okText: "ตกลง",
        clearText: "เคลียร์",
        time: false
    });
});

$(document).on('click', '#btn_modal_add_employexperience', function(e) {
    console.log($('#employid').val());
    Employ.addEmployExperience($('#employid').val(),$('#employexperiencestartdate').val(),$('#employexperienceenddate').val(),$('#employexperiencecompany').val(),$('#employexperiencebusinesstype').val(),$('#employexperiencestartposition').val(),$('#employexperienceendposition').val()).then(data => {
        console.log(data);
        var html = '';
        data.forEach(function (experience,index) {
            html += `<tr >                                        
                <td> ${experience.startdateth} - ${experience.enddateth}</td>                                            
                <td> ${experience.company} </td> 
                <td> ${experience.businesstype} </td>                                            
                <td> ${experience.startposition} </td> 
                <td> ${experience.endposition} </td> 
                <td> <a type="button" data-id="${experience.id}" class="btn badge bg-danger deleteemployexperience">ลบ</a> </td> 
            </tr>`
            });
         $("#fulltbp_companyemployexperience_wrapper_tr").html(html);
    })
    .catch(error => {})
});

$(document).on('click', '#btn_modal_add_employtraining', function(e) {
    console.log($('#employid').val());
    Employ.addEmployTraining($('#employid').val(),$('#employtrainingdate').val(),$('#employtrainingcourse').val(),$('#employtrainingowner').val()).then(data => {
        console.log(data);
        var html = '';
        data.forEach(function (training,index) {
            html += `<tr >                                        
                <td> ${training.trainingdateth}</td>                                            
                <td> ${training.course} </td> 
                <td> ${training.owner} </td>                                            
                <td> <a type="button" data-id="${training.id}" class="btn badge bg-danger deleteemploytraining">ลบ</a> </td> 
            </tr>`
            });
         $("#fulltbp_companyemploytraining_wrapper_tr").html(html);
    })
    .catch(error => {})
});

$(function () {
    $('#employtrainingdate').bootstrapMaterialDatePicker({
        format: 'DD/MM/YYYY',
        clearButton: true,
        weekStart: 1,
        cancelText: "ยกเลิก",
        okText: "ตกลง",
        clearText: "เคลียร์",
        time: false
    });
});

$(document).on("click",".deleteemployeducation",function(e){
    console.log($(this).data('id'));
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
            Employ.deleteEmployEducation($(this).data('id')).then(data => {
                var html = ``;
                console.log(data);
            data.forEach(function (education,index) {
            html += `<tr >                                        
                <td> ${education.employeducationlevel} </td>                                            
                <td> ${education.employeducationinstitute} </td> 
                    <td> ${education.employeducationmajor} </td>                                            
                    <td> ${education.employeducationmajor} </td> 
                    <td> <a type="button" data-id="${education.id}" class="btn badge bg-danger deleteemployeducation">ลบ</a> </td> 
                </tr>`
                });
            $("#fulltbp_companyemployeducation_wrapper_tr").html(html);
            })
           .catch(error => {})
        }
    });

}); 

$(document).on("click",".deleteemployexperience",function(e){
    console.log($(this).data('id'));
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
            Employ.deleteEmployExperience($(this).data('id')).then(data => {
                var html = ``;
                console.log(data);
                data.forEach(function (experience,index) {
                    html += `<tr >                                        
                        <td> ${experience.startdateth} - ${experience.enddateth}</td>                                            
                        <td> ${experience.company} </td> 
                        <td> ${experience.businesstype} </td>                                            
                        <td> ${experience.startposition} </td> 
                        <td> ${experience.endposition} </td> 
                        <td> <a type="button" data-id="${experience.id}" class="btn badge bg-danger deleteemployexperience">ลบ</a> </td> 
                    </tr>`
                    });
                 $("#fulltbp_companyemployexperience_wrapper_tr").html(html);
            })
           .catch(error => {})
        }
    });

}); 

$(document).on("click",".deleteemploytraining",function(e){
    console.log($(this).data('id'));
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
            Employ.deleteEmployTraining($(this).data('id')).then(data => {
                var html = ``;
                console.log(data);
                data.forEach(function (training,index) {
                    html += `<tr >                                        
                        <td> ${training.trainingdateth}</td>                                            
                        <td> ${training.course} </td> 
                        <td> ${training.owner} </td>                                            
                        <td> <a type="button" data-id="${training.id}" class="btn badge bg-danger deleteemploytraining">ลบ</a> </td> 
                    </tr>`
                    });
                 $("#fulltbp_companyemploytraining_wrapper_tr").html(html);
            })
           .catch(error => {})
        }
    });

}); 

$(document).on('click', '#btnstckholder', function(e) {
    Employ.getEmploys($(this).data('id')).then(data => {
        console.log(data);
        var html = ``;
        var selectstockholder = `<label>รายชื่อพนักงาน</label><span class="text-danger">*</span><select id="selectstockholder_edit" data-placeholder="รายชื่อพนักงาน" class="form-control form-control-select2">`;
        data.forEach(function (stock,index) {
            selectstockholder += `<option value="${stock['id']}" >${stock['name']}</option>`
            });
            selectstockholder += `</select>`;
        $("#stockholderselect_wrapper").html(selectstockholder);
    })
    .catch(error => {})
    $('#modal_add_stockholder').modal('show');
});

$(document).on('click', '#btn_modal_add_stockholder', function(e) {
    StockHolder.addStockHolder($('#selectstockholder_edit').val(),$('#relationwithceo').val()).then(data => {
        console.log(data);
        var html = ``;
        data.forEach(function (stockholder,index) {
            html += `<tr >                                        
                <td> ${stockholder.companyemploy['name']} ${stockholder.companyemploy['lastname']}</td>                                            
                <td> ${stockholder.relationwithceo} </td>                                           
                <td> <a type="button" data-id="${stockholder.id}" class="btn badge bg-warning deletestockholder">ลบ</a> </td> 
            </tr>`
            });
            console.log(html);
        $("#fulltbp_companystockholder_wrapper_tr").html(html);
    })
    .catch(error => {})
});

$(document).on("click",".deletestockholder",function(e){
    console.log($(this).data('id'));
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
            StockHolder.deleteStockHolder($(this).data('id')).then(data => {
                var html = ``;
                data.forEach(function (stockholder,index) {
                    html += `<tr >                                        
                        <td> ${stockholder.companyemploy['name']} ${stockholder.companyemploy['lastname']}</td>                                            
                        <td> ${stockholder.relationwithceo} </td>                                           
                        <td> <a type="button" data-id="${stockholder.id}" class="btn badge bg-warning deletestockholder">ลบ</a> </td> 
                    </tr>`
                    });
                    console.log(html);
                $("#fulltbp_companystockholder_wrapper_tr").html(html);
            })
           .catch(error => {})
        }
    });
}); 

$(document).on('keyup', '.projectabtractclass', function(e) {
    $('#projectabtracttextlength').html((90-ThaiWord.countCharTh($(this).val())));
});

$(document).on('keyup', '#projectabtract_input', function(e) {
    if (e.keyCode === 13) {
        var html = `<input type="text" name ="projectabtract[]" value="${$(this).val()}" class="form-control projectabtractclass" style="border: 0" >`;
        $(this).val('');
        $('#fulltbp_projectabtract_wrapper').append(html);
    }
});

$(document).on('click', '#btnaddprojectabtract', function(e) {
    var lines = $('input[name="projectabtract[]"]').map(function(){ 
        return this.value; 
    }).get();
    Project.addAbtract(lines,$(this).data('id')).then(data => {
        console.log(data);
        Swal.fire({
            title: 'สำเร็จ...',
            text: 'เพิ่มบทคัดย่อสำเร็จ!',
            });
    })
    .catch(error => {})
});

$(document).on('keyup', '.mainproductclass', function(e) {
    $('#mainproducttextlength').html((90-ThaiWord.countCharTh($(this).val())));
});

$(document).on('keyup', '#mainproduct_input', function(e) {
    if (e.keyCode === 13) {
        var html = `<input type="text" name ="mainproduct[]" value="${$(this).val()}" class="form-control mainproductclass" style="border: 0" >`;
        $(this).val('');
        $('#fulltbp_mainproduct_wrapper').append(html);
    }
});

$(document).on('click', '#btnaddmainproduct', function(e) {
    var lines = $('input[name="mainproduct[]"]').map(function(){ 
        return this.value; 
    }).get();
    Project.addProduct(lines,$(this).data('id')).then(data => {
        console.log(data);
        Swal.fire({
            title: 'สำเร็จ...',
            text: 'เพิ่มรายละเอียดผลิตภัณฑ์สำเร็จ!',
            });
    })
    .catch(error => {})
});

$(document).on('keyup', '.productdetailsclass', function(e) {
    $('#productdetailstextlength').html((90-ThaiWord.countCharTh($(this).val())));
});

$(document).on('keyup', '#productdetails_input', function(e) {
    if (e.keyCode === 13) {
        var html = `<input type="text" name ="productdetails[]" value="${$(this).val()}" class="form-control productdetailsclass" style="border: 0" >`;
        $(this).val('');
        $('#fulltbp_productdetails_wrapper').append(html);
    }
});

$(document).on('click', '#btnaddproductdetails', function(e) {
    var lines = $('input[name="productdetails[]"]').map(function(){ 
        return this.value; 
    }).get();
    Project.addProductDetail(lines,$(this).data('id')).then(data => {
        console.log(data);
        Swal.fire({
            title: 'สำเร็จ...',
            text: 'เพิ่มจุดเด่นผลิตภัณฑ์สำเร็จ!',
            });
    })
    .catch(error => {})
});

$(document).on('keyup', '.projectechdevclass', function(e) {
    $('#projectechdevtextlength').html((90-ThaiWord.countCharTh($(this).val())));
});

$(document).on('keyup', '#projectechdev_input', function(e) {
    if (e.keyCode === 13) {
        var html = `<input type="text" name ="projectechdev[]" value="${$(this).val()}" class="form-control projectechdevclass" style="border: 0" >`;
        $(this).val('');
        $('#fulltbp_projectechdev_wrapper').append(html);
    }
});

$(document).on('click', '#btnaddprojectechdev', function(e) {
    var lines = $('input[name="projectechdev[]"]').map(function(){ 
        return this.value; 
    }).get();
    Project.addTechDev(lines,$(this).data('id')).then(data => {
        console.log(data);
        Swal.fire({
            title: 'สำเร็จ...',
            text: 'เพิ่มการพัฒนาเทคโนโลยีสำเร็จ!',
            });
    })
    .catch(error => {})
});

$(document).on('click', '#btn_modal_add_tectdevlevel', function(e) {
    console.log($(this).data('id'));
    Project.addTechDevLevel($(this).data('id'),$('#tectdevleveltechnology').val(),$('#tectdevleveltechnologypresent').val(),$('#tectdevleveltechnologyproject').val()).then(data => {
        console.log(data);
        var html = ``;
        data.forEach(function (techdevlevel,index) {
            html += `<tr >                                        
                <td> ${techdevlevel.technology} </td>                                            
                <td> ${techdevlevel.presenttechnology} </td> 
                <td> ${techdevlevel.projecttechnology} </td>                                            
                <td> 
                <a type="button" data-id="${techdevlevel.id}" class="btn badge bg-warning deleteprojectechdevlevel">ลบ</a>  </td> 
            </tr>`
            });
         $("#fulltbp_projectechdevlevel_wrapper_tr").html(html);
    })
    .catch(error => {})
});

$(document).on("click",".deleteprojectechdevlevel",function(e){
    console.log($(this).data('id'));
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
            Project.deleteTechDevLevel($(this).data('id')).then(data => {
                var html = ``;
                data.forEach(function (techdevlevel,index) {
                    html += `<tr >                                        
                        <td> ${techdevlevel.technology} </td>                                            
                        <td> ${techdevlevel.presenttechnology} </td> 
                        <td> ${techdevlevel.projecttechnology} </td>                                            
                        <td> 
                        <a type="button" data-id="${techdevlevel.id}" class="btn badge bg-warning deleteprojectechdevlevel">ลบ</a>  </td> 
                    </tr>`
                    });
                 $("#fulltbp_projectechdevlevel_wrapper_tr").html(html);
            })
           .catch(error => {})
        }
    });
}); 

$(document).on('keyup', '.projectechdevproblemclass', function(e) {
    $('#projectechdevproblemtextlength').html((90-ThaiWord.countCharTh($(this).val())));
});

$(document).on('keyup', '#projectechdevproblem_input', function(e) {
    if (e.keyCode === 13) {
        var html = `<input type="text" name ="projectechdevproblem[]" value="${$(this).val()}" class="form-control projectechdevproblemclass" style="border: 0" >`;
        $(this).val('');
        $('#fulltbp_projectechdevproblem_wrapper').append(html);
    }
});

$(document).on('click', '#btnaddprojectechdevproblem', function(e) {
    var lines = $('input[name="projectechdevproblem[]"]').map(function(){ 
        return this.value; 
    }).get();
    Project.addTechDevProblem(lines,$(this).data('id')).then(data => {
        console.log(data);
        Swal.fire({
            title: 'สำเร็จ...',
            text: 'เพิ่มปัญหาและอุปสรรคสำเร็จ!',
            });
    })
    .catch(error => {})
});

$("#cer1").on('change', function() {
    if($(this).is(":checked")){
        $("#cer1qtydiv").attr("hidden",false);
    }else{
        $("#cer1qtydiv").attr("hidden",true);
    }
});
$("#cer2").on('change', function() {
    if($(this).is(":checked")){
        $("#cer2qtydiv").attr("hidden",false);
    }else{
        $("#cer2qtydiv").attr("hidden",true);
    }
});
$("#cer3").on('change', function() {
    if($(this).is(":checked")){
        $("#cer3qtydiv").attr("hidden",false);
    }else{
        $("#cer3qtydiv").attr("hidden",true);
    }
});
$("#cer4").on('change', function() {
    if($(this).is(":checked")){
        $("#cer4qtydiv").attr("hidden",false);
    }else{
        $("#cer4qtydiv").attr("hidden",true);
    }
});
$("#cer5").on('change', function() {
    if($(this).is(":checked")){
        $("#cer5qtydiv").attr("hidden",false);
    }else{
        $("#cer5qtydiv").attr("hidden",true);
    }
});
$("#cer6").on('change', function() {
    if($(this).is(":checked")){
        $("#cer6qtydiv").attr("hidden",false);
    }else{
        $("#cer6qtydiv").attr("hidden",true);
    }
});
$("#cer7").on('change', function() {
    if($(this).is(":checked")){
        $("#cer7qtydiv").attr("hidden",false);
    }else{
        $("#cer7qtydiv").attr("hidden",true);
    }
});
$("#cer8").on('change', function() {
    if($(this).is(":checked")){
        $("#cer8qtydiv").attr("hidden",false);
    }else{
        $("#cer8qtydiv").attr("hidden",true);
    }
});
$("#cer9").on('change', function() {
    if($(this).is(":checked")){
        $("#cer9qtydiv").attr("hidden",false);
    }else{
        $("#cer9qtydiv").attr("hidden",true);
    }
});
$("#cer11").on('change', function() {
    if($(this).is(":checked")){
        $("#cer11qtydiv").attr("hidden",false);
    }else{
        $("#cer11qtydiv").attr("hidden",true);
    }
});



$(document).on('click', '#btnaddprojectcertify', function(e) {
    Project.editProjectCertify($(this).data('id'),$('#cer1').is(':checked'),$('#cer1qty').val(),$('#cer2').is(':checked'),$('#cer2qty').val(),$('#cer3').is(':checked'),$('#cer3qty').val(),$('#cer4').is(':checked'),$('#cer4qty').val(),$('#cer5').is(':checked'),$('#cer5qty').val(),$('#cer6').is(':checked'),$('#cer6qty').val(),$('#cer7').is(':checked'),$('#cer7qty').val(),$('#cer8').is(':checked'),$('#cer8qty').val(),$('#cer9').is(':checked'),$('#cer9qty').val(),$('#cer10').is(':checked'),$('#cer11').is(':checked'),$('#cer11qty').val()).then(data => {
        console.log(data);
        Swal.fire({
            title: 'สำเร็จ...',
            text: 'อัพเดทสำเร็จ!',
            });
    })
    .catch(error => {})
});

$("#certify").on('change', function() {
    var file = this.files[0];
    if (this.files[0].size/1024/1024*1000 > 1000 ){
        alert('ไฟล์ขนาดมากกว่า 1 MB');
        return ;
    }
    var formData = new FormData();
    formData.append('file',file);
    formData.append('id',$(this).data('id'));
        $.ajax({
            url: `${route.url}/api/fulltbp/project/projectcertify/upload/add`,  //Server script to process data
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
                            <a href="${route.url}/${attachment.path}" class=" badge bg-primary">ดาวน์โหลด</a>
                            <a type="button" data-id="${attachment.id}" data-name="" class="btn badge bg-danger deletefulltbpcertifyattachment">ลบ</a>                                       
                        </td>
                    </tr>`
                    });
                 $("#fulltbp_certify_wrapper_tr").html(html);
        }
    });
});

$(document).on("click",".deletefulltbpcertifyattachment",function(e){
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
            Project.deleteCertifyAttachement($(this).data('id')).then(data => {
                var html = ``;
                // console.log(data);
                data.forEach(function (attachment,index) {
                    html += `<tr >                                        
                        <td> ${attachment.name} </td>                                            
                        <td> 
                            <a href="${route.url}/${attachment.path}" class=" badge bg-primary">ดาวน์โหลด</a>
                            <a type="button" data-id="${attachment.id}" data-name="" class="btn badge bg-danger deletefulltbpcertifyattachment">ลบ</a>                                       
                        </td>
                    </tr>`
                    });
                 $("#fulltbp_certify_wrapper_tr").html(html);
           })
           .catch(error => {})
        }
    });
}); 

$("#award").on('change', function() {
    var file = this.files[0];
    if (this.files[0].size/1024/1024*1000 > 1000 ){
        alert('ไฟล์ขนาดมากกว่า 1 MB');
        return ;
    }
    var formData = new FormData();
    formData.append('file',file);
    formData.append('id',$(this).data('id'));
    formData.append('awardname',$('#awardname').val());
        $.ajax({
            url: `${route.url}/api/fulltbp/project/projectaward/add`,  //Server script to process data
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
                            <a href="${route.url}/${attachment.path}" class=" badge bg-primary">ดาวน์โหลด</a>
                            <a type="button" data-id="${attachment.id}" data-name="" class="btn badge bg-danger deletefulltbpawardattachment">ลบ</a>                                       
                        </td>
                    </tr>`
                    });
                 $("#fulltbp_award_wrapper_tr").html(html);
                 $('#modal_add_award').modal('hide');
        }
    });
});

$(document).on("click",".deletefulltbpawardattachment",function(e){
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
            Project.deleteAwardAttachement($(this).data('id')).then(data => {
                var html = ``;
                data.forEach(function (attachment,index) {
                    html += `<tr >                                        
                        <td> ${attachment.name} </td>                                            
                        <td> 
                            <a href="${route.url}/${attachment.path}" class=" badge bg-primary">ดาวน์โหลด</a>
                            <a type="button" data-id="${attachment.id}" data-name="" class="btn badge bg-danger deletefulltbpawardattachment">ลบ</a>                                       
                        </td>
                    </tr>`
                    });
                 $("#fulltbp_award_wrapper_tr").html(html);
           })
           .catch(error => {})
        }
    });
}); 

$("#standard").on('change', function() {
    var file = this.files[0];
    if (this.files[0].size/1024/1024*1000 > 1000 ){
        alert('ไฟล์ขนาดมากกว่า 1 MB');
        return ;
    }
    var formData = new FormData();
    formData.append('file',file);
    formData.append('id',$(this).data('id'));
    formData.append('standardname',$('#standardname').val());
        $.ajax({
            url: `${route.url}/api/fulltbp/project/standard/add`,  //Server script to process data
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
                            <a href="${route.url}/${attachment.path}" class=" badge bg-primary">ดาวน์โหลด</a>
                            <a type="button" data-id="${attachment.id}" data-name="" class="btn badge bg-danger deletefulltbpstandardattachment">ลบ</a>                                       
                        </td>
                    </tr>`
                    });
                 $("#fulltbp_standard_wrapper_tr").html(html);
                 $('#modal_add_standard').modal('hide');
        }
    });
});

$(document).on("click",".deletefulltbpstandardattachment",function(e){
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
            Project.deleteStandardAttachement($(this).data('id')).then(data => {
                var html = ``;
                data.forEach(function (attachment,index) {
                    html += `<tr >                                        
                        <td> ${attachment.name} </td>                                            
                        <td> 
                            <a href="${route.url}/${attachment.path}" class=" badge bg-primary">ดาวน์โหลด</a>
                            <a type="button" data-id="${attachment.id}" data-name="" class="btn badge bg-danger deletefulltbpstandardattachment">ลบ</a>                                       
                        </td>
                    </tr>`
                    });
                 $("#fulltbp_standard_wrapper_tr").html(html);
           })
           .catch(error => {})
        }
    });
}); 
