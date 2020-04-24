import * as Geo from './location.js'
import * as Hid from './hid.js'
import * as Patient from './patient.js'
import * as Drug from './drug.js'
import * as MedicalCard from './medicalcardtype.js'
import * as HospitalList from './hospitallist.js'
import * as DateTime from './datetime.js'
import * as Room from './room.js'

$("#file").on('change', function() {
    var files = $(this)[0].files;
    $("#btnpicture").text(`อัพโหลดรูป (${files.length})`);
});

$("#attachment").on('change', function() {
    var files = $(this)[0].files;
    $("#btnattachment").text(`อัพโหลดไฟล์ (${files.length})`);
});
$("#attachfiledeathinfo").on('change', function() {
    var files = $(this)[0].files;
    $("#btnattachfiledeathinfo").text(`อัพโหลดไฟล์ (${files.length})`);
});
$("#attachfile").on('change', function() {
    var files = $(this)[0].files;
    $("#btnattachfilenote").text(`อัพโหลดไฟล์ (${files.length})`);
});

$(function () {
    $('#dob').bootstrapMaterialDatePicker({
        format: 'DD/MM/YYYY',
        clearButton: true,
        weekStart: 1,
        cancelText: "ยกเลิก",
        okText: "ตกลง",
        clearText: "เคลียร์",
        time: false
    });
});

$("#province").change(function(){
    Geo.amphur($(this).val()).then(data => {
        let  html = "";
        data.forEach((amphur,index) => 
            html += `<option value='${amphur.id}'>${amphur.name}</option>`
        )
        $("#amphur").html(html);
        $("#amphur option:contains("+$('#hidden_amphur').val()+")").attr('selected', true).change();
    })
    .catch(error => {
        console.log(error)
    })
});
$("#amphur").change(function(){
    Geo.tambol($(this).val()).then(data => {
        let  html = "";
        data.forEach((tambol,index) => 
            html += `<option value='${tambol.id}'>${tambol.name}</option>`
        )
        $("#tambol").html(html);
        $("#tambol option:contains("+$('#hidden_tambol').val()+")").attr('selected', true).change();
    })
    .catch(error => {
        console.log(error)
    })
});

