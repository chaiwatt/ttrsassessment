import * as Ev from './ev.js';
import * as Extra from './extra.js';
var commentreadonly =``;
var evdata = [];
var evextradata = [];

const Toast = Swal.mixin({
    toast: true,
    position: 'center-end',
    showConfirmButton: false,
    timer: 2000,
    timerProgressBar: true,
    // didOpen: (toast) => {
    //   toast.addEventListener('mouseenter', Swal.stopTimer)
    //   toast.addEventListener('mouseleave', Swal.resumeTimer)
    // }
  })

$(function() {

    pdfMake.fonts = {
        THSarabun: {
            normal: 'THSarabun.ttf',
            bold: 'THSarabun-Bold.ttf',
            italics: 'THSarabun-Italic.ttf',
            bolditalics: 'THSarabun-BoldItalic.ttf'
        }
    }

    getEv($('#evid').val()).then(data => {

        $('#weight').html('(' + data.sumweigth.toFixed(3) + ')');
        $('#float-weight').html(data.sumweigth.toFixed(3));
        $('#extraweight').html('(' + data.sumextraweigth.toFixed(3) + ')');
        RenderWeightTable(data.pillaindexweigths,1);
        if (data.extracriteriatransactions.length != 0) {
            RenderExtraTable(data.extracriteriatransactions);
        }
        
        $(".loadprogress").attr("hidden",true);
        RowSpanWeight("subpillarindex");
        if (data.extracriteriatransactions.length != 0) {
            RowSpanExtra("extra_subpillarindex");
        }
        
        InitializeDataTable();
        if (data.extracriteriatransactions.length != 0) {
            InitializeDataTableExtra();
        }
       
        var cookieval = getCookie("forcedownload");
        if(cookieval == '1'){
            $('#evexporttable').DataTable().buttons(0,0).trigger();
        }else if(cookieval == '2'){
            $('#evexporttable').DataTable().buttons(0,1).trigger();
        }else if(cookieval == '3'){
            $('#evextraexporttable').DataTable().buttons(0,0).trigger();
        }else if(cookieval == '4'){
            $('#evextraexporttable').DataTable().buttons(0,1).trigger();
        }
        setCookie("forcedownload", "")
        
    }).catch(error => {})
});

function setCookie(name, value, days) {
    var expires = "";
    if (days) {
      var date = new Date();
      date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
      expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "") + expires + "; path=/";
  }
  
  function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
      var c = ca[i];
      while (c.charAt(0) == ' ') c = c.substring(1, c.length);
      if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
  }
  

function InitializeDataTable(){
    $('#evexporttable').DataTable( {
        dom: 'Bfrtip',
        data: evdata,
        columns : [
            { "data" : "pillar" },
            { "data" : "subpillar" },
            { "data" : "subpillarindex" },  
            { "data" : "weight" }
        ],

        searching: false,
        paging:   false,
        ordering: false,
        info:     false,
        pageLength : 10,
        language: {
            zeroRecords: " ",
            search: "ค้นหา: ",  
            sLengthMenu: "จำนวน _MENU_ รายการ",
            info: "จำนวน _START_ - _END_ จาก _TOTAL_ รายการ",
            paginate: {
                previous: 'ก่อนหน้า',
                next: 'ถัดไป'
            }
        },
        buttons: [
            { 
                extend: 'excelHtml5',
                className: 'btn-primary',
                text: 'Excel',
                title: function () { 
                    return null; 
                },
                filename: function() {
                    return "รายการ EV Weight(Index Criteria) โครงการ" + $('#projectname') .val()     
                }, 
                exportOptions: {
                    columns: [ 0, 1,2,3 ]
                },
                customize: function( xlsx ) {
                    var source = xlsx.xl['workbook.xml'].getElementsByTagName('sheet')[0];
                    source.setAttribute('name','โครงการ' + $('#projectname').val());
                }, 
            },
            { 
                extend: 'pdfHtml5',
                // pageSize: 'A4',
                // orentation: 'landscape',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                customize: function(doc) {
                    doc.defaultStyle = {
                        font:'THSarabun',
                        fontSize:14                                 
                    };
                    doc.styles.title.alignment = 'left';
                    doc.pageMargins = [30, 30, 30, 30];
                    doc.content[1].table.widths = ['*','*', '*', '*']
                    var rowCount = doc.content[1].table.body.length;
                    for (var i = 1; i < rowCount; i++) {
                        doc.content[1].table.body[i][0].alignment = 'left';
                        doc.content[1].table.body[i][3].alignment = 'center';
                    }
                },
                exportOptions: {
                    columns: [ 0, 1,2,3]
                },
                title: function () { 
                    return "รายการ EV Weight(Index Criteria) โครงการ" + $('#projectname') .val() ; 
                },
                filename: function() {
                    return "รายการ EV Weight(Index Criteria) โครงการ" + $('#projectname') .val()       
                }, 
            }
            
        ],
        drawCallback: function() {
            $('.buttons-excel')[0].style.visibility = 'hidden'
            $('.buttons-pdf')[0].style.visibility = 'hidden'
        }
    } );
}

