$(function() {
    getSummaryEv($('#evid').val()).then(data => {
        $('#showpercent').html(parseFloat(data.projectgrade.percent).toFixed(2));
        $('#showgrade').html(data.projectgrade.grade);
        sumGrade(data);
        RenderTable(data,1);
        if(data.ev.percentextra > 0){ 
            RenderExtraTable(data.extracriteriatransactions,data.extrascorings);
        }
         $(".loadprogress").attr("hidden",true);
         RowSpan("criteriatable");

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
    var pillarpercent4 = 0;
    var pillarpercent3 = 0;
    var pillarpercent2 = 0;
    var pillarpercent1 = 0;
    data.finalgrade.forEach((grade,index) => {
        $('#chartpillar' + (index+1)).html(grade.percent + ' %');
        $('#pillar' + (index+1)).html(grade.percent + ' %');
        $('#gradepillar' + (index+1)).html(grade.grade);
         //console.log(index);
 
        if(index == 0){
            pillarpercent4 = grade.percent;
        }else if(index == 1){
            pillarpercent3 = grade.percent;
        }else if(index == 2){
            pillarpercent2 = grade.percent;
        }else if(index == 3){
            pillarpercent1 = grade.percent;
        }
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
            <td>${grade.grade}</td>
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
            <td>${grade.grade}</td>
            <tr>`
        }

    });  
    // var angle = grade.percent*1.8;
    $('.chart-skills4').find('span:nth-child(1)').text(`${pillarpercent4}%`);
    $('.chart-skills4').find('li:nth-child(1)').css('transform', `rotate(${pillarpercent4*1.8}deg)`);
    $('.chart-skills4').find('span:nth-child(1)').css('transform', `rotate(${(-1.8)*pillarpercent4}deg)`);
    if(pillarpercent4 == 100){
        $('.chart-skills4').find('span:nth-child(1)').css('top', `20px`);
    }

    $('.chart-skills3').find('span:nth-child(1)').text(`${pillarpercent3}%`);
    $('.chart-skills3').find('li:nth-child(1)').css('transform', `rotate(${pillarpercent3*1.8}deg)`);
    $('.chart-skills3').find('span:nth-child(1)').css('transform', `rotate(${(-1.8)*pillarpercent3}deg)`);
    if(pillarpercent3 == 100){
        $('.chart-skills3').find('span:nth-child(1)').css('top', `20px`);
    }

    $('.chart-skills2').find('span:nth-child(1)').text(`${pillarpercent2}%`);
    $('.chart-skills2').find('li:nth-child(1)').css('transform', `rotate(${pillarpercent2*1.8}deg)`);
    $('.chart-skills2').find('span:nth-child(1)').css('transform', `rotate(${(-1.8)*pillarpercent2}deg)`);
    if(pillarpercent2 == 100){
        $('.chart-skills2').find('span:nth-child(1)').css('top', `20px`);
    }

    $('.chart-skills').find('span:nth-child(1)').text(`${pillarpercent1}%`);
    $('.chart-skills').find('li:nth-child(1)').css('transform', `rotate(${pillarpercent1*1.8}deg)`);
    $('.chart-skills').find('span:nth-child(1)').css('transform', `rotate(${(-1.8)*pillarpercent1}deg)`);
    if(pillarpercent1 == 100){
        $('.chart-skills1').find('span:nth-child(1)').css('top', `20px`);
    }

    $("#chartarea").attr("hidden",false);
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
                    console.log(criteria.sumscoring['score']);
                    //checkvalue = "checked";
                    if(criteria.sumscoring['score'] == '1'){
                        checkvalue = "checked";
                    }
                }
            }

            var criterianame = `<label>กรอกเกรด/คะแนน</label>
                                    <input type="text" data-id="${criteria.id}" data-subpillarindex="${criteria.subpillarindex['id']}" placeholder="" value="${textvalue}" class="form-control inpscore">`;

            if(criteria.criteria != null){
                criterianame = `<label class="form-check-label">
                                    <input type="checkbox" data-name="${criteria.criteria['name']}" data-id="${criteria.id}" data-subpillarindex="${criteria.subpillarindex['id']}" class="form-check-input-styled-info inpscore" ${checkvalue}>
                                    ${criteria.criteria['name']}
                                </label>`;
            }

            criterianame += `<div class="toggle"><div class="form-group">
                                <label><i>ความเห็น</i></label>
                                <input type="text" data-id="${criteria.id}" data-subpillarindex="${criteria.subpillarindex['id']}" value="${comment}" class="form-control inpscore">
                                </div>
                            </div>`;
            
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

function RenderExtraTable(data,extrascorings){
    var html =``;
    data.forEach(function (criteriatransaction,index) {
        var find = extrascorings.filter(function(result) {
            return result.ev_id === criteriatransaction.ev_id && result.extra_critreria_transaction_id === criteriatransaction.id;
          });
          
         var comment = '';
         if(find[0].comment != null){
            comment = find[0].comment;
         }
            html += `<tr > 
            <td> ${criteriatransaction.extracategory['name']} <a href="#" type="button" data-categoryid="${criteriatransaction.extra_category_id}" class="text-grey-300"></a></td>                
            <td> ${criteriatransaction.extracriteria['name']} <a href="#" type="button"  data-categoryid="${criteriatransaction.extra_category_id}" data-criteriaid="${criteriatransaction.extra_criteria_id}" class="text-grey-300 "></a></td>                                            
            <td> 
            <div class="form-group">
                <label>กรอกคะแนน (0 - 5) <a href="#" data-toggle="modal" class="text-grey conflictextrascore" data-id="${criteriatransaction.id}"><i class="icon-folder-open3"></i></a></label>
                <input type="text" value="${find[0].scoring}" data-id="${criteriatransaction.id} "class="form-control inputextrascore weigthvalue decimalformat" readonly >

                <div class="toggle"><div class="form-group">
                    <label><i>ความเห็น</i></label>
                    <input type="text" value="${comment}" class="form-control form-control-lg inpscore inputextracomment" >
                </div>

            </div>
       
        </td> 
    </tr>`
    });
    $("#extra_criteria_transaction_wrapper_tr").html(html);
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
    enableFinishButton: false,
    onFinished: function (event, currentIndex) {

    },
    transitionEffect: 'fade',
    autoFocus: true,
    onStepChanged:function (event, currentIndex, newIndex) {
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