$("#hid").change(function(){
   console.log($("#passport").is(":checked"));
   if($("#passport").is(":checked") == true){
        $("#hidinvalid").attr("hidden",true);
        $(this).removeClass('border-danger');
        return;
   }
    if($(this).val() == ""){
        if($(this).hasClass("border-danger")){
            $("#hidinvalid").attr("hidden",true);
            $(this).removeClass('border-danger');            
            $("#hidinvalid").text('');
        }
        return ;
    }
    Hid.check($(this).val(),route.branchid).then(data => {
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

$('#searchpatient').keyup(function(){   
    console.log($(this).val());
    if ($(this).val() =='') return;   
    Patient.searchPatient(route.branchid,$(this).val()).then(data => {
         
        let html='';
        data.forEach(function (patient,index) {
            let status ='';
            html += `<tr>
                        <td>${("00000000" + patient.hn).slice(-8)}</td>
                        <td>${patient.patientprefix['name']}${patient.name} ${patient.lastname}</td>
                        <td>${patient.ageyear}</td>                      
                        <td>                                                                                                      
                            <a href="${route.url}/patient/edit/${patient.id}" class="badge bg-primary">แก้ไข</a>
                            <a href="${route.url}/patient/delete/${patient.id}" data-patient="${patient.name} ${patient.lastname}" onclick="confirmation(event)" class=" badge bg-danger">ลบ</a>  
                        </td>
                    <tr>`
            });
        $("#patienttable_body").html(html);
    })
    .catch(error => {
        // console.log(error)
    })
});

$('#drugname').keyup(function(){  
    $('#genericname').val($(this).val());
    $('#printname').val($(this).val());
});


$(document).on("click","#btn_modal_edit_hint",function(e){
    if ($("#drug_hint").val() =='') return;
    Drug.editHint(route.branchid,$("#hint_edit").val(),$("#drug_hint").val()).then(data => {
            let  html = `<option value='0'>===เลือกรายการยา===</option>`;
            data.forEach((hint,index) => 
                html += `<option value='${hint.id}'>${hint.texthint}</option>`
            )
            $("#drug_hint").html(html);
        })
        .catch(error => {
            // console.log(error)
        })
}); 

$(document).on("click","#btngeneratehid",function(e){
    var id12 = "";
    for(var i = 0; i < 12; i++){
        id12 += parseInt(Math.random()*10);
    }
    $('#hid').val(id12 + finddigit(id12)); 
}); 

function finddigit(id)
{
    var base = 100000000000; //สร้างตัวแปร เพื่อสำหรับให้หารเพื่อเอาหลักที่ต้องการ
    var basenow; //สร้างตัวแปรเพื่อเก็บค่าประจำหลัก
    var sum = 0; //สร้างตัวแปรเริ่มตัวผลบวกให้เท่ากับ 0
    for(var i = 13; i > 1; i--) { //วนรอบตั้งแต่ 13 ลงมาจนถึง 2
        basenow = Math.floor(id/base); //หาค่าประจำตำแหน่งนั้น ๆ
        id = id - basenow*base; //ลดค่า id ลงทีละหลัก
        sum += basenow*i; //บวกค่า sum ไปเรื่อย ๆ ทีละหลัก
        base = base/10; //ตัดค่าที่ใช้สำหรับการหาเลขแต่ละหลัก
    }
    var checkbit = (11 - (sum%11))%10; //คำนวณค่า checkbit
    return checkbit;
}

$(document).on("click","#btn_modal_generate_dob",function(e){
    if($("#ageyear").val() == '' || $("#ageyear").val() < 1 || $("#ageyear").val() > 150){
        return ;
    }
    if($("#agemonth").val() == '' || $("#agemonth").val() <1 || $("#agemonth").val() > 12){
        return ;
    }
    if($("#ageday").val() == '' || $("#ageday").val() < 1 || $("#ageday").val() > 31){
        return ;
    }
    var id12 = "";
    for(var i = 0; i < 12; i++){
        id12 += parseInt(Math.random()*10);
    }
    var birthDate = moment().subtract($("#ageyear").val(), 'years').subtract($("#agemonth").val(), 'months').subtract($("#ageday").val(), 'days');
    var dob = birthDate.format("YYYY-MM-DD");
    var _dob = dob.split('-');
    $("#dob").val(_dob[2] + '/' + _dob[1] + '/' + (parseInt(_dob[0])+543));
}); 

var i =0;
$(document).on("click","#btn_modal_drug_allergy",function(e){

    if($("#drugallergyname").val() == 0){
        return;
    }
    i++;

     var html = `
     <div class="row drugallergy${i}" >							
        <div class="col-md-6">
            <div class="form-group">
                <input type="text" name="drugallergyname[${i}]" id="drugallergyname${i}" value="${$("#drugallergyname").val()}" class="form-control" >
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <input type="text" name="drugallergynote[${i}]" id="drugallergynote${i}" value="${$("#drugallergynote").val()}" class="form-control" >
            </div>
        </div>
    </div>`;
     $('#drug_allergy_wrapper').append(html);
    var tr = `<tr class="drugallergy${i}">	
    <td> ${$("#drugallergyname  option:selected").text()} </td>
    <td> ${$("#drugallergynote").val()} </td>                                                
    <td> <a type="button" data-id="drugallergy${i}"  class="btn btn-danger-400 btn-sm deletedrugallergy" ><i class="icon-trash danger"></i></a></td>
    </tr>`;
    
    $('#drug_allergy_wrapper_tr').append(tr);
}); 

$(document).on("click",".deletedrugallergy",function(e){
     $("."+$(this).data('id')).remove();
}); 

$(document).on("click","#btn_modal_drug_allergy_edit",function(e){
    if($("#drugallergyname").val() == 0){
        return;
    }
    Patient.addDrugAllergy(route.patientid,$("#drugallergyname").val(),$("#drugallergynote").val()).then(data => {
        
       let html='';
       data.forEach(function (drugallergy,index) {
           let status ='';
           html += `<tr>
                       <td>${drugallergy.drug['name']}</td>
                       <td>${drugallergy['note']}</td>                   
                       <td>                                                                                                      
                       <a type="button" data-id="${drugallergy['id']}"  class="btn btn-danger-400 btn-sm" id="deletedrug" ><i class="icon-trash danger"></i></a>
                       </td>
                   <tr>`
           });
        $("#drug_allergy_wrapper_tr").html(html);
   })
   .catch(error => {
       //console.log(error)
   })
});


$(document).on("click","#deletedrug",function(e){
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
            Patient.deleteDrugAllergy(route.patientid,$(this).data('id')).then(data => {
                
               let html='';
               data.forEach(function (drugallergy,index) {
                   let status ='';
                   html += `<tr>
                               <td>${drugallergy.drug['name']}</td>
                               <td>${drugallergy['note']}</td>                   
                               <td>                                                                                                      
                               <a type="button" data-id="${drugallergy['id']}"  class="btn btn-danger-400 btn-sm" id="deletedrug" ><i class="icon-trash danger"></i></a>
                               </td>
                           <tr>`
                   });
                $("#drug_allergy_wrapper_tr").html(html);
           })
           .catch(error => {
               // console.log(error)
           })
        }
    });

}); 

var k=0;
$(document).on("click","#btn_modal_icd10",function(e){
    console.log($("#icd10name").val());
    if($("#icd10name").val() == 0){
        return;
    }
    k++;
     var html = `
     <div class="row congenitaldisease${k}" >							
        <div class="col-md-6">
            <div class="form-group">
                <input type="text" name="congenitaldiseasename[${k}]" id="congenitaldiseasename${k}" value="${$("#congenitaldiseasename").val()}" class="form-control" >
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <input type="text" name="congenitaldiseasenote[${k}]" id="congenitaldiseasenote${k}" value="${$("#congenitaldiseasenote").val()}" class="form-control" >
            </div>
        </div>
    </div>`;
     $('#congenital_disease_wrapper').append(html);
    var tr = `<tr class="congenitaldisease${k}">	
    <td> ${$('#congenitaldiseasename').find(':selected').data('icd10code')}</td>                                     
    <td> ${$('#congenitaldiseasename').find(':selected').data('nameth')}</td>  
    <td> ${$('#congenitaldiseasename').find(':selected').data('nameeng')}</td>  
    <td> ${$('#congenitaldiseasenote').val()}</td>    
    <td> <a type="button" data-id="congenitaldisease${k}"  class="btn btn-danger-400 btn-sm deletecongenitaldisease" ><i class="icon-trash danger"></i></a></td>
    </tr>`;
    $('#congenital_disease_wrapper_tr').append(tr);
});

$(document).on("click",".deletecongenitaldisease",function(e){
    $("."+$(this).data('id')).remove();
}); 

$(document).on("click","#deletecongenitaldisease",function(e){
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
            Patient.deleteCongenitalDisease(route.patientid,$(this).data('id')).then(data => {
                
               let html='';
               data.forEach(function (congenitaldisease,index) {
                   let status ='';
                   html += `<tr>
                                <td>${congenitaldisease.icd10['icd10code']} </td>
                                <td>${congenitaldisease.icd10['nameth']} </td>
                                <td>${congenitaldisease.icd10['nameeng']} </td>
                                <td>${congenitaldisease['note']}</td>                   
                                <td>                                                                                                      
                                <a type="button" data-id="${congenitaldisease['id']}"  class="btn btn-danger-400 btn-sm" id="deletecongenitaldisease" ><i class="icon-trash danger"></i></a>
                                </td>
                           <tr>`
                   });
                $("#congenital_disease_wrapper_tr").html(html);
           })
           .catch(error => {
               // console.log(error)
           })
        }
    });
}); 

