
$(function() {
    getEv($('#evid').val()).then(data => {
        RenderTable(data);
        $(".loadprogress").attr("hidden",true);
        RowSpan("criteriatable");
        $('#sumofweight').html(data.sumweigth);
        if(jQuery.isEmptyObject(data.scoringstatus) ){
            $('.inpscore').prop("disabled", false);
        }else{
            $('.inpscore').prop("disabled", true);
        }
        
    }).catch(error => {})
});

function getEv(evid){
    return new Promise((resolve, reject) => {
        $.ajax({
        url: `${route.url}/dashboard/admin/project/assessment/getev`,
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
    console.log(data);
    var html =``;
    data.criteriatransactions.forEach((criteria,index) => {
        var textvalue = '';
        var checkvalue = '';
        var comment = '';
        var raw = 0;
        if(criteria.scoring != null){
            if(criteria.scoring['comment'] != null){comment = criteria.scoring['comment'];}
            if(criteria.scoring['scoretype'] == 1){
                textvalue = criteria.scoring['score'];
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
            }else if(criteria.scoring['scoretype'] == 2){
                checkvalue = "checked";
            }
        }

        var criterianame = `<label>กรอกเกรด (A-F)</label>
                                <input type="text" id="gradescore" data-id="${criteria.id}" data-subpillarindex="${criteria.subpillarindex['id']}" placeholder="" value="${textvalue}" class="form-control inpscore">`;

        if(criteria.criteria != null){
            criterianame = `<label class="form-check-label">
                                <input type="checkbox" id="checkscore" data-name="${criteria.criteria['name']}" data-id="${criteria.id}" data-subpillarindex="${criteria.subpillarindex['id']}" class="form-check-input-styled-info inpscore" ${checkvalue}>
                                ${criteria.criteria['name']}
                            </label>`;
        }
        var indexpercent = (data.evportions.find(x => x.id === 1)['percent'])/100;
        var pillarpercent = (data.pillars.find(x => x.id === criteria.pillar['id'])['percent'])/100;
        var check = data.pillaindexweigths.find(x => x.sub_pillar_index_id === criteria.subpillarindex['id']);
        var pillarweight = 0;
        if ( typeof(check) !== "undefined" && check !== null ) {
            pillarweight = check['weigth'];
        }
        var weightsum = raw*indexpercent*pillarpercent*pillarweight;

        criterianame += `<div class="toggle" style="display:none;"><div class="form-group">
                            <label><i>ความเห็น</i></label>
                            <input type="text" id="comment" data-id="${criteria.id}" data-subpillarindex="${criteria.subpillarindex['id']}" value="${comment}" class="form-control inpscore">
                            </div>
                        </div>`;

        // var numcheck = data.scores.filter(x => x.sub_pillar_index_id === criteria.subpillarindex['id']).length; 
        var _scores = data.scores.filter(x => x.sub_pillar_index_id === criteria.subpillarindex['id']); 
        const numcheck = _scores.map(item => item.score).reduce((prev, curr) => parseInt(prev) + parseInt(curr), 0);
        console.log(numcheck)
        if(_scores.length > 0){
            var checklistgrading = data.checklistgradings.find(x => x.sub_pillar_index_id === criteria.subpillarindex['id']);
            console.log(checklistgrading['gradea']);
            var grades = [checklistgrading['gradea'], checklistgrading['gradeb'], checklistgrading['gradec'], checklistgrading['graded'],checklistgrading['gradee'],checklistgrading['gradef']];
            let gradeis = 0;
            for (let i = 0; i < grades.length; i++) {
                if(numcheck >= grades[i]){
                    gradeis = i;
                    break;
                }
            } 
            if(gradeis == 0){
                weightsum = 5*indexpercent*pillarpercent*pillarweight;
            }else if(gradeis == 1){
                weightsum = 4*indexpercent*pillarpercent*pillarweight;
            }else if(gradeis == 2){
                weightsum = 3*indexpercent*pillarpercent*pillarweight;
            }else if(gradeis == 3){
                weightsum = 2*indexpercent*pillarpercent*pillarweight;
            }else if(gradeis == 4){
                weightsum = 1*indexpercent*pillarpercent*pillarweight;
            }
        }

        html += `<tr > 
        <td> ${criteria.pillar['name']}</td>                                            
        <td> ${criteria.subpillar['name']}</td>    
        <td> ${criteria.subpillarindex['name']}</td>   
        <td> ${criterianame} </td>     
        <td> 
            <label>${criteria.subpillarindex['name']}</label>
            <input type="text" id="weightsum${criteria.subpillarindex['id']}" data-id="${criteria.id}" data-subpillarindex="${criteria.subpillarindex['id']}" placeholder="" value="${weightsum}" class="form-control" disabled> 
        </td>                                       
        </tr>`
        });
    $("#criteria_transaction_wrapper_tr").html(html);
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
        if (cell5 === null || fifthCell.innerText !== cell5.innerText) {
            cell5 = fifthCell;
        } else {
            cell5.rowSpan++;
            fifthCell.remove();
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

$(document).on('change', '#gradescore', function(e) {
    console.log($(this).data('id'));
    addScore($(this).data('id'),$(this).val(),$(this).data('subpillarindex'),1).then(data => {
        console.log(data);
        $('#weightsum'+$(this).data('subpillarindex')).val(data);
    }).catch(error => {})
});

$(document).on('change', '#checkscore', function(e) {
    var state = 0;
    if($(this).is(':checked') == true){
        state=1;
        if($(this).data("name").includes("x2")){
            state=2;
        }
    }
    console.log('hello');
    addScore($(this).data('id'),state,$(this).data('subpillarindex'),2).then(data => {
        console.log(data);
        $('#weightsum'+$(this).data('subpillarindex')).val(data);
    }).catch(error => {})
});

$(document).on('change', '#comment', function(e) {
    console.log($(this).data('id'));
    editComment($(this).data('id'),$(this).val()).then(data => {
        console.log(data);
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

  $('#chkscorestatus').on('change.bootstrapSwitch', function(e) {
    var status = 0
    if(e.target.checked==true){
        status =1;
    }        
    console.log($(this).data('id') + ' ' + status);
    $("#spinicon").attr("hidden",false);
    updateScoringStatus($(this).data('id'),status).then(data => {
        console.log(data);
        if(jQuery.isEmptyObject(data) ){
            $('.inpscore').prop("disabled", false);
        }else{
            $('.inpscore').prop("disabled", true);
        }
        $("#spinicon").attr("hidden",true);
    }).catch(error => {})
});

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