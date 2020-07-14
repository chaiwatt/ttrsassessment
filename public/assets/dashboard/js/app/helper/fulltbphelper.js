import * as ThaiWord from './thaiword.js';
import * as CompanyProfile from './companyprofile.js';
import * as CompanyProfileAttachment from './companyprofileattachment.js';
import * as Employ from './employ.js';
import * as StockHolder from './stockholder.js';
import * as Project from './project.js';
import * as Market from './market.js';
import * as Sell from './sell.js';

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

$(document).on('click', '#btn_modal_add_projectplan', function(e) {
    var data = [];
    $('.checkboxplan:checked').each(function(){
        data.push($(this).val());
      })
      Project.addPlan($(this).data('id'),$('#plandetail').val(),data).then(data => {
        var html = ``;
        data.fulltbpprojecplans.forEach(function (plan,index) {
            var tdbody =``;
            for (var k = 1; k <= 12; k++) {
                if(data.fulltbpprojectplantransactions.findIndex(x => x.month == k && x.project_plan_id == plan.id) != -1){
                    tdbody += `<td style="background-color:grey"></td>`;
                }else{
                    tdbody += `<td style="background-color:white"></td>`;
                } 
            }
            html += `<tr >                                        
                <td> ${plan.name} </td>                                            
                    ${tdbody}
                <td> 
                <a type="button" data-id="${plan.id}" class="btn badge bg-info editprojectplan">แก้ไข</a>
                    <a type="button" data-id="${plan.id}" data-name="" class="btn badge bg-warning deleteprojectplan">ลบ</a>                                       
                </td>
            </tr>`
            });
         $("#fulltbp_projectplan_wrapper_tr").html(html);
   })
});

$(document).on('click', '.editprojectplan', function(e) {
    $('#projectplan').val($(this).data('id'));
    Project.getPlan($(this).data('id')).then(data => {
        $('#plandetail_edit').val(data.fulltbpprojecplan['name']);
        var html = ``;
        for (var k = 1; k <= 12; k++) {
            var check = ``;
            if(data.fulltbpprojectplantransactions.findIndex(x => x.month == k) != -1){
                var check = `checked`;
            }
                html += `<div class="custom-control custom-checkbox custom-control-inline">
                        <input type="checkbox" name="plans[]" value="${k}" class="custom-control-input checkboxplane_dit" id="checkboxedit${k}" ${check} >
                        <label class="custom-control-label" for="checkboxedit${k}">${k}</label>
                    </div>`
        }
         $("#monthplan").html(html);
    })
    .catch(error => {})
    $('#modal_edit_projectplan').modal('show');
});

$(document).on('click', '#btn_modal_edit_projectplan', function(e) {
    var data = [];
    $('.checkboxplane_dit:checked').each(function(){
        data.push($(this).val());
      })
    Project.editPlan($('#projectplan').val(),$('#plandetail_edit').val(),data).then(data => {
        console.log(data);
        var html = ``;
        data.fulltbpprojecplans.forEach(function (plan,index) {
            var tdbody =``;
            for (var k = 1; k <= 12; k++) {
                if(data.fulltbpprojectplantransactions.findIndex(x => x.month == k && x.project_plan_id == plan.id) != -1){
                    tdbody += `<td style="background-color:grey"></td>`;
                }else{
                    tdbody += `<td style="background-color:white"></td>`;
                } 
            }
            html += `<tr >                                        
                <td> ${plan.name} </td>                                            
                    ${tdbody}
                <td> 
                <a type="button" data-id="${plan.id}" class="btn badge bg-info editprojectplan">แก้ไข</a>
                    <a type="button" data-id="${plan.id}" data-name="" class="btn badge bg-warning deleteprojectplan">ลบ</a>                                       
                </td>
            </tr>`
            });
         $("#fulltbp_projectplan_wrapper_tr").html(html);
    })
    .catch(error => {})
});
            