$(document).on("click","#btn_modal_icd10_edit",function(e){
  
    if($("#congenitaldiseasename").val() == 0){
        return;
    }
    Patient.addCongenitalDisease(route.patientid,$("#congenitaldiseasename").val(),$("#congenitaldiseasenote").val()).then(data => {
        
        let html='';
        data.forEach(function (congenitaldisease,index) {
            html += `<tr>
                        <td>${congenitaldisease.icd10['icd10code']} </td>
                        <td>${congenitaldisease.icd10['nameth']} </td>
                        <td>${congenitaldisease.icd10['nameeng']} </td>
                        <td>${congenitaldisease['note']}</td>                  
                        <td>                                                                                                      
                        <a type="button" data-id="${congenitaldisease['id']}"  class="btn btn-danger-400 btn-sm" id="deletecongenitaldisease" ><i class="icon-trash danger"></i></a>
                        </td>
                    <tr>`
            });
            console.log(html);
         $("#congenital_disease_wrapper_tr").html(html);
   })
   .catch(error => {
       //console.log(error)
   })
});

var c =0;
$(document).on("click","#btn_modal_food_allergy",function(e){
    if($("#foodallergyname").val() == 0){
        return;
    }
    c++;
     var html = `
     <div class="row foodallergy${c}" >							
        <div class="col-md-6">
            <div class="form-group">
                <input type="text" name="foodallergyname[${c}]" id="foodallergyname${c}" value="${$("#foodallergyname").val()}" class="form-control" >
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <input type="text" name="foodallergynote[${c}]" id="foodallergynote${c}" value="${$("#foodallergynote").val()}" class="form-control" >
            </div>
        </div>
    </div>`;
     $('#food_allergy_wrapper').append(html);
    var tr = `<tr class="foodallergy${c}">	
    <td> ${$("#foodallergyname").val()} </td> 
    <td> ${$("#foodallergynote").val()} </td>                                                
    <td> <a type="button" data-id="foodallergy${c}"  class="btn btn-danger-400 btn-sm deletefoodallergy" ><i class="icon-trash danger"></i></a></td>
    </tr>`;
    
    $('#food_allergy_wrapper_tr').append(tr);
}); 

