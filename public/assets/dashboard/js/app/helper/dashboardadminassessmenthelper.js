import * as Extra from './extra.js';

var stepindex =0;
var evdata = [];
var evextradata = [];

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
        RenderTable(data);
        $(".loadprogress").attr("hidden",true);
        RowSpan("criteriatable");
        RenderExtraTable(data.extracriteriatransactions);
        // RowSpan("extra_criteriatable");
        $('#sumofweight').html(data.sumweigth);

    }).catch(error => {})
});

function callDataTable(){
    $('#evexporttable').DataTable( {
        dom: 'Bfrtip',
        data: evdata,
        columns : [
            { "data" : "pillar" },
            { "data" : "subpillar" },
            { "data" : "subpillarindex" },
            { "data" : "criteria" },
            { "data" : "score" },
            { "data" : "comment" }
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
                    return "รายการ EV (Index Criteria)"      
                }, 
                exportOptions: {
                    columns: [ 0, 1,2,3,4,5 ]
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
                    doc.content[1].table.widths = ['*','*', '*', '*', '*', '*']
                    var rowCount = doc.content[1].table.body.length;
                    for (var i = 1; i < rowCount; i++) {
                        doc.content[1].table.body[i][4].alignment = 'center';
                    }
                },
                exportOptions: {
                    columns: [ 0, 1,2,3,4,5]
                },
                title: function () { 
                    return "รายการ EV (Index Criteria)"; 
                },
                filename: function() {
                    return "รายการ EV (Index Criteria)"      
                }, 
            }
            
        ],
        drawCallback: function() {
            $('.buttons-excel')[0].style.visibility = 'hidden'
            $('.buttons-pdf')[0].style.visibility = 'hidden'
        },
        bDestroy: true
    } );

    
}

function callDataTableExtra(){
    $('#evextraexporttable').DataTable( {
        dom: 'Bfrtip',
        data: evextradata,
        columns : [
            { "data" : "category" },
            { "data" : "criteria" },
            { "data" : "score" },
            { "data" : "comment" }
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
                    return "รายการ EV (Extra)"      
                }, 
                exportOptions: {
                    columns: [ 0, 1,2,3]
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
                    doc.content[1].table.widths = ['*','*','*','*']
                    var rowCount = doc.content[1].table.body.length;
                    for (var i = 1; i < rowCount; i++) {
                    doc.content[1].table.body[i][0].alignment = 'left';
                    }
                },
                exportOptions: {
                    columns: [ 0, 1,2,3]
                },
                title: function () { 
                    return "รายการ EV (Extra)"; 
                },
                filename: function() {
                    return "รายการ EV (Extra)"      
                }, 
            }     
        ],
        drawCallback: function() {
            $('.buttons-excel')[0].style.visibility = 'hidden'
            $('.buttons-pdf')[0].style.visibility = 'hidden'
        },
        bDestroy: true
    } );
}

$(document).on('click', '#btnOnExcel', function(e) {
    getEv($('#evid').val(),route.userid).then(data => {
         RenderTable2(data,1);
         callDataTable();
       $('#evexporttable').DataTable().buttons(0,0).trigger();
    }).catch(error => {})
});
$(document).on('click', '#btnOnPdf', function(e) {
    getEv($('#evid').val(),route.userid).then(data => {
        RenderTable2(data,1);
        callDataTable();
       $('#evexporttable').DataTable().buttons(0,1).trigger();
   }).catch(error => {})
});

$(document).on('click', '#btnOnExcelExtra', function(e) {
    getEv($('#evid').val(),route.userid).then(data => {
        console.log(data);
        RenderExtraTable2(data.extracriteriatransactions);
        callDataTableExtra();
       $('#evextraexporttable').DataTable().buttons(0,0).trigger();
    }).catch(error => {})
});

$(document).on('click', '#btnOnPdfExtra', function(e) {
    getEv($('#evid').val(),route.userid).then(data => {
        console.log(data);
        RenderExtraTable2(data.extracriteriatransactions);
        callDataTableExtra();
       $('#evextraexporttable').DataTable().buttons(0,1).trigger();
    }).catch(error => {})
});

