
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
                        <a data-id="${performance['id']}"  class="btn btn-danger-400 btn-sm" id="deleteperformance" ><i class="icon-trash danger"></i></a>
                        </td>
                    <tr>`
            });
         $("#performance_wrapper_tr").html(html); 
    })
    .catch(error => {

    })
});

$(document).on("click","#deleteperformance",function(e){
    Swal.fire({
        title: 'คำเตือน!',
        text: `ต้องการลบรายการ `,
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
                var html='';
                data.forEach(function (performance,index) {
                    html += `<tr>
                                <td>${performance.year} </td>
                                <td>${performance.income}</td>
                                <td>${performance.netprofit}</td>                   
                                <td>${performance.totalasset}</td> 
                                <td>${performance.totalasset}</td>
                                <td>                                                                                                      
                                <a data-id="${performance['id']}"  class="btn btn-danger-400 btn-sm" id="deleteperformance" ><i class="icon-trash danger"></i></a>
                                </td>
                            <tr>`
                    });
                 $("#performance_wrapper_tr").html(html); 
           })
           .catch(error => {

           })
        }
    });
});

$("#attachment").on('change', function() {
    var file = this.files[0];
    var fextension = file.name.substring(file.name.lastIndexOf('.')+1);
    var validExtensions = ["jpg","pdf","jpeg","gif","png","bmp"];
    if(!validExtensions.includes(fextension)){
        Swal.fire({
            title: 'ผิดพลาด...',
            text: 'รูปแบบไฟล์ไม่ถูกต้อง!',
            });
        this.value = "";
        return false;
    }
    if (this.files[0].size/1024/1024*1000 > 1024 ){
        Swal.fire({
            title: 'ผิดพลาด...',
            text: 'ไฟล์ขนาดมากกว่า 1 MB!',
            });
        return ;
    }
    if (this.files[0].name.length > 70 ){
        Swal.fire({
            title: 'ผิดพลาด...',
            text: 'ชื่อไฟล์ยาวมากกว่า 70 ตัวอักษร',
            });
        return ;
    }
    return ;

});