$(document).on("click",".deletefoodallergy",function(e){
     $("."+$(this).data('id')).remove();
}); 

$(document).on("click","#btn_modal_food_allergy_edit",function(e){
    if($("#foodallergyname").val() == 0){
        return;
    }
    Patient.addFoodAllergy(route.patientid,$("#foodallergyname").val(),$("#foodallergynote").val()).then(data => {
        
       let html='';
       data.forEach(function (foodallergy,index) {
           let status ='';
           html += `<tr>
                       <td>${foodallergy['name']}</td>
                       <td>${foodallergy['note']}</td>                   
                       <td>                                                                                                      
                       <a type="button" data-id="${foodallergy['id']}"  class="btn btn-danger-400 btn-sm" id="deletefoodallergy" ><i class="icon-trash danger"></i></a>
                       </td>
                   <tr>`
           });
        $("#food_allergy_wrapper_tr").html(html);
   })
   .catch(error => {
       //console.log(error)
   })
});

$(document).on("click","#deletefoodallergy",function(e){
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
            Patient.deleteFoodAllergy(route.patientid,$(this).data('id')).then(data => {
                
               let html='';
               data.forEach(function (foodallergy,index) {
                   html += `
                   <tr>
                        <td>${foodallergy['name']}</td>
                        <td>${foodallergy['note']}</td>                   
                        <td>                                                                                                      
                        <a type="button" data-id="${foodallergy['id']}"  class="btn btn-danger-400 btn-sm" id="deletefoodallergy" ><i class="icon-trash danger"></i></a>
                        </td>
                    <tr>`
                });
                $("#food_allergy_wrapper_tr").html(html);
           })
           .catch(error => {
               // console.log(error)
           })
        }
    });
}); 

var d =0;
$(document).on("click","#btn_modal_contact",function(e){
    if($("#contactname").val() == 0 || $("#contactlastname").val() == 0){
        return;
    }
    d++;
     var html = `
     <div class="row foodallergy${c}" >	
        <div class="col-md-2">
            <div class="form-group">
                <input type="text" name="contactprefix[${d}]" id="contactprefix${d}" value="${$("#contactprefix").val()}" class="form-control" >
            </div>
        </div>						
        <div class="col-md-2">
            <div class="form-group">
                <input type="text" name="contactname[${d}]" id="contactname${d}" value="${$("#contactname").val()}" class="form-control" >
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <input type="text" name="contactlastname[${d}]" id="contactlastname${d}" value="${$("#contactlastname").val()}" class="form-control" >
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <input type="text" name="relation[${d}]" id="relation${d}" value="${$("#relation").val()}" class="form-control" >
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <input type="text" name="contactphone[${d}]" id="contactphone${d}" value="${$("#contactphone").val()}" class="form-control" >
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <input type="text" name="contactemail[${d}]" id="contactemail${d}" value="${$("#contactemail").val()}" class="form-control" >
            </div>
        </div>
    </div>`;
     $('#contact_wrapper').append(html);
    var tr = `<tr class="contact${d}">	
    <td> ${$("#contactprefix  option:selected").text()}${$("#contactname").val()} ${$("#contactlastname").val()}</td> 
    <td> ${$("#relation").val()} </td>   
    <td> ${$("#contactphone").val()} </td>                                                
    <td> ${$("#contactemail").val()} </td>  
    <td> <a type="button" data-id="contact${d}"  class="btn btn-danger-400 btn-sm deletecontact" ><i class="icon-trash danger"></i></a></td>
    </tr>`;
    
    $('#contact_wrapper_tr').append(tr);
}); 

$(document).on("click",".deletecontact",function(e){
     $("."+$(this).data('id')).remove();
}); 

