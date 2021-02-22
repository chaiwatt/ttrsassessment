@extends('layouts.dashboard.main')
@section('pageCss')
<link href="{{asset('assets/dashboard/plugins/summernote/summernote.min.css')}}" rel="stylesheet">
@stop
@section('content')
    {{-- modal create announce --}}
    <div id="modal_add_announce" class="modal fade" style="overflow:hidden;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;เอกสารแนบประกาศ</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>โปรดระบุชื่อเอกสาร</label><span class="text-danger">*</span>
                                <input type="text" id="announceattachmentname" placeholder="โปรดระบุชื่อเอกสาร" class="form-control form-control-lg stringformat30">
                            </div>
                        </div>
                        <div class="col-md-12">	
                            <div class="input-group">													
                                <button id="btnuploadcertify" class="btn btn-info  btn-icon ml-2 btn-sm float-left" type="button" onclick="document.getElementById('announce').click();" >อัปโหลดไฟล์</button>													
                            </div>
                            <input type="file" style="display:none;" data-id="" id="announce" name="announce" />
                        </div>
                    </div>
                </div>           
                <div class="modal-footer">
                    <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
                
                </div>
            </div>
        </div>
    </div>
    {{-- modal edit announce --}}
    <div id="modal_edit_announce" class="modal fade" style="overflow:hidden;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="icon-menu7 mr-2"></i> &nbsp;แก้ไขประกาศ</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>ประกาศ</label><span class="text-danger">*</span>
                                <input type="text" id="modalannounce_edit" placeholder="ประกาศ" class="form-control form-control-lg" >
                            </div>
                        </div>
                    </div>
                </div>           
                <div class="modal-footer">
                    <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross2 font-size-base mr-1"></i> ปิด</button>
                    <button id="btn_modal_edit_announce" class="btn bg-primary" data-dismiss="modal"><i class="icon-checkmark3 font-size-base mr-1"></i> แก้ไขหมวดหมู่</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Page header -->
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">เพิ่มหน้าเพจ</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> ตั้งค่า</a>
                    <a href="#" class="breadcrumb-item"> เว็บไซต์</a>
                    <a href="{{route('setting.admin.website.page')}}" class="breadcrumb-item"> หน้าเพจ</a>
                    <span class="breadcrumb-item active">เพิ่มหน้าเพจ</span>
                </div>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>
    </div>
    <!-- /page header -->

    <!-- Content area -->
    <div class="content">
        @if (Session::has('success'))
            <div class="alert alert-success alert-styled-left alert-arrow-left alert-dismissible">
                <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                {{ Session::get('success') }}
            </div>
        @elseif( Session::has('error') )
            <div class="alert alert-warning alert-styled-left alert-dismissible">
                <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                {{ Session::get('error') }}
            </div>
        @endif
        @if ($errors->count() > 0)
            <div class="alert alert-warning alert-styled-left alert-dismissible">
                <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                {{ $errors->first() }}
            </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{route('setting.admin.website.announce.createsave')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">	
                                <div class="col-md-12">
                                    <fieldset>	
                                        <div class="form-group">
                                            <label>หมวดประกาศ</label>
                                            <select name="announcecategory" placeholder="เมนู" class="form-control form-control-select2">
                                                <option value="" >=== เลือกหมวดประกาศ ===</option>
                                                @foreach ($announcecategories as $announcecategory)
                                                    <option value="{{$announcecategory->id}}" >{{$announcecategory->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>หัวเรื่อง<span class="text-danger">*</span></label>
                                            <input type="text"  name="title" value="{{old('title')}}"  placeholder="หัวเรื่อง" class="form-control form-control-lg">
                                        </div>
                                        <div class="form-group">
                                            <label>ข้อมูลประกาศ<span class="text-danger">*</span></label>
											<textarea name="content" id="summernote" class="form-control mb-3" rows="7" cols="1" placeholder="บทความ"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <div id="input_attachment_wrapper"></div>
                                            <label for="">แนบเอกสาร</label>
                                            <a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal_add_announce">คลิกเพิ่ม</a> 
                                                <div class="table-responsive mt-2">
                                                    <table class="table table-bordered table-striped">
                                                        <thead>
                                                            <tr class="bg-info">
                                                                <th style="width:80%">ไฟล์</th> 
                                                                <th style="width:20%">เพิ่มเติม</th>                                                                                   
                                                            </tr>
                                                        </thead>
                                                        <tbody id="announceattachment_wrapper_tr"> 
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>                               
                                        <div class="form-group">
                                            <label>สถานะการแสดง</label>
                                            <select name="status" placeholder="สถานะการแสดง" class="form-control form-control-select2">
                                                @foreach ($pagestatuses as $pagestatus)
                                                    <option value="{{$pagestatus->id}}" >{{$pagestatus->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn bg-teal">บันทึก <i class="icon-paperplane ml-2"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /form layouts -->
    </div>
    <!-- /content area -->
@endsection
@section('pageScript')
<script src="{{asset('assets/dashboard/plugins/summernote/summernote.min.js')}}"></script>
<script type="module" src="{{asset('assets/dashboard/js/app/helper/pagehelper.js')}}"></script>

<script  type="text/javascript">
	var route = {
        url: "{{ url('/') }}",
        token: $('meta[name="csrf-token"]').attr('content')
    };
    $(document).ready(function() {
        $('#summernote').summernote({
            height: 300,
        });
    });
    $("#announce").on('change', function() {
    var file = this.files[0];
    console.log(file);
    if (this.files[0].size/1024/1024*1000 > 1000 ){
        alert('ไฟล์ขนาดมากกว่า 1 MB');
        return ;
    }
    
    var inpattachments = $('.input_attachment').map(function() {
        return $(this).val();
    }).toArray();

    var formData = new FormData();
    formData.append('file',file);
    formData.append('announceattachmentname',$('#announceattachmentname').val());
    formData.append('inpattachments',JSON.stringify(inpattachments));

    $.ajax({
        url: `${route.url}/setting/admin/website/announce/upload`, 
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: formData,
        contentType: false,
        processData: false,
        success: function(data){
            var inp = `<input name="input_attachment[]" value="${data.file.id}" data-id="${data.file.id}" class="input_attachment" hidden >`;
            $('#input_attachment_wrapper').append(inp);
            var html = ``;
            data.announceattachments.forEach(function (announceattachment,index) {
                html += `<tr >                                        
                    <td> ${announceattachment.name} </td>                                            
                    <td> 
                        <a href="${route.url}/${announceattachment.path}" class=" btn btn-sm bg-primary">ดาวน์โหลด</a>
                        <a type="button" data-id="${announceattachment.id}" data-name="" class="btn btn-sm bg-danger deleteannounceattachment">ลบ</a>                                       
                    </td>
                </tr>`
                });
            $('#modal_add_announce').modal('hide');
            $("#announceattachment_wrapper_tr").html(html);
        }
    });
});

$(document).on("click",".deleteannounceattachment",function(e){
    var inpattachments = $('.input_attachment').map(function() {
        return $(this).val();
    }).toArray();
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
            deleteAnnounceAttachment($(this).data('id'),inpattachments).then(data => {
                var html='';
                $("input[name='input_attachment[]'][data-id='" + data.id + "']").remove();
                data.announceattachments.forEach(function (announceattachment,index) {
                html += `<tr >                                        
                    <td> ${announceattachment.name} </td>                                            
                    <td> 
                        <a href="${route.url}/${announceattachment.path}" class=" btn btn-sm bg-primary">ดาวน์โหลด</a>
                        <a type="button" data-id="${announceattachment.id}" data-name="" class="btn btn-sm bg-danger deleteannounceattachment">ลบ</a>                                       
                    </td>
                </tr>`
                });
            $("#announceattachment_wrapper_tr").html(html);
           })
           .catch(error => {})
        }
    });
});


function deleteAnnounceAttachment(id,inpattachments){
    return new Promise((resolve, reject) => {
        $.ajax({
            url: `${route.url}/setting/admin/website/announce/deleteattachment`,
            type: 'POST',
            headers: {"X-CSRF-TOKEN":route.token},
            data: {
            id : id,
            inpattachments: JSON.stringify(inpattachments)
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

</script>
@stop
