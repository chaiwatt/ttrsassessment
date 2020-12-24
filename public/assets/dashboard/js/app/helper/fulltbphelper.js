import * as ThaiWord from './thaiword.js';
import * as CompanyProfile from './companyprofile.js';
import * as CompanyProfileAttachment from './companyprofileattachment.js';
import * as Employ from './employ.js';
import * as StockHolder from './stockholder.js';
import * as Project from './project.js';
import * as Market from './market.js';
import * as Sell from './sell.js';
import * as FullTbp from './fulltbp.js';

// $(document).on('keyup', '#companyprofile_input', function(e) {
//     if (e.keyCode === 13) {
//         var html = `<input type="text" name ="companyprofile[]" value="${$(this).val()}" class="form-control companyprofileclass" style="border: 0" >`;
//         $(this).val('');
//         $('#fulltbp_companyprofile_wrapper').append(html);
//     }
// });

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

// $("#attachment").on('change', function() {
// $(document).on('change', '#attachment', function(e) {
//     console.log($(this).data('id'));
//     var file = this.files[0];

//     if (this.files[0].size/1024/1024*1000 > 1000 ){
//         alert('ไฟล์ขนาดมากกว่า 1 MB');
//         return ;
//     }
//     var formData = new FormData();
//     formData.append('file',file);
//     formData.append('id',$(this).data('id'));
//         $.ajax({
//             url: `${route.url}/api/fulltbp/companyprofile/attachement/add`,  //Server script to process data
//             type: 'POST',
//             headers: {"X-CSRF-TOKEN":route.token},
//             data: formData,
//             contentType: false,
//             processData: false,
//             success: function(data){
//                 console.log(data)
//                 var html = ``;
//                 data.forEach(function (attachment,index) {
//                     html += `<tr >                                        
//                         <td> ${attachment.name} </td>                                            
//                         <td> 
//                             <a href="${route.url}/${attachment.path}" class=" btn btn-sm bg-primary">ดาวน์โหลด</a>
//                             <a type="button" data-id="${attachment.id}" data-name="" class="btn btn-sm bg-danger deletefulltbpcompanyprofileattachment">ลบ</a>                                       
//                         </td>
//                     </tr>`
//                     });
//                  $("#fulltbp_companyprofile_attachment_wrapper_tr").html(html);
//         }
//     });

// });

$("#companygeneraldoc").on('change', function() {
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
                            <a href="${route.url}/${attachment.path}" class=" btn btn-sm bg-primary">ดาวน์โหลด</a>
                            <a type="button" data-id="${attachment.id}" data-name="" class="btn btn-sm bg-danger deletefulltbpcompanyprofileattachment">ลบ</a>                                       
                        </td>
                    </tr>`
                    });
                 $("#fulltbp_companyprofile_attachment_wrapper_tr").html(html);
                 $('#modal_add_companydoc').modal('hide');
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
                            <a href="${route.url}/${attachment.path}" class=" btn btn-sm bg-primary">ดาวน์โหลด</a>
                            <a type="button" data-id="${attachment.id}" data-name="" class="btn btn-sm bg-danger deletefulltbpcompanyprofileattachment">ลบ</a>                                       
                        </td>
                    </tr>`
                    });
                 $("#fulltbp_companyprofile_attachment_wrapper_tr").html(html);
           })
           .catch(error => {})
        }
    });
}); 


