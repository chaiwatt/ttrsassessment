import * as WorkLoad from './workload.js'

$("#leader").on('change', function() {
    $("#main_wrapper").attr("hidden",false);
    var html = '';
    WorkLoad.getWorkLoadLeader($(this).val()).then(data => {
        data.allprojects.forEach(function (fulltbp,index) {
            var status = fulltbp.minitbp.businessplan.businessplanstatus['name'];
            if(fulltbp.minitbp.businessplan.finished == '1'){
                status = "ปิดโครงการ";
            }
            html += `<tr >                                        
                <td> ${fulltbp.updatedatth} </td>                            
                <td> ${fulltbp.minitbp['project']} </td>                         
                <td> ${fulltbp.minitbp.businessplan.company['name']} </td> 
                <td> ${status} </td> 
            </tr>`
            });
         $("#fulltbp_wrapper_tr").html(html);
        $("#total").html(data.allprojects.length);
        $("#finished").html(data.finishedprojects.length);
        $("#pending").html(data.allprojects.length-data.finishedprojects.length);
   })
   .catch(error => {})
});

$("#coleader").on('change', function() {
    $("#main_wrapper").attr("hidden",false);
    var html = '';
    WorkLoad.getWorkLoadCoLeader($(this).val()).then(data => {
        console.log(data.allprojects);
        data.allprojects.forEach(function (fulltbp,index) {
            var status = fulltbp.minitbp.businessplan.businessplanstatus['name'];
            if(fulltbp.minitbp.businessplan.finished == '1'){
                status = "ปิดโครงการ";
            }
            html += `<tr >                                        
                <td> ${fulltbp.updatedatth} </td>                            
                <td> ${fulltbp.minitbp['project']} </td>                         
                <td> ${fulltbp.minitbp.businessplan.company['name']} </td> 
                <td> ${status} </td> 
            </tr>`
            });
         $("#fulltbp_wrapper_tr").html(html);
        $("#total").html(data.allprojects.length);
        $("#finished").html(data.finishedprojects.length);
        $("#pending").html(data.allprojects.length-data.finishedprojects.length);
   })
   .catch(error => {})
});