$(document).on("click",".deleteprojectplan",function(e){
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
            Project.deletePlan($(this).data('id')).then(data => {
                
                var html = ``;
                data.fulltbpprojecplans.forEach(function (plan,index) {
                    var tdbody =``;
                    for (var k = 1; k <= 12; k++) {
                        if(data.fulltbpprojectplantransactions.findIndex(x => x.month == k && x.project_plan_id == plan.id) != -1){
                            tdbody += `<td style="background-color:grey"></td>`;
                        }else{
                            tdbody += `<td style="background-color:white"></td>`;
                        } 
                    }
                    html += `<tr >                                        
                        <td> ${plan.name} </td>                                            
                            ${tdbody}
                        <td> 
                        <a type="button" data-id="${plan.id}" class="btn badge bg-info editprojectplan">แก้ไข</a>
                            <a type="button" data-id="${plan.id}" data-name="" class="btn badge bg-warning deleteprojectplan">ลบ</a>                                       
                        </td>
                    </tr>`
                    });
                 $("#fulltbp_projectplan_wrapper_tr").html(html);
           })
           .catch(error => {})
        }
    });
}); 

$(document).on('keyup', '.marketneedclass', function(e) {
    $('#marketneedtextlength').html((90-ThaiWord.countCharTh($(this).val())));
});

$(document).on('keyup', '#marketneed_input', function(e) {
    if (e.keyCode === 13) {
        var html = `<input type="text" name ="marketneed[]" value="${$(this).val()}" class="form-control marketneedclass" style="border: 0" >`;
        $(this).val('');
        $('#fulltbp_marketneed_wrapper').append(html);
    }
});

$(document).on('click', '#btnaddmarketneed', function(e) {
    var lines = $('input[name="marketneed[]"]').map(function(){ 
        return this.value; 
    }).get();
    Market.addNeed(lines,$(this).data('id')).then(data => {
        console.log(data);
        Swal.fire({
            title: 'สำเร็จ...',
            text: 'เพิ่ม Market need สำเร็จ!',
            });
    })
    .catch(error => {})
});

$(document).on('keyup', '.marketsizeclass', function(e) {
    $('#marketsizetextlength').html((90-ThaiWord.countCharTh($(this).val())));
});

$(document).on('keyup', '#marketsize_input', function(e) {
    if (e.keyCode === 13) {
        var html = `<input type="text" name ="marketsize[]" value="${$(this).val()}" class="form-control marketsizeclass" style="border: 0" >`;
        $(this).val('');
        $('#fulltbp_marketsize_wrapper').append(html);
    }
});

$(document).on('click', '#btnaddmarketsize', function(e) {
    var lines = $('input[name="marketsize[]"]').map(function(){ 
        return this.value; 
    }).get();
    Market.addSize(lines,$(this).data('id')).then(data => {
        console.log(data);
        Swal.fire({
            title: 'สำเร็จ...',
            text: 'เพิ่ม Market size สำเร็จ!',
            });
    })
    .catch(error => {})
});

$(document).on('keyup', '.marketshareclass', function(e) {
    $('#marketsharetextlength').html((90-ThaiWord.countCharTh($(this).val())));
});

$(document).on('keyup', '#marketshare_input', function(e) {
    if (e.keyCode === 13) {
        var html = `<input type="text" name ="marketshare[]" value="${$(this).val()}" class="form-control marketshareclass" style="border: 0" >`;
        $(this).val('');
        $('#fulltbp_marketshare_wrapper').append(html);
    }
});

$(document).on('click', '#btnaddmarketshare', function(e) {
    var lines = $('input[name="marketshare[]"]').map(function(){ 
        return this.value; 
    }).get();
    Market.addShare(lines,$(this).data('id')).then(data => {
        console.log(data);
        Swal.fire({
            title: 'สำเร็จ...',
            text: 'เพิ่ม Market share สำเร็จ!',
            });
    })
    .catch(error => {})
});