$(document).on('click', '#btn_edit_employ', function(e) {
    console.log($(this).data('id'));
    Employ.editEmploy($('#employid').val(),$('#employname_edit').val(),$('#employlastname_edit').val(),$('#employposition_edit').val(),$('#employphone_edit').val(),$('#employworkphone_edit').val(),$('#employemail_edit').val()).then(data => {
        console.log(data);
        var html = ``;
        data.forEach(function (employ,index) {
            html += `<tr >                                        
                <td> ${employ.name}${employ.lastname} </td>                                            
                <td> ${employ.employposition['name']} </td> 
                <td> ${employ.phone} </td>                                            
                <td> ${employ.workphone} </td> 
                <td> ${employ.email} </td> 
                <td> <a type="button" data-id="${employ.id}" class="btn btn-sm bg-teal editEmployinfo">เพิ่มเติมข้อมูลส่วนตัว</a> 
                <a type="button" data-id="${employ.id}" class="btn btn-sm bg-warning deletecompanyemploy">ลบ</a>  </td>  
            </tr>`
            });
         $("#fulltbp_companyemploy_wrapper_tr").html(html);
         Swal.fire({
            title: 'สำเร็จ...',
            text: 'แก้ไขข้อมูลบุคลากรสำเร็จ!',
            });
    })
    .catch(error => {})
    // $('#modal_edit_employ').modal('show');
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
                    if(employ.employ_position_id < 6 ){
                        html += `<tr >                                        
                            <td> ${employ.name}${employ.lastname} </td>                                            
                            <td> ${employ.employposition['name']} </td> 
                            <td> ${employ.phone} </td>                                            
                            <td> ${employ.workphone} </td> 
                            <td> ${employ.email} </td> 
                            <td> <a type="button" data-id="${employ.id}" class="btn btn-sm bg-teal editEmployinfo">เพิ่มเติมข้อมูลส่วนตัว</a> 
                            <a type="button" data-id="${employ.id}" class="btn btn-sm bg-warning deletecompanyemploy">ลบ</a>  </td>  
                        </tr>`
                        }
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
                <td> <a type="button" data-id="${education.id}" class="btn btn-sm bg-danger deleteemployeducation">ลบ</a> </td> 
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
                <td> <a type="button" data-id="${experience.id}" class="btn btn-sm bg-danger deleteemployexperience">ลบ</a> </td> 
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
                <td> <a type="button" data-id="${training.id}" class="btn btn-sm bg-danger deleteemploytraining">ลบ</a> </td> 
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
                    <td> <a type="button" data-id="${education.id}" class="btn btn-sm bg-danger deleteemployeducation">ลบ</a> </td> 
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
                        <td> <a type="button" data-id="${experience.id}" class="btn btn-sm bg-danger deleteemployexperience">ลบ</a> </td> 
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
                        <td> <a type="button" data-id="${training.id}" class="btn btn-sm bg-danger deleteemploytraining">ลบ</a> </td> 
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
                <td> <a type="button" data-id="${stockholder.id}" class="btn btn-sm bg-warning deletestockholder">ลบ</a> </td> 
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
                        <td> <a type="button" data-id="${stockholder.id}" class="btn btn-sm bg-warning deletestockholder">ลบ</a> </td> 
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

// $(document).on('keyup', '#projectabtract_input', function(e) {
//     if (e.keyCode === 13) {
//         var html = `<input type="text" name ="projectabtract[]" value="${$(this).val()}" class="form-control projectabtractclass" style="border: 0" >`;
//         $(this).val('');
//         $('#fulltbp_projectabtract_wrapper').append(html);
//     }
// });

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

// $(document).on('keyup', '#mainproduct_input', function(e) {
//     if (e.keyCode === 13) {
//         var html = `<input type="text" name ="mainproduct[]" value="${$(this).val()}" class="form-control mainproductclass" style="border: 0" >`;
//         $(this).val('');
//         $('#fulltbp_mainproduct_wrapper').append(html);
//     }
// });

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

// $(document).on('keyup', '#productdetails_input', function(e) {
//     if (e.keyCode === 13) {
//         var html = `<input type="text" name ="productdetails[]" value="${$(this).val()}" class="form-control productdetailsclass" style="border: 0" >`;
//         $(this).val('');
//         $('#fulltbp_productdetails_wrapper').append(html);
//     }
// });

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

// $(document).on('keyup', '#projectechdev_input', function(e) {
//     if (e.keyCode === 13) {
//         var html = `<input type="text" name ="projectechdev[]" value="${$(this).val()}" class="form-control projectechdevclass" style="border: 0" >`;
//         $(this).val('');
//         $('#fulltbp_projectechdev_wrapper').append(html);
//     }
// });

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
                <a type="button" data-id="${techdevlevel.id}" class="btn btn-sm bg-warning deleteprojectechdevlevel">ลบ</a>  </td> 
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
                        <a type="button" data-id="${techdevlevel.id}" class="btn btn-sm bg-warning deleteprojectechdevlevel">ลบ</a>  </td> 
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

// $(document).on('keyup', '#projectechdevproblem_input', function(e) {
//     if (e.keyCode === 13) {
//         var html = `<input type="text" name ="projectechdevproblem[]" value="${$(this).val()}" class="form-control projectechdevproblemclass" style="border: 0" >`;
//         $(this).val('');
//         $('#fulltbp_projectechdevproblem_wrapper').append(html);
//     }
// });

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

$(document).on('change', '#cer1', function(e) {
    if($(this).is(":checked")){
        $("#cer1qtydiv").attr("hidden",false);
    }else{
        $("#cer1qtydiv").attr("hidden",true);
    }
});
$(document).on('change', '#cer2', function(e) {
    if($(this).is(":checked")){
        $("#cer2qtydiv").attr("hidden",false);
    }else{
        $("#cer2qtydiv").attr("hidden",true);
    }
});
$(document).on('change', '#cer3', function(e) {
    if($(this).is(":checked")){
        $("#cer3qtydiv").attr("hidden",false);
    }else{
        $("#cer3qtydiv").attr("hidden",true);
    }
});
$(document).on('change', '#cer4', function(e) {
    if($(this).is(":checked")){
        $("#cer4qtydiv").attr("hidden",false);
    }else{
        $("#cer4qtydiv").attr("hidden",true);
    }
});
$(document).on('change', '#cer5', function(e) {
    if($(this).is(":checked")){
        $("#cer5qtydiv").attr("hidden",false);
    }else{
        $("#cer5qtydiv").attr("hidden",true);
    }
});
$(document).on('change', '#cer6', function(e) {
    if($(this).is(":checked")){
        $("#cer6qtydiv").attr("hidden",false);
    }else{
        $("#cer6qtydiv").attr("hidden",true);
    }
});
$(document).on('change', '#cer7', function(e) {
    if($(this).is(":checked")){
        $("#cer7qtydiv").attr("hidden",false);
    }else{
        $("#cer7qtydiv").attr("hidden",true);
    }
});
$(document).on('change', '#cer8', function(e) {
    if($(this).is(":checked")){
        $("#cer8qtydiv").attr("hidden",false);
    }else{
        $("#cer8qtydiv").attr("hidden",true);
    }
});
$(document).on('change', '#cer9', function(e) {
    if($(this).is(":checked")){
        $("#cer9qtydiv").attr("hidden",false);
    }else{
        $("#cer9qtydiv").attr("hidden",true);
    }
});
$(document).on('change', '#cer11', function(e) {
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
$(document).on('change', '#certify', function(e) {
// $("#certify").on('change', function() {
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
                            <a href="${route.url}/${attachment.path}" class=" btn-sm bg-primary">ดาวน์โหลด</a>
                            <a type="button" data-id="${attachment.id}" data-name="" class="btn btn-sm bg-danger deletefulltbpcertifyattachment">ลบ</a>                                       
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
                            <a href="${route.url}/${attachment.path}" class=" btn-sm bg-primary">ดาวน์โหลด</a>
                            <a type="button" data-id="${attachment.id}" data-name="" class="btn btn-sm bg-danger deletefulltbpcertifyattachment">ลบ</a>                                       
                        </td>
                    </tr>`
                    });
                 $("#fulltbp_certify_wrapper_tr").html(html);
           })
           .catch(error => {})
        }
    });
}); 
$(document).on('change', '#award', function(e) {
// $("#award").on('change', function() {
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
                            <a href="${route.url}/${attachment.path}" class=" btn-sm bg-primary">ดาวน์โหลด</a>
                            <a type="button" data-id="${attachment.id}" data-name="" class="btn btn-sm bg-danger deletefulltbpawardattachment">ลบ</a>                                       
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
                            <a href="${route.url}/${attachment.path}" class=" btn-sm bg-primary">ดาวน์โหลด</a>
                            <a type="button" data-id="${attachment.id}" data-name="" class="btn btn-sm bg-danger deletefulltbpawardattachment">ลบ</a>                                       
                        </td>
                    </tr>`
                    });
                 $("#fulltbp_award_wrapper_tr").html(html);
           })
           .catch(error => {})
        }
    });
}); 
$(document).on('change', '#standard', function(e) {
// $("#standard").on('change', function() {
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
                            <a href="${route.url}/${attachment.path}" class=" btn-sm bg-primary">ดาวน์โหลด</a>
                            <a type="button" data-id="${attachment.id}" data-name="" class="btn btn-sm bg-danger deletefulltbpstandardattachment">ลบ</a>                                       
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
                            <a href="${route.url}/${attachment.path}" class=" btn-sm bg-primary">ดาวน์โหลด</a>
                            <a type="button" data-id="${attachment.id}" data-name="" class="btn btn-sm bg-danger deletefulltbpstandardattachment">ลบ</a>                                       
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
                <a type="button" data-id="${plan.id}" class="btn btn-sm bg-info editprojectplan">แก้ไข</a>
                    <a type="button" data-id="${plan.id}" data-name="" class="btn btn-sm bg-warning deleteprojectplan">ลบ</a>                                       
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
                <a type="button" data-id="${plan.id}" class="btn btn-sm bg-info editprojectplan">แก้ไข</a>
                    <a type="button" data-id="${plan.id}" data-name="" class="btn btn-sm bg-warning deleteprojectplan">ลบ</a>                                       
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
                        <a type="button" data-id="${plan.id}" class="btn btn-sm bg-info editprojectplan">แก้ไข</a>
                            <a type="button" data-id="${plan.id}" data-name="" class="btn btn-sm bg-warning deleteprojectplan">ลบ</a>                                       
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

// $(document).on('keyup', '#marketneed_input', function(e) {
//     if (e.keyCode === 13) {
//         var html = `<input type="text" name ="marketneed[]" value="${$(this).val()}" class="form-control marketneedclass" style="border: 0" >`;
//         $(this).val('');
//         $('#fulltbp_marketneed_wrapper').append(html);
//     }
// });

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

// $(document).on('keyup', '#marketsize_input', function(e) {
//     if (e.keyCode === 13) {
//         var html = `<input type="text" name ="marketsize[]" value="${$(this).val()}" class="form-control marketsizeclass" style="border: 0" >`;
//         $(this).val('');
//         $('#fulltbp_marketsize_wrapper').append(html);
//     }
// });

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

// $(document).on('keyup', '#marketshare_input', function(e) {
//     if (e.keyCode === 13) {
//         var html = `<input type="text" name ="marketshare[]" value="${$(this).val()}" class="form-control marketshareclass" style="border: 0" >`;
//         $(this).val('');
//         $('#fulltbp_marketshare_wrapper').append(html);
//     }
// });

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

// $(document).on('keyup', '#marketcompetitive_input', function(e) {
//     if (e.keyCode === 13) {
//         var html = `<input type="text" name ="marketcompetitive[]" value="${$(this).val()}" class="form-control marketcompetitiveclass" style="border: 0" >`;
//         $(this).val('');
//         $('#fulltbp_marketcompetitive_wrapper').append(html);
//     }
// });

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

$(document).on('change', '#businessmodelcanvas', function(e) {
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
                            <a href="${route.url}/${attachment.path}" class=" btn-sm bg-primary">ดาวน์โหลด</a>
                            <a type="button" data-id="${attachment.id}" data-name="" class="btn btn-sm bg-danger deletefulltbpmodelcanvasattachment">ลบ</a>                                       
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
                            <a href="${route.url}/${attachment.path}" class="btn btn-sm bg-primary">ดาวน์โหลด</a>
                            <a type="button" data-id="${attachment.id}" data-name="" class="btn btn-sm bg-danger deletefulltbpmodelcanvasattachment">ลบ</a>                                       
                        </td>
                    </tr>`
                    });
                 $("#fulltbp_businessmodelcanvas_wrapper_tr").html(html);
           })
           .catch(error => {})
        }
    });
}); 
$(document).on('change', '#swotfile', function(e) {
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
                            <a href="${route.url}/${attachment.path}" class="btn btn-sm bg-primary">ดาวน์โหลด</a>
                            <a type="button" data-id="${attachment.id}" data-name="" class="btn btn-sm bg-danger deletefulltbpswotattachment">ลบ</a>                                       
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
                            <a href="${route.url}/${attachment.path}" class="btn btn-sm bg-primary">ดาวน์โหลด</a>
                            <a type="button" data-id="${attachment.id}" data-name="" class="btn btn-sm bg-danger deletefulltbpswotattachment">ลบ</a>                                       
                        </td>
                    </tr>`
                    });
                 $("#fulltbp_swot_wrapper_tr").html(html);
           })
           .catch(error => {})
        }
    });
});

