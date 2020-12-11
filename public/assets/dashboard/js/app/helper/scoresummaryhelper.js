$(function() {
    getSummaryEv($('#evid').val()).then(data => {
        $('#showpercent').html(parseFloat(data.projectgrade.percent).toFixed(2));
        $('#showgrade').html(data.projectgrade.grade);
        sumGrade(data);
        RenderTable(data,1);
        if(data.ev.percentextra > 0){
            RenderTable(data,2);   
        }
        $(".loadprogress").attr("hidden",true);
        RowSpan("criteriatable");
        if(data.ev.percentextra > 0){
            RowSpan("extra_criteriatable");
        }
        $('.inpscore').prop("disabled", true);
        

    }).catch(error => {})
});

function getSummaryEv(evid){
    return new Promise((resolve, reject) => {
        $.ajax({
        url: `${route.url}/dashboard/admin/project/assessment/getsummaryev`,
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

  
  function sumGrade(data){
    var html1 =``;
    var html2 =``;
    data.finalgrade.forEach((grade,index) => {
        if(index < 4){
            var basepillar = ``;
            if(grade.pillar_id == 1){
                basepillar = `Management`;
            }
            if(grade.pillar_id == 2){
                basepillar = `เทคโนโลยี`;
            }
            if(grade.pillar_id == 3){
                basepillar = `การตลาด`;
            }
            if(grade.pillar_id == 4){
                basepillar = `ธุรกิจ`;
            }
            html1 += `<tr>
            <td>${basepillar}</td>
            <td>${parseFloat(grade.percent).toFixed(2)}</td>
            <tr>`
        }else{
            var basepillar = ``;
            if(grade.pillar_id == 5){
                basepillar = `Management`;
            }
            if(grade.pillar_id == 6){
                basepillar = `เทคโนโลยี`;
            }
            if(grade.pillar_id == 7){
                basepillar = `การตลาด`;
            }
            if(grade.pillar_id == 8){
                basepillar = `ธุรกิจ`;
            }
            html2 += `<tr>
            <td>${basepillar}</td>
            <td>${parseFloat(grade.percent).toFixed(2)}</td>
            <tr>`
        }
;
    });   
    $("#gradesummary_wrapper_tr").html(html1); 
    $("#extra_gradesummary_wrapper_tr").html(html2); 
  }

  function RowSpanSummary(tableid){
    const table = document.getElementById(tableid);// document.querySelector('table');
    let cell1 = "";
    let cell2 = "";
    let cell3 = "";
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

    }
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
            console.log(forthCell.innerText)
            if (forthCell.innerText.includes("placeholder") == true){
                cell4.rowSpan++;
                forthCell.remove();
            }
        }

    }
}

$(document).on('click', '#togglecomment', function(e) {
    $('.toggle').toggle();
 });


 function RenderTable(data,evtype){
    console.log(data.criteriatransactions);
    var html =``;

    data.criteriatransactions.forEach((criteria,index) => {
        if(criteria.ev_type_id == evtype){
            var textvalue = '';
            var checkvalue = '';
            var comment = '';
            var raw = 0;
            if(criteria.sumscoring != null){
                if(criteria.sumscoring['comment'] != null){comment = criteria.sumscoring['comment'];}
                if(criteria.sumscoring['scoretype'] == 1){
                    textvalue = criteria.sumscoring['score'];
                    if(textvalue == 'A'){
                        raw = 5;
                    }else if(textvalue == 'B'){
                        raw = 4;
                    }else if(textvalue == 'C'){
                        raw = 3;
                    }else if(textvalue == 'D'){
                        raw = 2;
                    }else if(textvalue == 'E'){
                        raw = 1;
                    }
                }else if(criteria.sumscoring['scoretype'] == 2){
                    checkvalue = "checked";
                }
            }

            var criterianame = `<label>กรอกเกรด/คะแนน</label>
                                    <input type="text" id="gradescore" data-id="${criteria.id}" data-subpillarindex="${criteria.subpillarindex['id']}" placeholder="" value="${textvalue}" class="form-control inpscore">`;

            if(criteria.criteria != null){
                criterianame = `<label class="form-check-label">
                                    <input type="checkbox" id="checkscore" data-name="${criteria.criteria['name']}" data-id="${criteria.id}" data-subpillarindex="${criteria.subpillarindex['id']}" class="form-check-input-styled-info inpscore" ${checkvalue}>
                                    ${criteria.criteria['name']}
                                </label>`;
            }
            // var indexpercent = (data.evportions.find(x => x.id === 1)['percent'])/100;
            // var pillarpercent = (data.pillars.find(x => x.id === criteria.pillar['id'])['percent'])/100;
            // var check = data.pillaindexweigths.find(x => x.sub_pillar_index_id === criteria.subpillarindex['id']);
            // var pillarweight = 0;
            // if ( typeof(check) !== "undefined" && check !== null ) {
            //     pillarweight = check['weigth'];
            // }
            // var weightsum = raw*indexpercent*pillarpercent*pillarweight;

            criterianame += `<div class="toggle" style="display:none;"><div class="form-group">
                                <label><i>ความเห็น</i></label>
                                <input type="text" id="comment" data-id="${criteria.id}" data-subpillarindex="${criteria.subpillarindex['id']}" value="${comment}" class="form-control inpscore">
                                </div>
                            </div>`;

            // var _scores = data.scores.filter(x => x.sub_pillar_index_id === criteria.subpillarindex['id']); 
            // const numcheck = _scores.map(item => item.score).reduce((prev, curr) => parseInt(prev) + parseInt(curr), 0);

            // if(_scores.length > 0){
            //     var checklistgrading = data.checklistgradings.find(x => x.sub_pillar_index_id === criteria.subpillarindex['id']);
            //     var grades = [checklistgrading['gradea'], checklistgrading['gradeb'], checklistgrading['gradec'], checklistgrading['graded'],checklistgrading['gradee'],checklistgrading['gradef']];
            //     let gradeis = 0;
            //     for (let i = 0; i < grades.length; i++) {
            //         if(numcheck >= grades[i]){
            //             gradeis = i;
            //             break;
            //         }
            //     } 
            //     if(gradeis == 0){
            //         weightsum = 5*indexpercent*pillarpercent*pillarweight;
            //     }else if(gradeis == 1){
            //         weightsum = 4*indexpercent*pillarpercent*pillarweight;
            //     }else if(gradeis == 2){
            //         weightsum = 3*indexpercent*pillarpercent*pillarweight;
            //     }else if(gradeis == 3){
            //         weightsum = 2*indexpercent*pillarpercent*pillarweight;
            //     }else if(gradeis == 4){
            //         weightsum = 1*indexpercent*pillarpercent*pillarweight;
            //     }
            // }
            
            html += `<tr > 
            <td> ${criteria.pillar['name']}</td>                                            
            <td> ${criteria.subpillar['name']}</td>    
            <td> ${criteria.subpillarindex['name']}</td>   
            <td> ${criterianame} </td>                                          
            </tr>`
        }
        });
        if(evtype == 1){
            $("#criteria_summary_wrapper_tr").html(html);
        }else if(evtype == 2){
            $("#extra_criteria_transaction_wrapper_tr").html(html);
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
    enableFinishButton: false,
    onFinished: function (event, currentIndex) {
        // $('.scoring').each(function() {
        //     if($(this).val() == ''){
        //         Swal.fire({
        //             title: 'ผิดพลาด...',
        //             text: 'กรุณากรอกเกรด/คะแนนให้ครบ!',
        //             });
        //         return;
        //     }
        // });
        // var conflictarray = $(".scoring").map(function () {
        //     var val = $(this).val();
        //     if($(this).data('scoretype') == 2){
        //         val = $(this).is(':checked');
        //     }
        //     return {
        //         evid: $('#evid').val(),
        //         criteriatransactionid: $(this).data('id'),
        //         subpillarindex: $(this).data('subpillarindex'),
        //         scoretype: $(this).data('scoretype'),
        //         value: val
        //       } 
        // }).get();
        // $("#spinicon").attr("hidden",false);
        // updateScore(conflictarray,$('#evid').val()).then(data => {
        //     $("#spinicon").attr("hidden",true);
        //     Swal.fire({
        //         title: 'สำเร็จ...',
        //         text: 'สรุปคะแนนสำเร็จ!',
        //         }).then((result) => {
        //             window.location.replace(`${route.url}/dashboard/admin/assessment`);
        //         });
        // }).catch(error => {})
    },
    transitionEffect: 'fade',
    autoFocus: true,
    onStepChanged:function (event, currentIndex, newIndex) {
        return true;
    },   
});

// function updateScore(arraylist,evid){
//     return new Promise((resolve, reject) => {
//         $.ajax({
//         url: `${route.url}/dashboard/admin/assessment/updatescore`,
//         type: 'POST',
//         headers: {"X-CSRF-TOKEN":route.token},
//         data: {
//             arraylist : arraylist,
//             evid : evid
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