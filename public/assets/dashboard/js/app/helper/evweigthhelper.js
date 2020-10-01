
$( document ).ready(function() {
    getEv($('#evid').val()).then(data => {
        console.log(data);
        RenderTable(data.criteriatransactions);
        RenderWeightTable(data.pillaindexweigths);
        $(".loadprogress").attr("hidden",true);
        RowSpan("criteriatable");
        RowSpanWeight("subpillarindex");
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

  $(document).on('change', '#weigthvalue', function(e) {
    // $(".loadprogress2").attr("hidden",false);
    editWeight($(this).data('id'),$(this).val()).then(data => {
        // $(".loadprogress2").attr("hidden",true);
        // console.log(data.sumweigth);
        $('#sumofweight').html(data.sumweigth);
    }).catch(error => {})
});

function editWeight(id,value){
    return new Promise((resolve, reject) => {
        $.ajax({
        url: `${route.url}/dashboard/admin/project/evweight/editsave`,
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

function RenderTable(data){
    var html =``;
    data.forEach(function (criteria,index) {
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
        });
    $("#criteria_transaction_wrapper_tr").html(html);
}

function RenderWeightTable(data){
    var html =``;
    data.forEach(function (pillaindex,index) {
        html += `<tr > 
        <td> ${pillaindex.pillar['name']}</td>                                            
        <td> ${pillaindex.subpillar['name']}</td>    
        <td> 
            <div class="form-group">
                <label>${pillaindex.subpillarindex['name']}</label>
                <input type="number" id ="weigthvalue" value="${pillaindex.weigth}" data-id="${pillaindex.id}"  class="form-control">
            </div>
        </td>                           
        </tr>`
        });
    $("#subpillar_index_transaction_wrapper_tr").html(html);
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

    $('#chkevstatus').on('change.bootstrapSwitch', function(e) {
        var status = 2
        if(e.target.checked==true){
            status =3;
        }     
        console.log(status);   
        $("#spinicon").attr("hidden",false);
        updateEvAdminStatus($(this).data('id'),status).then(data => {
            $("#spinicon").attr("hidden",true);
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

   $(document).on('click', '#sendedittojd', function(e) {
        $("#spiniconev").attr("hidden",false);
        sendEditEv($(this).data('id')).then(data => {
            $("#spiniconev").attr("hidden",true);
        }).catch(error => {})
    });

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



