
import * as Businessplan from './businessplan.js'

$(document).on("click","#btn_add_performance",function(e){
    Businessplan.addPerformance($(this).data('id'),$('#performanceyear').val(),$('#performanceincome').val(),$('#performancenetprofit').val(),$('#performancetotalasset').val(),$('#performancetotalliability').val()).then(data => {
        var html='';
        data.forEach(function (performance,index) {
            html += `<tr>
                        <td>${performance.year} </td>
                        <td>${performance.income}</td>
                        <td>${performance.netprofit}</td>                   
                        <td>${performance.totalasset}</td> 
                        <td>${performance.totalasset}</td>
                        <td>                                                                                                      
                        <a type="button" data-id="${performance['id']}"  class="btn btn-danger-400 btn-sm" id="deleteexpertexpienceclass_editview" ><i class="icon-trash danger"></i></a>
                        </td>
                    <tr>`
            });
         $("#performance_wrapper_tr").html(html); 
    })
    .catch(error => {
        console.log(error)
    })
});