function InitializeDataTableExtra(){
$('#evextraexporttable').DataTable( {
    dom: 'Bfrtip',
    data: evextradata,
    columns : [
        { "data" : "category" },
        { "data" : "criteria" },
        { "data" : "weight" }
    ],
    
    searching: false,
    paging:   false,
    ordering: false,
    info:     false,
    pageLength : 10,
    language: {
        zeroRecords: " ",
        search: "ค้นหา: ",  
        sLengthMenu: "จำนวน _MENU_ รายการ",
        info: "จำนวน _START_ - _END_ จาก _TOTAL_ รายการ",
        paginate: {
            previous: 'ก่อนหน้า',
            next: 'ถัดไป'
        }
    },
    buttons: [
        { 
            extend: 'excelHtml5',
            className: 'btn-primary',
            text: 'Excel',
            title: function () { 
                return null; 
            },
            filename: function() {
                return "รายการ EV Weight(Extra) โครงการ" + $('#projectname') .val()       
            }, 
            exportOptions: {
                columns: [ 0, 1,2]
            },
            customize: function( xlsx ) {
                var source = xlsx.xl['workbook.xml'].getElementsByTagName('sheet')[0];
                source.setAttribute('name','โครงการ' + $('#projectname').val());
            }, 
        },
        { 
            extend: 'pdfHtml5',
            pageSize: 'A4',
            // orentation: 'landscape',
            customize: function(doc) {
                doc.defaultStyle = {
                    font:'THSarabun',
                    fontSize:14                                 
                };
                doc.styles.title.alignment = 'left';
                doc.pageMargins = [30, 30, 30, 30];
                doc.content[1].table.widths = ['*','*','*']
                var rowCount = doc.content[1].table.body.length;
                for (var i = 1; i < rowCount; i++) {
                doc.content[1].table.body[i][0].alignment = 'left';
                doc.content[1].table.body[i][2].alignment = 'center';
                }
            },
            exportOptions: {
                columns: [ 0, 1,2]
            },
            title: function () { 
                return "รายการ EV Weight(Extra) โครงการ" + $('#projectname') .val(); 
            },
            filename: function() {
                return "รายการ EV Weight(Extra) โครงการ" + $('#projectname') .val() 
            }, 
        }
        
    ],
    drawCallback: function() {
        $('.buttons-excel')[1].style.visibility = 'hidden'
        $('.buttons-pdf')[1].style.visibility = 'hidden'
    }
} );
}

