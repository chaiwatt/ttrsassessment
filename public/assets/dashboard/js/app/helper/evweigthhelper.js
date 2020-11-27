import * as Ev from './ev.js';

$( document ).ready(function() {
    getEv($('#evid').val()).then(data => {
        console.log(data);
        RenderTable(data.criteriatransactions);
        RenderWeightTable(data.pillaindexweigths);
        console.log(data.pillaindexweigths);
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
    var readonly =``;
    if($('#evstatus').val() == 4 ){
        readonly =`readonly`;
    }
    data.forEach(function (pillaindex,index) {
        // $readonly = `<input type="number" id ="weigthvalue" value="${pillaindex.weigth}" data-id="${pillaindex.id}"class="form-control">`;

        html += `<tr > 
        <td> ${pillaindex.pillar['name']}</td>                                            
        <td> ${pillaindex.subpillar['name']}</td>    
        <td> 
            <div class="form-group">
                <label>${pillaindex.subpillarindex['name']}</label>
                <input type="number" id ="weigthvalue" value="${pillaindex.weigth}" ${readonly} data-id="${pillaindex.id}"class="form-control">
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

    // $('#chkevstatus').on('change.bootstrapSwitch', function(e) {
    //     var status = 2
    //     if(e.target.checked==true){
    //         status =3;
    //     }     
    //     console.log(status);   
    //     $("#spinicon").attr("hidden",false);
    //     updateEvAdminStatus($(this).data('id'),status).then(data => {
    //         $("#spinicon").attr("hidden",true);
    //     }).catch(error => {})
    // });

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

   $(document).on('click', '#sendedittojd', function(e) {
        $("#spiniconev").attr("hidden",false);
        sendEditEv($(this).data('id')).then(data => {
            $("#spiniconev").attr("hidden",true);
            window.location.reload();
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

      $(document).on('click', '#btn_modal_add_comment', function(e) {
        $("#addcommentspinicon").attr("hidden",false);
        Ev.addCommentStageTwo($('#evid').val(),$('#comment').val()).then(data => {
            $("#addcommentspinicon").attr("hidden",true);
            $('#modal_add_comment').modal('hide');
            window.location.reload();
        }).catch(error => {})
    });

    $('.nav-tabs a').on('shown.bs.tab', function (e) {
        // alert('Hello from the other siiiiiide!');
        if(route.usertypeid == 6)return;
        console.log($(e.target).attr("href"));
        if($(e.target).attr("href") == '#commenttab'){
            Ev.clearCommentTab($('#evid').val(),2).then(data => {
        
            }).catch(error => {})
        }
        // var previous_tab = e.relatedTarget;
    });
    
    $(document).on("click",".deletecomment",function(e){
        console.log($(this).data('id'));
        Swal.fire({
            title: 'คำเตือน!',
            text: `ต้องการลบรายการ หรือไม่`,
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
                    console.log(data);
                    var html =``;
                    data.forEach(function (comment,index) {
                            html += `<tr > 
                            <td> ${comment.created_at} </td>                                            
                            <td> ${comment.detail} </td>    
                            <td> <a type="button" data-id="${comment.id}" class="btn btn-sm bg-danger deletecomment">ลบ</a> </td>                                          
                            </tr>`
                        });
                    $("#ev_edit_history_wrapper_tr").html(html);
            
                }).catch(error => {})
            }
        });
    }); 

    $(document).on('click', '#approveevstagetwo', function(e) {
        $("#spinicon").attr("hidden",false);
        Ev.approveEvStageTwo($(this).data('id')).then(data => {
            $("#spinicon").attr("hidden",true);
            Swal.fire({
                title: 'สำเร็จ...',
                text: 'EV ได้รับการอนุมัติแล้ว',
            }).then((result) => {
                window.location.reload();
            });
        }).catch(error => {})
    });
