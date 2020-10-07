
$(function() {
    getEv($('#evid').val()).then(data => {
        RenderTable(data);
        $(".loadprogress").attr("hidden",true);
        RowSpan("criteriatable");
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

        var criterianame = `<label>กรอกเกรด (A-F) <a href="#" class="text-grey conflictgrade" data-id="${criteria.id}" ><i class="icon-folder-open3"></i></a> </label>
                           <input type="text" id="gradescore" data-id="${criteria.id}" data-subpillarindex="${criteria.subpillarindex['id']}" data-scoretype="1" placeholder="" value="" class="form-control scoring">
                            `;

        if(criteria.criteria != null){
            criterianame = `<label class="form-check-label">
                                <input type="checkbox" id="checkscore" data-name="${criteria.criteria['name']}" data-id="${criteria.id}" data-scoretype="2" data-subpillarindex="${criteria.subpillarindex['id']}" class="form-check-input-styled-info scoring">
                                ${criteria.criteria['name']} <a href="#" class="text-grey conflictscore" data-id="${criteria.id}"><i class="icon-folder-open3"></i></a>
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
                            <input type="text" id="comment" data-id="${criteria.id}" data-subpillarindex="${criteria.subpillarindex['id']}" value="${comment}" class="form-control">
                            </div>
                        </div>`;

        var _scores = data.scores.filter(x => x.sub_pillar_index_id === criteria.subpillarindex['id']); 
        const numcheck = _scores.map(item => item.score).reduce((prev, curr) => parseInt(prev) + parseInt(curr), 0);
        console.log(numcheck)
        if(_scores.length > 0){
            var checklistgrading = data.checklistgradings.find(x => x.sub_pillar_index_id === criteria.subpillarindex['id']);
            // console.log(checklistgrading['gradea']);
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
            console.log(forthCell.innerText)
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


$(document).on('click', '#saveupdate', function(e) {
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
    console.log(conflictarray);

    updateScore(conflictarray).then(data => {
        Swal.fire({
            title: 'สำเร็จ...',
            text: 'สรุปคะแนนสำเร็จ!',
            });
    }).catch(error => {})
});
// $(document).on('change', '#gradescore', function(e) {
//     updateScore($(this).data('id'),$(this).val(),$(this).data('subpillarindex'),1).then(data => {
//         console.log(data);
//         $('#weightsum'+$(this).data('subpillarindex')).val(data.weightsum);
//         RenderTable(data);
//         $(".loadprogress").attr("hidden",true);
//         RowSpan("criteriatable");
//     }).catch(error => {})
// });

// $(document).on('change', '#checkscore', function(e) {
//     var state = 0;
//     if($(this).is(':checked') == true){
//         state=1;
//         if($(this).data("name").includes("x2")){
//             state=2;
//         }
//     }
//     updateScore($(this).data('id'),state,$(this).data('subpillarindex'),2).then(data => {
//         console.log(data);
//         $('#weightsum'+$(this).data('subpillarindex')).val(data.weightsum);
//         RenderTable(data);
//         $(".loadprogress").attr("hidden",true);
//         RowSpan("criteriatable");
//     }).catch(error => {})
// });

$(document).on('change', '#comment', function(e) {
    console.log($(this).data('id'));
    editComment($(this).data('id'),$(this).val()).then(data => {
        console.log(data);
    }).catch(error => {})
});

function updateScore(arraylist){
    return new Promise((resolve, reject) => {
        $.ajax({
        url: `${route.url}/dashboard/admin/assessment/updatescore`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
            arraylist : arraylist
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
            if ( typeof(check) !== "undefined" && check !== null ) {
                icon = '<i class="icon-check"></i>';
            }
            html += `<tr > 
            <td> ${conflict.user['name']} ${conflict.user['lastname']}</td>                                            
            <td> ${icon} </td>                                            
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
    console.log($(this).data('id'));
    showConflictGrade($(this).data('id')).then(data => {
        var html =``;
        data.forEach(function (conflict,index) {
            html += `<tr > 
            <td> ${conflict.user['name']} ${conflict.user['lastname']}</td>                                            
            <td> ${conflict.score} </td>                                            
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