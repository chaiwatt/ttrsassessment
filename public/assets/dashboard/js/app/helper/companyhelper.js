import * as Assessment from './assessment.js'
import * as Company from './company.js'

 $('#chkassessment').on('change.bootstrapSwitch', function(e) {
     var status = 0
     if(e.target.checked==true){
         status =1;
     }        
    console.log($(this).data('id'));
    $("#spinicon").attr("hidden",false);
    Assessment.addAssessment($(this).data('id'),status).then(data => {
        $("#spinicon").attr("hidden",true);
    }).catch(error => {})
});

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
