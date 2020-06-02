import * as Assessment from './assessment.js'

 $('#chkassessment').on('change.bootstrapSwitch', function(e) {
     var status = 0
     if(e.target.checked==true){
         status =1;
     }        
        console.log($(this).data('id'));
      Assessment.addAssessment($(this).data('id'),status);
});