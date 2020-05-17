import * as Category from './pagecategory.js'
import * as Tag from './pagetag.js'
import * as Upload from './upload.js'

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

// $("#singlefile").on('change', function() {

//     var formData = new FormData();
    
//     formData.append('file',file);
//     // console.log(formData );
//     // return ;

//     // var formData = new FormData();
//     // console.log (this.files[0]);
//     // return ;
//     // var file = this.files[0];
//     // console.log(file);
//     // $.ajaxSetup({
//     //         headers: {
//     //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//     //         }
//     //     });
//     // formData.append('file',file);
//     //     $.ajax({
//     //     url: "{{route('api.upload')}}",  //Server script to process data
//     //     type: 'POST',
//     //     data: formData,
//     //     contentType: false,
//     //     processData: false,
//     //     //Ajax events
//     //     success: function(html){
//     //         alert(html);
//     //     }
//     // });
//     upload(formData).then(data => {
//         console.lod(data);
//         // let html ='';
//         // data.forEach((tag,index) => 
//         //         html += `<option value='${tag.id}'>${tag.name}</option>`
//         //     )
//         // $("#pagetag").html(html);
//     })
//     .catch(error => {
//         //console.log(error)
//     })
// });

$("#singlefile").on('change', function() {

    var galleries = $('.gal').map(function() {
        return $(this).val();
    }).toArray();

  console.log(galleries);
    var formData = new FormData();
    var file = this.files[0];
    formData.append('file',file);
    formData.append('galleries',JSON.stringify(galleries));
        $.ajax({
            url: `${route.url}/api/upload/upload`,  //Server script to process data
            type: 'POST',
            headers: {"X-CSRF-TOKEN":route.token},
            data: formData,
            contentType: false,
            processData: false,
            success: function(data){
                console.log(data.gallergy)
                var inp = `<input name="gal[]" value="${data.image.id}" class="gal"> </input>                                     `;
                $('#gallery_wrapper').append(inp);
                var html = `<div class="form-group">
                            <div class="row">`;
                data.gallergy.forEach(function (gallergy,index) {
                    html += 
                            `<div class="col-sm-6 col-xl-3">
                                <div class="card">
                                    <div class="card-img-actions mx-1 mt-1">
                                        <img class="card-img img-fluid" src="${route.url}/${gallergy.image}" alt="">
                                        <div class="card-img-actions-overlay card-img">
                                            <a href="${route.url}/${gallergy.image}" class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round" data-popup="lightbox" rel="group">
                                                <i class="icon-plus3"></i>
                                            </a>
                                        </div>
                                    </div>
                        
                                    <div class="card-body">
                                        <div class="d-flex align-items-start flex-nowrap">
                                            <div class="list-icons list-icons-extended ml-auto">
                                                <a href="${route.url}/${gallergy.image}" class="list-icons-item"><i class="icon-download top-0"></i></a>
                                                <a href="{{route('setting.admin.dashboard.pageimage.delete',['id' => $pageimage->id])}}" class="list-icons-item"><i class="icon-bin top-0"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>`

                    });
                    html +=`</div></div>`;
                 $("#images_wrapper").html(html);

        }
    });
});

