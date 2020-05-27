
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
                console.log(data)
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
               // console.log(error)
           })
        }
    });
});

$("#attachment").on('change', function() {
    var file = this.files[0];

    if (this.files[0].size/1024/1024*1000 > 1000 ){
        alert('ไฟล์ขนาดมากกว่า 1 MB');
        return ;
    }
    return ;
    // var inpattachments = $('.input_attachment').map(function() {
    //     return $(this).val();
    // }).toArray();

    // var formData = new FormData();
    // formData.append('file',file);
    // formData.append('inpattachments',JSON.stringify(inpattachments));

    //     $.ajax({
    //         url: `${route.url}/api/message/uploadattachment`,  //Server script to process data
    //         type: 'POST',
    //         headers: {"X-CSRF-TOKEN":route.token},
    //         data: formData,
    //         contentType: false,
    //         processData: false,
    //         success: function(data){
    //             console.log(data)
    //             var inp = `<input name="input_attachment[]" value="${data.file.id}" data-id="${data.file.id}" class="input_attachment" hidden>`;
    //             $('#input_attachment_wrapper').append(inp);
    //             var html = `<ul class="media-list">`;
    //             data.messageboxattachments.forEach(function (messageboxattachment,index) {
    //                 html += 
    //                     `<li class="media">	
    //                         <div class="media-body">
    //                             <div class="text-muted">${messageboxattachment.name}</div>
    //                         </div>
    //                         <div class="ml-3 align-self-center">
    //                             <a href="#" class="list-icons-item" id="deleteattachment" data-id="${messageboxattachment.id}"><i class="icon-trash text-muted"></i></a>
    //                         </div>
    //                     </li>`
    //                 });
    //                 html +=`</ul>`;
    //              $("#attachment_wrapper").html(html);
    //     }
    // });

});