$(document).on('change', '#financialplan', function(e) {
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
                            <a href="${route.url}/${attachment.path}" class="btn btn-sm bg-primary">ดาวน์โหลด</a>
                            <a type="button" data-id="${attachment.id}" data-name="" class="btn btn-sm bg-danger deletefulltbpfinancialplanattachment">ลบ</a>                                       
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
                            <a href="${route.url}/${attachment.path}" class="btn btn-sm bg-primary">ดาวน์โหลด</a>
                            <a type="button" data-id="${attachment.id}" data-name="" class="btn btn-sm bg-danger deletefulltbpfinancialplanattachment">ลบ</a>                                       
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
                    <a type="button" data-id="${sell.id}" class="btn btn-sm bg-info editsell">แก้ไข</a> 
                    <a type="button" data-id="${sell.id}" class="btn btn-sm bg-warning deletesell">ลบ</a>
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
                            <a type="button" data-id="${sell.id}" class="btn btn-sm bg-info editsell">แก้ไข</a> 
                            <a type="button" data-id="${sell.id}" class="btn btn-sm bg-warning deletesell">ลบ</a>
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
                    <a type="button" data-id="${sell.id}" class="btn btn-sm bg-info editsell">แก้ไข</a> 
                    <a type="button" data-id="${sell.id}" class="btn btn-sm bg-warning deletesell">ลบ</a>
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
                    <a type="button" data-id="${sell.id}" class="btn btn-sm bg-info editsellstatus">แก้ไข</a> 
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
        console.log(data);
        data.forEach(function (sell,index) {
            html += `<tr >                                        
                <td> ${sell.debtpartner} </td>                            
                <td> ${sell.numproject} </td>  
                <td> ${sell.partnertaxid} </td>                         
                <td> ${sell.totalyearsell} </td> 
                <td> ${sell.percenttosale} </td> 
                <td> ${sell.businessyear} </td> 
                <td> 
                    <a type="button" data-id="${sell.id}" class="btn btn-sm bg-info editdebtpartner">แก้ไข</a> 
                    <a type="button" data-id="${sell.id}" class="btn btn-sm bg-warning deletedebtpartner">ลบ</a>
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
                    <a type="button" data-id="${sell.id}" class="btn btn-sm bg-info editdebtpartner">แก้ไข</a> 
                    <a type="button" data-id="${sell.id}" class="btn btn-sm bg-warning deletedebtpartner">ลบ</a>
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
                            <a type="button" data-id="${sell.id}" class="btn btn-sm bg-info editdebtpartner">แก้ไข</a> 
                            <a type="button" data-id="${sell.id}" class="btn btn-sm bg-warning deletedebtpartner">ลบ</a>
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
                    <a type="button" data-id="${sell.id}" class="btn btn-sm bg-info editcreditpartner">แก้ไข</a> 
                    <a type="button" data-id="${sell.id}" class="btn btn-sm bg-warning deletecreditpartner">ลบ</a>
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
                    <a type="button" data-id="${sell.id}" class="btn btn-sm bg-info editcreditpartner">แก้ไข</a> 
                    <a type="button" data-id="${sell.id}" class="btn btn-sm bg-warning deletecreditpartner">ลบ</a>
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
                            <a type="button" data-id="${sell.id}" class="btn btn-sm bg-info editcreditpartner">แก้ไข</a> 
                            <a type="button" data-id="${sell.id}" class="btn btn-sm bg-warning deletecreditpartner">ลบ</a>
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
                    <a type="button" data-id="${asset.id}" class="btn btn-sm bg-info editasset">แก้ไข</a> 
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
                    <a type="button" data-id="${invesment.id}" class="btn btn-sm bg-info editinvestment">แก้ไข</a> 
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
                    <a type="button" data-id="${cost.id}" class="btn btn-sm bg-info editcost">แก้ไข</a> 
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
$(document).on('change', '#companydoc', function(e) {
// $("#companydoc").on('change', function() {
    if($('#companydocname').val() == '')return ;
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
                            <a href="${route.url}/${attachment.path}" class="btn btn-sm bg-primary">ดาวน์โหลด</a>
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
                            <a href="${route.url}/${attachment.path}" class="btn btn-sm bg-primary">ดาวน์โหลด</a>
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

$(document).on('click', '#btneditquantityemploy', function(e) {
    Employ.editEmployQuantity($(this).data('id'),$('#department1_qty').val(),$('#department2_qty').val(),$('#department3_qty').val(),$('#department4_qty').val(),$('#department5_qty').val()).then(data => {
        $('#department1_qty').val(data.department1_qty);
        $('#department2_qty').val(data.department2_qty);
        $('#department3_qty').val(data.department3_qty);
        $('#department4_qty').val(data.department4_qty);
        $('#department5_qty').val(data.department5_qty);
        Swal.fire({
            title: 'สำเร็จ...',
            text: 'แก้ไขจำนวนบุคลากรสำเร็จ!',
            });
    })
    .catch(error => {})
});

$(document).on('change', '#organizeimg', function(e) {
    var file = this.files[0];
    if (this.files[0].size/1024/1024*1000 > 2000 ){
        alert('ไฟล์ขนาดมากกว่า 2 MB');
        return ;
    }
    console.log(file);
    var formData = new FormData();
    formData.append('file',file);
    formData.append('id',$(this).data('id'));
        $.ajax({
            url: `${route.url}/api/company/uploadorganizeimg`,  //Server script to process data
            type: 'POST',
            headers: {"X-CSRF-TOKEN":route.token},
            data: formData,
            contentType: false,
            processData: false,
            success: function(data){
                console.log(data)
                var imgpath = route.url + '/'+ data.organizeimg;
                $("#organizeimgholder").attr("src", imgpath);
                //organizeimgholder
        }
    });
});

// Basic wizard setup
var form = $('.steps-basic').show();
$('.steps-basic').steps({
    headerTag: 'h6',
    bodyTag: 'fieldset',
    transitionEffect: 'fade',
    enableFinishButton: false,
    titleTemplate: '<span class="number">#index#</span> #title#',
    labels: {
        previous: '<i class="icon-arrow-left13 mr-2" /> ย้อนกลับ',
        next: 'ต่อไป <i class="icon-arrow-right14 ml-2" />',
        finish: 'บันทึก <i class="icon-arrow-right14 ml-2" />'
    },
    onStepChanged:function (event, currentIndex, newIndex) {
        if(currentIndex == 1){
            $(".actions").find(".libtn").remove();
            FullTbp.editGeneral($('#fulltbpid').val(),$('#businesstype').val(),$('#department_qty').val(),$('#department1_qty').val(),$('#department2_qty').val(),$('#department3_qty').val(),$('#department4_qty').val(),$('#department5_qty').val(),
            $('#companyhistory').val(),$('#responsibleprefix').val(),$('#responsiblename').val(),$('#responsiblelastname').val(),$('#responsibleposition').val(),$('#responsibleemail').val(),$('#responsiblephone').val(),$('#responsibleworkphone').val(),$('#responsibleeducationhistory').val(),$('#responsibleexperiencehistory').val(),$('#responsibletraininghistory').val()).then(data => {
                console.log(data);
            })
            .catch(error => {})
        }else if(currentIndex == 2){
            $(".actions").find(".libtn").remove();
            FullTbp.editOverAll($('#fulltbpid').val(),$('#projectabtract_input').val(),$('#productdetails_input').val(),$('#projectechdev_input').val(),$('#projectechdevproblem_input').val(),$('#mainproduct_input').val(),$('#projectinnovation_input').val(),$('#projectstandard_input').val()).then(data => {
                Project.editProjectCertify($('#fulltbpid').val(),$('#cer1').is(':checked'),$('#cer1qty').val(),$('#cer2').is(':checked'),$('#cer2qty').val(),$('#cer3').is(':checked'),$('#cer3qty').val(),$('#cer4').is(':checked'),$('#cer4qty').val(),$('#cer5').is(':checked'),$('#cer5qty').val(),$('#cer6').is(':checked'),$('#cer6qty').val(),$('#cer7').is(':checked'),$('#cer7qty').val(),$('#cer8').is(':checked'),$('#cer8qty').val(),$('#cer9').is(':checked'),$('#cer9qty').val(),$('#cer10').is(':checked'),$('#cer11').is(':checked'),$('#cer11qty').val()).then(data => {
                    console.log(data);
                })
                .catch(error => {})
            })  
        }else if(currentIndex == 3){
            $(".actions").find(".libtn").remove();
            FullTbp.editMarketPlan($('#fulltbpid').val(),$('#analysis').val(),$('#modelcanvas').val(),$('#swot').val()).then(data => {
                console.log(data);
            })
            
            .catch(error => {})
        }else if(currentIndex == 4){
            var hidden = '';
            if(route.submitstatus !=4 && (route.refixstatus == 0 || route.refixstatus == 2 )){
                hidden = 'hidden';
                $("#appceptagreement_wrapper").attr("hidden",true);
            }
            $(document).find(".actions ul").append(`
                <li class='libtn'><a href='#' id='downloadpdf' class='btn btn-primary' target="_blank"> ดาวน์โหลด <i class='icon-floppy-disk ml-2' /></a></li>
                <li class='libtn' ${hidden}><a href='#' id='submitfulltbp' class='btn bg-teal' ><i class="icon-spinner spinner mr-2" id="spinicon" hidden></i>ส่งขอประเมิน<i class='icon-paperplane ml-2' /></a></li>
            `);

            Sell.editROI($('#fulltbpid').val(),$('#income').val(),$('#profit').val(),$('#reduce').val()).then(data => {
                $('#income').val(data.income);
                $('#profit').val(data.profit);
                $('#reduce').val(data.reduce);
                FullTbp.generatePdf($('#fulltbpid').val()).then(data => {
                    var pdfpath = route.url + '/'+ data;
                    var url = pdfpath;
                    $('#downloadpdf').attr('href', url);
                    PDFObject.embed(pdfpath, "#example1");
                })
            })
            .catch(error => {})
        }
    },
    onStepChanging: function (event, currentIndex, newIndex) {
        console.log();
        if(currentIndex == 3){
            if($('#usersignature').val() == 2){
                if (typeof $('#signatureimg').val() === 'undefined'){
                    $("#signatureerror").attr("hidden",false);
                    return;
                }else{
                    $("#signatureerror").attr("hidden",true);
                }
            }
        }
        form.validate().settings.ignore = ':disabled,:hidden';
        return form.valid();
    },
    onFinished: function (event, currentIndex) {
        alert('Form submitted.');
    }
});

$(document).on('click', '#btn_modal_add_researcher', function(e) {
    FullTbp.addResearcher(1,$('#fulltbpid').val(),$('#researcherfix').val(),$('#researchername').val(),$('#researcherlastname').val(),$('#researchereducation').val(),$('#researcherexperience').val(),$('#researchertraining').val()).then(data => {
        var html = ``;
        data.forEach(function (researcher,index) {
            html += `<tr >                                        
                <td> ${researcher.prefix['name']}${researcher.name} ${researcher.lastname}</td>                                            
                <td> ${researcher.education} </td>     
                <td> ${researcher.experience} </td>     
                <td> ${researcher.training} </td>  
                <td> 
                    <a type="button" data-id="${researcher.id}" data-name="" class="btn btn-sm bg-warning deleteresearcher">ลบ</a>                                       
                </td>
            </tr>`
            });
         $("#fulltbp_researcher_wrapper_tr").html(html);
   })
   .catch(error => {})
});

$(document).on('click', '#btn_modal_add_projectmember', function(e) {
    FullTbp.addResearcher(2,$('#fulltbpid').val(),$('#projectmemberfix').val(),$('#projectmembername').val(),$('#projectmemberlastname').val(),$('#researchereducation').val(),$('#projectmemberexperience').val(),$('#projectmembertraining').val()).then(data => {
        var html = ``;
        data.forEach(function (researcher,index) {
            html += `<tr >                                        
                <td> ${researcher.prefix['name']}${researcher.name} ${researcher.lastname}</td>                                            
                <td> ${researcher.education} </td>     
                <td> ${researcher.experience} </td>     
                <td> ${researcher.training} </td>  
                <td> 
                    <a type="button" data-id="${researcher.id}" data-name="" class="btn btn-sm bg-warning deleteprojectmember">ลบ</a>                                       
                </td>
            </tr>`
            });
         $("#fulltbp_projectmember_wrapper_tr").html(html);
   })
   .catch(error => {})
});

$(document).on("click",".deleteresearcher",function(e){
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
            FullTbp.deleteResearcher(1,$(this).data('id')).then(data => {
                var html = ``;
                data.forEach(function (researcher,index) {
                    html += `<tr >                                        
                        <td> ${researcher.prefix['name']}${researcher.name} ${researcher.lastname}</td>                                            
                        <td> ${researcher.education} </td>     
                        <td> ${researcher.experience} </td>     
                        <td> ${researcher.training} </td>  
                        <td> 
                            <a type="button" data-id="${researcher.id}" data-name="" class="btn btn-sm bg-warning deleteresearcher">ลบ</a>                                       
                        </td>
                    </tr>`
                    });
                 $("#fulltbp_researcher_wrapper_tr").html(html);
           })
           .catch(error => {})
        }
    });
});

$(document).on("click",".deleteprojectmember",function(e){
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
            FullTbp.deleteResearcher(2,$(this).data('id')).then(data => {
                var html = ``;
                data.forEach(function (researcher,index) {
                    html += `<tr >                                        
                        <td> ${researcher.prefix['name']}${researcher.name} ${researcher.lastname}</td>                                            
                        <td> ${researcher.education} </td>     
                        <td> ${researcher.experience} </td>     
                        <td> ${researcher.training} </td>  
                        <td> 
                            <a type="button" data-id="${researcher.id}" data-name="" class="btn btn-sm bg-warning deleteresearcher">ลบ</a>                                       
                        </td>
                    </tr>`
                    });
                 $("#fulltbp_projectmember_wrapper_tr").html(html);
           })
           .catch(error => {})
        }
    });
});

$(document).on('change', '#boardattachment', function(e) {
    console.log($(this).data('id'));
    var file = this.files[0];

    if (this.files[0].size/1024/1024*1000 > 1000 ){
        alert('ไฟล์ขนาดมากกว่า 1 MB');
        return ;
    }
    var formData = new FormData();
    formData.append('file',file);
    formData.append('id',$('#employid').val());
        $.ajax({
            url: `${route.url}/api/fulltbp/employ/addboardattachment`,  //Server script to process data
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
                            <a href="${route.url}/${attachment.path}" class="btn btn-sm bg-primary">ดาวน์โหลด</a>
                            <a type="button" data-id="${attachment.id}" data-name="" class="btn btn-sm bg-danger deleteboardattachment">ลบ</a>                                       
                        </td>
                    </tr>`
                    });
                 $("#fulltbp_board_attachment_wrapper_tr").html(html);
        }
    });
});

