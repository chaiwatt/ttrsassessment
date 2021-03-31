
import * as Extra from './extra.js';
var stepindex =0;
var readonly = "";
var disabled = "";
$(function() {
    getEv($('#evid').val(),route.userid).then(data => {
        
        RenderTable(data,1);
        //RenderTable(data,2);
        RenderExtraTable(data.extracriteriatransactions,data.extrascoring);
        $(".loadprogress").attr("hidden",true);
        RowSpan("criteriatable");
        // RowSpan("extra_criteriatable");
        // $('#sumofweight').html(data.sumweigth);
        // RowSpanExtra("extra_subpillarindex");
        // console.log('dfsdf');
        if(jQuery.isEmptyObject(data.scoringstatus) ){
            // console.log('aa');
            $('.inpscore').prop("disabled", false);
        }else{
            // console.log('bb');
            $('.inpscore').prop("disabled", true);
            readonly = "readonly";
            disabled = "disabled";
        }
        
    }).catch(error => {})
});

function getEv(evid,userid){
    return new Promise((resolve, reject) => {
        $.ajax({
        url: `${route.url}/dashboard/admin/project/assessment/getev`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
            evid : evid,
            userid : userid
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
function RenderTable(data,evtype){
    var html =``;
    var userid = route.userid;
    data.pillars.some((pillar,index) => {
        if(pillar.ev_type_id == evtype){
            data.criteriatransactions.some((criteria,item) => {
                if(criteria.ev_type_id == evtype && criteria.pillar_id == pillar.id){
                    var textvalue = '';
                    var checkvalue = '';
                    var comment = '';
                    var finaltextvalue = '';
                    var finalcheckvalue = '';
                    var finalcomment = '';

                    var hiddenfinal = "";
                    
                    var checkscore = criteria.scoring.filter(x => x.user_id == userid); 
                    if(typeof(checkscore[0]) != "undefined"){
                        var _scoring = checkscore[0];
                        if(_scoring['comment']){comment = _scoring['comment'];}
                        if(_scoring['scoretype'] == 1){
                            textvalue = _scoring['score'];
                        }else if(_scoring['scoretype'] == 2){
                            checkvalue = "checked";
                        }
                    }
                    var criterianame = `<div class="form-group"><label>กรอกเกรด (A - E)</label>
                    <input type="text" data-id="${criteria.id}" data-subpillarindex="${criteria.subpillarindex['id']}" placeholder="" value="${textvalue}" class="form-control form-control-lg inpscore gradescore" ${readonly}></div>`;

                    if(criteria.criteria != null){
                    criterianame = `<label class="form-check-label">
                                        <input type="checkbox" data-name="${criteria.criteria['name']}" data-id="${criteria.id}" data-subpillarindex="${criteria.subpillarindex['id']}" class="form-check-input-styled-info inpscore checkscore" ${checkvalue} ${disabled}>
                                        ${criteria.criteria['name']}
                                    </label>`;
                    }
        
                    criterianame += `<div class="toggle" style="display:none;"><div class="form-group">
                                        <label><i>ความเห็น</i></label>
                                        <input type="text" data-id="${criteria.id}" data-subpillarindex="${criteria.subpillarindex['id']}" value="${comment}" class="form-control form-control-lg inpscore comment" ${readonly}>
                                        </div>
                                    </div>`;

                    if($('#isfinal').val() == 0){
                        hiddenfinal = "hidden";
                    }
                    var finalcheckscore = criteria.scoring.filter(x => x.user_id == null); 
                    if(typeof(finalcheckscore[0]) != "undefined"){
                        var _finalscoring = finalcheckscore[0];
                        if(_finalscoring['comment']){finaltextvalue = _scoring['comment'];}
                        if(_finalscoring['scoretype'] == 1){
                            finaltextvalue = _finalscoring['score'];
                        }else if(_finalscoring['scoretype'] == 2){
                            finalcheckvalue = "checked";
                        }
                    }
                    // console.log(comment);
                    var warningtext ='';
                    var warninglabel ='';
                    if(finaltextvalue != textvalue){
                        warningtext ='text-danger';
                    }
                    if(finalcheckvalue != checkvalue){
                        warninglabel ='text-danger';
                    }

                    var finalcriterianame = `<div class="form-group"><label>กรอกเกรด (A-E)</label><input type="text" placeholder="" value="${finaltextvalue}" class="form-control form-control-lg ${warningtext}" disabled ></div>`;

                    if(criteria.criteria != null){
                        finalcriterianame = `<label class="form-check-label">
                                        <input type="checkbox" class="form-check-input-styled-info" ${finalcheckvalue} disabled>
                                        <span class="${warninglabel}">${criteria.criteria['name']}<span>
                                    </label>`;
                    }
        
                    finalcriterianame += `<div class="toggle" style="display:none;"><div class="form-group">
                                        <label><i>ความเห็น</i></label>
                                        <input type="text" value="${comment}" class="form-control form-control-lg" disabled>
                                        </div>
                                    </div>
                                    `; 
                    html += `<tr > 
                    <td> ${criteria.pillar['name']}</td>                                            
                    <td> ${criteria.subpillar['name']}</td>    
                    <td> ${criteria.subpillarindex['name']}</td>   
                    <td> ${criterianame} </td>       
                    <td ${hiddenfinal}> ${finalcriterianame} </td>                                      
                </tr>`
                }
            });

        }
    });
    if(evtype == 1){
        $("#criteria_transaction_wrapper_tr").html(html);
    }else if(evtype == 2){
        $("#extra_criteria_transaction_wrapper_tr").html(html);
    }
    
}


function RenderExtraTable(data,scoring){
    var html =``;
    var readonly =``;

    data.forEach(function (criteriatransaction,index) {
        var checkscore = scoring.filter(x => x.extra_critreria_transaction_id == criteriatransaction.id)[0]; 
        var score = '';
        var comment = '';
            if(!jQuery.isEmptyObject(checkscore) ){
                score = checkscore.scoring;
                if(checkscore.comment){comment = checkscore.comment;}
            }
            html += `<tr > 
            <td> ${criteriatransaction.extracategory['name']} <a href="#" type="button" data-categoryid="${criteriatransaction.extra_category_id}" class="text-grey-300"></a></td>                
            <td> ${criteriatransaction.extracriteria['name']} <a href="#" type="button"  data-categoryid="${criteriatransaction.extra_category_id}" data-criteriaid="${criteriatransaction.extra_criteria_id}" class="text-grey-300 "></a></td>                                            
            <td> 
                <div class="form-group">
                        <label>กรอกคะแนน (0-5)</label>
                        <input type="text" value="${score}" data-id="${criteriatransaction.id}" class="form-control form-control-lg inputextrascore extravalue inpscore numeralformat2" ${readonly}>
                    </div>
                    <div class="toggle" style="display:none;"><div class="form-group">
                        <label><i>ความเห็น</i></label>
                        <input type="text" value="${comment}" data-id="${criteriatransaction.id}" class="form-control form-control-lg inpscore inputextracomment" >
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
    let cell5 = "";
    for (let row of table.rows) {
        const firstCell = row.cells[0];
        const secondCell = row.cells[1];
        const thirdCell = row.cells[2];
        const forthCell = row.cells[3];
        const fifthCell = row.cells[4];
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
    addScore($(this).data('id'),$(this).val(),$(this).data('subpillarindex'),1).then(data => {
        $('#weightsum'+$(this).data('subpillarindex')).val(data);
    }).catch(error => {})
});

$(document).on('change', '.inputextrascore', function(e) {
    if($(this).val() != '5' && $(this).val() != '4' && $(this).val() != '3' && $(this).val() != '2' && $(this).val() != '1' && $(this).val() != '0'){
        Swal.fire({
            title: 'ผิดพลาด...',
            text: 'กรอกคะแนน 0-5 เท่านั้น!',
        })
        $(this).val('');
        return;
    }  

    Extra.addExtraScore($(this).data('id'),$('#evid').val(),$(this).val()).then(data => {

    }).catch(error => {})
});

$(document).on('change', '.inputextracomment', function(e) {
    Extra.addExtraComment($(this).data('id'),$('#evid').val(),$(this).val()).then(data => {
    }).catch(error => {})
});


$(document).on('change', '.checkscore', function(e) {
    var state = 0;
    if($(this).is(':checked') == true){
        state=1;
        if($(this).data("name").includes("x2")){
            state=2;
        }
    }
    addScore($(this).data('id'),state,$(this).data('subpillarindex'),2).then(data => {
        $('#weightsum'+$(this).data('subpillarindex')).val(data);
    }).catch(error => {})
});

$(document).on('change', '.comment', function(e) {
    editComment($(this).data('id'),$(this).val()).then(data => {
    }).catch(error => {})
});

function addScore(transactionid,score,subpillarindex,scoretype){
    return new Promise((resolve, reject) => {
        $.ajax({
        url: `${route.url}/dashboard/admin/project/assessment/editscore`,
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

  function editComment(transactionid,comment){
    return new Promise((resolve, reject) => {
        $.ajax({
        url: `${route.url}/dashboard/admin/project/assessment/editcomment`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
            transactionid : transactionid,
            comment : comment
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

function updateScoringStatus(evid,status){
    return new Promise((resolve, reject) => {
        $.ajax({
        url: `${route.url}/dashboard/admin/project/assessment/updatescoringstatus`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
            evid : evid,
            status : status
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

  $(document).on('click', '#submitscore', function(e) {
    $("#spinicon").attr("hidden",false);
    updateScoringStatus($(this).data('id'),1).then(data => {
        if(jQuery.isEmptyObject(data) ){
            $('.inpscore').prop("disabled", false);
        }else{
            $('.inpscore').prop("disabled", true);
        }
        $("#spinicon").attr("hidden",true);
        Swal.fire({
            title: 'สำเร็จ...',
            text: 'นำส่งคะแนนสำเร็จ!',
        }).then((result) => {
            window.location.reload();
        });
    }).catch(error => {})
});
var submitbutton = true;
if($('#scoringstatus').val() != "" ){
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
            text: `ต้องการนำส่งคะแนน หรือไม่`,
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
                $('.gradescore').each(function() {
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

                // inppercentextra
                if($("#inppercentextra").val() != ''){
                    $('.extravalue').each(function() {
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
                }

                $("#spinicon").attr("hidden",false);
                updateScoringStatus($('#evid').val(),1).then(data => {
                    if(jQuery.isEmptyObject(data) ){
                        $('.inpscore').prop("disabled", false);
                    }else{
                        $('.inpscore').prop("disabled", true);
                    }
                    $("#spinicon").attr("hidden",true);
                    Swal.fire({
                        title: 'สำเร็จ...',
                        text: 'นำส่งคะแนนสำเร็จ!',
                    }).then((result) => {
                        window.location.reload();
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