$(document).on("click","#btn_modal_create_medicalcard",function(e){
    if($("#medicalcardname").val() == ''){
        return;
    }
    MedicalCard.addMedicalCard(route.branchid,$("#medicalcardname").val()).then(data => {
        
       let html='';
       data.forEach((medicalcardname,index) => 
            html += `<option value='${medicalcardname.id}'>${medicalcardname.name}</option>`
        )
        $("#medicalcard").html(html);
   })
   .catch(error => {
       //console.log(error)
   })
});

$(document).on("click","#deletemedicalcard",function(e){
    if($("#medicalcard").val() == ''){
        return;
    }
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
            MedicalCard.deleteMedicalCard(route.branchid,$("#medicalcard").val()).then(data => {
                
            let html='';
            data.forEach((medicalcardname,index) => 
                    html += `<option value='${medicalcardname.id}'>${medicalcardname.name}</option>`
                )
                $("#medicalcard").html(html);
        })
        .catch(error => {
            //console.log(error)
        })
        }
    });
});

$(document).on("click","#btneditmedicalcard",function(e){
    if ($("#medicalcard").val() =='') return;
    $("#medicalcardname_edit").val($( "#medicalcard option:selected" ).text());
    $('#modal_edit_medicalcard').modal('show');
}); 

  $(document).on("click","#btn_modal_edit_medicalcard",function(e){
    if ($("#unit_edit").val() =='') return;
        MedicalCard.editMedicalCard(route.branchid,$("#medicalcardname_edit").val(),$("#medicalcard").val()).then(data => {
            
        let html='';
        data.forEach((medicalcardname,index) => 
                html += `<option value='${medicalcardname.id}'>${medicalcardname.name}</option>`
            )
            $("#medicalcard").html(html);
    })
    .catch(error => {
        //console.log(error)
    })
  }); 

  $("#hospitalprovince").change(function(){
    Geo.amphur($(this).val()).then(data => {
        let html = "<option value=''></option>";
        data.forEach((amphur,index) => 
            html += `<option value='${amphur.id}'>${amphur.name}</option>`
        )
        $("#hospitaltambol").html('');
        $("#hospitalamphur").html(html);
        $("#hospitalamphur option:contains("+$('#hospitalamphur').val()+")").attr('selected', true).change();

    })
    .catch(error => {
        console.log(error)
    })
});
$("#hospitalamphur").change(function(){
    Geo.tambol($(this).val()).then(data => {
        let  html = "<option value=''></option>";
        data.forEach((tambol,index) => 
            html += `<option value='${tambol.id}'>${tambol.name}</option>`
        )
        $("#hospitaltambol").html(html);
        $("#hospitaltambol option:contains("+$('#hospitaltambol').val()+")").attr('selected', true).change();
    })
    .catch(error => {
        console.log(error)
    })
});


$(document).on("click","#btn_modal_create_medicalcard",function(e){
    if ($("#hospitalname").val() =='' || $("#hospitaladdress").val() =='') return;
        HospitalList.addHospitalList(route.branchid,$("#hospitalname").val(),$("#hospitaladdress").val(),$("#hospitalprovince").val(),$("#hospitalamphur").val(),$("#hospitaltambol").val(),$("#hospitalphone").val()).then(data => {
        
        let html='';
        data.forEach((hospitallist,index) => 
                html += `<option value='${hospitallist.id}'>${hospitallist.name}</option>`
            )
            $("#mainhospital").html(html);
            $("#subhospital").html(html);
            $.toast({
                heading: 'SUCCESS',
                text: `เพิ่มโรงพยาบาลสำเร็จ`,
                showHideTransition: 'slide',
                position: 'top-center',
                hideAfter: 2000,
                class: 'kanit',
                icon: 'success'
            })
    })
    .catch(error => {
        //console.log(error)
    })
  }); 
   var amphurid;
   var tambolid;
  $(document).on("click","#btnedithospitallist",function(e){
    if ($("#mainhospital").val() == '') return;
    HospitalList.searchHospital($("#mainhospital").val()).then(data => {
        $("#hospitalname_edit").val(data.name)
        $("#hospitaladdress_edit").val(data.address)
        $("#hospitalphone_edit").val(data.phone)
        amphurid = data.amphur_id;
        tambolid = data.tambol_id;
        $("#hospitalprovince_edit option").filter(function() { return $(this).val() == data.province_id; }).attr('selected', true).change();
      })
      .catch(error => {
          // console.log(error)
      })
    $('#modal_edit_hospital').modal('show');
}); 