$(document).on("click",".deleteboardattachment",function(e){
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
            Employ.deleteBoardAttachment($(this).data('id')).then(data => {
                var html = ``;
                var html = ``;
                data.forEach(function (attachment,index) {
                    html += `<tr >                                        
                        <td> ${attachment.name} </td>                                            
                        <td> 
                            <a href="${route.url}/${attachment.path}" class="btn btn-sm bg-primary">ดาวน์โหลด</a>
                            <a type="button" data-id="${attachment.id}" data-name="" class="btn btn-sm bg-danger deleteboardattachment">ลบ</a>                                       
                        </td>
                    </tr>`
                    });
                 $("#fulltbp_board_attachment_wrapper_tr").html(html);
           })
           .catch(error => {})
        }
    });
});

$(document).on('change', '#usersignature', function(e) {
    var usesignature = 1;
    if($(this).val() == 1){
        $("#signature_wrapper").attr("hidden",true);
    }else{
        usesignature = 2;
        $("#signature_wrapper").attr("hidden",false);
    }
    FullTbp.editSignature($('#fulltbpid').val(),usesignature).then(data => {
        console.log(data);
    })
});

$(document).on('click', '#submitfulltbp', function(e) {
    console.log($('#appceptagreement').is(':checked'));
    if($('#appceptagreement').is(':checked') === false){
        Swal.fire({
            title: 'ผิดพลาด!',
            type: 'warning',
            text: 'กรุณารับรองว่าข้อมูลทั้งหมดเป็นความจริง',
        });
        return;
    }
    var text = 'ส่งแบบฟอร์มแผนธุรกิจเทคโนโลยี (FUll TBP) หรือไม่'
    if($('#usersignature').val() == 1){
        text = 'ส่งแบบฟอร์มแผนธุรกิจเทคโนโลยี (FUll TBP) และเลือกไฟล์ที่ลงลายมือชื่อเรียบร้อยแล้ว'
    }
    Swal.fire({
        title: 'โปรดยืนยัน',
        text: text,
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'ตกลง',
        cancelButtonText: 'ยกเลิก',
        closeOnConfirm: false,
        closeOnCancel: false
        }).then((result) => {
        if (result.value) {
            if($('#usersignature').val() == 1){
                $("#fulltbppdf").trigger('click');
            }else{
                $("#spinicon").attr("hidden",false);
                submitNoAttachement($('#fulltbpid').val()).then(data => {
                    $("#submitfulltbp").attr("hidden",true);
                    $("#spinicon").attr("hidden",true);
                    $("#appceptagreement_wrapper").attr("hidden",true);
                        var html = ``;
                        Swal.fire({
                            title: 'สำเร็จ...',
                            text: 'ส่งแบบแบบฟอร์มแผนธุรกิจเทคโนโลยี (FUll TBP) สำเร็จ!',
                        }).then((result) => {
                            window.location.reload();
                        });
                    })
                .catch(error => {})
            }
        }
    });
});