function getEv(evid){
    return new Promise((resolve, reject) => {
        $.ajax({
        url: `${route.url}/dashboard/admin/assessment/getev`,
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

  $(document).on('click', '#togglecomment', function(e) {
      $('.toggle').toggle();
   });
   
   function RenderTable(data){
        var html =``;
        data.criteriatransactions.forEach((criteria,index) => {
                var comment = '';
                var criterianame = `<label>กรอกเกรด (A - F) <a href="#" data-toggle="modal" data-criterianame="${criteria.subpillarindex['name']}" class="text-grey conflictgrade" data-id="${criteria.id}" ><i class="icon-folder-open3"></i></a> </label>
                                <input type="text" data-id="${criteria.id}" data-subpillarindex="${criteria.subpillarindex['id']}" data-scoretype="1" placeholder="" value="" data-type="score" class="form-control scoring gradescore">
                                    `;
        
                if(criteria.criteria != null){
                    criterianame = `<label class="form-check-label">
                                        <input type="checkbox" data-name="${criteria.criteria['name']}" data-id="${criteria.id}" data-scoretype="2" data-subpillarindex="${criteria.subpillarindex['id']}" data-type="score" style="vertical-align: middle" class="form-check-input-styled-info scoring">
                                        ${criteria.criteria['name']} <a href="#" data-toggle="modal" class="text-grey conflictscore" data-criterianame="${criteria.criteria['name']}" data-id="${criteria.id}"><i class="icon-folder-open3"></i></a>
                                    </label>`;
                }
        
                criterianame += `<div class="toggle"><div class="form-group">
                                    <label><i>ความเห็น</i></label>
                                    <input type="text" data-id="${criteria.id}" data-subpillarindex="${criteria.subpillarindex['id']}" value="${comment}" data-type="comment" class="form-control form-control-lg comment">
                                    </div>
                                </div>`;
        
                html += `<tr > 
                <td> ${criteria.pillar['name']}</td>                                            
                <td> ${criteria.subpillar['name']}</td>    
                <td> ${criteria.subpillarindex['name']}</td>   
                <td> ${criterianame} </td>                              
                </tr>`
        });
        $("#criteria_transaction_wrapper_tr").html(html);

}

function RenderTable2(data){
    evdata = [];
    data.criteriatransactions.forEach((criteria,index) => {
            var comment = '';
            var score = $(`input[data-id="${criteria.id}"][data-subpillarindex="${criteria.subpillarindex['id']}"][data-type="score"]`).val();
            var comment = $(`input[data-id="${criteria.id}"][data-subpillarindex="${criteria.subpillarindex['id']}"][data-type="comment"]`).val();
            var showcriteria = criteria.subpillarindex['name'];
            if(criteria.criteria != null){
                showcriteria = criteria.criteria['name'];
                if($($(`input[data-id="${criteria.id}"][data-subpillarindex="${criteria.subpillarindex['id']}"][data-type="score"]`)).is(":checked")){
                        score = 'x';
                    }else{
                    score = '';
                }
            }

        evdata.push({"pillar":  criteria.pillar['name'] , "subpillar": criteria.subpillar['name'], "subpillarindex": criteria.subpillarindex['name'], "criteria": showcriteria, "score" : score , "comment" : comment });                            
    });

}

function RenderExtraTable(data){
    
    var html =``;
    data.forEach(function (criteriatransaction,index) {

            html += `<tr > 
            <td> ${criteriatransaction.extracategory['name']} <a href="#" data-categoryid="${criteriatransaction.extra_category_id}" class="text-grey-300"></a></td>                
            <td> ${criteriatransaction.extracriteria['name']} <a href="#" data-categoryid="${criteriatransaction.extra_category_id}" data-criteriaid="${criteriatransaction.extra_criteria_id}" class="text-grey-300 "></a></td>                                            
            <td> 
            <div class="form-group">
                <label>กรอกคะแนน (0 - 5) <a href="#" data-toggle="modal" class="text-grey conflictextrascore" data-criterianame="${criteriatransaction.extracriteria['name']}" data-id="${criteriatransaction.id}"  ><i class="icon-folder-open3"></i></a></label>
                <input type="text" value="" data-id="${criteriatransaction.id}"  data-type="score" class="form-control inputextrascore weigthvalue decimalformat" >

                <div class="toggle"><div class="form-group">
                    <label><i>ความเห็น</i></label>
                    <input type="text" data-id="${criteriatransaction.id}" class="form-control form-control-lg extracomment" data-type="comment">
                    </div>
                </div>
                
            </div>
       
        </td> 
    </tr>`
    });
    $("#extra_criteria_transaction_wrapper_tr").html(html);
}

function RenderExtraTable2(data){
    evextradata =[];
    data.forEach(function (criteriatransaction,index) {
        var score = $(`input[data-id="${criteriatransaction.id}"][data-type="score"]`).val();
        var comment = $(`input[data-id="${criteriatransaction.id}"][data-type="comment"]`).val();
        evextradata.push({"category":  criteriatransaction.extracategory['name'] , "criteria": criteriatransaction.extracriteria['name'], "score": score , "comment" : comment });

    });
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
            if (forthCell.innerText.includes("placeholder") == true){
                cell4.rowSpan++;
                forthCell.remove();
            }
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

// $(document).on('change', '#comment', function(e) {
//     editComment($(this).data('id'),$(this).val()).then(data => {
//     }).catch(error => {})
// });

// function editComment(transactionid,comment){
//     return new Promise((resolve, reject) => {
//         $.ajax({
//         url: `${route.url}/dashboard/admin/project/assessment/editcomment`,
//         type: 'POST',
//         headers: {"X-CSRF-TOKEN":route.token},
//         data: {
//             transactionid : transactionid,
//             comment : comment
//         },
//         success: function(data) {
//             resolve(data)
//         },
//         error: function(error) {
//             reject(error)
//         },
//         })
//     })
//   }

function updateScore(arraylist,conflictcommentarray,extraarraylist,extracommnetarraylist,evid){
    return new Promise((resolve, reject) => {
        $.ajax({
        url: `${route.url}/dashboard/admin/assessment/updatescore`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
            arraylist : arraylist,
            conflictcommentarray : conflictcommentarray,
            extraarraylist : extraarraylist,
            extracommnetarraylist : extracommnetarraylist,
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

function addScore(transactionid,score,subpillarindex,scoretype){
    return new Promise((resolve, reject) => {
        $.ajax({
        url: `${route.url}/dashboard/admin/assessment/addscore`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
            transactionid : transactionid,
            score : score,
            subpillarindex : subpillarindex,
            scoretype : scoretype
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


  $(document).on('click', '.conflictscore', function(e) {
    showConflictScore($(this).data('id')).then(data => {
        var html =``;
        console.log(data);  
        data.projectmembers.forEach(function (conflict,index) {
             
            var icon = '<i class="icon-cross"></i>';
            var check = data.scores.find(x => x.user_id === conflict.user['id']);
            var _comment ='';
            if ( typeof(check) !== "undefined" && check !== null ) {
                if(check['score'] == 1){
                    icon = '<i class="icon-check"></i>';
                }
                _comment = check.comment;
                if(_comment === null){
                    _comment = "";
                }
            }
            html += `<tr > 
            <td> ${conflict.user['name']} ${conflict.user['lastname']}</td>                                            
            <td style="text-align:center"> ${icon} </td>  
            <td> ${_comment} </td>                                            
            </tr>`
            });
        $("#show_conflict_modal_wrapper_tr").html(html);
        $('#title').html(' โครงการ'+$('#projectname').val() + ' | ' + $(this).data('criterianame'));
        $('#modal_show_conflict').modal('show');
    }).catch(error => {})
});

function showConflictScore(id){
    return new Promise((resolve, reject) => {
        $.ajax({
        url: `${route.url}/dashboard/admin/assessment/conflictscore`,
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

  $(document).on('click', '.conflictgrade', function(e) {
    
    showConflictGrade($(this).data('id')).then(data => {
        var html =``;
        data.forEach(function (conflict,index) {

               var _comment = conflict.comment;
                if(_comment === null){
                    _comment = "";
                }


            html += `<tr > 
            <td> ${conflict.user['name']} ${conflict.user['lastname']}</td>                                            
            <td style="text-align:center"> ${conflict.score} </td>   
            <td> ${_comment} </td>                                           
            </tr>`
        });

        $("#show_conflict_modal_wrapper_tr").html(html);
        $('#title').html(' โครงการ'+$('#projectname').val() + ' | ' + $(this).data('criterianame'));
        $('#modal_show_conflict').modal('show');
    }).catch(error => {})
});

function showConflictGrade(id){
    return new Promise((resolve, reject) => {
        $.ajax({
        url: `${route.url}/dashboard/admin/assessment/conflictgrade`,
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

  $(document).on('click', '.conflictextrascore', function(e) {
    Extra.showConflictScore($(this).data('id'),$('#evid').val()).then(data => {
        var html =``;
        data.forEach(function (conflict,index) {
            var _comment = conflict.comment;
            if(_comment === null){
                _comment = "";
            }

            html += `<tr > 
            <td> ${conflict.user['name']} ${conflict.user['lastname']}</td>                                            
           <td style="text-align:center"> ${conflict.scoring} </td>   
           <td> ${_comment} </td>                                             
            </tr>`
            });
        $("#show_conflict_modal_wrapper_tr").html(html);
        $('#title').html(' โครงการ'+$('#projectname').val() + ' | ' + $(this).data('criterianame'));
        $('#modal_show_conflict').modal('show');
    }).catch(error => {})
});

  $(document).on('change', '.gradescore', function(e) {
    if(stepindex == 0){
        if($(this).val() == 'a'){$(this).val('A')}
        if($(this).val() == 'b'){$(this).val('B')}
        if($(this).val() == 'c'){$(this).val('C')}
        if($(this).val() == 'd'){$(this).val('D')}
        if($(this).val() == 'e'){$(this).val('E')}
        if($(this).val() == 'f'){$(this).val('F')}

        if($(this).val() !== 'A' && $(this).val() !== 'B' && $(this).val() !== 'C' && $(this).val() !== 'D' && $(this).val() !== 'E' && $(this).val() !== 'F'){
            
            Swal.fire({
                title: 'ผิดพลาด...',
                text: 'กรอกเกรด A-F เท่านั้น!',
            })
            $(this).val('');
            return;
        }
    }else if(stepindex == 1){
        if($(this).val() != '5' && $(this).val() != '4' && $(this).val() != '3' && $(this).val() != '2' && $(this).val() != '1' && $(this).val() != '0'){
            Swal.fire({
                title: 'ผิดพลาด...',
                text: 'กรอกคะแนน 0-5 เท่านั้น!',
            })
            $(this).val('');
            return;
        }  
    }
});

$(document).on('change', '.inputextrascore', function(e) {
if(stepindex == 1){
        if($(this).val() != '5' && $(this).val() != '4' && $(this).val() != '3' && $(this).val() != '2' && $(this).val() != '1' && $(this).val() != '0'){
            Swal.fire({
                title: 'ผิดพลาด...',
                text: 'กรอกคะแนน 0-5 เท่านั้น!',
            })
            $(this).val('');
            return;
        }  
    }
});



var submitbutton = true;
if($('#evstatus').val() >= 5 ){
    submitbutton = false;
}
var form = $('.step-evweight').show();
$('.step-evweight').steps({
    headerTag: 'h6',
    bodyTag: 'fieldset',
    transitionEffect: 'fade',
    titleTemplate: '<span class="number">#index#</span> #title#',
    labels: {
        previous: '<i class="icon-arrow-left13 mr-2" /> ก่อนหน้า',
        next: 'ต่อไป <i class="icon-arrow-right14 ml-2" />',
        finish: '<i class="icon-spinner spinner mr-2" id="spinicon" hidden/>บันทึกคะแนน'
    },
    enableFinishButton: submitbutton,
    onFinished: function (event, currentIndex) {
        Swal.fire({
            title: 'คำเตือน!',
            text: `ต้องการบันทึกผลสรุปคะแนน หรือไม่`,
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'ตกลง',
            cancelButtonText: 'ยกเลิก',
            closeOnConfirm: false,
            closeOnCancel: false
            }).then((result) => {
            if (result.value) {
                var noblank = true;
                $('.scoring').each(function() {
                    if($(this).val() == ''){
                        noblank = false;
                        return;
                    }
                });
        
                if (noblank == false){
                    Swal.fire({
                        title: 'ผิดพลาด...',
                        text: 'กรุณากรอกเกรด/คะแนนให้ครบ!',
                    })
                    return;
                };
        
                var conflictarray = $(".scoring").map(function () {
                    var val = $(this).val();
                    if($(this).data('scoretype') == 2){
                       
                        val = $(this).is(':checked');
                        
                        if(val == true){
                            val = 1;
                        }else{
                            val = 0;
                        }
                    }
                    return {
                        evid: $('#evid').val(),
                        criteriatransactionid: $(this).data('id'),
                        subpillarindex: $(this).data('subpillarindex'),
                        scoretype: $(this).data('scoretype'),
                        value: val
                      } 
                }).get();
     
                var conflictcommentarray = $(".comment").map(function () {
                    var val = $(this).val();
                    return {
                        evid: $('#evid').val(),
                        criteriatransactionid: $(this).data('id'),
                        subpillarindex: $(this).data('subpillarindex'),
                        value: val
                      } 
                }).get();

                var conflictextraarray = $(".inputextrascore").map(function () {
                    var val = $(this).val();
                    return {
                        evid: $('#evid').val(),
                        extracriteriatransactionid: $(this).data('id'),
                        value: val
                      } 
                }).get();

                var conflictextracommentarray = $(".extracomment").map(function () {
                    var val = $(this).val();
                    return {
                        evid: $('#evid').val(),
                        extracriteriatransactionid: $(this).data('id'),
                        value: val
                      } 
                }).get();
                
                $("#spinicon").attr("hidden",false);
                updateScore(conflictarray,conflictcommentarray,conflictextraarray,conflictextracommentarray,$('#evid').val()).then(data => {
                    $("#spinicon").attr("hidden",true);
                    Swal.fire({
                        title: 'สำเร็จ...',
                        text: 'สรุปคะแนนสำเร็จ',
                        }).then((result) => {
                            window.location.replace(`${route.url}/dashboard/admin/assessment/summary/${$('#fulltbpid').val()}`);
                        });
                }).catch(error => {})
            }
        });

    },
    transitionEffect: 'fade',
    autoFocus: true,
    onStepChanged:function (event, currentIndex, newIndex) {
        stepindex = currentIndex;
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