$( document ).ready(function() {
    getTimeLine('1').then(data => {
        // data.allprojects.forEach(function (fulltbp,index) {
        //     var status = fulltbp.minitbp.businessplan.businessplanstatus['name'];
        //     if(fulltbp.minitbp.businessplan.finished == '1'){
        //         status = "ปิดโครงการ";
        //     }
        //     html += `<tr >                                        
        //         <td> ${fulltbp.updatedatth} </td>                            
        //         <td> ${fulltbp.minitbp['project']} </td>                         
        //         <td> ${fulltbp.minitbp.businessplan.company['name']} </td> 
        //         <td> ${status} </td> 
        //     </tr>`
        //     });
        //  $("#fulltbp_wrapper_tr").html(html);
        // $("#total").html(data.allprojects.length);
        // $("#finished").html(data.finishedprojects.length);
        // $("#pending").html(data.allprojects.length-data.finishedprojects.length);
   }).catch(error => {})
});

function getTimeLine(userid){
    return new Promise((resolve, reject) => {
        $.ajax({
          url: `${route.url}/dashboard/company/report/gettimeline`,
          type: 'POST',
          headers: {"X-CSRF-TOKEN":route.token},
          data: {
            'userid': userid
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