$(document).on('keyup', '.marketcompetitiveclass', function(e) {
    $('#marketcompetitivetextlength').html((90-ThaiWord.countCharTh($(this).val())));
});

$(document).on('keyup', '#marketcompetitive_input', function(e) {
    if (e.keyCode === 13) {
        var html = `<input type="text" name ="marketcompetitive[]" value="${$(this).val()}" class="form-control marketcompetitiveclass" style="border: 0" >`;
        $(this).val('');
        $('#fulltbp_marketcompetitive_wrapper').append(html);
    }
});

$(document).on('click', '#btnaddmarketcompetitive', function(e) {
    var lines = $('input[name="marketcompetitive[]"]').map(function(){ 
        return this.value; 
    }).get();
    Market.addCompetitive(lines,$(this).data('id')).then(data => {
        console.log(data);
        Swal.fire({
            title: 'สำเร็จ...',
            text: 'เพิ่ม Market competitive สำเร็จ!',
            });
    })
    .catch(error => {})
});

$("#businessmodelcanvas").on('change', function() {
    console.log($(this).data('id'));

    var file = this.files[0];

    if (this.files[0].size/1024/1024*1000 > 1000 ){
        alert('ไฟล์ขนาดมากกว่า 1 MB');
        return ;
    }
    var formData = new FormData();
    formData.append('file',file);
    formData.append('id',$(this).data('id'));
    formData.append('attachmenttype','1');
        $.ajax({
            url: `${route.url}/api/fulltbp/market/attachment/add`,  //Server script to process data
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
                            <a type="button" data-id="${attachment.id}" data-name="" class="btn badge bg-danger deletefulltbpmodelcanvasattachment">ลบ</a>                                       
                        </td>
                    </tr>`
                    });
                 $("#fulltbp_businessmodelcanvas_wrapper_tr").html(html);
        }
    });

});


$(document).on("click",".deletefulltbpmodelcanvasattachment",function(e){
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
            Market.deleteMarketAttachment($(this).data('id'),'1').then(data => {
                console.log(data);
                var html = ``;
                data.forEach(function (attachment,index) {
                    html += `<tr >                                        
                        <td> ${attachment.name} </td>                                            
                        <td> 
                            <a href="${route.url}/${attachment.path}" class=" badge bg-primary">ดาวน์โหลด</a>
                            <a type="button" data-id="${attachment.id}" data-name="" class="btn badge bg-danger deletefulltbpmodelcanvasattachment">ลบ</a>                                       
                        </td>
                    </tr>`
                    });
                 $("#fulltbp_businessmodelcanvas_wrapper_tr").html(html);
           })
           .catch(error => {})
        }
    });
}); 

$("#swot").on('change', function() {
    console.log($(this).data('id'));

    var file = this.files[0];

    if (this.files[0].size/1024/1024*1000 > 1000 ){
        alert('ไฟล์ขนาดมากกว่า 1 MB');
        return ;
    }
    var formData = new FormData();
    formData.append('file',file);
    formData.append('id',$(this).data('id'));
    formData.append('attachmenttype','2');
        $.ajax({
            url: `${route.url}/api/fulltbp/market/attachment/add`,  //Server script to process data
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
                            <a type="button" data-id="${attachment.id}" data-name="" class="btn badge bg-danger deletefulltbpswotattachment">ลบ</a>                                       
                        </td>
                    </tr>`
                    });
                 $("#fulltbp_swot_wrapper_tr").html(html);
        }
    });

});

$(document).on("click",".deletefulltbpswotattachment",function(e){
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
            Market.deleteMarketAttachment($(this).data('id'),'2').then(data => {
                console.log(data);
                var html = ``;
                data.forEach(function (attachment,index) {
                    html += `<tr >                                        
                        <td> ${attachment.name} </td>                                            
                        <td> 
                            <a href="${route.url}/${attachment.path}" class=" badge bg-primary">ดาวน์โหลด</a>
                            <a type="button" data-id="${attachment.id}" data-name="" class="btn badge bg-danger deletefulltbpswotattachment">ลบ</a>                                       
                        </td>
                    </tr>`
                    });
                 $("#fulltbp_swot_wrapper_tr").html(html);
           })
           .catch(error => {})
        }
    });
});

