import * as Expert from './expert.js'

$("#btn_modal_add_expertfield").on('click', function() {
   Expert.addExpertfield($('#expertfieldnum').val(),$('#expertfielddetail').val()).then(data => {
       if($('#expertfieldnum').val() =='' || $('#expertfielddetail').val() =='')return;
       var html ='';
       data.forEach(function (expertdoc,index) {
        html += `<tr >                                        
            <td> ${expertdoc.order} </td>                                            
            <td> ${expertdoc.detail} </td> 
            <td> 
                <a type="button" data-id="${expertdoc.id}" data-name="" class="btn badge bg-danger deleteexpertfield">ลบ</a>                                       
            </td>
        </tr>`
        });
     $("#expertfield_wrapper_tr").html(html);
    }).catch(error => {})
});

$(document).on("click",".deleteexpertfield",function(e){
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
            Expert.deleteExpertfield($(this).data('id')).then(data => {
                var html = ``;
                data.forEach(function (expertdoc,index) {
                    html += `<tr >                                        
                        <td> ${expertdoc.order} </td>                                            
                        <td> ${expertdoc.detail} </td> 
                        <td> 
                            <a type="button" data-id="${expertdoc.id}" data-name="" class="btn badge bg-danger deleteexpertfield">ลบ</a>                                       
                        </td>
                    </tr>`
                    });
                 $("#expertfield_wrapper_tr").html(html);
           })
           .catch(error => {})
        }
    });
}); 