$("#hospitalprovince_edit").change(function(){
    Geo.amphur($(this).val()).then(data => {
        let  html = "";
        data.forEach((amphur,index) => 
            html += `<option value='${amphur.id}'>${amphur.name}</option>`
        )
        $("#hospitalamphur_edit").html(html);
        $("#hospitalamphur_edit option").filter(function() { return $(this).val() == amphurid; }).attr('selected', true).change();
    })
    .catch(error => {
        console.log(error)
    })
});
$("#hospitalamphur_edit").change(function(){
    Geo.tambol($(this).val()).then(data => {
        let  html = "";
        data.forEach((tambol,index) => 
            html += `<option value='${tambol.id}'>${tambol.name}</option>`
        )
        $("#hospitaltambol_edit").html(html);
        $("#hospitaltambol_edit option").filter(function() { return $(this).val() == tambolid; }).attr('selected', true).change();
    })
    .catch(error => {
        console.log(error)
    })
});

$(document).on("click","#btn_modal_edit_hospitallist",function(e){
    if ($("#mainhospital").val() =='') return;
    HospitalList.editHospitalList(route.branchid,$("#mainhospital").val(),$("#hospitalname_edit").val(),$("#hospitaladdress_edit").val(),$("#hospitalprovince_edit").val(),$("#hospitalamphur_edit").val(),$("#hospitaltambol_edit").val(),$("#hospitalphone_edit").val()).then(data => {
        let html='';
        data.forEach((hospitallist,index) => 
                html += `<option value='${hospitallist.id}'>${hospitallist.name}</option>`
            )
            $("#mainhospital").html(html);
            $("#subhospital").html(html);
    })
    .catch(error => {
        //console.log(error)
    })
  }); 

  $(document).on("click","#deletehospitallist",function(e){
    if($("#mainhospital").val() == ''){
        return;
    }
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
            HospitalList.deleteHospitalList(route.branchid,$("#mainhospital").val()).then(data => {
                let html='';
                data.forEach((hospitallist,index) => 
                    html += `<option value='${hospitallist.id}'>${hospitallist.name}</option>`
                )
                $("#mainhospital").html(html);
                $("#subhospital").html(html);
        })
        .catch(error => {
            //console.log(error)
        })
        }
    });
});

var f=0;
$(document).on("click","#btn_modal_medicalcard",function(e){
    if($("#icd10name").val() == 0){
        return;
    }
    f++;
     var html = `
     <div class="row medicalcardclass${f}" >							
        <div class="col-md-1">
            <div class="form-group">
                <input type="text" name="medicalcard[${f}]" id="medicalcard${f}" value="${$("#medicalcard").val()}" class="form-control" >
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <input type="text" name="medicalcardnumber[${f}]" id="medicalcardnumber${f}" value="${$("#medicalcardnumber").val()}" class="form-control" >
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <input type="text" name="mainhospital[${f}]" id="mainhospital${f}" value="${$("#mainhospital").val()}" class="form-control" >
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <input type="text" name="subhospital[${f}]" id="subhospital${f}" value="${$("#subhospital").val()}" class="form-control" >
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <input type="text" name="activedate[${f}]" id="activedate${f}" value="${$("#activedate").val()}" class="form-control" >
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <input type="text" name="expireddate[${f}]" id="expireddate${f}" value="${$("#expireddate").val()}" class="form-control" >
            </div>
        </div>
        <div class="col-md-1">
            <div class="form-group">
                <input type="text" name="credit[${f}]" id="credit${f}" value="${$("#credit").val()}" class="form-control" >
            </div>
        </div>
    </div>`;
     $('#medicalcard_wrapper').append(html);
    var tr = `<tr class="medicalcardclass${f}">	
    <td> ${$('#medicalcard').find(':selected').data('name')}</td>  
    <td> ${$('#medicalcardnumber').val()}</td>                                     
    <td> ${$('#mainhospital').find(':selected').data('name')}</td>  
    <td> ${$('#subhospital').find(':selected').data('name')}</td>  
    <td> ${$('#credit').val()}</td>  
    <td> ${$('#activedate').val()}</td>  
    <td> ${$('#expireddate').val()}</td>    
    <td> <a type="button" data-id="medicalcardclass${f}"  class="btn btn-danger-400 btn-sm deletemedicalcardclass" ><i class="icon-trash danger"></i></a></td>
    </tr>`;
    $('#medicalcard_wrapper_tr').append(tr);
});
$(document).on("click",".deletemedicalcardclass",function(e){
    $("."+$(this).data('id')).remove();
}); 

