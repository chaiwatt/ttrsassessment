import * as Category from './pagecategory.js'
import * as Tag from './pagetag.js'

$(document).on("click","#btn_modal_create_category",function(e){
    if ($("#modalcreatecategory").val() =='') return;
    Category.addCategory($("#modalcreatecategory").val()).then(data => {
        let html ='';
        data.forEach((category,index) => 
                html += `<option value='${category.id}'>${category.name}</option>`
            )
        $("#pagecategory").html(html);
    })
    .catch(error => {
        //console.log(error)
    })
});

$(document).on("click","#editcategory",function(e){
    if ($("#pagecategory").val() =='') return;
    $("#modalcategory_edit").val($("#pagecategory option:selected").text());
    $('#modal_edit_category').modal('show');
}); 

$(document).on("click","#btn_modal_edit_category",function(e){
    if ($("#modalcategory_edit").val() =='' || $("#pagecategory").val() =='') return;
    Category.editCategory($("#pagecategory").val(),$("#modalcategory_edit").val()).then(data => {
        let html ='';
        data.forEach((category,index) => 
                html += `<option value='${category.id}'>${category.name}</option>`
            )
        $("#pagecategory").html(html);
    })
    .catch(error => {
        //console.log(error)
    })
});

$(document).on("click","#deletecategory",function(e){
    if($("#pagecategory").val() == ''){
        return;
    }
    Swal.fire({
        title: 'คำเตือน!',
        text: `ต้องการลบรายการ ${$("#pagecategory option:selected").text()} หรือไม่`,
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'ยืนยันลบ',
        cancelButtonText: 'ยกเลิก',
        closeOnConfirm: false,
        closeOnCancel: false
        }).then((result) => {
        if (result.value) {
            Category.deleteCategory($("#pagecategory").val()).then(data => {
                let html ='';
                data.forEach((category,index) => 
                        html += `<option value='${category.id}'>${category.name}</option>`
                    )
                $("#pagecategory").html(html);
            })
        .catch(error => {
            //console.log(error)
        })
        }
    });
});


$(document).on("click","#btn_modal_create_tag",function(e){
    if ($("#modalcreatetag").val() =='') return;
    Tag.addTag($("#modalcreatetag").val()).then(data => {
        let html ='';
        data.forEach((tag,index) => 
                html += `<option value='${tag.id}'>${tag.name}</option>`
            )
        $("#pagetag").html(html);
    })
    .catch(error => {
        //console.log(error)
    })
});

$(document).on("click","#edittag",function(e){
    var count = $("#pagetag :selected").length;
    if(count == 0 || count > 1){
        Swal.fire({
            title: 'ผิดพลาด...',
            text: 'เลือกรายการไม่ถูกต้อง!',
            }).then((result) => {
                // alert(createhospitallink);
            })
        return;
    }
    $("#modaltag_edit").val($("#pagetag option:selected").text());
    $('#modal_edit_tag').modal('show');
}); 
//  parseInt(sVal)
$(document).on("click","#btn_modal_edit_tag",function(e){
    if ($("#modaltag_edit").val() =='' || $("#pagetag").val() =='') return;
    Tag.editTag(parseInt($("#pagetag").val()),$("#modaltag_edit").val()).then(data => {
        let html ='';
        data.forEach((tag,index) => 
                html += `<option value='${tag.id}'>${tag.name}</option>`
            )
        $("#pagetag").html(html);
    })
    .catch(error => {
        //console.log(error)
    })
});

$(document).on("click","#deletetag",function(e){
    var count = $("#pagetag :selected").length;
    if(count == 0 || count > 1){
               Swal.fire({
                title: 'ผิดพลาด...',
                text: 'เลือกรายการไม่ถูกต้อง!',
                }).then((result) => {
                    // alert(createhospitallink);
                })
        return;
    }
    Swal.fire({
        title: 'คำเตือน!',
        text: `ต้องการลบรายการ ${$("#pagetag option:selected").text()} หรือไม่`,
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'ยืนยันลบ',
        cancelButtonText: 'ยกเลิก',
        closeOnConfirm: false,
        closeOnCancel: false
        }).then((result) => {
        if (result.value) {
            Tag.deleteTag(parseInt($("#pagetag").val())).then(data => {
                let html ='';
                data.forEach((tag,index) => 
                        html += `<option value='${tag.id}'>${tag.name}</option>`
                    )
                $("#pagetag").html(html);
            })
        .catch(error => {
            //console.log(error)
        })
        }
    });
});