$("#financialplan").on('change', function() {
    console.log($(this).data('id'));

    var file = this.files[0];

    if (this.files[0].size/1024/1024*1000 > 1000 ){
        alert('ไฟล์ขนาดมากกว่า 1 MB');
        return ;
    }
    var formData = new FormData();
    formData.append('file',file);
    formData.append('id',$(this).data('id'));
    formData.append('attachmenttype','3');
        $.ajax({
            url: `${route.url}/api/fulltbp/market/attachment/add`,  //Server script to process data
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
                            <a type="button" data-id="${attachment.id}" data-name="" class="btn badge bg-danger deletefulltbpfinancialplanattachment">ลบ</a>                                       
                        </td>
                    </tr>`
                    });
                 $("#fulltbp_financialplan_wrapper_tr").html(html);
        }
    });

});

$(document).on("click",".deletefulltbpfinancialplanattachment",function(e){
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
            Market.deleteMarketAttachment($(this).data('id'),'3').then(data => {
                console.log(data);
                var html = ``;
                data.forEach(function (attachment,index) {
                    html += `<tr >                                        
                        <td> ${attachment.name} </td>                                            
                        <td> 
                            <a href="${route.url}/${attachment.path}" class=" badge bg-primary">ดาวน์โหลด</a>
                            <a type="button" data-id="${attachment.id}" data-name="" class="btn badge bg-danger deletefulltbpfinancialplanattachment">ลบ</a>                                       
                        </td>
                    </tr>`
                    });
                 $("#fulltbp_financialplan_wrapper_tr").html(html);
           })
           .catch(error => {})
        }
    });
});

$(document).on('click', '#btn_modal_add_sell', function(e) {
    Sell.addSell($(this).data('id'),$('#productname').val(),$('#sellpresent').val(),$('#sellpast1').val(),$('#sellpast2').val(),$('#sellpast3').val()).then(data => {
        var html = ``;
        data.forEach(function (sell,index) {
            html += `<tr >                                        
                <td> ${sell.name} </td>                            
                <td> ${sell.present} </td>                         
                <td> ${sell.past1} </td> 
                <td> ${sell.past2} </td> 
                <td> ${sell.past3} </td> 
                <td> 
                    <a type="button" data-id="${sell.id}" class="btn badge bg-info editsell">แก้ไข</a> 
                    <a type="button" data-id="${sell.id}" class="btn badge bg-warning deletesell">ลบ</a>
                </td> 
            </tr>`
            });
         $("#fulltbp_sell_wrapper_tr").html(html);
    })
    .catch(error => {})
});

$(document).on("click",".deletesell",function(e){
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
            Sell.deleteSell($(this).data('id')).then(data => {
             
                var html = ``;
                data.forEach(function (sell,index) {
                    html += `<tr >                                        
                        <td> ${sell.name} </td>                            
                        <td> ${sell.present} </td>                         
                        <td> ${sell.past1} </td> 
                        <td> ${sell.past2} </td> 
                        <td> ${sell.past3} </td> 
                        <td> 
                            <a type="button" data-id="${sell.id}" class="btn badge bg-info editsell">แก้ไข</a> 
                            <a type="button" data-id="${sell.id}" class="btn badge bg-warning deletesell">ลบ</a>
                        </td> 
                    </tr>`
                    });
                 $("#fulltbp_sell_wrapper_tr").html(html);
           })
           .catch(error => {})
        }
    });
});

$(document).on('click', '.editsell', function(e) {
    Sell.getSell($(this).data('id')).then(data => {
        $('#sellid').val(data.id);
        $('#productnameedit').val(data.name);
        $('#sellpresentedit').val(data.present);
        $('#sellpastedit1').val(data.past1);
        $('#sellpastedit2').val(data.past2);
        $('#sellpastedit3').val(data.past3);
    })
    .catch(error => {})
    $('#modal_edit_sell').modal('show');
});

$(document).on('click', '#btn_modal_edit_sell', function(e) {
    Sell.editSell($('#sellid').val(),$('#productnameedit').val(),$('#sellpresentedit').val(),$('#sellpastedit1').val(),$('#sellpastedit2').val(),$('#sellpastedit3').val()).then(data => {
        var html = ``;
        data.forEach(function (sell,index) {
            html += `<tr >                                        
                <td> ${sell.name} </td>    
                <td> ${sell.present} </td>                         
                <td> ${sell.past1} </td> 
                <td> ${sell.past2} </td> 
                <td> ${sell.past3} </td>                                            
                <td> 
                    <a type="button" data-id="${sell.id}" class="btn badge bg-info editsell">แก้ไข</a> 
                    <a type="button" data-id="${sell.id}" class="btn badge bg-warning deletesell">ลบ</a>
                </td> 
            </tr>`
            });
         $("#fulltbp_sell_wrapper_tr").html(html);
    })
    .catch(error => {})
});

$(document).on('click', '.editsellstatus', function(e) {
    Sell.getSellStatus($(this).data('id')).then(data => {
        $('#sellstatusid').val(data.id);
        $('#sellstatus').val(data.name);
        $('#sellstatuspresentedit').val(data.present);
        $('#sellstatuspastedit1').val(data.past1);
        $('#sellstatuspastedit2').val(data.past2);
        $('#sellstatuspastedit3').val(data.past3);
    })
    .catch(error => {})
    $('#modal_edit_sellstatus').modal('show');
});

$(document).on('click', '#btn_modal_edit_sellstatus', function(e) {
    Sell.editSellStatus($('#sellstatusid').val(),$('#sellstatuspresentedit').val(),$('#sellstatuspastedit1').val(),$('#sellstatuspastedit2').val(),$('#sellstatuspastedit3').val()).then(data => {
        var html = ``;
        data.forEach(function (sell,index) {
            html += `<tr >                                        
                <td> ${sell.name} </td>    
                <td> ${sell.present} </td>                         
                <td> ${sell.past1} </td> 
                <td> ${sell.past2} </td> 
                <td> ${sell.past3} </td>                                            
                <td> 
                    <a type="button" data-id="${sell.id}" class="btn badge bg-info editsellstatus">แก้ไข</a> 
                </td> 
            </tr>`
            });
         $("#fulltbp_sellstatus_wrapper_tr").html(html);
    })
    .catch(error => {})
});

$(document).on('click', '#btn_modal_add_debtpartner', function(e) {
    Sell.addDebtPartner($(this).data('id'),$('#debtpartner').val(),$('#numproject').val(),$('#debtpartnertaxid').val(),$('#debttotalyearsell').val(),$('#debtpercenttosale').val(),$('#debtpartneryear').val()).then(data => {
        var html = ``;
        data.forEach(function (sell,index) {
            html += `<tr >                                        
                <td> ${sell.debtpartner} </td>                            
                <td> ${sell.numproject} </td>  
                <td> ${sell.partnertaxid} </td>                         
                <td> ${sell.totalyearsell} </td> 
                <td> ${sell.percenttosale} </td> 
                <td> ${sell.businessyear} </td> 
                <td> 
                    <a type="button" data-id="${sell.id}" class="btn badge bg-info editdebtpartner">แก้ไข</a> 
                    <a type="button" data-id="${sell.id}" class="btn badge bg-warning deletedebtpartner">ลบ</a>
                </td> 
            </tr>`
            });
         $("#fulltbp_debtpartner_wrapper_tr").html(html);
    })
    .catch(error => {})
});

$(document).on('click', '.editdebtpartner', function(e) {
    Sell.getDebtPartner($(this).data('id')).then(data => {
        $('#debtpartnerid').val(data.id);
        $('#debtpartneredit').val(data.debtpartner);
        $('#numprojectedit').val(data.numproject);
        $('#debtpartnertaxidedit').val(data.partnertaxid);
        $('#debttotalyearselledit').val(data.totalyearsell);
        $('#debtpercenttosaleedit').val(data.percenttosale);
        $('#debtpartneryearedit').val(data.businessyear);
    })
    .catch(error => {})
    $('#modal_edit_debtpartner').modal('show');
});

$(document).on('click', '#btn_modal_edit_debtpartner', function(e) {
    Sell.editDebtPartner($('#debtpartnerid').val(),$('#debtpartneredit').val(),$('#numprojectedit').val(),$('#debtpartnertaxidedit').val(),$('#debttotalyearselledit').val(),$('#debtpercenttosaleedit').val(),$('#debtpartneryearedit').val()).then(data => {
        var html = ``;
        data.forEach(function (sell,index) {
            html += `<tr >                                        
                <td> ${sell.debtpartner} </td>                            
                <td> ${sell.numproject} </td>  
                <td> ${sell.partnertaxid} </td>                         
                <td> ${sell.totalyearsell} </td> 
                <td> ${sell.percenttosale} </td> 
                <td> ${sell.businessyear} </td> 
                <td> 
                    <a type="button" data-id="${sell.id}" class="btn badge bg-info editdebtpartner">แก้ไข</a> 
                    <a type="button" data-id="${sell.id}" class="btn badge bg-warning deletedebtpartner">ลบ</a>
                </td> 
            </tr>`
            });
         $("#fulltbp_debtpartner_wrapper_tr").html(html);
    })
    .catch(error => {})
});

$(document).on("click",".deletedebtpartner",function(e){
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
            Sell.deleteDebtPartner($(this).data('id')).then(data => {
                var html = ``;
                data.forEach(function (sell,index) {
                    html += `<tr >                                        
                        <td> ${sell.debtpartner} </td>
                        <td> ${sell.numproject} </td>
                        <td> ${sell.partnertaxid} </td>
                        <td> ${sell.totalyearsell} </td>
                        <td> ${sell.percenttosale} </td>
                        <td> ${sell.businessyear} </td>
                        <td> 
                            <a type="button" data-id="${sell.id}" class="btn badge bg-info editdebtpartner">แก้ไข</a> 
                            <a type="button" data-id="${sell.id}" class="btn badge bg-warning deletedebtpartner">ลบ</a>
                        </td> 
                    </tr>`
                    });
                 $("#fulltbp_debtpartner_wrapper_tr").html(html);
           })
           .catch(error => {})
        }
    });
});

$(document).on('click', '#btn_modal_add_creditpartner', function(e) {
    Sell.addCreditPartner($(this).data('id'),$('#creditpartner').val(),$('#creditpartnertaxid').val(),$('#credittotalyearsell').val(),$('#creditpercenttosale').val(),$('#creditpartneryear').val()).then(data => {
        var html = ``;
        data.forEach(function (sell,index) {
            html += `<tr >                                        
                <td> ${sell.creditpartner} </td>                            
                <td> ${sell.partnertaxid} </td>  
                <td> ${sell.totalyearpurchase} </td>                         
                <td> ${sell.percenttopurchase} </td> 
                <td> ${sell.businessyear} </td> 
                <td> 
                    <a type="button" data-id="${sell.id}" class="btn badge bg-info editcreditpartner">แก้ไข</a> 
                    <a type="button" data-id="${sell.id}" class="btn badge bg-warning deletecreditpartner">ลบ</a>
                </td> 
            </tr>`
            });
         $("#fulltbp_creditpartner_wrapper_tr").html(html);
    })
    .catch(error => {})
});

$(document).on('click', '.editcreditpartner', function(e) {
    Sell.getCreditPartner($(this).data('id')).then(data => {
        $('#creditpartnerid').val(data.id);
        $('#creditpartneredit').val(data.creditpartner);
        $('#creditpartnertaxidedit').val(data.partnertaxid);
        $('#credittotalyearselledit').val(data.totalyearpurchase);
        $('#creditpercenttosaleedit').val(data.percenttopurchase);
        $('#creditpartneryearedit').val(data.businessyear);
    })
    .catch(error => {})
    $('#modal_edit_creditpartner').modal('show');
});

$(document).on('click', '#btn_modal_edit_creditpartner', function(e) {
    Sell.editCreditPartner($('#creditpartnerid').val(),$('#creditpartneredit').val(),$('#creditpartnertaxidedit').val(),$('#credittotalyearselledit').val(),$('#creditpercenttosaleedit').val(),$('#creditpartneryearedit').val()).then(data => {
        var html = ``;
        data.forEach(function (sell,index) {
            html += `<tr >                                        
                <td> ${sell.creditpartner} </td>                            
                <td> ${sell.partnertaxid} </td>  
                <td> ${sell.totalyearpurchase} </td>                         
                <td> ${sell.percenttopurchase} </td> 
                <td> ${sell.businessyear} </td> 
                <td> 
                    <a type="button" data-id="${sell.id}" class="btn badge bg-info editcreditpartner">แก้ไข</a> 
                    <a type="button" data-id="${sell.id}" class="btn badge bg-warning deletecreditpartner">ลบ</a>
                </td> 
            </tr>`
            });
         $("#fulltbp_creditpartner_wrapper_tr").html(html);
    })
    .catch(error => {})
});

$(document).on("click",".deletecreditpartner",function(e){
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
            Sell.deleteCreditPartner($(this).data('id')).then(data => {
                var html = ``;
                data.forEach(function (sell,index) {
                    html += `<tr >                                        
                        <td> ${sell.creditpartner} </td>                            
                        <td> ${sell.partnertaxid} </td>  
                        <td> ${sell.totalyearpurchase} </td>                         
                        <td> ${sell.percenttopurchase} </td> 
                        <td> ${sell.businessyear} </td> 
                        <td> 
                            <a type="button" data-id="${sell.id}" class="btn badge bg-info editcreditpartner">แก้ไข</a> 
                            <a type="button" data-id="${sell.id}" class="btn badge bg-warning deletecreditpartner">ลบ</a>
                        </td> 
                    </tr>`
                    });
                 $("#fulltbp_creditpartner_wrapper_tr").html(html);
           })
           .catch(error => {})
        }
    });
});

$(document).on('click', '.editasset', function(e) {
    Sell.getAsset($(this).data('id')).then(data => {
        $('#assetid').val(data.id);
        $('#asset').val(data.asset);
        $('#assetcostedit').val(data.cost);
        $('#assetquantityedit').val(data.quantity);
        $('#assetpriceedit').val(data.price);
        $('#assetspecificationedit').val(data.specification);
    })
    .catch(error => {})
    $('#modal_edit_asset').modal('show');
});

$(document).on('click', '#btn_modal_edit_asset', function(e) {
    Sell.editAsset($('#assetid').val(),$('#assetcostedit').val(),$('#assetquantityedit').val(),$('#assetpriceedit').val(),$('#assetspecificationedit').val()).then(data => {
        var html = ``;
        data.forEach(function (asset,index) {
            html += `<tr >                                        
                <td> ${asset.asset} </td>                            
                <td> ${asset.cost} </td>  
                <td> ${asset.quantity} </td>                         
                <td> ${asset.price} </td> 
                <td> ${asset.specification} </td> 
                <td> 
                    <a type="button" data-id="${asset.id}" class="btn badge bg-info editasset">แก้ไข</a> 
                </td> 
            </tr>`
            });
         $("#fulltbp_asset_wrapper_tr").html(html);
    })
    .catch(error => {})
});

$(document).on('click', '.editinvestment', function(e) {
    Sell.getInvestment($(this).data('id')).then(data => {
        $('#investmentid').val(data.id);
        $('#investment').val(data.investment);
        $('#investmentcostedit').val(data.cost);
    })
    .catch(error => {})
    $('#modal_edit_investment').modal('show');
});

$(document).on('click', '#btn_modal_edit_investment', function(e) {
    Sell.editInvestment($('#investmentid').val(),$('#investmentcostedit').val()).then(data => {
        var html = ``;
        data.forEach(function (invesment,index) {
            html += `<tr >                                        
                <td> ${invesment.investment} </td>                            
                <td> ${invesment.cost} </td>  
                <td> 
                    <a type="button" data-id="${invesment.id}" class="btn badge bg-info editinvestment">แก้ไข</a> 
                </td> 
            </tr>`
            });
         $("#fulltbp_investment_wrapper_tr").html(html);
    })
    .catch(error => {})
});

$(document).on('click', '.editcost', function(e) {
    Sell.getCost($(this).data('id')).then(data => {
        $('#costid').val(data.id);
        $('#costnameedit').val(data.costname);
        $('#costexistingedit').val(data.existing);
        $('#costneededit').val(data.need);
        $('#costapprovededit').val(data.approved);
        $('#costplanedit').val(data.plan);
    })
    .catch(error => {})
    $('#modal_edit_cost').modal('show');
});

$(document).on('click', '#btn_modal_edit_cost', function(e) {
    Sell.editCost($('#costid').val(),$('#costexistingedit').val(),$('#costneededit').val(),$('#costapprovededit').val(),$('#costplanedit').val()).then(data => {
        var html = ``;
        console.log(data);
        data.forEach(function (cost,index) {
            html += `<tr >                                        
                <td> ${cost.costname} </td>                            
                <td> ${cost.existing} </td>  
                <td> ${cost.need} </td>  
                <td> ${cost.approved} </td>  
                <td> ${cost.plan} </td>
                <td> 
                    <a type="button" data-id="${cost.id}" class="btn badge bg-info editcost">แก้ไข</a> 
                </td> 
            </tr>`
            });
         $("#fulltbp_cost_wrapper_tr").html(html);
    })
    .catch(error => {})
});

$(document).on('click', '#btnaddreturnofinvestment', function(e) {
    Sell.editROI($(this).data('id'),$('#income').val(),$('#profit').val(),$('#reduce').val()).then(data => {
        $('#income').val(data.income);
        $('#profit').val(data.profit);
        $('#reduce').val(data.reduce);
        Swal.fire({
            title: 'สำเร็จ...',
            text: 'แก้ไขประมาณการผลตอบแทนจากการลงทุนสำเร็จ!',
            });
    })
    .catch(error => {})
});

$("#companydoc").on('change', function() {
    var file = this.files[0];
    console.log(file);
    if (this.files[0].size/1024/1024*1000 > 1000 ){
        alert('ไฟล์ขนาดมากกว่า 1 MB');
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
                            <a href="${route.url}/${attachment.path}" class=" badge bg-primary">ดาวน์โหลด</a>
                            <a type="button" data-id="${attachment.id}" data-name="" class="btn badge bg-danger deletefulltbpcompanydocattachment">ลบ</a>                                       
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
                            <a href="${route.url}/${attachment.path}" class=" badge bg-primary">ดาวน์โหลด</a>
                            <a type="button" data-id="${attachment.id}" data-name="" class="btn badge bg-danger deletefulltbpcompanydocattachment">ลบ</a>                                       
                        </td>
                    </tr>`
                    });
                 $("#fulltbp_companydoc_wrapper_tr").html(html);
           })
           .catch(error => {})
        }
    });
});