$(function () {
    $('#activedate').bootstrapMaterialDatePicker({
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
    $('#expireddate').bootstrapMaterialDatePicker({
        format: 'DD/MM/YYYY',
        clearButton: true,
        weekStart: 1,
        cancelText: "ยกเลิก",
        okText: "ตกลง",
        clearText: "เคลียร์",
        time: false
    });
});

var g =0;
$(document).on("click","#btn_modal_patient_note",function(e){
    if($("#patientnote").val() == 0){
        return;
    }
    g++;
     var html = `
     <div class="row patientnoteclass${g}" >	
        <div class="col-md-3">
            <div class="form-group">
                <input type="text" name="adddate[${g}]" id="adddate${g}" value="${DateTime.getTodayThai()}" class="form-control" >
            </div>
        </div>						
        <div class="col-md-9">
            <div class="form-group">
                <input type="text" name="patientnote[${g}]" id="patientnote${g}" value="${$("#patientnote").val()}" class="form-control" >
            </div>
        </div>
    </div>`;
     $('#patientnote_wrapper').append(html);
    var tr = `<tr class="patientnoteclass${g}">	
    <td> ${DateTime.getTodayThai()} </td>   
    <td style="word-break:break-all"> ${$("#patientnote").val()} </td>                                                
    <td> <a type="button" data-id="patientnoteclass${g}"  class="btn btn-danger-400 btn-sm deletepatientnoteclass" ><i class="icon-trash danger"></i></a></td>
    </tr>`;
    
    $('#patientnote_wrapper_tr').append(tr);
}); 

$(document).on("click",".deletepatientnoteclass",function(e){
     $("."+$(this).data('id')).remove();
}); 

$(document).on("click","#btn_modal_contact_editview",function(e){
    if($("#contactname").val() == '' || $("#contactlastname").val() == '' || $("#relation").val() == ''){
        return;
    }
    Patient.addContactPerson(route.patientid,$("#contactprefix").val(),$("#contactname").val(),$("#contactlastname").val(),$("#relation").val(),$("#contactphone").val(),$("#contactemail").val()).then(data => {
       let html='';
       data.forEach(function (contactperson,index) {
           html += `<tr>
                       <td>${contactperson.prefix['name']}${contactperson['name']} ${contactperson['lastname']} </td>
                       <td>${contactperson['relation']}</td>
                       <td>${contactperson['phone']}</td>                   
                       <td>${contactperson['email']}</td> 
                       <td>                                                                                                      
                       <a type="button" data-id="${contactperson['id']}"  class="btn btn-danger-400 btn-sm" id="deletecontactperson_editview" ><i class="icon-trash danger"></i></a>
                       </td>
                   <tr>`
           });
        $("#contact_wrapper_tr").html(html);
   })
   .catch(error => {
       //console.log(error)
   })
});

$(document).on("click","#deletecontactperson_editview",function(e){
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
            Patient.deleteContactPerson(route.patientid,$(this).data('id')).then(data => {
                var html='';
                data.forEach(function (contactperson,index) {
                    html += `<tr>
                                <td>${contactperson.prefix['name']}${contactperson['name']} ${contactperson['lastname']} </td>
                                <td>${contactperson['relation']}</td>
                                <td>${contactperson['phone']}</td>                   
                                <td>${contactperson['email']}</td> 
                                <td>                                                                                                      
                                <a type="button" data-id="${contactperson['id']}"  class="btn btn-danger-400 btn-sm" id="deletecontactperson_editview" ><i class="icon-trash danger"></i></a>
                                </td>
                            <tr>`
                    });
                 $("#contact_wrapper_tr").html(html);
           })
           .catch(error => {
               // console.log(error)
           })
        }
    });
}); 

$(document).on("click","#btn_modal_medicalcard_editview",function(e){
    if($("#medicalcardnumber").val() == '' || $("#credit").val() == '' ){
        return;
    }
    Patient.addMedicalCard(route.patientid,$("#medicalcard").val(),$("#medicalcardnumber").val(),$("#mainhospital").val(),$("#subhospital").val(),$("#activedate").val(),$("#expireddate").val(),$("#credit").val()).then(data => {
       let html='';
       console.log(data);
       data.forEach(function (medicalcard,index) {
           html += `<tr>
                       <td>${medicalcard.patientmedicalcardtype['name']} </td>
                       <td>${medicalcard['medicalcardnumber']}</td>
                       <td>${medicalcard.mainhospitallist['name']}</td>                   
                       <td>${medicalcard.subhospitallist['name']}</td> 
                       <td>${medicalcard.activedatethai}</td>
                       <td>${medicalcard.expireddatethai}</td>
                       <td>${medicalcard['credit']}</td>
                       <td>                                                                                                      
                       <a type="button" data-id="${medicalcard['id']}"  class="btn btn-danger-400 btn-sm" id="deletemedicalcardclass_editview" ><i class="icon-trash danger"></i></a>
                       </td>
                   <tr>`
           });
        $("#medicalcard_wrapper_tr").html(html);
   })
   .catch(error => {
       //console.log(error)
   })
});

