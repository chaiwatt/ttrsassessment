
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
                        <a type="button" data-id="${performance['id']}"  class="btn btn-danger-400 btn-sm" id="deleteperformance" ><i class="icon-trash danger"></i></a>
                        </td>
                    <tr>`
            });
         $("#performance_wrapper_tr").html(html); 
    })
    .catch(error => {
        console.log(error)
    })
});

$(document).on("click","#deleteperformance",function(e){
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
            Businessplan.deletePerformance($(this).data('id')).then(data => {
                 console.log(data);
                var html='';
                data.forEach(function (performance,index) {
                    html += `<tr>
                                <td>${performance.year} </td>
                                <td>${performance.income}</td>
                                <td>${performance.netprofit}</td>                   
                                <td>${performance.totalasset}</td> 
                                <td>${performance.totalasset}</td>
                                <td>                                                                                                      
                                <a type="button" data-id="${performance['id']}"  class="btn btn-danger-400 btn-sm" id="deleteperformance" ><i class="icon-trash danger"></i></a>
                                </td>
                            <tr>`
                    });
                    // console.log(html);
                 $("#performance_wrapper_tr").html(html); 
           })
           .catch(error => {
               // console.log(error)
           })
        }
    });
});