$(document).on('change', '#fulltbppdf', function(e) {
    var file = this.files[0];
    if (file === undefined) {
        return ;
    }
    if (this.files[0].size/1024/1024*1000 > 2000 ){
        alert('ไฟล์ขนาดมากกว่า 2 MB');
        return ;
    }
    var formData = new FormData();
    formData.append('attachment',file);
    formData.append('id',$('#fulltbpid').val());
    console.log($('#fulltbpid').val());
    $.ajax({
        url: `${route.url}/api/fulltbp/submitwithattachement`,  //Server script to process data
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: formData,
        contentType: false,
        processData: false,
        beforeSend: function ( xhr ) {
            $("#spinicon").attr("hidden",false);
        },
        success: function(data){
            $("#submitfulltbp").attr("hidden",true);
            $("#spinicon").attr("hidden",true);
            $("#appceptagreement_wrapper").attr("hidden",true);
            Swal.fire({
                title: 'สำเร็จ...',
                text: 'ส่งแบบคำขอรับการประเมิน TTRS สำเร็จ!',
            });
        }
    });
});

function submitNoAttachement(id){
    return new Promise((resolve, reject) => {
        $.ajax({
            url: `${route.url}/api/fulltbp/submitwithnoattachement`,
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


$(document).on('click', '#btnaddboard', function(e) {
    Employ.getEmployPosition().then(data => {
        var selectemployposition = `<select id="employposition" data-placeholder="ตำแหน่ง" class="form-control form-control-select2">`;
        data.forEach(function (position,index) {
                if(index <= 4){
                    selectemployposition += `<option value="${position['id']}" >${position['name']}</option>`
                }
            });
        selectemployposition += `</select>`;
        $("#employ_position_wrapper").html(selectemployposition);
    })
    .catch(error => {})
    $('#modal_add_employ').modal('show');
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
                <td> <a type="button" data-id="${education.id}" class="btn btn-sm bg-danger deleteemployeducation">ลบ</a> </td> 
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
                <td> <a type="button" data-id="${experience.id}" class="btn btn-sm bg-danger deleteemployexperience">ลบ</a> </td> 
            </tr>`
            });
         $("#fulltbp_companyemployexperience_wrapper_tr").html(experiencetable);

         var trainingtable = '';
         data.employtrainings.forEach(function (training,index) {
            trainingtable += `<tr >                                        
                 <td> ${training.trainingdateth}</td>                                            
                 <td> ${training.course} </td> 
                 <td> ${training.owner} </td>                                            
                 <td> <a type="button" data-id="${training.id}" class="btn btn-sm bg-danger deleteemploytraining">ลบ</a> </td> 
             </tr>`
             });
          $("#fulltbp_companyemploytraining_wrapper_tr").html(trainingtable);
        var attachment  = '';
          data.fullTbpboardattachments.forEach(function (boardattachment,index) {
            attachment += `<tr >                                        
                  <td> ${boardattachment.name}</td>                                                                                      
                  <td> 
                    <a href="${route.url}/${boardattachment.path}" class="btn btn-sm bg-primary">ดาวน์โหลด</a>
                    <a type="button" data-id="${boardattachment.id}" class="btn btn-sm bg-danger deleteboardattachment">ลบ</a> 
                  </td> 
              </tr>`
              });
           $("#fulltbp_board_attachment_wrapper_tr").html(attachment);


        $("#employposition_wrapper").html(selectemployposition);
        $('#employid').val(data.employ['id'])
        $('#employname_edit').val(data.employ['name'])
        $('#employlastname_edit').val(data.employ['lastname'])
        $('#employphone_edit').val(data.employ['phone'])
        $('#employworkphone_edit').val(data.employ['workphone']) 
        $('#employemail_edit').val(data.employ['email']) 
        
    })
    .catch(error => {})
    $('#modal_edit_employ').modal('show');
});

$(document).on('click', '#btnaddresearch', function(e) {
    Employ.getEmployPosition().then(data => {
        var selectemployposition = `<select id="employposition_research" data-placeholder="ตำแหน่ง" class="form-control form-control-select2">`;
        data.forEach(function (position,index) {
            if(index == 5){
                selectemployposition += `<option value="${position['id']}" >${position['name']}</option>`
            }
        });
        selectemployposition += `</select>`;
        $("#employ_position_research_wrapper").html(selectemployposition);
    })
    .catch(error => {})
    $('#modal_add_employ_research').modal('show');
});

$(document).on('click', '#btn_modal_add_employ', function(e) {
    Employ.saveEmploy($('#employprefix').val(),$('#employname').val(),$('#employlastname').val(),$('#employposition').val(),$('#employphone').val(),$('#employworkphone').val(),$('#employemail').val()).then(data => {
        console.log(data);
        var html = ``;
        data.forEach(function (employ,index) {
            if(employ.employ_position_id < 6 ){
                html += `<tr >                                        
                    <td> ${employ.name}${employ.lastname} </td>                                            
                    <td> ${employ.employposition['name']} </td> 
                    <td> ${employ.phone} </td>                                            
                    <td> ${employ.workphone} </td> 
                    <td> ${employ.email} </td> 
                    <td> <a type="button" data-id="${employ.id}" class="btn btn-sm bg-teal editEmployinfo">เพิ่มเติมข้อมูลส่วนตัว</a> 
                    <a type="button" data-id="${employ.id}" class="btn btn-sm bg-warning deletecompanyemploy">ลบ</a>  </td> 
                </tr>`
            }
      
            });
         $("#fulltbp_companyemploy_wrapper_tr").html(html);
    })
    .catch(error => {})
});

$(document).on('click', '#btn_modal_add_employ_research', function(e) {
    Employ.saveEmploy($('#employprefix_research').val(),$('#employname_research').val(),$('#employlastname_research').val(),$('#employposition_research').val(),$('#employphone_research').val(),$('#employworkphone_research').val(),$('#employemail_research').val()).then(data => {
        console.log(data);
        var html = ``;
        data.forEach(function (employ,index) {
                if(employ.employ_position_id == 6){
                    html += `<tr >                                        
                        <td> ${employ.name} ${employ.lastname} </td>                                            
                        <td> ${employ.employposition['name']} </td> 
                        <td> ${employ.phone} </td>                                            
                        <td> ${employ.workphone} </td> 
                        <td> ${employ.email} </td> 
                        <td> <a type="button" data-id="${employ.id}" class="btn btn-sm bg-teal editEmployinfo">เพิ่มเติมข้อมูลส่วนตัว</a> 
                        <a type="button" data-id="${employ.id}" class="btn btn-sm bg-warning deletecompanyemploy_research">ลบ</a>  </td> 
                    </tr>`
                }
            });
         $("#fulltbp_researcher_wrapper_tr").html(html);
    })
    .catch(error => {})
});

$(document).on("click",".deletecompanyemploy_research",function(e){
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
                    if(employ.employ_position_id == 6){
                        html += `<tr >                                        
                            <td> ${employ.name} ${employ.lastname} </td>                                            
                            <td> ${employ.employposition['name']} </td> 
                            <td> ${employ.phone} </td>                                            
                            <td> ${employ.workphone} </td> 
                            <td> ${employ.email} </td> 
                            <td> <a type="button" data-id="${employ.id}" class="btn btn-sm bg-teal editEmployinfo">เพิ่มเติมข้อมูลส่วนตัว</a> 
                            <a type="button" data-id="${employ.id}" class="btn btn-sm bg-warning deletecompanyemploy_research">ลบ</a>  </td> 
                        </tr>`
                    }
                });
                $("#fulltbp_researcher_wrapper_tr").html(html);
            })
           .catch(error => {})
        }
    });
}); 

$(document).on('click', '#btnaddprojectmember', function(e) {
    Employ.getEmployPosition().then(data => {
        var selectemployposition = `<select id="employposition_projectmember" data-placeholder="ตำแหน่ง" class="form-control form-control-select2">`;
        data.forEach(function (position,index) {
                if(index > 5){
                    selectemployposition += `<option value="${position['id']}" >${position['name']}</option>`
                }
            });
        selectemployposition += `</select>`;
        $("#employ_position_projectmember_wrapper").html(selectemployposition);
    })
    .catch(error => {})
    $('#modal_add_employ_projectmember').modal('show');
});

$(document).on('click', '#btn_modal_add_employ_projectmember', function(e) {
    Employ.saveEmploy($('#employprefix_projectmember').val(),$('#employname_projectmember').val(),$('#employlastname_projectmember').val(),$('#employposition_projectmember').val(),$('#employphone_projectmember').val(),$('#employworkphone_projectmember').val(),$('#employemail_projectmember').val()).then(data => {
        console.log(data);
        var html = ``;
        data.forEach(function (employ,index) {
                if(employ.employ_position_id > 6){
                    html += `<tr >                                        
                        <td> ${employ.name}${employ.lastname} </td>                                            
                        <td> ${employ.employposition['name']} </td> 
                        <td> ${employ.phone} </td>                                            
                        <td> ${employ.workphone} </td> 
                        <td> ${employ.email} </td> 
                        <td> <a type="button" data-id="${employ.id}" class="btn btn-sm bg-teal editEmployinfo">เพิ่มเติมข้อมูลส่วนตัว</a> 
                        <a type="button" data-id="${employ.id}" class="btn btn-sm bg-warning deletecompanyemploy_projectmember">ลบ</a>  </td> 
                    </tr>`
                }
            });
         $("#fulltbp_projectmember_wrapper_tr").html(html);
    })
    .catch(error => {})
});

$(document).on("click",".deletecompanyemploy_projectmember",function(e){
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
                    if(employ.employ_position_id > 6){
                        html += `<tr >                                        
                            <td> ${employ.name}${employ.lastname} </td>                                            
                            <td> ${employ.employposition['name']} </td> 
                            <td> ${employ.phone} </td>                                            
                            <td> ${employ.workphone} </td> 
                            <td> ${employ.email} </td> 
                            <td> <a type="button" data-id="${employ.id}" class="btn btn-sm bg-teal editEmployinfo">เพิ่มเติมข้อมูลส่วนตัว</a> 
                            <a type="button" data-id="${employ.id}" class="btn btn-sm bg-warning deletecompanyemploy_projectmember">ลบ</a>  </td> 
                        </tr>`
                    }
                });
             $("#fulltbp_projectmember_wrapper_tr").html(html);
            })
           .catch(error => {})
        }
    });
}); 


	// Initialize validation
	$('.steps-basic').validate({
	    ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
	    errorClass: 'validation-invalid-label',
	    highlight: function(element, errorClass) {
	        $(element).removeClass(errorClass);
	    },
	    unhighlight: function(element, errorClass) {
	        $(element).removeClass(errorClass);
	    },

	    // Different components require proper error label placement
	    errorPlacement: function(error, element) {

	        // Unstyled checkboxes, radios
	        if (element.parents().hasClass('form-check')) {
	            error.appendTo( element.parents('.form-check').parent() );
	        }

	        // Input with icons and Select2
	        else if (element.parents().hasClass('form-group-feedback') || element.hasClass('select2-hidden-accessible')) {
	            error.appendTo( element.parent() );
	        }

	        // Input group, styled file input
	        else if (element.parent().is('.uniform-uploader, .uniform-select') || element.parents().hasClass('input-group')) {
	            error.appendTo( element.parent().parent() );
	        }

	        // Other elements
	        else {
	            error.insertAfter(element);
	        }
	    },
	    rules: {
	        email: {
	            email: true
	        }
	    }
	});