$(document).on("click","#deletemedicalcardclass_editview",function(e){
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
            Patient.deleteMedicalCard(route.patientid,$(this).data('id')).then(data => {
                var html='';
                data.forEach(function (medicalcard,index) {
                    html += `<tr>
                                <td>${medicalcard.patientmedicalcardtype['name']} </td>
                                <td>${medicalcard['medicalcardnumber']}</td>
                                <td>${medicalcard.mainhospitallist['name']}</td>                   
                                <td>${medicalcard.subhospitallist['name']}</td> 
                                <td>${medicalcard.activedatethai}</td>
                                <td>${medicalcard.expireddatethai}</td>
                                <td>${medicalcard['credit']}</td>
                                <td>                                                                                                      
                                <a type="button" data-id="${medicalcard['id']}"  class="btn btn-danger-400 btn-sm" id="deletemedicalcardclass_editview" ><i class="icon-trash danger"></i></a>
                                </td>
                            <tr>`
                    });
                 $("#medicalcard_wrapper_tr").html(html);
           })
           .catch(error => {
               // console.log(error)
           })
        }
    });
});

$(document).on("click","#btn_modal_patient_note_editview",function(e){
    if($("#patientnote").val() == '' ){
        return;
    }
    Patient.addPatientNote(route.patientid,$("#patientnote").val(),$('#attachfile').prop('files')[0]).then(data => {
       let html='';
       console.log(data);
       data.forEach(function (patientnote,index) {
            var download = "";
           if(patientnote['attachfile'] !== null && patientnote['attachfile'] !== ''){
                download = `<a href="${route.url}/${patientnote['attachfile']}" class=" badge bg-primary">ดาวน์โหลด</a>`;
           }
           html += `<tr>
                       <td>${patientnote.dateaddthai} </td>
                       <td>${patientnote['note']}</td>
                       <td>${download}</td>                   
                       <td>                                                                                                      
                       <a type="button" data-id="${patientnote['id']}"  class="btn btn-danger-400 btn-sm" id="deletepatientnoteclass_editview" ><i class="icon-trash danger"></i></a>
                       </td>
                   <tr>`
           });
        $("#patientnote_wrapper_tr").html(html);
   })
   .catch(error => {
       //console.log(error)
   })
});

$(document).on("click","#deletepatientnoteclass_editview",function(e){
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
            Patient.deletePatientNote(route.patientid,$(this).data('id')).then(data => {
                let html='';
                console.log(data);
                data.forEach(function (patientnote,index) {
                     var download = "";
                    if(patientnote['attachfile'] !== null && patientnote['attachfile'] !== ''){
                         download = `<a href="${route.url}/${patientnote['attachfile']}" class=" badge bg-primary">ดาวน์โหลด</a>`;
                    }
                    html += `<tr>
                                <td>${patientnote.dateaddthai} </td>
                                <td>${patientnote['note']}</td>
                                <td>${download}</td>                   
                                <td>                                                                                                      
                                <a type="button" data-id="${patientnote['id']}"  class="btn btn-danger-400 btn-sm" id="deletepatientnoteclass_editview" ><i class="icon-trash danger"></i></a>
                                </td>
                            <tr>`
                    });
                 $("#patientnote_wrapper_tr").html(html);
           })
           .catch(error => {
               // console.log(error)
           })
        }
    });
});

$(function () {
    $('#deathdate').bootstrapMaterialDatePicker({
        format: 'DD/MM/YYYY',
        clearButton: true,
        weekStart: 1,
        cancelText: "ยกเลิก",
        okText: "ตกลง",
        clearText: "เคลียร์",
        time: false
    });
});

$("#workstation").change(function(){
    Room.list($(this).val()).then(data => {
        let  html = "";
        data.forEach((room,index) => 
            html += `<option value='${room.id}'>${room.name}</option>`
        )
        $("#room").html(html);
    })
    .catch(error => {
        console.log(error)
    })
});