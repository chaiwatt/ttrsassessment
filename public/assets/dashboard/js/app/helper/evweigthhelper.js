import * as Ev from './ev.js';
import * as Extra from './extra.js';

$(function() {
    getEv($('#evid').val()).then(data => {
        console.log(data);
        // RenderTable(data.criteriatransactions,1);
        // RenderTable(data.criteriatransactions,2);
        RenderWeightTable(data.pillaindexweigths,1);
        // RenderWeightTable(data.pillaindexweigths,2);
        RenderExtraTable(data.extracriteriatransactions);
        
        $(".loadprogress").attr("hidden",true);
        // RowSpan("criteriatable");
        // RowSpan("extra_criteriatable");
        RowSpanWeight("subpillarindex");
        RowSpanExtra("extra_subpillarindex");
        $('#weight').html('(' + data.sumweigth.toFixed(3) + ')');
        $('#extraweight').html('(' + data.sumextraweigth.toFixed(3) + ')');
        
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

 $(document).on('focusin', '.weigthvalue1', function(){
    $(this).data('old', $(this).val());
 }).on('change', '.weigthvalue1', function(e) {
    var check = parseFloat($('#weight').html().replace(/[{()}]/g, ''));
    var newval = check + parseFloat($(this).val()) - parseFloat($(this).data('old'));

    var sum =0;
    $('.weigthvalue1').each(function(){
        var val = parseFloat($(this).val());
        sum += val;
    });
    if(sum.toFixed(3) > 1){
        Swal.fire({
            title: 'ผิดพลาด...',
            text: 'ผลรวม Weight มากกว่า 1 !',
            });
            $(this).val($(this).data('old')) 
            return;
    }

    if(newval.toFixed(3) > 1){
        Swal.fire({
            title: 'ผิดพลาด...',
            text: 'ผลรวม Weight มากกว่า 1 !',
            });
            $(this).val($(this).data('old')) 
            return;
    }
    editWeight($(this).data('id'),$(this).val(),1).then(data => {
        $('#weight').html('(' + data.sumweigth.toFixed(3) + ')');
    }).catch(error => {})
});

// $(document).on('focusin', '.weigthvalue1', function(){
//     $(this).data('old', $(this).val());
//  }).on('change', '.weigthvalue2', function(e) {
//     var check = parseFloat($('#extraweight').html().replace(/[{()}]/g, ''));
//     var newval = check + parseFloat($(this).val()) - parseFloat($(this).data('old'));
//     if(newval.toFixed(3) > 1){
//         Swal.fire({
//             title: 'ผิดพลาด...',
//             text: 'ผลรวม Weight มากกว่า 1 !',
//             });
//             $(this).val($(this).data('old')) 
//             return;
//     }
//     editWeight($(this).data('id'),$(this).val(),2).then(data => {
//         $('#extraweight').html('(' + data.sumweigth.toFixed(3) + ')');
//     }).catch(error => {})
// });

$(document).on('focusin', '.weigthvalue', function(){
    $(this).data('old', $(this).val());
 }).on('change', '.weigthvalue', function(e) {
    var check = parseFloat($('#extraweight').html().replace(/[{()}]/g, ''));
    var sum =0;
    $('.weigthvalue').each(function(){
        var val = parseFloat($(this).val());
        sum += val;
    });
    if(sum.toFixed(3) > 1){
        Swal.fire({
            title: 'ผิดพลาด...',
            text: 'ผลรวม Weight มากกว่า 1 !',
            });
            $(this).val($(this).data('old')) 
            return;
    }
    var newval = check + parseFloat($(this).val()) - parseFloat($(this).data('old'));
    // console.log(newval);
    if(newval.toFixed(3) > 1){
        Swal.fire({
            title: 'ผิดพลาด...',
            text: 'ผลรวม Weight มากกว่า 1 !',
            });
            $(this).val($(this).data('old')) 
            return;
    }
    Extra.editExtraWeight($('#evid').val(),$(this).data('id'),$(this).val()).then(data => {
        // console.log(data)
        $('#extraweight').html('(' + parseFloat(data).toFixed(3) + ')');
    }).catch(error => {})
});


function editWeight(id,value,evtypeid){
    return new Promise((resolve, reject) => {
        $.ajax({
        url: `${route.url}/dashboard/admin/project/evweight/editsave`,
        type: 'POST',
        headers: {"X-CSRF-TOKEN":route.token},
        data: {
            id : id,
            value : value,
            evtypeid : evtypeid,
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



  function RenderTable(data,evtype){
    var html =``;
    
    data.forEach(function (criteria,index) {
        if(criteria.ev_type_id == evtype){
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
        }
     });
     if(evtype == 1){
        $("#criteria_transaction_wrapper_tr").html(html);
    }else if(evtype == 2){
        $("#extra_criteria_transaction_wrapper_tr").html(html);
    }
    
}

function RenderWeightTable(data,evtypeid){
    var html =``;
    var readonly =`readonly`;
    // console.log($('#evstatus').val());
    if(($('#evstatus').val() == 2 || ($('#evstatus').val() == 3 && route.refixstatus == 1))){
        readonly =``;
    }
    if($('#evstatus').val() >= 4){
        readonly =`readonly`;
    }
    // console.log(data);
    data.forEach(function (pillaindex,index) {
        if(pillaindex.ev_type_id == evtypeid){
            html += `<tr > 
                <td> ${pillaindex.pillar['name']}</td>                                            
                <td> ${pillaindex.subpillar['name']}</td>    
                <td> 
                    <div class="form-group">
                        <label>${pillaindex.subpillarindex['name']}</label>
                        <input type="number" value="${pillaindex.weigth}" ${readonly} data-id="${pillaindex.id}"class="form-control inputweigth weigthvalue${evtypeid}">
                    </div>
                </td>                           
            </tr>`
            
        }
        });
        if(evtypeid == 1){
            $("#subpillar_index_transaction_wrapper_tr").html(html);
        }else if(evtypeid == 2){
            $("#extra_subpillar_index_transaction_wrapper_tr").html(html);
        }
}

function RenderExtraTable(data){
    var html =``;
    var readonly =`readonly`;
    // console.log($('#evstatus').val());
    if(($('#evstatus').val() == 2 || ($('#evstatus').val() == 3 && route.refixstatus == 1))){
        readonly =``;
    }
    if($('#evstatus').val() >= 4){
        readonly =`readonly`;
    }
    data.forEach(function (criteria,index) {
            html += `<tr > 
            <td> ${criteria.extracategory['name']} <a href="#" type="button" data-categoryid="${criteria.extra_category_id}" class="text-grey-300"></a></td>                
            <td> ${criteria.extracriteria['name']} <a href="#" type="button"  data-categoryid="${criteria.extra_category_id}" data-criteriaid="${criteria.extra_criteria_id}" class="text-grey-300 "></a></td>                                            
            <td> 
            <div class="form-group">
                <label>${criteria.extracriteria['name']}</label>
                <input type="number" value="${criteria.weight}" data-id="${criteria.id} "class="form-control inputextraweigth weigthvalue" ${readonly}>
            </div>
        </td> 
    </tr>`
    });
    console.log(html)
        $("#extra_criteria_transaction_wrapper_tr").html(html);
}

function RowSpanExtra(tableid){
    const table = document.getElementById(tableid);// document.querySelector('table');
    let cell1 = "";
    let cell2 = "";
    for (let row of table.rows) {
        const firstCell = row.cells[0];
        const secondCell = row.cells[1];
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
    }
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

//    $(document).on('click', '#sendedittojd', function(e) {
//         $("#spiniconev").attr("hidden",false);
//         sendEditEv($(this).data('id')).then(data => {
//             $("#spiniconev").attr("hidden",true);
//             Swal.fire({
//                 title: 'สำเร็จ...',
//                 text: 'นำส่ง EV ให้ JD สำเร็จ!',
//             }).then((result) => {
//                 window.location.reload();
//             });
//         }).catch(error => {})
//     });

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

    $(document).on('shown.bs.tab', 'a[data-toggle="tab"]', function (e) {
        if(route.usertypeid == 6)return;
        // console.log($(e.target).attr("href"));
        if($(e.target).attr("href") == '#commenttab'){
            Ev.clearCommentTab($('#evid').val(),2).then(data => {
        
            }).catch(error => {})
        }
    })

    // $('.nav-tabs a').on('shown.bs.tab', function (e) {
    //     console.log($(e.target).attr("href"));
    //     if(route.usertypeid == 6)return;
    //     console.log($(e.target).attr("href"));
    //     if($(e.target).attr("href") == '#commenttab'){
    //         Ev.clearCommentTab($('#evid').val(),2).then(data => {
        
    //         }).catch(error => {})
    //     }
    //     // var previous_tab = e.relatedTarget;
    // });
    
    $(document).on("click",".deletecomment",function(e){
        // console.log($(this).data('id'));
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
                    // console.log(data);
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
    var submitbutton = false;

    if(($('#evstatus').val() == 2 || ($('#evstatus').val() == 3 && route.refixstatus == 1)) && route.usertypeid != 6){
        submitbutton = true;
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
			finish: '<i class="icon-spinner spinner mr-2" id="spiniconsendjd" hidden/>นำส่ง JD <i class="icon-arrow-right14 ml-2" />'
		},
		enableFinishButton: submitbutton,
		onFinished: function (event, currentIndex) {
            $('.inputweigth').each(function() {
                if($(this).val() == ''){
                    $(this).val(0);
                }
            });

            if(parseFloat($('#weight').html().replace(/[{()}]/g, '')) != 1){
                Swal.fire({
                    title: 'ผิดพลาด...',
                    text: 'ผลรวม Index Weight ไม่เท่ากับ 1',
                })
                return ;
            }
            if($('#percentextra').val() > 0){
                if(parseFloat($('#extraweight').html().replace(/[{()}]/g, '')) != 1){
                    Swal.fire({
                        title: 'ผิดพลาด...',
                        text: 'ผลรวม Extra Weight ไม่เท่ากับ 1',
                    })
                    return ;
                }
            }  
            // $("#sendedittojd").trigger("click");
            $("#spiniconsendjd").attr("hidden",false);
            sendEditEv($('#evid').val()).then(data => {
                $("#spiniconsendjd").attr("hidden",true);
                Swal.fire({
                    title: 'สำเร็จ...',
                    text: 'นำส่ง EV ให้ JD สำเร็จ!',
                }).then((result) => {
                    window.location.reload();
                });
            }).catch(error => {})
		},
		transitionEffect: 'fade',
		autoFocus: true,
		onStepChanged:function (event, currentIndex, newIndex) {
			// console.log('current step ' + currentIndex);

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