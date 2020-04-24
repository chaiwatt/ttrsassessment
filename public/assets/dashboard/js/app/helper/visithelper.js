import * as Patient from './patient.js'
import * as Geo from './location.js'
import * as Screen from './screen.js'
import * as Cc from './cc.js'
import * as Room from './room.js'

if($("#patientid").val() != ''){
    $('#hidden_patientid').val($("#patientid").val());
    Patient.searchPatientById(route.branchid,$("#patientid").val()).then(data => {
        // $("#prefix option").filter(function(index) { return $(this).text() === data.patientprefix['name']; }).attr('selected', 'selected').change();
        $("#prefix option").filter(function(index) { return $(this).val() == data.prefix_id }).attr('selected', 'selected').change();
        $('#name').val(data.name);
        $('#hn').val(data.hn);
        $('#lastname').val(data.lastname);
        $("#gender option").filter(function() { return $(this).val() == data.gender_id; }).attr('selected', true).change();
        $('#hid').val(data.hid);
        $("#blood option").filter(function() { return $(this).val() == data.blood_id; }).attr('selected', true).change();
        $("#drugallergy option").filter(function() { return $(this).val() == data.drugallergy_id; }).attr('selected', true).change();
        $('#dob').val(data.dobth);
        $('#phone').val(data.phone);
        $('#address').val(data.address);
        $("#province option").filter(function() { return $(this).val() == data.province_id; }).attr('selected', true).change();
        $('#hidden_amphur').val(data.amphur_id);
        $('#hidden_tambol').val(data.tambol_id);
        $('#postalcode').val(data.postalcode);
        $('#imgbase64fromcard').attr('src',`${route.url}/${data.picture}`);
        $("#contactprefix option").filter(function() { return $(this).val() == data.contactprefix_id; }).attr('selected', true).change();
        $('#contactname').val(data.contactname);
        $('#contactlastname').val(data.contactlastname);
        $('#relation').val(data.relation);
        $('#contactphone').val(data.contactphone);
        $('#contactemail').val(data.contactemail);
   })
   .catch(error => {
       // console.log(error)
   })
}

$('#searchpatient').keyup(function(){   
    console.log($(this).val());
    if ($(this).val() =='') {
        $('#patientlist').fadeOut();  
        $("#patientlist").html('');
        $('#patientid').val('');
        return;   
    }
    
    Patient.searchPatient(route.branchid,$(this).val()).then(data => {
        
        let html=`<div class="dropdown-menu" style="display: block; "position: static; width: 100%; margin-top: 0; float: none; z-index: auto;>`;
        $('#patientlist').fadeIn();
        data.forEach(function (patient,index) {
            html += `<a href="#" data-id="${patient.id}" class="dropdown-item searchpatient">${patient.name} ${patient.lastname}</a>`;
            
            });
            html += `</div>`;
        if (data.length>0) {
            $("#patientlist").html(html);
        }
    })
    .catch(error => {
        // console.log(error)
    })
});

$(document).on('click', '.searchpatient', function() {
    $('#hidden_patientid').val($(this).data('id'));
    console.log($(this).data('id'));
    $('#patientlist').fadeOut();  
    Patient.searchPatientById(route.branchid,$(this).data('id')).then(data => {
        // $("#prefix option").filter(function(index) { return $(this).text() === data.patientprefix['name']; }).attr('selected', 'selected').change();
        $("#prefix option").filter(function(index) { return $(this).val() == data.prefix_id }).attr('selected', 'selected').change();
        $('#name').val(data.name);
        $('#hn').val(data.hn);
        $('#lastname').val(data.lastname);
        $("#gender option").filter(function() { return $(this).val() == data.gender_id; }).attr('selected', true).change();
        $('#hid').val(data.hid);
        $("#blood option").filter(function() { return $(this).val() == data.blood_id; }).attr('selected', true).change();
        $("#drugallergy option").filter(function() { return $(this).val() == data.drugallergy_id; }).attr('selected', true).change();
        $('#dob').val(data.dobth);
        $('#phone').val(data.phone);
        $('#address').val(data.address);
        $("#province option").filter(function() { return $(this).val() == data.province_id; }).attr('selected', true).change();
        $('#hidden_amphur').val(data.amphur_id);
        $('#hidden_tambol').val(data.tambol_id);
        $('#postalcode').val(data.postalcode);
        $('#imgbase64fromcard').attr('src',`${route.url}/${data.picture}`);
        $("#contactprefix option").filter(function() { return $(this).val() == data.contactprefix_id; }).attr('selected', true).change();
        $('#contactname').val(data.contactname);
        $('#contactlastname').val(data.contactlastname);
        $('#relation').val(data.relation);
        $('#contactphone').val(data.contactphone);
        $('#contactemail').val(data.contactemail);
        
   })
   .catch(error => {
       // console.log(error)
   })
});