function getEv(evid){
    return new Promise((resolve, reject) => {
        $.ajax({
        url: `${route.url}/dashboard/admin/project/evweight/getev`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
            evid : evid
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

 $(document).on('focusin', '.weigthvalue1', function(){
    $(this).data('old', $(this).val());
 }).on('change', '.weigthvalue1', function(e) {
    $(this).val($(this).val().replace(/[^0-9\.]/g,''));

    var check = parseFloat($('#weight').html().replace(/[{()}]/g, ''));

    var newval = check + parseFloat($(this).val()) - parseFloat($(this).data('old'));

    var sum =0;
    $('.weigthvalue1').each(function(){
        var val = parseFloat($(this).val());
        sum += val;
    });

    if(sum.toFixed(3) > 1){
        Swal.fire({
            title: 'ผิดพลาด...',
            text: 'ผลรวม Weight มากกว่า 1 (ผลรวม ' + sum.toFixed(3) +')',
            });
            $(this).val($(this).data('old')) 
            return;
    }

    if(newval.toFixed(3) > 1){
        Swal.fire({
            title: 'ผิดพลาด...',
            text: 'ผลรวม Weight มากกว่า 1 (ผลรวม ' + newval.toFixed(3) +')',
            });
            $(this).val($(this).data('old')) 
            return;
    }
    editWeight($(this).data('id'),$(this).val(),1).then(data => {
        $('#weight').html('(' + data.sumweigth.toFixed(3) + ')');
        $('#float-weight').html(data.sumweigth.toFixed(3));
        // Toast.fire({
        //     title: 'Weight sum ' + data.sumweigth.toFixed(3)
        //   })
    }).catch(error => {})
});

$(document).on('focusin', '.weigthvalue', function(){
    $(this).data('old', $(this).val());
 }).on('change', '.weigthvalue', function(e) {
    $(this).val($(this).val().replace(/[^0-9\.]/g,''));
    
    var check = parseFloat($('#extraweight').html().replace(/[{()}]/g, ''));
    var sum =0;
    $('.weigthvalue').each(function(){
        var val = parseFloat($(this).val());
        sum += val;
    });
    if(sum.toFixed(3) > 1){
        Swal.fire({
            title: 'ผิดพลาด...',
            text: 'ผลรวม Weight มากกว่า 1 (ผลรวม ' + sum.toFixed(3) +')',
            });
            $(this).val($(this).data('old')) 
            return;
    }
    var newval = check + parseFloat($(this).val()) - parseFloat($(this).data('old'));
    if(newval.toFixed(3) > 1){
        Swal.fire({
            title: 'ผิดพลาด...',
            text: 'ผลรวม Weight มากกว่า 1 (ผลรวม ' + newval.toFixed(3) +')',
            });
            $(this).val($(this).data('old')) 
            return;
    }
    Extra.editExtraWeight($('#evid').val(),$(this).data('id'),$(this).val()).then(data => {
        $('#extraweight').html('(' + parseFloat(data).toFixed(3) + ')');
        // Toast.fire({
        //     title: 'Weight sum ' + parseFloat(data).toFixed(3)
        //   })
    }).catch(error => {})
});


function editWeight(id,value,evtypeid){
    return new Promise((resolve, reject) => {
        $.ajax({
        url: `${route.url}/dashboard/admin/project/evweight/editsave`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
            id : id,
            value : value,
            evtypeid : evtypeid,
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

  function RenderTable(data,evtype){
    var html =``;
    
    data.forEach(function (criteria,index) {
        if(criteria.ev_type_id == evtype){
            var criterianame = '-';
            if(criteria.criteria != null){
                criterianame = criteria.criteria['name']
            }
            html += `<tr > 
            <td> ${criteria.pillar['name']}</td>                                            
            <td> ${criteria.subpillar['name']}</td>    
            <td> ${criteria.subpillarindex['name']}</td>   
            <td> ${criterianame} </td>                                            
            </tr>`
        }
     });
     if(evtype == 1){
        $("#criteria_transaction_wrapper_tr").html(html);
    }else if(evtype == 2){
        $("#extra_criteria_transaction_wrapper_tr").html(html);
    }
}

function RenderWeightTable(data,evtypeid){
  
    var html =``;
    evdata = [];
    var readonly =`readonly`;

    if(($('#evstatus').val() == 2)){
        if(route.usertypeid != 6){  //only admin
            readonly =``;
        }
    }

    if(($('#evstatus').val() == 3)){
        if(route.refixstatus == 0){
            if(route.usertypeid == 6){ //only jd
                readonly =``;
            }
        }else if(route.refixstatus == 1){ //only admin
            if(route.usertypeid != 6){
                readonly =``;
            }
        }else if(route.refixstatus == 2){ //only jd
            if(route.usertypeid == 6){
                readonly =``;
            }
        }
    }

   if($('#evstatus').val() >= 4 ){
        commentreadonly =`readonly`;
    }
    if($('#evstatus').val() == 2 || route.refixstatus == 1){
        commentreadonly =``;
    }

    data.forEach(function (pillaindex,index) {
        var comment = '';
        if(pillaindex.comment){
            comment = pillaindex.comment;
        }

        evdata.push({"pillar":  pillaindex.pillar['name'] , "subpillar": pillaindex.subpillar['name'], "subpillarindex": pillaindex.subpillarindex['name'], "weight": pillaindex.weigth});
        
        if(pillaindex.ev_type_id == evtypeid){
            html += `<tr > 
                <td> ${pillaindex.pillar['name']}</td>                                            
                <td> ${pillaindex.subpillar['name']}</td>    
                <td> 
                    <div class="form-group">
                        <label>${pillaindex.subpillarindex['name']}</label>
                        <input type="text" data-pillarname="${pillaindex.pillar['name']}" data-subpillarname="${pillaindex.subpillar['name']}" data-subpillarindexname="${pillaindex.subpillarindex['name']}" value="${pillaindex.weigth}" ${readonly} data-id="${pillaindex.id}" class="form-control form-control-lg inputweigth weigthvalue${evtypeid} decimalformat">
                    </div>
                    <div class="toggle" >
                        <div class="form-group" style="margin-top:5px">
                            <label><i>ความเห็น</i></label>
                            <input type="text" data-id="${pillaindex.id}" value="${comment}" class="form-control form-control-lg inpscore comment" ${readonly} >
                        </div>
                    </div>
                </td>                           
            </tr>`
        }
        });
        // console.log(evdata);
        if(evtypeid == 1){
            $("#subpillar_index_transaction_wrapper_tr").html(html);
        }else if(evtypeid == 2){
            $("#extra_subpillar_index_transaction_wrapper_tr").html(html);
        }
}


function RenderExtraTable(data){
    var html =``;
    evextradata = [];
    var readonly =`readonly`;
   
    // if(($('#evstatus').val() == 2 || ($('#evstatus').val() == 3 && route.refixstatus == 1))){
    if(($('#evstatus').val() == 2 || ($('#evstatus').val() == 3))){
        // console.log('here');
        if(route.refixstatus == 1){
            if(route.usertypeid != 6){
                readonly =``;
            }
        } if(route.refixstatus == 2){
            if(route.usertypeid == 6){
                readonly =``;
            }
        }
    }
    // if($('#evstatus').val() >= 4 || route.usertypeid != 6){
    //     commentreadonly =`readonly`;
    // }
    // if($('#evstatus').val() == 2 || route.refixstatus == 1){
    //     commentreadonly =``;
    // }

    if(($('#evstatus').val() == 2)){
        if(route.usertypeid != 6){  //only admin
            readonly =``;
        }
    }

    if(($('#evstatus').val() == 3)){
        if(route.refixstatus == 0){
            if(route.usertypeid == 6){ //only jd
                readonly =``;
            }
        }else if(route.refixstatus == 1){ //only admin
            if(route.usertypeid != 6){
                readonly =``;
            }
        }else if(route.refixstatus == 2){ //only jd
            if(route.usertypeid == 6){
                readonly =``;
            }
        }
    }


    data.forEach(function (criteria,index) {
        var comment = '';
        if(criteria.weightcomment){
            comment = criteria.weightcomment;
        }
        evextradata.push({"category":  criteria.extracategory['name'] , "criteria": criteria.extracriteria['name'], "weight": criteria.weight});
            html += `<tr > 
            <td> ${criteria.extracategory['name']} <a href="#" data-categoryid="${criteria.extra_category_id}" class="text-grey-300"></a></td>                
            <td> ${criteria.extracriteria['name']} <a href="#" data-categoryid="${criteria.extra_category_id}" data-criteriaid="${criteria.extra_criteria_id}" class="text-grey-300 "></a></td>                                            
            <td> 
            <div class="form-group">
                <label>${criteria.extracriteria['name']}</label>
                <input type="text" data-category="${criteria.extracategory['name']}" data-extracriteria="${criteria.extracriteria['name']}" value="${criteria.weight}" data-id="${criteria.id} "class="form-control form-control-lg inputextraweigth weigthvalue decimalformat" ${readonly} >
                <div class="toggle">
                    <div class="form-group" style="margin-top:5px">
                        <label><i>ความเห็น</i></label>
                        <input type="text" data-id="${criteria.id}" value="${comment}" class="form-control form-control-lg inpscore extracomment" ${readonly} >
                    </div>
                </div>
            </div>
        </td> 
    </tr>`
    });
    $("#extra_criteria_transaction_wrapper_tr").html(html);
}

function RowSpanExtra(tableid){
    const table = document.getElementById(tableid);// document.querySelector('table');
    let cell1 = "";
    let cell2 = "";
    for (let row of table.rows) {
        const firstCell = row.cells[0];
        const secondCell = row.cells[1];
        if (cell1 === null || firstCell.innerText !== cell1.innerText) {
            cell1 = firstCell;
        } else {
            cell1.rowSpan++;
            firstCell.remove();
        }
        if (cell2 === null || secondCell.innerText !== cell2.innerText) {
            cell2 = secondCell;
        } else {
            cell2.rowSpan++;
            secondCell.remove();
        }
    }
}

function RowSpan(tableid){
    const table = document.getElementById(tableid);// document.querySelector('table');
    let cell1 = "";
    let cell2 = "";
    let cell3 = "";
    let cell4 = "";
    for (let row of table.rows) {
        const firstCell = row.cells[0];
        const secondCell = row.cells[1];
        const thirdCell = row.cells[2];
        const forthCell = row.cells[3];
        if (cell1 === null || firstCell.innerText !== cell1.innerText) {
            cell1 = firstCell;
        } else {
            cell1.rowSpan++;
            firstCell.remove();
        }
        if (cell2 === null || secondCell.innerText !== cell2.innerText) {
            cell2 = secondCell;
        } else {
            cell2.rowSpan++;
            secondCell.remove();
        }
        if (cell3 === null || thirdCell.innerText !== cell3.innerText) {
            cell3 = thirdCell;
        } else {
            cell3.rowSpan++;
            thirdCell.remove();
        }
        if (cell4 === null || forthCell.innerText !== cell4.innerText) {
            cell4 = forthCell;
        } else {
            cell4.rowSpan++;
            forthCell.remove();
        }
    }
}

function RowSpanWeight(tableid){
    const table = document.getElementById(tableid);// document.querySelector('table');
    let cell1 = "";
    let cell2 = "";
    let cell3 = "";
    for (let row of table.rows) {
        const firstCell = row.cells[0];
        const secondCell = row.cells[1];
        const thirdCell = row.cells[2];
        if (cell1 === null || firstCell.innerText !== cell1.innerText) {
            cell1 = firstCell;
        } else {
            cell1.rowSpan++;
            firstCell.remove();
        }
        if (cell2 === null || secondCell.innerText !== cell2.innerText) {
            cell2 = secondCell;
        } else {
            cell2.rowSpan++;
            secondCell.remove();
        }
        if (cell3 === null || thirdCell.innerText !== cell3.innerText) {
            cell3 = thirdCell;
        } else {
            cell3.rowSpan++;
            thirdCell.remove();
        }
    }
}
    $(document).on('click', '#updateevstatus', function(e) { 
        $("#spinicon").attr("hidden",false);
        updateEvAdminStatus($(this).data('id'),3).then(data => {
            $("#spinicon").attr("hidden",true);
            window.location.reload();
        }).catch(error => {})
    });

function updateEvAdminStatus(id,value){
    return new Promise((resolve, reject) => {
        $.ajax({
        url: `${route.url}/api/assessment/ev/updateadminevstatus`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
            id : id,
            value : value
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

    function sendEditEv(id){
        return new Promise((resolve, reject) => {
            $.ajax({
            url: `${route.url}/api/assessment/ev/sendeditev`,
            type: 'POST',
            headers: {"X-CSRF-TOKEN":route.token},
            data: {
                id : id
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

      $(document).on('click', '#btn_modal_add_comment', function(e) {
        if($('#comment').val() == ''){
            return;
        }
        Swal.fire({
            title: 'โปรดยืนยัน',
            text: `ต้องการส่งคืนให้ Admin แก้ไข`,
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'ตกลง',
            cancelButtonText: 'ยกเลิก',
            closeOnConfirm: false,
            closeOnCancel: false
            }).then((result) => {
            if (result.value) {
                $("#addcommentspinicon").attr("hidden",false);
                Ev.addCommentStageTwo($('#evid').val(),$('#comment').val()).then(data => {
                    $("#addcommentspinicon").attr("hidden",true);
                    $('#modal_add_comment').modal('hide');
                    window.location.reload();
                }).catch(error => {})
            }
        });
    });

    $(document).on('shown.bs.tab', 'a[data-toggle="tab"]', function (e) {
        if(route.usertypeid == 6)return;
        if($(e.target).attr("href") == '#commenttab'){
            // Ev.clearCommentTab($('#evid').val(),2).then(data => {
        
            // }).catch(error => {})
        }
    })

    $(document).on("click",".deletecomment",function(e){
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
                Ev.deleteComment($(this).data('id')).then(data => {
                    var html =``;
                    data.forEach(function (comment,index) {
                            html += `<tr > 
                            <td> ${comment.created_at} </td>                                            
                            <td> ${comment.detail} </td>    
                            <td> <a data-id="${comment.id}" class="btn btn-sm bg-danger deletecomment">ลบ</a> </td>                                          
                            </tr>`
                        });
                    $("#ev_edit_history_wrapper_tr").html(html);
            
                }).catch(error => {})
            }
        });
    }); 

    $(document).on('click', '#approveevstagetwo', function(e) {
        Swal.fire({
            title: 'อนุมัติ EV!',
            text: `ต้องการอนุมัติ EV `,
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'ตกลง',
            cancelButtonText: 'ยกเลิก',
            closeOnConfirm: false,
            closeOnCancel: false
            }).then((result) => {
            if (result.value) {
                $("#spinicon").attr("hidden",false);
                Ev.approveEvStageTwo($(this).data('id')).then(data => {
                    $("#spinicon").attr("hidden",true);
                    Swal.fire({
                        title: 'สำเร็จ',
                        text: 'EV ได้รับการอนุมัติแล้ว',
                    }).then((result) => {
                        window.location.reload();
                    });
                }).catch(error => {})
            }
        });
    });
    var submitbutton = false;

    if(($('#evstatus').val() == 2 || ($('#evstatus').val() == 3 && route.refixstatus == 1)) && route.usertypeid != 6){
        submitbutton = true;
    }
    var form = $('.step-evweight').show();
	$('.step-evweight').steps({
		headerTag: 'h6',
		bodyTag: 'fieldset',
		transitionEffect: 'fade',
        enableKeyNavigation: false,
		titleTemplate: '<span class="number">#index#</span> #title#',
		labels: {
			previous: '<i class="icon-arrow-left13 mr-2" /> ก่อนหน้า',
			next: 'ต่อไป <i class="icon-arrow-right14 ml-2" />',
			finish: '<i class="icon-spinner spinner mr-2" id="spiniconsendjd" hidden/>นำส่ง Manager <i class="icon-arrow-right14 ml-2" />'
		},
		enableFinishButton: submitbutton,
		onFinished: function (event, currentIndex) {
            Swal.fire({
                title: 'โปรดยืนยัน',
                text: `ต้องการนำส่ง Manager `,
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'ตกลง',
                cancelButtonText: 'ยกเลิก',
                closeOnConfirm: false,
                closeOnCancel: false
                }).then((result) => {
                    if (result.value) {
                        var tempchk = 0;
                        $('.inputweigth').each(function() {
                            if($(this).val() == '' || $(this).val() == 0){
                                //$(this).val(0);
                                Swal.fire({
                                    title: 'ผิดพลาด...',
                                    text: 'กรอก Weight ไม่ครบ หรือกรอกค่า Weight เป็น 0',
                                })
                                tempchk = 1;
                                return ;
                            }
                        });
            
                        if (tempchk == 1) {
                            return ;
                        }
                        
                        if(parseFloat($('#weight').html().replace(/[{()}]/g, '')) != 1){
                            Swal.fire({
                                title: 'ผิดพลาด...',
                                text: 'ผลรวม Index Weight ไม่เท่ากับ 1',
                            })
                            return ;
                        }
                        if($('#percentextra').val() > 0){
                            if(parseFloat($('#extraweight').html().replace(/[{()}]/g, '')) != 1){
                                Swal.fire({
                                    title: 'ผิดพลาด...',
                                    text: 'ผลรวม Extra Weight ไม่เท่ากับ 1',
                                })
                                return ;
                            }
                        }  
                        $("#spiniconsendjd").attr("hidden",false);
                        sendEditEv($('#evid').val()).then(data => {
                            Ev.clearCommentTab($('#evid').val(),2).then(data => {
                                $("#spiniconsendjd").attr("hidden",true);
                                Swal.fire({
                                    title: 'สำเร็จ',
                                    text: 'นำส่ง Manager สำเร็จ',
                                }).then((result) => {
                                    window.location.reload();
                                });
                            }).catch(error => {})
                        }).catch(error => {})
                }
            });


		},
		transitionEffect: 'fade',
		autoFocus: true,
		onStepChanged:function (event, currentIndex, newIndex) {
            if(currentIndex == 1){
                $("#weightstick").attr("hidden",true);
            }else{
                $("#weightstick").attr("hidden",false);
            }
		return true;
		},
		
    });
    
    	// Initialize validation
	$('.step-evweight').validate({
	    ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
	    errorClass: 'validation-invalid-label',
	    highlight: function(element, errorClass) {
	        $(element).removeClass(errorClass);
	    },
	    unhighlight: function(element, errorClass) {
	        $(element).removeClass(errorClass);
	    },

	    // Different components require proper error label placement
	    errorPlacement: function(error, element) {

	        // Unstyled checkboxes, radios
	        if (element.parents().hasClass('form-check')) {
	            error.appendTo( element.parents('.form-check').parent() );
	        }

	        // Input with icons and Select2
	        else if (element.parents().hasClass('form-group-feedback') || element.hasClass('select2-hidden-accessible')) {
	            error.appendTo( element.parent() );
	        }

	        // Input group, styled file input
	        else if (element.parent().is('.uniform-uploader, .uniform-select') || element.parents().hasClass('input-group')) {
	            error.appendTo( element.parent().parent() );
	        }

	        // Other elements
	        else {
	            error.insertAfter(element);
	        }
	    },
	    rules: {
	        email: {
	            email: true
	        }
	    }
	});

    $(document).on('change', '.comment', function(e) {
        Ev.editWeightComment($(this).data('id'),$(this).val()).then(data => {
        }).catch(error => {})
    });

    $(document).on('change', '.extracomment', function(e) {
        Ev.editExtraWeightcomment($(this).data('id'),$(this).val()).then(data => {
        }).catch(error => {})
    });

    $(document).on('click', '#togglecomment', function(e) {
        $('.toggle').toggle();
     });
    
     
     $("#btnOnExcel").on('click', function() {
        evdata = [];
        $('.inputweigth').each(function(){
            evdata.push({"pillar":  $(this).data('pillarname') , "subpillar": $(this).data('subpillarname'), "subpillarindex": $(this).data('subpillarindexname'), "weight": $(this).val()});
        });

        var table = $('#evexporttable').DataTable();
        if(table!=null){
            table.clear();
            table.clear().destroy();
        }
        
        InitializeDataTable();

        $('#evexporttable').DataTable().buttons(0,0).trigger();

        // if (!$('#evexporttable').DataTable().data().any() ) {
        //     setCookie("forcedownload", "1");
        //     window.location.reload();
        // }else{
        //     $('#evexporttable').DataTable().buttons(0,0).trigger();
        // }
    
    });
    $(document).on('click', '.preview', function(e) {
        var previewdata = []
        var previewextradata = []
        $('.inputweigth').each(function(){
            previewdata.push({"pillar":  $(this).data('pillarname') , "subpillar": $(this).data('subpillarname'), "subpillarindex": $(this).data('subpillarindexname'), "weight": $(this).val()});
            
        });

        $('.inputextraweigth').each(function(){
            previewextradata.push({"category":  $(this).data('category') , "extracriteria": $(this).data('extracriteria'), "weight": $(this).val()});
            
        });
        var html =``;
        previewdata.forEach(function (data,index) {
                html += `<tr > 
                <td> ${data.pillar} </td>                                            
                <td> ${data.subpillar} </td>    
                <td> ${data.subpillarindex} </td>  
                <td style="text-align:center"> ${data.weight} </td>                                          
                </tr>`
            });


        if(previewextradata.length > 0){
            var html1 =``;
            previewextradata.forEach(function (data,index) {
                    html1 += `<tr > 
                    <td> ${data.category} </td>                                            
                    <td> ${data.extracriteria} </td>    
                    <td style="text-align:center"> ${data.weight} </td>                                          
                    </tr>`
                });
            $("#extra_preview_wrapper").attr("hidden",false);
        }else{
            $("#extra_preview_wrapper").attr("hidden",true);
        }
        $("#preview_wrapper_tr").html(html);
            $("#extra_preview_wrapper_tr").html(html1);
            $('#modal_preview_weight').modal('show');
    });

    
    $("#btnOnPdf").on('click', function() {
        evdata = [];
        $('.inputweigth').each(function(){
            evdata.push({"pillar":  $(this).data('pillarname') , "subpillar": $(this).data('subpillarname'), "subpillarindex": $(this).data('subpillarindexname'), "weight": $(this).val()});
        });

        var table = $('#evexporttable').DataTable();
        if(table!=null){
            table.clear();
            table.clear().destroy();
        }
        
        InitializeDataTable();

        $('#evexporttable').DataTable().buttons(0,1).trigger();

        // if (!$('#evexporttable').DataTable().data().any() ) {
        //     setCookie("forcedownload", "2");
        //     window.location.reload();
        // }else{
        //     $('#evexporttable').DataTable().buttons(0,1).trigger();
        // }
       
    });
    
    $("#btnOnExcelExtra").on('click', function() {
       
        evextradata = [];

        $('.inputextraweigth').each(function(){
             evextradata.push({"category":  $(this).data('category') , "criteria": $(this).data('extracriteria'), "weight": $(this).val()});
             
         });
        //  console.log(evextradata);
         var table_extra = $('#evextraexporttable').DataTable();
         if(table_extra!=null){
            table_extra.clear();
            table_extra.clear().destroy();
         }
         
         InitializeDataTableExtra();
 
         $('#evextraexporttable').DataTable().buttons(0,0).trigger();

        // if (!$('#evextraexporttable').DataTable().data().any() ) {
        //     setCookie("forcedownload", "3");
        //     window.location.reload();
        // }else{
        //     $('#evextraexporttable').DataTable().buttons(0,0).trigger();
        // }
        
    
    });
    
    $("#btnOnPdfExtra").on('click', function() {

        evextradata = [];

        $('.inputextraweigth').each(function(){
             evextradata.push({"category":  $(this).data('category') , "criteria": $(this).data('extracriteria'), "weight": $(this).val()});
             
         });
        //  console.log(evextradata);
         var table_extra = $('#evextraexporttable').DataTable();
         if(table_extra!=null){
            table_extra.clear();
            table_extra.clear().destroy();
         }
         
         InitializeDataTableExtra();
 
         $('#evextraexporttable').DataTable().buttons(0,1).trigger();

        // if (!$('#evextraexporttable').DataTable().data().any() ) {
        //     setCookie("forcedownload", "4");
        //     window.location.reload();
        // }else{
        //     $('#evextraexporttable').DataTable().buttons(0,1).trigger();
        // }
        
    });
    