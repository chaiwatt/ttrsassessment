import * as Assessment from './assessment.js'

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