$("#province").change(function(){
    Geo.amphur($(this).val()).then(data => {
        let  html = "";
        data.forEach((amphur,index) => 
            html += `<option value='${amphur.id}'>${amphur.name}</option>`
        )
        $("#amphur").html(html);
        $("#amphur option").filter(function() { return $(this).val() == $('#hidden_amphur').val(); }).attr('selected', true).change();
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
        $("#tambol option").filter(function() { return $(this).val() == $('#hidden_tambol').val(); }).attr('selected', true).change();
    })
    .catch(error => {
        console.log(error)
    })
});

$(document).on("click","#btn_modal_add_quickscreen",function(e){
    if ($("#quickscreenmodal").val() =='') return;
    Screen.addQuickScreen(route.branchid,$("#quickscreenmodal").val()).then(data => {
            $("#quickscreen").val(data.name);
        })
        .catch(error => {
            // console.log(error)
        })
}); 

$('#quickscreen').keyup(function(){   
    if ($(this).val() =='') {
        $('#quickscreenlist').fadeOut();  
        $("#quickscreenlist").html('');
        $('#quickscreen').val('');
        return;   
    }
    
    Screen.searchQuickScreen(route.branchid,$(this).val()).then(data => {
        let html=`<div class="dropdown-menu" style="display: block; "position: static; width: 100%; margin-top: 0; float: none; z-index: auto;>`;
        $('#quickscreenlist').fadeIn();
        data.forEach(function (quickscreen,index) {
            html += `<a href="#" data-id="${quickscreen.id}" class="dropdown-item searchquickscreen">${quickscreen.name}</a>`;
            
            });
            html += `</div>`;
            $("#quickscreenlist").html(html);
    })
    .catch(error => {
        // console.log(error)
    })
});

$(document).on('click', '.searchquickscreen', function() {
    $("#quickscreen").attr("data-id",$(this).data('id'));
    $('#quickscreen').val($(this).text());
    $('#cc').append($(this).text() + `\n`); 
    $('#quickscreenlist').fadeOut();  
});

$(document).on("click","#btneditquickscreen",function(e){
    if ($('#quickscreen').val() =='') return;
    $("#quickscreen_edit").val($('#quickscreen').val());
    $('#modal_edit_quickscreen').modal('show');
}); 

$(document).on("click","#btn_modal_edit_quickscreen",function(e){
    if ($("#quickscreen_edit").val() =='') return;
    Screen.editQuickScreen(route.branchid,$('#quickscreen').data('id'), $("#quickscreen_edit").val()).then(data => {
            $('#quickscreen').val(data.name);
        })
        .catch(error => {
            // console.log(error)
        })
}); 

$(document).on("click","#btndeletequickscreen",function(e){
    if ($('#quickscreen').val() =='') return;
    Swal.fire({
        title: 'คำเตือน!',
        text: `ต้องการลบ "${$('#quickscreen').val()}" หรือไม่`,
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'ยืนยันลบ',
        cancelButtonText: 'ยกเลิก',
        closeOnConfirm: false,
        closeOnCancel: false
        }).then((result) => {
        if (result.value) {
            Screen.deleteQuickScreen(route.branchid,$('#quickscreen').data('id')).then(data => {
                $('#quickscreen').val('') ;
            })
            .catch(error => {
                // console.log(error)
            })
        }
    });
}); 

$(document).on("click","#btnaddcctemplate",function(e){
    $("#cctemplatenamedetail").val($('#cc').val());
    $('#modal_add_cctemplate').modal('show');
}); 

$(document).on("click","#btn_modal_add_cctemplate",function(e){
    if ($("#cctemplatename").val() =='' || $("#cctemplatenamedetail").val() =='') return;   
    Cc.addCcTemplate(route.branchid,$("#cctemplatename").val(),$("#cctemplatenamedetail").val()).then(data => {
            
        })
        .catch(error => {
            // console.log(error)
        })
}); 

$(document).on("click","#btneditcctemplate",function(e){
    $('#modal_edit_cctemplate').modal('show');
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