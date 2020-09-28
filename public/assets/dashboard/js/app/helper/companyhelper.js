import * as Assessment from './assessment.js'

 $('#chkassessment').on('change.bootstrapSwitch', function(e) {
     var status = 0
     if(e.target.checked==true){
         status =1;
     }        
    console.log($(this).data('id'));
    $(".loader").addClass('is-active');
    Assessment.addAssessment($(this).data('id'),status).then(data => {
        $(".loader").removeClass('is-active');
    }).catch(error => {})
});