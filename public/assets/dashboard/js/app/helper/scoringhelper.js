
$( document ).ready(function() {
    getEv($('#evid').val()).then(data => {

        RenderTable(data.criteriatransactions);
        $(".loadprogress").attr("hidden",true);
        RowSpan("criteriatable");
        $('#sumofweight').html(data.sumweigth);
    }).catch(error => {})
});

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

  $(document).on('click', '#togglecomment', function(e) {
      $('.toggle').toggle();
   });
function RenderTable(data){
    var html =``;
    data.forEach(function (criteria,index) {
        var criterianame = `<label>กรอกเกรด (A-F)</label>
                                <input type="text" id="gradescore" data-id="${criteria.id}" placeholder="" class="form-control">`;
        if(criteria.criteria != null){
            criterianame = `<label class="form-check-label">
                                <input type="checkbox" id="checkscore" data-id="${criteria.id}" class="form-check-input-styled-info" >
                                ${criteria.criteria['name']}
                            </label>`;
        }
        criterianame += `<div class="toggle" style="display:none;"><div class="form-group">
                            <label><i>ความเห็น</i></label>
                            <input type="text" id="comment" data-id="${criteria.id}" class="form-control">
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

$(document).on('change', '#gradescore', function(e) {
    console.log($(this).data('id'));
    // editWeight($(this).data('id'),$(this).val()).then(data => {
    //     $('#sumofweight').html(data.sumweigth);
    // }).catch(error => {})
});

function addScore(evid){
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
