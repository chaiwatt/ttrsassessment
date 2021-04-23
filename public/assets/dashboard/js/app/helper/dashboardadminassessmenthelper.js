import * as Extra from './extra.js';

var stepindex =0;
$(function() {
    getEv($('#evid').val()).then(data => {
        RenderTable(data);
        $(".loadprogress").attr("hidden",true);
        RowSpan("criteriatable");
        RenderExtraTable(data.extracriteriatransactions);
        // RowSpan("extra_criteriatable");
        $('#sumofweight').html(data.sumweigth);

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
                var criterianame = `<label>กรอกเกรด (A - F) <a href="#" data-toggle="modal" class="text-grey conflictgrade" data-id="${criteria.id}" ><i class="icon-folder-open3"></i></a> </label>
                                <input type="text" id="gradescore" data-id="${criteria.id}" data-subpillarindex="${criteria.subpillarindex['id']}" data-scoretype="1" placeholder="" value="" class="form-control scoring gradescore">
                                    `;
        
                if(criteria.criteria != null){
                    criterianame = `<label class="form-check-label">
                                        <input type="checkbox" id="checkscore" data-name="${criteria.criteria['name']}" data-id="${criteria.id}" data-scoretype="2" data-subpillarindex="${criteria.subpillarindex['id']}" class="form-check-input-styled-info scoring">
                                        ${criteria.criteria['name']} <a href="#" data-toggle="modal" class="text-grey conflictscore" data-id="${criteria.id}"><i class="icon-folder-open3"></i></a>
                                    </label>`;
                }
        
                criterianame += `<div class="toggle"><div class="form-group">
                                    <label><i>ความเห็น</i></label>
                                    <input type="text" id="comment" data-id="${criteria.id}" data-subpillarindex="${criteria.subpillarindex['id']}" value="${comment}" class="form-control form-control-lg">
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

function RenderExtraTable(data){
    
    var html =``;
    data.forEach(function (criteriatransaction,index) {

            html += `<tr > 
            <td> ${criteriatransaction.extracategory['name']} <a href="#" type="button" data-categoryid="${criteriatransaction.extra_category_id}" class="text-grey-300"></a></td>                
            <td> ${criteriatransaction.extracriteria['name']} <a href="#" type="button"  data-categoryid="${criteriatransaction.extra_category_id}" data-criteriaid="${criteriatransaction.extra_criteria_id}" class="text-grey-300 "></a></td>                                            
            <td> 
            <div class="form-group">
                <label>กรอกคะแนน (0 - 5) <a href="#" data-toggle="modal" class="text-grey conflictextrascore" data-id="${criteriatransaction.id}"><i class="icon-folder-open3"></i></a></label>
                <input type="text" value="" data-id="${criteriatransaction.id} "class="form-control inputextrascore weigthvalue decimalformat" >

                <div class="toggle"><div class="form-group">
                    <label><i>ความเห็น</i></label>
                    <input type="text" data-id="${criteriatransaction.id}" class="form-control form-control-lg extracomment">
                    </div>
                </div>
                
            </div>
       
        </td> 
    </tr>`
    });
    $("#extra_criteria_transaction_wrapper_tr").html(html);
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



$(document).on('change', '#comment', function(e) {
    editComment($(this).data('id'),$(this).val()).then(data => {
    }).catch(error => {})
});

function updateScore(arraylist,extraarraylist,evid){
    return new Promise((resolve, reject) => {
        $.ajax({
        url: `${route.url}/dashboard/admin/assessment/updatescore`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
            arraylist : arraylist,
            extraarraylist : extraarraylist,
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
      
        data.projectmembers.forEach(function (conflict,index) {
           
            var icon = '<i class="icon-cross"></i>';
            var check = data.scores.find(x => x.user_id === conflict.user['id']);
            var _comment ='';
            if ( typeof(check) !== "undefined" && check !== null ) {
                icon = '<i class="icon-check"></i>';
                _comment = check.comment;
                if(_comment === null){
                    _comment = "";
                }
            }
            html += `<tr > 
            <td> ${conflict.user['name']} ${conflict.user['lastname']}</td>                                            
            <td> ${icon} </td>  
            <td> ${_comment} </td>                                            
            </tr>`
            });
        $("#show_conflict_modal_wrapper_tr").html(html);
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
            html += `<tr > 
            <td> ${conflict.user['name']} ${conflict.user['lastname']}</td>                                            
            <td> ${conflict.score} </td>   
            <td> ${conflict.comment} </td>                                           
            </tr>`
        });

        $("#show_conflict_modal_wrapper_tr").html(html);
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
            html += `<tr > 
            <td> ${conflict.user['name']} ${conflict.user['lastname']}</td>                                            
           <td> ${conflict.scoring} </td>                                             
            </tr>`
            });
        $("#show_conflict_modal_wrapper_tr").html(html);
        $('#modal_show_conflict').modal('show');
    }).catch(error => {})
});

  $(document).on('change', '.gradescore', function(e) {
    if(stepindex == 0){
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


var submitbutton = true;
if($('#evid').val() >= 5 ){
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
                    }
                    return {
                        evid: $('#evid').val(),
                        criteriatransactionid: $(this).data('id'),
                        subpillarindex: $(this).data('subpillarindex'),
                        scoretype: $(this).data('scoretype'),
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
        
                $("#spinicon").attr("hidden",false);
                updateScore(conflictarray,conflictextraarray,$('#evid').val()).then(data => {
                    $("#spinicon").attr("hidden",true);
                    Swal.fire({
                        title: 'สำเร็จ...',
                        text: 'สรุปคะแนนสำเร็จ!',
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